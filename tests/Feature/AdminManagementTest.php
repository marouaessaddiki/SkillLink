<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Mission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_a_mission(): void
    {
        $role = Role::create(['name' => 'admin', 'display_name' => 'Admin']);
        $admin = User::factory()->create();
        $admin->addRole($role);
        $client = User::factory()->create();
        $category = Category::create(['name' => 'Development']);
        $mission = Mission::create([
            'client_id' => $client->id,
            'category_id' => $category->id,
            'title' => 'Remove me',
            'description' => 'Mission',
            'budget' => 100,
            'deadline' => now()->addDays(5),
            'status' => 'open',
        ]);

        $this->actingAs($admin)
            ->delete("/admin/missions/{$mission->id}")
            ->assertRedirect();

        $this->assertDatabaseMissing('missions', ['id' => $mission->id]);
    }

    public function test_admin_category_description_is_persisted(): void
    {
        $role = Role::create(['name' => 'admin', 'display_name' => 'Admin']);
        $admin = User::factory()->create();
        $admin->addRole($role);

        $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Marketing',
            'description' => 'Digital marketing services',
        ])->assertRedirect('/admin/categories');

        $this->assertDatabaseHas('categories', [
            'name' => 'Marketing',
            'description' => 'Digital marketing services',
        ]);
    }

    public function test_admin_cannot_delete_a_category_used_by_a_mission(): void
    {
        $role = Role::create(['name' => 'admin', 'display_name' => 'Admin']);
        $admin = User::factory()->create();
        $admin->addRole($role);
        $client = User::factory()->create();
        $category = Category::create(['name' => 'Development']);
        $mission = Mission::create([
            'client_id' => $client->id,
            'category_id' => $category->id,
            'title' => 'Protected mission',
            'description' => 'Mission',
            'budget' => 100,
            'deadline' => now()->addDays(5),
            'status' => 'open',
        ]);

        $this->actingAs($admin)
            ->delete("/admin/categories/{$category->id}")
            ->assertSessionHas('error');

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertDatabaseHas('missions', ['id' => $mission->id, 'category_id' => $category->id]);
    }
}
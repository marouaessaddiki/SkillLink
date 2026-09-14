<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Mission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardAndSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_dashboard_displays_recent_missions(): void
    {
        $role = Role::create(['name' => 'client', 'display_name' => 'Client']);
        $client = User::factory()->create();
        $client->addRole($role);
        $category = Category::create(['name' => 'Development']);
        $mission = Mission::create([
            'client_id' => $client->id,
            'category_id' => $category->id,
            'title' => 'Recent dashboard mission',
            'description' => 'Mission description',
            'budget' => 500,
            'deadline' => now()->addDays(5),
            'status' => 'open',
        ]);

        $this->actingAs($client)
            ->get('/client/dashboard')
            ->assertOk()
            ->assertSee($mission->title);
    }

    public function test_freelancer_can_filter_missions_by_status(): void
    {
        $role = Role::create(['name' => 'freelance', 'display_name' => 'Freelance']);
        $freelance = User::factory()->create();
        $freelance->addRole($role);
        $client = User::factory()->create();
        $category = Category::create(['name' => 'Development']);
        Mission::create([
            'client_id' => $client->id,
            'category_id' => $category->id,
            'title' => 'Completed mission',
            'description' => 'Completed',
            'budget' => 500,
            'deadline' => now()->addDays(5),
            'status' => 'completed',
        ]);

        $this->actingAs($freelance)
            ->get('/freelance/missions?status=completed')
            ->assertOk()
            ->assertSee('Completed mission');
    }
}
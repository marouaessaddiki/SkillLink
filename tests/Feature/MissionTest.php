<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Role;

class MissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_create_a_mission(): void
    {
        $role = Role::create([
    'name' => 'client',
    'display_name' => 'Client',
]);

$client = User::factory()->create();

$client->addRole($role);
     

        $category = Category::create([
            'name' => 'Web Development',
        ]);

        $response = $this->actingAs($client)->post('/missions', [
            'title' => 'Test Mission',
            'description' => 'Test mission description',
            'category_id' => $category->id,
            'budget' => 1000,
            'deadline' => now()->addDays(7)->format('Y-m-d'),
            'status' => 'open',
        ]);

        $response->assertRedirect('/missions');

        $this->assertDatabaseHas('missions', [
            'title' => 'Test Mission',
            'client_id' => $client->id,
            'category_id' => $category->id,
        ]);
    }
    public function test_client_cannot_view_another_clients_mission(): void
{
    $role = Role::create([
        'name' => 'client',
        'display_name' => 'Client',
    ]);

    $client1 = User::factory()->create();
    $client1->addRole($role);

    $client2 = User::factory()->create();
    $client2->addRole($role);

    $category = Category::create([
        'name' => 'Web Development',
    ]);

    $mission = Mission::create([
        'client_id' => $client1->id,
        'category_id' => $category->id,
        'title' => 'Private Mission',
        'description' => 'Private mission',
        'budget' => 1000,
        'deadline' => now()->addDays(7),
        'status' => 'open',
    ]);

    $response = $this->actingAs($client2)
        ->get("/missions/{$mission->id}");

    $response->assertForbidden();
}

    public function test_new_mission_always_starts_open(): void
    {
        $role = Role::create(['name' => 'client', 'display_name' => 'Client']);
        $client = User::factory()->create();
        $client->addRole($role);
        $category = Category::create(['name' => 'Design']);

        $this->actingAs($client)->post('/missions', [
            'title' => 'Logo mission',
            'description' => 'Create a logo',
            'category_id' => $category->id,
            'budget' => 500,
            'deadline' => now()->addDays(7)->format('Y-m-d'),
            'status' => 'completed',
        ]);

        $this->assertDatabaseHas('missions', [
            'title' => 'Logo mission',
            'status' => 'open',
        ]);
    }
}
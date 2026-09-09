<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Category;
use App\Models\Mission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_freelance_can_apply_to_an_open_mission(): void
    {
        $clientRole = Role::create([
            'name' => 'client',
            'display_name' => 'Client',
        ]);

        $freelanceRole = Role::create([
            'name' => 'freelance',
            'display_name' => 'Freelance',
        ]);

        $client = User::factory()->create();
        $client->addRole($clientRole);

        $freelance = User::factory()->create();
        $freelance->addRole($freelanceRole);

        $category = Category::create([
            'name' => 'Web Development',
        ]);

        $mission = Mission::create([
            'client_id' => $client->id,
            'category_id' => $category->id,
            'title' => 'Test Mission',
            'description' => 'Test description',
            'budget' => 1000,
            'deadline' => now()->addDays(7),
            'status' => 'open',
        ]);

        $response = $this->actingAs($freelance)
            ->post("/freelance/missions/{$mission->id}/apply", [
                'cover_letter' => 'I am interested in this mission.',
                'proposed_price' => 900,
            ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('applications', [
            'mission_id' => $mission->id,
            'freelance_id' => $freelance->id,
            'proposed_price' => 900,
            'status' => 'pending',
        ]);
    }
    public function test_client_can_accept_an_application(): void
{
    $clientRole = Role::create([
        'name' => 'client',
        'display_name' => 'Client',
    ]);

    $freelanceRole = Role::create([
        'name' => 'freelance',
        'display_name' => 'Freelance',
    ]);

    $client = User::factory()->create();
    $client->addRole($clientRole);

    $freelance = User::factory()->create();
    $freelance->addRole($freelanceRole);

    $category = Category::create([
        'name' => 'Web Development',
    ]);

    $mission = Mission::create([
        'client_id' => $client->id,
        'category_id' => $category->id,
        'title' => 'Test Mission',
        'description' => 'Test description',
        'budget' => 1000,
        'deadline' => now()->addDays(7),
        'status' => 'open',
    ]);

    $application = Application::create([
        'mission_id' => $mission->id,
        'freelance_id' => $freelance->id,
        'cover_letter' => 'I can do this mission.',
        'proposed_price' => 900,
        'status' => 'pending',
    ]);

    $response = $this->actingAs($client)
        ->post("/client/applications/{$application->id}/accept");

    $response->assertSessionHas('success');

    $this->assertDatabaseHas('applications', [
        'id' => $application->id,
        'status' => 'accepted',
    ]);

    $this->assertDatabaseHas('missions', [
        'id' => $mission->id,
        'status' => 'in_progress',
    ]);
}
public function test_freelance_can_complete_an_in_progress_mission(): void
{
    $clientRole = Role::create([
        'name' => 'client',
        'display_name' => 'Client',
    ]);

    $freelanceRole = Role::create([
        'name' => 'freelance',
        'display_name' => 'Freelance',
    ]);

    $client = User::factory()->create();
    $client->addRole($clientRole);

    $freelance = User::factory()->create();
    $freelance->addRole($freelanceRole);

    $category = Category::create([
        'name' => 'Web Development',
    ]);

    $mission = Mission::create([
        'client_id' => $client->id,
        'category_id' => $category->id,
        'title' => 'Test Mission',
        'description' => 'Test description',
        'budget' => 1000,
        'deadline' => now()->addDays(7),
        'status' => 'in_progress',
    ]);

    Application::create([
        'mission_id' => $mission->id,
        'freelance_id' => $freelance->id,
        'cover_letter' => 'I can do this mission.',
        'proposed_price' => 900,
        'status' => 'accepted',
    ]);

    $response = $this->actingAs($freelance)
        ->post("/freelance/missions/{$mission->id}/complete");

    $response->assertSessionHas('success');

    $this->assertDatabaseHas('missions', [
        'id' => $mission->id,
        'status' => 'completed',
    ]);
}
}
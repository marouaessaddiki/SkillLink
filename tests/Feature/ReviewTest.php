<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Category;
use App\Models\Mission;
use App\Models\Role;
use App\Models\User;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_review_freelance_after_completed_mission(): void
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
            'title' => 'Completed Mission',
            'description' => 'Test completed mission',
            'budget' => 1000,
            'deadline' => now()->addDays(7),
            'status' => 'completed',
        ]);

        Application::create([
            'mission_id' => $mission->id,
            'freelance_id' => $freelance->id,
            'cover_letter' => 'I can do this mission.',
            'proposed_price' => 900,
            'status' => 'accepted',
        ]);

        $response = $this->actingAs($client)
    ->post("/client/missions/{$mission->id}/review", [
                'rating' => 5,
                'comment' => 'Excellent work!',
            ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('reviews', [
            'mission_id' => $mission->id,
            'reviewer_id' => $client->id,
            'reviewee_id' => $freelance->id,
            'rating' => 5,
            'comment' => 'Excellent work!',
        ]);
    }
    public function test_client_cannot_review_before_mission_is_completed(): void
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
        'title' => 'In Progress Mission',
        'description' => 'Test mission',
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

    $response = $this->actingAs($client)
        ->post("/client/missions/{$mission->id}/review", [
            'rating' => 5,
            'comment' => 'Excellent work!',
        ]);

    $response->assertForbidden();

    $this->assertDatabaseMissing('reviews', [
        'mission_id' => $mission->id,
        'reviewer_id' => $client->id,
    ]);
}
public function test_freelance_can_review_client_after_completed_mission(): void
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
        'title' => 'Completed Mission',
        'description' => 'Test completed mission',
        'budget' => 1000,
        'deadline' => now()->addDays(7),
        'status' => 'completed',
    ]);

    Application::create([
        'mission_id' => $mission->id,
        'freelance_id' => $freelance->id,
        'cover_letter' => 'I can do this mission.',
        'proposed_price' => 900,
        'status' => 'accepted',
    ]);

    $response = $this->actingAs($freelance)
        ->post("/freelance/missions/{$mission->id}/review-client", [
            'rating' => 4,
            'comment' => 'Good client!',
        ]);

    $response->assertSessionHas('success');

    $this->assertDatabaseHas('reviews', [
        'mission_id' => $mission->id,
        'reviewer_id' => $freelance->id,
        'reviewee_id' => $client->id,
        'rating' => 4,
        'comment' => 'Good client!',
    ]);
}
public function test_client_cannot_review_same_mission_twice(): void
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
        'title' => 'Completed Mission',
        'description' => 'Test completed mission',
        'budget' => 1000,
        'deadline' => now()->addDays(7),
        'status' => 'completed',
    ]);

    Application::create([
        'mission_id' => $mission->id,
        'freelance_id' => $freelance->id,
        'cover_letter' => 'I can do this mission.',
        'proposed_price' => 900,
        'status' => 'accepted',
    ]);

    // First review
    $this->actingAs($client)
        ->post("/client/missions/{$mission->id}/review", [
            'rating' => 5,
            'comment' => 'Excellent work!',
        ]);

    // Second review
    $response = $this->actingAs($client)
        ->post("/client/missions/{$mission->id}/review", [
            'rating' => 4,
            'comment' => 'Another review',
        ]);

    $response->assertSessionHas('error');

    $this->assertDatabaseCount('reviews', 1);
}
}
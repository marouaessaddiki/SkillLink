<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Mission;
use App\Models\Review;
use App\Http\Requests\StoreFreelanceReviewRequest;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Mission $mission)
    {
        // Only the client who owns the mission can review
        if ($mission->client_id !== auth()->id()) {
            abort(403);
        }

        // Mission must be completed
        if ($mission->status !== 'completed') {
            abort(403, 'This mission is not completed yet.');
        }

        // Get the accepted application
        $application = $mission->applications()
            ->where('status', 'accepted')
            ->first();

        if (!$application) {
            abort(403, 'No accepted freelancer found.');
        }

        // Prevent duplicate review
        $alreadyReviewed = Review::where('mission_id', $mission->id)
            ->where('reviewer_id', auth()->id())
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'You already reviewed this mission.');
        }

        Review::create([
            'mission_id' => $mission->id,
            'reviewer_id' => auth()->id(),
            'reviewee_id' => $application->freelance_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with(
            'success',
            'Review submitted successfully!'
        );
    }
    public function reviewClient(
    StoreFreelanceReviewRequest $request,
    Mission $mission
) {
    // Find the accepted application of the logged-in freelancer
    $application = $mission->applications()
        ->where('freelance_id', auth()->id())
        ->where('status', 'accepted')
        ->first();

    if (!$application) {
        abort(403, 'You are not assigned to this mission.');
    }

    // Mission must be completed
    if ($mission->status !== 'completed') {
        abort(403, 'This mission is not completed yet.');
    }

    // Prevent duplicate review
    $alreadyReviewed = Review::where('mission_id', $mission->id)
        ->where('reviewer_id', auth()->id())
        ->exists();

    if ($alreadyReviewed) {
        return back()->with(
            'error',
            'You already reviewed this client.'
        );
    }

    Review::create([
        'mission_id' => $mission->id,
        'reviewer_id' => auth()->id(),
        'reviewee_id' => $mission->client_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return back()->with(
        'success',
        'Client review submitted successfully!'
    );
}
}
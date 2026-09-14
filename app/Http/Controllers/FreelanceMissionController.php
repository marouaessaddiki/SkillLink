<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Notifications\PlatformNotification;

class FreelanceMissionController extends Controller
{
    public function show(Mission $mission)
    {
        abort_if($mission->status !== 'open', 404);

        $mission->load(['category', 'client'])->loadCount('applications');
        $application = $mission->applications()
            ->where('freelance_id', auth()->id())
            ->first();

        return view('freelance.missions.show', compact('mission', 'application'));
    }

       public function index(Request $request)
{
    $query = Mission::with(['category', 'client'])
        ->withCount('applications')
        ->where('status', $request->input('status', 'open'));

    if ($request->filled('status') && ! in_array($request->status, [
        'open',
        'in_progress',
        'completed',
        'cancelled',
    ], true)) {
        abort(422, 'Invalid mission status.');
    }

    // Search by mission title
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Filter by category
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Minimum budget
    if ($request->filled('min_budget')) {
        $query->where('budget', '>=', $request->min_budget);
    }

    // Maximum budget
    if ($request->filled('max_budget')) {
        $query->where('budget', '<=', $request->max_budget);
    }

    if ($request->filled('deadline')) {
        $query->whereDate('deadline', '<=', $request->deadline);
    }

    match ($request->input('sort', 'latest')) {
        'budget_low' => $query->orderBy('budget'),
        'budget_high' => $query->orderByDesc('budget'),
        'deadline' => $query->orderBy('deadline'),
        default => $query->latest(),
    };

    $missions = $query->get();

    $categories = \App\Models\Category::orderBy('name')->get();

    return view('freelance.missions.index', compact(
        'missions',
        'categories'
    ));
}

    public function complete(Mission $mission)
    {
        $application = Application::where('mission_id', $mission->id)
            ->where('freelance_id', auth()->id())
            ->where('status', 'accepted')
            ->first();

        if (!$application) {
            abort(403, 'You are not assigned to this mission.');
        }

        if ($mission->status !== 'in_progress') {
            abort(403, 'This mission cannot be completed.');
        }

        $mission->update([
            'status' => 'completed',
        ]);

        $mission->client->notify(new PlatformNotification(
            'Your mission has been completed.',
            $mission->id,
        ));

        return redirect()
            ->route('freelance.applications.index')
            ->with('success', 'Mission completed successfully!');
    }
}
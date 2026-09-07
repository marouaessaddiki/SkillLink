<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Application;
use Illuminate\Http\Request;

class FreelanceMissionController extends Controller
{
       public function index(Request $request)
{
    $query = Mission::with('category')
        ->where('status', 'open');

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

    $missions = $query->latest()->get();

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

        return redirect()
            ->route('freelance.applications.index')
            ->with('success', 'Mission completed successfully!');
    }
}
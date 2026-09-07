<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMissionRequest;
use App\Models\Mission;
use Illuminate\Http\Request;
use App\Models\Category;

class MissionController extends Controller
{
    /**
     * Display a listing of the missions.
     */
    public function index()
    {
        $missions = Mission::where('client_id', auth()->id())
            ->latest()
            ->get();

        return view('missions.index', compact('missions'));
    }

    /**
     * Show the form for creating a new mission.
     */
  public function create()
{
    $categories = Category::orderBy('name')->get();

    return view('missions.create', compact('categories'));
}

    /**
     * Store a newly created mission.
     */
    public function store(StoreMissionRequest $request)
    {
       Mission::create([
    'client_id' => auth()->id(),
    'category_id' => $request->category_id,
    'title' => $request->title,
    'description' => $request->description,
    'budget' => $request->budget,
    'deadline' => $request->deadline,
    'status' => $request->status ?? 'open',
]);

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission created successfully!');
    }

    /**
     * Display the specified mission.
     */
    public function show(Mission $mission)
    {
        abort_if($mission->client_id !== auth()->id(), 403);

        return view('missions.show', compact('mission'));
    }

    /**
     * Show the form for editing the specified mission.
     */
    public function edit(Mission $mission)
    {
        abort_if($mission->client_id !== auth()->id(), 403);

        return view('missions.edit', compact('mission'));
    }

    /**
     * Update the specified mission.
     */
    public function update(StoreMissionRequest $request, Mission $mission)
    {
        abort_if($mission->client_id !== auth()->id(), 403);

        $mission->update([
            'title' => $request->title,
            'description' => $request->description,
            'budget' => $request->budget,
            'deadline' => $request->deadline,
            'status' => $request->status ?? $mission->status,
        ]);

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission updated successfully!');
    }

    /**
     * Remove the specified mission.
     */
    public function destroy(Mission $mission)
    {
        abort_if($mission->client_id !== auth()->id(), 403);

        $mission->delete();

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission deleted successfully!');
    }
}
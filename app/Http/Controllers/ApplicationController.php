<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Mission;

class ApplicationController extends Controller
{
    public function store(StoreApplicationRequest $request, Mission $mission)
    {
        if ($mission->status !== 'open') {
            abort(403, 'This mission is not available.');
        }

        $alreadyApplied = Application::where('mission_id', $mission->id)
            ->where('freelance_id', auth()->id())
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'You have already applied to this mission.');
        }

        Application::create([
            'mission_id' => $mission->id,
            'freelance_id' => auth()->id(),
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Application submitted successfully!');
         
    }
    public function myApplications()
{
    $applications = Application::with('mission')
        ->where('freelance_id', auth()->id())
        ->latest()
        ->get();

    return view('freelance.applications.index', compact('applications'));
}
}
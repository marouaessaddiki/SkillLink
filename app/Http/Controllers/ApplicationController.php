<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Mission;
use App\Notifications\PlatformNotification;

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
            'proposed_price' => $request->proposed_price,
            'date_submission' => now(),
            'status' => 'pending',
        ]);

        $mission->client->notify(new PlatformNotification(
            'A new application was submitted for your mission.',
            $mission->id,
        ));

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

    public function edit(Application $application)
    {
        $this->ensurePendingOwner($application);

        return view('freelance.applications.edit', compact('application'));
    }

    public function update(StoreApplicationRequest $request, Application $application)
    {
        $this->ensurePendingOwner($application);

        $application->update($request->validated());

        return redirect()
            ->route('freelance.applications.index')
            ->with('success', 'Application updated successfully!');
    }

    public function destroy(Application $application)
    {
        $this->ensurePendingOwner($application);

        $application->delete();

        return back()->with('success', 'Application deleted successfully!');
    }

    private function ensurePendingOwner(Application $application): void
    {
        abort_if(
            $application->freelance_id !== auth()->id()
                || $application->status !== 'pending'
                || $application->mission->status !== 'open',
            403,
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Application;

class ClientApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['mission', 'freelance'])
            ->whereHas('mission', function ($query) {
                $query->where('client_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('client.applications.index', compact('applications'));
    }
      public function accept(Application $application)
{
    abort_if(
        $application->mission->client_id !== auth()->id(),
        403
    );

    // Accept this application
    $application->update([
        'status' => 'accepted',
    ]);

    // Reject other pending applications
    Application::where('mission_id', $application->mission_id)
        ->where('id', '!=', $application->id)
        ->where('status', 'pending')
        ->update([
            'status' => 'rejected',
        ]);

    // Change mission status
    $application->mission->update([
        'status' => 'in_progress',
    ]);

    return back()->with(
        'success',
        'Application accepted successfully!'
    );
}

    public function reject(Application $application)
    {
        abort_if(
            $application->mission->client_id !== auth()->id(),
            403
        );

        $application->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Application rejected successfully!'
        );
    }
}
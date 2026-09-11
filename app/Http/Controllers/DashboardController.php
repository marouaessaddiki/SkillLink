<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Application;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Dashboard Client
     */
    public function client()
    {
        $user = auth()->user();

        $stats = [
            'total' => Mission::where('client_id', $user->id)->count(),

            'open' => Mission::where('client_id', $user->id)
                ->where('status', 'open')
                ->count(),

            'in_progress' => Mission::where('client_id', $user->id)
                ->where('status', 'in_progress')
                ->count(),

            'completed' => Mission::where('client_id', $user->id)
                ->where('status', 'completed')
                ->count(),

            'applications' => Application::whereHas('mission', function ($query) use ($user) {
                $query->where('client_id', $user->id);
            })->count(),
        ];

        return view('client.dashboard', compact('stats'));
    }


    /**
 * Dashboard Freelance
 */
public function freelance()
{
    $user = auth()->user();

    $stats = [
        
        'missions' => Mission::where('status', 'open')->count(),

        //applications
        'applications' => Application::where(
            'freelance_id',
            $user->id
        )->count(),

        // Applications
        'accepted' => Application::where(
            'freelance_id',
            $user->id
        )
            ->where('status', 'accepted')
            ->count(),

        // Missions en cours
        'in_progress' => Application::where(
            'freelance_id',
            $user->id
        )
            ->where('status', 'accepted')
            ->whereHas('mission', function ($query) {
                $query->where('status', 'in_progress');
            })
            ->count(),

        // Missions terminées
        'completed' => Application::where(
            'freelance_id',
            $user->id
        )
            ->where('status', 'accepted')
            ->whereHas('mission', function ($query) {
                $query->where('status', 'completed');
            })
            ->count(),
    ];

    return view('freelance.dashboard', compact('stats'));
}

    /**
     * Dashboard Admin
     */
    public function admin()
    {
        $stats = [
            'users' => User::count(),

            'clients' => User::whereHas('roles', function ($query) {
                $query->where('name', 'client');
            })->count(),

            'freelances' => User::whereHas('roles', function ($query) {
                $query->where('name', 'freelance');
            })->count(),

            'missions' => Mission::count(),

            'completed' => Mission::where('status', 'completed')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
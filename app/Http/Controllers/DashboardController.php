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

        $recentMissions = Mission::with('category')
            ->where('client_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('client.dashboard', compact('stats', 'recentMissions'));
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

    $recommendedMissions = Mission::with('category')
        ->where('status', 'open')
        ->latest()
        ->take(4)
        ->get();

    $pendingApplications = Application::with('mission')
        ->where('freelance_id', $user->id)
        ->where('status', 'pending')
        ->latest()
        ->take(4)
        ->get();

    $activeMissions = Application::with('mission.client')
        ->where('freelance_id', $user->id)
        ->where('status', 'accepted')
        ->whereHas('mission', fn ($query) => $query->where('status', 'in_progress'))
        ->latest()
        ->take(3)
        ->get();

    return view('freelance.dashboard', compact(
        'stats',
        'recommendedMissions',
        'pendingApplications',
        'activeMissions',
    ));
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

            'active' => Mission::where('status', 'in_progress')->count(),

            'applications' => Application::count(),

            'completed' => Mission::where('status', 'completed')->count(),
        ];

        $missionStatuses = [
            'open' => Mission::where('status', 'open')->count(),
            'in_progress' => Mission::where('status', 'in_progress')->count(),
            'completed' => Mission::where('status', 'completed')->count(),
            'cancelled' => Mission::where('status', 'cancelled')->count(),
        ];
        $recentMissions = Mission::with('client')->latest()->take(6)->get();
        $recentUsers = User::with('roles')->latest()->take(6)->get();
        $pendingApplications = Application::with(['mission', 'freelance'])->where('status', 'pending')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'missionStatuses', 'recentMissions', 'recentUsers', 'pendingApplications'));
    }
}
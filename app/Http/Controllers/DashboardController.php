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
                ->where('status', 'Ouverte')
                ->count(),

            'in_progress' => Mission::where('client_id', $user->id)
                ->where('status', 'En cours')
                ->count(),

            'completed' => Mission::where('client_id', $user->id)
                ->where('status', 'Terminée')
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
            // جميع missions المفتوحة
            'missions' => Mission::where('status', 'Ouverte')->count(),

            // عدد العروض التي أرسلها freelance
            'applications' => Application::where(
                'freelance_id',
                $user->id
            )->count(),

            // العروض المقبولة
            'accepted' => Application::where('freelance_id', $user->id)
                ->where('status', 'accepted')
                ->count(),

            // missions en cours
            'in_progress' => Application::where('freelance_id', $user->id)
                ->where('status', 'accepted')
                ->whereHas('mission', function ($query) {
                    $query->where('status', 'En cours');
                })
                ->count(),

            // missions terminées
            'completed' => Application::where('freelance_id', $user->id)
                ->where('status', 'accepted')
                ->whereHas('mission', function ($query) {
                    $query->where('status', 'Terminée');
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

            'completed' => Mission::where('status', 'Terminée')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Mission;

class AdminMissionController extends Controller
{
    public function index()
    {
        $missions = Mission::with(['client', 'category'])
            ->latest()
            ->get();

        return view('admin.missions.index', compact('missions'));
    }
}
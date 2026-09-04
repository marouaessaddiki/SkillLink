<?php

namespace App\Http\Controllers;

use App\Models\Mission;

class FreelanceMissionController extends Controller
{
  public function index()
{
    $missions = Mission::where('status', 'open')
        ->latest()
        ->get();

    $appliedMissionIds = \App\Models\Application::where('freelance_id', auth()->id())
        ->whereIn('mission_id', $missions->pluck('id'))
        ->pluck('mission_id')
        ->toArray();

    return view('freelance.missions.index', compact(
        'missions',
        'appliedMissionIds'
    ));
}
}
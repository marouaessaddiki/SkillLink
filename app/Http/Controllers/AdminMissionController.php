<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class AdminMissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Mission::with(['client', 'category'])->withCount('applications');
        $search = $request->string('search')->toString();
        $status = $request->string('status')->toString();
        if ($search !== '') {
            $query->where('title', 'like', "%{$search}%");
        }
        if (in_array($status, ['open', 'in_progress', 'completed', 'cancelled'], true)) {
            $query->where('status', $status);
        }
        $missions = $query->latest()->get();
        $stats = [
            'total' => Mission::count(),
            'open' => Mission::where('status', 'open')->count(),
            'in_progress' => Mission::where('status', 'in_progress')->count(),
            'completed' => Mission::where('status', 'completed')->count(),
            'cancelled' => Mission::where('status', 'cancelled')->count(),
        ];

        return view('admin.missions.index', compact('missions', 'stats'));
    }

    public function destroy(Mission $mission)
    {
        $mission->delete();

        return back()->with('success', 'Mission deleted successfully.');
    }
}
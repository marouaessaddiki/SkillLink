<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        $search = $request->string('search')->toString();
        $role = $request->string('role')->toString();

        if ($search !== '') {
            $query->where(fn ($builder) => $builder->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"));
        }
        if (in_array($role, ['admin', 'client', 'freelance'], true)) {
            $query->whereHas('roles', fn ($builder) => $builder->where('name', $role));
        }

        $users = $query->latest()->get();
        $stats = [
            'total' => User::count(),
            'freelancers' => User::whereHas('roles', fn ($builder) => $builder->where('name', 'freelance'))->count(),
            'clients' => User::whereHas('roles', fn ($builder) => $builder->where('name', 'client'))->count(),
            'new' => User::where('created_at', '>=', now()->subDays(30))->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    public function destroy(User $user)
    {
        // Prevent admin from deleting himself
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
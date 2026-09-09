<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
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
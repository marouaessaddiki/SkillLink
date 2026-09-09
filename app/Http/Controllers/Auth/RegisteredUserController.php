<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Role;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'lowercase',
            'email',
            'max:255',
            'unique:' . User::class
        ],
        'password' => [
            'required',
            'confirmed',
            Rules\Password::defaults()
        ],
        'role' => ['required', 'in:client,freelance'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Give the user his selected role
    $role = Role::where('name', $request->role)->firstOrFail();

$user->addRole($role);

    event(new Registered($user));

  Auth::login($user);

if ($user->hasRole('client')) {
    return redirect()->route('client.dashboard');
}

if ($user->hasRole('freelance')) {
    return redirect()->route('freelance.dashboard');
}

abort(403, 'User has no valid role.');
}
}

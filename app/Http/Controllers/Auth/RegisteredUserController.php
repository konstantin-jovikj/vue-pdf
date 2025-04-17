<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        $roles = Role::where('id', '!=', 1)->get();
        return Inertia::render(
            'auth/Register',
            ['roles' => $roles]
        );
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function store(Request $request): RedirectResponse
    {
        // Validate the input
        $validated = $request->validate([
            'role_id' => 'required|integer|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Ensure the role_id has a default value of 3 if it is not provided
        $roleId = $validated['role_id'] ?? 3;  // Default to role_id = 3 if not provided

        // Check if the role_id exists in the roles table
        if (!Role::find($roleId)) {
            return back()->withErrors(['role_id' => 'Invalid role selected.'])->withInput();
        }
        // dd($validated);
        // Create the user
        $user = User::create([
            'role_id' => $roleId,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        // dd($user);

        // Trigger the Registered event (optional)
        // event(new Registered($user));

        return redirect()->route('documents.index')->with('success', 'Корисникот е успешно додаден');
    }


}

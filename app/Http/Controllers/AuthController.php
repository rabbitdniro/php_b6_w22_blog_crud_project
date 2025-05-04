<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Directing to the dashboard page
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    // Directing to registration page
    public function registrationPage()
    {
        return view('auth.register');
    }

    // Registering a new user
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|confirmed',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Log the user in
        Auth::attempt($request->only('email', 'password'));

        // Redirect to dashboard page
        return redirect()->route('dashboard');
    }

    // Directing to login page
    public function loginPage()
    {
        return view('auth.login');
    }

    // Logging in a user
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Attempt to log the user in
        if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            // Redirect back with an error message
            return back()->with('status', 'Invalid credentials');
        }

        // Redirect to the dashboard page
        return redirect()->route('dashboard');
    }

    // Logging out a user
    public function logout()
    {
        // Log the user out
        Auth::logout();

        // Redirect to the login page
        return redirect('/');
    }
}

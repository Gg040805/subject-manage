<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Check the credentials
    if ($request->username === 'admin' && $request->password === '131188') {
        // Store the logged-in state and username in the session
        $request->session()->put('loggedIn', true);
        $request->session()->put('username', $request->username); // Store the username
        return redirect()->route('subjects.index'); 
    }

    return back()->withErrors(['login' => 'Invalid username or password.']);
}
public function logout(Request $request)
{
    $request->session()->forget(['loggedIn', 'username']); // Clear session data
    return redirect('/login')->with('success', 'You have been logged out successfully.');
}


}

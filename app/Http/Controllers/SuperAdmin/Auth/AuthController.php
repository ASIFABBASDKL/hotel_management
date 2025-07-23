<?php
namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login page
    public function showLoginForm()
    {
        return view('auth.sign_in');  // This will render 'auth.sign_in' view
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate the form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to dashboard on success
            return redirect()->route('dashboard.index');
        }

        // If authentication fails, redirect back with an error
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form'); // Adjust route as needed
    }
}

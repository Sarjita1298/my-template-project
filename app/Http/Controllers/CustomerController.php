<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    
    public function logout()
    {
        Auth::logout();
        return redirect('home')->with('success', 'Logged out successfully.');
    }

    public function dashboard()
    {
        return view('frontend.customer.dashboard'); // Make sure this view exists
    }

    public function profileIndex()
    {
        $user = Auth::user();
        return view('frontend.customer.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $request->username;
        $user->email = $request->email;

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function changePasswordForm()
    {
        return view('frontend.customer.change-password'); // Create this view
    }


public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password'     => 'required|min:6|confirmed',
    ]);

    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->withErrors(['error' => 'You must be logged in to change your password.']);
    }

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('customer.dashboard')->with('success', 'Password updated successfully.');
}

}

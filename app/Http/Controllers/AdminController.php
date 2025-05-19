<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function index()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin, $request->has('remember'));
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->flush();
    
        return redirect()->route('admin.login')->with('status', 'Logged out successfully.');
    }
    

    public function createAdmin()
    {
        Admin::create([
            'name' => 'Sarjita',
            'email' => 'sarjitachaurasiya@gmail.com',
            'password' => bcrypt('sarjita@1234'),
        ]);

        return "Admin created successfully!";
    }



    public function show()
    {
        $admin = Auth::guard('admin')->user();
        return view('backend.profile', compact('admin'));
    }

   public function updatePicture(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $admin = Auth::guard('admin')->user();

    // Delete old image if exists
    if ($admin->profile_picture && Storage::disk('public')->exists('profile_pictures/' . $admin->profile_picture)) {
        Storage::disk('public')->delete('profile_pictures/' . $admin->profile_picture);
    }

    $filename = uniqid() . '.' . $request->profile_picture->getClientOriginalExtension();
    $request->file('profile_picture')->storeAs('profile_pictures', $filename, 'public');

    $admin->profile_picture = $filename;
    $admin->save();

    return redirect()->back()->with('success', 'Profile picture updated successfully.');
}

}




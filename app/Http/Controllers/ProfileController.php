<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('backend.profile');
    }
   
    // public function update(Request $request)
    // {
    //     $user = Auth::guard('admin')->user();
    
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);
    
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    
    //     if ($request->hasFile('profile_picture')) {
    //         if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
    //             Storage::delete('public/profile_pictures/' . $user->profile_picture);
    //         }
    
    //         $file = $request->file('profile_picture');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $file->storeAs('public/profile_pictures', $filename);
    //         $user->profile_picture = $filename;
    //     }
    
    //     elseif ($request->filled('existing_picture')) {
    //         $user->profile_picture = $request->existing_picture;
    //     }
    
    //     $user->save();
    
    //     return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    // }
    public function update(Request $request)
{
    $user = Auth::guard('admin')->user();
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Only allow image uploads
    ]);
    
    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->hasFile('profile_picture')) {
        if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
            Storage::delete('public/profile_pictures/' . $user->profile_picture);
        }

        $file = $request->file('profile_picture');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/profile_pictures', $filename);

        $user->profile_picture = $filename;
    }
    
    elseif ($request->filled('existing_picture')) {
        $user->profile_picture = $request->existing_picture;
    }

    $user->save();

    return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
}


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('/profile.show')->with('error', 'Current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}

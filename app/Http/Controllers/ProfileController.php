<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
   use App\Models\Setting;

class ProfileController extends Controller
{
    // public function show()
    // {
    //     return view('backend.profile');
    // }
    // use App\Models\Setting; // if using a Setting model

public function show()
{
    $logo_name = Setting::where('key', 'logo_name')->value('value') ?? 'AdminLTE 3';

    return view('backend.profile', compact('logo_name'));
}


    // In ProfileController.php
public function uploadLogo(Request $request)
{
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $logoName = 'AdminLTELogo.png';
        $path = public_path('backend/images/');

        // Save the new logo (overwrites the old one)
        $logo->move($path, $logoName);

          return redirect()->route('profile.show')->with('success', 'Logo updated successfully!');
    }

      return redirect()->route('profile.show')->with('error', 'Please select a logo to upload.');
}
 
public function showProfile()
{
    $setting = Setting::where('key', 'logo_name')->first();
    $logo_name = $setting ? $setting->value : 'Default Logo';

    $admin = auth()->user(); // ya jo admin ho

    return view('backend.profile', compact('logo_name', 'admin'));
}



    public function updateLogoName(Request $request)
    {
        $request->validate([
            'logo_name' => 'required|string|max:255',
        ]);

        // Save or update the logo_name in settings table
        Setting::updateOrCreate(
            ['key' => 'logo_name'],
            ['value' => $request->logo_name]
        );

      return redirect()->route('profile.show')->with('success', 'Logo name updated successfully.');
    }
   public function update(Request $request)
{
    $admin = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email,' . $admin->id,
        '	profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('	profile_picture')) {
        $image = $request->file('	profile_picture');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/profile'), $imageName);

        // Delete old image if exists
        if ($admin->	profile_picture && file_exists(public_path('uploads/profile/' . $admin->	profile_picture))) {
            unlink(public_path('uploads/profile/' . $admin->	profile_picture));
        }

        $admin->	profile_picture = $imageName;
    }

    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->save();

    return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
}



   public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::guard('admin')->user(); // ✅ Fix here

    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->route('profile.show')->with('error', 'Current password is incorrect.');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('profile.show')->with('success', 'Password changed successfully.');
}

}

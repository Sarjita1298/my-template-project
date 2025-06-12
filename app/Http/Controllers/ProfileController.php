<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;

class ProfileController extends Controller
{
    /**
     * Show the admin profile page.
     */
    public function show()
    {
        $setting = Setting::where('key', 'logo_name')->first();
        $logo_name = $setting ? $setting->value : 'Default Logo';

        $admin = Auth::guard('admin')->user(); // ✅ correct for admin login

        return view('backend.profile', compact('logo_name', 'admin'));
    }

    /**
     * Upload the site logo image.
     */
    public function uploadLogo(Request $request)
    {
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'AdminLTELogo.png';
            $path = public_path('backend/images/');

            $logo->move($path, $logoName);

            return redirect()->route('profile.show')->with('success', 'Logo updated successfully!');
        }

        return redirect()->route('profile.show')->with('error', 'Please select a logo to upload.');
    }

    /**
     * Update the logo name (text).
     */
    public function updateLogoName(Request $request)
    {
        $request->validate([
            'logo_name' => 'required|string|max:255',
        ]);

        Setting::updateOrCreate(
            ['key' => 'logo_name'],
            ['value' => $request->logo_name]
        );

        return redirect()->route('profile.show')->with('success', 'Logo name updated successfully.');
    }

    /**
     * Update admin profile info.
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user(); // ✅ use correct guard

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ✅ Profile Picture Upload
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/profile'), $imageName);

            // Delete old image
            if ($admin->profile_picture && file_exists(public_path('uploads/profile/' . $admin->profile_picture))) {
                unlink(public_path('uploads/profile/' . $admin->profile_picture));
            }

            $admin->profile_picture = $imageName;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    /**
     * Change admin password.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->route('profile.show')->with('error', 'Current password is incorrect.');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('profile.show')->with('success', 'Password changed successfully.');
    }
}

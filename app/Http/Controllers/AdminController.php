<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         $admin = Admin::where('email', $request->email)->first();

//         if ($admin && Hash::check($request->password, $admin->password)) {
//             Auth::guard('admin')->login($admin);
//             return redirect()->route('admin.dashboard');
//         }

//         return back()->withErrors(['email' => 'Invalid credentials']);
//     }
// public function createAdmin()
// {
//     Admin::create([
//         'name' => 'sarjita',
//         'email' => 'sarjitachsurasiya@gmail.com',
//         'password' => bcrypt('sarjita@1234'),
//     ]);

//     return "Admin created successfully!";
// }

// public function logout()
// {
//     Auth::guard('admin')->logout();
//     return redirect()->route('login');
// }

}

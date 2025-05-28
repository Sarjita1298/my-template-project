<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin with email already exists to avoid duplicates
        if (!Admin::where('email', 'sarjitachaurasiya@gmail.com')->exists()) {
            Admin::create([
                'name' => 'Sarjita',
                'email' => 'sarjitachaurasiya@gmail.com',
                'password' => bcrypt('sarjita@1234'),
                // 'profile_picture' => 'optional-profile.jpg', // agar chahe to
            ]);
        }
    }
}

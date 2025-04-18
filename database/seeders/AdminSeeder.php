<?php

namespace Database\Seeders;
use App\Models\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
        Admin::create([
            'name' => 'sarjita',
            'email' => 'sarjitachaurasiya@gmail.com',
            'password' => bcrypt('sarjita@1234'),
        ]);
    }
}



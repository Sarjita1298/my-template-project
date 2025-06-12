<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    public function run()
    {
        State::insert([
            ['name' => 'Uttar Pradesh'],
            ['name' => 'Maharashtra'],
            ['name' => 'Bihar'],
            ['name' => 'Madhya Pradesh'],
            ['name' => 'Rajasthan'],
        ]);
    }
}

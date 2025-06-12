<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    public function run()
    {
        District::insert([
            ['state_id' => 1, 'name' => 'Varanasi'],
            ['state_id' => 1, 'name' => 'Lucknow'],
            ['state_id' => 2, 'name' => 'Mumbai'],
            ['state_id' => 2, 'name' => 'Pune'],
            ['state_id' => 3, 'name' => 'Patna'],
            ['state_id' => 3, 'name' => 'Gaya'],
            ['state_id' => 4, 'name' => 'Bhopal'],
            ['state_id' => 4, 'name' => 'Indore'],
            ['state_id' => 5, 'name' => 'Jaipur'],
            ['state_id' => 5, 'name' => 'Udaipur'],
        ]);
    }
}

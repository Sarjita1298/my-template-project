<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pincode;

class PincodeSeeder extends Seeder
{
    public function run()
    {
        Pincode::insert([
            ['district_id' => 1, 'code' => '221001'], // Varanasi
            ['district_id' => 2, 'code' => '226001'], // Lucknow
            ['district_id' => 3, 'code' => '400001'], // Mumbai
            ['district_id' => 4, 'code' => '411001'], // Pune
            ['district_id' => 5, 'code' => '800001'], // Patna
            ['district_id' => 6, 'code' => '823001'], // Gaya
            ['district_id' => 7, 'code' => '462001'], // Bhopal
            ['district_id' => 8, 'code' => '452001'], // Indore
            ['district_id' => 9, 'code' => '302001'], // Jaipur
            ['district_id' => 10, 'code' => '313001'], // Udaipur
        ]);
    }
}


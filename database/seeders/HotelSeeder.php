<?php

namespace Database\Seeders;

use App\Models\hotels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            hotels::create([
                'name' => 'Hotel '.$i,
                'email' => 'hotel'.$i.'@gmail.com',
                'address' => 'Phnom Penh '.$i,
                'logo' => null
            ]);
        }
    }
}

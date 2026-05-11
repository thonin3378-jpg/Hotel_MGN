<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Customers::create([
                'name' => 'Customer '.$i,
                'gender' => $i % 2 == 0 ? 'Male' : 'Female',
                'email' => 'customer'.$i.'@gmail.com',
                'phone' => '0123456'.$i,
                'password' => bcrypt('123456'),
                'profile_photo' => null
            ]);
        }
    }
}

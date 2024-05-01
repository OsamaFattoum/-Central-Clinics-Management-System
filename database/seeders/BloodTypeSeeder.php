<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodType = ["O-", "O+", "A+", "A-", "B+", "B-", "AB+", "AB-"];

        foreach ($bloodType as $type) {
            BloodType::create([
               'name' => $type, 
            ]);
        }
    }
}

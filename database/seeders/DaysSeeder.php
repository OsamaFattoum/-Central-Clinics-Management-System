<?php

namespace Database\Seeders;

use App\Models\Day\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days_ar = ['السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];

        $days_en = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];


        foreach ($days_ar as $index => $day) {
            Day::create([
                'ar' => [
                    'day' => $days_ar[$index],
                ],
                'en' => [
                    'day' => $days_en[$index],
                ],
            ]);
        }
    }
}

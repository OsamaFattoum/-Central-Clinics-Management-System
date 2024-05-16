<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\BloodType;
use App\Models\Users\Patient;
use App\Models\Users\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = $this->createAdmin();
        $this->call([LaratrustSeeder::class,DepartmentSeeder::class, DaysSeeder::class, FacilitySeeder::class,BloodTypeSeeder::class,UsersSeeder::class]);
        $admin->addRole('admin');


        Patient::factory()->count(200)->create()->each(function ($patient) {
            $patient->profile()->save(Profile::factory()->create([
                'profile_type' => get_class($patient),
                'profile_id' => $patient->id
            ]));
        });
    }

    private function createAdmin()
    {
        $admin = Admin::create([
            'name' => 'Manger System',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'phone' => '+962775314544',
        ]);

        return $admin;
    } //end of create admin

}

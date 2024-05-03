<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\BloodType;
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

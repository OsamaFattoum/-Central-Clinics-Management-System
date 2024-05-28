<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Department\Department;
use App\Models\Permission;
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

        $this->call([LaratrustSeeder::class, DepartmentSeeder::class, DaysSeeder::class, FacilitySeeder::class, BloodTypeSeeder::class, UsersSeeder::class]);
        $this->addPermissionToAdmin($admin);
        $admin->addRole('admin');


        Patient::factory()->count(50)->create()->each(function ($patient) {
            $patient->profile()->save(Profile::factory()->create([
                'profile_type' => get_class($patient),
                'profile_id' => $patient->id
            ]));
        });
    }

    private function createAdmin()
    {
        $admin = Admin::create([
            'name' => 'Manager System',
            'email' => 'admin@app.com',
            'phone' => '0775314544',
            'password' => bcrypt('password'),
        ]);

        return $admin;
    } //end of create admin


    private function addPermissionToAdmin(Admin $admin)
    {

        $permissions = [];
        $departments = Department::all();

        foreach ($departments as $department) {
            foreach (config('laratrust_seeder.permissions_map') as $map) {
                $permissions[] = Permission::where('name', $map . '-' . $department->scientific_name)->first()->id;
            }
        }
        $admin->syncPermissions($permissions);
    }
}

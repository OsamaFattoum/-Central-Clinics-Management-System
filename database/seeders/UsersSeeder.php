<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createDoctors();
        $this->createPatients();
    } //end of run

  

    private function createDoctors()
    {
        $doctor_one = Doctor::create([
            "civil_id" => '9991061159',
            "email" => 'khaled.salama@gmail.com',
            "password" => Hash::make('password'),
            'clinic_id' => '1',
            'department_id' => '1',
        ]);

        $doctor_one->profile()->create([
            "ar" => [
                "name" => 'د.خالد سلامة',
            ],
            "en" => [
                "name" => 'D.khaled salama',
            ],
            'gender' => '1',
            'birth_date' => '1983-09-09',
            'phone' => '+962775314544',
            'city' => '2',
            'address' => 'Zarqa/new Zarqa',
            'profile_id' => $doctor_one->id,
            'profile_type' => Doctor::class,
        ]);
        

        $doctor_one->syncPermissions(['30','31']);

        $doctor_one->addRole('doctor');

        //doctor two
        $doctor_two = Doctor::create([
            "civil_id" => '9991061155',
            "email" => 'mohammad.salama@gmail.com',
            "password" => Hash::make('password'),
            'clinic_id' => '1',
            'department_id' => '3',
        ]);

        $doctor_two->profile()->create([
            "ar" => [
                "name" => 'د.محمد سلامة',
            ],
            "en" => [
                "name" => 'D.mohammad salama',
            ],
            'gender' => '1',
            'birth_date' => '1983-09-09',
            'phone' => '+962775314544',
            'city' => '2',
            'address' => 'Zarqa/new Zarqa',
            'profile_id' => $doctor_two->id,
            'profile_type' => Doctor::class,
        ]);
        

        $doctor_two->syncPermissions(['37','38','39','25','26']);

        $doctor_two->addRole('doctor');



    } //end of create doctors

    private function createPatients()
    {

        $patient_one = Patient::create([
            "civil_id" => '9991061159',
            "email" => 'husam.salama@gmail.com',
            "password" => Hash::make('password'),
            'blood_type_id' => '1',
        ]);

        $patient_one->profile()->create([
            "ar" => [
                "name" => 'حسام سلامة',
            ],
            "en" => [
                "name" => 'husam salama',
            ],
            'gender' => '1',
            'birth_date' => '1983-09-09',
            'phone' => '+962775314544',
            'city' => '2',
            'address' => 'Zarqa/new Zarqa',
            'profile_id' => $patient_one->id,
            'profile_type' => Patient::class,
        ]);
        


        $patient_one->addRole('patient');

        //patient two
        $patient_two = Patient::create([
            "civil_id" => '9991061155',
            "email" => 'mohammad.islam@gmail.com',
            "password" => Hash::make('password'),
            'blood_type_id' => '3',
        ]);

        $patient_two->profile()->create([
            "ar" => [
                "name" => 'محمد اسلام',
            ],
            "en" => [
                "name" => 'mohammad islam',
            ],
            'gender' => '1',
            'birth_date' => '1983-09-09',
            'phone' => '+962775314544',
            'city' => '2',
            'address' => 'Zarqa/new Zarqa',
            'profile_id' => $patient_two->id,
            'profile_type' => Patient::class,
        ]);
        


        $patient_two->addRole('patient');



    } //end of create patients

}

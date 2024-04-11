<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'name' => 'Manger System',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'phone' => '+962775314544',
        ]);

        $admin->addRole('admin');
    }
}

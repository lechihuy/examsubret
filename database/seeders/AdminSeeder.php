<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'fullname' => 'Admin',
                'phone_number' => '123456789',
                'email' => 'admin@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => 'nimda',
                'password' => bcrypt('nimda'),
                'fullname' => 'Nimda',
                'phone_number' => '987654321',
                'email' => 'nimda@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

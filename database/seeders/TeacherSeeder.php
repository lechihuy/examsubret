<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'username' => 'huy.197ct31347',
                'password' => bcrypt('huy.197ct31347'),
                'fullname' => 'Lê Chí Huy',
                'phone_number' => '0933160483',
                'email' => 'huy.197ct31347@vanlanguni.vn',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

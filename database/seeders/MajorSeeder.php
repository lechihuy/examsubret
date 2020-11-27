<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Major;
use App\Models\Department;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('data.majors') as $item) {
            $major = new Major;
            $major->name = $item['name'];
            $major->code = $item['code'];
            $major->save();

            if (isset($item['department_code'])) {
                $major->departments()->attach(
                    Department::whereIn('code', $item['department_code'])->get()
                );
            }
        }
    }
}

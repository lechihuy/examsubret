<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Subject;
use App\Models\Department;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('data.subjects') as $item) {
            $subject = new Subject;
            $subject->name = $item['name'];
            $subject->code = $item['code'];
            $subject->save();

            if (isset($item['department_code'])) {
                $subject->departments()->attach(
                    Department::whereIn('code', $item['department_code'])->get()
                );
            }
        }
    }
}

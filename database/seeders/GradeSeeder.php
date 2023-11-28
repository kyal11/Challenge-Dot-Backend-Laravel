<?php

namespace Database\Seeders;

use App\Models\courses;
use App\Models\grades;
use App\Models\students;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $students = students::all()->pluck('id')->toArray();
        $courses = courses::all()->pluck('id')->toArray();

        for ($i = 0; $i < 60; $i++) {
            $studentId = $faker->randomElement($students);
            $courseId = $faker->randomElement($courses);

            grades::create([
                'student_id' => $studentId,
                'course_id' => $courseId,
                'grade' => $faker->randomElement(['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'D-', 'E'])
            ]);
        }
    }
}

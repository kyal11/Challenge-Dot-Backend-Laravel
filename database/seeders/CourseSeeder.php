<?php

namespace Database\Seeders;

use App\Models\courses;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $courseList = [
            'Data Structure',
            'Algorithms Basic',
            'Machine Learning',
            'Web Development Fundamentals',
            'Database Management Systems',
            'Computer Networks',
            'Software Engineering Principles',
            'Artificial Intelligence',
            'Cybersecurity Fundamentals',
            'Operating Systems',
            'Mobile App Development',
            'Data Science and Analytics',
            'Computer Graphics',
            'Game Development',
            'Cloud Computing',
            'Internet of Things (IoT)',
            'Blockchain Technology',
            'Robotics',
            'Human-Computer Interaction',
            'Big Data Technologies'
        ];

        for ($i = 0 ;$i < count($courseList); $i++) {
            $course = $courseList[$i];

            courses::create([
                'name' => $course,
                'credit' => $faker->numberBetween(1,5),
                'description' => $faker->sentence
            ]);
        }
    }
}

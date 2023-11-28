<?php

namespace Database\Seeders;

use App\Models\students;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $majorList = [
            'Computer Science',
            'Electrical Engineering',
            'Mechanical Engineering',
            'Civil Engineering',
            'Chemical Engineering',
            'Biomedical Engineering',
            'Aerospace Engineering',
            'Software Engineering',
            'Environmental Engineering',
        ];

        for ($i = 0; $i < 30; $i++) {
            $major = $majorList[array_rand($majorList)];
            students::create([
                'name' => $faker->name,
                'nim' => $faker->unique()->numerify('#########'), 
                'birth_date' => $faker->date,
                'address' => $faker->address,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'major' => $major
            ]);
        }
    }
}

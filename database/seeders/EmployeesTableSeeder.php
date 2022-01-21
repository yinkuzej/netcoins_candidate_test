<?php

namespace Database\Seeders;

use App\Models\Employee;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::truncate();

        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $first_name = $faker->firstName;
            $last_name = $faker->lastName;
            Employee::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => strtolower($first_name . '.' . $last_name) . '@company.com',
                'job_role' => $faker->jobTitle,
            ]);
        }

    }
}

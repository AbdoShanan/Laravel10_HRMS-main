<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Faker\Factory as Faker;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Employee::create([
                'emp_name' => $faker->name,
                'emp_national_idenity' => $faker->randomNumber(9, true),
                'emp_email' => $faker->unique()->safeEmail,
                'emp_start_date' => $faker->date(),
                'emp_Departments_code' => $faker->numberBetween(1, 10),
                'emp_jobs_id' => $faker->numberBetween(1, 5),
                'emp_sal' => $faker->numberBetween(3000, 10000),
                'added_by' => $faker->name,
            ]);
        }
    }
}

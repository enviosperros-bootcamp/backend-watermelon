<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\User;
use Faker\Factory as Faker;

class PatientsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $userIds = User::pluck('id')->toArray();

        foreach ($userIds as $userId) {
            Patient::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'sex' => $faker->randomElement(['M', 'F']),
                'birth_date' => $faker->date('Y-m-d', '2005-01-01'),
                'age' => $faker->numberBetween(18, 80),
                'occupation' => $faker->jobTitle(),
                'phone' => $faker->phoneNumber(),
                'user_id' => $userId,
            ]);
        }
    }
}

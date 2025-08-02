<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Patient;
use Faker\Factory as Faker;

class AppointmentsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $patients = Patient::all();
        $doctors = User::where('role', 'Doctor')->get();

        foreach (range(1, 20) as $i) {
            Appointment::create([
                'name' => $faker->sentence(3),
                'date' => $faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
                'time' => $faker->time('H:i'),
                'patient_id' => $patients->random()->id,
                'doctor_id' => $doctors->random()->id,
                'status' => $faker->randomElement(['pendiente', 'realizada', 'cancelada']),
                'notes' => $faker->text(100),
            ]);
        }
    }
}

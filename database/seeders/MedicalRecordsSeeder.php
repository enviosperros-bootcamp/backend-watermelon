<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MedicalRecordsSeeder extends Seeder
{
    public function run()
    {
        DB::statement('PRAGMA foreign_keys=OFF;');
        MedicalRecord::truncate();
        DB::statement('PRAGMA foreign_keys=ON;');

        $faker = Faker::create();

        $patients = Patient::all();
        $doctors = User::where('role', 'Doctor')->get();

        foreach (range(1, 20) as $i) {
            MedicalRecord::create([
                'patient_id' => $patients->random()->id,
                'doctor_id' => $doctors->random()->id,
                'summary' => $faker->paragraph(2),
                'date' => $faker->date('Y-m-d', 'now'),
            ]);
        }
    }
}

<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'sex' => $this->faker->randomElement(['M', 'F']),
            'birth_date' => $this->faker->date('Y-m-d'),
            'age' => $this->faker->numberBetween(18, 90),
            'occupation' => $this->faker->jobTitle,
            'phone' => $this->faker->phoneNumber,
            'user_id' => User::factory(),
            'image' => 'patients/' . $this->faker->word . '.jpg',
        ];
    }
}


<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_patient_with_valid_data()
    {
        $user = User::factory()->create();

        $patient = Patient::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'sex' => 'M',
            'birth_date' => '1990-01-01',
            'age' => 34,
            'occupation' => 'Ingeniero',
            'phone' => '1234567890',
            'user_id' => $user->id,
            'image' => 'patients/foto.jpg',
        ]);

        $this->assertDatabaseHas('patients', [
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $patient->user);
        $this->assertEquals($user->id, $patient->user->id);
    }

    /** @test */
    public function it_returns_jwt_identifier_and_custom_claims()
    {
        $patient = Patient::factory()->create();

        $this->assertEquals($patient->id, $patient->getJWTIdentifier());
        $this->assertIsArray($patient->getJWTCustomClaims());
        $this->assertEmpty($patient->getJWTCustomClaims());
    }
}


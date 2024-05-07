<?php

namespace Database\Factories\Users;

use App\Models\BloodType;
use App\Models\Users\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'civil_id' => $this->faker->unique()->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'blood_type_id' => BloodType::all()->random()->id, // Example blood type ID
        ];
    }
}

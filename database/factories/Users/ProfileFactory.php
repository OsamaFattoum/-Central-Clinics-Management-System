<?php

namespace Database\Factories\Users;

use App\Models\Users\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ar' => ['name' => $this->faker->name()],
            'en' => ['name' => $this->faker->name()],
            'gender' => $this->faker->randomElement([0,1]), // Example gender (1 or 2)
            'birth_date' => $this->faker->date('Y-m-d', '-30 years'), // Example birth date
            'phone' => $this->faker->e164PhoneNumber,
            'city' => $this->faker->numberBetween(1,13), // Example city ID
            'address' => $this->faker->address,
            
        ];
    }
}

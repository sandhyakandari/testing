<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $academyNames = [
            'Elite Tennis Academy',
            'Grand Slam Tennis Academy',
            'Pro Tennis Academy',
            'Ace Tennis Academy',
            'Victory Tennis Academy',
            'Top Spin Tennis Academy',
            'NextGen Tennis Academy',
            'Champions Tennis Academy',
            'Masterstroke Tennis Academy',
            'Prime Tennis Academy',
        ];
        return [
            'name' => $this->faker->unique()->randomElement($academyNames),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->optional()->dateTime(),
            'password' => bcrypt('1234'), // or $this->faker->password()
            'created_at' => now(),
            'updated_at' => now(),
            'phone' => $this->faker->unique()->numerify('##########'),
            'role' => 'Academy',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

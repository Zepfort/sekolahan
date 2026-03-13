<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('##################'),
            'tempat_lahir' => fake()->city(),
            'tgl_lahir' => fake()->date(),
            'gender' => fake()->randomElement(['laki-laki', 'perempuan']),
            'phone_number' => fake()->numerify('08##########'),
            'alamat' => fake()->address(),
            'pendidikan' => 'S1 Pendidikan',
        ];
    }
}

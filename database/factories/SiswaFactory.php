<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nis' => fake()->unique()->numerify('##########'),
            'nama' => fake()->name(),
            'gender' => fake()->randomElement(['laki-laki', 'perempuan']),
            'tempat_lahir' => fake()->city(),
            'tgl_lahir' => fake()->date(),
            'email' => fake()->unique()->safeEmail(),
            'nama_ortu' => fake()->name(),
            'alamat' => fake()->address(),
            'phone_number' => fake()->numerify('08##########'),
        ];
    }
}

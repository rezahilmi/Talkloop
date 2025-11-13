<?php

namespace Database\Factories;

use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jawaban>
 */
class JawabanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'pertanyaan_id' => Pertanyaan::inRandomOrder()->first()->id ?? Pertanyaan::factory(),
            'jawaban' => $this->faker->paragraph(),
        ];
    }
}

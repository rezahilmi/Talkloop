<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pertanyaan>
 */
class PertanyaanFactory extends Factory
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
            'kategori_id' => Kategori::inRandomOrder()->first()->id ?? Kategori::factory(),
            'judul' => $this->faker->sentence(),
            'isi' => $this->faker->paragraph(4),
            'gambar' => null,
        ];
    }
}

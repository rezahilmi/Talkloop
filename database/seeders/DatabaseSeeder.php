<?php

namespace Database\Seeders;

use App\Models\Jawaban;
use App\Models\Kategori;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Buat 10 User random
        User::factory(10)->create();

        // Buat 5 kategori
        Kategori::factory(5)->create();

        // Buat 20 pertanyaan
        Pertanyaan::factory(20)->create();

        // Setiap pertanyaan punya 1-4 jawaban
        Pertanyaan::all()->each(function ($q) {
            Jawaban::factory(rand(1, 4))->create([
                'pertanyaan_id' => $q->id,
            ]);
        });
    }
}

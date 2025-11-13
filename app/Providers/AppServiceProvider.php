<?php

namespace App\Providers;

use App\Models\Jawaban;
use App\Models\Kategori;
use App\Models\Pertanyaan;
use App\Policies\JawabanPolicy;
use App\Policies\KategoriPolicy;
use App\Policies\PertanyaanPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $policies = [
        Jawaban::class => JawabanPolicy::class,
        Pertanyaan::class => PertanyaanPolicy::class,
        Kategori::class => KategoriPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Domain\Translation\Interfaces\LanguageRepositoryInterface;
use App\Domain\Translation\Interfaces\LanguageServiceInterface;
use App\Domain\Translation\Interfaces\TranslationRepositoryInterface;
use App\Domain\Translation\Interfaces\TranslationServiceInterface;
use App\Domain\Translation\Repositories\LanguageRepository;
use App\Domain\Translation\Repositories\TranslationRepository;
use App\Domain\Translation\Services\LanguageService;
use App\Domain\Translation\Services\TranslationService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TranslationRepositoryInterface::class, TranslationRepository::class);
        $this->app->bind(TranslationServiceInterface::class, TranslationService::class);

        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
        $this->app->bind(LanguageServiceInterface::class, LanguageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}

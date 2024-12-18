<?php

namespace App\Providers;

use App\Contracts\AnswerRepositoryContract;
use App\Contracts\GameContract;
use App\Contracts\PlayerRepositoryContract;
use App\Contracts\QuestionRepositoryContract;
use App\Contracts\RoomRepositoryContract;
use App\Services\AnswerRepository;
use App\Services\GameService;
use App\Services\PlayerRepository;
use App\Services\QuestionRepository;
use App\Services\RoomRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RoomRepositoryContract::class, RoomRepository::class);
        $this->app->bind(PlayerRepositoryContract::class, PlayerRepository::class);
        $this->app->bind(QuestionRepositoryContract::class, QuestionRepository::class);
        $this->app->bind(AnswerRepositoryContract::class, AnswerRepository::class);
        $this->app->singleton(GameContract::class, GameService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ScoreRepositoryInterface::class, ScoreRepository::class);
    }

    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Cinema;
use App\Movie;
use App\Policies\CinemaPolicy;
use App\Policies\MoviePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Cinema' => 'App\Policies\CinemaPolicy',
        'App\Movie' => 'App\Policies\MoviePolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Video;
use App\Policies\VideoPolicy;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register policies
        Gate::policy(Video::class, VideoPolicy::class);

        // Define gates
        Gate::define('manage-videos', function ($user) {
            return $user->isSuperAdmin();
        });

        Gate::define('view-videos', function ($user) {
            return $user->hasPermissionTo('view videos');
        });

        Blade::component('layouts.app', 'layouts.app');

        $this -> registerPolicies();
    }
    protected $policies = [
        Video::class => VideoPolicy::class,
    ];

}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoUserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //单例
        $this->app->singleton('App\Repositories\Contracts\UserInterface', function($app){
            return new \App\Repositories\Eloquent\UserServiceRepository();
        });
        // 绑定
//        $this->app->bind('App\Repositories\Contracts\UserInterface', 'App\Repositories\Eloquent\UserServiceRepository');
        $this->app->singleton('UserFacadeRepository', function($app){
            return new \App\Repositories\Eloquent\UserFacadeRepository();
        });
    }
}

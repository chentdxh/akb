<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    private  static  $empty_user ;
    public function boot()
    {
        //

        view()->composer('*', function ($view)
        {

            $user = request()->user();

            if (empty($user))
            {
                if (empty(self::$empty_user))
                {
                    self::$empty_user = new User();
                    self::$empty_user->name = "Guest";
                    self::$empty_user->id = null;
                    self::$empty_user->uid = null;
                    $user = self::$empty_user;
                }

            }

            $view->with('webuser', $user);

        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

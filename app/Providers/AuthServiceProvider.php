<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // blokir akses menggunakan Gate, hampir sama dengan policy
        Gate::define('akses_menu', function($user){
            $role = User::find($user->id)->role->id;
            if ($role == 2){
                return true;
            }
            return null;
        });

        // blokir akses menggunakan Gate, hampir sama dengan policy
        Gate::define('tombol_superadmin', function($user){
            $role = User::find($user->id)->role->id;
            if ($role == 2){
                return true;
            }
            return null;
        });
       
        // blokir akses menggunakan Gate, hampir sama dengan policy
        Gate::define('table_superadmin', function($user){
            $role = User::find($user->id)->role->id;
            if ($role == 2){
                return true;
            }
            return null;
        });
    }
}

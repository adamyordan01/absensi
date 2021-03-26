<?php

namespace App\Providers;

// use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Gates Authorization
        //MEMBUAT GATE DIMANA PARAMETER PERTAMA ADALAH NAMA GATE-NYA
        //DAN PARAMETER SELANJUTNYA ADALAH CLOSURE FUNCTION
        //DIMANA KITA MELAKUKAN PENGECEKAN, JIKA USER YANG SEDANG LOGIN ROLE BERNILAI TRUE, MAKA DIA AKAN DIIZINKAN
        Gate::define('isAdmin', function($user) {
            return $user->level == 'admin';
        });

        Gate::define('isPegawai', function($user) {
            return $user->level == 'pegawai';
        });
    }
}

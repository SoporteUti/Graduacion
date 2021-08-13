<?php

namespace sispg\Providers;

use Illuminate\Support\ServiceProvider;
use sispg\AlumnoAsistencia;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        AlumnoAsistencia::observe('sispg\\Observers\\AlumnoAsistenciaObserver');
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

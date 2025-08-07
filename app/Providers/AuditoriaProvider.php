<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\AuditoriaObserver;

class AuditoriaProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // INDICAR AQUI AS MODELS QUE TERÃO DADOS SALVOS
        // PENSAR TALVEZ EM UM LAÇO OU UMA OUTRA FORMA DE FAZER ISSO COM TODAS AS MODELS AUTOMATICAMENTE
        // \App\Models\Model::observe(AuditoriaObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

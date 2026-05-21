<?php

namespace App\Providers;

use App\Models\annnee_accademiqueModel;
use App\Models\personnelsModel;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('totalPersonnels', personnelsModel::count());
        });

        $anneAccademiqueActive = annnee_accademiqueModel::where('active', true)->first();

        View::share('anneAccademiqueActive', $anneAccademiqueActive);

         Carbon::setLocale('fr');
    }

}

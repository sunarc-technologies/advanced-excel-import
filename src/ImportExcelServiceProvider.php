<?php

namespace Sunarc\ImportExcel;

use Sunarc\ImportExcel\ImportExcel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ImportExcelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ImportExcel');
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
        Route::group(['prefix' => '/api/import', 'middleware' => ['api']], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });

        if ($this->app->runningInConsole()) {
            // Publishing the config.
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('ImportExcel.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'ImportExcel');
        $this->app->singleton('ImportExcel', function () {
            return new ImportExcel;
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => 'import',
            'middleware' => ['web'],
        ];
    }
}

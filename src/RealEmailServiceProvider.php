<?php

namespace Megaads\RealEmail;

use Illuminate\Support\ServiceProvider;
use Megaads\RealEmail\Controllers\VerifyEmailController;

class RealEmailServiceProvider extends ServiceProvider
{

    public function boot() {
        include __DIR__ . '/routes.php';
    }

    public function register() {

        $this->registerFacade();
        $this->registerHelper();
    }

    protected function registerFacade()
    {
        $this->app->bind('realemail', function ($app) {
            return new VerifyEmailController();
        });

        if (class_exists('AliasLoader')) {
            $loader =  \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('RealEmail', 'Megaads\RealEmail\Facades\VerifyEmailFacade');
        } else {
            class_alias('Megaads\RealEmail\Facades\VerifyEmailFacade', 'RealEmail');
        }
    }

    protected function registerHelper()
    {
        $filePath = __DIR__ . '/Helpers/helper.php';
        if (file_exists($filePath)) {
            require_once $filePath;
        }
    }
}
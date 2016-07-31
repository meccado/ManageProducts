<?php

namespace Meccado\ManageProducts;

use Illuminate\Support\ServiceProvider;

class ManageProductsServiceProvider extends ServiceProvider
{
  /**
       * Perform post-registration booting of services.
       *
       * @return void
       */
      public function boot()
      {
        if (! $this->app->routesAreCached()) {
          require __DIR__.'/Http/routes.php';
        }

        $configFiles = ['product'];
        foreach ($configFiles as $config) {
          $this->mergeConfigFrom(__DIR__."/config/{$config}.php", 'mng_product');
        }

        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'mng_product');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'mng_product');

        //Publish middleware
        // $this->publishes([
        //   __DIR__ . '/Middleware/' => app_path('Http/Middleware'),
        // ]);

        //Publish providers
        // $this->publishes([
        //   __DIR__ . '/Providers/' => app_path('Providers'),
        // ]);

        //Publish views
        $this->publishes([
          __DIR__.'/resources/views' => resource_path('views'),
        ], 'views');

        //Publish translations
        $this->publishes([
          __DIR__.'/resources/lang/' => resource_path('lang/'),
        ], 'translations');

        // Publish a config file
        $this->publishes([
          __DIR__.'/config/product.php' => config_path('product.php'),
        ], 'config');

        //Publish migrations
        $this->publishes([
          __DIR__ . '/database/migrations' => database_path('migrations'),
          //__DIR__ . '/database/seeds' => database_path('seeds'),
        ], 'migrations');

        $this->publishes([
          __DIR__.'/assets/bower_components/AdminLTE/' => public_path('/assets/bower_components/AdminLTE/'),
        ], 'public');

        $this->publishes([
          __DIR__ . '/Http/Controllers/Admin/'    => app_path('/Http/Controllers/Admin/'),
        ], 'controllers');
        $this->publishes([
          __DIR__ . '/Models/Admin/' => app_path(),
        ], 'models');
      }

      /**
       * Register any package services.
       *
       * @return void
       */
      public function register()
      {
        $this->app->bind('mng_product', function($app){
          return new ManageProducts;
        });

        //Register dependency packages
        $this->app->register('Collective\Html\HtmlServiceProvider');
        $this->app->register('Intervention\Image\ImageServiceProvider');
        //$this->app->register('Unisharp\Ckeditor\ServiceProvider');
        //$this->app->register('Unisharp\Laravelfilemanager\LaravelFilemanagerServiceProvider');
        $this->app->register('Meccado\AclAdminControlPanel\AclAdminControlPanelServiceProvider');

        // Register dependancy aliases
        $this->app->booting(function()
        {
          $loader = \Illuminate\Foundation\AliasLoader::getInstance();
          $loader->alias('Form', 'Collective\Html\FormFacade');
          $loader->alias('HTML', 'Collective\Html\HtmlFacade');
          $loader->alias('Image', 'Intervention\Image\Facades\Image');
        });
      }
}

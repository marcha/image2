<?php

namespace Marcha\Image2;

use Config;
use Illuminate\Support\ServiceProvider;
use marcha\Image2\Provider as LaravelProvider;
use marcha\Image2\Image;
use marcha\Image2\Cache\ProviderCacher;
use marcha\Image2\SaveHandlers\FileSystem;
use Marcha\Image2\Commands\MoveAssetCommand;


class Image2ServiceProvider extends ServiceProvider {
    
        /**
         * Indicates if loading of the provider is deferred.
         *
         * @var bool
         */
        protected $defer = false;
    
        public function boot() {
    
            include(__DIR__.'/Providers/routes.php');
        }
    
    
        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {
    
            //Config::package('marcha/image2', __DIR__.'/../../../../../config');
            config('marcha/image2', __DIR__.'/../../../config');
    
            $this->registerCache();
            $this->registerImageFileSaveHandler();
            $this->registerImage();
    
            $this->registerCommands();
    
        }
    
    
        private function registerCache() {
    
            $this->app->bind('marcha.Image2.cache', function() {
                // default cache is file
                // trying to keep image cache separate from other cache
                $config = array();
                $config['config']['cache.driver'] = 'file';
                $config['config']['cache.path'] = storage_path() . '/cache/' . Config::get('image.cache.path');
                $config['files'] = new \Illuminate\Filesystem\Filesystem;
                // return new \Illuminate\Cache\CacheManager($config);
                return new \Illuminate\Cache\CacheManager($this->app);
            });
    
        }
    
    
        private function registerImageFileSaveHandler()
        {
            $app = $this->app;
            $this->app->bind('marcha.Image2.saveHandler', function() use ($app) {
                return new FileSystem(new LaravelProvider($app['marcha.Image2.cache']));
            });
        }
    
    
        private function registerImage() {
    
            $app = $this->app;
    
            $this->app->bind('marcha.Image2', function() use ($app) {
                $provider = new LaravelProvider($app['marcha.Image2.cache']);
                // option 1
                $cacher   = new ProviderCacher($provider);
                // option 2
                // $cacher   = new ImageFileCacher($app['marcha.Image.saveHandler']);
                return new Image($provider,
                                 Config::get('image.cache.lifetime'),
                                 Config::get('image.route'),
                                 $cacher);
            });
    
        }
    
    
        private function registerCommands() {
    
            $this->app->singleton('command.marcha.Image2.moveasset', function ($app) {
                return new MoveAssetCommand();
           });

            $this->commands('command.marcha.Image2.moveasset');
        }
    
    
        /**
         * Get the services provided by the provider.
         *
         * @return array
         */
        public function provides()
        {
            return ['marcha2.Image'];
        }
    
    }


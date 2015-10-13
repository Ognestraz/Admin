<?php namespace Ognestraz\Admin;

use Illuminate\Support\ServiceProvider;
 
class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require __DIR__ . '/Http/routes.php';
        
        $this->loadViewsFrom(__DIR__.'/resources/views', 'admin');
        $this->publishes([
            __DIR__.'/public/build' => base_path('public/build'),
            __DIR__.'/public/css' => base_path('public/css'),
            __DIR__.'/public/js' => base_path('public/js'),
            __DIR__.'/database' => base_path('database')
        ]);        
        
    }    
    
    public function register()
    {
        $this->app->bind('admin', function () {
            return new Admin;
        });
    }
}

<?php namespace Ognestraz\Admin;

use Illuminate\Support\ServiceProvider;
 
class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require __DIR__ . '/Http/routes.php';
        
        $this->loadViewsFrom(__DIR__.'/resources/views', 'admin');
    }    
    
    public function register()
    {
        $this->app->bind('admin', function () {
            return new Admin;
        });
    }
}

<?php namespace Vanchelo\CustomResponses;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ResponsesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function register()
    {
        $this->registerBindings();
        $this->registerErrorHandler();
    }

    /**
     * Register Bindings
     */
    protected function registerBindings()
    {
        $this->app->bind('403', 'Vanchelo\CustomResponses\Responses\Forbidden');
        $this->app->bind('404', 'Vanchelo\CustomResponses\Responses\NotFound');
    }

    /**
     * Register Error Handler
     */
    protected function registerErrorHandler()
    {
        $this->app->error(function(HttpExceptionInterface $e)
        {
            if ($this->app['config']->get('app.debug'))
            {
                return null;
            }

            if ($this->app->bound($e->getStatusCode()))
            {
                return $this->app->make($e->getStatusCode());
            }
        });
    }
}

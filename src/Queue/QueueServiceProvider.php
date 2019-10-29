<?php

namespace WPKit\Queue;

use Illuminate\Support\ServiceProvider;
use WPKit\Queue\Queue;

class QueueServiceProvider extends ServiceProvider
{
    /**
     * Define theme routes namespace.
     */
    public function register()
    {
	    
	    $this->app->instance('queue', new Queue());   
        
    }
}

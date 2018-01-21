<?php

namespace SCF\Silex\Provider\Models;

use Silex\Application;
use Pimple\ServiceProviderInterface;

class ModelsServiceProvider implements ServiceProviderInterface {
    
	public function register(\Pimple\Container $app) {
		$app['models.basepath'] = array();
        $app['models'] = $app->protect(function() use ($app) {
            return new Models($app);
        });
    }
    
    public function boot(Application $app) {

    }
}

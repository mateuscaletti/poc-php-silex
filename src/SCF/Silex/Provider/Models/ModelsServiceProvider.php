<?php

namespace SCF\Silex\Provider\Models;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ModelsServiceProvider implements ServiceProviderInterface {
    
	public function register(Application $app) {
		$app['models.basepath'] = array();
        $app['models'] = $app->share(function($app) {
            return new Models($app);
        });
    }
    
    public function boot(Application $app) {

    }
}
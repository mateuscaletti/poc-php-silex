<?php
namespace SCF\Controller;

use Silex\Application;

class WelcomeController {
	public function showAction(Application $app) {
		$app['monolog']->debug('Controller showAction acionado');
		return 'Welcome to SCF';
	}	
}

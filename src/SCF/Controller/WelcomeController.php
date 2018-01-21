<?php
namespace SCF\Controller;

use Silex\Application;

class WelcomeController {
	public function showAction(Application $app) {
		return 'Welcome to SCF';
	}	
}

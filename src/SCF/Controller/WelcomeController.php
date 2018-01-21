<?php
namespace SCF\Controller;

use Silex\Application;

class WelcomeController {
	public function showAction(Request $request, Application $app) {
		echo 'Welcome to SCF';
	}	
}
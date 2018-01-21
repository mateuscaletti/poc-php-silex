<?php

namespace SCF\Silex\Provider\Models;

use Silex\Application;

class Models {
	private $app;
	public function __construct(Application $app) {
		$this->app = $app;
	}
	public function load($modelName) {
		
		$modelNameDir = str_replace('\\', DIRECTORY_SEPARATOR, $modelName);
		
		require_once $this->app['models.basepath'] . DIRECTORY_SEPARATOR . $modelNameDir . '.php';
				
		return new $modelName($this->app);
	}

}
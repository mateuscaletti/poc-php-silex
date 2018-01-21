<?php

namespace SCF\Silex\Provider\Models;

use Silex\Application;

class ModelBase {
	
	protected $app;
	
	public function __construct(Application $app) {
		$this->app = $app;
	}
	
}
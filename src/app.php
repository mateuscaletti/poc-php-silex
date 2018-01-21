<?php

require_once(__DIR__."/config.php");

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->set('SCF\Silex', __DIR__);
$loader->set('SCF\Controller', __DIR__);
$loader->set('SCF\Modal', __DIR__);
$loader->register(true);


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JDesrosiers\Silex\Provider\CorsServiceProvider;
use SCF\Silex\Application;
use SCF\Silex\Http\ResponseHeader as ResponseHeader;
use SCF\Silex\Http\RequestJsonData as RequestJsonData;
use SCF\Controller\AuthController;
use SCF\Controller\WelcomeController;

$app = new SCF\Silex\Application();

$app['debug'] = $SCFconfig['debug'];

require_once(__DIR__."/registers.php");
require_once(__DIR__."/controllers.php");	
	
return $app;

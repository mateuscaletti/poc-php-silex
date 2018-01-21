<?php

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;

if($SCFconfig['logs.monolog.enabled']) {
	$app->register(new MonologServiceProvider(), array(
	    'monolog.logfile' => __DIR__.'/../var/logs/silex_dev.log',
	));
}

if($SCFconfig['logs.profiler.enabled']) {
	$app->register(new WebProfilerServiceProvider(), array(
	    'profiler.cache_dir' => __DIR__.'/../var/cache/profiler',
	));
}

$app['monolog']->debug('Registrando o ServiceProvider do "Doctrine"');
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => array(
		'driver' 	=> $SCFconfig['db.driver'],
		'dbhost' 	=> $SCFconfig['db.dbhost'],
		'host' 		=> $SCFconfig['db.host'],
		'dbname' 	=> $SCFconfig['db.dbname'],
		'user' 		=> $SCFconfig['db.user'],
		'password' 	=> $SCFconfig['db.password'],
		'charset' 	=> $SCFconfig['db.charset'],
	),
));

$app['monolog']->debug('Registrando o ServiceProvider do "Models"');
$app->register(new SCF\Silex\Provider\Models\ModelsServiceProvider(), array(
    'models.basepath' => __DIR__
));

$app['monolog']->debug('Registrando o ServiceProvider do "Login"');
if(!$SCFconfig['login.salt']) {
	$app['monolog']->warning('Config "login.salt" não foi setada! Segurança prejudicada!');
}
$app->register(new SCF\Silex\Provider\Login\LoginServiceProvider(), array(
    'login.salt' => $SCFconfig['login.salt']
));

//$app->register(new CorsServiceProvider());

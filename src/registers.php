<?php

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

$app->register(new SCF\Silex\Provider\Models\ModelsServiceProvider(), array(
    'models.basepath' => __DIR__
));

//$app->register(new CorsServiceProvider());
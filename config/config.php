<?php

//ini_set('display_errors', 0);
ini_set('display_errors', 1);

//error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);

$SCFconfig = array();

$SCFconfig['debug'] = true;

$SCFconfig['db.driver'] = 'pdo_mysql';
$SCFconfig['db.dbhost'] = 'localhost';
$SCFconfig['db.host'] = 'localhost';
$SCFconfig['db.dbname'] = '';
$SCFconfig['db.user'] = '';
$SCFconfig['db.password'] = '';
$SCFconfig['db.charset'] = 'utf8';

$SCFconfig['login.salt'] = ' asd 2382y3rbkj as JJ//? **34 9)(*"KÇÇÇk 12+';

$SCFconfig['logs.profiler.enabled'] = false;
$SCFconfig['logs.monolog.enabled'] = true;

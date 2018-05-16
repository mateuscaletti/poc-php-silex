<?php

//ini_set('display_errors', 0);
ini_set('display_errors', getenv('APP_DISPLAYERRORS'));

error_reporting(E_ALL);
if(getenv('APP_ERROR_LEVEL') != 'E_ALL')
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

$SCFconfig = array();

$SCFconfig['debug'] = true;

$SCFconfig['db.driver'] = 'pdo_mysql';
$SCFconfig['db.dbhost'] = getenv('APP_DB_HOST');
$SCFconfig['db.host'] = getenv('APP_DB_HOST');
$SCFconfig['db.dbname'] = getenv('APP_DB_DBNAME');
$SCFconfig['db.user'] = getenv('APP_DB_USER');
$SCFconfig['db.password'] = getenv('APP_DB_PASS');
$SCFconfig['db.charset'] = 'utf8';

$SCFconfig['login.salt'] = getenv('APP_LOGIN_SALT');

$SCFconfig['logs.profiler.enabled'] = getenv('APP_LOGS_PROFILER_ENABLED');
$SCFconfig['logs.monolog.enabled'] = getenv('APP_LOGS_MONOLOG_ENABLED');

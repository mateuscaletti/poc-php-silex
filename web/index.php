<?php

ini_set('display_errors', 0);

require __DIR__.'/../config/prod.php';

$app = require __DIR__.'/../app/app.php';

$app->run();
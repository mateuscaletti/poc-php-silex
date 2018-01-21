<?php

ini_set('display_errors', 0);

require __DIR__.'/../config/config.php';

$app = require __DIR__.'/../src/app.php';

$app->run();
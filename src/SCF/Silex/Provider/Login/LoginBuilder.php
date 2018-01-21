<?php

namespace SCF\Silex\Provider\Login;
use Silex\Application;

class LoginBuilder {
    public static function mountProviderIntoApplication($route, Application $app) {
        $app->mount($route, (new LoginControllerProvider())->setBaseRoute($route));
    }
}

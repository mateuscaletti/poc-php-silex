<?php

namespace SCF\Silex;

use Silex\Application as SilexApplication;
use SCF\Silex\Provider\Login\LoginBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Application extends SilexApplication {
    public function __construct(array $values = []) {
        parent::__construct($values);
        
        LoginBuilder::mountProviderIntoApplication('/auth', $this);
        
        $this->after(function (Request $request, Response $response) {
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', '*');
        });

    }
}
<?php

namespace SCF\Silex\Provider\Login;

use Silex\Application;
use Pimple\ServiceProviderInterface;

class LoginServiceProvider implements ServiceProviderInterface
{
    const AUTH_VALIDATE_CREDENTIALS = 'auth.validate.credentials';
    const AUTH_VALIDATE_TOKEN       = 'auth.validate.token';
    const AUTH_ISVALID_TOKEN       	= 'auth.isvalid.token';
    const AUTH_NEW_TOKEN            = 'auth.new.token';
    const AUTH_TOKEN_SALT			= '88&mmmasd 1°°,.>>< //12    ((*123nb';
    
    private $app;
    
    public function register(\Pimple\Container $app)
    {
    	$this->app = $app;
    	
        $app[self::AUTH_VALIDATE_CREDENTIALS] = $app->protect(function ($user, $pass, $apiKey) {
            return $this->validateCredentials($this->app, $user, $pass, $apiKey);
        });
        $app[self::AUTH_VALIDATE_TOKEN] = $app->protect(function ($token, $user, $apiKey) {
            return $this->validateToken($this->app, $token, $user, $apiKey);
        });
        $app[self::AUTH_NEW_TOKEN] = $app->protect(function ($user, $apiKey) {
            return $this->getNewTokenForUser($user, $apiKey);
        });
        $app[self::AUTH_ISVALID_TOKEN] = $app->protect(function ($token, $apiKey) {
        	return $this->isValidToken($token, $apiKey);
        });
    }
    
    public function boot(Application $app) {
    	
    }
        
    private function validateCredentials(Application $app, $user, $pass, $apiKey) {
    	
    	try {
    	
	    	$userModel = $app['models']->load('SC\Model\Globals\UserModel');
	    	$userModel->validate($user, $pass);
	    	
	    	$apiKeyModel = $app['models']->load('SC\Model\Globals\ApiKeysModel');
	    	$apiKeyModel->validate($apiKey);
    	    	
        	return true;
    	} catch (\RuntimeException $e) {
    		throw $e;
    		return false;
    	}
    }
    
    private function generateSecretKey($apiKey) {
    	return base64_encode(md5(self::AUTH_TOKEN_SALT.$apiKey));
    }
    
    private function generateExpirationTime() {
    	return strtotime('+1 day');
    }
    
    private function isValidToken($token, $apiKey) {
    	$secret = $this->generateSecretKey($apiKey);

    	try{
    		$decoded = \JWT::decode($token, $secret, true);
    		return true;
    	} catch (\Exception $e) {
    		return false;
    	}
    }
    
    private function validateToken(Application $app, $token, $user, $apiKey) {
    	$apiKeyModel = $app['models']->load('SC\Model\Globals\ApiKeysModel');
    	$apiKeyModel->validate($apiKey);
    	
    	$secret = $this->generateSecretKey($apiKey);
    	$decoded = \JWT::decode($token, $secret, true);
    	
    	$userModel = $app['models']->load('SC\Model\Globals\UserModel');
    	$userModel->validateUser($user);
    	
    	if($decoded->user != $user) {
    		throw new \RuntimeException('Token is not valid for this user');
    	}
    }
    
    private function getNewTokenForUser($user, $apiKey) {
    	$token = array(
    		"user" 		=> $user,
    		"apiKey" 	=> $apiKey,
    		"exp" 		=> $this->generateExpirationTime()
    	);
    	
    	$secret = $this->generateSecretKey($apiKey);
    	
    	$jwt = \JWT::encode($token, $secret);
    	
        return $jwt;
    }
}

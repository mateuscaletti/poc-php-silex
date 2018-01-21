<?php
namespace SCF\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use SCF\Silex\Http\ResponseHeader as ResponseHeader;
use SCF\Silex\Http\RequestJsonData as RequestJsonData;
use SCF\Silex\Provider\Login\LoginServiceProvider;

class AuthController {
	public function validateCredentialsAction(Request $request, Application $app) {
		try {
			$request = RequestJsonData::get($request);
			
			$user   = $request->get('user');
			$pass   = $request->get('pass');
			$apiKey = $request->get('apiKey');
			
			$statusOK = $app['auth.validate.credentials']($user, $pass, $apiKey);
			
			$token = $app['auth.new.token']($user, $apiKey);
			
			$userModel = $app['models']->load('SC\Model\Globals\UserModel');
			$user = $userModel->get($user);
			
			$response['status'] = 'OK';
			$response['info'] = [
				'token' => $token,
				'user' 	=> [
					'id'		=> $user['IDUSER'],
					'username'	=> $user['USER'],
					'name'		=> $user['NAME']
				]
			];
			
			return $app->json($response, 200, ResponseHeader::get(200, '10001', 'Authentication process result OK', ResponseHeader::AUTH_REQUEST_RESPONSE));

		} catch (\RuntimeException $e) {
			
			$message = $e->getMessage();
			$code = $e->getCode();
			
			$response['status'] = 'Error';
			$response['info'] = ['message' => $message];
			
			return $app->json($response, 401, ResponseHeader::get(401, $code, $message, ResponseHeader::AUTH_REQUEST_RESPONSE));
		}
	}
	
	public function validateTokenAction(Request $request, Application $app) {
	
		try {
	
			$request = RequestJsonData::get($request);
	
	
	
			$apiKey = $request->get('apiKey');
	
			$user = $request->get('user');
	
			$token = $request->get('token');
	
	
	
			$decodedToken = $app['auth.validate.token']($token, $user, $apiKey);
	
	
	
			$response['token_status'] = 'VALID';
	
	
	
			return $app->json($response, 200, ResponseHeader::get(200, '10500', 'Client token is valid', ResponseHeader::AUTH_INFO_RESPONSE));
	
	
	
		} catch (\RuntimeException $e) {
	
	
	
			$message = $e->getMessage();
	
			$code = $e->getCode();
	
	
	
			$response['token_status'] = 'NOT_VALID';
	
			$response['info'] = [
	
					'code' 		=> $code,
	
					'message' 	=> $message
	
			];
	
	
	
			return $app->json($response, 200, ResponseHeader::get(200, '10501', 'Token is not valid', ResponseHeader::AUTH_REQUEST_RESPONSE));
	
		}
	
	}
	
	
	
}
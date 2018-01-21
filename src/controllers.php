<?php

	/*
	 * Validate credentials to authenticate
	 */
	$app->match('/welcome', 'SCF\Controller\WelcomeController::showAction')
	->method('GET');


	/*
	 * Validate credentials to authenticate
	 */
	$app->match('/auth/validate-credentials', 'SCF\Controller\AuthController::validateCredentialsAction')
	->method('POST');
	
	
	/*
	 * Validate existing client token
	 */
	$app->match('/auth/validate-token', 'SCF\Controller\AuthController::validateTokenAction')
	->method('POST');
	
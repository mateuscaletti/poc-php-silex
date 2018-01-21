<?php

namespace SCF\Silex\Http;



class ResponseHeader {
	const HTTP_STATUS_CODE_HEADER_KEY = 'X-HTTP-Status-Code';
	const API_RESPONSE_STATUS_CODE_HEADER_KEY = 'X-API-Response-Status-Code';
	const API_RESPONSE_STATUS_MESSAGE_HEADER_KEY = 'X-API-Response-Status-Message';
	const API_RESPONSE_TYPE_HEADER_KEY = 'X-API-Response-Type';
	
	const REGULAR_RESPONSE = 'REGULAR_RESPONSE';
	const AUTH_REQUEST_RESPONSE = 'AUTH_REQUEST_RESPONSE';
	const AUTH_INFO_RESPONSE = 'AUTH_INFO_RESPONSE';

	public static function get($httpStatusCode, $apiStatusCode, $apiStatusMessage, $apiResponseType = null) {
		if(is_null($apiResponseType)) $apiResponseType = self::REGULAR_RESPONSE;
		
		return array(
			self::HTTP_STATUS_CODE_HEADER_KEY				=> $httpStatusCode
			, self::API_RESPONSE_STATUS_CODE_HEADER_KEY 	=> $apiStatusCode
			, self::API_RESPONSE_STATUS_MESSAGE_HEADER_KEY 	=> $apiStatusMessage
			, self::API_RESPONSE_TYPE_HEADER_KEY 			=> $apiResponseType
		);
	}
}
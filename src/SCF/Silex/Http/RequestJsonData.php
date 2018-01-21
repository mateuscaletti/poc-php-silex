<?php

namespace SCF\Silex\Http;

class RequestJsonData {
	
	public static function get($request) {
		$data = json_decode($request->getContent(), true);
		$request->request->replace(is_array($data) ? $data : array());
		
		return $request;
	}
}
<?php

require "vendor/autoload.php";
use \Firebase\JWT\JWT;

class jwtToken {

	var $payLoad;
	var $encodeStatus;
	var $decodeStatus;

	function __contruct() {

		$this->payload = array();
	
	}

	function prepareJwtToken($emailId) {
		
		$this->payload = array("emailId" => $emailId, "exp" => time()+100);	

	}

	function encodeJwtToken() {

		try {
	    		$jwt = JWT::encode($this->payload, "GISED@123");
			$this->encodeStatus = true;
		}catch (UnexpectedValueException $e) {
		    	$jwt = $e->getMessage();
			$this->encodeStatus = false;
		}

		return $jwt;

	}

	function decodeJwtToken($encodeJwt) {
		
		try {
		    	$jwt = (array) JWT::decode($encodeJwt, "GISED@123", array('HS256'));
		    	$this->decodeStatus = true;
		}catch (UnexpectedValueException $e) {
		    	$jwt = $e->getMessage();
			$this->decodeStatus = false;
		}

		return $jwt;

	}

}
?>

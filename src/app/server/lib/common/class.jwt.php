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

$jwtObj = new jwtToken();
$jwtObj->prepareJwtToken("nsathees.y2k@gmail.com");
$encodeJwt = $jwtObj->encodeJwtToken();
$encodeJwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbElkIjoibnNhdGhlZXMueTJrQGdtYWlsLmNvbSIsImV4cCI6MTU4ODUxNjY4MH0.PxmYy0CbVd5hZRUk1MinBCh7oJPuw_z9wJBw5N23gps
";
$token = $jwtObj->decodeJwtToken($encodeJwt);
echo "Encode JWT : ".$encodeJwt."<br/><br/><br/>";
if($encodeJwt->decodeStatus) {
echo "Decode JWT : ".json_encode($token)."<br/><br/><br/>";
} else {
echo "Decode JWT : ".json_encode($token)."<br/><br/><br/>";
}

 
//$jwt='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdXRob3IiOiJTaWdpdCBQcmFzZXR5byBOIiwiYXV0aG9ydXJpIjoiaHR0cHM6XC9cL3NlZWdhdGVzaXRlLmNvbSIsImV4cCI6MTU4NzU2MjcyOX0.WrjuzgPQXgntIH_hgti0rjonP8MpXUyFP8vHPjk-7iA';

?>

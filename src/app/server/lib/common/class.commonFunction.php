<?php

class commonFunction {

    function encryption($plainData) {
		return base64_encode($plainData);
	}

	function decryption($encryptedData) {
		return base64_decode($encryptedData['request']);
	}

	function readJsonConfigurations($for, $value, $keyName) {
		if($for == 'modules') {
			$filePath = MODULES_PATH;
		} else if($for == 'mails') {
			$filePath = MAILS_PATH;
		}

		$jsonData = json_decode($this->readFileContents($filePath),1);
		$keyValues = array_column($jsonData,$keyName);
		$arrayIndex = array_search($value, $keyValues);
		return $jsonData[$arrayIndex];
	}
	
	function readFileContents($filePath) {
		return file_get_contents($filePath);
	}

	function escapeMysqlSpecialString($data) {
		return mysql_escape_string($data);
	}

}

?>
<?php

//Description : This file used to create common db connection for the product
class dbConnection {

	//Database connection object
	public static $dbObj;

	//Database connection creation
	public static function connectDB() {

		//If connection not exist create new connection
		if(self::$dbObj == null) {
			//Creating a connection
			self::$dbObj = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, DB_NAME);

			//Check connection
			if (self::$dbObj->connect_error) {
				die("Connection failed: " . self::$dbObj->connect_error);
			}
		}

	}

	//Select query function
	public static function selectQuery($sql) {

		$records = array();
		$dbResult = self::$dbObj->query($sql);
		if($dbResult === false) {
			return 'ERROR';
		} else {
			while($row = mysqli_fetch_assoc($dbResult)) {
				$records[] = $row; 
			}
			if(empty($records)) {
				return 'EMPTY';
			} else {
				return $records;
			}
		}

	}

	//Insert query function
	public static function insertQuery($sql) {

		if(self::$dbObj->query($sql) === true) {
			return true;
		} else {
			return 'ERROR';
		}

	}

	//Update query function
	public static function updateQuery($sql) {

		if(self::$dbObj->query($sql) === true) {
			return true;
		} else {
			return 'ERROR';
		}

	}

	//Delete query function
	public static function deleteQuery($sql) {

		if(self::$dbObj->query($sql) === true) {
			return true;
		} else {
			return 'ERROR';
		}

	}

	//Destroy the database connection
	public static function destroyConnectDB() {
		if(self::$dbObj != null) {
			self::$dbObj->close();						
		}
	}
	
}

?>

<?php

//Description : This file used to create common db connection for the product
class dmpassword {

    //Variable declarations
    var $password_id;
    var $login_password;

    //Initial values for the variables
    function __construct() {
        $this->password_id = 0;
        $this->login_password = '';
    }

    //Insert query for the table
    function insertdmpassword() {
        $sql = "insert into dm_password values(
                                            $this->password_id,
                                            '". $this->login_password ."'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmpassword() {
        $sql = "select
                        password_id,
                        aes_decrypt(login_password,sha2('GISED@123',256)) as login_password
                from 
                        dm_password 
                where 1 ";

        if($this->password_id != 0) {
            $sql = $sql . " and password_id = " . $this->password_id;
        }

        if($this->login_password != '') {
            $sql = $sql . " and login_password = " . $this->login_password;
        }

        return $sql;
    }

    //Update query for the table
    function updatedmpassword() {
        $sql = "update 
                        dm_password 
                set";

        $camaa = " ";
        if($this->login_password != '') {
            $sql = $sql . $camaa." login_password = aes_encrypt('" . $this->login_password ."',sha2('GISED@123',256)) ";
            $camaa = ', ';

        }

        $sql = $sql . " where ";

        if($this->password_id != 0) {
            $sql = $sql . " password_id = " . $this->password_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmpassword() {
        $sql = "delete 
                from 
                    dm_password 
                where 1 ";

        if($this->password_id != 0) {
            $sql = $sql . " and password_id = " . $this->password_id;
        }

        if($this->login_password != '') {
            $sql = $sql . " and login_password = " . $this->login_password;
        }

        return $sql;
    }

    //Get password id
    function getPasswordId() {

        $sql = "SELECT password_id FROM dm_password WHERE login_password = '". $this->login_password ."'";
        return $sql;

    }

}

?>

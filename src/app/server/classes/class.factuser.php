<?php

//Description : This file used to create common db connection for the product
class factuser {

    //Variable declarations
    var $fact_user_id;
    var $r_user_id;
    var $r_password_id;
    var $r_user_type_id;

    //Initial values for the variables
    function __construct() {
        $this->fact_user_id = 0;
        $this->r_user_id = 0;
        $this->r_password_id = 0;
        $this->r_user_type_id = 0;
    }

    //Insert query for the table
    function insertfactuser() {
        $sql = "insert into fact_user values(
                                            $this->fact_user_id,
                                            $this->r_user_id,
                                            $this->r_password_id,
                                            $this->r_user_type_id
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectfactuser() {
        $sql = "select
                        *
                from 
                fact_user 
                where 1 ";

        if($this->fact_user_id != 0) {
            $sql = $sql . " and fact_user_id = " . $this->fact_user_id;
        }

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->r_user_id;
        }

        if($this->r_password_id != 0) {
            $sql = $sql . " and r_password_id = " . $this->r_password_id;
        }

        if($this->r_user_type_id != 0) {
            $sql = $sql . " and r_user_type_id = " . $this->r_user_type_id;
        }

        return $sql;
    }

    //Update query for the table
    function updatefactuser() {
        $sql = "update 
                    fact_user 
                set";

        $camaa = " ";        

        if($this->r_user_id != 0) {
            $sql = $sql . $camaa ." r_user_id = " . $this->fact_user_id;
            $camaa = ', ';
        }

        if($this->r_password_id != 0) {
            $sql = $sql . $camaa ." r_password_id = " . $this->r_password_id;
            $camaa = ', ';
        }

        if($this->r_user_type_id != 0) {
            $sql = $sql . $camaa ." r_user_type_id = " . $this->r_user_type_id;
            $camaa = ', ';
        }
        
        $sql = $sql . " where ";

        if($this->fact_user_id != 0) {
            $sql = $sql . " fact_user_id = " . $this->fact_user_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletefactuser() {
        $sql = "delete 
                from 
                    fact_user 
                where 1 ";

        if($this->fact_user_id != 0) {
            $sql = $sql . " and fact_user_id = " . $this->fact_user_id;
        }

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->fact_user_id;
        }

        if($this->r_password_id != 0) {
            $sql = $sql . " and r_password_id = " . $this->r_password_id;
        }

        if($this->r_user_type_id != 0) {
            $sql = $sql . " and r_user_type_id = " . $this->r_user_type_id;
        }

        return $sql;
    }

}

?>

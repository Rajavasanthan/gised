<?php

//Description : This file used to create common db connection for the product
class dmsetpassword {

    //Variable declarations
    var $set_password_id;
    var $r_user_id;
    var $link;
    var $status;
    
    //Initial values for the variables
    function __construct() {
        $this->set_password_id = 0;
        $this->r_user_id = 0;
        $this->link = '';
        $this->status = '';
    }

    //Insert query for the table
    function insertdmsetpassword() {
        $sql = "insert into dm_set_password values(
                                            $this->set_password_id,
                                            $this->r_user_id,
                                            '$this->link',
                                            '$this->status',
                                            now(),
                                            now()                       
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmsetpassword() {
        $sql = "select
                        *
                from 
                        dm_set_password  
                where 1 ";

        if($this->set_password_id != 0) {
            $sql = $sql . " and set_password_id = " . $this->set_password_id;
        }

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->r_user_id;
        }

        if($this->sourcelink_name != '') {
            $sql = $sql . " and link = '" . $this->link ."'";
        }

        if($this->status != '') {
            $sql = $sql . " and status = '" . $this->status ."'";
        }

        return $sql;
    }

    //Update query for the table
    function updatedmsetpassword() {
        $sql = "update 
                        dm_set_password  
                set";
        
        $camaa = " ";
        if($this->r_user_id != 0) {
            $sql = $sql . $camaa." r_user_id = " . $this->r_user_id;
            $camaa = ', ';
        }

        if($this->link != '') {
            $sql = $sql . $camaa." link = " . $this->link;
            $camaa = ', ';
        }

        if($this->status != '') {
            $sql = $sql . $camaa." status = " . $this->status;
            $camaa = ', ';
        }
        
        $sql = $sql . " where 1 ";

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->r_user_id;
        }

        if($this->link != '') {
            $sql = $sql . " and link = '" . $this->link ."'";
        }

        if($this->status != '') {
            $sql = $sql . " and status = '" . $this->status ."'";
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmsetpassword() {
        $sql = "delete 
                from 
                    dm_set_password  
                where 1 ";

        if($this->set_password_id != 0) {
            $sql = $sql . " and set_password_id = " . $this->set_password_id;
        }

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->r_user_id;
        }

        if($this->sourcelink_name != '') {
            $sql = $sql . " and link = '" . $this->link ."'";
        }

        if($this->status != '') {
            $sql = $sql . " and status = '" . $this->status ."'";
        }

        return $sql;
    }

    //Update query to expired for exsiting query
    function disableExistingLink() {

            $sql = "UPDATE dm_set_password set status='N' WHERE  r_user_id = ".$this->r_user_id;

            return $sql;
            
    }

}

?>

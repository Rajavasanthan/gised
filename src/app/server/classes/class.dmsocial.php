<?php

//Description : This file used to create common db connection for the product
class dmsocial {

    //Variable declarations
    var $social_id;
    var $r_user_id;
    var $social_site;
    var $response;
    var $created_date_time;
    var $updated_date_time;
    
    //Initial values for the variables
    function __construct() {
        $this->social_id = 0;
        $this->r_user_id = 0;
        $this->social_site = '';
        $this->response = '';
        $this->created_date_time = '0000-00-00 00:00:00';
        $this->updated_date_time = '0000-00-00 00:00:00';
    }

    //Insert query for the table
    function insertdmsocial() {
        $sql = "insert into dm_social values(
                                            $this->social_id,
                                            $this->r_user_id,
                                            '$this->social_site',
                                            '$this->response',
                                            now(),
                                            now()
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmsocial() {
        $sql = "select
                        *
                from 
                dm_social 
                where 1 ";

        if($this->social_id != 0) {
            $sql = $sql . " and social_id = " . $this->social_id;
        }

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->r_user_id;
        }

        if($this->social_site != '') {
            $sql = $sql . " and social_site = " . $this->social_site;
        }

        if($this->response != '') {
            $sql = $sql . " and response = " . $this->response;
        }

        return $sql;
    }

    //Update query for the table
    function updatedmsocial() {
        $sql = "update 
                    dm_social 
                set"; 
        
        $camaa = " ";        
        if($this->r_user_id != 0) {
            $sql = $sql .$camaa. " r_user_id = '" . $this->r_user_id ."'";
            $camaa = ', ';
        }

        if($this->social_site != '') {
            $sql = $sql .$camaa. " social_site = '" . $this->social_site ."'";
            $camaa = ', ';
        }

        if($this->response != '') {
            $sql = $sql .$camaa. " response = '" . $this->response ."'";
            $camaa = ', ';
        }

        $sql = $sql . " where ";
                
        if($this->social_id != 0) {
            $sql = $sql . " social_id = " . $this->social_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmsocial() {
        $sql = "delete 
                from 
                    dm_social 
                where 1 ";

        if($this->social_id != 0) {
            $sql = $sql . " and social_id = " . $this->social_id;
        }

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->r_user_id;
        }

        if($this->social_site != '') {
            $sql = $sql . " and social_site = " . $this->social_site;
        }

        if($this->response != '') {
            $sql = $sql . " and response = " . $this->response;
        }
        return $sql;
    }

}

?>

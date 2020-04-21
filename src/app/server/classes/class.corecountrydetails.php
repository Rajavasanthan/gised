<?php

//Description : This file used to create common db connection for the product
class corecountrydetails {

    //Variable declarations
    var $country_id;
    var $country_name;
    var $status;

    //Initial values for the variables
    function __construct() {
        $this->country_id = 0;
        $this->country_name = '';
        $this->status = 'Y';
    }

    //Insert query for the table
    function insertcorecountrydetails() {
        $sql = "insert into core_country_details values(
                                            $this->country_id,
                                            '$this->country_name',
                                            '$this->status'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectcorecountrydetails() {
        $sql = "select
                        *
                from 
                core_country_details 
                where 1 ";

        if($this->country_id != 0) {
            $sql = $sql . " and country_id = " . $this->country_id;
        }

        if($this->country_name != '') {
            $sql = $sql . " and country_name = " . $this->country_name;
        }

        if($this->status != '') {
            $sql = $sql . " and status = '" . $this->status ."'";
        }

        return $sql;
    }

    //Update query for the table
    function updatecorecountrydetails() {
        $sql = "update 
                    core_country_details 
                set ";

        $camaa = " ";
        if($this->country_name != '') {
            $sql = $sql . $camaa . " country_name = " . $this->country_name;
            $camaa = ', ';
        }
        if($this->status != '') {
            $sql = $sql . $camaa . " status = " . $this->status;
            $camaa = ', ';
        }
        
        $sql = $sql . " where ";

        if($this->country_id != 0) {
            $sql = $sql . " country_id = " . $this->country_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletecorecountrydetails() {
        $sql = "delete 
                from 
                    core_country_details 
                where 1 ";

        if($this->country_id != 0) {
            $sql = $sql . " and country_id = " . $this->country_id;
        }

        if($this->country_name != '') {
            $sql = $sql . " and country_name = " . $this->country_name;
        }

        if($this->status != '') {
            $sql = $sql . " and status = " . $this->status;
        }

        return $sql;
    }

}

?>

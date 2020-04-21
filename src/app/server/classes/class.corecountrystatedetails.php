<?php

//Description : This file used to create common db connection for the product
class corecountrystatedetails {

    //Variable declarations
    var $country_state_details_id;
    var $r_country_id;
    var $r_state_id;
    var $status;

    //Initial values for the variables
    function __construct() {
        $this->country_state_details_id = 0;
        $this->r_country_id = 0;
        $this->r_state_id = 0;
        $this->status = 'Y';
    }


    //Insert query for the table
    function insertcorecountrystatedetails() {
        $sql = "insert into core_country_state_details values(
                                            $this->country_state_details_id,
                                            $this->r_country_id,
                                            $this->r_state_id,
                                            '$this->status'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectcorecountrystatedetails() {
        $sql = "select
                        *
                from 
                core_country_state_details 
                where 1 ";

        if($this->country_state_details_id != 0) {
            $sql = $sql . " and country_state_details_id = " . $this->country_state_details_id;
        }

        if($this->r_country_id != 0) {
            $sql = $sql . " and r_country_id = " . $this->r_country_id;
        }

        if($this->r_state_id != 0) {
            $sql = $sql . " and r_state_id = " . $this->r_state_id;
        }

        if($this->status != '') {
            $sql = $sql . " and status = " . $this->status;
        }

        return $sql;
    }

    //Update query for the table
    function updatecorecountrystatedetails() {
        $sql = "update 
                    core_country_state_details 
                set";

        $camaa = " ";
        
        if($this->r_country_id != 0) {
            $sql = $sql . $camaa ." r_country_id = " . $this->r_country_id;
            $camaa = ', ';
        }

        if($this->r_state_id != 0) {
            $sql = $sql . $camaa ." r_state_id = " . $this->r_state_id;
            $camaa = ', ';
        }

        if($this->status != '') {
            $sql = $sql . $camaa ." status = " . $this->status;
            $camaa = ', ';
        }
        
        $sql = $sql . " where ";

        if($this->country_state_details_id != 0) {
            $sql = $sql . " country_state_details_id = " . $this->country_state_details_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletecorecountrystatedetails() {
        $sql = "delete 
                from 
                    core_country_state_details 
                where 1 ";

        if($this->country_state_details_id != 0) {
            $sql = $sql . " and country_state_details_id = " . $this->country_state_details_id;
        }

        if($this->r_country_id != 0) {
            $sql = $sql . " and r_country_id = " . $this->r_country_id;
        }

        if($this->r_state_id != 0) {
            $sql = $sql . " and r_state_id = " . $this->r_state_id;
        }

        if($this->status != '') {
            $sql = $sql . " and status = " . $this->status;
        }

        return $sql;
    }

}

?>

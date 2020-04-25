<?php

//Description : This file used to create common db connection for the product
class dmapplicationdetails {

    //Variable declarations
    var $application_details_id;
    var $application_name;
    var $status;

    //Initial values for the variables
    function __construct() {
        $this->application_details_id = 0;
        $this->application_name = '';
        $this->status = '';
    }

    //Insert query for the table
    function insertdmapplicationdetails() {
        $sql = "insert into dm_application_details values(
                                            $this->application_details_id,
                                            '$this->application_name',
                                            '$this->status'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmapplicationdetails() {
        $sql = "select
                        *
                from 
                        dm_application_details 
                where 1 ";

        if($this->application_details_id != 0) {
            $sql = $sql . " and application_details_id = " . $this->application_details_id;
        }

        if($this->application_name != '') {
            $sql = $sql . " and application_name = " . $this->application_name;
        }

        if($this->status != '') {
            $sql = $sql . " and status = '" . $this->status."'";
        }

        return $sql;
    }

    //Update query for the table
    function updatedmapplicationdetails() {
        $sql = "update 
                        dm_application_details 
                set"; 

        $camaa = " ";        

        if($this->application_name != '') {
            $sql = $sql . $camaa." application_name = " . $this->application_name;
            $camaa = ", "; 
        }

        $sql = $sql . " where ";

        if($this->application_details_id != 0) {
            $sql = $sql . " application_details_id = " . $this->application_details_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmapplicationdetails() {
        $sql = "delete 
                from 
                    dm_application_details 
                where 1 ";

        if($this->application_details_id != 0) {
            $sql = $sql . " and  application_details_id = " . $this->application_details_id;
        }

        if($this->application_name != '') {
            $sql = $sql . " and application_name = " . $this->application_name;
        }

        return $sql;
    }

}

?>

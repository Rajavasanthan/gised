<?php

//Description : This file used to create common db connection for the product
class corestatedetails {

    //Variable declarations
    var $state_id;
    var $state_name;
    var $status;

    //Initial values for the variables
    function __construct() {
        $this->state_id = 0;
        $this->state_name = '';
        $this->status = 'Y';
    }

    //Insert query for the table
    function insertcorestatedetails() {
        $sql = "insert into core_state_details values(
                                            $this->state_id,
                                            '$this->state_name',
                                            '$this->status'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectcorestatedetails() {
        $sql = "select
                        *
                from 
                core_state_details 
                where 1 ";

        if($this->state_id != 0) {
            $sql = $sql . " and state_id = " . $this->state_id;
        }

        if($this->state_name != '') {
            $sql = $sql . " and state_name = " . $this->state_name;
        }

        if($this->state_id != '') {
            $sql = $sql . " and status = " . $this->status;
        }

        return $sql;
    }

    //Update query for the table
    function updatecorestatedetails() {
        $sql = "update 
                    core_state_details 
                set"; 
        $camaa = " ";
        if($this->state_name != '') {
            $sql = $sql . $camaa." state_name = " . $this->state_name;
            $camaa = ", ";
        }

        $sql = $sql . " where ";

        if($this->state_id != '') {
            $sql = $sql . " status = " . $this->status;
           
        }
        

        return $sql;
    }

    //Delete query for the table
    function deletecorestatedetails() {
        $sql = "delete 
                from 
                    core_state_details 
                where 1 ";

        if($this->state_id != 0) {
            $sql = $sql . " and state_id = " . $this->state_id;
        }

        if($this->state_name != '') {
            $sql = $sql . " and state_name = " . $this->state_name;
        }

        if($this->state_id != '') {
            $sql = $sql . " and status = " . $this->status;
        }

        return $sql;
    }

}

?>

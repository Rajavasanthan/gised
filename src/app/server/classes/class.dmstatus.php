<?php

//Description : This file used to create common db connection for the product
class dmstatus {

    //Variable declarations
    var $status_id;
    var $status_code;
    var $status_value;
    var $description;

    //Initial values for the variables
    function __construct() {
        $this->status_id = 0;
        $this->status_code = '';
        $this->status_value = '';
        $this->description = '';
    }

    //Insert query for the table
    function insertdmstatus() {
        $sql = "insert into dm_status values(
                                            $this->status_id,
                                            '$this->status_code',
                                            '$this->status_value',
                                            '$this->description'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmstatus() {
        $sql = "select
                        *
                from 
                dm_status 
                where 1 ";

        if($this->status_id != 0) {
            $sql = $sql . " and status_id = " . $this->status_id;
        }

        if($this->status_code != '') {
            $sql = $sql . " and status_code = " . $this->status_code;
        }

        if($this->status_value != '') {
            $sql = $sql . " and status_value = " . $this->status_value;
        }

        if($this->description != '') {
            $sql = $sql . " and description = " . $this->description;
        }

        return $sql;
    }

    //Update query for the table
    function updatedmstatus() {
        $sql = "update 
                    dm_status 
                set";

        $camaa = " ";        
        if($this->status_code != '') {
            $sql = $sql . $camaa." status_code = " . $this->status_code;
            $camaa = ', ';
        }

        if($this->status_value != '') {
            $sql = $sql . $camaa." status_value = " . $this->status_value;
            $camaa = ', ';
        }

        if($this->description != '') {
            $sql = $sql . $camaa." description = " . $this->description;
            $camaa = ', ';
        }

        $sql = $sql . " where ";

        if($this->status_id != 0) {
            $sql = $sql . " status_id = " . $this->status_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmstatus() {
        $sql = "delete 
                from 
                    dm_status 
                where 1 ";

        if($this->status_id != 0) {
            $sql = $sql . " and status_id = " . $this->status_id;
        }

        if($this->status_code != '') {
            $sql = $sql . " and status_code = " . $this->status_code;
        }

        if($this->status_value != '') {
            $sql = $sql . " and status_value = " . $this->status_value;
        }

        if($this->description != '') {
            $sql = $sql . " and description = " . $this->description;
        }

        return $sql;
    }

}

?>

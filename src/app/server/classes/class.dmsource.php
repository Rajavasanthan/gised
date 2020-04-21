<?php

//Description : This file used to create common db connection for the product
class dmsource {

    //Variable declarations
    var $source_id;
    var $source_name;

    //Initial values for the variables
    function __construct() {
        $this->source_id = 0;
        $this->source_name = '';
    }

    //Insert query for the table
    function insertdmsource() {
        $sql = "insert into dm_source values(
                                            $this->source_id,
                                            '$this->source_name'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmsource() {
        $sql = "select
                        *
                from 
                        dm_source 
                where 1 ";

        if($this->source_id != 0) {
            $sql = $sql . " and source_id = " . $this->source_id;
        }

        if($this->source_name != '') {
            $sql = $sql . " and source_name = " . $this->source_name;
        }

        return $sql;
    }

    //Update query for the table
    function updatedmsource() {
        $sql = "update 
                        dm_source 
                set";
        $camaa = " ";

        if($this->source_name != '') {
            $sql = $sql . $camaa." source_name = " . $this->source_name;
            $camaa = ', ';
        }
        
        $sql = $sql . " where ";

        if($this->source_id != 0) {
            $sql = $sql . " source_id = " . $this->source_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmsource() {
        $sql = "delete 
                from 
                    dm_source 
                where 1 ";

        if($this->source_id != 0) {
            $sql = $sql . " and source_id = " . $this->source_id;
        }

        if($this->source_name != '') {
            $sql = $sql . " and source_name = " . $this->source_name;
        }

        return $sql;
    }

}

?>

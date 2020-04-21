<?php

//Description : This file used to create common db connection for the product
class corecurrencytype {

    //Variable declarations
    var $currency_type_id;
    var $currency_type;
    var $description;
    var $status;

    //Initial values for the variables
    function __construct() {
        $this->currency_type_id = 0;
        $this->currency_type = '';
        $this->description = '';
        $this->status = 'Y';
    }

    //Insert query for the table
    function insertcorecurrencytype() {
        $sql = "insert into core_currency_type values(
                                            $this->currency_type_id,
                                            '$this->currency_type',
                                            '$this->description',
                                            '$this->status'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectcorecurrencytype() {
        $sql = "select
                        *
                from 
                core_currency_type 
                where 1 ";

        if($this->currency_type_id != 0) {
            $sql = $sql . " and currency_type_id = " . $this->currency_type_id;
        }

        if($this->currency_type != '') {
            $sql = $sql . " and currency_type = " . $this->currency_type;
        }

        if($this->description != '') {
            $sql = $sql . " and description = " . $this->description;
        }

        if($this->status != '') {
            $sql = $sql . " and status = " . $this->status;
        }

        return $sql;
    }

    //Update query for the table
    function updatecorecurrencytype() {
        $sql = "update 
                    core_currency_type 
                set";
        $camaa = " ";
        if($this->currency_type != '') {
            $sql = $sql . $camaa." currency_type = " . $this->currency_type;
            $camaa = ", ";
        }

        if($this->description != '') {
            $sql = $sql . $camaa." description = " . $this->description;
            $camaa = ", ";
        }

        if($this->status != '') {
            $sql = $sql . $camaa." status = " . $this->status;
            $camaa = ", ";
        }        

        $sql = $sql . " where ";

        if($this->currency_type_id != 0) {
            $sql = $sql . " currency_type_id = " . $this->currency_type_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletecorecurrencytype() {
        $sql = "delete 
                from 
                    core_currency_type 
                where 1 ";

        if($this->currency_type_id != 0) {
            $sql = $sql . " and currency_type_id = " . $this->currency_type_id;
        }

        if($this->currency_type != '') {
            $sql = $sql . " and currency_type = " . $this->currency_type;
        }

        if($this->description != '') {
            $sql = $sql . " and description = " . $this->description;
        }

        if($this->status != '') {
            $sql = $sql . " and status = " . $this->status;
        }

        return $sql;
    }

}

?>

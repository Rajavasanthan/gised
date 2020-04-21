<?php

//Description : This file used to create common db connection for the product
class coreusertype {

    //Variable declarations
    var $user_type_id;
    var $user_type;

    //Initial values for the variables
    function __construct() {
        $this->user_type_id = 0;
        $this->user_type = '';
    }

    //Insert query for the table
    function insertcoreusertype() {
        $sql = "insert into core_user_type values(
                                            $this->user_type_id,
                                            '$this->user_type'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectcoreusertype() {
        $sql = "select
                        *
                from 
                     core_user_type 
                where 1 ";

        if($this->user_type_id != 0) {
            $sql = $sql . " and user_type_id = " . $this->user_type_id;
        }

        if($this->user_type != '') {
            $sql = $sql . " and user_type = " . $this->user_type;
        }

        return $sql;
    }

    //Update query for the table
    function updatecoreusertype() {
        $sql = "update 
                    core_user_type 
                set"; 
        $camaa = " ";        
        if($this->user_type !='') {
            $sql = $sql . $camaa." user_type = " . $this->user_type;
            $camaa = ", ";
        }        

        $sql = $sql . " where ";

        if($this->user_type_id != 0) {
            $sql = $sql . " user_type_id = " . $this->user_type_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletecoreusertype() {
        $sql = "delete 
                from 
                    core_user_type 
                where 1 ";

        if($this->user_type_id != 0) {
            $sql = $sql . " and user_type_id = " . $this->user_type_id;
        }

        if($this->user_type !='') {
            $sql = $sql . " and user_type = " . $this->user_type;
        }

        return $sql;
    }

}

?>

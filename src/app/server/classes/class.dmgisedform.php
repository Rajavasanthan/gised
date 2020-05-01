<?php

//Description : This file used to create common db connection for the product
class dmgisedform {

    //Variable declarations
    var $gised_form_id;
    var $r_user_id;
    var $r_status_id;
    var $status;

    //Initial values for the variables
    function __construct() {
        $this->gised_form_id = 0;
        $this->r_user_id = 0;
        $this->r_status_id = 0;
        $this->status = '';
    }

    //Insert query for the table
    function insertdmgisedform() {
        $sql = "insert into dm_gised_form values(
                                            $this->gised_form_id,
                                            $this->r_user_id,
                                            $this->r_status_id,
                                            '$this->status'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmgisedform() {
        $sql = "select
                        *
                from 
                        dm_gised_form 
                where 1 ";

        if($this->gised_form_id != 0) {
            $sql = $sql . " and gised_form_id = " . $this->gised_form_id;
        }

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->r_user_id;
        }

        if($this->r_status_id != 0) {
            $sql = $sql . " and r_status_id = " . $this->r_status_id;
        }

        if($this->status != '') {
            $sql = $sql . " and status = '" . $this->status ."'";
        }

        return $sql;
    }

    //Update query for the table
    function updatedmgisedform() {
        $sql = "update 
                        dm_gised_form 
                set";
        $camaa = " ";

        if($this->r_user_id != 0) {
            $sql = $sql . $camaa." r_user_id = " . $this->r_user_id;
            $camaa = ', ';
        }

        if($this->r_status_id != 0) {
            $sql = $sql . $camaa." r_status_id = " . $this->r_status_id;
            $camaa = ', ';
        }

        if($this->status != '') {
            $sql = $sql . $camaa." status = '" . $this->status ."'";
            $camaa = ', ';
        }
        
        $sql = $sql . " where ";

        if($this->gised_form_id != 0) {
            $sql = $sql . " gised_form_id = " . $this->gised_form_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmgisedform() {
        $sql = "delete 
                from 
                    dm_gised_form 
                where 1 ";

                if($this->gised_form_id != 0) {
                    $sql = $sql . " and gised_form_id = " . $this->gised_form_id;
                }
        
                if($this->r_user_id != 0) {
                    $sql = $sql . " and r_user_id = " . $this->r_user_id;
                }
        
                if($this->r_status_id != 0) {
                    $sql = $sql . " and r_status_id = " . $this->r_status_id;
                }
        
                if($this->status != '') {
                    $sql = $sql . " and status = " . $this->status;
                }
                return $sql;
        
    }

}

?>

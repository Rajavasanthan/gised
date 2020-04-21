<?php

//Description : This file used to create common db connection for the product
class dmformdetails {

    //Variable declarations
    var $form_details_id;
    var $form_name;
    var $order_by;

    //Initial values for the variables
    function __construct() {
        $this->form_details_id = 0;
        $this->form_name = '';
        $this->order_by = 0;
    }


    //Insert query for the table
    function insertdmformdetails() {
        $sql = "insert into dm_form_details values(
                                            $this->form_details_id,
                                            '$this->form_name',
                                             $this->order_by
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmformdetails() {
        $sql = "select
                        *
                from 
                dm_form_details 
                where 1 ";

        if($this->form_details_id != 0) {
            $sql = $sql . " and form_details_id = " . $this->form_details_id;
        }

        if($this->form_name != '') {
            $sql = $sql . " and form_name = " . $this->form_name;
        }

        if($this->order_by != 0) {
            $sql = $sql . " and order_by = " . $this->order_by;
        }

        return $sql;
    }

    //Update query for the table
    function updatedmformdetails() {
        $sql = "update 
                    dm_form_details 
                set"; 
        $camaa = " ";

        if($this->form_name != '') {
            $sql = $sql . $camaa." form_name = " . $this->form_name;
            $camaa = ', ';
        }

        if($this->order_by != 0) {
            $sql = $sql . $camaa." order_by = " . $this->order_by;
            $camaa = ', ';
        }        

        $sql = $sql . " where ";

        if($this->form_details_id != 0) {
            $sql = $sql . " form_details_id = " . $this->form_details_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmformdetails() {
        $sql = "delete 
                from 
                    dm_form_details 
                where 1 ";

        if($this->form_details_id != 0) {
            $sql = $sql . " and form_details_id = " . $this->form_details_id;
        }

        if($this->form_name != '') {
            $sql = $sql . " and form_name = " . $this->form_name;
        }

        if($this->order_by != 0) {
            $sql = $sql . " and order_by = " . $this->order_by;
        }

        return $sql;
    }

}

?>

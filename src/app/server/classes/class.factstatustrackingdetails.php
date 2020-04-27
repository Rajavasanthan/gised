<?php

//Description : This file used to create common db connection for the product
class factstatustrackingdetails {

    //Variable declarations
    var $status_tracking_details_id;
    var $r_user_id;
    var $r_application_details_id;
    var $r_form_details_id;
    var $r_form_id;
    var $r_status_id;
    var $approval_by;
    var $status;

    //Initial values for the variables
    function __construct() {
        $this->status_tracking_details_id = 0;
        $this->r_user_id = 0;
        $this->r_application_details_id = 0;
        $this->r_form_details_id = 0;
        $this->r_form_id = 0;
        $this->r_status_id = 0;
        $this->approval_by = 0;
        $this->status = '';
    }

    //Insert query for the table
    function insertfactstatustrackingdetails() {
        $sql = "insert into fact_status_tracking_details values(
                                            $this->status_tracking_details_id,
                                            $this->r_user_id,
                                            $this->r_application_details_id,
                                            $this->r_form_details_id,
                                            $this->r_form_id,
                                            $this->r_status_id,
                                            $this->approval_by,
                                            '$this->status'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectfactstatustrackingdetails() {
        $sql = "select
                        *
                from 
                fact_status_tracking_details 
                where 1 ";

        if($this->status_tracking_details_id != 0) {
            $sql = $sql . " and status_tracking_details_id = " . $this->status_tracking_details_id;
        }

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->r_user_id;
        }
        
        if($this->r_application_details_id != 0) {
            $sql = $sql . " and r_application_details_id = " . $this->r_application_details_id;
        }

        if($this->r_form_details_id != 0) {
            $sql = $sql . " and r_form_details_id = " . $this->r_form_details_id;
        }

        if($this->r_form_id != 0) {
            $sql = $sql . " and r_form_id = " . $this->r_form_id;
        }

        if($this->r_status_id != 0) {
            $sql = $sql . " and r_status_id = " . $this->r_status_id;
        }

        if($this->approval_by != 0) {
            $sql = $sql . " and approval_by = " . $this->approval_by;
        }

        if($this->status != '') {
            $sql = $sql . " and status = " . $this->status;
        }

        return $sql;
    }

    //Update query for the table
    function updatefactstatustrackingdetails() {
        $sql = "update 
                    fact_status_tracking_details 
                set";

        $camaa = " ";        

        if($this->status_tracking_details_id != 0) {
            $sql = $sql . $camaa." status_tracking_details_id = " . $this->status_tracking_details_id;
            $camaa = ', ';
        }


        if($this->r_user_id != 0) {
            $sql = $sql . $camaa." r_user_id = " . $this->r_user_id;
            $camaa = ', ';
        }

        if($this->r_form_details_id != 0) {
            $sql = $sql . $camaa." r_form_details_id = " . $this->r_form_details_id;
            $camaa = ', ';
        }

        if($this->r_form_id != 0) {
            $sql = $sql . $camaa." r_form_id = " . $this->r_form_id;
            $camaa = ', ';
        }

        if($this->r_status_id != 0) {
            $sql = $sql . $camaa." r_status_id = " . $this->r_status_id;
            $camaa = ', ';
        }

        if($this->approval_by != 0) {
            $sql = $sql . $camaa." approval_by = " . $this->approval_by;
            $camaa = ', ';
        } 
        
        $sql = $sql . " where ";

        $camaa = " ";   
        if($this->status_tracking_details_id != 0) {
            $sql = $sql . " status_tracking_details_id = " . $this->status_tracking_details_id;
            $camaa = ', ';
        }

        if($this->status != '') {
            $sql = $sql . " status = '" . $this->status."'";
            $camaa = ', ';
        }

        return $sql;
    }

    //Delete query for the table
    function deletefactstatustrackingdetails() {
        $sql = "delete 
                from 
                    fact_status_tracking_details 
                where 1 ";

        if($this->status_tracking_details_id != 0) {
            $sql = $sql . " and status_tracking_details_id = " . $this->status_tracking_details_id;
        }

        if($this->r_user_id != 0) {
            $sql = $sql . " and r_user_id = " . $this->r_user_id;
        }

        if($this->r_application_details_id != 0) {
            $sql = $sql . " and r_application_details_id = " . $this->r_application_details_id;
        }

        if($this->r_form_details_id != 0) {
            $sql = $sql . " and r_form_details_id = " . $this->r_form_details_id;
        }

        if($this->r_form_id != 0) {
            $sql = $sql . " and r_form_id = " . $this->r_form_id;
        }

        if($this->r_status_id != 0) {
            $sql = $sql . " and r_status_id = " . $this->r_status_id;
        }

        if($this->approval_by != 0) {
            $sql = $sql . " and approval_by = " . $this->approval_by;
        }

        return $sql;
    }


    //Select query for the table
    function getFormStatus() {
        $sql = "select
                        *
                from 
                        fact_status_tracking_details 
                where 
                        1 
                        and status = 'Y' 
                        and r_user_id = " . $this->r_user_id 
                        . " ORDER BY status_tracking_details_id DESC";

        return $sql;
    }


}

?>

<?php

//Description : This file used to create common db connection for the product
class dmformdetailedpresentation {

    //Variable declarations
    var $form_detailed_presentation_id;
    var $uploads;
    var $created_date_time;
    var $updated_date_time;

   //Initial values for the variables
    function __construct() {
        $this->form_detailed_presentation_id = 0;
        $this->uploads = '';
        $this->created_date_time = '0000-00-00 00:00:00';
        $this->updated_date_time = '0000-00-00 00:00:00';
    }

    //Insert query for the table
    function insertdmformdetailedpresentation() {
        $sql = "insert into dm_form_detailed_presentation values(
                                            $this->form_detailed_presentation_id,
                                            '$this->uploads',
                                            '$this->created_date_time',
                                            '$this->updated_date_time'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmformdetailedpresentation() {
        $sql = "select
                        *
                from 
                dm_form_detailed_presentation 
                where 1 ";

        if($this->form_detailed_presentation_id != 0) {
            $sql = $sql . " and form_detailed_presentation_id = " . $this->form_detailed_presentation_id;
        }

        if($this->uploads != '') {
            $sql = $sql . " and uploads = " . $this->uploads;
        }

        return $sql;
    }

    //Update query for the table
    function updatedmformdetailedpresentation() {
        $sql = "update 
                    dm_form_detailed_presentation 
                set"; 
        $camaa = " ";
        if($this->uploads != '') {
            $sql = $sql . $camaa." uploads = " . $this->uploads;
            $camaa = ", ";
        }
        
        $sql = $sql . " where ";
        
        if($this->form_detailed_presentation_id != 0) {
            $sql = $sql . " form_detailed_presentation_id = " . $this->form_detailed_presentation_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmformdetailedpresentation() {
        $sql = "delete 
                from 
                    dm_form_detailed_presentation 
                where 1 ";

        if($this->form_detailed_presentation_id != 0) {
            $sql = $sql . " and form_detailed_presentation_id = " . $this->form_detailed_presentation_id;
        }

        if($this->uploads != '') {
            $sql = $sql . " and uploads = " . $this->uploads;
        }

        return $sql;
    }

}

?>

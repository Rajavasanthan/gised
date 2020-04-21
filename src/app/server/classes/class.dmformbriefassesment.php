<?php

//Description : This file used to create common db connection for the product
class dmformbriefassesment {

    //Variable declarations
    var $form_brief_assesment_id;
    var $full_name;
    var $address;
    var $email_id;
    var $telephone_number;
    var $website_url;
    var $uploads;
    var $created_date_time;
    var $updated_date_time;

   //Initial values for the variables
    function __construct() {
        $this->form_brief_assesment_id = 0;
        $this->full_name = '';
        $this->address = '';
        $this->email_id = '';
        $this->telephone_number = '';
        $this->website_url = '';
        $this->uploads = '';
        $this->created_date_time = '0000-00-00 00:00:00';
        $this->updated_date_time = '0000-00-00 00:00:00';
    }

    //Insert query for the table
    function insertdmformbriefassesment() {
        $sql = "insert into dm_form_brief_assesment values(
                                            $this->form_brief_assesment_id,
                                            '$this->full_name',
                                            '$this->address',
                                            '$this->email_id',
                                            '$this->telephone_number',
                                            '$this->website_url',
                                            '$this->uploads',
                                            '$this->created_date_time',
                                            '$this->updated_date_time'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmformbriefassesment() {
        $sql = "select
                        *
                from 
                dm_form_brief_assesment 
                where 1 ";

        if($this->form_brief_assesment_id != 0) {
            $sql = $sql . " and form_brief_assesment_id = " . $this->form_brief_assesment_id;
        }

        if($this->full_name != '') {
            $sql = $sql . " and full_name = " . $this->full_name;
        }

        if($this->address != '') {
            $sql = $sql . " and address = " . $this->address;
        }

        if($this->email_id != '') {
            $sql = $sql . " and email_id = " . $this->email_id;
        }

        if($this->telephone_number != '') {
            $sql = $sql . " and telephone_number = " . $this->telephone_number;
        }

        if($this->website_url != '') {
            $sql = $sql . " and website_url = " . $this->website_url;
        }

        if($this->uploads != '') {
            $sql = $sql . " and uploads = " . $this->uploads;
        }

        return $sql;
    }

    //Update query for the table
    function updatedmformbriefassesment() {
        $sql = "update 
                    dm_form_brief_assesment 
                set";
        
        $camaa = " ";

        if($this->full_name != '') {
            $sql = $sql . $camaa. " full_name = " . $this->full_name;
            $camaa = ', ';
        }

        if($this->address != '') {
            $sql = $sql .$camaa . " address = " . $this->address;
            $camaa = ', ';
        }

        if($this->email_id != '') {
            $sql = $sql . $camaa. " email_id = " . $this->email_id;
            $camaa = ', ';
        }

        if($this->telephone_number != '') {
            $sql = $sql . $camaa." telephone_number = " . $this->telephone_number;
            $camaa = ', ';
        }

        if($this->website_url != '') {
            $sql = $sql . $camaa." website_url = " . $this->website_url;
            $camaa = ', ';
        }

        if($this->uploads != '') {
            $sql = $sql . $camaa." uploads = " . $this->uploads;
            $camaa = ', ';
        }        
        
        $sql = $sql . " where ";

        if($this->form_brief_assesment_id != 0) {
            $sql = $sql . " form_brief_assesment_id = " . $this->form_brief_assesment_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmformbriefassesment() {
        $sql = "delete 
                from 
                    dm_form_brief_assesment 
                where 1 ";

        if($this->form_brief_assesment_id != 0) {
            $sql = $sql . " and form_brief_assesment_id = " . $this->form_brief_assesment_id;
        }

        if($this->full_name != '') {
            $sql = $sql . " and full_name = " . $this->full_name;
        }

        if($this->address != '') {
            $sql = $sql . " and address = " . $this->address;
        }

        if($this->email_id != '') {
            $sql = $sql . " and email_id = " . $this->email_id;
        }

        if($this->telephone_number != '') {
            $sql = $sql . " and telephone_number = " . $this->telephone_number;
        }

        if($this->website_url != '') {
            $sql = $sql . " and website_url = " . $this->website_url;
        }

        if($this->uploads != '') {
            $sql = $sql . " and uploads = " . $this->uploads;
        }
        

        return $sql;
    }

}

?>

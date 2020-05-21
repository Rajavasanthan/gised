<?php

//Description : This file used to create common db connection for the product
class dmuser {

    //Variable declarations
    var $user_id;
    var $email_id;
    var $mobile_no;
    var $title;
    var $first_name;
    var $last_name;
    var $gender;
    var $age;
    var $communication_address;
    var $permanent_address;
    var $activation_status;
    var $r_state_id;
    var $r_country_id;
    var $field_of_activity;
    var $date_of_foundation;
    var $created_date_time;
    var $updated_date_time;

    //Initial values for the variables
    function __construct() {
        $this->user_id = 0;
        $this->email_id = '';
        $this->mobile_no = '';
        $this->title = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->gender = 'Nil';
        $this->age = '';
        $this->communication_address = '';
        $this->permanent_address = '';
        $this->activation_status = '';
        $this->r_state_id = 0;
        $this->r_country_id = 1;
        $this->field_of_activity = '0';
        $this->date_of_foundation = '0000-00-00';
        $this->created_date_time = '0000-00-00 00:00:00';
        $this->updated_date_time = '0000-00-00 00:00:00';
    }

    //Insert query for the table
    function insertdmuser() {
        $sql = "insert into dm_user values(
                                            $this->user_id,
                                            '$this->email_id',
                                            '$this->mobile_no',
                                            '$this->title',
                                            '$this->first_name',
                                            '$this->last_name',
                                            '$this->gender',
                                            '$this->age',
                                            '$this->communication_address',
                                            '$this->permanent_address',
                                            '$this->activation_status',
                                             $this->r_state_id,
                                             $this->r_country_id,
                                            '$this->field_of_activity',
                                            '$this->date_of_foundation',
                                            '$this->created_date_time',
                                            '$this->updated_date_time'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmuser() {
        $sql = "select
                        *
                from 
                dm_user 
                where 1 ";

        if($this->user_id != 0) {
            $sql = $sql . " and user_id = " . $this->user_id;
        }
        
        if($this->email_id != '') {
            $sql = $sql . " and email_id = '" . $this->email_id ."'";
        }

        if($this->mobile_no != '') {
            $sql = $sql . " and mobile_no = " . $this->mobile_no;
        }

        if($this->title != '') {
            $sql = $sql . " and title = " . $this->title;
        }

        if($this->first_name != '') {
            $sql = $sql . " and first_name = " . $this->first_name;
        }

        if($this->last_name != '') {
            $sql = $sql . " and last_name = " . $this->last_name;
        }

        if($this->gender != 'Nil') {
            $sql = $sql . " and gender = " . $this->gender;
        }

        if($this->age != '') {
            $sql = $sql . " and age = " . $this->age;
        }

        if($this->communication_address != '') {
            $sql = $sql . " and communication_address = " . $this->communication_address;
        }

        if($this->permanent_address != '') {
            $sql = $sql . " and permanent_address = " . $this->permanent_address;
        }

        if($this->activation_status != '') {
            $sql = $sql . " and activation_status = " . $this->activation_status;
        }

        if($this->r_state_id != 0) {
            $sql = $sql . " and r_state_id = " . $this->r_state_id;
        }

        if($this->r_country_id != 1) {
            $sql = $sql . " and r_country_id = " . $this->r_country_id;
        }

        if($this->field_of_activity != '0') {
            $sql = $sql . " and field_of_activity = " . $this->field_of_activity;
        }

        if($this->date_of_foundation != '0000-00-00') {
            $sql = $sql . " and date_of_foundation = " . $this->date_of_foundation;
        }
       
        return $sql;//stripcslashes($sql);
    }

    //Update query for the table
    function updatedmuser() {
        $sql = "update 
                    dm_user 
                set";

        $camaa = " ";        

        if($this->mobile_no != '') {
            $sql = $sql . $camaa." mobile_no = '" . $this->mobile_no . "'";
            $camaa = ', ';
        }

        if($this->title != '') {
            $sql = $sql . $camaa." title = '" . $this->title . "'";
            $camaa = ', ';
        }

        if($this->first_name != '') {
            $sql = $sql . $camaa." first_name = '" . $this->first_name . "'";
            $camaa = ', ';
        }

        if($this->last_name != '') {
            $sql = $sql . $camaa." last_name = '" . $this->last_name . "'";
            $camaa = ', ';
        }

        if($this->gender != 'Nil') {
            $sql = $sql . $camaa." gender = '" . $this->gender . "'";
            $camaa = ', ';
        }

        if($this->age != '') {
            $sql = $sql . $camaa." age = '" . $this->age . "'";
            $camaa = ', ';
        }

        if($this->communication_address != '') {
            $sql = $sql . $camaa." communication_address = '" . $this->communication_address . "'";
            $camaa = ', ';
        }

        if($this->permanent_address != '') {
            $sql = $sql . $camaa." permanent_address = '" . $this->permanent_address . "'";
            $camaa = ', ';
        }

        if($this->activation_status != '') {
            $sql = $sql . $camaa." activation_status = '" . $this->activation_status . "'";
            $camaa = ', ';
        }

        if($this->r_state_id != 0) {
            $sql = $sql . $camaa." r_state_id = " . $this->r_state_id;
            $camaa = ', ';
        }

        if($this->r_country_id != 1) {
            $sql = $sql . $camaa." r_country_id = " . $this->r_country_id;
            $camaa = ', ';
        }

        if($this->field_of_activity != '0') {
            $sql = $sql . $camaa." field_of_activity = '" . $this->field_of_activity . "'";
            $camaa = ', ';
        }

        if($this->date_of_foundation != '0000-00-00') {
            $sql = $sql . $camaa." date_of_foundation = '" . $this->date_of_foundation . "'";
            $camaa = ', ';
        }

        $sql = $sql . " where ";

        if($this->user_id != 0) {
            $sql = $sql . " user_id = " . $this->user_id;
        }
        if($this->email_id != '') {
            $sql = $sql . " email_id = '" . $this->email_id . "'";
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmuser() {
        $sql = "delete 
                from 
                    dm_user 
                where 1 ";

        if($this->user_id != 0) {
            $sql = $sql . " and user_id = " . $this->user_id;
        }

        if($this->email_id != '') {
            $sql = $sql . " and email_id = " . $this->email_id;
        }

        if($this->mobile_no != '') {
            $sql = $sql . " and mobile_no = " . $this->mobile_no;
        }

        if($this->title != '') {
            $sql = $sql . " and title = " . $this->title;
        }

        if($this->first_name != '') {
            $sql = $sql . " and first_name = " . $this->first_name;
        }

        if($this->last_name != '') {
            $sql = $sql . " and last_name = " . $this->last_name;
        }

        if($this->gender != '') {
            $sql = $sql . " and gender = " . $this->gender;
        }

        if($this->age != '') {
            $sql = $sql . " and age = " . $this->age;
        }

        if($this->communication_address != '') {
            $sql = $sql . " and communication_address = " . $this->communication_address;
        }

        if($this->permanent_address != '') {
            $sql = $sql . " and permanent_address = " . $this->permanent_address;
        }

        if($this->activation_status != '') {
            $sql = $sql . " and activation_status = " . $this->activation_status;
        }

        if($this->r_state_id != 0) {
            $sql = $sql . " and r_state_id = " . $this->r_state_id;
        }

        if($this->r_country_id != 1) {
            $sql = $sql . " and r_country_id = " . $this->r_country_id;
        }

        if($this->field_of_activity != '0') {
            $sql = $sql . " and field_of_activity = " . $this->field_of_activity;
        }

        if($this->date_of_foundation != '0000-00-00') {
            $sql = $sql . " and date_of_foundation = " . $this->date_of_foundation;
        }

        return $sql;
    }

}

?>

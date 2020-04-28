<?php

//Description : This file used to create common db connection for the product
class dmformfirstcontact {

    //Variable declarations
    var $form_first_contact_id;
    var $first_name;
    var $last_name;
    var $email_id;
    var $organization_name;
    var $org_details;
    var $sign_up_for_emails;
    var $r_source_id;
    var $brief_idea;
    var $explained_idea;
    var $about_group;
    var $created_date_time;
    var $updated_date_time;

    //Initial values for the variables
    function __construct() {
        $this->form_first_contact_id = 0;
        $this->first_name = '';
        $this->last_name = '';
        $this->email_id = '';
        $this->organization_name = '';
        $this->org_details = '';
        $this->sign_up_for_emails = '';
        $this->r_source_id = '';
        $this->brief_idea = '';
        $this->explained_idea = '';
        $this->about_group = '';
        $this->created_date_time = '0000-00-00 00:00:00';
        $this->updated_date_time = '0000-00-00 00:00:00';
    }

    //Insert query for the table
    function insertdmformfirstcontact() {
        $sql = "insert into dm_form_first_contact values(
                                            $this->form_first_contact_id,
                                            '$this->first_name',
                                            '$this->last_name',
                                            '$this->email_id',
                                            '$this->organization_name',
                                            '$this->org_details',
                                            '$this->sign_up_for_emails',
                                            compress('$this->r_source_id'),
                                            '$this->brief_idea',
                                            '$this->explained_idea',
                                            '$this->about_group',
                                            now(),
                                            now()
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmformfirstcontact() {
        $sql = "select
                        *,
                        uncompress(r_source_id) as r_source_id 
                from 
                dm_form_first_contact 
                where 1 ";

        if($this->form_first_contact_id != 0) {
            $sql = $sql . " and form_first_contact_id = " . $this->form_first_contact_id;
        }

        if($this->first_name != '') {
            $sql = $sql . " and first_name = " . $this->first_name;
        }

        if($this->last_name != '') {
            $sql = $sql . " and last_name = " . $this->last_name;
        }

        if($this->email_id != '') {
            $sql = $sql . " and email_id = " . $this->email_id;
        }

        if($this->organization_name != '') {
            $sql = $sql . " and organization_name = " . $this->organization_name;
        }

        if($this->org_details != '') {
            $sql = $sql . " and org_details = " . $this->org_details;
        }

        if($this->sign_up_for_emails != '') {
            $sql = $sql . " and sign_up_for_emails = " . $this->sign_up_for_emails;
        }

        if($this->r_source_id != '') {
            $sql = $sql . " and r_source_id = " . $this->r_source_id;
        }

        if($this->brief_idea != '') {
            $sql = $sql . " and brief_idea = " . $this->brief_idea;
        }

        if($this->explained_idea != '') {
            $sql = $sql . " and explained_idea = " . $this->explained_idea;
        }

        if($this->about_group != '') {
            $sql = $sql . " and about_group = " . $this->about_group;
        }

        return $sql;
    }

    //Update query for the table
    function updatedmformfirstcontact() {
        $sql = "update 
                    dm_form_first_contact 
                set"; 
        
        $camaa = " ";        
        if($this->first_name != '') {
            $sql = $sql .$camaa. " first_name = '" . $this->first_name ."'";
            $camaa = ', ';
        }

        if($this->last_name != '') {
            $sql = $sql .$camaa. " last_name = '" . $this->last_name ."'";
            $camaa = ', ';
        }

        if($this->email_id != '') {
            $sql = $sql .$camaa. " email_id = '" . $this->email_id ."'";
            $camaa = ', ';
        }

        if($this->organization_name != '') {
            $sql = $sql . $camaa." organization_name = '" . $this->organization_name ."'";
            $camaa = ', ';
        }

        if($this->org_details != '') {
            $sql = $sql . $camaa." org_details = '" . $this->org_details ."'";
            $camaa = ', ';
        }

        if($this->sign_up_for_emails != '') {
            $sql = $sql . $camaa." sign_up_for_emails = '" . $this->sign_up_for_emails ."'";
            $camaa = ', ';
        }

        if($this->r_source_id != '') {
            $sql = $sql . $camaa." r_source_id = compress('" . $this->r_source_id ."')";
            $camaa = ', ';
        }

        if($this->brief_idea != '') {
            $sql = $sql . $camaa." brief_idea = '" . $this->brief_idea ."'";
            $camaa = ', ';
        }

        if($this->explained_idea != '') {
            $sql = $sql . $camaa." explained_idea = '" . $this->explained_idea ."'";
            $camaa = ', ';
        }

        if($this->about_group != '') {
            $sql = $sql . $camaa." about_group = '" . $this->about_group ."'";
            $camaa = ', ';
        }

        $sql = $sql . " where ";
                
        if($this->form_first_contact_id != 0) {
            $sql = $sql . " form_first_contact_id = " . $this->form_first_contact_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmformfirstcontact() {
        $sql = "delete 
                from 
                    dm_form_first_contact 
                where 1 ";

        if($this->form_first_contact_id != 0) {
            $sql = $sql . " and form_first_contact_id = " . $this->form_first_contact_id;
        }

        if($this->first_name != '') {
            $sql = $sql . " and first_name = " . $this->first_name;
        }

        if($this->last_name != '') {
            $sql = $sql . " and last_name = " . $this->last_name;
        }

        if($this->email_id != '') {
            $sql = $sql . " and email_id = " . $this->email_id;
        }

        if($this->organization_name != '') {
            $sql = $sql . " and organization_name = " . $this->organization_name;
        }

        if($this->org_details != '') {
            $sql = $sql . " and org_details = " . $this->org_details;
        }

        if($this->sign_up_for_emails != '') {
            $sql = $sql . " and sign_up_for_emails = " . $this->sign_up_for_emails;
        }

        if($this->r_source_id != '') {
            $sql = $sql . " and r_source_id = " . $this->r_source_id;
        }

        if($this->brief_idea != '') {
            $sql = $sql . " and brief_idea = " . $this->brief_idea;
        }

        if($this->explained_idea != '') {
            $sql = $sql . " and explained_idea = " . $this->explained_idea;
        }

        if($this->about_group != '') {
            $sql = $sql . " and about_group = " . $this->about_group;
        }

        return $sql;
    }

}

?>

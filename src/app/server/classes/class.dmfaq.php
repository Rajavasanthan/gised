<?php

//Description : This file used to create common db connection for the product
class dmfaq {

    //Variable declarations
    var $faq_id;
    var $question;
    var $answer;
    var $status;

    //Initial values for the variables
    function __construct() {
        $this->faq_id = 0;
        $this->question = '';
        $this->answer = '';
        $this->status = '';
    }

    //Insert query for the table
    function insertdmfaq() {
        $sql = "insert into dm_faq values(
                                            $this->faq_id,
                                            '$this->question',
                                            '$this->answer',
                                            '$this->status'
                                            )";

        return $sql;
    }

    //Select query for the table
    function selectdmfaq() {
        $sql = "select
                        *
                from 
                dm_faq 
                where 1 ";

        if($this->faq_id != 0) {
            $sql = $sql . " and faq_id = " . $this->faq_id;
        }

        if($this->question != '') {
            $sql = $sql . " and question = " . $this->question;
        }

        if($this->answer != '') {
            $sql = $sql . " and answer = " . $this->answer;
        }


        if($this->status != '') {
            $sql = $sql . " and status = '" . $this->status ."'";
        }

        return $sql;
    }

    //Update query for the table
    function updatedmfaq() {
        $sql = "update 
                    dm_faq 
                set ";

        $camaa = " ";
        if($this->question != '') {
            $sql = $sql . $camaa . " question = " . $this->question;
            $camaa = ', ';
        }

        if($this->answer != '') {
            $sql = $sql . $camaa . " answer = " . $this->answer;
            $camaa = ', ';
        }

        if($this->status != '') {
            $sql = $sql . $camaa . " status = " . $this->status;
            $camaa = ', ';
        }
        
        $sql = $sql . " where ";

        if($this->faq_id != 0) {
            $sql = $sql . " faq_id = " . $this->faq_id;
        }

        return $sql;
    }

    //Delete query for the table
    function deletedmfaq() {
        $sql = "delete 
                from 
                    dm_faq 
                where 1 ";

        if($this->faq_id != 0) {
            $sql = $sql . " and faq_id = " . $this->faq_id;
        }

        if($this->question != '') {
            $sql = $sql . " and question = " . $this->question;
        }

        if($this->answer != '') {
            $sql = $sql . " and answer = " . $this->answer;
        }

        if($this->status != '') {
            $sql = $sql . " and status = " . $this->status;
        }

        return $sql;
    }

}

?>

<?php

    require_once "lib/common/class.sendMail.php";
    
    class userProfile {

        var $action;
        var $input;
        var $output;
        var $commonObj;

        function __construct($angularRequest) {
            $this->commonObj = new commonFunction();
            $this->action = "";
            $this->output = array();
        }

        function executeModule() {
            switch($this->action) {
                case 'showprofile':
                    $this->showProfileAction();
                    break;
                default:
                    $this->defaultAction();
            }
        }

        function showProfileAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);

            $this->output = $result[0];

        }

        function defaultAction() {
            $this->output = "I am defaultAction. I got called successfully :)";
        }

        function getModuleOutput() {
            return $this->output;
        }

    }

?>
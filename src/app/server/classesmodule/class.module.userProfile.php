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
            $userResult = dbConnection::selectQuery($sql);
            $userId = $userResult[0]['user_id'];

            require_once "classes/class.corecountrydetails.php";
            $countryObj = new corecountrydetails();
            $countryObj->country_id = $userResult[0]['r_country_id'];
            $sql = $countryObj->selectcorecountrydetails();
            $result = dbConnection::selectQuery($sql);
            $userResult[0]['country_name'] = $result[0]['country_name'];

            foreach($userResult AS $key => $value) {
                foreach($value AS $innerKey => $innerValue) {
                    $this->output['loggedProfile'][$innerKey] = $innerValue;
                }
            }

            require_once "classes/class.dmapplicationdetails.php";
            $applicationObj = new dmapplicationdetails();
            $sql = $applicationObj->selectdmapplicationdetails();
            $result = dbConnection::selectQuery($sql);
            $this->output['applications'] = $result;
            

            require_once "classes/class.dmsource.php";
            $sourceObj = new dmsource();
            $sql = $sourceObj->selectdmsource();
            $result = dbConnection::selectQuery($sql);
            $this->output['sources'] = $result;

            require_once "classes/class.factstatustrackingdetails.php";
            $factTrackObj = new factstatustrackingdetails();
            $factTrackObj->r_user_id = $userId;
            $sql = $factTrackObj->selectfactstatustrackingdetailsUsingForStatus();
            $result = dbConnection::selectQuery($sql);
            
            if(isset($result[0]['r_status_id'])) {
                if($result[0]['r_status_id'] == 1) {
                    $this->output['status'] = "Approved";
                } else if($result[0]['r_status_id'] == 2) {
                    $this->output['status'] = "Awaiting Approval";
                }else if($result[0]['r_status_id'] == 3) {
                    $this->output['status'] = "Draft";
                }else{
                    $this->output['status'] = "Hold";
                }
            } else {
                $this->output['status'] = "NILL";
            }
        
        }


        function defaultAction() {
            $this->output = "I am defaultAction. I got called successfully :)";
        }

        function getModuleOutput() {
            return $this->output;
        }

    }

?>
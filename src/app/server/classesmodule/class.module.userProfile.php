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
            $applicationObj->status = 'Y';
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
            $sql = $factTrackObj->getFormStatus();
            $result = dbConnection::selectQuery($sql);
            $this->output['presentFormNo'] = $result[0]['r_form_details_id'];

            if($result[0]['r_form_details_id'] == 1) {
                $this->getFirstContactForm($result[0]['r_form_id']);
            } else if($result[0]['r_form_details_id'] == 2) {
                $this->getBriefAssesmentForm($result[0]['r_form_id']);
            } else if($result[0]['r_form_details_id'] == 3) {
                $this->getDetailedPresentationForm($result[0]['r_form_id']);
            } else if($result[0]['r_form_details_id'] == 4) {
                $this->getFinalApprovalForm($result[0]['r_form_id']);
            } else {
                $this->output['presentFormNo'] = 1;
                $this->output['action'] = 'firstcontactforminsertion';
            }

            if(isset($result[0]['r_status_id'])) {
                require_once "classes/class.dmstatus.php";
                $dmStatusObj = new dmStatus();
                $dmStatusObj->status_id = $result[0]['r_status_id'];
                $sql = $dmStatusObj->selectdmstatus();
                $result = dbConnection::selectQuery($sql);
                $this->output['status'] = $result[0]['status_value'];
            } else {
                $this->output['status'] = "Nil";
            }
        
        }

        function getFirstContactForm($formId) {

            require_once "classes/class.dmformfirstcontact.php";
            $firstFormObj = new dmformfirstcontact();
            $firstFormObj->form_first_contact_id = $formId;
            $sql = $firstFormObj->selectdmformfirstcontact();
            $result = dbConnection::selectQuery($sql);

            $this->output['sql'] = $sql;
            foreach($result AS $key => $value) {
                foreach($value AS $innerKey => $innerValue) {
                    $this->output['firstContactForm'][$innerKey] = $innerValue;
                }
            }

        }

        function getBriefAssesmentForm() {
            //briefAssesmentForm
        }

        function getDetailedPresentationForm() {
            //detailedPresentationForm
        }

        function getFinalApprovalForm() {
            //finalApprovalForm
        }

        function defaultAction() {
            $this->output = "I am defaultAction. I got called successfully :)";
        }

        function getModuleOutput() {
            return $this->output;
        }

    }

?>
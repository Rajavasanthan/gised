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
            
            require_once "classes/class.factstatustrackingdetails.php";
            $factTrackObj = new factstatustrackingdetails();
            $factTrackObj->r_user_id = $userId;
            $sql = $factTrackObj->getFormStatus();
            $result = dbConnection::selectQuery($sql);

            $this->output['close']['firstContactFormClose'] = 'OPEN';
            $this->output['close']['briefAssesmentFormClose'] = 'OPEN';
            $this->output['close']['detailedPresentationFormClose'] = 'OPEN';
            if($result[0]['r_form_details_id'] == 1 && $result[0]['r_status_id'] == 3) {
                $this->getFirstContactForm($result[0]['r_form_id']);
                $this->setFormNoAndAction(1, 'firstcontactformupdation');
            } else if($result[0]['r_form_details_id'] == 1 && $result[0]['r_status_id'] == 2) {
                $this->getFirstContactForm($result[0]['r_form_id']);
                $this->setFormNoAndAction(0, 'Nil');
            } else if($result[0]['r_form_details_id'] == 1 && $result[0]['r_status_id'] == 1) {
                $this->getFirstContactForm($result[1]['r_form_id']);
                $this->setFormNoAndAction(2, 'briefassesmentforminsertion');
                $this->output['close']['firstContactFormClose'] = 'CLOSE';
            } else if($result[0]['r_form_details_id'] == 2 && $result[0]['r_status_id'] == 3) {
                $this->getFirstContactForm($result[1]['r_form_id']);
                $this->getBriefAssesmentForm($result[0]['r_form_id']);
                $this->setFormNoAndAction(2, 'briefassesmentformupdation');
                $this->output['close']['firstContactFormClose'] = 'CLOSE';
            } else if($result[0]['r_form_details_id'] == 2 && $result[0]['r_status_id'] == 2) {
                $this->getFirstContactForm($result[1]['r_form_id']);
                $this->getBriefAssesmentForm($result[0]['r_form_id']);
                $this->setFormNoAndAction(0, 'Nil');
                $this->output['close']['firstContactFormClose'] = 'CLOSE';
            } else if($result[0]['r_form_details_id'] == 2 && $result[0]['r_status_id'] == 1) {
                $this->getFirstContactForm($result[1]['r_form_id']);
                $this->getBriefAssesmentForm($result[0]['r_form_id']);
                $this->setFormNoAndAction(3, 'detailedpresentationforminsertion');
                $this->output['close']['firstContactFormClose'] = 'CLOSE';
                $this->output['close']['briefAssesmentFormClose'] = 'CLOSE';
            } else if($result[0]['r_form_details_id'] == 3 && $result[0]['r_status_id'] == 3) {
                $this->getFirstContactForm($result[2]['r_form_id']);
                $this->getBriefAssesmentForm($result[1]['r_form_id']);
                $this->getDetailedPresentationForm($result[0]['r_form_id']);
                $this->setFormNoAndAction(3, 'detailedpresentationformupdation');
                $this->output['close']['firstContactFormClose'] = 'CLOSE';
                $this->output['close']['briefAssesmentFormClose'] = 'CLOSE';
            } else if($result[0]['r_form_details_id'] == 3 && $result[0]['r_status_id'] == 2) {
                $this->getFirstContactForm($result[2]['r_form_id']);
                $this->getBriefAssesmentForm($result[1]['r_form_id']);
                $this->getDetailedPresentationForm($result[0]['r_form_id']);
                $this->setFormNoAndAction(0, 'Nil');
                $this->output['close']['firstContactFormClose'] = 'CLOSE';
                $this->output['close']['briefAssesmentFormClose'] = 'CLOSE';
            } else if($result[0]['r_form_details_id'] == 3 && $result[0]['r_status_id'] == 1) {
                $this->getFirstContactForm($result[2]['r_form_id']);
                $this->getBriefAssesmentForm($result[1]['r_form_id']);
                $this->getDetailedPresentationForm($result[0]['r_form_id']);
                $this->setFormNoAndAction(4, 'finalapprovalforminsertion');
                $this->output['close']['firstContactFormClose'] = 'CLOSE';
                $this->output['close']['briefAssesmentFormClose'] = 'CLOSE';
                $this->output['close']['detailedPresentationFormClose'] = 'CLOSE';
            } else if($result[0]['r_form_details_id'] == 4) {
                $this->getFirstContactForm($result[3]['r_form_id']);
                $this->getBriefAssesmentForm($result[2]['r_form_id']);
                $this->getDetailedPresentationForm($result[1]['r_form_id']);
                $this->getFinalApprovalForm($result[0]['r_form_id']);
                $this->setFormNoAndAction(4, 'finalapprovalforminsertion');
                $this->output['close']['firstContactFormClose'] = 'CLOSE';
                $this->output['close']['briefAssesmentFormClose'] = 'CLOSE';
                $this->output['close']['detailedPresentationFormClose'] = 'CLOSE';
            } else {
                $this->setFormNoAndAction(1, 'firstcontactforminsertion');
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

        function setFormNoAndAction($formNo, $action) {

            $this->output['presentFormNo'] = $formNo;
            $this->output['action'] = $action;

        }

        function getFirstContactForm($formId) {

            require_once "classes/class.dmformfirstcontact.php";
            $firstFormObj = new dmformfirstcontact();
            $firstFormObj->form_first_contact_id = $formId;
            $sql = $firstFormObj->selectdmformfirstcontact();
            $result = dbConnection::selectQuery($sql);

            foreach($result AS $key => $value) {
                foreach($value AS $innerKey => $innerValue) {
                    $this->output['firstContactForm'][$innerKey] = $innerValue;
                }
            }

        }

        function getBriefAssesmentForm($formId) {
            
            require_once "classes/class.dmformbriefassesment.php";
            $briefAssesObj = new dmformbriefassesment();
            $briefAssesObj->form_brief_assesment_id = $formId;
            $sql = $briefAssesObj->selectdmformbriefassesment();
            $result = dbConnection::selectQuery($sql);

            foreach($result AS $key => $value) {
                foreach($value AS $innerKey => $innerValue) {
                    $this->output['briefAssesmentForm'][$innerKey] = $innerValue;
                }
            }

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
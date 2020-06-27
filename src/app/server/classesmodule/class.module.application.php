<?php

    require_once "lib/common/class.sendMail.php";
    
    class application {

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
                case 'firstcontactforminsertion':
                    $this->firstContactInsertionAction();
                    break;
                case 'firstcontactformupdation':
                    $this->firstContactUpdationAction();
                    break;
                case 'briefassesmentforminsertion':
                    $this->briefAssesmentFormInsertionAction();
                    break;
                case 'briefassesmentformupdation':
                    $this->briefAssesmentFormUpdationAction();
                    break;
                case 'detailedpresentationforminsertion':
                    $this->detailedPresentationFormInsertionAction();
                    break;
                case 'detailedpresentationformupdation':
                    $this->detailedPresentationFormUpdationAction();
                    break;
                case 'finalapprovalforminsertion':
                    $this->finalApprovalFormInsertionAction();
                    break;
                case 'approverprocess':
                    $this->approverProcessAction();
                    break;
                default:
                    $this->defaultAction();
            }
        }

        function approverProcessAction() {

            if($this->input['process'] == "APPROVE") {
                $this->updateApproverAction($this->input['statusTrackingDetailsId'], 1, $this->input['approvalBy']);
            } else if($this->input['process'] == "REJECT") {
                $this->updateApproverAction($this->input['statusTrackingDetailsId'], 6, $this->input['approvalBy']);
            } else if($this->input['process'] == "DRAFT") {
                $this->updateApproverAction($this->input['statusTrackingDetailsId'], 3, $this->input['approvalBy']);
            }
            $this->mailForApproerAction();
            $this->output['userMsg'] = $this->input['userMsg'];
            $this->output['emailId'] = $this->input['loggedEmailId'];
                        
        }

        function updateApproverAction($factStatusTrackingId, $status, $approvalBy) {

            require_once "classes/class.factstatustrackingdetails.php";
            $trackObj = new factstatustrackingdetails();
            $trackObj->r_gised_id = ($this->input['process'] == 'REJECT') ? $this->input['gisedId'] : 0 ;
            $trackObj->status_tracking_details_id = ($this->input['process'] == 'REJECT') ? 0 : $factStatusTrackingId ;
            $trackObj->status = ($this->input['process'] == 'REJECT') ? 'N' : 'Y' ;
            $trackObj->r_status_id = ($this->input['presentFormNo'] == 4) ? 5 : $status ;
            $trackObj->approval_by = $approvalBy;
            $sql = $trackObj->updatefactstatustrackingdetails();
            $result = dbConnection::updateQuery($sql);

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->gised_form_id = $this->input['gisedId'];
            $gisedObj->r_user_id = $this->input['userId'];
            $gisedObj->r_status_id = ($this->input['presentFormNo'] == 4) ? 5 : $status ;
            if($status == 6) {
                $gisedObj->status = 'N'; 
            } else if($status == 1 && $this->input['presentFormNo'] == 4) {
                $gisedObj->status = 'C'; 
            } else {
                $gisedObj->status = 'Y';    
            }
            $sql = $gisedObj->updatedmgisedform();
            $result = dbConnection::updateQuery($sql);

        }

        function firstContactInsertionAction() {

            $this->output['emailId'] = $this->input['emailId'];

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $this->output['sql'] = $sql;
            $this->output['result'] = $result;
            $user_id = $result[0]['user_id'];

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->r_user_id = $user_id;
            $gisedObj->r_status_id = $this->input['status'];
            $gisedObj->status = 'Y';
            $sql = $gisedObj->insertdmgisedform();
            $result = dbConnection::insertQuery($sql);
            $gisedId = dbConnection::$dbObj->insert_id;
            $this->output['GISEDFORM'] = $sql;

            require_once "classes/class.dmformfirstcontact.php";
            $dmfirstcontactObj = new dmformfirstcontact();
            $dmfirstcontactObj->first_name = $this->commonObj->escapeMysqlSpecialString($this->input['firstName']);
            $dmfirstcontactObj->last_name = $this->commonObj->escapeMysqlSpecialString($this->input['lastName']);
            $dmfirstcontactObj->email_id = $this->commonObj->escapeMysqlSpecialString($this->input['email']);
            $dmfirstcontactObj->organization_name = $this->commonObj->escapeMysqlSpecialString($this->input['organizationName']);
            $dmfirstcontactObj->org_details = $this->commonObj->escapeMysqlSpecialString($this->input['orgDetails']);
            $dmfirstcontactObj->sign_up_for_emails = ($this->input['signUpEmail']) ? 'Y' : 'N' ;
            $dmfirstcontactObj->r_source_id = json_encode($this->input['sourceValue']);
            $dmfirstcontactObj->brief_idea = $this->commonObj->escapeMysqlSpecialString($this->input['describeIdea1']);
            $dmfirstcontactObj->explained_idea = $this->commonObj->escapeMysqlSpecialString($this->input['describeIdea2']);
            $dmfirstcontactObj->about_group = $this->commonObj->escapeMysqlSpecialString($this->input['describeIdea3']);
            $sql = $dmfirstcontactObj->insertdmformfirstcontact();
            $result = dbConnection::insertQuery($sql);
            $dmfirstcontactId = dbConnection::$dbObj->insert_id;
            $this->output['sathees'] = $sql;

            require_once "classes/class.factstatustrackingdetails.php";
            $trackObj = new factstatustrackingdetails();
            $trackObj->r_gised_id = $gisedId;
            $trackObj->r_user_id = $user_id;
            $trackObj->r_application_details_id = 1;
            $trackObj->r_form_details_id = 1;
            $trackObj->r_form_id = $dmfirstcontactId;
            $trackObj->r_status_id = $this->input['status'];
            $trackObj->approval_by = 0;
            $trackObj->status = 'Y';
            $sql = $trackObj->insertfactstatustrackingdetails();
            $result = dbConnection::insertQuery($sql);

            if($this->input['status'] == 3) {
                $this->setFormNoActionMsg(1, 'firstcontactformupdation', 'First contact form saved successfully', $this->input['status']);
            } else if($this->input['status'] == 2) {
                $this->setFormNoActionMsg(0, '', 'First contact form submited to approver successfully', $this->input['status']);
            }

        }   

        function firstContactUpdationAction() {

            $this->output['emailId'] = $this->input['emailId'];

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $userId = $result[0]['user_id'];

            require_once "classes/class.factstatustrackingdetails.php";
            $factTrackObj = new factstatustrackingdetails();
            $factTrackObj->r_user_id = $userId;
            $sql = $factTrackObj->getFormStatus();
            $result = dbConnection::selectQuery($sql);
            $statusTrackingId = $result[0]['status_tracking_details_id'];
            $gisedId = $result[0]['r_gised_id'];

            require_once "classes/class.dmformfirstcontact.php";
            $dmfirstcontactObj = new dmformfirstcontact();
            $dmfirstcontactObj->first_name = $this->commonObj->escapeMysqlSpecialString($this->input['firstName']);
            $dmfirstcontactObj->last_name = $this->commonObj->escapeMysqlSpecialString($this->input['lastName']);
            $dmfirstcontactObj->email_id = $this->commonObj->escapeMysqlSpecialString($this->input['email']);
            $dmfirstcontactObj->organization_name = $this->commonObj->escapeMysqlSpecialString($this->input['organizationName']);
            $dmfirstcontactObj->org_details = $this->commonObj->escapeMysqlSpecialString($this->input['orgDetails']);
            $dmfirstcontactObj->sign_up_for_emails = ($this->input['signUpEmail']) ? 'Y' : 'N' ;
            $dmfirstcontactObj->r_source_id = json_encode($this->input['sourceValue']);
            $dmfirstcontactObj->brief_idea = $this->commonObj->escapeMysqlSpecialString($this->input['describeIdea1']);
            $dmfirstcontactObj->explained_idea = $this->commonObj->escapeMysqlSpecialString($this->input['describeIdea2']);
            $dmfirstcontactObj->about_group = $this->commonObj->escapeMysqlSpecialString($this->input['describeIdea3']);
            $dmfirstcontactObj->form_first_contact_id = $result[0]['r_form_id'];
            $sql = $dmfirstcontactObj->updatedmformfirstcontact();
            $result = dbConnection::updateQuery($sql);

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->gised_form_id = $gisedId;
            $gisedObj->r_status_id = $this->input['status'];
            $sql = $gisedObj->updatedmgisedform();
            $result = dbConnection::updateQuery($sql);

            if($this->input['status'] == 2) {
                require_once "classes/class.factstatustrackingdetails.php";
                $trackObj = new factstatustrackingdetails();
                $trackObj->status_tracking_details_id = $statusTrackingId;
                $trackObj->r_status_id = $this->input['status'];
                $sql = $trackObj->updatefactstatustrackingdetails();
                $result = dbConnection::updateQuery($sql);
            }

            if($this->input['status'] == 3) {
                $this->setFormNoActionMsg(1, 'firstcontactformupdation', 'First contact form saved successfully', $this->input['status']);
            } else if($this->input['status'] == 2) {
                $this->setFormNoActionMsg(0, '', 'First contact form submited to approver successfully', $this->input['status']);
            }

        }

        function briefAssesmentFormInsertionAction() {

            $this->output['emailId'] = $this->input['emailId'];

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user_id = $result[0]['user_id'];

            require_once "classes/class.dmformbriefassesment.php";
            $briefAssesObj = new dmformbriefassesment();
            $briefAssesObj->full_name = $this->commonObj->escapeMysqlSpecialString($this->input['name']);
            $briefAssesObj->address = $this->commonObj->escapeMysqlSpecialString($this->input['address']);
            $briefAssesObj->email_id = $this->commonObj->escapeMysqlSpecialString($this->input['email']);
            $briefAssesObj->telephone_number = $this->input['telephoneNo'];
            $briefAssesObj->website_url = ($this->input['website']) ? 'Y' : 'N' ;
            $briefAssesObj->web_url = $this->commonObj->escapeMysqlSpecialString($this->input['websiteUrl']);
            $briefAssesObj->uploads = json_encode($this->input['uploadedFiles']);
            $briefAssesObj->streetAddress = $this->commonObj->escapeMysqlSpecialString($this->input['streetAddress']);
            $briefAssesObj->zipCode = $this->commonObj->escapeMysqlSpecialString($this->input['zipCode']);
            $briefAssesObj->city = $this->commonObj->escapeMysqlSpecialString($this->input['city']);
            $briefAssesObj->country = $this->commonObj->escapeMysqlSpecialString($this->input['country']);
            $briefAssesObj->ngoFoundedDate = ($this->input['ngoFoundedDate']=="") ? "1970-01-01" : $this->commonObj->escapeMysqlSpecialString($this->input['ngoFoundedDate']);
            $briefAssesObj->countriesNgoActive = $this->commonObj->escapeMysqlSpecialString($this->input['countriesNgoActive']);
            $briefAssesObj->ngoVisionMission = $this->commonObj->escapeMysqlSpecialString($this->input['ngoVisionMission']);
            $briefAssesObj->ngoGoal = $this->commonObj->escapeMysqlSpecialString($this->input['ngoGoal']);
            $briefAssesObj->ngoLongTermStrategy = $this->commonObj->escapeMysqlSpecialString($this->input['ngoLongTermStrategy']);
            $briefAssesObj->ngoOfferedActivities = $this->commonObj->escapeMysqlSpecialString($this->input['ngoOfferedActivities']);
            $briefAssesObj->ngoPlanning = $this->commonObj->escapeMysqlSpecialString($this->input['ngoPlanning']);
            $briefAssesObj->ngoFinance = $this->commonObj->escapeMysqlSpecialString($this->input['ngoFinanced']);
            $sql = $briefAssesObj->insertdmformbriefassesment();
            $result = dbConnection::insertQuery($sql);
            $briefAssesId = dbConnection::$dbObj->insert_id;
            $this->output['fileuppp'] = $briefAssesObj->uploads;
            $this->output['BRIEFQUERY'] = $sql;

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->r_user_id = $user_id;
            $gisedObj->status = 'Y';
            $sql = $gisedObj->selectdmgisedform();
            $result = dbConnection::selectQuery($sql);
            $gisedId = $result[0]['gised_form_id'];

            require_once "classes/class.factstatustrackingdetails.php";
            $trackObj = new factstatustrackingdetails();
            $trackObj->r_gised_id = $gisedId;
            $trackObj->r_user_id = $user_id;
            $trackObj->r_application_details_id = 1;
            $trackObj->r_form_details_id = 2;
            $trackObj->r_form_id = $briefAssesId;
            $trackObj->r_status_id = $this->input['status'];
            $trackObj->approval_by = 0;
            $trackObj->status = 'Y';
            $sql = $trackObj->insertfactstatustrackingdetails();
            $result = dbConnection::insertQuery($sql);

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->gised_form_id = $gisedId;
            $gisedObj->r_status_id = $this->input['status'];
            $sql = $gisedObj->updatedmgisedform();
            $result = dbConnection::updateQuery($sql);

            if($this->input['status'] == 3) {
                $this->setFormNoActionMsg(2, 'briefassesmentformupdation', 'Brief assesment form saved successfully', $this->input['status']);
            } else if($this->input['status'] == 2) {
                $this->setFormNoActionMsg(0, '', 'Brief assesment form submited to approver successfully', $this->input['status']);
            }

        }

        function briefAssesmentFormUpdationAction() {

            $this->output['emailId'] = $this->input['emailId'];

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user_id = $result[0]['user_id'];

            require_once "classes/class.factstatustrackingdetails.php";
            $factTrackObj = new factstatustrackingdetails();
            $factTrackObj->r_user_id = $user_id;
            $sql = $factTrackObj->getFormStatus();
            $result = dbConnection::selectQuery($sql);
            $statusTrackingId = $result[0]['status_tracking_details_id'];
            $gisedId = $result[0]['r_gised_id'];

            require_once "classes/class.dmformbriefassesment.php";
            $briefAssesObj = new dmformbriefassesment();
            $briefAssesObj->full_name = $this->commonObj->escapeMysqlSpecialString($this->input['name']);
            $briefAssesObj->address = $this->commonObj->escapeMysqlSpecialString($this->input['address']);
            $briefAssesObj->email_id = $this->commonObj->escapeMysqlSpecialString($this->input['email']);
            $briefAssesObj->telephone_number = $this->input['telephoneNo'];
            $briefAssesObj->website_url = ($this->input['website']) ? 'Y' : 'N' ;
            $briefAssesObj->uploads = $this->uploadFileCheck($this->input['uploadedFiles'], 2, $result[0]['r_form_id']);
            $briefAssesObj->streetAddress = $this->commonObj->escapeMysqlSpecialString($this->input['streetAddress']);
            $briefAssesObj->zipCode = $this->commonObj->escapeMysqlSpecialString($this->input['zipCode']);
            $briefAssesObj->city = $this->commonObj->escapeMysqlSpecialString($this->input['city']);
            $briefAssesObj->country = $this->commonObj->escapeMysqlSpecialString($this->input['country']);
            $briefAssesObj->ngoFoundedDate = ($this->input['ngoFoundedDate']=="") ? "1970-01-01" : $this->commonObj->escapeMysqlSpecialString($this->input['ngoFoundedDate']);
            $briefAssesObj->countriesNgoActive = $this->commonObj->escapeMysqlSpecialString($this->input['countriesNgoActive']);
            $briefAssesObj->ngoVisionMission = $this->commonObj->escapeMysqlSpecialString($this->input['ngoVisionMission']);
            $briefAssesObj->ngoGoal = $this->commonObj->escapeMysqlSpecialString($this->input['ngoGoal']);
            $briefAssesObj->ngoLongTermStrategy = $this->commonObj->escapeMysqlSpecialString($this->input['ngoLongTermStrategy']);
            $briefAssesObj->ngoOfferedActivities = $this->commonObj->escapeMysqlSpecialString($this->input['ngoOfferedActivities']);
            $briefAssesObj->ngoPlanning = $this->commonObj->escapeMysqlSpecialString($this->input['ngoPlanning']);
            $briefAssesObj->ngoFinance = $this->commonObj->escapeMysqlSpecialString($this->input['ngoFinanced']);
            $briefAssesObj->form_brief_assesment_id = $result[0]['r_form_id'];
            $sql = $briefAssesObj->updatedmformbriefassesment();
            $result = dbConnection::updateQuery($sql);
            $this->output['fileup'] = $briefAssesObj->uploads;

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->gised_form_id = $gisedId;
            $gisedObj->r_status_id = $this->input['status'];
            $sql = $gisedObj->updatedmgisedform();
            $result = dbConnection::updateQuery($sql);

            if($this->input['status'] == 2) {
                require_once "classes/class.factstatustrackingdetails.php";
                $trackObj = new factstatustrackingdetails();
                $trackObj->status_tracking_details_id = $statusTrackingId;
                $trackObj->r_status_id = $this->input['status'];
                $sql = $trackObj->updatefactstatustrackingdetails();
                $result = dbConnection::updateQuery($sql);
            }

            if($this->input['status'] == 3) {
                $this->setFormNoActionMsg(2, 'briefassesmentformupdation', 'Brief assesment form saved successfully', $this->input['status']);
            } else if($this->input['status'] == 2) {
                $this->setFormNoActionMsg(0, '', 'Brief assesment form submited to approver successfully', $this->input['status']);
            }   

        }

        function detailedPresentationFormInsertionAction() {

            $this->output['emailId'] = $this->input['emailId'];

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user_id = $result[0]['user_id'];

            require_once "classes/class.dmformdetailedpresentation.php";
            $detPressObj = new dmformdetailedpresentation();
            $detPressObj->uploads = json_encode($this->input['uploadedFiles']);
            $sql = $detPressObj->insertdmformdetailedpresentation();
            $result = dbConnection::insertQuery($sql);
            $detPressId = dbConnection::$dbObj->insert_id;

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->r_user_id = $user_id;
            $gisedObj->status = 'Y';
            $sql = $gisedObj->selectdmgisedform();
            $result = dbConnection::selectQuery($sql);
            $gisedId = $result[0]['gised_form_id'];

            require_once "classes/class.factstatustrackingdetails.php";
            $trackObj = new factstatustrackingdetails();
            $trackObj->r_gised_id = $gisedId;
            $trackObj->r_user_id = $user_id;
            $trackObj->r_application_details_id = 1;
            $trackObj->r_form_details_id = 3;
            $trackObj->r_form_id = $detPressId;
            $trackObj->r_status_id = $this->input['status'];
            $trackObj->approval_by = 0;
            $trackObj->status = 'Y';
            $sql = $trackObj->insertfactstatustrackingdetails();
            $result = dbConnection::insertQuery($sql);

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->gised_form_id = $gisedId;
            $gisedObj->r_status_id = $this->input['status'];
            $sql = $gisedObj->updatedmgisedform();
            $result = dbConnection::updateQuery($sql);

            if($this->input['status'] == 3) {
                $this->setFormNoActionMsg(2, 'detailedpresentationformupdation', 'Detailed presentation form saved successfully', $this->input['status']);
            } else if($this->input['status'] == 2) {
                $this->setFormNoActionMsg(0, '', 'Detailed presentation form submited to approver successfully', $this->input['status']);
            }

        }

        function detailedPresentationFormUpdationAction() {

            $this->output['emailId'] = $this->input['emailId'];

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user_id = $result[0]['user_id'];

            require_once "classes/class.factstatustrackingdetails.php";
            $factTrackObj = new factstatustrackingdetails();
            $factTrackObj->r_user_id = $user_id;
            $sql = $factTrackObj->getFormStatus();
            $result = dbConnection::selectQuery($sql);
            $statusTrackingId = $result[0]['status_tracking_details_id'];
            $gisedId = $result[0]['r_gised_id'];

            require_once "classes/class.dmformdetailedpresentation.php";
            $detPressObj = new dmformdetailedpresentation();
            $detPressObj->uploads = $this->uploadFileCheck($this->input['uploadedFiles'], 3, $result[0]['r_form_id']);
            $detPressObj->form_detailed_presentation_id = $result[0]['r_form_id'];
            $sql = $detPressObj->updatedmformdetailedpresentation();
            $result = dbConnection::updateQuery($sql);
            $this->output['fileup'] = $detPressObj->uploads;

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->gised_form_id = $gisedId;
            $gisedObj->r_status_id = $this->input['status'];
            $sql = $gisedObj->updatedmgisedform();
            $result = dbConnection::updateQuery($sql);

            if($this->input['status'] == 2) {
                require_once "classes/class.factstatustrackingdetails.php";
                $trackObj = new factstatustrackingdetails();
                $trackObj->status_tracking_details_id = $statusTrackingId;
                $trackObj->r_status_id = $this->input['status'];
                $sql = $trackObj->updatefactstatustrackingdetails();
                $result = dbConnection::updateQuery($sql);
            }

            if($this->input['status'] == 3) {
                $this->setFormNoActionMsg(3, 'detailedpresentationformupdation', 'Detailed presentation form saved successfully', $this->input['status']);
            } else if($this->input['status'] == 2) {
                $this->setFormNoActionMsg(0, '', 'Detailed presentation form submited to approver successfully', $this->input['status']);
            }   

        }

        function finalApprovalFormInsertionAction() {

            $this->output['emailId'] = $this->input['emailId'];

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user_id = $result[0]['user_id'];

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->r_user_id = $user_id;
            $gisedObj->status = 'Y';
            $sql = $gisedObj->selectdmgisedform();
            $result = dbConnection::selectQuery($sql);
            $gisedId = $result[0]['gised_form_id'];

            require_once "classes/class.factstatustrackingdetails.php";
            $trackObj = new factstatustrackingdetails();
            $trackObj->r_gised_id = $gisedId;
            $trackObj->r_user_id = $user_id;
            $trackObj->r_application_details_id = 1;
            $trackObj->r_form_details_id = 4;
            $trackObj->r_form_id = 1;
            $trackObj->r_status_id = $this->input['status'];
            $trackObj->approval_by = 0;
            $trackObj->status = 'Y';
            $sql = $trackObj->insertfactstatustrackingdetails();
            $result = dbConnection::insertQuery($sql);

            require_once "classes/class.dmgisedform.php";
            $gisedObj = new dmgisedform();
            $gisedObj->gised_form_id = $gisedId;
            $gisedObj->r_status_id = $this->input['status'];
            $sql = $gisedObj->updatedmgisedform();
            $result = dbConnection::updateQuery($sql);

            $this->setFormNoActionMsg(0, '', 'Final approval form submited to approver successfully', $this->input['status']);

        }

        function setFormNoActionMsg($formNo, $action, $userMsg, $statusId) {

            $this->output['presentFormNo'] = $formNo;
            $this->output['action'] = $action;
            $this->output['userMsg'] = $userMsg;

            require_once "classes/class.dmstatus.php";
            $dmStatusObj = new dmStatus();
            $dmStatusObj->status_id = $statusId;
            $sql = $dmStatusObj->selectdmstatus();
            $result = dbConnection::selectQuery($sql);
            if(isset($result[0]['status_id'])) {
                $this->output['status'] = $result[0]['status_value'];
            } else {
                $this->output['status'] = "Nil";
            }

        }

        function mailForApproerAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['userEmailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user = $result[0];    

            if(isset($user['email_id'])) {

                $mailValues = $this->commonObj->readJsonConfigurations('mails', $this->input['mailerAction'], 'action');
    
                $sendMailObj = new sendMail();
                $sendMailObj->receiverTitle = $user['title'];
                $sendMailObj->receiverName = $user['first_name'].' '.$user['last_name'];
                $sendMailObj->receiverMailId = $user['email_id'];
                $sendMailObj->subject = $mailValues['mail_subject'];
                $sendMailObj->message = $this->mailStringReplace($mailValues['mail_message'], $user);
                $sendMailObj->link = PRODUCT_LINK;
    
                $sendMailObj->mail();
    
                $this->output['userMsg'] = 'Suggesstion mail sent to admin successfully';
            } else {
                $this->output['userMsg'] = 'Sorry! Something went wrong';
            }

        }

        function mailStringReplace($mailMsg, $replaceStr) {

            $mailMsg = str_replace("TITLE", $replaceStr['title'], $mailMsg);
            $mailMsg = str_replace("USER_NAME", $replaceStr['first_name'], $mailMsg);
            $mailMsg = str_replace("EMAIL_ID", $replaceStr['email_id'], $mailMsg);
            if(isset($this->input['feedback'])) {
                $mailMsg = str_replace("FEEDBACK_SUGESSTION", $this->input['feedback'], $mailMsg);
            } else if(isset($this->input['approverReason'])) {
                $mailMsg = str_replace("FEEDBACK_SUGESSTION", $this->input['approverReason']['reason'], $mailMsg);
            }

            return $mailMsg;

        }

        function uploadFileCheck($uploadedFiles, $formNo, $formId) {

            if($formNo == 2) {
                require_once "classes/class.dmformbriefassesment.php";
                $briefAssesObj = new dmformbriefassesment();
                $briefAssesObj->form_brief_assesment_id = $formId;
                $sql = $briefAssesObj->selectdmformbriefassesment();
                $result = dbConnection::selectQuery($sql);
            } else if($formNo == 3) {
                require_once "classes/class.dmformdetailedpresentation.php";
                $detPressObj = new dmformdetailedpresentation();
                $detPressObj->form_detailed_presentation_id = $formId;
                $sql = $detPressObj->selectdmformdetailedpresentation();
                $result = dbConnection::selectQuery($sql);
            }
            $stroedArray = json_decode($result[0]['uploads'],1);
            $this->output['sathees'] = $sql;

            foreach($uploadedFiles AS $key => $value) {
                // if($value[0] != "No Files") {
                    foreach($value AS $innerKey => $innerValue) {
                        if(count($stroedArray[$key])==0) {
                            $stroedArray[$key] = array();
                        }
                        array_push($stroedArray[$key], $innerValue);
                    }
                // }
            }

            return json_encode($stroedArray);

        }

        function defaultAction() {
            $this->output = "I am defaultAction. I got called successfully :)";
        }

        function getModuleOutput() {
            return $this->output;
        }

    }

?>
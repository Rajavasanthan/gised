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
                default:
                    $this->defaultAction();
            }
        }

        function firstContactInsertionAction() {

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
            $gisedObj->r_status_id = 0;
            $gisedObj->status = 'Y';
            $sql = $gisedObj->insertdmgisedform();
            $result = dbConnection::insertQuery($sql);
            $gisedId = dbConnection::$dbObj->insert_id;

            require_once "classes/class.dmformfirstcontact.php";
            $dmfirstcontactObj = new dmformfirstcontact();
            $dmfirstcontactObj->first_name = $this->input['firstName'];
            $dmfirstcontactObj->last_name = $this->input['lastName'];
            $dmfirstcontactObj->email_id = $this->input['email'];
            $dmfirstcontactObj->organization_name = $this->input['organizationName'];
            $dmfirstcontactObj->org_details = $this->input['orgDetails'];
            $dmfirstcontactObj->sign_up_for_emails = ($this->input['signUpEmail']) ? 'Y' : 'N' ;
            $dmfirstcontactObj->r_source_id = json_encode($this->input['sourceValue']);
            $dmfirstcontactObj->brief_idea = $this->input['describeIdea1'];
            $dmfirstcontactObj->explained_idea = $this->input['describeIdea2'];
            $dmfirstcontactObj->about_group = $this->input['describeIdea3'];
            $sql = $dmfirstcontactObj->insertdmformfirstcontact();
            $result = dbConnection::insertQuery($sql);
            $dmfirstcontactId = dbConnection::$dbObj->insert_id;

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

            require_once "classes/class.dmformfirstcontact.php";
            $dmfirstcontactObj = new dmformfirstcontact();
            $dmfirstcontactObj->first_name = $this->input['firstName'];
            $dmfirstcontactObj->last_name = $this->input['lastName'];
            $dmfirstcontactObj->email_id = $this->input['email'];
            $dmfirstcontactObj->organization_name = $this->input['organizationName'];
            $dmfirstcontactObj->org_details = $this->input['orgDetails'];
            $dmfirstcontactObj->sign_up_for_emails = ($this->input['signUpEmail']) ? 'Y' : 'N' ;
            $dmfirstcontactObj->r_source_id = json_encode($this->input['sourceValue']);
            $dmfirstcontactObj->brief_idea = $this->input['describeIdea1'];
            $dmfirstcontactObj->explained_idea = $this->input['describeIdea2'];
            $dmfirstcontactObj->about_group = $this->input['describeIdea3'];
            $dmfirstcontactObj->form_first_contact_id = $result[0]['r_form_id'];
            $sql = $dmfirstcontactObj->updatedmformfirstcontact();
            $result = dbConnection::updateQuery($sql);

            if($this->input['status'] == 2) {
                require_once "classes/class.factstatustrackingdetails.php";
                $trackObj = new factstatustrackingdetails();
                $trackObj->status_tracking_details_id = $statusTrackingId;
                $trackObj->r_status_id = $this->input['status'];
                $sql = $trackObj->updatefactstatustrackingdetails();
                $result = dbConnection::updateQuery($sql);
                $this->output['samplecheck'] = $sql;
            }

            if($this->input['status'] == 3) {
                $this->setFormNoActionMsg(1, 'firstcontactformupdation', 'First contact form saved successfully', $this->input['status']);
            } else if($this->input['status'] == 2) {
                $this->setFormNoActionMsg(0, '', 'First contact form submited to approver successfully', $this->input['status']);
            }

        }

        function briefAssesmentFormInsertionAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user_id = $result[0]['user_id'];

            require_once "classes/class.dmformbriefassesment.php";
            $briefAssesObj = new dmformbriefassesment();
            $briefAssesObj->full_name = $this->input['name'];
            $briefAssesObj->address = $this->input['address'];
            $briefAssesObj->email_id = $this->input['email'];
            $briefAssesObj->telephone_number = $this->input['telephoneNo'];
            $briefAssesObj->website_url = ($this->input['website']) ? 'Y' : 'N' ;
            $briefAssesObj->uploads = '{"purposeOfProject1":["filename1.txt","filename2.txt"],"detailedInformation":["filename1.txt","filename2.txt"],"estimatedBudget":["filename1.txt","filename2.txt","filename3.txt","filename4.txt"],"periodOfTime":["filename1.txt"],"purposeOfProject2":["filename1.txt","filename2.txt"]}';
            // $briefAssesObj->uploads = $this->input['uploadedFiles'];
            $sql = $briefAssesObj->insertdmformbriefassesment();
            $result = dbConnection::insertQuery($sql);
            $briefAssesId = dbConnection::$dbObj->insert_id;

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

            if($this->input['status'] == 3) {
                $this->setFormNoActionMsg(2, 'briefassesmentformupdation', 'Brief assesment form saved successfully', $this->input['status']);
            } else if($this->input['status'] == 2) {
                $this->setFormNoActionMsg(0, '', 'Brief assesment form submited to approver successfully', $this->input['status']);
            }

        }

        function briefAssesmentFormUpdationAction() {

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

            require_once "classes/class.dmformbriefassesment.php";
            $briefAssesObj = new dmformbriefassesment();
            $briefAssesObj->full_name = $this->input['name'];
            $briefAssesObj->address = $this->input['address'];
            $briefAssesObj->email_id = $this->input['email'];
            $briefAssesObj->telephone_number = $this->input['telephoneNo'];
            $briefAssesObj->website_url = ($this->input['website']) ? 'Y' : 'N' ;
            $briefAssesObj->uploads = $this->input['uploadedFiles'];
            $briefAssesObj->form_brief_assesment_id = $result[0]['r_form_id'];;
            $sql = $briefAssesObj->updatedmformbriefassesment();
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

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user_id = $result[0]['user_id'];

            require_once "classes/class.dmformdetailedpresentation.php";
            $detPressObj = new dmformdetailedpresentation();
            // $detPressObj->uploads = '{"purposeOfProject1":["filename1.txt","filename2.txt"],"detailedInformation":["filename1.txt","filename2.txt"],"estimatedBudget":["filename1.txt","filename2.txt","filename3.txt","filename4.txt"],"periodOfTime":["filename1.txt"],"purposeOfProject2":["filename1.txt","filename2.txt"]}';
            $detPressObj->uploads = $this->input['uploadedFiles'];
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

            if($this->input['status'] == 3) {
                $this->setFormNoActionMsg(2, 'detailedpresentationformupdation', 'Detailed presentation form saved successfully', $this->input['status']);
            } else if($this->input['status'] == 2) {
                $this->setFormNoActionMsg(0, '', 'Detailed presentation form submited to approver successfully', $this->input['status']);
            }

        }

        function detailedPresentationFormUpdationAction() {



        }

        function finalApprovalFormInsertionAction() {

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

        function defaultAction() {
            $this->output = "I am defaultAction. I got called successfully :)";
        }

        function getModuleOutput() {
            return $this->output;
        }

    }

?>
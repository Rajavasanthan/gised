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
                    $this->firstContactAction();
                    break;
                default:
                    $this->defaultAction();
            }
        }

        function firstContactAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user_id = $result[0]['user_id'];

            require_once "classes/class.dmformfirstcontact.php";
            $dmfirstcontactObj = new dmformfirstcontact();
            $dmfirstcontactObj->first_name = $this->input['firstName'];
            $dmfirstcontactObj->last_name = $this->input['lastName'];
            $dmfirstcontactObj->email_id = $this->input['email'];
            $dmfirstcontactObj->organization_name = $this->input['organizationName'];
            $dmfirstcontactObj->org_details = $this->input['orgDetails'];
            $dmfirstcontactObj->sign_up_for_emails = $this->input['signUpEmail'];
            $dmfirstcontactObj->r_source_id = $this->input['sourceValue'];
            $dmfirstcontactObj->brief_idea = $this->input['describeIdea1'];
            $dmfirstcontactObj->explained_idea = $this->input['describeIdea2'];
            $dmfirstcontactObj->about_group = $this->input['describeIdea3'];
            //$dmfirstcontactObj->created_date_time = 'now()';
            $sql = $dmfirstcontactObj->insertdmformfirstcontact();
            $result = dbConnection::insertQuery($sql);

            //$this->output = $sql;
            $dmfirstcontactId = dbConnection::$dbObj->insert_id;
            //$this->output['last inser id'] = $result->insert_id;

            require_once "classes/class.factstatustrackingdetails.php";
            $trackObj = new factstatustrackingdetails();
            $trackObj->r_user_id = $user_id;
            $trackObj->r_application_details_id = 1;
            $trackObj->r_form_details_id = 1;
            $trackObj->r_form_id = $dmfirstcontactId;
            $trackObj->r_status_id = 2;
            $trackObj->approval_by = 0;
            $trackObj->status = 'Y';
            $sql = $trackObj->insertfactstatustrackingdetails();
            $result = dbConnection::insertQuery($sql);
        }   


        function defaultAction() {
            $this->output = "I am defaultAction. I got called successfully :)";
        }

        function getModuleOutput() {
            return $this->output;
        }

    }

?>
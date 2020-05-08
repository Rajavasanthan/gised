<?php

    require_once "lib/common/class.sendMail.php";
    
    class userProfile {

        var $action;
        var $input;
        var $output;
        var $commonObj;
        var $userType;
        var $factStatusTrackingDetails;

        function __construct($angularRequest) {
            $this->commonObj = new commonFunction();
            $this->action = "";
            $this->output = array();
            $this->userType = 0;
            $this->factStatusTrackingDetails = array();
        }

        function executeModule() {
            switch($this->action) {
                case 'showprofile':
                    $this->showProfileAction();
                    break;
                case 'showuserform':
                    $this->showUserFormAction();
                    break;
                case 'adminlist':
                    $this->adminListAction();
                    break;
                case 'profilephotoupload':
                    $this->profilePhotoAction();
                    break;
                default:
                    $this->defaultAction();
            }
        }

        function adminListAction() {

            $this->adminData();
            $this->output['emailId'] = $this->input['loggedEmailId'];

        }

        function showUserFormAction() {

            $this->input['emailId'] = ($this->input['userEmailId']) ? $this->input['userEmailId'] : $this->input['emailId'] ; 

            $this->showProfileAction();

            if(isset($this->factStatusTrackingDetails[0]['r_gised_id'])) {
                if($this->factStatusTrackingDetails[0]['r_status_id'] == 2) {
                    $this->output['presentFormNo'] = $this->factStatusTrackingDetails[0]['r_form_details_id'];
                    $this->output['statusTrackingDetailsId'] = $this->factStatusTrackingDetails[0]['status_tracking_details_id'];
                    $this->output['processUserId'] = $this->factStatusTrackingDetails[0]['r_user_id'];
                    $this->output['gisedId'] = $this->factStatusTrackingDetails[0]['r_gised_id'];
                    $this->output['processEmailId'] = $this->input['emailId'];
                } else {
                    $this->output['statusTrackingDetailsId'] = 0;
                    $this->output['presentFormNo'] = 0;
                    $this->output['statusTrackingDetailsId'] = 0;
                    $this->output['processUserId'] = 0;
                    $this->output['gisedId'] = 0;
                    $this->output['processEmailId'] = $this->input['emailId'];
                }
            }

            $this->output['close']['firstContactFormClose'] = 'OPEN';
            $this->output['close']['briefAssesmentFormClose'] = 'OPEN';
            $this->output['close']['detailedPresentationFormClose'] = 'OPEN';

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['loggedEmailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $this->output['approvalBy'] = (isset($result[0]['user_id'])) ? $result[0]['user_id'] : 0 ;
            $this->output['emailId'] = $this->input['loggedEmailId'];

        }

        function showProfileAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $userResult = dbConnection::selectQuery($sql);
            $userId = $userResult[0]['user_id'];
            $this->output['emailId'] = $this->input['emailId'];

            require_once "classes/class.factuser.php";
            $factUserObj = new factuser();
            $factUserObj->r_user_id = $userId;
            $sql = $factUserObj->selectfactuser();
            $result = dbConnection::selectQuery($sql);
            $this->userType = $result[0]['r_user_type_id'];
            
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

            $this->output['loggedProfile']['profileImg'] = $this->getProfilePicture($userResult[0]['user_id'], $userResult[0]['gender']);

            require_once "classes/class.dmapplicationdetails.php";
            $applicationObj = new dmapplicationdetails();
            $applicationObj->status = 'Y';
            $sql = $applicationObj->selectdmapplicationdetails();
            $result = dbConnection::selectQuery($sql);
            $this->output['applications'] = $result;
            
            require_once "classes/class.factstatustrackingdetails.php";
            $factTrackObj = new factstatustrackingdetails();
            $factTrackObj->r_gised_id =  (isset($this->input['gisedId'])) ? $this->input['gisedId'] : 0 ;
            $factTrackObj->r_user_id = $userId;
            $sql = (isset($this->input['admin'])) ? $factTrackObj->getFormStatusAdmin() : $factTrackObj->getFormStatus() ;
            $result = dbConnection::selectQuery($sql);
            $this->factStatusTrackingDetails = $result;

            if(isset($this->input['admin']) && $result[0]['r_status_id']==6) {
                foreach($result AS $key => $value) {
                    $result[$key]['r_status_id'] = 3;
                }
            }

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
                $this->output['close']['finalApprovalFormClose'] = 'CLOSE';
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

            if($this->userType == 1) {
                $this->adminData();
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

            $this->output['result'] = $sql;
            foreach($result AS $key => $value) {
                foreach($value AS $innerKey => $innerValue) {
                    $this->output['firstContactForm'][$innerKey] = ($innerKey == 'r_source_id') ? json_decode($innerValue) : $innerValue;
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
                    $this->output['briefAssesmentForm'][$innerKey] = ($innerKey == 'uploads') ? $this->getFileNameOnly(json_decode($innerValue,1)) : $innerValue;
                }
            }

        }

        function getFileNameOnly($files) {

            $preparedFiles = array();
            foreach($files AS $key => $value) {
                foreach($value AS $innerKey => $innerValue) {
                    if($innerValue != "" && $innerValue != "No Files") {
                        $preparedFiles[$key][$innerKey]['displayFileName'] = explode("___",$innerValue)[1];
                        $preparedFiles[$key][$innerKey]['downloadFileName'] = $innerValue;
                    }
                }
            }

            return $preparedFiles;

        }

        function getDetailedPresentationForm($formId) {
           
            require_once "classes/class.dmformdetailedpresentation.php";
            $detPressObj = new dmformdetailedpresentation();
            $detPressObj->form_detailed_presentation_id = $formId;
            $sql = $detPressObj->selectdmformdetailedpresentation();
            $result = dbConnection::selectQuery($sql);

            foreach($result AS $key => $value) {
                foreach($value AS $innerKey => $innerValue) {
                    $this->output['detailedPresentationForm'][$innerKey] = ($innerKey == 'uploads') ? $this->getFileNameOnly(json_decode($innerValue,1)) : $innerValue;
                }
            }

        }

        function getFinalApprovalForm() {
            //finalApprovalForm
        }

        function adminData() {

            require_once "classes/class.generalsql.php";
            $generalSqlObj = new generalsql();
            $sql = $generalSqlObj->userRequestList();
            $result = dbConnection::selectQuery($sql);

            if($result != "EMPTY") {
                foreach($result AS $key => $value) {
                    $this->output['userRequestList'][$key] = $value;
                }    
                $this->output['userRequestListCount'] = count($result);
            } else {
                $this->output['userRequestListCount'] = 0;
            }

        }

        function profilePhotoAction() {
        
            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user_id = $result[0]['user_id'];
            $gender = $result[0]['gender'];
            
            $img = $this->input['image'];
            $file = 'user_' .$user_id. '.jpg';
            $this->base64_to_jpeg($img, $file );

            $this->output['emailId'] = $this->input['emailId'];
            $this->output['profileImg'] = $this->getProfilePicture($user_id, $gender);
        
        }

        function base64_to_jpeg($base64_string, $output_file) {

            $ifp = fopen( USER_PROFILE_PICTURE_PATH.$output_file, 'wb' );
            $data = explode( ',', $base64_string );
            fwrite( $ifp, base64_decode( $data[ 1 ] ) );
            fclose( $ifp );

        }

	    function getProfilePicture($userId, $gender) {

            $profilePicturePath = "./assets/images/blank.jpg";

            if(file_exists(USER_PROFILE_PICTURE_PATH . "user_".$userId.".jpg")) {
                $profilePicturePath = BACKEND_PRODUCT_LINK . USER_PROFILE_PICTURE_PATH . "user_".$userId.".jpg?".date("dmYHis");
            } else if($gender == "Male") {
                $profilePicturePath = "./assets/images/male.jpg";
            } else if($gender == "Female") {
                $profilePicturePath = "./assets/images/female.jpg";
            }

            return $profilePicturePath;

        }

        function defaultAction() {
            
            $this->output = "I am defaultAction. I got called successfully :)";
        
        }

        function getModuleOutput() {
        
            return $this->output;
        
        }

    }

?>

<?php

    require_once "lib/common/class.sendMail.php";
    
    class login {

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
                case 'logincheck':
                    $this->loginAction();
                    break;
                case 'signup':
                    $this->signUpAction();
                    break;
                case 'forgotpassword':
                    $this->forgotPasswordAction();
                    break;
                case 'setpassword':
                    $this->setPasswordAction();
                    break;
                case 'updatepassword':
                    $this->updatePasswordAction();
                    break;
                case 'getcountries':
                    $this->getCountriesAction();
                    break;
                case 'mailidcheck':
                    $this->mailIdCheckAction();
                    break;
                default:
                    $this->defaultAction();
            }
        }

        function loginAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);

            if(isset($result[0]['email_id'])) {
                require_once "classes/class.factuser.php";
                $factUserObj = new factuser();
                $factUserObj->r_user_id = $result[0]['user_id'];
                $sql = $factUserObj->selectfactuser();
                $result = dbConnection::selectQuery($sql);
                $userTypeId = $result[0]['r_user_type_id'];

                require_once "classes/class.dmpassword.php";
                $dmPassObj = new dmpassword();
                $dmPassObj->password_id = $result[0]['r_password_id'];
                $sql = $dmPassObj->selectdmpassword();
                $result = dbConnection::selectQuery($sql);
            }

            if(isset($result[0]['login_password'])) {
                if($result[0]['login_password'] == $this->input['password']) {
                    $this->output['userTypeId'] = $userTypeId;
                    $this->output['emailId'] = $this->input['emailId'];
                    $this->output['status'] = "SUCCESS";
                } else {
                    $this->output['status'] = "NOTSUCCESS";
                }
            } else {
                $this->output['status'] = "NOTSUCCESS";
            }

        }

        function signUpAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $dmUserObj->mobile_no = $this->input['mobileNo'];
            $dmUserObj->title = ($this->input['gender'] == "Male") ? "Mr" : "Ms" ;
            $dmUserObj->first_name = $this->input['fullName'];
            $dmUserObj->gender = $this->input['gender'];
            $dmUserObj->age = $this->input['age'];
            $dmUserObj->r_state_id = 1;
            $dmUserObj->r_country_id = $this->input['country'];
            $sql = $dmUserObj->insertdmuser();
            $result = dbConnection::insertQuery($sql);

            require_once "classes/class.dmpassword.php";
            $dmPassObj = new dmpassword();
            $dmPassObj->login_password = $this->input['emailId'];
            $sql = $dmPassObj->insertdmpassword();
            $result = dbConnection::insertQuery($sql);

            $dmUserObj->__construct();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $userId = $result[0]['user_id'];

            $sql = $dmPassObj->getPasswordId();
            $result = dbConnection::selectQuery($sql);

            require_once "classes/class.factuser.php";
            $factUserObj = new factuser();
            $factUserObj->r_user_id = $userId;
            $factUserObj->r_password_id = $result[0]['password_id'];
            $factUserObj->r_user_type_id = 2;
            $sql = $factUserObj->insertfactuser();
            $result = dbConnection::insertQuery($sql);

            $this->forgotPasswordAction();

            if(isset($this->input['social'])) {
                $this->insertSocialResponse($userId);
            }
        }

        function insertSocialResponse($userId) {

            require_once "classes/class.dmsocial.php";
            $socialObj = new dmsocial();
            $socialObj->r_user_id = $userId;
            $socialObj->social_site = $this->input['socialType'];
            $socialObj->response = json_encode($this->input['social']);
            $sql = $socialObj->insertdmsocial();
            $result = dbConnection::insertQuery($sql);

        }

        function forgotPasswordAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);

            if(isset($result[0]['email_id'])) {

                $mailValues = $this->commonObj->readJsonConfigurations('mails', $this->action, 'action');

                $sendMailObj = new sendMail();
                $sendMailObj->receiverTitle = $result[0]['title'];
                $sendMailObj->receiverName = $result[0]['first_name'].' '.$result[0]['last_name'];
                $sendMailObj->receiverMailId = $result[0]['email_id'];
                $sendMailObj->subject = $mailValues['mail_subject'];
                $sendMailObj->message = $mailValues['mail_message'];
                $linkEncryption = $this->commonObj->encryption($result[0]['user_id']."|||".$result[0]['email_id']."|||".date('Y-m-d H:i:s'));
                $sendMailObj->link = SET_PASSWORD_LINK.$linkEncryption;

                require_once 'classes/class.dmsetpassword.php';
                $dmSetPassObj = new dmsetpassword();

                $dmSetPassObj->r_user_id = $result[0]['user_id'];
                $userId = $result[0]['user_id'];
                $sql = $dmSetPassObj->disableExistingLink();
                $result = dbConnection::updateQuery($sql);

                $dmSetPassObj->__construct();
                $dmSetPassObj->r_user_id = $userId;
                $dmSetPassObj->status = 'Y';
                $dmSetPassObj->link = $linkEncryption;    
                $sql = $dmSetPassObj->insertdmsetpassword();
                $result = dbConnection::insertQuery($sql);
                
                $sendMailObj->mail();

            } else {
                $this->output = $result;
            }
            
        }

        function setPasswordAction() {

            $linkDecryption = base64_decode($this->input['link']);
            $userId = explode('|||',$linkDecryption)[0];
            $emailId = explode('|||',$linkDecryption)[1];

            require_once 'classes/class.dmsetpassword.php';
            $dmSetPassObj = new dmsetpassword();
            $dmSetPassObj->r_user_id = $userId;
            $dmSetPassObj->status = 'Y';
            $dmSetPassObj->link = $this->input['link'];
            $sql = $dmSetPassObj->selectdmsetpassword();
            $result = dbConnection::selectQuery($sql);

            if(isset($result[0]['link'])) {
                $this->output['emailId'] = $emailId;
                $this->output['userId'] = $userId;
            } else {
                $this->output['result'] = $result;
            }

        }

        function updatePasswordAction() {

            require_once "classes/class.factuser.php";
            $factUserObj = new factuser();
            $factUserObj->r_user_id = $this->input['userId'];
            $sql = $factUserObj->selectfactuser();
            $result = dbConnection::selectQuery($sql);

            require_once "classes/class.dmpassword.php";
            $dmPassObj = new dmpassword();
            $dmPassObj->password_id = $result[0]['r_password_id'];
            $dmPassObj->login_password = $this->input['password'];
            $sql2 = $dmPassObj->updatedmpassword();
            $result = dbConnection::updateQuery($sql2);

            require_once 'classes/class.dmsetpassword.php';
            $dmSetPassObj = new dmsetpassword();
            $dmSetPassObj->r_user_id = $this->input['userId'];
            $sql = $dmSetPassObj->disableExistingLink();
            $result = dbConnection::updateQuery($sql);

            //$this->output['result'] = $result;
        }

        function getCountriesAction() {

            require_once 'classes/class.corecountrydetails.php';
            $coreCounObj = new corecountrydetails();
            $sql = $coreCounObj->selectcorecountrydetails();
            $result = dbConnection::selectQuery($sql);
            //$this->output['countries'][1]['country_id'] = "0";
            //$this->output['countries'][1]['country_name'] = "Select your country";
            foreach($result AS $key => $value) {
                $this->output['countries'][$key] = $value;
            }

        }

        function mailIdCheckAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);

            if(isset($result[0]['email_id'])) {
                $this->output['emailId'] = $result[0]['email_id'];
            } else {
                $this->output['result'] = $result;
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
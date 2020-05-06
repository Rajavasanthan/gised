<?php

    require_once "lib/common/class.sendMail.php";
    
    class mailer {

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
                case 'feedback':
                    $this->feedbackAction();
                    break;
                case 'feedbackadmin':
                    $this->feedbackAdminAction();
                    break;
                default:
                    $this->defaultAction();
            }
        }

        function feedbackAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = GISED_ADMIN_MAIL_ID;
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $admin = $result[0];

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['emailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user = $result[0];

            if(isset($admin['email_id'])) {

                $mailValues = $this->commonObj->readJsonConfigurations('mails', $this->action, 'action');

                $sendMailObj = new sendMail();
                $sendMailObj->receiverTitle = $admin['title'];
                $sendMailObj->receiverName = $admin['first_name'].' '.$admin['last_name'];
                $sendMailObj->receiverMailId = $admin['email_id'];
                $sendMailObj->subject = $mailValues['mail_subject'];
                $sendMailObj->message = $this->mailStringReplace($mailValues['mail_message'], $user);
                $sendMailObj->link = PRODUCT_LINK;

                $sendMailObj->mail();

                $this->output['userMsg'] = 'Suggesstion mail sent to admin successfully';
            } else {
                $this->output['userMsg'] = 'Sorry! Something went wrong';
            }

        }

        function feedbackAdminAction() {

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = GISED_ADMIN_MAIL_ID;
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $admin = $result[0];

            require_once "classes/class.dmuser.php";
            $dmUserObj = new dmuser();
            $dmUserObj->email_id = $this->input['userEmailId'];
            $sql = $dmUserObj->selectdmuser();
            $result = dbConnection::selectQuery($sql);
            $user = $result[0];

            if(isset($user['email_id'])) {

                $mailValues = $this->commonObj->readJsonConfigurations('mails', $this->action, 'action');

                $sendMailObj = new sendMail();
                $sendMailObj->receiverTitle = $user['title'];
                $sendMailObj->receiverName = $user['first_name'].' '.$user['last_name'];
                $sendMailObj->receiverMailId = $user['email_id'];
                $sendMailObj->subject = $mailValues['mail_subject'];
                $sendMailObj->message = $this->mailStringReplace($mailValues['mail_message'], $admin);
                $sendMailObj->link = PRODUCT_LINK;

                $sendMailObj->mail();

                $this->output['userMsg'] = 'Suggesstion mail sent to admin successfully';
            } else {
                $this->output['userMsg'] = 'Might be entered user wrong';
            }
            $this->output['emailId'] = $this->input['loggedEmailId'];
            
        }
        
        function mailStringReplace($mailMsg, $replaceStr) {

            $mailMsg = str_replace("TITLE", $replaceStr['title'], $mailMsg);
            $mailMsg = str_replace("USER_NAME", $replaceStr['first_name'], $mailMsg);
            $mailMsg = str_replace("EMAIL_ID", $replaceStr['email_id'], $mailMsg);
            $mailMsg = str_replace("FEEDBACK_SUGESSTION", $this->input['feedback'], $mailMsg);

            return $mailMsg;

        }

        function defaultAction() {
            $this->output = "I am defaultAction. I got called successfully :)";
        }

        function getModuleOutput() {
            return $this->output;
        }

    }

?>

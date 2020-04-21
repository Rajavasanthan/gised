<?php

    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    class sendMail {

        var $receiverTitle;
        var $receiverName;
        var $receiverMailId;
        var $subject;
        var $message;
        var $link;
        

        function __construct($angularRequest) {
            $this->receiverTitle = '';
            $this->receiverName = '';
            $this->receiverMailId = '';
            $this->subject = '';
            $this->message = '';
            $this->link = '';
        }

        function mail() {

            //Initiate mail caller
            $mail = new PHPMailer();                

            //Enable verbose debug output
            $mail->SMTPDebug = 0;                   
            //Set mailer to use SMTP
            $mail->isSMTP();                        
            //Specify main SMTP server
            $mail->Host       = SMTP_HOST;    
            //Enable SMTP authentication
            $mail->SMTPAuth   = true;               
            //SMTP username
            $mail->Username   = SMTP_USERNAME;     
            //SMTP password
            $mail->Password   = SMTP_PASSWORD;         
            //Enable TLS encryption, 'ssl' also accepted
            $mail->SMTPSecure = SMTP_SECURE;              
            //TCP port to connect to
            $mail->Port       = SMTP_PORT;                
            //SMTP options
            $mail->SMTPOptions = array(
                    'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );
            //Set sender of the mail
            $mail->setFrom(SMTP_SENDER_MAILID, SMTP_SENDER_MAIL_NAME);      
            //Name is optional     
            $mail->addAddress($this->receiverMailId, $this->receiverName);

            //Add bcc mail id
            //$mail->addBcc("balay2k11@gmail.com", 'Mr. BalaMurugan');  

            //For attachments // Name is optional
            //$mail->addAttachment('url', 'filename');    

            //If send HTML content make it true
            $mail->isHTML(true);                                  
            $mail->Subject = $this->subject;
            $mail->Body    = $this->mailHeader().$this->mailBody().$this->mailFooter();
            $mail->AltBody = $this->message;

            //Send mail
            $mail->send();

        }

        function mailHeader() {
            return '<html>
                        <body>
                            <div style="border:1px solid black;margin:auto;width:600px;padding:10px;margin-top:5px;">
                                <div style="border:1px solid #DCDCDC;widht:100%;background-color:#EEEEEE;">
                                    <div style="padding:10px 20px;font-size:40px;">
                                        GISED
                                    </div>
                                </div>
                                <div style="border:0px solid blue;">';
        }

        function mailBody() {
            return '<p>
                        Dear '.$this->receiverTitle.'. '.$this->receiverName.',
                    <p>
                    <p>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$this->message.'
                    </p>
                    <p>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$this->link.'">Click Here</a>
                    </p>
                    <p>
                        --<br/>
                        Thanks & Regards
                    </p>
                    <p>
                        Gised Team
                    </p>';
        }

        function mailFooter() {
            return '</div>
                    <div style="border:1px solid #DCDCDC;widht:100%;background-color:#EEEEEE;">
				        <div style="padding:10px 20px;text-align:center;">
					        Copyright 2020 by Gised Team. All Rights Reserved.
				        </div>
			        </div>
		            </div>
	                <body>
                    </html>';
        }

    }

?>
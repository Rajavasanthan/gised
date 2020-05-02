<?php

    require_once "lib/common/class.sendMail.php";
    
    class download {

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
                case 'download':
                    $this->downloadAction();
                    break;
                default:
                    $this->defaultAction();
            }
        }

        function downloadAction() {

            $filedownloadpath = USER_DOWNLOAD_PATH;
            $pieces = explode("/",$_SERVER['SCRIPT_FILENAME']);
            unset($pieces[count($pieces)-1]);
            $downloadfile = implode("/",$pieces)."/".$filedownloadpath.basename($this->input['filename']);
            if(file_exists($downloadfile)) {
                $this->output['DOWNLOAD_FILE'] = $downloadfile;
            } else {
                $this->output['userMsg'] = "Downlod file not exist";
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

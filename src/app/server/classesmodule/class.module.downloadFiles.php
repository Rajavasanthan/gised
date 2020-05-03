<?php
    //Server access headers defined
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
    header('Access-Control-Allow-Credentials: true');

    
    //Require Files
    require_once "../config/productConfig.php";
   
    $fileName = $_GET['fileName'];

    $file = USER_DOWNLOAD_PATH.$fileName;

    if(file_exists($file)) {

        $type = filetype($file);
        header("Access-Control-Allow-Origin: *");
        header("Content-type: $type");
        header("Content-Disposition: attachment;filename=".basename($file));
        header("Content-Transfer-Encoding: binary");
        header('Pragma: no-cache');
        header('Expires: 0');
        set_time_limit(0);
        readfile($file);
        exit;

    } else {

        $angularResponse["response"]["responseData"]["userMsg"] = "Download file may not exist";
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		echo json_encode($angularResponse);

    }

?>
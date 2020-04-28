<?php
    //Server access headers defined
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
    header('Access-Control-Allow-Credentials: true');

    //Require Files
    require_once "../config/productConfig.php";

    // Count # of uploaded files in array
    $total = count($_FILES['purpose']['name']);
    $total1 = count($_FILES['detailed']['name']);
    $total2 = count($_FILES['estimated']['name']);
    $total3 = count($_FILES['period']['name']);
    $total4 = count($_FILES['purpose1']['name']);

    $jsonImg = '{"purposeOfProject1":[';

    // Loop through each file
	for( $i=0 ; $i < $total ; $i++ ) {
        //Get the temp file path
        $tmpFilePath = $_FILES['purpose']['tmp_name'][$i];
        //Make sure we have a file path
        if ($tmpFilePath != ""){
            $target_file = basename($_FILES["purpose"]["name"][$i]);
            $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
            $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
            $newFilePath = USER_UPLOAD_PATH . $file_url;
            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                //echo "success :".$name;
                $jsonImg = $jsonImg.'"'.$file_url.'",';
            }else{
                echo "not success";
            }
        }
    }
    $jsonImg = substr($jsonImg, 0, -1);
    $jsonImg = $jsonImg.'],';

    // Loop through each file
    $jsonImg = $jsonImg.'"detailedInformation":[';
	for( $i=0 ; $i < $total1 ; $i++ ) {
        //Get the temp file path
        $tmpFilePath = $_FILES['detailed']['tmp_name'][$i];
        //Make sure we have a file path
        if ($tmpFilePath != ""){
            $target_file = basename($_FILES["detailed"]["name"][$i]);
            $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
            $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
            $newFilePath = USER_UPLOAD_PATH . $file_url;
            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                //echo "success :".$name;
                $jsonImg = $jsonImg.'"'.$file_url.'",';
            }else{
                echo "not success";
            }
        }
    }
    $jsonImg = substr($jsonImg, 0, -1);
    $jsonImg = $jsonImg.'],';

    // Loop through each file
    $jsonImg = $jsonImg.'"estimatedBudget":[';
	for( $i=0 ; $i < $total2 ; $i++ ) {
        //Get the temp file path
        $tmpFilePath = $_FILES['estimated']['tmp_name'][$i];
        //Make sure we have a file path
        if ($tmpFilePath != ""){
            $target_file = basename($_FILES["estimated"]["name"][$i]);
            $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
            $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
            $newFilePath = USER_UPLOAD_PATH . $file_url;
            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                //echo "success :".$name;
                $jsonImg = $jsonImg.'"'.$file_url.'",';
            }else{
                echo "not success";
            }
        }
    }
    $jsonImg = substr($jsonImg, 0, -1);
    $jsonImg = $jsonImg.'],';

    // Loop through each file
    $jsonImg = $jsonImg.'"periodOfTime":[';
	for( $i=0 ; $i < $total3 ; $i++ ) {
        //Get the temp file path
        $tmpFilePath = $_FILES['period']['tmp_name'][$i];
        //Make sure we have a file path
        if ($tmpFilePath != ""){
            $target_file = basename($_FILES["period"]["name"][$i]);
            $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
            $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
            $newFilePath = USER_UPLOAD_PATH . $file_url;
            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                //echo "success :".$name;
                $jsonImg = $jsonImg.'"'.$file_url.'",';
            }else{
                echo "not success";
            }
        }
    }
    $jsonImg = substr($jsonImg, 0, -1);
    $jsonImg = $jsonImg.'],';

    // Loop through each file
    $jsonImg = $jsonImg.'"purposeOfProject2":[';
	for( $i=0 ; $i < $total4 ; $i++ ) {
        //Get the temp file path
        $tmpFilePath = $_FILES['purpose1']['tmp_name'][$i];
        //Make sure we have a file path
        if ($tmpFilePath != ""){
            $target_file = basename($_FILES["purpose1"]["name"][$i]);
            $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
            $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
            $newFilePath = USER_UPLOAD_PATH . $file_url;
            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                //echo "success :".$name;
                $jsonImg = $jsonImg.'"'.$file_url.'",';
            }else{
                echo "not success";
            }
        }
    }
    $jsonImg = substr($jsonImg, 0, -1);
    $jsonImg = $jsonImg.']}';
    
    //echo "json Val :".$jsonImg;
    header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	echo json_encode($jsonImg);


?>
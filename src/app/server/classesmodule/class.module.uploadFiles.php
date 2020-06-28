<?php
    //Server access headers defined
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
    header('Access-Control-Allow-Credentials: true');

    //Require Files
    require_once "../config/productConfig.php";

    $arrayVals = array();
    $arrayVals['purposeOfProject1'][0] = "No Files";
    $arrayVals['detailedInformation'][0] = "No Files";
    $arrayVals['estimatedBudget'][0] = "No Files";
    $arrayVals['periodOfTime'][0] = "No Files";
    $arrayVals['purposeOfProject2'][0] = "No Files";
    $arrayVals['errors'] = array();

    
    $formsVal = $_REQUEST['formValue'];

    $errorIndex = -1;

    // Count # of uploaded files in array
    $total = count($_FILES['purpose']['name']);
    $total1 = count($_FILES['detailed']['name']);
    $total2 = count($_FILES['estimated']['name']);
    $total3 = count($_FILES['period']['name']);
    $total4 = count($_FILES['purpose1']['name']);

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
                //$arrayVals.push($file_url);
                $arrayVals['purposeOfProject1'][$i] = $file_url;
            }else{
                $arrayVals['errors'][$errorIndex+1] = $file_url;
            }
        }
    }
   
    // Loop through each file
   
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
                $arrayVals['detailedInformation'][$i] = $file_url;
            }else{
                $arrayVals['errors'][$errorIndex+1] = $file_url;
            }
        }
    }
   
    // Loop through each file
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
                $arrayVals['estimatedBudget'][$i] = $file_url;
            }else{
                $arrayVals['errors'][$errorIndex+1] = $file_url;
            }
        }
    }
   
    // Loop through each file
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
                $arrayVals['periodOfTime'][$i] = $file_url;
            }else{
                $arrayVals['errors'][$errorIndex+1] = $file_url;
            }
        }
    }
   
    // Loop through each file
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
                $arrayVals['purposeOfProject2'][$i] = $file_url;
            }else{
                $arrayVals['errors'][$errorIndex+1] = $file_url;
            }
        }
    }

    
    if($formsVal == 2){
        $arrayVals['ngoCertifiedOfficial'][0] = "No Files";
        $arrayVals['ngoCertifiedDeed'][0] = "No Files";
        $arrayVals['ngoCertifiedBudget'][0] = "No Files";
        $arrayVals['ngoCertifiedActivity'][0] = "No Files";
        $arrayVals['certifiedId'][0] = "No Files";

        $total5 = count($_FILES['ngoCertifiedOfficial']['name']);
        $total6 = count($_FILES['ngoCertifiedDeed']['name']);
        $total7 = count($_FILES['ngoCertifiedBudget']['name']);
        $total8 = count($_FILES['ngoCertifiedActivity']['name']);
        $total9 = count($_FILES['certifiedId']['name']);

        for( $i=0 ; $i < $total5 ; $i++ ) {
            //Get the temp file path
            $tmpFilePath = $_FILES['ngoCertifiedOfficial']['tmp_name'][$i];
            //Make sure we have a file path
            if ($tmpFilePath != ""){
                $target_file = basename($_FILES["ngoCertifiedOfficial"]["name"][$i]);
                $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
                $newFilePath = USER_UPLOAD_PATH . $file_url;
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $arrayVals['ngoCertifiedOfficial'][$i] = $file_url;
                }else{
                    $arrayVals['errors'][$errorIndex+1] = $file_url;
                }
            }
        }

        for( $i=0 ; $i < $total6 ; $i++ ) {
            //Get the temp file path
            $tmpFilePath = $_FILES['ngoCertifiedDeed']['tmp_name'][$i];
            //Make sure we have a file path
            if ($tmpFilePath != ""){
                $target_file = basename($_FILES["ngoCertifiedDeed"]["name"][$i]);
                $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
                $newFilePath = USER_UPLOAD_PATH . $file_url;
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $arrayVals['ngoCertifiedDeed'][$i] = $file_url;
                }else{
                    $arrayVals['errors'][$errorIndex+1] = $file_url;
                }
            }
        }

        for( $i=0 ; $i < $total7 ; $i++ ) {
            //Get the temp file path
            $tmpFilePath = $_FILES['ngoCertifiedBudget']['tmp_name'][$i];
            //Make sure we have a file path
            if ($tmpFilePath != ""){
                $target_file = basename($_FILES["ngoCertifiedBudget"]["name"][$i]);
                $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
                $newFilePath = USER_UPLOAD_PATH . $file_url;
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $arrayVals['ngoCertifiedBudget'][$i] = $file_url;
                }else{
                    $arrayVals['errors'][$errorIndex+1] = $file_url;
                }
            }
        }

        for( $i=0 ; $i < $total8 ; $i++ ) {
            //Get the temp file path
            $tmpFilePath = $_FILES['ngoCertifiedActivity']['tmp_name'][$i];
            //Make sure we have a file path
            if ($tmpFilePath != ""){
                $target_file = basename($_FILES["ngoCertifiedActivity"]["name"][$i]);
                $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
                $newFilePath = USER_UPLOAD_PATH . $file_url;
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $arrayVals['ngoCertifiedActivity'][$i] = $file_url;
                }else{
                    $arrayVals['errors'][$errorIndex+1] = $file_url;
                }
            }
        }

        for( $i=0 ; $i < $total9 ; $i++ ) {
            //Get the temp file path
            $tmpFilePath = $_FILES['certifiedId']['tmp_name'][$i];
            //Make sure we have a file path
            if ($tmpFilePath != ""){
                $target_file = basename($_FILES["certifiedId"]["name"][$i]);
                $file_name_only = pathinfo($target_file, PATHINFO_FILENAME);
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $file_url =  date("YmdHis") ."___".$file_name_only ."." . $fileType;
                $newFilePath = USER_UPLOAD_PATH . $file_url;
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $arrayVals['certifiedId'][$i] = $file_url;
                }else{
                    $arrayVals['errors'][$errorIndex+1] = $file_url;
                }
            }
        }


    }
      
    
    header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	echo json_encode($arrayVals);
?>

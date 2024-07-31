<?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
    $EG_RECE_TRAN_ID = $_POST['EG_RECE_TRAN_ID'];
    $EG_FINISH_DATE = $_POST['EG_FINISH_DATE'];
    $EG_FINISH_TYPE = $_POST['EG_FINISH_TYPE'];
    $EG_FINISH_DESC = $_POST['EG_FINISH_DESC'];
    $CREATED_BY = $_POST['CREATED_BY'];
    $LAST_UPDATED_BY = $_POST['LAST_UPDATED_BY'];
    $LAST_UPDATE_LOGIN = $_POST['LAST_UPDATE_LOGIN'];
    $EG_MACHINE_ACT_STOP = $_POST['EG_MACHINE_ACT_STOP'];
    $EG_WORK_GRADE = $_POST['EG_WORK_GRADE'];
    $EG_WORK_CORRECTIVE = $_POST['EG_WORK_CORRECTIVE'];


    $sqlQery = "SELECT * FROM SF_EG_FINISH_TRAN f
    WHERE f.eg_rece_tran_id = '$EG_RECE_TRAN_ID'";
    $response = oci_parse($objConnect, $sqlQery,);
    oci_execute($response, OCI_DEFAULT);
    $objResult = oci_fetch_array($response);


    if ($objResult) {

        $sqlUpdate = "UPDATE SF_EG_FINISH_TRAN SET EG_FINISH_DATE='$EG_FINISH_DATE',EG_FINISH_TYPE = '',
                EG_FINISH_DESC='$EG_FINISH_DESC',CREATION_DATE=SYSDATE,CREATED_BY= $CREATED_BY,LAST_UPDATE_LOGIN=null,
                EG_MACHINE_ACT_STOP=$EG_MACHINE_ACT_STOP,EG_WORK_GRADE='',EG_WORK_CORRECTIVE=''
                WHERE EG_RECE_TRAN_ID = '$EG_RECE_TRAN_ID'";
        $s = oci_parse($objConnect, $sqlUpdate);
        $objExecute = oci_execute($s);

        if ($objExecute) {
            echo 'true';
        } else {
            $e = oci_error($objExecute);
            echo 'false' . $e;
        }
        
    } else {

        $sqlInsert = "INSERT INTO sfi.SF_EG_FINISH_TRAN (EG_RECE_TRAN_ID,EG_FINISH_DATE,EG_FINISH_TYPE,EG_FINISH_DESC,CREATION_DATE,CREATED_BY,
        LAST_UPDATE_DATE,LAST_UPDATED_BY,LAST_UPDATE_LOGIN,EG_MACHINE_ACT_STOP,EG_WORK_GRADE,EG_WORK_CORRECTIVE)
        VALUES($EG_RECE_TRAN_ID,'$EG_FINISH_DATE','','$EG_FINISH_DESC',SYSDATE,$CREATED_BY,SYSDATE,$CREATED_BY,
        null,$EG_MACHINE_ACT_STOP,'','')";
        $s = oci_parse($objConnect, $sqlInsert);
        $objExecute = oci_execute($s);
    
        if ($objExecute) {
            echo 'true';
        } else {
            $e = oci_error($objExecute);
            echo 'false'.$e;
        }
    }
    oci_commit($objConnect);
    oci_close($objConnect);
}

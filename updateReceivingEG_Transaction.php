<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
     $TRAN_DOCUMENT = $_POST['TRAN_DOCUMENT'];
    $MACHINE_ID = $_POST['MACHINE_ID'];
    $EG_RECE_EST_TIME = $_POST['EG_RECE_EST_TIME'];
    $EG_RECE_EST_DATE = $_POST['EG_RECE_EST_DATE'];
    $LAST_UPDATED_BY = $_POST['LAST_UPDATED_BY'];
    $LAST_UPDATE_LOGIN = $_POST['LAST_UPDATE_LOGIN'];
    $EG_MACHINE_STD_STOP = $_POST['EG_MACHINE_STD_STOP'];
    $BUDGET_CODE = $_POST['BUDGET_CODE'];
    $EG_RECE_PROBLEM = $_POST['EG_RECE_PROBLEM'];
    $EG_RECE_METHOD = $_POST['EG_RECE_METHOD'];
    $EG_RECE_BUDGET = $_POST['EG_RECE_BUDGET'];
    $EG_RECE_PURCHASE = $_POST['EG_RECE_PURCHASE'];
    $EG_RECE_PROCESS = $_POST['EG_RECE_PROCESS'];
    $EG_RECE_EXTERNAL = $_POST['EG_RECE_EXTERNAL'];
    $BUDGET_ID = $_POST['BUDGET_ID'];
    $EG_RECE_STATUS_APP = $_POST['EG_RECE_STATUS_APP'];
    $EG_RECE_LOCATION = $_POST['EG_RECE_LOCATION'];

    if($EG_RECE_BUDGET == 'null' ){
        $EG_RECE_BUDGET = null;
    }

    if($EG_MACHINE_STD_STOP == 'null' ){
        $EG_MACHINE_STD_STOP = null;
    }

   if($EG_RECE_EXTERNAL == 0 || $EG_RECE_EXTERNAL == null ){
       $EG_RECE_EXTERNAL = null;
   }

   if($EG_RECE_PURCHASE == 0 || $EG_RECE_PURCHASE == null){
       $EG_RECE_PURCHASE = null;
   }

   if($EG_RECE_PROCESS == 0 || $EG_RECE_PROCESS == null){
    $EG_RECE_PROCESS = null;
}

    $sql = "UPDATE sf_eg_receive_tran  SET MACHINE_ID = '$MACHINE_ID',EG_RECE_EST_TIME='$EG_RECE_EST_TIME',EG_RECE_EST_DATE = '$EG_RECE_EST_DATE',
    LAST_UPDATED_BY='$LAST_UPDATED_BY',LAST_UPDATE_LOGIN='$LAST_UPDATE_LOGIN',EG_MACHINE_STD_STOP='$EG_MACHINE_STD_STOP',BUDGET_CODE='$BUDGET_CODE',EG_RECE_PROBLEM='$EG_RECE_PROBLEM',
    EG_RECE_METHOD='$EG_RECE_METHOD',EG_RECE_BUDGET='$EG_RECE_BUDGET',EG_RECE_PURCHASE='$EG_RECE_PURCHASE',EG_RECE_PROCESS='$EG_RECE_PROCESS',EG_RECE_EXTERNAL='$EG_RECE_EXTERNAL',BUDGET_ID='$BUDGET_ID',
    EG_RECE_STATUS_APP = '$EG_RECE_STATUS_APP',EG_RECE_LOCATION = '$EG_RECE_LOCATION'
    WHERE eg_rece_document = $TRAN_DOCUMENT";
     $s = oci_parse($objConnect, $sql);
     $objExecute = oci_execute($s);

    if ($objExecute) {
        echo 'true';
    } else {
        $e = oci_error($objExecute);
        echo 'false'.$e;
        
    }
    oci_commit($objConnect);
    oci_close($objConnect);

   
}

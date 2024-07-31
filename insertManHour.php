<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
    $EG_RECE_TRAN_ID = $_POST['EG_RECE_TRAN_ID'];
    $EG_MH_SFI_CODE = $_POST['EG_MH_SFI_CODE'];
    $EG_MH_HOUR_ACT = $_POST['EG_MH_HOUR_ACT'];
    $EG_MH_HOUR_STD = $_POST['EG_MH_HOUR_STD'];
    $EG_MH_NUMBER = $_POST['EG_MH_NUMBER'];
    $EMPLOYEE_CODE = $_POST['EMPLOYEE_CODE'];
   // $rid = $_POST['rid'];

   $sqlInsert = "INSERT INTO sfi.sf_eg_man_hour (EG_RECE_TRAN_ID,EG_MH_SFI_CODE,EG_MH_HOUR_ACT,EG_MH_HOUR_STD,EG_MH_NUMBER,EMPLOYEE_CODE)
        VALUES('$EG_RECE_TRAN_ID','$EG_MH_SFI_CODE','$EG_MH_HOUR_ACT','$EG_MH_HOUR_STD','$EG_MH_NUMBER','$EMPLOYEE_CODE')";
        $s = oci_parse($objConnect, $sqlInsert);
        $objExecute = oci_execute($s);
    
        if ($objExecute) {
            echo 'true';
        } else {
            $e = oci_error($objExecute);
            echo 'false';
        }

        oci_commit($objConnect);
    oci_close($objConnect);

   
}

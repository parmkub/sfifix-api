<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     require_once 'connect.php';
    //require_once 'connect-test.php';
    $empCode = $_POST['empCode'];
    $tranID = $_POST['egReceTranID'];
  

    $sql = "DELETE FROM sfi.sf_eg_man_hour t 
    WHERE t.EG_RECE_TRAN_ID = '$tranID'
    AND t.EMPLOYEE_CODE = '$empCode'";
    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($objExecute) {
        echo 'true';
    } else {
        echo 'false';
    }
    oci_commit($objConnect);
    oci_close($objConnect);
}

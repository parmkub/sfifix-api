<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    ///require_once 'connect-test.php';
    $documentNo = $_GET['documentNo'];
    $cancleDetail =$_GET['cancleDetail'];
   

    $sql = "UPDATE sf_eg_receive_tran r SET r.EG_RECE_STATUS_APP = 3,r.eg_rece_status_other = '$cancleDetail'
    WHERE r.eg_rece_document = $documentNo";
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

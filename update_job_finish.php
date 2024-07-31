<?php

    require_once 'connect.php';
    ///require_once 'connect-test.php';
    $eg_rece_document = $_GET['eg_rece_document'];
 
    $sql = "UPDATE sf_eg_receive_tran r SET r.EG_RECE_STATUS = 1 WHERE r.eg_rece_document = $eg_rece_document";
    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($objExecute) {
        echo 'true';
    } else {
        echo 'false';
    }
    oci_commit($objConnect);
    oci_close($objConnect);



<?php

    require_once 'connect.php';
    ///require_once 'connect-test.php';
    $eg_rece_tran_id = $_POST['TranID'];
    $eg_rece_status = $_POST['EG_RECE_STATUS'];
    $eg_rece_status_other = $_POST['EG_RECE_STATUS_OTHER'];

    $sql = "UPDATE sf_eg_receive_tran r SET r.EG_RECE_STATUS = $eg_rece_status,
    r.EG_RECE_STATUS_OTHER = '$eg_rece_status_other'  WHERE r.EG_RECE_TRAN_ID = $eg_rece_tran_id";
    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($objExecute) {
        echo 'true';
    } else {
        echo 'false';
    }
    oci_commit($objConnect);
    oci_close($objConnect);



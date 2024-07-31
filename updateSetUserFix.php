<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    ///require_once 'connect-test.php';
    $empCode = $_GET['empcode'];
    $rid = $_GET['rid'];

    $sql = "UPDATE sf_eg_receive_tran r SET r.EMPLOYEE_CODE = $empCode  WHERE r.eg_rece_document = $rid";
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

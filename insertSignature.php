<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';

    $name = $_POST['sign_name'];
    $type = $_POST['sign_type'];
    $data = $_POST['sign_data'];
    $status = $_POST['sing_status'];
    $informNo = $_POST['inform_no'];
   // $rid = $_POST['rid'];

    $sql = "INSERT INTO sfi.sf_eng_fixapp_sign (sign_name, sign_type, sign_data, sing_status,inform_no,date_time)VALUES('$name','$type','$data','$status','$informNo',SYSDATE)";
    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($objExecute) {
        echo 'true';
    } else {
        echo 'false';
    }
}

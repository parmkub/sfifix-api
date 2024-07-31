<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';

    $informNo = $_POST['jobid'];
    $imgName = $_POST['imgname'];
    $imgStatus = $_POST['imagestatus'];
    $empName = $_POST['empname'];
    $empCode = $_POST['empcode'];
   // $rid = $_POST['rid'];

    $sql = "INSERT INTO sfi.sf_eng_fixapp_image (inform_no, img_name, img_status, employee_name,employee_code,date_time)VALUES('$informNo','$imgName','$imgStatus','$empName','$empCode',SYSDATE)";
    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($objExecute) {
        echo 'true';
    } else {
        echo 'false';
    }
}

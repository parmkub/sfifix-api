<?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //require_once 'connect.php';
    require_once 'connect-test.php';
    $empCode = $_POST['empCode'];
    $toKen = $_POST['toKen'];
    $nAme = $_POST['nAme'];
  

    $sqlQery = "SELECT * FROM sf_emp_mobile_token
    where empcode = '$empCode'";
    $response = oci_parse($objConnect, $sqlQery,);
    oci_execute($response, OCI_DEFAULT);
    $objResult = oci_fetch_array($response);


    if ($objResult) {

        $sqlUpdate = "UPDATE sf_emp_mobile_token  SET NAME='$nAme',TOKEN='$toKen'
                WHERE EMPCODE = '$empCode'";
        $s = oci_parse($objConnect, $sqlUpdate);
        $objExecute = oci_execute($s);

        if ($objExecute) {
            echo 'true';
        } else {
            $e = oci_error($objExecute);
            echo 'false';
        }
    } else {

        $sqlInsert = "INSERT INTO sfi.sf_emp_mobile_token (EMPCODE,NAME,TOKEN)
        VALUES('$empCode','$nAme','$toKen')";

        $s = oci_parse($objConnect, $sqlInsert);
        $objExecute = oci_execute($s);
    
        if ($objExecute) {
            echo 'true';
        } else {
            $e = oci_error($objExecute);
            echo 'false';
        }
    }
    oci_commit($objConnect);
    oci_close($objConnect);
}

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     require_once 'connect.php';
    //require_once 'connect-test.php';
    $itemEstId = $_POST['item_est_id'];
    $tranID = $_POST['eg_rece_tran_id'];
  

    $sql = "DELETE FROM sfi.sf_eg_item_est t 
    WHERE t.eg_rece_tran_id = '$tranID'
    AND t.item_est_id = '$itemEstId'";
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

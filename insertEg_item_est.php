<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     require_once 'connect.php';
    //require_once 'connect-test.php';
    $itemEstId = $_POST['item_est_id'];
    $tranID = $_POST['eg_rece_tran_id'];
    $estQty = $_POST['item_est_qty'];
    $estPrice = $_POST['item_est_price'];
    $estUOM = $_POST['item_est_uom'];
    $deleteMark = $_POST['delete_mark'];
    $createBy = $_POST['created_by'];
    $lastUpdateBy = $_POST['last_update_by'];
   // $rid = $_POST['rid'];

    $sql = "INSERT INTO sfi.SF_EG_ITEM_EST (ITEM_EST_ID,EG_RECE_TRAN_ID, ITEM_EST_QTY, ITEM_EST_PRICE, ITEM_EST_UOM,DELETE_MARK,CREATION_DATE,CREATED_BY,LAST_UPDATE_DATE,LAST_UPDATED_BY)
    VALUES('$itemEstId','$tranID','$estQty','$estPrice','$estUOM','0',SYSDATE,'$createBy',SYSDATE,'$lastUpdateBy')";
    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($objExecute) {
        echo 'true';
    } else {
        echo 'false';
    }
}

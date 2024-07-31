<?php
 require_once 'connect.php';

 if($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['documentNo'])){
    $documentNo = $_POST['documentNo'];
    $documentNo = implode("','",$documentNo);

    

    $sql = "UPDATE sf_qc_hygienic_screening h SET h.qc_check_before = 1 , h.QC_CHECK_AFFTER = 1 WHERE h.eg_rece_tran_id in ('$documentNo')";
    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);
    oci_commit($objConnect);
    oci_close($objConnect);
    echo 'true';
    }else{
        echo 'false';
    }

?>
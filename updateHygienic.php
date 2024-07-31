<?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
    $EG_RECE_TRAN_ID = $_POST['EG_RECE_TRAN_ID'];
    $PRODUCT_USERNAME = $_POST['PRODUCT_USERNAME'];
    $QC_USERNAME = $_POST['QC_USERNAME'];
    $PRODCT_SECT_CODE = $_POST['PRODCT_SECT_CODE'];
    $QC_SECT_CODE = $_POST['QC_SECT_CODE'];
    $PRODUCT_CHECK_BEFORE = $_POST['PRODUCT_CHECK_BEFORE'];
    $PRODUCT_CHECK_AFFTER = $_POST['PRODUCT_CHECK_AFFTER'];
    $QC_CHECK_BEFORE = $_POST['QC_CHECK_BEFORE'];
    $QC_CHECK_AFFTER = $_POST['QC_CHECK_AFFTER'];
    $DETAIL_BEFORE = $_POST['DETAIL_BEFORE'];
    $DETAIL_AFFTER = $_POST['DETAIL_AFFTER'];

   


    $sqlQery = "SELECT * FROM SF_QC_HYGIENIC_SCREENING h
    WHERE h.eg_rece_tran_id = '$EG_RECE_TRAN_ID'";
    $response = oci_parse($objConnect, $sqlQery,);
    oci_execute($response, OCI_DEFAULT);
    $objResult = oci_fetch_array($response,OCI_ASSOC+OCI_RETURN_NULLS);
    $num_row = oci_num_rows($response);

    if ($objResult) {

        echo "มีข้อมูล ให้อัพเดท";
        $sqlUpdate = "UPDATE SF_QC_HYGIENIC_SCREENING SET EG_RECE_TRAN_ID='$EG_RECE_TRAN_ID',PRODUCT_USERNAME = '$PRODUCT_USERNAME',
                QC_USERNAME='$QC_USERNAME',PRODCT_SECT_CODE='$PRODCT_SECT_CODE',QC_SECT_CODE= '$QC_SECT_CODE',PRODUCT_CHECK_BEFORE='$PRODUCT_CHECK_BEFORE',
                PRODUCT_CHECK_AFFTER=$PRODUCT_CHECK_AFFTER,QC_CHECK_BEFORE='$QC_CHECK_BEFORE',QC_CHECK_AFFTER='$QC_CHECK_AFFTER',CHECK_DATE=SYSDATE,
                DETAIL_BEFORE='$DETAIL_BEFORE',DETAIL_AFFTER='$DETAIL_AFFTER'
                WHERE EG_RECE_TRAN_ID = '$EG_RECE_TRAN_ID'";
        $s = oci_parse($objConnect, $sqlUpdate);
        $objExecute = oci_execute($s);
      

        if ($objExecute) {
            echo 'true';
            echo '<script>swal({
                title: "บันทึกข้อมูลสำเร็จ",
                text: "กรุณากดปุ่มตกลง",
                icon: "success",
                confirmButtomText: "ตกลง",
                
              }).then(()=>{
                window.location.replace("");
              });
             
              </script>';
        } else {
            $e = oci_error($objExecute);
            echo 'false' . $e;
                oci_rollback($objConnect);
                echo '<script>swal({
                        title: "บันทึกข้อมูลไม่สำเร็จ",
                        text: "กรุณากดปุ่มตกลง",
                        icon: "error",
                        button: "ตกลง",
                      });
                      </script>';
        }
        
    } else {
        echo "ไม่มีข้อมูล ให้ Insert";

        // $sqlInsert = "INSERT INTO SF_QC_HYGIENIC_SCREENING (EG_RECE_TRAN_ID,PRODUCT_USERNAME,QC_USERNAME,PRODCT_SECT_CODE,QC_SECT_CODE,PRODUCT_CHECK_BEFORE,
        // PRODUCT_CHECK_AFFTER,QC_CHECK_BEFORE,QC_CHECK_AFFTER,CHECK_DATE,DETAIL_BEFORE,DETAIL_AFFTER)
        // VALUES($EG_RECE_TRAN_ID,'$PRODUCT_USERNAME','$QC_USERNAME','$PRODCT_SECT_CODE','$QC_SECT_CODE',$PRODUCT_CHECK_BEFORE,'$PRODUCT_CHECK_AFFTER',$QC_CHECK_BEFORE,
        // '$QC_CHECK_AFFTER',SYSDATE,'$DETAIL_BEFORE','$DETAIL_AFFTER' )";

        $sqlInsert = "INSERT INTO SF_QC_HYGIENIC_SCREENING (EG_RECE_TRAN_ID,PRODUCT_USERNAME,QC_USERNAME,PRODCT_SECT_CODE,QC_SECT_CODE,PRODUCT_CHECK_BEFORE,
        PRODUCT_CHECK_AFFTER,QC_CHECK_BEFORE,QC_CHECK_AFFTER,CHECK_DATE,DETAIL_BEFORE,DETAIL_AFFTER)
        VALUES($EG_RECE_TRAN_ID,'$PRODUCT_USERNAME','$QC_USERNAME','$PRODCT_SECT_CODE','$QC_SECT_CODE','1','1','1',
        '1',SYSDATE,'$DETAIL_BEFORE','$DETAIL_AFFTER' )";

        $s = oci_parse($objConnect, $sqlInsert);
        $objExecute = oci_execute($s);
    
        if ($objExecute) {
            echo 'true';
            echo '<script>swal({
                title: "บันทึกข้อมูลสำเร็จ",
                text: "กรุณากดปุ่มตกลง",
                icon: "success",
                confirmButtomText: "ตกลง",
                
              }).then(()=>{
                window.location.replace("");
              });
             
              </script>';
        } else {
            $e = oci_error($objExecute);
            echo 'false'.$e;
            echo '<script>swal({
                title: "บันทึกข้อมูลไม่สำเร็จ",
                text: "กรุณากดปุ่มตกลง",
                icon: "error",
                button: "ตกลง",
              });
              </script>';
        }
    }
    oci_commit($objConnect);
    oci_close($objConnect);
}

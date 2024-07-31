<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //require_once 'connect-test.php';
    require_once 'connect.php';
    $eg_rece_document = $_GET['eg_rece_document'];

    $sql = "SELECT
    *
    FROM sf_eg_receive_tran 
    WHERE eg_rece_document = '$eg_rece_document'";
   $response = oci_parse($objConnect, $sql,);
   $output = null;


       if(oci_execute($response)){
           while($row =  oci_fetch_assoc($response)){
               $output[] = $row;
           }
           echo json_encode($output);
       }
       else {
           echo "Null";
       }



   oci_close($objConnect);
  
}
   

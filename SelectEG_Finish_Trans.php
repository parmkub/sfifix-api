<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $eg_rece_tranID = $_GET['eg_rece_tranID'];

    $sql = "SELECT
    *
    FROM sf_eg_finish_tran
    WHERE eg_rece_tran_id = '$eg_rece_tranID' ";
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
   

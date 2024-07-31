<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';

    $tranID = $_GET['tranID'];

    $sql = "SELECT
    p.item_est_id,
    p.eg_rece_tran_id,
    m.description,
    p.item_est_qty,
    p.item_est_price,
    p.item_est_uom,
    p.delete_mark,
    p.creation_date,
    p.created_by,
    p.last_update_date,
    p.last_updated_by,
    p.last_update_login    
FROM SF_EG_ITEM_EST p ,sf_eg_item_est_mst m
WHERE p.eg_rece_tran_id = '$tranID'
AND p.item_est_id = m.item_est_id (+)
ORDER BY p.creation_date";
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
   

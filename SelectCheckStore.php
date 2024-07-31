<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //require_once 'connect-test.php';
    require_once 'connect.php';
    $eg_rece_document = $_GET['eg_rece_document'];

    $sql = " SELECT
    st.eng_online eg_tran_document,
    st.request_item_id,
    st.request_location,
    st.request_qty,
    st.request_uom,
    st.request_comment,
    (select  a.description item_desc1
     from apps.MTL_SYSTEM_ITEMS a
     where a.organization_id = 82
     and a.INVENTORY_ITEM_ID = st.request_item_id
     and SUBSTR(a.segment1,1,2) IN ('12','13','91'))dtail
  FROM sf_store_request_dtl st
  WHERE  st.eng_online ='$eg_rece_document'";
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
   

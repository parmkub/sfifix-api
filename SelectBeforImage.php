<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $jobcode = $_GET['jobcode'];

    $sql = "SELECT
    inform_no,
    img_name,
    img_status
FROM sfi.sf_eng_fixapp_image 
WHERE inform_no = '$jobcode'
AND img_status = 'before'
ORDER BY image_id DESC";
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
   

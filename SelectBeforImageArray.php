<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $jobcode = $_GET['jobcode'];

    $sql = "SELECT
    inform_no,
    img_before,
    img_affrer
FROM sfi.sf_eng_fixapp_image 
WHERE inform_no = '$jobcode'
ORDER BY image_id DESC";
  $s = oci_parse($objConnect, $sql);
  $objExecute = oci_execute($s);

  if ($row = oci_fetch_assoc($s)) {
      $result[] = $row ;
      echo json_encode($result);
      oci_close($objConnect);
  } else {
      
      echo 'Null';
      oci_close($objConnect);
  }
   
}
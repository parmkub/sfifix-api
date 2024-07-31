<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once '../connect.php';
    $report_to_employee_code = $_GET['report_to_employee_code'];
   

    $sql = "SELECT 'งานทั้งหมด'name, count(eg_rece_tran_id) valude  FROM sf_eg_receive_tran
    WHERE  eg_rece_status = '0'
    AND report_to_employee_code = '530098'
    union all
    SELECT  'มอบหมาย',count(employee_code) ass  FROM sf_eg_receive_tran
    WHERE  eg_rece_status = '0'
    AND report_to_employee_code = '$report_to_employee_code'";


   $response = oci_parse($objConnect, $sql,);
   $output = [];


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
   

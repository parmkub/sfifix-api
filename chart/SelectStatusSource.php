<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once '../connect.php';
    //$source = $_GET['dataSource'];
    $report_to_employee_code = $_GET['report_to_employee_code'];
    //$report_data_source = $_GET['report_data_source'];
    // echo $report_data_source;
    // echo $report_to_employee_code;
 
  

    $sql = "SELECT  ('งานทั้งหมด')name ,count(eg_rece_tran_id)valude FROM sf_eg_receive_tran 
    WHERE report_to_employee_code = '$report_to_employee_code'
    AND TO_CHAR(eg_rece_date,'MON-RR') = TO_CHAR(SYSDATE,'MON-RR')
    union all
    SELECT ('ไม่เสร็จ')name ,count(eg_rece_tran_id)valude FROM sf_eg_receive_tran 
    WHERE report_to_employee_code = '$report_to_employee_code'
    AND TO_CHAR(eg_rece_date,'MON-RR') = TO_CHAR(SYSDATE,'MON-RR')
    AND eg_rece_status = '0'
    union all
    SELECT ('เสร็จ')name ,count(eg_rece_tran_id)valude FROM sf_eg_receive_tran 
    WHERE report_to_employee_code = '$report_to_employee_code'
    AND TO_CHAR(eg_rece_date,'MON-RR') = TO_CHAR(SYSDATE,'MON-RR')
    AND eg_rece_status = '1'
    union all
    SELECT ('ยกเลิก')name ,count(eg_rece_tran_id)valude FROM sf_eg_receive_tran 
    WHERE report_to_employee_code = '$report_to_employee_code'
    AND TO_CHAR(eg_rece_date,'MON-RR') = TO_CHAR(SYSDATE,'MON-RR')
    AND eg_rece_status = '2'";


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
   

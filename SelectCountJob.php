<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $positionGroup = $_GET['positiongroup'];
    $positionCode = $_GET['positionCode'];

    $sql = "SELECT  empv.title || empv.first_name ||' '||empv.last_name name , 
    count( t.employee_code) valude
FROM sfi.sf_per_employees_v empv ,(select * from sf_eg_receive_tran where eg_rece_status = '0')  t
WHERE empv.$positionGroup = '$positionCode'
AND empv.resign_date IS NULL
AND t.employee_code(+)  = empv.employee_code
group by empv.title , empv.first_name , empv.last_name";


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
   

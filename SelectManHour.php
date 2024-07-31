<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';

    $tranID = $_GET['tranID'];

    $sql = "SELECT man.EG_RECE_TRAN_ID,
    man.eg_mh_sfi_code code,
     man.EG_MH_HOUR_ACT ACT,
    man.EG_MH_HOUR_STD STD,
    man.EG_MH_NUMBER MH_NUMBER,
    man.employee_code,
    emp.title||emp.first_name||' '||emp.last_name name
    FROM sf_eg_man_hour man,sf_per_employees_v emp
        WHERE man.eg_rece_tran_id = '$tranID'
        and man.employee_code = emp.employee_code(+)";

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
   

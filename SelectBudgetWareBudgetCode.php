<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $budget_code = $_GET['budget_code'];

    $sql = "SELECT Budget_id
    FROM SFI.SF_BG_BUDGETCODE_MST
    where BUDGET_CODE = '$budget_code'
    AND budget_type = 'F'";


   $response = oci_parse($objConnect, $sql,);
   $output = null;


   if(oci_execute($response)){
       while($row =  oci_fetch_assoc($response)){
           $output = $row['BUDGET_ID'];
       }
       echo $output;
   }
   else {
       echo "Null";
   }
       

   oci_close($objConnect);
  
}
   

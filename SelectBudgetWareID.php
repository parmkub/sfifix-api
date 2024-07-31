<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $budget_id = $_GET['budget_id'];

    $sql = "SELECT BUDGET_CODE  budget_Code
    FROM SFI.SF_BG_BUDGETCODE_MST
    where budget_type = 'F'
    and budget_id = '$budget_id'";


   $response = oci_parse($objConnect, $sql,);
   $output = null;


   if(oci_execute($response)){
       while($row =  oci_fetch_assoc($response)){
           $output = $row['BUDGET_CODE'];
       }
       echo $output;
   }
   else {
       echo "Null";
   }
       

   oci_close($objConnect);
  
}
   

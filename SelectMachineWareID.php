<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $item_est_id = $_GET['item_est_id'];

    $sql = "SELECT  machine_code||' '||machine_name machine_code
    FROM (SELECT cost_Center,cost_center_name FROM SFI.SF_BG_COSTCENTER_V )cc
        ,sfi.sf_eg_item_code_mst egmst
        ,sfi.sf_bg_budgetcode_mst bgmst
    WHERE  cc.cost_Center(+) = egmst.cost_Center
      AND egmst.budget_code = bgmst.budget_code(+)
      and nvl(egmst.MACHINE_STATUS,'0') ='0'
      and nvl(egmst.budget_type,'F') = bgmst.budget_type
      and egmst.machine_id = '$item_est_id'";


   $response = oci_parse($objConnect, $sql,);
   $output = null;


   if(oci_execute($response)){
       while($row =  oci_fetch_assoc($response)){
           $output = $row['MACHINE_CODE'];
       }
       echo $output;
   }
   else {
       echo "Null";
   }
       

   oci_close($objConnect);
  
}
   

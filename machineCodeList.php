
    <?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    require_once 'connect.php';
    $strSQL = "SELECT  machine_code||' '||machine_name||'|'||egmst.machine_id ||'|'|| egmst.budget_code machine_code,machine_id,egmst.budget_code ,bgmst.budget_desc,egmst.cost_Center,cc.cost_Center_name description 
    FROM (SELECT cost_Center,cost_center_name FROM SFI.SF_BG_COSTCENTER_V )cc
        ,sfi.sf_eg_item_code_mst egmst
        ,sfi.sf_bg_budgetcode_mst bgmst
    WHERE  cc.cost_Center(+) = egmst.cost_Center
      AND egmst.budget_code = bgmst.budget_code(+)
      and nvl(egmst.MACHINE_STATUS,'0') ='0'
      and nvl(egmst.budget_type,'F') = bgmst.budget_type";

    //$strSQL = "SELECT first_name||' '||last_name MACHINE_CODE FROM sf_per_employees_v  WHERE resign_date is NULL";

    $response = oci_parse($objConnect, $strSQL,);
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

    ?>

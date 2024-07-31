<?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $sectCode = $_GET['sectcode'];
        //$password = $_POST['password'];
        require_once 'connect.php';
        // $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.2.1.13)(PORT = 1522)))(CONNECT_DATA=(SID=TEST)))";
        // $objConnect = oci_connect("sfi", "sfi", $db, 'AL32UTF8');
        $strSQL = "SELECT  
        empv.title || empv.first_name ||' '||empv.last_name name,
        empv.employee_code emp_code,
        empv.position_name position,
        empv.sect_code sect_code,
        empv.sect_name sect_name,
        empv.divi_name divi_name,
        empv.depart_name depart_name,
        empv.position_group_code groupcode,
        empv.position_group_name position_group_name
        
    FROM sfi.sf_per_employees_v empv
    LEFT JOIN sfi.sf_per_employees emp
    ON empv.employee_id = emp.employee_id
    WHERE empv.sect_code = '$sectCode' AND emp.resign_flag = '0'
    AND empv.position_group_code != '032'";
        $response = oci_parse($objConnect, $strSQL,);

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

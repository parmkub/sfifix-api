<?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $positionGroup = $_GET['positiongroup'];
        $positionCode = $_GET['positioncode'];
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
        empv.divi_code divi_code,
        empv.divi_name divi_name,
        empv.depart_code depart_code,
        empv.depart_name depart_name,
        empv.position_group_code groupcode,
        empv.position_group_name position_group_name
    FROM sfi.sf_per_employees_v empv
    LEFT JOIN sfi.sf_per_employees emp
    ON empv.employee_id = emp.employee_id
    WHERE empv.$positionGroup = '$positionCode'
    AND empv.resign_date IS NULL
    AND emp.resign_date IS NULL
    ORDER BY empv.position_group_code DESC";
    
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

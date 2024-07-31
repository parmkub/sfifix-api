
    <?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
        require_once 'connect.php';
        $strSQL = "SELECT emp.employee_code|| '|' || emp.title||emp.first_name||' '||emp.last_name name from sf_per_employees_v emp
        WHERE resign_date is null 
        AND emp.depart_code = '5400'";


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

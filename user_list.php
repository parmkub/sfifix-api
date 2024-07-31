
    <?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
        require_once 'connect.php';
        $strSQL = "SELECT first_name||' '||last_name name FROM sf_per_employees_v WHERE resign_date is NULL";


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

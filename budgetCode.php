
    <?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        require_once 'connect.php';
        $strSQL = "SELECT BUDGET_CODE||' '|| BUDGET_DESC||'|'|| BUDGET_ID  budget,BUDGET_ID
        FROM SFI.SF_BG_BUDGETCODE_MST
        where budget_type = 'F'";


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


    <?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
        require_once 'connect.php';
        $strSQL = "SELECT
        p.item_est_id||','||p.description||','||p.item_est_price||','||p.item_est_uom DESCRIPTION
        FROM sf_eg_item_est_mst p";


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

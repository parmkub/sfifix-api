
    <?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $empcode = $_GET['empcode'];
        require_once 'connect.php';
        //require_once 'connect-test.php';

        $strSQL = "";


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

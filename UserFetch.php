
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        //$password = $_POST['password'];
        require_once 'connect.php';
        // $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.2.1.13)(PORT = 1522)))(CONNECT_DATA=(SID=TEST)))";
        // $objConnect = oci_connect("sfi", "sfi", $db, 'AL32UTF8');
        $strSQL = "SELECT * from sfi.sf_per_employees_fnduser_v fndemp where fndemp.user_name = '$username'";
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

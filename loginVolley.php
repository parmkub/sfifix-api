
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // require_once 'connect-test.php';
        $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.2.1.13)(PORT = 1522)))(CONNECT_DATA=(SID=TEST)))";
        $objConnect = oci_connect("sfi", "sfi", $db, 'AL32UTF8');
        $strSQL = "SELECT * from sfi.sf_per_employees_fnduser_v fndemp where fndemp.user_name = '$username' AND fndemp.user_id = '$password'";
        $response = oci_parse($objConnect, $strSQL,);
        oci_execute($response);

        $result = array();
        $result['login'] = array();
        if ($row = oci_fetch_assoc($response)) {
            array_push($result['login'], $row);
            $result['success'] = "1";
            $result['message'] = "success";
            echo json_encode($result);
            oci_close($objConnect);
        } else {
            $result['success'] = "0";
            $result['message'] = "error";
            echo json_encode($result);
            oci_close($objConnect);
        }
    }

    ?>

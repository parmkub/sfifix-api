<html>
<head>
<title> PHP & Oracle Tutorial</title>
</head>
<body>
<?php
	
	//$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.2.1.13)(PORT = 1522)))(CONNECT_DATA=(SID=TEST)))";
    //$objConnect = oci_connect("sfi","sfi",$db, 'AL32UTF8');
    
    require_once 'connect.php';
    $json_return = array();
    $strSQL = "SELECT * FROM sfi.sf_per_employees_v emp where emp.depart_code = '0400'";
	$result = oci_parse($objConnect, $strSQL,);
    oci_execute($result,);

    $json_return= array();
    $json_return["employee"]=array();
	
	while($row=oci_fetch_array($result))
            {
				array_push($json_return['employee'],array(
                    "first_name"=> $row[1],
                    "last_name"=> $row[2],
                    "hire_date"=> $row[4],
                    "employee_code"=> $row[8],
                    "birth_date"=> $row[11]));
            }
            $json_return["sucsess"] = "2";
        print json_encode($json_return);

		oci_close($objConnect);

        
	
?>
</body>
</html>
<?php
$User = "sfi";
$pass = "sfi";
$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.2.1.13)(PORT = 1521)))(CONNECT_DATA=(SID=PROD)))";
$objConnect = oci_connect($User,$pass,$db,'AL32UTF8');

?>
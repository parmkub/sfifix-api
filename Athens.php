<?php
header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $empCode = $_GET['empcode'];

    // $sql = "SELECT
    // UPPER(v.eng_first_name||substr(v.eng_last_name,1,1)) username,
    // v.employee_code empcode,
    // v.position_group_code positiongroup,
    // v.position_f_group_name positiongroupname,
    // v.sect_code sectcode,
    // v.divi_code divicode,
    // v.depart_code departcode
    // FROM sfi.sf_per_employees_v v
    // WHERE v.employee_code = '$empCode'
    // AND v.resign_date IS NULL";

    $sql ="SELECT 
    f.user_id userid,
    f.employee_name,
    f.user_name username,
    f.employee_code empcode,
    f.position_group_code positiongroup,
    f.position_name positiongroupname,
    f.sect_code sectcode,
    f.divi_code divicode,
    f.depart_code departcode
FROM sf_per_employees_fnduser_v f
WHERE f.employee_code = '$empCode'
AND f.resign_date IS NULL";

    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($row = oci_fetch_assoc($s)) {
        $result[] = $row ;
        echo json_encode($result);
        oci_close($objConnect);
    } else {
        
        echo 'Null';
        oci_close($objConnect);
    }





    // try{
    //     if ($objExecute) {
    //         while($row =  oci_fetch_assoc($s)){
    //             $output[] = $row;
    //         }
    //         echo json_encode($output);
    //     } else {
    //         echo 'false';
    //     }
    // }catch (Exception $e){
    //     echo 'error'.$e;
    // }
    // oci_close($objConnect);
   
}
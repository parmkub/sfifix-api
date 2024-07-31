<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
    $informNO = $_POST['informNO'];
    $egreasonCode = $_POST['egreasonCode'];
    $createBy = $_POST['createBy'];
    $lastUpdateDate = $_POST['lastUpdateDate'];
    $lastUpdateBy = $_POST['lastUpdateBy'];
    $constCenter = $_POST['constCenter'];
    $informDESC = $_POST['informDESC'];
    $empCodeAnalyse = $_POST['empCodeAnalyse'];
    $informID = $_POST['informID'];
   // $rid = $_POST['rid'];

   $sqlUpdate = "UPDATE sf_eng_inform_hdr r SET r.inform_status = 3 WHERE r.INFORM_ID = $informID";
   $sUpdate = oci_parse($objConnect, $sqlUpdate);
    $objExecuteUpdate = oci_execute($sUpdate);
   
    

    $sqlInsert = "declare Auto_to number;
    BEGIN 
        select sfi.sf_eg_receive_tran_s.nextval
        into Auto_to from dual; 

        INSERT INTO SFI.sf_eg_receive_tran (
    MACHINE_ID,
    EG_RECE_TRAN_ID, 	
    EG_RECE_STATUS,
    EG_PLANNING_CLASS,
    EG_RECE_DATE,
    EG_RECE_DOCUMENT,
    EG_RECE_TYPE,
    DELETE_MARK,
    CREATED_BY,
    LAST_UPDATE_DATE,
    LAST_UPDATED_BY,
    COST_CENTER,
    EG_RECE_COMMENT, 
    REPORT_TO_EMPLOYEE_CODE ,
    INFORM_ID)
    VALUES(
    5015,
    Auto_to,
	0, 
	'LS', 
	sysdate, 
	'$informNO',
	'$egreasonCode',
	0 ,
	'$createBy',
	'$lastUpdateDate',
	'$lastUpdateBy',
	'$constCenter',
	'$informDESC',
	'$empCodeAnalyse',  
	'$informID'
    ); end;";
    $sInsert = oci_parse($objConnect, $sqlInsert);
    $objExecuteInsert = oci_execute($sInsert);

    if ($objExecuteUpdate &&  $objExecuteInsert) {
        echo 'true';
    } else {
        echo 'false';

    }
}

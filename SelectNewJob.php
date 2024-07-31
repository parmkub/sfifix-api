<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
   
    $sql = "Select 
    INFORM_ID,INFORM_NO,TYPE_BUDGET,CHANGE_REQUEST,CHANGE_REQUEST_NO,INFORM_TO,INFORM_DATE,INFORM_FROM,COST_CENTER,MACHINE_CODE,EG_REASON_CODE,INFORM_DESC,e.first_name||' '||e.last_name create_name,INFORM_WORK_ORDER,INFORM_APPROVE_FLAG,
    CREATION_DATE,CREATED_BY,LAST_UPDATE_DATE,LAST_UPDATED_BY,LAST_UPDATE_LOGIN,INFORM_IMPORTANCE,INFORM_STATUS,INFORM_LONG,INFORM_FACTORY,INFORM_BOOK_NO,INFORM_SUP_A,INFORM_DIVI_A,INFORM_DEPT_A,
    INFORM_APPROVE_INFO,INFORM_EMAIL,APPROVED_FLAG,REJECT_FLAG,APPROVED_BY,FINAL_APPROVED,INFORM_POSITION_APPROVED,INFORM_GROUP,INFORM_SEU_ID,INFORM_REMARK
    from sf_eng_inform_hdr i
    INNER JOIN sf_per_employees_v e
    ON i.inform_work_order = e.employee_code
    WHERE i.inform_status = '2'
    AND i.inform_no is not null
    ORDER BY i.inform_date DESC";

    // $sql = "Select 
    // INFORM_ID,INFORM_NO,TYPE_BUDGET,CHANGE_REQUEST,CHANGE_REQUEST_NO,INFORM_TO,INFORM_DATE,INFORM_FROM,COST_CENTER,MACHINE_CODE,EG_REASON_CODE,INFORM_DESC,e.first_name||' '||e.last_name create_name,INFORM_WORK_ORDER,INFORM_APPROVE_FLAG,
    // CREATION_DATE,CREATED_BY,LAST_UPDATE_DATE,LAST_UPDATED_BY,LAST_UPDATE_LOGIN,INFORM_IMPORTANCE,INFORM_STATUS,INFORM_LONG,INFORM_FACTORY,INFORM_BOOK_NO,INFORM_SUP_A,INFORM_DIVI_A,INFORM_DEPT_A,
    // INFORM_APPROVE_INFO,INFORM_EMAIL,APPROVED_FLAG,REJECT_FLAG,APPROVED_BY,FINAL_APPROVED,INFORM_POSITION_APPROVED,INFORM_GROUP,INFORM_SEU_ID
    // from sf_eng_inform_hdr i
    // INNER JOIN sf_per_employees_v e
    // ON i.inform_work_order = e.employee_code
    // WHERE i.inform_status = '2'
    // AND i.inform_no is not null";
   $response = oci_parse($objConnect, $sql,);
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
   

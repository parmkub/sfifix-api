<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
   
    $sql = "SELECT
    r.eg_rece_document FixID,
    r.eg_rece_tran_id TranID,
    r.machine_id MainChineID,
    r.eg_rece_budget,
    r.eg_rece_process,
    r.eg_rece_purchase,
    r.employee_code,
    r.eg_rece_status_app,  
    i.inform_no JOBID,
    i.inform_importance,
    i.type_budget,
    i.change_request,
    i.change_request_no doc_chang_no,
    i.inform_to,
    i.cost_center,
    i.eg_reason_code,
    i.inform_from,
    r.eg_rece_date,
    e.employee_id empid,
    (select user_id 
    from sf_per_employees_fnduser_v u 
    WHERE  u.employee_code = e.employee_code) idLogin,
    e.first_name ||' '|| e.last_name name,
    i.inform_work_order empid_create,
    (SELECT
        emp.first_name || ' ' || emp.last_name
    FROM sf_per_employees_v emp 
    WHERE emp.employee_code = i.inform_work_order) UserCreat ,
    r.employee_code empfixid,
    (SELECT lower(e.eng_first_name||substr(e.eng_last_name,1,1)) username 
    FROM sf_per_employees_v e
    where e.employee_code = i.inform_work_order)User_Creat_eng ,
    (SELECT  
        emp.first_name || ' ' || emp.last_name 
    FROM sf_per_employees_v emp 
    WHERE emp.employee_code = r.employee_code) namefix,
    (SELECT
        emp.position_name 
    FROM sf_per_employees_v emp
    WHERE emp.employee_code = r.employee_code) PositionFix,
    r.eg_rece_comment Detail,
    NVL(r.inselected,0) inselected
FROM sf_eg_receive_tran r
INNER JOIN sf_per_employees_v e 
ON r.report_to_employee_code = e.employee_code
INNER JOIN sf_eng_inform_hdr i
ON i.inform_id = r.inform_id
WHERE r.eg_rece_status = '0'
 --AND r.report_to_employee_code is null
ORDER BY r.eg_rece_date DESC";
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
   

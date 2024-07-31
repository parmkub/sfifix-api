<?php
                $slq = "SELECT
                t.machine_id,
                t.eg_rece_tran_id,
                t.eg_rece_status,
                t.EG_PLANNING_CLASS,
                t.EG_RECE_DATE,
                t.EG_RECE_CC_ID,
                t.EG_RECE_EST_TIME,
                t.EG_RECE_EST_DATE,
                t.EG_RECE_DOCUMENT,
                t.EG_RECE_TYPE,
                t.EG_RECE_SFI_CODE,
                t.EG_RECE_COMMENT,
                t.DELETE_MARK,
                t.EG_MACHINE_STD_STOP,
                t.BUDGET_CODE,
                t.EG_RECE_SFI_CODE_CHIEF,
                t.EG_RECE_PROBLEM,
                t.EG_RECE_METHOD,
                t.EG_RECE_BUDGET,
                t.EG_RECE_PURCHASE,
                t.EG_RECE_PROCESS,
                t.EG_RECE_EXTERNAL,
                t.EG_RECE_STATUS_OTHER,
                t.COST_CENTER,
                t.LAST_UPDATE_DATE,
                t.EG_RECE_LOCATION,
                (SELECT  
                    emp.first_name || ' ' || emp.last_name 
                FROM sf_per_employees_v emp 
                WHERE emp.employee_code = t.EMPLOYEE_CODE) NAME_TECHNIC ,
                (SELECT  
                    emp.first_name || ' ' || emp.last_name 
                FROM sf_per_employees_v emp 
                WHERE emp.employee_code = t.report_to_employee_code) NAME_TECHNIC_FIX ,
                t.REPORT_TO_EMPLOYEE_CODE,
                t.BUDGET_ID,
                t.INFORM_ID,
               (SELECT  
                    emp.title||' '||emp.first_name || ' ' || emp.last_name 
                FROM sf_per_employees_v emp 
                WHERE emp.employee_code = inform_work_order) NAME_CREAT ,
                (SELECT user_id 
                from sf_per_employees_fnduser_v u 
                where u.employee_code = i.inform_work_order) user_id,
                (SELECT u.sect_code 
                from sf_per_employees_fnduser_v u 
                where u.employee_code = i.inform_work_order) sect_code,
                 (SELECT u.depart_code 
                from sf_per_employees_fnduser_v u 
                where u.employee_code = i.inform_work_order) depart_code,
                (select        
                e.sect_code
                FROM sf_per_employees_fnduser_v e
                where e.sect_code = (select q.sect_code_qc from sf_qc_product q 
                                        where q.cost_center = t.COST_CENTER
                                        and q.SECT_CODE_PRODUCT = i.inform_from
                                        GROUP BY q.sect_code_qc)and ROWNUM = 1)  sect_code_qc,
                (select        
                e.employee_name
                FROM sf_per_employees_fnduser_v e
                where e.sect_code = (select q.sect_code_qc from sf_qc_product q 
                                        where q.cost_center = t.COST_CENTER
                                        and q.SECT_CODE_PRODUCT = i.inform_from
                                        
                                        GROUP BY q.sect_code_qc)and ROWNUM = 1) name_qc
              
                
            FROM sf_eg_receive_tran  t
            INNER JOIN sf_eng_inform_hdr i
            ON i.inform_id = t.inform_id
            WHERE eg_rece_document = '$documentNo' ";
                $result = oci_parse($objConnect, $slq,);
                oci_execute($result,);
                while (($row = oci_fetch_assoc($result)) != false) {
                    $MACHINE_ID = $row["MACHINE_ID"];
                    $EG_RECE_TRAN_ID = $row["EG_RECE_TRAN_ID"];
                    $EG_RECE_STATUS = $row["EG_RECE_STATUS"];
                    $EG_PLANNING_CLASS = $row["EG_PLANNING_CLASS"];
                    $EG_RECE_DATE = $row["EG_RECE_DATE"];
                    $EG_RECE_CC_ID = $row["EG_RECE_CC_ID"];
                    $EG_RECE_EST_TIME  = $row["EG_RECE_EST_TIME"];
                    $EG_RECE_EST_DATE  = $row["EG_RECE_EST_DATE"];
                    $EG_RECE_DOCUMENT  = $row["EG_RECE_DOCUMENT"];
                    $EG_RECE_TYPE  = $row["EG_RECE_TYPE"];
                    $EG_RECE_SFI_CODE  = $row["EG_RECE_SFI_CODE"];
                    $EG_RECE_COMMENT  = $row["EG_RECE_COMMENT"];
                    $DELETE_MARK  = $row["DELETE_MARK"];
                    $EG_MACHINE_STD_STOP  = $row["EG_MACHINE_STD_STOP"];
                    $BUDGET_CODE  = $row["BUDGET_CODE"];
                    $EG_RECE_SFI_CODE_CHIEF  = $row["EG_RECE_SFI_CODE_CHIEF"];
                    $EG_RECE_PROBLEM  = $row["EG_RECE_PROBLEM"];
                    $EG_RECE_METHOD  = $row["EG_RECE_METHOD"];
                    $EG_RECE_BUDGET  = $row["EG_RECE_BUDGET"];
                    $EG_RECE_PURCHASE  = $row["EG_RECE_PURCHASE"];
                    $EG_RECE_PROCESS  = $row["EG_RECE_PROCESS"];
                    $EG_RECE_EXTERNAL  = $row["EG_RECE_EXTERNAL"];
                    $EG_RECE_STATUS_OTHER  = $row["EG_RECE_STATUS_OTHER"];
                    $COST_CENTER  = $row["COST_CENTER"];
                    $NAME_TECHNIC  = $row["NAME_TECHNIC"];
                    $NAME_TECHNIC_FIX  = $row["NAME_TECHNIC_FIX"];
                    $REPORT_TO_EMPLOYEE_CODE  = $row["REPORT_TO_EMPLOYEE_CODE"];
                    $BUDGET_ID  = $row["BUDGET_ID"];
                    $INFORM_ID  = $row["INFORM_ID"];
                    $NAME_CREAT = $row["NAME_CREAT"];
                    $USER_ID = $row["USER_ID"];
                    $SECT_CODE = $row["SECT_CODE"];
                    $DEPART_CODE = $row["DEPART_CODE"];
                    $LAST_UPDATE_DATE = $row["LAST_UPDATE_DATE"];
                    $SECT_CODE_QC = $row['SECT_CODE_QC'];
                    $name_qc = $row["NAME_QC"];
                    $location = $row["EG_RECE_LOCATION"];
                }
                oci_close($objConnect);
                ?>

<?php
                $slq = "select INFORM_HDR_ID
                ,INFORM_RESULT_ID
                ,INSPECTION_RESULT
                ,RESULT_GRADE
                ,SUGGESTION
                ,OWNER_NAME
                ,ASSESSOR
    from sfi.sf_eng_inform_result
    where inform_hdr_id = '$INFORM_ID'
    AND rownum =1";

                $result = oci_parse($objConnect, $slq,);
                $i = 0;
                oci_execute($result);
                        while (($row = oci_fetch_array($result, OCI_BOTH)) != false) {
                                    $i++;
                    }
                
                if($i==1){
                    oci_execute($result);
                    while (($row = oci_fetch_assoc($result)) != false) {
                        $INFORM_RESULT_ID = $row["INFORM_RESULT_ID"];
                        $INSPECTION_RESULT = $row["INSPECTION_RESULT"];
                        $RESULT_GRADE = $row["RESULT_GRADE"];
                        $SUGGESTION = $row["SUGGESTION"];
                        $OWNER_NAME = $row["OWNER_NAME"];
                }

                }else {
                    $INFORM_RESULT_ID = null;
                    $INSPECTION_RESULT =  null;
                    $RESULT_GRADE = null;
                    $SUGGESTION =null;
                    $OWNER_NAME = null;
                }
        
            

              
                oci_close($objConnect);

<?php
                $slqBefore = "SELECT
                *
            FROM sf_eng_fixapp_image 
            WHERE inform_no = $documentNo
            and img_status = 'before'";

                $iB = 0;
                $resultB = oci_parse($objConnect, $slqBefore,);
              
                oci_execute($resultB);
                while (($row = oci_fetch_array($resultB, OCI_BOTH)) != false) {
                            $iB++;
            }
                
                if($iB > 0){
                    oci_execute($resultB, OCI_DEFAULT);
                    while (($row = oci_fetch_assoc($resultB)) != false) {
                        $IMG_BEFORE[] = $row["IMG_NAME"];
    
                    }
                    $visableImageBefore = true;

                }else{
                    $IMG_BEFORE[0]= "noImage.png";
                    $visableImageBefore = false;
                }
                
               
              


                $slqAfter = "SELECT
                *
            FROM sf_eng_fixapp_image 
            WHERE inform_no = $documentNo
            and img_status = 'after'";

                $resultA = oci_parse($objConnect, $slqAfter,);
               
                    $iA = 0;
                    oci_execute($resultA);
                    while (($row = oci_fetch_array($resultA, OCI_BOTH)) != false) {
                                $iA++;
                }
                if($iA > 0){
                    oci_execute($resultA,OCI_DEFAULT);
                    while (($row = oci_fetch_assoc($resultA)) != false) {
                        $IMG_AFTER[] = $row["IMG_NAME"];
                        $visableImageAfter = true;
    
                    }
                }else{
                    $IMG_AFTER[0] = "noImage.png";
                    $visableImageAfter = false;
                }
               

                
                oci_close($objConnect);
                ?>

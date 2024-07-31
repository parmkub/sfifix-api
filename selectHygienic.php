<?php
                $PRODUCT_CHECK_BEFORE = '';
                $PRODUCT_CHECK_AFFTER = '';
                 $QC_CHECK_BEFORE = '';
                $QC_CHECK_AFFTER = '';
                $DETAIL_BEFORE = '';
                $DETAIL_AFFTER = '';
                $CHECK_DATE = '';
                $dataNull = '';
                $QC_USERNAME  = '';

                $slq = "SELECT 
                PRODUCT_USERNAME,
                QC_USERNAME,
                PRODCT_SECT_CODE,
                QC_SECT_CODE,
                nvl(PRODUCT_CHECK_BEFORE,1) PRODUCT_CHECK_BEFORE,
                nvl(PRODUCT_CHECK_AFFTER,1) PRODUCT_CHECK_AFFTER,
                nvl(QC_CHECK_BEFORE,1) QC_CHECK_BEFORE,
                nvl(QC_CHECK_AFFTER,1) QC_CHECK_AFFTER,
                CHECK_DATE,
                DETAIL_BEFORE,
                DETAIL_AFFTER FROM SF_QC_HYGIENIC_SCREENING h
                WHERE h.eg_rece_tran_id = '$EG_RECE_TRAN_ID'";
                $result = oci_parse($objConnect, $slq,);
                
                oci_execute($result,);
            
                while (($row = oci_fetch_assoc($result)) != false) {
                    $PRODUCT_USERNAME = $row["PRODUCT_USERNAME"];
                    $QC_USERNAME = $row["QC_USERNAME"];
                    $PRODCT_SECT_CODE = $row["PRODCT_SECT_CODE"];
                    $QC_SECT_CODE = $row["QC_SECT_CODE"];
                    $PRODUCT_CHECK_BEFORE = $row["PRODUCT_CHECK_BEFORE"];
                    $PRODUCT_CHECK_AFFTER  = $row["PRODUCT_CHECK_AFFTER"];
                    $QC_CHECK_BEFORE  = $row["QC_CHECK_BEFORE"];
                    $QC_CHECK_AFFTER  = $row["QC_CHECK_AFFTER"];
                    $CHECK_DATE  = $row["CHECK_DATE"];
                    $DETAIL_BEFORE  = $row["DETAIL_BEFORE"];
                    $DETAIL_AFFTER  = $row["DETAIL_AFFTER"];
                }
           
            

                // $objResult = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS);

            //     if($objResult){

                
            //     while (($row = oci_fetch_assoc($result)) != false) {
            //         $PRODUCT_USERNAME = $row["PRODUCT_USERNAME"];
            //         $QC_USERNAME = $row["QC_USERNAME"];
            //         $PRODCT_SECT_CODE = $row["PRODCT_SECT_CODE"];
            //         $QC_SECT_CODE = $row["QC_SECT_CODE"];
            //         $PRODUCT_CHECK_BEFORE = $row["PRODUCT_CHECK_BEFORE"];
            //         $PRODUCT_CHECK_AFFTER  = $row["PRODUCT_CHECK_AFFTER"];
            //         $QC_CHECK_BEFORE  = $row["QC_CHECK_BEFORE"];
            //         $QC_CHECK_AFFTER  = $row["QC_CHECK_AFFTER"];
            //         $CHECK_DATE  = $row["CHECK_DATE"];
            //         $DETAIL_BEFORE  = $row["DETAIL_BEFORE"];
            //         $DETAIL_AFFTER  = $row["DETAIL_AFFTER"];
                  
            //     }
            // }else{
                // $QC_CHECK_BEFORE = '';
                // $QC_CHECK_AFFTER = '';
                // $DETAIL_BEFORE = '';
                // $DETAIL_AFFTER = '';

            // }
                oci_close($objConnect);
                ?>

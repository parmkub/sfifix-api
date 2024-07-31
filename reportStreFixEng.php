<?php

use JetBrains\PhpStorm\Language;

require_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Google fonts -->

  <link href="http://10.2.2.5/sfifix/css/font.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link href="css/style.css" rel="stylesheet" type="text/css">

  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <title>รายงานการเบิกอะไหล่</title>
</head>

<body>



  <?php
  $eg_rece_document = $_GET['documentNo'];

  $slq = "SELECT
  st.eng_online eg_tran_document,
  sh.REQUEST_NO,
  st.request_item_id,
  st.request_location,
  st.request_qty,
  st.request_uom,
  st.request_comment,
  (select  a.description item_desc1
   from apps.MTL_SYSTEM_ITEMS a
   where a.organization_id = 82
   and a.INVENTORY_ITEM_ID = st.request_item_id
   and SUBSTR(a.segment1,1,2) IN ('12','13','91'))dtail
FROM sf_store_request_dtl st
INNER JOIN sf_store_request_hdr sh
ON sh.id = st.request_hdr_id
WHERE  st.eng_online = '$eg_rece_document'
and sh.request_recieve_finish = 1";



  $objParse = oci_parse($objConnect, $slq,);
  oci_execute($objParse,);


  ?>
  <div class="container">

    <div class="form-group">


      <div class="row justify-content-md-center mt-4">

        <div class="card m4-2 col-8">
          <div class="card-heade text-center mt-5">
            <H6>รายการเบิกอะไหล่ใบแจ้งซ่อมเลขที่ <?php echo $eg_rece_document ?></H6>
          </div>
          <div class="table-responsive">
            <table class="table table-sm table-hover mt-3">
              <thead class="thead-dark">

             
              <tr class="text-center">
              <th width="8%">ลำดับ</th>
              <th width="15%">เลขที่ใบเบิก</th>  
              <th width="20%">รายการ</th>
                
                <th class="text-end" width="8%">จำนวน</th>
                <th width="8%">หน่วย</th>
                <th width="20%">การใช้งาน</th>
                
          

              </tr>
              </thead>

              <?php  $i=1; 
                while ($row = oci_fetch_assoc($objParse)) { ?>

                <tr class="text-center">
                <td><?php echo $i; ?></td>
                <td class="text-start"><?php echo $row["REQUEST_NO"]; ?></td>
                  <td class="text-start"><?php echo $row["DTAIL"]; ?></td>
                  <td class="text-end"><?php echo $row["REQUEST_QTY"]; ?></td>
                  <td><?php echo $row["REQUEST_UOM"]; ?></td>
                  <td class="text-start"><?php echo $row["REQUEST_COMMENT"]; ?></td>
                <?php $i++; ?>

                </tr>

              <?php } ?>
            </table>
          </div>


        </div>

      </div>
    </div>
  </div>


  <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
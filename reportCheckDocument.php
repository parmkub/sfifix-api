<?php

use JetBrains\PhpStorm\Language;

header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Google fonts -->

  <link href="css/font.css?family=Sarabun:wght@100&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css">

  <script src="node_modules/jquery/dist/jquery.min.js"></script>

  <script src="sweetalert/unpkg/sweetalert.min.js"></script>


  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <title>รายงานใบแจ้งซ่อม</title>
</head>

<body>



  <?php

  ?>
  <div class="container mt-3">

    <div class="form-group">

      <div class="row justify-content-center ">
        <div class="card col-12 shadow p-3 mb-5 bg-white rounded ">
          <div class="card-heade text-center mt-3 ">

            <p>Seafresh Indstry Public Company Limited 402 Village 8, Pakname Chumphon, Chumphon. 86120 Thailand </p>
            <h6>ใบตรวจเช็กเอกสารสำเร็จ </h6>

          </div>


          <div class="card-body ">
            <table class=" table ms-1 me-1  table-bordered table-info">
              <thead class="thead-dark">
                <tr class="text-center">

                  <th scope="col" style="width: 5%">ใบแจ้งซ่อม</th>
                  <th scope="col" style="width: 40%">รายละเอียด</th>
                  <th scope="col" style="width: 10%">วันที่</th>
                  <th scope="col" style="width: 5%">QC ตรวจก่อน</th>
                  <th scope="col" style="width: 5%">QC ตรวจหลัง</th>
                  <th scope="col" style="width: 5%">ผู้แจ้ง ตรวจก่อน</th>
                  <th scope="col" style="width: 5%">ผู้แจ้ง ตรวจหลัง</th>
                  <th scope="col" style="width: 5%">เกรด </th>
                  <th scope="col" style="width: 5%">ส่งเมลล์ QC</th>
                  <th scope="col" style="width: 5%">ส่งเมลล์ผู้แจ้ง</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php

                  include 'connect.php';

                  $empCode = $_GET['empCode'];
                  $sql = "SELECT
                               t.eg_rece_tran_id,
                               t.eg_rece_document,
                               t.eg_rece_type,
                               t.inform_id,
                               t.employee_code,
                               t.report_to_employee_code,
                               i.inform_from,
                               t.cost_center,
                               t.eg_rece_comment,
                               t.eg_rece_date,
                               h.qc_username,
                               h.PRODUCT_USERNAME,
                               h.PRODUCT_CHECK_BEFORE,
                               h.PRODUCT_CHECK_AFFTER,
                               h.QC_CHECK_BEFORE,
                               h.QC_CHECK_AFFTER,
                               r.result_grade,
                           
                               i.inform_email product_email,
                               (select        
                                           e.email_address
                                           FROM sf_per_employees_fnduser_v e
                                           where e.sect_code = (select q.sect_code_qc from sf_qc_product q 
                                                                   where q.cost_center = t.cost_center
                                                                   and q.SECT_CODE_PRODUCT = i.inform_from
                                                                   GROUP BY q.sect_code_qc)and ROWNUM = 1)qc_email
                                        
                           FROM sf_eng_inform_hdr i ,sf_eg_receive_tran t ,sf_qc_hygienic_screening h,sf_eng_inform_result r
                           where i.inform_id = t.inform_id(+)
                           and t.eg_rece_tran_id = h.eg_rece_tran_id(+)
                           and t.inform_id = r.inform_hdr_id(+)
                           and TO_CHAR(t.eg_rece_date,'yyyy') > 2022
                           and t.eg_rece_status = '1'
                           AND t.eg_rece_type != 'RPM'
                           AND t.report_to_employee_code = '$empCode'
                           AND t.cost_center in (select cost_center from sf_qc_product)
                           AND (select        
                                           e.email_address
                                           FROM sf_per_employees_fnduser_v e
                                           where e.sect_code = (select q.sect_code_qc from sf_qc_product q 
                                                                   where q.cost_center = t.cost_center
                                                                   and q.SECT_CODE_PRODUCT = i.inform_from
                                                                   GROUP BY q.sect_code_qc)and ROWNUM = 1) is not NULL
                           AND(
                           r.result_grade is  Null
                           OR h.product_check_before is  NULL
                           OR h.PRODUCT_CHECK_AFFTER is  null
                           OR h.QC_CHECK_BEFORE is  null
                           OR h.QC_CHECK_AFFTER is  null)";

                  $result = oci_parse($objConnect, $sql,);
                  oci_execute($result,);


                  while ($row = oci_fetch_assoc($result)) { ?>
                <tr class="text-center">
                  <td><?php echo $row['EG_RECE_DOCUMENT'] ?></td>
                  <td class="text-start"><?php echo $row['EG_RECE_COMMENT'] ?></td>
                  <td><?php echo $row['EG_RECE_DATE'] ?></td>
                  <td><input type="checkbox" name="QC_CHECK_BEFORE" id="QC_CHECK_BEFORE" class="form-check-input " <?php echo ($row['QC_CHECK_BEFORE'] == '1') ? 'checked disabled' : 'disabled' ?>></td>
                  <td><input type="checkbox" name="QC_CHECK_AFFTER" id="QC_CHECK_AFFTER" class="form-check-input " <?php echo ($row['QC_CHECK_AFFTER'] == '1') ? 'checked disabled' : 'disabled' ?>></td>
                  <td><input type="checkbox" name="PRODUCT_CHECK_BEFORE" id="PRODUCT_CHECK_BEFORE" class="form-check-input " <?php echo ($row['PRODUCT_CHECK_BEFORE'] == '1') ? 'checked disabled' : 'disabled' ?>></td>
                  <td><input type="checkbox" name="PRODUCT_CHECK_AFFTER" id="PRODUCT_CHECK_AFFTER" class="form-check-input " <?php echo ($row['PRODUCT_CHECK_AFFTER'] == '1') ? 'checked disabled' : 'disabled' ?>></td>
                  <td><?php echo $row['RESULT_GRADE'] ?></td>
                  <td><?php if($row['QC_EMAIL']!=null){ ?>
                    <input type="buttom" name="sendmailQC" email="<?php echo $row['QC_EMAIL'] ?>" id="<?php echo $row['EG_RECE_DOCUMENT'] ?>" value="แจ้ง QC" class="btn btn-danger btn-sm shadow sendMailQC"></td>
                  <?php }else{ ?>
                    <p>QC ไม่ต้องตรวจ</p>
                  <?php } ?>
                  <td><input type="buttom" name="sendmailUser" email="<?php echo $row['PRODUCT_EMAIL'] ?>" id="<?php echo $row['EG_RECE_DOCUMENT'] ?>" value="แจ้ง ผู้แจ้งซ่อม" class="btn btn-warning btn-sm shadow sendMailUser"></td>
                  <!-- <td><?php echo $row['PRODUCT_EMAIL'] ?></td>
                  <td><?php echo $row['QC_EMAIL']  ?></td> -->
                <?php oci_close($objConnect);
                  } ?>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="d-flex justify-content-center m-3">
            <h6>บริษัทซีเฟรชอินดัสตรีจำกัด มหาชน 402 หมู่ 8 ตำบลปากน้ำ อำเภอเมือง จังหวัดชุมพร 86120</h6>
          </div>


        </div>



      </div>

      <script>
        $(document).on('keydown', function(e) {
          if ((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80)) {

            $("div").removeClass("container");
            $("div").removeClass("col-8");
            // alert("Please use the Print PDF button below for a better rendering on the document");

            e.cancelBubble = true;
            // e.preventDefault();

            e.stopImmediatePropagation();
          }
        });
      </script>

      <script type="text/javascript">
        $(document).ready(function() {
          $('.sendMailUser').click(function() {
            var id = $(this).attr("id");
            var email = $(this).attr("email");
            console.log(id);
            console.log(email);
            swal({
              title: "ส่งอีเมล์แจ้งผู้แจ้งซ่อม email : " + email + "",
              text: "คุณต้องการส่งอีเมล์แจ้งผู้แจ้งซ่อมหรือไม่",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                var settings = {
                  'url': "http://10.2.2.5:3000/sendemail?urlType=userEstimate&documentNo=" + id + "&emailRecive=" + email,
                  'method': "GET",
                  'timeout': 0,
                }
                $.ajax(settings).done(function(response) {
                  console.log(response['RespMassage']);
                  if(response['RespMassage'] == 'good'){
                    swal("ส่งอีเมล์แจ้งผู้แจ้งซ่อมเรียบร้อยแล้ว", {
                      icon: "success",
                    });
                  }else{
                    swal("ส่งอีเมล์แจ้งผู้แจ้งซ่อมไม่สำเร็จ", {
                      icon: "error",
                    });
                  }
                });
              } else {
                swal("ยกเลิกการส่งอีเมล์แจ้งผู้แจ้งซ่อม");
              }
            });

          });

          $('.sendMailQC').click(function() {
            var id = $(this).attr("id");
            var email = $(this).attr("email");
            //var email = 'phayuhons@chp.seafresh.com';
            console.log(id);
            console.log(email);
            swal({
              title: "ส่งอีเมล์ให้ QC ตรวจ email : " + email + "",
              text: "คุณต้องการส่งอีเมล์แจ้งผู้แจ้งซ่อมหรือไม่",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                var settings = {
                  'url': "http://10.2.2.5:3000/sendemail?urlType=qcApprove&documentNo=" + id + "&emailRecive=" + email,
                  'method': "GET",
                  'timeout': 0,
                }
                $.ajax(settings).done(function(response) {
                  console.log(response['RespMassage']);
                  if(response['RespMassage'] == 'good'){
                    swal("ส่งอีเมล์แจ้งผู้แจ้งซ่อมเรียบร้อยแล้ว", {
                      icon: "success",
                    });
                  }else{
                    swal("ส่งอีเมล์แจ้งผู้แจ้งซ่อมไม่สำเร็จ", {
                      icon: "error",
                    });
                  }
                });
              } else {
                swal("ยกเลิกการส่งอีเมล์แจ้งผู้แจ้งซ่อม");
              }
            });

          });
        });
      </script>

      <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
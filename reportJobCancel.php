<?php

use JetBrains\PhpStorm\Language;

//require_once 'connect-test.php';
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
  <link rel="stylesheet" href="css/style.css">

  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <script src="sweetalert/unpkg/sweetalert.min.js"></script>


  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <title>ใบขอยกเลิกงานซ๋อม</title>
</head>

<body>



  <?php
  $documentNo = $_GET['documentNo'];
  // $slq = "select t.eg_rece_document,
  // t.EG_RECE_DATE,
  // t.eg_rece_comment,
  // t.eg_rece_status,
  // t.eg_rece_status_other,
  // (select v.title|| v.first_name||' '||v.last_name from sf_per_employees_v v
  // WHERE v.employee_code = t.report_to_employee_code)head_tech,
  // e.title||e.last_name||' '||e.last_name tech
  // from sf_eg_receive_tran t
  // INNER JOIN sf_per_employees_v e
  // ON  e.employee_code =t.employee_code
  // where t.eg_rece_document = '$documentNo'";
  $slq = "SELECT 
  t.eg_rece_document,
  t.EG_RECE_DATE,
  t.eg_rece_comment,
  t.eg_rece_status,
  t.eg_rece_status_other,

  (SELECT v.title|| v.first_name||' '||v.last_name FROM sf_per_employees_v v WHERE employee_code = t.report_to_employee_code)head_tech,
  (SELECT v.title|| v.first_name||' '||v.last_name FROM sf_per_employees_v v WHERE employee_code = t.employee_code)tech
  FROM sf_eg_receive_tran t
where t.eg_rece_document = '$documentNo'";

  $result = oci_parse($objConnect, $slq,);
  oci_execute($result,);
  while (($row = oci_fetch_assoc($result)) != false) {
    $EG_RECE_DOCUMENT = $row["EG_RECE_DOCUMENT"];
    $EG_RECE_DATE = $row['EG_RECE_DATE'];
    $EG_RECE_COMMENT = $row['EG_RECE_COMMENT'];
    $eg_rece_status = $row['EG_RECE_STATUS'];
    $EG_RECE_STATUS_OTHER = $row['EG_RECE_STATUS_OTHER'];
    $HEAD_TECH = $row['HEAD_TECH'];
    $TECH = $row['TECH'];
  }
  oci_close($objConnect);
  oci_commit($objConnect);


  ?>
  <div class="container">
    <form action="" method="post">
      <div class="form-group">

        <div class="row justify-content-md-center mt-4">

          <div class="card m4-2 col-8 shadow rounded ">
            <div class="card-heade text-center mt-3 c ">

              <p>Seafresh Indstry Public Company Limited 402 Village 8, Pakname Chumphon, Chumphon. 86120 Thailand </p>

            </div>
            <div class="card-heade text-center ">
              <p class="c">ใบขอยกเลิกใบแจ้งซ่อม <?php echo $documentNo?></p>
            </div>

            <?php if($eg_rece_status == '1'){ ?>
              <span class="border border-dark p-3 ms-5 me-5 mt-2 mb-5" >
             
                <div class="d-flex justify-content-center">
                <p class="c">เลขที่ใบแจ้งซ่อมนี้ดำเนินการเสร็จสิ้นแล้ว!</p>
               

              
              </div>

              </span>
           <?php } else {?>


            <span class="border border-dark p-3 ms-5 me-5 mt-2 mb-5">
              <div class="row ">
                <div class="col-6 ">
                  <div class="row ">
                    <div class="d-flex justify-content-start ">

                      <div class="col align-self-center">
                        <p class="c">เลขที่ใบแจ้งซ่อม : <?php echo $documentNo ?> </p>
                      </div>

                    </div>
                  </div>
                  <p class="c">วันที่แจ้ง : <?php echo $EG_RECE_DATE ?></p>
                </div>

                <div class="col">
                  <p class="c">ผู้รับผิดชอบ : <?php echo ($TECH != null) ? $TECH : "-" ?></p>
                  <p class="c">หัวหน้าช่าง : <?php echo ($HEAD_TECH != null) ? $HEAD_TECH : "-" ?></p>
                </div>
                <p class="c">รายละเอียด : <?php echo $EG_RECE_COMMENT ?></p>

                <div class="mt-3">
                  <p class="c">
                  <p class="c">สาเหตุที่ขอยกเลิก: <?php echo ($EG_RECE_STATUS_OTHER != null) ?  $EG_RECE_STATUS_OTHER :  "-" ?></p>
                  </p>
                  <p class="c">
                  <p class="c">สถานะการยกเลิก: <?php if ($eg_rece_status != '2') {
                                                  echo 'รอยกเลิก';
                                                } else {
                                                  echo 'ยกเลิกแล้ว';
                                                } ?></p>
                  </p>
                </div>
              </div>

            </span>

            <?php if ($eg_rece_status != '2') { ?>

              <div class="card-body">
                <div class="row d-flex justify-content-around">
                  <div class="col-4 ">
                    <button class=" w-100 btn btn-success" type="submit" name="submit">อนุมัติ</button>
                  </div>
                  <div class="col-4 ">
                    <button class=" w-100 btn btn-danger" type="submit" name="submitCancle">ไม่อนุมัติ</button>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
            <?php } ?>
        </div>
      </div>

    </form>

    <?php



    if (isset($_POST['submit'])) {

      // $documentNo = $_POST['documentNo'];
      $sql = "UPDATE sf_eg_receive_tran r SET r.eg_rece_status = 2
      WHERE r.eg_rece_document = $documentNo";

      $objParse = oci_parse($objConnect, $sql);
      if (oci_execute($objParse, OCI_COMMIT_ON_SUCCESS)) {

        // echo '<script>swal({
        //           title: "บันทึกข้อมูลสำเร็จ",
        //           text: "กรุณากดปุ่มตกลง",
        //           icon: "success",
        //           confirmButtomText: "ตกลง",

        //         }).then(()=>{
        //           window.location.replace("");
        //         });

        //         </script>';
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อย');
        window.location.href='http://10.2.2.5/sfifix/reportJobCancel.php?documentNo=$EG_RECE_DOCUMENT'
        </script>";

        //   
      } else {
        oci_rollback($objConnect);
        // echo '<script>swal({
        //           title: "บันทึกข้อมูลไม่สำเร็จ",
        //           text: "กรุณากดปุ่มตกลง",
        //           icon: "error",
        //           button: "ตกลง",
        //         });
        //         </script>';
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อย');
        window.location.href='http://10.2.2.5/sfifix/reportJobCancel.php?documentNo=$EG_RECE_DOCUMENT'
        </script>";
      }
      oci_commit($objConnect);
      oci_close($objConnect);
    }

    if (isset($_POST['submitCancle'])) {

      // $documentNo = $_POST['documentNo'];
      $sql = "UPDATE sf_eg_receive_tran r SET r.eg_rece_status = 0,r.eg_rece_status_app = 1
      WHERE r.eg_rece_document = $documentNo";

      $objParse = oci_parse($objConnect, $sql);
      if (oci_execute($objParse, OCI_COMMIT_ON_SUCCESS)) {

        // echo '<script>swal({
        //           title: "บันทึกข้อมูลสำเร็จ",
        //           text: "กรุณากดปุ่มตกลง",
        //           icon: "success",
        //           confirmButtomText: "ตกลง",

        //         }).then(()=>{
        //           window.location.replace("");
        //         });

        //         </script>';
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อย');
        window.location.href='http://10.2.2.5/sfifix/reportJobCancel.php?documentNo=$EG_RECE_DOCUMENT'
        </script>";

        //   
      } else {
        oci_rollback($objConnect);
        // echo '<script>swal({
        //           title: "บันทึกข้อมูลไม่สำเร็จ",
        //           text: "กรุณากดปุ่มตกลง",
        //           icon: "error",
        //           button: "ตกลง",
        //         });
        //         </script>';
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อย');
        window.location.href='http://10.2.2.5/sfifix/reportJobCancel.php?documentNo=$EG_RECE_DOCUMENT'
        </script>";
      }
      oci_commit($objConnect);
      oci_close($objConnect);
    }

    ?>
  </div>

  <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
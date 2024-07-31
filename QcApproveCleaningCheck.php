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

  <link href="./css/font.css?family=Sarabun:wght@100&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css">


  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

  <!-- <script src="sweetalert/unpkg/sweetalert.min.js"></script> -->

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->


  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <title>ใบตรวจเช็คอุปกรณ์เข้าไลน์ผลิต</title>
</head>

<body>



  <?php
  $documentNo = $_GET['documentNo'];
 
  if(isset($_GET['empCode']) && $_GET['empCode'] != ''){
    $empCode = $_GET['empCode'];
    // echo $empCode;
  }
  require_once 'reportQueryReceTran.php';
  require_once 'selectHygienic.php';
  require_once 'reportQueryImgFix.php';
  require_once 'reportQueryInformResult.php';


  ?>
  <div class="container">

    <div class="form-group">

      <div class="row justify-content-center ">
        <div class="card col-8 mt-2">
          <div class="card-heade text-center mt-3 ">

            <p>Seafresh Indstry Public Company Limited 402 Village 8, Pakname Chumphon, Chumphon. 86120 Thailand </p>
            <p>Hygienic Screening & Cleaning Check </p>

          </div>


          <div class="card-body ">
            <table class="table ms-1 me-1">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">วันที่รับใบแจ้งซ่อม</th>
                  <th scope="col">เอกสารเลขที่</th>
                  <th scope="col">แผนก</th>
                  <th scope="col">Cost center</th>
                  <th scope="col">Machine Code</th>
                  <th scope="col">ช่างผู้รับผิดชอบ</th>
                  <th scope="col">หัวหน้าช่าง</th>
                  <th scope="col">กำหนดเสร็จ</th>
                  <th scope="col">ระยะเวลาทำงาน</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $EG_RECE_DATE ?></td>
                  <td><?php echo $EG_RECE_DOCUMENT ?></td>
                  <td><?php echo $SECT_CODE ?></td>
                  </td>
                  <td><?php echo $COST_CENTER ?></td>
                  </td>
                  <td><?php $strSQL = "SELECT  machine_code 
                        FROM (SELECT cost_Center,cost_center_name FROM SFI.SF_BG_COSTCENTER_V )cc
                                  ,sfi.sf_eg_item_code_mst egmst
                                  ,sfi.sf_bg_budgetcode_mst bgmst
                              WHERE  cc.cost_Center(+) = egmst.cost_Center
                                AND egmst.budget_code = bgmst.budget_code(+)
                                and nvl(egmst.MACHINE_STATUS,'0') ='0'
                                and nvl(egmst.budget_type,'F') = bgmst.budget_type
                                and machine_id = '$MACHINE_ID'";
                      $result = oci_parse($objConnect, $strSQL);
                      oci_execute($result,);
                      while (($row = oci_fetch_assoc($result)) != false) {
                        $Machin_code = $row['MACHINE_CODE'];
                        echo  $Machin_code;
                      }


                      ?></td>
                  <td><?php echo $NAME_TECHNIC ?></td>
                  <td><?php echo $NAME_TECHNIC_FIX ?></td>
                  <td><?php echo $EG_RECE_EST_DATE ?></td>
                  <td><?php echo $EG_RECE_EST_TIME . " ชม." ?></td>

                </tr>
              </tbody>
            </table>
            <div class="border border-dark p-2 ms-1 me-1">
              <div class="row ">
                <div class="col">
                  <p>ลำดับความสำคัญ: <?php echo $EG_RECE_TYPE ?></p>
                </div>
                <div class="col">
                  <p>ผู้แจ้งซ่อม : <?php echo $NAME_CREAT ?> </p>
                </div>
              </div>
              <div>
                <p>สาเหตุ: <?php echo $EG_RECE_COMMENT ?></p>
              </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
              <p>รายการเครื่องมือ/อุปกรณ์/อะไหล่ที่ใช้งาน/เปลี่ยใส่เครื่องจักร/นำออกโรงงาน</p>
            </div>
            <div class="justify-content-center ms-1 me-1">
              <table class="table table-bordered border-dark table-sm">
                <thead>
                  <tr>
                    <th class="a" style="width:5%" scope="col">ลำดับ</th>
                    <th class="a" style="width:35%" scope="col">รายการ</th>
                    <th class="a" style="width:20%" scope="col">จำนวนที่เข้าโรงงาน</th>
                    <th class="a" style="width:20%" scope="col">จำนวนที่เปลี่ยน</th>
                    <th class="a" style="width:20%" scope="col">จำนวนที่นำออกโรงงาน</th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  $sql = "SELECT
                    dtl.description,
                    dtl.issue_qty,
                    dtl.issue_um
                    FROM sf_eg_part_tran t,sfi.sf_bg_trx_Dtl dtl
                    WHERE t.eg_rece_tran_id = '$EG_RECE_TRAN_ID'
                    and t.trx_id = dtl.trx_id
                    and t.line_id = dtl.line_id
                    ORDER BY dtl.issue_qty ASC";

                  $result = oci_parse($objConnect, $sql,);
                  oci_execute($result,);
                  $i = 1;
                  while (($row = oci_fetch_assoc($result)) != false) {; ?>

                    <tr>
                      <td class="a"><?php echo $i ?></td>
                      <td><?php echo $row["DESCRIPTION"]; ?></td>
                      <td class="a"><?php echo $row["ISSUE_QTY"] . "  " . $row["ISSUE_UM"]; ?></td>
                      <td class="a"><?php echo $row["ISSUE_QTY"] . "  " . $row["ISSUE_UM"]; ?></td>
                      <td class="a">-</td>
                    </tr>
                  <?php $i++;
                  } ?>
                  <tr>
                    <td class="a"><?php echo $i; ?></td>
                    <td>ชุดเครื่องมือ</td>
                    <td class="a">1 ชุด</td>
                    <td class="a">-</td>
                    <td class="a">1 ชุด</td>

                  </tr>


                  <tr>

                    <td colspan="3">
                      <p>หมายเหตุ: กรณีชิ้นส่วน อุปกรณ์ อะไหล่ ไม่ครบหรือไม่พบตามจำนวนที่ต้องนำออก ให้เจ้าหน้าที่วิศวกรรมซ่อมหรือสร้างแจ้งกับเจ้าของพื้นที่หรือเจ้าของเครื่องจักรหรือผู้รับผิดชอบให้ทราบเพื่อนดำเนินการแก้ไขทันที</p>
                    </td>
                    <td colspan="2">
                      <p>บันทึกชิ้นส่วน/อุปกรณ์/อะไหล่ไม่ครบหรือไม่พบ:.......................................................</p>

                  </tr>
                  <tr>

                    <td class="a" colspan="2">ผู้บันทีก: <?php echo $NAME_TECHNIC_FIX ?></td>
                    <td class="a" colspan="2">ผู้ตรวจสอบ:<?php echo $NAME_TECHNIC_FIX ?> </td>
                    <td class="a" colspan="2">ตรวจโดย QC: <?php if ($QC_CHECK_BEFORE && $QC_CHECK_AFFTER == "1") {
                                                            echo "ผ่าน";
                                                          } else if($QC_CHECK_BEFORE || $QC_CHECK_AFFTER == "0"){
                                                            echo "ไม่ผ่าน";
                                                          } else{
                                                            echo "-";
                                                          }
                                                          ?></td>

                  </tr>

                </tbody>
              </table>

            </div>
                                   
            <div class="d-flex justify-content-center ">
              <p>Hygienic Screening & Cleaning Check</p>
            </div>

            <form action="" method="post" id="insert-data">
              <div class="row ms-1 me-1">
                <div class="col-6 border border-dark ">
                  <div>
                    <p>cleaning Check Before Maintenance</p>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="qcCheckBefore" value="1" id="RadioBefore" <?php if ($QC_CHECK_BEFORE == '1') echo "checked"; ?>>
                    <label class="form-check-label" for="defaultCheck1">
                      <p>ไม่เสี่ยงต่อการปนเปื้นข้าม</p>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="qcCheckBefore" value="0" id="RadioBefore" <?php if ($QC_CHECK_BEFORE == '0') echo "checked"; ?>>
                    <label class="form-check-label" for="defaultCheck2">
                      <p>เสี่ยงต่อการปนเปื้นข้าม</p>
                    </label>
                  </div>
                  <div class="row">

                    <div class="col">
                      <div class=" d-flex justify-content-center">
                        <div>
                          <p class="a">ลงชื่อ <?php echo $name_qc ?></p>
                          <p class="a">ห้วหน้าแผนกฝ่าย QC ขึ้นไป</p>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>

                <div class="col-6 border border-dark ">
                  <div>
                    <p>cleaning Check After Maintenance</p>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="qcCheckAffter" id="RadioAffter" value="1" <?php if ($QC_CHECK_AFFTER == '1') echo "checked"; ?>>
                    <label class="form-check-label" for="defaultCheck1">
                      <p>ไม่เสี่ยงต่อการปนเปื้นข้าม(สะอาด)ไม่มีเศษชิ้นส่วนจากการซ่อม/สร้าง</p>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="qcCheckAffter" id="RadioAffter" value="0" <?php if ($QC_CHECK_AFFTER == '0') echo "checked"; ?>>
                    <label class="form-check-label" for="defaultCheck2">
                      <p>เสี่ยงต่อการปนเปื้นข้าม</p>
                    </label>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class=" d-flex justify-content-center">
                        <div>
                          <p>ลงชื่อ <?php echo $name_qc ?></p>
                          <p>ห้วหน้าแผนกฝ่าย QC ขึ้นไป</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-3 d-flex justify-content-center ">
                <div class="col-4">
                <button class=" w-100 btn btn-success" type="submit" name="submit">บันทึก</button>
                  <!-- <?php if ($QC_CHECK_BEFORE == null || $QC_CHECK_AFFTER == null) { ?>
                    <button class=" w-100 btn btn-success" type="submit" name="submit">บันทึก</button>
                  <?php } ?> -->
                  
                </div>

              </div>
            </form>
          </div>
          <p class="mt-3">
            หมายเหตุ: กรุณากดบันทึกทุกครั้งเมื่อเปิดโปรแกรม กดบันทึกแล้วให้ปิดโปรแกรมได้เลย
            <!-- <?php echo $EG_RECE_TRAN_ID  ?> -->
          </p>
          <?php

          if (isset($_POST['submit'])) {
            require_once 'connect.php';
            $qcCheckBefore = $_POST['qcCheckBefore'];
            $qcCheckAffter = $_POST['qcCheckAffter'];

            // echo "qcCheckBefore:".$qcCheckBefore ."<br>";
            // echo "qcCheckAffter:".$qcCheckAffter."<br>";;


            $sqlQery = "SELECT * FROM SF_QC_HYGIENIC_SCREENING h
            WHERE h.eg_rece_tran_id = '$EG_RECE_TRAN_ID'";
            $response = oci_parse($objConnect, $sqlQery,);
            oci_execute($response, OCI_DEFAULT);
            $objResult = oci_fetch_array($response, OCI_ASSOC + OCI_RETURN_NULLS);
            $num_row = oci_num_rows($response);

            if ($objResult) {

              // echo "มีข้อมูล ให้อัพเดท";
              $sqlUpdate = "UPDATE SF_QC_HYGIENIC_SCREENING SET PRODUCT_USERNAME = '$NAME_CREAT',
                        QC_USERNAME='$name_qc',PRODCT_SECT_CODE='$SECT_CODE',QC_SECT_CODE= '$SECT_CODE_QC',
                        QC_CHECK_BEFORE='$qcCheckBefore',QC_CHECK_AFFTER='$qcCheckAffter',CHECK_DATE=SYSDATE,
                        DETAIL_BEFORE='',DETAIL_AFFTER=''
                        WHERE EG_RECE_TRAN_ID = '$EG_RECE_TRAN_ID'";
              $s = oci_parse($objConnect, $sqlUpdate);
              $objExecute = oci_execute($s);


              if ($objExecute) {
                // echo 'true';
                // echo '<script>swal({
                //     title: "บันทึกข้อมูลสำเร็จ",
                //     text: "กรุณากดปุ่มตกลง",
                //     icon: "success",
                //     confirmButtomText: "ตกลง",

                //   }).then(()=>{
                //     window.location.replace("");
                //   });

                //   </script>';
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อย');
            
                window.location.href='http://10.2.2.5/sfifix/reportCheckDocumentQC.php?empCode=$empCode'
                
                
        
          </script>";
              } else {
                $e = oci_error($objExecute);
                echo 'false' . $e;
                oci_rollback($objConnect);
                // echo '<script>swal({
                //         title: "บันทึกข้อมูลไม่สำเร็จ",
                //         text: "กรุณากดปุ่มตกลง",
                //         icon: "error",
                //         button: "ตกลง",
                //       });
                //       </script>';
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลล้มเหลว');
                window.location.href='http://10.2.2.5/sfifix/reportCheckDocumentQC.php?empCode=$empCode'
         
          </script>";
              }
            } else {
              // echo "ไม่มีข้อมูล ให้ Insert";

              $sqlInsert = "INSERT INTO SF_QC_HYGIENIC_SCREENING (EG_RECE_TRAN_ID,PRODUCT_USERNAME,QC_USERNAME,PRODCT_SECT_CODE,QC_SECT_CODE
                ,QC_CHECK_BEFORE,QC_CHECK_AFFTER,CHECK_DATE,DETAIL_BEFORE,DETAIL_AFFTER)
                VALUES($EG_RECE_TRAN_ID,'$NAME_CREAT','$name_qc','$SECT_CODE','$SECT_CODE_QC','$qcCheckBefore','$qcCheckAffter',SYSDATE,'','' )";

              $s = oci_parse($objConnect, $sqlInsert);
              $objExecute = oci_execute($s);

              if ($objExecute) {
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อย');
                window.location.href='http://10.2.2.5/sfifix/QcApproveCleaningCheck.php?documentNo=$EG_RECE_DOCUMENT'
          </script>";
                // echo 'true';
                // echo '<script>swal({
                //     title: "บันทึกข้อมูลสำเร็จ",
                //     text: "กรุณากดปุ่มตกลง",
                //     icon: "success",
                //     confirmButtomText: "ตกลง",

                //   }).then(()=>{
                //     window.location.replace("");
                //   });

                //   </script>';
              } else {
                // $e = oci_error($objExecute);
                // // echo 'false'.$e;
                // echo '<script>swal({
                //     title: "บันทึกข้อมูลไม่สำเร็จ",
                //     text: "กรุณากดปุ่มตกลง",
                //     icon: "error",
                //     button: "ตกลง",
                //   });
                //   </script>';
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลล้มเหลว');
                window.location.href='http://10.2.2.5/sfifix/QcApproveCleaningCheck.php?documentNo=$EG_RECE_DOCUMENT'
         
                    </script>";
              }
            }
            oci_commit($objConnect);
            oci_close($objConnect);
          }

          ?>

        </div>

      </div>

    </div>
  </div>

  


<!-- 
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

    $(document).ready(function() {

    })
  </script> -->

  <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
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

  <script src="sweetalert/unpkg/sweetalert.min.js"></script>


  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <title>ใบประเมินรายการแจ้งซ่อม</title>
</head>

<body>

  <?php
  $documentNo = $_GET['documentNo'];

  if(isset($_GET['empCode']) && $_GET['empCode'] != ' '){
    $empCode = $_GET['empCode'];
  }else{
    $empCode = "";
  }

  require_once 'reportQueryReceTran.php';
  require_once 'reportQueryImgFix.php';
  require_once 'reportQueryInformResult.php';
  require_once 'selectHygienic.php';

  ?>
  <div class="container">
    <form action="" method="post">
      <div class="form-group">


        <div class="row justify-content-md-center mt-4 mb-2">


          <div class="card  col col-xl-8 shadow rounded">
            <div class="card-heade text-center mt-3 ">
              <p>Seafresh Indstry Public Company Limited 402 Village 8, Pakname Chumphon, Chumphon. 86120 Thailand </p>
              <p>ใบแจ้งประเมินรายการแจ้งซ่อมเลขที่ <?php echo $EG_RECE_DOCUMENT ?></p>

            </div>
            <div class="card-body">
              <!-- <div><p><?php echo $EG_RECE_TRAN_ID; ?></p></div> -->
             

              <table class="table">
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
              <div class="row">

                <div class="mt-2">

                  <h8>
                    <p>รายละเอียดแจ้งซ่อม: <?php echo $EG_RECE_COMMENT ?></p>
                  </h8>
                  <h8>
                    <p>ปัญหา: <?php echo $EG_RECE_PROBLEM ?></p>
                  </h8>
                  <h8>
                    <p>การแก้ไข: <?php echo $EG_RECE_METHOD ?></p>
                  </h8>
                </div>
              </div>

              <?php if($location == '0') {  ?>
           
            
                <div class="d-flex justify-content-center mt-3">
                  <p>รายการเครื่องมือ/อุปกรณ์/อะไหล่ที่ใช้งาน/เปลี่ยใส่เครื่องจักร/นำออกโรงงาน</p>
                </div>
                <div class="justify-content-center ">
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
                        <td class="a">-</td>

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
                                                              } else if ($QC_CHECK_BEFORE || $QC_CHECK_AFFTER == "0") {
                                                                echo "ไม่ผ่าน";
                                                              } else {
                                                                echo "-";
                                                              }
                                                              ?></td>

                      </tr>

                    </tbody>
                  </table>


                  <div class="d-flex justify-content-center ">
                    <p>Hygienic Screening & Cleaning Check</p>
                  </div>
                </div>

                <form action="" method="post" id="insert-data">

                  <div class="row mt-2 mb-2">
                    <div class="col-6 border border-dark ">
                      <div>
                        <p>cleaning Check Before Maintenance</p>
                      </div>
                      <!-- <?php echo $PRODUCT_CHECK_BEFORE ?> -->
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="productCheckBefore" value="1" id="RadioBefore" <?php if ($PRODUCT_CHECK_BEFORE == '1') echo "checked"; ?>>
                        <label class="form-check-label" for="defaultCheck1">
                          <p>ไม่เสี่ยงต่อการปนเปื้นข้าม</p>
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="productCheckBefore" value="0" id="RadioBefore" <?php if ($PRODUCT_CHECK_BEFORE == '0') echo "checked"; ?>>
                        <label class="form-check-label" for="defaultCheck2">
                          <p>เสี่ยงต่อการปนเปื้อนข้าม</p>
                        </label>
                      </div>
                      <div class="row">

                        <div class="col">
                          <div class=" d-flex justify-content-center">
                            <div>
                              <p class="a">ลงชื่อ <?php echo $NAME_CREAT ?></p>
                              <p class="a">ห้วหน้าแผนก Product ขึ้นไป</p>
                            </div>
                          </div>
                        </div>

                      </div>

                    </div>

                    <div class="col-6 border border-dark ">
                      <div>
                        <p>cleaning Check After Maintenance</p>
                      </div>
                      <!-- <?php echo $PRODUCT_CHECK_AFFTER ?> -->
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="productCheckAffter" id="RadioAffter" value="1" <?php if ($PRODUCT_CHECK_AFFTER == '1') echo "checked"; ?>>
                        <label class="form-check-label" for="defaultCheck1">
                          <p>ไม่เสี่ยงต่อการปนเปื้นข้าม(สะอาด)ไม่มีเศษชิ้นส่วนจากการซ่อม/สร้าง</p>
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="productCheckAffter" id="RadioAffter" value="0" <?php if ($PRODUCT_CHECK_AFFTER == '0') echo "checked"; ?>>
                        <label class="form-check-label" for="defaultCheck2">
                          <p>เสี่ยงต่อการปนเปื้อนข้าม</p>
                        </label>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class=" d-flex justify-content-center">
                            <div>
                              <p>ลงชื่อ <?php echo $NAME_CREAT ?></p>
                              <p>ห้วหน้าแผนก Product ขึ้นไป</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <?php } else {  $PRODUCT_CHECK_AFFTER == null; $PRODUCT_CHECK_BEFORE == null; echo '<p>สถานที่: นอกไลน์ผลิต</p>'; } ?>
              

                <div class="row">

                  <span class="border border-dark p-3">
                    <div class="mb-3">
                      <p>การประเมินการทำงาน</p>
                      <p><?php echo "เกรตเท่ากับ $RESULT_GRADE"; ?></p>
                    </div>
                    <div class="row">
                      <div class=" col-4">

                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="A" <?php echo ($RESULT_GRADE == 'A') ? 'checked' : '' ?> name="flexRadioEstimate" id="flexRadioEstimate1">
                          <label class="form-check-label" for="flexRadioEstimate1">
                            ดีมาก(Very Good)
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="B" <?php echo ($RESULT_GRADE == "B") ? 'checked' : '' ?> name="flexRadioEstimate" id="flexRadioEstimate2">
                          <label class="form-check-label" for="flexRadioEstimate2">
                            ดี(Good)
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="C" <?php echo ($RESULT_GRADE == 'C') ? 'checked' : '' ?> name="flexRadioEstimate" id="flexRadioEstimate3">
                          <label class="form-check-label" for="flexRadioEstimate3">
                            พอใช้(Fair)
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="D" <?php echo ($RESULT_GRADE == 'D') ? 'checked' : '' ?> name="flexRadioEstimate" id="flexRadioEstimate4">
                          <label class="form-check-label" for="flexRadioEstimate4">
                            ต้องแก้ไข(Corrective)
                          </label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label for="textBoxResultDetail" class="form-label">ข้อเสนอแนะ</label>
                          <textarea class="form-control" id="textBoxResultDetail" name="textBoxResultDetail" rows="3"><?= $SUGGESTION; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </span>

                </div>
                <div class="row mt-3">

                  <span class="border border-dark p-3">
                    <div class="mb-3">
                      <p>ตรวจงาน</p>
                    </div>
                    <div class="row">

                      <div class="col">


                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="1" <?php echo ($INSPECTION_RESULT == '1') ? 'checked' : '' ?> name="RadioCheckWork" id="flexRadioCheckWork1">
                          <label class="form-check-label" for="RadioCheckWork1">
                            เรียบร้อย
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="0" <?php echo ($INSPECTION_RESULT == '0') ? 'checked' : '' ?> name="RadioCheckWork" id="flexRadioCheckWork2">
                          <label class="form-check-label" for="RadioCheckWork2">
                            ยังไม่เรียบร้อย
                          </label>
                        </div>
                      </div>
                      <div class="col">

                        <p>ผู้ประเมิน : <?php echo $NAME_CREAT ?></p>

                      </div>
                    </div>
                  </span>



                </div>

                <div class="row mt-3 d-flex justify-content-center">

                  <button type="submit" id="submit" name="submit" class="btn btn-success  col-4">ส่งข้อมูล</button>
                </div>

                <!-- <?php if ($RESULT_GRADE == null || $CHECK_DATE == null) { ?>
                  <div class="row jestify-conten-center m-5">

                    <button type="submit" id="submit" name="submit" class="btn btn-success">ส่งข้อมูล</button>
                  </div>
                <?php } ?> -->


            </div>
            <div>
              <p>หมายเหตุ: เมื่อกดบันทึกแล้วให้ปิดโปรแกรมได้เลย</p>
            </div>

          </div>
          <?php if ($visableImageBefore) { ?>
            <div class="card mt-3 col-8 shadow rounded">
              <div class="d-flex justify-content-center m-3">
                <h8>ภาพถ่ายก่อนและหลังซ่อม</h8>
              </div>

              <div class="row jestify-content-center ">
                <div id="carouselBefore" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-indicators">

                    <?php
                    $i = 0;
                    foreach ($IMG_BEFORE as $row) {
                      $active = '';
                      if ($i == 0) {
                        $active = 'active';
                      }
                    ?>
                      <button type="button" data-bs-target="#carouselBefore" data-bs-slide-to="<?= $i; ?>" class="<?= $active; ?>" aria-current="true" aria-label="Slide 1"></button>
                    <?php $i++;
                    } ?>
                  </div>
                  <div class="carousel-inner">
                    <?php
                    $i = 0;
                    foreach ($IMG_BEFORE as $row) {
                      $active = '';
                      if ($i == 0) {
                        $active = 'active';
                      }
                    ?>
                      <div class="carousel-item <?= $active; ?>">
                        <img src="image/ImageFix/<?= $IMG_BEFORE[$i] ?>" alt="...">
                      </div>
                    <?php $i++;
                    } ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselBefore" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselBefore" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
                <div class="text-center mt-3 mb-5">
                  <h8>ภาพก่อนซ่อม</h8>
                </div>


              <?php }  ?>

              <?php if ($visableImageAfter) { ?>
                <div id="carouselAffter" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-indicators">

                    <?php
                    $i = 0;
                    foreach ($IMG_AFTER as $row) {
                      $active = '';
                      if ($i == 0) {
                        $active = 'active';
                      }
                    ?>
                      <button type="button" data-bs-target="#carouselAffter" data-bs-slide-to="<?= $i; ?>" class="<?= $active; ?>" aria-current="true" aria-label="Slide 1"></button>
                    <?php $i++;
                    } ?>
                  </div>
                  <div class="carousel-inner">
                    <?php
                    $i = 0;
                    foreach ($IMG_AFTER as $row) {
                      $active = '';
                      if ($i == 0) {
                        $active = 'active';
                      }
                    ?>
                      <div class="carousel-item <?= $active; ?>">
                        <img src="image/ImageFix/<?= $IMG_AFTER[$i] ?>" alt="...">
                      </div>
                    <?php $i++;
                    } ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselAffter" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselAffter" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
                <div class="text-center mt-3">
                  <h8>ภาพหลังซ่อม</h8>
                </div>

              <?php } ?>
              </div>
            </div>

        </div>
      </div>
    </form>
    <!-- <h5><?php echo $EG_RECE_TRAN_ID?></h5>
    <h5><?php echo $INFORM_ID?></h5> -->

    <?php

                  

    if (isset($_POST['submit'])) {

      $textBoxResultDetail = $_POST['textBoxResultDetail'];
      $RadioCheckWork = $_POST['RadioCheckWork'];
      $flexRadioEstimate = $_POST['flexRadioEstimate'];
      // if($qc_email == null || $qc_email == ""){
      //   $productCheckBefore = "";
      //   $productCheckAffter = "";
      // }else{
      //   $productCheckBefore = $_POST['productCheckBefore'];
      //   $productCheckAffter = $_POST['productCheckAffter'];
      // }
      if($location == '0'){
      $productCheckBefore = $_POST['productCheckBefore'];
      $productCheckAffter = $_POST['productCheckAffter'];
      }else{
        $productCheckBefore = "";
        $productCheckAffter = "";
      }
     

      $sqlQery = "SELECT * FROM SF_QC_HYGIENIC_SCREENING h
      WHERE h.eg_rece_tran_id = '$EG_RECE_TRAN_ID'";
      $response = oci_parse($objConnect, $sqlQery,);
      oci_execute($response, OCI_DEFAULT);
      $objResult = oci_fetch_array($response, OCI_ASSOC + OCI_RETURN_NULLS);


      if ($objResult) {

        // echo "มีข้อมูล ให้อัพเดท";
        $sqlUpdate = "UPDATE SF_QC_HYGIENIC_SCREENING SET PRODUCT_USERNAME = '$NAME_CREAT',
                QC_USERNAME='$name_qc',PRODCT_SECT_CODE='$SECT_CODE',QC_SECT_CODE= '$SECT_CODE_QC',
                PRODUCT_CHECK_BEFORE='$productCheckBefore',PRODUCT_CHECK_AFFTER='$productCheckAffter',CHECK_DATE=SYSDATE,
                DETAIL_BEFORE='',DETAIL_AFFTER=''
                WHERE EG_RECE_TRAN_ID = '$EG_RECE_TRAN_ID'";
        $s = oci_parse($objConnect, $sqlUpdate);
        $objExecute = oci_execute($s);

        if ($objExecute) {
          $hyghienicStatus = true;
        } else {
          $hyghienicStatus = false;
        }
      } else {
        //if ($qc_email != null) {
          // echo "ไม่มีข้อมูล ให้ Insert";
          $sqlInsert = "INSERT INTO SF_QC_HYGIENIC_SCREENING (EG_RECE_TRAN_ID,PRODUCT_USERNAME,QC_USERNAME,PRODCT_SECT_CODE,QC_SECT_CODE
        ,PRODUCT_CHECK_BEFORE,PRODUCT_CHECK_AFFTER,CHECK_DATE,DETAIL_BEFORE,DETAIL_AFFTER)
        VALUES($EG_RECE_TRAN_ID,'$NAME_CREAT','$name_qc','$SECT_CODE','$SECT_CODE_QC','$productCheckBefore','$productCheckAffter',SYSDATE,'','' )";

          $s = oci_parse($objConnect, $sqlInsert);
          $objExecute = oci_execute($s);

          if ($objExecute) {
            $hyghienicStatus = true;
          } else {
            $hyghienicStatus = false;
          }
        // } else {
        //   $hyghienicStatus = true;
        // }
      }


      $sqlInformResult = "SELECT * FROM SF_ENG_INFORM_RESULT r
      WHERE r.inform_hdr_id = '$INFORM_ID'";
      $responseInformResult = oci_parse($objConnect, $sqlInformResult,);
      oci_execute($responseInformResult, OCI_DEFAULT);
      $objResultInformResult = oci_fetch_array($responseInformResult, OCI_ASSOC + OCI_RETURN_NULLS);

      if ($objResultInformResult) {

        $updateInform = "UPDATE SF_ENG_INFORM_RESULT SET INSPECTION_RESULT = '$RadioCheckWork',RESULT_DATE = SYSDATE,SUGGESTION = '$textBoxResultDetail',CREATION_DATE=SYSDATE,CREATED_BY='$USER_ID',
        LAST_UPDATE_DATE = SYSDATE,LAST_UPDATED_BY='$USER_ID',RESULT_GRADE='$flexRadioEstimate' WHERE INFORM_RESULT_ID = '$INFORM_RESULT_ID'";

        $ss = oci_parse($objConnect, $updateInform);
        $objExecuteInform = oci_execute($ss, OCI_COMMIT_ON_SUCCESS);
      } else {

        if($USER_ID == null || $USER_ID == ""){
          $USER_ID = "99999";
        }

        $sql = "INSERT INTO sfi.SF_ENG_INFORM_RESULT (
          INFORM_RESULT_ID,
          INFORM_HDR_ID,
          INSPECTION_RESULT,
          OWNER_NAME,
          RESULT_DATE,
          ASSESSOR,
          SUGGESTION,
          CREATION_DATE,
          CREATED_BY,
          LAST_UPDATE_DATE,
          LAST_UPDATED_BY,
          RESULT_GRADE
          )values(
           sfi.SF_ENG_INFORM_RESULT_S.nextval,
          '$INFORM_ID',
          '$RadioCheckWork',
          '$NAME_CREAT',
          sysdate,
          '$NAME_CREAT',
          '$textBoxResultDetail',
          sysdate,
          '$USER_ID',
          sysdate,
          '$USER_ID',
          '$flexRadioEstimate'
          )";

         

        $objParse = oci_parse($objConnect, $sql);
        $objExecuteInform = oci_execute($objParse, OCI_COMMIT_ON_SUCCESS);
      }
      if ($objExecuteInform && $hyghienicStatus) {
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อย');
          window.location.href='http://10.2.2.5/sfifix/reportCheckDocumentProduct.php?empCode=$empCode'
          </script>";

        // echo '<script>swal({
        //           title: "บันทึกข้อมูลสำเร็จ",
        //           text: "กรุณากดปุ่มตกลง",
        //           icon: "success",
        //           confirmButtomText: "ตกลง",

        //         }).then(()=>{

        //         });


        //         </script>';



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
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลผิดพลาด <?php echo $sql ?>');
        window.location.href='http://10.2.2.5/sfifix/reportCheckDocumentProduct.php?empCode=$empCode'
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
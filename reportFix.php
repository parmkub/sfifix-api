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

  <script src="node_modules/jquery/dist/jquery.min.js"></script>


  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

  <!-- <script src="sweetalert/unpkg/sweetalert.min.js"></script> -->


  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <title>รายงานใบแจ้งซ่อม</title>
</head>

<body>



  <?php
  $documentNo = $_GET['documentNo'];
  require_once 'reportQueryReceTran.php';
  require_once 'reportQueryImgFix.php';
  require_once 'reportQueryInformResult.php';
  require_once 'selectHygienic.php';


  ?>
  <div class="container mt-3">

    <div class="form-group">

      <div class="row justify-content-center ">
        <div class="card col-8 shadow p-3 mb-5 bg-white rounded ">
          <div class="card-heade text-center mt-3 ">

            <p>Seafresh Industry Public Company Limited 402 Moo 8, Paknam Chumphon, Amphur Mueang Chumphon, Chumphon. 86120 Thailand </p>
            <p>ใบแจ้งเพิ่มเครื่องจักรอุปกรณ์ / ซ่อม / สร้าง ( Work Order Form )</p>

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
                <div class="col">
                  <p>ผู้อนุมัติซ่อม: <?php echo $OWNER_NAME ?></p>
                </div>
              </div>
              <div>
                <p>รายละเอียดการแจ้งซ่อม: <?php echo $EG_RECE_COMMENT ?></p>
              </div>
              <div>
                <p>การแก้ไขปัญหาที่พบ: <?php echo $EG_RECE_METHOD ?></p>
              </div>

              <div class="ms-1">
                <div class="row ">
                  <div class="col-6 col-xl-6">

                    <div class="row">
                      <div class="col">
                        <p>วันที่เริ่ม: <?php echo $EG_RECE_EST_DATE ?> </p>
                      </div>
                      <div class="col">
                        <p>วันที่เสร็จ: <?php echo $EG_RECE_EST_DATE ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <p>เวลาเข้า: -</p>
                      </div>
                      <div class="col">
                        <p>เวลาออก: -</p>
                      </div>
                    </div>


                  </div>
                  <div class="col-6 col-xl-6">
                    <p>ช่างปฏิบัติงาน</p>

                    <?php
                    $sql = "SELECT man.EG_RECE_TRAN_ID,
                   man.eg_mh_sfi_code code,
                    man.EG_MH_HOUR_ACT ACT,
                   man.EG_MH_HOUR_STD STD,
                   man.EG_MH_NUMBER MH_NUMBER,
                   man.employee_code,
                   emp.title||emp.first_name||' '||emp.last_name name
                   FROM sf_eg_man_hour man,sf_per_employees_v emp
                       
                       WHERE man.eg_rece_tran_id = '$EG_RECE_TRAN_ID'   --  337202
                       and man.employee_code = emp.employee_code(+)";

                    $result = oci_parse($objConnect, $sql,);
                    oci_execute($result,);
                    $i = 1;
                    while (($row = oci_fetch_assoc($result)) != false) {
                      $NameManhour = $row['NAME'];

                      echo '<p>' . $i . ". " . $NameManhour . '</p>';
                      $i++;
                    }

                    ?>

                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
              <p>รายการเครื่องมือ/อุปกรณ์/อะไหล่ที่ใช้งาน/เปลี่ยนใส่เครื่องจักร/นำออกโรงงาน</p>
            </div>
            <div class="justify-content-center ">
              <table class="table table-bordered border-dark table-sm ">
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
                <tr>
                    <td class="a"><?php echo $i; ?></td>
                    <td>เครื่องมือ</td>
                    <td class="a">1 ชุด</td>
                    <td class="a">-</td>
                    <td class="a">1 ชุด</td>

                  </tr>

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

                    <td colspan="3">
                      <p>หมายเหตุ: กรณีชิ้นส่วน อุปกรณ์ อะไหล่ ไม่ครบหรือไม่พบตามจำนวนที่ต้องนำออก ให้เจ้าหน้าที่วิศวกรรมซ่อมหรือสร้างแจ้งกับเจ้าของพื้นที่หรือเจ้าของเครื่องจักรหรือผู้รับผิดชอบให้ทราบเพื่อดำเนินการแก้ไขทันที</p>
                    </td>
                    <td colspan="2">
                      <p>บันทึกชิ้นส่วน/อุปกรณ์/อะไหล่ไม่ครบหรือไม่พบ:.......................................................</p>

                  </tr>

                  <tr>

                    <td class="a" colspan="2">ผู้บันทีก: <?php echo $NAME_TECHNIC ?></td>
                    <td class="a" colspan="2">ผู้ตรวจสอบ:<?php echo $NAME_TECHNIC_FIX ?> </td>

                    <?php if($QC_USERNAME != "" || $QC_USERNAME  != null || strlen($QC_USERNAME ) > 0  ){ ?>
                    <td class="a" colspan="2">ตรวจโดย QC: <?php if ($QC_CHECK_BEFORE && $QC_CHECK_AFFTER == "1") {
                                                            echo "ผ่าน";
                                                          } else if($QC_CHECK_BEFORE || $QC_CHECK_AFFTER == "0"){
                                                            echo "ไม่ผ่าน";
                                                          } else{
                                                            echo "-";
                                                          } ?></td>
                    <?php }  ?></td>
                                                        
                  </tr>

                </tbody>
              </table>

            </div>

            <?php 
    
        
            //  if ($QC_USERNAME  != "" || $QC_USERNAME  != null || strlen($QC_USERNAME ) > 0  ) { ?>
              <div class="d-flex justify-content-center ">
                <p>Hygienic Screening & Cleaning Check</p>
              </div>
              <div class="row ms-1 me-1">
                <div class="col-6 border border-dark ">
                  <div>
                    <p>cleaning Check Before Maintenance</p>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" <?php echo ($PRODUCT_CHECK_BEFORE == "1" && $QC_CHECK_BEFORE == "1") ? 'disabled checked' : 'disabled' ?>>
                    <label class="form-check-label" for="defaultCheck1">
                      <p>ไม่เสี่ยงต่อการปนเปื้อนข้าม</p>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" <?php echo ($PRODUCT_CHECK_BEFORE == "0" || $QC_CHECK_BEFORE == "0") ? 'disabled checked' : 'disabled' ?>>
                    <label class="form-check-label" for="defaultCheck2">
                      <p>เสี่ยงต่อการปนเปื้อนข้าม</p>
                    </label>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class=" d-flex justify-content-center">
                        <div>
                          <p>ลงชื่อ <?php echo $NAME_CREAT ?></p>
                          <p>หัวหน้าแผนกฝ่ายผลิตขึ้นไป</p>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class=" d-flex justify-content-center">
                        <div>
                          <p class="a">ลงชื่อ <?php echo $QC_USERNAME ?></p>
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
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" <?php echo ($PRODUCT_CHECK_AFFTER == "1" && $QC_CHECK_AFFTER == "1") ? 'disabled checked' : 'disabled' ?>>
                    <label class="form-check-label" for="defaultCheck1">
                      <p>ไม่เสี่ยงต่อการปนเปื้อนข้าม (สะอาด) ไม่มีเศษชิ้นส่วนจากการซ่อม/สร้าง</p>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" <?php echo ($PRODUCT_CHECK_AFFTER == "0" || $QC_CHECK_AFFTER == "0") ? 'disabled checked' : 'disabled' ?>>
                    <label class="form-check-label" for="defaultCheck2">
                      <p>เสี่ยงต่อการปนเปื้อนข้าม</p>
                    </label>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class=" d-flex justify-content-center">
                        <div>
                          <p class="a">ลงชื่อ <?php echo $NAME_CREAT ?></p>
                          <p class="a">หัวหน้าแผนกฝ่ายผลิตขึ้นไป</p>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class=" d-flex justify-content-center">
                        <div>
                          <p>ลงชื่อ <?php echo $QC_USERNAME ?></p>
                          <p>ห้วหน้าแผนกฝ่าย QC ขึ้นไป</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            

        


            <div class="row  ms-1 me-1">
              <div class="col-6 border border-dark">
                <p>ผลการประเมิน</p>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" <?php echo ($EG_RECE_STATUS == '1') ? 'checked disabled' : 'disabled' ?>>
                  <label class="form-check-label" for="defaultCheck1">
                    <p>เรียบร้อย</p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" <?php echo ($RESULT_GRADE == 'C') ? 'checked disabled' : 'disabled' ?>>
                  <label class="form-check-label" for="defaultCheck2">
                    <p>งานต้องแก้</p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" <?php echo ($EG_RECE_STATUS == '2') ? 'checked disabled' : 'disabled' ?>>
                  <label class="form-check-label" for="defaultCheck2">
                    <p>ยกเลิกงาน</p>

                  </label>

                </div>
                <p><?php if ($EG_RECE_STATUS == "2") {
                      echo "เหตุผล: " . $EG_RECE_STATUS_OTHER;
                    } else {
                      echo "เหตุผล:............................................................................................................";
                    } ?></p>
              </div>

              <div class="col-6 border  border-dark">
                <p>แบบประเมินการทำงานของช่างวิศวกรรม(ประเมินโดยผู้รับงาน)</p>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" <?php echo ($RESULT_GRADE == 'A') ? 'checked disabled' : 'disabled' ?>>
                  <label class="form-check-label" for="defaultCheck1">
                    <p>ดีมาก</p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" <?php echo ($RESULT_GRADE == 'B') ? 'checked disabled' : 'disabled' ?>>
                  <label class="form-check-label" for="defaultCheck2">
                    <p>ดี</p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" <?php echo ($RESULT_GRADE == 'C') ? 'checked disabled' : 'disabled' ?>>
                  <label class="form-check-label" for="defaultCheck2">
                    <p>พอใช้</p>
                  </label>
                </div>
                <p>ข้อเสนอแนะ:.......................................................................................................</p>
              </div>
            </div>

            <div class="row ms-1 me-1">
              <div class="col border border-dark">
                <p class="a m-1">
                  ลงชื่อผู้รับงาน/ผู้ประเมิน <?php echo ($RESULT_GRADE == '' || $RESULT_GRADE == null) ? 'ยังไม่ได้ตรวจรับงาน' : $NAME_CREAT ?>
                </p>
                <p class="a"><?php echo "วันที่ " . $EG_RECE_EST_DATE; ?></p>
              </div>
              <div class="col border border-dark">
                <p class="a m-1">
                  ผู้บันทึกข้อมูลประวัติเครื่องจักร <?php echo $NAME_TECHNIC ?>
                </p>
                <p class="a"><?php echo "วันที่ " . $EG_RECE_EST_DATE; ?></p>

              </div>
            </div>
          </div>
          <div class="d-flex justify-content-end">
          <p>F-5400-10(R6-25/11/66)</p>
          </div>
                   
        </div>

      </div>

      <?php if ($visableImageBefore) { ?>

        <div class="row justify-content-center ">
          <div class="card col-8 shadow p-3 mb-5 bg-white rounded">
            <div class="card-heade text-center mt-3 mb-3">

              <h8>รายการภาพถ่ายก่อนซ่อมและหลังซ่อม</h8>

            </div>


            <div id="carouselBefore" class="carousel slide mt-3 " data-bs-ride="carousel">
              <div class="carousel-indicators ">

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
            <div class="text-center mt-3 mb-5">
              <h8>ภาพหลังซ่อม</h8>
            </div>

          <?php } ?>
          </div>
        </div>
        

          <!-- <div class="d-flex justify-content-center m-1">      
              <h6>บริษัทซีเฟรชอินดัสตรีจำกัด มหาชน  402 หมู่ 8 ตำบลปากน้ำ อำเภอเมือง จังหวัดชุมพร 86120</h6>
          </div> -->

    </div>



  </div>

  <script>
    $(document).on('keydown', function(e) {
      if ((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80)) {

        $("div").removeClass("container");
        $("div").removeClass("col-8");
        $("div").removeClass("card");
        $("div").removeClass("shadow");
        // alert("Please use the Print PDF button below for a better rendering on the document");

        e.cancelBubble = true;
        // e.preventDefault();

        e.stopImmediatePropagation();
      }
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
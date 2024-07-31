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

  <link rel="stylesheet" href="css/style.css">


  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

  <!-- <script src="sweetalert/unpkg/sweetalert.min.js"></script> -->

  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" />
     
  <script src="https://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
     
  <script type="text/javascript" src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script> -->

  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <title>รายงานใบแจ้งซ่อม</title>
</head>

<body>

  

  <?php
  $documentNo = $_GET['documentNo'];
  require_once 'reportQueryReceTran.php';
  require_once 'reportQueryImgFix.php';
  require_once 'reportQueryInformResult.php';
  

  ?>
  <div class="container">
    <form action="" method="post" >
      <div class="form-group">


        <div class="row justify-content-md-center mt-4">

          <div class="card m4-2 col-8 ">
          <div class="card-heade text-center mt-2 ">
              <p>Seafresh Indstry Public Company Limited 402 Village 8, Pakname Chumphon, Chumphon. 86120 Thailand </p>
              <p>ใบแจ้งประเมินรายการแจ้งซ่อมเลขที่ <?php echo $EG_RECE_DOCUMENT ?></p>
            </div>


            <span class="border border-dark p-3 m-1">
              <div class="row">
                <div class="col-8">
                  <p>เลขที่เอกสาร : <?php echo $EG_RECE_DOCUMENT ?></p>
                  <p>วันที่แจ้ง : <?php echo $EG_RECE_DATE ?></p>
                </div>
                <div class="col">
                  <p>ผู้แจ้ง : <?php echo $NAME_CREAT ?></p>
                  <p>ผู้รับผิดชอบ : <?php echo $NAME_TECHNIC ?></p>
                </div>
                <!-- <p>ID เอกสาร : <?php echo $EG_RECE_TRAN_ID ?></p> -->
            
                <div >
                <p>
                    <p>รายละเอียดแจ้งซ่อม: <?php echo $EG_RECE_COMMENT ?></p>
                  </p>
                  <p>
                    <p>ปัญหาที่พบ: <?php echo $EG_RECE_PROBLEM ?></p>
                  </p>
                  <p>
                    <p>การแก้ไข: <?php echo $EG_RECE_METHOD ?></p>
                  </p>
                </div>
              </div>

            </span>
            

            <div class="card-body">
              <?php if($visableImageBefore){?>
              <div class="row jestify-content-center m-1">
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
                        <img src="image/ImageFix/<?= $IMG_BEFORE[$i] ?>"  alt="...">
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
                <div class="text-center mt-1">
                  <p>ภาพก่อนซ่อม</p>
                </div>
            
                <?php }  ?>
                  
                <?php if($visableImageAfter){?>
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
                        <img src="image/ImageFix/<?= $IMG_AFTER[$i] ?>"  alt="...">
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
                <div class="text-center mt-1">
                  <p>ภาพหลังซ่อม</p>
                </div>

                <?php } ?>
              </div>

              <div class="row m-1">
                <span class="border border-dark p-3">
                  <div >
                    <p>การประเมินการทำงาน</p>
                    <p> <?php  echo "เกรตเท่ากับ $RESULT_GRADE";?></p>
                  </div>
                  <div class="row">
                    <div class=" col-4">

                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="A" <?php echo ($RESULT_GRADE == 'A')?'checked':''?> name="flexRadioEstimate" id="flexRadioEstimate1">
                        <label class="form-check-label" for="flexRadioEstimate1">
                          ดีมาก(Very Good)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="B" <?php echo ($RESULT_GRADE == "B")?'checked':''?> name="flexRadioEstimate" id="flexRadioEstimate2">
                        <label class="form-check-label" for="flexRadioEstimate2">
                          ดี(Good)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="C" <?php echo ($RESULT_GRADE == 'C')?'checked':''?> name="flexRadioEstimate" id="flexRadioEstimate3">
                        <label class="form-check-label" for="flexRadioEstimate3">
                          พอใช้(Fair)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="D" <?php echo ($RESULT_GRADE == 'D')?'checked':''?> name="flexRadioEstimate" id="flexRadioEstimate4">
                        <label class="form-check-label" for="flexRadioEstimate4">
                          ต้องแก้ไข(Corrective)
                        </label>
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="textBoxResultDetail" class="form-label">ข้อเสนอแนะ</label>
                        <textarea class="form-control" id="textBoxResultDetail"  name="textBoxResultDetail" rows="3" ><?=$SUGGESTION;?></textarea>
                      </div>
                    </div>
                  </div>
                </span>

              </div>
              <div class="row m-1">

                <span class="border border-dark p-3">
                  <div class="mb-3">
                    <p>ตรวจงาน</p>
                  </div>
                  <div class="row">

                    <div class="col">


                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" <?php echo ($INSPECTION_RESULT == '1')?'checked':''?> name="RadioCheckWork" id="flexRadioCheckWork1">
                        <label class="form-check-label" for="RadioCheckWork1">
                          เรียบร้อย
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" <?php echo ($INSPECTION_RESULT == '0')?'checked':''?> name="RadioCheckWork" id="flexRadioCheckWork2">
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
              <?php if($INSPECTION_RESULT == null){?>
                <div class="row jestify-conten-center m-5">
                <button type="submit" id="submit" name="submit" class="btn btn-success">ส่งข้อมูล</button>
              </div>
             <?php } ?>
              
            </div>

          </div>

        </div>
      </div>
    </form>

    <?php 
  
  

    if(isset($_POST['submit'])){
        $textBoxResultDetail = $_POST['textBoxResultDetail'];  
       $RadioCheckWork = $_POST['RadioCheckWork'];
       $flexRadioEstimate =$_POST['flexRadioEstimate'];

      // echo $INFORM_ID." ".$RadioCheckWork." ".$NAME_CREAT." ".$NAME_CREAT." ".$RadioCheckWork." ".$textBoxResultDetail." ".$flexRadioEstimate;
    
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

          $sqlHdr = "update sfi.SF_ENG_INFORM_HDR set INFORM_STATUS = '6'
          where inform_id = $INFORM_ID";

        $objParse = oci_parse($objConnect, $sql);
        $objParseHDR = oci_parse($objConnect,$sqlHdr);
        if (oci_execute($objParse, OCI_COMMIT_ON_SUCCESS)&&oci_execute($objParseHDR, OCI_COMMIT_ON_SUCCESS)) {
          echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อย');
          window.location.href='http://10.2.2.5/sfifix/reportReceTran.php?documentNo=$EG_RECE_DOCUMENT'
          </script>";
      
         
                oci_commit($objConnect);
          
          //   
      } else {
          oci_rollback($objConnect);
          echo "<script type='text/javascript'>alert('บันทึกข้อมูลผิดพลาด');</script>";
        
      }
      oci_close($objConnect);
    }
    
  ?>
  </div>

  <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
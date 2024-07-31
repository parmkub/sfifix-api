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

  <title>ใบตรวจเช็คอุปกรณ์เข้าไลน์ผลิต</title>
</head>

<body>



  <?php
  // if(isset($_POST['empCode']) && $_POST['empCode'] != ''){
  //   $empCode = $_POST['empCode'];
  //   echo $empCode;



  ?>
  <div class="container mt-3">

    <div class="form-group">
    

      <div class="row justify-content-center ">
        
        <div class="card col-12 shadow p-3 mb-5 bg-white rounded ">
          <div class="card-heade text-center mt-3 ">

            <p>Seafresh Indstry Public Company Limited 402 Village 8, Pakname Chumphon, Chumphon. 86120 Thailand </p>
            <h6>ใบตรวจเช็คอุปกรณ์เข้าไลน์ผลิต QC </h6>

          </div>
         


          <div class="card-body ">
            <div class="row justify-content-end">
              <div class="col-2">
                <button type="button" class="btn btn-primary mt-4 mr-3" id="logOut">ออกจากระบบ</button>
              </div>
           
            </div>
          

          
            <table class=" table ms-1 me-1 mt-3 table-bordered table-info" id="dataTable">
              <thead class="thead-dark">
                <tr class="text-center">
                  <th class="text-center" scope="col" style="width: 5%"><input type="checkbox" id = "selectAll" value="เลือกทั้งหมด" >  All</th>
                  <th scope="col" style="width: 5%">ลำดับ</th>
                  <th scope="col" style="width: 5%">ใบแจ้งซ่อม</th>
                  <th scope="col" style="width: 40%">รายละเอียด</th>
                  <th scope="col" style="width: 10%">วันที่</th>
                  <th scope="col" style="width: 1%"></th>
                 
                  <th scope="col" style="width: 5%">ใบเช็คอุปกรณ์</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php

                  include 'connect.php';

                  $empCode = $_GET['empCode'];
                  $sql = "SELECT * FROM sf_per_infrom_report
                  where  qc_check_before is null
                  and qc_username is not null
                  and qc_employee_code = '$empCode'
                  ORDER BY TO_DATE(eg_rece_date) DESC"
                  ;
                  $i = 0;
                  $result = oci_parse($objConnect, $sql,);
                  oci_execute($result,);


                  while ($row = oci_fetch_assoc($result)) { $i++; ?>
                  
                <tr class="text-center">
                  <td><input type="checkbox" name="check" id="<?php echo $row['EG_RECE_TRAN_ID'] ?>" value="<?php echo $row['EG_RECE_TRAN_ID'] ?>" class="check"></td>
                  <td><?php echo $i ?></td>
                  <td><?php echo $row['EG_RECE_DOCUMENT'] ?></td>
                  <td class="text-start"><?php echo $row['EG_RECE_COMMENT'] ?></td>
                  <td><?php echo $row['EG_RECE_DATE'] ?></td>
                  <td><input type="hidden" name="empCode" id="empCode" value="<?php echo $empCode ?>"></td>
                 
                 
                  <td><input type="buttom" name="detail"  id="<?php echo $row['EG_RECE_DOCUMENT'] ?>" value="ใบเช็คอุปกรณ์" class="btn btn-primary btn-sm shadow detail"></td>
                  <!-- <td><?php echo $row['PRODUCT_EMAIL'] ?></td>
                  <td><?php echo $row['QC_EMAIL']  ?></td> -->
                <?php oci_close($objConnect);
                  } ?>
                </tr>
              </tbody>
            </table>
           
          </div>
          
          <div class="d-flex justify-content-center ">
              <button type="button" class="btn btn-danger mt-4  " onclick="updteDataToSelect()">อัพเดทข้อมูล</button>
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

        function updteDataToSelect(){
          var documentNo = [];
          var i = 0;
          $('.check:checked').each(function(){
            documentNo[i++] = $(this).val();
          });
          console.log(documentNo);

          $.ajax({
            type: "POST",
            url: "updateDataQCToSelect.php",
            data: {documentNo:documentNo},
            success: function (response) {
              console.log(response);
             if(response == 'true'){
              swal({
                title: "อัพเดทข้อมูลสำเร็จ",
                text: "กดปุ่มตกลง",
                icon: "success",
                button: "ตกลง",
              }).then((value) => {
                location.reload();
              });
            }else{
              swal({
                title: "อัพเดทข้อมูลไม่สำเร็จ",
                text: "กดปุ่มตกลง",
                icon: "error",
                button: "ตกลง",
              }).then((value) => {
                location.reload();
              });
            }
            }
          })
        }
          
        

        $(document).ready(function() {
          $('.detail').click(function() {
            var documentID = $(this).attr("id");
            var empCode = $('#empCode').val();

            // open new page to link with parameter id 
           // window.open("http://10.2.2.5/sfifix/QcApproveCleaningCheck.php?documentNo=" + documentID + "&empCode="+empCode, "_blank")

           // open page
            window.location.href = "http://10.2.2.5/sfifix/QcApproveCleaningCheck.php?documentNo=" + documentID + "&empCode="+empCode;
        
          });

          $('#logOut').click(function(e) {
            e.preventDefault();
            location.href = "http://10.2.2.5/sfifix/checkStatusWorkQC.php";
          });

          // select all checkbox
          $('#selectAll').click(function(){
            if(this.checked){
              $('.check').each(function(){
                this.checked = true;
              });
            }else{
              $('.check').each(function(){
                this.checked = false;
              });
            }
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
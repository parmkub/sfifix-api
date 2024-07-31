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

  <title>รายงานใบแจ้งซ่อม Production</title>
</head>

<body>



  <?php

  ?>
  <div class="container mt-3 ">

    <div class="form-group">

      <div class="row justify-content-center ">
        <div class="card col-6 shadow p-3 mb-5 bg-white rounded ">
          <div class="card-heade text-center mt-3 ">

            <p>Seafresh Indstry Public Company Limited 402 Village 8, Pakname Chumphon, Chumphon. 86120 Thailand </p>
            <h6>โปรแกรมตรวจสอบเอกสารงานซ่อมของ Production</h6>

          </div>

          <div class="card-body ">
            <div class="row d-flex justify-content-center ">
              <div class="form-group col-8 ">
                <label for="empCode">รหัสพนักงาน</label>
                <input type="text" class="form-control" id="empCode" aria-describedby="รหัสพนักงาน" placeholder="กรอกรหัสพนักงาน">
               
              </div>
              <div class="row justify-content-center col-4">
              <button type="button" class="btn btn-primary mt-4 search " id="btnSearch">ค้นหา</button>
              </div>
              
            </div>

          </div>

          <div class="d-flex justify-content-center m-3">
            <h6>บริษัทซีเฟรชอินดัสตรีจำกัด มหาชน 402 หมู่ 8 ตำบลปากน้ำ อำเภอเมือง จังหวัดชุมพร 86120</h6>
          </div>

        </div>



      </div>

     
      <script type="text/javascript">
        $(document).ready(function() {
          $('.search').click(function(e) {
            e.preventDefault();
            var empCode = $('#empCode').val();
            console.log(empCode);
         
              //redirect page to reportCheckDocumentQC.php with parameter empCode method POST 
           
           
        
              


              

           
             location.href = "http://10.2.2.5/sfifix/reportCheckDocumentProduct.php?empCode=" + empCode;

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
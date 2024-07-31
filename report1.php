<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> -->

    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src= "bootstrap/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <title>SFI FIX</title>
</head>

<body>
    <div class="container mt-3">
        <div class="d-flex justify-content-center">
            <div class="col-6 ">
                <div class="card m-2 shadow-sm p-3">
                    <div class="d-flex justify-content-center mb-3">
                        <H3>รายงาน</H3>
                    </div>
                    <div class="row m-3">
                        <div class="col-9">
                            <form name="form1" id="form1" method="post" action="http://10.2.1.4:16200/Seafresh_WebCenter/Reports/engineering/eng_report1">
                                
                                <label for="fixNO" class="form-label">เอกสารเลขที่</label>
                                <input type="text" class="form-control" id="txt_no" name="txt_no">
                        </div>
                        <div class="col-3 align-self-end">
                            <button class="btn btn-primary " name="Submit" type="submit">แสดงข้อมูล</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>



    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->


</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="./css/font.css?family=Sarabun:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <title>SFI FIX</title>
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <div class="col col-xl-6">
                <div class="card m-2 shadow-sm p-3">
                    <div class="d-flex justify-content-center mb-3">
                        <H5>รายงานใบแจ้งซ่อม</H5>
                    </div>
                    <div class="row m-3">
                        <div class="col-9 ">
                            <form name="form1" id="form1" method="post" action="http://10.2.1.4:16200/Seafresh_WebCenter/Reports/engineering/eng_report1">

                                <label for="fixNO" class="form-label">เอกสารเลขที่</label>
                                <input type="text" class="form-control" id="txt_no" name="txt_no">
                        </div>
                        <div class="col-3 align-self-end">
                            <button class="btn btn-primary " name="Submit" type="submit">แสดงข้อมูล</button>
                        </div>

                        </form>

                        <div class="mt-3">
                            <p>กรุณากรอกเลขที่เอกสารใบแจ้งซ๋อม</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</body>

</html>
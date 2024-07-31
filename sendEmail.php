<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send_Email</title>
    <script src="https://smtpjs.com/v3/smtp.js"></script>


</head>

<body>


    <form action="" method="post">

        <input type="button" value="Send Email" onclick="sendEmail()"/>
    </form>



    <script type="text/javascript">
       function sendEmail(){
        //alert("Email sent successfully")
        Email.send({
                tls:{
                    rejectUnauthorized: false,
                    minVersion: 'TLSv1'
                },
                Host: "10.2.1.2",
                port: 25,
                Username: "webmaster",
                Password: "isyl]y[",
                To: "phayuhons@chp.seafresh.com",
                From: "webmaster@chp.seafresh.com",
                Subject: "Check Email Sending",
                Body: "สวัสดีคับ",
            }).then(function(message) {
                alert("Email sent successfully")
            });
       }
    </script>
</body>

</html>
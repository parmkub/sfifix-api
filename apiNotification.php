<?php

// Server key from Firebase Console
define('API_ACCESS_KEY', 'AAAApjXnhQ8:APA91bELUWrR9IlAFdxBDrSiiKajJjhNnFIlhzhTRSKnuq_OsQH0myyPV4EL-gh37GyfimwAtiqv81z4c6v5oKVvUdWwDF1ap211I7KeJur7xkPMrcDPZM3LejF3Qrb_8-qJDnwH4nrm'); // Replace YOUR FIREBASE CLOUD MESSAGING API KEY with your Firebase Cloud Messaging server Key

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // POST values
    $token = $_POST["token"];
    $title = $_POST["title"];
    $message = $_POST["message"];
   
    $token = htmlspecialchars($token, ENT_COMPAT);
    $title = htmlspecialchars($title, ENT_COMPAT);
    $message = htmlspecialchars($message, ENT_COMPAT);

    // Push Data's
    $data = array(
        "to" => "$token",
        "notification" => array(
            "body" => "$message",
            "title" => "$title",
            'click_action' => 'OPEN_ACTIVITY_1',
            "sound"=>'default',
            "content_available"=> 'true',
            "priority" => 'high',
        )
    );

    // Print Output in JSON Format
    $data_string = json_encode($data);

    // FCM API Token URL
    $url = "https://fcm.googleapis.com/fcm/send";

    //Curl Headers
    $headers = array(
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    // Variable for Print the Result
    $result = curl_exec($ch);
    print_r($result);
    curl_close($ch);
}

?>


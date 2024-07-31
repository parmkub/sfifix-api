
   
<?php
function sendFCM() {
  // FCM API Url
  $url = 'https://fcm.googleapis.com/fcm/send';

  // Put your Server Key here
  $apiKey = "AAAA_5t5w4I:APA91bFeU0SY9WC8D2jLxLR5zZwoFvkXY71OaOvfabO5uP7r6XxgMIJuBWk9BliW6kd8cr1kIs2Dazp-icpJGvD1SYumeCii7JJEKwodMrxQQ0l8R281Tn5OmXo2TkPr0KhQrUHJJu6N";

  // Compile headers in one variable
  $headers = array (
    'Authorization:key=' . $apiKey,
    'Content-Type:application/json'
  );

  // Add notification content to a variable for easy reference
  $notifData = [
    'title' => "รายการแจ้งซ๋อม",
    'body' => "รายการแจ้งซ่อมเลขที ",
    //  "image": "url-to-image",//Optional
    'click_action' => "OPEN_ACTIVITY_1" //Action/Activity - Optional
  ];

  $dataPayload = ['to'=> 'My Name', 
  'points'=>80, 
  'other_data' => 'This is extra payload'
  ];

  // Create the api body
  $apiBody = [
    'notification' => $notifData,
    'data' => $dataPayload, //Optional
    'time_to_live' => 600, // optional - In Seconds
    //'to' => '/topics/mytargettopic'
    //'registration_ids' = ID ARRAY
    'to' => 'e1vibc0uT3iqYFmY_hN01p:APA91bFE210ui8QssNb2OX-Du2qk8d0w1XdFnLJnyfKA3yWh6PTt9zO-JQ8X1J0n2zFKd51Evz19HfcsbgC13xDz1FoOrsCAtTz36qrg1TC9zwWMqvEte0Wuc8oe8qVyejN0sj6BifYi'
  ];

  // Initialize curl with the prepared headers and body
  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_POST, true);
  curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

  // Execute call and save result
  $result = curl_exec($ch);
  print($result);
  // Close curl after call
  curl_close($ch);

  return $result;
}
sendFCM();
?>

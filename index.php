<?php

session_start();
// Required if your environment does not handle autoloading
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
if(isset($_SESSION['mbn'])){

// Your Account SID and Auth Token from console.twilio.com
$sid = "AC8798f3d9eaab81d30a4b1512c54c3d13";
$token = "55ed08ec3cda6470cdad7f31b5419bf4";
$client = new Client($sid, $token);
$number=$_POST['mbn'];
$num=rand(1000,9999);
$_SESSION['otp']=$num;
$msg="Your Login OTP is ".$num;
// Use the Client to make requests to the Twilio REST API

                  $twilio_number="+16076012961";
                  $client = new Client($sid, $token);
                  $client->messages->create(
                      // Where to send a text message (your cell phone?)
                      $number,
                      array(
                          'from' => $twilio_number,
                          'body' => $msg
                      )
                  );
if ($message->sid) {
    echo "Message sent successfully.";
    echo "<script> window.location.assign('verifyotp.php');</script>'";
}
}
?>
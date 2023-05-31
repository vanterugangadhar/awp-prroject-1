<?php
session_start();
include 'dbconnection.php';

if (isset($_POST['verify']) && isset($_SESSION['mbn']) && isset($_SESSION['voterid']) && isset($_SESSION['otp']) && isset($_POST['otpv']) && isset($_SESSION['domain'])) {
    $user_otp = $_POST['otpv'];
    $otp = $_SESSION['otp'];

    if ($otp == $user_otp) {
        echo "<script>alert('OTP verified successfully')</script>";
        $voterid = $_SESSION['voterid'];
        $mobilenumber = $_SESSION['mbn'];
        $domain = $_SESSION['domain'];
        $sql = "INSERT INTO nomineeregistration(voterid, mobilenumber, domain) VALUES ('$voterid', '$mobilenumber', '$domain')";
        mysqli_query($connection, $sql);
        echo "<script>alert('Registration completed successfully');</script>";
        echo "<script>window.location.assign('menu.php');</script>";
        exit; // Add exit to stop further execution
    } else {
        echo "<script>alert('Wrong OTP')</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>OTP LOGIN SYSTEM USING TWILION API</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
	    <script src="./js/bootstrap.min.js"></script>
	    <link rel="stylesheet" href="./style.css">
</head>
<body>

          <div class="container">
        
            <form method="post">
                
                <div class="form-group">
                    <label for="number">OTP Number:</label>
                    <input type="text" class="form-control" id="" name="otpv" required>
                </div>
		            <button type="submit"  class="btn btn-primary" name="verify">Verify</button>
            </form>

          </div>
</body>
</html>



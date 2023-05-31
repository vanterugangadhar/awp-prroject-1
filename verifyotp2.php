<?php
session_start();
include 'dbconnection.php';
if (isset($_SESSION['username'])&&isset($_SESSION['mbn'])&&isset($_SESSION['otp'])&&isset($_POST['otpv'])) {
 
 $user_otp=$_POST['otpv'];

 $otp=$_SESSION['otp'];

 if ($otp==$user_otp) {
  
  echo "<script>alert('otp verified sucessfully')</script>";
					
                    echo '<script> window.location.assign("login1.php");</script>';
 }

  else{

    echo "<script>alert('otp wrong')</script>";

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



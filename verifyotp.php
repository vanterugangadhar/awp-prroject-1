<?php
session_start();
include 'dbconnection.php';
if (isset($_POST['verify'])&&isset($_SESSION['photo'])&&isset($_SESSION['image'])&&isset($_SESSION['name'])
&&isset($_SESSION['dob'])&&isset($_SESSION['course'])&&isset($_SESSION['branch'])&&isset($_SESSION['domain'])&&isset($_SESSION['mbn'])&&
isset($_SESSION['otp'])&&isset($_POST['otpv'])) {
 
 $user_otp=$_POST['otpv'];

 $otp=$_SESSION['otp'];

 if ($otp==$user_otp) {
  
  echo "<script>alert('otp verified sucessfully')</script>";
          $filenamenew=$_SESSION['photo'];
					$filenamenew1=$_SESSION['image'];
          
          $fullname=$_SESSION['name'];
          $dob=$_SESSION['dob'];
          $course=$_SESSION['course'];
          $branch=$_SESSION['branch'];
          $domain=$_SESSION['domain'];	
          $mobilenumber=$_SESSION['mbn'];
          $sql="INSERT INTO registration(photourl,imageurl,username,dateofbirth,course,branch,domain,mobilenumber) values('$filenamenew1','$filenamenew','$fullname','$dob','$course','$branch','$domain','$mobilenumber')";
					mysqli_query($connection,$sql);
					echo "<script>alert('Registration completed successfully');</script>";
          echo "<script> window.location.assign('menu.php');</script>";
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
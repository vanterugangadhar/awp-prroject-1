<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="./js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="style.css">
	<style>
		.logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            }
            .logout-button {
                padding: 10px 20px;
                display: inline-block;
                color: white;
                background-color: #f44336;
                border: none;
                text-decoration: none;
                cursor: pointer;
                border-radius: 4px;
            }

            .logout-button:hover {
                background-color: #d32f2f;
            }

	</style>
</head>
<body>
	<div class="container">
		<h1>Registration</h1>
		<form  method="post" enctype="multipart/form-data">
			<div class="form-group">
                <label for="Upload">Upload Photo:</label>
                <input type="file" class="form-control" id="image" name="photo" required><font style="color: red;">(.jpg,.jpeg,.png  and <500kb)</font>
            </div>
            <div class="form-group">
                <label for="Upload">Upload Aadhar:</label>
                <input type="file" class="form-control" id="image" name="image" required><font style="color: red;">(.jpg,.jpeg,.png  and <500kb)</font>
            </div>
		    <div class="form-group">
				<label for="name">Full Name:</label>
				<input type="text" class="form-control" id="name" name="name" required><font style="color: red;">(as per Aadhar)</font>
			</div>
			<div class="form-group">
				<label for="dob">Date-Of-Birth</label>
				<input type="date" class="form-control" id="dob" name="dob" required><font style="color: red;">(as per Aadhar)</font>
			</div>
			<div class="form-group">
				<label for="courses">Select Course</label>
				<select name="course" id="">
					<option value="course1">Course</option>
					<option value="Btech">Btech</option>
					<option value="b.s.c">B.Sc</option>
				</select>
			</div>
			<div class="form-group">
				<label for="branch">Select Branch</label>
				<select name="branch" id="">
					<option value="branch1">Branch</option>
					<option value="cse">CSE</option>
					<option value="ece">ECE</option>
					<option value="mech">MECH</option>
					<option value="ece">ECE</option>
				</select>
			</div>
			<div class="form-group">
				<label for="domain">Select Domain</label>
				<select name="domain" id="">
					<option value="domain">domain</option>
					<option value="cn">computer networks</option>
					<option value="csd">data science</option>
					<option value="aiml">machine learning</option>
					<option value="cic">iot and cyber security</option>
				</select>
			</div>  
			<div class="form-group">
				<label for="mbn">Mobile Number</label>
				<input type="text" class="form-control" id="mbn" name="mbn" required><font style="color: red;">(ex:+91xxxxxxxxxx)</font>
			</div>
			<button type="submit"  class="btn btn-primary" name="submit">Submit</button>
		</form>
	</div>
	<a href="logout1.php" class="logout-button">Logout</a>
</body>
</html>


<?php
	session_start();
	include "dbconnection.php";
	require __DIR__ . '/vendor/autoload.php';
	use Twilio\Rest\Client;
	if(isset($_POST['submit'])){
		$file=$_FILES['image'];
		$filename=$_FILES['image']['name'];
		$filesize=$_FILES['image']['size'];
		$filetmp=$_FILES['image']['tmp_name'];
		$filetype=$_FILES['image']['type'];
		$fileerror=$_FILES['image']['error'];
		
		$file1=$_FILES['photo'];
		$filename1=$_FILES['photo']['name'];
		$filesize1=$_FILES['photo']['size'];
		$filetmp1=$_FILES['photo']['tmp_name'];
		$filetype1=$_FILES['photo']['type'];
		$fileerror1=$_FILES['photo']['error'];
		

		$fileext=explode('.',$filename);
		$fileactualext=strtolower(end($fileext));
		$allowed=array('jpg','png','jpeg');

		$fileext1=explode('.',$filename1);
		$fileactualext1=strtolower(end($fileext1));
		$allowed1=array('jpg','png','jpeg');

		$fullname=$_POST['name'];
		$dob=$_POST['dob'];
		$course=$_POST['course'];
		$branch=$_POST['branch'];
		$domain=$_POST['domain'];	
		$mobilenumber=$_POST['mbn'];	
		$query="SELECT * from registration WHERE mobilenumber=$mobilenumber";
		$run=mysqli_query($connection,$query);
		if(mysqli_num_rows($run)>0){
			echo "<script>alert('Already mobile number is registered');</script>";
		}
		
		else if((in_array($fileactualext,$allowed))&&(in_array($fileactualext1,$allowed1))){
			if($fileerror===0){
				if(($filesize<500000)&&($filesize1<500000)){
					$filenamenew = uniqid('', true) . "." . $fileactualext;
					$filenamenew1 = uniqid('', true) . "." . $fileactualext1;
					$filedestination = 'images/' . $filenamenew;
					$filedestination1 = 'images/' . $filenamenew1;
					move_uploaded_file($filetmp, $filedestination);
					move_uploaded_file($filetmp1, $filedestination1);
					if(isset($mobilenumber)){
						$sid = "AC8798f3d9eaab81d30a4b1512c54c3d13";
						$token = "55ed08ec3cda6470cdad7f31b5419bf4";
						$twilio_number="+16076012961";
						$num=rand(1000,9999);
						$_SESSION['loggedin'] = true;
            			$_SESSION['photo'] = $filenamenew;
            			$_SESSION['image']=$filenamenew1;
						$_SESSION['name'] = $fullname;
            			$_SESSION['dob'] = $dob;
            			$_SESSION['course']=$course;
						$_SESSION['branch'] = $branch;
            			$_SESSION['domain'] = $domain;
            			$_SESSION['mbn']=$mobilenumber;
						$_SESSION['otp']=$num;
						$msg="Your Login OTP is ".$num;
						$client = new Client($sid, $token);
						$message=$client->messages->create(
						  // Where to send a text message (your cell phone?)
							$mobilenumber,
							array(
								'from' => $twilio_number,
								'body' => $msg
							)
						);
						if ($message->sid) {
							echo "<script>alert('OTP sent successfully')</script>";
							echo "<script> window.location.assign('verifyotp.php');</script>";
						}
					}
				}
				else{
					echo "<script>alert('Please check your uploaded files are is too big');</script>";
				}
			}else{
				echo "<script>alert('There was an error uploading your file');</script>";
			}
		}
		else{
			echo "<script>alert('You cannot upload this type of files');</script>";
		}
		
	}

?>

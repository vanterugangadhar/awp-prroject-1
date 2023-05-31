<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
	<script src="./js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./style.css">
    <title>Nominee Registration</title>
</head>
<body>
    <div class="container">
        
        <form method="post" action="">
            
            <div class="form-group">
                <label for="voterid">VOTER ID:</label>
                <input type="text" class="form-control" id="voterid" name="voterid" required>
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
                <label for="mbn">Mobile Number:</label>
                <input type="text" class="form-control" id="mbn" name="mbn" required><font style="color: red;">(ex:+91xxxxxxxxxx)</font>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
    session_start();
	include "dbconnection.php";
	require __DIR__ . '/vendor/autoload.php';
	use Twilio\Rest\Client;

	if(isset($_POST['submit'])){
		$voterid = $_POST['voterid'];
		$mobilenumber = $_POST['mbn'];	
		$domain=$_POST['domain'];
		$query = "SELECT * FROM nomineeregistration WHERE voterid='$voterid' AND mobilenumber='$mobilenumber'";
		$run = mysqli_query($connection, $query);

        $query1 = "SELECT * FROM registration WHERE voterid='$voterid' AND domain='$domain' AND mobilenumber='$mobilenumber'";
        $run1 = mysqli_query($connection, $query1);

		if(mysqli_num_rows($run) > 0){
			echo "<script>alert('Mobile number is already registered.');</script>";
		}
		else if(mysqli_num_rows($run1) == 1){
			$voterid = $_POST['voterid'];
			$mobilenumber = $_POST['mbn'];	
			$domain=$_POST['domain'];
			$sid = "AC8798f3d9eaab81d30a4b1512c54c3d13";
			$token = "55ed08ec3cda6470cdad7f31b5419bf4";
			$twilio_number = "+16076012961";
			$num = rand(1000, 9999);
			$_SESSION['loggedin'] = true;
			$_SESSION['voterid'] = $voterid;
			$_SESSION['mbn'] = $mobilenumber;
			$_SESSION['otp'] = $num;
			$_SESSION['domain']=$domain;
			$msg = "Your Login OTP is " . $num;

			$client = new Client($sid, $token);
			$message = $client->messages->create(
				$mobilenumber,
				array(
					'from' => $twilio_number,
					'body' => $msg
				)
			);

			if ($message->sid) {
				echo "<script>alert('OTP sent successfully.')</script>";
				echo "<script>window.location.assign('nomineeregverifyotp.php');</script>";
			}
		}
        else{
            echo "<script>alert('Invalid details.')</script>";
        }
	}
?>

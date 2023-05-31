<?php
session_start();
include "dbconnection.php";

if (isset($_POST['submit'])) {
    $file = $_FILES['image'];
    $filename = $_FILES['image']['name'];
    $filesize = $_FILES['image']['size'];
    $filetmp = $_FILES['image']['tmp_name'];
    $filetype = $_FILES['image']['type'];
    $fileerror = $_FILES['image']['error'];

    $fileext = explode('.', $filename);
    $fileactualext = strtolower(end($fileext));
    $allowed = array('jpg', 'png', 'jpeg');
    $profile = $_FILES['image']['name'];
    $partyname = $_POST['name'];
    $nomineeid = $_SESSION['nid'];
    $query = "SELECT * FROM nomineeregistration WHERE nominneid='$nomineeid'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $row1 = $row['partyname'];
    
    if (empty($row['photo']) && empty($row['partyname'])) {
        if (in_array($fileactualext, $allowed)) {
            if ($fileerror === 0) {
                if ($filesize < 500000) {
                    $filenamenew = uniqid('', true) . "." . $fileactualext;
					
					$filedestination = 'images/' . $filenamenew;
					
					move_uploaded_file($filetmp, $filedestination);
					
                    $query = "UPDATE nomineeregistration SET photo='$filenamenew', partyname='$partyname' WHERE nominneid='$nomineeid'";
                    $result = mysqli_query($connection, $query);
                    
                    echo "<script>alert('Registration completed successfully');</script>";
                } else {
                    echo "<script>alert('Please check your uploaded file size. It is too big');</script>";
                }
            } else {
                echo "<script>alert('There was an error uploading your file');</script>";
            }
        } else {
            echo "<script>alert('You cannot upload this type of file');</script>";
        }
    }  else {
        echo "<script>alert('For this nominee ID, the form is already filled.');</script>";
    }
    if (!empty($row1)) {
        echo "<script>alert('Already this party name exists');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nominee Registration</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <script src="./js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="profile">Profile photo (or) party photo:</label>
            <input type="file" class="form-control" id="profile" name="image" required>
        </div>
        <div class="form-group">
            <label for="name">Party name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
</body>
</html>

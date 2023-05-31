<?php
    // Check if the user is logged in
    require_once "dbconnection.php";
    session_start();
    
    // Assuming you have established a connection to your database, include the necessary code here.
    // $connection = mysqli_connect("localhost", "username", "password", "database_name");

    if (isset($_SESSION['username']) && isset($_SESSION['mbn']) && isset($_SESSION['domain'])) {
        $username = $_SESSION['username'];
        $mobilenumber = $_SESSION['mbn'];
        $domain = $_SESSION['domain'];
        
        echo "<p><strong>Username:</strong> $username</p>";
        echo "<p><strong>Mobile number:</strong> $mobilenumber</p>";
        echo "<p><strong>Domain:</strong> $domain</p>";
        
        $query = "SELECT status FROM registration WHERE mobilenumber = '$mobilenumber'";
        $result = mysqli_query($connection, $query);
        
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $status = $row['status'];
                echo "<p><strong>Status:</strong> $status</p>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            padding: 20px;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        strong {
            font-weight: bold;
            color: #008080;
        }
        .center {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }


    .center button {
      margin: 0 10px; 
      width: 150px; 
      height: 50px; 
    }
    </style>
</head>
<body>
<div class="center">
    <a href="studentnominee.php"><button>Student Nominees</button></a>
    <button>Faculty Nominees</button>
  </div>
</body>
</html>

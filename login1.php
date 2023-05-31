<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto; /* Center the card horizontally */
            max-width: 400px; /* Limit the maximum width of the card */
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
            margin-bottom: 20px;
        }

        .center a,
.center button {
    margin: 0 10px; 
    width: 250px; 
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    background-color: #008080;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    margin-top: 240px;
    
}

.center a:hover,
.center button:hover {
    background-color: #006666;
}

        .user-profile {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 300px;
        }

        .user-profile p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="user-profile">
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
                $status = '';
                $query = "SELECT status FROM registration WHERE mobilenumber = '$mobilenumber'";
                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) == 1) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = $row['status'];
                    }
                }

                echo "<p><strong>Username:</strong> $username</p>";
                echo "<p><strong>Mobile number:</strong> $mobilenumber</p>";
                echo "<p><strong>Domain:</strong> $domain</p>";
                echo "<p><strong>Status:</strong> $status</p>";
            }
        ?>
    </div>

    <div class="center">
		
        <a href="studentnominee.php">Student Nominees</a>
        <button>Faculty Nominees</button>
    </div>

    
</body>
</html>

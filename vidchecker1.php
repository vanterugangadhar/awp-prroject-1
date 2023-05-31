<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>voterid page</title>
    <style>
        body{
            background-color: grey;

        }
        p{
            text-align: center;
            margin-top: 250px;
            color: white;
            font-size: 50px;
        }
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
    <?php
        include 'dbconnection.php';
        session_start();
        if(isset($_SESSION['username']) && isset($_SESSION['mbn'])) {
            $name=$_SESSION['username'];
            $mobilenumber=$_SESSION['mbn'];
            $query="SELECT voterid from registration where mobilenumber=$mobilenumber";
            
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_assoc($result);
            if($row['voterid']){
                
            
         
    ?>
        <p>HELLO <?php echo $name ?>. Your voter id number is generated. Voter ID number is <b><?php echo $row['voterid']; ?></b></p>
    <?php
            }
        
        else{
    ?>
    <p>HELLO <?php echo $name ?>. Your voter id number was not generated</p>
    
    <?php
        }
    }
    ?>
    
    <a href="logout1.php" class="logout-button">Logout</a>
    
</body>
</html>

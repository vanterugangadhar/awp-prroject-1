<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nominee ID Checker Page</title>
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
    </style>
</head>
<body>
<?php
        include 'dbconnection.php';
        session_start();
        if(isset($_SESSION['mbn'])&&isset($_SESSION['voterid'])) {
            
            $mobilenumber=$_SESSION['mbn'];
            $query = "SELECT nominneid FROM nomineeregistration WHERE mobilenumber = '$mobilenumber'";
            
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_assoc($result);
            if($row['nominneid']){
                
            
         
    ?>
        <p>HELLO Your Nominee id number is generated. Nominee ID number is <b><?php echo $row['nominneid']; ?></b></p>
    <?php
            }
        
        else{
    ?>
    <p>HELLO Your Nominee id number was not generated</p>
    
    <?php
        }
    }
    ?>
</body>
</html>

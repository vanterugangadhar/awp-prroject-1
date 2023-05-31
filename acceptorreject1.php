<?php
    require_once "dbconnection.php";
    
    if(isset($_POST['accept'])) 
    {
        
        $mobilenumber = $_POST['mobilenumber'];
        $query = "SELECT voterid FROM nomineeregistration WHERE mobilenumber='$mobilenumber'";
        $result = mysqli_query($connection, $query);
        $query1="SELECT nominneid FROM nomineeregistration WHERE mobilenumber='$mobilenumber'";
        $result1 = mysqli_query($connection, $query1);
        $row=mysqli_fetch_assoc($result);
        $row1=mysqli_fetch_assoc($result1);
        if($row['voterid']){
            
                $unqid = 'CNOID'.substr(str_shuffle("0123456789"), 0, 7);
                $query = "UPDATE nomineeregistration SET nominneid='$unqid' WHERE mobilenumber='$mobilenumber'";
                $result = mysqli_query($connection, $query);
                if($result&&$row1['nominneid']=='') 
                {
                    echo "<script>alert('Your application nominee id number is generated. Your unique ID is $unqid.');</script>";
                } 
                else 
                {
                    echo "<script>alert('Your application nominee id number is already generated');</script>";
                }
        }
        else{
            echo "<script>alert('Already nominee id is generated for this registered applicant')</script>";
        }
    }
    if(isset($_POST['reject'])){
        $mobilenumber = $_POST['mobilenumber'];
        $query = "DELETE FROM nomineeregistration WHERE mobilenumber='$mobilenumber'";
        $result = mysqli_query($connection, $query);
        if ($result) 
        {
            echo "<script>alert('The applicant nominee data has been deleted successfully.');</script>";
        }
        else 
        {
            echo "<script>alert('There was an error while deleting the applicant data.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accept or Reject data</title>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <style type="text/css">
            table.center{
                margin-top: 40px;
                margin-left: auto;
                margin-right: auto;
            }
            body{
                width: 100%;
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

    <body >

        <h3 style="text-align:center">DATA PRESENT IN OUR DATABASE</h3>
        <form action="" method="post">
            <table border='2' class="center">   
                <tr>
                    
                    <td>Voter id</td>
                    <td>mobile number</td>
                    <td>Nominee id</td>
                    <td>Party Photo</td>
                    <td>party name</td>
                    <td>Domain</td>
                    <td>Accept</td>
                    <td>Reject</td>
                </tr>
                <tr>
                    <?php
                        require_once "dbconnection.php";
                        $query="SELECT * from nomineeregistration";
                        $result=mysqli_query($connection,$query);
                        while($row=mysqli_fetch_assoc($result))
                        {
                     ?>
                        
                        <td><?php echo $row['voterid'];  ?></td>
                        <td><?php echo $row['mobilenumber'];  ?></td>
                        <td><?php echo $row['nominneid'];  ?></td>
                        <td><img src="images/<?php echo $row['photo']; ?>" alt="image" width="70px" height="80px"></td>
                        <td><?php echo $row['partyname'];  ?></td>
                        <td><?php echo $row['domain'];  ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="mobilenumber" value="<?php echo $row['mobilenumber']; ?>">
                                <input type="submit" name="accept" id="accept" value="Accept">
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="mobilenumber" value="<?php echo $row['mobilenumber']; ?>">
                                <input type="submit" name="reject" value="Reject">
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
            </table>
        </form>
        <a href="logout.php" class="logout-button">Logout</a>

    </body>
</html>


<?php
    require_once "dbconnection.php";
    
    if(isset($_POST['accept'])) 
    {
        
        $mobilenumber = $_POST['mobilenumber'];
        $dateofbirth = $_POST['dateofbirth'];
        $age = date_diff(date_create($dateofbirth), date_create('today'))->y;
        $query = "SELECT voterid FROM registration WHERE mobilenumber='$mobilenumber'";
        $result = mysqli_query($connection, $query);
        $row=mysqli_fetch_assoc($result);
        if($row['voterid']==''){
            if($age >= 18)
            {
                $unqid = 'CVOID'.substr(str_shuffle("0123456789"), 0, 7);
                $query = "UPDATE registration SET voterid='$unqid' WHERE mobilenumber='$mobilenumber'";
                $result = mysqli_query($connection, $query);
        
                if($result) 
                {
                    echo "<script>alert('Your application voter id number is generated. Your unique ID is $unqid.');</script>";
                } 
                else 
                {
                    echo "<script>alert('Your application voter id number is not generated');</script>";
                }
            }   
        }
        else{
            echo "<script>alert('Already voter id is generated for this registered applicant')</script>";
        }
    }
    if(isset($_POST['reject'])){
        $mobilenumber = $_POST['mobilenumber'];
        $query = "DELETE FROM registration WHERE mobilenumber='$mobilenumber'";
        $result = mysqli_query($connection, $query);
        if ($result) 
        {
            echo "<script>alert('The applicant data has been deleted successfully.');</script>";
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
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
                    <td>photo url</td>
                    <td>image url</td>
                    <td>user name</td>
                    <td>date of birth</td>
                    <td>course</td>
                    <td>branch</td>
                    <td>domain</td>
                   
                    <td>mobile number</td>
                    <td>Voter id</td>
                    <td>Status</td>
                    <td>Voted party</td>
                    <td>Accept</td>
                    <td>Reject</td>
                </tr>
                <tr>
                    <?php
                        require_once "dbconnection.php";
                        $query="SELECT * from registration";
                        $result=mysqli_query($connection,$query);
                        while($row=mysqli_fetch_assoc($result))
                        {
                     ?>
                        <td><img src="images/<?php echo $row['photourl']; ?>" alt="image" width="70px" height="80px"></td>
                        <td><img src="images/<?php echo $row['imageurl']; ?>" alt="image" width="70px" height="80px"></td>
                        
                        <td><?php echo $row['username'];  ?></td>
                        <td><?php echo $row['dateofbirth'];  ?></td>
                        <td><?php echo $row['course'];  ?></td>
                        <td><?php echo $row['branch'];  ?></td>
                        <td><?php echo $row['domain'];  ?></td>
                       
                        <td><?php echo $row['mobilenumber'];  ?></td>
                        <td><?php echo $row['voterid']  ?></td>
                        <td><?php echo $row['status']  ?></td>
                        <td><?php echo $row['votedparty']  ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="dateofbirth" value="<?php echo $row['dateofbirth']; ?>">
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


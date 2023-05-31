<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        h3 {
            text-align: center;
            background-color: yellow;
        }
        
        .center {
            margin-left: auto;
            margin-right: auto;
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
    <br><br><br>
    <h3>STUDENT NOMINEES</h3>
    
    <table border='2' align="center">   
        <tr>
            <td>Photo URL</td>
            <td>Party Name</td>
            <td>Vote</td>
        </tr>
        <?php
        require_once "dbconnection.php";
        session_start();
        if (isset($_SESSION['username'])) {
            $domain = $_SESSION['domain'];
            $query = "SELECT * FROM nomineeregistration WHERE domain='$domain'";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $photo = $row['photo'];
                if ($photo != '') {
        ?>
        <tr>
            <td width="100" ><img src="images/<?php echo $photo; ?>" alt="image" width="70px" height="80px"></td>
            <td width="100"><?php echo $row['partyname']; ?></td>
            <td width="100">
                <form method="post" id="voteForm">
                    <input type="hidden" name="partyname" value="<?php echo $row['partyname']; ?>">
                    <input type="submit" name="vote" id="vote" value="Vote">
                </form>
            </td>
        </tr>
        <?php
                }
            }
        }
        ?>
    </table>
    <a href="logout1.php" class="logout-button">Logout</a>
    
    
</body>
</html>

<?php

if (isset($_SESSION['username']) && isset($_POST['vote'])) {
    require_once "dbconnection.php";
    
    $username = $_SESSION['username'];
    $voterid = $_SESSION['vid'];
    $voterparty = $_POST['partyname'];
    $query = "SELECT status FROM registration WHERE username='$username' AND voterid='$voterid'";
    $result = mysqli_query($connection, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];
        
        if ($status == 'Not Voted') {
            $query = "UPDATE registration SET status='Voted', votedparty='$voterparty' WHERE voterid='$voterid'";
            $result = mysqli_query($connection, $query);
            
            if ($result) {
                echo "<script>alert('Your vote has been saved successfully')</script>";
            } else {
                echo "<script>alert('An error occurred while saving your vote. Please try again.')</script>";
            }
        } else {
            echo "<script>alert('Your vote has already been submitted. You cannot vote again.')</script>";
        }
    }
}
?>

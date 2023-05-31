<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
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
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <h3>Total Users</h3>
                    <?php
                        require_once 'dbconnection.php';
                        $query = "SELECT COUNT(*) AS count FROM registration";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>Total - $count cadidates</p>";
                        } else {
                            echo "<p>No users found</p>";
                        }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <h3>Data Science</h3>
                    <?php
                        $query = "SELECT COUNT(*) AS count FROM registration where  domain='csd'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>Total - $count candidates</p>";
                        }
                        $query = "SELECT COUNT(*) AS count FROM registration where status='voted' and domain='csd'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>$count voted</p>";
                        }
                        $query = "SELECT COUNT(*) AS count FROM registration where status='Not Voted' and domain='csd'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>$count not voted</p>";
                        }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <h3>Machine Learning</h3>
                    <?php

                        $query = "SELECT COUNT(*) AS count FROM registration where  domain='aiml'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>Total - $count candidates</p>";
                        }
                        $query = "SELECT COUNT(*) AS count FROM registration where status='voted' and domain='aiml'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>$count voted</p>";
                        }
                        $query = "SELECT COUNT(*) AS count FROM registration where status='Not Voted' and domain='aiml'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>$count not voted</p>";
                        }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <h3>Computer Networks</h3>
                    <?php
                        $query = "SELECT COUNT(*) AS count FROM registration where  domain='cn'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>Total - $count candidates</p>";
                        }
                        $query = "SELECT COUNT(*) AS count FROM registration where status='voted' and domain='cn'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>$count voted</p>";
                        }
                        $query = "SELECT COUNT(*) AS count FROM registration where status='Not Voted' and domain='cn'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>$count not voted</p>";
                        }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <h3>Iot and Cyber Security</h3>
                    <?php

                        $query = "SELECT COUNT(*) AS count FROM registration where  domain='cic'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>Total - $count candidates</p>";
                        }
                        $query = "SELECT COUNT(*) AS count FROM registration where status='voted' and domain='cic'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>$count voted</p>";
                        }
                        $query = "SELECT COUNT(*) AS count FROM registration where status='Not Voted' and domain='cic'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>$count not voted</p>";
                        }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <h3>CR(BOYS) NOMINEE</h3>
                    <?php

                        $query = "SELECT COUNT(*) AS count FROM registration";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>Total - $count candidates</p>";
                        }
                        $query = "SELECT COUNT(*) AS count FROM registration where status='voted' and votedparty='CR(BOYS)'";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $count = $row['count'];
                            echo "<p>$count voted</p>";
                        }
                        
                    ?>
                </div>
            </div>
        </div>
    </div>
    <a href="logout.php" class="logout-button">Logout</a>

</body>
</html>

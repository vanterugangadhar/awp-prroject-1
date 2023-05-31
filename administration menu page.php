<!DOCTYPE html>
<html>
  <head>
    <title>Administration Menu Page</title>
    <style>
        body{
            background-color: whitesmoke;
        }
        nav {
            background-color: #333;
            height: 50px;
            margin-bottom: 20px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav li {
            margin: 0;
            padding: 0;
        }

        nav a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 0 20px;
            line-height: 50px;
        }

        nav a:hover {
            background-color: #555;
        }

        h1 {
            font-size: 36px;
            margin: 0;
            padding: 20px;
            text-align: center;
            background-color: yellow;
            margin-top: 5px;
            margin-bottom: 35px;
        }

        p {
            font-size: 18px;
            margin: 0;
            padding: 20px;
        }
        marquee{
            background-color: whitesmoke;
            margin-bottom: 35px;
        }
        .center {
            display: block;
            margin-top: 45px;
        }

    </style>
  </head>
  <body>
    <h1>ONLINE VOTING SYSTEM (Administration)</h1>
    <marquee behavior="ltr" direction="ltr">WELCOME TO ONLINE VOTING SYSTEM</marquee>
    <nav>
      <ul>
        <li><a href="acceptorreject.php">Voter Details</a></li>
        <li><a href="acceptorreject1.php">Nominee Details</a></li>
        <li><a href="dash1.php">Dashboard</a></li>
        
      </ul>
    </nav>
    <img src="https://www.hi-techmedical.org/img/administration.jpg" alt="vote" width="1520" height="450"  class="center">
  </body>
</html
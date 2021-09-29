<?php

session_start();

require_once "config.php";

$sql = "SELECT * FROM donors,users WHERE donors.user_id = users.id ";  
$result = mysqli_query($conn, $sql);

?>












<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">


  <link rel="stylesheet" href="css/style.css">
  <title>Blood boons</title>
</head>

<body>
<header class="inner">
    <h2><a href="index.php">
    
            <img src="./img/icons8-blood-donation-64.png" class="img-fluid">

        Blood boons</a></h2>
    <nav>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="donors.php">Donors</a>
        </li>
        <li>
          <a href="requests.php">Requests</a>
        </li> 
        <li>
          <a href="donate.php">Donate</a>
        </li>
        <li>
          <a href="request_blood.php">Request blood</a>
        </li> 

        <li>
          <a href="login.php">
            <?php
                if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
                {
                    echo("LogIn/SignUp");
                }
            ?>
          </a>
        </li>

        <li>
          <a href="logout.php">
            <?php
                if(isset($_SESSION['loggedin']))
                {
                    echo("logout");
                }
            ?>
          </a>
        </li>


      </ul>
    </nav>
  </header>

  <section id="donors" class="container">
    <table id="customers">
      <tr>
        <th>Blood Group</th>
        <th>State</th>
        <th>Name</th>
        <th>Contact</th>
      </tr>
      <?php  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                            while($row = mysqli_fetch_array($result))  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $row["blood_grp"];?></td>  
                               <td><?php echo $row["state"]; ?></td>  
                               <td><?php echo $row["name"]; ?></td>
                               <td><?php echo $row["mobile"]; ?></td>
                          </tr>  
                          <?php  
                               }  
                          }  
                          ?>  
  </section>
</body>

</html>
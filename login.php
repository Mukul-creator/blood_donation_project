<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['mobile']))
{
    header("location: index.php");
    exit;
}
require_once "config.php";

$mobile = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['mobile'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter email + password";
    }
    else{
        $mobile = trim($_POST['mobile']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, mobile, password FROM users WHERE mobile = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_mobile);
    $param_mobile = $mobile;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $mobile, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["mobile"] = $mobile;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: index.php");
                            
                        }
                    }

                }

    }
}    


}


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
  <link rel="stylesheet" href="css/login.css">

  <title>Blood boons</title>
</head>

<body>
  <header class="inner">
    <h2><a href="index.php"><i class="fas fa-code"></i>
        Blood boons</a></h2>
        <nav>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="donors.html">Donors</a>
        </li>
        <li>
          <a href="requests.html">Requests</a>
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

  <section id="login-signup" class="login-signup">
      <h2>
          <center>
            LogIn Now!...
          </center>
    </h2>
    <form action="" method="post">  
        <div class="container">   
            <label>Mobile Number : </label>   
            <input type="phone" placeholder="Enter Mobile Number" id="mobile" name="mobile" required>  
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" id="password" name="password" required>  
            <button type="submit">Login</button>   
            <!-- <input type="checkbox" checked="checked"> Remember me    -->
            <a href="signup.php">SignUp</a>
            <!-- <button type="button" class="cancelbtn"> Cancel</button>    -->
        </div>   
    </form>    
  </section>
  
  <script src="./js/scripts.js"></script>
</body>

</html>















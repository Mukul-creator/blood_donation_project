<?php
require_once "config.php";

$mobile = $password = $name = $email = "";
$mobile_err = $password_err = $name_err = $email_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if mobile is empty
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = "Mobile Number cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE mobile = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_mobile);

            // Set the value of param mobile
            $param_mobile = trim($_POST['mobile']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $mobile_err = "This mobile number is already taken"; 
                }
                else{
                    $mobile = trim($_POST['mobile']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for name
if(empty(trim($_POST['name']))){
  $name_err = "name cannot be blank";
}
else{
  $name = trim($_POST['name']);
}

// Check for email
if(empty(trim($_POST['email']))){
  $email_err = "email cannot be blank";
}
else{
  $email = trim($_POST['email']);
}


// If there were no errors, go ahead and insert into the database
if(empty($mobile_err) && empty($password_err) && empty($name_err) && empty($email_err))
{
    $sql = "INSERT INTO users (mobile, password, name, email) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ssss", $param_mobile, $param_password, $param_name, $param_email);

        // Set these parameters
        $param_mobile = $mobile;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_name = $name;
        $param_email = $email;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
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
                session_start();

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
            Sign up for free!...
          </center>
    </h2>
    <form action= "" method= "post">  
        <div class="container">   
            <label>Mobile Number : </label>   
            <input type="phone" placeholder="Enter Mobile Number" id="mobile" name="mobile" required>
            <label>Name : </label>   
            <input type="text" placeholder="Enter Your Name" id="name" name="name" required>
            <label>Email : </label>   
            <input type="email" placeholder="Enter Your Email" id="email" name="email" required>
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" id="password" name="password" required>  
            <button type="submit">sign Up</button>   
            <a href="login.php">Already registered!!</a>
        </div>   
    </form>    
  </section>
  <script src="./js/scripts.js"></script>
</body>

</html>















<?php

session_start();


require_once "config.php";

$blood_grp = $state = $city = $district = $address = $pincode ="";

$err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  if
  (
    empty(trim($_POST['blood_grp'])) || empty(trim($_POST['state'])) || empty(trim($_POST['city']))
    || empty(trim($_POST['district'])) || empty(trim($_POST['address'])) || empty(trim($_POST['pincode']))
  )
  {
    $err = "Please enter all fields";
  }

  if(empty($err)){
    $sql = "INSERT INTO requests (user_id, blood_grp, state, city, district, address, pincode) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sssssss", $param_user_id, $param_blood_grp, $param_state, $param_city, $param_district, $param_address, $param_pincode);
        
        // Set these parameters
        $param_user_id = $_SESSION["id"];
        $param_blood_grp = $_POST["blood_grp"];
        $param_state = $_POST["state"];

        $param_city = $_POST["city"];
        $param_district = $_POST["district"];
        $param_address = $_POST["address"];
        $param_pincode = $_POST["pincode"];

        

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: index.php");
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
  <link rel="stylesheet" href="css/donate.css">
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
  
  <?php if(isset($_SESSION['loggedin'])): ?>
    <div class="container">
      <div class="title">Submit Donation Request</div>
      <div class="content">
        <form action= "" method= "post">
          <div class="user-details">
            <div class="input-box">
              <span class="details">State</span>
              <input type="text" placeholder="Enter your State"
              id="state" name="state"  required>
            </div>
            <div class="input-box">
              <span class="details">Districts</span>
              <input type="text" placeholder="Enter Districts"
              id="district" name="district"  required>
            </div>
            <div class="input-box">
              <span class="details">City</span>
              <input type="text" placeholder="Enter City"
              id="city" name="city"  required>
            </div>
            <div class="input-box">
              <span class="details">Pincode</span>
              <input type="text" placeholder="Enter Area Pincode" 
              id="pincode" name="pincode" required>
            </div>

            <div class="input-box">
              <span class="details">Address</span>
              <input type="text" placeholder="Enter Address"
              id="address" name="address"  required>
            </div>

            

            <div class="input-box">
              <span class="details">Confirm Mobile Number</span>
              <input type="phone" placeholder="Confirm your mobile number"
              id="mobile" name="mobile"  required>
            </div>
          </div>
          <center>
          <div class="input-box">
                                <label>Blood Group</label>
                                <select name="blood_grp">
                                    <option value="A1+">A1+</option>
                                    <option value="A1-">A1-</option>
                                    <option value="A2+">A2+</option>
                                    <option value="A2-">A2-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="A1B+">A1B+</option>
                                    <option value="A1B-">A1B-</option>
                                    <option value="A2B+">A2B+</option>
                                    <option value="A2B-">A2B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                </select>
                            </div>
          </center>
          <div class="button">

            <input type="submit" value="Register">
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>


  <?php if(!isset($_SESSION['loggedin'])): ?>
    <div class="container">
      <center>
        log in to view content
        <br>
        
        <button style = "border-radius: 12px; background-color: #04AA6D;
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;" type="button" onclick="myFunction()">  login  </button>
        <script>
        function myFunction() {
              window.location.href="login.php";  
     }
   </script>
        
      </center>
    </div>
  <?php endif; ?>
</body>

</html>
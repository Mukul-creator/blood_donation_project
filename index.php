<?php

session_start();


require_once "config.php";

$name = $email = $phone = $message  = "";

$err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  if
  (
    empty(trim($_POST['name'])) || empty(trim($_POST['email'])) || empty(trim($_POST['phone']))
    || empty(trim($_POST['message']))
  )
  {
    $err = "Please enter all fields";
  }

  if(empty($err)){
    $sql = "INSERT INTO query (name, email, phone, message) VALUES (?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_phone, $param_message);
        
        // Set these parameters
        $param_name = $_POST["name"];
        $param_email = $_POST["email"];
        $param_phone = $_POST["phone"];
        $param_message = $_POST["message"];

        

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

  <section class="backs">
    <div class="center">
      
      <button class="homebutton" onclick="myFunction()">DOANTE TODAY</button>
      <script>
          function myFunction() {
                window.location.href="login.php";  
                }
      </script>



      
  </div>
</section>


  <section>
<br><br>
<div class="container-f" style="Width:75%;">
     <div style="text-align: center;"> 

       
            <h2>DONATION PROCESS</h2>
            <h4>The donation process from the time you arrive center until the time you leave</h4><br>


    </div> <!-- for text-center  -->

    <div class="row"> <!-- for row  -->

        <div class="column"> <!-- for column  -->

           

                

                    <img src="images/process_1.jpg" alt="service" />
                <article>

                                   <h2>1. Registration</h2>
                    <p>You need to complete a very simple registration form. Which contains all required contact
                        information to enter in the donation process.</p>
                
</article>

        </div> <!--  end .col-lg-3 -->



        <div class="column">

         

                
                    <img src="images/process_2.jpg" alt="process" />
                
                <article >
                    <h2>2. Screening</h2>
                    <p>A drop of blood from your finger will take for simple test to ensure that your blood iron
                        levels are proper enough for donation process.</p>
                </article>

           

        </div> <!--  end .col-lg-3 -->


        <div class="column">

          

                
                    <img src="images/process_3.jpg" alt="process" />
                    
            

                <article style="left: 20px;">
                    <h2>3. Donation</h2>
                    <p>After ensuring and passed screening test successfully you will be directed to a donor bed
                        for donation. It will take only 6-10 minutes.</p>
                </article>

           
          </div>

  </section> <!--  end .section-process --><br><br>
  


          <div class="container-f" style="width:80%">

              <div style="text-align: center;">                
              
                      <h2>LATEST NEWS</h2>
                      <span></span>
                      <h4>Latest news and statements regarding giving blood processing</h4>
                      <br>
              
                        </div>


              <div class="row">

                  <div class="column">


                          <a href="#">
                          
                                  <img src="images/blog_thumb_1.jpg" alt="latest news">
                            
                          </a>

                          <div>

                              <h3>
                                  <a style="color: black;" href="https://www.google.com/search?q=Blood Connects Us All in a Soul">Blood Connects Us All in a Soul</a>
                              </h3>

                              
                                  <i>July 8, 2021</i>
                              
                              </div>

                  <div>    
                                  In many countries, demand exceeds supply, and blood services face the challenge of
                                  making blood available for patient.
                            


                      </div><!--   -->

                  </div> <!--  end column  -->

                  <div class="column ">


                          <a href="#">
                            
                                  <img src="images/blog_thumb_2.jpg" alt="latest news">
                            
                          </a>

                          <div>

                              <h3>
                                  <a style="color: black;" href="https://www.google.com/search?q=Give Blood and Save three Lives">Give Blood and Save three Lives</a>
                              </h3>

                              <div>
                                  <i>  July 8, 2021 </i>
                          
                              </div>

                              <div>
                                  To save a life, you don't need to use muscle. By donating just one unit of blood, you
                                  can save three lives or even several lives.
                              </div>


                      </div><!--  end .update-info  -->

                  </div> <!--  end column  -->

                  <div class="column">

                      

                          <a href="#">
                          
                                  <img src="images/blog_thumb_3.jpg" alt="latest news">
                            
                          </a>

                          <div >

                              <h3>
                                  <a style="color: black;" href="https://www.google.com/search?q=Why Should I donate Blood">Why Should I donate Blood ?</a>
                              </h3>

                              <div >
                                  <i>July 8, 2021</i>
                              </div>

                              <div>
                                  Blood is the most precious gift that anyone can give to another person.Donating blood
                                  not only saves the life also donors.
                              </div>


                  </div> <!--  end column  -->

              
              </div> <!-- end row  -->


      </section> <!--  end .section-latest-blog --><br><br>

      
  <section> 
  <div class="container-f" style="Width:100%;">
  <div class="row">
    <div class="column" style="position:absolute; left:350px;"> 
      <br>
      <br>
        <h2 style="font-size: 3rem;">Contact Us</h2>
  <br>
      
        <span ></span> Patliputra Industrial Area, Patna, Bihar, 800014 <br> India

                    <br>
                    <br>
          <span ></span>  +91 7033650263
          

          <br>
          <br>
          <span ></span> info@bloodb.com

                </div>
                <div class="column" style="position:absolute; right:200px;">
                  

                
    <form id="contact" action="" method="post">
      
      <h4>Contact us today, and get reply with in 24 hours!</h4>
      <fieldset>
        <input placeholder="Your name" type="text" id="name" name="name" required autofocus>
      </fieldset>
      <fieldset>
        <input placeholder="Your Email Address" type="email" id="email" name="email" required>
      </fieldset>
      <fieldset>
        <input placeholder="Your Phone Number" type="tel" id="phone" name="phone" required>
      </fieldset>
      <fieldset>
        <textarea placeholder="Type your Message Here...." id="message" name="message" required></textarea>
      </fieldset>
      <fieldset>
        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
      </fieldset>
    </form>
  
    

                
                </div>
  </div>
  </section>
</body>

</html>
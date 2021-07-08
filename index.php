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

  <section id="search" class="search-wrap">
    <h1>Find A Coding Gig</h1>
    <form action="gigs.html" class="search-form">
      <i class="fas fa-search"></i>
      <input type="search" name="term" placeholder="Javascript, PHP, Rails, etc...">
      <input type="submit" value="Search">
    </form>
  </section>
</body>

</html>
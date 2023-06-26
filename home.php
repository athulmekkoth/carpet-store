<?php

session_start();

if(isset($_POST['logout'])){
  session_destroy();
  header('location: ./home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./home.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Carpet</title>
  
</head>
<body>
  <nav class="navbar">
    <video autoplay muted loop class="background-video">
      <source src="./public/Brand Ad _ Carpet Court.mp4" type="video/mp4">
    </video>

    <div class="navbar-content">
      <div class="ns">
        <ul class="navbar-list">
          <li><a href="#">Home</a></li>
          <li><a href="./Aboutus.php">About</a></li>
          <li><a href="#sec">Products</a></li>
         
  <?php
  if (isset($_SESSION['user_name'])) {
    echo '
    <div class="dropdown">
    <li><a href="#">' . $_SESSION['user_name'] . '</a></li>
    <div class="dropdown-content" >
    <form method="POST">
    
    <button type="submit" name="logout" class="logout">Logout</button>
          <br>
          <div class="ff">
    <a class="cart-button" href="./cart.php">Cart</a>
    
    <a class="cart-button" href="./orders.php">Order</a>
    </div>
    </form>


    

                  </div>
                </div>';

               
  } else {
    echo '<li><a href="./register.php">Register</a></li>';
  }
  ?>

      </div>
    </div>
    <img class="navicon" src="navigation-bar.png" alt="navbar" width="10px"  height="10px"/>
    <div class="maintxt">
      <h1>HERE TO <span>FLOOR </span>YOU</h1>
    </div>
  </nav>
<!--next part-->


 <div class="est">
  <h1 class="letter">Get Your Free Estimate Now</h1>
  <p>Let our flooring experts help you transform your space from the floor up!</p>
  <a href="./Contactus.php" class="bt"> Get estimante now</a>
 </div> 

 <!--carpet section-->
 <div class="carpetsec" id="sec">
  <div>
  <p>Crepet Solution for your everyday need</p>
  <h1>HERE TO <span>WOW</span> YOU</h1>
</div>
<div class="cimg">  
  <div ><a href="./commonpage.php?category=trad">
   Traditional Crapet
  </a>

  </div>
  <div ><a href="./commonpage.php?category=modern">
    Modern
  </a>

  </div

</div>
 </div>

 <div class="est1">

  <h1 class="letter1">Quality Assured Every Purchase</h1>
  
 </div> 

 <!--last bsection-->

 <div>
  <div class="lastsec">
    <h1>HERE TO <span>HELP</span>YOU</h1>
    <p>Not sure where to start? That's what we're here for</p>
  </div>

  <div class="under">
    <div>
      <h1>Find floors and peace of mind</h1>
      <p>If you don't love your floors, we'll replace them for free with the Beautiful Guarantee®.</p>
    </div>
    <div>
      <img class="imgunder" src="./public/card-3-image.jpg" alt="poi" width="400" height="300"/>
    </div>
   
  </div>
</div>


<div class="est2">
  <div>
  <h1>Discuss your Project with us Today</h1>
  <p>Your local Carpt One floor and Home boast purchasing power!</p>

</div>
  <a href="./services.php" class="bt2"> Find a Store</a>
 </div> 
<!--footer-->

<script type="text/javascript" src="./home.js">

</script>

</body>
  


</html>
<?php
  // Include the footer file
  include './homefooter.php';
  ?>
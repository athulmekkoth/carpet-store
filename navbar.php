<?php
if(isset($_POST['logout'])){
  session_destroy();
  header('location: ./home.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./navbar.css"/>
    <title>Document</title>
    <style>



/* Navbar container */
body{
  margin: 0px;
  z-index: 20;
  font-family: Arial, Helvetica, sans-serif;

}
.navbar {
    background-color: #3FD2C7;
    padding: 10px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;

    color: white;
font-family: Verdana, Geneva, Tahoma, sans-serif;
font-size: 1.6rem;
    
  }
  .bgbt{
    background-color: aqua;
    padding: 5px;
    border: none;
    border-radius: 10%;
  }
  /* Navbar content */
  .navbar-content {

 width: 100%;
    display: flex;
  
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    margin: 0 200px;
 
  }
  .ns{
    display: flex;
    
  }

  .navbar-list {
   
    list-style: none;
    display: flex;
    gap: 10px;
  }
  
  .navbar-list li a {
    text-decoration: none;
    color: #333;
    padding: 5px;
  }
  
  /* Cart button */
  .cart-button {
    background-color: #333;
    background-color: #333;
    padding: 8px 12px;
    border-radius: 4px;
  }
  
  .cart-button a {
    color: #fff;
    text-decoration: none;
  }
  .dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 200px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  padding: 12px 16px;
  z-index: 1;
  margin-top: 10px; /* Add a top margin for the gap */
  gap: 10px;
}
.logout {
  text-decoration: none;
  background-color: black;
  color: wheat;
  padding: 10px;
  margin:10px 10px; 
  border: none;
  border-radius: 4px;
  cursor: pointer;
  text-decoration: none;
}


.dropdown:hover .dropdown-content {
  display: block;
}
.a{
  list-style: none;
  text-decoration: none;
}
 
  @media screen and (max-width: 768px) {
    .navbar {
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
    }
  
    .navbar-list {
      margin-top: 10px;
    }
  
    .navbar-list li {
      margin-bottom: 5px;
    }
  
    .cart-button {
      margin-top: 10px;
    }
  
  }
 
  

    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <div class="ns">
                <ul class="navbar-list">
                    <li><a href="./home.php">Home</a></li>
                    <li><a href="./Aboutus.php">About</a></li>
                    <li><div class="dropdown">
  <span style="color:black" >Products</span>
  <div class="dropdown-content">
<a class="logoutf" href="./commonpage.php?category=trad">Tradional carprt</a>
<br>
<a class="logoutf" href="./commonpage.php?category=modern">Modern carprt</a>
  </div>
</div></li>
<?php
  if (isset($_SESSION['user_name'])) {
    echo '
    <div class="dropdown">
    <li><a href="#">' . $_SESSION['user_name'] . '</a></li>
    <div class="dropdown-content" >
    <form method="post">
    <button type="submit" name="logout" class="logout">Logout</button>
</form>
<button type="submit" name="logout" class="logout"><a  class="a" href="./orders.php">Orders<a/></button>

          
                


                  </div>
                </div>';

               
  } ?>
              
                </ul>
               
            </div>
            <div>
            <?php
                // Check if the user is logged in
                if (isset($_SESSION['user_name'])) {
                    // User is logged in, display the cart button
                    echo '<div class="cart-button">
                              <a href="./cart.php">Cart</a>
                          </div>';
                }
            ?>
            </div>
        </div>
    </nav>
</body>
</html>

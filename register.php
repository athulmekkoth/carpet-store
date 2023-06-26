<?php
  include 'connection.php';
  if(isset($_POST['submit-btn']))
  {
     $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);
    
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    
    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);
    
    $filter_confirm_password = filter_var($_POST['confirm-password'], FILTER_SANITIZE_STRING);
    $confirm_password = mysqli_real_escape_string($conn, $filter_confirm_password);
    
 
    $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE email='$email'") or die("query failed");
    if(mysqli_num_rows($select_user) > 0)
    {
      $message[] = "User already exists";
    }
    else
    {
      if($password != $confirm_password)
      {
        $message[] = "Passwords do not match";
      }
      else
      {
        mysqli_query($conn, "INSERT INTO `user`(`name`, `email`, `password`) VALUES ('$name', '$email', '$password')") or die ("query failed");
        $message[] = 'Registered successfully';
       header('location: login.php');
        exit;
      }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="./register.css">
</head>
<body>
<?php 
if(isset($message))
{
  foreach($message as $msg)
  {
    echo '
    <div class="message">
      <span>'.$msg.'</span>
      <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
    </div>';
  }
}

?>

  <div class="registration-form">
    
    <form method="POST" action="">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your name">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password">
      </div>
      <div class="form-group">
        <button name="submit-btn" type="submit">Register</button>
      </div>
      <div  class="ch">
      <h1>Already have account ?</h1>
      <li><a class="login" href="../register/login.php">Login</a></li>

      </div>
      
    </form>
  </div>
</body>
</html>

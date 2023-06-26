<?php
  include 'connection.php';
  session_start();
  
  if(isset($_POST['submit-btn']))
  {
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    
    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);
    
    $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE email='$email'") or die("query failed");
    
    if(mysqli_num_rows($select_user) > 0)
    {
      $row = mysqli_fetch_assoc($select_user);
      $hashed_password = $row['password'];
  
      if($password == $hashed_password)
      {
        if($row['user_type'] == 'admin')
        {
          $_SESSION['admin_name'] = $row['name'];
          $_SESSION['admin_email'] = $row['email'];
          $_SESSION['admin_id'] = $row['id'];
          header('location:./adminpanel.php');
          exit;
        }
        else if($row['user_type'] == 'user')
        {
          $_SESSION['user_name'] = $row['name'];
          $_SESSION['user_email'] = $row['email'];
          $_SESSION['user_id'] = $row['id'];
          header('location:./home.php');
          exit;
        }
      }
      else {
        $message = 'Invalid password'; // Add error message
      }
    }
    else {
      $message = 'Invalid email or password'; // Add error message
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="./login.css">
  <style>
    .error-message {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-form">
      <h2>Login</h2>
      <?php if(isset($message)): ?>
        <div class="error-message"><?php echo $message; ?></div> <!-- Display error message if it exists -->
      <?php endif; ?>
      <form method="post" action="">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter your password">
        </div>
        <div class="form-group">
          <button type="submit" name="submit-btn">Log in</button>
        </div>
        <div class="register-link">
          Don't have an account? <a href="../register/register.php">Register</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>

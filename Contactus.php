<?php
session_start();

include './connection.php';
if (isset($_POST['submit'])) {
 


  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $number = $_POST['number'];

  
  $stmt = "INSERT INTO messsages (name, email, number, message) VALUES ('$name', '$email', '$number', '$message')";

  $insertint = mysqli_query($conn, $stmt);

  if (!$insertint) {
    die('Failed to insert message: ' . mysqli_error($conn));
  } else {
    echo '<div>Thank you for contacting us!</div>';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Contact Us</title>
  <link rel="stylesheet"  href="./contactus.css">
</head>
<body class="c-page">
  <h1>Contact Us</h1>
  <div class="ext">
  <form method="post">
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="number">Number:</label>
    <input type="text" id="number" name="number" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" rows="5" required></textarea>
    
    <button type="submit" name="submit" class="submit">Submit</button>
  </form>
  </div>
</body>

</html>

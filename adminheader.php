<?php




session_start();

  


if (isset($_POST['logout'])) {

    session_unset();

    session_destroy();
 
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./adminheader.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="admin-panel">
        <div class="admin">
            <a href="adminpanel.php" class="logo" src="../home/twitter.svg" ></a>
        <h1>Welcome to the Admin Panel</h1>
        <ul class="menu">
            <li><a href="adminpanel.php">Dashboard</a></li>
            <li><a href="adminproduct.php">Products</a></li>
            <li><a href="adminorder.php">Order</a></li>
            <li><a href="adminuser.php">User</a></li>
            <li><a href="adminmessage.php">Message</a></li>
        </ul>
        <div class="user">
            <p>Username: <span><?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : ""; ?></span></p>
            <p>Email: <span><?php echo isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : ""; ?></span></p>
            <form method="POST" action="">
                    <button class="logout" type="submit" name="logout">Logout</button>
                </form>
        </div>
    </div>
    <script type="text/javascript" src="./script.js"></script>
</body>
</html>

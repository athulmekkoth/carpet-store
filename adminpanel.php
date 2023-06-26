<?php
include './connection.php';
include './adminheader.php';

if(isset($_POST['logout'])){
    session_destroy();
    header('location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <link rel="stylesheet" href="./adminpanel.css"/>
</head>

<body>

    <div class="box-container">
        <div class="box">
            <?php
            $total = 0;
            $select = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status='pending'") or die(mysqli_error($conn));

            while ($fetch_pending = mysqli_fetch_assoc($select)) {
                $total += $fetch_pending['total_price'];
            }
            ?>

            <h3 style="color:black">$<?php echo $total; ?></h3>
            <p>TOTAL COMPLETE</p>
        </div>
        <div class="box">
            <?php
          
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die("query failed");
            $numoforders=mysqli_num_rows($select_orders)
            ?>

            <h3 style="color:black"><?php echo $numoforders; ?></h3>
            <p>orderplaced</p>
        </div>

        <div class="box">
            <?php
        
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die("query failed");
            $numofproducts=mysqli_num_rows($select_products)
            ?>

            <h3 style="color:black"><?php echo $numofproducts; ?></h3>
            <p>product added</p>
        </div>
   
        <div class="box">
            <?php
        
            $select_users = mysqli_query($conn, "SELECT * FROM `user`") or die("query failed");
            $numofuser=mysqli_num_rows($select_users)
            ?>

            <h3 style="color:black"><?php echo $numofuser; ?></h3>
            <p>Registred user</p>
        </div>
   
   

        <div class="box">
            <?php
        
            $select_message = mysqli_query($conn, "SELECT * FROM `messsages` ") or die("query failed");
            $numofmessage=mysqli_num_rows($select_message)
            ?>

            <h3 style="color:black"><?php echo $numofmessage; ?></h3>
            <p>messages</p>
        </div>

    </div>
</body>

</html>

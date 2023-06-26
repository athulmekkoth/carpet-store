<?php
session_start();
include '../register/connection.php';
include './navbar.php';

// Fetch the user ID from the session
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    // Handle user not logged in or redirect to login page
    header("Location: ../register/login.php");
    exit;
}

// Retrieve all orders for the current user
$query = "SELECT * FROM orders WHERE user_id = $userId";
$result = mysqli_query($conn, $query);
if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

// Check if there are any orders
if (mysqli_num_rows($result) > 0) {
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // Handle no orders scenario or display a message
    $message = 'You have no orders';
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="./orders.css"/>
</head>
<body>
    <h1 class="title">My Orders</h1>
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php else : ?>
        <div class="orders-container">
            <?php foreach ($orders as $order) : ?>
                <div class="order-item">
                    <h2>Order ID: <?php echo $order['id']; ?></h2>
                    <p>Name: <?php echo $order['name']; ?></p>
                    <p>Number: <?php echo $order['number']; ?></p>
                    <p>Email: <?php echo $order['email']; ?></p>
                    <p>Method: <?php echo $order['method']; ?></p>
                    <p>Address: <?php echo $order['address']; ?></p>
                    <p>Total Products: <?php echo $order['total_products']; ?></p>
                    <p>Placed On: <?php echo $order['placed_on']; ?></p>
                  
                    <p>Total Price: $<?php echo $order['total_price']; ?></p>
 <!-- Fetch individual products for the order -->
 <?php if (isset($order['products'])) : ?>
                        <p>Products:</p>
                        <ul>
                            <?php foreach ($order['products'] as $product) : ?>
                                <li><?php echo $product['name']; ?> - Price: $<?php echo $product['price']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
            
                    
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
   <?php
// Close the database connection
include './homefooter.php'
?>
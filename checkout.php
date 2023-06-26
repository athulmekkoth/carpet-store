<?php

include '../register/connection.php';
include './navbar.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {

    header("Location: ../register/login.php");
    exit;
}


$query = "SELECT * FROM cart WHERE user_id = $userId";
$result = mysqli_query($conn, $query);
if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}


if (mysqli_num_rows($result) > 0) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $totalPrice = 0;
 
    $productNames = [];
    foreach ($products as $product) {
        $totalPrice += $product['price'] * $product['quantity'];
        $productNames[] = $product['name'];
    }
    $totalProducts = implode(', ', $productNames);

    if (isset($_POST['checkout'])) {
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $method = $_POST['method'];
        $address = $_POST['address'];
     
        $placedOn = date('Y-m-d H:i:s');
        $paymentStatus = 'Pending';


        $insertQuery = "INSERT INTO orders (user_id, name, number, email, method, address, total_products, placed_on, payment_status, total_price)
                        VALUES ('$userId', '$name', '$number', '$email', '$method', '$address', '$totalProducts', '$placedOn', '$paymentStatus', '$totalPrice')";
        $insertResult = mysqli_query($conn, $insertQuery);
        if (!$insertResult) {
            die('Failed to place order: ' . mysqli_error($conn));
        }

        $deleteQuery = "DELETE FROM cart WHERE user_id = $userId";
        $deleteResult = mysqli_query($conn, $deleteQuery);
        if (!$deleteResult) {
            die('Failed to clear cart: ' . mysqli_error($conn));
        }

        header("Location: thankyou.php");
        exit;
    }
} else {
   
    $message = 'Your cart is empty';
}


mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title class="title">Checkout</title>
    <link rel="stylesheet" href="./checkout.css"/>
</head>
<body>
    <h1>Checkout</h1>
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php else : ?>
    
    <div class="checkout-form">
        <h2>Shipping Details</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" pattern="[A-Za-z\s]+" title="Please enter letters only" required>
            <label for="number">Phone Number:</label>
            <input type="text" id="number" name="number" pattern="[0-9]+" title="Please enter numbers only" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="method">Payment Method:</label>
            <select id="method" name="method" required>
                <option value="Credit Card">Credit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
            </select>
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
            <p>Total Price: $<?php echo $totalPrice; ?></p>
            <input type="submit" name="checkout" value="Checkout">
        </form>
    </div>
    <?php endif; ?>
</body>
</html>

<?php
// Close the database connection
include './homefooter.php'
?>
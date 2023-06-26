<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../register/connection.php';
include './navbar.php';

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
} else {
   
    $message = 'Your cart is empty';
    $products = []; 
}

// Update quantity
if (isset($_POST['updateQuantity'])) {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the cart
    $updateQuery = "UPDATE cart SET quantity = $quantity WHERE id = $cartId";
    $updateResult = mysqli_query($conn, $updateQuery);
    if (!$updateResult) {
        die('Failed to update quantity: ' . mysqli_error($conn));
    }

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
}

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM cart WHERE id = $deleteId";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    if (!$deleteResult) {
        die('Failed to delete item from cart: ' . mysqli_error($conn));
    }

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
}

// Calculate the total price
$totalPrice = 0;
foreach ($products as $product) {
    $totalPrice += $product['price'] * $product['quantity'];
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="./cart.css"/>
    <script>
        function validateQuantity(input) {
            var quantity = parseInt(input.value);
            if (quantity > 4) {
                alert("Maximum quantity allowed is 4.");
                input.value = 4;
            }
        }
    </script>
</head>
<body>
    <h1>Cart</h1>
    <?php if (isset($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php else : ?>
        <div class="cart-container">
            <?php foreach ($products as $product) : ?>
                <div class="cart-item">
                    <div>
                        <img class="bimg" src="../register/image/<?php echo $product['image']; ?>" />
                    </div>
                    <div class="item">
                        <h2><?php echo $product['name']; ?></h2>
                        <p>Price: $<?php echo $product['price']; ?></p>
                        <form method="post">
                            <input type="hidden" name="cartId" value="<?php echo $product['id']; ?>">
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" max="4" value="<?php echo $product['quantity']; ?>" onchange="validateQuantity(this);">
                            <input class="update" type="submit" name="updateQuantity" value="Update">

                            <a class="delete" href="cart.php?delete_id=<?php echo $product['id']; ?>">Delete</a>
                        </form>
                      
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="btclass">
            <div class="cart-total">
                <p>Total Price: $<?php echo $totalPrice; ?></p>
            </div>
            <div class="bt">
                <button class="checkout" onclick="location.href='checkout.php';">Checkout</button>
            </div>
        </div>
    <?php endif; ?>
</body>
<?php

include './footer.php'
?>
</html>

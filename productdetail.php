<?php
session_start();
include '../register/connection.php';
include './navbar.php';

$message = ''; // Initialize an empty message

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $query = "SELECT * FROM products WHERE id = $productId";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $product = mysqli_fetch_assoc($result);

    $userId = null;
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    }

    if ($userId) {
        $pid = $product['id'];
        $cartQuery = "SELECT * FROM cart WHERE pid = '$pid' AND user_id = '$userId'";
        $cartResult = mysqli_query($conn, $cartQuery);
        if ($cartResult && mysqli_num_rows($cartResult) > 0) {
            $message = 'Product is already in the cart!';
        } else {
            if (isset($_POST['addToCart'])) {
                $name = $product['name'];
                $quantity = $_POST['quantity']; // Retrieve the quantity from the form

                // Check if quantity exceeds the maximum limit of 4
                if ($quantity > 4) {
                    $message = 'Maximum quantity allowed per person is 4.';
                } else {
                    $price = $product['price'] * $quantity; // Calculate the updated price
                    $image = $product['image'];

                    // Insert the product into the cart
                    $insertQuery = "INSERT INTO cart (user_id, pid, name, quantity, price, image) VALUES ('$userId', '$productId', '$name', '$quantity', '$price', '$image')";
                    $insertResult = mysqli_query($conn, $insertQuery);
                    if (!$insertResult) {
                        die('Failed to add to cart: ' . mysqli_error($conn));
                    }

                    $message = 'Product added to cart successfully!';
                }
            }
        }
    }
} else {
    // Handle invalid request or redirect to the product details page
    header("Location: productdetail.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="./productdetail.css"/>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <div class="product-details">
        <h1><?php echo $product['name']; ?></h1>
        <img src="../register/image/<?php echo $product['image']; ?>" />
        
        <p class="text-cat" >Price: $<?php echo $product['price']; ?></p>
        <p class="text-cat"  >Category: <?php echo $product['category']; ?></p>
        <p class="text-cat" ><?php echo $product['product_detail']; ?></p>
        <?php if ($userId) : ?>
            <?php if (!empty($message)) : ?>
                <p class="mesg"><?php echo $message; ?></p>
            <?php else : ?>
                <form method="post">
                    <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="5">
                    <input type="submit" name="addToCart" value="Add to Cart" onclick="if (document.getElementById('quantity').value == 4) { showAlert('Maximum quantity allowed per person is 4.'); return false; }">
                </form>
            <?php endif; ?>
        <?php else : ?>
            <div class="bt">
            <p class="mesg">You need to be logged in to add products to the cart.</p>
            <a class="login" href="./login.php">Login</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Close the database connection
include './homefooter.php'
?>

<?php
// Close the database connection
mysqli_close($conn);
?>

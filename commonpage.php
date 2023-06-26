<?php
session_start();
include '../register/connection.php';
include './navbar.php';
$category = $_GET['category'];

if ($category == 'trad') {
    $query = "SELECT * FROM products WHERE category = 'traditional'";
} elseif ($category == 'modern') {
    $query = "SELECT * FROM products WHERE category = 'modern'";
} else {
  
    echo '<div><h1>Invalid category</h1></div>';
    exit;
}

$result = mysqli_query($conn, $query);
if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <Link rel="stylesheet" href="./commonpage.css"/>

</head>
<body>
<div class="cont">
<div class="wrapper">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
  <div class="card">
    <div class="product-img">
      <img class="card-image" src="../register/image/<?php echo $row['image']; ?>" alt="Product Image">
    </div>
    <div class="card-content">
      <h2 class="card-title"><?php echo $row['name']; ?></h2>
      <h3 class="card-category"><?php echo $row['category']; ?></h3>
      <p class="card-detail"><?php echo $row['product_detail']; ?></p>
      <div class="card-price-btn">
        <p><span><?php echo $row['price']; ?></span>$</p>
        <a class="add-to-cart" href="productdetail.php?id=<?php echo $row['id']; ?>">Buy Now</a>
      </div>
    </div>
  </div>
<?php } ?>


    </div>
    <footer>
    <?php

include './homefooter.php'
?>
    </footer>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>

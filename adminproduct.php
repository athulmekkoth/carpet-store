<?php
include 'connection.php';
include './adminheader.php';



$message = array();

if(isset($_POST['addproduct'])){
    $product_name = $_POST['productname'];
    $product_desc = $_POST['productdesc'];
    $product_price = $_POST['productprice'];
    $product_category = $_POST['productcategory'];
    $image = $_FILES['productimage']['name'];
    $image_size = $_FILES['productimage']['size'];
    $image_tmp_name = $_FILES['productimage']['tmp_name'];
    $image_folder = 'image/'.$image;

    $selectpname = mysqli_query($conn, "SELECT name FROM products WHERE name='$product_name'");
    if(mysqli_num_rows($selectpname) > 0) {
        $message[] = "Product already exists.";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO products (name, price, product_detail, category, image)
        VALUES ('$product_name', '$product_price', '$product_desc', '$product_category', '$image')");
        if($insert) {
            if($image_size > 2000000) {
                $message[] = 'Image size is too large.';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = "Product added successfully.";
            }
        }
    }
}

if(isset($_GET['delete'])){
    $product_id = $_GET['delete'];
    $select_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id='$product_id'") or die("query failed");
    $fetch_delete_image = mysqli_fetch_assoc($select_image);
    $image_path = 'image/' . $fetch_delete_image['image'];

    $delete = mysqli_query($conn, "DELETE FROM `products` WHERE id='$product_id'") or die("query failed");

    if($delete) {
        unlink($image_path);
        header('location:adminproduct.php');
    }
}

if(isset($_POST['update_product']))
{
    $update_id=$_POST['update_id'];
    $update_name=$_POST['update_name'];
    $update_price=$_POST['update_price'];
    $update_detail = $_POST['update_detail'];
    $update_category = $_POST['update_category'];
    $update_image=$_FILES['update_image']['name'];
    $update_image_tmp_name=$_FILES['update_image']['tmp_name'];
    $update_image_folder='image/'.$update_image;

    $update_query = mysqli_query($conn, "UPDATE `products` SET `name`='$update_name', `price`='$update_price', `product_detail`='$update_detail', `category`='$update_category', `image`='$update_image' WHERE id='$update_id'") or die('query failed');

    if($update_query)
    {
        move_uploaded_file($update_image_tmp_name,$update_image_folder);
        header('location:adminproduct.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./adminproduct.css"/>
</head>
<body>

    <form method="POST" enctype="multipart/form-data">
        <?php
        // Display the messages
        if(!empty($message)) {
            foreach($message as $msg) {
                echo "<p>$msg</p>";
            }
        }
        ?>
        <div>
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="productname">

            <label for="product-desc">Product Description:</label>
            <textarea id="product-desc" name="productdesc"></textarea>

            <label for="product-price">Product Price:</label>
            <input type="text" id="product-price" name="productprice">

            <label for="product-category">Product Category:</label>
            <input type="text" id="product-category" name="productcategory">

            <label for="product-image">Product Image:</label>
            <input type="file" id="product-image" name="productimage">

            <input name="addproduct" id="upload" type="submit" value="Upload">
        </div>
    </form>
    </div>
    <section class="section">
        <div class="row">
            <?php
            $selectproduct = mysqli_query($conn, "SELECT * FROM `products`");
            if (mysqli_num_rows($selectproduct) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($selectproduct)) {
            ?>
                    <div class="box">
                        <img src="image/<?php echo $fetch_product['image']; ?> " />
                        <h4>NAME:<?php echo $fetch_product['name']; ?></h4>
                        <p>price: $<?php echo $fetch_product['price']; ?> </p>
                       
                        <h4>Category<?php echo $fetch_product['category']; ?></h4>
                        <details><?php echo $fetch_product['product_detail'] ?></details>
                        <a href="adminproduct.php?edit=<?php echo $fetch_product['id']; ?>" class="edit">edit</a>
                        <a href="adminproduct.php?delete=<?php echo $fetch_product['id']; ?>" class="delete" onclick="return confirm('Do you want to delete?');">delete</a>
                    </div>

            <?php
                }
            } else {
                echo '<div>
                        <p>No products added</p>
                      </div>';
            }
            ?>
        </div>
    </section>

    <div class="update">
    <?php
    if(isset($_GET['edit'])){
        $edit_id = $_GET['edit'];
        $edit = mysqli_query($conn, "SELECT * FROM `products` WHERE id='$edit_id'") or die("query failed");

        if(mysqli_num_rows($edit) > 0) {
            while($fetch_edit = mysqli_fetch_assoc($edit)){
    ?>
    <h1>Update your product</h1>
    <form method="POST" enctype="multipart/form-data" class="update">
        <img class="img" src="image/<?php echo $fetch_edit['image']; ?>">
        <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
        <label for="update_name">Name</label>
        <input type="text" name="update_name" id="update_name" value="<?php echo $fetch_edit['name']; ?>">
        <label for="update_price">Price</label>
        <input type="number" name="update_price" id="update_price" min="0" value="<?php echo $fetch_edit['price']; ?>">
        <label for="update_detail">Detail</label>
        <textarea name="update_detail" id="update_detail"><?php echo $fetch_edit['product_detail']; ?></textarea>
        <label for="update_category">Category:</label>
        <input type="text" name="update_category" id="update_category" value="<?php echo $fetch_edit['category']; ?>">
        <label for="update_image">Image</label>
        <input type="file" name="update_image" id="update_image">
        <input type="submit" name="update_product" value="Update">
    </form>
    <?php
                }
            }
        }
    ?>
    </div>

  
</body>
</html>

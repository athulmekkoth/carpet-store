

<?php
include 'connection.php';
include './adminheader.php';


$message = array();

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $delete = mysqli_query($conn, "DELETE FROM `orders` WHERE id='$delete_id'") or die("query failed");
    $message[] = "Order deleted";
    header('location:adminorder.php');
}

if(isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    
    $update = mysqli_query($conn, "UPDATE `orders` SET `payment_status`='$update_payment' WHERE id='$order_id'") or die("query failed");
    $message[] = "Payment status updated";


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./adminorder.css" />
</head>

<body>

    <form method="POST" enctype="multipart/form-data">
        <div class="message-container">
            <?php
            // Display the messages
            if (!empty($message)) {
                foreach ($message as $msg) {
                    echo "<p class='message'>$msg</p>";
                }
            }
            ?>
        </div>
        <section>
            <h1>Orders</h1>
            <div class="container">
                <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                if (mysqli_num_rows($select_orders) > 0) {
                    while ($fetch_order = mysqli_fetch_assoc($select_orders)) {
                ?>
                        <div class="box">

                            <p>user name: <span><?php echo $fetch_order['name']; ?></span></p>

                            <p>user id: <span><?php echo $fetch_order['user_id']; ?></span></p>
                            <p>placed on: <span><?php echo $fetch_order['placed_on']; ?></span></p>

                            <p>number: <span><?php echo $fetch_order['number']; ?></span></p>
                            <p>email: <span><?php echo $fetch_order['email']; ?></span></p>

                            <p>total price : <span><?php echo $fetch_order['total_price']; ?></span></p>
                            <p>method: <span><?php echo $fetch_order['method']; ?></span></p>

                            <p>address: <span><?php echo $fetch_order['address']; ?></span></p>
                            <p>total product : <span><?php echo $fetch_order['total_products']; ?></span></p>

                            <form method="post">
                                <input type="hidden" name="order_id" value="<?php echo $fetch_order['id']; ?>" />
                                <select name="update_payment">
                                    <option disabled selected><?php echo $fetch_order['payment_status']; ?></option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                                <input type="submit" name="update_order" value="update_payment" class="btn" />
                                <a class="delete" href="adminorder.php?delete=<?php echo $fetch_order['id']; ?>" onclick="return confirm('Delete this order?');">delete</a>
                            </form>
                        </div>
                <?php
                    }
                } else {
                    echo '<div>
                    <p>No Orders available</p>
                </div>';
                }
                ?>
            </div>
        </section>
    </form>
</body>

</html>

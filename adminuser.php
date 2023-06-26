<?php
include 'connection.php';

$message = array();
include 'connection.php';
include './adminheader.php';
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
  
    $delete = mysqli_query($conn, "DELETE FROM `user` WHERE id='$delete_id'") or die("query failed");
    $message[] = "User deleted";
    header('location:adminuser.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./adminuser.css"/>
</head>
<body>
  
    <form method="POST" enctype="multipart/form-data">
    <?php
       
        if(!empty($message)) {
            foreach($message as $msg) {
                echo "<p>$msg</p>";
            }
        }
    ?>
    <div></div>
    <section>
        <h1>Unread Messages</h1>
        <div class="container">
            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `user`") or die('query failed');
            if(mysqli_num_rows($select_users) > 0) {
                while($fetch_user = mysqli_fetch_assoc($select_users)) {
                    ?>
                    <div class="box">
                    <p>user id: <span><?php echo $fetch_user['id']; ?></span></p>
  <p>name: <span><?php echo $fetch_user['name']; ?></span></p>
  <p>email: <span><?php echo $fetch_user['email']; ?></span></p>
  <p>
    usertype:
    <span style="color: <?php echo $fetch_user['user_type'] === 'admin' ? 'orange' : 'blue'; ?>">
      <?php echo $fetch_user['user_type']; ?>
    </span>
  </p>

                        <a href="adminuser.php?delete=<?php echo $fetch_user['id']; ?>" class="delete" onclick="return confirm('Delete this user?');">Delete</a>
                    </div>
                    <?php
                }
            } else {
                echo '<div>
                    <p>No Messages available</p>
                </div>';
            }
            ?>
        </div>
    </section>
</body>
</html>

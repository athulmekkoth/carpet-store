<?php
include 'connection.php';
include './adminheader.php';


$message = array();

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

  
    $delete = mysqli_query($conn, "DELETE FROM `messsages` WHERE id='$delete_id'") or die("query failed");

        header('location:adminmessage.php');
    
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./adminmessage.css"/>
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
                $select_message = mysqli_query($conn, "SELECT * FROM `messsages`") or die('query failed');
                if(mysqli_num_rows($select_message) > 0) {
                    while($fetch_message = mysqli_fetch_assoc($select_message)) {
                ?>
                <div class="box">
                    <p>User ID: <span><?php echo $fetch_message['id']; ?></span></p>
                    <p>Name: <span><?php echo $fetch_message['name']; ?></span></p>
                    <p>Email: <span><?php echo $fetch_message['email']; ?></span></p>
                    <p>Message: <span><?php echo $fetch_message['message']; ?></span></p>
                    <a class="delete" href="adminmessage.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Do you want to delete?')">Delete</a>
                </div>
                <?php
                    }
                } else {
                    echo '<div class="no-messages">
                            <p>No Messages available</p>
                          </div>';
                }
                ?>
            </div>
        </section>
    </form>
   
</body>
</html>

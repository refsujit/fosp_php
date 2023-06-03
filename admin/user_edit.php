<?php

session_start();
$userID = $_GET['id'];
require_once('./../config/database.php');
require_once('./../helpers/helper.php');
validateAuthPage();
$sql = "select * from users where id = '$userID'";
$result = $conn->query($sql);

if($result->num_rows==1){
    $row = $result->fetch_object();
    $name = $row->name;
    $email = $row->email;
    $id = $row->id;

    if($email == 'refsujit@gmail.com'){
        redirectWithMessage('dashboard.php','error','You can not update this user');
    }
}else{
    redirectWithMessage('dashboard.php','error','User not found');
//    $_SESSION['message']['error'] = "User not found";
}

require_once('user_edit_handle.php');

?>





    <!DOCTYPE html>
    <html>

<?php
require_once('./../_partials/head.php');

?>

<body>

<?php
require_once('./../_partials/navbar.php');
?>

<h2 style="text-align: center">Update Your Name</h2>

<form action="user_edit.php?id=<?php echo $userID; ?>" method="post">
    <div class="imgcontainer">
        <img src="./../img/logo.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">

        <?php if (isset($message['error'])) {  ?>
            <p style="color:red"><?php echo $message['error'] ?></p>

        <?php } ?>


        <?php if (isset($message['success'])) {  ?>
            <p style="color:green"><?php echo $message['success'] ?></p>

        <?php } ?>


        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" value="<?php echo $name; ?>">

        <label for="email"><b>Email</b></label>
        <input disabled type="email" placeholder="Enter Email" name="email" value="<?php echo $email; ?>">
        <i>[Email can not update]</i>

        <button type="submit" name="submit">Update</button>

    </div>



</form>

</body>

    </html><?php

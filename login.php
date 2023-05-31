<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "fosp_php";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_errno == 0) {
} else {
    die("error on connection ");
}


if (isset($_POST['submit'])) {
    session_start();

    // Get values from users
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Check email and password existence
    $sql = "select * from users";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        $message['error'] = "Invalid Credentials";
    } else {
        $row = $result->fetch_assoc();

        $_SESSION['auth']['name'] = $name =  $row['name'];
        $_SESSION['auth']['email'] = $email =  $row['email'];
        
        header('location:dashboard.php');
    }

    // die;
}





?>





<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <style>
    </style>
</head>

<body>

    <h2>Login Panel</h2>

    <form action="login.php" method="post">
        <div class="imgcontainer">
            <img src="img/logo.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">

            <?php if (isset($message['error'])) {  ?>
                <p style="color:red"><?php echo $message['error'] ?></p>

            <?php } ?>


            <?php if (isset($message['success'])) {  ?>
                <p style="color:green"><?php echo $message['success'] ?></p>

            <?php } ?>

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email">

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter password" name="password">

            <button type="submit" name="submit">Login</button>
            <!-- <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label> -->
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn"><a href="forgot-password.php">Forgot Password</a></button>
            <span class="psw"> <a href="index.php">Not registered yet?</a></span>
        </div>
    </form>

</body>

</html>
<?php
require_once('./../helpers/helper.php');
require_once('./../config/database.php');

session_start();
validateRegistrationLoginPage();


if (isset($_POST['submit'])) {

    // Get values from users
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Check email and password existence
    $sql = "select * from users where email = '$email' and password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        setFlashMessage('error','Invalid Credentials');
    } else {
        $row = $result->fetch_assoc();

        $_SESSION['auth']['name'] = $name = $row['name'];
        $_SESSION['auth']['email'] = $email = $row['email'];
        redirectTo('./../admin/dashboard.php');
    }
}


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

<h2 style="text-align: center">Login Panel</h2>

<form action="login.php" method="post">
    <div class="imgcontainer">
        <img src="./../img/logo.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">

        <?php
        require_once('./../helpers/flash.php');
        ?>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email">

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter password" name="password">

        <button type="submit" name="submit">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <span class="psw"> <a href="./register.php">Not registered yet?</a></span>
    </div>
</form>

</body>

</html>
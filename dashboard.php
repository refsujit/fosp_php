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
  $_SESSION['name'] = $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  // Password Confirmation
  if ($password == $cpassword) {
    // Check email existence
    $sql = "select * from users where email = '$email'";
    $result = $conn->query($sql);
    // print_r($result);

    if ($result->num_rows > 0) {
      $message['error'] = "Email already exist";
    } else {
      // Registration 
      $sql = "insert into users(name, email, password) values ('$name','$email','$password')";
      $result = $conn->query($sql);
      if ($result) {
        $message['success'] = "User registered successfully";
      } else {
        $message['error'] = "Unable to insert";
      }
    }
  } else {
    $message['error'] = "Password do not matched";
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

  <ul>
    <li><a href="#home">Home</a></li>
    <li><a href="#news">News</a></li>
    <li><a href="#contact">Contact</a></li>
    <li style="float:right"><a class="active" href="#about">About</a></li>
  </ul>
  
  <h2>Registration Form</h2>

  <form action="index.php" method="post">
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


      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="name">

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email">

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter password" name="password">

      <label for="cpassword"><b>Confirm Password</b></label>
      <input type="password" placeholder="Confirm password" name="cpassword">

      <button type="submit" name="submit">Sign Up</button>
      <!-- <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label> -->
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" class="cancelbtn">Cancel</button>
      <span class="psw">Already Registered <a href="login.php">Login Now?</a></span>
    </div>

  </form>

</body>

</html>
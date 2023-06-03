<?php
require_once('./../config/database.php');
require_once('./../helpers/helper.php');

session_start();
validateRegistrationLoginPage();



if (isset($_POST['submit'])) {


// Get values from users
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $dateTime =date('Y-m-d H:i:s');

    if (isset($name) && isset($email) && isset($password) && isset($cpassword) && !empty($name) && !empty($email) && !empty($password) && !empty($cpassword)) {


        // Password Confirmation
        if ($password == $cpassword) {
            // Check email existence
            $sql = "select * from users where email = '$email'";
            $result = $conn->query($sql);
            // print_r($result);

            if ($result->num_rows > 0) {
                setFlashMessage('error', 'Email already exist');
            } else {

                $upload_path = NULL;

                //Working with files
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {

                    // The target directory of uploading is uploads
                    $upload_dir = "./../uploads/";
                    $fileName = rand(1, 100000) . '_' . basename($_FILES["image"]["name"]);
                    $upload_path = $upload_dir . $fileName;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    } else {
                        redirectWithMessage("./register.php", 'error', 'Problem with selected photo');
                    }
                }


                // Registration
                if(is_null($upload_path)){
                      $sql = "insert into users(name, email, password,reg_date, image) values ('$name','$email','$password','$dateTime', null);";
                }else{
                     $sql = "insert into users(name, email, password, reg_date,image) values ('$name','$email','$password','$dateTime' ,'$fileName')";
                }
                $result = $conn->query($sql);
                if ($result) {
                    setFlashMessage('success', 'User registered successfully');
                } else {
                    setFlashMessage('success', 'Unable to insert');
                }
            }
        } else {
            setFlashMessage('error', 'Password do not matched');
        }


    } else {
        setFlashMessage('error', 'Fields with * are required');
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

<h2 style="text-align: center">Register Your Details</h2>

<form action="./register.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
        <img src="./../img/logo.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">

        <?php
        require_once('./../helpers/flash.php');
        ?>


        <label for="name"><b>Name*</b></label>
        <input type="text" placeholder="Enter Name" name="name">

        <label for="email"><b>Email*</b></label>
        <input type="email" placeholder="Enter Email" name="email">

        <label for="password"><b>Password*</b></label>
        <input type="password" placeholder="Enter password" name="password">

        <label for="cpassword"><b>Confirm Password*</b></label>
        <input type="password" placeholder="Confirm password" name="cpassword">

        <label for="avatar"><b>Avatar</b></label>
        <input type="file"  name="image" id="avatar">

        <button type="submit" name="submit">Sign Up</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">

        <span class="psw">Already Registered <a href="login.php">Login Now?</a></span>
    </div>

</form>

</body>

</html>
<?php

session_start();

require_once('./../config/database.php');
require_once('./../helpers/helper.php');
validateAuthPage();

$userID = $_GET['id'];
$authEmail = $_SESSION['auth']['email'];

if ($authEmail == 'refsujit@gmail.com') {
    $sql = "select email,id from users where email = 'refsujit@gmail.com' and id = '$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        setFlashMessage('error', 'Can not delete yourself');

    } else {
        $sql = "delete from users where id = $userID";

        $result = $conn->query($sql);
        if ($result) {
            setFlashMessage('success', 'User deleted successfully');
        } else {
            setFlashMessage('error', 'Unable to delete the user');
        }
    }
} else {
    setFlashMessage('error', "You do not have permission to delete the users. Contact Admin!");
}


header("location:dashboard.php");

?>
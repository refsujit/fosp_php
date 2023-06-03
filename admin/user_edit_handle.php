<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location: ./../index.php' ) );
}
require_once('./../config/database.php');
require_once('./../helpers/helper.php');
validateAuthPage();

require_once('./../helpers/helper.php');

if (isset($_POST['submit'])) {


    // Get values from users
    $name = $_POST['name'];




    // Registration
    $sql = "update users set name='$name' where id='$userID'";
    // die;
    $result = $conn->query($sql);
    if ($result) {
        setFlashMessage('success', 'User updated successfully');
        redirectTo('dashboard.php');
    } else {
        setFlashMessage('error', 'Unable to update');
    }
}

// die;


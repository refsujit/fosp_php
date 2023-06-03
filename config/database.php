<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location: ./../index.php' ) );
}



$host = "localhost";
$username = "root";
$password = "";
$database = "fosp_php";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_errno == 0) {
} else {
  die("error on connection ");
}

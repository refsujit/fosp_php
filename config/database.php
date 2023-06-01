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


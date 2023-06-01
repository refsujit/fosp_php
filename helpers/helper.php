<?php



function isLoggedIn(){
    if (isset($_SESSION['auth']['email'])) {
        // users authenticated
        return true;
      } else {
        return false;
      }
}

function validateAuthPage(){
    if (isset($_SESSION['auth']['email'])) {
        // users authenticated
      } else {
        header('location:login.php');
      }
}

function validateRegistrationLoginPage(){
    if (isset($_SESSION['auth']['email'])) {
        // users authenticated
        header('location:dashboard.php');
    } 
}

<?php
session_start();
unset($_SESSION['auth']['email']);
session_destroy();

header('location:./../auth/login.php');

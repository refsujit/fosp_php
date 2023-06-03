<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location: ./../index.php' ) );
}

if (isset($_SESSION['message']['error'])) { ?>
    <p style="color:red;font-weight: bold;"><?php echo $_SESSION['message']['error'] ?></p>
  <?php } unset($_SESSION['message']['error']); ?>


  <?php if (isset($_SESSION['message']['success'])) { ?>
    <p style="color:green;font-weight: bold;"><?php echo $_SESSION['message']['success'] ?></p>
  <?php }  unset($_SESSION['message']['success']); ?>
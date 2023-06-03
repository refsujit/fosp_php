<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location: ./../index.php' ) );
}

require_once('protect_direct_access.php');

?>

<ul>
    <li><img src="<?php echo baseURL().'/img/logo.png'; ?>" style="height: 40px; width: 80px;"> </li>
        <li><a href="<?php echo baseURL(''); ?>">Home</a></li>

        <?php if (isLoggedIn()) { ?>
            <li style="float:right"><a class="" href="<?php echo baseURL().'/auth/logout.php'; ?>">Logout</a></li>
            <li style="float:right"><a class="" href="<?php echo baseURL().'/admin/dashboard.php'; ?>">Dashboard</a></li>
        <?php } else { ?>
            <li style="float:right"><a class="" href="<?php echo baseURL().'/auth/login.php'; ?>">Login</a></li>
            <li style="float:right"><a class="" href="<?php echo baseURL().'/auth/register.php'; ?>">Register</a></li>
        <?php } ?>
    </ul>
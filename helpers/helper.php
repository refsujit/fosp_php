<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location: ./../index.php' ) );
}

function requirePathFromRoot($path)
{
    return dirname(__DIR__) . $path;
}


function pathFromCurrent($path)
{
    return dirname(__FILE__) . $path;
}


function url()
{
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}


function baseURL()
{

// first get http protocol if http or https

    $base_url = (isset($_SERVER['HTTPS']) &&

        $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';

// get default website root directory

     $tmpURL = dirname(__DIR__);

// when use dirname(__FILE__) will return value like this "C:\xampp\htdocs\my_website",

//convert value to http url use string replace,

// replace any backslashes to slash in this case use chr value "92"

     $tmpURL = str_replace(chr(92), '/', $tmpURL);

// now replace any same string in $tmpURL value to null or ''

// and will return value like /localhost/my_website/ or just /my_website/

     $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'], '', $tmpURL);

// delete any slash character in first and last of value

    $tmpURL = ltrim($tmpURL, '/');

    $tmpURL = rtrim($tmpURL, '/');


// check again if we find any slash string in value then we can assume its local machine

    if (strpos($tmpURL, '/')) {

// explode that value and take only first value

        $tmpURL = explode('/', $tmpURL);

        $tmpURL = $tmpURL[0];

    }

// now last steps

// assign protocol in first value

    if ($tmpURL !== $_SERVER['HTTP_HOST'])

// if protocol its http then like this

        $base_url .= $_SERVER['HTTP_HOST'] . '/' . $tmpURL;

    else

// else if protocol is https

        $base_url .= $tmpURL;

// give return value

    return $base_url;

}

function redirectTo($pathToFile)
{

    header("location:" . $pathToFile);
}


function isLoggedIn()
{
    if (isset($_SESSION['auth']['email'])) {
        // users authenticated
        return true;
    } else {
        return false;
    }
}

function validateAuthPage()
{
    if (isset($_SESSION['auth']['email'])) {
        // users authenticated
    } else {
        redirectTo(baseURL().'/auth/login.php');
    }
}

function validateRegistrationLoginPage()
{
//    return baseURL();
//    if (isset($_SESSION['auth']['email'])) {
//        // users authenticated
//        header('location:dashboard.php');
//    }
    if (isset($_SESSION['auth']['email'])) {
        die;
        // users authenticated
        header('location:./../admin/dashboard.php');
    } else {

    }
}


//


function redirectWithMessage($fullPath, $messageType, $message)
{
    switch ($messageType) {
        case 'error':
            $_SESSION['message']['error'] = $message;
            break;
        case 'success':
            $_SESSION['message']['success'] = $message;
            break;
    }
    header("location:" . $fullPath);
}

function setFlashMessage($messageType, $message)
{
    switch ($messageType) {
        case 'error':
            $_SESSION['message']['error'] = $message;
            break;
        case 'success':
            $_SESSION['message']['success'] = $message;
            break;
    }
}

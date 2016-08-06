<?php
// script for logging user out, saving his progress, destroying session, displaying logout message

    include_once 'user_class.php';
    include_once 'session_check.php';
    
    if (isset($_SESSION['user'])) {
        $_SESSION['user']->saveCurrentState(); // save progress of the user
    }

    //destroy the session:
    $_SESSION = array(); // Destroy all session variables
    /* If the session information is stored in cookies,
    delete the session cookie as well: */
    if (ini_get('session.use_cookies')) {
        $cookie_parameters = session_get_cookie_params();
        setcookie(session_name(), '', time() - 2592000,
                $cookie_parameters['path'],
                $cookie_parameters['domain'],
                $cookie_parameters['secure'],
                $cookie_parameters['httponly']);
    }
    session_destroy(); // Destroy the session data

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Goodbye</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
                <p>You have successfully logged out. See you back soon!</p>
                <p>Want to log back in? Click <a href="../index.php">here</a>.</p>
            </div>
        </div>
    </body>
</html>

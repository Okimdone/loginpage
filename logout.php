<?php 
    // Smarty template s declaration
    require_once("php/smarty_config.php");    

    // If client has a cookie (already logged in) destroy it and redirect to the login page
    if (isset($_COOKIE['login_cookie']))
    {
        setcookie('login_cookie', $_COOKIE['login_cookie'] , time() - 2592000);
        header("Location: index.php");
        die();
    }
<?php 
    // Smarty template s declaration
    require_once("php/smarty_config.php");   
    
    //If user has a cookie Welcome him into the home page
    if (isset($_COOKIE['login_cookie']))
    {
        $username = $_COOKIE['username'];
        $smarty->display("$path/V/templates/home.tpl");
        die();
    }
    
    header("Location: index.php");
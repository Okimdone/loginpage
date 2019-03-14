<?php 
    // Smarty template s declaration
    require_once("php/smarty_config.php");   
    
    //If user has a cookie Welcome him into the home page
    if (isset($_COOKIE['login_cookie']))
    {
        // Maybe do something with his name later
        $username = $_COOKIE['username'];

        

        //Display the page
        $smarty->display("$path/V/templates/home.tpl");
        die();
    }
    
    header("Location: index.php");
<?php 
    // Smarty template s declaration
    require_once("php/smarty_config.php");    

    // If client has a cookie redirect him directly to the home page
    if (isset($_COOKIE['login_cookie']))
    {
        header("Location: home.php");
        die();
    }

    // if what we re trying to do is loging into the website do this
    if(isset($_POST['route']) && $_POST['route']==="login") {

        // if login informations are set 
        if(isset($_POST['uname']) && isset($_POST['passwd'])){
                
            require_once("php/functions.php");
            // and the input is actually registered the redirect to the content
            if( islogin($_POST['uname'], $_POST['passwd']) ) {
                
                // Make the logged in user an identifying cookie
                setcookie('login_cookie', $_POST['uname']);
        
                // Redirect to the home welcome application
                header("Location: home.php");
                die();
            }else {// Add a Bad username/passwd error to the login page
                $smarty->assign('badlogin', 'false');
            }
        }       $smarty->display("$path/V/templates/login.tpl");
        die();
    }


    // route to the login page by default : 
    $smarty->display("$path/V/templates/login.tpl");
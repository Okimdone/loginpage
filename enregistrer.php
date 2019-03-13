<?php 
    // Smarty template s declaration
    require_once("php/smarty_config.php");    
    
    // If client has a cookie redirect him directly to the home page
    if (isset($_COOKIE['login_cookie']))
    {
        header("Location: home.php");
        die();
    }


    // if what we re trying to do is registering a new account
    if(isset($_POST['route']) && $_POST['route']==="signup") {

        require_once("php/functions.php");
        // if all signing up fields are filled
                
        if(isset($_POST['uname']) && isset($_POST['passwd']) && isset($_POST['confpasswd'])){
        
            // if the account s username is already registered => signup page + error msg  
            if (uname_exists($_POST['uname'])){
                
                $smarty->assign('uname_exists', TRUE);
            } // If somehow the two password do not match => signup page + error msg
            else if ( $_POST['passwd'] !== $_POST['confpasswd'] ) {
                $smarty->assign('no_conf_pass', TRUE);
                
            } // Save the login-password and go back to the login page  
            else {

                enregistrer($_POST['uname'],$_POST['passwd']);
                $smarty->display("$path/V/templates/login.tpl");
                die();
            }
        }
    }

    // route to the login page by default : 
    $smarty->display("$path/V/templates/signup.tpl");
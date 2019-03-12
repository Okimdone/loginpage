<?php 
    // Smarty template s declaration
    require_once("php/smarty_config.php");    

    // if what we re trying to do is loging into the website do this
    if(isset($_POST['route']) && $_POST['route']==="login") {

        // if login informations are set 
        if(isset($_POST['uname']) && isset($_POST['passwd'])){
                
            require_once("php/functions.php");
            // and the input is actually registered the redirect to the content
            if( islogin($_POST['uname'], $_POST['passwd']) ) {
                
                //This is supposed to contains the content of the page
                $smarty->display("$path/V/templates/layout.tpl");
                die();
            }else {// Add a Bad username/passwd error to the login page
                $smarty->assign('badlogin', 'false');
            }
        }       $smarty->display("$path/V/templates/login.tpl");
        die();
    }


    // route to the login page by default : 
    $smarty->display("$path/V/templates/login.tpl");
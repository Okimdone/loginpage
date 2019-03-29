<?php 
    // Smarty template s declaration
    require_once("php/smarty_config.php");    

    // If client has a cookie redirect him directly to the home page
    if (isset($_COOKIE['login_cookie']))
    {
        header("Location: home.php");
        die();
    }


    // if what we re trying to do is recovering an existing account
    if(isset($_POST['route']) && $_POST['route']==="recovery") {
    
        require_once("php/functions.php");
        // if all signing up fields are filled
        if ( isset($_POST['rec-step']) ) { 
            if ($_POST['rec-step'] === "first") {

                // if the username is being inputed / holds a value
                if( isset($_POST['uname']) ) {

                    // username holds a value that doesn t correspond to any registered accounts
                    if ( !uname_exists($_POST['uname']) ) {
                        $smarty->assign('fist_step', TRUE);
                        $smarty->assign('uname_not_exists', TRUE);    
                    } 
                    // if the user name exists , start a session to save the username 
                    // go to the next step ( take the new password )
                    else {

                        //start a session
                        session_start();
                        $_SESSION['uname'] = $_POST['uname'];
                        
                        // go to the next step (new password + confirmation step)
                        $smarty->assign('second_step', TRUE);
                    }
                    $smarty->display("$path/V/templates/recover.tpl");
                    die();
                }
            }
            // If we reached the second step of the account s recovery process 
            elseif ( $_POST['rec-step'] === "second") {
                
                // safe checking if the password s actually  
                if( isset($_POST['passwd']) && isset($_POST['confpasswd'])) {
                    
                    // if the password is empty or the password and the confirm password do not match  
                    if(($_POST['passwd'] !== $_POST['confpasswd']) OR $_POST['passwd'] === ''  ){

                        // then repeat step 2 and show an error message under confirm password 
                        $smarty->assign('second_step', TRUE);
                        $smarty->assign('no_conf_pass', TRUE);
                    } 
                    else  { // Change the password in the csv file and then go to the congratulation step
                        
                        //Change the pass
                        modify($_SESSION['uname'], $_POST['passwd']);
                        session_destroy();
                        //go to the next page (congratulation step)
                        $smarty->assign('end_step', TRUE);
                    }

                    $smarty->display("$path/V/templates/recover.tpl");
                    die();
                }// else go back to step one ( default )
            }
            elseif ( $_POST['rec-step'] === "end"){
                // if the form came from the end step message , route to the login page
                $smarty->display("$path/V/templates/login.tpl");
                die();
            }

        }
    }
    
    // route to the type the username to reset its passwd page by default : 
    $smarty->assign('fist_step', TRUE);
    $smarty->display("$path/V/templates/recover.tpl");
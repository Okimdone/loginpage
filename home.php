<?php 
    // Smarty template s declaration
    require_once("php/smarty_config.php");   
    
    //If user has a cookie Welcome him into the home page
    if (isset($_COOKIE['login_cookie']))
    {
        // Maybe do something with his name later
        $username = $_COOKIE['login_cookie'];
        
        require_once("php/functions_note.php");
        //if there is any AJAX request to post/get data
        if (isset($_POST['data'])) {
            
            // Get the data Object
            $data = $_POST['data']; 

            //  a list of the added etudiants to send to ajax front end
            $added_etudiants_for_ajax = array();

            // Get the added notes list from the data 
            if( isset( $data['added_list']) ) {
                $added_list = $data['added_list'];
                // Give the added notes an id Add store them and then return
                // the id + all the etudian, notes , moy data to the front end 
                foreach($added_list as $added){
                    $added_id = add_note($added[0], $added[1], $added[2], $added[3]);
                    
                    //  The making of the Json object
                    $added_etudiants_for_ajax[ $added_id ] = $etudiants[$added_id]; 
                }
            }
            
            if( isset($data['modified_list']) ) {
                $modified_list = $data['modified_list']; 
                foreach($modified_list as $modified) {
                    modif_note($modified[0], $modified[1], $modified[2], $modified[3], $modified[4]);
                }
            }

            if( isset($data['deleted_list']) ) {
                $deleted_list = $data['deleted_list'];
                foreach($deleted_list as $id_to_delete) {
                    suppr_note($id_to_delete);
                }
            }
            //  Save the changes to the hard drive
            enregistre();

            //  Send an Ajax response containing the new elements as an json output
            die( json_encode($added_etudiants_for_ajax) );
        }
        require_once("php/functions_note.php");
        $smarty->assign('etudiants', $etudiants);

        //Display the page
        $smarty->display("$path/V/templates/home.tpl");
        die();
    }
    
    header("Location: index.php");
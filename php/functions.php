<?php 
    //globale variables to store login infos
    $UNAME = array();
    $PASSWDS = array();
    $f ='data/users.csv' ;//change the slash Windows/Linux
    load_csv();
    
    // takes 
    function cryptthis ($passwd ) {
         $strlen = strlen($passwd)-1;
         $hack = '';
         for ($i=0; $i <=$strlen/2 ; $i++) { 
            $swap = $passwd[$strlen - $i] ;
            $passwd[$strlen - $i] = $passwd[$i];
            $passwd[$i] = $swap ; 
         }
         $strlen = strlen($passwd);
         for ($i=0; $i < $strlen ; $i++) { 
           $nbr = ord($passwd[$i]);
           $hack = $hack."$nbr";
         }
        return  $hack;
    }
    
    function enregistrer($uname,&$mdp){
        global $f;
        $b = $uname.';'.cryptthis($mdp)."\n";
        if ($file = fopen($f,'a+')) {
            fputs($file,$b,strlen($b));
            fclose($file);
        } else {
            die("Couldn t create / open file / enregitrer");
        }
    }

    function load_csv () {
		global $UNAME ;
	    global $PASSWDS ;
	    global $f;
	    if (file_exists($f)) {
            if($file = fopen($f, 'r')) {
                while ($line = fgets($file)) { 	
                    $tab = explode(";", trim($line));
                    $UNAME[] = $tab[0]; $PASSWDS[] = $tab[1];
                }
                fclose($file);
            } 
	    }
    }

    function islogin ($uname, &$passwd) {
        global $UNAME; global $PASSWDS;
        $passwd = cryptthis($passwd);
        foreach($UNAME as $index => $name) {
            if($name === $uname) {
                if($PASSWDS[$index] === $passwd){
                    return TRUE;
                }
                return FALSE;
            }
        }
        return FALSE;
    }

    function uname_exists($uname) {
        global $UNAME;
        foreach($UNAME as $name){
            if( $uname === $name){
                return TRUE;
            }
        }
        return FALSE;
    }

    function change_pass_for_user($uname, $newpass) {

        global $UNAME, $PASSWDS, $f;
        // Make the change the the $UNAME array
        foreach($UNAME as $index => $name) {
            
            if($name == $uname) {
                $PASSWDS[$index] = cryptthis($newpass);
                break;
            }
        }

        //applay the changes to the actual csv files for users data
        if ($file = fopen($f,'w')) {
            ftruncate($file, 0);
            foreach($UNAME as $index => $name) {
                $ligne = $name.";".$PASSWDS[$index]."\n";
                fputs($file,$ligne,strlen($ligne));
            }
            fclose($file);
        } else {
            die("Couldn t create / open file / change-pass");
        }

    }
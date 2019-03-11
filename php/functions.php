<?php 
    //globale variables to store login infos
    global $UNAME ; $UNAME = array();
    global $PASSWDS;$PASSWDS = array();
    global $f ;$f ='data\users.csv' ;//change the slash Windows/Linux
    load_csv();
    
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
        $a = cryptthis( $mdp);
        $b = $uname.';'.$a ."\n" ;
        if (file_exists($f)) {
            $file = fopen($f,'a+');
            fputs($file,$b,strlen($b));
            echo "felicitation vous etes un membre :) $b!";
            fclose($file);
        }
    }
    function load_csv () {
		global $UNAME ;
	    global $PASSWDS ;
	    global $f;
	    if (file_exists($f)) {
            $file = fopen($f, 'r');
            while ( !feof($file)) { 	
                $line = fgets($file);
                $tab = explode(";", $line);
                $UNAME[] = $tab[0]; $PASSWDS[] = $tab[1];
            }
            fclose($file);
	    }
    }

    function islogin ($uname, $passwd) {
        global $UNAME; global $PASSWDS;

        foreach( $UNAME as $index => $name) {
            if($name === $uname) {
                if($PASSWDS[$index] === $passwd){
                    return TRUE;
                }
                return FALSE;
            }
        }
        return FALSE;
    }
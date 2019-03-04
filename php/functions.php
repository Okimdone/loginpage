<?php 
    //globale variables to store login infos
    global $UNAME ; $UNAME = array();
    global $PASSWDS;$PASSWDS = array();

    function cryptthis ($passwd ) {
        return $passwd;
    }

    function load_csv () {
		global $UNAME ;
	    global $PASSWDS ;
	    $file = fopen('../data/users.csv', 'r');
    	while ( !feof($file)) { 	
    	 	$line = fgets($file);
    	 	$tab = explode(";", $line);
    	 	$UNAME[] = $tab[0]; $PASSWDS[] = $tab[1];
    	}
    	fclose($file);
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
<?php 
    //globale variables to store login infos
    global $UNAME ; $UNAME = array();
    global $PASSWDS;$PASSWDS = array();
    global $f ;$f ='data\users.csv' ;
    load_csv();
    
    function cryptthis ($passwd ) {
         $tab = array();
         $tab = $passwd ;
         $strlen = strlen($tab)-1;
         for ($i=0; $i <$strlen/2 ; $i++) { 
            $swap = $tab[$strlen] ;
            $tab[$strlen] = $tab[$i];
             $tab[$i] = $swap ;
            $strlen--;
         }
         $passwd = $tab ;
        return $passwd;
    }
        function enregistrer($uname,$mdp){
        global $f;
        $a = cryptthis($mdp);
        $b = "\n".$uname.';'.$a ;
        if (file_exists($f)) {
        $file = fopen($f,'a+');
        fputs($file,$b,strlen($b));
        echo "felicitation vous etes un membre :) $b!";
    }
    	fclose($file);
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
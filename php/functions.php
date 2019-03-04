<?php 
    //globale variables to store login infos
    global $UNAME ; $UNAME = array();
    global $PASSWDS;$PASSWDS = array();

    function cryptthis ($passwd ) {
        return $passwd;
    }

    function load_csv () {

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
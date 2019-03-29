<?php 
    //Files storing the username s information and his password
    $f_passwd = '../data/passwd.csv';
    $f_shadow = '../data/shadow.csv';
    $f_groups = '../data/group.csv';
    $f_log    = '../data/var/logins.log';

    // Tests
    $etudiants = new Logins;
    //$etudiants->load_csv();
    var_dump($etudiants->logins[1]);
    $etudiants->modify_login("ach1", ["id" => 1 ,"nom" => "my Name Here","class" => "classXXX","passwd" => "123", "prenom" => "pixel", "email" => "hahua@gmail.com"]);
    var_dump($etudiants->logins[1]);
    $etudiants->add_login("achh", ["uname" => "newadmin","grp" => "0", "nom" => "damnit","class" => "classXXX","passwd" => "123", "prenom" => "pixel", "email" => "awdi@gmail.com"]);
    $etudiants->delete_login("ach1", 1);
    $etudiants->enregistre();
    var_dump($etudiants->logins[1]);

    /**
     * the Main class, This class has an array of refereces of type : User and Prof
     * it also has a public interface for interacting with the main Logins Array consisting of :
     * Load_csv()  : Read the passwd & shadow files into The "logins" array
     * enregistre(): Writes into the passwd & shadow files the contents of the "logins" array
     * uname_exists() : checks if an entery with the given username is exists
     * islogin() : checks if the -login-passwd- pair is a valid login
     * add_login() : takes an associative array as an argument with its values as the properties of the new User object to add 
     * modify_login() : takes an associative array as argument with its key as the properties to change and value as the new value to be saved
     * delete_login() : Deletes the given $id s entery from the logins array
     */
    class Logins {
        // Logins
        static public $logins = array();
        // Groups
        static public $groups = array();

        public function __construct() {
            $this->load_csv();
        }        

        // Load the database-file into RAM 
        public function load_csv () {
            global $f_passwd, $f_shadow, $f_groups;
            if(($file_p = fopen($f_passwd, 'r') ) AND ($file_sh = fopen($f_shadow, 'r') ) AND ($file_grp = fopen($f_groups, 'r'))  )  {
                // Load Groups
                while(($line = fgets($file_grp)) AND  ($line !== "\n")) {
                    $tab = explode(";", trim($line));
                    $this->groups[$tab[1]] = $tab[0] ;
                }

                // Load usernames and their informations
                while ( ($line = fgets($file_p)) AND  ($line !== "\n")) { 	
                    $tab = explode(";", trim($line));
                    if($tab[1] == $this->groups['admin']) { // if login id is the same as an admin s id (0)
                        $this->logins[$tab[0]] = new User(  $tab[0], $tab[1], $tab[2], 
                                                            $tab[4], $tab[5], $tab[6], $tab[7]); 
                    }
                    else if($tab[1] == $this->groups['professeur']) { // if login id is the same as a prof s id (1)
                        $this->logins[$tab[0]] = new Prof(  $tab[0], $tab[1], $tab[2], $tab[4], 
                                                            $tab[5], $tab[6], $tab[7], $tab[8]); 
                    }
                    else {
                        $this->logins[$tab[0]] = new User(  $tab[0], $tab[1], $tab[2], 
                                                            $tab[4], $tab[5], $tab[6], $tab[7]); 
                    }
                }

                // Load passwords to the logins
                while ( ($line = fgets($file_sh)) AND ($line !== "\n") ) { 	
                    $tab = explode(";", trim($line));
                    if(isset($this->logins[$tab[0]]))
                        $this->logins[$tab[0]]->passwd = $tab[2]; 
                }

                fclose($file_p);fclose($file_sh);fclose($file_grp);
            } 
            else {
                die("fopen error error");
            }
        }

        // Saves the logins array from RAM into the hard disk drive
        public function enregistre(){
            global $f_passwd, $f_shadow;
            if(($file_p = fopen($f_passwd, 'w+') ) AND ($file_sh = fopen($f_shadow, 'w+') )) {
                foreach($this->logins as $id => $login){
                    // Wrtie into passwdfile
                    $line = $id . ';'.$login->grp . ';'.$login->uname . ';' . ((isset($login->passwd))?'x;':'*;')
                            .$login->nom.';' . $login->prenom.';' . $login->email . (($login->grp == 1)?";$login->class":"") . "\n"; 
                    fputs($file_p,$line ,strlen($line));
                    
                    // Wrtie into the shadow file
                    $line = $id . ';'.$login->uname . ';'. $login->passwd . "\n"; 
                    fputs($file_sh,$line ,strlen($line));
                }
                fclose($file_p);fclose($file_sh);
            } 
            else die("eregistre() error");
        }

        // looks for the given username, returns its id if true , else returns false 
        public function uname_exists($uname) {
            foreach($this->logins as $id => $login){
                if( $login->uname === $uname){
                    return $id;
                }
            }   return FALSE;
        }

        // Returns true if uname n password verifies what s registered, else , False
        public function islogin ($uname, &$passwd) {
            $passwd = cryptthis($passwd);

            if(  ( $id = uname_exists($uname) )  )  {
                if($this->logins[$id]->passwd === $passwd){
                    return TRUE;
                }
            }   return FALSE;
        }
        
        // Adds an entery into the logins table
        public function add_login($who, $login_array){
            if( !($who_id = $this->uname_exists($who)) OR ($this->logins[$who_id]->grp !== $this->groups['admin']) ) 
                die("Not enough permissions");

            if( isset($login_array) AND 
                isset($login_array['uname']) AND
                !$this->uname_exists($login_array["uname"]) AND isset($login_array["passwd"]) AND isset($login_array["grp"])
              )
            {
                //  Get an id
                $id = $this->get_id();

                if($login_array["grp"] == 1) { // Prof
                    $this->logins[$id] = new Prof($id, $login_array["grp"], $login_array["uname"]
                                                  , $login_array["nom"], $login_array["prenom"], $login_array["email"]
                                                  , $login_array["class"], $this->cryptthis($login_array["passwd"]) );
                }
                else {
                    $this->logins[$id] = new User($id, $login_array["grp"], $login_array["uname"]
                                                  , $login_array["nom"], $login_array["prenom"]
                                                  , $login_array["email"], $this->cryptthis($login_array["passwd"]));
                }
                $this->log_save($who, " ADDED ".json_encode( $this->logins[$id] ));
                return $id;
            }
            return FALSE;
        }

        // Take an array of changes to make and makes them if it could
        public function modify_login($who, $login_array) {
            if( !($who_id = $this->uname_exists($who)) OR ($this->logins[$who_id]->grp !== $this->groups['admin']) ) 
                die("Not enough permissions");

            if( isset($login_array) AND 
                isset($login_array['id']) AND
                isset($this->logins[ $login_array["id"] ])
                )
            {
                $id = $login_array['id'];
                
                //  User by log_save() to save the old state of the login
                $old_login =  json_encode( $this->logins[$id] );

                //  Get the keys of the array
                $keys = array_keys($login_array); 
            
                foreach($keys as $key)  {
                    switch ($key) {
                        case 'grp':
                            $this->logins[$id]->grp = $login_array['grp'];
                            break;
                            
                        case 'passwd':
                            $this->logins[$id]->passwd = $this->cryptthis($login_array['passwd']);
                            break;
                            
                        case 'nom':
                            $this->logins[$id]->nom = $login_array['nom'];
                            break;

                        case 'prenom':
                            $this->logins[$id]->prenom = $login_array['prenom'];
                            break;

                        case 'email':
                            $this->logins[$id]->email = $login_array['email'];
                            break;

                        case 'class':
                            if( $this->logins[$id]->grp == 1 ) {//grp-id des profs = 1
                                $this->logins[$id]->class = $login_array['class'];
                            }
                            break;
                    }
                }

                $this->log_save($who, " MODIFED " . $old_login ." ==> ". json_encode($this->logins[$id]) );
                return $id;
            }
            return FALSE;
        }

        // Delete an entery in the Logins
        public function delete_login($who, $id){
            if( !($who_id = $this->uname_exists($who)) OR ($this->logins[$who_id]->grp !== $this->groups['admin']) ) 
                die("Not enough permissions");

            if (isset($this->logins[$id]) ) {
                $this->log_save($who, " DELETED ".json_encode( $this->logins[$id] ));
                unset($this->logins[$id]);
                return TRUE;
            }
            return FALSE;
        }

        //  returns the next open id
        private function get_id() {
            if(count($this->logins) == 0)
                return 0;
            
            $max = $this->logins[0]->id ;
            foreach($this->logins as $login){
                if ($max < $login->id) $max = $login->id;
            }   return $max + 1;
        }
        
        // Takes a password, crypts and erases it
        private function cryptthis (&$passwd ) {
            $strlen = strlen($passwd) - 1;
            for ($i=0, $half_strlen=(strlen($passwd))/2 ; $i < $half_strlen ; $i++) { 
                $swap = $passwd[$strlen - $i] ;
                $passwd[$strlen - $i] = $passwd[$i];
                $passwd[$i] = $swap ; 
            }   $hack="";
            for($i = 0; $i <= $strlen; ++$i) {
                $hack .= ord($passwd[$i]);
                $passwd[$i] = " ";
            }
            return  $hack;
        }

        // Log the changes made to the logins array
        private function log_save($who, $message) {
            global $f_log;
            $date = date(DATE_RFC2822);

            if( ($file_lg = fopen($f_log, 'a') ) ) {
                fwrite($file_lg, "$date $who $message\n");
                fclose($file_lg);
            }
        }
    }

    /*
    **  A class defining a User(admin) that can login
    */
    class User {    // Class decribing an admin grp-id = 0
        public $id;
        public $grp;
        
        public $uname;
        public $passwd;
        
        public $nom;
        public $prenom;
        public $email;
        
        function __construct($id, $grp, $uname, $nom, $prenom, $email, $passwd) {
            $this->id=$id;
            $this->grp=$grp;
            
            $this->uname=$uname;
            if(isset($passwd)){
                $this->passwd=$passwd;
            }
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->email=$email;
        }
    }

    class Prof extends User { // Class prof grp-id = 1
        public $class;

        function __construct($id, $grp, $uname, $nom, $prenom, $email, $class, $passwd) {
            parent::__construct($id, $grp, $uname, $nom, $prenom, $email, $passwd);
            $this->class = $class;
        }
    } 
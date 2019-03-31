<?php
    //  Necessary to verify the modifier s permissions 
    require_once("$_SERVER[DOCUMENT_ROOT]/php/logins_class.php");

    // file needed to Load and store informations about the students, their notes and who did any modification on them 
    $f_notes        = $_SERVER['DOCUMENT_ROOT'] . '/data/note_users.csv';
    $f_notes_log    = $_SERVER['DOCUMENT_ROOT'] . '/data/var/etud_notes.log';
    

    /**
     * the Main class, This class has an array of refereces of type : Etudiant 
     * it also has a public interface for interacting with the main etudiants Array consisting of :
     * Load_note()  : Read the etudiant_notes file into The "etudiants" array
     * enregistre(): Writes into the etudiant_notes file the contents of the "etudiants" array
     * add_note() : takes an associative array as an argument with its values as the properties of the new Etudiant object to add 
     * modify_note() : takes an associative array as argument with its key as the properties to change and value as the new value to be saved
     * delete_note() : Deletes the given $id s entery from the "etudiants" array
     * getStudentsByClass() : takes a class and return a cloned list of all the students that attend that class
     */
    class Etudiants {
        //  tableau des etudiants
        public $etudiants =  array();

        //  this methods loads the file $f_notes into $this->etudiants. In case the file doesn t exists, it loads nothing
        public function load_note() {
            global $f_notes;
            if ($file = fopen($f_notes, 'r')) {
                while ( ($line = fgets($file)) AND  ($line !== "\n")) { 	
                    $tab = explode(";", trim($line));
                    $this->etudiants[$tab[0]] = new Etudiant($tab[0], $tab[1], $tab[2], $tab[3], $tab[4], $tab[5]);
                }       fclose($file);
            }
        }
        
        //  Saves the students in $this->etudiants into the file $f_notes
        public function enregistre() {
            global $etudiants ;
            global $f_notes;
            if ($file = fopen($f_notes, 'w+')){
                foreach($this->etudiants as $etudiant){
                    $line = $etudiant->id . ';' . $etudiant->nom.';' . $etudiant->prenom. ';'
                            . $etudiant->class . ';' . $etudiant->note1.';'.$etudiant->note2."\n"; 
                    fputs($file, $line);
                }
                fclose($file);
            } 
            else die("eregistre() error");
        }

        //  Ajouter un etudiant dans le tableau, returns the student s reference or FALSE in case of problems
        public function add_note($who, $etudiant_array ){
            $logins = Logins::GetInstance();
            $who_id = $logins->uname_exists($who);

            //  Check if $who is trying to make the addition is a 'professeur' else ERROR
            if( !($who_id) OR ($logins->logins[$who_id]->grp !== $logins->groups['professeur']) ) {
                echo "Not enough permissions";
                return FALSE;
            }
            
            if ( isset($etudiant_array['nom'], $etudiant_array['prenom']
                      , $etudiant_array['note1'], $etudiant_array['note2']) ) 
            {
                $id = $this->get_id();
                $this->etudiants[$id] = new Etudiant($id, $etudiant_array['nom'], $etudiant_array['prenom'], $logins->logins[$who_id]->class
                                                , $etudiant_array['note1'], $etudiant_array['note2'] 
                                                );
                $this->log_save($who, " ADDED ".json_encode( $this->etudiants[$id] ));
                return $this->$etudiants[$id];
            }
            echo "Invalide Etudiant";
            return FALSE;
        }

        //  Modifier les donnés d'un etudiant selon son id 
        public function modify_note($who, $etudiant_array ){
            $logins = Logins::GetInstance();
            $who_id = $logins->uname_exists($who);


            //  Check if $who is trying to make the modification is a 'professeur' of the same class else ERROR
            if( !($who_id) OR ($logins->logins[$who_id]->grp !== $logins->groups['professeur']) ) {
                echo "Not enough permissions";
                return FALSE;
            }

            //  If the student s id is NOT set or the student s class is not the same as its professor trying to modify it QUIT
            $id = $etudiant_array['id'];
            if  ( !$id OR  !isset($etudiant_array['class']) 
                  OR ($this->etudiants[$id]->class != $logins->logins[$who_id]->class) 
                ) 
            {
                return FALSE;
            }

            if ( isset($etudiant_array['nom'], $etudiant_array['prenom']
                      , $etudiant_array['note1'], $etudiant_array['note2']) ) 
            {

                $old_etudiant =  json_encode( $this->etudiants[$id] );

                // If id is registered ex
                $this->etudiants[$id]->nom = $etudiant_array['nom'];
                $this->etudiants[$id]->prenom = $etudiant_array['prenom'];
                $this->etudiants[$id]->note1 = $etudiant_array['note1'];
                $this->etudiants[$id]->note2 = $etudiant_array['note2'];
                
                //  Log the changes
                $this->log_save($who, " MODIFED " . $old_etudiant ." ==> ". json_encode($this->etudiants[$id]); 
                return $id;
            }
            echo "Invalide Modification";
            return FALSE;
        }
    
        //  Given an id, deletes it from the table $etudiants if the deleter is a prof with with same class
        public function delete_note($who, $id){
            $logins = Logins::GetInstance();
            $who_id = $logins->uname_exists($who);

            //  Check if $who is trying to make the addition is a 'proffesseur' else ERROR
            if( !($who_id) OR ($logins->logins[$who_id]->grp !== $logins->groups['professeur']) ) {
                echo "Not enough permissions";
                return FALSE;
            }

            //  the deleted is the professor of the same class the student that must exist attends
            if( isset($this->etudiants[$id]) AND ($this->etudiants[$id]->class == $logins->logins[$who_id]->class) ){
                $this->log_save($who, " DELETED ".json_encode( $this->etudiants[$id] ));
                unset($this->etudiants[$id]);
                return TRUE;
            } 
            return FALSE;
        } 

        //  Get a list of students that attend the given class
        public function getStudentsByClass($class) {
            $etudiants_list = array();

            foreach ($this->etudiants as $id => $etudiant) {
                if ($etudiant->class == $class) {
                    $etudiants_list[$id] = clone $etudiant;
                }
            }
            return $etudiants_list;
        }

        //  Returns the next open id
        private function get_id() {
            if(count($this->etudiants) == 0)
                return 0;
            
            $max = $this->etudiants[0]->id ;
            foreach($this->etudiants as $etudiant){
                if ($max < $etudiant->id) $max = $etudiant->id;
            }   return $max + 1;
        }

        // Log the changes made to the logins array
        private function log_save($who, $message) {
            global $f_notes_log;
            $date = date(DATE_RFC2822);

            if( ($file_lg = fopen($f_notes_log, 'a') ) ) {
                fwrite($file_lg, "$date $who $message\n");
                fclose($file_lg);
            }
        }
    }

    /*
    **  Class Containing information about one student
    */
    class Etudiant{
        public $id ; 
        public $nom ;
        public $prenom ;
        public $class;
        public $note1 ;
        public $note2 ;

        function __construct($id, $nom, $prenom, $class, $note1, $note2){
            $this->id = $id;   
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->class = $class;
            $this->note1 = $note1;
            $this->note2 = $note2;
        }
    } 

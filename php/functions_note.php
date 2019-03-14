<?php
    $etudiants =  array();
    $f = 'C:\wamp\www\tests\login\data\note_users.csv';    
    class Etudiant{
        public $id ; 
        public $nom ;
        public $prenom ;
        public $note1 ;
        public $note2 ;
        public $moy ;
        function __construct($id1,$nom1,$prenom1,$n1,$n2){
            $id = $id1;   
            $nom = $nom1;
            $prenom = $prenom1;
            $note1 = $n1;
            $note2 = $n2;
            $moy = ($n1+$n2)/2 ;
        }

    } 

	 load_note ();
    function load_note () {
		global $etudiants ;
        global $f;
        
	    if (!file_exists($f)) {
            fclose( fopen($f, 'w'));
            return;
        }
            
        

	    if ($file = fopen($f, 'r')) {
            while ($line = fgets($file)) { 	
                $tab = explode(";", trim($line));
                $etudiants[] = new Etudiant($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5]);
            }
            fclose($file);
	    }
    }

    function add_note($nom,$prenom,$note1,$note2){
        global $f;
        $etud = new Etudiant($nom,$prenom,$note1,$note2);
        $ident = 
	    $add = $nom.';'.$prenom.';'.$note1.';'.$note2.';'.$etud->moy."\n" ;
	    if ($file = fopen($f, 'a+')) {
            fputs($file,$add,strlen($add));
            echo "Ajout avec succès!";
            fclose($file); 
        }    
        else echo "its not working bro !";
    }
   function modif_note($nom,$prenom){

   }
   function suppr_note(){

   }
   function max_ident(){
       
   }
?>
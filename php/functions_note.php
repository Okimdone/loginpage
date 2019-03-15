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
        function __construct($iden,$nom1,$prenom1,$n1,$n2,$myen){
            $this->id = $iden;   
            $this->nom = $nom1;
            $this->prenom = $prenom1;
            $this->note1 = $n1;
            $this->note2 = $n2;
            $this->moy = $myen ;
        }

    } 

	 load_note ();
    function load_note () {
		global $etudiants ;
	    global $f;
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
        $moy = ($note1+$note2)/2;
        $id = get_id();
	    $add =$id.';'.$nom.';'.$prenom.';'.$note1.';'.$note2.';'.$moy."\n" ;
	    if ($file = fopen($f, 'a+')) {
            fputs($file,$add,strlen($add));
            echo "Ajout avec succès!";
            fclose($file); 
        }    
        else echo "its not working bro !";
    }
    function get_id() {
        global $f;
        global $etudiants ;
        if(count($etudiants) == 0){
            return 0;
        }
        $max = $etudiants[0]->id ;
        foreach($etudiants as $etudiant){
            if ($max < $etudiant->id) $max = $etudiant->id;
        }
        return $max + 1;
    }

   function modif_note(){  

   }
   function suppr_note(){

   }
   function get_buttons(){
       $str = '';
       $btns = array(
        1=>'save',
        2=>'delete',
        3=>'refresh'
       );
  
       //while(list($k,$v)= each($btns))
       foreach($btns as $k=>$v){
           $str.='<input type = "submit" value="'.$v.'" name="btn_'.$k.'" id="btn_'.$k.'"/>';
       }
       return $str ;
   }
   echo get_buttons() ;
?>  
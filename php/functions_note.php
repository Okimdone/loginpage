<?php
    $etudiants =  array();
    $f = 'data/note_users.csv';
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
                $etudiants[$tab[0]] = new Etudiant($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5]);
            }
            fclose($file);
	    }
    }

    /*
    **ajouter un etudiant dans le tableau avant de lui ajouter dans le fichier  
    */
    function add_note($nom,$prenom,$note1,$note2){
        global $etudiants ;
        $moy = ($note1+$note2)/2;
        $id = get_id();
        $etudiants[$id] = new Etudiant($id,$nom,$prenom,$note1,$note2,$moy);
    }

    /*
    **  cette fonction enregistre le contenu du tab global apres tous modifaction
    **  le fichier $f 
    */
    function enregistre(){
        global $etudiants ;
        global $f ;
        if ($file = fopen($f, 'w')){
            ftruncate($file, 0);
            foreach($etudiants as $etudiant){
                $line = $etudiant->id.';'.$etudiant->nom.';'.$etudiant->prenom.';'.$etudiant->note1.';'.$etudiant->note2.';'.$etudiant->moy."\n"; 
                fputs($file,$line ,strlen($line));
            }
        } 
        else die("eregistre() error");
    }

    /*
    **calcule un nv id pour un etudiant elle retourn le max des id+1
    */
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

    /*
    **modifier les donnés d'un etudiant selon son id 
    */
    function modif_note($id,$nom,$prenom,$note1,$note2){
        global $etudiants ;
        $moy = ($note1+$note2)/2;
        $etudiants[$id]->nom = $nom;
        $etudiants[$id]->prenom = $prenom;
        $etudiants[$id]->note1 = $note1;
        $etudiants[$id]->note2 = $note2;
        $etudiants[$id]->moy = $moy;
   }
   
   /*
   ** cette fonction supprime un element du tableau global
   */
    function suppr_note($iden){
        global $etudiants ;
        if(isset($etudiants[$iden])){
            unset($etudiants[$iden]);
        } 
    } 
?>  
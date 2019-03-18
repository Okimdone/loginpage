<?php
    $f = 'data/note_users.csv';
    $id = array() ; 
    $nom = array() ;
    $prenom = array() ;
    $note1 = array() ;
    $note2 = array() ;
    $moy = array() ;

    $etudiants =  array(
        'id' => $id,
        'nom'=> $nom,
        'prenom'=>$prenom,
        'note1' => $note1,
        'note2' => $note2,
        'moy'   => $moy
    );

     

    load_note ();
    function load_note () {
		global $etudiants ;
	    global $f;
	    if ($file = fopen($f, 'r')) {
            while ($line = fgets($file)) { 	
                $tab = explode(";", trim($line));
                $etudiants['id'][$tab[0]]      = $tab[0];
                $etudiants['nom'][$tab[0]]     = $tab[1];
                $etudiants['prenom'][$tab[0]]  = $tab[2];
                $etudiants['note1'][$tab[0]]   = $tab[3];
                $etudiants['note2'][$tab[0]]   = $tab[4];
                $etudiants['moy'][$tab[0]]     = $tab[5];
            }
            fclose($file);
	    }
    }

    /*
    **ajouter un etudiant dans le tableau avant de lui ajouter dans le fichier  
    */
    function add_note($nom,$prenom,$note1,$note2){
        global $etudiants ;
        $moy = ((int)$note1+ (int)$note2)/2;
        $id = get_id();
        $etudiants['id'][$id]      = $id;
        $etudiants['nom'][$id]     = $nom;
        $etudiants['prenom'][$id]  = $prenom;
        $etudiants['note1'][$id]   = $note1;
        $etudiants['note2'][$id]   = $note2;
        $etudiants['moy'][$id]     = $moy;
        return $id;
    }

    /*
    **  cette fonction enregistre le contenu du tab global apres tous modifaction
    **  le fichier $f 
    */
    function enregistre(){
        global $etudiants ;
        global $f;
        if ($file = fopen($f, 'w')){
            ftruncate($file, 0);
            foreach($etudiants['id'] as $id){
                $line = $id.';'.$etudiants['nom'][$id].';'.$etudiants['prenom'][$id].';'.$etudiants['note1'][$id].';'.$etudiants['note2'][$id].';'.$etudiants['moy'][$id]."\n"; 
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
        $max = $etudiants['id'][0] ;
        foreach($etudiants['id'] as $id){
            if ($max < $id) $max = $id;
        }
        return $max + 1;
    }

    /*
    **modifier les donnés d'un etudiant selon son id 
    */
    function modif_note($id,$nom,$prenom,$note1,$note2){
        global $etudiants ;
        $moy = ($note1+$note2)/2;
        $etudiants['nom'][$id]      = $nom;
        $etudiants['prenom'][$id]   = $prenom;
        $etudiants['note1'][$id]    = $note1;
        $etudiants['note2'][$id]    = $note2;
        $etudiants['moy'][$id]      = $moy;
   }
   
   /*
   ** cette fonction supprime un element du tableau global
   */
    function suppr_note($iden){
        global $etudiants ;
        if(isset($etudiants['id'][$iden])){
            unset($etudiants['id'][$iden]);
            unset($etudiants['nom'][$iden]);
            unset($etudiants['prenom'][$iden]);
            unset($etudiants['note1'][$iden]);
            unset($etudiants['note2'][$iden]);
            unset($etudiants['moy'][$iden]);
        } 
    } 
?>  
<?php

    namespace App\Http\Controllers;
    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Cookie;
    use Tymon\JWTAuth\Exceptions\JWTException;


//    use JWTAuth;
//    use Illuminate\Http\Request;
 //   use Cookie;
    class DataController extends Controller
    {
        public function homepage(Request $request) {
            //$data = \App\Type_compte::all();

           $user = JWTAuth::parseToken()->authenticate();
            //hasAccess('jwt');
            return view('home',[/*'data' => $data,*/ 'user' => '22'/*var_dump($user)*/]);
        }

        public function loginpage()
        {
            return  view('loginpage')->render();
        }

        public function closed()
        {
            $data = "Only authorized users can see this";
            return response()->json(compact('data'),200);
        }

        public function syncData(Request $request){
           //   Getting the type of the acount used
           $loggedUser = JWTAuth::parseToken()->authenticate();
           $type_compte = \App\Type_compte::where('id', $loggedUser->id_type_compte)->get('type')->first()->type;

            // what the data json is supposed to look like : {"added_list" : [] , "modified_list" : [], "deleted_list" : [] }
            $data = $request->get('data');
            $data = json_decode($data);

           switch ($type_compte) {
               case 'admin':
                    // Works with a Json object of this form
                    /*
                    {"added_list" :
                        {
                            "profs":[{ "nom": "nomprof", "prenom": "prenomprof", "email": "email@gmail.com"} ]
                            , "modules": [{"id_prof": 3, "module" : "WEB" }]
                        }
                    }
                    */
                    if (isset($data->added_list)) {
                        if ($data->added_list->profs) {
                            foreach($data->added_list->profs as $toAddProf){
                                try {
                                    \DB::beginTransaction();

                                    // For a new Users entity
                                    $user = new \App\User();

                                    $user->uname = $toAddProf->email;
                                    $user->password = Hash::make($toAddProf->email);
                                    $user->id_type_compte = \App\Type_compte::where('type', 'professeur')->get('id')->first()->id;
                                    $user->save();

                                    // For enseignants entity
                                    $prof = new \App\Enseignant();
                                    $prof->id = $user->id;
                                    $prof->nom = $toAddProf->nom;
                                    $prof->prenom = $toAddProf->prenom;
                                    $prof->email = $toAddProf->email;
                                    $prof->save();

                                    \DB::commit();
                                } catch (Exception $e){
                                    \DB::rollback();
                                }
                            }
                        }
                        if ($data->added_list->modules) {
                            foreach ($data->added_list->modules as $toAddModule) {
                                try {
                                    \DB::beginTransaction();

                                    $module = new \App\Module();
                                    $module->module = $toAddModule->module;
                                    $module->id_prof = $toAddModule->id_prof;
                                    $module->save();

                                    \DB::commit();
                                } catch (Exception $e){
                                    \DB::rollback();
                                }
                            }
                        }
                    }

                    // Works with a Json object of this form
                    /*
                    {"modified_list" :
                        {
                            "profs":[{"id": 20 , "nom": "nomprof", "prenom": "prenomprof", "email": "email@gmail.com"} ]
                            , "modules": [{"id": 4, "module" : "WEB" }]
                        }
                    }
                    */
                    if (isset($data->modified_list)) {
                        if ($data->modified_list->profs) {
                            foreach($data->modified_list->profs as $toModifProf){
                                try {
                                    \DB::beginTransaction();

                                    $prof = \App\Enseignant::find($toModifProf->id);
                                    {
                                        if(isset($toModifProf->nom)){
                                            $prof->nom = $toModifProf->nom;
                                        }
                                        if(isset($toModifProf->prenom)){
                                            $prof->prenom = $toModifProf->prenom;
                                        }
                                        if(isset($toModifProf->email)){
                                            $prof->email = $toModifProf->email;
                                        }
                                    }
                                    $prof->save();

                                    $user = \App\User::find($toModifProf->id);
                                    {
                                        $user->uname = $prof->email ;
                                        $user->password = Hash::make($prof->email) ;
                                    }
                                    $user->save();

                                    \DB::commit();
                                } catch (Exception $e){
                                    \DB::rollback();
                                }
                            }
                        }
                        if ($data->modified_list->modules) {
                            foreach ($data->modified_list->modules as $toModifModule) {
                                try {
                                    \DB::beginTransaction();

                                    if(isset($toModifModule->id) AND isset($toModifModule->module)) {
                                        \App\Module::where('id', $toModifModule->id)
                                                   ->update(['module' => $toModifModule->module]);
                                    }

                                    \DB::commit();
                                } catch (Exception $e){
                                    \DB::rollback();
                                }
                            }
                        }
                    }

                    // Works with a Json object of this form
                    /*
                    {"deleted_list" :
                        {
                            "profs":[{"id": 20 } ]
                            , "modules": [{"id": 4 }]
                        }
                    }
                    */
                    if (isset($data->deleted_list)) {
                        if ($data->deleted_list->profs) {
                            foreach($data->deleted_list->profs as $toDelProf){
                                try {
                                    \DB::beginTransaction();

                                    if ( isset($toDelProf->id) ) {

                                        // deleting the user and cascading it to the prof(enseignant)
                                        \App\User::where('id', $toDelProf->id)->delete();

                                    }

                                    \DB::commit();
                                } catch (Exception $e){
                                    \DB::rollback();
                                }
                            }
                        }
                        if ($data->deleted_list->modules) {
                            foreach ($data->deleted_list->modules as $toDelModule) {
                                try {
                                    \DB::beginTransaction();

                                        // deleting the user and cascading it to the prof(enseignant)
                                        \App\Module::where('id', $toDelModule->id)->delete();

                                    \DB::commit();
                                } catch (Exception $e){
                                    \DB::rollback();
                                }
                            }
                        }
                    }
                    return;
               break;

               case 'professeur':
                    // Works with a Json object of this form
                    // {"added_list" : [{"nom":  "achraf", "prenom":"bougadre", "cne":"123456", "note": 12.25, "id_module": 3 }] , "modified_list" : [], "deleted_list" : [] }
                    if (isset($data->added_list)) {
                        foreach($data->added_list as $toAdd){
                            try {
                                \DB::beginTransaction();

                                // For a new Users entity
                                $user = new \App\User();

                                $user->uname = $toAdd->cne;
                                $user->password = Hash::make($toAdd->cne);
                                $user->id_type_compte = \App\Type_compte::where('type', 'etudiant')->get('id')->first()->id;
                                $user->save();

                                // For etudiants entity
                                $etudiant = new \App\Etudiant();
                                $etudiant->id = $user->id;
                                $etudiant->cne = $toAdd->cne;
                                $etudiant->nom = $toAdd->nom;
                                $etudiant->prenom = $toAdd->prenom;
                                $etudiant->save();

                                // For Notes entity
                                $note = new \App\Note();
                                $note->note = $toAdd->note;
                                $note->id_module = $toAdd->id_module;
                                $note->id_prof = $loggedUser->id;
                                $note->id_etud = $etudiant->id;
                                $note->save();

                                \DB::commit();
                            } catch (Exception $e) {
                                \DB::rollBack();
                            }
                        }
                    }

                    // Works with a Json object of this form
                    // {"modified_list" : [{"cne":"123456", "nom":  "achraf", "prenom":"bougadre", "note": 12.25, "id_module": 3 }], "deleted_list" : [] }
                    if (isset($data->modified_list)) {
                        foreach($data->modified_list as $toModif){
                            try {
                                \DB::beginTransaction();

                                //  Get the id of the user with intered cne if it exists
                                $etud_id = \App\Etudiant::where('CNE', $toModif->cne)->get('id')->first();
                                if(isset($etud_id)) {
                                    $etudiant = \App\Etudiant::find($etud_id->id);
                                    {
                                        if(isset($toModif->nom)){
                                            $etudiant->nom = $toModif->nom;
                                        }

                                        if(isset($toModif->prenom)){
                                            $etudiant->prenom = $toModif->prenom;
                                        }
                                    }
                                    $etudiant->save();

                                    if(isset($toModif->note) AND isset($toModif->id_module)) {
                                        \App\Note::where('id_module', $toModif->id_module)
                                                   ->where('id_etud', $etud_id->id)
                                                   ->where('id_prof', $loggedUser->id)
                                                   ->update(['note' => $toModif->note]);
                                    }
                                }
                                \DB::commit();
                            } catch (Exception $e){
                                \DB::rollback();
                            }
                        }
                    }

                    // Works with a Json object of this form
                    //{ "deleted_list" :[ {"cne":"123456", "id_module": 3 } ]  }
                    if (isset($data->deleted_list)) {
                        foreach($data->deleted_list as $toDel){
                            try {
                                \DB::beginTransaction();
                                {
                                    if ( isset($toDel->cne) AND isset($toDel->id_module) ) {
                                        $etud_id = \App\Etudiant::where('CNE', $toDel->cne)->get('id')->first();
                                        if(!isset($etud_id)){
                                            continue;
                                        }

                                        // Getting the Notes model
                                        $note = \App\Note::where('id_module', $toDel->id_module)
                                                   ->where('id_etud', $etud_id->id)
                                                   ->where('id_prof', $loggedUser->id)
                                                   ->delete();

                                        // If there are no records saved for the studens : then delete the user account and cascade to the etudiant record
                                        $note_count_for_student = \App\Note::where('id_etud', $etud_id->id)->count();
                                        if($note_count_for_student == 0){
                                            \App\User::where('id', $etud_id->id)->delete();
                                        }
                                    }
                                }
                                \DB::commit();
                            } catch (Exception $e) {
                                \DB::rollback();
                            }
                        }
                    }
               break;
           }
           return;
        }


        protected function hasAccess(){

        }
    }


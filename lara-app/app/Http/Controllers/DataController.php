<?php

    namespace App\Http\Controllers;

    use JWTAuth;
    use Illuminate\Http\Request;

    class DataController extends Controller
    {
        public function homepage() {
            //$data = \App\Type_compte::all();

           $user = JWTAuth::parseToken()->authenticate();

            return view('home',[/*'data' => $data,*/ 'user' => var_dump($user)])->render();
        }

        public function loginpage()
        {
            return  view('loginpage')->render();;
        }

        public function registerpage(){
            return  view('registerpage')->render();;
        }

        public function closed()
        {
            $data = "Only authorized users can see this";
            return response()->json(compact('data'),200);
        }
    }

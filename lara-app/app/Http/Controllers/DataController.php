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

        protected function hasAccess(){

        }
    }

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class IndexController extends Controller
{
    //
    public function index(Request $request){
        return view('index', [ ] );
    }


    public function login(Request $request){
        try{
            $requestInfo = [
                'user' => $request->email,
                'password' => $request->password                       
            ];
            
            $user = new User();
            $validateUsers = $user->validarUsers($requestInfo);
            
            if( $validateUsers['validate'] === false){
                $result = [
                    "message" => 'Por favor valide las credenciales.',
                    "status" => 'success',
                    "code" => 400
                ];                
    
            }else{    
                
                $request->session()->put('userData', json_encode($validateUsers['userData']));

                $result = [
                    "message" => 'Login Correcto.',
                    "status" => 'success',
                    "code" => 200
                ];

            }
        }
        catch(\Exception $e){             
            $result = [
                "message" => $e->getMessage(),
                "status" => 'success',
                "code" => 400
            ];
        }        

        return json_encode($result);
    }

    public function cerrar(Request $request){

        try{
            $request->session()->forget('userData');
            $return = redirect()->route('inicio', []);
        }catch(\Exception $e){             
            $request->session()->put('message', $e->getMessage());
            $return = redirect()->route('inicio', []);
        }

        return $return;
    }

    
    public function home(Request $request){

        try{
            if($request->session()->has('userData')){
                $return = view('home', [ ] );
            }else{
                $request->session()->put('message', 'Por favor hacer login');
                $return = redirect()->route('inicio', []);
            }
        }catch(\Exception $e){             
            $request->session()->put('message', $e->getMessage());
            $return = redirect()->route('inicio', []);
        }

        return $return;
        
    }

}

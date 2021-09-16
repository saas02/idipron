<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    //
    public function view(Request $request){
        return view('users', [ ] );
    }

    public function get(Request $request){
        try{
            $user = new User();
            $Users = $user->obtainUsersByParentId();

            $result = [
                "message" => $Users,
                "status" => 'success',
                "code" => 200
            ];

        }catch(\Exception $e){             
            
            $result = [
                "message" => $e->getMessage(),
                "status" => 'success',
                "code" => 400
            ];
        }

        return $result;
    }


    public function crear(Request $request){
        return view('crearUsuarios', [ ] );
    }

    public function create(Request $request){
        try{
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = md5($request->password);

            $user->email_verified_at = new \DateTime();
            $user->created_at = new \DateTime();
            $user->updated_at = new \DateTime();
            $user->is_parent = 0;

            $user->save();

            $result = [
                "message" => 'Proceso realizado correctamente',
                "status" => 'success',
                "code" => 200
            ];
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



    

}

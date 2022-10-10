<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function register(Request $request){
        
        // // validation
        // $validator = Validator::make($request->all(),[

        //     "name" => "required",
        //     "email" => "required|email",
        //     "password" => "required|min:6",
        // ]);

        // errors
        // if($validator->fails()){

        //     return response()->json([
        //         "status"=>"error",
        //         "errors"=> $validator,
        //     ]);
        // }

        // create user 
        // $user =  User::create([
        //         "name"=> $request->name,
        //         "email"=> $request->email,
        //         "password"=> bcrypt($request->password),
        //     ]);

        $user = new User();      

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        // // success
        // return response()->json([
        //     "status"=> "success",
        //     "data" => $user
        //  ]);

    }
    public function login()
    {
        
        $credentials = request(['email', 'password']);

        // if logged
        // if (!$token = auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
        if ($token = auth()->attempt($credentials)) {

            return response()->json([ 'status' => 'success', 'token'=>$token ]);
        }

        return response()->json([ 'status' => 'error' ]);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

}

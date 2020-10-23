<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\MessageReceived;
use App\Models\User;
use Cassandra\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //Get listar registro
    public function index(Request $request)
    {
        $usuario =User::all();
        return response()->json([
            'Usuarios'=>$usuario
        ], 200);
    }

    //POST insert
    public function signup(CreateUserRequest $request)
    {
        $input= $request->all();
        $user = User::where('usuarioEmail','like','%' . $input['usuarioEmail'] . '%')->first();
        if (!is_null($user)){
            return response()->json([
                'res' =>false,
                'message'=>'Correo ya en uso'
            ], 200);
        }
        $password = $input['usuarioContraseña'];
        $input['usuarioContraseña'] = password_hash($password, PASSWORD_BCRYPT);
        User::create($input);
        return response()->json([
            'res' =>true,
            'message'=>'Resgistro creado correctamente.'
        ], 200);
    }

    public function login(Request $request)
    {
        $input= $request->all();
        $user = User::where('usuarioEmail','like','%' . $input['usuarioEmail'] . '%')->first();
        if (!is_null($user)&&!password_verify($input['usuarioContraseña'], $user['usuarioContraseña'])){
            return response()->json([
                'res' =>false,
                'message'=>'Correo o contraseña incorrectos'
            ], 200);
        }
        $user->api_token =Str::random(100);
        $user->save();
        return response()->json([
            'res' =>true,
            'token' => 'Bearer '.$user->api_token,
            'message'=>'Inicio de sesión correctamente.'
        ], 200);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function recovery(Request $request)
    {
        $input= $request->all();
        $user = User::where('usuarioEmail','like','%' . $input['usuarioEmail'] . '%')->first();
        if(is_null($user)){
            return response()->json([
                'res' =>false,
                'message'=>'Correo inexistente'
            ], 200);
        }
        $random=rand(0,10000);
        $hash=Hash::make($random);
        $pass=substr($hash,0, 9);
        $user->usuarioContraseña=password_hash($pass, PASSWORD_BCRYPT);
        try {
            $user->save();
            $infoUser['Name']=$user['usuarioNombre'];
            $infoUser['Password']=$pass;
            Mail::to($user['usuarioEmail'])->queue(new MessageReceived($infoUser));
            return response()->json([
                'res' =>true,
                'message'=>'Resgistro actualizado correctamente.'
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'Exeption'=>$e->getMessage(),
                'res' =>false,
                'message'=>'Resgistro actualizado erroneamente.'
            ], 200);
        }
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'res' =>true,
            'message'=>'Resgistro eliminado correctamente.'
        ], 200);
    }

    public function logout(){
        $user = auth()->user();
        $user->api_token =null;
        $user->save();
        return response()->json([
            'res' =>true,
            'message'=>'Cerro sesión correctamente.'
        ], 200);
    }

    function findId($id){
        $user = User::where('id','like','%' . $id . '%')->first();
        return $user['usuarioNombre'];
    }

}

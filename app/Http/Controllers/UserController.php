<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Cassandra\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //Get listar registro
    public function index(Request $request)
    {
        /*if($request->has('txtbuscar')){
            $usuario = User::where('usuarioNombre','like','%' . $request->txtbuscar . '%')
                ->orWhere('usuarioTelefonoPrincipal', $request->txtbuscar)
                ->get();
        }else{*/
        $usuario =User::all();
        //}
        $user = auth()->user();
        return response()->json([
            'UsiarioActual'=> $user['id'],
            'Usuarios'=>$usuario
        ], 200);
    }

    //POST insert
    public function signup(CreateUserRequest $request)
    {
        $input= $request->all();
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
        $user = User::where('usuarioEmail','like','%' . $input['usuarioEmail'] . '%')->get();
        if(count($user)==0){
            return response()->json([
                'res' =>false,
                'message'=>'Correo inexistente'
            ], 200);
        }
        try {
            $this->update($user);
        }catch (\Exception $e){
            return response()->json([
                'res' =>false,
                'message'=>'Resgistro actualizado erroneamente.'
            ], 200);
        }
    }

    //PUT actualizar registros
    public function update(UpdateUserRequest $request, User $user)
    {
        $input= $request->all();
        try {
            $user->update($input);
        }catch (\Exception $e){
            return $e->getMessage();
        }
        return response()->json([
            'res' =>true,
            'message'=>'Resgistro actualizado correctamente.'
        ], 200);
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

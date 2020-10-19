<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $UserController = new UserController();
        $results=PostModel::all();
        $filas=count($results);
        $posts=null;
        for ($i = 0; $i < $filas; $i++){
            $posts[$i]['publicacionTitulo']=$results[$i]['publicacionTitulo'];
            $posts[$i]['publicacionDescripcion']=$results[$i]['publicacionDescripcion'];
            $posts[$i]['usuarioNombre']=$UserController->findId($results[$i]['fk_usuarioId']);
            $posts[$i]['publicacionFechaCreacion']=$results[$i]['publicacionFechaCreacion'];
        }
        return response()->json([
            'Posts'=>$posts
        ], 200);
    }

    public function store(Request $request)
    {
        $input= $request->all();
        $hoy = date('Y-m-d');
        $post['publicacionFechaCreacion']=$hoy;
        $user = auth()->user();
        $post['publicacionTitulo']=$input['publicacionTitulo'];
        $post['publicacionDescripcion']=$input['publicacionDescripcion'];
        $post['cboCollege']=$input['cboCollege'];
        $post['fk_usuarioId']=$user['id'];
        PostModel::create($post);
        return response()->json([
            'res' =>true,
            'message'=>'Publicación creada correctamente.'
        ], 200);
    }

    public function show(PostModel $post)
    {
        return $post;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

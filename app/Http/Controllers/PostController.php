<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        return PostModel::all();
    }

    public function store(Request $request)
    {
        $input= $request->all();
        $hoy = date('Y-m-d');
        $input['publicacionFechaCreacion']=$hoy;
        PostModel::create($input);
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

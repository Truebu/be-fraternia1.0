<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Models\CompanyModel;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(CreateCompanyRequest $request){
        $input= $request->all();
        $user = auth()->user();
        $input['id_user']=$user['id'];
        CompanyModel::create($input);
        return response()->json([
            'res' =>true,
            'message'=>'Empresa creado correctamente.'
        ], 200);
    }

    public function findCompanyName(Request $request){
        $college = CompanyModel::where('id','like','%' . $request . '%')->first();
        return $college['empresaNombre'];
    }

    public function findCompanyId(Request $request){
        $college = CompanyModel::where('id_user','like','%' . $request . '%')->first();
        return $college['id'];
    }
}

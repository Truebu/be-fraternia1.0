<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Models\CompanyModel;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(CreateCompanyRequest $request){
        $input= $request->all();
        $company = CompanyModel::where('empresaEmail','like','%' . $input['empresaEmail'] . '%')->first();
        if (!is_null($company)){
            return response()->json([
                'res' =>false,
                'message'=>'Correo ya en uso'
            ], 200);
        }
        $user = auth()->user();
        $input['id_user']=$user['id'];
        CompanyModel::create($input);
        return response()->json([
            'res' =>true,
            'message'=>'Empresa creado correctamente.'
        ], 200);
    }

    public function findCompanyName($request){
        $company = CompanyModel::where('id','like','%' . $request . '%')->first();
        return $company['empresaNombre'];
    }

    public function findCompanyId($request){
        $company = CompanyModel::where('id_user','like','%' . $request . '%')->first();
        return $company['id'];
    }

    public function isExistCompany(){
        $user = auth()->user();
        $findUser['id_user']=$user['id'];
        $company = CompanyModel::where('id_user','like','%' . $findUser['id_user'] . '%')->first();
        if($company==null){
            $res=false;
        }else{
            $res=true;
        }
        return response()->json([
            'res' =>$res
        ], 200);
    }
}

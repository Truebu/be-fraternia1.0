<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\VacantModel;
use Illuminate\Http\Request;
use App\Http\Controllers\CompanyController;

class VacantController extends Controller
{
    public function index()
    {
        $CompanyController= new CompanyController();
        $UserController = new UserController();
        $results=VacantModel::all();
        $filas=count($results);
        $vacants=null;
        for ($i = 0; $i < $filas; $i++){
            $vacants[$i]['vacanteNombre']=$results[$i]['vacanteNombre'];
            $vacants[$i]['vacanteDescripcion']=$results[$i]['vacanteDescripcion'];
            $vacants[$i]['nombreEmpresa']=$CompanyController->findCompanyName($results[$i]['id_empresa']);
            $vacants[$i]['nombreUser']=$UserController->findId($results[$i]['id_users']);
            $vacants[$i]['fechasRegistro']=$results[$i]['fechasRegistro'];
        }
        return response()->json([
            'Vacants'=>$vacants
        ], 200);
    }

    public function store(Request $request)
    {
        $CompanyController= new CompanyController();
        $input= $request->all();
        $hoy = date('Y-m-d');
        $vacants['fechasRegistro']=$hoy;
        $user = auth()->user();
        $vacants['vacanteNombre']=$input['vacanteNombre'];
        $vacants['vacanteDescripcion']=$input['vacanteDescripcion'];
        $vacants['id_empresa']=$CompanyController->findCompanyId($user['id']);
        $vacants['id_users']=$user['id'];
        $vacants['cboCollege']=$input['cboCollege'];
        VacantModel::create($vacants);
        return response()->json([
            'res' =>true,
            'message'=>'Vacante creada correctamente.'
        ], 200);
    }
}

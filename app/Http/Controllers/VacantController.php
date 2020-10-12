<?php

namespace App\Http\Controllers;

use App\Models\VacantModel;
use Illuminate\Http\Request;

class VacantController extends Controller
{
    public function index()
    {
        include("CompanyController.php");
        include("UserController.php");
        $results=VacantModel::all();
        $filas=count($results);
        for ($i = 0; $i < $filas; $i++){
            $vacants[$i]['vacanteNombre']=$results[$i]['vacanteNombre'];
            $vacants[$i]['vacanteDescripcion']=$results[$i]['vacanteDescripcion'];
            $vacants[$i]['id_empresa']->findCompanyName($results[$i]['id_empresa']);
            $vacants[$i]['id_users']->findUser($results[$i]['id_users']);
            $vacants[$i]['fechasRegistro']=$results[$i]['fechasRegistro'];
        }
        return $vacants;
    }

    public function store(Request $request, $company)
    {
        include("CompanyController.php");
        $input= $request->all();
        $hoy = date('Y-m-d');
        $vacants['fechasRegistro']=$hoy;
        $user = auth()->user();
        $vacants['vacanteNombre']=$input['publicacionTitulo'];
        $vacants['vacanteDescripcion']=$input['publicacionDescripcion'];
        $company->findCompanyId($user['id']);
        $vacants['id_empresa']=$company;
        $vacants['id_users']=$user['id'];
        VacantModel::create($vacants);
        return response()->json([
            'res' =>true,
            'message'=>'Vacante creada correctamente.'
        ], 200);
    }
}

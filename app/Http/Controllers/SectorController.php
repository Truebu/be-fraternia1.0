<?php

namespace App\Http\Controllers;

use App\Models\SectorModel;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function findSector(Request $request){
        $college = SectorModel::where('id','like','%' . $request . '%')->first();
        return $college['sectorNombre'];
    }
}

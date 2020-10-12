<?php

namespace App\Http\Controllers;

use App\Models\CollegeModel;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function findCollege(Request $request){
        $college = CollegeModel::where('id','like','%' . $request . '%')->first();
        return $college['nombreUniversidad'];
    }
}

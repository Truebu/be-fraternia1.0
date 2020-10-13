<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    use HasFactory;
    protected $table='empresa';

    protected $fillable = [
        'empresaNombre',
        'empresaTelefono',
        'empresaEmail',
        'nitEmpresa',
        'empresaDescripcion',
        'id_sector',
        'id_user'
    ];

    protected $hidden=[
        'created_at','updated_at'
    ];
}

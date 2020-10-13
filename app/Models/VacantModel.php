<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacantModel extends Model
{
    use HasFactory;
    protected $table='vacante';

    protected $fillable = [
        'vacanteNombre',
        'vacanteDescripcion',
        'fechasRegistro',
        'id_empresa',
        'id_users',
        'cboCollege'
    ];

    protected $hidden=[
        'created_at','updated_at'
    ];
}

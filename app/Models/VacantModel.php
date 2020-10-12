<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacantModel extends Model
{
    use HasFactory;
    protected $table='publicacion';

    protected $fillable = [
        'vacanteNombre',
        'vacanteDescripcion',
        'fechasRegistro',
        'id_empresa',
        'id_users'
    ];

    protected $hidden=[
        'created_at','updated_at'
    ];
}

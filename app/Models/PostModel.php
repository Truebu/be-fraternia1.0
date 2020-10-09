<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;
    protected $table='publicacion';

    protected $fillable = [
        'publicacionTitulo',
        'publicacionDescripcion',
        'cboCollege',
        'fk_usuarioId',
        'publicacionFechaCreacion'
    ];

    protected $hidden=[
        'created_at','updated_at'
    ];
}

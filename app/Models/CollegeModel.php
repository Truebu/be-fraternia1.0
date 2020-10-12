<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeModel extends Model
{
    use HasFactory;
    protected $table='universidad';

    protected $fillable = [
        'nombreUniversidad'
    ];

    protected $hidden=[
        'created_at','updated_at'
    ];
}

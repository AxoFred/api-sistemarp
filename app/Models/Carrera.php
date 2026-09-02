<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'carreras';

    protected $primaryKey = 'ID_Carrera';

    public $timestamps = false;

    protected $fillable = [
        'Nombre_Carrera',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alfabetizatec extends Model
{
    protected $table = 'alfabetizatec';
    protected $primaryKey = 'ID_Alfa';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Institucion',
        'ID_Matricula',
        'Correo',
        'Telefono',
        'Programa_Academico',
        'ID_Educando',
        'ID_Lvl',
    ];

    protected $casts = [
        'ID_Matricula' => 'integer',
        'ID_Educando' => 'integer',
        'ID_Lvl' => 'integer',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'ID_Matricula', 'ID_VS');
    }

    public function educando()
    {
        return $this->belongsTo(Educando::class, 'ID_Educando', 'ID_Educando');
    }

    public function nivelEducando()
    {
        return $this->belongsTo(NivelEducando::class, 'ID_Lvl', 'ID_Lvl');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Carrera;

class Matricula extends Model
{
    protected $table = 'matricula';

    protected $primaryKey = 'ID_VS';

    public $timestamps = false;

    protected $fillable = [
        'No_Control',
        'Nombres',
        'Apaterno',
        'Amaterno',
        'Rfc',
        'Curp',
        'Sexo',
        'Semestres',
        'Periodo_Actual',
        'ID_Carrera',
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'ID_Carrera', 'ID_Carrera');
    }
}
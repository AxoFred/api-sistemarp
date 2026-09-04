<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitaIndustrial extends Model
{
    protected $table = 'visitas_industriales';
    protected $primaryKey = 'ID_Visita';
    public $timestamps = false;

    protected $fillable = [
        'No_Visita',
        'Empresa',
        'Materia',
        'Grupo',
        'Fecha_Visita',
        'Convenio(SI/NO)',
        'ID_Matricula',
        'ID_Convenio',
    ];

    protected $casts = [
        'Fecha_Visita' => 'date',
        'ID_Matricula' => 'integer',
        'ID_Convenio' => 'integer',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'ID_Matricula', 'ID_VS');
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'ID_Convenio', 'ID_Convenio');
    }
}
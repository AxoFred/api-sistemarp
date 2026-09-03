<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $table = 'convenios';

    protected $primaryKey = 'ID_Convenio';

    public $timestamps = false;

    protected $fillable = [
        'Anio',
        'Empresa_organismo_institucion_dependencia',
        'Objetivo_convenio',
        'Area_seguimiento',
        'Nombre_celebra_convenio',
        'Primer_apellido_celebra_convenio',
        'Segundo_apellido_celebra_convenio',
        'Tipo',
        'Pertenece_tecnm',
        'Nacional_Internacional',
        'Sector',
        'Fecha_firma_convenio',
        'Fecha_inicio_convenio',
        'Vigencia_convenio',
        'Fecha_termina',
        'Estatus',
        'Con_eficiencia',
    ];

    protected $casts = [
        'Anio' => 'integer',
        'Fecha_firma_convenio' => 'date',
        'Fecha_inicio_convenio' => 'date',
        'Fecha_termina' => 'date',
    ];
}
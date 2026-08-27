<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioSocial extends Model
{
    protected $table = 'servicio_social';

    protected $primaryKey = 'ID_SS';

    public $timestamps = false;

    protected $fillable = [
        'No_Control',
        'Nombre',
        'Apaterno',
        'Amaterno',
        'Sexo',
        'Semestre',
        'ID_Carrera',
        'Sector',
        'Dependencia',
        'Area_Departamento',
        'Municipio_Comunidad',
        'Convenio',
        'Programa',
        'Actividades_Problemas',
        'Actividades_Inclusion_Igualdad',
        'No_Personas_Beneficiadas_SS_Reporte_1',
        'No_Personas_Beneficiadas_SS_Reporte_2',
        'No_Personas_Beneficiadas_SS_Reporte_3',
        'No_Personas_Beneficiadas_SS_Acumulados_Periodo',
        'Evaluacion_SS',
        'Situacion',
    ];

    protected $casts = [
        'ID_SS' => 'integer',
        'Semestre' => 'integer',
        'ID_Carrera' => 'integer',
        'No_Personas_Beneficiadas_SS_Reporte_1' => 'integer',
        'No_Personas_Beneficiadas_SS_Reporte_2' => 'integer',
        'No_Personas_Beneficiadas_SS_Reporte_3' => 'integer',
        'No_Personas_Beneficiadas_SS_Acumulados_Periodo' => 'integer',
    ];

    public function carrera()
    {
        return $this->belongsTo(
            Carrera::class,
            'ID_Carrera',
            'ID_Carrera'
        );
    }
}
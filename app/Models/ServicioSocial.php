<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioSocial extends Model
{
    protected $table = 'servicio_social';

    protected $primaryKey = 'ID_SS';

    public $timestamps = false;

    protected $fillable = [
        'Sector',
        'Dependencia',
        'Area/Departamento',
        'Municipio/Comunidad',
        'Convenio(si/no)',
        'Programa',
        'Actividades_Problemas',
        'Actividades_Inclusion_Igualdad',
        'No_Personas_Beneficiadas_SS_Reporte_1',
        'No_Personas_Beneficiadas_SS_Reporte_2',
        'No_Personas_Beneficiadas_SS_Reporte_3',
        'No_Personas_Beneficiadas_SS_Acumulados_Periodo',
        'Evalucion_SS',
        'Situacion',
        'ID_Matricula',
        'ID_Convenio',
    ];

    protected $casts = [
        'No_Personas_Beneficiadas_SS_Reporte_1' => 'integer',
        'No_Personas_Beneficiadas_SS_Reporte_2' => 'integer',
        'No_Personas_Beneficiadas_SS_Reporte_3' => 'integer',
        'No_Personas_Beneficiadas_SS_Acumulados_Periodo' => 'integer',
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
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residencia extends Model
{
    protected $table = 'residencias';
    protected $primaryKey = 'ID_Residencia';
    public $timestamps = false;

    protected $fillable = [
        'Dependencia',
        'Sector',
        'Convenio(si/no)',
        'ID_Matricula',
        'ID_Convenio',
    ];

    protected $casts = [
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
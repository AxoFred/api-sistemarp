<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educando extends Model
{
    protected $table = 'educandos';
    protected $primaryKey = 'ID_Educando';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Sexo',
        'Lvl_Estudio_Cursando',
        'ID_Lvl',
    ];

    protected $casts = [
        'ID_Lvl' => 'integer',
    ];

    public function nivelEducando()
    {
        return $this->belongsTo(NivelEducando::class, 'ID_Lvl', 'ID_Lvl');
    }

    public function alfabetizaciones()
    {
        return $this->hasMany(Alfabetizatec::class, 'ID_Educando', 'ID_Educando');
    }
}
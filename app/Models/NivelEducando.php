<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelEducando extends Model
{
    protected $table = 'niveles_educando';
    protected $primaryKey = 'ID_Lvl';
    public $timestamps = false;

    protected $fillable = [
        'Nivel',
    ];

    public function educandos()
    {
        return $this->hasMany(Educando::class, 'ID_Lvl', 'ID_Lvl');
    }

    public function alfabetizaciones()
    {
        return $this->hasMany(Alfabetizatec::class, 'ID_Lvl', 'ID_Lvl');
    }
}
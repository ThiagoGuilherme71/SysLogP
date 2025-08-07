<?php

namespace App\Models;

use Semge\Laravel\BaseModel;

class SistemaPerfilChristi extends BaseModel
{
//    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'sistema_perfil';
    protected $connection = 'mysql';
    public $timestamps = false;
    protected $fillable = ['id_sistema', 'id_perfil'];


    public function getFillable()
    {
        return $this->fillable;
    }

    public function sistema()
    {
        return $this->belongsTo('App\Models\SistemaChristi', 'id_sistema');
    }

    public function perfil()
    {
        return $this->belongsTo('App\Models\PerfilChristi', 'id_perfil');
    }
}

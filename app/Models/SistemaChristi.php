<?php

namespace App\Models;

use Semge\Laravel\BaseModel;

class SistemaChristi extends BaseModel
{
//    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'sistema';
    protected $connection = 'mysql';
    public $timestamps = false;
    protected $fillable = ['cod_name','descricao'];


    public function getFillable()
    {
        return $this->fillable;
    }
}

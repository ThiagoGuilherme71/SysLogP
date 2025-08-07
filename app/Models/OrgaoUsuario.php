<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgaoUsuario extends Model
{
//    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'orgao';
    // public $timestamps = false;

    protected $fillable = [
        'sigla',
        'descricao',
        'status',
    ];

    protected $dates = [
        'data_criacao',
        'data_atualizacao'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Semge\Audit\Models\Auditoria as Audit;

class Auditoria extends Audit
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public $timestamps 	= false;
    protected $table 	= 'auditoria';
    protected $fillable = [
        'id_usuario', 
        'nome_usuario', 
        'id_registro', 
        'acao', 
        'atributo', 
        'valor_antigo', 
        'valor_novo', 
        'nome_tabela', 
        'ip', 
        'data_hora'
    ];

    // protected $hidden = [
    // ];

    // protected $casts = [
    // ];
}

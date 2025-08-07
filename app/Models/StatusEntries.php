<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusEntries extends Model
{
    use HasFactory;
    protected $connection = 'oracle';
    protected $table = 'status_entries';

    protected $fillable = [
        'descricao',
    ];
}

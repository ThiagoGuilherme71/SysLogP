<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelescopeEntries extends Model
{
    use HasFactory;
    protected $connection = 'oracle';
    protected $table = 'telescope_entries';
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'content',
        'id_status_entries',
        'responsavel',
         'created_at'
    ];
    const UPDATED_AT = null;
}

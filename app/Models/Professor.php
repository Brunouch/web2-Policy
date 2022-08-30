<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome', 'email', 'siape', 'eixo_id', 'ativo' ];

    public function eixo(){
        return $this->belongsTo('\App\Models\Eixo');
    }
}
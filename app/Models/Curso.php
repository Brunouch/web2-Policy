<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'sigla', 'tempo', 'eixo_id'];

    public function eixo() {
        return $this->belongsTo('\App\Models\Eixo');
    }

    public function professor(){
        return $this->hasMany('App\Models\Professor');
    }

    public function aluno(){
        return $this->hasMany('App\Model\Aluno');
    }
}
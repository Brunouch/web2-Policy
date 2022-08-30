<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome', 'curso_id'];

    public function curso(){
        return $this->belongsTo('App\Models\Curso');
    }

    public function disciplina(){
        return $this->belongsToMany('App\Models\Disciplina', 'matriculas');
    }
}

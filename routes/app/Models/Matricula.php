<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = ['disciplina_id', 'aluno_id'];

    public function disciplina() {
        return $this->belongsTo('App\Models\Disciplina');
    }

    public function aluno() {
        return $this->belongsTo('App\Models\Aluno');
    }


}

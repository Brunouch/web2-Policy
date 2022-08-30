<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome', 'curso_id', 'carga'];

    public function curso() {
        return $this->belongsTo('\App\Models\Curso');
    }
}
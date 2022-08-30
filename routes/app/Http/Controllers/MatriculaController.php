<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Matricula;
use App\Facades\UserPermission;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function store(Request $request)
    {


        $aluno = Aluno::find($request->aluno);

        Matricula::where('aluno_id', $request->aluno)->delete();



        if (isset($request->disciplina)) {
            for ($i = 0; $i < count($request->disciplina); $i++) {

                $matricula = new Matricula;

                $matricula->aluno_id = $request->aluno;
                $matricula->disciplina_id = $request->disciplina[$i];
                $matricula->save();
            }
        }
        return redirect()->route('alunos.index');
    }
}

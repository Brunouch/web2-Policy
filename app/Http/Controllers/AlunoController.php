<?php

namespace App\Http\Controllers;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Disciplina;
use App\Facades\UserPermission;

use Illuminate\Http\Request;

class AlunoController extends Controller
{


    public function __construct()
    {
        $this->authorizeResource(Aluno::class, 'aluno');
    }
    
    public function index()
    {
        $this->authorize('viewAny',  Aluno::class);

        $data = Aluno::with(['curso'])->get();

        return view('alunos.index', compact(['data']));
    }


    public function create()
    {

        $this->authorize('create',  Aluno::class);

        $curso = Curso::orderBy('nome')->get();
        return view('alunos.create', compact(['curso']));
    }

   
    public function store(Request $request)
    {

        $this->authorize('create',  Aluno::class);

        $rules = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        if (!UserPermission::isAuthorized('alunos.destroy')) {
            return response()->view('templates.restrito');
        }
        $request->validate($rules, $msgs);

        $curso = Curso::find($request->curso_id);

        if (isset($curso)) {
            

            $obj = new Aluno();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->curso()->associate($curso);

            $obj->save();

            return redirect()->route('alunos.index');
        }
    }
    public function show(Aluno $aluno)
    {
        $this->authorize('view', $aluno);

        $aluno = Aluno::find($id);

        $disc = Disciplina::where('curso_id', $aluno->curso_id)->get();

        $mat = Matricula::where('aluno_id', $id)->get();

        return view('matriculas.index', compact('aluno', 'disc', 'mat'));
    }

    
    public function edit(Aluno $aluno)
    {
        $this->authorize('update', $aluno);


        $curso = Curso::orderBy('nome')->get();
    
            return view('alunos.edit', compact(['aluno', 'curso']));

    }


    
    public function update(Request $request, Aluno $aluno)
    {

        $this->authorize('update', $aluno);

        if(!isset($aluno)) { return "<h1>Aluno: $aluno->nome não encontrado!"; }

        $regras = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!"
        ];

        $request->validate($regras, $msgs);

        $obj_curso = Curso::find($request->curso_id);

        $obj->nome =  mb_strtoupper($request->nome, 'UTF-8');

        $obj->curso()->associate($obj_curso);

        $obj->save();

        return redirect()->route('alunos.index');
        }
    

   
    public function destroy(Aluno $aluno)
    {
        $this->authorize('delete', $aluno);

        if (isset($obj)) {
            $obj->destroy(($aluno));
        } 

        return redirect()->route('alunos.index');
    }
}

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
 
    public function index()
    {   
        if (!UserPermission::isAuthorized('alunos.index')) {
            return response()->view('templates.restrito');
        }
        $data = Aluno::with(['curso'])->get();

        return view('alunos.index', compact(['data']));
    }


    public function create()
    {
        if (!UserPermission::isAuthorized('alunos.create')) {
            return response()->view('templates.restrito');
        }

        $curso = Curso::orderBy('nome')->get();
        return view('alunos.create', compact(['curso']));
    }

   
    public function store(Request $request)
    {

        $rules = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

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
    public function show($id)
    {
        $aluno = Aluno::find($id);

        $disc = Disciplina::where('curso_id', $aluno->curso_id)->get();

        $mat = Matricula::where('aluno_id', $id)->get();

        return view('matriculas.index', compact('aluno', 'disc', 'mat'));
    }

    
    public function edit($id)
    {
        if (!UserPermission::isAuthorized('alunos.edit')) {
            return response()->view('templates.restrito');
        }

        $curso = Curso::orderBy('nome')->get();
        $data = Aluno::find($id);


        if (isset($data)) {
            return view('alunos.edit', compact(['data', 'curso']));
        }
    }


    
    public function update(Request $request, $id)
    {
        $obj = Aluno::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

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
    

   
    public function destroy($id)
    {   if(!UserPermission::isAuthorized('alunos.destroy')) {
        return response()->view('templates.restrito');
    }
        $obj = Aluno::find($id);

        if (isset($obj)) {
            $obj->destroy(($id));
        } 

        return redirect()->route('alunos.index');
    }
}

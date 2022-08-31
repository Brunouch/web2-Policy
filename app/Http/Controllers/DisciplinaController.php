<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Eixo;
use App\Facades\UserPermission;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class DisciplinaController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Disciplina::class, 'disciplina');
    }
    public function index()
    {
        $this->authorize('viewAny',  Disciplina::class);

        $data = Disciplina::with(['curso'])->orderby('nome')->get();

        return view('disciplinas.index', compact(['data']));
    }


    public function create()
    {

        $this->authorize('create', Disciplina::class);

        $curso = Curso::orderby('nome')->get();

        return view('disciplinas.create', compact(['curso']));
    }


    public function store(Request $request)
    {
        $this->authorize('create',  Disciplina::class);

        $regras = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required',
            'carga' => 'required|max:12|min:1'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um Veterinário cadastrado com esse [:attribute]!"
        ];

        //$request->validate($regras, $msgs);

        
        if (isset($disciplina)) {
            $disciplina = new Disciplina();
            $disciplina->nome = mb_strtoupper($request->nome, 'UTF-8');
            $disciplina->carga = $request->carga;
            $disciplina->curso()->associate($curso);
            $disciplina->save();

            return redirect()->route('disciplinas.index');
        }
    }

    public function edit(Disciplina $disciplina)
    {

        $this->authorize('update', $disciplina);

       
        $curso = Curso::orderby('nome')->get();

        if (isset($disciplina)) {
            return view('disciplinas.edit', compact(['disciplina', 'curso']));
        } else {
            $msg = "Disciplina";
            $link = "disciplinas.index";
            return view('erros.id', compact(['msg', 'link']));
        }
    }

    public function update(Request $request, Disciplina $disciplina)
    {
       

        $this->authorize('update', $disciplina);

        if (!isset($disciplina)) {
            return "<h1>Disciplina não encontrado!</h1>";
        }

        if ($request->id == $disciplina->id) {
            $regras = [
                'nome' => 'required|max:100|min:10',
                'curso_id' => 'required',
                'carga' => 'required|max:12|min:1'
            ];
        } else {
            $regras = [
                'nome' => 'required|max:100|min:10',
                'curso_id' => 'required',
                'carga' => 'required|max:12|min:1'
            ];
        }

        $msgs = [
            "required" => "O preenchimento do campo Especialidade é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um Curso cadastrado com esse [:attribute]!"
        ];

        //$request->validate($regras, $msgs);

        $curso = Curso::find($request->curso);
        

        if (isset($disciplina) && isset($curso)) {
            $disciplina->nome = mb_strtoupper($request->nome, 'UTF-8');
            $disciplina->carga = $request->carga;
            $disciplina->curso()->associate($curso);

            $disciplina->save();

            return redirect()->route('disciplinas.index');
        }
    }

    public function destroy(Disciplina $disciplina)
    {
        $this->authorize('delete', $disciplina);

        

        if (isset($disciplina)) {
            $disciplina->delete();
        }



        return redirect()->route('disciplinas.index');
    }
}

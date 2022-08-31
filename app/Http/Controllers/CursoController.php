<?php

namespace App\Http\Controllers;
use App\Facades\UserPermission;
use App\Models\Curso;
use App\Models\Eixo;


use Illuminate\Http\Request;



class CursoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Curso::class, 'curso');
    }
  

    public function index()
    {
        
        $this->authorize('viewAny',  Curso::class);
        $data = Curso::all();

        return view('cursos.index', compact('data'));
    }

    public function create()
    {

        $this->authorize('create',  Curso::class);

        $eixo = Eixo::orderby('nome')->get();

        return view('cursos.create', compact(['eixo']));
    }

   
    public function store(Request $request)
    {
        $this->authorize('create',  Curso::class);

        $regras = [
            'nome' => 'required|max:50|min:10|unique:cursos',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1',
            'eixo_id' => 'required'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um Curso cadastrado com esse [:attribute]!"
        ];


        //$request->validate($regras, $msgs);


        Curso::create([
            
            'nome' => mb_strtoupper($request->nome, 'UTF8'),
            'sigla' => mb_strtoupper($request->sigla, 'UTF8'),
            'tempo' => $request->tempo,
            'eixo_id' => $request->eixo,
        ]);

        return redirect()->route('cursos.index');
    }

    public function edit(Curso $curso)
    {
        $this->authorize('update', $curso);

       
        $eixo = Eixo::orderby('nome')->get();

        if (!isset($curso)) {
            return "<h1>Curso não encontrado!</h1>";
        }
        return view('cursos.edit', compact(['curso', 'eixo']));
    }

    public function update(Request $request, Curso $curso)
    {
        $this->authorize('update', $curso);

        
        if (!isset($curso)) {
            return "<h1>Curso não encontrado!</h1>";
        }

        if ($request->id == $curso->id) {
            $regras = [
                'nome' => 'required|max:50|min:10',
                'sigla' => 'required|max:8|min:2',
                'tempo' => 'required|max:2|min:1',
                'eixo' => 'required'
            ];
        }else{
            $regras = [
                'nome' => 'required|max:50|min:10',
                'sigla' => 'required|max:8|min:2',
                'tempo' => 'required|max:2|min:1',
                'eixo' => 'required'
            ];
        }

        $msgs = [
            "required" => "O preenchimento do campo Especialidade é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um Curso cadastrado com esse [:attribute]!"
        ];

        $request->validate($regras, $msgs);

        $eixo = Eixo::find($request->eixo);
        if (isset($eixo) && isset($obj)) {
            $curso->nome = mb_strtoupper($request->nome, 'UTF-8');
            $curso->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $curso->tempo = $request->tempo;
            $curso->eixo()->associate($eixo);
            $curso->save();
            return redirect()->route('cursos.index');
        }

        $msg = "Curso ou Eixo/Área";
        $link = "cursos.index";

        return view('erros.id', compact(['msg', 'link']));
    }

    public function destroy(Curso $curso)
    {
        $this->authorize('delete', $curso);


        if (isset($curso)) {
            $curso->delete();
        } else {
            $msg = "Curso";
            $link = "cursos.index";
            return view('erros.id', compact(['msg', 'link']));
        }

        return redirect()->route('cursos.index');
    
    }
}

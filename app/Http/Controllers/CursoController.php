<?php

namespace App\Http\Controllers;
use App\Facades\UserPermission;
use App\Models\Curso;
use App\Models\Eixo;


use Illuminate\Http\Request;



class CursoController extends Controller
{
    
    public function index()
    {
        if(!UserPermission::isAuthorized('cursos.index')) {
            return response()->view('templates.restrito');
        }

        $data = Curso::all();

        return view('cursos.index', compact('data'));
    }

    public function create()
    {
        if(!UserPermission::isAuthorized('cursos.create')) {
            return response()->view('templates.restrito');
        }

        $eixo = Eixo::orderby('nome')->get();

        return view('cursos.create', compact(['eixo']));
    }

   
    public function store(Request $request)
    {

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

    public function edit($id)
    {
        
        $data = Curso::find($id);
        $eixo = Eixo::orderby('nome')->get();

        if (!isset($data)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }
        return view('cursos.edit', compact(['data', 'eixo']));
    }

    public function update(Request $request, $id)
    {
        
        $obj = Curso::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        if ($request->id == $obj->id) {
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
        $obj = Curso::find($id);
        if (isset($eixo) && isset($obj)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $obj->tempo = $request->tempo;
            $obj->eixo()->associate($eixo);
            $obj->save();
            return redirect()->route('cursos.index');
        }

        $msg = "Curso ou Eixo/Área";
        $link = "cursos.index";

        return view('erros.id', compact(['msg', 'link']));
    }

    public function destroy($id)
    {
        if(!UserPermission::isAuthorized('cursos.destroy')) {
            return response()->view('templates.restrito');
        }

        $obj = Curso::find($id);

        if (isset($obj)) {
            $obj->delete();
        } else {
            $msg = "Curso";
            $link = "cursos.index";
            return view('erros.id', compact(['msg', 'link']));
        }

        return redirect()->route('cursos.index');
    
    }
}

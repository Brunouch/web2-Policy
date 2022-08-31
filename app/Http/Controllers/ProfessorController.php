<?php

namespace App\Http\Controllers;

use App\Facades\UserPermission;
use App\Models\Professor;
use App\Models\Eixo;
use App\Models\Docencia;


use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Professor::class, 'professore');
    }

    public function index()
    {
        $this->authorize('viewAny',  Professor::class);

        $data = Professor::with(['eixo'])->get();

        return view('professores.index', compact(['data']));
    }


    public function create()
    {
        $this->authorize('create',  Professor::class);

        $eixo = Eixo::orderBy('nome')->get();
        return view('professores.create', compact(['eixo']));
    }


    public function store(Request $request)
    {
        $this->authorize('create',  Professor::class);

        $rules = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15|unique:professors',
            'siape' => 'required|max:10|min:8',
            'eixo' => 'required',
            'radio' => 'required',

        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "O campo [:attribute] pode ter apenas um único registro!"
        ];

        $request->validate($rules, $msgs);

        $eixo = Eixo::find($request->eixo);

        if (isset($eixo)) {

            $obj = new Professor();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->siape = $request->siape;
            $obj->ativo = $request->radio;
            $obj->eixo()->associate($eixo);

            $obj->save();

            return redirect()->route('professores.index');
        }
    }

    
    public function edit(Professor $professore)
    {
        $this->authorize('update', $professore);

        $eixo = Eixo::orderBy('nome')->get();
       


        if (isset($professor)) {
            return view('professores.edit', compact(['professore', 'eixo']));
        }
    }

    public function update(Request $request, Professor $professore)
    {
        $this->authorize('update', $professore);
        
        $rules = [
            'nome' => 'required|max:100|min:5',
            'email' => 'required',
            'siape' => 'required',
            'radio' => 'required',
            'eixo' => 'required',

        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($rules, $msgs);

        $eixo = Eixo::find($request->eixo);
      

        if (isset($eixo) && isset($professore)) {

            $professore->nome = mb_strtoupper($request->nome, 'UTF-8');
            $professore->email = mb_strtolower($request->email, 'UTF-8');
            $professore->siape = $request->siape;
            $professore->ativo = $request->radio;
            $professore->eixo()->associate($eixo);
            $professore->save();


            return redirect()->route('professores.index');
        }
    }

   
    public function destroy(Professor $professore)
    {
        $this->authorize('delete', $professore);

        

        if (isset($professore)) {
            $professore->delete();
        } else {
            $msg = "Professor";
            $link = "professores.index";
            return view('erros.id', compact(['msg', 'link']));
        }

        return redirect()->route('professores.index');
    }
}

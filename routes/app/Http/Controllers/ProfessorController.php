<?php

namespace App\Http\Controllers;

use App\Facades\UserPermission;
use App\Models\Professor;
use App\Models\Eixo;
use App\Models\Docencia;


use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    
    public function index()
    {
        if(!UserPermission::isAuthorized('professores.index')) {
            return response()->view('templates.restrito');
        }
        $data = Professor::with(['eixo'])->get();

        return view('professores.index', compact(['data']));
    }


    public function create()
    {   
        if(!UserPermission::isAuthorized('professores.create')) {
            abort(403);
        }
        $eixo = Eixo::orderBy('nome')->get();
        return view('professores.create', compact(['eixo']));
    }


    public function store(Request $request)
    {
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

    
    public function edit($id)
    {
        if(!UserPermission::isAuthorized('professores.edit')) {
            return response()->view('templates.restrito');
        }
        $eixo = Eixo::orderBy('nome')->get();
        $data = Professor::with(['eixo' => function ($q) {
            $q->withTrashed();
        }])->find($id);


        if (isset($data)) {
            return view('professores.edit', compact(['data', 'eixo']));
        }
    }

    public function update(Request $request, $id)
    {
        
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
        $obj_prof = Professor::find($id);

        if (isset($eixo) && isset($obj_prof)) {

            $obj_prof->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_prof->email = mb_strtolower($request->email, 'UTF-8');
            $obj_prof->siape = $request->siape;
            $obj_prof->ativo = $request->radio;
            $obj_prof->eixo()->associate($eixo);
            $obj_prof->save();


            return redirect()->route('professores.index');
        }
    }

   
    public function destroy($id)
    {
        if(!UserPermission::isAuthorized('professores.destroy')) {
            return response()->view('templates.restrito');
        }
        $obj = Professor::find($id);

        if (isset($obj)) {
            $obj->delete();
        } else {
            $msg = "Professor";
            $link = "professores.index";
            return view('erros.id', compact(['msg', 'link']));
        }

        return redirect()->route('professores.index');
    }
}

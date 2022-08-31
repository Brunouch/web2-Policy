<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;
use App\Facades\UserPermission;

class EixoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Eixo::class, 'eixo');
    }
    
    public function index()
    {

        $this->authorize('viewAny',  Eixo::class);

        $data = Eixo::orderby('nome')->get();

        return view('eixos.index', compact(['data']));
    }

    
    public function create()
    {
        $this->authorize('create',  Eixo::class);

        return view('eixos.create');
    }

   
    public function store(Request $request)
    {
        $this->authorize('create',  Eixo::class);

        $regras = [
            'nome' => 'required|max:100|min:10',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um Eixo cadastrado com esse [:attribute]!"
        ];

        $request->validate($regras, $msgs);

        Eixo::create([

            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
        ]);

        return redirect()->route('eixos.index');
    }

    public function edit(Eixo $eixo)
    {

        $this->authorize('update', $eixo);

        

        if(!isset($eixo)){
            return "<h1>Eixo não encontrado!</h1>";
        }

        return view('eixos.edit', compact(['eixo']));
    }

  
    public function update(Request $request, Eixo $eixo)
    {

        $this->authorize('update', $eixo);

        

        $regras = [
            'nome' => 'required|max:100|min:10'
        ];

       if (!isset($eixo)) {
            return "<h1>Eixo não encontrado!</h1>";
        }

        if (trim($request->nome) == trim($eixo->nome)) {
            $regras = [
                'nome' => 'required|max:100|min:10'
            ]; 
        } 

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um Cliente cadastrado com esse [:attribute]!"
        ];

        $request->validate($regras, $msgs);

       
        
        if (isset($eixo)) {
            $eixo->nome = mb_strtoupper($request->nome, 'UTF-8');
            $eixo->save();
        }

       

        return redirect()->route('eixos.index');
    }

    
    public function destroy(Eixo $eixo)
    {
        $this->authorize('delete', $eixo);

       

        
        if (isset($eixo)) {
            $eixo->delete();
        }

        return redirect()->route('eixos.index');
    }
}

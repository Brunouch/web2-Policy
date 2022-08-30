<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Docencia;
use App\Facades\UserPermission;


use Illuminate\Http\Request;

class DocenciaController extends Controller
{
    
    public function index()
    {
        $curso  = Curso::with(['eixo']);

        $disciplina = Disciplina::all();
        $prof = Professor::orderBy('id')->get();
        
        return view('docencias.index', compact(['prof', 'disciplina', 'curso']));
    }

    
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $rules = [
            'PROFESSOR_ID_SELECTED' => 'required',
            'DISCIPLINA' => 'required',

        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($rules, $msgs);

            $doc = new Docencia();
            $doc->professor_id = $request->PROFESSOR_ID_SELECTED['0'];
            $doc->disciplina_id = $request->DISCIPLINA;
            $doc->save();
        

        return redirect()->route('disciplinas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

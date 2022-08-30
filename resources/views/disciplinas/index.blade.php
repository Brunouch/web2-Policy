<!-- Herda o layout padrão definido no template "main" -->
@extends('templates/middleware')<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') - Disciplinas @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

<div class="row">
    <div class="col">

        <!-- Utiliza o componente "datalist" criado -->
        <x-datalistDisciplina :header="[ 'NOME', 'CURSO', 'AÇÕES']" :data="$data" :hide="[ false, true, false]" />

    </div>
</div>
@endsection
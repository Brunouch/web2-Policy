<!-- Herda o layout padrão definido no template "main" -->
@extends('templates/middleware')
<!-- Preenche o conteúdo da seção "titulo" -->
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

<div class="row">
    <div class="col">

        <!-- Utiliza o componente "datalist" criado -->
        <x-datalistAluno :header="['NOME', 'CURSO', 'AÇÕES']" 
        :data="$data" 
        :hide="[ false, true, false]" />

    </div>

</div>
@endsection
<!-- Herda o layout padrão definido no template "main" -->
@extends('templates/middleware')
<!-- Preenche o conteúdo da seção "titulo" -->
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

<div class="row">
    <div class="col">

        <!-- Utiliza o componente "datalist" criado -->
        <x-datalistEixo :header="['NOME', 'AÇÕES']" :data="$data" :hide="[ false, false]" />

    </div>

</div>
@endsection
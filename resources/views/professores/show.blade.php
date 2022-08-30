@extends('templates/middleware')

@section('conteudo')
<div class="row">
    <div class="col">
        <h3 class="display-7 text-secondary d-none d-md-block"><b>Professor/Disciplinas</b></h3>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table align-middle caption-top  table-dark table-striped">
            <caption>Tabela de <b>Disciplinas</b></caption>
            <thead>
                <tr class="header-table">
                    <th scope="col" class="d-none d-md-table-cell">Disciplina</th>
                    <th scope="col" class="d-none d-md-table-cell">Curso</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doc as $item)
                <tr>
                    <td>{{$item->disciplina->nome}}</td>
                    <td>{{$item->disciplina->curso->nome}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col">
            <a href="{{route('professores.index')}}" class="btn btn-dark btn-block align-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                </svg>
                &nbsp; Voltar
            </a>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Listado de Resultados por Cuestionarios
        </h3>
    </div>
    <input class="form-control col-4 m light-table-filter mb-4"
           data-table="order-table"
           type="text"
           placeholder="Buscador general">
    <a href="{{route('export')}}" CLASS="btn btn-success">Generar Excel
        <i class="fas fa-file-excel"></i></a>
    <hr>
    <table class="table table-striped table-bordered
    table-hover shadow rounded  sortable order-table">
        <thead>
        <tr>
            <th scope="col">Nombre del Cuestionario</th>
            <th scope="col">Ver participantes</th>
        </tr>
        </thead>
        <tbody>
        @forelse($result as $r)
            <tr>
                <td><h3>{{$r->questionnaire->name}}</h3></td>
                <td><a class="btn btn-primary mb-2 text-light"
                   href="{{route('result.questionnaire.find',$r->questionnaire->id)}}">
                    Ver</a>
                </td>
            </tr>
        @empty
            <p>No se encontraron resultados</p>
            @endforelse
        </tbody>
    </table>
    {{ $result->links() }}
@endsection

<title>Resultados | Intranet Casanare</title>
@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
      Listado de Resultados por Cuestionario
        </h3>
    </div>
    <input class="form-control col-4 m light-table-filter mb-4"
           data-table="order-table"
           type="text"
           placeholder="Buscador general">
    <table class="table table-striped
     table-hover
     table-bordered shadow rounded  sortable order-table">
        <thead>
        <tr>
            <th scope="col">Nombre del Cuestionario Realizado</th>
            <th scope="col">Respondido</th>
            <th scope="col">Acciones</th>

        </tr>
        </thead>
        <tbody>
    @forelse($result as $res)
        <tr>
            <td>{{$res->questionnaire->name}}</td>
            <td><small>
              {{$res->repetition->created_at->diffForHumans(null, false, false,3) }}
                </small>
            </td>
          <td> <a href="{{route('resultDetails', ['idquestionnaire'=>$res->questionnaire_id,
               'idrepetition'=>$res->repetition_id])}}"
               class="btn btn-primary text-light" role="button">Detalles</a>
          </td>
        </tr>

    @empty
        <p>No se encontraron resultados</p>
            @endforelse
        </tbody>
    </table>
    {{ $result->links() }}


@endsection

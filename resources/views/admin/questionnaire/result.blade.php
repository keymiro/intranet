@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Listado de Resultados por Evaluados
        </h3>
    </div>
    <input class="form-control col-4 m light-table-filter mb-4"
           data-table="order-table"
           type="text"
           placeholder="Buscador general">
    <table class="table table-striped table-bordered table-hover
 sortable order-table">
        <thead>
        <tr>
            <th scope="col">Nombre del Cuestionario</th>
            <th>Nombres del Evaluado</th>
            <th>Apellidos del Evaluado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
    @forelse($result as $r)
        <tr>
            <td> <h3>{{$r->questionnaire->name}}</h3> </td>
            <td>{{$r->user->people->names}}</td>
            <td>{{$r->user->people->lastnames}}</td>
            <td><a href="{{route('result.questionnaire.find.peoples',
                ['questionnaire_id'=>$r->questionnaire_id
                ,'user_id'=>$r->user_id])}}"
                class="btn btn-primary"
                style="border: none;" role="button">Detalles
                </a>
            </td>
        </tr>
          @empty
        <p>No se encontraron resultados</p>
    @endforelse
        </tbody>
    </table>
@endsection

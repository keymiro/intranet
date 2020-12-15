@section('title', $resultPeoplesQ[0]->questionnaire->name . ' | Intranet Casanare')
@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Resultados de {{$resultPeoplesQ[0]->questionnaire->name}}
            Por número de intentos
        </h3>
    </div>
    <input class="form-control col-4 m light-table-filter mb-4"
           data-table="order-table"
           type="text"
           placeholder="Buscador general">
    <table class="table table-striped
     table-hover
     table-bordered
 sortable order-table">
        <thead>
        <tr>
            <th scope="col">Nombres</th>
            <th scope="col">apellidos</th>
            <th scope="col">Puntaje</th>
            <th scope="col">Aprobo</th>
            <th scope="col">Intento Respondido</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($resultPeoplesQ as $rP)
            <tr>
                <td>{{$rP->user->people->names}}</td>
                <td>{{$rP->user->people->lastnames}}</td>
                <td>{{$rP->score}}</td>
                <td>@if ($rP->pass =='1')
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td>
                    {{$rP->repetition->created_at->diffForHumans(null, false, false,3)}}
                </td>
                <td><a  class="btn btn-primary" href="{{route('result.questionnaire.details.peoples',
                    ['questionnaire_id'=>$rP->questionnaire_id,
                    'user_id'=>$rP->user_id,
                    'repetition_id'=>$rP->repetition_id])}}">Detalles
                    </a>
                </td>
            </tr>
        @empty
            <p>No se encontraron resultados</p>
        @endforelse
        </tbody>
    </table>
    {{ $resultPeoplesQ->links() }}
@endsection

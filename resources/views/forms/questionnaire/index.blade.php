<title>Cuestionario | Intranet Casanare</title>
@extends('layouts.app')
@section('content')
    @include('partials.notification')
    <table class="table
    table-striped
    table-bordered
    table-hover mb-0
    shadow rounded
    mr-0">
        <thead>
        <tr>
            <th scope="col">Nombre del Cuestionario</th>
            <th scope="col">Duración</th>
            <th scope="col"># Intentos</th>
            <th scope="col">Publicado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
    @forelse($questionnaires as $questionnaire)
        <tr>
            <td><h3 class="text-dark">{{$questionnaire->name}}</h3></td>
            <td>{{$questionnaire->time}} Min</td>
            <td>{{$questionnaire->try}}</td>
            <td>{{$questionnaire->created_at->diffForHumans() }}</td>
            <td>
                @can('questionnaire_present_show')
                <a href="{{route('presentarq.show',$questionnaire)}}"
                   class="btn btn-success text-light">
                    Realizar
                </a>
                @endcan
            </td>
        </tr>
    @empty
        <p>No se encontraron cuestionarios</p>
    @endforelse
        </tbody>
    </table><br>
        {{ $questionnaires->links() }}
@endsection

<title>Cuestionarios | Intranet Casanare</title>
@extends('layouts.app')
@section('content')

    @can('questionnaire_result_index')
        <div class="col-xs-4">
                        <a class="btn btn-primary mb-2 text-light"
                   href="{{route('list.result.questionnaire')}}">
                    Resultados Cuestionarios</a>
        </div>
        <hr>
    @endcan

    <form action="{{route('questionario.store')}}" method="POST">
        @csrf
        <label for="name">Nuevo Cuestionario: </label>
        <div class="row">
            <div class="col-sm-5">
                <input type="text" class="form-control"
                       name="name" id="name"
                       placeholder="Nombre del nuevo cuestionario"
                       required>
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control"
                       name="try" id="try"
                       placeholder="Intentos"
                       required>
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control"
                       name="time" id="time"
                       placeholder="Tiempo en minutos"
                       required>
            </div>
            <div class="col-2">
                <button class="btn btn-success mb-2">Crear</button>
            </div>
        </div>
    </form>

    @forelse($questionnaires as $questionnaire )
        <div class="card shadow-sm rounded  ">
            <div class="card-body">
                <div class="row">
                        <div class="mr-lg-auto m-3">
                            <h3 class="text-dark">{{$questionnaire->name}}</h3>
                            <small>{{$questionnaire->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="mr-auto">
                            Intentos<p>{{$questionnaire->try}}</p>
                        </div>
                        <div class="mr-auto">
                             <span >
                                @if($questionnaire->active==1)
                                     Estado:  <p class="badge badge-success">
                                        {{'Activo'}}</p>
                                 @else
                                     Estado:  <p class="badge badge-danger">{{'Inactivo'}}</p>
                                 @endif
                            </span>
                        </div>
                        <div class="mr-auto">
                            <p><i class="fas fa-stopwatch text-primary "></i>
                                {{$questionnaire->time}} Min
                            </p>
                        </div>
                        <div class="mr-auto">
                            <a href="{{route('questionario.edit',$questionnaire)}}"
                               class="btn btn-success text-light ">
                                <i class="fas fa-edit"></i>
                            </a>
                            @can('question_show')
                                <a href="{{route('preguntas.show',$questionnaire->id)}}"
                                   class="btn btn-primary text-light ">
                                   Preguntas
                                </a>
                            @endcan
                            <form   action="{{route('questionario.destroy',$questionnaire->id)}}"
                                        method="post">
                                    @csrf @method('DELETE')
                                    <button  class="btn btn-danger mr-5">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                        </div>
                    </div>
            </div>
        </div>

        <br>
    @empty
        <p>No se encontraron questionarios</p>
    @endforelse
    {{ $questionnaires->links() }}

@endsection


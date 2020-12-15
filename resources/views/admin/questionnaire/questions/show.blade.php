@section('title', $questionnaire->name . ' | Intranet Casanare')
@extends('layouts.app')

@section('content')
    @include('admin.questionnaire.questions.create',
    array('questions'=>$questionnaire))
    <div class="container">
        <hr>
        <div class="card shadow rounded">
            <div class="card-body">
                @include('partials.notification')
                <div class="card-header bg-primary text-light
                 shadow rounded mb-4">
                    <h3> {{$questionnaire->name}}</h3>
                </div>
                @forelse($questions as $question)
                    <br>
                    <div class="card shadow rounded border-primary">
                        <div class="card-header bg-primary text-light">
                          <strong>Pregunta: </strong> {{$question->statement}}
                        </div>
                        <div class="card-body">
                            <form  action="{{route('preguntas.destroy',$question->id)}}"
                                    method="POST">
                                @csrf @method('DELETE')
                                <button  class="btn btn-danger float-right">
                                    Eliminar
                                </button>
                            </form>
                            <a href="{{route('preguntas.edit',$question)}}"
                               type="button"
                               class="btn btn-success text-light float-right mr-2">
                                Editar
                            </a>
                                <strong>Respuestas: </strong>

                                <p class="badge badge-info text-light">
                                    A
                                </p> {{$question->option_a}}

                                <p class="badge badge-info text-light">
                                    B
                                </p> {{$question->option_b}}

                                <p class="badge badge-info text-light">
                                    C
                                </p> {{$question->option_c}}
                                <p class="badge badge-info text-light">
                                    D
                                </p> {{$question->option_d}}
                                <br>
                                Respuesta correcta:
                                <p class="badge badge-success text-light">
                                    {{$question->correctoption->option}}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p>No se encontraron preguntas</p>
                    @endforelse
                <br>
                    {{ $questions->links() }}
            </div>
        </div>
    </div>
@endsection

@section('title', $questions->statement . ' | Intranet Casanare')
@extends('layouts.app')
@section('content')
<form method="post" action="{{route('preguntas.update',$questions->id)}}">
    @csrf @method('PATCH')
    @include('partials.notification')
    <div class="container " id="newquestion">
        <div class="card shadow rounded">
            <div class="card-body">
                <div class="card-header bg-primary
                text-light shadow rounded mb-4">
                    <div class="btn-group btn-group float-right" role="group" >
                        <a href="{{route('preguntas.show',$questions->questionnaire->id)}}"
                           type="button"
                           class="btn btn-info text-light">Listar Preguntas</a>
                    </div>
                    <h3>Actualizar pregunta</h3>

                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="">Enunciado</label>
                        <textarea type="text" class="form-control"
                                  name="statement">{{$questions->statement}}
                        </textarea>
                        <input type="hidden" name="idquestionnaire"
                               value="{{$questions->questionnaire->id}}" required>
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="a">respuesta A</label>
                        <input type="text" class="form-control"
                               name="option_a" id="a"
                               value="{{$questions->option_a}}" required>
                    </div>
                    <div class="col">
                        <label for="b">respuesta B</label>
                        <input type="text" class="form-control"
                               name="option_b"
                               id="b"
                               value="{{$questions->option_b}}" required>
                    </div>
                    <div class="col">
                        <label for="c">respuesta C</label>
                        <input type="text" class="form-control"
                               name="option_c"
                               id="c"
                               value="{{$questions->option_c}}" required>
                    </div>
                    <div class="col">
                        <label for="d">respuesta D</label>
                        <input type="text" class="form-control"
                               name="option_d"
                               id="d"
                               value="{{$questions->option_d}}" required>
                    </div>
                    <div class="col">
                        <label for="options">Respuesta correcta</label>
                        <select name="correctoption" id="options"
                                class="form-control" required>
                            <option
                                    value="{{$questions->correctoption->id}}">
                                 Actual: {{$questions->correctoption->option}}
                                </option>
                            @foreach( $correctoptions as  $CorrectOption)
                                <option value="{{$CorrectOption->id}}">
                                    {{$CorrectOption->option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-success">Actualizar</button>
            </div><!--card-body-->
        </div><!--card-->
    </div><!--container-->
</form>
@endsection

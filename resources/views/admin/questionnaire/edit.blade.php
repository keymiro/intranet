@section('title', $questionnaire->name . ' | Intranet Casanare')
@extends('layouts.app')
@section('content')
    <form action="{{route('questionario.update',$questionnaire->id)}}"
          method="POST">
        @csrf @method('PATCH')
        <label for="name">Actualizar questionario: </label>
        <div class="row">
            <div class="col-sm-4">
                <input type="text" class="form-control"
                       name="name" id="name"
                       placeholder="Nombre del nuevo cuestionario"
                       value="{{$questionnaire->name}}"
                       required>

            </div>
            <div class="col-sm-2">
                <select name="active" id="options"
                        class="form-control mb-1">
                    <option value="1">Activar</option>
                    <option value="0">Desactivar</option>
                </select>
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control"
                       name="try" id="try"
                       placeholder="Intentos"
                      value="{{$questionnaire->try}}"
                       required>
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control"
                       name="time" id="time"
                       placeholder="Tiempo en minutos"
                       value="{{$questionnaire->time}}"
                       required>
            </div>
            <div class="col-2">
                <button
                    class="btn btn-success mb-2">
                    Actualizar
                </button>
            </div>
        </div>
    </form>
@endsection

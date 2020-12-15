<div class="container mb-4">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#newquestion">
        <i class="fas fa-plus-circle"></i> Nueva pregunta
    </button>
    <a class="btn btn-primary" type="button" href="{{route('questionario.index')}}">
         Listar Cuestionarios
    </a>
</div>
<form method="post" action="{{route('preguntas.store')}}">
    @csrf
    <div class="container collapse" id="newquestion">
        <div class="card shadow rounded">
            <div class="card-body">
                <div class="card-header bg-primary text-light shadow rounded mb-4">
                    <h3>Nueva pregunta</h3>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="">Enunciado</label>
                        <input type="hidden" name="idquestionnaire"
                               value="{{$questionnaire->id}}">
                        <textarea type="text" class="form-control" name="statement" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="a">respuesta A</label>
                        <input type="text" class="form-control" name="option_a" id="a" required>
                    </div>
                    <div class="col">
                        <label for="b">respuesta B</label>
                        <input type="text" class="form-control" name="option_b" id="b" required>
                    </div>
                    <div class="col">
                        <label for="c">respuesta C</label>
                        <input type="text" class="form-control" name="option_c" id="c" required>
                    </div>
                    <div class="col">
                        <label for="d">respuesta D</label>
                        <input type="text" class="form-control" name="option_d" id="d" required>
                    </div>
                    <div class="col">
                        <label for="options">Respuesta correcta</label>
                        <select name="correctoption" id="options" class="form-control" required>
                            <option value="">Seleccione una opción</option>
                            @foreach( $correoptions as  $CorrectOption)
                                <option value="{{$CorrectOption->id}}" >
                                    {{$CorrectOption->option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-success">Crear</button>
            </div><!--card-body-->
        </div><!--card-->
    </div><!--container-->
</form>


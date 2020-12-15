@section('title', $questionnaire->name . ' | Intranet Casanare')

<script>
    window.onload = function(){

        const time = {!! json_encode($questionnaire->time) !!};
        var seconds = time*60; //número de segundos a contar
        function secondPassed() {

            var minutes = Math.round((seconds - 30)/60); //calcula el número de minutos
            var remainingSeconds = seconds % 60; //calcula los segundos
            //si los segundos usan sólo un dígito, añadimos un cero a la izq
            if (remainingSeconds < 10) {
                remainingSeconds = "0" + remainingSeconds;
            }
            document.getElementById('countdown').innerHTML = minutes + ":" +     remainingSeconds;
            if (seconds == 0) {
                clearInterval(countdownTimer);
                document.forms["questionnaire"].submit();
              /*  document.getElementById("id").submit();*/
                alert('Se acabó el tiempo');
            } else {
                seconds--;
            }
        }
        var countdownTimer = setInterval(secondPassed, 1000);
        alert('Tienes '+ {!! json_encode($questionnaire->time) !!} +' min para resolver el questionario')
    };
</script>
@extends('layouts.app')
@section('content')

    <div class="container">
        <hr>
        <form action="{{route('presentarq.store')}}" method="Post" name="questionnaire">
                @csrf

                        @include('partials.notification')
                        <div class="card-header bg-primary text-light
                     shadow rounded mb-4">
                            <div class="row">
                                <div class="col">
                                    <h3> {{$questionnaire->name}}
                                     </h3>
                                </div>
                                <div class="col">
                                   <h4 class="float-right ">
                                       Tiempo restante:
                                        <span id="countdown">
                                        </span>
                                       <i class="far fa-clock"></i>
                                   </h4>
                                </div>
                            </div>
                                <input type="hidden" name="questionnaire_id"
                                   value="{{$questionnaire->id}}">
                        </div>
                        @forelse($questions as $question)
                            <br>
                            <div class="card shadow rounded border-primary">
                                <div class="card-header bg-primary text-light ">
                                 <h4><strong>Pregunta: </strong> {{$question->statement}}</h4>
                                    <input type="hidden" name="question_id[]"
                                           value="{{$question->id}}">
                                </div>
                                <div class="card-body">
                                    <strong>Respuestas: </strong><br>
                                    <p class="badge badge-dark text-light">
                                        A
                                    </p> {{$question->option_a}}<br>
                                    <p class="badge badge-dark text-light">
                                        B
                                    </p> {{$question->option_b}}<br>

                                    <p class="badge badge-dark text-light">
                                        C
                                    </p> {{$question->option_c}}<br>
                                    <p class="badge badge-dark text-light">
                                        D
                                    </p> {{$question->option_d}}
                                    <br>
                                    <label for="options">Seleccione la respuesta correcta</label>
                                    <select name="correctoption_id[]" id="options" class="form-control">
                                        <option value="">Seleccione una opción</option>
                                        @foreach( $correoptions as  $CorrectOption)
                                            <option value="{{$CorrectOption->id}}">
                                                {{$CorrectOption->option}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        @empty
                            <h3>Este cuestionario no tiene preguntas</h3>
                        @endforelse
                        <br>
                         <center>
                             @can('questionnaire_present_create')
                                 <button class="btn btn-success" type="submit">
                                     Terminar
                                 </button>
                             @endcan
                         </center>
              </form>
       </div>
@endsection

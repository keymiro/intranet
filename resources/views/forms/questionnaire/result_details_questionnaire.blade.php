<title>Cuestionario | Intranet Casanare</title>
@extends('layouts.app')
@section('content')
    <table class="table
     table-hover
     table-bordered shadow rounded">
        <thead>
        <tr>
            <th scope="col">Detalles del Resultado</th>
            <th scope="col">Aprobo</th>
            <th scope="col">Puntaje</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $res)
            <tr>
                @if ($res->score > $prom)
                    <td class="table-success">
                        <h3 class="">
                            Acertaste {{$res->score}} Preguntas de {{$total}}
                            <i class="far fa-laugh-beam float-right fa-2x"></i>
                        </h3>
                    </td>
                @else
                    <td class="table-danger">
                        <h3 class="">
                            Acertaste {{$res->score}} Preguntas de {{$total}}
                            <i class="far fa-frown float-right fa-2x"></i>
                        </h3>
                    </td>
                    @endif
                    </td>
                <td>
                   @if ($res->pass==1)SI @else NO @endif
                </td>
                    <td>
                        {{$res->score}}
                    </td>
                    <td>
                        <div class="col-3">
                            <a href="{{route('result.questionnaire')}}"
                               class="btn btn-primary text-light">Volver</a>
                        </div>
                    </td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

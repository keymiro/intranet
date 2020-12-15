@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">

            @foreach($people as $Ru )

                <div class="card-header shadow rounded mb-4 bg-primary text-light">
                    <h3>
                      Resultado detallado de:  {{$Ru->user->people->names}}
                             {{$Ru->user->people->lastnames}}
                    </h3>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table
                        table-hover
                        table-striped
                        table-bordered
                        shadow-sm">
                            <tbody>
                            <tr>
                                <th scope="row">Nombres</th>
                                <td>{{$Ru->user->people->names}}</td>
                                <td class="font-weight-bold">Cargo</td>
                                <td>{{$Ru->user->people->jobtitle->title}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Apellidos</th>
                                <td>{{$Ru->user->people->lastnames}}</td>
                                <td class="font-weight-bold">Área</td>
                                <td>{{$Ru->user->people->area->name}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Correo</th>
                                <td>{{$Ru->user->email}}</td>
                                <td class="font-weight-bold">Fecha Nacimiento</td>
                                <td>{{$Ru->user->people->datebirth}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Documento</th>
                                <td>{{$Ru->user->people->document}}</td>
                                <td class="font-weight-bold">Celular</td>
                                <td>{{$Ru->user->people->phone}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Puntaje</th>
                                <td>{{$Ru->score}}</td>
                                <td class="font-weight-bold">Dirección</td>
                                <td>{{$Ru->user->people->address}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Aprobo</th>
                                <td>{{$Ru->Aprobo}}</td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            <div class="container">
                <div class="row">
                    @foreach($ResultUser as $result )
                        @if ($result->Correctas=='✓')
                            <div class=" alert alert-success mr-4  shadow-sm" role="alert">
                                <br>
                                Pregunta: {{$result->Preguntas}}
                                <br>
                                Repuesta que selecciono:
                                {{$result->RespuestaSeleccionada}} <strong>✓</strong>
                        @else
                            <div class="alert alert-danger
                             mr-4
                            shadow-sm" role="alert">
                                <br>
                                Pregunta: {{$result->Preguntas}}
                                <br>
                                Repuesta que selecciono:
                                @if ($result->RespuestaSeleccionada==null)
                                    <p>No selecciono ninguna respuesta</p>
                                @else
                                    {{$result->RespuestaSeleccionada}}
                                @endif <strong>X</strong>
                        @endif <br>
                                <hr>
                            Respuesta correcta:
                                {{$result->RespuestaCorrecta}}
                            </div>
                    @endforeach
                @endforeach
                </div>
            </div>
        </div>
        <hr>
    </div>

@endsection

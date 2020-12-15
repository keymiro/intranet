@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Detalle Vacaciones Laborales
        </h3>
    </div>
    @include('partials.notification')
    @foreach($workvacation as $w)
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <p><strong>Creado el:</strong> {{$w->created_at}}</p>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p><strong>Nombres:</strong> {{$w->user->people->names}}</p>
                        </div>
                        <div class="col">
                            <p><strong>Apellidos:</strong> {{$w->user->people->lastnames}}</p>
                        </div>
                        <div class="col">
                            <p><strong>Documento:</strong> {{$w->user->people->document}}</p>
                        </div>
                        <div class="col">
                            <p><strong> Cel:</strong> {{$w->user->people->phone}}</p>
                        </div>
                    </div>
                    <hr>
                    <p class="font-weight-bold text-center bg-secondary">
                        Programación de vacaciones (periodo a disfrutar)
                    </p>
                    <div class="row">
                        <div class="col">
                            <p><strong>Fecha Inicio Disfrute de Vacaciones:</strong>
                                {{$w->startdate}}
                            </p>
                        </div>
                        <div class="col">
                            <p><strong>Fecha Reanudación Labores:</strong>
                                {{$w->returndate}}</p>
                        </div>
                    </div>
                    <hr>
                    <p class="font-weight-bold text-center bg-secondary">
                        Periodo al cual corresponden las vacaciones a tomar (periodo de causacion)
                    </p>
                    <div class="row">
                        <div class="col">
                            <p><strong>Desde:</strong>
                                {{$w->fromdate}}
                            </p>
                        </div>
                        <div class="col">
                            <p><strong>Hasta:</strong>
                                {{$w->untildate}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><strong>No. de días hábiles disponibles para disfrutar</strong>
                                {{$w->businessdays}}
                            </p>
                        </div>
                        <div class="col">
                            <p><strong>No. de días solicitados para disfrutar </strong>
                                {{$w->requesteddays}}</p>
                        </div>
                        <div class="col">
                            <p><strong>No. de días que quedan pendientes para este periodo</strong>
                                {{$w->pendingdays}}
                            </p>
                        </div>
                        <div class="col">
                            <p><strong>No Dias a Disfrutar</strong>
                                {{$w->enjoydays}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="border">
                                <p class="my-2 mx-2"><strong>Observaciónes:</strong> {{$w->observations}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered shadow-sm">
                                <thead class="bg-secondary">
                                <tr>
                                    <th colspan="3" scope="col" class="text-center">
                                        Estado de la solicitud
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>Coordinador de Área:</strong>
                                        @switch($w->coordigree)
                                            @case(null)
                                            Esperando respuesta
                                            @break
                                            @case(0)
                                            Denegado
                                            @break
                                            @case(1)
                                            Aprobado
                                            @break
                                        @endswitch
                                    </td>
                                    <td><strong>Dirección:</strong>
                                        @switch($w->directigree)
                                                @case(null)
                                                Esperando respuesta
                                                @break
                                                @case(0)
                                                Denegado
                                                @break
                                                @case(1)
                                                Aprobado
                                                @break
                                            @endswitch
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        @if(auth()->user()->people->area_id!=3)
                            @if (auth()->user()->is_Admin||
                              auth()->user()->is_Coord||
                             auth()->user()->is_Director)
                                <div class="col-3">
                                    <form action="{{route('approve.WorkVacation',['WorkVacationId'=>$w->id,'off'=>0])}}" method="post">
                                        @csrf @method('PATCH')
                                        <label for="approvevacation" class="my-2 font-weight-bold">Desea aprobar la solicitud?</label>
                                        <select name="approvevacation" class="form-control mb-2 " id="approvevacation">
                                            <option value="">Seleccione una opción</option>
                                            <option value="0">Denegar</option>
                                            <option value="1">Aprobar</option>
                                        </select>
                                        <button class="btn btn-success">aceptar</button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

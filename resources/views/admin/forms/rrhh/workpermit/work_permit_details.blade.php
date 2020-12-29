@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Detalle Permiso Laboral
        </h3>
    </div>
@include('partials.notification')
    @foreach($workpermit as $w)
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <p><strong>Creado el:</strong> {{$w->created_at}}</p>
                    <div>
                        <p><strong>(RRHH) Resgitrado: </strong>{{$w->rdate==null?'No':'Si'}} ( {{$w->rdate}} )</p>
                        @hasrole('super-admin|admin|coordinador-rrrhh')
                            <a class="btn btn-success" href="{{route('register.WorkPermit', $w->id)}}">
                                Registrar
                            </a>
                        @endhasrole
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p><strong>Permiso:</strong> {{$w->especify==0 ?'Solicitud de permiso':
                        'Autorización desplazamiento diligencia institucional' }}
                            </p>
                        </div>
                        <div class="col">
                            <p><strong>Tipo de pago:</strong> {{$w->tipepaid ==0 ?'Remunerado':'No remunerado'}}</p>
                        </div>
                        <div class="col">
                            <p><strong>Tipo de permiso:</strong> {{$w->typepermit->name}}</p>
                        </div>
                        <div class="col">
                            <p><strong> Cargo:</strong> {{$w->user->people->jobtitle->title}}</p>
                        </div>
                    </div>
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
                            <p><strong> Dependencia:</strong> {{$w->user->people->area->name}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered shadow-sm">
                                <thead class="bg-secondary">
                                <tr>
                                    <th colspan="2" scope="col" class="text-center">
                                        Horario Laboral
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>Entrada:</strong> {{$w->jentry}}</td>
                                    <td><strong>Salida:</strong> {{$w->jexit}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table table-bordered shadow-sm">
                                <thead class="bg-secondary">
                                <tr>
                                    <th scope="col">
                                        Duración Permiso
                                    </th>
                                    <th>
                                        Fecha permiso
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {{$w->timepermit}} Horas
                                    </td>
                                    <td>
                                        {{$w->datepermit}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table table-bordered shadow-sm">
                                <thead class="bg-secondary">
                                <tr>
                                    <th colspan="2" scope="col" class="text-center">
                                        Horario del Permiso
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>Salidad:</strong> {{$w->pexit}}</td>
                                    <td><strong>Regreso:</strong> {{$w->preturn}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="border">
                                <p CLASS="my-2 mx-2"><strong>Descripción:</strong> {{$w->description}}</p>
                            </div>
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
                                            Estado del Permiso
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
                                            @if ($w->timepermit > 24 )
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
                                            @else
                                            No aplica
                                            @endif
                                        </td>
                                        <td><strong>Gerencia:</strong>
                                            @if ($w->timepermit > 48)
                                                @switch($w->managigree)
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
                                            @else
                                            No aplica
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            @can('approve_request')
                                <div class="col-3">
                                        <form action="{{route('approve.WorkPermit',['WorkPermitId'=>$w->id])}}" method="post">
                                            @csrf @method('PATCH')
                                            <label for="approvepermit" class="my-2 font-weight-bold">Desea aprobar el permiso?</label>
                                            <select name="approvepermit" class="form-control mb-2 " id="approvepermit">
                                                <option value="">Seleccione una opción</option>
                                                <option value="0">Denegar</option>
                                                <option value="1">Aprobar</option>
                                            </select>
                                            <button class="btn btn-success">aceptar</button>
                                        </form>
                                </div>
                            @endcan
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

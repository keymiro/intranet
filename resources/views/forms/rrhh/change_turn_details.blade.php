@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Detalle Cambio de Turno
        </h3>
    </div>
    @include('partials.notification')
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p><strong>Fecha Solicitud:</strong> {{$changeturn->created_at}} </p>
                        </div>
                        <div class="col">
                            <p><strong> Número de cambios de turno:</strong> {{$changeturn->numberchangeturn}}</p>
                        </div>
                        <div class="col">
                            <p><strong>Fecha recibido:</strong>
                                @if($changeturn->rdaterrhh==null)
                                    No hay recibido
                                @else
                                    {{$changeturn->rdaterrhh}}
                                @endif
                            </p>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col">
                            <p><strong>Nombres: </strong>
                                {{$changeturn->user->people->names}}
                            </p>
                        </div>
                        <div class="col">
                            <p><strong>Apellidos:</strong>
                                {{$changeturn->user->people->lastnames}}
                            </p>
                        </div>
                        <div class="col">
                            <p><strong>Cel:</strong> {{$changeturn->user->people->phone}} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered shadow-sm">
                                <thead class="bg-secondary">
                                <tr>
                                    <th colspan="2" scope="col" class="text-center">
                                        Fecha Programada
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>Fecha:</strong> {{$changeturn->datechangeturn}} </td>
                                    <td><strong>Horario:</strong> {{$changeturn->tchangeturn}} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @if($changeturn->user_change_igree==null)
                        <div class="col">
                            <p class="text-warning"><strong>Nombre quien reemplaza:</strong> Esperando aprobación del reemplazante </p>
                        </div>
                        <div class="col">
                            <p class="text-warning"><strong>Cel quien reemplaza:</strong> Esperando aprobación del reemplazante  </p>
                        </div>
                    @elseif($changeturn->user_change_igree==0)
                        <div class="col">
                            <p><strong>Nombre quien reemplaza:</strong>No aprobado</p>
                        </div>
                        <div class="col">
                            <p><strong>Cel quien reemplaza:</strong> No aprobado </p>
                        </div>
                    @else
                        <div class="col">
                            <p><strong>Nombre quien reemplaza:</strong> {{$changeturn->change_user->people->names}} </p>
                        </div>
                        <div class="col">
                            <p><strong>Cel quien reemplaza:</strong> {{$changeturn->change_user->people->phone}} </p>
                        </div>
                    @endif
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered shadow-sm ">
                                <thead class="bg-secondary">
                                <tr>
                                    <th colspan="2" scope="col" class="text-center">
                                        Fecha Devolución
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>Fecha:</strong>{{$changeturn->returnchangeturn}} </td>
                                    <td><strong>Horario:</strong> {{$changeturn->t1changeturn}} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            @can('approve_request')
                            Aprobar como coordinador
                                <div class="col">
                                    <form action="{{route('approve.ChangeTurn',['ChangeTurnId'=>$changeturn->id])}}" method="post">
                                        @csrf @method('PATCH')
                                        <label for="approvechangeturn" class="my-2 font-weight-bold">Desea aprobar el permiso?</label>
                                        <select name="approvechangeturn" class="form-control mb-2 " id="approvechangeturn">
                                            <option value="">Seleccione una opción</option>
                                            <option value="0">Denegar</option>
                                            <option value="1">Aprobar</option>
                                        </select>
                                        <button class="btn btn-success">aceptar</button>
                                    </form>
                                </div>
                            @endcan
                            @if(auth()->user()->id==$changeturn->user_change_id)
                                <div class="col">
                                    Aprobar como reemplazante
                                    <form action="{{route('ChangeTurn.approve',['ChangeTurnId'=>$changeturn->id])}}" method="post">
                                        @csrf @method('PATCH')
                                        <label for="approvechangeturn" class="my-2 font-weight-bold">Desea aprobar el permiso?</label>
                                        <select name="approvechangeturn" class="form-control mb-2 " id="approvechangeturn">
                                            <option value="">Seleccione una opción</option>
                                            <option value="0">Denegar</option>
                                            <option value="1">Aprobar</option>
                                        </select>
                                        <button class="btn btn-success">aceptar</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <div class="border">
                                <p class="my-2 mx-2"><strong>Observaciónes:</strong> {{$changeturn->observations}}</p>
                            </div>
                        </div>
                        <div class="col">
                            <table class="table table-bordered shadow-sm ">
                                <thead class="bg-secondary">
                                <tr>
                                    <th colspan="3" scope="col" class="text-center">
                                        Estado de Cambio de Turno
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>Coordinador de Área:</strong>
                                        @switch($changeturn->coordigree)
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
                                    <td><strong>Reemplaza:</strong>
                                        @switch($changeturn->user_change_igree)
                                            @case(null)
                                            Esperando respuesta
                                            @break
                                            @case(0)
                                            Denegado
                                            @break
                                            @case(1)
                                           <p class="text-success">Aprobo</p>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

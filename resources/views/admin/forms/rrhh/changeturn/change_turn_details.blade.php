@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Detalle Cambio de Turno
        </h3>
    </div>
    @include('partials.notification')
    @foreach($changeturn as $c)
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p><strong>Fecha Solicitud:</strong> {{$c->created_at}} </p>
                        </div>
                        <div class="col">
                            <p><strong> Número de cambios de turno:</strong> {{$c->numberchangeturn}}</p>
                        </div>
                        <div class="col">
                            <p><strong>Fecha recibido:</strong>
                                @if($c->rdaterrhh==null)
                                    No hay recibido
                                @else
                                    {{$c->rdaterrhh}}
                                @endif
                            </p>
                        </div>
                        <div class="col">
                         @hasrole('super-admin|admin|coordinador-rrrhh')
                                <a class="btn btn-success" href="{{route('register.ChangeTurn', $c->id)}}">
                                    Recibido
                                </a>
                         @endhasrole

                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col">
                            <p><strong>Nombres: </strong>
                                {{$c->user->people->names}}
                            </p>
                        </div>
                        <div class="col">
                            <p><strong>Apellidos:</strong>
                                {{$c->user->people->lastnames}}
                            </p>
                        </div>
                        <div class="col">
                            <p><strong>Cel:</strong> {{$c->user->people->phone}} </p>
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
                                    <td><strong>Fecha:</strong> {{$c->datechangeturn}} </td>
                                    <td><strong>Horario:</strong> {{$c->tchangeturn}} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p><strong>Nombre quien reemplaza:</strong> {{$c->namechange}} </p>
                        </div>
                        <div class="col">
                            <p><strong>Cel quien reemplaza:</strong> {{$c->celchange}} </p>
                        </div>
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
                                    <td><strong>Fecha:</strong>{{$c->returnchangeturn}} </td>
                                    <td><strong>Horario:</strong> {{$c->t1changeturn}} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="border">
                                <p class="my-2 mx-2"><strong>Observaciónes:</strong> {{$c->observations}}</p>
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
                                        @switch($c->coordigree)
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
                                        @switch($c->changeigree)
                                            @case(null)
                                            Esperando respuesta
                                            @break
                                            @case(0)
                                            Denegado
                                            @break
                                            @case(1)
                                            Aprobo
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        @if(auth()->user()->people->area_id!=3)
                            <div class="col">
                                <form action="{{route('approve.ChangeTurn',['ChangeTurnId'=>$c->id,'off'=>'0'])}}" method="post">
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
                </div>
            </div>
        </div>
    @endforeach
@endsection

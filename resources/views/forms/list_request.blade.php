@extends('layouts.app')
@section('content')

    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Solicitudes
        </h3>
    </div>
    <button class="btn btn-primary " type="button"
            data-toggle="collapse"
            data-target="#workpermit"
            aria-expanded="false"
            aria-controls="collapseExample">
        <i class="fas fa-bars"></i>
        Listar permisos laborales solicitados
    </button>
<div class="collapse my-4" id="workpermit">
<h3>Permisos laborales</h3>
    <input class="form-control col-4 m light-table-filter mb-4"
           data-table="order-table"
           type="text"
           placeholder="Buscador general">
    <table class="table table-striped table-bordered
    table-hover shadow rounded  sortable order-table">
        <thead>
        <tr>
            <th scope="col">Permiso</th>
            <th scope="col">Tipo de permiso</th>
            <th scope="col">Solicitado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($workpermit as $w)
            <td>{{$w->especify==0 ?'Solicitud de permiso':
                'Autorización desplazamiento diligencia institucional' }}
            </td>
            <td>{{$w->typepermit->name}}</td>
            <td>{{$w->created_at->diffForHumans()}}</td>
            <td>
                <a class="btn btn-primary mb-2 text-light"
                   href="{{route('detailsworkpermit.c',$w->id)}}">
                    Ver
                </a>
            </td>
            </tr>

        @empty
            <p>No se encontraron resultados</p>
        @endforelse

        </tbody>
    </table>
    {{ $workpermit->links() }}
    </div>
    <hr>
<!--    CAMBIO DE TURNO----------------------------------------------------->
    <button class="btn btn-primary " type="button"
            data-toggle="collapse"
            data-target="#changeturn"
            aria-expanded="false"
            aria-controls="collapseExample">
        <i class="fas fa-bars"></i>
        Listar cambios de turnos solicitados
    </button>
    <div class="collapse my-4" id="changeturn">
        <h3>Cambios de turnos</h3>
        <input class="form-control col-4 m light-table-filter mb-4"
               data-table="order-table1"
               type="text"
               placeholder="Buscador general">
        <table class="table table-striped table-bordered
    table-hover shadow rounded  sortable order-table1">
            <thead>
            <tr>
                <th scope="col">Solicita</th>
                <th scope="col">Fecha programada del turno</th>
                <th scope="col">Solicitado</th>
                <th scope="col">Detalles</th>
            </tr>
            </thead>
            <tbody>
            @forelse($changeturn as $c)
                <td>{{$c->user->people->names}}</td>
                <td>{{$c->datechangeturn}}</td>
                <td>{{$c->created_at->diffForHumans()}}</td>
                <td>
                    <a class="btn btn-primary mb-2 text-light"
                       href="{{route('ChangeTurn.detailsc',$c->id)}}">
                        Ver
                    </a>
                </td>
                </tr>

            @empty
                <p>No se encontraron resultados</p>
            @endforelse

            </tbody>
        </table>
        {{ $changeturn->links() }}
    </div>
    <hr>
    <!--    CAMBIO DE VACACIONES----------------------------------------------------->
    <button class="btn btn-primary " type="button"
            data-toggle="collapse"
            data-target="#vacation"
            aria-expanded="false"
            aria-controls="collapseExample">
        <i class="fas fa-bars"></i>
        Listado de vacaciones
    </button>
    <div class="collapse my-4" id="vacation">
        <h3>Listado de vacaciones</h3>
        <input class="form-control col-4 m light-table-filter mb-4"
               data-table="order-table2"
               type="text"
               placeholder="Buscador general">
        <table class="table table-striped table-bordered
    table-hover shadow rounded  sortable order-table2">
            <thead>
            <tr>
                <th scope="col">Solicita</th>
                <th scope="col">Solicitado</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($workvacation as $w)
                <td>{{$w->user->people->names}}</td>
                <td>{{$w->created_at->diffForHumans()}}</td>
                <td>
                    <a class="btn btn-primary mb-2 text-light"
                       href="{{route('WorkVacation.detailsc',$w->id)}}">
                        Ver
                    </a>
                </td>
                </tr>

            @empty
                <p>No se encontraron resultados</p>
            @endforelse

            </tbody>
        </table>
        {{ $changeturn->links() }}
    </div>
@endsection

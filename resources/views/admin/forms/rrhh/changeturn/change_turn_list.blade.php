@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Cambio de Turno
        </h3>
    </div>
    <input class="form-control col-4 m light-table-filter mb-4"
           data-table="order-table"
           type="text"
           placeholder="Buscador general">
    <table class="table table-striped table-bordered
    table-hover shadow rounded  sortable order-table">
        <thead>
        <tr>
            <th scope="col">Solicita</th>
            <th scope="col">Fecha programada del turno</th>
            <th scope="col">Recibido</th>
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
                   href="{{route('ChangeTurn.details',$c->id)}}">
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
@endsection

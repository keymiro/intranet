@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded
    mb-4 bg-primary text-light">
        <h3>
           Resultados Eventos Adversos
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
            <th scope="col">Resultados evento adversos (consecutivo)</th>
            <th scope="col">Recibido</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($event as $e)
                <td>{{$e->consecutive}}</td>
                <td>{{$e->created_at->diffForHumans()}}</td>
                <td><a class="btn btn-primary mb-2 text-light"
                       href="{{route('Details.AdverseEvent',$e->id )}}">
                        Detalles</a>
                </td>
            </tr>

        @empty
            <p>No se encontraron resultados</p>
        @endforelse

        </tbody>
    </table>
    {{ $event->links() }}
@endsection

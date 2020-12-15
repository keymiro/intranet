<title>Cuestionario | Intranet Casanare</title>
@extends('layouts.app')
@section('content')
    @include('partials.notification')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            <i class="fas fa-hands-helping"></i> Atención al usuario
        </h3>
    </div>
    <input class="form-control col-4 m light-table-filter mb-4"
           data-table="order-table"
           type="text"
           placeholder="Buscador general">
    <table class="table
    table-striped
    table-bordered
    table-hover mb-0
    shadow rounded
    table-responsive table-sm
    sortable order-table">
        <thead>
        <tr>
            <th scope="col">Nombres</th>
            <th scope="col">Email</th>
            <th scope="col">Cel</th>
            <th scope="col">Cargo</th>
            <th scope="col">Eps</th>
            <th scope="col">mensaje</th>
            <th scope="col">Recibido</th>
        </tr>
        </thead>
        <tbody>
        @forelse($usersopport as $u)
            <tr>
                <td>{{$u->names}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->phone}}</td>
                <td>{{$u->jobtitle}}</td>
                <td>{{$u->eps}}</td>
                <td>{{$u->type}}</td>
                <td>{{$u->message}}</td>
            </tr>
        @empty
            <p>No se encontraron Resultados</p>
        @endforelse
        </tbody>
    </table><br>
    {{  $usersopport->links() }}
@endsection

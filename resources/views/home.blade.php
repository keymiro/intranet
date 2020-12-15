<title>Inicio | Intranet Casanare</title>
@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <div class="card-header bg-primary text-light my-2 shadow-sm">
            <h3><i class="fas fa-bell"></i> Notificaciones</h3>

        </div>
        @include('partials.notification')
        <br>
        <div class="row">


        </div>
    </div>
@endsection

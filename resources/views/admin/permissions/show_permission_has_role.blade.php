<title>Permisos | Intranet Casanare </title>
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <center>
                    <div class="bg bg-primary shadow rounded text-light mb-4">
                        <h3><i class="fas fa-user-shield"></i>
                           Permisos
                        </h3>
                    </div>
                </center>
            </div>
        </div>
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="card-header shadow rounded
                               bg-primary text-light mb-lg-4">
                    <i class="fas fa-cogs"></i> Permisos del rol
                    <strong>{{$role->name}}</strong>
                </div>
                @include('partials.notification')
                <div class="container">
                    <form action="{{route('permisos.remove', $role->id)}}" method="Post">
                        @csrf
                        @can('remove_role_has_permisssion')
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-danger btn-block">Revocar Permisos</button>
                            </div>
                            <div class="col-3">
                                <label for="checkTodos">
                                    <input type="checkbox" class="my-2" id="checkTodos" /> Marcar/Desmarcar Todos
                                </label>
                            </div>
                        </div>
                        @endcan
                        <hr>
                        <div class="row">
                            @forelse($allPermissions as $p)
                                <div class="col-4">
                                    <div class="alert alert-secondary" role="alert">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="permission[]"
                                                   id="{{$p->name}}"
                                                   value="{{$p->id}}" />

                                            <label class="form-check-label" for="{{$p->name}}">
                                                <strong>{{$p->name}}</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No se le han asignado permisos</p>
                            @endforelse
                        </div>
                    </form>
                </div>
            </div><!-------------card-body------------------------------------------------------------------------------------->
        </div><!-------------card------------------------------------------------------------------------------------>
    </div><!-------------container------------------------------------------------------------------------------------->
@endsection

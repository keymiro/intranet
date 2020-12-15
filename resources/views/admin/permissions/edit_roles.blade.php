<title>Permisos | Intranet Casanare </title>
@extends('layouts.app')
@section('content')
    <div class="container"><br>
        <div class="card-header shadow rounded
                               bg-primary text-light mb-lg-4">
            <i class="fas fa-cogs"></i> Configurar permisos y roles
        </div>
        <div class="card">
            <br>
            <div class="card-body">
                    <form action="{{route('roles.update',$roles->id)}}"
                          method="POST">
                        @csrf @method('PATCH')
                        <label for="name">Editar Rol: </label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control"
                                       name="name" id="name"
                                       placeholder="Nombre del nuevo rol"
                                       required value="{{$roles->name}}">
                            </div>
                            @can('rol_edit')
                                <div class="col">
                                    <button class="btn btn-success mb-2">Actualizar</button>
                                </div>
                            @endcan
                        </div>
                    </form>

                <br>
            </div>
        </div>
    </div>
@endsection

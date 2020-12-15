<title>Usuarios | Intranet Casanare </title>
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <center>
                    @include('partials.notification')
                    <div class="bg bg-primary shadow rounded text-light mb-4">
                        <h3><i class="fas fa-user-plus"></i>
                            Nuevo Usuario
                        </h3>
                    </div>
                </center>
            </div>
        </div>
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="card-header shadow rounded
                               bg-primary text-light mb-lg-4">
                    <i class="fas fa-key"></i> Usuario
                </div>
                <hr>
                <form action="{{route('user.store')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="email">Correo Electrónico :</label>
                            <input class="form-control" type="email"
                                   id="email" name="email"
                                   placeholder="Introduzca el e-mail"
                                   required value="{{old('email')}}">
                        </div>
                        <div class="form-group col">
                            <label for="password">Contraseña :</label>
                            <input class="form-control" type="password"
                                   id="password" name="password"
                                   placeholder="Introduzca la contraseña"
                                   required value="{{old('password')}}">
                        </div>
                    </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="role">Escoja un rol</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">Seleccione un rol</option>
                                    @foreach($Roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="t">Tipo de funcionario</label>
                                <select class="form-control" id="t" name="type_func" required>
                                    <option value="">Seleccione el tipo funcionario</option>
                                    <option value="1">Administrativo</option>
                                    <option value="2">Asistencial</option>

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="e">Estado</label>
                                <select class="form-control" id="e" name="state" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                    <!--------------datos personales------------------>

                    <div class="card-header shadow rounded
                               bg-primary text-light mb-lg-4">
                        <i class="fas fa-info-circle"></i>
                        Datos personales
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="document">Documento de identificación :</label>
                            <input class="form-control" type="text"
                                   id="document" name="document"
                                   placeholder="Introduzca el documento de identificación"
                                   required value="{{old('document')}}">
                        </div>
                        <div class="form-group col">
                            <label for="names">Nombres</label>
                            <input class="form-control" type="text"
                                   id="names" name="names"
                                   placeholder="Introduzca los nombres"
                                   required value="{{old('names')}}">
                        </div>
                        <div class="form-group col">
                            <label for="lastnames">Apellidos :</label>
                            <input class="form-control" type="text"
                                   id="lastnames" name="lastnames"
                                   placeholder="Introduzca los apellidos"
                                   required value="{{old('lastnames')}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="datebirth">Fecha de nacimiento :</label>
                            <input class="form-control" type="date"
                                   id="datebirth" name="datebirth"
                                   placeholder="Introduzca fecha de nacimiento"
                                   required value="{{old('datebirth')}}">
                        </div>
                        <div class="form-group col">
                            <label for="phone">Número telefónico :</label>
                            <input class="form-control" type="number"
                                   id="phone" name="phone"
                                   placeholder="Introduzca número telefónico"
                                   required value="{{old('datebirth')}}">
                        </div>
                        <div class="form-group col">
                            <label for="address">Dirección :</label>
                            <input class="form-control" type="text"
                                   id="address" name="address"
                                   placeholder="Introduzca la dirección"
                                   required value="{{old('address')}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="area">Área :</label>
                            <select class="form-control" id="area" name="area">
                                <option>Seleccione el área</option>
                                @foreach($Areas as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="jobtitles">Seleccione el cargo :</label>
                            <select class="form-control" id="jobtitles" name="jobtitles">
                                <option>Seleccione un cargo</option>
                                @foreach( $Jobtitles as $jobtitle)
                                    <option value="{{$jobtitle->id}}">{{$jobtitle->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    @can('user_index')
                        <button class="btn btn-dark " type="button"
                                data-toggle="collapse"
                                data-target="#accordion"
                                aria-expanded="false"
                                aria-controls="collapseExample">
                            <i class="fas fa-bars"></i>
                            Listar Usuarios
                        </button>
                    @endcan
                    @can('user_create')
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Registrar Usuario
                        </button>
                    @endcan
                </form>
            </div><!-------------card-body------------------------------------------------------------------------------------->
        </div><!-------------card------------------------------------------------------------------------------------>
        {{--List user--}}
        @include('admin.users.tableListUser')

    </div><!-------------container------------------------------------------------------------------------------------->

@endsection

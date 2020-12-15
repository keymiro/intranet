<title>Editar Usuario | Intranet Casanare </title>
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <center>
                    @include('partials.notification')
                    <div class="bg bg-primary shadow rounded text-light mb-4">
                        <h3><i class="fas fa-user-edit"></i>
                            Editar Usuario
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
                @foreach($user as $u)
                <form action="{{route('update.user',$u->id)}}"
                      method="POST">
                    @csrf @method('PATCH')
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="email">Correo Electrónico :</label>
                            <input class="form-control" type="email"
                                   id="email" name="email"
                                   placeholder="Introduzca el e-mail"
                                   required value="{{$u->email}}">
                        </div>
                        <div class="form-group col">
                            <label for="password">Contraseña :</label>
                            <input class="form-control" type="password"
                                   id="password" name="password"
                                   placeholder="Introduzca la contraseña"
                                   required value="{{$u->password}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="role">Escoja un rol</label>
                            <select class="form-control" id="role" name="role_id" required>
                                <option value="">Seleccione un rol</option>
                                <option value="{{$u->roles()->pluck('id')->implode(' ') }}" selected>
                                    {{$u->roles()->pluck('name')->implode(' ') }}
                                </option>
<!--                                <option value="{{--{{$u->role_id}}--}}">{{--{{$u->role->name}}--}}</option>-->
                                @foreach($Roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="t">Tipo de funcionario</label>
                            <select class="form-control notItemOne"
                                    id="t" name="type_func" required>
                                <option value="{{$u->type_func}}">
                                    {{$u->type_func==1 ?'Administrativo':'Asistencial'}}
                                </option>
                                <option value="1">Administrativo</option>
                                <option value="2">Asistencial</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="e">Estado</label>
                            <select class="form-control notItemOne" id="e" name="state" required>
                                <option value="{{$u->state}}">{{$u->state ==1 ?'Activo':'Inactivo'}}</option>
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
                                   required value="{{$u->people->document}}">
                        </div>
                        <div class="form-group col">
                            <label for="names">Nombres</label>
                            <input class="form-control" type="text"
                                   id="names" name="names"
                                   placeholder="Introduzca los nombres"
                                   required value="{{$u->people->names}}">
                        </div>
                        <div class="form-group col">
                            <label for="lastnames">Apellidos :</label>
                            <input class="form-control" type="text"
                                   id="lastnames" name="lastnames"
                                   placeholder="Introduzca los apellidos"
                                   required value="{{$u->people->lastnames}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="datebirth">Fecha de nacimiento :</label>
                            <input class="form-control" type="date"
                                   id="datebirth" name="datebirth"
                                   placeholder="Introduzca fecha de nacimiento"
                                   required value="{{$u->people->datebirth}}">
                        </div>
                        <div class="form-group col">
                            <label for="phone">Número telefónico :</label>
                            <input class="form-control" type="number"
                                   id="phone" name="phone"
                                   placeholder="Introduzca número telefónico"
                                   required value="{{$u->people->phone}}">
                        </div>
                        <div class="form-group col">
                            <label for="address">Dirección :</label>
                            <input class="form-control" type="text"
                                   id="address" name="address"
                                   placeholder="Introduzca la dirección"
                                   required value="{{$u->people->address}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="area">Área :</label>
                            <select class="form-control notItemOne" id="area" name="area_id">
                                <option value="{{$u->people->area_id}}">{{$u->people->area->name}}</option>
                                @foreach($Areas as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="jobtitles">Seleccione el cargo :</label>
                            <select class="form-control notItemOne" id="jobtitles" name="jobtitle_id">
                                <option value="{{$u->people->jobtitle_id}}">{{$u->people->jobtitle->title}}</option>
                                @foreach( $Jobtitles as $jobtitle)
                                    <option value="{{$jobtitle->id}}">{{$jobtitle->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    @can('user_edit')
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Actualizar
                    </button>
                    @endcan
                </form>
                @endforeach
            </div><!-------------card-body------------------------------------------------------------------------------------->
        </div><!-------------card------------------------------------------------------------------------------------>
    </div><!-------------container------------------------------------------------------------------------------------->
@endsection

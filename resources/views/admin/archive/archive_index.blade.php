@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            <i class="fas fa-file-upload text-light"></i>  Archivos
        </h3>
    </div>
@include('partials.notification')
    @can('archive_create')
    <button class="btn btn-primary my-2" type="button" data-toggle="collapse"
                data-target="#file">
        <i class="fas fa-file-upload text-light"></i>   Nuevo archivo
    </button>
    @endcan

        <div id="file" class="collapse my-2">
            <div class="card">
                <div class="card-body">
<!--                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar"
                             style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="myBar"></div>
                    </div>-->
                    <br>
                    <form action="{{route('Archive.Post')}}"
                          method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Nombre del archivo</label>
                                    <input type="text" class="form-control"
                                           name="name"
                                           required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="category">Categoria</label>
                                    <select class="form-control" id="category"
                                            name="category"
                                            required>
                                        <option  selected>Selecione una categoria</option>
                                        @foreach($categoryArchive as $c)
                                          @hasrole('secretaria')
                                                @if($c->id==2)
                                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endif
                                          @endhasrole
                                          @hasrole('super-admin|admin')
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                          @endhasrole
                                           @hasrole('coordinador|coordinador-rrhh')
                                            @if($c->id!=2)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endif
                                            @endhasrole
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="area">Área</label>
                                    <select class="form-control" id="area"
                                            name="area"
                                            required>
                                        <option  selected>Selecione una área</option>
                                            @foreach($area as $a)
                                                <option value="{{$a->id}}">{{$a->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"
                                                   id="customFile"
                                                   name="archive"
                                                   required>
                                            <label class="custom-file-label"
                                                   for="customFile">Seleccione un archivo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <br>
                        @can('archive_create')
                        <button class="btn btn-success">Cargar archivo</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    <hr>
    <input class="form-control col-4 m light-table-filter mb-4"
           data-table="order-table"
           type="text"
           placeholder="Buscador general">

        <table class="table table-striped table-bordered
        table-hover  shadow-sm rounded order-table">
            <thead>
            <tr>
                <th scope="col">Subido por</th>
                <th scope="col">Archivo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Area</th>
                <th scope="col">Subido</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
                @forelse($archive as $a)
                    <tr>
                        @if ($a->user_id== auth()->user()->id ||
                            auth()->user()->roles()->pluck('id')->implode(' ') ==1)

                        <td>{{$a->user->people->names}}</td>
                        <td><a href="{{ Storage::url($a->url) }}" >
                                {{$a->name.'.'.$a->ext}}
                            </a>
                        </td>
                        <td>
                            {{$a->categoryarchive->name}}
                        </td>
                        <td>{{$a->area->name}}</td>
                        <td>{{$a->created_at}}</td>
                        <td>
                            <div class="row">
                                @can('archive_edit')
                                <a href="{{route('Archive.Edit',$a->id)}}" class="btn btn-success text-light mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('archive_destroy')
                                    <form   action="{{route('Archive.Delete',$a->id)}}"
                                            method="post">
                                        @csrf @method('DELETE')
                                        <button  class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                 @endcan
                            </div>
                        </td>
                        @endif
                    </tr>
            </tbody>
            @empty
                <p>No se encontraron resultados</p>
            @endforelse
        </table>

    {{$archive->links()}}
    @endsection



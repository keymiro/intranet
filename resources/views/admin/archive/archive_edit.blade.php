<title>Editar archivo | Intranet Casanare </title>
@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        @include('partials.notification')
        <div class="card-header bg-secondary shadow-sm">
            <a class="btn btn-primary" href="{{route('Archive.index')}}">
                Listar archivos
            </a>
        </div>
        <br>
      @foreach($editarchive as $e)
        <form action="{{route('Archive.Update',$e->id)}}"
              method="post"
              enctype="multipart/form-data">
            @csrf  @method('PATCH')
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nombre del archivo</label>
                        <input type="text" class="form-control" name="name" value="{{$e->name}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="category">Categoria</label>
                        <select class="form-control notItemOne" id="category" name="category">
                            <option  value="{{$e->id}}">
                                {{$e->categoryarchive->name}}
                            </option>
                            @foreach($categoryArchive as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="area">Área</label>
                        <select class="form-control notItemOne" id="area" name="area">
                            <option value="{{$e->area->id}}">{{$e->area->name}}</option>
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
                            <input type="file" class="custom-file-input" id="customFile" name="archive"
                                   value="{{ $e->url }}">
                            <label class="custom-file-label" for="customFile">{{ Storage::url($e->url) }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success">Actualizar archivo</button>
        </form>
        @endforeach
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            <i class="fas fa-mail-bulk text-light shadow-sm"></i>
            Correspondencia de <strong class="border-bottom">{{Auth::user()->people->area->name}}</strong>
        </h3>
    </div>
    @include('partials.notification')
    <div class="container">
        <form class="form-inline my-4 form-row" method="Get">
                <input class="form-control  light-table-filter"
                       data-table="order-table"
                       type="text"
                       placeholder="Buscador general">

                <input class=" form-control mr-sm-2 mx-4"
                       type="search" placeholder="Buscar por : Nombre"
                       name="name" >
                <button class=" btn btn-outline-success"
                        type="submit">
                    <i class="fas fa-search"></i>
                </button>
        </form>
    </div>

    <table class="table table-striped table-bordered
        table-hover  shadow-sm rounded sortable order-table">
        <thead>
        <tr>
            <th scope="col"><i class="fas fa-file-alt text-primary"> </i> Archivo</th>
            <th scope="col"><i class="fas fa-tags text-warning"></i> Categoria</th>
            <th scope="col"><i class="fas fa-calendar-day text-success"></i> Recibido</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $correspondence as $a)
                          <tr>
                            <td><a href="{{ Storage::url($a->url) }}" >
                                    @switch($a->ext)
                                        @case('pdf')
                                        <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                        @break
                                        @case('docx')
                                        <i class="fas fa-file-word fa-2x"></i>
                                        @break
                                        @case('doc')
                                        <i class="fas fa-file-word fa-2x"></i>
                                        @break
                                        @case('pptx')
                                        <i class="fas fa-file-powerpoint fa-2x text-warning"></i>
                                        @break
                                        @case('ppt')
                                        <i class="fas fa-file-powerpoint fa-2x text-warning"></i>
                                        @break
                                        @case('xlsx')
                                        <i class="fas fa-file-excel fa-2x text-success"></i>
                                        @break
                                        @case('xls')
                                        <i class="fas fa-file-excel fa-2x text-success"></i>
                                        @break

                                        @default
                                        <i class="fas fa-question-circle fa-2x text-secondary"></i>
                                    @endswitch

                                    {{$a->name.'.'.$a->ext}}
                                </a>
                            </td>
                            <td>
                                {{$a->categoryarchive->name}}
                            </td>
                              <td>{{$a->created_at->diffForHumans()}}</td>
                        </tr>
                @endforeach
        </tbody>
    </table>
    {{ $correspondence->links()}}
@endsection

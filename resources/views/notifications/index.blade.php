<title>Notifications | Intranet Casanare</title>
@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <div class="card-header bg-primary text-light my-2 shadow-sm">
            <h3><i class="far fa-bell"></i> Notificaciones</h3>
        </div>
        @include('partials.notification')
           <br>
           <div class="cantainer">
            <a href="{{route('Read.all.Notifications')}}" class="float-right btn btn-outline-primary">Marcar todo leído</a>
            <p class="text-muted">Nuevas</p>
            @forelse ($unreadnotify  as $n )
                <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <a href="{{route('details.WorkPermit',$n->data['workpermit_id'])}}">
                                        {{$n->data['name_user']}}
                                        {{$n->data['lastname_user']}} ha solicitado un<br>
                                        {{$n->data['title']}}<br>
                                        <small>{{$n->created_at->diffForHumans()}}</small><br>
                                    </a><br>
                                </div>
                            </div>
                        </div>
                </div>
            @empty
                <span class="ml-3 pull-right text-muted text-sm">No hay notificaciones leídas</span>
            @endforelse <hr>
               <p class="text-muted">Anteriores</p>
                @forelse ($readnotify as $n )
                    <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <a href="{{route('details.WorkPermit',$n->data['workpermit_id'])}}">
                                            {{$n->data['name_user']}}
                                            {{$n->data['lastname_user']}} ha solicitado un<br>
                                            {{$n->data['title']}}<br>
                                            <small>{{$n->created_at->diffForHumans()}}</small><br>
                                        </a><br>
                                    </div>
                                </div>
                            </div>
                    </div>
                @empty
                    <span class="ml-3 pull-right text-muted text-sm">No hay notificaciones leídas</span>
                @endforelse
        </div>
    </div>
@endsection

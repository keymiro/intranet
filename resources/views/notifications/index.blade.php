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
            <h3><i class="fas fa-inbox"></i> Notificaciones</h3>
        </div>
        @include('partials.notification')
           <br>
           <div class="cantainer">
            <a href="{{route('Read.all.Notifications')}}" class="float-right btn btn-outline-primary">
                Marcar todo leído
            </a>
            <p class="text-muted"> Nuevas</p>
                <div class="row">
                    @forelse ($unreadnotify  as $n )
                        <div class="card  my-2 mx-4">
                                <div class="card-body ">
                                    <div class="container">
                                        <div class="row">
                                            <a href="{{route('details.WorkPermit',$n->data['workpermit_id'])}}">
                                                {{$n->data['name_user']}}
                                                {{$n->data['lastname_user']}} ha solicitado un<br>
                                                {{$n->data['title']}}<br>
                                                <small>{{$n->created_at->diffForHumans()}}</small><br>
                                            </a>
                                            <a href="{{route('Read.Notifications', $n->id)}}" class="text-muted float-right mx-4">
                                                <i class="fas fa-check"></i> Marcar Leído
                                            </a><br>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    @empty
                        <span class="my-2 mx-4 text-muted text-sm-right">No hay notificaciones nuevas</span>
                    @endforelse
                </div><br>
               <p class="text-muted">Anteriores</p>
               <div class="row">
                    @forelse ($readnotify as $n )
                        <div class="card my-2 mx-4">
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
                    <span class="my-2 mx-4 text-muted text-sm-right">No hay notificaciones leídas</span>
                    @endforelse
               </div>
        </div>
    </div>
@endsection

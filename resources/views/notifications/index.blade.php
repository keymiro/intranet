<title>Notifications | Intranet Casanare</title>
@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

        <div class="card-header bg-primary text-light my-2 shadow-sm">
            <h3><i class="fas fa-inbox"></i> Notificaciones</h3>
        </div>
        @include('partials.notification')
           <br>

            <a href="{{route('Read.all.Notifications')}}" class="float-right btn btn-outline-primary">
                Marcar todo leído
            </a>
    <div class="row">
            <div class="col-sm-6">
                <p class="text-muted"> Nuevas</p>
                <ul class="list-group">
                    @forelse ($unreadnotify  as $n )
                        <li class="list-group-item">
                            <a href="{{$n->data['link']}}">
                            {{$n->data['name_user']}}
                            {{$n->data['lastname_user']}} ha solicitado un<br>
                            {{$n->data['title']}}
                           </span>
                            <small class="text-muted">{{$n->created_at->diffForHumans()}}</small><br>
                            </a>
                            <a href="{{route('Read.Notifications', $n->id)}}" class="text-muted float-right mx-4">
                                <i class="fas fa-check"></i> Marcar Leído
                            </a>
                        </li>
                    @empty
                        <span class="text-muted">No hay notificaciones nuevas</span>
                    @endforelse
                </ul>
            </div>
        <div class="col-sm-6">
            <p class="text-muted">Anteriores</p>
                <ul class="list-group">
                    @forelse ($readnotify as $n )
                        <li class="list-group-item">
                            <a href="{{$n->data['link']}}">
                                {{$n->data['name_user']}}
                                {{$n->data['lastname_user']}} ha solicitado un
                                {{$n->data['title']}} -
                                <small class="text-muted">{{$n->created_at->diffForHumans()}}</small>
                            </a>
                            <form action="{{route('destroy.Notifications',$n->id)}}" method="POST" class="float-right">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Eliminar Permanentemente">X
                                </button>
                            </form>
                        </li>
                    @empty
                        <span class="text-muted">No hay notificaciones leídas</span>
                    @endforelse
                </ul>
        </div>
    </div>

@endsection

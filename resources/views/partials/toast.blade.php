
 <!-- Notifications Dropdown Menu -->
 <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="fas fa-bell"></i>
      <span class="badge badge-danger navbar-badge">
        @if (count (auth()->user()->unreadNotifications))
        <span class="badge badge-danger">
            {{ count(auth()->user()->unreadNotifications)}}
        </span>
        @endif
    </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right toast">
        <span class="dropdown-header">
        <strong><i class="fas fa-inbox"></i> Nuevas</strong>
        </span>
        <div class="toast-body">
                @forelse (auth()->user()->unreadNotifications  as $n)
                    <a href="{{route('details.WorkPermit',$n->data['workpermit_id'])}}" >
                        {{$n->data['name_user']}}
                        {{$n->data['lastname_user']}} ha solicitado un
                        {{$n->data['title']}}
                    </a>  - 
                    <a href="{{route('Read.Notifications', $n->id)}}" class="text-muted">
                       <i class="fas fa-check"></i> Marcar Leído
                    </a> <br>

                <small class="text-muted">{{$n->created_at->diffForHumans()}}</small>
                   <br>
                @empty
                    <span class="ml-3 pull-right text-muted text-sm">No hay notificaciones nuevas</span>
                @endforelse
            <div class="dropdown-divider"></div>
            <span class="dropdown-header">
                <strong>Anteriores</strong>
                </span>
            @forelse (auth()->user()->readNotifications  as $n )
                    <a href="{{route('details.WorkPermit',$n->data['workpermit_id'])}}">
                        {{$n->data['name_user']}}
                        {{$n->data['lastname_user']}} ha solicitado un
                        {{$n->data['title']}} <br></a>
                    <small class="text-muted">{{$n->created_at->diffForHumans()}}</small>


                    <br>
                @empty
                    <span class="ml-3 pull-right text-muted text-sm">No hay notificaciones leídas</span>
                @endforelse
            <div class="dropdown-divider"></div>
            <a href="{{route('Read.all.Notifications')}}" class="dropdown-item dropdown-footer">Marcar todo leído</a>
            <a href="{{route('index.all.Notifications')}}" class="dropdown-item dropdown-footer">Ver a detalle</a>
        </div>
    </div>
</li>

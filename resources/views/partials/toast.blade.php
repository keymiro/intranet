
<div id="toast1" class="toast"  role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false"
    style="position: absolute; top:0; right:0; z-index:1;">
    <div class="toast-header">
        <i class="fas fa-bell mr-2 text-warning"></i>
        <strong class="mr-auto">Notificaciones</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
    </div>

    <div class="toast-body">
        <div class="text-secondary font-weight-bold">
           <li>Nuevas</li>
        </div>
                @forelse (auth()->user()->unreadNotifications  as $n)
                    <a href="{{route('details.WorkPermit',$n->data['workpermit_id'])}}" class="link-success">
                                {{$n->data['name_user']}}
                                {{$n->data['lastname_user']}} ha solicitado un <br>
                                {{$n->data['title']}}<br>
                        <small>{{$n->created_at->diffForHumans()}}</small><br>
                    </a><br>
                @empty
                  <small class="text-muted">No hay notificaciones nuevas</small>
                @endforelse
        <div class="text-secondary font-weight-bold">
            <li>Anteriores</li>
        </div>
                @forelse (auth()->user()->readNotifications  as $n )
                <a href="#" class="link-success">
                               {{$n->data['name_user']}}
                               {{$n->data['lastname_user']}} ha solicitado un<br>
                               {{$n->data['title']}}<br>
                       <small>{{$n->created_at->diffForHumans()}}</small><br>
                   </a><br>
                @empty
                        <small class="text-muted">No hay notificaciones leídas</small>
                @endforelse

        <div class="dropdown-divider"></div>
        <a href=""> Marcar todas como leídas</a>
    </div>
</div>

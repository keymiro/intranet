<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="fas fa-bell"></i>
        @if (count(auth()->user()->unreadNotifications))
        <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>

        @endif
      </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header" >Nuevas</span>
      @forelse (auth()->user()->unreadNotifications as $n)
        <a href="{{$n->data['link']}}" class="dropdown-item">
            {{$n->data['name_user']}}
            {{$n->data['lastname_user']}} ha solicitado un <br>
            {{$n->data['title']}} -
            <small class=" pull-right text-muted text-sm">{{ $n->created_at->diffForHumans() }}</small>
            <a href="{{route('Read.Notifications', $n->id)}}" class="dropdown-item">
                <i class="fas fa-check"></i> Marcar Leído
            </a>
        </a>
      @empty
        <small class="text-muted text-sm dropdown-item">Sin notificaciones nuevas </small>
      @endforelse
      <div class="dropdown-divider"></div>
      <span class="dropdown-header">Anteriores</span>
      @forelse (auth()->user()->readNotifications as $n)
        <a href="{{$n->data['link']}}" class="dropdown-item">
            {{$n->data['name_user']}}
            {{$n->data['lastname_user']}} ha solicitado un <br>
            {{$n->data['title']}} -
            <small class="pull-right text-muted text-sm">{{ $n->created_at->diffForHumans() }}</small>
        </a>
      @empty
        <small class="text-muted text-sm dropdown-item">Sin notificaciones leídas </small>
      @endforelse
      <div class="dropdown-divider"></div>
        <a href="{{route('Read.all.Notifications')}}" class="dropdown-item dropdown-footer">Marcar todo leído</a>
        <a href="{{route('index.all.Notifications')}}" class="dropdown-item dropdown-footer">Ver a detalle</a>
    </div>
  </li>



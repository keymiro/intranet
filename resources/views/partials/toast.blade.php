
  <div id="toast1" class="toast"  role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false"
  style="position: absolute; top:0; right:0;">
      <div class="toast-header">
        <i class="fas fa-bell mr-2 text-warning"></i>
           <strong class="mr-auto">Notificaciones sin Leer</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>
      <div class="toast-body">
          @forelse (auth()->user()->unreadNotifications  as $n)
            <p> {{ !empty($n->data['datepermit']) ? $n->data['datepermit']:'' }}</p>
            <p>{{$n->data['rdate']}}</p>
            <a href="#" class="link-success">Success link</a><br>
            <small>{{$n->created_at->diffForHumans()}}</small><br>
            <div class="dropdown-divider"></div>
            @empty
            <p>No hay notificaciones nuevas</p>
          @endforelse
      </div>
      <div class="toast-header">
        <i class="fas fa-bell mr-2 text-warning"></i>
           <strong class="mr-auto">Notificaciones Leídas</strong>
      </div>
      <div class="toast-body">
      @forelse (auth()->user()->readNotifications  as $n )
        <p>{{$n->data['datepermit']}}</p>
        <p>{{$n->data['rdate']}}</p>
        <a href="#" class="link-success">Success link</a><br>
        <small>{{$n->created_at->diffForHumans()}}</small><br>
        <div class="dropdown-divider"></div>
        @empty
            <p>Sin notificaciones leídas</p>
        @endforelse
      </div>
  </div>

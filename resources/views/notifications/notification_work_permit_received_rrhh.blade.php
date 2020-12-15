@if(Auth::user()->people->area_id==3)
    @foreach ($workpermit as $w)
        @if ($w->rdate==null)
            <div class="card shadow-sm mx-4 mb-0 my-2 border-primary">
                <div class="card-header font-weight-bold text-light bg-primary"><i
                        class="fas fa-bell"></i> Recibido Permiso Laboral</div>
                <div class="card-body">
                    <strong>Solicita:</strong>
                    <p>{{$w->user->people->names}}</p>
                    <strong>Tiempo Solicitado:</strong>
                    <p>{{$w->timepermit}} Horas</p>
                    <strong>Tipo de permiso:</strong>
                    <p>{{$w->typepermit->name}}</p>

                    {{--  {{$n->workpermit->description}}--}}
                </div>
                <div class="card-footer">
                    <a class="btn btn-success" href="{{route('register.WorkPermit', $w->id)}}">
                        Registrar
                    </a>
                    <a href="{{route('details.WorkPermit',$w->id)}}" class="btn btn-primary">Ver</a>
                    <hr>
                    <small><strong>Recibido:</strong>
                        <p>{{$w->created_at->diffForHumans()}}</p></small>
                </div>
            </div>
        @endif
    @endforeach
    @foreach ($UserNotifyChangeTurn as $w)
        @if ($w->rdaterrhh==null)
            <div class="card shadow-sm mx-4 mb-0 my-2 border-primary">
                <div class="card-header font-weight-bold text-light bg-primary"><i
                        class="fas fa-bell"></i> Recibido Cambio de Turno</div>
                <div class="card-body">
                    <strong>Solicita:</strong>
                    <p>{{$w->user->people->names}}</p>
                    <strong>Fecha programada del turno:</strong>
                    <p>{{$w->datechangeturn}}</p>
                    <strong>Reemplaza:</strong>
                    <p>{{$w->namechange}}</p>
                    {{--  {{$n->workpermit->description}}--}}
                </div>
                <div class="card-footer">
                    <a class="btn btn-success" href="{{route('register.ChangeTurn', $w->id)}}">
                        Registrar
                    </a>
                    <a href="{{route('ChangeTurn.details',$w->id)}}" class="btn btn-primary">Ver</a>
                    <hr>
                    <small><strong>Recibido:</strong>
                        <p>{{$w->created_at->diffForHumans()}}</p></small>
                </div>
            </div>
        @endif
    @endforeach
@endif

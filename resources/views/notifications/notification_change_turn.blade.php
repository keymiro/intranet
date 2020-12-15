@if(Auth::user()->role_id==4)
    @foreach ($UserNotifyChangeTurn as $c)
        @if( $c->user->people->area_id==Auth::user()->people->area_id && $c->v==1)
            <div class="card shadow-sm mx-4 mb-0 my-2 border-primary">
                    <div class="card-header font-weight-bold text-light bg-primary"><i
                            class="fas fa-bell"></i> Cambio de Turno
                    </div>
                <div class="card-body">
                    <strong>Solicita:</strong>
                    <p>{{$c->user->people->names}}</p>
                    <strong>Fecha Programada del turno:</strong>
                    <p>{{$c->datechangeturn}}</p>
                    <strong>Persona que reemplaza:</strong>
                    <p>{{$c->namechange}}</p>
                    <strong>Fecha devuelve turno:</strong>
                    <p>{{$c->returnchangeturn}}</p>

                    {{--  {{$n->workpermit->description}}--}}
                </div>
                <div class="card-footer">
                    <form action="{{route('approve.ChangeTurn',['ChangeTurnId'=>$c->id,'off'=>'0'])}}" method="post">
                        @csrf @method('PATCH')
                        <label for="approvechangeturn" class="my-2 font-weight-bold">Desea aprobar el permiso?</label>
                        <select name="approvechangeturn" class="form-control mb-2 " id="approvechangeturn">
                            <option value="">Seleccione una opción</option>
                            <option value="0">Denegar</option>
                            <option value="1">Aprobar</option>
                        </select>
                        <button class="btn btn-success">aceptar</button>
                        <a href="{{route('ChangeTurn.details',$c->id)}}" class="btn btn-primary">Ver</a>
                        <hr>
                </div>
            </div>
        @endif
    @endforeach
@endif

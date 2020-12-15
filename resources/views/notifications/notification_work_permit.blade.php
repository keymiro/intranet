@foreach($UserNotify->role->notification as $n)
    @if ($n->role_id==2)
        @if ($n->v==1)

            <div class="card shadow-sm mx-4 mb-0 my-2 border-primary">
                <div class="card-header font-weight-bold text-light bg-primary"><i
                        class="fas fa-bell"></i> {{$n->notification}}</div>
                <div class="card-body">
                    <strong>Solicita:</strong>
                    <p>{{$n->workpermit->user->people->names}}</p>
                    <strong>Tiempo Solicitado:</strong>
                    <p>{{$n->workpermit->timepermit}} Horas</p>
                    <strong>Tipo de permiso:</strong>
                    <p>{{$n->workpermit->typepermit->name}}</p>
                    {{--  {{$n->workpermit->description}}--}}
                </div>
                <div class="card-footer">
                    <form action="{{route('approve.WorkPermit', ['WorkPermitId'=>$n->workpermit_id,'off'=>0])}}"
                          method="post">
                        @csrf @method('PATCH')
                        <label for="approvepermit" class="my-2 font-weight-bold">Desea aprobar el
                            permiso?</label>
                        <select name="approvepermit" class="form-control mb-2 " id="approvepermit">
                            <option value="">Seleccione una opción</option>
                            <option value="0">Denegar</option>
                            <option value="1">Aprobar</option>
                        </select>
                        <button class="btn btn-success">aceptar</button>
                        <a href="{{route('details.WorkPermit',$n->workpermit_id)}}" class="btn btn-primary">Ver
                            detalles</a>
                    </form>
                </div>
            </div>
        @endif
    @elseif ($n->role_id==3)
        @if ($n->v==1)
            <div class="card shadow-sm mx-4 mb-0 my-2 border-primary">
                <div class="card-header font-weight-bold text-light bg-primary"><i
                        class="fas fa-bell"></i> {{$n->notification}}</div>
                <div class="card-body">
                    <strong>Solicita:</strong>
                    <p>{{$n->workpermit->user->people->names}}</p>
                    <strong>Tiempo Solicitado:</strong>
                    <p>{{$n->workpermit->timepermit}} Horas</p>
                    <strong>Tipo de permiso:</strong>
                    <p>{{$n->workpermit->typepermit->name}}</p>
                    {{--  {{$n->workpermit->description}}--}}
                </div>
                <div class="card-footer">
                    <form action="{{route('approve.WorkPermit', ['WorkPermitId'=>$n->workpermit_id,'off'=>0])}}"
                          method="post">
                        @csrf @method('PATCH')
                        <label for="approvepermit" class="my-2 font-weight-bold">Desea aprobar el
                            permiso?</label>
                        <select name="approvepermit" class="form-control mb-2 " id="approvepermit">
                            <option value="">Seleccione una opción</option>
                            <option value="0">Denegar</option>
                            <option value="1">Aprobar</option>
                        </select>
                        <button class="btn btn-success">aceptar</button>
                        <a href="{{route('details.WorkPermit',$n->workpermit_id)}}" class="btn btn-primary">Ver
                            detalles</a>
                    </form>
                </div>
            </div>
        @endif
    @elseif ($n->role_id==4 && $n->workpermit->user->people->area_id==Auth::user()->people->area_id )
        @if ($n->v==1)
            <div class="card shadow-sm mx-4 mb-0 my-2 border-primary">
                <div class="card-header font-weight-bold text-light bg-primary"><i
                        class="fas fa-bell"></i> {{$n->notification}}</div>
                <div class="card-body">
                    <strong>Solicita:</strong>
                    <p>{{$n->workpermit->user->people->names}}</p>
                    <strong>Tiempo Solicitado:</strong>
                    <p>{{$n->workpermit->timepermit}} Horas</p>
                    <strong>Tipo de permiso:</strong>
                    <p>{{$n->workpermit->typepermit->name}}</p>
                    {{--  {{$n->workpermit->description}}--}}
                </div>
                <div class="card-footer">
                    <form action="{{route('approve.WorkPermit', ['WorkPermitId'=>$n->workpermit_id,'off'=>0])}}"
                          method="post">
                        @csrf @method('PATCH')
                        <label for="approvepermit" class="my-2 font-weight-bold">Desea aprobar el
                            permiso?</label>
                        <select name="approvepermit" class="form-control mb-2 " id="approvepermit">
                            <option value="">Seleccione una opción</option>
                            <option value="0">Denegar</option>
                            <option value="1">Aprobar</option>
                        </select>
                        <button class="btn btn-success">aceptar</button>
                        <a href="{{route('details.WorkPermit',$n->workpermit_id)}}" class="btn btn-primary">Ver
                            detalles</a>
                    </form>
                </div>
            </div>

        @endif
    @endif
@endforeach

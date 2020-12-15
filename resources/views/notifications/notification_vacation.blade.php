@if(Auth::user()->role_id==4 || Auth::user()->role_id==3 )
    @foreach ($UserNotifyVacation as $v)
            @if( $v->user->people->area_id==Auth::user()->people->area_id && $v->v==1)
                <div class="card shadow-sm mx-4 mb-0 my-2 border-primary">
                    <div class="card-header font-weight-bold text-light bg-primary"><i
                            class="fas fa-bell"></i> Solicitud Vacaciones</div>
                    <div class="card-body">
                        <strong>Solicita:</strong>
                        <p>{{$v->user->people->names}}</p>
                        <strong>recibido:</strong>
                        <p>{{$v->created_at->diffForHumans()}}</p>
                        {{--  {{$n->workpermit->description}}--}}
                    </div>
                    <div class="card-footer">
                        <form action="{{route('approve.WorkVacation',['WorkVacationId'=>$v->id,'off'=>0])}}" method="post">
                            @csrf @method('PATCH')
                            <label for="approvevacation" class="my-2 font-weight-bold">Desea aprobar la solicitud?</label>
                            <select name="approvevacation" class="form-control mb-2 " id="approvevacation">
                                <option value="">Seleccione una opción</option>
                                <option value="0">Denegar</option>
                                <option value="1">Aprobar</option>
                            </select>
                            <button class="btn btn-success">aceptar</button>
                            <a href="{{route('WorkVacation.Details',$v->id)}}" class="btn btn-primary">Ver</a>
                        </form>
                    </div>
                </div>
            @endif
    @endforeach
@endif

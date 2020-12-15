<div class="tab-pane fade"
     id="assing_permit"
     role="tabpanel"
     aria-labelledby="profile-tab">
    <div class="container"><br>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{route('permisos.assign')}}" method="Post">
                        @csrf
                        @can('permission_assign')
                            <label for="rol">Asignar permisos al rol</label>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" id="rol" name="rol">
                                        <option value="">Seleccione un rol</option>
                                            @foreach($roles as $ro)
                                                <option value="{{$ro->id}}">{{$ro->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <button class="btn btn-success" type="submit">Asignar</button>
                                </div>
                            </div>
                            <label for="checkTodos">

                            </label>
                        @endcan

                        <hr/>
                        <div class="row">
                            <input class="form-control col-4 m light-table-filter mb-4"
                                   data-table="order-table1"
                                   type="text"
                                   placeholder="Buscador general">

                            <table class="table table-striped table-bordered
                                  table-hover shadow-sm rounded
                                  order-table1">
                                <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">
                                        <label for="checkTodos">
                                            <input type="checkbox"  id="checkTodos" /> Marcar/Desmarcar Todos
                                        </label>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $permissions as $p)
                                    <tr>
                                        <label for="{{$p->name}}">
                                            <td>
                                                 <strong> {{$p->name}}</strong>
                                            </td>
                                            <td>
                                                <input
                                                       id="{{$p->name}}"
                                                       type="checkbox"
                                                       name="permission[]"
                                                       value="{{$p->id}}" />
                                            </td>
                                        </label>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







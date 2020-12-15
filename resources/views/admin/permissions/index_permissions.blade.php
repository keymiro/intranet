<div class="tab-pane fade"
     id="permit"
     role="tabpanel"
     aria-labelledby="profile-tab">
    <div class="container"><br>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form action="{{route('permisos.store')}}" method="POST">
                            @csrf
                            <label for="name">Nuevo Permiso: </label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control"
                                           name="name" id="name"
                                           placeholder="Nombre del nuevo permiso">
                                </div>
                                <div class="col">
                                    <button class="btn btn-success">
                                        Crear
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>

                    <input class="form-control col-4 m light-table-filter mb-4"
                           data-table="order-table"
                           type="text"
                           placeholder="Buscador general">
                    <table class="table table-striped table-bordered
                                  table-hover shadow-sm rounded  sortable
                                  order-table">
                        <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $permissions as $p)
                            <tr>
                                <td><label class="form-check-label" for="{{$p->name}}">
                                        <strong>{{$p->name}}</strong>
                                    </label>
                                </td>
                                <td>
                                    <form action="{{route('permisos.delete', $p->id)}}" method="post">
                                        @csrf @method('DELETE')
                                        @can('permission_edit')
                                            <a href="{{route('permisos.edit',$p->id)}}" type="button"
                                               class="btn btn-success mr-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('permission_destroy')
                                            <button class="btn btn-danger"
                                                    onclick="return confirm('Estas seguro de eliminar este permiso ?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</div>







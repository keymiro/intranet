<div class="tab-pane fade show active"
     id="role"
     role="tabpanel"
     aria-labelledby="home-tab">
    <div class="container"><br>
        <div class="card">
            <div class="card-body">
                <form action="{{route('roles.store')}}" method="POST">
                    @csrf
                    <label for="name">Nuevo Rol: </label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control"
                                   name="name" id="name"
                                   placeholder="Nombre del nuevo rol"
                                   required>
                        </div>
                        <div class="col">
                            <button class="btn btn-success mb-2">Crear</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="row">
                    @foreach( $roles as $r)
                        <div class="col-4">
                            <div class="alert alert-secondary" role="alert">
                             <label for="">
                                <strong>{{$r->name}}</strong>
                            </label>

                                <form action="{{route('roles.delete',$r->id)}}"
                                    method="post">
                                  @csrf @method('DELETE')
                           @can('show_role_has_permisssion')
                                <a href="{{route('show.rolehaspermission', $r->id)}}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                           @endcan
                            @can('rol_edit')
                                  <a href="{{route('roles.edit',$r->id)}}"
                                     type="button"
                                     class="btn btn-success">
                                      <i class="fas fa-edit"></i>
                                  </a>
                            @endcan
                            @can('rol_destroy')
                                  <button class="btn btn-danger"
                                          onclick="return confirm('Estas seguro de eliminar este rol ?');">
                                      <i class="fas fa-trash-alt"></i>
                                  </button>
                            @endcan
                              </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


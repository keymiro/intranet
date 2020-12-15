<div class="card   shadow collapse" id="accordion">
    <div class="card-body">
        <div class="card-header shadow rounded
                                bg-primary text-light mb-lg-4">
            <i class="fas fa-users"></i>
            Listado de usuarios
        </div>

        <input class="form-control col-4 m light-table-filter mb-4"
               data-table="order-table"
               type="text"
               placeholder="Buscador general">

        <table class="table table-sm table-striped
        table-bordered
        table-responsive
        sortable
        order-table">
            <thead >
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Documento</th>
                <th scope="col">Rol</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Nacimiento</th>
                <th scope="col">Cel</th>
                <th scope="col">Dirección</th>
                <th scope="col">Área</th>
                <th scope="col">Cargo</th>
                <th scope="col">acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($Users as $user)
                <tr>
                    <td>{{$user->email}}</td>
                    <td>{{$user->people->document}}</td>
                    <td>{{$user->roles()->pluck('name')->implode(' ') }}</td>
                    <td>{{$user->people->names}}</td>
                    <td>{{$user->people->lastnames}}</td>
                    <td>{{$user->people->datebirth}}</td>
                    <td>{{$user->people->phone}}</td>
                    <td>{{$user->people->address}}</td>
                    <td>{{$user->people->area->name}}</td>
                    <td>{{$user->people->jobtitle->title}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @can('user_edit')
                            <a href="{{ route('edit.user',$user->id)}}"
                               type="button"
                               class="btn btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            @can('user_destroy')
                            <a href="{{ route('inactive.user', $user->id) }}"
                               type="button"
                               class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                                @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


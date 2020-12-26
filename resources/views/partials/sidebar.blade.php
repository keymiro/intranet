@auth()
    <!-- Sidebar -->
    <div class="bg-light border-right shadow-sm" id="sidebar-wrapper">
        <div class="sidebar-heading  bg-secondary">
            <br>
            <h5>
                <i class="fas fa-user-circle text-primary"></i>
                {{auth()->user()->people->names}}
                <br>{{auth()->user()->people->lastnames}}
            </h5>

                <i class="fas fa-user-tag text-warning"></i>
                {{auth()->user()->roles()->pluck('name')->implode(' ') }}
            <br>
                <i class="fas fa-briefcase text-secondary"></i>
                {{auth()->user()->people->jobtitle->title}}
            <br>
                <i class="fas fa-thumbtack text-danger"></i>
                {{auth()->user()->people->area->name}}
        </div>
        <hr class=" my-0  shadow-sm">
        <div class="list-group list-group-flush ">
            <div class="list-group-item text-primary">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </div>
            <a href="{{ route('home') }}" type="button"
               class="{{request()->is('home')? 'active':'' }}
                   list-group-item list-group-item-action">
                <i class="fas fa-home"></i>
                Inicio
            </a>
            @role('admin|super-admin')
                <div class="dropdown dropright">
                    <button type="button" class="list-group-item list-group-item-action  dropdown-toggle"
                            data-toggle="dropdown">
                        <i class="fas fa-user-shield"></i>
                        Admin
                    </button>
                    <div class="dropdown-menu shadow">
                        @can('user_index')
                            <a class="{{request()->is('usuarios')? 'active':'' }} dropdown-item"
                           href="{{ route('usuarios') }}">Usuarios</a>
                        @endcan
                        @can('permission_roles_index')
                            <a class="{{request()->is('permisos')? 'active':'' }} dropdown-item"
                               href="{{ route('permisos') }}">Permisos</a>
                        @endcan
                    </div>

                </div>
             @endrole
        <!--            <a href="/ver" type="button"
               class="{{request()->is('ver')? 'active':''}}
            list-group-item list-group-item-action">
            <i class="fas fa-eye"></i>
            Ver incidencias
        </a>-->

      @can('administrar_coordinacion')
            <div class="dropdown dropright">
                <button type="button" class="list-group-item list-group-item-action  dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="fas fa-cogs"></i>
                    Administración
                </button>
                <div class="dropdown-menu shadow">
                    <a class="{{request()->is('questionario')? 'active':'' }} dropdown-item"
                       href="{{route('questionario.store')}}">Cuestionarios</a>
                    @hasrole('coordinador-calidad|super-admin|admin')
                    <a class="dropdown-item {{request()->is('list-adverse-events')? 'active':'' }}"
                       href="{{route('AdverseEvent')}}">Eventos Adversos</a>
                    @endhasrole
                    @hasrole('coordinador-rrrhh|super-admin|admin')
                    <a class="dropdown-item {{request()->is('list-work-permit')? 'active':'' }}"
                       href="{{route('list.WorkPermit')}}">Permiso Laboral</a>

                    <a class="dropdown-item {{request()->is('list-change-turn')? 'active':'' }}"
                       href="{{route('ChangeTurn.list')}}">Cambio de Turno</a>

                    <a class="dropdown-item {{request()->is('list-work-vacation')? 'active':'' }}"
                       href="{{route('WorkVacation.list')}}">Vacaciones</a>
                    @endhasrole

                    <a class="dropdown-item {{request()->is('archive')? 'active':'' }}"
                       href="{{route('Archive.index')}}"> Archivos</a>
                </div>
            </div>
      @endcan

            <div class="dropdown dropright">
                <button type="button" class="list-group-item
                list-group-item-action  dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="fab fa-wpforms"></i>
                    Solicitudes
                </button>
                <div class="dropdown-menu shadow">
                    <a class="dropdown-item
                        {{request()->is('Solicitud')? 'active':'' }}"
                       href="{{ route('forms') }}">Formularios</a>
                    <a class="dropdown-item
                        {{request()->is('trazabilidad')? 'active':'' }}"
                       href="{{route('ListRequest')}}">Trazabilidad</a>
                </div>
            </div>
            <div class="dropdown dropright">
                <button type="button" class="list-group-item
                list-group-item-action  dropdown-toggle
                   {{request()->is('reportar')? 'active':'' }}"
                        data-toggle="dropdown">
                    <i class="fab fa-wpforms"></i>
                    Cuestionarios
                </button>
                <div class="dropdown-menu shadow">
                    <a class="dropdown-item
                    {{request()->is('presentarq')? 'active':'' }}"
                       href="{{ route('presentarq.index') }}">
                        Realizar Cuestionario
                    </a>
                    <a class="dropdown-item
                    {{request()->is('resultquestionnaire')? 'active':'' }}"
                       href="{{route('result.questionnaire')}}">
                        Resultados
                    </a>
                </div>
            </div>
            <a href="{{route('Correspondence')}}"
               class="list-group-item list-group-item-action {{request()->is('correspondencia')? 'active':'' }}">
                <i class="fas fa-mail-bulk"></i> Correspondencia
            </a>
            <a href="{{route('Archiveindex')}}"
               class="list-group-item list-group-item-action {{request()->is('archivos-informativos')? 'active':'' }}">
                <i class="fas fa-folder-open"></i> Archivos
            </a>
            @hasrole('coordinador-siau|super-admin|admin')
            <a href="{{route('user_support.index')}}"
               class="list-group-item list-group-item-action {{request()->is('user_support')? 'active':'' }}">
                <i class="fas fa-hands-helping"></i> Atención al Usuario
            </a>
            @endhasrole
            <!--            <a href="#" class="list-group-item list-group-item-action">En desarollo..</a>-->
        </div>
    </div>
@endauth
<!-- /#sidebar-wrapper -->
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container py-2">
        <div class="row">
            <div class="col">
                <div class="card shadow rounded">
                    @auth()
                        <div class="card-header bg-secondary">
                            <a class="btn btn-success" href="{{route('home')}}"> <i class="fas fa-home fa-2x"></i></a>
                            <a class="btn btn-warning mr-4" href="javascript:history.go(-1)"><i
                                    class="fas fa-chevron-left fa-2x"></i></a>
                            <a class="btn btn-warning" href="javascript:history.go(1)"><i
                                    class="fas fa-chevron-right fa-2x"></i></a>
                        </div>

                    @endauth
                    <div class="card-body">
                        @yield('content')
                    </div>
                            <div class="card-footer" align="center">
                        <footer style="bottom:0;">
                            <small>&copy; Ideas Creativas IC 2020-2020</small>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>






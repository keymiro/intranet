<title>Permisos | Intranet Casanare </title>
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <center>
                    <div class="bg bg-primary shadow rounded text-light mb-4">
                        <h3><i class="fas fa-user-shield"></i>
                           Permisos
                        </h3>
                    </div>
                </center>
            </div>
        </div>
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="card-header shadow rounded
                               bg-primary text-light mb-lg-4">
                    <i class="fas fa-cogs"></i> Configurar permisos y roles
                </div>
                @include('partials.notification')
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                @can('rol_index')
                    <li class="nav-item">
                        <a class="nav-link active"
                           id="home-tab"
                           data-toggle="tab"
                           href="#role"
                           role="tab"
                           aria-controls="home"
                           aria-selected="true">Roles</a>
                    </li>
                    @endcan
                @can('permission_index')
                    <li class="nav-item">
                        <a class="nav-link"
                           id="profile-tab"
                           data-toggle="tab"
                           href="#permit"
                           role="tab"
                           aria-controls="profile"
                           aria-selected="false">Permisos</a>
                    </li>
                    @endcan
                @can('permission_assign')
                    <li class="nav-item">
                        <a class="nav-link"
                           id="profile-tab"
                           data-toggle="tab"
                           href="#assing_permit"
                           role="tab"
                           aria-controls="profile"
                           aria-selected="false">Asignar Permisos</a>
                    </li>
                        @endcan
                </ul>
                <div class="tab-content" id="myTabContent">
                    @can('rol_index')
                        @include('admin.permissions.index_roles')
                    @endcan
                    @can('permission_index')
                        @include('admin.permissions.index_permissions')
                    @endcan
                    @can('permission_assign')
                        @include('admin.permissions.assign_permissions')
                    @endcan
                </div>
        </div><!-------------card-body------------------------------------------------------------------------------------->
        </div><!-------------card------------------------------------------------------------------------------------>
    </div><!-------------container------------------------------------------------------------------------------------->
@endsection

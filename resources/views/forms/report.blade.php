<title>Solicitud | Intranet Casanare </title>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <center>
                    <div class="bg bg-primary shadow rounded text-light mb-4">
                         <h3><i class="fab fa-wpforms"></i>
                             Formularios
                         </h3>
                    </div>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="area">Selecione un área </label>
                            <select class="form-control" id="area"
                                    onChange="mostrar(this.value);">
                                <option>Seleccione un área</option>
                              {{--  <option value="system">Sistemas</option>--}}
                           {{--     <option value="maintenance">Mantenimiento</option>--}}
                                <option value="quality">Calidad</option>
                                <option value="rrhh">Recusos Humanos</option>
<!--                                <option value="siau">Atención al Usuario</option>-->
                            </select>
                        </div>
                    </div>
                </div>
                <!----Formularios_area------------------------------------->
            @include('forms.forms_area.area_system')
            @include('forms.forms_area.area_maintenance')
            @include('forms.forms_area.area_quality')
            @include('forms.forms_area.area_rrhh')
            @include('forms.forms_area.area_siau')

            <!----/Formularios_area------------------------------------->
                <img class="img-fluid py-lg-4" src="/img/forms.svg" alt="">
            </div>
            <div class="col">
                <!----Formularios------------------------------------->
                <div class="card shadow">

                    <div class="card-body">
                    @include('partials.notification')
                    @include('forms.mantenimiento.forms_maintenance')
                    @include('forms.sistemas.forms_system')
                    @include('forms.calidad.forms_quality')
                    @include('forms.siau.forms_siau')
                    @include('forms.rrhh.forms_work_permit')
                    @include('forms.rrhh.forms_change_turn')
                    @include('forms.rrhh.forms_work_vacation')
                    <!----/Formularios------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    <div class="card-header shadow rounded mb-4 bg-primary text-light">
        <h3>
            Resultados Formularios
        </h3>
    </div>
    @include('partials.notification')
    @forelse($event as $e)

        <div class="row">
            <div class="col">
                <p>
                    <strong> Reporte hecho el :</strong> {{$e->created_at}}
                </p>
            </div>
            <div class="col">
                <h6>
                    <strong>  Consecutivo : </strong>{{$e->consecutive}}
                </h6>
            </div>
            <div class="col">
                <button class="btn btn-primary float-right"
                    type="button" data-toggle="collapse"
                    data-target="#newquestion">
                <i class="fas fa-plus-circle"></i> Asignación
                </button>
                <a href="{{route('Export.AdverseEvent',$e->id)}}" class="btn btn-success">
                    <i class="fas fa-file-pdf"></i>
                    Exportar Pdf
                </a>
            </div>
        </div>

        <form method="post" action="{{route('Update.AdverseEvent',$e->id)}}">
            @csrf @method('PATCH')
            <div class="container collapse" id="newquestion">
                <br>
                <div class="card shadow rounded">
                    <div class="card-body">
                        <div class="card-header bg-primary text-light shadow rounded mb-4">
                            <h5>Asinación Para Análisis</h5>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="cnameevent">Nombre el evento</label>
                                <input type="text"
                                       class="form-control"
                                       name="cnameevent"
                                       id="cnameevent"
                                       required>
                            </div>
                            <div class="col">
                                <label for="ccoord">Coordinador</label>
                                <input type="text"
                                       class="form-control"
                                       name="ccoord" id="ccoord"
                                       required>
                            </div>
                            <div class="col">
                                <label for="cunid">Unidad de análisis</label>
                                <select name="cunid" id="cunid" class="form-control" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="0">No Aplica</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-success">Guardar</button>
                    </div><!--card-body-->
                </div><!--card-->
            </div><!--container-->
        </form>
        <br>
        <h3 class="text-center">Evento Adverso</h3>
        <table class="table table-striped table-bordered
    table-hover shadow rounded">
        <tbody>
            <thead>
                <th colspan="2" class="text-center">
                    Info Reportante
                </th>
                <th colspan="2" class="text-center">
                    Info Paciente
                </th>
            </thead>
        <tr>
            <th scope="row">Anonimo</th>
            <td>{{$e->canoni==1 ? 'Si':'No'}}</td>
            <th scope="font-weight-bold">Paciente</th>
            <td>{{$e->namepatient}}</td>
        </tr>
        <tr>
            <th scope="font-weight-bold">Servicio/Area</th>
            <td>{{$e->user->people->area->name}}</td>
            <th scope="row">Id Paciente</th>
            <td>{{$e->documentpatient}}</td>
        </tr>
        <tr>
            <th scope="row">Reporta</th>
            <td>
                @if ($e->canoni==1)
                    {{'Desconocido'}}
                @else
                    {{$e->user->people->names}}
                @endif
             </td>
            <th scope="row">Ubicación</th>
            <td>{{$e->location->name}}</td>
        </tr>
        <tr>
            <th scope="row">Cargo</th>
            <td>
                @if ($e->canoni==1)
                    {{'Desconocido'}}
                @else
                {{$e->user->people->jobtitle->title}}
                @endif
            </td>
            <th scope="font-weight-bold">Descripción</th>
            <td>{{$e->description}}</td>
        </tr>
            </tbody>
        </table>
        <br>
        <h3 class="text-center">Análisis de Asignación</h3>
        <table class="table shadow">
            <thead>
            <tr>
                <th scope="col">Nombre evento</th>
                <th scope="col">Coordinador</th>
                <th scope="col">Unidad análisis</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>{{$e->nameevent}}</th>
                <td>{{$e->coordinator}}</td>
                <td>{{$e->unitanalysis ==1?'Aplica':'No aplica' }}</td>

            </tr>
            </tbody>
        </table>
        @empty
            <p>No se encontraron resultados</p>
        @endforelse

@endsection

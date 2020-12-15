<title>{{$title->nameevent }}</title>
@foreach($event as $e)
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
        th {

            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #adb0b3;
            color: #000000;
        }
    </style>

            <p>
                <strong> Reporte hecho el :</strong> {{$e->created_at}}
            </p>
    <strong>  Consecutivo : </strong>{{$e->consecutive}}
            </p>
    <br>
    <h3 class="text-center">Evento Adverso</h3>
    <hr>
    <br>
    <table>
        <tbody>
        <thead>
        <th colspan="2" >
            Info Reportante
        </th>
        <th colspan="2">
            Info Paciente
        </th>
        </thead>
        <tr>

        </tr>
        <tr>
            <th scope="font-weight-bold">Servicio/Area: </th>
            <td> {{$e->user->people->area->name}}</td>
            <th scope="row">Id Paciente: </th>
            <td> {{$e->documentpatient}}</td>
        </tr>
        <tr>
            <th scope="row">Reporta: </th>
            <td>
                @if ($e->canoni==1)
                    {{'Desconocido'}}
                @else
                    {{$e->user->people->names}}
                @endif
            </td>

            <th scope="row">Ubicación: </th>
            <td>{{$e->location->name}}</td>
        </tr>
        <tr>
            <th scope="row">Cargo: </th>
            <td>
                @if ($e->canoni==1)
                    {{'Desconocido'}}
                @else
                    {{$e->user->people->jobtitle->title}}
                @endif
            </td>
            <th scope="font-weight-bold">Descripción: </th>
            <td>{{$e->description}}</td>
        </tr>
        <tr>
            <th scope="row">Anonimo: </th>
            <td>{{$e->canoni==1 ? 'Si':'No'}}</td>
            <th scope="font-weight-bold">Paciente: </th>
            <td>{{$e->namepatient}}</td>
        </tr>
        </tbody>
    </table>
    <br>
        <h3>Análisis de Asignación</h3>
    <hr><br>
    <table>
        <thead>
        <tr>
            <th scope="col">Nombre evento</th>
            <th scope="col">Coordinador</th>
            <th scope="col">Unidad análisis</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$e->nameevent}}</td>
            <td>{{$e->coordinator}}</td>
            <td>{{$e->unitanalysis ==1?'Aplica':'No aplica' }}</td>
        </tr>
        </tbody>
    </table>
@endforeach

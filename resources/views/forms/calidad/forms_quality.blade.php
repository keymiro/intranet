<div id="quality_form"  style="display: none;">
    <div class="card-header bg-primary text-light mb-4 shadow rounded">
        <i class="fas fa-file-import "></i> Formulario de
        Calidad
    </div>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        En este formulario podras generar un evento adverso
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{route('evento.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="canoni">Desea enviar este reporte en anonimato? :</label>
            <select name="canoni" class="form-control" id="canoni" required
                    value="{{old('canoni')}}">
                <option value="">Seleccione una opción</option>
                <option value="1">Si</option>
                <option value="0">No</option>

            </select>
        </div>
        <div class="form-group">
            <label for="cservice">Servicio/área que reporta :</label>
            <select name="cservice" class="form-control" id="cservice" required
                    value="{{old('cservice')}}">
                <option value="">Seleccione una servicio/área</option>
                @foreach($areas as $a)
                    <option value="{{$a->id}}">{{$a->name}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="clocation">Ubicación donde ocurrio el incidente :</label>
            <select name="clocation" class="form-control" id="clocation" required>
                <option value="">Seleccione una ubicación</option>
                @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="cpaci">Ingrese el nombre completo del paciente :</label>
            <input class="form-control" type="text" id="cpaci" name="cpaci" placeholder="Ingrese el nombre completo del paciente"
                   required
                   value="{{old('cpaci')}}">
        </div>
        <div class="form-group">
            <label for="cid">Ingrese la identificación del paciente :</label>
            <input class="form-control" type="text" id="cid" name="cid" placeholder="Ingrese la identificación del paciente"
                   required
                   value="{{old('cid')}}">
        </div>
        <div class="form-group">
            <label for="cdescription">Descripción del suceso :</label>
            <textarea name="cdescription" class="form-control" id="cdescription" rows="3"
                      placeholder="Resuma en breves palabras el incidente ocurrido y las medidas correctivas tomadas en el momento"
                      required>{{old('cdescription')}}
                    </textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-file-import"></i> Enviar
            Reporte
        </button>
    </form>
</div>

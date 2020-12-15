<div id="rrhh_form"  style="display: none;">
    <div class="card-header bg-primary text-light mb-4 shadow-sm rounded">
       <p> <i class="fas fa-file-import"></i> Formulario de
        Recursos humanos | Permiso laboral
       </p>
    </div>

    <form action="{{route('WorkPermit.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="especify">Especifique permiso:</label>
            <select name="especify" class="form-control" id="especify" required>
                <option value="">Seleccione una opción</option>
                <option value="0">Solicitud de permiso</option>
                <option value="1">Autorización desplazamiento diligencia institucional</option>
            </select>
        </div>
        <div class="form-group">
            <label for="typepaid">Tipo de permiso: </label>
            <select name="typepaid" class="form-control" id="typepaid" required>
                <option value="">Seleccione una opción</option>
                <option value="0">Remunedaro</option>
                <option value="1">No remunedaro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="typepermit">Tipo : </label>
            <select name="typepermit" class="form-control" id="typepermit" required>
                <option value="">Seleccione una opción</option>
                @foreach($typepermit as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
         </div>
          <div class="form-group">
            <p CLASS="bg-primary rounded text-light" align="center">Horario Laboral</p>
            <div class="row">
                <div class="col">
                   <label for="jentry"> Hora de entrada </label>
                    <input class="form-control" type="time" name="jentry" id="jentry" required>
               </div>
                <div class="col">
                    <label for="jexit"> Hora de salida </label>
                    <input class="form-control" type="time" name="jexit" id="jexit" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="datepermit"> Fecha del permiso </label>
            <input class="form-control" type="date" name="datepermit" id="datepermit" required>
        </div>
        <div class="form-group">
            <label for="timepermit"> Duración en horas del permiso </label>
            <input class="form-control" type="number" name="timepermit" id="timepermit"
                   placeholder="Duración en horas" required>
        </div>

        <div class="form-group">
            <p CLASS="bg-primary rounded text-light" align="center">Horario Laboral</p>
            <div class="row">
                <div class="col">
                    <label for="preturn"> Hora de entrada </label>
                    <input class="form-control" type="time" name="preturn" id="preturn" required>
                </div>
                <div class="col">
                    <label for="pexit"> Hora de salida </label>
                    <input class="form-control" type="time" name="pexit" id="pexit" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description"> Descripcion justificada del permiso </label>
            <textarea class="form-control" name="description" id="description"  rows="3"
            placeholder="Introduzca aquí la descripción justificada del permiso" required>

            </textarea>
        </div>

        <div class="form-group">
            <label for="observations">Observaciones del permiso</label>
            <textarea name="observations" class="form-control" id="observations" rows="3"
                      placeholder="Plasme aqui observaciones a cerca de la solicitud de permiso en tramite "
                      required>{{old('observation')}}
                    </textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-file-import"></i> Enviar
            Solicitud de Permiso
        </button>
    </form>
</div>

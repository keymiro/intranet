<div id="form_change_turn"  style="display: none;">
    <div class="card-header bg-primary text-light mb-4 shadow-sm rounded">
       <p> <i class="fas fa-file-import "></i> Formulario de
        Recursos humanos | Cambio de turno
       </p>
    </div>
    <form action="{{route('ChangeTurn.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="numberchangeturn">Número de cambios de turno:</label>
            <select name="numberchangeturn" class="form-control" id="numberchangeturn" required>
                <option value="">Seleccione una opción</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                   <label for="datechangeturn"> Fecha programda de turno </label>
                    <input class="form-control" type="date" name="datechangeturn" id="datechangeturn" required>
               </div>
                <div class="col">
                    <label for="tchangeturn">Horario </label>
                    <select name="tchangeturn" class="form-control" id="tchangeturn" required>
                        <option value="">Seleccione una opción</option>
                        <option value="M">M</option>
                        <option value="T">T</option>
                        <option value="N">N</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
          <label for="namechange">Nombre quien reemplaza</label>
          <input type="text" name="namechange" id="namechange"
          class="form-control"
          placeholder="Nombre quien reemplaza"
           required>
        </div>
        <div class="form-group">
            <label for="celchange">Celular quien reemplaza</label>
            <input type="number" name="celchange" id="celchange"
            class="form-control"
            placeholder="Celular quien reemplaza"
             required>
          </div>
          <div class="form-group">
            <div class="row">
                <div class="col">
                   <label for="returnchangeturn"> Fecha devolución de turno </label>
                    <input class="form-control" type="date"
                    name="returnchangeturn"
                    id="returnchangeturn" required>
               </div>
                <div class="col">
                    <label for="t1changeturn">Horario </label>
                    <select name="t1changeturn" class="form-control"
                     id="t1changeturn" required>
                        <option value="">Seleccione una opción</option>
                        <option value="M">M</option>
                        <option value="T">T</option>
                        <option value="N">N</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="observations">Observaciones</label>
            <textarea name="observations" class="form-control" id="observations" rows="3"
                      placeholder="Plasme aqui observaciones a cerca de la solicitud en tramite "
                      required>{{old('observation')}}
                    </textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-file-import"></i> Enviar
            Solicitud
        </button>
    </form>
</div>

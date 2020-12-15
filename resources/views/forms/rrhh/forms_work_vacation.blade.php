<div id="form_work_vacation"  style="display: none;">
    <div class="card-header bg-primary text-light mb-4 shadow-sm rounded">
        <p> <i class="fas fa-file-import "></i> Formulario de
            Recursos humanos | Vacaciones
        </p>
    </div>
    <form action="{{route('WorkVacation.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <div class="row">

                <div class="col">
                    <p class="my-2 font-weight-bold">Programación de vacaciones (periodo a disfrutar)</p>
                    <label for="startdate"> Fecha inicio vacaciones </label>
                    <input class="form-control" type="date" name="startdate" id="startdate" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="returndate"> Fecha de reanuación laborales </label>
                    <input class="form-control" type="date"
                           name="returndate"
                           id="returndate" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <p class="my-2 font-weight-bold">
                Periodo al cual corresponden las vacaciones a tomar (periodo de causacion)
            </p>
            <div class="row">
                <div class="col">
                    <label for="fromdate"> Desde </label>
                    <input class="form-control" type="date"
                           name="fromdate"
                           id="fromdate" required>
                </div>
                <div class="col">
                    <label for="untildate">Hasta</label>
                    <input type="date" class="form-control"
                           name="untildate"
                           id="untildate" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="businessdays"> No. de días hábiles disponibles para disfrutar </label>
                    <input class="form-control" type="number"
                           name="businessdays"
                           id="businessdays" required
                           placeholder="No. de días hábiles disponibles para disfrutar">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="requesteddays">No. de días solicitados para disfrutar </label>
                    <input class="form-control" type="number"
                           name="requesteddays"
                           id="requesteddays" required
                           placeholder="No. de días solicitados para disfrutar ">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="pendingdays"> No. de días que quedan pendientes para este periodo </label>
                    <input class="form-control" type="number"
                           name="pendingdays"
                           id="pendingdays" required
                           placeholder="No. de días que quedan pendientes para este periodo">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="enjoydays">No dias adisfrutar</label>
                    <input class="form-control" type="number"
                           name="enjoydays"
                           id="enjoydays" required
                           placeholder="No dias a disfrutar">
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

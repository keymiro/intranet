<div id="maintenance_form"  style="display: none;">
    <div class="card-header bg-dark text-light mb-4 shadow rounded">
        <i class="fas fa-file-import "></i> Formulario de
        Mantenimiento
    </div>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        En este formulario podras solicitar un ticket que corresponde a un soporte por
        el área de sistemas
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="prioridad">Prioridad del incidente :</label>
            <select name="priority" class="form-control" id="prioridad" required
                    value="{{old('priority')}}">
                <option value="">Seleccione una prioridad</option>

            </select>
        </div>
        <div class="form-group">
            <label for="ubicacion">Ubicación donde ocurrio el incidente :</label>
            <select name="location" class="form-control" id="ubicacion" required>
                <option value="">Seleccione una ubicación</option>

            </select>
        </div>
        <div class="form-group">
            <label for="titulo">Titulo :</label>
            <input class="form-control" type="text" id="titulo" name="title" placeholder="Titulo, mínimo 5 caracteres"
                   required
                   value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="comentario">Descripción :</label>
            <textarea name="description" class="form-control" id="comentario" rows="3"
                      placeholder="Por favor detalle lo ocurrido, mínimo 15 caracteres" required>{{old('description')}}
                    </textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-file-import"></i> Enviar
            Incidencia
        </button>
    </form>
</div>

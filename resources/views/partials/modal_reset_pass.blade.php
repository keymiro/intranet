<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-key"></i> Cambiar contraseña</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('edit.user.client',auth()->user()->id )}}" method="post">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" name="passOld" type="password" placeholder="Contraseña anterior" required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="passNew" type="password" placeholder="Nueva contraseña" required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="passNewRepet"type="password" placeholder="Repetir nueva contraseña"required>
                </div>
                <small>La contraseña debe ser igual o superior a 8 digitos</small>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit"  class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>

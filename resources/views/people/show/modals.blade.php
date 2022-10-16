<!-- edit privilege modal -->
<form action="#" id="form-editprivilege">
  <div class="modal fade" id="editPrivilegeModal" tabindex="-1" role="dialog" aria-labelledby="editPrivilegeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPrivilegeModalLabel"><b><i class="fas fa-pencil-alt"></i> Editar Privilegio</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="editPrivilegeBody">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btn-modify-privilege">Modificar</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- edit discipline modal -->
<form action="#">
  <div class="modal fade" id="editDisciplineModal" tabindex="-1" role="dialog" aria-labelledby="editDisciplineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDisciplineModalLabel"><b><i class="fas fa-pencil-alt"></i> Editar Disciplina</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="editDisciplineBody">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="btn-modify-discipline">Modificar</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- confirm delete privilege modal -->
<div class="modal fade" id="delPrivilegeModal" tabindex="-1" role="dialog" aria-labelledby="delPrivilegeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delPrivilegeModalLabel"><b><i class="fas fa-exclamation-triangle"></i> Eliminar Privilegio</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="del-priv-modal">
        Confirme que desea eliminar el registro de privilegio definitivamente.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn-del-privilege">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- confirm delete discipline modal -->
<div class="modal fade" id="delDisciplineModal" tabindex="-1" role="dialog" aria-labelledby="delDisciplineModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delDisciplineModalLabel"><b><i class="fas fa-exclamation-triangle"></i> Eliminar Disciplina</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="del-disp-modal">
        Confirme que desea eliminar el registro de disciplina definitivamente.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn-del-discipline">Eliminar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade text-left" id="modal_especialidad" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="lblTitle">Especialidades y Certificaciones:</h5>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form method="post" id="miembro_especialidad_form">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h6>Especialidad *</h6>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" id="especialidad" name="especialidad" placeholder="Especialidad">
                                    <div class="form-control-position">
                                        <i class="bx bx-user"></i>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <input type="hidden" name="id_miembro" id="id_miembro">
                    </form>
                    <div class="table-responsive">
                        <table id="data_especialidad" class="stripe row-border order-column">
                            <thead>
                                <tr>
                                    <th>Especialidad</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="return cerrarModal()" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cancelar</span>
                </button>
                <button type="button" onclick="return guardarEspecialidad()" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Guardar</span>
                </button>
            </div>
        </div>
    </div>
</div>
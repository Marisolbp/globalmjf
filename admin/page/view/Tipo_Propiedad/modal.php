<div class="modal fade text-left" id="modal_tipo_propiedad" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="lblTitle"></h5>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form method="post" id="tipo_propiedad_form">
                        <div class="tab-content">
                            <div class="tab-pane active fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <input type="hidden" id="codigo" name="codigo">
                                            <div class="col-md-9 col-sm-12">
                                                <h6>Nombre</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-home"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <input type="hidden" name="estado_real" id="estado_real" value="A">

                                            <div class="col-md-3 col-sm-12">
                                                <h6>Estado</h6>
                                                <div class="custom-control custom-switch custom-control-inline mb-0">
                                                    <input type="checkbox" class="custom-control-input" id="estado" name="estado">
                                                        <label class="custom-control-label mr-1" for="estado">
                                                        </label>
                                                        <span id="lblEstado">Activo</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="return cerrarModal()" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cancelar</span>
                </button>
                <button type="button" onclick="return guardarRegistro()" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Guardar</span>
                </button>
            </div>
        </div>
    </div>
</div>
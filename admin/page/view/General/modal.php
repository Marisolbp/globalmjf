<div class="modal fade text-left" id="modal_valor" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="lblTitle">Nuevo valor</h5>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form method="post" id="valor_form">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <h6>Valor</h6>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor">
                                                <div class="form-control-position">
                                                    <i class="bx bx-buildings"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <h6>Descripción</h6>
                                            <fieldset class="form-group">
                                                <textarea class="form-control" id="descrip" name="descrip" rows="3" placeholder="Descripción"></textarea>
                                            </fieldset>
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
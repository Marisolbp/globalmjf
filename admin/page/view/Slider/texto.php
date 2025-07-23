<div class="modal fade text-left" id="modal_texto_slider" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="lblTitle">Texto para slider</h5>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form method="post" id="texto_slider_form">
                        <div class="tab-content">
                            <div class="tab-pane active fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <input type="hidden" id="id_slider" name="id_slider">
                                            <div class="col-md-12 col-sm-12">
                                                <h6>Titulo</h6>
                                                <fieldset class="form-group">
                                                    <textarea class="form-control" id="titulo" name="titulo" rows="2" placeholder="Descripción"></textarea>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <h6>Subtitulo</h6>
                                                <fieldset class="form-group">
                                                    <textarea class="form-control" id="subtitulo" name="subtitulo" rows="3" placeholder="Descripción"></textarea>
                                                </fieldset>
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
                <button type="button" onclick="return guardarTexto()" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Guardar</span>
                </button>
            </div>
        </div>
    </div>
</div>
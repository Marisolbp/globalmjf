<div class="modal fade text-left" id="modal_foto_indep" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="lblTitle">Fotos de independización</h5>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form method="post" id="independizacion_foto_form">
                        <div class="tab-content">
                            <div class="tab-pane active fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="dropzone dz-custom-style" id="upload-form">
                                            <div class="dz-message">
                                                <i class="bx bx-cloud-upload upload-icon"></i>
                                                <p>Arrastra o selecciona la foto</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_indep" id="id_indep">
                    </form>
                    <div class="table-responsive">
                        <table id="data_foto_independizacion" class="stripe row-border order-column">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Foto</th>
                                    <th>Orden</th>
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
                <button type="button" onclick="return gardarFoto()" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Guardar</span>
                </button>
            </div>
        </div>
    </div>
</div>
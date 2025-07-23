<div class="modal fade text-left" id="modal_miembro" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="lblTitle"></h5>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form method="post" id="miembro_form">
                        <div class="tab-content">
                            <div class="tab-pane active fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="row">
                                            <input type="hidden" id="codigo" name="codigo">
                                            <div class="col-md-6 col-sm-12">
                                                <h6>Nombres *</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-user"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <h6>Apellido *</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-user"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <h6>CAP *</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="codcap" name="codcap" placeholder="CAP">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-briefcase"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <h6>Puesto *</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="puesto" name="puesto" placeholder="Puesto">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-briefcase"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-12 col-sm-12">
                                                <h6>Detalle puesto *</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="detapuesto" name="detapuesto" placeholder="Detalle puesto">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-briefcase"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <h6>Correo *</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-envelope"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <h6>Contacto</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Contacto">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-phone"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <h6>LinkedIn</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn">
                                                    <div class="form-control-position">
                                                        <i class="bx bxl-linkedin"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <h6>Instragram</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram">
                                                    <div class="form-control-position">
                                                        <i class="bx bxl-instagram"></i>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-md-12 col-sm-12">
                                                <h6>Descripción *</h6>
                                                <fieldset class="form-group">
                                                    <textarea class="form-control" id="descrip" name="descrip" rows="3" placeholder="Descripción"></textarea>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-3 col-sm-6">
                                                <h6>Orden *</h6>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="orden" name="orden" placeholder="Orden">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-sort"></i>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <input type="hidden" name="estado_real" id="estado_real" value="A">

                                            <div class="col-md-3 col-sm-6">
                                                <h6>Estado</h6>
                                                <div class="custom-control custom-switch custom-control-inline mt-0">
                                                    <input type="checkbox" class="custom-control-input" id="estado" name="estado">
                                                        <label class="custom-control-label mr-1" for="estado">
                                                        </label>
                                                        <span id="lblEstado">Activo</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <h6>Foto de perfil</h6>
                                        <div class="dropzone dz-custom-style" id="upload-form">
                                            <div class="dz-message">
                                                <i class="bx bx-cloud-upload upload-icon"></i>
                                                <p>Arrastra o selecciona la foto del miembro</p>
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
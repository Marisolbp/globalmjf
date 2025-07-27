<div class="modal fade text-left" id="modal_solicitud" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="lblTitle"></h5>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form method="post" id="solicitud_form">
                        <div class="tab-content">
                            <div class="tab-pane active fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                <div class="row">
                                    <input type="hidden" id="codigo" name="codigo">

                                    <div class="col-md-6 col-sm-12">
                                        <h6>Documento</h6>
                                        <div class="form-group">
                                            <select class="form-control" id="tip_doc" name="tip_doc">
                                                <option value="DNI">DNI</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="RUC">RUC</option>    
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <h6>N° documento</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="dni" name="dni" placeholder="N° documento">
                                            <div class="form-control-position">
                                                <i class="bx bx-id-card"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <h6>Nombre</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                            <div class="form-control-position">
                                                <i class="bx bx-user"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <h6>Apellido</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                                            <div class="form-control-position">
                                                <i class="bx bx-user"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <h6>Email</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                            <div class="form-control-position">
                                                <i class="bx bx-envelope"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <h6>N° telefono</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="N° telefono">
                                            <div class="form-control-position">
                                                <i class="bx bx-phone"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <h6>Propiedad</h6>
                                        <div class="form-group">
                                            <select class="select2 form-control" id="id_t_prop" name="id_t_prop">
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <h6>Modalidad</h6>
                                        <div class="form-group">
                                            <select class="select2 form-control" id="modalidad" name="modalidad">
                                                <option value="">-- Seleccionar --</option>
                                                <option value="V">Venta</option>
                                                <option value="A">Alquiler</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <h6>Departamento</h6>
                                        <select class="select2 form-control" id="id_depart" name="id_depart"></select>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <h6>Provincia</h6>
                                        <select class="select2 form-control" id="id_provin" name="id_provin"></select>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <h6>Distrito</h6>
                                        <select class="select2 form-control" id="id_distri" name="id_distri"></select>
                                    </div>

                                    <div class="col-md-12 col-sm-12 mt-1">
                                        <h6>Descripción</h6>
                                        <div id="snow-editor-d" style="height: 150px;" class="mb-1">
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
                <button type="button" onclick="return rechazarSolicitud()" class="btn btn-danger ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Rechazar</span>
                </button>
                <button type="button" onclick="return aceptarSolicitud()" class="btn btn-success ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Aceptar</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="modal_propiedad" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="lblTitle"></h5>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form method="post" id="propiedad_form">
                        <div class="tab-content">
                            <div class="tab-pane active fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                <div class="row">
                                    <input type="hidden" id="id" name="id">
                                    
                                    <div class="col-md-3 col-sm-12">
                                        <h6>Código</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código">
                                            <div class="form-control-position"><i class="bx bx-barcode"></i></div>
                                        </fieldset>
                                    </div>

                                    <!-- Nombre -->
                                    <div class="col-md-5 col-sm-12">
                                        <h6>Nombre</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                            <div class="form-control-position"><i class="bx bx-home"></i></div>
                                        </fieldset>
                                    </div>

                                    <!-- Propiedad -->
                                    <div class="col-md-4 col-sm-12">
                                        <h6>Propiedad</h6>
                                        <div class="form-group">
                                            <select class="select2 form-control" id="id_t_prop" name="id_t_prop">
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Moneda -->
                                    <div class="col-md-3 col-sm-12">
                                        <h6>Moneda</h6>
                                        <div class="form-group">
                                            <select class="select2 form-control" id="moneda" name="moneda">
                                                <option value="">-- Seleccionar --</option>
                                                <option value="PEN">Soles (PEN)</option>
                                                <option value="USD">Dólares (USD)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Precio -->
                                    <div class="col-md-3 col-sm-12">
                                        <h6>Precio</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control text-start input-mask " id="precio" name="precio" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                                            <div class="form-control-position"><i class="bx bx-money"></i></div>
                                        </fieldset>
                                    </div>

                                    <!-- Valor m² -->
                                    <div class="col-md-3 col-sm-12">
                                        <h6>Valor m²</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control text-start input-mask" id="valmcua" name="valmcua" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                                            <div class="form-control-position"><i class="bx bx-ruler"></i></div>
                                        </fieldset>
                                    </div>

                                    <!-- Modalidad -->
                                    <div class="col-md-3 col-sm-12">
                                        <h6>Modalidad</h6>
                                        <div class="form-group">
                                            <select class="select2 form-control" id="modalidad" name="modalidad">
                                                <option value="">-- Seleccionar --</option>
                                                <option value="V">Venta</option>
                                                <option value="A">Alquiler</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Ubicación Geográfica -->
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

                                    <!-- Dirección y Coordenadas -->
                                    <div class="col-md-6 col-sm-12 mt-1">
                                        <h6>Dirección</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                                            <div class="form-control-position"><i class="bx bx-map"></i></div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3 col-sm-12  mt-1">
                                        <h6>Longitud</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud">
                                            <div class="form-control-position"><i class="bx bx-map"></i></div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3 col-sm-12 mt-1">
                                        <h6>Latitud</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud">
                                            <div class="form-control-position"><i class="bx bx-map"></i></div>
                                        </fieldset>
                                    </div>


                                    <div class="col-md-3 col-sm-12">
                                        <h6>N° Pisos</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="npisos" name="npisos">
                                            <div class="form-control-position">
                                                <i class="bx bx-home"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <h6>N° Dormitorios</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="ndormit" name="ndormit">
                                            <div class="form-control-position">
                                                <i class="bx bx-bed"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <h6>N° Baños</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="nbanos" name="nbanos">
                                            <div class="form-control-position">
                                                <i class="bx bx-water"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <h6>N° Cochera</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="ncochera" name="ncochera">
                                            <div class="form-control-position">
                                                <i class="bx bx-car"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <h6>N° Cocina</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="ncocina" name="ncocina">
                                            <div class="form-control-position">
                                                <i class="bx bx-fridge"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <h6>N° Lavanderia</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="nlavand" name="nlavand">
                                            <div class="form-control-position">
                                                <i class="bx bx-home"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <h6>N° Depósitos</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="ndeposito" name="ndeposito">
                                            <div class="form-control-position">
                                                <i class="bx bx-home"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <h6>Antiguedad</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="antiguedad" name="antiguedad" placeholder="Antiguedad">
                                            <div class="form-control-position">
                                                <i class="bx bx-calendar"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-2 col-sm-12">
                                        <h6>Mantenimiento</h6>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control text-start input-mask" id="mantenimiento" name="mantenimiento" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                                            <div class="form-control-position">
                                                <i class="bx bx-money"></i>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <h6>Estado del inmueble</h6>
                                        <div class="form-group">
                                            <select class="select2 form-control" id="estado_im" name="estado_im">
                                                <option value="">--Seleccionar--</option>
                                                <option value="B">Bueno</option>
                                                <option value="R">Regular</option>
                                                <option value="M">Malo</option> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <h6>Ubicado</h6>
                                        <div class="form-group">
                                            <select class="select2 form-control" id="ubicacion" name="ubicacion">
                                                <option value="">--Seleccionar--</option>
                                                <option value="E">Esquinero</option>
                                                <option value="ME">Medianero</option>
                                                <option value="I">Intermedio</option>
                                                <option value="F">Frontal</option> 
                                                <option value="P">Posterior </option> 
                                                <option value="D">Doble frente </option> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-12">
                                        <h6>Área total</h6>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-start input-mask" id="atotal" name="atotal" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                                            <div class="input-group-append">
                                                <span class="input-group-text">m²</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-12">
                                        <h6>Área construida</h6>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-start input-mask" id="aconstru" name="aconstru" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                                            <div class="input-group-append">
                                                <span class="input-group-text">m²</span>
                                            </div>
                                        </div>
                                    </div>  


                                    <div class="col-md-12 col-sm-12">
                                        <h6>Descripción</h6>
                                        <div id="snow-editor-d" style="height: 150px;" class="mb-1">
                                        </div>
                                    </div>

                                    <input type="hidden" name="estado_real" id="estado_real" value="A">

                                    <div class="col-md-3 col-sm-12">
                                        <h6>Estado</h6>
                                        <div class="custom-control custom-switch custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="estado" name="estado">
                                                <label class="custom-control-label mr-1" for="estado">
                                                </label>
                                                <span id="lblEstado">Activo</span>
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
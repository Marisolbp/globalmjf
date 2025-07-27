var tabla;

const quill_d = new Quill('#snow-editor-d', {
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['image', 'code-block'],
            [{ list: 'ordered' }, { list: 'bullet' }],
        ],
    },
    placeholder: 'Descripción de proyecto',
    theme: 'snow', // or 'bubble'
    });

$(document).ready(function(){
    tabla=$('#data_propiedad').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "searching": true,
        lengthChange: false,
        colReorder: true,
        "ordering": false,
        columnDefs: [
            { width: "5%", targets: 0, className: 'text-center'},
            { width: "15%", targets: 1, className: 'text-center'},
            { width: "10%", targets: 2, className: 'text-center'},
            { width: "10%", targets: 3, className: 'text-center'},
            { width: "5%", targets: 4, className: 'text-center'},
            { width: "15%", targets: 5, className: 'text-center'},
            { width: "10%", targets: 6, className: 'text-center'},
            { width: "10%", targets: 7, className: 'text-center'},
            { width: "10%", targets: 8, className: 'text-center'},
            { width: "5%", targets: 9, className: 'text-center'},
            { width: "5%", targets: 10, className: 'text-center'}
        ],
        fixedColumns: {
            left: 1,
            right: 2
        },
        scrollCollapse: true,
        scrollX: true,
        "ajax":{
            url: '../../controller/propiedad.php?op=listar',
            type : "post",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }     
    }).DataTable();

    $.post("../../controller/tipo_propiedad.php?op=combo_tip_pro",function(data, status){
        $('#id_t_prop').html(data);
    });

    $('#estado').prop('checked', true);

    $.post("../../controller/ubicacion.php?op=combo_depart",function(data, status){
        $('#id_depart').html(data);
    });

    // Definimos los campos por tipo de propiedad
    const camposPorTipo = {
        "1": [ // CASA
            "#npisos", "#ndormit", "#nbanos", "#ncochera",
            "#ncocina", "#nlavand", "#ndeposito", "#antiguedad",
            "#atotal", "#aconstru"
        ],
        "2": [ // DEPARTAMENTO
            "#npisos", "#ndormit", "#nbanos", "#ncochera",
            "#ncocina", "#nlavand", "#ndeposito",
            "#antiguedad", "#mantenimiento",
            "#atotal", "#aconstru"
        ],
        "3": [ // TERRENO
            "#atotal"
        ]
    };

    // Todos los campos posibles
    const todosCampos = [
        "#npisos", "#ndormit", "#nbanos", "#ncochera",
        "#ncocina", "#nlavand", "#ndeposito", "#antiguedad",
        "#mantenimiento",
        "#atotal", "#aconstru"
    ];

    // Función principal
    function actualizarCampos() {
        const tipoSeleccionado = $('#id_t_prop').val();
        
        // Si no hay selección, deshabilitar todo
        if (!tipoSeleccionado) {
            todosCampos.forEach(campo => {
                $(campo).prop('readonly', true).val('');
                if ($(campo).hasClass('select2')) {
                    $(campo).select2('enable', false);
                }
            });
            return;
        }

        // Obtener campos permitidos para este tipo
        const camposPermitidos = camposPorTipo[tipoSeleccionado] || [];

        // Actualizar cada campo
        todosCampos.forEach(campo => {
            const elemento = $(campo);
            
            if (camposPermitidos.includes(campo)) {
                // Habilitar campo
                elemento.prop('readonly', false);
                if (elemento.hasClass('select2')) {
                    elemento.select2('enable', true);
                }
                elemento.closest('.form-group, .input-group').css('opacity', '1');
            } else {
                // Deshabilitar campo
                elemento.prop('readonly', true).val('');
                if (elemento.hasClass('select2')) {
                    elemento.select2('enable', false);
                }
                elemento.closest('.form-group, .input-group').css('opacity', '0.5');
            }
        });
    }

    // Event listener
    $('#id_t_prop').on('change', actualizarCampos);
    
    // Ejecutar al cargar
    actualizarCampos();
});

$('#id_depart').on('change', function () {

    $('#id_provin').prop('disabled', false); 

    $.post("../../controller/ubicacion.php?op=combo_prov", { id_depart : $(this).val() }, function(data, status){
        $('#id_provin').html(data);
    });
});

$('#id_provin').on('change', function () {

    $('#id_distri').prop('disabled', false); 

    $.post("../../controller/ubicacion.php?op=combo_dist_prov", { id_provin : $(this).val() }, function(data, status){
        $('#id_distri').html(data);
    });
});

$('#estado').on('change', function () {
    
    if ($(this).is(':checked')) {
        $('#estado_real').val('A');
        $('#lblEstado').text('Activo');
    } else {
        $('#estado_real').val('I');
        $('#lblEstado').text('Inactivo');
    }
});

function nuevoRegistro(){
    $('#estado').prop('checked', true); 
    
    $("#id").val('');

    $('#lblTitle').html('Nuevo registro');
    $('#modal_propiedad').modal('show');
}

function guardarRegistro(){
    var formData = new FormData($("#propiedad_form")[0]);
    var tipo = $("#id_t_prop").val(); // “1”=Terreno, “2”=Departamento, “3”=Casa

    // Definimos los campos que deberán validarse para cada tipo
    const camposPorTipo = {
        "1": [ // CASA
            "#codigo", "#nombre",
            "#id_t_prop", "#moneda", "#precio",
            "#modalidad", "#id_depart", "#id_provin", "#id_distri",
            "#direccion", "#longitud", "#latitud",
            "#npisos", "#ndormit", "#nbanos", "#ncochera",
            "#ncocina", "#nlavand", "#ndeposito",
            "#estado_im", "#ubicacion", "#atotal"
        ],
        "2": [ // DEPARTAMENTO
            "#codigo", "#nombre",
            "#id_t_prop", "#moneda", "#precio",
            "#modalidad", "#id_depart", "#id_provin", "#id_distri",
            "#direccion", "#longitud", "#latitud",
            "#npisos", "#ndormit", "#nbanos", "#ncochera",
            "#ncocina", "#nlavand", "#ndeposito",
            "#antiguedad",
            "#estado_im", "#ubicacion", "#atotal"
        ],
        "3": [ // TERRENO
            "#codigo", "#nombre",
            "#id_t_prop", "#moneda", "#precio",
            "#modalidad", "#id_depart", "#id_provin", "#id_distri", 
            "#direccion", "#longitud", "#latitud",
             "#estado_im", "#ubicacion", "#atotal"
        ]
        
    };

    // Obtenemos el array de campos adecuado
    const campos = camposPorTipo[tipo];
    if (!campos) {
        Swal.fire({
        icon: "error",
        title: "Tipo de propiedad inválido",
        text: "Por favor selecciona un tipo de propiedad válido."
        });
        return false;
    }

    // Validamos cada campo de la lista
    for (let selector of campos) {
        const $campo = $(selector);
        // Si el campo existe y su valor está vacío...
        if ($campo.length && $.trim($campo.val()) === "") {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
        Toast.fire({
            icon: "warning",
            title: "Complete todos los datos requeridos"
        });
        $campo.focus();
        return false;
        }
    }

    var editorHTMLContentD = quill_d.root.innerHTML.trim();

    if (editorHTMLContentD.length === 0) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });
    
          Toast.fire({
            icon: "warning",
            title: "Complete la descripción",
          });

        quill_d.focus(); // Enfoca el editor si está vacío
        return false;
    } else {
        formData.append("descrip", editorHTMLContentD);

        let url_ajax, resultado;

        if($('#id').val() != ''){
            url_ajax = "../../controller/propiedad.php?op=editar";
            resultado = 'Propiedad actualizado';
        } else {
            url_ajax = "../../controller/propiedad.php?op=registrar";
            resultado = 'Propiedad registrado';
        }

        $.ajax({
            url: url_ajax,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                if (datos.success == 1) {

                    cerrarModal()
                    
                    $("#propiedad_form")[0].reset();
                    $("#select2-id_t_prop-container").empty(); 
                    $("#select2-id_t_prop-container").html("-- Seleccionar --");

                    quill_d.setText('');

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer);
                            toast.addEventListener("mouseleave", Swal.resumeTimer);
                        },
                    });
                    Toast.fire({
                        icon: "success",
                        title: resultado,
                    });

                    $('#data_propiedad').DataTable().ajax.reload();	

                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                        },
                    });
                    Toast.fire({
                        icon: "error",
                        title: "Error, algo salió mal",
                    });
                }
            },
        });
    }
}

function editarRegistro(id){
    $('#lblTitle').html('Editar registro');
    $('#modal_propiedad').modal('show');

    $("#id").val(id);

    $.post("../../controller/propiedad.php?op=obtener", { id: id }, function (data) {
        data = JSON.parse(data);

        $('#codigo').val(data.codigo);
        $('#nombre').val(data.nombre);
        
        quill_d.root.innerHTML = data.descrip;

        $('#moneda').val(data.moneda).trigger('change');
        $("#select2-moneda-container").html(data.moneda);

        $('#modalidad').val(data.modalidad).trigger('change');
        let modalidad = data.modalidad === 'V' ? 'Venta' : 'Alquiler';

        $("#select2-modalidad-container").html(modalidad);

        $('#id_depart').val(data.id_depart).trigger('change');
        $("#select2-id_depart-container").html(data.departamento);

        // Esperar a que termine de cargar provincias antes de asignar provincia
        $.post("../../controller/ubicacion.php?op=combo_prov", { id_depart: data.id_depart }, function(provinciasHTML) {
            $('#id_provin').html(provinciasHTML);
            $('#id_provin').val(data.id_provin).trigger('change');

            // Ahora hacemos lo mismo para distrito
            $.post("../../controller/ubicacion.php?op=combo_dist_prov", { id_provin: data.id_provin }, function(distritosHTML) {
                $('#id_distri').html(distritosHTML);
                $('#id_distri').val(data.id_distri).trigger('change');
            });
        });

        $('#direccion').val(data.direccion);

        $('#longitud').val(data.longitud);
        $('#latitud').val(data.latitud);

        $('#npisos').val(data.npisos);
        $('#ndormit').val(data.ndormit);
        $('#nbanos').val(data.nbanos);
        $('#ncochera').val(data.ncochera);
        $('#ncocina').val(data.ncocina);
        $('#nlavand').val(data.nlavand);
        $('#ndeposito').val(data.ndeposito);

        $('#id_t_prop').val(data.id_t_prop).trigger('change');
        $("#select2-id_t_prop-container").html(data.tipo);

        $('#precio').val(data.precio);
        $('#modalidad').val(data.modalidad);
        $('#antiguedad').val(data.antiguedad);
        $('#mantenimiento').val(data.mantenimiento);

        $('#ubicacion').val(data.ubicacion);
        let ubicacionTexto = {
            E: 'Esquinero',
            ME: 'Medianero',
            I: 'Intermedio',
            F: 'Frontal',
            P: 'Posterior',
            D: 'Doble frente'
        }[data.ubicacion] || '';
        $("#select2-ubicacion-container").html(ubicacionTexto);

        $('#estado_im').val(data.estado_im);
        let estado_im_texto = { B: 'Bueno', R: 'Regular', M: 'Malo' }[data.estado_im] || '';
        $("#select2-estado_im-container").html(estado_im_texto);

        $('#atotal').val(data.atotal);
        $('#aconstru').val(data.aconstru);

        $('#valmcua').val(data.valmcua);

        $('#estado').prop('checked', data.estado !== 'I');
    });
}

function cerrarModal(){
    $('#modal_propiedad').modal('hide'); 
    
    $("#propiedad_form")[0].reset();

    $("#select2-moneda-container").empty();
    document.getElementById("select2-moneda-container").innerHTML="-- Seleccionar --";
    $("#select2-modalidad-container").empty();
    document.getElementById("select2-modalidad-container").innerHTML="-- Seleccionar --";
    $("#select2-id_depart-container").empty();
    document.getElementById("select2-id_depart-container").innerHTML="-- Seleccionar --";
    $("#select2-id_provin-container").empty();
    document.getElementById("select2-id_provin-container").innerHTML="-- Seleccionar --";
    $("#select2-id_distri-container").empty();
    document.getElementById("select2-id_distri-container").innerHTML="-- Seleccionar --";
    $("#select2-id_t_prop-container").empty();
    document.getElementById("select2-id_t_prop-container").innerHTML="-- Seleccionar --";
    $("#select2-ubicacion-container").empty();
    document.getElementById("select2-ubicacion-container").innerHTML="-- Seleccionar --";
    $("#select2-estado_im-container").empty();
    document.getElementById("select2-estado_im-container").innerHTML="-- Seleccionar --";

    /* $('#modal_foto_proyecto').modal('hide'); 

    myDropzone.removeAllFiles(true); */
}

$(document).on('shown.bs.dropdown', '.dropup', function () {
    let $menu = $(this).find('.dropdown-menu');
    let offset = $menu.offset();
    
    $menu.appendTo('body')
        .css({
            display: 'block',
            top: offset.top,
            left: offset.left,
            position: 'absolute',
            zIndex: 9999
        })
        .addClass('dropdown-fixed');
});

$(document).on('hide.bs.dropdown', '.dropup', function () {
    let $dropdown = $(this);
    let $menu = $('body .dropdown-menu.dropdown-fixed');

    $menu.appendTo($dropdown)
         .removeAttr('style')
         .removeClass('dropdown-fixed');
});

function registrarFoto(id){

    listarFoto(id)

    $('#id_propiedad').val(id)
    $('#modal_foto_propiedad').modal('show');
}

$(document).on('change', '.input-orden', function () {
    let nuevoOrden = $(this).val();
    let id = $(this).data('id');

    $.ajax({
        url: '../../controller/propiedad.php?op=actualizar_orden_foto',
        method: 'POST',
        data: { id: id, orden: nuevoOrden },
        success: function (resp) {
            let r = JSON.parse(resp);
            if (r.success == 1) {
                $('#data_foto_propiedad').DataTable().ajax.reload();
            } else {
                toastr.error('Error al actualizar el orden');
            }
        }
    });
});

function listarFoto(id){
    tabla_foto=$('#data_foto_propiedad').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "searching": false,
        lengthChange: false,
        colReorder: true,
        "ordering": false,
        columnDefs: [
            { width: "35%", targets: 0, className: 'text-left'},
            { width: "35%", targets: 1, className: 'text-center'},
            { width: "25%", targets: 2, className: 'text-center'},
            { width: "5%", targets: 3, className: 'text-center'}
        ],
        "ajax":{
            url: '../../controller/propiedad.php?op=listar_foto',
            type : "post",
            dataType : "json",
            data: {id_propiedad : id},						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }     
    }).DataTable();
}

// Inicializar Dropzone
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#upload-form", {
    url: "../../controller/propiedad.php?op=registrar", // Solo para inicializar
    paramName: "file",
    maxFilesize: 10, // MB
    acceptedFiles: ".jpg,.jpeg,.png,.gif,.bmp,.webp,.avif",
    dictDefaultMessage: "Arrastra los archivos aquí para subirlos o haz clic",
    autoProcessQueue: false,
    uploadMultiple: false,
    maxFiles: 5,
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar",

    init: function () {
        this.on("addedfile", function (file) {
            // Ocultar el mensaje e ícono cuando se agrega un archivo
            $('#upload-form .dz-message').hide();
        });

        this.on("removedfile", function (file) {
            // Mostrar el mensaje e ícono si se elimina el archivo
            if (this.files.length === 0) {
                $('#upload-form .dz-message').show();
            }
        });

        this.on("success", function (file, response) {
            console.log("Archivo subido exitosamente", response);
        });

        this.on("error", function (file, errorMessage) {
            console.log("Error al subir el archivo", errorMessage);
        });

        // Guardamos referencia para usar fuera
        window.dropzoneInstance = this;

    }
});

function guardarFoto(){
    var formData = new FormData($("#propiedad_foto_form")[0]);

    if (myDropzone.files.length === 0) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });
    
          Toast.fire({
            icon: "warning",
            title: "Debe cargar una foto",
          });
    
          $(campos[i]).focus();
          return false;
    } else {
  
        myDropzone.files.forEach((file, i) => {
            formData.append("foto" + i, file); // Añade los archivos al FormData
        });
        
        formData.append("total_archivos", myDropzone.files.length); // Enviamos el total de archivos también
  
        //Registrar archivo
        $.ajax({
            url: "../../controller/propiedad.php?op=registrar_foto",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                if (datos.success == 1) {

                    myDropzone.removeAllFiles(true); // Limpiar Dropzone

                    $('#data_foto_propiedad').DataTable().ajax.reload();

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer);
                            toast.addEventListener("mouseleave", Swal.resumeTimer);
                        },
                    });
                    Toast.fire({
                        icon: "success",
                        title: 'Foto registradas correctamente',
                    });
                } else if (datos.archivos_duplicados > 0) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer);
                            toast.addEventListener("mouseleave", Swal.resumeTimer);
                        },
                    });
                    Toast.fire({
                        icon: "warning",
                        title: datos.archivos_duplicados + " foto(s) ya ha sido registrada",
                    });
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer);
                            toast.addEventListener("mouseleave", Swal.resumeTimer);
                        },
                    });
                    Toast.fire({
                        icon: "error",
                        title: "Error, algo salió mal",
                    });
                }
            },
        });
    }
}

function eliminarFoto(id){
    swal({
        title: "Atención",
        text: "¿Desea elimiar foto?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
      },
      function(isConfirm) {
          if (isConfirm) {
              $.post("../../controller/propiedad.php?op=eliminar", {id : id}, function (data) {
              }); 
    
              $('#data_foto_propiedad').DataTable().ajax.reload();	
    
              swal({
                  title: "Correcto",
                  text: "Foto eliminada",
                  type: "success",
                  confirmButtonClass: "btn-success"
              });
          }
      });
}

// Función JavaScript para cargar los detalles de la propiedad
function verDetalle(id){
    // Mostrar el modal
    $('#modal_detalle').modal('show');
    
    // Cambiar el título del modal
    $('#lblTitle').text('Detalles de la Propiedad');
    
    
    // Llamar al controlador para obtener los detalles
    $.post("../../controller/propiedad.php?op=detalle", { id: id }, function(data){
        // La respuesta ya viene con el HTML generado desde el controlador
        $('#detalle_propiedad').html(data);
    });
}
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
    placeholder: 'Descripción de módulo',
    theme: 'snow', // or 'bubble'
    });

$(document).ready(function(){
    tabla=$('#data_independizacion').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "searching": true,
        lengthChange: false,
        colReorder: true,
        "ordering": false,
        columnDefs: [
            { width: "40%", targets: 0, className: 'text-left'},
            { width: "20%", targets: 1, className: 'text-center'},
            { width: "15%", targets: 2, className: 'text-center'},
            { width: "15%", targets: 3, className: 'text-center'},
            { width: "10%", targets: 4, className: 'text-center'}
        ],
        "ajax":{
            url: '../../controller/independizacion.php?op=listar',
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

    $('#estado').prop('checked', true); 

    $.post("../../controller/ubicacion.php?op=combo_dist",function(data, status){
        $('#id_distri').html(data);
    });

    $.post("../../controller/independizacion.php?op=obtener_descripcion", function(response) {
        const datos = JSON.parse(response);
    
        if (datos.success === 1) {
            const info = datos.data;
            quill_d.root.innerHTML = info.descripcion || "";
        } else {
            console.log("No hay datos previos en la configuración.");
        }
    });
});

function guardarInfoModulo(){
    var formData = new FormData($("#module_independizacion_form")[0]);

    var editorHTMLContentD  = quill_d.getText().trim();
    var descripcionHTML = quill_d.root.innerHTML;

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

        quill_v.focus(); // Enfoca el editor si está vacío
        return false;
    } else {

        formData.append("descripcion", descripcionHTML);

        $.ajax({
            url: "../../controller/independizacion.php?op=registrar_info_modulo",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                if (datos.success == 1) {

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
                    title: "Información actualizada",
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
    
    $('#lblTitle').html('Nuevo registro');
    $('#modal_independizacion').modal('show');
}

function guardarRegistro(){
    var formData = new FormData($("#independizacion_form")[0]);
    const campos = [
        "#nombre",
        "#id_distri",
        "#area"
    ];
  
    for (let i = 0; i < campos.length; i++) {
      if ($(campos[i]).val().trim() === "") {

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
          title: "Complete todos los datos",
        });
  
        $(campos[i]).focus();
        return false;
      }
    }

    let url_ajax, resultado;

    if($('#codigo').val() != ''){
        url_ajax = "../../controller/independizacion.php?op=editar";
        resultado = 'Independizacion actualizado';
    } else {
        url_ajax = "../../controller/independizacion.php?op=registrar";
        resultado = 'Independizacion registrado';
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

                $("#independizacion_form")[0].reset();
                $("#select2-id_distri-container").empty(); 
                $("#select2-id_distri-container").html("-- Seleccionar --");

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

                $('#data_independizacion').DataTable().ajax.reload();	

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

function editarRegistro(id){
    $('#lblTitle').html('Editar registro');
    $('#modal_independizacion').modal('show');

    $("#codigo").val(id);

    $.post("../../controller/independizacion.php?op=obtener", { id: id }, function (data) {
        data = JSON.parse(data);
        $('#nombre').val(data.nombre);
        $("#id_distri").val(data.id_distri);
        $("#select2-id_distri-container").html(data.distrito);
        $('#area').val(data.area);

        if(data.estado == 'I'){
            $('#estado').prop('checked', false); 
        } else {
            $('#estado').prop('checked', true); 
        }
        
    });
}

function cerrarModal(){
    $('#modal_independizacion').modal('hide'); 
    
    $("#independizacion_form")[0].reset();

    $('#modal_foto_indep').modal('hide'); 

    myDropzone.removeAllFiles(true); // Limpiar Dropzone
}

function registrarFoto(id){

    listarFoto(id)

    $('#id_indep').val(id)
    $('#modal_foto_indep').modal('show');
}

$(document).on('change', '.input-orden', function () {
    let nuevoOrden = $(this).val();
    let id = $(this).data('id');

    $.ajax({
        url: '../../controller/independizacion.php?op=actualizar_orden_foto',
        method: 'POST',
        data: { id: id, orden: nuevoOrden },
        success: function (resp) {
            let r = JSON.parse(resp);
            if (r.success == 1) {
                $('#data_foto_independizacion').DataTable().ajax.reload();
            } else {
                toastr.error('Error al actualizar el orden');
            }
        }
    });
});

function listarFoto(id){
    tabla_foto=$('#data_foto_independizacion').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "searching": false,
        lengthChange: false,
        colReorder: true,
        "ordering": false,
        columnDefs: [
            { width: "30%", targets: 0, className: 'text-left'},
            { width: "35%", targets: 1, className: 'text-center'},
            { width: "25%", targets: 2, className: 'text-center'},
            { width: "5%", targets: 3, className: 'text-center'}
        ],
        "ajax":{
            url: '../../controller/independizacion.php?op=listar_foto',
            type : "post",
            dataType : "json",
            data: {id_indep : id},						
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
    url: "../../controller/independizacion.php?op=registrar", // Solo para inicializar
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

function gardarFoto(){
    var formData = new FormData($("#independizacion_foto_form")[0]);

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
            url: "../../controller/independizacion.php?op=registrar_foto",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                if (datos.success == 1) {

                    myDropzone.removeAllFiles(true); // Limpiar Dropzone

                    $('#data_foto_independizacion').DataTable().ajax.reload();

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
              $.post("../../controller/independizacion.php?op=eliminar", {id : id}, function (data) {
              }); 
    
              $('#data_foto_independizacion').DataTable().ajax.reload();	
    
              swal({
                  title: "Correcto",
                  text: "Foto eliminada",
                  type: "success",
                  confirmButtonClass: "btn-success"
              });
          }
      });
}
var tabla;

$(document).ready(function(){
    tabla=$('#data_slider').dataTable({
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
            url: '../../controller/slider.php?op=listar',
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
});

$(document).on('change', '.input-orden', function () {
    let nuevoOrden = $(this).val();
    let id = $(this).data('id');

    $.ajax({
        url: '../../controller/slider.php?op=actualizar_orden',
        method: 'POST',
        data: { id: id, orden: nuevoOrden },
        success: function (resp) {
            let r = JSON.parse(resp);
            if (r.success == 1) {
                $('#data_slider').DataTable().ajax.reload();
            } else {
                toastr.error('Error al actualizar el orden');
            }
        }
    });
});

// Inicializar Dropzone
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#upload-form", {
    url: "../../controller/miembro.php?op=registrar", // Solo para inicializar
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

function nuevoSlider(){
    $('#estado').prop('checked', true); 
    
    $('#lblTitle').html('Nuevo registro');
    $('#modal_slider').modal('show');
}

function guardarRegistro(){
    var formData = new FormData($("#slider_form")[0]);

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
            url: "../../controller/slider.php?op=registrar_foto",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                if (datos.success == 1) {

                    cerrarModal()

                    myDropzone.removeAllFiles(true); // Limpiar Dropzone

                    $('#data_slider').DataTable().ajax.reload();

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

function cerrarModal(){
    $('#modal_slider').modal('hide'); 
    
    $("#slider_form")[0].reset();
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
              $.post("../../controller/slider.php?op=eliminar", {id : id}, function (data) {
              }); 
    
              $('#data_slider').DataTable().ajax.reload();	
    
              swal({
                  title: "Correcto",
                  text: "Foto eliminada",
                  type: "success",
                  confirmButtonClass: "btn-success"
              });
          }
      });
}

function editarTexto(id){

    $.post("../../controller/slider.php?op=obtener_titulo", { id: id }, function (data) {
        data = JSON.parse(data);
        $('#titulo').val(data.titulo);
        $('#subtitulo').val(data.subtitulo);        
    });

    $('#id_slider').val(id)
    $('#modal_texto_slider').modal('show');
}

function guardarTexto(){

    var formData = new FormData($("#texto_slider_form")[0]);

    $.ajax({
        url: "../../controller/slider.php?op=actualizar_texto",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            if (datos.success == 1) {

                $('#modal_texto_slider').modal('hide');

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
                    title: 'Slider actualizado',
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
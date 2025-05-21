var tabla;

$(document).ready(function(){
    tabla=$('#data_usuario').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "searching": true,
        lengthChange: false,
        colReorder: true,
        "ordering": false,
        columnDefs: [
            { width: "20%", targets: 0, className: 'text-center'},
            { width: "20%", targets: 1, className: 'text-center'},
            { width: "20%", targets: 2, className: 'text-center'},
            { width: "15%", targets: 3, className: 'text-center'},
            { width: "5%", targets: 4, className: 'text-center'},
            { width: "5%", targets: 5, className: 'text-center'},
            { width: "10%", targets: 6, className: 'text-center'},
            { width: "5%", targets: 7, className: 'text-center'}
        ],
        "ajax":{
            url: '../../controller/usuario.php?op=listar',
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
});

$(document).on('change', '.input-orden', function () {
    let nuevoOrden = $(this).val();
    let id = $(this).data('id');

    $.ajax({
        url: '../../controller/miembro.php?op=actualizar_orden',
        method: 'POST',
        data: { id: id, orden: nuevoOrden },
        success: function (resp) {
            let r = JSON.parse(resp);
            if (r.success == 1) {
                $('#data_miembro').DataTable().ajax.reload();
            } else {
                toastr.error('Error al actualizar el orden');
            }
        }
    });
});

// Inicializar Dropzone
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#upload-form", {
    url: "../../controller/usuario.php?op=registrar", // Solo para inicializar
    paramName: "file",
    maxFilesize: 10, // MB
    acceptedFiles: ".jpg,.jpeg,.png,.gif,.bmp,.webp,.avif",
    dictDefaultMessage: "Arrastra los archivos aquí para subirlos o haz clic",
    autoProcessQueue: false,
    uploadMultiple: false,
    maxFiles: 1,
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar",

    init: function () {
        this.on("addedfile", function (file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]); // Elimina el primero (antiguo)
            }
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


$('#estado').on('change', function () {
    if ($(this).is(':checked')) {
        $('#estado_real').val('A');
        $('#lblEstado').text('Activo');
    } else {
        $('#estado_real').val('I');
        $('#lblEstado').text('Inactivo');
    }
});

function nuevoMiembro(){
    $('#estado').prop('checked', true); 
    
    $('#lblTitle').html('Nuevo registro');
    $('#modal_usuario').modal('show');
}

function guardarRegistro(){
    // Capturar el formulario y crear FormData
    var formData = new FormData($("#usuario_form")[0]);
    
    // Verificar si es edición o registro nuevo
    let esEdicion = $('#codigo').val() !== '';

    const campos = [
        "#nombre",
        "#apellido",
        "#correo",
        "#usuario",
        "#rol"
    ];
    
    // Si no es edición, también validar contraseña
    if (!esEdicion) {
        campos.push("#clave");
    }
  
    // Validación básica de campos requeridos
    for (let i = 0; i < campos.length; i++) {
      if ($(campos[i]).val().trim() === "") {
        Swal.fire({
          icon: "warning",
          title: "Complete todos los datos",
          text: "El campo " + campos[i].replace("#", "") + " es requerido"
        });
        $(campos[i]).focus();
        return false;
      }
    }
    
    // En caso de edición, añadir explícitamente el id como un campo llamado 'id'
    if (esEdicion) {
        formData.append('id', $('#codigo').val());
    }
    
    // También añadir el valor de estado_real si no existe
    if (!formData.has('estado_real')) {
        formData.append('estado_real', $("#estado").val() || "1");
    }
    
    // Añadir fotos al FormData si hay alguna
    if (typeof myDropzone !== 'undefined' && myDropzone.files.length > 0) {
        myDropzone.files.forEach((file, i) => {
            formData.append("foto" + i, file);
        });
    }
    
    // Determinar URL y mensaje según operación
    let url_ajax, resultado;

    if(esEdicion){
        url_ajax = "../../controller/usuario.php?op=editar";
        resultado = 'Usuario actualizado';
    } else {
        url_ajax = "../../controller/usuario.php?op=registrar";
        resultado = 'Usuario registrado';
    }
    
    
    // Realizar solicitud AJAX con depuración extendida
    $.ajax({
        url: url_ajax,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            
            if (datos && datos.success == 1) {
                cerrarModal();
                $("#usuario_form")[0].reset();
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
                $('#data_usuario').DataTable().ajax.reload();
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
    $('#modal_usuario').modal('show');

    $("#codigo").val(id);

    $.post("../../controller/usuario.php?op=obtener", { id: id }, function (data) {
        data = JSON.parse(data);
        $('#nombre').val(data.nombre);
        $('#apellido').val(data.apellido);
        $('#correo').val(data.correo);
        $('#usuario').val(data.usuario);
        $('#rol').val(data.rol);

        // Simula la imagen previa
        if (data.foto) {
            var mockFile = {
                name: "foto_perfil.png", // Nombre ficticio
                size: 7024, // Tamaño ficticio en bytes
                type: "image/png"
            };

            // Agrega archivo ficticio a Dropzone
            dropzoneInstance.emit("addedfile", mockFile);
            dropzoneInstance.emit("thumbnail", mockFile, data.foto);
            dropzoneInstance.emit("complete", mockFile);

            // Marca que no es archivo nuevo
            dropzoneInstance.files.push(mockFile);

            dropzoneInstance.emit("thumbnail", mockFile, data.foto);

            // Limita la imagen después de insertarla
            $(mockFile.previewElement).find("img").css({
                width: "100%",
                height: "auto",
                "object-fit": "cover",
                "max-height": "120px"
            });
        }
        
        if(data.estado == 'I'){
            $('#estado').prop('checked', false); 
        } else {
            $('#estado').prop('checked', true); 
        }
        
    });
}

function cerrarModal(){
    $('#modal_usuario').modal('hide'); 
    
    $("#usuario_form")[0].reset();

    myDropzone.removeAllFiles(true); // Limpiar Dropzone
}
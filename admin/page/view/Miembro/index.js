var tabla;

$(document).ready(function(){
    tabla=$('#data_miembro').dataTable({
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
            url: '../../controller/miembro.php?op=listar',
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
    url: "../../controller/miembro.php?op=registrar", // Solo para inicializar
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
    $('#codigo').val(""); 

    $('#estado').prop('checked', true); 
    
    $('#lblTitle').html('Nuevo registro');
    $('#modal_miembro').modal('show');
}

function guardarRegistro(){
    var formData = new FormData($("#miembro_form")[0]);
    const campos = [
        "#nombre",
        "#apellido",
        "#puesto",
        "#detapuesto",
        "#codcap",
        "#linkedin",
        "#instagram",
        "#correo",
        "#contacto",
        "#descrip",
        "#orden"
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
    }

    myDropzone.files.forEach((file, i) => {
      formData.append("foto" + i, file); // Añade los archivos al FormData
    });

    let url_ajax, resultado;

    if($('#codigo').val() != ''){
        url_ajax = "../../controller/miembro.php?op=editar";
        resultado = 'Miembro actualizado';
    } else {
        url_ajax = "../../controller/miembro.php?op=registrar";
        resultado = 'Miembro registrado';
    }

    $.ajax({
        url: url_ajax,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            console.log(datos);  
            if (datos.success == 1) {

                cerrarModal()

                $("#miembro_form")[0].reset();

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

                $('#data_miembro').DataTable().ajax.reload();	

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
    $('#modal_miembro').modal('show');

    $("#codigo").val(id);

    $.post("../../controller/miembro.php?op=obtener", { id: id }, function (data) {
        data = JSON.parse(data);
        $('#nombre').val(data.nombre);
        $('#apellido').val(data.apellido);
        $('#codcap').val(data.codcap);
        $('#puesto').val(data.puesto);  
        $('#detapuesto').val(data.detapuesto);
        $('#correo').val(data.correo);
        $('#contacto').val(data.contacto);
        $('#linkedin').val(data.linkedin);
        $('#instagram').val(data.instagram);
        $('#tiktok').val(data.tiktok);
        $('#descrip').val(data.descrip);
        $('#orden').val(data.orden);

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
    $('#modal_miembro').modal('hide'); 
    
    $("#miembro_form")[0].reset();

    myDropzone.removeAllFiles(true); // Limpiar Dropzone
}

function verEspecialidad(id){
    listar_especialidad(id)

    $('#id_miembro').val(id)
    $('#modal_especialidad').modal('show');
}

function listar_especialidad(id){
    tabla_esp=$('#data_especialidad').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "searching": false,
        lengthChange: false,
        colReorder: true,
        "ordering": false,
        columnDefs: [
            { width: "80%", targets: 0, className: 'text-left'},
            { width: "20%", targets: 1, className: 'text-center'}
        ],
        "ajax":{
            url: '../../controller/miembro.php?op=listar_especialidad',
            type : "post",
            dataType : "json",
            data: {id_miembro : id},						
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

function guardarEspecialidad(){

    var formData = new FormData($("#miembro_especialidad_form")[0]);
    const campos = [
        "#especialidad"
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
          title: "Ingrese una especialidad o certificación",
        });
  
        $(campos[i]).focus();
        return false;
      }
    }

    $.ajax({
            url: "../../controller/miembro.php?op=registrar_especialidad",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                if (datos.success == 1) {
                    
                    $("#miembro_especialidad_form")[0].reset();

                    $('#data_especialidad').DataTable().ajax.reload();

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
                        title: 'Especialidad registrada correctamente',
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

function eliminarEspecialidad(id){
    swal({
        title: "Atención",
        text: "¿Desea elimiar especialidad?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
      },
      function(isConfirm) {
          if (isConfirm) {
              $.post("../../controller/miembro.php?op=eliminar_especialidad", {id : id}, function (data) {
              }); 
    
              $('#data_especialidad').DataTable().ajax.reload();	
    
              swal({
                  title: "Correcto",
                  text: "Especialidad eliminada",
                  type: "success",
                  confirmButtonClass: "btn-success"
              });
          }
      });
}
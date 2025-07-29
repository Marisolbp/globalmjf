$(document).ready(function(){
    tabla=$('#data_valor').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "searching": false,
        lengthChange: false,
        colReorder: true,
        "ordering": false,
        columnDefs: [
            { width: "10%", targets: 0, className: 'text-left'},
            { width: "85%", targets: 1, className: 'text-left'},
            { width: "5%", targets: 2, className: 'text-center'}
        ],
        "ajax":{
            url: '../../controller/general.php?op=listar_valor',
            type : "post",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 20,
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
    
    $.post("../../controller/general.php?op=obtener_configuracion", function(response) {
        const datos = JSON.parse(response);
    
        if (datos.success === 1) {
            const info = datos.data;
    
            $("#numero").val(info.numero);
            $("#correo").val(info.correo);
            $("#facebook").val(info.facebook);
            $("#linkedin").val(info.linkedin);
            $("#instagram").val(info.instagram);
            $("#tiktok").val(info.tiktok);
            $("#direccion").val(info.direccion);
            /* $("#longitud").val(info.longitud);
            $("#latitud").val(info.latitud); */
            // Si usas Quill:
            /* quill_m.root.innerHTML = info.mision || "";
            quill_v.root.innerHTML = info.vision || ""; */
        } else {
            console.log("No hay datos previos en la configuración.");
        }
    });

    $.post("../../controller/general.php?op=obtener_nosotros", function(response) {
        const datos = JSON.parse(response);
    
        if (datos.success === 1) {
            const info = datos.data;
            quill_qs.root.innerHTML = info.quienes_somos || "";
            quill_m.root.innerHTML = info.mision || "";
            quill_v.root.innerHTML = info.vision || "";
        } else {
            console.log("No hay datos previos en la configuración.");
        }
    });
});

const quill_qs = new Quill('#snow-editor-qs', {
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['image', 'code-block'],
            [{ list: 'ordered' }, { list: 'bullet' }],
        ],
    },
    placeholder: '¿Quiénes somos?',
    theme: 'snow', // or 'bubble'
    });

const quill_m = new Quill('#snow-editor-m', {
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['image', 'code-block'],
            [{ list: 'ordered' }, { list: 'bullet' }],
        ],
    },
    placeholder: 'Misión',
    theme: 'snow', // or 'bubble'
    });

const quill_v = new Quill('#snow-editor-v', {
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['image', 'code-block'],
            [{ list: 'ordered' }, { list: 'bullet' }],
        ],
    },
    placeholder: 'Visión',
    theme: 'snow', // or 'bubble'
    });

function guardarInfoGeneral(){
    var formData = new FormData($("#general_form")[0]);
    const campos = [
        "#numero",
        "#correo",
        "#direccion",
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

    $.ajax({
        url: "../../controller/general.php?op=registrar_general",
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

function guardarInfoNosotros(){
    var formData = new FormData($("#nosotros_form")[0]);

    var editorHTMLContentQS = quill_qs.getText().trim();
    var editorHTMLContentM  = quill_m.getText().trim();
    var editorHTMLContentV  = quill_v.getText().trim();

    if (editorHTMLContentQS.length === 0) {
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
            title: "Complete el campo ¿Quiénes somos?",
          });

        quill_qs.focus(); // Enfoca el editor si está vacío
        return false;
    } else if (editorHTMLContentM.length === 0) {
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
            title: "Complete la misión",
          });

        quill_m.focus(); // Enfoca el editor si está vacío
        return false;
    } else if (editorHTMLContentV.length === 0) {
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
            title: "Complete la visión",
          });

        quill_v.focus(); // Enfoca el editor si está vacío
        return false;
    } else {

        formData.append("qsomos", editorHTMLContentQS);
        formData.append("mision", editorHTMLContentM);
        formData.append("vision", editorHTMLContentV);

        $.ajax({
            url: "../../controller/general.php?op=registrar_nosotros",
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

function nuevoValor(){
    $('#modal_valor').modal('show');
}

function guardarRegistro(){
    var formData = new FormData($("#valor_form")[0]);
    const campos = [
        "#valor",
        "#descrip"
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

    $.ajax({
        url: "../../controller/general.php?op=registrar_valor",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            if (datos.success == 1) {

                cerrarModal()

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
                title: "Valor registrado",
                });

                $('#data_valor').DataTable().ajax.reload();	

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

function cerrarModal(){
    $('#modal_valor').modal('hide'); 
    
    $("#valor_form")[0].reset();
}

function eliminarValor(id){
    swal({
        title: "Atención",
        text: "¿Desea elimiar valor?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
      },
      function(isConfirm) {
          if (isConfirm) {
              $.post("../../controller/general.php?op=eliminar_valor", {id : id}, function (data) {
              }); 
    
              $('#data_valor').DataTable().ajax.reload();	
    
              swal({
                  title: "Correcto",
                  text: "Valor eliminado",
                  type: "success",
                  confirmButtonClass: "btn-success"
              });
          }
      });
}
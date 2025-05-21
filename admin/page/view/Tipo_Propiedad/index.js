var tabla;

$(document).ready(function(){
    tabla=$('#data_tipo_propiedad').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "searching": true,
        lengthChange: false,
        colReorder: true,
        "ordering": false,
        columnDefs: [
            { width: "85%", targets: 0, className: 'text-left'},
            { width: "10%", targets: 1, className: 'text-center'},
            { width: "5%", targets: 2, className: 'text-center'}
        ],
        "ajax":{
            url: '../../controller/tipo_propiedad.php?op=listar',
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

$('#estado').on('change', function () {
    if ($(this).is(':checked')) {
        $('#estado_real').val('A');
        $('#lblEstado').text('Activo');
    } else {
        $('#estado_real').val('I');
        $('#lblEstado').text('Inactivo');
    }
});

function nuevoTipoPropiedad(){
    $('#estado').prop('checked', true); 
    
    $('#lblTitle').html('Nuevo registro');
    $('#modal_tipo_propiedad').modal('show');
}

function guardarRegistro(){
    var formData = new FormData($("#tipo_propiedad_form")[0]);
    const campos = [
        "#nombre"
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
        url_ajax = "../../controller/tipo_propiedad.php?op=editar";
        resultado = 'Tipo de propiedad actualizado';
    } else {
        url_ajax = "../../controller/tipo_propiedad.php?op=registrar";
        resultado = 'Tipo de propiedad registrado';
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

                $("#tipo_propiedad_form")[0].reset();

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

                $('#data_tipo_propiedad').DataTable().ajax.reload();	

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
    $('#modal_tipo_propiedad').modal('show');

    $("#codigo").val(id);

    $.post("../../controller/tipo_propiedad.php?op=obtener", { id: id }, function (data) {
        data = JSON.parse(data);
        $('#nombre').val(data.nombre);
        
        if(data.estado == 'I'){
            $('#estado').prop('checked', false); 
        } else {
            $('#estado').prop('checked', true); 
        }
        
    });
}

function cerrarModal(){
    $('#modal_tipo_propiedad').modal('hide'); 
    
    $("#tipo_propiedad_form")[0].reset();
}
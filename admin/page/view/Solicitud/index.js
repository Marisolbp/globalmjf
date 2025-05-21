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
    tabla=$('#data_solicitud').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "searching": true,
        lengthChange: false,
        colReorder: true,
        "ordering": false,
        columnDefs: [
            { width: "14%", targets: 0, className: 'text-center'},
            { width: "14%", targets: 1, className: 'text-center'},
            { width: "14%", targets: 2, className: 'text-center'},
            { width: "14%", targets: 3, className: 'text-center'},
            { width: "14%", targets: 4, className: 'text-center'},
            { width: "14%", targets: 5, className: 'text-center'},
            { width: "14%", targets: 6, className: 'text-center'}
        ],
        "ajax":{
            url: '../../controller/solicitud.php?op=listar',
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

    $.post("../../controller/ubicacion.php?op=combo_depart",function(data, status){
        $('#id_depart').html(data);
    });

    
});

var solicitudId;

function verSolicitud(id){

    // Guardamos el ID en la variable global para usarlo posteriormente
    solicitudId = id;

    $('#lblTitle').html('Ver solicitud');
    $('#modal_solicitud').modal('show');

    $.post("../../controller/solicitud.php?op=obtener", { id: id }, function (data) {
        data = JSON.parse(data);

        $('#nombre').val(data.nombre);
        $('#apellido').val(data.apellido);
        $('#dni').val(data.dni);
        $('#telefono').val(data.telefono);
        
        quill_d.root.innerHTML = data.detalle;

        $('#modalidad').val(data.modalidad).trigger('change');
        let modalidad = data.modalidad === 'V' ? 'Venta' : 'Alquiler';

        $("#select2-modalidad-container").html(modalidad);

        $('#id_t_prop').val(data.id_t_prop).trigger('change');
        $("#select2-id_t_prop-container").html(data.tipo);

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
    });
}

// Función para rechazar solicitud - tipo 1
function rechazarSolicitud() {
    return actualizarEstado(solicitudId, 'R');
}

// Función para aceptar solicitud - tipo 2
function aceptarSolicitud() {
    return actualizarEstado(solicitudId, 'A');
}

// Función para actualizar el estado de la solicitud
function actualizarEstado(id, tipo) {
    // Mensajes personalizados según el tipo
    let mensaje = tipo === 'A' ? 'rechazar' : 'aceptar';
    let pasado = tipo === 'R' ? 'rechazada' : 'aceptada';
    
    swal({
        title: '¿Está seguro?',
        text: '¿Desea ' + mensaje + ' esta solicitud?',
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
      },
      function(isConfirm) {
            if (isConfirm) {
              $.post("../../controller/solicitud.php?op=actualizar_estado", { id: id, tipo: tipo }, function (data) {
              }); 
    
              $('#data_solicitud').DataTable().ajax.reload();	
    
              swal({
                  title: "Correcto",
                  text: 'La solicitud ha sido ' + pasado + ' correctamente.',
                  type: "success",
                  confirmButtonClass: "btn-success"
              });
          }
      });
    
    return false; // Para evitar que el formulario se envíe si estos botones están dentro de un form
}
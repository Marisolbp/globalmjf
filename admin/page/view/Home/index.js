/*var tabla;
var codusux = $('#l_codusu').val();
var codrolx = $('#l_codrol').val();

if (codrolx == 1 || codrolx == 2) {
    $('#widgets-contable').show();
    $('#widgets-legal').show();
} else if (codrolx == 3 || codrolx == 4) {
    $('#widgets-contable').show();
    $('#widgets-legal').hide();
} else {
    $('#widgets-contable').hide();
    $('#widgets-legal').show();
}*/

$(document).ready(function(){

    $.post("../../controller/dashboard.php?op=obtener_solicitudes_activas", function (data) {
        data = JSON.parse(data); 
        $('#lblSolicitudesOn').html(data.total_solicitudes);
    });

    $.post("../../controller/dashboard.php?op=obtener_total_miembros", function (data) {
        data = JSON.parse(data); 
        $('#lblTotalMiembros').html(data.total_miembros);
    });

    $.post("../../controller/dashboard.php?op=obtener_propiedades_disponibles", function (data) {
        data = JSON.parse(data); 
        $('#lblPropiedadesDisponibles').html(data.total_propiedades);
    });

    $.post("../../controller/dashboard.php?op=obtener_distrito_mayor_in", function (data) {
        data = JSON.parse(data); 
        $('#lblDistritoMayor').html(data.mayor_distrito);
    });

    $.post("../../controller/dashboard.php?op=obtener_proyectos_en_curso", function (data) {
        data = JSON.parse(data); 
        $('#lblProyectoCurso').html(data.total_proyectos);
    });

    $.post("../../controller/dashboard.php?op=obtener_proyectos_mas_cotizado", function (data) {
        data = JSON.parse(data); 
        $('#lblProyectoCotizado').html(data.proyectos_cotizados);
    });
})


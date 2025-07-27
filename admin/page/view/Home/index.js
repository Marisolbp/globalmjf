$(document).ready(function(){

    $.post("../../controller/dashboard.php?op=obtener_solicitudes_pendientes", function (data) {
        data = JSON.parse(data); 
        $('#lblSolicitudesPe').html(data.total_solicitudes);
    });

    $.post("../../controller/dashboard.php?op=obtener_total_miembros", function (data) {
        data = JSON.parse(data); 
        $('#lblTotalMiembros').html(data.total_miembros);
    });

    $.post("../../controller/dashboard.php?op=obtener_total_propiedades", function (data) {
        data = JSON.parse(data); 
        $('#lblTotalPropiedades').html(data.total_propiedades);
    });

    $.post("../../controller/dashboard.php?op=obtener_total_independizacion", function (data) {
        data = JSON.parse(data); 
        $('#lblTotalIndependizaciones').html(data.total_independizacion);
    });

    $.post("../../controller/dashboard.php?op=obtener_total_proyectos", function (data) {
        data = JSON.parse(data); 
        $('#lblTotalProyectos').html(data.total_proyectos);
    });

    $.post("../../controller/dashboard.php?op=obtener_proyectos_mas_cotizado", function (data) {
        data = JSON.parse(data); 
        $('#lblProyectoCotizado').html(data.proyectos_cotizados);
    });
})


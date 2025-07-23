$(document).ready(function(){
    obtenerFooter()

    $.post("./controller/solicitud.php?op=combo_tipo_prop",function(data, status){
        $('#id_t_prop').html(data);
    });

    $.post("./controller/solicitud.php?op=combo_depart",function(data, status){
        $('#id_depart').html(data);
    });

    $('#id_provin').prop('disabled', true); 
    $('#id_distri').prop('disabled', true); 
});

$('#id_depart').on('change', function () {

    $('#id_provin').prop('disabled', false); 

    $.post("./controller/solicitud.php?op=combo_prov", { id_depart : $(this).val() }, function(data, status){
        $('#id_provin').html(data);
    });
});

$('#id_provin').on('change', function () {

    $('#id_distri').prop('disabled', false); 

    $.post("./controller/solicitud.php?op=combo_dist_prov", { id_provin : $(this).val() }, function(data, status){
        $('#id_distri').html(data);
    });
});
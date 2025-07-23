$(document).ready(function(){   
    $.post("./controller/declaratoria.php?op=mostrar_datos", function(data) {
        data = JSON.parse(data);
        $('#descrip_decla').html(data.descrip_decla);
        $('#descrip_indep').html(data.descrip_indep);
    });

    obtenerFooter()
});
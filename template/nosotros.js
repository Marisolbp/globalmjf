$(document).ready(function(){
    $.post("./controller/nosotros.php?op=mostrar_datos", function(data) {
        data = JSON.parse(data);
        $('#quienes-somos').html(data.quienes_somos);
        $('#mision').html(data.mision);
        $('#vision').html(data.vision);
    });

    $.post("./controller/nosotros.php?op=mostrar_perfiles_completos", function(data) {
        $("#nuestro-equipo").html(data);
    });

    obtenerFooter()
});

    
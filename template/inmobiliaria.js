$(document).ready(function(){
    $.post("./controller/inmobiliaria.php?op=mostrar_inmobiliaria", function(data) {
        $("#listar_inmobiliaria").html(data);
    });

    obtenerFooter()
});
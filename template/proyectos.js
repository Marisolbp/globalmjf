$(document).ready(function(){
    $.post("./controller/proyecto.php?op=mostrar_proyectos", function(data) {
        $("#listar_proyecto").html(data);
    });

    obtenerFooter()
});
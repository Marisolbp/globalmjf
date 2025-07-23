$(document).ready(function(){

    $.post("./controller/principal.php?op=mostrar_foto", function(data) {
        $("#foto-slider").html(data);
    });

    $.post("./controller/principal.php?op=mostrar_equipo", function(data) {
        $("#nuestro-equipo").html(data);
    });

    $.post("./controller/inmobiliaria.php?op=mostar_tipos", function(data) {
        let tipos = JSON.parse(data);
        let html = '<li class="list-inline-item btn-filter filtr-active" data-id="0" data-filter="all">Todos</li>';

        tipos.forEach((tipo, index) => {
            html += `<li class="list-inline-item btn-filter" data-id="${tipo.id}" data-filter="${index + 1}">
                        ${tipo.nombre}
                    </li>`;
        });

        $("#list_filter").html(html);

        // Delegar evento clic a los li
        $("#list_filter").on("click", ".btn-filter", function () {
            const id = $(this).data("id");
            filtrarPropiedades(id);

            // Activar el botón seleccionado
            $(".btn-filter").removeClass("filtr-active");
            $(this).addClass("filtr-active");
        });

        // Ejecutar filtro inicial
        filtrarPropiedades(0);
    });

    obtenerFooter()
});

function filtrarPropiedades(idTipo) {
    $.post("./controller/inmobiliaria.php?op=listar_propiedades", { id_t_prop: idTipo }, function(html) {
        $("#list_prop").html(html);
    });
}
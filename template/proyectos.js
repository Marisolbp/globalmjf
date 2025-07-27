$(document).ready(function(){

    $.post("./controller/tipo_propiedad.php?op=listar_tipos", function (data) {
        $("#id_t_prop").html(data);
    });

    $.post("./controller/proyecto.php?op=combo_pisos", function (data) {
        $("#npisos").html(data);
    });

    $.post("./controller/proyecto.php?op=combo_dormitorios", function (data) {
        $("#ndormit").html(data);
    });

    // Cargar todos los proyectos inicialmente
    cargarProyectos();
    
    // Evento para filtros
    $('#filtro_form select').on('change', function () {
        cargarProyectos();
    });

    // Botón para limpiar filtros
    $('#limpiar_filtros').on('click', function() {
        $('#filtro_form')[0].reset();
        cargarProyectos();
    });

    obtenerFooter()
});

function cargarProyectos() {
    // Mostrar loading
    $("#listar_proyecto").css('justify-content', 'center');
    $("#listar_proyecto").html('<div style="text-align:center; padding:20px;"><i class="fa fa-spinner fa-spin"></i> Cargando...</div>');
    
    // SOLUCIÓN: Crear objeto solo con valores que no estén vacíos
    let formData = {};
    
    let id_t_prop = $('#id_t_prop').val();
    let area = $('#area').val();
    let npisos = $('#npisos').val();
    let ndormit = $('#ndormit').val();
    
    // Solo agregar al formData si el valor no está vacío
    if (id_t_prop && id_t_prop !== '') {
        formData.id_t_prop = id_t_prop;
    }
    
    if (area && area !== '') {
        formData.area = area;
    }
    
    if (npisos && npisos !== '') {
        formData.npisos = npisos;
    }
    
    if (ndormit && ndormit !== '') {
        formData.ndormit = ndormit;
    }
    
    // Hacer la petición AJAX
    $.post("./controller/proyecto.php?op=mostrar_proyectos", formData, function (data) {
        
        // ESPERAR 5 SEGUNDOS antes de mostrar los resultados
        setTimeout(function() {
            if (data.trim() === '' || data.includes('No se encontraron')) {
                // Sin resultados - agregar justify-content center
                $("#listar_proyecto").css('justify-content', 'center');
                $("#listar_proyecto").html('<div style="text-align:center; padding:40px; color:#999;"><h4>No se encontraron resultados</h4><p>Intenta ajustar los filtros</p></div>');
            } else {
                // Con resultados - remover justify-content
                $("#listar_proyecto").css('justify-content', '');
                $("#listar_proyecto").html(data);
            }
        }, 1000); // 5000 milisegundos = 5 segundos
        
    }).fail(function(xhr, status, error) {
        
        // También esperar 5 segundos para mostrar el error
        setTimeout(function() {
            $("#listar_proyecto").css('justify-content', 'center');
            $("#listar_proyecto").html('<div style="text-align:center; padding:40px; color:#red;"><h4>Error al cargar</h4><p>Inténtalo nuevamente</p></div>');
        }, 1000);
    });
}
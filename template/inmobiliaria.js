$(document).ready(function(){

    $.post("./controller/tipo_propiedad.php?op=listar_tipos", function (data) {
        $("#id_t_prop").html(data);
    });

    $.post("./controller/inmobiliaria.php?op=combo_distri", function (data) {
        $("#id_distri").html(data);
    });

    $.post("./controller/inmobiliaria.php?op=combo_pisos", function (data) {
        $("#npisos").html(data);
    });

    $.post("./controller/inmobiliaria.php?op=combo_dormitorios", function (data) {
        $("#ndormit").html(data);
    });

    $.post("./controller/inmobiliaria.php?op=rango_precio", function (data) {
        try {
            let rangoData = JSON.parse(data);
            
            if (rangoData.length > 0) {
                let precioMin = rangoData[0].precio_min;
                let precioMax = rangoData[0].precio_max;
                
                // Actualizar los atributos del input
                $("#price_range").attr({
                    'data-min': precioMin,
                    'data-max': precioMax,
                    'data-from': precioMin,
                    'data-to': precioMax
                });
                
                // Inicializar el slider
                $("#price_range").ionRangeSlider({
                    min: precioMin,
                    max: precioMax,
                    from: precioMin,
                    to: precioMax,
                    type: 'double',
                    step: 10000,
                    prefix: ' ',
                    thousandsSeparator: ',',
                    skin: 'flat',
                    hide_min_max: false,
                    hide_from_to: false,
                    grid: true,
                    prettify_enabled: true,
                    prettify_separator: ',',
                    
                    onChange: function (data) {
                        console.log('Rango cambiado:', data.from, '-', data.to);
                        cargarInmobiliaria();
                    },
                    
                    onFinish: function (data) {
                        //
                    }
                });
            }
        } catch (e) {
            console.error('Error al parsear datos de rango:', e);
        }
    });

    // Cargar todos los inmobiliarias inicialmente
    cargarInmobiliaria();
    
    // Evento para filtros
    $('#filtro_form select').on('change', function () {
        cargarInmobiliaria();
    });

    // Botón para limpiar filtros
    $('#limpiar_filtros').on('click', function() {
        $('#filtro_form')[0].reset();
        cargarInmobiliaria();
    });

    obtenerFooter()
});

let paginaActual = 1;
const registrosPorPagina = 15;

function cargarInmobiliaria(pagina = 1) {
    paginaActual = pagina;
    // Mostrar loading
    $("#listar_inmobiliaria").css('justify-content', 'center');
    $("#listar_inmobiliaria").html('<div style="text-align:center; padding:20px;"><i class="fa fa-spinner fa-spin"></i> Cargando...</div>');
    
    // SOLUCIÓN: Crear objeto solo con valores que no estén vacíos
    let formData = {};
    let offset = (pagina - 1) * registrosPorPagina;
    
    let id_t_prop = $('#id_t_prop').val();
    let modalidad = $('#modalidad').val();
    let id_distri = $('#id_distri').val();
    let atotal = $('#atotal').val();
    let npisos = $('#npisos').val();
    let ndormit = $('#ndormit').val();
    
    // Solo agregar al formData si el valor no está vacío
    if (id_t_prop && id_t_prop !== '') {
        formData.id_t_prop = id_t_prop;
    }

    if (modalidad && modalidad !== '') {
        formData.modalidad = modalidad;
    }

    if (id_distri && id_distri !== '') {
        formData.id_distri = id_distri;
    }
    
    if (atotal && atotal !== '') {
        formData.atotal = atotal;
    }
    
    if (npisos && npisos !== '') {
        formData.npisos = npisos;
    }
    
    if (ndormit && ndormit !== '') {
        formData.ndormit = ndormit;
    }

    // NUEVO: Obtener valores del range slider
    let rangeSlider = $("#price_range").data("ionRangeSlider");
    if (rangeSlider && rangeSlider.result) {
        formData.precio_min = rangeSlider.result.from;
        formData.precio_max = rangeSlider.result.to;
        console.log("Filtro de precio aplicado: S/ " + formData.precio_min + " - S/ " + formData.precio_max);
    }

    // Paginación
    formData.limit = registrosPorPagina;
    formData.offset = offset;
    
    // Hacer la petición AJAX
    $.post("./controller/inmobiliaria.php?op=mostrar_inmobiliaria", formData, function (data) {
        
        let parsed = typeof data === 'string' ? JSON.parse(data) : data;

        setTimeout(function () {
            if (!parsed.html || parsed.html.trim() === '' || parsed.html.includes('No se encontraron')) {
                $("#listar_inmobiliaria").css('justify-content', 'center');
                $("#listar_inmobiliaria").html('<div style="text-align:center; padding:40px; color:#999;"><h4>No se encontraron resultados</h4><p>Intenta ajustar los filtros</p></div>');
            } else {
                $("#listar_inmobiliaria").css('justify-content', '');
                $("#listar_inmobiliaria").html(parsed.html);
            }

            generarPaginacion(parsed.total || 0);
        }, 1000);        
    }).fail(function(xhr, status, error) {
        
        // También esperar 5 segundos para mostrar el error
        setTimeout(function() {
            $("#listar_inmobiliaria").css('justify-content', 'center');
            $("#listar_inmobiliaria").html('<div style="text-align:center; padding:40px; color:#red;"><h4>Error al cargar</h4><p>Inténtalo nuevamente</p></div>');
        }, 1000);
    });
}

// Crear paginación básica
function generarPaginacion(total) {
    let totalPaginas = Math.ceil(total / registrosPorPagina);
    let pagHtml = '<div class="pagination-wrapper text-center mt-4"><ul class="pagination justify-content-center">';

    for (let i = 1; i <= totalPaginas; i++) {
        pagHtml += `<li class="page-item ${i === paginaActual ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="cargarInmobiliaria(${i}); return false;">${i}</a>
                    </li>`;
    }

    pagHtml += '</ul></div>';
    $("#paginacion_inmobiliaria").html(pagHtml);
}
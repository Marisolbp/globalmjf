$(document).ready(function(){
    $.urlParam = function(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (!results) return 0;
        
        var encrypted = results[1];
        // Hacer una petición al servidor para desencriptar
        var decrypted = null;
        
        $.ajax({
            url: 'config/decrypt.php',
            type: 'POST',
            data: { encrypted: encrypted },
            async: false, // Importante para obtener el valor de inmediato
            success: function(response) {
                decrypted = response;
            }
        });
        
        return decrypted || 0;
    }
    
    let id_inmobiliaria = $.urlParam('v');

    $('#id_inmobiliaria').val(id_inmobiliaria)

    $.post("./controller/inmobiliaria.php?op=info_propiedad", { id: id_inmobiliaria }, function(data) {
        data = JSON.parse(data);
        $('#title_proyect').html(data.nombre);
        $('#direction').html(data.direccion +', '+ data.distrito);
        $('#descrip').html(data.descrip);

        let simbolo;
        let mod;

        if (data.moneda == 'USD') {
            simbolo = '$';
        } else {
            simbolo = 'S/';
        }

        if (data.modalidad == 'A'){
            mod = "/m";
        } else {
            mod = "";
        }
        $('#price').html(simbolo +' '+ data.precio +' '+ mod);

        let lng = data.longitud;
        let lat = data.latitud;

        // Usamos el formato de Google Maps Embed con lat y lng dinámicos
        let mapURL = `https://www.google.com/maps?q=${lng},${lat}&hl=es&z=15&output=embed`;

        $('#iframe-map').attr('src', mapURL);

        let streetURL = `https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=${lng},${lat}`;
        $('#iframe-street-view').replaceWith(`<a href="${streetURL}" target="_blank">Ver en Street View</a>`);

        // Mostrar detalles condicionales según el tipo de propiedad
        let tipo = data.id_t_prop;

        const camposPorTipo = {
            "1": [ // CASA
                { label: "Código", valor: data.codigo },
                { label: "Precio", valor: simbolo + data.precio },
                { label: "Área total", valor: data.area + " m²" },
                { label: "Modalidad", valor: (data.modalidad == 'A') ? 'Alquiler' : 'Venta' },
                { label: "Ubicación", valor: data.ubicacion },
                { label: "Pisos", valor: data.npisos },
                { label: "Baños", valor: data.nbanos },
                { label: "Lavandería", valor: data.nlavand },
                { label: "Cochera", valor: data.ncochera },

                { label: "Tipo de propiedad", valor: "Casa" },
                { label: "Valor m²", valor: simbolo + data.valmcua },
                { label: "Área construida", valor: data.aconstru + " m²" },
                { label: "Estado Inmueble", valor: data.estado_im },
                { label: "Antigüedad", valor: data.antiguedad + " años" },
                { label: "Dormitorios", valor: data.ndormit },
                { label: "Cocina", valor: data.ncocina },
                { label: "Depósito", valor: data.ndeposito },
                { label: "Mantenimiento", valor: (data.mantenimiento > 0 ? simbolo + data.mantenimiento : null) }
            ],
            "2": [ // DEPARTAMENTO
                { label: "Código", valor: data.codigo },
                { label: "Precio", valor: simbolo + data.precio },
                { label: "Área total", valor: data.area + " m²" },
                { label: "Modalidad", valor: (data.modalidad == 'A') ? 'Alquiler' : 'Venta' },
                { label: "Ubicación", valor: data.ubicacion },
                { label: "Pisos", valor: data.npisos },
                { label: "Baños", valor: data.nbanos },
                { label: "Lavandería", valor: data.nlavand },
                { label: "Cochera", valor: data.ncochera },

                { label: "Tipo de propiedad", valor: "Departamento" },
                { label: "Valor m²", valor: simbolo + data.valmcua },
                { label: "Área construida", valor: data.aconstru + " m²" },
                { label: "Estado Inmueble", valor: data.estado_im },
                { label: "Antigüedad", valor: data.antiguedad + " años" },
                { label: "Dormitorios", valor: data.ndormit },
                { label: "Cocina", valor: data.ncocina },
                { label: "Depósito", valor: data.ndeposito },
                { label: "Mantenimiento", valor: (data.mantenimiento > 0 ? simbolo + data.mantenimiento : null) }
            ],
            "3": [ // TERRENO
                { label: "Código", valor: data.codigo },
                { label: "Precio", valor: simbolo + data.precio },
                { label: "Área total", valor: data.area + " m²" },
                { label: "Modalidad", valor: (data.modalidad == 'A') ? 'Alquiler' : 'Venta' },
                { label: "Ubicación", valor: data.ubicacion },

                { label: "Tipo de propiedad", valor: "Terreno" },
                { label: "Valor m²", valor: simbolo + data.valmcua },
                { label: "Estado Inmueble", valor: data.estado_im }
            ]
        };

        // 1. Obtener y filtrar los campos que deben mostrarse
        const campos = (camposPorTipo[tipo] || []).filter(c => {
            const v = c.valor?.toString().trim();
            return v &&
                v !== "0" &&
                v !== "0.00" &&
                !v.startsWith("0 ") &&               // ej. "0 años"
                !v.startsWith(simbolo + "0") &&      // ej. "$0.00"
                !v.includes("0.00 m²") &&
                !v.includes(simbolo + "0.00") &&
                v !== simbolo + '0.00';
        });

        // 2. Dividir los campos ya filtrados
        const mitad = Math.ceil(campos.length / 2);
        const columna1 = campos.slice(0, mitad);
        const columna2 = campos.slice(mitad);

        // 3. Función para generar HTML
        function generarListaHTML(campos) {
            return campos
                .map(c => `<li><b>${c.label}:</b> ${c.valor}</li>`)
                .join('');
        }

        $(".property__detail-info-list").eq(0).html(generarListaHTML(columna1));
        $(".property__detail-info-list").eq(1).html(generarListaHTML(columna2));

    });

    $.post("./controller/inmobiliaria.php?op=fotos_x_inmobiliaria", { id: id_inmobiliaria }, function(response) {
    
        const images = []; // Array para las URLs

        response.forEach(function(foto, index) {
            images.push(foto.ruta_web);

            // Agregar miniaturas dinámicamente
            $("#thumbnailsWrapper").append(`
                <div class="thumbnail ${index === 0 ? 'active' : ''}" onclick="selectImage(${index})">
                    <img src="${foto.ruta_web}" alt="Miniatura ${index + 1}">
                    <div class="thumbnail-overlay"></div>
                </div>
            `);

            $('#t_propiedad').html(foto.tipo_propiedad);
            $('#inmobiliaria_name').html(foto.inmobiliaria_nombre);
        });

        // Configurar imágenes al slider
        if (images.length > 0) {
            document.getElementById('mainImage').src = images[0];
            document.getElementById('totalImages').textContent = images.length;
        }        

        // Sobrescribir el array global y actualizar funciones
        window.images = images;
        updateMainImage();
        updateThumbnails();
        updateCounter();

    }, "json");

    
    $.post("./controller/inmobiliaria.php?op=propiedad_relacionado", { id: id_inmobiliaria }, function (html) {
        $('#carousel_propiedad').html(html);
        iniciarCarrusel(); // iniciar scroll cuando ya se insertó el HTML
    });

    $("#loader").fadeOut()

    obtenerFooter()
});


let currentImageIndex = 0;

// Función para seleccionar imagen por índice
function selectImage(index) {
    currentImageIndex = index;
    updateMainImage();
    updateThumbnails();
    updateCounter();
}
// Función para cambiar imagen con flechas
function changeImage(direction) {
    currentImageIndex += direction;
    
    if (currentImageIndex >= images.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = images.length - 1;
    }
    
    updateMainImage();
    updateThumbnails();
    updateCounter();
}
// Actualizar imagen principal
function updateMainImage() {
    const mainImage = document.getElementById('mainImage');
    mainImage.style.opacity = '0';
    
    setTimeout(() => {
        mainImage.src = images[currentImageIndex];
        mainImage.style.opacity = '1';
    }, 150);
}
// Actualizar miniaturas activas
function updateThumbnails() {
    const thumbnails = document.querySelectorAll('.thumbnail');
    thumbnails.forEach((thumbnail, index) => {
        thumbnail.classList.toggle('active', index === currentImageIndex);
    });
}
// Actualizar contador
function updateCounter() {
    document.getElementById('currentImageNumber').textContent = currentImageIndex + 1;
}
// Scroll de miniaturas
function scrollThumbnails(direction) {
    const wrapper = document.getElementById('thumbnailsWrapper');
    const scrollAmount = 140; // Ancho de miniatura + gap
    
    wrapper.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}
// Navegación con teclado
document.addEventListener('keydown', function(e) {
    if (e.key === 'ArrowLeft') {
        changeImage(-1);
    } else if (e.key === 'ArrowRight') {
        changeImage(1);
    }
});
// Auto-scroll para mantener la miniatura activa visible
function scrollToActiveThumbnail() {
    const activeThumb = document.querySelector('.thumbnail.active');
    const wrapper = document.getElementById('thumbnailsWrapper');
    
    if (activeThumb) {
        const thumbRect = activeThumb.getBoundingClientRect();
        const wrapperRect = wrapper.getBoundingClientRect();
        
        if (thumbRect.left < wrapperRect.left) {
            wrapper.scrollBy({
                left: thumbRect.left - wrapperRect.left - 20,
                behavior: 'smooth'
            });
        } else if (thumbRect.right > wrapperRect.right) {
            wrapper.scrollBy({
                left: thumbRect.right - wrapperRect.right + 20,
                behavior: 'smooth'
            });
        }
    }
}
// Llamar al auto-scroll cuando se cambia de imagen
const originalSelectImage = selectImage;
selectImage = function(index) {
    originalSelectImage(index);
    setTimeout(scrollToActiveThumbnail, 100);
};
const originalChangeImage = changeImage;
changeImage = function(direction) {
    originalChangeImage(direction);
    setTimeout(scrollToActiveThumbnail, 100);
};

function iniciarCarrusel() {
    const wrapper = document.querySelector(".carrusel-wrapper");
    if (!wrapper) return;

    const items = wrapper.children;
    const total = items.length;

    if (total <= 3) return;

    // Clonar elementos
    const clones = [];
    for (let i = 0; i < total; i++) {
        const clone = items[i].cloneNode(true);
        clones.push(clone);
    }
    clones.forEach(clone => wrapper.appendChild(clone));

    let index = 0;
    const visibleCount = 3;

    const moveNext = () => {
        index++;
        const scrollWidth = wrapper.children[0].offsetWidth + 20; // ancho + gap
        wrapper.style.transform = `translateX(-${index * scrollWidth}px)`;

        if (index >= total) {
            setTimeout(() => {
                wrapper.style.transition = 'none';
                wrapper.style.transform = `translateX(0px)`;
                index = 0;
                void wrapper.offsetWidth; // forzar reflow
                wrapper.style.transition = 'transform 0.5s ease';
            }, 500);
        }
    };

    setInterval(moveNext, 5000);
}

function enviarFormulario() {
    let formData = new FormData($("#inmobiliaira_form")[0]);
    let esValido = true; // ✅ Asegúrate de inicializarlo

    $("#inmobiliaira_form [required]").each(function () {
        if ($.trim($(this).val()) === "") {
            $(this).addClass("input-error");
            esValido = false;
        } else {
            $(this).removeClass("input-error");
        }
    });

    if (!esValido) {
        return false;
    }

    $("#loader").fadeIn();

    $.ajax({
        url: "./controller/inmobiliaria.php?op=enviar_formulario",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            console.log(datos);  
            if (datos.success == 1) {

                // Ocultar loader al finalizar
                $("#loader").fadeOut();

                $("#inmobiliaira_form")[0].reset();

                Swal.fire({
                    title: 'Formulario enviado!',
                    text: 'Gracias por tu interés. Nos pondremos en contacto contigo pronto.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });

            } else {

                $("#loader").fadeOut();

                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al enviar el formulario. Intenta nuevamente.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
            }
        },
    });

    return true;
}

// Elimina el borde rojo cuando el usuario comienza a escribir o seleccionar
$(document).ready(function () {
    $("#inmobiliaira_form").on("input change", "[required]", function () {
        if ($.trim($(this).val()) !== "") {
            $(this).removeClass("input-error");
        }
    });
});
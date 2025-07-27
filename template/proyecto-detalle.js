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
    
    let id_proyecto = $.urlParam('v');

    $('#id_proyecto').val(id_proyecto)

    $.post("./controller/proyecto.php?op=info_proyecto", { id: id_proyecto }, function(data) {
        data = JSON.parse(data);
        $('#title_proyect').html(data.nombre);
        $('#descrip').html(data.descrip);

        // Controlar valores dinámicos
        const area          = data.area +' m²';
        const dormitorios   = data.ndormit;
        const pisos         = data.npisos;
        const banos         = data.nbanos;

        // Asignar dinámicamente los datos a los <li>
        $('.area-value').html(area);
        $('.dormitorios-value').html(dormitorios);
        $('.pisos-value').html(pisos);
        $('.banos-value').html(banos);
    });

    $.post("./controller/proyecto.php?op=fotos_x_proyecto", { id: id_proyecto }, function(response) {
    
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
            $('#proyect_name').html(foto.proyecto_nombre);
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

    $.post("./controller/proyecto.php?op=proyecto_relazionado", { id: id_proyecto }, function (html) {
        $('#carousel_proyectos').html(html);
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
    let formData = new FormData($("#proyecto_form")[0]);
    let esValido = true; // ✅ Asegúrate de inicializarlo

    $("#proyecto_form [required]").each(function () {
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
        url: "./controller/proyecto.php?op=enviar_formulario",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            console.log(datos);  
            if (datos.success == 1) {

                // Ocultar loader al finalizar
                $("#loader").fadeOut();

                $("#proyecto_form")[0].reset();

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
    $("#proyecto_form").on("input change", "[required]", function () {
        if ($.trim($(this).val()) !== "") {
            $(this).removeClass("input-error");
        }
    });
});
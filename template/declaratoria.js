$(document).ready(function(){

    $("#loader").fadeOut()

    $.post("./controller/declaratoria.php?op=mostrar_datos", function(data) {
        data = JSON.parse(data);
        $('#descrip_decla').html(data.descrip_decla);
        $('#descrip_indep').html(data.descrip_indep);
    });

    obtenerFooter()
});

function enviarFormulario() {
    let formData = new FormData($("#declaratoria_form")[0]);
    let esValido = true; // ✅ Asegúrate de inicializarlo

    $("#declaratoria_form [required]").each(function () {
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
        url: "./controller/declaratoria.php?op=enviar_formulario",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            console.log(datos);  
            if (datos.success == 1) {

                // Ocultar loader al finalizar
                $("#loader").fadeOut();

                $("#declaratoria_form")[0].reset();

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
    $("#declaratoria_form").on("input change", "[required]", function () {
        if ($.trim($(this).val()) !== "") {
            $(this).removeClass("input-error");
        }
    });
});
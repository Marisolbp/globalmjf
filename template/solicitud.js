$(document).ready(function(){

    $("#loader").fadeOut();
    
    obtenerFooter()

    $.post("./controller/solicitud.php?op=combo_tipo_prop",function(data, status){
        $('#id_t_prop').html(data);
    });

    $.post("./controller/solicitud.php?op=combo_depart",function(data, status){
        $('#id_depart').html(data);
    });

    $('#id_provin').prop('disabled', true); 
    $('#id_distri').prop('disabled', true); 
});

$('#id_depart').on('change', function () {

    $('#id_provin').prop('disabled', false); 

    $.post("./controller/solicitud.php?op=combo_prov", { id_depart : $(this).val() }, function(data, status){
        $('#id_provin').html(data);
    });
});

$('#id_provin').on('change', function () {

    $('#id_distri').prop('disabled', false); 

    $.post("./controller/solicitud.php?op=combo_dist_prov", { id_provin : $(this).val() }, function(data, status){
        $('#id_distri').html(data);
    });
});

function registrarSolicitud() {
    let formData = new FormData($("#solicitud_form")[0]);
    let esValido = true; // ✅ Asegúrate de inicializarlo

    $("#solicitud_form [required]").each(function () {
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
        url: "./controller/solicitud.php?op=registrar_solicitud",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            console.log(datos);  
            if (datos.success == 1) {

                // Ocultar loader al finalizar
                $("#loader").fadeOut();

                $("#solicitud_form")[0].reset();

                Swal.fire({
                    title: '¡Solicitud enviada!',
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
                    text: 'Hubo un problema al registrar la solicitud. Intenta nuevamente.',
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
    $("#solicitud_form").on("input change", "[required]", function () {
        if ($.trim($(this).val()) !== "") {
            $(this).removeClass("input-error");
        }
    });
});
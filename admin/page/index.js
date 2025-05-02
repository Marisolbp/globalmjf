function init(){

}

$(document).ready(function(){
    $("#usuario").focus();
});

$("#formlogin").on("submit", function(e) {
    e.preventDefault();  // 🚫 Detiene el envío normal del form
    login();             // ✅ Llama a tu función login
});

function login() {

    var formData = new FormData($("#formlogin")[0]);
    const campos = [
      "#usuario",
      "#clave"
    ];

    for (let i = 0; i < campos.length; i++) {
        if ($(campos[i]).val().trim() === "") {

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        Toast.fire({
            icon: "warning",
            title: "Complete todos los datos",
        });

        $(campos[i]).focus();
        return false;
        }
    }

    $.ajax({
         url: "controller/usuario.php?op=login",
         type: "POST",
         data: formData,
         contentType: false,
         processData: false,
         success: function (datos) {
            console.log(datos); 
            if (datos.success == 1) {
                window.location='view/Home/';
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                    },
                });
                Toast.fire({
                    icon: "error",
                    title: datos.mensaje || "Error desconocido",
                });
            }
        }
    });
};
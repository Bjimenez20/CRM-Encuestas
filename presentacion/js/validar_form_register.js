
function validar(tuformulario, val) {
    var NOMBRE = $("#name").val();
    if (NOMBRE == '') {
        MENSAJE = "Debes ingresar un nombre.";
        $("#mensaje").html(MENSAJE);
        $("#modalMensaje").modal('show');
        $('#name').focus();
        return false;
    }

    


    var APELLIDO = $("#last_name").val();
    if (APELLIDO == '') {
        MENSAJE = "Debes ingresar un apellido.";
        $("#mensaje").html(MENSAJE);
        $("#modalMensaje").modal('show');
        $('#last_name').focus();
        return false;
    }


    var CORREO = $("#email").val();
    if (CORREO == '') {
        MENSAJE = "Debes ingresar un correo electronico.";
        $("#mensaje").html(MENSAJE);
        $("#modalMensaje").modal('show');
        $('#email').focus();
        return false;
    } 


    // var TELEFONO = $("#phone").val();
    // if (TELEFONO == '') {
    //     MENSAJE = "Debes ingresar un número de teléfono.";
    //     $("#mensaje").html(MENSAJE);
    //     $("#modalMensaje").modal('show');
    //     $('#phone').focus();
    //     return false;
    // }

    // // var TELEFONOVAL = $("#phone").val();
    // // var NUM1 = "10";
    // // if (TELEFONOVAL < NUM1) {
    // //     MENSAJE = "Prueba 2";
    // //     $("#mensaje").html(MENSAJE);
    // //     $("#modalMensaje").modal('show');
    // //     $('#phone').focus();
    // //     return false;
    // // }

    // // var TELEFONOVAL = $("#phone").val();
    // // if (TELEFONOVAL >= 7){
    // //     MENSAJE = "Prueba 1";
    // //     $("#mensaje").html(MENSAJE);
    // //     $("#modalMensaje").modal('show');
    // //     $('#phone').focus();
    // //     return false;
    // // }

    const numberInput = document.getElementById('phone');

    var ROL = $("#role").val();
    if (ROL == '') {
        MENSAJE = "Por favor, selecciona un Rol";
        $("#mensaje").html(MENSAJE);
        $("#modalMensaje").modal('show');
        $('#role').focus();
        return false;
    }



    var ESTADO = $("#state").val();
    if (ESTADO == '') {
        MENSAJE = "Por favor, selecciona un Estado";
        $("#mensaje").html(MENSAJE);
        $("#modalMensaje").modal('show');
        $('#state').focus();
        return false;
    }

    var PROVEEDOR = $("#proveed").val();
    if (PROVEEDOR == '') {
        MENSAJE = "Por favor, selecciona un Proveedor";
        $("#mensaje").html(MENSAJE);
        $("#modalMensaje").modal('show');
        $('#proveed').focus();
        return false;
    }



}
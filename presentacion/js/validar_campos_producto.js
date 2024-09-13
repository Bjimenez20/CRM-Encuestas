function validar() {
    var EMPRESA = $("#NOM_PROVEE").val();
    if (EMPRESA == '' || EMPRESA == 'Seleccione...') {
        alert('El campo empresa esta vacio');
        $('#NOM_PROVEE').focus();
        return false;
    }

    var NUMERO_REMI = $("#NO_REMICION").val();
    if (NUMERO_REMI == '' || NUMERO_REMI == 'Seleccione...') {
        alert('El campo numero de remision esta vacio');
        $('#NO_REMICION').focus();
        return false;
    }

    var REFERENCIA = $("#REFERENCIA").val();
    if (REFERENCIA == '' || REFERENCIA == 'Seleccione...') {
        alert('No a seleccionado una referencia');
        $('#REFERENCIA').focus();
        return false;
    }

    var MARCA = $("#MARCA").val();
    if (MARCA == '' || MARCA == 'Seleccione...') {
        alert('No selecciono un material');
        $('#MARCA').focus();
        return false;
    }

    var UNIDADES = $("#UNIDADES").val();
    if (UNIDADES == '' || UNIDADES == 'Seleccione...') {
        alert('El campo cantidad esta vacio');
        $('#UNIDADES').focus();
        return false;
    }

    var ESTADO_PRODUCTO = $("#ESTADO_PRODUCTO").val();
    if (ESTADO_PRODUCTO == '' || ESTADO_PRODUCTO == 'Seleccione...') {
        alert('No selecciono un estado');
        $('#ESTADO_PRODUCTO').focus();
        return false;
    }

    var DESCRIPCION = $("#DESCRIPCION_DEL_DISPOSITIVO").val();
    if (DESCRIPCION == '' || DESCRIPCION == 'Seleccione...') {
        alert('El campo descripcion esta vacio');
        $('#DESCRIPCION_DEL_DISPOSITIVO').focus();
        return false;
    }

    var BODEGA = $("#BODEGA").val();
    if (BODEGA == '' || BODEGA == 'Seleccione...') {
        alert('No selecciono una bodega');
        $('#BODEGA').focus();
        return false;
    }
}
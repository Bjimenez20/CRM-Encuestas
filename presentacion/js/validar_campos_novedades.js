function validar(tuformulario, val) {

    var PAP = $("#PAP").val();
    if (PAP == '' || PAP == ' ') {
        alert('El pap esta vacio');
        $('#PAP').focus();
        return false;
    }

    var ASUNTO = $("#ASUNTO").val();
    if (ASUNTO == '' || ASUNTO == ' ') {
        alert('El asunto esta vacio');
        $('#ASUNTO').focus();
        return false;
    }

    var PRODUCTO = $("#PRODUCTO").val();
    if (PRODUCTO == '' || PRODUCTO == ' ') {
        alert('El producto esta vacio');
        $('#PRODUCTO').focus();
        return false;
    }

    var NOVEDAD = $("#NOVEDAD").val();
    if (NOVEDAD == '' || NOVEDAD == 'Seleccione...') {
        alert('Debe seleccionar una novedad');
        $('#NOVEDAD').focus();
        return false;
    }

    var FECHA_REPORTE = $("#FECHA_REPORTE").val();
    if (FECHA_REPORTE == '') {
        alert('La fecha del reporte esta vacia');
        $('#FECHA_REPORTE').focus();
        return false;
    }

    var OBSERVACION = $("#OBSERVACION").val();
    if (OBSERVACION == '') {
        alert('La observacion esta vacia');
        $('#OBSERVACION').focus();
        return false;
    }

}
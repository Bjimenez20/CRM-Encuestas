function validar(tuformulario, val) {

    var NOMBRE = $("#nombre").val();
    if (NOMBRE == '') {
        alert('El nombre esta vacio');
        $('#nombre').focus();
        return false;
    }

    var APELLIDO = $("#apellidos").val();
    if (APELLIDO == '') {
        alert('El apellido esta vacio');
        $('#apellidos').focus();
        return false;
    }

    var TELEFONO = $("#telefono1").val();
    if (TELEFONO == '') {
        alert('El telefono esta vacio');
        $('#telefono1').focus();
        return false;
    }

    var NOTA = $("#txtCurp").val();
    if (NOTA == '') {
        alert('La nota esta vacia');
        $('#txtCurp').focus();
        return false;
    }

}
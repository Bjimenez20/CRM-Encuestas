// JavaScript Document
function validar(tuformulario, val) {

	var MEDICAMENTO = $("#MEDICAMENTO").val();
	if (MEDICAMENTO == 'KOGENATE FS 2000 PLAN' || MEDICAMENTO == 'Xofigo 1x6 ml CO') {
		var DOSIS2 = $("#Dosis2").val();
		if (DOSIS2 == '') {
			alert('La dosis esta vacia');
			$('#Dosis2').focus();
			return false;
		}
	} else if ($MEDICAMENTO == 'KOGENATE FS 2000 PLAN') {
		var DOSIS3 = $("#Dosis3").val();
		if (DOSIS3 == '' || DOSIS3 == 'Seleccione...') {
			alert('La dosis esta vacia');
			$('#Dosis3').focus();
			return false;
		}
	} else {
		var DOSIS = $("#Dosis").val();
		if (DOSIS == '' || DOSIS == 'Seleccione...') {
			alert('La dosis esta vacia');
			$('#Dosis').focus();
			return false;
		}
	}

	var RECLAMO = $("#reclamo").val();
	if (RECLAMO == '' || RECLAMO == 'Seleccione...') {
		alert('El reclamo esta vacio');
		$('#reclamo').focus();
		return false;
	}

	if (RECLAMO == 'SI') {
		var MEDICAMENTO = $("#MEDICAMENTO").val();
		if (MEDICAMENTO == 'BETAFERON CMBP X 15 VPFS (3750 MCG) MM') {
			var FECHA_RECLAMACION = $("#fecha_reclamacion").val();
			if (FECHA_RECLAMACION == '') {
				alert('La fecha de reclamacion esta vacia');
				$('#fecha_reclamacion').focus();
				return false;
			}

			var CONSECUTIVO_BETAFERON = $("#consecutivo_betaferon").val();
			if (CONSECUTIVO_BETAFERON == '') {
				alert('El consecutivo de betaferon esta vacio');
				$('#consecutivo_betaferon').focus();
				return false;
			}
		}
		else {
			var FECHA_RECLAMACION = $("#fecha_reclamacion").val();
			if (FECHA_RECLAMACION == '') {
				alert('La fecha de reclamacion esta vacia');
				$('#fecha_reclamacion').focus();
				return false;
			}
		}
	}
	else if (RECLAMO == 'NO') {
		var CAUSA_NO_RECLAMACION = $("#causa_no_reclamacion").val();
		if (CAUSA_NO_RECLAMACION == '' || CAUSA_NO_RECLAMACION == 'Seleccione...') {
			alert('La causa de no reclamacion esta vacia');
			$('#causa_no_reclamacion').focus();
			return false;
		}
	}
	var crear = $("#crear").val();
	if (crear == '' || crear == 'Seleccione...') {
		alert('Crear gestion esta vacio');
		$('#crear').focus();
		return false;
	}
}
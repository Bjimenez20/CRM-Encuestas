function validar(tuformulario, val) {
	var LOGRO_COMUNICACION = $('input:radio[name=logro_comunicacion]:checked').val();
	if (LOGRO_COMUNICACION == '') {
		alert('El logro de la comunicacion esta vacio');
		$('#logro_comunicacion').focus();
		return false;
	}
	var FECHA_AUTORIZACIONES = $("#fecha_autorizacion").val();
	if (FECHA_AUTORIZACIONES == '') {
		alert('La Fecha de Autorizacion esta vacia');
		$('#fecha_autorizacion').focus();
		return false;
	}
	var RECLAMO = $("#reclamo").val();
	if (RECLAMO == '' || RECLAMO == 'Seleccione...') {
		alert('El reclamo esta vacio');
		$('#reclamo').focus();
		return false;
	}
	if (RECLAMO == 'SI') {
		var MEDICAMENTO = $("#MEDICAMENTO").val();
		if (MEDICAMENTO == 'BETAFERON') {
			var FECHA_RECLAMACION = $("#fecha_reclamacion").val();
			if (FECHA_RECLAMACION == '') {
				alert('La fecha de reclamacion esta vacia');
				$('#fecha_reclamacion').focus();
				return false;
			}
			var FECHA_RECLAMACION = $("#fecha_reclamacion").val();
			var FECHA_ACTUAL = $("#fecha_actual").val();
			if (FECHA_RECLAMACION > FECHA_ACTUAL) {
				alert('La fecha de reclamacion es mayor a la actual');
				$('#fecha_reclamacion').focus();
				return false;
			}
			var CONSECUTIVO_BETAFERON = $("#consecutivo_betaferon").val();
			if (CONSECUTIVO_BETAFERON == '') {
				alert('El consecutivo de betaferon esta vacio');
				$('#consecutivo_betaferon').focus();
				return false;
			}
			var NUMERO_CAJAS = $("#numero_cajas").val();
			if (NUMERO_CAJAS == '') {
				alert('El numero de cajas esta vacio');
				$('#numero_cajas').focus();
				return false;
			}
			var TIPO_NUMERO_CAJAS = $("#tipo_numero_cajas").val();
			if (TIPO_NUMERO_CAJAS == '') {
				alert('El tipo numero de cajas esta vacio');
				$('#tipo_numero_cajas').focus();
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
			var NUMERO_CAJAS = $("#numero_cajas").val();
			if (NUMERO_CAJAS == '') {
				alert('El numero de cajas esta vacio');
				$('#numero_cajas').focus();
				return false;
			}
			var TIPO_NUMERO_CAJAS = $("#tipo_numero_cajas").val();
			if (TIPO_NUMERO_CAJAS == '') {
				alert('El tipo numero de cajas esta vacio');
				$('#tipo_numero_cajas').focus();
				return false;
			}
		}
		var FECHA_AUTORIZACIONES = $("#fecha_autorizacion").val();
		if (FECHA_AUTORIZACIONES == '') {
			alert('La Fecha de Autorizacion esta vacia');
			$('#fecha_autorizacion').focus();
			return false;
		}
	}
	else {
		var MEDICAMENTO = $("#MEDICAMENTO").val();
		if (MEDICAMENTO == 'EYLIA') {
			var NUMERO_CAJAS = $("#numero_cajas").val();
			if (NUMERO_CAJAS == '') {
				alert('El numero de cajas esta vacio');
				$('#numero_cajas').focus();
				return false;
			}
			var TIPO_NUMERO_CAJAS = $("#tipo_numero_cajas").val();
			if (TIPO_NUMERO_CAJAS == '') {
				alert('El tipo numero de cajas esta vacio');
				$('#tipo_numero_cajas').focus();
				return false;
			}
		}
		var CAUSA_NO_RECLAMACION = $("#causa_no_reclamacion").val();
		if (CAUSA_NO_RECLAMACION == '' || CAUSA_NO_RECLAMACION == 'Seleccione...') {
			alert('La causa de no reclamacion esta vacia');
			$('#causa_no_reclamacion').focus();
			return false;
		}
		if (CAUSA_NO_RECLAMACION == 'Abandono') {
			var fecha_retiro = $("#fecha_retiro").val();
			if (fecha_retiro == '') {
				alert('La fecha de retiro esta vacio');
				$('#fecha_retiro').focus();
				return false;
			}
			var fecha_retiro = $("#fecha_retiro").val();
			if (fecha_retiro != '') {
				var motivo_retiro = $("#motivo_retiro").val();
				if (motivo_retiro == '' || motivo_retiro == 'Seleccione...') {
					alert('Seleccione motivo de retiro');
					$('#motivo_retiro').focus();
					return false;
				}
				var observacion_retiro = $("#observacion_retiro").val();
				if (observacion_retiro == '') {
					alert('La observacion de retiro esta vacia');
					$('#observacion_retiro').focus();
					return false;
				}
			}
		}
		var FECHA_AUTORIZACIONES = $("#fecha_autorizacion").val();
		if (FECHA_AUTORIZACIONES == '') {
			alert('La Fecha de Autorizacion esta vacia');
			$('#fecha_autorizacion').focus();
			return false;
		}
	}

	if (LOGRO_COMUNICACION == 'SI') {
		var ESTADO = $("#estado_paciente").val();
		if (ESTADO == '' || ESTADO == 'Seleccione...') {
			alert('El estado esta vacio');
			$('#estado_paciente').focus();
			return false;
		}
		var FECHA_ACTIVACION = $("#fecha_activacion").val();
		if (FECHA_ACTIVACION == '') {
			alert('La fecha de activacion esta vacia');
			$('#fecha_activacion').focus();
			return false;
		}
		//informacion seguimietno
		var CORREO = $("#correo").val();
		if (CORREO == '') {
			alert('Debe ingresar un correo electronico');
			$('#correo').focus();
			return false;
		}

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
		var TIPO_IDENTIFICACION = $("#tipo_identificacion").val();
		if (TIPO_IDENTIFICACION == '' || TIPO_IDENTIFICACION == 'Seleccione...') {
			alert('El tipo de identificacion esta vacio');
			$('#tipo_identificacion').focus();
			return false;
		}

		var IDENTIFICACION = $("#identificacion").val();
		if (IDENTIFICACION == '') {
			alert('La identificacion esta vacia');
			$('#identificacion').focus();
			return false;
		}
		var TELEFONO1 = $("#telefono1").val();
		if (TELEFONO1 == '') {
			alert('El telefono 1 esta vacio');
			$('#telefono1').focus();
			return false;
		}
		var DEPARTAMENTO = $("#departamento").val();
		if (DEPARTAMENTO == '' || DEPARTAMENTO == 'Seleccione...') {
			alert('El departamento esta vacio');
			$('#departamento').focus();
			return false;
		}
		var CIUDAD = $("#ciudad").val();
		if (CIUDAD == '' || CIUDAD == 'Seleccione...') {
			alert('La ciudad esta vacia');
			$('#ciudad').focus();
			return false;
		}
		var BARRIO = $("#barrio").val();
		if (BARRIO == '') {
			alert('El barrio esta vacio');
			$('#barrio').focus();
			return false;
		}
		if (val == 2) {
			var DIRECCION = $("#direccion_act").val();
			if (DIRECCION == '') {
				var DIRECCION2 = $("#DIRECCION").val();
				if (DIRECCION2 == '') {
					alert('La direccion esta vacia');
					$('#DIRECCION').focus();
					return false;
				}
			}
		}
		if (val == 1) {
			var DIRECCION = $("#DIRECCION").val();
			if (DIRECCION == '') {
				alert('La direccion esta vacia');
				$('#DIRECCION').focus();
				return false;
			}
		}
		var GENERO = $("#genero").val();
		if (GENERO == '' || GENERO == 'Seleccione...') {
			alert('El genero esta vacio');
			$('#genero').focus();
			return false;
		}
		var FECHA_NACIMIENTO = $("#fecha_nacimiento").val();
		if (FECHA_NACIMIENTO == '') {
			alert('La fecha de nacimiento esta vacia');
			$('#fecha_nacimiento').focus();
			return false;
		}
		var ACUDIENTE = $("#acudiente").val();
		if (ACUDIENTE != '') {
			var TELEFONO_ACUDIENTE = $("#telefono_acudiente").val();
			if (TELEFONO_ACUDIENTE == '') {
				alert('El telefono del acudiente esta vacio');
				$('#telefono_acudiente').focus();
				return false;
			}
		}
		var CIUDAD_RECLAMACION = $("#ciudad_reclamacion").val();
		if (CIUDAD_RECLAMACION == '' || CIUDAD_RECLAMACION == 'Seleccione...') {
			alert('La Ciudad de Entrega esta vacia');
			$('#ciudad_reclamacion').focus();
			return false;
		}
		var PRODUCTO = $("#producto_tratamiento").val();
		if (PRODUCTO == '' || PRODUCTO == 'Seleccione...') {
			alert('El producto del tratamiento esta vacio');
			$('#producto_tratamiento').focus();
			return false;
		}
		if (PRODUCTO == 'KOGENATE' || PRODUCTO == 'XOFIGO' || PRODUCTO == 'KOVALTRY' || PRODUCTO == 'JIVI') {
			if (PRODUCTO == 'XOFIGO') {
				var DOSIS2 = $("#Dosis2").val();
				if (DOSIS2 == '') {
					alert('La dosis esta vacia 1');
					$('#Dosis2').focus();
					return false;
				}
			}
			if (PRODUCTO == 'KOGENATE') {
				var DOSIS3 = $("#Dosis3").val();
				if (DOSIS3 == '') {
					alert('La dosis esta vacia 2');
					$('#Dosis3').focus();
					return false;
				}
			}
			if (PRODUCTO == 'KOVALTRY') {
				var DOSIS4 = $("#Dosis2").val();
				if (DOSIS4 == '') {
					alert('La dosis esta vacia 3');
					$('#Dosis2').focus();
					return false;
				}
			}
			if (PRODUCTO == 'JIVI') {
				var DOSIS5 = $("#Dosis2").val();
				if (DOSIS5 == '') {
					alert('La dosis esta vacia 4');
					$('#Dosis2').focus();
					return false;
				}
			}
		} else {
			var DOSIS = $("#Dosis").val();
			if (DOSIS == '' || DOSIS == 'Seleccione...') {
				alert('La dosis esta vacia 6');
				$('#Dosis').focus();
				return false;
			}

			var FECHA_ENTREGA = $("#fecha_entrega_1").val();
			if (FECHA_ENTREGA == '') {
				alert('La fecha de entrega esta vacia');
				$('#fecha_entrega_1').focus();
				return false;
			}

			var FECHA_VENCIMIENTO = $("#fecha_vencimiento_1").val();
			if (FECHA_VENCIMIENTO == '') {
				alert('La fecha de vencimiento esta vacia');
				$('#fecha_vencimiento_1').focus();
				return false;
			}

			var NUMERO_SN = $("#numero_sn_1").val();
			if (NUMERO_SN == '') {
				alert('El numero sn esta vacio');
				$('#numero_sn_1').focus();
				return false;
			}

			var FECHA_PRIMER_USO = $("#fecha_primer_uso_1").val();
			if (FECHA_PRIMER_USO == '') {
				alert('La fecha de primer uso esta vacia');
				$('#fecha_primer_uso_1').focus();
				return false;
			}

			var DISPOSITIVO = $("#tipo_de_dispositivo_1").val();
			if (DISPOSITIVO == '' || DISPOSITIVO == 'Seleccione...') {
				alert('El tipo de dispositivo esta vacio');
				$('#tipo_de_dispositivo_1').focus();
				return false;
			}

			var MOTIVO_CAMBIO = $("#motivo_cambio_1").val();
			if (MOTIVO_CAMBIO == '' || DISPOSITIVO == 'Seleccione...') {
				alert('El motivo del cambio esta vacio');
				$('#motivo_cambio_1').focus();
				return false;
			}
		}

		if (PRODUCTO == 'BETAFERON' || PRODUCTO == 'VENTAVIS') {
			var FECHA_VENCIMIENTO = $("#fecha_vencimiento").val();
			if (FECHA_VENCIMIENTO == '') {
				alert('La fecha de vencimiento esta vacia');
				$('#fecha_vencimiento').focus();
				return false;
			}

			var FECHA_ENTREGA = $("#fecha_entrega_1").val();
			if (FECHA_ENTREGA == '') {
				alert('La fecha de entrega esta vacia');
				$('#fecha_entrega_1').focus();
				return false;
			}

			var FECHA_VENCIMIENTO = $("#fecha_vencimiento_1").val();
			if (FECHA_VENCIMIENTO == '') {
				alert('La fecha de vencimiento esta vacia');
				$('#fecha_vencimiento_1').focus();
				return false;
			}

			var NUMERO_SN = $("#numero_sn_1").val();
			if (NUMERO_SN == '') {
				alert('El numero sn esta vacio');
				$('#numero_sn_1').focus();
				return false;
			}

			var FECHA_PRIMER_USO = $("#fecha_primer_uso_1").val();
			if (FECHA_PRIMER_USO == '') {
				alert('La fecha de primer uso esta vacia');
				$('#fecha_primer_uso_1').focus();
				return false;
			}

			var DISPOSITIVO = $("#tipo_de_dispositivo_1").val();
			if (DISPOSITIVO == '' || DISPOSITIVO == 'Seleccione...') {
				alert('El tipo de dispositivo esta vacio');
				$('#tipo_de_dispositivo_1').focus();
				return false;
			}

			var MOTIVO_CAMBIO = $("#motivo_cambio_1").val();
			if (MOTIVO_CAMBIO == '' || DISPOSITIVO == 'Seleccione...') {
				alert('El motivo del cambio esta vacio');
				$('#motivo_cambio_1').focus();
				return false;
			}
		}


		if (PRODUCTO == 'BETAFERON' || PRODUCTO == 'ADEMPAS' || PRODUCTO == 'EYLIA') {
			var STATUS = $("#status_paciente").val();
			if (STATUS == '' || STATUS == 'Seleccione...') {
				alert('El status esta vacio');
				$('#status_paciente').focus();
				return false;
			}
		}
		if (PRODUCTO == 'XOFIGO') {
			var fecha_formulacionv = $("#fecha_formulacion").val();
			if (fecha_formulacionv == '') {
				alert('La fecha formulacion esta vacia');
				$('#fecha_formulacion').focus();
				return false;
			}
		}
		var TRATAMIENTO_PREVIO = $("#tratamiento_previo").val();
		if (TRATAMIENTO_PREVIO == '' || TRATAMIENTO_PREVIO == 'Seleccione...') {
			alert('El tratamiento previo esta vacio');
			$('#tratamiento_previo').focus();
			return false;
		}
		if (TRATAMIENTO_PREVIO == 'Otro') {
			var tratamiento_previo_otro = $("#tratamiento_previo_otro").val();
			if (tratamiento_previo_otro == '') {
				alert('El tratamiento previo esta vacio');
				$('#tratamiento_previo_otro').focus();
				return false;
			}
		}
		var CLASIFICACION_PATOLOGICA = $("#clasificacion_patologica").val();
		if (CLASIFICACION_PATOLOGICA == '') {
			alert('La clasificacion patologica esta vacia');
			$('#clasificacion_patologica').focus();
			return false;
		}
		var FECHA_INICIO_TERAPIA = $("#fecha_inicio_trt").val();
		if (FECHA_INICIO_TERAPIA == '') {
			alert('La fecha inicio de terapia esta vacia');
			$('#fecha_inicio_trt').focus();
			return false;
		}
		var consentimiento = $("#consentimiento").val();
		if (consentimiento == '' || consentimiento == 'Seleccione...') {
			alert('Seleccione la respuesta del consentimiento');
			$('#consentimiento').focus();
			return false;
		}
		if (LOGRO_COMUNICACION == 'SI') {
			var MOTIVO_COMUNICACION = $("#motivo_comunicacion").val();
			if (MOTIVO_COMUNICACION == '' || MOTIVO_COMUNICACION == 'Seleccione...') {
				alert('El motivo de comunicacion esta vacio');
				$('#motivo_comunicacion').focus();
				return false;
			}
			var MEDIO_CONTACTO = $("#medio_contacto").val();
			if (MEDIO_CONTACTO == '' || MEDIO_CONTACTO == 'Seleccione...') {
				alert('El medio de contacto esta vacio');
				$('#medio_contacto').focus();
				return false;
			}
			var TIPO_LLAMADA = $("#tipo_llamada").val();
			if (TIPO_LLAMADA == '' || TIPO_LLAMADA == 'Seleccione...') {
				alert('El tipo de llamada esta vacio');
				$('#tipo_llamada').focus();
				return false;
			}
		}

		var ASEGURADOR = $("#asegurador").val();
		if (ASEGURADOR == '' || ASEGURADOR == 'Seleccione...') {
			alert('El asegurador esta vacio');
			$('#asegurador').focus();
			return false;
		}

		var CANAL_CONTACTO = $("#canal_contacto").val();
		if (CANAL_CONTACTO == '' || CANAL_CONTACTO == 'Seleccione...') {
			alert('Seleccione un canal de contacto');
			$('#canal_contacto').focus();
			return false;
		}

		var TIPO_VISITA = $("#tipo_visita").val();
		if (TIPO_VISITA == '' || TIPO_VISITA == 'Seleccione...') {
			alert('Seleccione un tipo de visita');
			$('#tipo_visita').focus();
			return false;
		}

		var REGIMEN = $("#regimen").val();
		if (REGIMEN == '' || REGIMEN == 'Seleccione...') {
			alert('El regimen esta vacio');
			$('#regimen').focus();
			return false;
		}
		var OPERADOR_LOGISTICO = $("#operador_logistico").val();
		if (OPERADOR_LOGISTICO == '' || OPERADOR_LOGISTICO == 'Seleccione...') {
			alert('El operador logistico esta vacio');
			$('#operador_logistico').focus();
			return false;
		}
		if (OPERADOR_LOGISTICO == 'Otro') {
			var OPERADOR_LOGISTICO_NUEVO = $("#operador_logistico_nuevo").val();
			if (OPERADOR_LOGISTICO_NUEVO == '') {
				alert('El operador logistico nuevo esta vacio');
				$('#operador_logistico_nuevo').focus();
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
			if (MEDICAMENTO == 'BETAFERON') {
				var FECHA_RECLAMACION = $("#fecha_reclamacion").val();
				if (FECHA_RECLAMACION == '') {
					alert('La fecha de reclamacion esta vacia');
					$('#fecha_reclamacion').focus();
					return false;
				}
				var FECHA_RECLAMACION = $("#fecha_reclamacion").val();
				var FECHA_ACTUAL = $("#fecha_actual").val();
				if (FECHA_RECLAMACION > FECHA_ACTUAL) {
					alert('La fecha de reclamacion es mayor a la actual');
					$('#fecha_reclamacion').focus();
					return false;
				}
				var CONSECUTIVO_BETAFERON = $("#consecutivo_betaferon").val();
				if (CONSECUTIVO_BETAFERON == '') {
					alert('El consecutivo de betaferon esta vacio');
					$('#consecutivo_betaferon').focus();
					return false;
				}
				var NUMERO_CAJAS = $("#numero_cajas").val();
				if (NUMERO_CAJAS == '') {
					alert('El numero de cajas esta vacio');
					$('#numero_cajas').focus();
					return false;
				}
				var TIPO_NUMERO_CAJAS = $("#tipo_numero_cajas").val();
				if (TIPO_NUMERO_CAJAS == '') {
					alert('El tipo numero de cajas esta vacio');
					$('#tipo_numero_cajas').focus();
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
				var NUMERO_CAJAS = $("#numero_cajas").val();
				if (NUMERO_CAJAS == '') {
					alert('El numero de cajas esta vacio');
					$('#numero_cajas').focus();
					return false;
				}
				var TIPO_NUMERO_CAJAS = $("#tipo_numero_cajas").val();
				if (TIPO_NUMERO_CAJAS == '') {
					alert('El tipo numero de cajas esta vacio');
					$('#tipo_numero_cajas').focus();
					return false;
				}
			}
			var NUMERO_AUTORIZACIONES = $("#estado_ctc").val();
			if (NUMERO_AUTORIZACIONES == 'Seleccione...') {
				alert('Numero De Autorizacion esta vacio');
				$('#estado_ctc').focus();
				return false;
			}

			var FECHA_AUTORIZACIONES = $("#fecha_autorizacion").val();
			if (FECHA_AUTORIZACIONES == '') {
				alert('La Fecha de Autorizacion esta vacia');
				$('#fecha_autorizacion').focus();
				return false;
			}
		}
		else {
			var MEDICAMENTO = $("#MEDICAMENTO").val();
			if (MEDICAMENTO == 'EYLIA') {
				var NUMERO_CAJAS = $("#numero_cajas").val();
				if (NUMERO_CAJAS == '') {
					alert('El numero de cajas esta vacio');
					$('#numero_cajas').focus();
					return false;
				}
				var TIPO_NUMERO_CAJAS = $("#tipo_numero_cajas").val();
				if (TIPO_NUMERO_CAJAS == '') {
					alert('El tipo numero de cajas esta vacio');
					$('#tipo_numero_cajas').focus();
					return false;
				}
			}
			var CAUSA_NO_RECLAMACION = $("#causa_no_reclamacion").val();
			if (CAUSA_NO_RECLAMACION == '' || CAUSA_NO_RECLAMACION == 'Seleccione...') {
				alert('La causa de no reclamacion esta vacia');
				$('#causa_no_reclamacion').focus();
				return false;
			}
			if (CAUSA_NO_RECLAMACION == 'Abandono') {
				var fecha_retiro = $("#fecha_retiro").val();
				if (fecha_retiro == '') {
					alert('La fecha de retiro esta vacio');
					$('#fecha_retiro').focus();
					return false;
				}
				var fecha_retiro = $("#fecha_retiro").val();
				if (fecha_retiro != '') {
					var motivo_retiro = $("#motivo_retiro").val();
					if (motivo_retiro == '' || motivo_retiro == 'Seleccione...') {
						alert('Seleccione motivo de retiro');
						$('#motivo_retiro').focus();
						return false;
					}
					var observacion_retiro = $("#observacion_retiro").val();
					if (observacion_retiro == '') {
						alert('La observacion de retiro esta vacia');
						$('#observacion_retiro').focus();
						return false;
					}
				}
			}
			var NUMERO_AUTORIZACIONES = $("#estado_ctc").val();
			if (NUMERO_AUTORIZACIONES == '' || NUMERO_AUTORIZACIONES == 'Seleccione...') {
				alert('Numero De Autorizacion esta vacio');
				$('#estado_ctc').focus();
				return false;
			}

			var FECHA_AUTORIZACIONES = $("#fecha_autorizacion").val();
			if (FECHA_AUTORIZACIONES == '') {
				alert('La Fecha de Autorizacion esta vacia');
				$('#fecha_autorizacion').focus();
				return false;
			}
		}
		if (val == 1) {
			var MEDICAMENTO = $("#producto_tratamiento").val();
		}
		if (val == 2) {
			var MEDICAMENTO = $("#MEDICAMENTO").val();
		}
		if (MEDICAMENTO == 'EYLIA' || MEDICAMENTO == 'VENTAVIS' || MEDICAMENTO == 'ADEMPAS' || MEDICAMENTO == 'XOFIGO') {
			if (MEDICAMENTO == 'ADEMPAS') {
				var brindo_apoyo = $("#brindo_apoyo").val();
				if (brindo_apoyo == '') {
					alert('Brindo apoyo esta vacio');
					$('#brindo_apoyo').focus();
					return false;
				}
			}
			var paap = $("#paap").val();
			if (paap == '') {
				alert('El PAAP esta vacio');
				$('#paap').focus();
				return false;
			}
			if (paap == 'SI') {
				var sub_paap = $("#sub_paap").val();
				if (sub_paap == '') {
					alert('El Sub PAAP esta vacio');
					$('#sub_paap').focus();
					return false;
				}
				if (sub_paap == 'Con barrera') {
					var sub_barrera = $("#sub_barrera").val();
					if (sub_barrera == '') {
						alert('La Barrera esta vacia');
						$('#sub_barrera').focus();
						return false;
					}
				}
			}
		}
		var genera_solicitud = $('input:radio[name=genera_solicitud]:checked').val();
		if (genera_solicitud == '') {
			alert('Genera solicitud esta vacio');
			$('#genera_solicitud').focus();
			return false;
		}
		var NUMERO_AUTORIZACIONES = $("#estado_ctc").val();
		if (NUMERO_AUTORIZACIONES == '' || NUMERO_AUTORIZACIONES == 'Seleccione...') {
			alert('Numero De Autorizacion esta vacio');
			$('#estado_ctc').focus();
			return false;
		}
		var FECHA_AUTORIZACIONES = $("#fecha_autorizacion").val();
		if (FECHA_AUTORIZACIONES == '') {
			alert('La Fecha de Autorizacion esta vacia');
			$('#fecha_autorizacion').focus();
			return false;
		}
		var EVENTO_ADVERSO = $('input:radio[name=evento_adverso]:checked').val();
		if (EVENTO_ADVERSO == '') {
			alert('El evento adverso esta vacio');
			$('#evento_adverso').focus();
			return false;
		}
		if (EVENTO_ADVERSO == 'SI') {
			var TIPO_EVENTO_ADVERSO = $('input:radio[name=tipo_evento_adverso]:checked').val();
			if (TIPO_EVENTO_ADVERSO == '') {
				alert('El tipo de evento adverso esta vacio');
				$('#tipo_evento_adverso').focus();
				return false;
			}
		}
		var IPS_ATIENDE = $("#ips_atiende").val();
		if (IPS_ATIENDE == '') {
			alert('La ips que atiende esta vacia');
			$('#ips_atiende').focus();
			return false;
		}
		var MEDICO = $("#medico").val();
		if (MEDICO == '' || MEDICO == 'Seleccione...') {
			alert('El medico esta vacio');
			$('#medico').focus();
			return false;
		}
		if (MEDICO == 'Otro') {
			var MEDICO_NUEVO = $("#medico_nuevo").val();
			if (MEDICO_NUEVO == '') {
				alert('El medico nuevo esta vacio');
				$('#medico_nuevo').focus();
				return false;
			}
		}
		var PRODUCTO_TRATAMIENTO = $("#producto_tratamiento").val();
		if (PRODUCTO_TRATAMIENTO != '') {
			if (PRODUCTO_TRATAMIENTO == 'VENTAVIS') {
				var NEBULIZACIONES = $("#nebulizaciones").val();
				if (NEBULIZACIONES == '') {
					alert('El numero de nebulizaciones esta vacio');
					$('#nebulizaciones').focus();
					return false;
				}
			}
		}
		var FECHA_RECLAMACION = $("#fecha_reclamacion").val();
		var FECHA_ACTUAL = $("#fecha_actual").val();
		if (FECHA_RECLAMACION > FECHA_ACTUAL) {
			alert('La fecha de reclamacion es mayor a la actual');
			$('#fecha_reclamacion').focus();
			return false
		}
		var NUMERO_AUTORIZACIONES = $("#estado_ctc").val();
		if (NUMERO_AUTORIZACIONES == '' || NUMERO_AUTORIZACIONES == 'Seleccione...') {
			alert('Numero De Autorizacion esta vacio');
			$('#estado_ctc').focus();
			return false;
		}
		var FECHA_AUTORIZACIONES = $("#fecha_autorizacion").val();
		if (FECHA_AUTORIZACIONES == '') {
			alert('La Fecha de Autorizacion esta vacia');
			$('#fecha_autorizacion').focus();
			return false;
		}
		var FECHA_PROXIMA_LLAMADA = $("#fecha_proxima_llamada").val();
		if (FECHA_PROXIMA_LLAMADA == '') {
			alert('La fecha de proxima llamada esta vacia');
			$('#fecha_proxima_llamada').focus();
			return false;
		}
		var FECHA_PROXIMA_LLAMADA = $("#fecha_proxima_llamada").val();
		var FECHA_ACTUAL = $("#fecha_actual").val();
		if (FECHA_PROXIMA_LLAMADA < FECHA_ACTUAL) {
			alert('La fecha de la proxima llamada no puede ser menor a la fecha actual');
			$('#fecha_proxima_llamada').focus();
			return false;
		}
		var MOTIVO_PROXIMA_LLAMADA = $("#motivo_proxima_llamada").val();
		if (MOTIVO_PROXIMA_LLAMADA == '') {
			alert('El motivo de proxima llamada esta vacio');
			$('#motivo_proxima_llamada').focus();
			return false;
		}
		var FECHA_AUTORIZACIONES = $("#fecha_autorizacion").val();
		if (FECHA_AUTORIZACIONES == '') {
			alert('La Fecha de Autorizacion esta vacia');
			$('#fecha_autorizacion').focus();
			return false;
		}
		var MEDICAMENTO = $("#MEDICAMENTO").val();
		if (MEDICAMENTO != '') {
			if (MEDICAMENTO == 'KOGENATE' || MEDICAMENTO == 'XOFIGO') {
				var DOSIS2 = $("#Dosis2").val();
				if (DOSIS2 == '') {
					alert('La dosis esta vacia 7');
					$('#Dosis2').focus();
					return false;
				}

				var DOSIS = $("#Dosis").val();
				if (DOSIS == '' || DOSIS == 'Seleccione...') {
					alert('La dosis esta vacia 8');
					$('#Dosis').focus();
					return false;
				}
			} else {
				var DOSIS = $("#Dosis").val();
				if (DOSIS == '' || DOSIS == 'Seleccione...') {
					alert('La dosis esta vacia 9');
					$('#Dosis').focus();
					return false;
				}

				var FECHA_ENTREGA = $("#fecha_entrega_1").val();
				if (FECHA_ENTREGA == '') {
					alert('La fecha de entrega esta vacia');
					$('#fecha_entrega_1').focus();
					return false;
				}

				var FECHA_VENCIMIENTO = $("#fecha_vencimiento_1").val();
				if (FECHA_VENCIMIENTO == '') {
					alert('La fecha de vencimiento esta vacia');
					$('#fecha_vencimiento_1').focus();
					return false;
				}

				var NUMERO_SN = $("#numero_sn_1").val();
				if (NUMERO_SN == '') {
					alert('El numero sn esta vacio');
					$('#numero_sn_1').focus();
					return false;
				}

				var FECHA_PRIMER_USO = $("#fecha_primer_uso_1").val();
				if (FECHA_PRIMER_USO == '') {
					alert('La fecha de primer uso esta vacia');
					$('#fecha_primer_uso_1').focus();
					return false;
				}

				var DISPOSITIVO = $("#tipo_de_dispositivo_1").val();
				if (DISPOSITIVO == '' || DISPOSITIVO == 'Seleccione...') {
					alert('El tipo de dispositivo esta vacio');
					$('#tipo_de_dispositivo_1').focus();
					return false;
				}

				var MOTIVO_CAMBIO = $("#motivo_cambio_1").val();
				if (MOTIVO_CAMBIO == '' || DISPOSITIVO == 'Seleccione...') {
					alert('El motivo del cambio esta vacio');
					$('#motivo_cambio_1').focus();
					return false;
				}
			}
			if (MEDICAMENTO == 'VENTAVIS') {
				var NEBULIZACIONES = $("#nebulizaciones").val();
				if (NEBULIZACIONES == '') {
					alert('El numero de nebulizaciones esta vacio');
					$('#nebulizaciones').focus();
					return false;
				}
			}
			if (MEDICAMENTO == 'NUBEQA') {
				var FECHA_RADICACION = $("#fecha_radicacion").val()
				if (FECHA_RADICACION == '') {
					alert("La fecha de radicacion EPS esta vacia");
					$('#fecha_radicacion').focus();
					return false;
				}

				var TRATAMIENTO_ADICIONAL = $("#tratamientos_adicionales").val()
				if (TRATAMIENTO_ADICIONAL == '' || TRATAMIENTO_ADICIONAL == 'Seleccione...') {
					alert("El tratamiento adicional esta vacio");
					$('#tratamientos_adicionales').focus();
					return false;
				}
			}
		}

		var FECHA_ENTREGA = $("#fecha_entrega_1").val();
		if (FECHA_ENTREGA == '') {
			alert('La fecha de entrega esta vacia');
			$('#fecha_entrega_1').focus();
			return false;
		}

		var FECHA_VENCIMIENTO = $("#fecha_vencimiento_1").val();
		if (FECHA_VENCIMIENTO == '') {
			alert('La fecha de vencimiento esta vacia');
			$('#fecha_vencimiento_1').focus();
			return false;
		}

		var NUMERO_SN = $("#numero_sn_1").val();
		if (NUMERO_SN == '') {
			alert('El numero sn esta vacio');
			$('#numero_sn_1').focus();
			return false;
		}

		var FECHA_PRIMER_USO = $("#fecha_primer_uso_1").val();
		if (FECHA_PRIMER_USO == '') {
			alert('La fecha de primer uso esta vacia');
			$('#fecha_primer_uso_1').focus();
			return false;
		}

		var DISPOSITIVO = $("#tipo_de_dispositivo_1").val();
		if (DISPOSITIVO == '' || DISPOSITIVO == 'Seleccione...') {
			alert('El tipo de dispositivo esta vacio');
			$('#tipo_de_dispositivo_1').focus();
			return false;
		}

		var MOTIVO_CAMBIO = $("#motivo_cambio_1").val();
		if (MOTIVO_CAMBIO == '' || DISPOSITIVO == 'Seleccione...') {
			alert('El motivo del cambio esta vacio');
			$('#motivo_cambio_1').focus();
			return false;
		}

		var DESCRIPCION_COMUNICACION = $("#descripcion_comunicacion").val();
		if (DESCRIPCION_COMUNICACION == '') {
			alert('La descripcion de comunicacion esta vacia');
			$('#descripcion_comunicacion').focus();
			return false;
		}

		var CONSENTIMIENTO_INFORMADO = $("#consentimiento_informado").val();
		if (CONSENTIMIENTO_INFORMADO == 'Seleccione...' || CONSENTIMIENTO_INFORMADO == '') {
			alert('Confirme si el paciente requiere ser re consentido');
			$('#consentimiento_informado').focus();
			return false;
		}
	} else {
		var MEDIO_CONTACTO = $("#medio_contacto").val();
		if (MEDIO_CONTACTO == '' || MEDIO_CONTACTO == 'Seleccione...') {
			alert('El medio de contacto esta vacio');
			$('#medio_contacto').focus();
			return false;
		}
		var TIPO_LLAMADA = $("#tipo_llamada").val();
		if (TIPO_LLAMADA == '' || TIPO_LLAMADA == 'Seleccione...') {
			alert('El tipo de llamada esta vacio');
			$('#tipo_llamada').focus();
			return false;
		}
		var MOTIVO_NO_COMUNICACION = $("#motivo_no_comunicacion").val();
		if (MOTIVO_NO_COMUNICACION == '' || MOTIVO_NO_COMUNICACION == 'Seleccione...') {
			alert('El motivo de no comunicacion esta vacio');
			$('#motivo_no_comunicacion').focus();
			return false;
		}
		var NUMERO_INTENTOS = $("#via_recepcion").val();
		if (NUMERO_INTENTOS == '') {
			alert('El numero de intentos esta vacio');
			$('#via_recepcion').focus();
			return false;
		}
		var FECHA_PROXIMA_LLAMADA = $("#fecha_proxima_llamada").val();
		if (FECHA_PROXIMA_LLAMADA == '') {
			alert('La fecha de proxima llamada esta vacia');
			$('#fecha_proxima_llamada').focus();
			return false;
		}
		var MOTIVO_PROXIMA_LLAMADA = $("#motivo_proxima_llamada").val();
		if (MOTIVO_PROXIMA_LLAMADA == '') {
			alert('El motivo de proxima llamada esta vacio');
			$('#motivo_proxima_llamada').focus();
			return false;
		}

		var FECHA_ENTREGA = $("#fecha_entrega_1").val();
		if (FECHA_ENTREGA == '') {
			alert('La fecha de entrega esta vacia');
			$('#fecha_entrega_1').focus();
			return false;
		}

		var FECHA_VENCIMIENTO = $("#fecha_vencimiento_1").val();
		if (FECHA_VENCIMIENTO == '') {
			alert('La fecha de vencimiento esta vacia');
			$('#fecha_vencimiento_1').focus();
			return false;
		}

		var NUMERO_SN = $("#numero_sn_1").val();
		if (NUMERO_SN == '') {
			alert('El numero sn esta vacio');
			$('#numero_sn_1').focus();
			return false;
		}

		var FECHA_PRIMER_USO = $("#fecha_primer_uso_1").val();
		if (FECHA_PRIMER_USO == '') {
			alert('La fecha de primer uso esta vacia');
			$('#fecha_primer_uso_1').focus();
			return false;
		}

		var DISPOSITIVO = $("#tipo_de_dispositivo_1").val();
		if (DISPOSITIVO == '' || DISPOSITIVO == 'Seleccione...') {
			alert('El tipo de dispositivo esta vacio');
			$('#tipo_de_dispositivo_1').focus();
			return false;
		}

		var MOTIVO_CAMBIO = $("#motivo_cambio_1").val();
		if (MOTIVO_CAMBIO == '' || DISPOSITIVO == 'Seleccione...') {
			alert('El motivo del cambio esta vacio');
			$('#motivo_cambio_1').focus();
			return false;
		}

		var DESCRIPCION_COMUNICACION = $("#descripcion_comunicacion").val();
		if (DESCRIPCION_COMUNICACION == '') {
			alert('La descripcion de comunicacion esta vacia');
			$('#descripcion_comunicacion').focus();
			return false;
		}

		var CONSENTIMIENTO_INFORMADO = $("#consentimiento_informado").val();
		if (CONSENTIMIENTO_INFORMADO == 'Seleccione...' || CONSENTIMIENTO_INFORMADO == '') {
			alert('Confirme si el paciente requiere ser re consentido');
			$('#consentimiento_informado').focus();
			return false;
		}

		var FECHA_AUTORIZACIONES = $("#fecha_autorizacion").val();
		if (FECHA_AUTORIZACIONES == '') {
			alert('La Fecha de Autorizacion esta vacia');
			$('#fecha_autorizacion').focus();
			return false;
		}
	}
}
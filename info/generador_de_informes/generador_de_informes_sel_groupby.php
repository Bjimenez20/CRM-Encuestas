<?php
   include_once('generador_de_informes_session.php');
   session_start();
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
   $Sel_Groupby = new generador_de_informes_sel_Groupby(); 
   $Sel_Groupby->Sel_Groupby_init();
   
class generador_de_informes_sel_Groupby
{
function Sel_Groupby_init()
{
   global $opc_ret, $sc_init, $path_img, $path_btn, $groupby_atual, $embbed, $tbar_pos, $_POST, $_GET;
   if (isset($_POST['script_case_init']))
   {
       $opc_ret  = $_POST['opc_ret'];
       $sc_init  = $_POST['script_case_init'];
       $path_img = $_POST['path_img'];
       $path_btn = $_POST['path_btn'];
       $embbed   = isset($_POST['embbed_groupby']) && 'Y' == $_POST['embbed_groupby'];
       $tbar_pos = isset($_POST['toolbar_pos']) ? $_POST['toolbar_pos'] : '';
   }
   elseif (isset($_GET['script_case_init']))
   {
       $opc_ret  = $_GET['opc_ret'];
       $sc_init  = $_GET['script_case_init'];
       $path_img = $_GET['path_img'];
       $path_btn = $_GET['path_btn'];
       $embbed   = isset($_GET['embbed_groupby']) && 'Y' == $_GET['embbed_groupby'];
       $tbar_pos = isset($_GET['toolbar_pos']) ? $_GET['toolbar_pos'] : '';
   }
   
   $groupby_atual = $_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Ind_Groupby'];
   if (isset($_POST['fsel_ok']) && $_POST['fsel_ok'] == "OK" && isset($_POST['sel_groupby']))
   {
       $this->campos_sel   = isset($_POST['campos_sel'])   ? $_POST['campos_sel']   : "";
       $this->xaxys_fields = isset($_POST['xaxys_fields']) ? $_POST['xaxys_fields'] : "";
       $this->summ_fields  = isset($_POST['summ_fields'])  ? $_POST['summ_fields']  : "";
       $this->Sel_processa_out($_POST['sel_groupby']);
   }
   else
   {
       if ($embbed)
       {
           ob_start();
           $this->Sel_processa_form();
           $Temp = ob_get_clean();
           echo NM_charset_to_utf8($Temp);
       }
       else
       {
           $this->Sel_processa_form();
       }
   }
   exit;
   
}
function Sel_processa_out($sel_groupby)
{
   global $sc_init, $groupby_atual, $opc_ret, $embbed;
   $Change_free_groupby = false;
   $campos_sel = explode("@?@", $this->campos_sel);
   if ($sel_groupby == "sc_free_group_by")
   {
       if (count($campos_sel) != count($_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Gb_Free_cmp']))
       {
           $Change_free_groupby = true;
       }
       else
       {
          $Arr_temp = array();
           foreach ($_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Gb_Free_cmp'] as $Cada_cmp => $Resto)
           {
               $Arr_temp[] = $Cada_cmp;
           }
           foreach ($campos_sel as $ind => $cada_cmp)
           {
               if ($Arr_temp[$ind] != $cada_cmp)
               {
                   $Change_free_groupby = true;
                   break;
               }
           }
       }
   }
   if ($sel_groupby == "sc_free_group_by" && $opc_ret == "resumo" && empty($this->campos_sel))
   { }
   elseif ($sel_groupby != $groupby_atual || $Change_free_groupby)
   {
       $_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Ind_Groupby']     = $sel_groupby;
       $_SESSION['sc_session'][$sc_init]['generador_de_informes']['contr_array_resumo'] = "NAO";
       $_SESSION['sc_session'][$sc_init]['generador_de_informes']['contr_total_geral']  = "NAO";
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['ordem_quebra']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['ordem_select']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['tot_geral']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_group_by']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_x_axys']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_y_axys']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_fill']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_order']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_order_col']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_order_level']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_order_sort']);
       unset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_tabular']);
       if ($sel_groupby == "sc_free_group_by")
       {
           $tab_arr_groubby_cmp = array();
           $tab_arr_groubby_sql = array();
           $tab_arr_groubby_cmp['pacientes_id_paciente'] = array('cmp' => "pacientes.ID_PACIENTE", 'ind' => 0);
           $tab_arr_groubby_cmp['pacientes_estado_paciente'] = array('cmp' => "pacientes.ESTADO_PACIENTE", 'ind' => 1);
           $tab_arr_groubby_cmp['pacientes_fecha_activacion_paciente'] = array('cmp' => "pacientes.FECHA_ACTIVACION_PACIENTE", 'ind' => 2);
           $tab_arr_groubby_cmp['pacientes_fecha_retiro_paciente'] = array('cmp' => "pacientes.FECHA_RETIRO_PACIENTE", 'ind' => 3);
           $tab_arr_groubby_cmp['pacientes_motivo_retiro_paciente'] = array('cmp' => "pacientes.MOTIVO_RETIRO_PACIENTE", 'ind' => 4);
           $tab_arr_groubby_cmp['pacientes_observacion_motivo_retiro_paciente'] = array('cmp' => "pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE", 'ind' => 5);
           $tab_arr_groubby_cmp['pacientes_identificacion_paciente'] = array('cmp' => "pacientes.IDENTIFICACION_PACIENTE", 'ind' => 6);
           $tab_arr_groubby_cmp['pacientes_nombre_paciente'] = array('cmp' => "pacientes.NOMBRE_PACIENTE", 'ind' => 7);
           $tab_arr_groubby_cmp['pacientes_apellido_paciente'] = array('cmp' => "pacientes.APELLIDO_PACIENTE", 'ind' => 8);
           $tab_arr_groubby_cmp['pacientes_telefono_paciente'] = array('cmp' => "pacientes.TELEFONO_PACIENTE", 'ind' => 9);
           $tab_arr_groubby_cmp['pacientes_telefono2_paciente'] = array('cmp' => "pacientes.TELEFONO2_PACIENTE", 'ind' => 10);
           $tab_arr_groubby_cmp['pacientes_telefono3_paciente'] = array('cmp' => "pacientes.TELEFONO3_PACIENTE", 'ind' => 11);
           $tab_arr_groubby_cmp['pacientes_correo_paciente'] = array('cmp' => "pacientes.CORREO_PACIENTE", 'ind' => 12);
           $tab_arr_groubby_cmp['pacientes_direccion_paciente'] = array('cmp' => "pacientes.DIRECCION_PACIENTE", 'ind' => 13);
           $tab_arr_groubby_cmp['pacientes_barrio_paciente'] = array('cmp' => "pacientes.BARRIO_PACIENTE", 'ind' => 14);
           $tab_arr_groubby_cmp['pacientes_departamento_paciente'] = array('cmp' => "pacientes.DEPARTAMENTO_PACIENTE", 'ind' => 15);
           $tab_arr_groubby_cmp['pacientes_ciudad_paciente'] = array('cmp' => "pacientes.CIUDAD_PACIENTE", 'ind' => 16);
           $tab_arr_groubby_cmp['pacientes_genero_paciente'] = array('cmp' => "pacientes.GENERO_PACIENTE", 'ind' => 17);
           $tab_arr_groubby_cmp['pacientes_fecha_nacimineto_paciente'] = array('cmp' => "pacientes.FECHA_NACIMINETO_PACIENTE", 'ind' => 18);
           $tab_arr_groubby_cmp['pacientes_edad_paciente'] = array('cmp' => "pacientes.EDAD_PACIENTE", 'ind' => 19);
           $tab_arr_groubby_cmp['pacientes_acudiente_paciente'] = array('cmp' => "pacientes.ACUDIENTE_PACIENTE", 'ind' => 20);
           $tab_arr_groubby_cmp['pacientes_telefono_acudiente_paciente'] = array('cmp' => "pacientes.TELEFONO_ACUDIENTE_PACIENTE", 'ind' => 21);
           $tab_arr_groubby_cmp['pacientes_codigo_xofigo'] = array('cmp' => "pacientes.CODIGO_XOFIGO", 'ind' => 22);
           $tab_arr_groubby_cmp['pacientes_status_paciente'] = array('cmp' => "pacientes.STATUS_PACIENTE", 'ind' => 23);
           $tab_arr_groubby_cmp['pacientes_id_ultima_gestion'] = array('cmp' => "pacientes.ID_ULTIMA_GESTION", 'ind' => 24);
           $tab_arr_groubby_cmp['pacientes_usuario_creacion'] = array('cmp' => "pacientes.USUARIO_CREACION", 'ind' => 25);
           $tab_arr_groubby_cmp['tratamiento_id_tratamiento'] = array('cmp' => "tratamiento.ID_TRATAMIENTO", 'ind' => 26);
           $tab_arr_groubby_cmp['tratamiento_producto_tratamiento'] = array('cmp' => "tratamiento.PRODUCTO_TRATAMIENTO", 'ind' => 27);
           $tab_arr_groubby_cmp['tratamiento_nombre_referencia'] = array('cmp' => "tratamiento.NOMBRE_REFERENCIA", 'ind' => 28);
           $tab_arr_groubby_cmp['tratamiento_clasificacion_patologica_tratamiento'] = array('cmp' => "tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO", 'ind' => 29);
           $tab_arr_groubby_cmp['tratamiento_tratamiento_previo'] = array('cmp' => "tratamiento.TRATAMIENTO_PREVIO", 'ind' => 30);
           $tab_arr_groubby_cmp['tratamiento_consentimiento_tratamiento'] = array('cmp' => "tratamiento.CONSENTIMIENTO_TRATAMIENTO", 'ind' => 31);
           $tab_arr_groubby_cmp['tratamiento_fecha_inicio_terapia_tratamiento'] = array('cmp' => "tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO", 'ind' => 32);
           $tab_arr_groubby_cmp['tratamiento_regimen_tratamiento'] = array('cmp' => "tratamiento.REGIMEN_TRATAMIENTO", 'ind' => 33);
           $tab_arr_groubby_cmp['tratamiento_asegurador_tratamiento'] = array('cmp' => "tratamiento.ASEGURADOR_TRATAMIENTO", 'ind' => 34);
           $tab_arr_groubby_cmp['tratamiento_operador_logistico_tratamiento'] = array('cmp' => "tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO", 'ind' => 35);
           $tab_arr_groubby_cmp['tratamiento_punto_entrega'] = array('cmp' => "tratamiento.PUNTO_ENTREGA", 'ind' => 36);
           $tab_arr_groubby_cmp['tratamiento_fecha_ultima_reclamacion_tratamiento'] = array('cmp' => "tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO", 'ind' => 37);
           $tab_arr_groubby_cmp['tratamiento_otros_operadores_tratamiento'] = array('cmp' => "tratamiento.OTROS_OPERADORES_TRATAMIENTO", 'ind' => 38);
           $tab_arr_groubby_cmp['tratamiento_medios_adquisicion_tratamiento'] = array('cmp' => "tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO", 'ind' => 39);
           $tab_arr_groubby_cmp['tratamiento_ips_atiende_tratamiento'] = array('cmp' => "tratamiento.IPS_ATIENDE_TRATAMIENTO", 'ind' => 40);
           $tab_arr_groubby_cmp['tratamiento_medico_tratamiento'] = array('cmp' => "tratamiento.MEDICO_TRATAMIENTO", 'ind' => 41);
           $tab_arr_groubby_cmp['tratamiento_especialidad_tratamiento'] = array('cmp' => "tratamiento.ESPECIALIDAD_TRATAMIENTO", 'ind' => 42);
           $tab_arr_groubby_cmp['tratamiento_paramedico_tratamiento'] = array('cmp' => "tratamiento.PARAMEDICO_TRATAMIENTO", 'ind' => 43);
           $tab_arr_groubby_cmp['tratamiento_zona_atencion_paramedico_tratamiento'] = array('cmp' => "tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO", 'ind' => 44);
           $tab_arr_groubby_cmp['tratamiento_ciudad_base_paramedico_tratamiento'] = array('cmp' => "tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO", 'ind' => 45);
           $tab_arr_groubby_cmp['tratamiento_notas_adjuntos_tratamiento'] = array('cmp' => "tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO", 'ind' => 46);
           $tab_arr_groubby_cmp['tratamiento_id_paciente_fk'] = array('cmp' => "tratamiento.ID_PACIENTE_FK", 'ind' => 47);
           $tab_arr_groubby_cmp['gestiones_id_gestion'] = array('cmp' => "gestiones.ID_GESTION", 'ind' => 48);
           $tab_arr_groubby_cmp['gestiones_motivo_comunicacion_gestion'] = array('cmp' => "gestiones.MOTIVO_COMUNICACION_GESTION", 'ind' => 49);
           $tab_arr_groubby_cmp['gestiones_medio_contacto_gestion'] = array('cmp' => "gestiones.MEDIO_CONTACTO_GESTION", 'ind' => 50);
           $tab_arr_groubby_cmp['gestiones_tipo_llamada_gestion'] = array('cmp' => "gestiones.TIPO_LLAMADA_GESTION", 'ind' => 51);
           $tab_arr_groubby_cmp['gestiones_logro_comunicacion_gestion'] = array('cmp' => "gestiones.LOGRO_COMUNICACION_GESTION", 'ind' => 52);
           $tab_arr_groubby_cmp['gestiones_motivo_no_comunicacion_gestion'] = array('cmp' => "gestiones.MOTIVO_NO_COMUNICACION_GESTION", 'ind' => 53);
           $tab_arr_groubby_cmp['gestiones_numero_intentos_gestion'] = array('cmp' => "gestiones.NUMERO_INTENTOS_GESTION", 'ind' => 54);
           $tab_arr_groubby_cmp['gestiones_esperado_gestion'] = array('cmp' => "gestiones.ESPERADO_GESTION", 'ind' => 55);
           $tab_arr_groubby_cmp['gestiones_estado_ctc_gestion'] = array('cmp' => "gestiones.ESTADO_CTC_GESTION", 'ind' => 56);
           $tab_arr_groubby_cmp['gestiones_estado_farmacia_gestion'] = array('cmp' => "gestiones.ESTADO_FARMACIA_GESTION", 'ind' => 57);
           $tab_arr_groubby_cmp['gestiones_reclamo_gestion'] = array('cmp' => "gestiones.RECLAMO_GESTION", 'ind' => 58);
           $tab_arr_groubby_cmp['gestiones_causa_no_reclamacion_gestion'] = array('cmp' => "gestiones.CAUSA_NO_RECLAMACION_GESTION", 'ind' => 59);
           $tab_arr_groubby_cmp['gestiones_dificultad_acceso_gestion'] = array('cmp' => "gestiones.DIFICULTAD_ACCESO_GESTION", 'ind' => 60);
           $tab_arr_groubby_cmp['gestiones_tipo_dificultad_gestion'] = array('cmp' => "gestiones.TIPO_DIFICULTAD_GESTION", 'ind' => 61);
           $tab_arr_groubby_cmp['gestiones_envios_gestion'] = array('cmp' => "gestiones.ENVIOS_GESTION", 'ind' => 62);
           $tab_arr_groubby_cmp['gestiones_medicamentos_gestion'] = array('cmp' => "gestiones.MEDICAMENTOS_GESTION", 'ind' => 63);
           $tab_arr_groubby_cmp['gestiones_tipo_envio_gestion'] = array('cmp' => "gestiones.TIPO_ENVIO_GESTION", 'ind' => 64);
           $tab_arr_groubby_cmp['gestiones_evento_adverso_gestion'] = array('cmp' => "gestiones.EVENTO_ADVERSO_GESTION", 'ind' => 65);
           $tab_arr_groubby_cmp['gestiones_tipo_evento_adverso'] = array('cmp' => "gestiones.TIPO_EVENTO_ADVERSO", 'ind' => 66);
           $tab_arr_groubby_cmp['gestiones_genera_solicitud_gestion'] = array('cmp' => "gestiones.GENERA_SOLICITUD_GESTION", 'ind' => 67);
           $tab_arr_groubby_cmp['gestiones_fecha_proxima_llamada'] = array('cmp' => "gestiones.FECHA_PROXIMA_LLAMADA", 'ind' => 68);
           $tab_arr_groubby_cmp['gestiones_motivo_proxima_llamada'] = array('cmp' => "gestiones.MOTIVO_PROXIMA_LLAMADA", 'ind' => 69);
           $tab_arr_groubby_cmp['gestiones_observacion_proxima_llamada'] = array('cmp' => "gestiones.OBSERVACION_PROXIMA_LLAMADA", 'ind' => 70);
           $tab_arr_groubby_cmp['gestiones_fecha_reclamacion_gestion'] = array('cmp' => "gestiones.FECHA_RECLAMACION_GESTION", 'ind' => 71);
           $tab_arr_groubby_cmp['gestiones_consecutivo_gestion'] = array('cmp' => "gestiones.CONSECUTIVO_GESTION", 'ind' => 72);
           $tab_arr_groubby_cmp['gestiones_autor_gestion'] = array('cmp' => "gestiones.AUTOR_GESTION", 'ind' => 73);
           $tab_arr_groubby_cmp['gestiones_nota'] = array('cmp' => "gestiones.NOTA", 'ind' => 74);
           $tab_arr_groubby_cmp['gestiones_fecha_programada_gestion'] = array('cmp' => "gestiones.FECHA_PROGRAMADA_GESTION", 'ind' => 75);
           $tab_arr_groubby_cmp['gestiones_usuario_asigando'] = array('cmp' => "gestiones.USUARIO_ASIGANDO", 'ind' => 76);
           $tab_arr_groubby_cmp['gestiones_id_paciente_fk2'] = array('cmp' => "gestiones.ID_PACIENTE_FK2", 'ind' => 77);
           $tab_arr_groubby_cmp['gestiones_fecha_comunicacion'] = array('cmp' => "gestiones.FECHA_COMUNICACION", 'ind' => 78);
           $tab_arr_groubby_cmp['gestiones_estado_gestion'] = array('cmp' => "gestiones.ESTADO_GESTION", 'ind' => 79);
           $tab_arr_groubby_cmp['gestiones_codigo_argus'] = array('cmp' => "gestiones.CODIGO_ARGUS", 'ind' => 80);
           $tab_arr_groubby_cmp['gestiones_numero_cajas'] = array('cmp' => "gestiones.NUMERO_CAJAS", 'ind' => 81);
           $tab_arr_groubby_sql[0] = array('cmp' => "pacientes.ID_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[1] = array('cmp' => "pacientes.ESTADO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[2] = array('cmp' => "pacientes.FECHA_ACTIVACION_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[3] = array('cmp' => "pacientes.FECHA_RETIRO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[4] = array('cmp' => "pacientes.MOTIVO_RETIRO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[5] = array('cmp' => "pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[6] = array('cmp' => "pacientes.IDENTIFICACION_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[7] = array('cmp' => "pacientes.NOMBRE_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[8] = array('cmp' => "pacientes.APELLIDO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[9] = array('cmp' => "pacientes.TELEFONO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[10] = array('cmp' => "pacientes.TELEFONO2_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[11] = array('cmp' => "pacientes.TELEFONO3_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[12] = array('cmp' => "pacientes.CORREO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[13] = array('cmp' => "pacientes.DIRECCION_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[14] = array('cmp' => "pacientes.BARRIO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[15] = array('cmp' => "pacientes.DEPARTAMENTO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[16] = array('cmp' => "pacientes.CIUDAD_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[17] = array('cmp' => "pacientes.GENERO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[18] = array('cmp' => "pacientes.FECHA_NACIMINETO_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[19] = array('cmp' => "pacientes.EDAD_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[20] = array('cmp' => "pacientes.ACUDIENTE_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[21] = array('cmp' => "pacientes.TELEFONO_ACUDIENTE_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[22] = array('cmp' => "pacientes.CODIGO_XOFIGO", 'ord' => 'asc');
           $tab_arr_groubby_sql[23] = array('cmp' => "pacientes.STATUS_PACIENTE", 'ord' => 'asc');
           $tab_arr_groubby_sql[24] = array('cmp' => "pacientes.ID_ULTIMA_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[25] = array('cmp' => "pacientes.USUARIO_CREACION", 'ord' => 'asc');
           $tab_arr_groubby_sql[26] = array('cmp' => "tratamiento.ID_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[27] = array('cmp' => "tratamiento.PRODUCTO_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[28] = array('cmp' => "tratamiento.NOMBRE_REFERENCIA", 'ord' => 'asc');
           $tab_arr_groubby_sql[29] = array('cmp' => "tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[30] = array('cmp' => "tratamiento.TRATAMIENTO_PREVIO", 'ord' => 'asc');
           $tab_arr_groubby_sql[31] = array('cmp' => "tratamiento.CONSENTIMIENTO_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[32] = array('cmp' => "tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[33] = array('cmp' => "tratamiento.REGIMEN_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[34] = array('cmp' => "tratamiento.ASEGURADOR_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[35] = array('cmp' => "tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[36] = array('cmp' => "tratamiento.PUNTO_ENTREGA", 'ord' => 'asc');
           $tab_arr_groubby_sql[37] = array('cmp' => "tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[38] = array('cmp' => "tratamiento.OTROS_OPERADORES_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[39] = array('cmp' => "tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[40] = array('cmp' => "tratamiento.IPS_ATIENDE_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[41] = array('cmp' => "tratamiento.MEDICO_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[42] = array('cmp' => "tratamiento.ESPECIALIDAD_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[43] = array('cmp' => "tratamiento.PARAMEDICO_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[44] = array('cmp' => "tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[45] = array('cmp' => "tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[46] = array('cmp' => "tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO", 'ord' => 'asc');
           $tab_arr_groubby_sql[47] = array('cmp' => "tratamiento.ID_PACIENTE_FK", 'ord' => 'asc');
           $tab_arr_groubby_sql[48] = array('cmp' => "gestiones.ID_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[49] = array('cmp' => "gestiones.MOTIVO_COMUNICACION_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[50] = array('cmp' => "gestiones.MEDIO_CONTACTO_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[51] = array('cmp' => "gestiones.TIPO_LLAMADA_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[52] = array('cmp' => "gestiones.LOGRO_COMUNICACION_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[53] = array('cmp' => "gestiones.MOTIVO_NO_COMUNICACION_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[54] = array('cmp' => "gestiones.NUMERO_INTENTOS_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[55] = array('cmp' => "gestiones.ESPERADO_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[56] = array('cmp' => "gestiones.ESTADO_CTC_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[57] = array('cmp' => "gestiones.ESTADO_FARMACIA_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[58] = array('cmp' => "gestiones.RECLAMO_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[59] = array('cmp' => "gestiones.CAUSA_NO_RECLAMACION_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[60] = array('cmp' => "gestiones.DIFICULTAD_ACCESO_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[61] = array('cmp' => "gestiones.TIPO_DIFICULTAD_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[62] = array('cmp' => "gestiones.ENVIOS_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[63] = array('cmp' => "gestiones.MEDICAMENTOS_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[64] = array('cmp' => "gestiones.TIPO_ENVIO_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[65] = array('cmp' => "gestiones.EVENTO_ADVERSO_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[66] = array('cmp' => "gestiones.TIPO_EVENTO_ADVERSO", 'ord' => 'asc');
           $tab_arr_groubby_sql[67] = array('cmp' => "gestiones.GENERA_SOLICITUD_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[68] = array('cmp' => "gestiones.FECHA_PROXIMA_LLAMADA", 'ord' => 'asc');
           $tab_arr_groubby_sql[69] = array('cmp' => "gestiones.MOTIVO_PROXIMA_LLAMADA", 'ord' => 'asc');
           $tab_arr_groubby_sql[70] = array('cmp' => "gestiones.OBSERVACION_PROXIMA_LLAMADA", 'ord' => 'asc');
           $tab_arr_groubby_sql[71] = array('cmp' => "gestiones.FECHA_RECLAMACION_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[72] = array('cmp' => "gestiones.CONSECUTIVO_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[73] = array('cmp' => "gestiones.AUTOR_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[74] = array('cmp' => "gestiones.NOTA", 'ord' => 'asc');
           $tab_arr_groubby_sql[75] = array('cmp' => "gestiones.FECHA_PROGRAMADA_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[76] = array('cmp' => "gestiones.USUARIO_ASIGANDO", 'ord' => 'asc');
           $tab_arr_groubby_sql[77] = array('cmp' => "gestiones.ID_PACIENTE_FK2", 'ord' => 'asc');
           $tab_arr_groubby_sql[78] = array('cmp' => "gestiones.FECHA_COMUNICACION", 'ord' => 'asc');
           $tab_arr_groubby_sql[79] = array('cmp' => "gestiones.ESTADO_GESTION", 'ord' => 'asc');
           $tab_arr_groubby_sql[80] = array('cmp' => "gestiones.CODIGO_ARGUS", 'ord' => 'asc');
           $tab_arr_groubby_sql[81] = array('cmp' => "gestiones.NUMERO_CAJAS", 'ord' => 'asc');
           $_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Gb_Free_cmp'] = array();
           $_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Gb_Free_sql'] = array();
           foreach ($campos_sel as $cada_cmp)
           {
               if (!empty($cada_cmp))
               {
                   $ind = $tab_arr_groubby_cmp[$cada_cmp]['ind'];
                   $_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Gb_Free_cmp'][$cada_cmp] = $tab_arr_groubby_cmp[$cada_cmp]['cmp'];
                   $_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Gb_Free_sql'][$tab_arr_groubby_sql[$ind]['cmp']] = $tab_arr_groubby_sql[$ind]['ord'];
               }
           }
       }
   }
   if ($sel_groupby == "sc_free_group_by")
   {
       $groupby_this  = 0;
       $groupby_count = sizeof($campos_sel);
       $xaxys_count   = '' == $this->xaxys_fields ? 0 : sizeof(explode("@?@", $this->xaxys_fields));
       $xaxys_list    = array();
       $yaxys_list    = array();
       for ($i = 0; $i < $groupby_count; $i++)
       {
           if (0 == $xaxys_count)
           {
               $yaxys_list[$groupby_this] = $groupby_this;
           }
           else
           {
               $xaxys_list[$groupby_this] = $groupby_this;
               $xaxys_count--;
           }
           $groupby_this++;
       }
       $_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_x_axys'] = $xaxys_list;
       $_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_y_axys'] = $yaxys_list;
   }
   if ($opc_ret == "resumo")
   {
       $summ_fields = explode("@?@", $this->summ_fields);
       foreach ($_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_display'] as $i_sum => $d_sum)
       {
           $_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_display'][$i_sum]['display'] = in_array($i_sum, $summ_fields);
       }
       $_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_order'] = $summ_fields;
   }
?>
    <script language="javascript"> 
<?php
   if (!$embbed)
   {
?>
      self.parent.tb_remove(); 
<?php
   }
?>
<?php
   $sParent = $embbed ? '' : 'parent.';
   if ($opc_ret != "resumo")
   {
      echo $sParent . "nm_gp_submit_ajax('" . $opc_ret . "', '')"; 
   }
   else
   {
      echo $sParent . "nm_gp_move('" . $opc_ret . "', '0')"; 
   }
?>
   </script>
<?php
}
   
function Sel_processa_form()
{
   global $sc_init, $path_img, $path_btn, $groupby_atual, $opc_ret, $embbed, $tbar_pos;
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "es";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $this->Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       include_once($NM_arq_lang);
   }
   $_SESSION['scriptcase']['charset']  = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "ISO-8859-1";
   foreach ($this->Nm_lang as $ind => $dados)
   {
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
      {
          $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
          $this->Nm_lang[$ind] = $dados;
      }
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
      {
          $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
   }
   $display_free_gb  = false;
   $arr_campos_free  = array();
   $arr_campos_free['pacientes_id_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_id_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_id_paciente'] : "PAP";
   $arr_campos_free['pacientes_estado_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_estado_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_estado_paciente'] : "ESTADO PACIENTE";
   $arr_campos_free['pacientes_fecha_activacion_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_fecha_activacion_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_fecha_activacion_paciente'] : "FECHA ACTIVACION PACIENTE";
   $arr_campos_free['pacientes_fecha_retiro_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_fecha_retiro_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_fecha_retiro_paciente'] : "FECHA RETIRO PACIENTE";
   $arr_campos_free['pacientes_motivo_retiro_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_motivo_retiro_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_motivo_retiro_paciente'] : "MOTIVO RETIRO PACIENTE";
   $arr_campos_free['pacientes_observacion_motivo_retiro_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_observacion_motivo_retiro_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_observacion_motivo_retiro_paciente'] : "OBSERVACION MOTIVO RETIRO PACIENTE";
   $arr_campos_free['pacientes_identificacion_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_identificacion_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_identificacion_paciente'] : "IDENTIFICACION PACIENTE";
   $arr_campos_free['pacientes_nombre_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_nombre_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_nombre_paciente'] : "NOMBRE PACIENTE";
   $arr_campos_free['pacientes_apellido_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_apellido_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_apellido_paciente'] : "APELLIDO PACIENTE";
   $arr_campos_free['pacientes_telefono_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_telefono_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_telefono_paciente'] : "TELEFONO PACIENTE";
   $arr_campos_free['pacientes_telefono2_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_telefono2_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_telefono2_paciente'] : "TELEFONO2 PACIENTE";
   $arr_campos_free['pacientes_telefono3_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_telefono3_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_telefono3_paciente'] : "TELEFONO3 PACIENTE";
   $arr_campos_free['pacientes_correo_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_correo_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_correo_paciente'] : "CORREO PACIENTE";
   $arr_campos_free['pacientes_direccion_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_direccion_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_direccion_paciente'] : "DIRECCION PACIENTE";
   $arr_campos_free['pacientes_barrio_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_barrio_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_barrio_paciente'] : "BARRIO PACIENTE";
   $arr_campos_free['pacientes_departamento_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_departamento_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_departamento_paciente'] : "DEPARTAMENTO PACIENTE";
   $arr_campos_free['pacientes_ciudad_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_ciudad_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_ciudad_paciente'] : "CIUDAD PACIENTE";
   $arr_campos_free['pacientes_genero_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_genero_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_genero_paciente'] : "GENERO PACIENTE";
   $arr_campos_free['pacientes_fecha_nacimineto_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_fecha_nacimineto_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_fecha_nacimineto_paciente'] : "FECHA NACIMINETO PACIENTE";
   $arr_campos_free['pacientes_edad_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_edad_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_edad_paciente'] : "EDAD PACIENTE";
   $arr_campos_free['pacientes_acudiente_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_acudiente_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_acudiente_paciente'] : "ACUDIENTE PACIENTE";
   $arr_campos_free['pacientes_telefono_acudiente_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_telefono_acudiente_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_telefono_acudiente_paciente'] : "TELEFONO ACUDIENTE PACIENTE";
   $arr_campos_free['pacientes_codigo_xofigo']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_codigo_xofigo'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_codigo_xofigo'] : "CODIGO XOFIGO";
   $arr_campos_free['pacientes_status_paciente']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_status_paciente'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_status_paciente'] : "STATUS PACIENTE";
   $arr_campos_free['pacientes_id_ultima_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_id_ultima_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_id_ultima_gestion'] : "ID ULTIMA GESTION";
   $arr_campos_free['pacientes_usuario_creacion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_usuario_creacion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['pacientes_usuario_creacion'] : "USUARIO CREACION";
   $arr_campos_free['tratamiento_id_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_id_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_id_tratamiento'] : "ID TRATAMIENTO";
   $arr_campos_free['tratamiento_producto_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_producto_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_producto_tratamiento'] : "PRODUCTO TRATAMIENTO";
   $arr_campos_free['tratamiento_nombre_referencia']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_nombre_referencia'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_nombre_referencia'] : "NOMBRE REFERENCIA";
   $arr_campos_free['tratamiento_clasificacion_patologica_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_clasificacion_patologica_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_clasificacion_patologica_tratamiento'] : "CLASIFICACION PATOLOGICA TRATAMIENTO";
   $arr_campos_free['tratamiento_tratamiento_previo']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_tratamiento_previo'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_tratamiento_previo'] : "TRATAMIENTO PREVIO";
   $arr_campos_free['tratamiento_consentimiento_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_consentimiento_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_consentimiento_tratamiento'] : "CONSENTIMIENTO TRATAMIENTO";
   $arr_campos_free['tratamiento_fecha_inicio_terapia_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_fecha_inicio_terapia_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_fecha_inicio_terapia_tratamiento'] : "FECHA INICIO TERAPIA TRATAMIENTO";
   $arr_campos_free['tratamiento_regimen_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_regimen_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_regimen_tratamiento'] : "REGIMEN TRATAMIENTO";
   $arr_campos_free['tratamiento_asegurador_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_asegurador_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_asegurador_tratamiento'] : "ASEGURADOR TRATAMIENTO";
   $arr_campos_free['tratamiento_operador_logistico_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_operador_logistico_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_operador_logistico_tratamiento'] : "OPERADOR LOGISTICO TRATAMIENTO";
   $arr_campos_free['tratamiento_punto_entrega']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_punto_entrega'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_punto_entrega'] : "PUNTO ENTREGA";
   $arr_campos_free['tratamiento_fecha_ultima_reclamacion_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_fecha_ultima_reclamacion_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_fecha_ultima_reclamacion_tratamiento'] : "FECHA ULTIMA RECLAMACION TRATAMIENTO";
   $arr_campos_free['tratamiento_otros_operadores_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_otros_operadores_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_otros_operadores_tratamiento'] : "OTROS OPERADORES TRATAMIENTO";
   $arr_campos_free['tratamiento_medios_adquisicion_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_medios_adquisicion_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_medios_adquisicion_tratamiento'] : "MEDIOS ADQUISICION TRATAMIENTO";
   $arr_campos_free['tratamiento_ips_atiende_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_ips_atiende_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_ips_atiende_tratamiento'] : "IPS ATIENDE TRATAMIENTO";
   $arr_campos_free['tratamiento_medico_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_medico_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_medico_tratamiento'] : "MEDICO TRATAMIENTO";
   $arr_campos_free['tratamiento_especialidad_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_especialidad_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_especialidad_tratamiento'] : "ESPECIALIDAD TRATAMIENTO";
   $arr_campos_free['tratamiento_paramedico_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_paramedico_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_paramedico_tratamiento'] : "PARAMEDICO TRATAMIENTO";
   $arr_campos_free['tratamiento_zona_atencion_paramedico_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_zona_atencion_paramedico_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_zona_atencion_paramedico_tratamiento'] : "ZONA ATENCION PARAMEDICO TRATAMIENTO";
   $arr_campos_free['tratamiento_ciudad_base_paramedico_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_ciudad_base_paramedico_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_ciudad_base_paramedico_tratamiento'] : "CIUDAD BASE PARAMEDICO TRATAMIENTO";
   $arr_campos_free['tratamiento_notas_adjuntos_tratamiento']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_notas_adjuntos_tratamiento'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_notas_adjuntos_tratamiento'] : "NOTAS ADJUNTOS TRATAMIENTO";
   $arr_campos_free['tratamiento_id_paciente_fk']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_id_paciente_fk'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['tratamiento_id_paciente_fk'] : "ID PACIENTE FK";
   $arr_campos_free['gestiones_id_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_id_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_id_gestion'] : "ID GESTION";
   $arr_campos_free['gestiones_motivo_comunicacion_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_motivo_comunicacion_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_motivo_comunicacion_gestion'] : "MOTIVO COMUNICACION GESTION";
   $arr_campos_free['gestiones_medio_contacto_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_medio_contacto_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_medio_contacto_gestion'] : "MEDIO CONTACTO GESTION";
   $arr_campos_free['gestiones_tipo_llamada_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_tipo_llamada_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_tipo_llamada_gestion'] : "TIPO LLAMADA GESTION";
   $arr_campos_free['gestiones_logro_comunicacion_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_logro_comunicacion_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_logro_comunicacion_gestion'] : "LOGRO COMUNICACION GESTION";
   $arr_campos_free['gestiones_motivo_no_comunicacion_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_motivo_no_comunicacion_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_motivo_no_comunicacion_gestion'] : "MOTIVO NO COMUNICACION GESTION";
   $arr_campos_free['gestiones_numero_intentos_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_numero_intentos_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_numero_intentos_gestion'] : "NUMERO INTENTOS GESTION";
   $arr_campos_free['gestiones_esperado_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_esperado_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_esperado_gestion'] : "ESPERADO GESTION";
   $arr_campos_free['gestiones_estado_ctc_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_estado_ctc_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_estado_ctc_gestion'] : "ESTADO CTC GESTION";
   $arr_campos_free['gestiones_estado_farmacia_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_estado_farmacia_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_estado_farmacia_gestion'] : "ESTADO FARMACIA GESTION";
   $arr_campos_free['gestiones_reclamo_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_reclamo_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_reclamo_gestion'] : "RECLAMO GESTION";
   $arr_campos_free['gestiones_causa_no_reclamacion_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_causa_no_reclamacion_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_causa_no_reclamacion_gestion'] : "CAUSA NO RECLAMACION GESTION";
   $arr_campos_free['gestiones_dificultad_acceso_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_dificultad_acceso_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_dificultad_acceso_gestion'] : "DIFICULTAD ACCESO GESTION";
   $arr_campos_free['gestiones_tipo_dificultad_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_tipo_dificultad_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_tipo_dificultad_gestion'] : "TIPO DIFICULTAD GESTION";
   $arr_campos_free['gestiones_envios_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_envios_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_envios_gestion'] : "ENVIOS GESTION";
   $arr_campos_free['gestiones_medicamentos_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_medicamentos_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_medicamentos_gestion'] : "MEDICAMENTOS GESTION";
   $arr_campos_free['gestiones_tipo_envio_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_tipo_envio_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_tipo_envio_gestion'] : "TIPO ENVIO GESTION";
   $arr_campos_free['gestiones_evento_adverso_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_evento_adverso_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_evento_adverso_gestion'] : "EVENTO ADVERSO GESTION";
   $arr_campos_free['gestiones_tipo_evento_adverso']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_tipo_evento_adverso'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_tipo_evento_adverso'] : "TIPO EVENTO ADVERSO";
   $arr_campos_free['gestiones_genera_solicitud_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_genera_solicitud_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_genera_solicitud_gestion'] : "GENERA SOLICITUD GESTION";
   $arr_campos_free['gestiones_fecha_proxima_llamada']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_fecha_proxima_llamada'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_fecha_proxima_llamada'] : "FECHA PROXIMA LLAMADA";
   $arr_campos_free['gestiones_motivo_proxima_llamada']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_motivo_proxima_llamada'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_motivo_proxima_llamada'] : "MOTIVO PROXIMA LLAMADA";
   $arr_campos_free['gestiones_observacion_proxima_llamada']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_observacion_proxima_llamada'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_observacion_proxima_llamada'] : "OBSERVACION PROXIMA LLAMADA";
   $arr_campos_free['gestiones_fecha_reclamacion_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_fecha_reclamacion_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_fecha_reclamacion_gestion'] : "FECHA RECLAMACION GESTION";
   $arr_campos_free['gestiones_consecutivo_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_consecutivo_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_consecutivo_gestion'] : "CONSECUTIVO GESTION";
   $arr_campos_free['gestiones_autor_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_autor_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_autor_gestion'] : "AUTOR GESTION";
   $arr_campos_free['gestiones_nota']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_nota'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_nota'] : "NOTA";
   $arr_campos_free['gestiones_fecha_programada_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_fecha_programada_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_fecha_programada_gestion'] : "FECHA PROGRAMADA GESTION";
   $arr_campos_free['gestiones_usuario_asigando']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_usuario_asigando'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_usuario_asigando'] : "USUARIO ASIGANDO";
   $arr_campos_free['gestiones_id_paciente_fk2']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_id_paciente_fk2'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_id_paciente_fk2'] : "ID PACIENTE FK2";
   $arr_campos_free['gestiones_fecha_comunicacion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_fecha_comunicacion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_fecha_comunicacion'] : "FECHA COMUNICACION";
   $arr_campos_free['gestiones_estado_gestion']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_estado_gestion'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_estado_gestion'] : "ESTADO GESTION";
   $arr_campos_free['gestiones_codigo_argus']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_codigo_argus'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_codigo_argus'] : "CODIGO ARGUS";
   $arr_campos_free['gestiones_numero_cajas']  = (isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_numero_cajas'])) ? $_SESSION['sc_session'][$sc_init]['generador_de_informes']['labels']['gestiones_numero_cajas'] : "NUMERO CAJAS";
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc8_Turquoise/Sc8_Turquoise";
   include("../_lib/css/" . $str_schema_all . "_grid.php");
   $Str_btn_grid = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
   include("../_lib/buttons/" . $Str_btn_grid);
   if (!function_exists("nmButtonOutput"))
   {
       include_once("../_lib/lib/php/nm_gp_config_btn.php");
   }
   $bStartFree   = true;
   $bSummaryPage = isset($_GET['opc_ret']) && 'resumo' == $_GET['opc_ret'];
   if (!$embbed)
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Generador de Informes</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_tab'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_tab_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" /> 
 <script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
 <script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js"></script>
 <script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js"></script>
 <script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>
<?php
   }
?>
<?php
if ($embbed)
{
?>
 <script language="javascript" type="text/javascript">
  function scSubmitGroupBy(sPos) {
   $.ajax({
    type: "POST",
    url: "generador_de_informes_sel_groupby.php",
    data: {
     script_case_init: $("#sc_id_gby_script_case_init").val(),
     script_case_session: $("#sc_id_gby_script_case_session").val(),
     path_img: $("#sc_id_gby_path_img").val(),
     path_btn: $("#sc_id_gby_path_btn").val(),
     opc_ret: $("#sc_id_gby_opc_ret").val(),
     campos_sel: $("#sc_id_gby_campos_sel").val(),
     xaxys_fields: $("#sc_id_gby_xaxys_fields").val(),
     summ_fields: $("#sc_id_gby_summ_fields").val(),
     fsel_ok: $("#sc_id_gby_fsel_ok").val(),
     sel_groupby: $(".sc_ui_gby_selected:checked").val(),
     embbed_groupby: 'Y'
    }
   }).success(function(data) {
    $("#sc_id_groupby_placeholder_" + sPos).find("td").html(data);
    scBtnGroupByHide(sPos);
   });
  }
  </script>
<?php
}
?>
 <script language="javascript" type="text/javascript">
<?php
if ($bSummaryPage)
{
    $aOptions = array();
    foreach ($_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_control'] as $l_field => $d_field)
    {
        $aOptions[] = "sc_id_item_summ_" . $l_field . ": \"" . str_replace('"', '\"', $d_field['select']) . "\"";
    }
?>
  var scTotalOptions = {<?php echo implode(', ', $aOptions); ?>};
<?php
}
?>
  $(function() {
   $(".scAppDivTabLine").find("li").mouseover(function() {
    $(this).css("cursor", "pointer");
   });
   $(".sc_ui_litem").mouseover(function() {
    $(this).css("cursor", "all-scroll");
   });
   $("#sc_id_available").sortable({
    connectWith: ".sc_ui_sort_groupby",
    placeholder: "scAppDivSelectFieldsPlaceholder"
   }).disableSelection();
   $("#sc_id_yaxys").sortable({
    connectWith: ".sc_ui_sort_groupby",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    update: function(event, ui) {
     $("#sc_id_sel_groupby_sc_free_group_by").prop("checked", true);
    }
   }).disableSelection();
<?php
if ($bSummaryPage)
{
?>
   $("#sc_id_xaxys").sortable({
    connectWith: ".sc_ui_sort_groupby",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    update: function(event, ui) {
     $("#sc_id_sel_groupby_sc_free_group_by").prop("checked", true);
    }
   }).disableSelection();
   $("#sc_id_summ_available").sortable({
    helper: "clone",
    connectWith: ".sc_ui_sort_summ",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var idx, elm, eid, nid, fieldName, opName;
     fieldName = $(ui.item[0]).attr("id").substr(16);
     opName = scSummFirstAvailable(fieldName);
     if (false == opName) {
      $(this).sortable("cancel");
      return;
     }
     idx = $("#sc_id_summ_selected").children().index($(ui.item[0]));
     if (idx == -1) return;
     elm = $(ui.item[0]).clone(true).removeClass("box ui-draggable ui-draggable-dragging").addClass("box-clone");
     eid = elm.attr("id");
     nid = eid.substr(0, 16) + scSummItemCount.toString();
     scSummItemCount++;
     elm.attr("id", nid).find(".sc-ui-total-options").html(scTotalOptions[eid]);
     $("#sc_id_summ_selected").children(":eq(" + idx + ")").after(elm);
     $(this).sortable("cancel");
     scSummOptionsSetNew($("#sc_id_summ_selected").children(":eq(" + idx + ")").find("select"), fieldName, opName);
     scSummOptionsSet(fieldName, opName, false);
     ajusta_window();
    }
   }).disableSelection();
   $("#sc_id_summ_selected").sortable({
    connectWith: ".sc_ui_sort_summ",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var fieldName, opName;
     fieldName = $(ui.item[0]).find("select").attr("class").substr(13);
     opName = $(ui.item[0]).find("select").find(":selected").attr("class").substr(20);
     $(this).sortable("cancel");
     $(ui.item[0]).remove();
     scSummOptionsSet(fieldName, opName, true);
     ajusta_window();
    }
   });
<?php
}
?>
   $("#sc_id_show_static").click(function() {
    scShowStatic();
   });
   $("#sc_id_show_free").click(function() {
    scShowFree();
   });
   $("#sc_id_show_total").click(function() {
    scShowTotal();
   });
   scUpdateListHeight();
  });
  function scUpdateListHeight() {
   $("#sc_id_available").css("min-height", "<?php echo sizeof($arr_campos_free) * 29 ?>px");
   $("#sc_id_yaxys").css("min-height", "<?php echo sizeof($arr_campos_free) * 29 ?>px");
   $("#sc_id_xaxys").css("min-height", "29px");
<?php
if ($bSummaryPage)
{
?>
   $("#sc_id_summ_available").css("min-height", "<?php echo sizeof($_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_display']) * 29 ?>px");
   $("#sc_id_summ_selected").css("min-height", "<?php echo sizeof($_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_display']) * 29 ?>px");
<?php
}
?>
  }
  function scPackGroupBy() {
   var fieldList, i, fieldName, selectedFields = new Array, xaxysFields = new Array, summFields = new Array;
<?php
if ($bSummaryPage)
{
?>
   fieldList = $("#sc_id_xaxys").sortable("toArray");
   for (i = 0; i < fieldList.length; i++) {
    fieldName = fieldList[i].substr(11);
    selectedFields.push(fieldName);
    xaxysFields.push(fieldName);
   }
   $("#sc_id_gby_xaxys_fields").val(xaxysFields.join("@?@"));
   fieldList = $("#sc_id_summ_selected").sortable("toArray");
   for (i = 0; i < fieldList.length; i++) {
    fieldName = $("#" + fieldList[i]).find("select").val();
    summFields.push(fieldName);
   }
   $("#sc_id_gby_summ_fields").val(summFields.join("@?@"));
<?php
}
?>
   fieldList = $("#sc_id_yaxys").sortable("toArray");
   for (i = 0; i < fieldList.length; i++) {
    fieldName = fieldList[i].substr(11);
    selectedFields.push(fieldName);
   }
   $("#sc_id_gby_campos_sel").val(selectedFields.join("@?@"));
  }
  function scShowStatic() {
    $("#sc_id_static_groupby").show();
    $("#sc_id_free_groupby").hide();
    $("#sc_id_summary").hide();
    $("#sc_id_show_static").addClass("scTabActive").removeClass("scTabInactive");
    $("#sc_id_show_free").addClass("scTabInactive").removeClass("scTabActive");
    $("#sc_id_show_total").addClass("scTabInactive").removeClass("scTabActive");
<?php
   if (!$embbed)
   {
?>
   ajusta_window();
<?php
   }
?>
  }
  function scShowFree() {
    $("#sc_id_static_groupby").hide();
    $("#sc_id_free_groupby").show();
    $("#sc_id_summary").hide();
    $("#sc_id_show_static").addClass("scTabInactive").removeClass("scTabActive");
    $("#sc_id_show_free").addClass("scTabActive").removeClass("scTabInactive");
    $("#sc_id_show_total").addClass("scTabInactive").removeClass("scTabActive");
<?php
   if (!$embbed)
   {
?>
   ajusta_window();
<?php
   }
?>
  }
  function scShowTotal() {
    $("#sc_id_static_groupby").hide();
    $("#sc_id_free_groupby").hide();
    $("#sc_id_summary").show();
    $("#sc_id_show_static").addClass("scTabInactive").removeClass("scTabActive");
    $("#sc_id_show_free").addClass("scTabInactive").removeClass("scTabActive");
    $("#sc_id_show_total").addClass("scTabActive").removeClass("scTabInactive");
<?php
   if (!$embbed)
   {
?>
   ajusta_window();
<?php
   }
?>
  }
  function scSummOptionsInit() {
   var fieldList, fieldObject, fieldName, fieldOption, i;
   fieldList = $("#sc_id_summ_selected").sortable("toArray");
   for (i = 0; i < fieldList.length; i++) {
    fieldObject = $("#" + fieldList[i]).find("select");
    fieldName = fieldObject.attr("class").substr(13);
    fieldOption = fieldObject.find(":selected").attr("class").substr(20);
    scSummStatus[fieldName][fieldOption] = false;
   }
   scSummOptionsDraw();
  }
  function scSummOptionsSet(fieldName, opName, opValue) {
   scSummStatus[fieldName][opName] = opValue;
   if (opValue) {
    $("#sc_id_item_summ_" + fieldName).find(".sc-ui-select-available-" + opName).removeClass("scAppDivSelectBoxDisabled");
    $(".sc-ui-select-" + fieldName).find(".sc-ui-select-option-" + opName).prop("disabled", false);
   }
   else {
    $("#sc_id_item_summ_" + fieldName).find(".sc-ui-select-available-" + opName).addClass("scAppDivSelectBoxDisabled");
    $(".sc-ui-select-" + fieldName).find(".sc-ui-select-option-" + opName).filter(":not(:selected)").prop("disabled", true);
   }
   scSummFieldStatus(fieldName);
  }
  function scSummOptionsSetNew(fieldObj, fieldName, opSelected) {
   fieldObj.find(".sc-ui-select-option-" + opSelected).prop("selected", true);
   for (opName in scSummStatus[fieldName]) {
    if (opName != opSelected && !scSummStatus[fieldName][opName]) {
     fieldObj.find(".sc-ui-select-option-" + opName).prop("disabled", true);
    }
   }
   scSummFieldStatus(fieldName);
  }
  function scSummChange(fieldObj) {
   var fieldName, opName, fieldList, i;
   fieldName = fieldObj.attr("class").substr(13);
   for (opName in scSummStatus[fieldName]) {
    scSummStatus[fieldName][opName] = true;
    $("#sc_id_item_summ_" + fieldName).find(".sc-ui-select-available-" + opName).removeClass("scAppDivSelectBoxDisabled");
    $(".sc-ui-select-" + fieldName).find(".sc-ui-select-option-" + opName).prop("disabled", false);
   }
   fieldList = $("." + fieldObj.attr("class"));
   for (i = 0; i < fieldList.length; i++) {
    opName = $(fieldList[i]).find(":selected").attr("class").substr(20);
    scSummStatus[fieldName][opName] = false;
    $("#sc_id_item_summ_" + fieldName).find(".sc-ui-select-available-" + opName).addClass("scAppDivSelectBoxDisabled");
    $(".sc-ui-select-" + fieldName).find(".sc-ui-select-option-" + opName).filter(":not(:selected)").prop("disabled", true);
   }
  }
  function scSummOptionsDraw() {
   var fieldName, opName;
   for (fieldName in scSummStatus) {
    for (opName in scSummStatus[fieldName]) {
     if (scSummStatus[fieldName][opName]) {
      $("#sc_id_item_summ_" + fieldName).find(".sc-ui-select-available-" + opName).removeClass("scAppDivSelectBoxDisabled");
      $(".sc-ui-select-" + fieldName).find(".sc-ui-select-option-" + opName).filter(":selected").prop("disabled", false);
     }
     else {
      $("#sc_id_item_summ_" + fieldName).find(".sc-ui-select-available-" + opName).addClass("scAppDivSelectBoxDisabled");
      $(".sc-ui-select-" + fieldName).find(".sc-ui-select-option-" + opName).filter(":not(:selected)").prop("disabled", true);
     }
    }
    scSummFieldStatus(fieldName);
   }
  }
  function scSummFieldStatus(fieldName) {
   if (false == scSummFirstAvailable(fieldName)) {
    $("#sc_id_item_summ_" + fieldName).addClass("scAppDivSelectFieldsDisabled");
   }
   else {
    $("#sc_id_item_summ_" + fieldName).removeClass("scAppDivSelectFieldsDisabled");
   }
  }
  function scSummFirstAvailable(fieldName) {
   for (opName in scSummStatus[fieldName]) {
    if (scSummStatus[fieldName][opName]) {
     return opName;
    }
   }
   return false;
  }
 </script>
 <style type="text/css">
  .sc_ui_sortable {
   list-style-type: none;
   margin: 0;
   min-width: 225px;
  }
  .sc_ui_sortable li {
   margin: 0 3px 3px 3px;
   padding: 3px 3px 3px 15px;
   height: 18px;
  }
  .sc_ui_sortable li span {
   position: absolute;
   margin-left: -1.3em;
  }
  .sc_ui_ulist {
   min-width: 225px;
  }
  .sc_ui_ulist_total {
   width: 250px;
  }
  .sc_ui_litem {
  }
  .sc_ui_litem_total {
   height: 25px !important;
  }
 </style>
<?php
   if (!$embbed)
   {
?>
</HEAD>
<BODY class="scGridPage" style="margin: 0px; overflow-x: hidden">
<?php
   }
?>
<FORM name="Fsel_quebras" method="POST">
  <INPUT type="hidden" name="script_case_init" id="sc_id_gby_script_case_init" value="<?php echo NM_encode_input($sc_init); ?>"> 
  <INPUT type="hidden" name="script_case_session" id="sc_id_gby_script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
  <INPUT type="hidden" name="path_img" id="sc_id_gby_path_img" value="<?php echo NM_encode_input($path_img); ?>"> 
  <INPUT type="hidden" name="path_btn" id="sc_id_gby_path_btn" value="<?php echo NM_encode_input($path_btn); ?>"> 
  <INPUT type="hidden" name="opc_ret" id="sc_id_gby_opc_ret" value="<?php echo NM_encode_input($opc_ret); ?>"> 
  <INPUT type="hidden" name="campos_sel" id="sc_id_gby_campos_sel" value="">
  <INPUT type="hidden" name="xaxys_fields" id="sc_id_gby_xaxys_fields" value="">
  <INPUT type="hidden" name="summ_fields" id="sc_id_gby_summ_fields" value="">
  <INPUT type="hidden" name="fsel_ok" id="sc_id_gby_fsel_ok" value="OK"> 
<?php
if ($embbed)
{
    echo "<div class='scAppDivMoldura'>";
    echo "<table id=\"main_table\" style=\"width: 100%\" cellspacing=0 cellpadding=0>";
}
elseif ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; right: 20px; min-width: 500px\">";
}
else
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; left: 20px; min-width: 500px\">";
}
?>
<?php
if (!$embbed)
{
?>
<tr>
<td>
<div class="scGridBorder">
<table width='100%' cellspacing=0 cellpadding=0>
<?php
}
?>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivHeader scAppDivHeaderText':'scGridLabelVert'; ?>">
   <?php echo $this->Nm_lang['lang_btns_grpby_hint']; ?>
  </td>
 </tr>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>">
   <table class="<?php echo ($embbed)? '':'scGridTabela'; ?>" style="border-width: 0; border-collapse: collapse; width:100%;" cellspacing=0 cellpadding=0>
    <tr class="<?php echo ($embbed)? '':'scGridFieldOddVert'; ?>">
     <td style="vertical-align: top">
      <table cellspacing=0 cellpadding=0 style="width: 100%">
<?php
    $has_group_by_static  = false;
    $has_group_by_dynamic = true;
    $has_total_dynamic    = true && $opc_ret == "resumo";
    $iTabCount            = 1;
    if ($opc_ret == "resumo")
    {
        $has_total_dynamic = true;
        $iTabCount++;
    }
    if (1 < $iTabCount)
    {
?>
 <tr>
  <td>
   <ul class="scAppDivTabLine">
<?php
        if ($has_group_by_static)
        {
            $sTabClass = ('sc_free_group_by' == $groupby_atual) ? 'scTabInactive' : 'scTabActive';
?>
    <li id="sc_id_show_static" class="<?php echo $sTabClass; ?>"><a><?php echo $this->Nm_lang['lang_othr_groupby_static']; ?></a></li>
<?php
        }
        if ($has_group_by_dynamic)
        {
            $sTabClass = ('sc_free_group_by' == $groupby_atual) ? 'scTabActive' : 'scTabInactive';
?>
    <li id="sc_id_show_free" class="<?php echo $sTabClass; ?>"><a><?php echo $this->Nm_lang['lang_othr_groupby_dynamic']; ?></a></li>
<?php
        }
        if ($has_total_dynamic)
        {
?>
    <li id="sc_id_show_total" class="scTabInactive"><a><?php echo $this->Nm_lang['lang_othr_totals']; ?></a></li>
<?php
        }
?>
   </ul>
  </td>
 </tr>
<?php
    }
?>
 <tr id="sc_id_free_groupby">
  <td>
<?php
     if (!in_array("sc_free_group_by", $_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Groupby_hide']))
     {
        $check = ($groupby_atual == "sc_free_group_by") ? " checked" : "";
?>
      <span>
       <input type="radio" class="scAppDivToolbarInput sc_ui_gby_selected" name="sel_groupby" value="sc_free_group_by" id="sc_id_sel_groupby_sc_free_group_by"<?php echo $check ?> /><label for="sc_id_sel_groupby_sc_free_group_by" style="font-weight: bold"><?php echo $this->Nm_lang['lang_othr_groupby_free']; ?></label>
       <br /><br />
      </span>
<?php
        if ($bSummaryPage)
        {
?>
      <?php echo $this->Nm_lang['lang_othr_groupby_required']; ?><br />
<?php
        }
?>
      <table>
<?php
        $aYAxysFields = array();
        $aXAxysFields = array();
        $sYAxysLabel  = $this->Nm_lang['lang_othr_groupby_selected_fld'];
        foreach ($_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Gb_Free_cmp'] as $NM_cada_field => $resto)
        {
            $aYAxysFields[$NM_cada_field] = $resto;
        }
        if ($bSummaryPage)
        {
            $aTmpGroupBy = $aYAxysFields;
            foreach ($_SESSION['sc_session'][$sc_init]['generador_de_informes']['pivot_x_axys'] as $temp)
            {
                reset($aTmpGroupBy);
                $temp_key                 = key($aTmpGroupBy);
                $aXAxysFields[$temp_key] = $aTmpGroupBy[$temp_key];
                unset($aYAxysFields[$temp_key]);
                unset($aTmpGroupBy[$temp_key]);
            }
            $sYAxysLabel = $this->Nm_lang['lang_othr_groupby_axis_y'];
?>
       <tr>
        <td colspan="2" style="height: 35px">&nbsp;</td>
        <td rowspan="2" style="vertical-align: top">
         <?php echo $this->Nm_lang['lang_othr_groupby_axis_x']; ?>
         <ul class="sc_ui_sort_groupby sc_ui_sortable sc_ui_ulist scAppDivSelectFields" id="sc_id_xaxys">
<?php
            foreach ($aXAxysFields as $NM_cada_field => $resto)
            {
?>
          <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_item_<?php echo NM_encode_input($NM_cada_field); ?>"><?php echo $arr_campos_free[$NM_cada_field]; ?></li>
<?php
            }
?>
         </ul>
        </td>
       </tr>
<?php
        }
?>
       <tr>
        <td style="vertical-align: top">
         <?php echo $this->Nm_lang['lang_othr_groupby_available_fld']; ?>
         <ul class="sc_ui_sort_groupby sc_ui_sortable sc_ui_ulist scAppDivSelectFields" id="sc_id_available">
<?php
        foreach ($arr_campos_free as $NM_cada_field => $NM_cada_label)
        {
           if (!isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['SC_Gb_Free_cmp'][$NM_cada_field]))
           {
?>
          <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_item_<?php echo NM_encode_input($NM_cada_field); ?>"><?php echo $NM_cada_label; ?></li>
<?php
           }
        }
?>
         </ul>
        </td>
        <td style="vertical-align: top">
         <?php echo $sYAxysLabel; ?>
         <ul class="sc_ui_sort_groupby sc_ui_sortable sc_ui_ulist scAppDivSelectFields" id="sc_id_yaxys">
<?php
        foreach ($aYAxysFields as $NM_cada_field => $resto)
        {
?>
          <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_item_<?php echo NM_encode_input($NM_cada_field); ?>"><?php echo $arr_campos_free[$NM_cada_field]; ?></li>
<?php
        }
?>
         </ul>
        </td>
<?php
        if (isset($_GET['opc_ret']) && 'resumo' == $_GET['opc_ret'])
        {
?>
        <td>&nbsp;</td>
       </tr>
<?php
        }
?>
       </tr>
      </table>
<?php
     }
?>
  </td>
 </tr>
<?php
   $iItemCount = 0;
   if ($bSummaryPage)
   {
       $aSummStatus = array();
?>
 <tr id="sc_id_summary">
  <td>
      <table>
       <tr>
        <td style="vertical-align: top">
         <?php echo $this->Nm_lang['lang_othr_groupby_totals_fld']; ?>
         <ul class="sc_ui_sort_summ sc_ui_sortable sc_ui_ulist sc_ui_ulist_total scAppDivSelectFields" id="sc_id_summ_available">
<?php
        foreach ($_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_control'] as $l_field => $d_field)
        {
            $aSummStatus[$l_field] = array();
            $sOpDisplay            = 'NM_Count' == $l_field ? '; display: none' : '';
?>
          <li class="sc_ui_litem sc_ui_litem_total scAppDivSelectFieldsEnabled" id="sc_id_item_summ_<?php echo NM_encode_input($l_field); ?>"><table style="width: 100%"><tr><td><?php echo NM_encode_input($d_field['label']); ?></td><td style="text-align: right" class="sc-ui-total-options"><?php
            foreach ($d_field['options'] as $d_sum)
            {
                $aSummStatus[$l_field][] = $d_sum['op'];
?>
&nbsp;<span style="position: relative; margin-left: 0<?php echo $sOpDisplay; ?>" class="scAppDivSelectBoxEnabled sc-ui-select-available-<?php echo NM_encode_input($d_sum['op']); ?>"><?php echo NM_encode_input($d_sum['abbrev']); ?></span><?php
            }
?>
</td></tr></table></li>
<?php
        }
?>
         </ul>
        </td>
        <td style="vertical-align: top">
         <?php echo $this->Nm_lang['lang_othr_groupby_selected_fld']; ?>
         <ul class="sc_ui_sort_summ sc_ui_sortable sc_ui_ulist sc_ui_ulist_total scAppDivSelectFields" id="sc_id_summ_selected">
<?php
        foreach ($_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_order'] as $i_sum)
        {
            if ('' != $i_sum && isset($_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_display'][$i_sum]))
            {
                $d_sum = $_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_display'][$i_sum];
                if ($d_sum['display'])
                {
                    $sLabel = $d_sum['label'];
                    $sId    = '';
                    $bFound = false;
                    foreach ($_SESSION['sc_session'][$sc_init]['generador_de_informes']['summarizing_fields_control'] as $l_field => $d_field)
                    {
                        foreach ($d_field['options'] as $d_option)
                        {
                            if ($d_option['index'] == $i_sum)
                            {
                                $sLabel = $d_field['label'];
                                $sId    = $l_field;
                                $bFound = true;
                            }
                        }
                        if ($bFound)
                        {
                            break;
                        }
                    }
                    $sSelDisplay = 'NM_Count' == $sId ? ' style="display: none"' : '';
?>
          <li class="sc_ui_litem sc_ui_litem_total scAppDivSelectFieldsEnabled" id="sc_id_item_summ_<?php echo NM_encode_input($iItemCount); ?>"><table style="width: 100%"><tr><td><?php echo NM_encode_input($sLabel); ?></td><td style="text-align: right" class="sc-ui-total-options"><select class="sc-ui-select-<?php echo $sId; ?>"<?php echo $sSelDisplay; ?> onChange="scSummChange($(this))"><?php
                    foreach ($d_field['options'] as $d_option)
                    {
                        $sSelected = $i_sum == $d_option['index'] ? ' selected' : '';
?>
<option value="<?php echo $d_option['index']; ?>" class="sc-ui-select-option-<?php echo $d_option['op']; ?>"<?php echo $sSelected; ?>><?php echo NM_encode_input($d_option['label']); ?></option><?php
                    }
?>
</select></td></tr></table></li>
<?php
                    $iItemCount++;
                }
           }
       }
?>
         </ul>
        </td>
       </tr>
      </table>
  </td>
 </tr>
<?php
   }
?>
      </table>
<script type="text/javascript">
 var scSummItemCount, scSummStatus;
 $(function() {
  scSummItemCount = <?php echo $iItemCount; ?>;
<?php
   if ($bSummaryPage)
   {
?>
  scSummStatus = {
<?php
       foreach ($aSummStatus as $sSummId => $aSummData)
       {
?>
   <?php echo $sSummId; ?>: {
<?php
           foreach ($aSummData as $sSummOp)
           {
?>
     <?php echo $sSummOp; ?>: true,
<?php
           }
?>
   },
<?php
       }
?>
  };
<?php
   }
?>
  scSummOptionsInit();
 });
</script>
   </td>
  </table>
  </td>
  </tr>
   <tr>
  <td class="<?php echo ($embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>" colspan=2>
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bok", "scPackGroupBy();document.Fsel_quebras.submit()", "scPackGroupBy();document.Fsel_quebras.submit()", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bapply", "scPackGroupBy();scSubmitGroupBy('" . $tbar_pos . "')", "scPackGroupBy();scSubmitGroupBy('" . $tbar_pos . "')", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp;
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bsair", "self.parent.tb_remove()", "self.parent.tb_remove()", "Bsair", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnGroupByHide('" . $tbar_pos . "')", "scBtnGroupByHide('" . $tbar_pos . "')", "Bsair", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
   </td></tr>
<?php
if (!$embbed)
{
?>
  </table>
  </div>
  </td>
  </tr>
<?php
}
?>
  </table>
<?php
if ($embbed)
{
?>
    </div>
<?php
}
?>
</FORM>
<script language="javascript">
$(function() {
<?php
   if ($bStartFree)
   {
?>
       scShowFree();
<?php
   }
   else
   {
?>
       scShowStatic();
<?php
   }
?>
});
</script>
<?php
   if (!$embbed)
   {
?>
<script language="javascript"> 
var bFixed = false;
function ajusta_window()
{
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window()", 50);
    return;
  }
  else if(!bFixed)
  {
    var oOrig = $(document.Fsel_quebras.sel_groupby),
        mHeight = oOrig.height(),
        mWidth  = oOrig.width() + 5;
    oOrig.height(mHeight);
    oOrig.width(mWidth);
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
      self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
      setTimeout("ajusta_window()", 50);
      return;
    }
  }
  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
  self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
}
$( document ).ready(function() {
  ajusta_window();
});
</script>
<script>
  ajusta_window();
</script>
</BODY>
</HTML>
<?php
   }
}
}

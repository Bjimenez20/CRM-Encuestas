<?php
   include_once('Informe_reclamacion_historial_session.php');
   session_start();
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
    $Ord_Cmp = new Informe_reclamacion_historial_Ord_cmp(); 
    $Ord_Cmp->Ord_cmp_init();
   
class Informe_reclamacion_historial_Ord_cmp
{
function Ord_cmp_init()
{
  global $sc_init, $path_img, $path_btn, $tab_ger_campos, $tab_def_campos, $tab_converte, $tab_labels, $embbed, $tbar_pos, $_POST, $_GET;
   if (isset($_POST['script_case_init']))
   {
       $sc_init    = $_POST['script_case_init'];
       $path_img   = $_POST['path_img'];
       $path_btn   = $_POST['path_btn'];
       $use_alias  = (isset($_POST['use_alias']))  ? $_POST['use_alias']  : "S";
       $fsel_ok    = (isset($_POST['fsel_ok']))    ? $_POST['fsel_ok']    : "";
       $campos_sel = (isset($_POST['campos_sel'])) ? $_POST['campos_sel'] : "";
       $sel_regra  = (isset($_POST['sel_regra']))  ? $_POST['sel_regra']  : "";
       $embbed     = isset($_POST['embbed_groupby']) && 'Y' == $_POST['embbed_groupby'];
       $tbar_pos   = isset($_POST['toolbar_pos']) ? $_POST['toolbar_pos'] : '';
   }
   elseif (isset($_GET['script_case_init']))
   {
       $sc_init    = $_GET['script_case_init'];
       $path_img   = $_GET['path_img'];
       $path_btn   = $_GET['path_btn'];
       $use_alias  = (isset($_GET['use_alias']))  ? $_GET['use_alias']  : "S";
       $fsel_ok    = (isset($_GET['fsel_ok']))    ? $_GET['fsel_ok']    : "";
       $campos_sel = (isset($_GET['campos_sel'])) ? $_GET['campos_sel'] : "";
       $sel_regra  = (isset($_GET['sel_regra']))  ? $_GET['sel_regra']  : "";
       $embbed     = isset($_GET['embbed_groupby']) && 'Y' == $_GET['embbed_groupby'];
       $tbar_pos   = isset($_GET['toolbar_pos']) ? $_GET['toolbar_pos'] : '';
   }
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "es";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $this->Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       include_once($NM_arq_lang);
   }
   
   $tab_ger_campos = array();
   $tab_def_campos = array();
   $tab_labels     = array();
   $tab_ger_campos['pacientes_id_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_id_paciente'] = "pacientes_id_paciente";
       $tab_converte["pacientes_id_paciente"]   = "pacientes_id_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_id_paciente'] = "pacientes.ID_PACIENTE";
       $tab_converte["pacientes.ID_PACIENTE"]   = "pacientes_id_paciente";
   }
   $tab_labels["pacientes_id_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_id_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_id_paciente"] : "ID PACIENTE";
   $tab_ger_campos['gestiones_logro_comunicacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['gestiones_logro_comunicacion_gestion'] = "cmp_maior_30_1";
       $tab_converte["cmp_maior_30_1"]   = "gestiones_logro_comunicacion_gestion";
   }
   else
   {
       $tab_def_campos['gestiones_logro_comunicacion_gestion'] = "gestiones.LOGRO_COMUNICACION_GESTION";
       $tab_converte["gestiones.LOGRO_COMUNICACION_GESTION"]   = "gestiones_logro_comunicacion_gestion";
   }
   $tab_labels["gestiones_logro_comunicacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_logro_comunicacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_logro_comunicacion_gestion"] : "LOGRO COMUNICACION GESTION";
   $tab_ger_campos['gestiones_fecha_comunicacion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['gestiones_fecha_comunicacion'] = "cmp_maior_30_2";
       $tab_converte["cmp_maior_30_2"]   = "gestiones_fecha_comunicacion";
   }
   else
   {
       $tab_def_campos['gestiones_fecha_comunicacion'] = "gestiones.FECHA_COMUNICACION";
       $tab_converte["gestiones.FECHA_COMUNICACION"]   = "gestiones_fecha_comunicacion";
   }
   $tab_labels["gestiones_fecha_comunicacion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_fecha_comunicacion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_fecha_comunicacion"] : "FECHA COMUNICACION";
   $tab_ger_campos['gestiones_autor_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['gestiones_autor_gestion'] = "gestiones_autor_gestion";
       $tab_converte["gestiones_autor_gestion"]   = "gestiones_autor_gestion";
   }
   else
   {
       $tab_def_campos['gestiones_autor_gestion'] = "gestiones.AUTOR_GESTION";
       $tab_converte["gestiones.AUTOR_GESTION"]   = "gestiones_autor_gestion";
   }
   $tab_labels["gestiones_autor_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_autor_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_autor_gestion"] : "AUTOR GESTION";
   $tab_ger_campos['pacientes_departamento_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_departamento_paciente'] = "cmp_maior_30_3";
       $tab_converte["cmp_maior_30_3"]   = "pacientes_departamento_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_departamento_paciente'] = "pacientes.DEPARTAMENTO_PACIENTE";
       $tab_converte["pacientes.DEPARTAMENTO_PACIENTE"]   = "pacientes_departamento_paciente";
   }
   $tab_labels["pacientes_departamento_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_departamento_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_departamento_paciente"] : "DEPARTAMENTO PACIENTE";
   $tab_ger_campos['pacientes_ciudad_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_ciudad_paciente'] = "cmp_maior_30_4";
       $tab_converte["cmp_maior_30_4"]   = "pacientes_ciudad_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_ciudad_paciente'] = "pacientes.CIUDAD_PACIENTE";
       $tab_converte["pacientes.CIUDAD_PACIENTE"]   = "pacientes_ciudad_paciente";
   }
   $tab_labels["pacientes_ciudad_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_ciudad_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_ciudad_paciente"] : "CIUDAD PACIENTE";
   $tab_ger_campos['pacientes_estado_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_estado_paciente'] = "cmp_maior_30_5";
       $tab_converte["cmp_maior_30_5"]   = "pacientes_estado_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_estado_paciente'] = "pacientes.ESTADO_PACIENTE";
       $tab_converte["pacientes.ESTADO_PACIENTE"]   = "pacientes_estado_paciente";
   }
   $tab_labels["pacientes_estado_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_estado_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_estado_paciente"] : "ESTADO PACIENTE";
   $tab_ger_campos['pacientes_status_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_status_paciente'] = "cmp_maior_30_6";
       $tab_converte["cmp_maior_30_6"]   = "pacientes_status_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_status_paciente'] = "pacientes.STATUS_PACIENTE";
       $tab_converte["pacientes.STATUS_PACIENTE"]   = "pacientes_status_paciente";
   }
   $tab_labels["pacientes_status_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_status_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_status_paciente"] : "STATUS PACIENTE";
   $tab_ger_campos['pacientes_fecha_activacion_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_fecha_activacion_paciente'] = "cmp_maior_30_7";
       $tab_converte["cmp_maior_30_7"]   = "pacientes_fecha_activacion_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_fecha_activacion_paciente'] = "pacientes.FECHA_ACTIVACION_PACIENTE";
       $tab_converte["pacientes.FECHA_ACTIVACION_PACIENTE"]   = "pacientes_fecha_activacion_paciente";
   }
   $tab_labels["pacientes_fecha_activacion_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_fecha_activacion_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_fecha_activacion_paciente"] : "FECHA ACTIVACION PACIENTE";
   $tab_ger_campos['pacientes_codigo_xofigo'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_codigo_xofigo'] = "pacientes_codigo_xofigo";
       $tab_converte["pacientes_codigo_xofigo"]   = "pacientes_codigo_xofigo";
   }
   else
   {
       $tab_def_campos['pacientes_codigo_xofigo'] = "pacientes.CODIGO_XOFIGO";
       $tab_converte["pacientes.CODIGO_XOFIGO"]   = "pacientes_codigo_xofigo";
   }
   $tab_labels["pacientes_codigo_xofigo"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_codigo_xofigo"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["pacientes_codigo_xofigo"] : "CODIGO XOFIGO";
   $tab_ger_campos['tratamiento_producto_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_producto_tratamiento'] = "cmp_maior_30_8";
       $tab_converte["cmp_maior_30_8"]   = "tratamiento_producto_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_producto_tratamiento'] = "tratamiento.PRODUCTO_TRATAMIENTO";
       $tab_converte["tratamiento.PRODUCTO_TRATAMIENTO"]   = "tratamiento_producto_tratamiento";
   }
   $tab_labels["tratamiento_producto_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_producto_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_producto_tratamiento"] : "PRODUCTO TRATAMIENTO";
   $tab_ger_campos['tratamiento_nombre_referencia'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_nombre_referencia'] = "cmp_maior_30_9";
       $tab_converte["cmp_maior_30_9"]   = "tratamiento_nombre_referencia";
   }
   else
   {
       $tab_def_campos['tratamiento_nombre_referencia'] = "tratamiento.NOMBRE_REFERENCIA";
       $tab_converte["tratamiento.NOMBRE_REFERENCIA"]   = "tratamiento_nombre_referencia";
   }
   $tab_labels["tratamiento_nombre_referencia"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_nombre_referencia"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_nombre_referencia"] : "NOMBRE REFERENCIA";
   $tab_ger_campos['tratamiento_dosis_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_dosis_tratamiento'] = "cmp_maior_30_10";
       $tab_converte["cmp_maior_30_10"]   = "tratamiento_dosis_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_dosis_tratamiento'] = "tratamiento.DOSIS_TRATAMIENTO";
       $tab_converte["tratamiento.DOSIS_TRATAMIENTO"]   = "tratamiento_dosis_tratamiento";
   }
   $tab_labels["tratamiento_dosis_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_dosis_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_dosis_tratamiento"] : "DOSIS TRATAMIENTO";
   $tab_ger_campos['gestiones_numero_cajas'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['gestiones_numero_cajas'] = "gestiones_numero_cajas";
       $tab_converte["gestiones_numero_cajas"]   = "gestiones_numero_cajas";
   }
   else
   {
       $tab_def_campos['gestiones_numero_cajas'] = "gestiones.NUMERO_CAJAS";
       $tab_converte["gestiones.NUMERO_CAJAS"]   = "gestiones_numero_cajas";
   }
   $tab_labels["gestiones_numero_cajas"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_numero_cajas"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_numero_cajas"] : "NUMERO CAJAS";
   $tab_ger_campos['tratamiento_asegurador_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_asegurador_tratamiento'] = "cmp_maior_30_11";
       $tab_converte["cmp_maior_30_11"]   = "tratamiento_asegurador_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_asegurador_tratamiento'] = "tratamiento.ASEGURADOR_TRATAMIENTO";
       $tab_converte["tratamiento.ASEGURADOR_TRATAMIENTO"]   = "tratamiento_asegurador_tratamiento";
   }
   $tab_labels["tratamiento_asegurador_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_asegurador_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_asegurador_tratamiento"] : "ASEGURADOR TRATAMIENTO";
   $tab_ger_campos['tratamiento_operador_logistico_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_operador_logistico_tratamiento'] = "cmp_maior_30_12";
       $tab_converte["cmp_maior_30_12"]   = "tratamiento_operador_logistico_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_operador_logistico_tratamiento'] = "tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO";
       $tab_converte["tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO"]   = "tratamiento_operador_logistico_tratamiento";
   }
   $tab_labels["tratamiento_operador_logistico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_operador_logistico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_operador_logistico_tratamiento"] : "OPERADOR LOGISTICO TRATAMIENTO";
   $tab_ger_campos['tratamiento_punto_entrega'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_punto_entrega'] = "cmp_maior_30_13";
       $tab_converte["cmp_maior_30_13"]   = "tratamiento_punto_entrega";
   }
   else
   {
       $tab_def_campos['tratamiento_punto_entrega'] = "tratamiento.PUNTO_ENTREGA";
       $tab_converte["tratamiento.PUNTO_ENTREGA"]   = "tratamiento_punto_entrega";
   }
   $tab_labels["tratamiento_punto_entrega"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_punto_entrega"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["tratamiento_punto_entrega"] : "PUNTO ENTREGA";
   $tab_ger_campos['gestiones_reclamo_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['gestiones_reclamo_gestion'] = "cmp_maior_30_14";
       $tab_converte["cmp_maior_30_14"]   = "gestiones_reclamo_gestion";
   }
   else
   {
       $tab_def_campos['gestiones_reclamo_gestion'] = "gestiones.RECLAMO_GESTION";
       $tab_converte["gestiones.RECLAMO_GESTION"]   = "gestiones_reclamo_gestion";
   }
   $tab_labels["gestiones_reclamo_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_reclamo_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_reclamo_gestion"] : "RECLAMO GESTION";
   $tab_ger_campos['gestiones_fecha_reclamacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['gestiones_fecha_reclamacion_gestion'] = "cmp_maior_30_15";
       $tab_converte["cmp_maior_30_15"]   = "gestiones_fecha_reclamacion_gestion";
   }
   else
   {
       $tab_def_campos['gestiones_fecha_reclamacion_gestion'] = "gestiones.FECHA_RECLAMACION_GESTION";
       $tab_converte["gestiones.FECHA_RECLAMACION_GESTION"]   = "gestiones_fecha_reclamacion_gestion";
   }
   $tab_labels["gestiones_fecha_reclamacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_fecha_reclamacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_fecha_reclamacion_gestion"] : "FECHA RECLAMACION GESTION";
   $tab_ger_campos['gestiones_causa_no_reclamacion_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['gestiones_causa_no_reclamacion_gestion'] = "cmp_maior_30_16";
       $tab_converte["cmp_maior_30_16"]   = "gestiones_causa_no_reclamacion_gestion";
   }
   else
   {
       $tab_def_campos['gestiones_causa_no_reclamacion_gestion'] = "gestiones.CAUSA_NO_RECLAMACION_GESTION";
       $tab_converte["gestiones.CAUSA_NO_RECLAMACION_GESTION"]   = "gestiones_causa_no_reclamacion_gestion";
   }
   $tab_labels["gestiones_causa_no_reclamacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_causa_no_reclamacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["gestiones_causa_no_reclamacion_gestion"] : "CAUSA NO RECLAMACION GESTION";
   $tab_ger_campos['historial_reclamacion_id_historial_reclamacion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_id_historial_reclamacion'] = "cmp_maior_30_17";
       $tab_converte["cmp_maior_30_17"]   = "historial_reclamacion_id_historial_reclamacion";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_id_historial_reclamacion'] = "historial_reclamacion.ID_HISTORIAL_RECLAMACION";
       $tab_converte["historial_reclamacion.ID_HISTORIAL_RECLAMACION"]   = "historial_reclamacion_id_historial_reclamacion";
   }
   $tab_labels["historial_reclamacion_id_historial_reclamacion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_id_historial_reclamacion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_id_historial_reclamacion"] : "ID HISTORIAL RECLAMACION";
   $tab_ger_campos['historial_reclamacion_anio_historial_reclamacion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_anio_historial_reclamacion'] = "cmp_maior_30_18";
       $tab_converte["cmp_maior_30_18"]   = "historial_reclamacion_anio_historial_reclamacion";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_anio_historial_reclamacion'] = "historial_reclamacion.ANIO_HISTORIAL_RECLAMACION";
       $tab_converte["historial_reclamacion.ANIO_HISTORIAL_RECLAMACION"]   = "historial_reclamacion_anio_historial_reclamacion";
   }
   $tab_labels["historial_reclamacion_anio_historial_reclamacion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_anio_historial_reclamacion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_anio_historial_reclamacion"] : "ANIO HISTORIAL RECLAMACION";
   $tab_ger_campos['historial_reclamacion_mes1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes1'] = "cmp_maior_30_19";
       $tab_converte["cmp_maior_30_19"]   = "historial_reclamacion_mes1";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes1'] = "historial_reclamacion.MES1";
       $tab_converte["historial_reclamacion.MES1"]   = "historial_reclamacion_mes1";
   }
   $tab_labels["historial_reclamacion_mes1"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes1"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes1"] : "MES1";
   $tab_ger_campos['historial_reclamacion_reclamo1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo1'] = "cmp_maior_30_20";
       $tab_converte["cmp_maior_30_20"]   = "historial_reclamacion_reclamo1";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo1'] = "historial_reclamacion.RECLAMO1";
       $tab_converte["historial_reclamacion.RECLAMO1"]   = "historial_reclamacion_reclamo1";
   }
   $tab_labels["historial_reclamacion_reclamo1"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo1"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo1"] : "RECLAMO1";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion1'] = "cmp_maior_30_21";
       $tab_converte["cmp_maior_30_21"]   = "historial_reclamacion_fecha_reclamacion1";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion1'] = "historial_reclamacion.FECHA_RECLAMACION1";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION1"]   = "historial_reclamacion_fecha_reclamacion1";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion1"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion1"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion1"] : "FECHA RECLAMACION1";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion1'] = "cmp_maior_30_22";
       $tab_converte["cmp_maior_30_22"]   = "historial_reclamacion_motivo_no_reclamacion1";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion1'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION1";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION1"]   = "historial_reclamacion_motivo_no_reclamacion1";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion1"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion1"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion1"] : "MOTIVO NO RECLAMACION1";
   $tab_ger_campos['historial_reclamacion_mes2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes2'] = "cmp_maior_30_23";
       $tab_converte["cmp_maior_30_23"]   = "historial_reclamacion_mes2";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes2'] = "historial_reclamacion.MES2";
       $tab_converte["historial_reclamacion.MES2"]   = "historial_reclamacion_mes2";
   }
   $tab_labels["historial_reclamacion_mes2"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes2"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes2"] : "MES2";
   $tab_ger_campos['historial_reclamacion_reclamo2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo2'] = "cmp_maior_30_24";
       $tab_converte["cmp_maior_30_24"]   = "historial_reclamacion_reclamo2";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo2'] = "historial_reclamacion.RECLAMO2";
       $tab_converte["historial_reclamacion.RECLAMO2"]   = "historial_reclamacion_reclamo2";
   }
   $tab_labels["historial_reclamacion_reclamo2"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo2"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo2"] : "RECLAMO2";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion2'] = "cmp_maior_30_25";
       $tab_converte["cmp_maior_30_25"]   = "historial_reclamacion_fecha_reclamacion2";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion2'] = "historial_reclamacion.FECHA_RECLAMACION2";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION2"]   = "historial_reclamacion_fecha_reclamacion2";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion2"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion2"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion2"] : "FECHA RECLAMACION2";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion2'] = "cmp_maior_30_26";
       $tab_converte["cmp_maior_30_26"]   = "historial_reclamacion_motivo_no_reclamacion2";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion2'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION2";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION2"]   = "historial_reclamacion_motivo_no_reclamacion2";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion2"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion2"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion2"] : "MOTIVO NO RECLAMACION2";
   $tab_ger_campos['historial_reclamacion_mes3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes3'] = "cmp_maior_30_27";
       $tab_converte["cmp_maior_30_27"]   = "historial_reclamacion_mes3";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes3'] = "historial_reclamacion.MES3";
       $tab_converte["historial_reclamacion.MES3"]   = "historial_reclamacion_mes3";
   }
   $tab_labels["historial_reclamacion_mes3"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes3"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes3"] : "MES3";
   $tab_ger_campos['historial_reclamacion_reclamo3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo3'] = "cmp_maior_30_28";
       $tab_converte["cmp_maior_30_28"]   = "historial_reclamacion_reclamo3";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo3'] = "historial_reclamacion.RECLAMO3";
       $tab_converte["historial_reclamacion.RECLAMO3"]   = "historial_reclamacion_reclamo3";
   }
   $tab_labels["historial_reclamacion_reclamo3"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo3"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo3"] : "RECLAMO3";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion3'] = "cmp_maior_30_29";
       $tab_converte["cmp_maior_30_29"]   = "historial_reclamacion_fecha_reclamacion3";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion3'] = "historial_reclamacion.FECHA_RECLAMACION3";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION3"]   = "historial_reclamacion_fecha_reclamacion3";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion3"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion3"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion3"] : "FECHA RECLAMACION3";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion3'] = "cmp_maior_30_30";
       $tab_converte["cmp_maior_30_30"]   = "historial_reclamacion_motivo_no_reclamacion3";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion3'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION3";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION3"]   = "historial_reclamacion_motivo_no_reclamacion3";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion3"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion3"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion3"] : "MOTIVO NO RECLAMACION3";
   $tab_ger_campos['historial_reclamacion_mes4'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes4'] = "cmp_maior_30_31";
       $tab_converte["cmp_maior_30_31"]   = "historial_reclamacion_mes4";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes4'] = "historial_reclamacion.MES4";
       $tab_converte["historial_reclamacion.MES4"]   = "historial_reclamacion_mes4";
   }
   $tab_labels["historial_reclamacion_mes4"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes4"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes4"] : "MES4";
   $tab_ger_campos['historial_reclamacion_reclamo4'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo4'] = "cmp_maior_30_32";
       $tab_converte["cmp_maior_30_32"]   = "historial_reclamacion_reclamo4";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo4'] = "historial_reclamacion.RECLAMO4";
       $tab_converte["historial_reclamacion.RECLAMO4"]   = "historial_reclamacion_reclamo4";
   }
   $tab_labels["historial_reclamacion_reclamo4"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo4"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo4"] : "RECLAMO4";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion4'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion4'] = "cmp_maior_30_33";
       $tab_converte["cmp_maior_30_33"]   = "historial_reclamacion_fecha_reclamacion4";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion4'] = "historial_reclamacion.FECHA_RECLAMACION4";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION4"]   = "historial_reclamacion_fecha_reclamacion4";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion4"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion4"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion4"] : "FECHA RECLAMACION4";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion4'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion4'] = "cmp_maior_30_34";
       $tab_converte["cmp_maior_30_34"]   = "historial_reclamacion_motivo_no_reclamacion4";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion4'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION4";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION4"]   = "historial_reclamacion_motivo_no_reclamacion4";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion4"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion4"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion4"] : "MOTIVO NO RECLAMACION4";
   $tab_ger_campos['historial_reclamacion_mes5'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes5'] = "cmp_maior_30_35";
       $tab_converte["cmp_maior_30_35"]   = "historial_reclamacion_mes5";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes5'] = "historial_reclamacion.MES5";
       $tab_converte["historial_reclamacion.MES5"]   = "historial_reclamacion_mes5";
   }
   $tab_labels["historial_reclamacion_mes5"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes5"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes5"] : "MES5";
   $tab_ger_campos['historial_reclamacion_reclamo5'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo5'] = "cmp_maior_30_36";
       $tab_converte["cmp_maior_30_36"]   = "historial_reclamacion_reclamo5";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo5'] = "historial_reclamacion.RECLAMO5";
       $tab_converte["historial_reclamacion.RECLAMO5"]   = "historial_reclamacion_reclamo5";
   }
   $tab_labels["historial_reclamacion_reclamo5"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo5"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo5"] : "RECLAMO5";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion5'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion5'] = "cmp_maior_30_37";
       $tab_converte["cmp_maior_30_37"]   = "historial_reclamacion_fecha_reclamacion5";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion5'] = "historial_reclamacion.FECHA_RECLAMACION5";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION5"]   = "historial_reclamacion_fecha_reclamacion5";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion5"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion5"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion5"] : "FECHA RECLAMACION5";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion5'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion5'] = "cmp_maior_30_38";
       $tab_converte["cmp_maior_30_38"]   = "historial_reclamacion_motivo_no_reclamacion5";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion5'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION5";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION5"]   = "historial_reclamacion_motivo_no_reclamacion5";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion5"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion5"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion5"] : "MOTIVO NO RECLAMACION5";
   $tab_ger_campos['historial_reclamacion_mes6'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes6'] = "cmp_maior_30_39";
       $tab_converte["cmp_maior_30_39"]   = "historial_reclamacion_mes6";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes6'] = "historial_reclamacion.MES6";
       $tab_converte["historial_reclamacion.MES6"]   = "historial_reclamacion_mes6";
   }
   $tab_labels["historial_reclamacion_mes6"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes6"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes6"] : "MES6";
   $tab_ger_campos['historial_reclamacion_reclamo6'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo6'] = "cmp_maior_30_40";
       $tab_converte["cmp_maior_30_40"]   = "historial_reclamacion_reclamo6";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo6'] = "historial_reclamacion.RECLAMO6";
       $tab_converte["historial_reclamacion.RECLAMO6"]   = "historial_reclamacion_reclamo6";
   }
   $tab_labels["historial_reclamacion_reclamo6"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo6"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo6"] : "RECLAMO6";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion6'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion6'] = "cmp_maior_30_41";
       $tab_converte["cmp_maior_30_41"]   = "historial_reclamacion_fecha_reclamacion6";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion6'] = "historial_reclamacion.FECHA_RECLAMACION6";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION6"]   = "historial_reclamacion_fecha_reclamacion6";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion6"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion6"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion6"] : "FECHA RECLAMACION6";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion6'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion6'] = "cmp_maior_30_42";
       $tab_converte["cmp_maior_30_42"]   = "historial_reclamacion_motivo_no_reclamacion6";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion6'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION6";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION6"]   = "historial_reclamacion_motivo_no_reclamacion6";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion6"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion6"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion6"] : "MOTIVO NO RECLAMACION6";
   $tab_ger_campos['historial_reclamacion_mes7'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes7'] = "cmp_maior_30_43";
       $tab_converte["cmp_maior_30_43"]   = "historial_reclamacion_mes7";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes7'] = "historial_reclamacion.MES7";
       $tab_converte["historial_reclamacion.MES7"]   = "historial_reclamacion_mes7";
   }
   $tab_labels["historial_reclamacion_mes7"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes7"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes7"] : "MES7";
   $tab_ger_campos['historial_reclamacion_reclamo7'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo7'] = "cmp_maior_30_44";
       $tab_converte["cmp_maior_30_44"]   = "historial_reclamacion_reclamo7";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo7'] = "historial_reclamacion.RECLAMO7";
       $tab_converte["historial_reclamacion.RECLAMO7"]   = "historial_reclamacion_reclamo7";
   }
   $tab_labels["historial_reclamacion_reclamo7"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo7"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo7"] : "RECLAMO7";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion7'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion7'] = "cmp_maior_30_45";
       $tab_converte["cmp_maior_30_45"]   = "historial_reclamacion_fecha_reclamacion7";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion7'] = "historial_reclamacion.FECHA_RECLAMACION7";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION7"]   = "historial_reclamacion_fecha_reclamacion7";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion7"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion7"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion7"] : "FECHA RECLAMACION7";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion7'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion7'] = "cmp_maior_30_46";
       $tab_converte["cmp_maior_30_46"]   = "historial_reclamacion_motivo_no_reclamacion7";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion7'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION7";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION7"]   = "historial_reclamacion_motivo_no_reclamacion7";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion7"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion7"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion7"] : "MOTIVO NO RECLAMACION7";
   $tab_ger_campos['historial_reclamacion_mes8'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes8'] = "cmp_maior_30_47";
       $tab_converte["cmp_maior_30_47"]   = "historial_reclamacion_mes8";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes8'] = "historial_reclamacion.MES8";
       $tab_converte["historial_reclamacion.MES8"]   = "historial_reclamacion_mes8";
   }
   $tab_labels["historial_reclamacion_mes8"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes8"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes8"] : "MES8";
   $tab_ger_campos['historial_reclamacion_reclamo8'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo8'] = "cmp_maior_30_48";
       $tab_converte["cmp_maior_30_48"]   = "historial_reclamacion_reclamo8";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo8'] = "historial_reclamacion.RECLAMO8";
       $tab_converte["historial_reclamacion.RECLAMO8"]   = "historial_reclamacion_reclamo8";
   }
   $tab_labels["historial_reclamacion_reclamo8"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo8"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo8"] : "RECLAMO8";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion8'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion8'] = "cmp_maior_30_49";
       $tab_converte["cmp_maior_30_49"]   = "historial_reclamacion_fecha_reclamacion8";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion8'] = "historial_reclamacion.FECHA_RECLAMACION8";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION8"]   = "historial_reclamacion_fecha_reclamacion8";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion8"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion8"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion8"] : "FECHA RECLAMACION8";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion8'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion8'] = "cmp_maior_30_50";
       $tab_converte["cmp_maior_30_50"]   = "historial_reclamacion_motivo_no_reclamacion8";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion8'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION8";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION8"]   = "historial_reclamacion_motivo_no_reclamacion8";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion8"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion8"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion8"] : "MOTIVO NO RECLAMACION8";
   $tab_ger_campos['historial_reclamacion_mes9'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes9'] = "cmp_maior_30_51";
       $tab_converte["cmp_maior_30_51"]   = "historial_reclamacion_mes9";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes9'] = "historial_reclamacion.MES9";
       $tab_converte["historial_reclamacion.MES9"]   = "historial_reclamacion_mes9";
   }
   $tab_labels["historial_reclamacion_mes9"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes9"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes9"] : "MES9";
   $tab_ger_campos['historial_reclamacion_reclamo9'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo9'] = "cmp_maior_30_52";
       $tab_converte["cmp_maior_30_52"]   = "historial_reclamacion_reclamo9";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo9'] = "historial_reclamacion.RECLAMO9";
       $tab_converte["historial_reclamacion.RECLAMO9"]   = "historial_reclamacion_reclamo9";
   }
   $tab_labels["historial_reclamacion_reclamo9"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo9"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo9"] : "RECLAMO9";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion9'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion9'] = "cmp_maior_30_53";
       $tab_converte["cmp_maior_30_53"]   = "historial_reclamacion_fecha_reclamacion9";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion9'] = "historial_reclamacion.FECHA_RECLAMACION9";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION9"]   = "historial_reclamacion_fecha_reclamacion9";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion9"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion9"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion9"] : "FECHA RECLAMACION9";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion9'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion9'] = "cmp_maior_30_54";
       $tab_converte["cmp_maior_30_54"]   = "historial_reclamacion_motivo_no_reclamacion9";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion9'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION9";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION9"]   = "historial_reclamacion_motivo_no_reclamacion9";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion9"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion9"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion9"] : "MOTIVO NO RECLAMACION9";
   $tab_ger_campos['historial_reclamacion_mes10'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes10'] = "cmp_maior_30_55";
       $tab_converte["cmp_maior_30_55"]   = "historial_reclamacion_mes10";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes10'] = "historial_reclamacion.MES10";
       $tab_converte["historial_reclamacion.MES10"]   = "historial_reclamacion_mes10";
   }
   $tab_labels["historial_reclamacion_mes10"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes10"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes10"] : "MES10";
   $tab_ger_campos['historial_reclamacion_reclamo10'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo10'] = "cmp_maior_30_56";
       $tab_converte["cmp_maior_30_56"]   = "historial_reclamacion_reclamo10";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo10'] = "historial_reclamacion.RECLAMO10";
       $tab_converte["historial_reclamacion.RECLAMO10"]   = "historial_reclamacion_reclamo10";
   }
   $tab_labels["historial_reclamacion_reclamo10"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo10"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo10"] : "RECLAMO10";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion10'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion10'] = "cmp_maior_30_57";
       $tab_converte["cmp_maior_30_57"]   = "historial_reclamacion_fecha_reclamacion10";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion10'] = "historial_reclamacion.FECHA_RECLAMACION10";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION10"]   = "historial_reclamacion_fecha_reclamacion10";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion10"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion10"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion10"] : "FECHA RECLAMACION10";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion10'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion10'] = "cmp_maior_30_58";
       $tab_converte["cmp_maior_30_58"]   = "historial_reclamacion_motivo_no_reclamacion10";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion10'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION10";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION10"]   = "historial_reclamacion_motivo_no_reclamacion10";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion10"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion10"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion10"] : "MOTIVO NO RECLAMACION10";
   $tab_ger_campos['historial_reclamacion_mes11'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes11'] = "cmp_maior_30_59";
       $tab_converte["cmp_maior_30_59"]   = "historial_reclamacion_mes11";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes11'] = "historial_reclamacion.MES11";
       $tab_converte["historial_reclamacion.MES11"]   = "historial_reclamacion_mes11";
   }
   $tab_labels["historial_reclamacion_mes11"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes11"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes11"] : "MES11";
   $tab_ger_campos['historial_reclamacion_reclamo11'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo11'] = "cmp_maior_30_60";
       $tab_converte["cmp_maior_30_60"]   = "historial_reclamacion_reclamo11";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo11'] = "historial_reclamacion.RECLAMO11";
       $tab_converte["historial_reclamacion.RECLAMO11"]   = "historial_reclamacion_reclamo11";
   }
   $tab_labels["historial_reclamacion_reclamo11"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo11"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo11"] : "RECLAMO11";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion11'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion11'] = "cmp_maior_30_61";
       $tab_converte["cmp_maior_30_61"]   = "historial_reclamacion_fecha_reclamacion11";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion11'] = "historial_reclamacion.FECHA_RECLAMACION11";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION11"]   = "historial_reclamacion_fecha_reclamacion11";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion11"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion11"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion11"] : "FECHA RECLAMACION11";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion11'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion11'] = "cmp_maior_30_62";
       $tab_converte["cmp_maior_30_62"]   = "historial_reclamacion_motivo_no_reclamacion11";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion11'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION11";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION11"]   = "historial_reclamacion_motivo_no_reclamacion11";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion11"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion11"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion11"] : "MOTIVO NO RECLAMACION11";
   $tab_ger_campos['historial_reclamacion_mes12'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_mes12'] = "cmp_maior_30_63";
       $tab_converte["cmp_maior_30_63"]   = "historial_reclamacion_mes12";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_mes12'] = "historial_reclamacion.MES12";
       $tab_converte["historial_reclamacion.MES12"]   = "historial_reclamacion_mes12";
   }
   $tab_labels["historial_reclamacion_mes12"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes12"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_mes12"] : "MES12";
   $tab_ger_campos['historial_reclamacion_reclamo12'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_reclamo12'] = "cmp_maior_30_64";
       $tab_converte["cmp_maior_30_64"]   = "historial_reclamacion_reclamo12";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_reclamo12'] = "historial_reclamacion.RECLAMO12";
       $tab_converte["historial_reclamacion.RECLAMO12"]   = "historial_reclamacion_reclamo12";
   }
   $tab_labels["historial_reclamacion_reclamo12"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo12"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_reclamo12"] : "RECLAMO12";
   $tab_ger_campos['historial_reclamacion_fecha_reclamacion12'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion12'] = "cmp_maior_30_65";
       $tab_converte["cmp_maior_30_65"]   = "historial_reclamacion_fecha_reclamacion12";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_fecha_reclamacion12'] = "historial_reclamacion.FECHA_RECLAMACION12";
       $tab_converte["historial_reclamacion.FECHA_RECLAMACION12"]   = "historial_reclamacion_fecha_reclamacion12";
   }
   $tab_labels["historial_reclamacion_fecha_reclamacion12"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion12"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_fecha_reclamacion12"] : "FECHA RECLAMACION12";
   $tab_ger_campos['historial_reclamacion_motivo_no_reclamacion12'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion12'] = "cmp_maior_30_66";
       $tab_converte["cmp_maior_30_66"]   = "historial_reclamacion_motivo_no_reclamacion12";
   }
   else
   {
       $tab_def_campos['historial_reclamacion_motivo_no_reclamacion12'] = "historial_reclamacion.MOTIVO_NO_RECLAMACION12";
       $tab_converte["historial_reclamacion.MOTIVO_NO_RECLAMACION12"]   = "historial_reclamacion_motivo_no_reclamacion12";
   }
   $tab_labels["historial_reclamacion_motivo_no_reclamacion12"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion12"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['labels']["historial_reclamacion_motivo_no_reclamacion12"] : "MOTIVO NO RECLAMACION12";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['ordem_select'] = array();
   }
   
   if ($fsel_ok == "cmp")
   {
       $this->Sel_processa_out_sel($campos_sel);
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
function Sel_processa_out_sel($campos_sel)
{
   global $tab_ger_campos, $sc_init, $tab_def_campos, $tab_converte, $embbed;
   $arr_temp = array();
   $campos_sel = explode("@?@", $campos_sel);
   $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_converte[$campo]))
       {
           $_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['ordem_select'][$campo] = $ordem;
       }
   }
?>
    <script language="javascript"> 
<?php
   if (!$embbed)
   {
?>
      self.parent.tb_remove(); 
      parent.nm_gp_submit_ajax('inicio', ''); 
<?php
   }
   else
   {
?>
      nm_gp_submit_ajax('inicio', ''); 
<?php
   }
?>
   </script>
<?php
}
   
function Sel_processa_form()
{
  global $sc_init, $path_img, $path_btn, $tab_ger_campos, $tab_def_campos, $tab_converte, $tab_labels, $embbed, $tbar_pos;
   $size = 10;
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
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc8_Turquoise/Sc8_Turquoise";
   include("../_lib/css/" . $str_schema_all . "_grid.php");
   $Str_btn_grid = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
   include("../_lib/buttons/" . $Str_btn_grid);
   if (!function_exists("nmButtonOutput"))
   {
       include_once("../_lib/lib/php/nm_gp_config_btn.php");
   }
   if (!$embbed)
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Informe Reclamaciones Historial</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" /> 
</HEAD>
<BODY class="scGridPage" style="margin: 0px; overflow-x: hidden">
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>
<?php
   }
?>
<script language="javascript"> 
<?php
if ($embbed)
{
?>
  function scSubmitOrderCampos(sPos, sType) {
    $("#id_fsel_ok_sel_ord").val(sType);
    if(sType == 'cmp')
    {
       scPackSelectedOrd();
    }
   $.ajax({
    type: "POST",
    url: "Informe_reclamacion_historial_order_campos.php",
    data: {
     script_case_init: $("#id_script_case_init_sel_ord").val(),
     script_case_session: $("#id_script_case_session_sel_ord").val(),
     path_img: $("#id_path_img_sel_ord").val(),
     path_btn: $("#id_path_btn_sel_ord").val(),
     campos_sel: $("#id_campos_sel_sel_ord").val(),
     sel_regra: $("#id_sel_regra_sel_ord").val(),
     fsel_ok: $("#id_fsel_ok_sel_ord").val(),
     embbed_groupby: 'Y'
    }
   }).success(function(data) {
    $("#sc_id_order_campos_placeholder_" + sPos).find("td").html(data);
    scBtnOrderCamposHide(sPos);
   });
  }
<?php
}
?>
 // Submeter o formularior
 //-------------------------------------
 function submit_form_Fsel_ord()
 {
     scPackSelectedOrd();
      document.Fsel_ord.submit();
 }
 function scPackSelectedOrd() {
  var fieldList, fieldName, i, selectedFields = new Array;
 fieldList = $("#sc_id_fldord_selected").sortable("toArray");
 for (i = 0; i < fieldList.length; i++) {
  fieldName  = fieldList[i].substr(14);
  selectedFields.push($("#sc_id_class_" + fieldName).val() + fieldName);
 }
 $("#id_campos_sel_sel_ord").val( selectedFields.join("@?@") );
 }
 </script>
<FORM name="Fsel_ord" method="POST">
  <INPUT type="hidden" name="script_case_init"    id="id_script_case_init_sel_ord"    value="<?php echo NM_encode_input($sc_init); ?>"> 
  <INPUT type="hidden" name="script_case_session" id="id_script_case_session_sel_ord" value="<?php echo NM_encode_input(session_id()); ?>"> 
  <INPUT type="hidden" name="path_img"            id="id_path_img_sel_ord"            value="<?php echo NM_encode_input($path_img); ?>"> 
  <INPUT type="hidden" name="path_btn"            id="id_path_btn_sel_ord"            value="<?php echo NM_encode_input($path_btn); ?>"> 
  <INPUT type="hidden" name="fsel_ok"             id="id_fsel_ok_sel_ord"             value=""> 
<?php
if ($embbed)
{
    echo "<div class='scAppDivMoldura'>";
    echo "<table id=\"main_table\" style=\"width: 100%\" cellspacing=0 cellpadding=0>";
}
elseif ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; right: 20px\">";
}
else
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; left: 20px\">";
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
   <?php echo $this->Nm_lang['lang_btns_sort_hint']; ?>
  </td>
 </tr>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>">
   <table class="<?php echo ($embbed)? '':'scGridTabela'; ?>" style="border-width: 0; border-collapse: collapse; width:100%;" cellspacing=0 cellpadding=0>
    <tr class="<?php echo ($embbed)? '':'scGridFieldOddVert'; ?>">
     <td style="vertical-align: top">
     <table>
   <tr><td style="vertical-align: top">
 <script language="javascript" type="text/javascript">
  $(function() {
   $(".sc_ui_litem").mouseover(function() {
    $(this).css("cursor", "all-scroll");
   });
   $("#sc_id_fldord_available").sortable({
    connectWith: ".sc_ui_fldord_selected",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var fieldName = $(ui.item[0]).find("select").attr("id");
     $("#" + fieldName).show();
     $('#f_sel_sub').css('display', 'inline-block');
    }
   }).disableSelection();
   $("#sc_id_fldord_selected").sortable({
    connectWith: ".sc_ui_fldord_available",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var fieldName = $(ui.item[0]).find("select").attr("id");
     $("#" + fieldName).hide();
     $('#f_sel_sub').css('display', 'inline-block');
    }
   });
   scUpdateListHeight();
  });
  function scUpdateListHeight() {
   $("#sc_id_fldord_available").css("min-height", "<?php echo sizeof($tab_ger_campos) * 35 ?>px");
   $("#sc_id_fldord_selected").css("min-height", "<?php echo sizeof($tab_ger_campos) * 35 ?>px");
  }
 </script>
 <style type="text/css">
  .sc_ui_sortable_ord {
   list-style-type: none;
   margin: 0;
   min-width: 225px;
  }
  .sc_ui_sortable_ord li {
   margin: 0 3px 3px 3px;
   padding: 1px 3px 1px 15px;
   min-height: 28px;
  }
  .sc_ui_sortable_ord li span {
   position: absolute;
   margin-left: -1.3em;
  }
 </style>
    <ul class="sc_ui_sort_groupby sc_ui_sortable_ord sc_ui_fldord_available scAppDivSelectFields" id="sc_id_fldord_available">
<?php
   foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
   {
       if ($NM_cada_opc != "none")
       {
           if (!isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['ordem_select'][$tab_def_campos[$NM_cada_field]]))
           {
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemord_<?php echo NM_encode_input($tab_def_campos[$NM_cada_field]); ?>">
      <?php echo $tab_labels[$NM_cada_field]; ?>
      <select id="sc_id_class_<?php echo NM_encode_input($tab_def_campos[$NM_cada_field]); ?>" class="scAppDivToolbarInput" style="display: none">
       <option value="+">Asc</option>
       <option value="-">Desc</option>
      </select><br/>
     </li>
<?php
           }
       }
   }
?>
    </ul>
   </td>
   <td style="vertical-align: top">
    <ul class="sc_ui_sort_groupby sc_ui_sortable_ord sc_ui_fldord_selected scAppDivSelectFields" id="sc_id_fldord_selected">
<?php
   foreach ($_SESSION['sc_session'][$sc_init]['Informe_reclamacion_historial']['ordem_select'] as $NM_cada_field => $NM_cada_opc)
   {
       if (isset($tab_converte[$NM_cada_field]))
       {
           $sAscSelected  = " selected";
           $sDescSelected = "";
           if ($NM_cada_opc == "desc")
           {
               $sAscSelected  = "";
               $sDescSelected = " selected";
           }
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemord_<?php echo $NM_cada_field; ?>">
      <?php echo $tab_labels[$tab_converte[$NM_cada_field]]; ?>
      <select id="sc_id_class_<?php echo NM_encode_input($tab_def_campos[ $tab_converte[$NM_cada_field] ]); ?>" class="scAppDivToolbarInput" onchange="$('#f_sel_sub').css('display', 'inline-block');">
       <option value="+"<?php echo $sAscSelected; ?>>Asc</option>
       <option value="-"<?php echo $sDescSelected; ?>>Desc</option>
      </select>
     </li>
<?php
       }
   }
?>
    </ul>
    <input type="hidden" name="campos_sel" id="id_campos_sel_sel_ord" value="">
   </td>
   </tr>
   </table>
   </td>
   </tr>
   </table>
  </td>
 </tr>
   <tr><td class="<?php echo ($embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>">
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bok", "document.Fsel_ord.fsel_ok.value='cmp';submit_form_Fsel_ord()", "document.Fsel_ord.fsel_ok.value='cmp';submit_form_Fsel_ord()", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bapply", "scSubmitOrderCampos('" . NM_encode_input($tbar_pos) . "', 'cmp')", "scSubmitOrderCampos('" . NM_encode_input($tbar_pos) . "', 'cmp')", "f_sel_sub", "", "", "display: none;", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
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
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "')", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "')", "Bsair", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
   </td>
   </tr>
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
var bFixed = false;
function ajusta_window_Fsel_ord()
{
<?php
   if ($embbed)
   {
?>
  return false;
<?php
   }
?>
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window_Fsel_ord()", 50);
    return;
  }
  else if(!bFixed)
  {
    var oOrig = $(document.Fsel_ord.sel_orig),
        oDest = $(document.Fsel_ord.sel_dest),
        mHeight = Math.max(oOrig.height(), oDest.height()),
        mWidth = Math.max(oOrig.width() + 5, oDest.width() + 5);
    oOrig.height(mHeight);
    oOrig.width(mWidth);
    oDest.height(mHeight);
    oDest.width(mWidth + 15);
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
      self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
      setTimeout("ajusta_window_Fsel_ord()", 50);
      return;
    }
  }
  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
  self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
}
$( document ).ready(function() {
  ajusta_window_Fsel_ord();
});
</script>
<script>
    ajusta_window_Fsel_ord();
</script>
</BODY>
</HTML>
<?php
}
}

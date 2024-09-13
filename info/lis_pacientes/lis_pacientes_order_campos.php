<?php
   include_once('lis_pacientes_session.php');
   session_start();
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
    $Ord_Cmp = new lis_pacientes_Ord_cmp(); 
    $Ord_Cmp->Ord_cmp_init();
   
class lis_pacientes_Ord_cmp
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
   $tab_labels["pacientes_id_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_id_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_id_paciente"] : "ID PACIENTE";
   $tab_ger_campos['pacientes_estado_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_estado_paciente'] = "cmp_maior_30_1";
       $tab_converte["cmp_maior_30_1"]   = "pacientes_estado_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_estado_paciente'] = "pacientes.ESTADO_PACIENTE";
       $tab_converte["pacientes.ESTADO_PACIENTE"]   = "pacientes_estado_paciente";
   }
   $tab_labels["pacientes_estado_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_estado_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_estado_paciente"] : "ESTADO PACIENTE";
   $tab_ger_campos['pacientes_fecha_activacion_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_fecha_activacion_paciente'] = "cmp_maior_30_2";
       $tab_converte["cmp_maior_30_2"]   = "pacientes_fecha_activacion_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_fecha_activacion_paciente'] = "pacientes.FECHA_ACTIVACION_PACIENTE";
       $tab_converte["pacientes.FECHA_ACTIVACION_PACIENTE"]   = "pacientes_fecha_activacion_paciente";
   }
   $tab_labels["pacientes_fecha_activacion_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_fecha_activacion_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_fecha_activacion_paciente"] : "FECHA ACTIVACION PACIENTE";
   $tab_ger_campos['pacientes_fecha_retiro_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_fecha_retiro_paciente'] = "cmp_maior_30_3";
       $tab_converte["cmp_maior_30_3"]   = "pacientes_fecha_retiro_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_fecha_retiro_paciente'] = "pacientes.FECHA_RETIRO_PACIENTE";
       $tab_converte["pacientes.FECHA_RETIRO_PACIENTE"]   = "pacientes_fecha_retiro_paciente";
   }
   $tab_labels["pacientes_fecha_retiro_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_fecha_retiro_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_fecha_retiro_paciente"] : "FECHA RETIRO PACIENTE";
   $tab_ger_campos['pacientes_motivo_retiro_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_motivo_retiro_paciente'] = "cmp_maior_30_4";
       $tab_converte["cmp_maior_30_4"]   = "pacientes_motivo_retiro_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_motivo_retiro_paciente'] = "pacientes.MOTIVO_RETIRO_PACIENTE";
       $tab_converte["pacientes.MOTIVO_RETIRO_PACIENTE"]   = "pacientes_motivo_retiro_paciente";
   }
   $tab_labels["pacientes_motivo_retiro_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_motivo_retiro_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_motivo_retiro_paciente"] : "MOTIVO RETIRO PACIENTE";
   $tab_ger_campos['pacientes_observacion_motivo_retiro_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_observacion_motivo_retiro_paciente'] = "cmp_maior_30_5";
       $tab_converte["cmp_maior_30_5"]   = "pacientes_observacion_motivo_retiro_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_observacion_motivo_retiro_paciente'] = "pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE";
       $tab_converte["pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE"]   = "pacientes_observacion_motivo_retiro_paciente";
   }
   $tab_labels["pacientes_observacion_motivo_retiro_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_observacion_motivo_retiro_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_observacion_motivo_retiro_paciente"] : "OBSERVACION MOTIVO RETIRO PACIENTE";
   $tab_ger_campos['pacientes_identificacion_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_identificacion_paciente'] = "cmp_maior_30_6";
       $tab_converte["cmp_maior_30_6"]   = "pacientes_identificacion_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_identificacion_paciente'] = "pacientes.IDENTIFICACION_PACIENTE";
       $tab_converte["pacientes.IDENTIFICACION_PACIENTE"]   = "pacientes_identificacion_paciente";
   }
   $tab_labels["pacientes_identificacion_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_identificacion_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_identificacion_paciente"] : "IDENTIFICACION PACIENTE";
   $tab_ger_campos['pacientes_nombre_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_nombre_paciente'] = "cmp_maior_30_7";
       $tab_converte["cmp_maior_30_7"]   = "pacientes_nombre_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_nombre_paciente'] = "pacientes.NOMBRE_PACIENTE";
       $tab_converte["pacientes.NOMBRE_PACIENTE"]   = "pacientes_nombre_paciente";
   }
   $tab_labels["pacientes_nombre_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_nombre_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_nombre_paciente"] : "NOMBRE PACIENTE";
   $tab_ger_campos['pacientes_apellido_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_apellido_paciente'] = "cmp_maior_30_8";
       $tab_converte["cmp_maior_30_8"]   = "pacientes_apellido_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_apellido_paciente'] = "pacientes.APELLIDO_PACIENTE";
       $tab_converte["pacientes.APELLIDO_PACIENTE"]   = "pacientes_apellido_paciente";
   }
   $tab_labels["pacientes_apellido_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_apellido_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_apellido_paciente"] : "APELLIDO PACIENTE";
   $tab_ger_campos['pacientes_telefono_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_telefono_paciente'] = "cmp_maior_30_9";
       $tab_converte["cmp_maior_30_9"]   = "pacientes_telefono_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_telefono_paciente'] = "pacientes.TELEFONO_PACIENTE";
       $tab_converte["pacientes.TELEFONO_PACIENTE"]   = "pacientes_telefono_paciente";
   }
   $tab_labels["pacientes_telefono_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_telefono_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_telefono_paciente"] : "TELEFONO PACIENTE";
   $tab_ger_campos['pacientes_telefono2_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_telefono2_paciente'] = "cmp_maior_30_10";
       $tab_converte["cmp_maior_30_10"]   = "pacientes_telefono2_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_telefono2_paciente'] = "pacientes.TELEFONO2_PACIENTE";
       $tab_converte["pacientes.TELEFONO2_PACIENTE"]   = "pacientes_telefono2_paciente";
   }
   $tab_labels["pacientes_telefono2_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_telefono2_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_telefono2_paciente"] : "TELEFONO2 PACIENTE";
   $tab_ger_campos['pacientes_telefono3_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_telefono3_paciente'] = "cmp_maior_30_11";
       $tab_converte["cmp_maior_30_11"]   = "pacientes_telefono3_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_telefono3_paciente'] = "pacientes.TELEFONO3_PACIENTE";
       $tab_converte["pacientes.TELEFONO3_PACIENTE"]   = "pacientes_telefono3_paciente";
   }
   $tab_labels["pacientes_telefono3_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_telefono3_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_telefono3_paciente"] : "TELEFONO3 PACIENTE";
   $tab_ger_campos['pacientes_correo_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_correo_paciente'] = "cmp_maior_30_12";
       $tab_converte["cmp_maior_30_12"]   = "pacientes_correo_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_correo_paciente'] = "pacientes.CORREO_PACIENTE";
       $tab_converte["pacientes.CORREO_PACIENTE"]   = "pacientes_correo_paciente";
   }
   $tab_labels["pacientes_correo_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_correo_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_correo_paciente"] : "CORREO PACIENTE";
   $tab_ger_campos['pacientes_direccion_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_direccion_paciente'] = "cmp_maior_30_13";
       $tab_converte["cmp_maior_30_13"]   = "pacientes_direccion_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_direccion_paciente'] = "pacientes.DIRECCION_PACIENTE";
       $tab_converte["pacientes.DIRECCION_PACIENTE"]   = "pacientes_direccion_paciente";
   }
   $tab_labels["pacientes_direccion_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_direccion_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_direccion_paciente"] : "DIRECCION PACIENTE";
   $tab_ger_campos['pacientes_barrio_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_barrio_paciente'] = "cmp_maior_30_14";
       $tab_converte["cmp_maior_30_14"]   = "pacientes_barrio_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_barrio_paciente'] = "pacientes.BARRIO_PACIENTE";
       $tab_converte["pacientes.BARRIO_PACIENTE"]   = "pacientes_barrio_paciente";
   }
   $tab_labels["pacientes_barrio_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_barrio_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_barrio_paciente"] : "BARRIO PACIENTE";
   $tab_ger_campos['pacientes_departamento_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_departamento_paciente'] = "cmp_maior_30_15";
       $tab_converte["cmp_maior_30_15"]   = "pacientes_departamento_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_departamento_paciente'] = "pacientes.DEPARTAMENTO_PACIENTE";
       $tab_converte["pacientes.DEPARTAMENTO_PACIENTE"]   = "pacientes_departamento_paciente";
   }
   $tab_labels["pacientes_departamento_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_departamento_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_departamento_paciente"] : "DEPARTAMENTO PACIENTE";
   $tab_ger_campos['pacientes_ciudad_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_ciudad_paciente'] = "cmp_maior_30_16";
       $tab_converte["cmp_maior_30_16"]   = "pacientes_ciudad_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_ciudad_paciente'] = "pacientes.CIUDAD_PACIENTE";
       $tab_converte["pacientes.CIUDAD_PACIENTE"]   = "pacientes_ciudad_paciente";
   }
   $tab_labels["pacientes_ciudad_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_ciudad_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_ciudad_paciente"] : "CIUDAD PACIENTE";
   $tab_ger_campos['pacientes_genero_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_genero_paciente'] = "cmp_maior_30_17";
       $tab_converte["cmp_maior_30_17"]   = "pacientes_genero_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_genero_paciente'] = "pacientes.GENERO_PACIENTE";
       $tab_converte["pacientes.GENERO_PACIENTE"]   = "pacientes_genero_paciente";
   }
   $tab_labels["pacientes_genero_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_genero_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_genero_paciente"] : "GENERO PACIENTE";
   $tab_ger_campos['pacientes_fecha_nacimineto_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_fecha_nacimineto_paciente'] = "cmp_maior_30_18";
       $tab_converte["cmp_maior_30_18"]   = "pacientes_fecha_nacimineto_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_fecha_nacimineto_paciente'] = "pacientes.FECHA_NACIMINETO_PACIENTE";
       $tab_converte["pacientes.FECHA_NACIMINETO_PACIENTE"]   = "pacientes_fecha_nacimineto_paciente";
   }
   $tab_labels["pacientes_fecha_nacimineto_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_fecha_nacimineto_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_fecha_nacimineto_paciente"] : "FECHA NACIMINETO PACIENTE";
   $tab_ger_campos['pacientes_edad_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_edad_paciente'] = "pacientes_edad_paciente";
       $tab_converte["pacientes_edad_paciente"]   = "pacientes_edad_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_edad_paciente'] = "pacientes.EDAD_PACIENTE";
       $tab_converte["pacientes.EDAD_PACIENTE"]   = "pacientes_edad_paciente";
   }
   $tab_labels["pacientes_edad_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_edad_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_edad_paciente"] : "EDAD PACIENTE";
   $tab_ger_campos['pacientes_acudiente_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_acudiente_paciente'] = "cmp_maior_30_19";
       $tab_converte["cmp_maior_30_19"]   = "pacientes_acudiente_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_acudiente_paciente'] = "pacientes.ACUDIENTE_PACIENTE";
       $tab_converte["pacientes.ACUDIENTE_PACIENTE"]   = "pacientes_acudiente_paciente";
   }
   $tab_labels["pacientes_acudiente_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_acudiente_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_acudiente_paciente"] : "ACUDIENTE PACIENTE";
   $tab_ger_campos['pacientes_telefono_acudiente_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_telefono_acudiente_paciente'] = "cmp_maior_30_20";
       $tab_converte["cmp_maior_30_20"]   = "pacientes_telefono_acudiente_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_telefono_acudiente_paciente'] = "pacientes.TELEFONO_ACUDIENTE_PACIENTE";
       $tab_converte["pacientes.TELEFONO_ACUDIENTE_PACIENTE"]   = "pacientes_telefono_acudiente_paciente";
   }
   $tab_labels["pacientes_telefono_acudiente_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_telefono_acudiente_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_telefono_acudiente_paciente"] : "TELEFONO ACUDIENTE PACIENTE";
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
   $tab_labels["pacientes_codigo_xofigo"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_codigo_xofigo"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_codigo_xofigo"] : "CODIGO XOFIGO";
   $tab_ger_campos['pacientes_status_paciente'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_status_paciente'] = "cmp_maior_30_21";
       $tab_converte["cmp_maior_30_21"]   = "pacientes_status_paciente";
   }
   else
   {
       $tab_def_campos['pacientes_status_paciente'] = "pacientes.STATUS_PACIENTE";
       $tab_converte["pacientes.STATUS_PACIENTE"]   = "pacientes_status_paciente";
   }
   $tab_labels["pacientes_status_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_status_paciente"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_status_paciente"] : "STATUS PACIENTE";
   $tab_ger_campos['pacientes_id_ultima_gestion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_id_ultima_gestion'] = "cmp_maior_30_22";
       $tab_converte["cmp_maior_30_22"]   = "pacientes_id_ultima_gestion";
   }
   else
   {
       $tab_def_campos['pacientes_id_ultima_gestion'] = "pacientes.ID_ULTIMA_GESTION";
       $tab_converte["pacientes.ID_ULTIMA_GESTION"]   = "pacientes_id_ultima_gestion";
   }
   $tab_labels["pacientes_id_ultima_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_id_ultima_gestion"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_id_ultima_gestion"] : "ID ULTIMA GESTION";
   $tab_ger_campos['pacientes_usuario_creacion'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['pacientes_usuario_creacion'] = "cmp_maior_30_23";
       $tab_converte["cmp_maior_30_23"]   = "pacientes_usuario_creacion";
   }
   else
   {
       $tab_def_campos['pacientes_usuario_creacion'] = "pacientes.USUARIO_CREACION";
       $tab_converte["pacientes.USUARIO_CREACION"]   = "pacientes_usuario_creacion";
   }
   $tab_labels["pacientes_usuario_creacion"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_usuario_creacion"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["pacientes_usuario_creacion"] : "USUARIO CREACION";
   $tab_ger_campos['tratamiento_id_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_id_tratamiento'] = "cmp_maior_30_24";
       $tab_converte["cmp_maior_30_24"]   = "tratamiento_id_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_id_tratamiento'] = "tratamiento.ID_TRATAMIENTO";
       $tab_converte["tratamiento.ID_TRATAMIENTO"]   = "tratamiento_id_tratamiento";
   }
   $tab_labels["tratamiento_id_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_id_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_id_tratamiento"] : "ID TRATAMIENTO";
   $tab_ger_campos['tratamiento_producto_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_producto_tratamiento'] = "cmp_maior_30_25";
       $tab_converte["cmp_maior_30_25"]   = "tratamiento_producto_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_producto_tratamiento'] = "tratamiento.PRODUCTO_TRATAMIENTO";
       $tab_converte["tratamiento.PRODUCTO_TRATAMIENTO"]   = "tratamiento_producto_tratamiento";
   }
   $tab_labels["tratamiento_producto_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_producto_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_producto_tratamiento"] : "PRODUCTO TRATAMIENTO";
   $tab_ger_campos['tratamiento_nombre_referencia'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_nombre_referencia'] = "cmp_maior_30_26";
       $tab_converte["cmp_maior_30_26"]   = "tratamiento_nombre_referencia";
   }
   else
   {
       $tab_def_campos['tratamiento_nombre_referencia'] = "tratamiento.NOMBRE_REFERENCIA";
       $tab_converte["tratamiento.NOMBRE_REFERENCIA"]   = "tratamiento_nombre_referencia";
   }
   $tab_labels["tratamiento_nombre_referencia"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_nombre_referencia"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_nombre_referencia"] : "NOMBRE REFERENCIA";
   $tab_ger_campos['tratamiento_clasificacion_patologica_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_clasificacion_patologica_tratamiento'] = "cmp_maior_30_27";
       $tab_converte["cmp_maior_30_27"]   = "tratamiento_clasificacion_patologica_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_clasificacion_patologica_tratamiento'] = "tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO";
       $tab_converte["tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO"]   = "tratamiento_clasificacion_patologica_tratamiento";
   }
   $tab_labels["tratamiento_clasificacion_patologica_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_clasificacion_patologica_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_clasificacion_patologica_tratamiento"] : "CLASIFICACION PATOLOGICA TRATAMIENTO";
   $tab_ger_campos['tratamiento_tratamiento_previo'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_tratamiento_previo'] = "cmp_maior_30_28";
       $tab_converte["cmp_maior_30_28"]   = "tratamiento_tratamiento_previo";
   }
   else
   {
       $tab_def_campos['tratamiento_tratamiento_previo'] = "tratamiento.TRATAMIENTO_PREVIO";
       $tab_converte["tratamiento.TRATAMIENTO_PREVIO"]   = "tratamiento_tratamiento_previo";
   }
   $tab_labels["tratamiento_tratamiento_previo"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_tratamiento_previo"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_tratamiento_previo"] : "TRATAMIENTO PREVIO";
   $tab_ger_campos['tratamiento_consentimiento_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_consentimiento_tratamiento'] = "cmp_maior_30_29";
       $tab_converte["cmp_maior_30_29"]   = "tratamiento_consentimiento_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_consentimiento_tratamiento'] = "tratamiento.CONSENTIMIENTO_TRATAMIENTO";
       $tab_converte["tratamiento.CONSENTIMIENTO_TRATAMIENTO"]   = "tratamiento_consentimiento_tratamiento";
   }
   $tab_labels["tratamiento_consentimiento_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_consentimiento_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_consentimiento_tratamiento"] : "CONSENTIMIENTO TRATAMIENTO";
   $tab_ger_campos['tratamiento_fecha_inicio_terapia_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_fecha_inicio_terapia_tratamiento'] = "cmp_maior_30_30";
       $tab_converte["cmp_maior_30_30"]   = "tratamiento_fecha_inicio_terapia_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_fecha_inicio_terapia_tratamiento'] = "tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO";
       $tab_converte["tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO"]   = "tratamiento_fecha_inicio_terapia_tratamiento";
   }
   $tab_labels["tratamiento_fecha_inicio_terapia_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_fecha_inicio_terapia_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_fecha_inicio_terapia_tratamiento"] : "FECHA INICIO TERAPIA TRATAMIENTO";
   $tab_ger_campos['tratamiento_regimen_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_regimen_tratamiento'] = "cmp_maior_30_31";
       $tab_converte["cmp_maior_30_31"]   = "tratamiento_regimen_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_regimen_tratamiento'] = "tratamiento.REGIMEN_TRATAMIENTO";
       $tab_converte["tratamiento.REGIMEN_TRATAMIENTO"]   = "tratamiento_regimen_tratamiento";
   }
   $tab_labels["tratamiento_regimen_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_regimen_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_regimen_tratamiento"] : "REGIMEN TRATAMIENTO";
   $tab_ger_campos['tratamiento_asegurador_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_asegurador_tratamiento'] = "cmp_maior_30_32";
       $tab_converte["cmp_maior_30_32"]   = "tratamiento_asegurador_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_asegurador_tratamiento'] = "tratamiento.ASEGURADOR_TRATAMIENTO";
       $tab_converte["tratamiento.ASEGURADOR_TRATAMIENTO"]   = "tratamiento_asegurador_tratamiento";
   }
   $tab_labels["tratamiento_asegurador_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_asegurador_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_asegurador_tratamiento"] : "ASEGURADOR TRATAMIENTO";
   $tab_ger_campos['tratamiento_operador_logistico_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_operador_logistico_tratamiento'] = "cmp_maior_30_33";
       $tab_converte["cmp_maior_30_33"]   = "tratamiento_operador_logistico_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_operador_logistico_tratamiento'] = "tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO";
       $tab_converte["tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO"]   = "tratamiento_operador_logistico_tratamiento";
   }
   $tab_labels["tratamiento_operador_logistico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_operador_logistico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_operador_logistico_tratamiento"] : "OPERADOR LOGISTICO TRATAMIENTO";
   $tab_ger_campos['tratamiento_punto_entrega'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_punto_entrega'] = "cmp_maior_30_34";
       $tab_converte["cmp_maior_30_34"]   = "tratamiento_punto_entrega";
   }
   else
   {
       $tab_def_campos['tratamiento_punto_entrega'] = "tratamiento.PUNTO_ENTREGA";
       $tab_converte["tratamiento.PUNTO_ENTREGA"]   = "tratamiento_punto_entrega";
   }
   $tab_labels["tratamiento_punto_entrega"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_punto_entrega"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_punto_entrega"] : "PUNTO ENTREGA";
   $tab_ger_campos['tratamiento_fecha_ultima_reclamacion_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_fecha_ultima_reclamacion_tratamiento'] = "cmp_maior_30_35";
       $tab_converte["cmp_maior_30_35"]   = "tratamiento_fecha_ultima_reclamacion_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_fecha_ultima_reclamacion_tratamiento'] = "tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO";
       $tab_converte["tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO"]   = "tratamiento_fecha_ultima_reclamacion_tratamiento";
   }
   $tab_labels["tratamiento_fecha_ultima_reclamacion_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_fecha_ultima_reclamacion_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_fecha_ultima_reclamacion_tratamiento"] : "FECHA ULTIMA RECLAMACION TRATAMIENTO";
   $tab_ger_campos['tratamiento_otros_operadores_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_otros_operadores_tratamiento'] = "cmp_maior_30_36";
       $tab_converte["cmp_maior_30_36"]   = "tratamiento_otros_operadores_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_otros_operadores_tratamiento'] = "tratamiento.OTROS_OPERADORES_TRATAMIENTO";
       $tab_converte["tratamiento.OTROS_OPERADORES_TRATAMIENTO"]   = "tratamiento_otros_operadores_tratamiento";
   }
   $tab_labels["tratamiento_otros_operadores_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_otros_operadores_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_otros_operadores_tratamiento"] : "OTROS OPERADORES TRATAMIENTO";
   $tab_ger_campos['tratamiento_medios_adquisicion_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_medios_adquisicion_tratamiento'] = "cmp_maior_30_37";
       $tab_converte["cmp_maior_30_37"]   = "tratamiento_medios_adquisicion_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_medios_adquisicion_tratamiento'] = "tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO";
       $tab_converte["tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO"]   = "tratamiento_medios_adquisicion_tratamiento";
   }
   $tab_labels["tratamiento_medios_adquisicion_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_medios_adquisicion_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_medios_adquisicion_tratamiento"] : "MEDIOS ADQUISICION TRATAMIENTO";
   $tab_ger_campos['tratamiento_ips_atiende_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_ips_atiende_tratamiento'] = "cmp_maior_30_38";
       $tab_converte["cmp_maior_30_38"]   = "tratamiento_ips_atiende_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_ips_atiende_tratamiento'] = "tratamiento.IPS_ATIENDE_TRATAMIENTO";
       $tab_converte["tratamiento.IPS_ATIENDE_TRATAMIENTO"]   = "tratamiento_ips_atiende_tratamiento";
   }
   $tab_labels["tratamiento_ips_atiende_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_ips_atiende_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_ips_atiende_tratamiento"] : "IPS ATIENDE TRATAMIENTO";
   $tab_ger_campos['tratamiento_medico_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_medico_tratamiento'] = "cmp_maior_30_39";
       $tab_converte["cmp_maior_30_39"]   = "tratamiento_medico_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_medico_tratamiento'] = "tratamiento.MEDICO_TRATAMIENTO";
       $tab_converte["tratamiento.MEDICO_TRATAMIENTO"]   = "tratamiento_medico_tratamiento";
   }
   $tab_labels["tratamiento_medico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_medico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_medico_tratamiento"] : "MEDICO TRATAMIENTO";
   $tab_ger_campos['tratamiento_especialidad_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_especialidad_tratamiento'] = "cmp_maior_30_40";
       $tab_converte["cmp_maior_30_40"]   = "tratamiento_especialidad_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_especialidad_tratamiento'] = "tratamiento.ESPECIALIDAD_TRATAMIENTO";
       $tab_converte["tratamiento.ESPECIALIDAD_TRATAMIENTO"]   = "tratamiento_especialidad_tratamiento";
   }
   $tab_labels["tratamiento_especialidad_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_especialidad_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_especialidad_tratamiento"] : "ESPECIALIDAD TRATAMIENTO";
   $tab_ger_campos['tratamiento_paramedico_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_paramedico_tratamiento'] = "cmp_maior_30_41";
       $tab_converte["cmp_maior_30_41"]   = "tratamiento_paramedico_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_paramedico_tratamiento'] = "tratamiento.PARAMEDICO_TRATAMIENTO";
       $tab_converte["tratamiento.PARAMEDICO_TRATAMIENTO"]   = "tratamiento_paramedico_tratamiento";
   }
   $tab_labels["tratamiento_paramedico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_paramedico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_paramedico_tratamiento"] : "PARAMEDICO TRATAMIENTO";
   $tab_ger_campos['tratamiento_zona_atencion_paramedico_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_zona_atencion_paramedico_tratamiento'] = "cmp_maior_30_42";
       $tab_converte["cmp_maior_30_42"]   = "tratamiento_zona_atencion_paramedico_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_zona_atencion_paramedico_tratamiento'] = "tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO";
       $tab_converte["tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO"]   = "tratamiento_zona_atencion_paramedico_tratamiento";
   }
   $tab_labels["tratamiento_zona_atencion_paramedico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_zona_atencion_paramedico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_zona_atencion_paramedico_tratamiento"] : "ZONA ATENCION PARAMEDICO TRATAMIENTO";
   $tab_ger_campos['tratamiento_ciudad_base_paramedico_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_ciudad_base_paramedico_tratamiento'] = "cmp_maior_30_43";
       $tab_converte["cmp_maior_30_43"]   = "tratamiento_ciudad_base_paramedico_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_ciudad_base_paramedico_tratamiento'] = "tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO";
       $tab_converte["tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO"]   = "tratamiento_ciudad_base_paramedico_tratamiento";
   }
   $tab_labels["tratamiento_ciudad_base_paramedico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_ciudad_base_paramedico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_ciudad_base_paramedico_tratamiento"] : "CIUDAD BASE PARAMEDICO TRATAMIENTO";
   $tab_ger_campos['tratamiento_notas_adjuntos_tratamiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['tratamiento_notas_adjuntos_tratamiento'] = "cmp_maior_30_44";
       $tab_converte["cmp_maior_30_44"]   = "tratamiento_notas_adjuntos_tratamiento";
   }
   else
   {
       $tab_def_campos['tratamiento_notas_adjuntos_tratamiento'] = "tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO";
       $tab_converte["tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO"]   = "tratamiento_notas_adjuntos_tratamiento";
   }
   $tab_labels["tratamiento_notas_adjuntos_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_notas_adjuntos_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['lis_pacientes']['labels']["tratamiento_notas_adjuntos_tratamiento"] : "NOTAS ADJUNTOS TRATAMIENTO";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['lis_pacientes']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['lis_pacientes']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['lis_pacientes']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['lis_pacientes']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['lis_pacientes']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['lis_pacientes']['ordem_select'] = array();
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
   $_SESSION['sc_session'][$sc_init]['lis_pacientes']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['lis_pacientes']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['lis_pacientes']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_converte[$campo]))
       {
           $_SESSION['sc_session'][$sc_init]['lis_pacientes']['ordem_select'][$campo] = $ordem;
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
 <TITLE>Listado Pacientes</TITLE>
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
    url: "lis_pacientes_order_campos.php",
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
           if (!isset($_SESSION['sc_session'][$sc_init]['lis_pacientes']['ordem_select'][$tab_def_campos[$NM_cada_field]]))
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
   foreach ($_SESSION['sc_session'][$sc_init]['lis_pacientes']['ordem_select'] as $NM_cada_field => $NM_cada_opc)
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

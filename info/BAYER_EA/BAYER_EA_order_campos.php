<?php
   include_once('EA_session.php');
   session_start();
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
    $Ord_Cmp = new EA_Ord_cmp(); 
    $Ord_Cmp->Ord_cmp_init();
   
class EA_Ord_cmp
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
   $tab_ger_campos['evento_adverso_id_evento_adverso'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_id_evento_adverso'] = "cmp_maior_30_1";
       $tab_converte["cmp_maior_30_1"]   = "evento_adverso_id_evento_adverso";
   }
   else
   {
       $tab_def_campos['evento_adverso_id_evento_adverso'] = "evento_adverso.ID_EVENTO_ADVERSO";
       $tab_converte["evento_adverso.ID_EVENTO_ADVERSO"]   = "evento_adverso_id_evento_adverso";
   }
   $tab_labels["evento_adverso_id_evento_adverso"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_id_evento_adverso"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_id_evento_adverso"] : "ID EVENTO ADVERSO";
   $tab_ger_campos['evento_adverso_pais'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_pais'] = "evento_adverso_pais";
       $tab_converte["evento_adverso_pais"]   = "evento_adverso_pais";
   }
   else
   {
       $tab_def_campos['evento_adverso_pais'] = "evento_adverso.PAIS";
       $tab_converte["evento_adverso.PAIS"]   = "evento_adverso_pais";
   }
   $tab_labels["evento_adverso_pais"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_pais"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_pais"] : "PAIS";
   $tab_ger_campos['evento_adverso_tipo_reporte'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_tipo_reporte'] = "cmp_maior_30_2";
       $tab_converte["cmp_maior_30_2"]   = "evento_adverso_tipo_reporte";
   }
   else
   {
       $tab_def_campos['evento_adverso_tipo_reporte'] = "evento_adverso.TIPO_REPORTE";
       $tab_converte["evento_adverso.TIPO_REPORTE"]   = "evento_adverso_tipo_reporte";
   }
   $tab_labels["evento_adverso_tipo_reporte"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tipo_reporte"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tipo_reporte"] : "TIPO REPORTE";
   $tab_ger_campos['evento_adverso_fecha_staff'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_staff'] = "cmp_maior_30_3";
       $tab_converte["cmp_maior_30_3"]   = "evento_adverso_fecha_staff";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_staff'] = "evento_adverso.FECHA_STAFF";
       $tab_converte["evento_adverso.FECHA_STAFF"]   = "evento_adverso_fecha_staff";
   }
   $tab_labels["evento_adverso_fecha_staff"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_staff"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_staff"] : "FECHA STAFF";
   $tab_ger_campos['evento_adverso_producto'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_producto'] = "evento_adverso_producto";
       $tab_converte["evento_adverso_producto"]   = "evento_adverso_producto";
   }
   else
   {
       $tab_def_campos['evento_adverso_producto'] = "evento_adverso.PRODUCTO";
       $tab_converte["evento_adverso.PRODUCTO"]   = "evento_adverso_producto";
   }
   $tab_labels["evento_adverso_producto"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_producto"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_producto"] : "PRODUCTO";
   $tab_ger_campos['evento_adverso_ciudad'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_ciudad'] = "evento_adverso_ciudad";
       $tab_converte["evento_adverso_ciudad"]   = "evento_adverso_ciudad";
   }
   else
   {
       $tab_def_campos['evento_adverso_ciudad'] = "evento_adverso.CIUDAD";
       $tab_converte["evento_adverso.CIUDAD"]   = "evento_adverso_ciudad";
   }
   $tab_labels["evento_adverso_ciudad"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_ciudad"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_ciudad"] : "CIUDAD";
   $tab_ger_campos['evento_adverso_genero'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_genero'] = "evento_adverso_genero";
       $tab_converte["evento_adverso_genero"]   = "evento_adverso_genero";
   }
   else
   {
       $tab_def_campos['evento_adverso_genero'] = "evento_adverso.GENERO";
       $tab_converte["evento_adverso.GENERO"]   = "evento_adverso_genero";
   }
   $tab_labels["evento_adverso_genero"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_genero"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_genero"] : "GENERO";
   $tab_ger_campos['evento_adverso_fecha_nacimiento'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_nacimiento'] = "cmp_maior_30_4";
       $tab_converte["cmp_maior_30_4"]   = "evento_adverso_fecha_nacimiento";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_nacimiento'] = "evento_adverso.FECHA_NACIMIENTO";
       $tab_converte["evento_adverso.FECHA_NACIMIENTO"]   = "evento_adverso_fecha_nacimiento";
   }
   $tab_labels["evento_adverso_fecha_nacimiento"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_nacimiento"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_nacimiento"] : "FECHA NACIMIENTO";
   $tab_ger_campos['evento_adverso_embarazo'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_embarazo'] = "evento_adverso_embarazo";
       $tab_converte["evento_adverso_embarazo"]   = "evento_adverso_embarazo";
   }
   else
   {
       $tab_def_campos['evento_adverso_embarazo'] = "evento_adverso.EMBARAZO";
       $tab_converte["evento_adverso.EMBARAZO"]   = "evento_adverso_embarazo";
   }
   $tab_labels["evento_adverso_embarazo"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_embarazo"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_embarazo"] : "EMBARAZO";
   $tab_ger_campos['evento_adverso_fecha_parto'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_parto'] = "cmp_maior_30_5";
       $tab_converte["cmp_maior_30_5"]   = "evento_adverso_fecha_parto";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_parto'] = "evento_adverso.FECHA_PARTO";
       $tab_converte["evento_adverso.FECHA_PARTO"]   = "evento_adverso_fecha_parto";
   }
   $tab_labels["evento_adverso_fecha_parto"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_parto"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_parto"] : "FECHA PARTO";
   $tab_ger_campos['evento_adverso_desenlace'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_desenlace'] = "evento_adverso_desenlace";
       $tab_converte["evento_adverso_desenlace"]   = "evento_adverso_desenlace";
   }
   else
   {
       $tab_def_campos['evento_adverso_desenlace'] = "evento_adverso.DESENLACE";
       $tab_converte["evento_adverso.DESENLACE"]   = "evento_adverso_desenlace";
   }
   $tab_labels["evento_adverso_desenlace"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_desenlace"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_desenlace"] : "DESENLACE";
   $tab_ger_campos['evento_adverso_cuales_desenlaces'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_cuales_desenlaces'] = "cmp_maior_30_6";
       $tab_converte["cmp_maior_30_6"]   = "evento_adverso_cuales_desenlaces";
   }
   else
   {
       $tab_def_campos['evento_adverso_cuales_desenlaces'] = "evento_adverso.CUALES_DESENLACES";
       $tab_converte["evento_adverso.CUALES_DESENLACES"]   = "evento_adverso_cuales_desenlaces";
   }
   $tab_labels["evento_adverso_cuales_desenlaces"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_cuales_desenlaces"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_cuales_desenlaces"] : "CUALES DESENLACES";
   $tab_ger_campos['evento_adverso_contacto_directo'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_contacto_directo'] = "cmp_maior_30_7";
       $tab_converte["cmp_maior_30_7"]   = "evento_adverso_contacto_directo";
   }
   else
   {
       $tab_def_campos['evento_adverso_contacto_directo'] = "evento_adverso.CONTACTO_DIRECTO";
       $tab_converte["evento_adverso.CONTACTO_DIRECTO"]   = "evento_adverso_contacto_directo";
   }
   $tab_labels["evento_adverso_contacto_directo"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_contacto_directo"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_contacto_directo"] : "CONTACTO DIRECTO";
   $tab_ger_campos['evento_adverso_nombre_medico'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_nombre_medico'] = "cmp_maior_30_8";
       $tab_converte["cmp_maior_30_8"]   = "evento_adverso_nombre_medico";
   }
   else
   {
       $tab_def_campos['evento_adverso_nombre_medico'] = "evento_adverso.NOMBRE_MEDICO";
       $tab_converte["evento_adverso.NOMBRE_MEDICO"]   = "evento_adverso_nombre_medico";
   }
   $tab_labels["evento_adverso_nombre_medico"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_nombre_medico"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_nombre_medico"] : "NOMBRE MEDICO";
   $tab_ger_campos['evento_adverso_telefono_medico'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_telefono_medico'] = "cmp_maior_30_9";
       $tab_converte["cmp_maior_30_9"]   = "evento_adverso_telefono_medico";
   }
   else
   {
       $tab_def_campos['evento_adverso_telefono_medico'] = "evento_adverso.TELEFONO_MEDICO";
       $tab_converte["evento_adverso.TELEFONO_MEDICO"]   = "evento_adverso_telefono_medico";
   }
   $tab_labels["evento_adverso_telefono_medico"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_telefono_medico"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_telefono_medico"] : "TELEFONO MEDICO";
   $tab_ger_campos['evento_adverso_fax_medico'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fax_medico'] = "cmp_maior_30_10";
       $tab_converte["cmp_maior_30_10"]   = "evento_adverso_fax_medico";
   }
   else
   {
       $tab_def_campos['evento_adverso_fax_medico'] = "evento_adverso.FAX_MEDICO";
       $tab_converte["evento_adverso.FAX_MEDICO"]   = "evento_adverso_fax_medico";
   }
   $tab_labels["evento_adverso_fax_medico"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fax_medico"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fax_medico"] : "FAX MEDICO";
   $tab_ger_campos['evento_adverso_email_medico'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_email_medico'] = "cmp_maior_30_11";
       $tab_converte["cmp_maior_30_11"]   = "evento_adverso_email_medico";
   }
   else
   {
       $tab_def_campos['evento_adverso_email_medico'] = "evento_adverso.EMAIL_MEDICO";
       $tab_converte["evento_adverso.EMAIL_MEDICO"]   = "evento_adverso_email_medico";
   }
   $tab_labels["evento_adverso_email_medico"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_email_medico"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_email_medico"] : "EMAIL MEDICO";
   $tab_ger_campos['evento_adverso_indicacion1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_indicacion1'] = "cmp_maior_30_12";
       $tab_converte["cmp_maior_30_12"]   = "evento_adverso_indicacion1";
   }
   else
   {
       $tab_def_campos['evento_adverso_indicacion1'] = "evento_adverso.INDICACION1";
       $tab_converte["evento_adverso.INDICACION1"]   = "evento_adverso_indicacion1";
   }
   $tab_labels["evento_adverso_indicacion1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_indicacion1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_indicacion1"] : "INDICACION1";
   $tab_ger_campos['evento_adverso_formulacion1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_formulacion1'] = "cmp_maior_30_13";
       $tab_converte["cmp_maior_30_13"]   = "evento_adverso_formulacion1";
   }
   else
   {
       $tab_def_campos['evento_adverso_formulacion1'] = "evento_adverso.FORMULACION1";
       $tab_converte["evento_adverso.FORMULACION1"]   = "evento_adverso_formulacion1";
   }
   $tab_labels["evento_adverso_formulacion1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_formulacion1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_formulacion1"] : "FORMULACION1";
   $tab_ger_campos['evento_adverso_regimen_dosis1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_regimen_dosis1'] = "cmp_maior_30_14";
       $tab_converte["cmp_maior_30_14"]   = "evento_adverso_regimen_dosis1";
   }
   else
   {
       $tab_def_campos['evento_adverso_regimen_dosis1'] = "evento_adverso.REGIMEN_DOSIS1";
       $tab_converte["evento_adverso.REGIMEN_DOSIS1"]   = "evento_adverso_regimen_dosis1";
   }
   $tab_labels["evento_adverso_regimen_dosis1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_regimen_dosis1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_regimen_dosis1"] : "REGIMEN DOSIS1";
   $tab_ger_campos['evento_adverso_ruta_administracion1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_ruta_administracion1'] = "cmp_maior_30_15";
       $tab_converte["cmp_maior_30_15"]   = "evento_adverso_ruta_administracion1";
   }
   else
   {
       $tab_def_campos['evento_adverso_ruta_administracion1'] = "evento_adverso.RUTA_ADMINISTRACION1";
       $tab_converte["evento_adverso.RUTA_ADMINISTRACION1"]   = "evento_adverso_ruta_administracion1";
   }
   $tab_labels["evento_adverso_ruta_administracion1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_ruta_administracion1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_ruta_administracion1"] : "RUTA ADMINISTRACION1";
   $tab_ger_campos['evento_adverso_numero_lote1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_numero_lote1'] = "cmp_maior_30_16";
       $tab_converte["cmp_maior_30_16"]   = "evento_adverso_numero_lote1";
   }
   else
   {
       $tab_def_campos['evento_adverso_numero_lote1'] = "evento_adverso.NUMERO_LOTE1";
       $tab_converte["evento_adverso.NUMERO_LOTE1"]   = "evento_adverso_numero_lote1";
   }
   $tab_labels["evento_adverso_numero_lote1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_numero_lote1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_numero_lote1"] : "NUMERO LOTE1";
   $tab_ger_campos['evento_adverso_fecha_expiracion1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_expiracion1'] = "cmp_maior_30_17";
       $tab_converte["cmp_maior_30_17"]   = "evento_adverso_fecha_expiracion1";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_expiracion1'] = "evento_adverso.FECHA_EXPIRACION1";
       $tab_converte["evento_adverso.FECHA_EXPIRACION1"]   = "evento_adverso_fecha_expiracion1";
   }
   $tab_labels["evento_adverso_fecha_expiracion1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_expiracion1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_expiracion1"] : "FECHA EXPIRACION1";
   $tab_ger_campos['evento_adverso_fecha_inicio1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_inicio1'] = "cmp_maior_30_18";
       $tab_converte["cmp_maior_30_18"]   = "evento_adverso_fecha_inicio1";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_inicio1'] = "evento_adverso.FECHA_INICIO1";
       $tab_converte["evento_adverso.FECHA_INICIO1"]   = "evento_adverso_fecha_inicio1";
   }
   $tab_labels["evento_adverso_fecha_inicio1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio1"] : "FECHA INICIO1";
   $tab_ger_campos['evento_adverso_tratamiento_continua1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_tratamiento_continua1'] = "cmp_maior_30_19";
       $tab_converte["cmp_maior_30_19"]   = "evento_adverso_tratamiento_continua1";
   }
   else
   {
       $tab_def_campos['evento_adverso_tratamiento_continua1'] = "evento_adverso.TRATAMIENTO_CONTINUA1";
       $tab_converte["evento_adverso.TRATAMIENTO_CONTINUA1"]   = "evento_adverso_tratamiento_continua1";
   }
   $tab_labels["evento_adverso_tratamiento_continua1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tratamiento_continua1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tratamiento_continua1"] : "TRATAMIENTO CONTINUA1";
   $tab_ger_campos['evento_adverso_indicacion2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_indicacion2'] = "cmp_maior_30_20";
       $tab_converte["cmp_maior_30_20"]   = "evento_adverso_indicacion2";
   }
   else
   {
       $tab_def_campos['evento_adverso_indicacion2'] = "evento_adverso.INDICACION2";
       $tab_converte["evento_adverso.INDICACION2"]   = "evento_adverso_indicacion2";
   }
   $tab_labels["evento_adverso_indicacion2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_indicacion2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_indicacion2"] : "INDICACION2";
   $tab_ger_campos['evento_adverso_formulacion2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_formulacion2'] = "cmp_maior_30_21";
       $tab_converte["cmp_maior_30_21"]   = "evento_adverso_formulacion2";
   }
   else
   {
       $tab_def_campos['evento_adverso_formulacion2'] = "evento_adverso.FORMULACION2";
       $tab_converte["evento_adverso.FORMULACION2"]   = "evento_adverso_formulacion2";
   }
   $tab_labels["evento_adverso_formulacion2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_formulacion2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_formulacion2"] : "FORMULACION2";
   $tab_ger_campos['evento_adverso_regimen_dosis2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_regimen_dosis2'] = "cmp_maior_30_22";
       $tab_converte["cmp_maior_30_22"]   = "evento_adverso_regimen_dosis2";
   }
   else
   {
       $tab_def_campos['evento_adverso_regimen_dosis2'] = "evento_adverso.REGIMEN_DOSIS2";
       $tab_converte["evento_adverso.REGIMEN_DOSIS2"]   = "evento_adverso_regimen_dosis2";
   }
   $tab_labels["evento_adverso_regimen_dosis2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_regimen_dosis2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_regimen_dosis2"] : "REGIMEN DOSIS2";
   $tab_ger_campos['evento_adverso_ruta_administracion2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_ruta_administracion2'] = "cmp_maior_30_23";
       $tab_converte["cmp_maior_30_23"]   = "evento_adverso_ruta_administracion2";
   }
   else
   {
       $tab_def_campos['evento_adverso_ruta_administracion2'] = "evento_adverso.RUTA_ADMINISTRACION2";
       $tab_converte["evento_adverso.RUTA_ADMINISTRACION2"]   = "evento_adverso_ruta_administracion2";
   }
   $tab_labels["evento_adverso_ruta_administracion2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_ruta_administracion2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_ruta_administracion2"] : "RUTA ADMINISTRACION2";
   $tab_ger_campos['evento_adverso_numero_lote2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_numero_lote2'] = "cmp_maior_30_24";
       $tab_converte["cmp_maior_30_24"]   = "evento_adverso_numero_lote2";
   }
   else
   {
       $tab_def_campos['evento_adverso_numero_lote2'] = "evento_adverso.NUMERO_LOTE2";
       $tab_converte["evento_adverso.NUMERO_LOTE2"]   = "evento_adverso_numero_lote2";
   }
   $tab_labels["evento_adverso_numero_lote2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_numero_lote2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_numero_lote2"] : "NUMERO LOTE2";
   $tab_ger_campos['evento_adverso_fecha_expiracion2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_expiracion2'] = "cmp_maior_30_25";
       $tab_converte["cmp_maior_30_25"]   = "evento_adverso_fecha_expiracion2";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_expiracion2'] = "evento_adverso.FECHA_EXPIRACION2";
       $tab_converte["evento_adverso.FECHA_EXPIRACION2"]   = "evento_adverso_fecha_expiracion2";
   }
   $tab_labels["evento_adverso_fecha_expiracion2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_expiracion2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_expiracion2"] : "FECHA EXPIRACION2";
   $tab_ger_campos['evento_adverso_fecha_inicio2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_inicio2'] = "cmp_maior_30_26";
       $tab_converte["cmp_maior_30_26"]   = "evento_adverso_fecha_inicio2";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_inicio2'] = "evento_adverso.FECHA_INICIO2";
       $tab_converte["evento_adverso.FECHA_INICIO2"]   = "evento_adverso_fecha_inicio2";
   }
   $tab_labels["evento_adverso_fecha_inicio2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio2"] : "FECHA INICIO2";
   $tab_ger_campos['evento_adverso_tratamiento_continua2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_tratamiento_continua2'] = "cmp_maior_30_27";
       $tab_converte["cmp_maior_30_27"]   = "evento_adverso_tratamiento_continua2";
   }
   else
   {
       $tab_def_campos['evento_adverso_tratamiento_continua2'] = "evento_adverso.TRATAMIENTO_CONTINUA2";
       $tab_converte["evento_adverso.TRATAMIENTO_CONTINUA2"]   = "evento_adverso_tratamiento_continua2";
   }
   $tab_labels["evento_adverso_tratamiento_continua2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tratamiento_continua2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tratamiento_continua2"] : "TRATAMIENTO CONTINUA2";
   $tab_ger_campos['evento_adverso_indicacion3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_indicacion3'] = "cmp_maior_30_28";
       $tab_converte["cmp_maior_30_28"]   = "evento_adverso_indicacion3";
   }
   else
   {
       $tab_def_campos['evento_adverso_indicacion3'] = "evento_adverso.INDICACION3";
       $tab_converte["evento_adverso.INDICACION3"]   = "evento_adverso_indicacion3";
   }
   $tab_labels["evento_adverso_indicacion3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_indicacion3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_indicacion3"] : "INDICACION3";
   $tab_ger_campos['evento_adverso_formulacion3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_formulacion3'] = "cmp_maior_30_29";
       $tab_converte["cmp_maior_30_29"]   = "evento_adverso_formulacion3";
   }
   else
   {
       $tab_def_campos['evento_adverso_formulacion3'] = "evento_adverso.FORMULACION3";
       $tab_converte["evento_adverso.FORMULACION3"]   = "evento_adverso_formulacion3";
   }
   $tab_labels["evento_adverso_formulacion3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_formulacion3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_formulacion3"] : "FORMULACION3";
   $tab_ger_campos['evento_adverso_regimen_dosis3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_regimen_dosis3'] = "cmp_maior_30_30";
       $tab_converte["cmp_maior_30_30"]   = "evento_adverso_regimen_dosis3";
   }
   else
   {
       $tab_def_campos['evento_adverso_regimen_dosis3'] = "evento_adverso.REGIMEN_DOSIS3";
       $tab_converte["evento_adverso.REGIMEN_DOSIS3"]   = "evento_adverso_regimen_dosis3";
   }
   $tab_labels["evento_adverso_regimen_dosis3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_regimen_dosis3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_regimen_dosis3"] : "REGIMEN DOSIS3";
   $tab_ger_campos['evento_adverso_ruta_administracion3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_ruta_administracion3'] = "cmp_maior_30_31";
       $tab_converte["cmp_maior_30_31"]   = "evento_adverso_ruta_administracion3";
   }
   else
   {
       $tab_def_campos['evento_adverso_ruta_administracion3'] = "evento_adverso.RUTA_ADMINISTRACION3";
       $tab_converte["evento_adverso.RUTA_ADMINISTRACION3"]   = "evento_adverso_ruta_administracion3";
   }
   $tab_labels["evento_adverso_ruta_administracion3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_ruta_administracion3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_ruta_administracion3"] : "RUTA ADMINISTRACION3";
   $tab_ger_campos['evento_adverso_numero_lote3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_numero_lote3'] = "cmp_maior_30_32";
       $tab_converte["cmp_maior_30_32"]   = "evento_adverso_numero_lote3";
   }
   else
   {
       $tab_def_campos['evento_adverso_numero_lote3'] = "evento_adverso.NUMERO_LOTE3";
       $tab_converte["evento_adverso.NUMERO_LOTE3"]   = "evento_adverso_numero_lote3";
   }
   $tab_labels["evento_adverso_numero_lote3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_numero_lote3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_numero_lote3"] : "NUMERO LOTE3";
   $tab_ger_campos['evento_adverso_fecha_expiracion3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_expiracion3'] = "cmp_maior_30_33";
       $tab_converte["cmp_maior_30_33"]   = "evento_adverso_fecha_expiracion3";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_expiracion3'] = "evento_adverso.FECHA_EXPIRACION3";
       $tab_converte["evento_adverso.FECHA_EXPIRACION3"]   = "evento_adverso_fecha_expiracion3";
   }
   $tab_labels["evento_adverso_fecha_expiracion3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_expiracion3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_expiracion3"] : "FECHA EXPIRACION3";
   $tab_ger_campos['evento_adverso_fecha_inicio3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_inicio3'] = "cmp_maior_30_34";
       $tab_converte["cmp_maior_30_34"]   = "evento_adverso_fecha_inicio3";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_inicio3'] = "evento_adverso.FECHA_INICIO3";
       $tab_converte["evento_adverso.FECHA_INICIO3"]   = "evento_adverso_fecha_inicio3";
   }
   $tab_labels["evento_adverso_fecha_inicio3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio3"] : "FECHA INICIO3";
   $tab_ger_campos['evento_adverso_tratamiento_continua3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_tratamiento_continua3'] = "cmp_maior_30_35";
       $tab_converte["cmp_maior_30_35"]   = "evento_adverso_tratamiento_continua3";
   }
   else
   {
       $tab_def_campos['evento_adverso_tratamiento_continua3'] = "evento_adverso.TRATAMIENTO_CONTINUA3";
       $tab_converte["evento_adverso.TRATAMIENTO_CONTINUA3"]   = "evento_adverso_tratamiento_continua3";
   }
   $tab_labels["evento_adverso_tratamiento_continua3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tratamiento_continua3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tratamiento_continua3"] : "TRATAMIENTO CONTINUA3";
   $tab_ger_campos['evento_adverso_muestra_disponible'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_muestra_disponible'] = "cmp_maior_30_36";
       $tab_converte["cmp_maior_30_36"]   = "evento_adverso_muestra_disponible";
   }
   else
   {
       $tab_def_campos['evento_adverso_muestra_disponible'] = "evento_adverso.MUESTRA_DISPONIBLE";
       $tab_converte["evento_adverso.MUESTRA_DISPONIBLE"]   = "evento_adverso_muestra_disponible";
   }
   $tab_labels["evento_adverso_muestra_disponible"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_muestra_disponible"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_muestra_disponible"] : "MUESTRA DISPONIBLE";
   $tab_ger_campos['evento_adverso_informacion_muestra'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_informacion_muestra'] = "cmp_maior_30_37";
       $tab_converte["cmp_maior_30_37"]   = "evento_adverso_informacion_muestra";
   }
   else
   {
       $tab_def_campos['evento_adverso_informacion_muestra'] = "evento_adverso.INFORMACION_MUESTRA";
       $tab_converte["evento_adverso.INFORMACION_MUESTRA"]   = "evento_adverso_informacion_muestra";
   }
   $tab_labels["evento_adverso_informacion_muestra"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_muestra"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_muestra"] : "INFORMACION MUESTRA";
   $tab_ger_campos['evento_adverso_relacion_medicamento1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_relacion_medicamento1'] = "cmp_maior_30_38";
       $tab_converte["cmp_maior_30_38"]   = "evento_adverso_relacion_medicamento1";
   }
   else
   {
       $tab_def_campos['evento_adverso_relacion_medicamento1'] = "evento_adverso.RELACION_MEDICAMENTO1";
       $tab_converte["evento_adverso.RELACION_MEDICAMENTO1"]   = "evento_adverso_relacion_medicamento1";
   }
   $tab_labels["evento_adverso_relacion_medicamento1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacion_medicamento1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacion_medicamento1"] : "RELACION MEDICAMENTO1";
   $tab_ger_campos['evento_adverso_relacionado_dispositivo1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_relacionado_dispositivo1'] = "cmp_maior_30_39";
       $tab_converte["cmp_maior_30_39"]   = "evento_adverso_relacionado_dispositivo1";
   }
   else
   {
       $tab_def_campos['evento_adverso_relacionado_dispositivo1'] = "evento_adverso.RELACIONADO_DISPOSITIVO1";
       $tab_converte["evento_adverso.RELACIONADO_DISPOSITIVO1"]   = "evento_adverso_relacionado_dispositivo1";
   }
   $tab_labels["evento_adverso_relacionado_dispositivo1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacionado_dispositivo1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacionado_dispositivo1"] : "RELACIONADO DISPOSITIVO1";
   $tab_ger_campos['evento_adverso_fecha_inicio_evento1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_inicio_evento1'] = "cmp_maior_30_40";
       $tab_converte["cmp_maior_30_40"]   = "evento_adverso_fecha_inicio_evento1";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_inicio_evento1'] = "evento_adverso.FECHA_INICIO_EVENTO1";
       $tab_converte["evento_adverso.FECHA_INICIO_EVENTO1"]   = "evento_adverso_fecha_inicio_evento1";
   }
   $tab_labels["evento_adverso_fecha_inicio_evento1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio_evento1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio_evento1"] : "FECHA INICIO EVENTO1";
   $tab_ger_campos['evento_adverso_desenlace1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_desenlace1'] = "cmp_maior_30_41";
       $tab_converte["cmp_maior_30_41"]   = "evento_adverso_desenlace1";
   }
   else
   {
       $tab_def_campos['evento_adverso_desenlace1'] = "evento_adverso.DESENLACE1";
       $tab_converte["evento_adverso.DESENLACE1"]   = "evento_adverso_desenlace1";
   }
   $tab_labels["evento_adverso_desenlace1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_desenlace1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_desenlace1"] : "DESENLACE1";
   $tab_ger_campos['evento_adverso_fecha_recuperacion1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_recuperacion1'] = "cmp_maior_30_42";
       $tab_converte["cmp_maior_30_42"]   = "evento_adverso_fecha_recuperacion1";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_recuperacion1'] = "evento_adverso.FECHA_RECUPERACION1";
       $tab_converte["evento_adverso.FECHA_RECUPERACION1"]   = "evento_adverso_fecha_recuperacion1";
   }
   $tab_labels["evento_adverso_fecha_recuperacion1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_recuperacion1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_recuperacion1"] : "FECHA RECUPERACION1";
   $tab_ger_campos['evento_adverso_fecha_muerte1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_muerte1'] = "cmp_maior_30_43";
       $tab_converte["cmp_maior_30_43"]   = "evento_adverso_fecha_muerte1";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_muerte1'] = "evento_adverso.FECHA_MUERTE1";
       $tab_converte["evento_adverso.FECHA_MUERTE1"]   = "evento_adverso_fecha_muerte1";
   }
   $tab_labels["evento_adverso_fecha_muerte1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_muerte1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_muerte1"] : "FECHA MUERTE1";
   $tab_ger_campos['evento_adverso_criterio_seriedad1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad1'] = "cmp_maior_30_44";
       $tab_converte["cmp_maior_30_44"]   = "evento_adverso_criterio_seriedad1";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad1'] = "evento_adverso.CRITERIO_SERIEDAD1";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD1"]   = "evento_adverso_criterio_seriedad1";
   }
   $tab_labels["evento_adverso_criterio_seriedad1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad1"] : "CRITERIO SERIEDAD1";
   $tab_ger_campos['evento_adverso_criterio_seriedad_muerte1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_muerte1'] = "cmp_maior_30_45";
       $tab_converte["cmp_maior_30_45"]   = "evento_adverso_criterio_seriedad_muerte1";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_muerte1'] = "evento_adverso.CRITERIO_SERIEDAD_MUERTE1";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_MUERTE1"]   = "evento_adverso_criterio_seriedad_muerte1";
   }
   $tab_labels["evento_adverso_criterio_seriedad_muerte1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_muerte1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_muerte1"] : "CRITERIO SERIEDAD MUERTE1";
   $tab_ger_campos['evento_adverso_criterio_seriedad_hospitalizacion1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_hospitalizacion1'] = "cmp_maior_30_46";
       $tab_converte["cmp_maior_30_46"]   = "evento_adverso_criterio_seriedad_hospitalizacion1";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_hospitalizacion1'] = "evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1"]   = "evento_adverso_criterio_seriedad_hospitalizacion1";
   }
   $tab_labels["evento_adverso_criterio_seriedad_hospitalizacion1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_hospitalizacion1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_hospitalizacion1"] : "CRITERIO SERIEDAD HOSPITALIZACION1";
   $tab_ger_campos['evento_adverso_criterio_seriedad_amenaza1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_amenaza1'] = "cmp_maior_30_47";
       $tab_converte["cmp_maior_30_47"]   = "evento_adverso_criterio_seriedad_amenaza1";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_amenaza1'] = "evento_adverso.CRITERIO_SERIEDAD_AMENAZA1";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_AMENAZA1"]   = "evento_adverso_criterio_seriedad_amenaza1";
   }
   $tab_labels["evento_adverso_criterio_seriedad_amenaza1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_amenaza1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_amenaza1"] : "CRITERIO SERIEDAD AMENAZA1";
   $tab_ger_campos['evento_adverso_criterio_seriedad_incapacidad1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_incapacidad1'] = "cmp_maior_30_48";
       $tab_converte["cmp_maior_30_48"]   = "evento_adverso_criterio_seriedad_incapacidad1";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_incapacidad1'] = "evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1"]   = "evento_adverso_criterio_seriedad_incapacidad1";
   }
   $tab_labels["evento_adverso_criterio_seriedad_incapacidad1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_incapacidad1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_incapacidad1"] : "CRITERIO SERIEDAD INCAPACIDAD1";
   $tab_ger_campos['evento_adverso_criterio_seriedad_anormalidad1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_anormalidad1'] = "cmp_maior_30_49";
       $tab_converte["cmp_maior_30_49"]   = "evento_adverso_criterio_seriedad_anormalidad1";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_anormalidad1'] = "evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1"]   = "evento_adverso_criterio_seriedad_anormalidad1";
   }
   $tab_labels["evento_adverso_criterio_seriedad_anormalidad1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_anormalidad1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_anormalidad1"] : "CRITERIO SERIEDAD ANORMALIDAD1";
   $tab_ger_campos['evento_adverso_criterio_seriedad_evento1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_evento1'] = "cmp_maior_30_50";
       $tab_converte["cmp_maior_30_50"]   = "evento_adverso_criterio_seriedad_evento1";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_evento1'] = "evento_adverso.CRITERIO_SERIEDAD_EVENTO1";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_EVENTO1"]   = "evento_adverso_criterio_seriedad_evento1";
   }
   $tab_labels["evento_adverso_criterio_seriedad_evento1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_evento1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_evento1"] : "CRITERIO SERIEDAD EVENTO1";
   $tab_ger_campos['evento_adverso_criterio_seriedad_quirurgica1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_quirurgica1'] = "cmp_maior_30_51";
       $tab_converte["cmp_maior_30_51"]   = "evento_adverso_criterio_seriedad_quirurgica1";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_quirurgica1'] = "evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1"]   = "evento_adverso_criterio_seriedad_quirurgica1";
   }
   $tab_labels["evento_adverso_criterio_seriedad_quirurgica1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_quirurgica1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_quirurgica1"] : "CRITERIO SERIEDAD QUIRURGICA1";
   $tab_ger_campos['evento_adverso_causa_muerte1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_causa_muerte1'] = "cmp_maior_30_52";
       $tab_converte["cmp_maior_30_52"]   = "evento_adverso_causa_muerte1";
   }
   else
   {
       $tab_def_campos['evento_adverso_causa_muerte1'] = "evento_adverso.CAUSA_MUERTE1";
       $tab_converte["evento_adverso.CAUSA_MUERTE1"]   = "evento_adverso_causa_muerte1";
   }
   $tab_labels["evento_adverso_causa_muerte1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_causa_muerte1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_causa_muerte1"] : "CAUSA MUERTE1";
   $tab_ger_campos['evento_adverso_detalles_ea1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_detalles_ea1'] = "cmp_maior_30_53";
       $tab_converte["cmp_maior_30_53"]   = "evento_adverso_detalles_ea1";
   }
   else
   {
       $tab_def_campos['evento_adverso_detalles_ea1'] = "evento_adverso.DETALLES_EA1";
       $tab_converte["evento_adverso.DETALLES_EA1"]   = "evento_adverso_detalles_ea1";
   }
   $tab_labels["evento_adverso_detalles_ea1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_detalles_ea1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_detalles_ea1"] : "DETALLES EA1";
   $tab_ger_campos['evento_adverso_relacion_medicamento2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_relacion_medicamento2'] = "cmp_maior_30_54";
       $tab_converte["cmp_maior_30_54"]   = "evento_adverso_relacion_medicamento2";
   }
   else
   {
       $tab_def_campos['evento_adverso_relacion_medicamento2'] = "evento_adverso.RELACION_MEDICAMENTO2";
       $tab_converte["evento_adverso.RELACION_MEDICAMENTO2"]   = "evento_adverso_relacion_medicamento2";
   }
   $tab_labels["evento_adverso_relacion_medicamento2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacion_medicamento2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacion_medicamento2"] : "RELACION MEDICAMENTO2";
   $tab_ger_campos['evento_adverso_relacionado_dispositivo2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_relacionado_dispositivo2'] = "cmp_maior_30_55";
       $tab_converte["cmp_maior_30_55"]   = "evento_adverso_relacionado_dispositivo2";
   }
   else
   {
       $tab_def_campos['evento_adverso_relacionado_dispositivo2'] = "evento_adverso.RELACIONADO_DISPOSITIVO2";
       $tab_converte["evento_adverso.RELACIONADO_DISPOSITIVO2"]   = "evento_adverso_relacionado_dispositivo2";
   }
   $tab_labels["evento_adverso_relacionado_dispositivo2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacionado_dispositivo2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacionado_dispositivo2"] : "RELACIONADO DISPOSITIVO2";
   $tab_ger_campos['evento_adverso_fecha_inicio_evento2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_inicio_evento2'] = "cmp_maior_30_56";
       $tab_converte["cmp_maior_30_56"]   = "evento_adverso_fecha_inicio_evento2";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_inicio_evento2'] = "evento_adverso.FECHA_INICIO_EVENTO2";
       $tab_converte["evento_adverso.FECHA_INICIO_EVENTO2"]   = "evento_adverso_fecha_inicio_evento2";
   }
   $tab_labels["evento_adverso_fecha_inicio_evento2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio_evento2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio_evento2"] : "FECHA INICIO EVENTO2";
   $tab_ger_campos['evento_adverso_desenlace2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_desenlace2'] = "cmp_maior_30_57";
       $tab_converte["cmp_maior_30_57"]   = "evento_adverso_desenlace2";
   }
   else
   {
       $tab_def_campos['evento_adverso_desenlace2'] = "evento_adverso.DESENLACE2";
       $tab_converte["evento_adverso.DESENLACE2"]   = "evento_adverso_desenlace2";
   }
   $tab_labels["evento_adverso_desenlace2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_desenlace2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_desenlace2"] : "DESENLACE2";
   $tab_ger_campos['evento_adverso_fecha_recuperacion2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_recuperacion2'] = "cmp_maior_30_58";
       $tab_converte["cmp_maior_30_58"]   = "evento_adverso_fecha_recuperacion2";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_recuperacion2'] = "evento_adverso.FECHA_RECUPERACION2";
       $tab_converte["evento_adverso.FECHA_RECUPERACION2"]   = "evento_adverso_fecha_recuperacion2";
   }
   $tab_labels["evento_adverso_fecha_recuperacion2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_recuperacion2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_recuperacion2"] : "FECHA RECUPERACION2";
   $tab_ger_campos['evento_adverso_fecha_muerte2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_muerte2'] = "cmp_maior_30_59";
       $tab_converte["cmp_maior_30_59"]   = "evento_adverso_fecha_muerte2";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_muerte2'] = "evento_adverso.FECHA_MUERTE2";
       $tab_converte["evento_adverso.FECHA_MUERTE2"]   = "evento_adverso_fecha_muerte2";
   }
   $tab_labels["evento_adverso_fecha_muerte2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_muerte2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_muerte2"] : "FECHA MUERTE2";
   $tab_ger_campos['evento_adverso_criterio_seriedad2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad2'] = "cmp_maior_30_60";
       $tab_converte["cmp_maior_30_60"]   = "evento_adverso_criterio_seriedad2";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad2'] = "evento_adverso.CRITERIO_SERIEDAD2";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD2"]   = "evento_adverso_criterio_seriedad2";
   }
   $tab_labels["evento_adverso_criterio_seriedad2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad2"] : "CRITERIO SERIEDAD2";
   $tab_ger_campos['evento_adverso_criterio_seriedad_muerte2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_muerte2'] = "cmp_maior_30_61";
       $tab_converte["cmp_maior_30_61"]   = "evento_adverso_criterio_seriedad_muerte2";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_muerte2'] = "evento_adverso.CRITERIO_SERIEDAD_MUERTE2";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_MUERTE2"]   = "evento_adverso_criterio_seriedad_muerte2";
   }
   $tab_labels["evento_adverso_criterio_seriedad_muerte2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_muerte2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_muerte2"] : "CRITERIO SERIEDAD MUERTE2";
   $tab_ger_campos['evento_adverso_criterio_seriedad_hospitalizacion2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_hospitalizacion2'] = "cmp_maior_30_62";
       $tab_converte["cmp_maior_30_62"]   = "evento_adverso_criterio_seriedad_hospitalizacion2";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_hospitalizacion2'] = "evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2"]   = "evento_adverso_criterio_seriedad_hospitalizacion2";
   }
   $tab_labels["evento_adverso_criterio_seriedad_hospitalizacion2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_hospitalizacion2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_hospitalizacion2"] : "CRITERIO SERIEDAD HOSPITALIZACION2";
   $tab_ger_campos['evento_adverso_criterio_seriedad_amenaza2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_amenaza2'] = "cmp_maior_30_63";
       $tab_converte["cmp_maior_30_63"]   = "evento_adverso_criterio_seriedad_amenaza2";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_amenaza2'] = "evento_adverso.CRITERIO_SERIEDAD_AMENAZA2";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_AMENAZA2"]   = "evento_adverso_criterio_seriedad_amenaza2";
   }
   $tab_labels["evento_adverso_criterio_seriedad_amenaza2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_amenaza2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_amenaza2"] : "CRITERIO SERIEDAD AMENAZA2";
   $tab_ger_campos['evento_adverso_criterio_seriedad_incapacidad2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_incapacidad2'] = "cmp_maior_30_64";
       $tab_converte["cmp_maior_30_64"]   = "evento_adverso_criterio_seriedad_incapacidad2";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_incapacidad2'] = "evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2"]   = "evento_adverso_criterio_seriedad_incapacidad2";
   }
   $tab_labels["evento_adverso_criterio_seriedad_incapacidad2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_incapacidad2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_incapacidad2"] : "CRITERIO SERIEDAD INCAPACIDAD2";
   $tab_ger_campos['evento_adverso_criterio_seriedad_anormalidad2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_anormalidad2'] = "cmp_maior_30_65";
       $tab_converte["cmp_maior_30_65"]   = "evento_adverso_criterio_seriedad_anormalidad2";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_anormalidad2'] = "evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2"]   = "evento_adverso_criterio_seriedad_anormalidad2";
   }
   $tab_labels["evento_adverso_criterio_seriedad_anormalidad2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_anormalidad2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_anormalidad2"] : "CRITERIO SERIEDAD ANORMALIDAD2";
   $tab_ger_campos['evento_adverso_criterio_seriedad_evento2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_evento2'] = "cmp_maior_30_66";
       $tab_converte["cmp_maior_30_66"]   = "evento_adverso_criterio_seriedad_evento2";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_evento2'] = "evento_adverso.CRITERIO_SERIEDAD_EVENTO2";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_EVENTO2"]   = "evento_adverso_criterio_seriedad_evento2";
   }
   $tab_labels["evento_adverso_criterio_seriedad_evento2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_evento2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_evento2"] : "CRITERIO SERIEDAD EVENTO2";
   $tab_ger_campos['evento_adverso_criterio_seriedad_quirurgica2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_quirurgica2'] = "cmp_maior_30_67";
       $tab_converte["cmp_maior_30_67"]   = "evento_adverso_criterio_seriedad_quirurgica2";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_quirurgica2'] = "evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2"]   = "evento_adverso_criterio_seriedad_quirurgica2";
   }
   $tab_labels["evento_adverso_criterio_seriedad_quirurgica2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_quirurgica2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_quirurgica2"] : "CRITERIO SERIEDAD QUIRURGICA2";
   $tab_ger_campos['evento_adverso_causa_muerte2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_causa_muerte2'] = "cmp_maior_30_68";
       $tab_converte["cmp_maior_30_68"]   = "evento_adverso_causa_muerte2";
   }
   else
   {
       $tab_def_campos['evento_adverso_causa_muerte2'] = "evento_adverso.CAUSA_MUERTE2";
       $tab_converte["evento_adverso.CAUSA_MUERTE2"]   = "evento_adverso_causa_muerte2";
   }
   $tab_labels["evento_adverso_causa_muerte2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_causa_muerte2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_causa_muerte2"] : "CAUSA MUERTE2";
   $tab_ger_campos['evento_adverso_detalles_ea2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_detalles_ea2'] = "cmp_maior_30_69";
       $tab_converte["cmp_maior_30_69"]   = "evento_adverso_detalles_ea2";
   }
   else
   {
       $tab_def_campos['evento_adverso_detalles_ea2'] = "evento_adverso.DETALLES_EA2";
       $tab_converte["evento_adverso.DETALLES_EA2"]   = "evento_adverso_detalles_ea2";
   }
   $tab_labels["evento_adverso_detalles_ea2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_detalles_ea2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_detalles_ea2"] : "DETALLES EA2";
   $tab_ger_campos['evento_adverso_relacion_medicamento3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_relacion_medicamento3'] = "cmp_maior_30_70";
       $tab_converte["cmp_maior_30_70"]   = "evento_adverso_relacion_medicamento3";
   }
   else
   {
       $tab_def_campos['evento_adverso_relacion_medicamento3'] = "evento_adverso.RELACION_MEDICAMENTO3";
       $tab_converte["evento_adverso.RELACION_MEDICAMENTO3"]   = "evento_adverso_relacion_medicamento3";
   }
   $tab_labels["evento_adverso_relacion_medicamento3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacion_medicamento3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacion_medicamento3"] : "RELACION MEDICAMENTO3";
   $tab_ger_campos['evento_adverso_relacionado_dispositivo3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_relacionado_dispositivo3'] = "cmp_maior_30_71";
       $tab_converte["cmp_maior_30_71"]   = "evento_adverso_relacionado_dispositivo3";
   }
   else
   {
       $tab_def_campos['evento_adverso_relacionado_dispositivo3'] = "evento_adverso.RELACIONADO_DISPOSITIVO3";
       $tab_converte["evento_adverso.RELACIONADO_DISPOSITIVO3"]   = "evento_adverso_relacionado_dispositivo3";
   }
   $tab_labels["evento_adverso_relacionado_dispositivo3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacionado_dispositivo3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_relacionado_dispositivo3"] : "RELACIONADO DISPOSITIVO3";
   $tab_ger_campos['evento_adverso_fecha_inicio_evento3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_inicio_evento3'] = "cmp_maior_30_72";
       $tab_converte["cmp_maior_30_72"]   = "evento_adverso_fecha_inicio_evento3";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_inicio_evento3'] = "evento_adverso.FECHA_INICIO_EVENTO3";
       $tab_converte["evento_adverso.FECHA_INICIO_EVENTO3"]   = "evento_adverso_fecha_inicio_evento3";
   }
   $tab_labels["evento_adverso_fecha_inicio_evento3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio_evento3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_inicio_evento3"] : "FECHA INICIO EVENTO3";
   $tab_ger_campos['evento_adverso_desenlace3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_desenlace3'] = "cmp_maior_30_73";
       $tab_converte["cmp_maior_30_73"]   = "evento_adverso_desenlace3";
   }
   else
   {
       $tab_def_campos['evento_adverso_desenlace3'] = "evento_adverso.DESENLACE3";
       $tab_converte["evento_adverso.DESENLACE3"]   = "evento_adverso_desenlace3";
   }
   $tab_labels["evento_adverso_desenlace3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_desenlace3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_desenlace3"] : "DESENLACE3";
   $tab_ger_campos['evento_adverso_fecha_recuperacion3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_recuperacion3'] = "cmp_maior_30_74";
       $tab_converte["cmp_maior_30_74"]   = "evento_adverso_fecha_recuperacion3";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_recuperacion3'] = "evento_adverso.FECHA_RECUPERACION3";
       $tab_converte["evento_adverso.FECHA_RECUPERACION3"]   = "evento_adverso_fecha_recuperacion3";
   }
   $tab_labels["evento_adverso_fecha_recuperacion3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_recuperacion3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_recuperacion3"] : "FECHA RECUPERACION3";
   $tab_ger_campos['evento_adverso_fecha_muerte3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_muerte3'] = "cmp_maior_30_75";
       $tab_converte["cmp_maior_30_75"]   = "evento_adverso_fecha_muerte3";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_muerte3'] = "evento_adverso.FECHA_MUERTE3";
       $tab_converte["evento_adverso.FECHA_MUERTE3"]   = "evento_adverso_fecha_muerte3";
   }
   $tab_labels["evento_adverso_fecha_muerte3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_muerte3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_muerte3"] : "FECHA MUERTE3";
   $tab_ger_campos['evento_adverso_criterio_seriedad3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad3'] = "cmp_maior_30_76";
       $tab_converte["cmp_maior_30_76"]   = "evento_adverso_criterio_seriedad3";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad3'] = "evento_adverso.CRITERIO_SERIEDAD3";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD3"]   = "evento_adverso_criterio_seriedad3";
   }
   $tab_labels["evento_adverso_criterio_seriedad3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad3"] : "CRITERIO SERIEDAD3";
   $tab_ger_campos['evento_adverso_criterio_seriedad_muerte3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_muerte3'] = "cmp_maior_30_77";
       $tab_converte["cmp_maior_30_77"]   = "evento_adverso_criterio_seriedad_muerte3";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_muerte3'] = "evento_adverso.CRITERIO_SERIEDAD_MUERTE3";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_MUERTE3"]   = "evento_adverso_criterio_seriedad_muerte3";
   }
   $tab_labels["evento_adverso_criterio_seriedad_muerte3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_muerte3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_muerte3"] : "CRITERIO SERIEDAD MUERTE3";
   $tab_ger_campos['evento_adverso_criterio_seriedad_hospitalizacion3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_hospitalizacion3'] = "cmp_maior_30_78";
       $tab_converte["cmp_maior_30_78"]   = "evento_adverso_criterio_seriedad_hospitalizacion3";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_hospitalizacion3'] = "evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3"]   = "evento_adverso_criterio_seriedad_hospitalizacion3";
   }
   $tab_labels["evento_adverso_criterio_seriedad_hospitalizacion3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_hospitalizacion3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_hospitalizacion3"] : "CRITERIO SERIEDAD HOSPITALIZACION3";
   $tab_ger_campos['evento_adverso_criterio_seriedad_amenaza3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_amenaza3'] = "cmp_maior_30_79";
       $tab_converte["cmp_maior_30_79"]   = "evento_adverso_criterio_seriedad_amenaza3";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_amenaza3'] = "evento_adverso.CRITERIO_SERIEDAD_AMENAZA3";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_AMENAZA3"]   = "evento_adverso_criterio_seriedad_amenaza3";
   }
   $tab_labels["evento_adverso_criterio_seriedad_amenaza3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_amenaza3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_amenaza3"] : "CRITERIO SERIEDAD AMENAZA3";
   $tab_ger_campos['evento_adverso_criterio_seriedad_incapacidad3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_incapacidad3'] = "cmp_maior_30_80";
       $tab_converte["cmp_maior_30_80"]   = "evento_adverso_criterio_seriedad_incapacidad3";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_incapacidad3'] = "evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3"]   = "evento_adverso_criterio_seriedad_incapacidad3";
   }
   $tab_labels["evento_adverso_criterio_seriedad_incapacidad3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_incapacidad3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_incapacidad3"] : "CRITERIO SERIEDAD INCAPACIDAD3";
   $tab_ger_campos['evento_adverso_criterio_seriedad_anormalidad3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_anormalidad3'] = "cmp_maior_30_81";
       $tab_converte["cmp_maior_30_81"]   = "evento_adverso_criterio_seriedad_anormalidad3";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_anormalidad3'] = "evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3"]   = "evento_adverso_criterio_seriedad_anormalidad3";
   }
   $tab_labels["evento_adverso_criterio_seriedad_anormalidad3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_anormalidad3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_anormalidad3"] : "CRITERIO SERIEDAD ANORMALIDAD3";
   $tab_ger_campos['evento_adverso_criterio_seriedad_evento3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_evento3'] = "cmp_maior_30_82";
       $tab_converte["cmp_maior_30_82"]   = "evento_adverso_criterio_seriedad_evento3";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_evento3'] = "evento_adverso.CRITERIO_SERIEDAD_EVENTO3";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_EVENTO3"]   = "evento_adverso_criterio_seriedad_evento3";
   }
   $tab_labels["evento_adverso_criterio_seriedad_evento3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_evento3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_evento3"] : "CRITERIO SERIEDAD EVENTO3";
   $tab_ger_campos['evento_adverso_criterio_seriedad_quirurgica3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_quirurgica3'] = "cmp_maior_30_83";
       $tab_converte["cmp_maior_30_83"]   = "evento_adverso_criterio_seriedad_quirurgica3";
   }
   else
   {
       $tab_def_campos['evento_adverso_criterio_seriedad_quirurgica3'] = "evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3";
       $tab_converte["evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3"]   = "evento_adverso_criterio_seriedad_quirurgica3";
   }
   $tab_labels["evento_adverso_criterio_seriedad_quirurgica3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_quirurgica3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_criterio_seriedad_quirurgica3"] : "CRITERIO SERIEDAD QUIRURGICA3";
   $tab_ger_campos['evento_adverso_causa_muerte3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_causa_muerte3'] = "cmp_maior_30_84";
       $tab_converte["cmp_maior_30_84"]   = "evento_adverso_causa_muerte3";
   }
   else
   {
       $tab_def_campos['evento_adverso_causa_muerte3'] = "evento_adverso.CAUSA_MUERTE3";
       $tab_converte["evento_adverso.CAUSA_MUERTE3"]   = "evento_adverso_causa_muerte3";
   }
   $tab_labels["evento_adverso_causa_muerte3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_causa_muerte3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_causa_muerte3"] : "CAUSA MUERTE3";
   $tab_ger_campos['evento_adverso_detalles_ea3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_detalles_ea3'] = "cmp_maior_30_85";
       $tab_converte["cmp_maior_30_85"]   = "evento_adverso_detalles_ea3";
   }
   else
   {
       $tab_def_campos['evento_adverso_detalles_ea3'] = "evento_adverso.DETALLES_EA3";
       $tab_converte["evento_adverso.DETALLES_EA3"]   = "evento_adverso_detalles_ea3";
   }
   $tab_labels["evento_adverso_detalles_ea3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_detalles_ea3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_detalles_ea3"] : "DETALLES EA3";
   $tab_ger_campos['evento_adverso_informacion_adicional'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_informacion_adicional'] = "cmp_maior_30_86";
       $tab_converte["cmp_maior_30_86"]   = "evento_adverso_informacion_adicional";
   }
   else
   {
       $tab_def_campos['evento_adverso_informacion_adicional'] = "evento_adverso.INFORMACION_ADICIONAL";
       $tab_converte["evento_adverso.INFORMACION_ADICIONAL"]   = "evento_adverso_informacion_adicional";
   }
   $tab_labels["evento_adverso_informacion_adicional"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_adicional"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_adicional"] : "INFORMACION ADICIONAL";
   $tab_ger_campos['evento_adverso_nombre_reporte'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_nombre_reporte'] = "cmp_maior_30_87";
       $tab_converte["cmp_maior_30_87"]   = "evento_adverso_nombre_reporte";
   }
   else
   {
       $tab_def_campos['evento_adverso_nombre_reporte'] = "evento_adverso.NOMBRE_REPORTE";
       $tab_converte["evento_adverso.NOMBRE_REPORTE"]   = "evento_adverso_nombre_reporte";
   }
   $tab_labels["evento_adverso_nombre_reporte"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_nombre_reporte"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_nombre_reporte"] : "NOMBRE REPORTE";
   $tab_ger_campos['evento_adverso_id_paciente_fk'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_id_paciente_fk'] = "cmp_maior_30_88";
       $tab_converte["cmp_maior_30_88"]   = "evento_adverso_id_paciente_fk";
   }
   else
   {
       $tab_def_campos['evento_adverso_id_paciente_fk'] = "evento_adverso.ID_PACIENTE_FK";
       $tab_converte["evento_adverso.ID_PACIENTE_FK"]   = "evento_adverso_id_paciente_fk";
   }
   $tab_labels["evento_adverso_id_paciente_fk"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_id_paciente_fk"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_id_paciente_fk"] : "ID PACIENTE FK";
   $tab_ger_campos['evento_adverso_medicamento1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_medicamento1'] = "cmp_maior_30_89";
       $tab_converte["cmp_maior_30_89"]   = "evento_adverso_medicamento1";
   }
   else
   {
       $tab_def_campos['evento_adverso_medicamento1'] = "evento_adverso.MEDICAMENTO1";
       $tab_converte["evento_adverso.MEDICAMENTO1"]   = "evento_adverso_medicamento1";
   }
   $tab_labels["evento_adverso_medicamento1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_medicamento1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_medicamento1"] : "MEDICAMENTO1";
   $tab_ger_campos['evento_adverso_medicamento2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_medicamento2'] = "cmp_maior_30_90";
       $tab_converte["cmp_maior_30_90"]   = "evento_adverso_medicamento2";
   }
   else
   {
       $tab_def_campos['evento_adverso_medicamento2'] = "evento_adverso.MEDICAMENTO2";
       $tab_converte["evento_adverso.MEDICAMENTO2"]   = "evento_adverso_medicamento2";
   }
   $tab_labels["evento_adverso_medicamento2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_medicamento2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_medicamento2"] : "MEDICAMENTO2";
   $tab_ger_campos['evento_adverso_medicamento3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_medicamento3'] = "cmp_maior_30_91";
       $tab_converte["cmp_maior_30_91"]   = "evento_adverso_medicamento3";
   }
   else
   {
       $tab_def_campos['evento_adverso_medicamento3'] = "evento_adverso.MEDICAMENTO3";
       $tab_converte["evento_adverso.MEDICAMENTO3"]   = "evento_adverso_medicamento3";
   }
   $tab_labels["evento_adverso_medicamento3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_medicamento3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_medicamento3"] : "MEDICAMENTO3";
   $tab_ger_campos['evento_adverso_informacion_ea1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_informacion_ea1'] = "cmp_maior_30_92";
       $tab_converte["cmp_maior_30_92"]   = "evento_adverso_informacion_ea1";
   }
   else
   {
       $tab_def_campos['evento_adverso_informacion_ea1'] = "evento_adverso.INFORMACION_EA1";
       $tab_converte["evento_adverso.INFORMACION_EA1"]   = "evento_adverso_informacion_ea1";
   }
   $tab_labels["evento_adverso_informacion_ea1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_ea1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_ea1"] : "INFORMACION EA1";
   $tab_ger_campos['evento_adverso_informacion_ea2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_informacion_ea2'] = "cmp_maior_30_93";
       $tab_converte["cmp_maior_30_93"]   = "evento_adverso_informacion_ea2";
   }
   else
   {
       $tab_def_campos['evento_adverso_informacion_ea2'] = "evento_adverso.INFORMACION_EA2";
       $tab_converte["evento_adverso.INFORMACION_EA2"]   = "evento_adverso_informacion_ea2";
   }
   $tab_labels["evento_adverso_informacion_ea2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_ea2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_ea2"] : "INFORMACION EA2";
   $tab_ger_campos['evento_adverso_informacion_ea3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_informacion_ea3'] = "cmp_maior_30_94";
       $tab_converte["cmp_maior_30_94"]   = "evento_adverso_informacion_ea3";
   }
   else
   {
       $tab_def_campos['evento_adverso_informacion_ea3'] = "evento_adverso.INFORMACION_EA3";
       $tab_converte["evento_adverso.INFORMACION_EA3"]   = "evento_adverso_informacion_ea3";
   }
   $tab_labels["evento_adverso_informacion_ea3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_ea3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_informacion_ea3"] : "INFORMACION EA3";
   $tab_ger_campos['evento_adverso_fecha_suspencion1'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_suspencion1'] = "cmp_maior_30_95";
       $tab_converte["cmp_maior_30_95"]   = "evento_adverso_fecha_suspencion1";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_suspencion1'] = "evento_adverso.FECHA_SUSPENCION1";
       $tab_converte["evento_adverso.FECHA_SUSPENCION1"]   = "evento_adverso_fecha_suspencion1";
   }
   $tab_labels["evento_adverso_fecha_suspencion1"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_suspencion1"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_suspencion1"] : "FECHA SUSPENCION1";
   $tab_ger_campos['evento_adverso_fecha_suspencion2'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_suspencion2'] = "cmp_maior_30_96";
       $tab_converte["cmp_maior_30_96"]   = "evento_adverso_fecha_suspencion2";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_suspencion2'] = "evento_adverso.FECHA_SUSPENCION2";
       $tab_converte["evento_adverso.FECHA_SUSPENCION2"]   = "evento_adverso_fecha_suspencion2";
   }
   $tab_labels["evento_adverso_fecha_suspencion2"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_suspencion2"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_suspencion2"] : "FECHA SUSPENCION2";
   $tab_ger_campos['evento_adverso_fecha_suspencion3'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_suspencion3'] = "cmp_maior_30_97";
       $tab_converte["cmp_maior_30_97"]   = "evento_adverso_fecha_suspencion3";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_suspencion3'] = "evento_adverso.FECHA_SUSPENCION3";
       $tab_converte["evento_adverso.FECHA_SUSPENCION3"]   = "evento_adverso_fecha_suspencion3";
   }
   $tab_labels["evento_adverso_fecha_suspencion3"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_suspencion3"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_suspencion3"] : "FECHA SUSPENCION3";
   $tab_ger_campos['evento_adverso_fecha_evento_adverso'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_fecha_evento_adverso'] = "cmp_maior_30_98";
       $tab_converte["cmp_maior_30_98"]   = "evento_adverso_fecha_evento_adverso";
   }
   else
   {
       $tab_def_campos['evento_adverso_fecha_evento_adverso'] = "evento_adverso.FECHA_EVENTO_ADVERSO";
       $tab_converte["evento_adverso.FECHA_EVENTO_ADVERSO"]   = "evento_adverso_fecha_evento_adverso";
   }
   $tab_labels["evento_adverso_fecha_evento_adverso"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_evento_adverso"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_fecha_evento_adverso"] : "FECHA EVENTO ADVERSO";
   $tab_ger_campos['evento_adverso_nombre_reportante_primario'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_nombre_reportante_primario'] = "cmp_maior_30_99";
       $tab_converte["cmp_maior_30_99"]   = "evento_adverso_nombre_reportante_primario";
   }
   else
   {
       $tab_def_campos['evento_adverso_nombre_reportante_primario'] = "evento_adverso.NOMBRE_REPORTANTE_PRIMARIO";
       $tab_converte["evento_adverso.NOMBRE_REPORTANTE_PRIMARIO"]   = "evento_adverso_nombre_reportante_primario";
   }
   $tab_labels["evento_adverso_nombre_reportante_primario"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_nombre_reportante_primario"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_nombre_reportante_primario"] : "NOMBRE REPORTANTE PRIMARIO";
   $tab_ger_campos['evento_adverso_telefono_reportante_primario'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_telefono_reportante_primario'] = "cmp_maior_30_100";
       $tab_converte["cmp_maior_30_100"]   = "evento_adverso_telefono_reportante_primario";
   }
   else
   {
       $tab_def_campos['evento_adverso_telefono_reportante_primario'] = "evento_adverso.TELEFONO_REPORTANTE_PRIMARIO";
       $tab_converte["evento_adverso.TELEFONO_REPORTANTE_PRIMARIO"]   = "evento_adverso_telefono_reportante_primario";
   }
   $tab_labels["evento_adverso_telefono_reportante_primario"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_telefono_reportante_primario"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_telefono_reportante_primario"] : "TELEFONO REPORTANTE PRIMARIO";
   $tab_ger_campos['evento_adverso_tipo_reportante'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['evento_adverso_tipo_reportante'] = "cmp_maior_30_101";
       $tab_converte["cmp_maior_30_101"]   = "evento_adverso_tipo_reportante";
   }
   else
   {
       $tab_def_campos['evento_adverso_tipo_reportante'] = "evento_adverso.TIPO_REPORTANTE";
       $tab_converte["evento_adverso.TIPO_REPORTANTE"]   = "evento_adverso_tipo_reportante";
   }
   $tab_labels["evento_adverso_tipo_reportante"]   = (isset($_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tipo_reportante"])) ? $_SESSION['sc_session'][$sc_init]['EA']['labels']["evento_adverso_tipo_reportante"] : "TIPO REPORTANTE";
   $tab_ger_campos['evento_adverso_informacion_muestra'] = "none";
   $tab_ger_campos['evento_adverso_informacion_adicional'] = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['EA']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['EA']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['EA']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['EA']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['EA']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['EA']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['EA']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['EA']['ordem_select'] = array();
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
   $_SESSION['sc_session'][$sc_init]['EA']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['EA']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['EA']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_converte[$campo]))
       {
           $_SESSION['sc_session'][$sc_init]['EA']['ordem_select'][$campo] = $ordem;
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
   $_SESSION['scriptcase']['charset']  = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "ISO-8859-15";
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
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc8_BlueWood/Sc8_BlueWood";
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
 <TITLE><?php echo $this->Nm_lang['lang_othr_grid_titl'] ?> - </TITLE>
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
    url: "EA_order_campos.php",
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
           if (!isset($_SESSION['sc_session'][$sc_init]['EA']['ordem_select'][$tab_def_campos[$NM_cada_field]]))
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
   foreach ($_SESSION['sc_session'][$sc_init]['EA']['ordem_select'] as $NM_cada_field => $NM_cada_opc)
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

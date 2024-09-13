<?php
   include_once('Informe_reclamacion_session.php');
   session_start();
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
    $Ord_Cmp = new Informe_reclamacion_Ord_cmp(); 
    $Ord_Cmp->Ord_cmp_init();
   
class Informe_reclamacion_Ord_cmp
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
   $tab_ger_campos['id_paciente'] = "on";
   $tab_def_campos['id_paciente'] = "ID_PACIENTE";
   $tab_converte["ID_PACIENTE"]   = "id_paciente";
   $tab_labels["id_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["id_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["id_paciente"] : "ID PACIENTE";
   $tab_ger_campos['logro_comunicacion_gestion'] = "on";
   $tab_def_campos['logro_comunicacion_gestion'] = "LOGRO_COMUNICACION_GESTION";
   $tab_converte["LOGRO_COMUNICACION_GESTION"]   = "logro_comunicacion_gestion";
   $tab_labels["logro_comunicacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["logro_comunicacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["logro_comunicacion_gestion"] : "LOGRO COMUNICACION GESTION";
   $tab_ger_campos['fecha_comunicacion'] = "on";
   $tab_def_campos['fecha_comunicacion'] = "FECHA_COMUNICACION";
   $tab_converte["FECHA_COMUNICACION"]   = "fecha_comunicacion";
   $tab_labels["fecha_comunicacion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_comunicacion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_comunicacion"] : "FECHA COMUNICACION";
   $tab_ger_campos['autor_gestion'] = "on";
   $tab_def_campos['autor_gestion'] = "AUTOR_GESTION";
   $tab_converte["AUTOR_GESTION"]   = "autor_gestion";
   $tab_labels["autor_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["autor_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["autor_gestion"] : "AUTOR GESTION";
   $tab_ger_campos['departamento_paciente'] = "on";
   $tab_def_campos['departamento_paciente'] = "DEPARTAMENTO_PACIENTE";
   $tab_converte["DEPARTAMENTO_PACIENTE"]   = "departamento_paciente";
   $tab_labels["departamento_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["departamento_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["departamento_paciente"] : "DEPARTAMENTO PACIENTE";
   $tab_ger_campos['ciudad_paciente'] = "on";
   $tab_def_campos['ciudad_paciente'] = "CIUDAD_PACIENTE";
   $tab_converte["CIUDAD_PACIENTE"]   = "ciudad_paciente";
   $tab_labels["ciudad_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["ciudad_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["ciudad_paciente"] : "CIUDAD PACIENTE";
   $tab_ger_campos['estado_paciente'] = "on";
   $tab_def_campos['estado_paciente'] = "ESTADO_PACIENTE";
   $tab_converte["ESTADO_PACIENTE"]   = "estado_paciente";
   $tab_labels["estado_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["estado_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["estado_paciente"] : "ESTADO PACIENTE";
   $tab_ger_campos['status_paciente'] = "on";
   $tab_def_campos['status_paciente'] = "STATUS_PACIENTE";
   $tab_converte["STATUS_PACIENTE"]   = "status_paciente";
   $tab_labels["status_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["status_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["status_paciente"] : "STATUS PACIENTE";
   $tab_ger_campos['fecha_activacion_paciente'] = "on";
   $tab_def_campos['fecha_activacion_paciente'] = "FECHA_ACTIVACION_PACIENTE";
   $tab_converte["FECHA_ACTIVACION_PACIENTE"]   = "fecha_activacion_paciente";
   $tab_labels["fecha_activacion_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_activacion_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_activacion_paciente"] : "FECHA ACTIVACION PACIENTE";
   $tab_ger_campos['fecha_retiro_paciente'] = "on";
   $tab_def_campos['fecha_retiro_paciente'] = "FECHA_RETIRO_PACIENTE";
   $tab_converte["FECHA_RETIRO_PACIENTE"]   = "fecha_retiro_paciente";
   $tab_labels["fecha_retiro_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_retiro_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_retiro_paciente"] : "FECHA RETIRO PACIENTE";
   $tab_ger_campos['motivo_retiro_paciente'] = "on";
   $tab_def_campos['motivo_retiro_paciente'] = "MOTIVO_RETIRO_PACIENTE";
   $tab_converte["MOTIVO_RETIRO_PACIENTE"]   = "motivo_retiro_paciente";
   $tab_labels["motivo_retiro_paciente"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["motivo_retiro_paciente"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["motivo_retiro_paciente"] : "MOTIVO RETIRO PACIENTE";
   $tab_ger_campos['fecha_inicio_terapia_tratamiento'] = "on";
   $tab_def_campos['fecha_inicio_terapia_tratamiento'] = "FECHA_INICIO_TERAPIA_TRATAMIENTO";
   $tab_converte["FECHA_INICIO_TERAPIA_TRATAMIENTO"]   = "fecha_inicio_terapia_tratamiento";
   $tab_labels["fecha_inicio_terapia_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_inicio_terapia_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_inicio_terapia_tratamiento"] : "FECHA INICIO TERAPIA TRATAMIENTO";
   $tab_ger_campos['codigo_xofigo'] = "on";
   $tab_def_campos['codigo_xofigo'] = "CODIGO_XOFIGO";
   $tab_converte["CODIGO_XOFIGO"]   = "codigo_xofigo";
   $tab_labels["codigo_xofigo"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["codigo_xofigo"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["codigo_xofigo"] : "CODIGO XOFIGO";
   $tab_ger_campos['clasificacion_patologica_tratamiento'] = "on";
   $tab_def_campos['clasificacion_patologica_tratamiento'] = "CLASIFICACION_PATOLOGICA_TRATAMIENTO";
   $tab_converte["CLASIFICACION_PATOLOGICA_TRATAMIENTO"]   = "clasificacion_patologica_tratamiento";
   $tab_labels["clasificacion_patologica_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["clasificacion_patologica_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["clasificacion_patologica_tratamiento"] : "CLASIFICACION PATOLOGICA TRATAMIENTO";
   $tab_ger_campos['producto_tratamiento'] = "on";
   $tab_def_campos['producto_tratamiento'] = "PRODUCTO_TRATAMIENTO";
   $tab_converte["PRODUCTO_TRATAMIENTO"]   = "producto_tratamiento";
   $tab_labels["producto_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["producto_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["producto_tratamiento"] : "PRODUCTO TRATAMIENTO";
   $tab_ger_campos['nombre_referencia'] = "on";
   $tab_def_campos['nombre_referencia'] = "NOMBRE_REFERENCIA";
   $tab_converte["NOMBRE_REFERENCIA"]   = "nombre_referencia";
   $tab_labels["nombre_referencia"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["nombre_referencia"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["nombre_referencia"] : "NOMBRE REFERENCIA";
   $tab_ger_campos['dosis_tratamiento'] = "on";
   $tab_def_campos['dosis_tratamiento'] = "DOSIS_TRATAMIENTO";
   $tab_converte["DOSIS_TRATAMIENTO"]   = "dosis_tratamiento";
   $tab_labels["dosis_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["dosis_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["dosis_tratamiento"] : "DOSIS TRATAMIENTO";
   $tab_ger_campos['fecha_medicamento_hasta'] = "on";
   $tab_def_campos['fecha_medicamento_hasta'] = "FECHA_MEDICAMENTO_HASTA";
   $tab_converte["FECHA_MEDICAMENTO_HASTA"]   = "fecha_medicamento_hasta";
   $tab_labels["fecha_medicamento_hasta"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_medicamento_hasta"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_medicamento_hasta"] : "FECHA MEDICAMENTO HASTA";
   $tab_ger_campos['numero_cajas'] = "on";
   $tab_def_campos['numero_cajas'] = "NUMERO_CAJAS";
   $tab_converte["NUMERO_CAJAS"]   = "numero_cajas";
   $tab_labels["numero_cajas"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["numero_cajas"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["numero_cajas"] : "NUMERO CAJAS";
   $tab_ger_campos['asegurador_tratamiento'] = "on";
   $tab_def_campos['asegurador_tratamiento'] = "ASEGURADOR_TRATAMIENTO";
   $tab_converte["ASEGURADOR_TRATAMIENTO"]   = "asegurador_tratamiento";
   $tab_labels["asegurador_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["asegurador_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["asegurador_tratamiento"] : "ASEGURADOR TRATAMIENTO";
   $tab_ger_campos['operador_logistico_tratamiento'] = "on";
   $tab_def_campos['operador_logistico_tratamiento'] = "OPERADOR_LOGISTICO_TRATAMIENTO";
   $tab_converte["OPERADOR_LOGISTICO_TRATAMIENTO"]   = "operador_logistico_tratamiento";
   $tab_labels["operador_logistico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["operador_logistico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["operador_logistico_tratamiento"] : "OPERADOR LOGISTICO TRATAMIENTO";
   $tab_ger_campos['punto_entrega'] = "on";
   $tab_def_campos['punto_entrega'] = "PUNTO_ENTREGA";
   $tab_converte["PUNTO_ENTREGA"]   = "punto_entrega";
   $tab_labels["punto_entrega"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["punto_entrega"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["punto_entrega"] : "PUNTO ENTREGA";
   $tab_ger_campos['ips_atiende_tratamiento'] = "on";
   $tab_def_campos['ips_atiende_tratamiento'] = "IPS_ATIENDE_TRATAMIENTO";
   $tab_converte["IPS_ATIENDE_TRATAMIENTO"]   = "ips_atiende_tratamiento";
   $tab_labels["ips_atiende_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["ips_atiende_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["ips_atiende_tratamiento"] : "IPS";
   $tab_ger_campos['regimen_tratamiento'] = "on";
   $tab_def_campos['regimen_tratamiento'] = "REGIMEN_TRATAMIENTO";
   $tab_converte["REGIMEN_TRATAMIENTO"]   = "regimen_tratamiento";
   $tab_labels["regimen_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["regimen_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["regimen_tratamiento"] : "REGIMEN TRATAMIENTO";
   $tab_ger_campos['medico_tratamiento'] = "on";
   $tab_def_campos['medico_tratamiento'] = "MEDICO_TRATAMIENTO";
   $tab_converte["MEDICO_TRATAMIENTO"]   = "medico_tratamiento";
   $tab_labels["medico_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["medico_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["medico_tratamiento"] : "MEDICO TRATAMIENTO";
   $tab_ger_campos['tratamiento_previo'] = "on";
   $tab_def_campos['tratamiento_previo'] = "TRATAMIENTO_PREVIO";
   $tab_converte["TRATAMIENTO_PREVIO"]   = "tratamiento_previo";
   $tab_labels["tratamiento_previo"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["tratamiento_previo"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["tratamiento_previo"] : "TRATAMIENTO PREVIO";
   $tab_ger_campos['reclamo_gestion'] = "on";
   $tab_def_campos['reclamo_gestion'] = "RECLAMO_GESTION";
   $tab_converte["RECLAMO_GESTION"]   = "reclamo_gestion";
   $tab_labels["reclamo_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["reclamo_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["reclamo_gestion"] : "RECLAMO GESTION";
   $tab_ger_campos['fecha_reclamacion_gestion'] = "on";
   $tab_def_campos['fecha_reclamacion_gestion'] = "FECHA_RECLAMACION_GESTION";
   $tab_converte["FECHA_RECLAMACION_GESTION"]   = "fecha_reclamacion_gestion";
   $tab_labels["fecha_reclamacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_reclamacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_reclamacion_gestion"] : "FECHA RECLAMACION GESTION";
   $tab_ger_campos['causa_no_reclamacion_gestion'] = "on";
   $tab_def_campos['causa_no_reclamacion_gestion'] = "CAUSA_NO_RECLAMACION_GESTION";
   $tab_converte["CAUSA_NO_RECLAMACION_GESTION"]   = "causa_no_reclamacion_gestion";
   $tab_labels["causa_no_reclamacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["causa_no_reclamacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["causa_no_reclamacion_gestion"] : "CAUSA NO RECLAMACION GESTION";
   $tab_ger_campos['descripcion_comunicacion_gestion'] = "on";
   $tab_def_campos['descripcion_comunicacion_gestion'] = "DESCRIPCION_COMUNICACION_GESTION";
   $tab_converte["DESCRIPCION_COMUNICACION_GESTION"]   = "descripcion_comunicacion_gestion";
   $tab_labels["descripcion_comunicacion_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["descripcion_comunicacion_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["descripcion_comunicacion_gestion"] : "DESCRIPCION COMUNICACION GESTION";
   $tab_ger_campos['fecha_programada_gestion'] = "on";
   $tab_def_campos['fecha_programada_gestion'] = "FECHA_PROGRAMADA_GESTION";
   $tab_converte["FECHA_PROGRAMADA_GESTION"]   = "fecha_programada_gestion";
   $tab_labels["fecha_programada_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_programada_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_programada_gestion"] : "FECHA PROGRAMADA GESTION";
   $tab_ger_campos['id_ultima_gestion'] = "on";
   $tab_def_campos['id_ultima_gestion'] = "ID_ULTIMA_GESTION";
   $tab_converte["ID_ULTIMA_GESTION"]   = "id_ultima_gestion";
   $tab_labels["id_ultima_gestion"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["id_ultima_gestion"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["id_ultima_gestion"] : "ID ULTIMA GESTION";
   $tab_ger_campos['id_tratamiento'] = "on";
   $tab_def_campos['id_tratamiento'] = "ID_TRATAMIENTO";
   $tab_converte["ID_TRATAMIENTO"]   = "id_tratamiento";
   $tab_labels["id_tratamiento"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["id_tratamiento"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["id_tratamiento"] : "ID TRATAMIENTO";
   $tab_ger_campos['id_paciente_fk'] = "on";
   $tab_def_campos['id_paciente_fk'] = "ID_PACIENTE_FK";
   $tab_converte["ID_PACIENTE_FK"]   = "id_paciente_fk";
   $tab_labels["id_paciente_fk"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["id_paciente_fk"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["id_paciente_fk"] : "ID PACIENTE FK";
   $tab_ger_campos['paap'] = "on";
   $tab_def_campos['paap'] = "PAAP";
   $tab_converte["PAAP"]   = "paap";
   $tab_labels["paap"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["paap"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["paap"] : "PAAP";
   $tab_ger_campos['sub_paap'] = "on";
   $tab_def_campos['sub_paap'] = "SUB_PAAP";
   $tab_converte["SUB_PAAP"]   = "sub_paap";
   $tab_labels["sub_paap"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["sub_paap"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["sub_paap"] : "SUB PAAP";
   $tab_ger_campos['barrera'] = "on";
   $tab_def_campos['barrera'] = "BARRERA";
   $tab_converte["BARRERA"]   = "barrera";
   $tab_labels["barrera"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["barrera"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["barrera"] : "BARRERA";
   $tab_ger_campos['fecha_ini_paap'] = "on";
   $tab_def_campos['fecha_ini_paap'] = "FECHA_INI_PAAP";
   $tab_converte["FECHA_INI_PAAP"]   = "fecha_ini_paap";
   $tab_labels["fecha_ini_paap"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_ini_paap"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_ini_paap"] : "FECHA INI PAAP";
   $tab_ger_campos['fecha_fin_paap'] = "on";
   $tab_def_campos['fecha_fin_paap'] = "FECHA_FIN_PAAP";
   $tab_converte["FECHA_FIN_PAAP"]   = "fecha_fin_paap";
   $tab_labels["fecha_fin_paap"]   = (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_fin_paap"])) ? $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['labels']["fecha_fin_paap"] : "FECHA FIN PAAP";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'] = array();
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
   $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_converte[$campo]))
       {
           $_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'][$campo] = $ordem;
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
 <TITLE>Informe Reclamaciones</TITLE>
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
    url: "Informe_reclamacion_order_campos.php",
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
           if (!isset($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'][$tab_def_campos[$NM_cada_field]]))
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
   foreach ($_SESSION['sc_session'][$sc_init]['Informe_reclamacion']['ordem_select'] as $NM_cada_field => $NM_cada_opc)
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

<?php

class Informe_reclamacion_xls
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $xls_dados;
   var $xls_workbook;
   var $xls_col;
   var $xls_row;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $arquivo;
   var $tit_doc;
   //---- 
   function Informe_reclamacion_xls()
   {
   }

   //---- 
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $this->xls_row = 1;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel/Cell/AdvancedValueBinder.php';
      $orig_form_dt = strtoupper($_SESSION['scriptcase']['reg_conf']['date_format']);
      $this->SC_date_conf_region = "";
      for ($i = 0; $i < 8; $i++)
      {
          if ($i > 0 && substr($orig_form_dt, $i, 1) != substr($this->SC_date_conf_region, -1, 1)) {
              $this->SC_date_conf_region .= $_SESSION['scriptcase']['reg_conf']['date_sep'];
          }
          $this->SC_date_conf_region .= substr($orig_form_dt, $i, 1);
      }
      $this->xls_col    = 0;
      $this->nm_data    = new nm_data("es");
      $this->arquivo    = "sc_xls";
      $this->arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->arquivo   .= "_Informe_reclamacion";
      $this->arquivo   .= ".xls";
      $this->tit_doc    = "Informe_reclamacion.xls";
      $this->xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );;
      $this->xls_dados = new PHPExcel();
      $this->xls_dados->setActiveSheetIndex(0);
      $this->Nm_ActiveSheet = $this->xls_dados->getActiveSheet();
      if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
      {
          $this->Nm_ActiveSheet->setRightToLeft(true);
      }
   }

   //----- 
   function grava_arquivo()
   {
      global $nm_lang;
      global
             $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xls_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xls_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xls_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xls_name']);
          $this->xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_8, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_9, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_10, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_11, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_12, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_13, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_14, gestiones.FECHA_MEDICAMENTO_HASTA as cmp_maior_30_15, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_16, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_17, tratamiento.PUNTO_ENTREGA as cmp_maior_30_18, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_19, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_20, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_21, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_22, gestiones.RECLAMO_GESTION as cmp_maior_30_23, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_24, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_25, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_26, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_27, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_28, tratamiento.ID_TRATAMIENTO as cmp_maior_30_29, tratamiento.ID_PACIENTE_FK as cmp_maior_30_30, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_8, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_9, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_10, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_11, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_12, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_13, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_14, gestiones.FECHA_MEDICAMENTO_HASTA as cmp_maior_30_15, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_16, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_17, tratamiento.PUNTO_ENTREGA as cmp_maior_30_18, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_19, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_20, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_21, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_22, gestiones.RECLAMO_GESTION as cmp_maior_30_23, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_24, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_25, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_26, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_27, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_28, tratamiento.ID_TRATAMIENTO as cmp_maior_30_29, tratamiento.ID_PACIENTE_FK as cmp_maior_30_30, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_8, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_9, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_10, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_11, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_12, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_13, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_14, gestiones.FECHA_MEDICAMENTO_HASTA as cmp_maior_30_15, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_16, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_17, tratamiento.PUNTO_ENTREGA as cmp_maior_30_18, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_19, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_20, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_21, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_22, gestiones.RECLAMO_GESTION as cmp_maior_30_23, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_24, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_25, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_26, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_27, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_28, tratamiento.ID_TRATAMIENTO as cmp_maior_30_29, tratamiento.ID_PACIENTE_FK as cmp_maior_30_30, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, TO_DATE(TO_CHAR(gestiones.FECHA_COMUNICACION, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss') as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_8, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_9, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_10, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_11, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_12, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_13, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_14, gestiones.FECHA_MEDICAMENTO_HASTA as cmp_maior_30_15, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_16, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_17, tratamiento.PUNTO_ENTREGA as cmp_maior_30_18, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_19, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_20, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_21, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_22, gestiones.RECLAMO_GESTION as cmp_maior_30_23, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_24, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_25, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_26, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_27, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_28, tratamiento.ID_TRATAMIENTO as cmp_maior_30_29, tratamiento.ID_PACIENTE_FK as cmp_maior_30_30, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_8, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_9, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_10, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_11, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_12, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_13, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_14, gestiones.FECHA_MEDICAMENTO_HASTA as cmp_maior_30_15, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_16, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_17, tratamiento.PUNTO_ENTREGA as cmp_maior_30_18, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_19, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_20, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_21, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_22, gestiones.RECLAMO_GESTION as cmp_maior_30_23, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_24, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_25, LOTOFILE(gestiones.DESCRIPCION_COMUNICACION_GESTION, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as cmp_maior_30_26, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_27, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_28, tratamiento.ID_TRATAMIENTO as cmp_maior_30_29, tratamiento.ID_PACIENTE_FK as cmp_maior_30_30, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_8, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_9, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_10, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_11, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_12, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_13, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_14, gestiones.FECHA_MEDICAMENTO_HASTA as cmp_maior_30_15, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_16, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_17, tratamiento.PUNTO_ENTREGA as cmp_maior_30_18, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_19, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_20, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_21, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_22, gestiones.RECLAMO_GESTION as cmp_maior_30_23, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_24, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_25, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_26, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_27, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_28, tratamiento.ID_TRATAMIENTO as cmp_maior_30_29, tratamiento.ID_PACIENTE_FK as cmp_maior_30_30, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['pacientes_id_paciente'])) ? $this->New_label['pacientes_id_paciente'] : "ID PACIENTE"; 
          if ($Cada_col == "pacientes_id_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_logro_comunicacion_gestion'])) ? $this->New_label['gestiones_logro_comunicacion_gestion'] : "LOGRO COMUNICACION GESTION"; 
          if ($Cada_col == "gestiones_logro_comunicacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_fecha_comunicacion'])) ? $this->New_label['gestiones_fecha_comunicacion'] : "FECHA COMUNICACION"; 
          if ($Cada_col == "gestiones_fecha_comunicacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_autor_gestion'])) ? $this->New_label['gestiones_autor_gestion'] : "AUTOR GESTION"; 
          if ($Cada_col == "gestiones_autor_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_departamento_paciente'])) ? $this->New_label['pacientes_departamento_paciente'] : "DEPARTAMENTO PACIENTE"; 
          if ($Cada_col == "pacientes_departamento_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_ciudad_paciente'])) ? $this->New_label['pacientes_ciudad_paciente'] : "CIUDAD PACIENTE"; 
          if ($Cada_col == "pacientes_ciudad_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_estado_paciente'])) ? $this->New_label['pacientes_estado_paciente'] : "ESTADO PACIENTE"; 
          if ($Cada_col == "pacientes_estado_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_status_paciente'])) ? $this->New_label['pacientes_status_paciente'] : "STATUS PACIENTE"; 
          if ($Cada_col == "pacientes_status_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_fecha_activacion_paciente'])) ? $this->New_label['pacientes_fecha_activacion_paciente'] : "FECHA ACTIVACION PACIENTE"; 
          if ($Cada_col == "pacientes_fecha_activacion_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_fecha_retiro_paciente'])) ? $this->New_label['pacientes_fecha_retiro_paciente'] : "FECHA RETIRO PACIENTE"; 
          if ($Cada_col == "pacientes_fecha_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_motivo_retiro_paciente'])) ? $this->New_label['pacientes_motivo_retiro_paciente'] : "MOTIVO RETIRO PACIENTE"; 
          if ($Cada_col == "pacientes_motivo_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_fecha_inicio_terapia_tratamiento'])) ? $this->New_label['tratamiento_fecha_inicio_terapia_tratamiento'] : "FECHA INICIO TERAPIA TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_fecha_inicio_terapia_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_codigo_xofigo'])) ? $this->New_label['pacientes_codigo_xofigo'] : "CODIGO XOFIGO"; 
          if ($Cada_col == "pacientes_codigo_xofigo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_clasificacion_patologica_tratamiento'])) ? $this->New_label['tratamiento_clasificacion_patologica_tratamiento'] : "CLASIFICACION PATOLOGICA TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_clasificacion_patologica_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_producto_tratamiento'])) ? $this->New_label['tratamiento_producto_tratamiento'] : "PRODUCTO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_producto_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_nombre_referencia'])) ? $this->New_label['tratamiento_nombre_referencia'] : "NOMBRE REFERENCIA"; 
          if ($Cada_col == "tratamiento_nombre_referencia" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_dosis_tratamiento'])) ? $this->New_label['tratamiento_dosis_tratamiento'] : "DOSIS TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_dosis_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_fecha_medicamento_hasta'])) ? $this->New_label['gestiones_fecha_medicamento_hasta'] : "MEDICAMENTO HASTA"; 
          if ($Cada_col == "gestiones_fecha_medicamento_hasta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_numero_cajas'])) ? $this->New_label['gestiones_numero_cajas'] : "NUMERO CAJAS"; 
          if ($Cada_col == "gestiones_numero_cajas" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_asegurador_tratamiento'])) ? $this->New_label['tratamiento_asegurador_tratamiento'] : "ASEGURADOR TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_asegurador_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_operador_logistico_tratamiento'])) ? $this->New_label['tratamiento_operador_logistico_tratamiento'] : "OPERADOR LOGISTICO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_operador_logistico_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_punto_entrega'])) ? $this->New_label['tratamiento_punto_entrega'] : "PUNTO ENTREGA"; 
          if ($Cada_col == "tratamiento_punto_entrega" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_ips_atiende_tratamiento'])) ? $this->New_label['tratamiento_ips_atiende_tratamiento'] : "IPS"; 
          if ($Cada_col == "tratamiento_ips_atiende_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_regimen_tratamiento'])) ? $this->New_label['tratamiento_regimen_tratamiento'] : "REGIMEN TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_regimen_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_medico_tratamiento'])) ? $this->New_label['tratamiento_medico_tratamiento'] : "MEDICO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_medico_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_tratamiento_previo'])) ? $this->New_label['tratamiento_tratamiento_previo'] : "TRATAMIENTO PREVIO"; 
          if ($Cada_col == "tratamiento_tratamiento_previo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_reclamo_gestion'])) ? $this->New_label['gestiones_reclamo_gestion'] : "RECLAMO GESTION"; 
          if ($Cada_col == "gestiones_reclamo_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_fecha_reclamacion_gestion'])) ? $this->New_label['gestiones_fecha_reclamacion_gestion'] : "FECHA RECLAMACION GESTION"; 
          if ($Cada_col == "gestiones_fecha_reclamacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_causa_no_reclamacion_gestion'])) ? $this->New_label['gestiones_causa_no_reclamacion_gestion'] : "CAUSA NO RECLAMACION GESTION"; 
          if ($Cada_col == "gestiones_causa_no_reclamacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_descripcion_comunicacion_gestion'])) ? $this->New_label['gestiones_descripcion_comunicacion_gestion'] : "DESCRIPCION COMUNICACION GESTION"; 
          if ($Cada_col == "gestiones_descripcion_comunicacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_fecha_programada_gestion'])) ? $this->New_label['gestiones_fecha_programada_gestion'] : "FECHA PROGRAMADA GESTION"; 
          if ($Cada_col == "gestiones_fecha_programada_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_id_ultima_gestion'])) ? $this->New_label['pacientes_id_ultima_gestion'] : "ID ULTIMA GESTION"; 
          if ($Cada_col == "pacientes_id_ultima_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_id_tratamiento'])) ? $this->New_label['tratamiento_id_tratamiento'] : "ID TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_id_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_id_paciente_fk'])) ? $this->New_label['tratamiento_id_paciente_fk'] : "ID PACIENTE FK"; 
          if ($Cada_col == "tratamiento_id_paciente_fk" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_paap'])) ? $this->New_label['gestiones_paap'] : "PAAP"; 
          if ($Cada_col == "gestiones_paap" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_sub_paap'])) ? $this->New_label['gestiones_sub_paap'] : "SUB PAAP"; 
          if ($Cada_col == "gestiones_sub_paap" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_barrera'])) ? $this->New_label['gestiones_barrera'] : "BARRERA"; 
          if ($Cada_col == "gestiones_barrera" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
      } 
      while (!$rs->EOF)
      {
         $this->xls_col = 0;
         $this->xls_row++;
         $this->pacientes_id_paciente = $rs->fields[0] ;  
         $this->pacientes_id_paciente = (string)$this->pacientes_id_paciente;
         $this->gestiones_logro_comunicacion_gestion = $rs->fields[1] ;  
         $this->gestiones_fecha_comunicacion = $rs->fields[2] ;  
         $this->gestiones_autor_gestion = $rs->fields[3] ;  
         $this->pacientes_departamento_paciente = $rs->fields[4] ;  
         $this->pacientes_ciudad_paciente = $rs->fields[5] ;  
         $this->pacientes_estado_paciente = $rs->fields[6] ;  
         $this->pacientes_status_paciente = $rs->fields[7] ;  
         $this->pacientes_fecha_activacion_paciente = $rs->fields[8] ;  
         $this->pacientes_fecha_retiro_paciente = $rs->fields[9] ;  
         $this->pacientes_motivo_retiro_paciente = $rs->fields[10] ;  
         $this->tratamiento_fecha_inicio_terapia_tratamiento = $rs->fields[11] ;  
         $this->pacientes_codigo_xofigo = $rs->fields[12] ;  
         $this->pacientes_codigo_xofigo = (string)$this->pacientes_codigo_xofigo;
         $this->tratamiento_clasificacion_patologica_tratamiento = $rs->fields[13] ;  
         $this->tratamiento_producto_tratamiento = $rs->fields[14] ;  
         $this->tratamiento_nombre_referencia = $rs->fields[15] ;  
         $this->tratamiento_dosis_tratamiento = $rs->fields[16] ;  
         $this->gestiones_fecha_medicamento_hasta = $rs->fields[17] ;  
         $this->gestiones_numero_cajas = $rs->fields[18] ;  
         $this->tratamiento_asegurador_tratamiento = $rs->fields[19] ;  
         $this->tratamiento_operador_logistico_tratamiento = $rs->fields[20] ;  
         $this->tratamiento_punto_entrega = $rs->fields[21] ;  
         $this->tratamiento_ips_atiende_tratamiento = $rs->fields[22] ;  
         $this->tratamiento_regimen_tratamiento = $rs->fields[23] ;  
         $this->tratamiento_medico_tratamiento = $rs->fields[24] ;  
         $this->tratamiento_tratamiento_previo = $rs->fields[25] ;  
         $this->gestiones_reclamo_gestion = $rs->fields[26] ;  
         $this->gestiones_fecha_reclamacion_gestion = $rs->fields[27] ;  
         $this->gestiones_causa_no_reclamacion_gestion = $rs->fields[28] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->gestiones_descripcion_comunicacion_gestion = "";  
              if (is_file($rs_grid->fields[29])) 
              { 
                  $this->gestiones_descripcion_comunicacion_gestion = file_get_contents($rs_grid->fields[29]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->gestiones_descripcion_comunicacion_gestion = $this->Db->BlobDecode($rs->fields[29]) ;  
         } 
         else
         { 
             $this->gestiones_descripcion_comunicacion_gestion = $rs->fields[29] ;  
         } 
         $this->gestiones_fecha_programada_gestion = $rs->fields[30] ;  
         $this->pacientes_id_ultima_gestion = $rs->fields[31] ;  
         $this->pacientes_id_ultima_gestion = (string)$this->pacientes_id_ultima_gestion;
         $this->tratamiento_id_tratamiento = $rs->fields[32] ;  
         $this->tratamiento_id_tratamiento = (string)$this->tratamiento_id_tratamiento;
         $this->tratamiento_id_paciente_fk = $rs->fields[33] ;  
         $this->tratamiento_id_paciente_fk = (string)$this->tratamiento_id_paciente_fk;
         $this->gestiones_paap = $rs->fields[34] ;  
         $this->gestiones_sub_paap = $rs->fields[35] ;  
         $this->gestiones_barrera = $rs->fields[36] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if (isset($this->NM_Row_din[$this->xls_row]))
         { 
             $this->Nm_ActiveSheet->getRowDimension($this->xls_row)->setRowHeight($this->NM_Row_din[$this->xls_row]);
         } 
         $rs->MoveNext();
      }
      if (isset($this->NM_Col_din))
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      $rs->Close();
      $objWriter = new PHPExcel_Writer_Excel5($this->xls_dados);
      $objWriter->save($this->xls_f);
   }
   //----- pacientes_id_paciente
   function NM_export_pacientes_id_paciente()
   {
         $this->pacientes_id_paciente = html_entity_decode($this->pacientes_id_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_id_paciente = strip_tags($this->pacientes_id_paciente);
         if (!NM_is_utf8($this->pacientes_id_paciente))
         {
             $this->pacientes_id_paciente = sc_convert_encoding($this->pacientes_id_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_id_paciente, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_logro_comunicacion_gestion
   function NM_export_gestiones_logro_comunicacion_gestion()
   {
         $this->gestiones_logro_comunicacion_gestion = html_entity_decode($this->gestiones_logro_comunicacion_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_logro_comunicacion_gestion = strip_tags($this->gestiones_logro_comunicacion_gestion);
         if (!NM_is_utf8($this->gestiones_logro_comunicacion_gestion))
         {
             $this->gestiones_logro_comunicacion_gestion = sc_convert_encoding($this->gestiones_logro_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_logro_comunicacion_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_fecha_comunicacion
   function NM_export_gestiones_fecha_comunicacion()
   {
         if (substr($this->gestiones_fecha_comunicacion, 10, 1) == "-") 
         { 
             $this->gestiones_fecha_comunicacion = substr($this->gestiones_fecha_comunicacion, 0, 10) . " " . substr($this->gestiones_fecha_comunicacion, 11);
         } 
         if (substr($this->gestiones_fecha_comunicacion, 13, 1) == ".") 
         { 
            $this->gestiones_fecha_comunicacion = substr($this->gestiones_fecha_comunicacion, 0, 13) . ":" . substr($this->gestiones_fecha_comunicacion, 14, 2) . ":" . substr($this->gestiones_fecha_comunicacion, 17);
         } 
         $this->nm_data->SetaData($this->gestiones_fecha_comunicacion, "YYYY-MM-DD HH:II:SS");
         $this->gestiones_fecha_comunicacion = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         if (!NM_is_utf8($this->gestiones_fecha_comunicacion))
         {
             $this->gestiones_fecha_comunicacion = sc_convert_encoding($this->gestiones_fecha_comunicacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_fecha_comunicacion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_autor_gestion
   function NM_export_gestiones_autor_gestion()
   {
         $this->gestiones_autor_gestion = html_entity_decode($this->gestiones_autor_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_autor_gestion = strip_tags($this->gestiones_autor_gestion);
         if (!NM_is_utf8($this->gestiones_autor_gestion))
         {
             $this->gestiones_autor_gestion = sc_convert_encoding($this->gestiones_autor_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_autor_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- pacientes_departamento_paciente
   function NM_export_pacientes_departamento_paciente()
   {
         $this->pacientes_departamento_paciente = html_entity_decode($this->pacientes_departamento_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_departamento_paciente = strip_tags($this->pacientes_departamento_paciente);
         if (!NM_is_utf8($this->pacientes_departamento_paciente))
         {
             $this->pacientes_departamento_paciente = sc_convert_encoding($this->pacientes_departamento_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_departamento_paciente, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- pacientes_ciudad_paciente
   function NM_export_pacientes_ciudad_paciente()
   {
         $this->pacientes_ciudad_paciente = html_entity_decode($this->pacientes_ciudad_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_ciudad_paciente = strip_tags($this->pacientes_ciudad_paciente);
         if (!NM_is_utf8($this->pacientes_ciudad_paciente))
         {
             $this->pacientes_ciudad_paciente = sc_convert_encoding($this->pacientes_ciudad_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_ciudad_paciente, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- pacientes_estado_paciente
   function NM_export_pacientes_estado_paciente()
   {
         $this->pacientes_estado_paciente = html_entity_decode($this->pacientes_estado_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_estado_paciente = strip_tags($this->pacientes_estado_paciente);
         if (!NM_is_utf8($this->pacientes_estado_paciente))
         {
             $this->pacientes_estado_paciente = sc_convert_encoding($this->pacientes_estado_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_estado_paciente, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- pacientes_status_paciente
   function NM_export_pacientes_status_paciente()
   {
         $this->pacientes_status_paciente = html_entity_decode($this->pacientes_status_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_status_paciente = strip_tags($this->pacientes_status_paciente);
         if (!NM_is_utf8($this->pacientes_status_paciente))
         {
             $this->pacientes_status_paciente = sc_convert_encoding($this->pacientes_status_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_status_paciente, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- pacientes_fecha_activacion_paciente
   function NM_export_pacientes_fecha_activacion_paciente()
   {
         $this->pacientes_fecha_activacion_paciente = html_entity_decode($this->pacientes_fecha_activacion_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_fecha_activacion_paciente = strip_tags($this->pacientes_fecha_activacion_paciente);
         if (!NM_is_utf8($this->pacientes_fecha_activacion_paciente))
         {
             $this->pacientes_fecha_activacion_paciente = sc_convert_encoding($this->pacientes_fecha_activacion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_fecha_activacion_paciente, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- pacientes_fecha_retiro_paciente
   function NM_export_pacientes_fecha_retiro_paciente()
   {
         $this->pacientes_fecha_retiro_paciente = html_entity_decode($this->pacientes_fecha_retiro_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_fecha_retiro_paciente = strip_tags($this->pacientes_fecha_retiro_paciente);
         if (!NM_is_utf8($this->pacientes_fecha_retiro_paciente))
         {
             $this->pacientes_fecha_retiro_paciente = sc_convert_encoding($this->pacientes_fecha_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_fecha_retiro_paciente, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- pacientes_motivo_retiro_paciente
   function NM_export_pacientes_motivo_retiro_paciente()
   {
         $this->pacientes_motivo_retiro_paciente = html_entity_decode($this->pacientes_motivo_retiro_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_motivo_retiro_paciente = strip_tags($this->pacientes_motivo_retiro_paciente);
         if (!NM_is_utf8($this->pacientes_motivo_retiro_paciente))
         {
             $this->pacientes_motivo_retiro_paciente = sc_convert_encoding($this->pacientes_motivo_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_motivo_retiro_paciente, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_fecha_inicio_terapia_tratamiento
   function NM_export_tratamiento_fecha_inicio_terapia_tratamiento()
   {
         $this->tratamiento_fecha_inicio_terapia_tratamiento = html_entity_decode($this->tratamiento_fecha_inicio_terapia_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_fecha_inicio_terapia_tratamiento = strip_tags($this->tratamiento_fecha_inicio_terapia_tratamiento);
         if (!NM_is_utf8($this->tratamiento_fecha_inicio_terapia_tratamiento))
         {
             $this->tratamiento_fecha_inicio_terapia_tratamiento = sc_convert_encoding($this->tratamiento_fecha_inicio_terapia_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_fecha_inicio_terapia_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- pacientes_codigo_xofigo
   function NM_export_pacientes_codigo_xofigo()
   {
         if (!NM_is_utf8($this->pacientes_codigo_xofigo))
         {
             $this->pacientes_codigo_xofigo = sc_convert_encoding($this->pacientes_codigo_xofigo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->pacientes_codigo_xofigo))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_codigo_xofigo);
         $this->xls_col++;
   }
   //----- tratamiento_clasificacion_patologica_tratamiento
   function NM_export_tratamiento_clasificacion_patologica_tratamiento()
   {
         $this->tratamiento_clasificacion_patologica_tratamiento = html_entity_decode($this->tratamiento_clasificacion_patologica_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_clasificacion_patologica_tratamiento = strip_tags($this->tratamiento_clasificacion_patologica_tratamiento);
         if (!NM_is_utf8($this->tratamiento_clasificacion_patologica_tratamiento))
         {
             $this->tratamiento_clasificacion_patologica_tratamiento = sc_convert_encoding($this->tratamiento_clasificacion_patologica_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_clasificacion_patologica_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_producto_tratamiento
   function NM_export_tratamiento_producto_tratamiento()
   {
         $this->tratamiento_producto_tratamiento = html_entity_decode($this->tratamiento_producto_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_producto_tratamiento = strip_tags($this->tratamiento_producto_tratamiento);
         if (!NM_is_utf8($this->tratamiento_producto_tratamiento))
         {
             $this->tratamiento_producto_tratamiento = sc_convert_encoding($this->tratamiento_producto_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_producto_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_nombre_referencia
   function NM_export_tratamiento_nombre_referencia()
   {
         $this->tratamiento_nombre_referencia = html_entity_decode($this->tratamiento_nombre_referencia, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_nombre_referencia = strip_tags($this->tratamiento_nombre_referencia);
         if (!NM_is_utf8($this->tratamiento_nombre_referencia))
         {
             $this->tratamiento_nombre_referencia = sc_convert_encoding($this->tratamiento_nombre_referencia, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_nombre_referencia, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_dosis_tratamiento
   function NM_export_tratamiento_dosis_tratamiento()
   {
         $this->tratamiento_dosis_tratamiento = html_entity_decode($this->tratamiento_dosis_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_dosis_tratamiento = strip_tags($this->tratamiento_dosis_tratamiento);
         if (!NM_is_utf8($this->tratamiento_dosis_tratamiento))
         {
             $this->tratamiento_dosis_tratamiento = sc_convert_encoding($this->tratamiento_dosis_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_dosis_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_fecha_medicamento_hasta
   function NM_export_gestiones_fecha_medicamento_hasta()
   {
         $this->gestiones_fecha_medicamento_hasta = html_entity_decode($this->gestiones_fecha_medicamento_hasta, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_fecha_medicamento_hasta = strip_tags($this->gestiones_fecha_medicamento_hasta);
         if (!NM_is_utf8($this->gestiones_fecha_medicamento_hasta))
         {
             $this->gestiones_fecha_medicamento_hasta = sc_convert_encoding($this->gestiones_fecha_medicamento_hasta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_fecha_medicamento_hasta, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_numero_cajas
   function NM_export_gestiones_numero_cajas()
   {
         $this->gestiones_numero_cajas = html_entity_decode($this->gestiones_numero_cajas, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_numero_cajas = strip_tags($this->gestiones_numero_cajas);
         if (!NM_is_utf8($this->gestiones_numero_cajas))
         {
             $this->gestiones_numero_cajas = sc_convert_encoding($this->gestiones_numero_cajas, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_numero_cajas, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_asegurador_tratamiento
   function NM_export_tratamiento_asegurador_tratamiento()
   {
         $this->tratamiento_asegurador_tratamiento = html_entity_decode($this->tratamiento_asegurador_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_asegurador_tratamiento = strip_tags($this->tratamiento_asegurador_tratamiento);
         if (!NM_is_utf8($this->tratamiento_asegurador_tratamiento))
         {
             $this->tratamiento_asegurador_tratamiento = sc_convert_encoding($this->tratamiento_asegurador_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_asegurador_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_operador_logistico_tratamiento
   function NM_export_tratamiento_operador_logistico_tratamiento()
   {
         $this->tratamiento_operador_logistico_tratamiento = html_entity_decode($this->tratamiento_operador_logistico_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_operador_logistico_tratamiento = strip_tags($this->tratamiento_operador_logistico_tratamiento);
         if (!NM_is_utf8($this->tratamiento_operador_logistico_tratamiento))
         {
             $this->tratamiento_operador_logistico_tratamiento = sc_convert_encoding($this->tratamiento_operador_logistico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_operador_logistico_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_punto_entrega
   function NM_export_tratamiento_punto_entrega()
   {
         $this->tratamiento_punto_entrega = html_entity_decode($this->tratamiento_punto_entrega, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_punto_entrega = strip_tags($this->tratamiento_punto_entrega);
         if (!NM_is_utf8($this->tratamiento_punto_entrega))
         {
             $this->tratamiento_punto_entrega = sc_convert_encoding($this->tratamiento_punto_entrega, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_punto_entrega, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_ips_atiende_tratamiento
   function NM_export_tratamiento_ips_atiende_tratamiento()
   {
         $this->tratamiento_ips_atiende_tratamiento = html_entity_decode($this->tratamiento_ips_atiende_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_ips_atiende_tratamiento = strip_tags($this->tratamiento_ips_atiende_tratamiento);
         if (!NM_is_utf8($this->tratamiento_ips_atiende_tratamiento))
         {
             $this->tratamiento_ips_atiende_tratamiento = sc_convert_encoding($this->tratamiento_ips_atiende_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_ips_atiende_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_regimen_tratamiento
   function NM_export_tratamiento_regimen_tratamiento()
   {
         $this->tratamiento_regimen_tratamiento = html_entity_decode($this->tratamiento_regimen_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_regimen_tratamiento = strip_tags($this->tratamiento_regimen_tratamiento);
         if (!NM_is_utf8($this->tratamiento_regimen_tratamiento))
         {
             $this->tratamiento_regimen_tratamiento = sc_convert_encoding($this->tratamiento_regimen_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_regimen_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_medico_tratamiento
   function NM_export_tratamiento_medico_tratamiento()
   {
         $this->tratamiento_medico_tratamiento = html_entity_decode($this->tratamiento_medico_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_medico_tratamiento = strip_tags($this->tratamiento_medico_tratamiento);
         if (!NM_is_utf8($this->tratamiento_medico_tratamiento))
         {
             $this->tratamiento_medico_tratamiento = sc_convert_encoding($this->tratamiento_medico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_medico_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_tratamiento_previo
   function NM_export_tratamiento_tratamiento_previo()
   {
         $this->tratamiento_tratamiento_previo = html_entity_decode($this->tratamiento_tratamiento_previo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_tratamiento_previo = strip_tags($this->tratamiento_tratamiento_previo);
         if (!NM_is_utf8($this->tratamiento_tratamiento_previo))
         {
             $this->tratamiento_tratamiento_previo = sc_convert_encoding($this->tratamiento_tratamiento_previo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_tratamiento_previo, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_reclamo_gestion
   function NM_export_gestiones_reclamo_gestion()
   {
         $this->gestiones_reclamo_gestion = html_entity_decode($this->gestiones_reclamo_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_reclamo_gestion = strip_tags($this->gestiones_reclamo_gestion);
         if (!NM_is_utf8($this->gestiones_reclamo_gestion))
         {
             $this->gestiones_reclamo_gestion = sc_convert_encoding($this->gestiones_reclamo_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_reclamo_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_fecha_reclamacion_gestion
   function NM_export_gestiones_fecha_reclamacion_gestion()
   {
         $this->gestiones_fecha_reclamacion_gestion = html_entity_decode($this->gestiones_fecha_reclamacion_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_fecha_reclamacion_gestion = strip_tags($this->gestiones_fecha_reclamacion_gestion);
         if (!NM_is_utf8($this->gestiones_fecha_reclamacion_gestion))
         {
             $this->gestiones_fecha_reclamacion_gestion = sc_convert_encoding($this->gestiones_fecha_reclamacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_fecha_reclamacion_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_causa_no_reclamacion_gestion
   function NM_export_gestiones_causa_no_reclamacion_gestion()
   {
         $this->gestiones_causa_no_reclamacion_gestion = html_entity_decode($this->gestiones_causa_no_reclamacion_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_causa_no_reclamacion_gestion = strip_tags($this->gestiones_causa_no_reclamacion_gestion);
         if (!NM_is_utf8($this->gestiones_causa_no_reclamacion_gestion))
         {
             $this->gestiones_causa_no_reclamacion_gestion = sc_convert_encoding($this->gestiones_causa_no_reclamacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_causa_no_reclamacion_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_descripcion_comunicacion_gestion
   function NM_export_gestiones_descripcion_comunicacion_gestion()
   {
         $this->gestiones_descripcion_comunicacion_gestion = html_entity_decode($this->gestiones_descripcion_comunicacion_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_descripcion_comunicacion_gestion = strip_tags($this->gestiones_descripcion_comunicacion_gestion);
         if (!NM_is_utf8($this->gestiones_descripcion_comunicacion_gestion))
         {
             $this->gestiones_descripcion_comunicacion_gestion = sc_convert_encoding($this->gestiones_descripcion_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_descripcion_comunicacion_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_fecha_programada_gestion
   function NM_export_gestiones_fecha_programada_gestion()
   {
         $this->gestiones_fecha_programada_gestion = html_entity_decode($this->gestiones_fecha_programada_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_fecha_programada_gestion = strip_tags($this->gestiones_fecha_programada_gestion);
         if (!NM_is_utf8($this->gestiones_fecha_programada_gestion))
         {
             $this->gestiones_fecha_programada_gestion = sc_convert_encoding($this->gestiones_fecha_programada_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_fecha_programada_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- pacientes_id_ultima_gestion
   function NM_export_pacientes_id_ultima_gestion()
   {
         $this->pacientes_id_ultima_gestion = html_entity_decode($this->pacientes_id_ultima_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_id_ultima_gestion = strip_tags($this->pacientes_id_ultima_gestion);
         if (!NM_is_utf8($this->pacientes_id_ultima_gestion))
         {
             $this->pacientes_id_ultima_gestion = sc_convert_encoding($this->pacientes_id_ultima_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_id_ultima_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_id_tratamiento
   function NM_export_tratamiento_id_tratamiento()
   {
         $this->tratamiento_id_tratamiento = html_entity_decode($this->tratamiento_id_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_id_tratamiento = strip_tags($this->tratamiento_id_tratamiento);
         if (!NM_is_utf8($this->tratamiento_id_tratamiento))
         {
             $this->tratamiento_id_tratamiento = sc_convert_encoding($this->tratamiento_id_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_id_tratamiento, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- tratamiento_id_paciente_fk
   function NM_export_tratamiento_id_paciente_fk()
   {
         $this->tratamiento_id_paciente_fk = html_entity_decode($this->tratamiento_id_paciente_fk, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_id_paciente_fk = strip_tags($this->tratamiento_id_paciente_fk);
         if (!NM_is_utf8($this->tratamiento_id_paciente_fk))
         {
             $this->tratamiento_id_paciente_fk = sc_convert_encoding($this->tratamiento_id_paciente_fk, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->tratamiento_id_paciente_fk, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_paap
   function NM_export_gestiones_paap()
   {
         if (!NM_is_utf8($this->gestiones_paap))
         {
             $this->gestiones_paap = sc_convert_encoding($this->gestiones_paap, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_paap, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_sub_paap
   function NM_export_gestiones_sub_paap()
   {
         $this->gestiones_sub_paap = html_entity_decode($this->gestiones_sub_paap, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_sub_paap = strip_tags($this->gestiones_sub_paap);
         if (!NM_is_utf8($this->gestiones_sub_paap))
         {
             $this->gestiones_sub_paap = sc_convert_encoding($this->gestiones_sub_paap, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_sub_paap, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_barrera
   function NM_export_gestiones_barrera()
   {
         $this->gestiones_barrera = html_entity_decode($this->gestiones_barrera, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_barrera = strip_tags($this->gestiones_barrera);
         if (!NM_is_utf8($this->gestiones_barrera))
         {
             $this->gestiones_barrera = sc_convert_encoding($this->gestiones_barrera, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_barrera, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }

   function calc_cell($col)
   {
       $arr_alfa = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
       $val_ret = "";
       $result = $col + 1;
       while ($result > 26)
       {
           $cel      = $result % 26;
           $result   = $result / 26;
           if ($cel == 0)
           {
               $cel    = 26;
               $result--;
           }
           $val_ret = $arr_alfa[$cel] . $val_ret;
       }
       $val_ret = $arr_alfa[$result] . $val_ret;
       return $val_ret;
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT")
       {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT")
       {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       nm_conv_form_data($dt_out, $form_in, $form_out);
       return $dt_out;
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xls_file']);
      if (is_file($this->xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xls_file'] = $this->xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Informe Reclamaciones :: Excel</TITLE>
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
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">XLS</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="Informe_reclamacion_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="Informe_reclamacion"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
}

?>

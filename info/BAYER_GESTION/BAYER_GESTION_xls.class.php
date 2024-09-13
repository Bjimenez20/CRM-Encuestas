<?php

class GESTION_xls
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
   function GESTION_xls()
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
      $this->arquivo   .= "_GESTION";
      $this->arquivo   .= ".xls";
      $this->tit_doc    = "GESTION.xls";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['GESTION']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['GESTION']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['GESTION']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->gestiones_tipo_llamada_gestion = $Busca_temp['gestiones_tipo_llamada_gestion']; 
          $tmp_pos = strpos($this->gestiones_tipo_llamada_gestion, "##@@");
          if ($tmp_pos !== false)
          {
              $this->gestiones_tipo_llamada_gestion = substr($this->gestiones_tipo_llamada_gestion, 0, $tmp_pos);
          }
          $this->gestiones_id_gestion = $Busca_temp['gestiones_id_gestion']; 
          $tmp_pos = strpos($this->gestiones_id_gestion, "##@@");
          if ($tmp_pos !== false)
          {
              $this->gestiones_id_gestion = substr($this->gestiones_id_gestion, 0, $tmp_pos);
          }
          $this->gestiones_id_gestion_2 = $Busca_temp['gestiones_id_gestion_input_2']; 
          $this->gestiones_motivo_comunicacion_gestion = $Busca_temp['gestiones_motivo_comunicacion_gestion']; 
          $tmp_pos = strpos($this->gestiones_motivo_comunicacion_gestion, "##@@");
          if ($tmp_pos !== false)
          {
              $this->gestiones_motivo_comunicacion_gestion = substr($this->gestiones_motivo_comunicacion_gestion, 0, $tmp_pos);
          }
          $this->gestiones_medio_contacto_gestion = $Busca_temp['gestiones_medio_contacto_gestion']; 
          $tmp_pos = strpos($this->gestiones_medio_contacto_gestion, "##@@");
          if ($tmp_pos !== false)
          {
              $this->gestiones_medio_contacto_gestion = substr($this->gestiones_medio_contacto_gestion, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xls_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xls_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xls_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xls_name']);
          $this->xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_2, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_3, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_4, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_5, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_6, gestiones.ESPERADO_GESTION as cmp_maior_30_7, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_8, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_9, gestiones.RECLAMO_GESTION as cmp_maior_30_10, gestiones.CONSECUTIVO_BETAFERON as cmp_maior_30_11, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_12, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_13, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_14, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_15, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_16, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_17, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_18, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_19, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_20, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_21, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_22, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_23, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_24, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_25, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_26, gestiones.USUARIO_ASIGANDO as cmp_maior_30_27, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_28, gestiones.FECHA_COMUNICACION as cmp_maior_30_29, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.AUTOR_MODIFICACION as cmp_maior_30_30, gestiones.NUMERO_NEBULIZACIONES as cmp_maior_30_31, gestiones.FECHA_SUBIDO as gestiones_fecha_subido, gestiones.NUMERO_TABLETAS_DIARIAS as cmp_maior_30_32, gestiones.BRINDO_APOYO as gestiones_brindo_apoyo, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera, gestiones.INFORMACION_APLICACIONES as cmp_maior_30_33 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_2, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_3, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_4, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_5, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_6, gestiones.ESPERADO_GESTION as cmp_maior_30_7, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_8, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_9, gestiones.RECLAMO_GESTION as cmp_maior_30_10, gestiones.CONSECUTIVO_BETAFERON as cmp_maior_30_11, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_12, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_13, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_14, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_15, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_16, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_17, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_18, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_19, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_20, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_21, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_22, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_23, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_24, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_25, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_26, gestiones.USUARIO_ASIGANDO as cmp_maior_30_27, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_28, gestiones.FECHA_COMUNICACION as cmp_maior_30_29, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.AUTOR_MODIFICACION as cmp_maior_30_30, gestiones.NUMERO_NEBULIZACIONES as cmp_maior_30_31, gestiones.FECHA_SUBIDO as gestiones_fecha_subido, gestiones.NUMERO_TABLETAS_DIARIAS as cmp_maior_30_32, gestiones.BRINDO_APOYO as gestiones_brindo_apoyo, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera, gestiones.INFORMACION_APLICACIONES as cmp_maior_30_33 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_2, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_3, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_4, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_5, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_6, gestiones.ESPERADO_GESTION as cmp_maior_30_7, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_8, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_9, gestiones.RECLAMO_GESTION as cmp_maior_30_10, gestiones.CONSECUTIVO_BETAFERON as cmp_maior_30_11, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_12, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_13, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_14, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_15, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_16, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_17, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_18, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_19, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_20, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_21, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_22, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_23, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_24, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_25, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_26, gestiones.USUARIO_ASIGANDO as cmp_maior_30_27, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_28, gestiones.FECHA_COMUNICACION as cmp_maior_30_29, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.AUTOR_MODIFICACION as cmp_maior_30_30, gestiones.NUMERO_NEBULIZACIONES as cmp_maior_30_31, gestiones.FECHA_SUBIDO as gestiones_fecha_subido, gestiones.NUMERO_TABLETAS_DIARIAS as cmp_maior_30_32, gestiones.BRINDO_APOYO as gestiones_brindo_apoyo, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera, gestiones.INFORMACION_APLICACIONES as cmp_maior_30_33 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_2, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_3, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_4, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_5, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_6, gestiones.ESPERADO_GESTION as cmp_maior_30_7, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_8, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_9, gestiones.RECLAMO_GESTION as cmp_maior_30_10, gestiones.CONSECUTIVO_BETAFERON as cmp_maior_30_11, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_12, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_13, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_14, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_15, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_16, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_17, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_18, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_19, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_20, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_21, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_22, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_23, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_24, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_25, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_26, gestiones.USUARIO_ASIGANDO as cmp_maior_30_27, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_28, gestiones.FECHA_COMUNICACION as cmp_maior_30_29, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.AUTOR_MODIFICACION as cmp_maior_30_30, gestiones.NUMERO_NEBULIZACIONES as cmp_maior_30_31, gestiones.FECHA_SUBIDO as gestiones_fecha_subido, gestiones.NUMERO_TABLETAS_DIARIAS as cmp_maior_30_32, gestiones.BRINDO_APOYO as gestiones_brindo_apoyo, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera, gestiones.INFORMACION_APLICACIONES as cmp_maior_30_33 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_2, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_3, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_4, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_5, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_6, gestiones.ESPERADO_GESTION as cmp_maior_30_7, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_8, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_9, gestiones.RECLAMO_GESTION as cmp_maior_30_10, gestiones.CONSECUTIVO_BETAFERON as cmp_maior_30_11, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_12, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_13, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_14, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_15, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_16, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_17, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_18, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_19, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_20, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_21, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_22, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_23, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_24, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, LOTOFILE(gestiones.DESCRIPCION_COMUNICACION_GESTION, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as cmp_maior_30_25, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_26, gestiones.USUARIO_ASIGANDO as cmp_maior_30_27, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_28, gestiones.FECHA_COMUNICACION as cmp_maior_30_29, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.AUTOR_MODIFICACION as cmp_maior_30_30, gestiones.NUMERO_NEBULIZACIONES as cmp_maior_30_31, gestiones.FECHA_SUBIDO as gestiones_fecha_subido, gestiones.NUMERO_TABLETAS_DIARIAS as cmp_maior_30_32, gestiones.BRINDO_APOYO as gestiones_brindo_apoyo, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera, gestiones.INFORMACION_APLICACIONES as cmp_maior_30_33 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_2, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_3, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_4, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_5, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_6, gestiones.ESPERADO_GESTION as cmp_maior_30_7, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_8, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_9, gestiones.RECLAMO_GESTION as cmp_maior_30_10, gestiones.CONSECUTIVO_BETAFERON as cmp_maior_30_11, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_12, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_13, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_14, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_15, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_16, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_17, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_18, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_19, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_20, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_21, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_22, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_23, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_24, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_25, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_26, gestiones.USUARIO_ASIGANDO as cmp_maior_30_27, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_28, gestiones.FECHA_COMUNICACION as cmp_maior_30_29, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.AUTOR_MODIFICACION as cmp_maior_30_30, gestiones.NUMERO_NEBULIZACIONES as cmp_maior_30_31, gestiones.FECHA_SUBIDO as gestiones_fecha_subido, gestiones.NUMERO_TABLETAS_DIARIAS as cmp_maior_30_32, gestiones.BRINDO_APOYO as gestiones_brindo_apoyo, gestiones.PAAP as gestiones_paap, gestiones.SUB_PAAP as gestiones_sub_paap, gestiones.BARRERA as gestiones_barrera, gestiones.INFORMACION_APLICACIONES as cmp_maior_30_33 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['gestiones_id_gestion'])) ? $this->New_label['gestiones_id_gestion'] : "ID GESTION"; 
          if ($Cada_col == "gestiones_id_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_motivo_comunicacion_gestion'])) ? $this->New_label['gestiones_motivo_comunicacion_gestion'] : "MOTIVO COMUNICACION GESTION"; 
          if ($Cada_col == "gestiones_motivo_comunicacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_medio_contacto_gestion'])) ? $this->New_label['gestiones_medio_contacto_gestion'] : "MEDIO CONTACTO GESTION"; 
          if ($Cada_col == "gestiones_medio_contacto_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_tipo_llamada_gestion'])) ? $this->New_label['gestiones_tipo_llamada_gestion'] : "TIPO LLAMADA GESTION"; 
          if ($Cada_col == "gestiones_tipo_llamada_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_motivo_no_comunicacion_gestion'])) ? $this->New_label['gestiones_motivo_no_comunicacion_gestion'] : "MOTIVO NO COMUNICACION GESTION"; 
          if ($Cada_col == "gestiones_motivo_no_comunicacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_numero_intentos_gestion'])) ? $this->New_label['gestiones_numero_intentos_gestion'] : "NUMERO INTENTOS GESTION"; 
          if ($Cada_col == "gestiones_numero_intentos_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_esperado_gestion'])) ? $this->New_label['gestiones_esperado_gestion'] : "ESPERADO GESTION"; 
          if ($Cada_col == "gestiones_esperado_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_estado_ctc_gestion'])) ? $this->New_label['gestiones_estado_ctc_gestion'] : "ESTADO CTC GESTION"; 
          if ($Cada_col == "gestiones_estado_ctc_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_estado_farmacia_gestion'])) ? $this->New_label['gestiones_estado_farmacia_gestion'] : "ESTADO FARMACIA GESTION"; 
          if ($Cada_col == "gestiones_estado_farmacia_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_consecutivo_betaferon'])) ? $this->New_label['gestiones_consecutivo_betaferon'] : "CONSECUTIVO BETAFERON"; 
          if ($Cada_col == "gestiones_consecutivo_betaferon" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_dificultad_acceso_gestion'])) ? $this->New_label['gestiones_dificultad_acceso_gestion'] : "DIFICULTAD ACCESO GESTION"; 
          if ($Cada_col == "gestiones_dificultad_acceso_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_tipo_dificultad_gestion'])) ? $this->New_label['gestiones_tipo_dificultad_gestion'] : "TIPO DIFICULTAD GESTION"; 
          if ($Cada_col == "gestiones_tipo_dificultad_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_envios_gestion'])) ? $this->New_label['gestiones_envios_gestion'] : "ENVIOS GESTION"; 
          if ($Cada_col == "gestiones_envios_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_medicamentos_gestion'])) ? $this->New_label['gestiones_medicamentos_gestion'] : "MEDICAMENTOS GESTION"; 
          if ($Cada_col == "gestiones_medicamentos_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_tipo_envio_gestion'])) ? $this->New_label['gestiones_tipo_envio_gestion'] : "TIPO ENVIO GESTION"; 
          if ($Cada_col == "gestiones_tipo_envio_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_evento_adverso_gestion'])) ? $this->New_label['gestiones_evento_adverso_gestion'] : "EVENTO ADVERSO GESTION"; 
          if ($Cada_col == "gestiones_evento_adverso_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_tipo_evento_adverso'])) ? $this->New_label['gestiones_tipo_evento_adverso'] : "TIPO EVENTO ADVERSO"; 
          if ($Cada_col == "gestiones_tipo_evento_adverso" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_genera_solicitud_gestion'])) ? $this->New_label['gestiones_genera_solicitud_gestion'] : "GENERA SOLICITUD GESTION"; 
          if ($Cada_col == "gestiones_genera_solicitud_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_fecha_proxima_llamada'])) ? $this->New_label['gestiones_fecha_proxima_llamada'] : "FECHA PROXIMA LLAMADA"; 
          if ($Cada_col == "gestiones_fecha_proxima_llamada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_motivo_proxima_llamada'])) ? $this->New_label['gestiones_motivo_proxima_llamada'] : "MOTIVO PROXIMA LLAMADA"; 
          if ($Cada_col == "gestiones_motivo_proxima_llamada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_observacion_proxima_llamada'])) ? $this->New_label['gestiones_observacion_proxima_llamada'] : "OBSERVACION PROXIMA LLAMADA"; 
          if ($Cada_col == "gestiones_observacion_proxima_llamada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_consecutivo_gestion'])) ? $this->New_label['gestiones_consecutivo_gestion'] : "CONSECUTIVO GESTION"; 
          if ($Cada_col == "gestiones_consecutivo_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_nota'])) ? $this->New_label['gestiones_nota'] : "NOTA"; 
          if ($Cada_col == "gestiones_nota" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_usuario_asigando'])) ? $this->New_label['gestiones_usuario_asigando'] : "USUARIO ASIGANDO"; 
          if ($Cada_col == "gestiones_usuario_asigando" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_id_paciente_fk2'])) ? $this->New_label['gestiones_id_paciente_fk2'] : "ID PACIENTE FK2"; 
          if ($Cada_col == "gestiones_id_paciente_fk2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_estado_gestion'])) ? $this->New_label['gestiones_estado_gestion'] : "ESTADO GESTION"; 
          if ($Cada_col == "gestiones_estado_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_codigo_argus'])) ? $this->New_label['gestiones_codigo_argus'] : "CODIGO ARGUS"; 
          if ($Cada_col == "gestiones_codigo_argus" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_autor_modificacion'])) ? $this->New_label['gestiones_autor_modificacion'] : "AUTOR MODIFICACION"; 
          if ($Cada_col == "gestiones_autor_modificacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_numero_nebulizaciones'])) ? $this->New_label['gestiones_numero_nebulizaciones'] : "NUMERO NEBULIZACIONES"; 
          if ($Cada_col == "gestiones_numero_nebulizaciones" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_fecha_subido'])) ? $this->New_label['gestiones_fecha_subido'] : "FECHA SUBIDO"; 
          if ($Cada_col == "gestiones_fecha_subido" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_numero_tabletas_diarias'])) ? $this->New_label['gestiones_numero_tabletas_diarias'] : "NUMERO TABLETAS DIARIAS"; 
          if ($Cada_col == "gestiones_numero_tabletas_diarias" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_brindo_apoyo'])) ? $this->New_label['gestiones_brindo_apoyo'] : "BRINDO APOYO"; 
          if ($Cada_col == "gestiones_brindo_apoyo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_informacion_aplicaciones'])) ? $this->New_label['gestiones_informacion_aplicaciones'] : "INFORMACION APLICACIONES"; 
          if ($Cada_col == "gestiones_informacion_aplicaciones" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
         $this->gestiones_id_gestion = $rs->fields[0] ;  
         $this->gestiones_id_gestion = (string)$this->gestiones_id_gestion;
         $this->gestiones_motivo_comunicacion_gestion = $rs->fields[1] ;  
         $this->gestiones_medio_contacto_gestion = $rs->fields[2] ;  
         $this->gestiones_tipo_llamada_gestion = $rs->fields[3] ;  
         $this->gestiones_logro_comunicacion_gestion = $rs->fields[4] ;  
         $this->gestiones_motivo_no_comunicacion_gestion = $rs->fields[5] ;  
         $this->gestiones_numero_intentos_gestion = $rs->fields[6] ;  
         $this->gestiones_esperado_gestion = $rs->fields[7] ;  
         $this->gestiones_estado_ctc_gestion = $rs->fields[8] ;  
         $this->gestiones_estado_farmacia_gestion = $rs->fields[9] ;  
         $this->gestiones_reclamo_gestion = $rs->fields[10] ;  
         $this->gestiones_consecutivo_betaferon = $rs->fields[11] ;  
         $this->gestiones_causa_no_reclamacion_gestion = $rs->fields[12] ;  
         $this->gestiones_dificultad_acceso_gestion = $rs->fields[13] ;  
         $this->gestiones_tipo_dificultad_gestion = $rs->fields[14] ;  
         $this->gestiones_envios_gestion = $rs->fields[15] ;  
         $this->gestiones_medicamentos_gestion = $rs->fields[16] ;  
         $this->gestiones_tipo_envio_gestion = $rs->fields[17] ;  
         $this->gestiones_evento_adverso_gestion = $rs->fields[18] ;  
         $this->gestiones_tipo_evento_adverso = $rs->fields[19] ;  
         $this->gestiones_genera_solicitud_gestion = $rs->fields[20] ;  
         $this->gestiones_fecha_proxima_llamada = $rs->fields[21] ;  
         $this->gestiones_motivo_proxima_llamada = $rs->fields[22] ;  
         $this->gestiones_observacion_proxima_llamada = $rs->fields[23] ;  
         $this->gestiones_fecha_reclamacion_gestion = $rs->fields[24] ;  
         $this->gestiones_numero_cajas = $rs->fields[25] ;  
         $this->gestiones_consecutivo_gestion = $rs->fields[26] ;  
         $this->gestiones_autor_gestion = $rs->fields[27] ;  
         $this->gestiones_nota = $rs->fields[28] ;  
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
         $this->gestiones_usuario_asigando = $rs->fields[31] ;  
         $this->gestiones_id_paciente_fk2 = $rs->fields[32] ;  
         $this->gestiones_id_paciente_fk2 = (string)$this->gestiones_id_paciente_fk2;
         $this->gestiones_fecha_comunicacion = $rs->fields[33] ;  
         $this->gestiones_estado_gestion = $rs->fields[34] ;  
         $this->gestiones_codigo_argus = $rs->fields[35] ;  
         $this->gestiones_autor_modificacion = $rs->fields[36] ;  
         $this->gestiones_numero_nebulizaciones = $rs->fields[37] ;  
         $this->gestiones_fecha_subido = $rs->fields[38] ;  
         $this->gestiones_numero_tabletas_diarias = $rs->fields[39] ;  
         $this->gestiones_brindo_apoyo = $rs->fields[40] ;  
         $this->gestiones_paap = $rs->fields[41] ;  
         $this->gestiones_sub_paap = $rs->fields[42] ;  
         $this->gestiones_barrera = $rs->fields[43] ;  
         $this->gestiones_informacion_aplicaciones = $rs->fields[44] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['field_order'] as $Cada_col)
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
   //----- gestiones_id_gestion
   function NM_export_gestiones_id_gestion()
   {
         if (!NM_is_utf8($this->gestiones_id_gestion))
         {
             $this->gestiones_id_gestion = sc_convert_encoding($this->gestiones_id_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->gestiones_id_gestion))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_id_gestion);
         $this->xls_col++;
   }
   //----- gestiones_motivo_comunicacion_gestion
   function NM_export_gestiones_motivo_comunicacion_gestion()
   {
         $this->gestiones_motivo_comunicacion_gestion = html_entity_decode($this->gestiones_motivo_comunicacion_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_motivo_comunicacion_gestion = strip_tags($this->gestiones_motivo_comunicacion_gestion);
         if (!NM_is_utf8($this->gestiones_motivo_comunicacion_gestion))
         {
             $this->gestiones_motivo_comunicacion_gestion = sc_convert_encoding($this->gestiones_motivo_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_motivo_comunicacion_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_medio_contacto_gestion
   function NM_export_gestiones_medio_contacto_gestion()
   {
         $this->gestiones_medio_contacto_gestion = html_entity_decode($this->gestiones_medio_contacto_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_medio_contacto_gestion = strip_tags($this->gestiones_medio_contacto_gestion);
         if (!NM_is_utf8($this->gestiones_medio_contacto_gestion))
         {
             $this->gestiones_medio_contacto_gestion = sc_convert_encoding($this->gestiones_medio_contacto_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_medio_contacto_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_tipo_llamada_gestion
   function NM_export_gestiones_tipo_llamada_gestion()
   {
         $this->gestiones_tipo_llamada_gestion = html_entity_decode($this->gestiones_tipo_llamada_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_tipo_llamada_gestion = strip_tags($this->gestiones_tipo_llamada_gestion);
         if (!NM_is_utf8($this->gestiones_tipo_llamada_gestion))
         {
             $this->gestiones_tipo_llamada_gestion = sc_convert_encoding($this->gestiones_tipo_llamada_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_tipo_llamada_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
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
   //----- gestiones_motivo_no_comunicacion_gestion
   function NM_export_gestiones_motivo_no_comunicacion_gestion()
   {
         $this->gestiones_motivo_no_comunicacion_gestion = html_entity_decode($this->gestiones_motivo_no_comunicacion_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_motivo_no_comunicacion_gestion = strip_tags($this->gestiones_motivo_no_comunicacion_gestion);
         if (!NM_is_utf8($this->gestiones_motivo_no_comunicacion_gestion))
         {
             $this->gestiones_motivo_no_comunicacion_gestion = sc_convert_encoding($this->gestiones_motivo_no_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_motivo_no_comunicacion_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_numero_intentos_gestion
   function NM_export_gestiones_numero_intentos_gestion()
   {
         $this->gestiones_numero_intentos_gestion = html_entity_decode($this->gestiones_numero_intentos_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_numero_intentos_gestion = strip_tags($this->gestiones_numero_intentos_gestion);
         if (!NM_is_utf8($this->gestiones_numero_intentos_gestion))
         {
             $this->gestiones_numero_intentos_gestion = sc_convert_encoding($this->gestiones_numero_intentos_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_numero_intentos_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_esperado_gestion
   function NM_export_gestiones_esperado_gestion()
   {
         $this->gestiones_esperado_gestion = html_entity_decode($this->gestiones_esperado_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_esperado_gestion = strip_tags($this->gestiones_esperado_gestion);
         if (!NM_is_utf8($this->gestiones_esperado_gestion))
         {
             $this->gestiones_esperado_gestion = sc_convert_encoding($this->gestiones_esperado_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_esperado_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_estado_ctc_gestion
   function NM_export_gestiones_estado_ctc_gestion()
   {
         $this->gestiones_estado_ctc_gestion = html_entity_decode($this->gestiones_estado_ctc_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_estado_ctc_gestion = strip_tags($this->gestiones_estado_ctc_gestion);
         if (!NM_is_utf8($this->gestiones_estado_ctc_gestion))
         {
             $this->gestiones_estado_ctc_gestion = sc_convert_encoding($this->gestiones_estado_ctc_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_estado_ctc_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_estado_farmacia_gestion
   function NM_export_gestiones_estado_farmacia_gestion()
   {
         $this->gestiones_estado_farmacia_gestion = html_entity_decode($this->gestiones_estado_farmacia_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_estado_farmacia_gestion = strip_tags($this->gestiones_estado_farmacia_gestion);
         if (!NM_is_utf8($this->gestiones_estado_farmacia_gestion))
         {
             $this->gestiones_estado_farmacia_gestion = sc_convert_encoding($this->gestiones_estado_farmacia_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_estado_farmacia_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
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
   //----- gestiones_consecutivo_betaferon
   function NM_export_gestiones_consecutivo_betaferon()
   {
         $this->gestiones_consecutivo_betaferon = html_entity_decode($this->gestiones_consecutivo_betaferon, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_consecutivo_betaferon = strip_tags($this->gestiones_consecutivo_betaferon);
         if (!NM_is_utf8($this->gestiones_consecutivo_betaferon))
         {
             $this->gestiones_consecutivo_betaferon = sc_convert_encoding($this->gestiones_consecutivo_betaferon, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_consecutivo_betaferon, PHPExcel_Cell_DataType::TYPE_STRING);
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
   //----- gestiones_dificultad_acceso_gestion
   function NM_export_gestiones_dificultad_acceso_gestion()
   {
         $this->gestiones_dificultad_acceso_gestion = html_entity_decode($this->gestiones_dificultad_acceso_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_dificultad_acceso_gestion = strip_tags($this->gestiones_dificultad_acceso_gestion);
         if (!NM_is_utf8($this->gestiones_dificultad_acceso_gestion))
         {
             $this->gestiones_dificultad_acceso_gestion = sc_convert_encoding($this->gestiones_dificultad_acceso_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_dificultad_acceso_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_tipo_dificultad_gestion
   function NM_export_gestiones_tipo_dificultad_gestion()
   {
         $this->gestiones_tipo_dificultad_gestion = html_entity_decode($this->gestiones_tipo_dificultad_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_tipo_dificultad_gestion = strip_tags($this->gestiones_tipo_dificultad_gestion);
         if (!NM_is_utf8($this->gestiones_tipo_dificultad_gestion))
         {
             $this->gestiones_tipo_dificultad_gestion = sc_convert_encoding($this->gestiones_tipo_dificultad_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_tipo_dificultad_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_envios_gestion
   function NM_export_gestiones_envios_gestion()
   {
         $this->gestiones_envios_gestion = html_entity_decode($this->gestiones_envios_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_envios_gestion = strip_tags($this->gestiones_envios_gestion);
         if (!NM_is_utf8($this->gestiones_envios_gestion))
         {
             $this->gestiones_envios_gestion = sc_convert_encoding($this->gestiones_envios_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_envios_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_medicamentos_gestion
   function NM_export_gestiones_medicamentos_gestion()
   {
         $this->gestiones_medicamentos_gestion = html_entity_decode($this->gestiones_medicamentos_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_medicamentos_gestion = strip_tags($this->gestiones_medicamentos_gestion);
         if (!NM_is_utf8($this->gestiones_medicamentos_gestion))
         {
             $this->gestiones_medicamentos_gestion = sc_convert_encoding($this->gestiones_medicamentos_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_medicamentos_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_tipo_envio_gestion
   function NM_export_gestiones_tipo_envio_gestion()
   {
         $this->gestiones_tipo_envio_gestion = html_entity_decode($this->gestiones_tipo_envio_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_tipo_envio_gestion = strip_tags($this->gestiones_tipo_envio_gestion);
         if (!NM_is_utf8($this->gestiones_tipo_envio_gestion))
         {
             $this->gestiones_tipo_envio_gestion = sc_convert_encoding($this->gestiones_tipo_envio_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_tipo_envio_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_evento_adverso_gestion
   function NM_export_gestiones_evento_adverso_gestion()
   {
         $this->gestiones_evento_adverso_gestion = html_entity_decode($this->gestiones_evento_adverso_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_evento_adverso_gestion = strip_tags($this->gestiones_evento_adverso_gestion);
         if (!NM_is_utf8($this->gestiones_evento_adverso_gestion))
         {
             $this->gestiones_evento_adverso_gestion = sc_convert_encoding($this->gestiones_evento_adverso_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_evento_adverso_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_tipo_evento_adverso
   function NM_export_gestiones_tipo_evento_adverso()
   {
         $this->gestiones_tipo_evento_adverso = html_entity_decode($this->gestiones_tipo_evento_adverso, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_tipo_evento_adverso = strip_tags($this->gestiones_tipo_evento_adverso);
         if (!NM_is_utf8($this->gestiones_tipo_evento_adverso))
         {
             $this->gestiones_tipo_evento_adverso = sc_convert_encoding($this->gestiones_tipo_evento_adverso, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_tipo_evento_adverso, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_genera_solicitud_gestion
   function NM_export_gestiones_genera_solicitud_gestion()
   {
         $this->gestiones_genera_solicitud_gestion = html_entity_decode($this->gestiones_genera_solicitud_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_genera_solicitud_gestion = strip_tags($this->gestiones_genera_solicitud_gestion);
         if (!NM_is_utf8($this->gestiones_genera_solicitud_gestion))
         {
             $this->gestiones_genera_solicitud_gestion = sc_convert_encoding($this->gestiones_genera_solicitud_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_genera_solicitud_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_fecha_proxima_llamada
   function NM_export_gestiones_fecha_proxima_llamada()
   {
         $this->gestiones_fecha_proxima_llamada = html_entity_decode($this->gestiones_fecha_proxima_llamada, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_fecha_proxima_llamada = strip_tags($this->gestiones_fecha_proxima_llamada);
         if (!NM_is_utf8($this->gestiones_fecha_proxima_llamada))
         {
             $this->gestiones_fecha_proxima_llamada = sc_convert_encoding($this->gestiones_fecha_proxima_llamada, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_fecha_proxima_llamada, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_motivo_proxima_llamada
   function NM_export_gestiones_motivo_proxima_llamada()
   {
         $this->gestiones_motivo_proxima_llamada = html_entity_decode($this->gestiones_motivo_proxima_llamada, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_motivo_proxima_llamada = strip_tags($this->gestiones_motivo_proxima_llamada);
         if (!NM_is_utf8($this->gestiones_motivo_proxima_llamada))
         {
             $this->gestiones_motivo_proxima_llamada = sc_convert_encoding($this->gestiones_motivo_proxima_llamada, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_motivo_proxima_llamada, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_observacion_proxima_llamada
   function NM_export_gestiones_observacion_proxima_llamada()
   {
         $this->gestiones_observacion_proxima_llamada = html_entity_decode($this->gestiones_observacion_proxima_llamada, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_observacion_proxima_llamada = strip_tags($this->gestiones_observacion_proxima_llamada);
         if (!NM_is_utf8($this->gestiones_observacion_proxima_llamada))
         {
             $this->gestiones_observacion_proxima_llamada = sc_convert_encoding($this->gestiones_observacion_proxima_llamada, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_observacion_proxima_llamada, PHPExcel_Cell_DataType::TYPE_STRING);
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
   //----- gestiones_consecutivo_gestion
   function NM_export_gestiones_consecutivo_gestion()
   {
         $this->gestiones_consecutivo_gestion = html_entity_decode($this->gestiones_consecutivo_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_consecutivo_gestion = strip_tags($this->gestiones_consecutivo_gestion);
         if (!NM_is_utf8($this->gestiones_consecutivo_gestion))
         {
             $this->gestiones_consecutivo_gestion = sc_convert_encoding($this->gestiones_consecutivo_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_consecutivo_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
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
   //----- gestiones_nota
   function NM_export_gestiones_nota()
   {
         $this->gestiones_nota = html_entity_decode($this->gestiones_nota, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_nota = strip_tags($this->gestiones_nota);
         if (!NM_is_utf8($this->gestiones_nota))
         {
             $this->gestiones_nota = sc_convert_encoding($this->gestiones_nota, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_nota, PHPExcel_Cell_DataType::TYPE_STRING);
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
   //----- gestiones_usuario_asigando
   function NM_export_gestiones_usuario_asigando()
   {
         $this->gestiones_usuario_asigando = html_entity_decode($this->gestiones_usuario_asigando, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_usuario_asigando = strip_tags($this->gestiones_usuario_asigando);
         if (!NM_is_utf8($this->gestiones_usuario_asigando))
         {
             $this->gestiones_usuario_asigando = sc_convert_encoding($this->gestiones_usuario_asigando, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_usuario_asigando, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_id_paciente_fk2
   function NM_export_gestiones_id_paciente_fk2()
   {
         if (!NM_is_utf8($this->gestiones_id_paciente_fk2))
         {
             $this->gestiones_id_paciente_fk2 = sc_convert_encoding($this->gestiones_id_paciente_fk2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->gestiones_id_paciente_fk2))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_id_paciente_fk2);
         $this->xls_col++;
   }
   //----- gestiones_fecha_comunicacion
   function NM_export_gestiones_fecha_comunicacion()
   {
         $this->gestiones_fecha_comunicacion = html_entity_decode($this->gestiones_fecha_comunicacion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_fecha_comunicacion = strip_tags($this->gestiones_fecha_comunicacion);
         if (!NM_is_utf8($this->gestiones_fecha_comunicacion))
         {
             $this->gestiones_fecha_comunicacion = sc_convert_encoding($this->gestiones_fecha_comunicacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_fecha_comunicacion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_estado_gestion
   function NM_export_gestiones_estado_gestion()
   {
         $this->gestiones_estado_gestion = html_entity_decode($this->gestiones_estado_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_estado_gestion = strip_tags($this->gestiones_estado_gestion);
         if (!NM_is_utf8($this->gestiones_estado_gestion))
         {
             $this->gestiones_estado_gestion = sc_convert_encoding($this->gestiones_estado_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_estado_gestion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_codigo_argus
   function NM_export_gestiones_codigo_argus()
   {
         $this->gestiones_codigo_argus = html_entity_decode($this->gestiones_codigo_argus, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_codigo_argus = strip_tags($this->gestiones_codigo_argus);
         if (!NM_is_utf8($this->gestiones_codigo_argus))
         {
             $this->gestiones_codigo_argus = sc_convert_encoding($this->gestiones_codigo_argus, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_codigo_argus, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_autor_modificacion
   function NM_export_gestiones_autor_modificacion()
   {
         $this->gestiones_autor_modificacion = html_entity_decode($this->gestiones_autor_modificacion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_autor_modificacion = strip_tags($this->gestiones_autor_modificacion);
         if (!NM_is_utf8($this->gestiones_autor_modificacion))
         {
             $this->gestiones_autor_modificacion = sc_convert_encoding($this->gestiones_autor_modificacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_autor_modificacion, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_numero_nebulizaciones
   function NM_export_gestiones_numero_nebulizaciones()
   {
         $this->gestiones_numero_nebulizaciones = html_entity_decode($this->gestiones_numero_nebulizaciones, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_numero_nebulizaciones = strip_tags($this->gestiones_numero_nebulizaciones);
         if (!NM_is_utf8($this->gestiones_numero_nebulizaciones))
         {
             $this->gestiones_numero_nebulizaciones = sc_convert_encoding($this->gestiones_numero_nebulizaciones, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_numero_nebulizaciones, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_fecha_subido
   function NM_export_gestiones_fecha_subido()
   {
         $this->gestiones_fecha_subido = html_entity_decode($this->gestiones_fecha_subido, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_fecha_subido = strip_tags($this->gestiones_fecha_subido);
         if (!NM_is_utf8($this->gestiones_fecha_subido))
         {
             $this->gestiones_fecha_subido = sc_convert_encoding($this->gestiones_fecha_subido, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_fecha_subido, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_numero_tabletas_diarias
   function NM_export_gestiones_numero_tabletas_diarias()
   {
         $this->gestiones_numero_tabletas_diarias = html_entity_decode($this->gestiones_numero_tabletas_diarias, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_numero_tabletas_diarias = strip_tags($this->gestiones_numero_tabletas_diarias);
         if (!NM_is_utf8($this->gestiones_numero_tabletas_diarias))
         {
             $this->gestiones_numero_tabletas_diarias = sc_convert_encoding($this->gestiones_numero_tabletas_diarias, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_numero_tabletas_diarias, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_brindo_apoyo
   function NM_export_gestiones_brindo_apoyo()
   {
         $this->gestiones_brindo_apoyo = html_entity_decode($this->gestiones_brindo_apoyo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_brindo_apoyo = strip_tags($this->gestiones_brindo_apoyo);
         if (!NM_is_utf8($this->gestiones_brindo_apoyo))
         {
             $this->gestiones_brindo_apoyo = sc_convert_encoding($this->gestiones_brindo_apoyo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_brindo_apoyo, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->xls_col++;
   }
   //----- gestiones_paap
   function NM_export_gestiones_paap()
   {
         $this->gestiones_paap = html_entity_decode($this->gestiones_paap, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_paap = strip_tags($this->gestiones_paap);
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
   //----- gestiones_informacion_aplicaciones
   function NM_export_gestiones_informacion_aplicaciones()
   {
         $this->gestiones_informacion_aplicaciones = html_entity_decode($this->gestiones_informacion_aplicaciones, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_informacion_aplicaciones = strip_tags($this->gestiones_informacion_aplicaciones);
         if (!NM_is_utf8($this->gestiones_informacion_aplicaciones))
         {
             $this->gestiones_informacion_aplicaciones = sc_convert_encoding($this->gestiones_informacion_aplicaciones, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_informacion_aplicaciones, PHPExcel_Cell_DataType::TYPE_STRING);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xls_file']);
      if (is_file($this->xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xls_file'] = $this->xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> -  :: Excel</TITLE>
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
<form name="Fdown" method="get" action="GESTION_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="GESTION"> 
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

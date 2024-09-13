<?php

class GESTION_xml
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;

   var $arquivo;
   var $arquivo_view;
   var $tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function GESTION_xml()
   {
      $this->nm_data   = new nm_data("es");
   }

   //---- 
   function monta_xml()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nm_data    = new nm_data("es");
      $this->arquivo      = "sc_xml";
      $this->arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->arquivo     .= "_GESTION";
      $this->arquivo_view = $this->arquivo . "_view.xml";
      $this->arquivo     .= ".xml";
      $this->tit_doc      = "GESTION.xml";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xml_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xml_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xml_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->arquivo_view = $this->arquivo;
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

      $xml_charset = $_SESSION['scriptcase']['charset'];
      $xml_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo, "w");
      fwrite($xml_f, "<?xml version=\"1.0\" encoding=\"$xml_charset\" ?>\r\n");
      fwrite($xml_f, "<root>\r\n");
      if ($this->Grava_view)
      {
          $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
          $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo_view, "w");
          fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
          fwrite($xml_v, "<root>\r\n");
      }
      while (!$rs->EOF)
      {
         $this->xml_registro = "<GESTION";
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
         $this->xml_registro .= " />\r\n";
         fwrite($xml_f, $this->xml_registro);
         if ($this->Grava_view)
         {
            fwrite($xml_v, $this->xml_registro);
         }
         $rs->MoveNext();
      }
      fwrite($xml_f, "</root>");
      fclose($xml_f);
      if ($this->Grava_view)
      {
         fwrite($xml_v, "</root>");
         fclose($xml_v);
      }

      $rs->Close();
   }
   //----- gestiones_id_gestion
   function NM_export_gestiones_id_gestion()
   {
         nmgp_Form_Num_Val($this->gestiones_id_gestion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_id_gestion))
         {
             $this->gestiones_id_gestion = sc_convert_encoding($this->gestiones_id_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_id_gestion =\"" . $this->trata_dados($this->gestiones_id_gestion) . "\"";
   }
   //----- gestiones_motivo_comunicacion_gestion
   function NM_export_gestiones_motivo_comunicacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_motivo_comunicacion_gestion))
         {
             $this->gestiones_motivo_comunicacion_gestion = sc_convert_encoding($this->gestiones_motivo_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_motivo_comunicacion_gestion =\"" . $this->trata_dados($this->gestiones_motivo_comunicacion_gestion) . "\"";
   }
   //----- gestiones_medio_contacto_gestion
   function NM_export_gestiones_medio_contacto_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_medio_contacto_gestion))
         {
             $this->gestiones_medio_contacto_gestion = sc_convert_encoding($this->gestiones_medio_contacto_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_medio_contacto_gestion =\"" . $this->trata_dados($this->gestiones_medio_contacto_gestion) . "\"";
   }
   //----- gestiones_tipo_llamada_gestion
   function NM_export_gestiones_tipo_llamada_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_tipo_llamada_gestion))
         {
             $this->gestiones_tipo_llamada_gestion = sc_convert_encoding($this->gestiones_tipo_llamada_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_tipo_llamada_gestion =\"" . $this->trata_dados($this->gestiones_tipo_llamada_gestion) . "\"";
   }
   //----- gestiones_logro_comunicacion_gestion
   function NM_export_gestiones_logro_comunicacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_logro_comunicacion_gestion))
         {
             $this->gestiones_logro_comunicacion_gestion = sc_convert_encoding($this->gestiones_logro_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_logro_comunicacion_gestion =\"" . $this->trata_dados($this->gestiones_logro_comunicacion_gestion) . "\"";
   }
   //----- gestiones_motivo_no_comunicacion_gestion
   function NM_export_gestiones_motivo_no_comunicacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_motivo_no_comunicacion_gestion))
         {
             $this->gestiones_motivo_no_comunicacion_gestion = sc_convert_encoding($this->gestiones_motivo_no_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_motivo_no_comunicacion_gestion =\"" . $this->trata_dados($this->gestiones_motivo_no_comunicacion_gestion) . "\"";
   }
   //----- gestiones_numero_intentos_gestion
   function NM_export_gestiones_numero_intentos_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_numero_intentos_gestion))
         {
             $this->gestiones_numero_intentos_gestion = sc_convert_encoding($this->gestiones_numero_intentos_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_numero_intentos_gestion =\"" . $this->trata_dados($this->gestiones_numero_intentos_gestion) . "\"";
   }
   //----- gestiones_esperado_gestion
   function NM_export_gestiones_esperado_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_esperado_gestion))
         {
             $this->gestiones_esperado_gestion = sc_convert_encoding($this->gestiones_esperado_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_esperado_gestion =\"" . $this->trata_dados($this->gestiones_esperado_gestion) . "\"";
   }
   //----- gestiones_estado_ctc_gestion
   function NM_export_gestiones_estado_ctc_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_estado_ctc_gestion))
         {
             $this->gestiones_estado_ctc_gestion = sc_convert_encoding($this->gestiones_estado_ctc_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_estado_ctc_gestion =\"" . $this->trata_dados($this->gestiones_estado_ctc_gestion) . "\"";
   }
   //----- gestiones_estado_farmacia_gestion
   function NM_export_gestiones_estado_farmacia_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_estado_farmacia_gestion))
         {
             $this->gestiones_estado_farmacia_gestion = sc_convert_encoding($this->gestiones_estado_farmacia_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_estado_farmacia_gestion =\"" . $this->trata_dados($this->gestiones_estado_farmacia_gestion) . "\"";
   }
   //----- gestiones_reclamo_gestion
   function NM_export_gestiones_reclamo_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_reclamo_gestion))
         {
             $this->gestiones_reclamo_gestion = sc_convert_encoding($this->gestiones_reclamo_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_reclamo_gestion =\"" . $this->trata_dados($this->gestiones_reclamo_gestion) . "\"";
   }
   //----- gestiones_consecutivo_betaferon
   function NM_export_gestiones_consecutivo_betaferon()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_consecutivo_betaferon))
         {
             $this->gestiones_consecutivo_betaferon = sc_convert_encoding($this->gestiones_consecutivo_betaferon, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_consecutivo_betaferon =\"" . $this->trata_dados($this->gestiones_consecutivo_betaferon) . "\"";
   }
   //----- gestiones_causa_no_reclamacion_gestion
   function NM_export_gestiones_causa_no_reclamacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_causa_no_reclamacion_gestion))
         {
             $this->gestiones_causa_no_reclamacion_gestion = sc_convert_encoding($this->gestiones_causa_no_reclamacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_causa_no_reclamacion_gestion =\"" . $this->trata_dados($this->gestiones_causa_no_reclamacion_gestion) . "\"";
   }
   //----- gestiones_dificultad_acceso_gestion
   function NM_export_gestiones_dificultad_acceso_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_dificultad_acceso_gestion))
         {
             $this->gestiones_dificultad_acceso_gestion = sc_convert_encoding($this->gestiones_dificultad_acceso_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_dificultad_acceso_gestion =\"" . $this->trata_dados($this->gestiones_dificultad_acceso_gestion) . "\"";
   }
   //----- gestiones_tipo_dificultad_gestion
   function NM_export_gestiones_tipo_dificultad_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_tipo_dificultad_gestion))
         {
             $this->gestiones_tipo_dificultad_gestion = sc_convert_encoding($this->gestiones_tipo_dificultad_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_tipo_dificultad_gestion =\"" . $this->trata_dados($this->gestiones_tipo_dificultad_gestion) . "\"";
   }
   //----- gestiones_envios_gestion
   function NM_export_gestiones_envios_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_envios_gestion))
         {
             $this->gestiones_envios_gestion = sc_convert_encoding($this->gestiones_envios_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_envios_gestion =\"" . $this->trata_dados($this->gestiones_envios_gestion) . "\"";
   }
   //----- gestiones_medicamentos_gestion
   function NM_export_gestiones_medicamentos_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_medicamentos_gestion))
         {
             $this->gestiones_medicamentos_gestion = sc_convert_encoding($this->gestiones_medicamentos_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_medicamentos_gestion =\"" . $this->trata_dados($this->gestiones_medicamentos_gestion) . "\"";
   }
   //----- gestiones_tipo_envio_gestion
   function NM_export_gestiones_tipo_envio_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_tipo_envio_gestion))
         {
             $this->gestiones_tipo_envio_gestion = sc_convert_encoding($this->gestiones_tipo_envio_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_tipo_envio_gestion =\"" . $this->trata_dados($this->gestiones_tipo_envio_gestion) . "\"";
   }
   //----- gestiones_evento_adverso_gestion
   function NM_export_gestiones_evento_adverso_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_evento_adverso_gestion))
         {
             $this->gestiones_evento_adverso_gestion = sc_convert_encoding($this->gestiones_evento_adverso_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_evento_adverso_gestion =\"" . $this->trata_dados($this->gestiones_evento_adverso_gestion) . "\"";
   }
   //----- gestiones_tipo_evento_adverso
   function NM_export_gestiones_tipo_evento_adverso()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_tipo_evento_adverso))
         {
             $this->gestiones_tipo_evento_adverso = sc_convert_encoding($this->gestiones_tipo_evento_adverso, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_tipo_evento_adverso =\"" . $this->trata_dados($this->gestiones_tipo_evento_adverso) . "\"";
   }
   //----- gestiones_genera_solicitud_gestion
   function NM_export_gestiones_genera_solicitud_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_genera_solicitud_gestion))
         {
             $this->gestiones_genera_solicitud_gestion = sc_convert_encoding($this->gestiones_genera_solicitud_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_genera_solicitud_gestion =\"" . $this->trata_dados($this->gestiones_genera_solicitud_gestion) . "\"";
   }
   //----- gestiones_fecha_proxima_llamada
   function NM_export_gestiones_fecha_proxima_llamada()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_fecha_proxima_llamada))
         {
             $this->gestiones_fecha_proxima_llamada = sc_convert_encoding($this->gestiones_fecha_proxima_llamada, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_fecha_proxima_llamada =\"" . $this->trata_dados($this->gestiones_fecha_proxima_llamada) . "\"";
   }
   //----- gestiones_motivo_proxima_llamada
   function NM_export_gestiones_motivo_proxima_llamada()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_motivo_proxima_llamada))
         {
             $this->gestiones_motivo_proxima_llamada = sc_convert_encoding($this->gestiones_motivo_proxima_llamada, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_motivo_proxima_llamada =\"" . $this->trata_dados($this->gestiones_motivo_proxima_llamada) . "\"";
   }
   //----- gestiones_observacion_proxima_llamada
   function NM_export_gestiones_observacion_proxima_llamada()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_observacion_proxima_llamada))
         {
             $this->gestiones_observacion_proxima_llamada = sc_convert_encoding($this->gestiones_observacion_proxima_llamada, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_observacion_proxima_llamada =\"" . $this->trata_dados($this->gestiones_observacion_proxima_llamada) . "\"";
   }
   //----- gestiones_fecha_reclamacion_gestion
   function NM_export_gestiones_fecha_reclamacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_fecha_reclamacion_gestion))
         {
             $this->gestiones_fecha_reclamacion_gestion = sc_convert_encoding($this->gestiones_fecha_reclamacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_fecha_reclamacion_gestion =\"" . $this->trata_dados($this->gestiones_fecha_reclamacion_gestion) . "\"";
   }
   //----- gestiones_numero_cajas
   function NM_export_gestiones_numero_cajas()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_numero_cajas))
         {
             $this->gestiones_numero_cajas = sc_convert_encoding($this->gestiones_numero_cajas, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_numero_cajas =\"" . $this->trata_dados($this->gestiones_numero_cajas) . "\"";
   }
   //----- gestiones_consecutivo_gestion
   function NM_export_gestiones_consecutivo_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_consecutivo_gestion))
         {
             $this->gestiones_consecutivo_gestion = sc_convert_encoding($this->gestiones_consecutivo_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_consecutivo_gestion =\"" . $this->trata_dados($this->gestiones_consecutivo_gestion) . "\"";
   }
   //----- gestiones_autor_gestion
   function NM_export_gestiones_autor_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_autor_gestion))
         {
             $this->gestiones_autor_gestion = sc_convert_encoding($this->gestiones_autor_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_autor_gestion =\"" . $this->trata_dados($this->gestiones_autor_gestion) . "\"";
   }
   //----- gestiones_nota
   function NM_export_gestiones_nota()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_nota))
         {
             $this->gestiones_nota = sc_convert_encoding($this->gestiones_nota, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_nota =\"" . $this->trata_dados($this->gestiones_nota) . "\"";
   }
   //----- gestiones_descripcion_comunicacion_gestion
   function NM_export_gestiones_descripcion_comunicacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_descripcion_comunicacion_gestion))
         {
             $this->gestiones_descripcion_comunicacion_gestion = sc_convert_encoding($this->gestiones_descripcion_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_descripcion_comunicacion_gestion =\"" . $this->trata_dados($this->gestiones_descripcion_comunicacion_gestion) . "\"";
   }
   //----- gestiones_fecha_programada_gestion
   function NM_export_gestiones_fecha_programada_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_fecha_programada_gestion))
         {
             $this->gestiones_fecha_programada_gestion = sc_convert_encoding($this->gestiones_fecha_programada_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_fecha_programada_gestion =\"" . $this->trata_dados($this->gestiones_fecha_programada_gestion) . "\"";
   }
   //----- gestiones_usuario_asigando
   function NM_export_gestiones_usuario_asigando()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_usuario_asigando))
         {
             $this->gestiones_usuario_asigando = sc_convert_encoding($this->gestiones_usuario_asigando, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_usuario_asigando =\"" . $this->trata_dados($this->gestiones_usuario_asigando) . "\"";
   }
   //----- gestiones_id_paciente_fk2
   function NM_export_gestiones_id_paciente_fk2()
   {
         nmgp_Form_Num_Val($this->gestiones_id_paciente_fk2, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_id_paciente_fk2))
         {
             $this->gestiones_id_paciente_fk2 = sc_convert_encoding($this->gestiones_id_paciente_fk2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_id_paciente_fk2 =\"" . $this->trata_dados($this->gestiones_id_paciente_fk2) . "\"";
   }
   //----- gestiones_fecha_comunicacion
   function NM_export_gestiones_fecha_comunicacion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_fecha_comunicacion))
         {
             $this->gestiones_fecha_comunicacion = sc_convert_encoding($this->gestiones_fecha_comunicacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_fecha_comunicacion =\"" . $this->trata_dados($this->gestiones_fecha_comunicacion) . "\"";
   }
   //----- gestiones_estado_gestion
   function NM_export_gestiones_estado_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_estado_gestion))
         {
             $this->gestiones_estado_gestion = sc_convert_encoding($this->gestiones_estado_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_estado_gestion =\"" . $this->trata_dados($this->gestiones_estado_gestion) . "\"";
   }
   //----- gestiones_codigo_argus
   function NM_export_gestiones_codigo_argus()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_codigo_argus))
         {
             $this->gestiones_codigo_argus = sc_convert_encoding($this->gestiones_codigo_argus, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_codigo_argus =\"" . $this->trata_dados($this->gestiones_codigo_argus) . "\"";
   }
   //----- gestiones_autor_modificacion
   function NM_export_gestiones_autor_modificacion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_autor_modificacion))
         {
             $this->gestiones_autor_modificacion = sc_convert_encoding($this->gestiones_autor_modificacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_autor_modificacion =\"" . $this->trata_dados($this->gestiones_autor_modificacion) . "\"";
   }
   //----- gestiones_numero_nebulizaciones
   function NM_export_gestiones_numero_nebulizaciones()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_numero_nebulizaciones))
         {
             $this->gestiones_numero_nebulizaciones = sc_convert_encoding($this->gestiones_numero_nebulizaciones, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_numero_nebulizaciones =\"" . $this->trata_dados($this->gestiones_numero_nebulizaciones) . "\"";
   }
   //----- gestiones_fecha_subido
   function NM_export_gestiones_fecha_subido()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_fecha_subido))
         {
             $this->gestiones_fecha_subido = sc_convert_encoding($this->gestiones_fecha_subido, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_fecha_subido =\"" . $this->trata_dados($this->gestiones_fecha_subido) . "\"";
   }
   //----- gestiones_numero_tabletas_diarias
   function NM_export_gestiones_numero_tabletas_diarias()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_numero_tabletas_diarias))
         {
             $this->gestiones_numero_tabletas_diarias = sc_convert_encoding($this->gestiones_numero_tabletas_diarias, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_numero_tabletas_diarias =\"" . $this->trata_dados($this->gestiones_numero_tabletas_diarias) . "\"";
   }
   //----- gestiones_brindo_apoyo
   function NM_export_gestiones_brindo_apoyo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_brindo_apoyo))
         {
             $this->gestiones_brindo_apoyo = sc_convert_encoding($this->gestiones_brindo_apoyo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_brindo_apoyo =\"" . $this->trata_dados($this->gestiones_brindo_apoyo) . "\"";
   }
   //----- gestiones_paap
   function NM_export_gestiones_paap()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_paap))
         {
             $this->gestiones_paap = sc_convert_encoding($this->gestiones_paap, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_paap =\"" . $this->trata_dados($this->gestiones_paap) . "\"";
   }
   //----- gestiones_sub_paap
   function NM_export_gestiones_sub_paap()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_sub_paap))
         {
             $this->gestiones_sub_paap = sc_convert_encoding($this->gestiones_sub_paap, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_sub_paap =\"" . $this->trata_dados($this->gestiones_sub_paap) . "\"";
   }
   //----- gestiones_barrera
   function NM_export_gestiones_barrera()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_barrera))
         {
             $this->gestiones_barrera = sc_convert_encoding($this->gestiones_barrera, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_barrera =\"" . $this->trata_dados($this->gestiones_barrera) . "\"";
   }
   //----- gestiones_informacion_aplicaciones
   function NM_export_gestiones_informacion_aplicaciones()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_informacion_aplicaciones))
         {
             $this->gestiones_informacion_aplicaciones = sc_convert_encoding($this->gestiones_informacion_aplicaciones, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_informacion_aplicaciones =\"" . $this->trata_dados($this->gestiones_informacion_aplicaciones) . "\"";
   }

   //----- 
   function trata_dados($conteudo)
   {
      $str_temp =  $conteudo;
      $str_temp =  str_replace("<br />", "",  $str_temp);
      $str_temp =  str_replace("&", "&amp;",  $str_temp);
      $str_temp =  str_replace("<", "&lt;",   $str_temp);
      $str_temp =  str_replace(">", "&gt;",   $str_temp);
      $str_temp =  str_replace("'", "&apos;", $str_temp);
      $str_temp =  str_replace('"', "&quot;",  $str_temp);
      $str_temp =  str_replace('(', "_",  $str_temp);
      $str_temp =  str_replace(')', "",  $str_temp);
      return ($str_temp);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['GESTION'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> -  :: XML</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XML</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="GESTION_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="GESTION"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
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

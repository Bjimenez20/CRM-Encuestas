<?php

class Informe_reclamacion_xml
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
   function Informe_reclamacion_xml()
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
      $this->arquivo     .= "_Informe_reclamacion";
      $this->arquivo_view = $this->arquivo . "_view.xml";
      $this->arquivo     .= ".xml";
      $this->tit_doc      = "Informe_reclamacion.xml";
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xml_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xml_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xml_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->arquivo_view = $this->arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT ID_PACIENTE, LOGRO_COMUNICACION_GESTION, FECHA_COMUNICACION, AUTOR_GESTION, DEPARTAMENTO_PACIENTE, CIUDAD_PACIENTE, ESTADO_PACIENTE, STATUS_PACIENTE, FECHA_ACTIVACION_PACIENTE, FECHA_RETIRO_PACIENTE, MOTIVO_RETIRO_PACIENTE, FECHA_INICIO_TERAPIA_TRATAMIENTO, CODIGO_XOFIGO, CLASIFICACION_PATOLOGICA_TRATAMIENTO, PRODUCTO_TRATAMIENTO, NOMBRE_REFERENCIA, DOSIS_TRATAMIENTO, FECHA_MEDICAMENTO_HASTA, NUMERO_CAJAS, ASEGURADOR_TRATAMIENTO, OPERADOR_LOGISTICO_TRATAMIENTO, PUNTO_ENTREGA, IPS_ATIENDE_TRATAMIENTO, REGIMEN_TRATAMIENTO, MEDICO_TRATAMIENTO, TRATAMIENTO_PREVIO, RECLAMO_GESTION, FECHA_RECLAMACION_GESTION, CAUSA_NO_RECLAMACION_GESTION, DESCRIPCION_COMUNICACION_GESTION, FECHA_PROGRAMADA_GESTION, ID_ULTIMA_GESTION, ID_TRATAMIENTO, ID_PACIENTE_FK, PAAP, SUB_PAAP, BARRERA, FECHA_INI_PAAP, FECHA_FIN_PAAP, ID_GESTION from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp"; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT ID_PACIENTE, LOGRO_COMUNICACION_GESTION, FECHA_COMUNICACION, AUTOR_GESTION, DEPARTAMENTO_PACIENTE, CIUDAD_PACIENTE, ESTADO_PACIENTE, STATUS_PACIENTE, FECHA_ACTIVACION_PACIENTE, FECHA_RETIRO_PACIENTE, MOTIVO_RETIRO_PACIENTE, FECHA_INICIO_TERAPIA_TRATAMIENTO, CODIGO_XOFIGO, CLASIFICACION_PATOLOGICA_TRATAMIENTO, PRODUCTO_TRATAMIENTO, NOMBRE_REFERENCIA, DOSIS_TRATAMIENTO, FECHA_MEDICAMENTO_HASTA, NUMERO_CAJAS, ASEGURADOR_TRATAMIENTO, OPERADOR_LOGISTICO_TRATAMIENTO, PUNTO_ENTREGA, IPS_ATIENDE_TRATAMIENTO, REGIMEN_TRATAMIENTO, MEDICO_TRATAMIENTO, TRATAMIENTO_PREVIO, RECLAMO_GESTION, FECHA_RECLAMACION_GESTION, CAUSA_NO_RECLAMACION_GESTION, DESCRIPCION_COMUNICACION_GESTION, FECHA_PROGRAMADA_GESTION, ID_ULTIMA_GESTION, ID_TRATAMIENTO, ID_PACIENTE_FK, PAAP, SUB_PAAP, BARRERA, FECHA_INI_PAAP, FECHA_FIN_PAAP, ID_GESTION from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp"; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nmgp_select = "SELECT ID_PACIENTE, LOGRO_COMUNICACION_GESTION, FECHA_COMUNICACION, AUTOR_GESTION, DEPARTAMENTO_PACIENTE, CIUDAD_PACIENTE, ESTADO_PACIENTE, STATUS_PACIENTE, FECHA_ACTIVACION_PACIENTE, FECHA_RETIRO_PACIENTE, MOTIVO_RETIRO_PACIENTE, FECHA_INICIO_TERAPIA_TRATAMIENTO, CODIGO_XOFIGO, CLASIFICACION_PATOLOGICA_TRATAMIENTO, PRODUCTO_TRATAMIENTO, NOMBRE_REFERENCIA, DOSIS_TRATAMIENTO, FECHA_MEDICAMENTO_HASTA, NUMERO_CAJAS, ASEGURADOR_TRATAMIENTO, OPERADOR_LOGISTICO_TRATAMIENTO, PUNTO_ENTREGA, IPS_ATIENDE_TRATAMIENTO, REGIMEN_TRATAMIENTO, MEDICO_TRATAMIENTO, TRATAMIENTO_PREVIO, RECLAMO_GESTION, FECHA_RECLAMACION_GESTION, CAUSA_NO_RECLAMACION_GESTION, DESCRIPCION_COMUNICACION_GESTION, FECHA_PROGRAMADA_GESTION, ID_ULTIMA_GESTION, ID_TRATAMIENTO, ID_PACIENTE_FK, PAAP, SUB_PAAP, BARRERA, FECHA_INI_PAAP, FECHA_FIN_PAAP, ID_GESTION from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp"; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT ID_PACIENTE, LOGRO_COMUNICACION_GESTION, TO_DATE(TO_CHAR(FECHA_COMUNICACION, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), AUTOR_GESTION, DEPARTAMENTO_PACIENTE, CIUDAD_PACIENTE, ESTADO_PACIENTE, STATUS_PACIENTE, FECHA_ACTIVACION_PACIENTE, FECHA_RETIRO_PACIENTE, MOTIVO_RETIRO_PACIENTE, FECHA_INICIO_TERAPIA_TRATAMIENTO, CODIGO_XOFIGO, CLASIFICACION_PATOLOGICA_TRATAMIENTO, PRODUCTO_TRATAMIENTO, NOMBRE_REFERENCIA, DOSIS_TRATAMIENTO, FECHA_MEDICAMENTO_HASTA, NUMERO_CAJAS, ASEGURADOR_TRATAMIENTO, OPERADOR_LOGISTICO_TRATAMIENTO, PUNTO_ENTREGA, IPS_ATIENDE_TRATAMIENTO, REGIMEN_TRATAMIENTO, MEDICO_TRATAMIENTO, TRATAMIENTO_PREVIO, RECLAMO_GESTION, FECHA_RECLAMACION_GESTION, CAUSA_NO_RECLAMACION_GESTION, DESCRIPCION_COMUNICACION_GESTION, FECHA_PROGRAMADA_GESTION, ID_ULTIMA_GESTION, ID_TRATAMIENTO, ID_PACIENTE_FK, PAAP, SUB_PAAP, BARRERA, FECHA_INI_PAAP, FECHA_FIN_PAAP, ID_GESTION from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp"; 
       } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT ID_PACIENTE, LOGRO_COMUNICACION_GESTION, FECHA_COMUNICACION, AUTOR_GESTION, DEPARTAMENTO_PACIENTE, CIUDAD_PACIENTE, ESTADO_PACIENTE, STATUS_PACIENTE, FECHA_ACTIVACION_PACIENTE, FECHA_RETIRO_PACIENTE, MOTIVO_RETIRO_PACIENTE, FECHA_INICIO_TERAPIA_TRATAMIENTO, CODIGO_XOFIGO, CLASIFICACION_PATOLOGICA_TRATAMIENTO, PRODUCTO_TRATAMIENTO, NOMBRE_REFERENCIA, DOSIS_TRATAMIENTO, FECHA_MEDICAMENTO_HASTA, NUMERO_CAJAS, ASEGURADOR_TRATAMIENTO, OPERADOR_LOGISTICO_TRATAMIENTO, PUNTO_ENTREGA, IPS_ATIENDE_TRATAMIENTO, REGIMEN_TRATAMIENTO, MEDICO_TRATAMIENTO, TRATAMIENTO_PREVIO, RECLAMO_GESTION, FECHA_RECLAMACION_GESTION, CAUSA_NO_RECLAMACION_GESTION, LOTOFILE(DESCRIPCION_COMUNICACION_GESTION, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as descripcion_comunicacion_gestion, FECHA_PROGRAMADA_GESTION, ID_ULTIMA_GESTION, ID_TRATAMIENTO, ID_PACIENTE_FK, PAAP, SUB_PAAP, BARRERA, FECHA_INI_PAAP, FECHA_FIN_PAAP, ID_GESTION from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp"; 
       } 
      else 
      { 
          $nmgp_select = "SELECT ID_PACIENTE, LOGRO_COMUNICACION_GESTION, FECHA_COMUNICACION, AUTOR_GESTION, DEPARTAMENTO_PACIENTE, CIUDAD_PACIENTE, ESTADO_PACIENTE, STATUS_PACIENTE, FECHA_ACTIVACION_PACIENTE, FECHA_RETIRO_PACIENTE, MOTIVO_RETIRO_PACIENTE, FECHA_INICIO_TERAPIA_TRATAMIENTO, CODIGO_XOFIGO, CLASIFICACION_PATOLOGICA_TRATAMIENTO, PRODUCTO_TRATAMIENTO, NOMBRE_REFERENCIA, DOSIS_TRATAMIENTO, FECHA_MEDICAMENTO_HASTA, NUMERO_CAJAS, ASEGURADOR_TRATAMIENTO, OPERADOR_LOGISTICO_TRATAMIENTO, PUNTO_ENTREGA, IPS_ATIENDE_TRATAMIENTO, REGIMEN_TRATAMIENTO, MEDICO_TRATAMIENTO, TRATAMIENTO_PREVIO, RECLAMO_GESTION, FECHA_RECLAMACION_GESTION, CAUSA_NO_RECLAMACION_GESTION, DESCRIPCION_COMUNICACION_GESTION, FECHA_PROGRAMADA_GESTION, ID_ULTIMA_GESTION, ID_TRATAMIENTO, ID_PACIENTE_FK, PAAP, SUB_PAAP, BARRERA, FECHA_INI_PAAP, FECHA_FIN_PAAP, ID_GESTION from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp"; 
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
         $this->xml_registro = "<Informe_reclamacion";
         $this->id_paciente = $rs->fields[0] ;  
         $this->id_paciente = (string)$this->id_paciente;
         $this->logro_comunicacion_gestion = $rs->fields[1] ;  
         $this->fecha_comunicacion = $rs->fields[2] ;  
         $this->autor_gestion = $rs->fields[3] ;  
         $this->departamento_paciente = $rs->fields[4] ;  
         $this->ciudad_paciente = $rs->fields[5] ;  
         $this->estado_paciente = $rs->fields[6] ;  
         $this->status_paciente = $rs->fields[7] ;  
         $this->fecha_activacion_paciente = $rs->fields[8] ;  
         $this->fecha_retiro_paciente = $rs->fields[9] ;  
         $this->motivo_retiro_paciente = $rs->fields[10] ;  
         $this->fecha_inicio_terapia_tratamiento = $rs->fields[11] ;  
         $this->codigo_xofigo = $rs->fields[12] ;  
         $this->codigo_xofigo = (string)$this->codigo_xofigo;
         $this->clasificacion_patologica_tratamiento = $rs->fields[13] ;  
         $this->producto_tratamiento = $rs->fields[14] ;  
         $this->nombre_referencia = $rs->fields[15] ;  
         $this->dosis_tratamiento = $rs->fields[16] ;  
         $this->fecha_medicamento_hasta = $rs->fields[17] ;  
         $this->numero_cajas = $rs->fields[18] ;  
         $this->asegurador_tratamiento = $rs->fields[19] ;  
         $this->operador_logistico_tratamiento = $rs->fields[20] ;  
         $this->punto_entrega = $rs->fields[21] ;  
         $this->ips_atiende_tratamiento = $rs->fields[22] ;  
         $this->regimen_tratamiento = $rs->fields[23] ;  
         $this->medico_tratamiento = $rs->fields[24] ;  
         $this->tratamiento_previo = $rs->fields[25] ;  
         $this->reclamo_gestion = $rs->fields[26] ;  
         $this->fecha_reclamacion_gestion = $rs->fields[27] ;  
         $this->causa_no_reclamacion_gestion = $rs->fields[28] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->descripcion_comunicacion_gestion = "";  
              if (is_file($rs_grid->fields[29])) 
              { 
                  $this->descripcion_comunicacion_gestion = file_get_contents($rs_grid->fields[29]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->descripcion_comunicacion_gestion = $this->Db->BlobDecode($rs->fields[29]) ;  
         } 
         else
         { 
             $this->descripcion_comunicacion_gestion = $rs->fields[29] ;  
         } 
         $this->fecha_programada_gestion = $rs->fields[30] ;  
         $this->id_ultima_gestion = $rs->fields[31] ;  
         $this->id_ultima_gestion = (string)$this->id_ultima_gestion;
         $this->id_tratamiento = $rs->fields[32] ;  
         $this->id_tratamiento = (string)$this->id_tratamiento;
         $this->id_paciente_fk = $rs->fields[33] ;  
         $this->id_paciente_fk = (string)$this->id_paciente_fk;
         $this->paap = $rs->fields[34] ;  
         $this->sub_paap = $rs->fields[35] ;  
         $this->barrera = $rs->fields[36] ;  
         $this->fecha_ini_paap = $rs->fields[37] ;  
         $this->fecha_fin_paap = $rs->fields[38] ;  
         $this->id_gestion = $rs->fields[39] ;  
         $this->id_gestion = (string)$this->id_gestion;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['field_order'] as $Cada_col)
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
   //----- id_paciente
   function NM_export_id_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->id_paciente))
         {
             $this->id_paciente = sc_convert_encoding($this->id_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " id_paciente =\"" . $this->trata_dados($this->id_paciente) . "\"";
   }
   //----- logro_comunicacion_gestion
   function NM_export_logro_comunicacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->logro_comunicacion_gestion))
         {
             $this->logro_comunicacion_gestion = sc_convert_encoding($this->logro_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " logro_comunicacion_gestion =\"" . $this->trata_dados($this->logro_comunicacion_gestion) . "\"";
   }
   //----- fecha_comunicacion
   function NM_export_fecha_comunicacion()
   {
         if (substr($this->fecha_comunicacion, 10, 1) == "-") 
         { 
             $this->fecha_comunicacion = substr($this->fecha_comunicacion, 0, 10) . " " . substr($this->fecha_comunicacion, 11);
         } 
         if (substr($this->fecha_comunicacion, 13, 1) == ".") 
         { 
            $this->fecha_comunicacion = substr($this->fecha_comunicacion, 0, 13) . ":" . substr($this->fecha_comunicacion, 14, 2) . ":" . substr($this->fecha_comunicacion, 17);
         } 
         $this->nm_data->SetaData($this->fecha_comunicacion, "YYYY-MM-DD HH:II:SS");
         $this->fecha_comunicacion = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fecha_comunicacion))
         {
             $this->fecha_comunicacion = sc_convert_encoding($this->fecha_comunicacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " fecha_comunicacion =\"" . $this->trata_dados($this->fecha_comunicacion) . "\"";
   }
   //----- autor_gestion
   function NM_export_autor_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->autor_gestion))
         {
             $this->autor_gestion = sc_convert_encoding($this->autor_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " autor_gestion =\"" . $this->trata_dados($this->autor_gestion) . "\"";
   }
   //----- departamento_paciente
   function NM_export_departamento_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->departamento_paciente))
         {
             $this->departamento_paciente = sc_convert_encoding($this->departamento_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " departamento_paciente =\"" . $this->trata_dados($this->departamento_paciente) . "\"";
   }
   //----- ciudad_paciente
   function NM_export_ciudad_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ciudad_paciente))
         {
             $this->ciudad_paciente = sc_convert_encoding($this->ciudad_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " ciudad_paciente =\"" . $this->trata_dados($this->ciudad_paciente) . "\"";
   }
   //----- estado_paciente
   function NM_export_estado_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->estado_paciente))
         {
             $this->estado_paciente = sc_convert_encoding($this->estado_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " estado_paciente =\"" . $this->trata_dados($this->estado_paciente) . "\"";
   }
   //----- status_paciente
   function NM_export_status_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->status_paciente))
         {
             $this->status_paciente = sc_convert_encoding($this->status_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " status_paciente =\"" . $this->trata_dados($this->status_paciente) . "\"";
   }
   //----- fecha_activacion_paciente
   function NM_export_fecha_activacion_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fecha_activacion_paciente))
         {
             $this->fecha_activacion_paciente = sc_convert_encoding($this->fecha_activacion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " fecha_activacion_paciente =\"" . $this->trata_dados($this->fecha_activacion_paciente) . "\"";
   }
   //----- fecha_retiro_paciente
   function NM_export_fecha_retiro_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fecha_retiro_paciente))
         {
             $this->fecha_retiro_paciente = sc_convert_encoding($this->fecha_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " fecha_retiro_paciente =\"" . $this->trata_dados($this->fecha_retiro_paciente) . "\"";
   }
   //----- motivo_retiro_paciente
   function NM_export_motivo_retiro_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->motivo_retiro_paciente))
         {
             $this->motivo_retiro_paciente = sc_convert_encoding($this->motivo_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " motivo_retiro_paciente =\"" . $this->trata_dados($this->motivo_retiro_paciente) . "\"";
   }
   //----- fecha_inicio_terapia_tratamiento
   function NM_export_fecha_inicio_terapia_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fecha_inicio_terapia_tratamiento))
         {
             $this->fecha_inicio_terapia_tratamiento = sc_convert_encoding($this->fecha_inicio_terapia_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " fecha_inicio_terapia_tratamiento =\"" . $this->trata_dados($this->fecha_inicio_terapia_tratamiento) . "\"";
   }
   //----- codigo_xofigo
   function NM_export_codigo_xofigo()
   {
         nmgp_Form_Num_Val($this->codigo_xofigo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->codigo_xofigo))
         {
             $this->codigo_xofigo = sc_convert_encoding($this->codigo_xofigo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " codigo_xofigo =\"" . $this->trata_dados($this->codigo_xofigo) . "\"";
   }
   //----- clasificacion_patologica_tratamiento
   function NM_export_clasificacion_patologica_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->clasificacion_patologica_tratamiento))
         {
             $this->clasificacion_patologica_tratamiento = sc_convert_encoding($this->clasificacion_patologica_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " clasificacion_patologica_tratamiento =\"" . $this->trata_dados($this->clasificacion_patologica_tratamiento) . "\"";
   }
   //----- producto_tratamiento
   function NM_export_producto_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->producto_tratamiento))
         {
             $this->producto_tratamiento = sc_convert_encoding($this->producto_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " producto_tratamiento =\"" . $this->trata_dados($this->producto_tratamiento) . "\"";
   }
   //----- nombre_referencia
   function NM_export_nombre_referencia()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nombre_referencia))
         {
             $this->nombre_referencia = sc_convert_encoding($this->nombre_referencia, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " nombre_referencia =\"" . $this->trata_dados($this->nombre_referencia) . "\"";
   }
   //----- dosis_tratamiento
   function NM_export_dosis_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->dosis_tratamiento))
         {
             $this->dosis_tratamiento = sc_convert_encoding($this->dosis_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " dosis_tratamiento =\"" . $this->trata_dados($this->dosis_tratamiento) . "\"";
   }
   //----- fecha_medicamento_hasta
   function NM_export_fecha_medicamento_hasta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fecha_medicamento_hasta))
         {
             $this->fecha_medicamento_hasta = sc_convert_encoding($this->fecha_medicamento_hasta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " fecha_medicamento_hasta =\"" . $this->trata_dados($this->fecha_medicamento_hasta) . "\"";
   }
   //----- numero_cajas
   function NM_export_numero_cajas()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->numero_cajas))
         {
             $this->numero_cajas = sc_convert_encoding($this->numero_cajas, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " numero_cajas =\"" . $this->trata_dados($this->numero_cajas) . "\"";
   }
   //----- asegurador_tratamiento
   function NM_export_asegurador_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->asegurador_tratamiento))
         {
             $this->asegurador_tratamiento = sc_convert_encoding($this->asegurador_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " asegurador_tratamiento =\"" . $this->trata_dados($this->asegurador_tratamiento) . "\"";
   }
   //----- operador_logistico_tratamiento
   function NM_export_operador_logistico_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->operador_logistico_tratamiento))
         {
             $this->operador_logistico_tratamiento = sc_convert_encoding($this->operador_logistico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " operador_logistico_tratamiento =\"" . $this->trata_dados($this->operador_logistico_tratamiento) . "\"";
   }
   //----- punto_entrega
   function NM_export_punto_entrega()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->punto_entrega))
         {
             $this->punto_entrega = sc_convert_encoding($this->punto_entrega, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " punto_entrega =\"" . $this->trata_dados($this->punto_entrega) . "\"";
   }
   //----- ips_atiende_tratamiento
   function NM_export_ips_atiende_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ips_atiende_tratamiento))
         {
             $this->ips_atiende_tratamiento = sc_convert_encoding($this->ips_atiende_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " ips_atiende_tratamiento =\"" . $this->trata_dados($this->ips_atiende_tratamiento) . "\"";
   }
   //----- regimen_tratamiento
   function NM_export_regimen_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->regimen_tratamiento))
         {
             $this->regimen_tratamiento = sc_convert_encoding($this->regimen_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " regimen_tratamiento =\"" . $this->trata_dados($this->regimen_tratamiento) . "\"";
   }
   //----- medico_tratamiento
   function NM_export_medico_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->medico_tratamiento))
         {
             $this->medico_tratamiento = sc_convert_encoding($this->medico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " medico_tratamiento =\"" . $this->trata_dados($this->medico_tratamiento) . "\"";
   }
   //----- tratamiento_previo
   function NM_export_tratamiento_previo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_previo))
         {
             $this->tratamiento_previo = sc_convert_encoding($this->tratamiento_previo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_previo =\"" . $this->trata_dados($this->tratamiento_previo) . "\"";
   }
   //----- reclamo_gestion
   function NM_export_reclamo_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->reclamo_gestion))
         {
             $this->reclamo_gestion = sc_convert_encoding($this->reclamo_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " reclamo_gestion =\"" . $this->trata_dados($this->reclamo_gestion) . "\"";
   }
   //----- fecha_reclamacion_gestion
   function NM_export_fecha_reclamacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fecha_reclamacion_gestion))
         {
             $this->fecha_reclamacion_gestion = sc_convert_encoding($this->fecha_reclamacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " fecha_reclamacion_gestion =\"" . $this->trata_dados($this->fecha_reclamacion_gestion) . "\"";
   }
   //----- causa_no_reclamacion_gestion
   function NM_export_causa_no_reclamacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->causa_no_reclamacion_gestion))
         {
             $this->causa_no_reclamacion_gestion = sc_convert_encoding($this->causa_no_reclamacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " causa_no_reclamacion_gestion =\"" . $this->trata_dados($this->causa_no_reclamacion_gestion) . "\"";
   }
   //----- descripcion_comunicacion_gestion
   function NM_export_descripcion_comunicacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->descripcion_comunicacion_gestion))
         {
             $this->descripcion_comunicacion_gestion = sc_convert_encoding($this->descripcion_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " descripcion_comunicacion_gestion =\"" . $this->trata_dados($this->descripcion_comunicacion_gestion) . "\"";
   }
   //----- fecha_programada_gestion
   function NM_export_fecha_programada_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fecha_programada_gestion))
         {
             $this->fecha_programada_gestion = sc_convert_encoding($this->fecha_programada_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " fecha_programada_gestion =\"" . $this->trata_dados($this->fecha_programada_gestion) . "\"";
   }
   //----- id_ultima_gestion
   function NM_export_id_ultima_gestion()
   {
         nmgp_Form_Num_Val($this->id_ultima_gestion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->id_ultima_gestion))
         {
             $this->id_ultima_gestion = sc_convert_encoding($this->id_ultima_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " id_ultima_gestion =\"" . $this->trata_dados($this->id_ultima_gestion) . "\"";
   }
   //----- id_tratamiento
   function NM_export_id_tratamiento()
   {
         nmgp_Form_Num_Val($this->id_tratamiento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->id_tratamiento))
         {
             $this->id_tratamiento = sc_convert_encoding($this->id_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " id_tratamiento =\"" . $this->trata_dados($this->id_tratamiento) . "\"";
   }
   //----- id_paciente_fk
   function NM_export_id_paciente_fk()
   {
         nmgp_Form_Num_Val($this->id_paciente_fk, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->id_paciente_fk))
         {
             $this->id_paciente_fk = sc_convert_encoding($this->id_paciente_fk, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " id_paciente_fk =\"" . $this->trata_dados($this->id_paciente_fk) . "\"";
   }
   //----- paap
   function NM_export_paap()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->paap))
         {
             $this->paap = sc_convert_encoding($this->paap, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " paap =\"" . $this->trata_dados($this->paap) . "\"";
   }
   //----- sub_paap
   function NM_export_sub_paap()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sub_paap))
         {
             $this->sub_paap = sc_convert_encoding($this->sub_paap, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " sub_paap =\"" . $this->trata_dados($this->sub_paap) . "\"";
   }
   //----- barrera
   function NM_export_barrera()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->barrera))
         {
             $this->barrera = sc_convert_encoding($this->barrera, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " barrera =\"" . $this->trata_dados($this->barrera) . "\"";
   }
   //----- fecha_ini_paap
   function NM_export_fecha_ini_paap()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fecha_ini_paap))
         {
             $this->fecha_ini_paap = sc_convert_encoding($this->fecha_ini_paap, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " fecha_ini_paap =\"" . $this->trata_dados($this->fecha_ini_paap) . "\"";
   }
   //----- fecha_fin_paap
   function NM_export_fecha_fin_paap()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fecha_fin_paap))
         {
             $this->fecha_fin_paap = sc_convert_encoding($this->fecha_fin_paap, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " fecha_fin_paap =\"" . $this->trata_dados($this->fecha_fin_paap) . "\"";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Informe Reclamaciones :: XML</TITLE>
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
<form name="Fdown" method="get" action="Informe_reclamacion_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="Informe_reclamacion"> 
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

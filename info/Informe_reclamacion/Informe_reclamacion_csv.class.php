<?php

class Informe_reclamacion_csv
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;

   var $arquivo;
   var $tit_doc;
   var $delim_dados;
   var $delim_line;
   var $delim_col;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function Informe_reclamacion_csv()
   {
      $this->nm_data   = new nm_data("es");
   }

   //---- 
   function monta_csv()
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
      $this->arquivo     = "sc_csv";
      $this->arquivo    .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->arquivo    .= "_Informe_reclamacion";
      $this->arquivo    .= ".csv";
      $this->tit_doc    = "Informe_reclamacion.csv";
      $this->delim_dados = "\"";
      $this->delim_col   = ";";
      $this->delim_line  = "\r\n";
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['csv_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['csv_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['csv_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['csv_name']);
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

      $csv_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo, "w");
      $this->NM_prim_col  = 0;
      $this->csv_registro = "";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_paciente'])) ? $this->New_label['id_paciente'] : "ID PACIENTE"; 
          if ($Cada_col == "id_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['logro_comunicacion_gestion'])) ? $this->New_label['logro_comunicacion_gestion'] : "LOGRO COMUNICACION GESTION"; 
          if ($Cada_col == "logro_comunicacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['fecha_comunicacion'])) ? $this->New_label['fecha_comunicacion'] : "FECHA COMUNICACION"; 
          if ($Cada_col == "fecha_comunicacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['autor_gestion'])) ? $this->New_label['autor_gestion'] : "AUTOR GESTION"; 
          if ($Cada_col == "autor_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['departamento_paciente'])) ? $this->New_label['departamento_paciente'] : "DEPARTAMENTO PACIENTE"; 
          if ($Cada_col == "departamento_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['ciudad_paciente'])) ? $this->New_label['ciudad_paciente'] : "CIUDAD PACIENTE"; 
          if ($Cada_col == "ciudad_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['estado_paciente'])) ? $this->New_label['estado_paciente'] : "ESTADO PACIENTE"; 
          if ($Cada_col == "estado_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['status_paciente'])) ? $this->New_label['status_paciente'] : "STATUS PACIENTE"; 
          if ($Cada_col == "status_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['fecha_activacion_paciente'])) ? $this->New_label['fecha_activacion_paciente'] : "FECHA ACTIVACION PACIENTE"; 
          if ($Cada_col == "fecha_activacion_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['fecha_retiro_paciente'])) ? $this->New_label['fecha_retiro_paciente'] : "FECHA RETIRO PACIENTE"; 
          if ($Cada_col == "fecha_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['motivo_retiro_paciente'])) ? $this->New_label['motivo_retiro_paciente'] : "MOTIVO RETIRO PACIENTE"; 
          if ($Cada_col == "motivo_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['fecha_inicio_terapia_tratamiento'])) ? $this->New_label['fecha_inicio_terapia_tratamiento'] : "FECHA INICIO TERAPIA TRATAMIENTO"; 
          if ($Cada_col == "fecha_inicio_terapia_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['codigo_xofigo'])) ? $this->New_label['codigo_xofigo'] : "CODIGO XOFIGO"; 
          if ($Cada_col == "codigo_xofigo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['clasificacion_patologica_tratamiento'])) ? $this->New_label['clasificacion_patologica_tratamiento'] : "CLASIFICACION PATOLOGICA TRATAMIENTO"; 
          if ($Cada_col == "clasificacion_patologica_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['producto_tratamiento'])) ? $this->New_label['producto_tratamiento'] : "PRODUCTO TRATAMIENTO"; 
          if ($Cada_col == "producto_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['nombre_referencia'])) ? $this->New_label['nombre_referencia'] : "NOMBRE REFERENCIA"; 
          if ($Cada_col == "nombre_referencia" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['dosis_tratamiento'])) ? $this->New_label['dosis_tratamiento'] : "DOSIS TRATAMIENTO"; 
          if ($Cada_col == "dosis_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['fecha_medicamento_hasta'])) ? $this->New_label['fecha_medicamento_hasta'] : "FECHA MEDICAMENTO HASTA"; 
          if ($Cada_col == "fecha_medicamento_hasta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['numero_cajas'])) ? $this->New_label['numero_cajas'] : "NUMERO CAJAS"; 
          if ($Cada_col == "numero_cajas" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['asegurador_tratamiento'])) ? $this->New_label['asegurador_tratamiento'] : "ASEGURADOR TRATAMIENTO"; 
          if ($Cada_col == "asegurador_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['operador_logistico_tratamiento'])) ? $this->New_label['operador_logistico_tratamiento'] : "OPERADOR LOGISTICO TRATAMIENTO"; 
          if ($Cada_col == "operador_logistico_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['punto_entrega'])) ? $this->New_label['punto_entrega'] : "PUNTO ENTREGA"; 
          if ($Cada_col == "punto_entrega" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['ips_atiende_tratamiento'])) ? $this->New_label['ips_atiende_tratamiento'] : "IPS"; 
          if ($Cada_col == "ips_atiende_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['regimen_tratamiento'])) ? $this->New_label['regimen_tratamiento'] : "REGIMEN TRATAMIENTO"; 
          if ($Cada_col == "regimen_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['medico_tratamiento'])) ? $this->New_label['medico_tratamiento'] : "MEDICO TRATAMIENTO"; 
          if ($Cada_col == "medico_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['tratamiento_previo'])) ? $this->New_label['tratamiento_previo'] : "TRATAMIENTO PREVIO"; 
          if ($Cada_col == "tratamiento_previo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['reclamo_gestion'])) ? $this->New_label['reclamo_gestion'] : "RECLAMO GESTION"; 
          if ($Cada_col == "reclamo_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['fecha_reclamacion_gestion'])) ? $this->New_label['fecha_reclamacion_gestion'] : "FECHA RECLAMACION GESTION"; 
          if ($Cada_col == "fecha_reclamacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['causa_no_reclamacion_gestion'])) ? $this->New_label['causa_no_reclamacion_gestion'] : "CAUSA NO RECLAMACION GESTION"; 
          if ($Cada_col == "causa_no_reclamacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['descripcion_comunicacion_gestion'])) ? $this->New_label['descripcion_comunicacion_gestion'] : "DESCRIPCION COMUNICACION GESTION"; 
          if ($Cada_col == "descripcion_comunicacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['fecha_programada_gestion'])) ? $this->New_label['fecha_programada_gestion'] : "FECHA PROGRAMADA GESTION"; 
          if ($Cada_col == "fecha_programada_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['id_ultima_gestion'])) ? $this->New_label['id_ultima_gestion'] : "ID ULTIMA GESTION"; 
          if ($Cada_col == "id_ultima_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['id_tratamiento'])) ? $this->New_label['id_tratamiento'] : "ID TRATAMIENTO"; 
          if ($Cada_col == "id_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['id_paciente_fk'])) ? $this->New_label['id_paciente_fk'] : "ID PACIENTE FK"; 
          if ($Cada_col == "id_paciente_fk" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['paap'])) ? $this->New_label['paap'] : "PAAP"; 
          if ($Cada_col == "paap" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['sub_paap'])) ? $this->New_label['sub_paap'] : "SUB PAAP"; 
          if ($Cada_col == "sub_paap" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['barrera'])) ? $this->New_label['barrera'] : "BARRERA"; 
          if ($Cada_col == "barrera" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['fecha_ini_paap'])) ? $this->New_label['fecha_ini_paap'] : "FECHA INI PAAP"; 
          if ($Cada_col == "fecha_ini_paap" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
          $SC_Label = (isset($this->New_label['fecha_fin_paap'])) ? $this->New_label['fecha_fin_paap'] : "FECHA FIN PAAP"; 
          if ($Cada_col == "fecha_fin_paap" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
              $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $SC_Label);
              $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
              $this->NM_prim_col++;
          }
      } 
      $this->csv_registro .= $this->delim_line;
      fwrite($csv_f, $this->csv_registro);
      while (!$rs->EOF)
      {
         $this->csv_registro = "";
         $this->NM_prim_col  = 0;
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
         $this->csv_registro .= $this->delim_line;
         fwrite($csv_f, $this->csv_registro);
         $rs->MoveNext();
      }
      fclose($csv_f);

      $rs->Close();
   }
   //----- id_paciente
   function NM_export_id_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->id_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- logro_comunicacion_gestion
   function NM_export_logro_comunicacion_gestion()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->logro_comunicacion_gestion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
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
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->fecha_comunicacion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- autor_gestion
   function NM_export_autor_gestion()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->autor_gestion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- departamento_paciente
   function NM_export_departamento_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->departamento_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- ciudad_paciente
   function NM_export_ciudad_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->ciudad_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- estado_paciente
   function NM_export_estado_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->estado_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- status_paciente
   function NM_export_status_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->status_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_activacion_paciente
   function NM_export_fecha_activacion_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->fecha_activacion_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_retiro_paciente
   function NM_export_fecha_retiro_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->fecha_retiro_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- motivo_retiro_paciente
   function NM_export_motivo_retiro_paciente()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->motivo_retiro_paciente);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_inicio_terapia_tratamiento
   function NM_export_fecha_inicio_terapia_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->fecha_inicio_terapia_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- codigo_xofigo
   function NM_export_codigo_xofigo()
   {
         nmgp_Form_Num_Val($this->codigo_xofigo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->codigo_xofigo);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- clasificacion_patologica_tratamiento
   function NM_export_clasificacion_patologica_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->clasificacion_patologica_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- producto_tratamiento
   function NM_export_producto_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->producto_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- nombre_referencia
   function NM_export_nombre_referencia()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->nombre_referencia);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- dosis_tratamiento
   function NM_export_dosis_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->dosis_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_medicamento_hasta
   function NM_export_fecha_medicamento_hasta()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->fecha_medicamento_hasta);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- numero_cajas
   function NM_export_numero_cajas()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->numero_cajas);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- asegurador_tratamiento
   function NM_export_asegurador_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->asegurador_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- operador_logistico_tratamiento
   function NM_export_operador_logistico_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->operador_logistico_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- punto_entrega
   function NM_export_punto_entrega()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->punto_entrega);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- ips_atiende_tratamiento
   function NM_export_ips_atiende_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->ips_atiende_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- regimen_tratamiento
   function NM_export_regimen_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->regimen_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- medico_tratamiento
   function NM_export_medico_tratamiento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->medico_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- tratamiento_previo
   function NM_export_tratamiento_previo()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->tratamiento_previo);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- reclamo_gestion
   function NM_export_reclamo_gestion()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->reclamo_gestion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_reclamacion_gestion
   function NM_export_fecha_reclamacion_gestion()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->fecha_reclamacion_gestion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- causa_no_reclamacion_gestion
   function NM_export_causa_no_reclamacion_gestion()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->causa_no_reclamacion_gestion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- descripcion_comunicacion_gestion
   function NM_export_descripcion_comunicacion_gestion()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->descripcion_comunicacion_gestion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_programada_gestion
   function NM_export_fecha_programada_gestion()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->fecha_programada_gestion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_ultima_gestion
   function NM_export_id_ultima_gestion()
   {
         nmgp_Form_Num_Val($this->id_ultima_gestion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->id_ultima_gestion);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_tratamiento
   function NM_export_id_tratamiento()
   {
         nmgp_Form_Num_Val($this->id_tratamiento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->id_tratamiento);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- id_paciente_fk
   function NM_export_id_paciente_fk()
   {
         nmgp_Form_Num_Val($this->id_paciente_fk, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->id_paciente_fk);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- paap
   function NM_export_paap()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->paap);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- sub_paap
   function NM_export_sub_paap()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->sub_paap);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- barrera
   function NM_export_barrera()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->barrera);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_ini_paap
   function NM_export_fecha_ini_paap()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->fecha_ini_paap);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
   }
   //----- fecha_fin_paap
   function NM_export_fecha_fin_paap()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->delim_col : "";
      $conteudo = str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $this->fecha_fin_paap);
      $this->csv_registro .= $col_sep . $this->delim_dados . $conteudo . $this->delim_dados;
      $this->NM_prim_col++;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML>
<HEAD>
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
</HEAD>
<BODY>
<SCRIPT>
    window.location='<?php echo $this->Ini->path_imag_temp . "/" . $this->arquivo; ?>';
</SCRIPT>
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

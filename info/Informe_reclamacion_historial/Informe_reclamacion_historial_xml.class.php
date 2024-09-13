<?php

class Informe_reclamacion_historial_xml
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
   function Informe_reclamacion_historial_xml()
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
      $this->arquivo     .= "_Informe_reclamacion_historial";
      $this->arquivo_view = $this->arquivo . "_view.xml";
      $this->arquivo     .= ".xml";
      $this->tit_doc      = "Informe_reclamacion_historial.xml";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['xml_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['xml_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['xml_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->arquivo_view = $this->arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_8, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_9, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_10, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_11, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_12, tratamiento.PUNTO_ENTREGA as cmp_maior_30_13, gestiones.RECLAMO_GESTION as cmp_maior_30_14, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_15, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_16, historial_reclamacion.ID_HISTORIAL_RECLAMACION as cmp_maior_30_17, historial_reclamacion.ANIO_HISTORIAL_RECLAMACION as cmp_maior_30_18, historial_reclamacion.MES1 as cmp_maior_30_19, historial_reclamacion.RECLAMO1 as cmp_maior_30_20, historial_reclamacion.FECHA_RECLAMACION1 as cmp_maior_30_21, historial_reclamacion.MOTIVO_NO_RECLAMACION1 as cmp_maior_30_22, historial_reclamacion.MES2 as cmp_maior_30_23, historial_reclamacion.RECLAMO2 as cmp_maior_30_24, historial_reclamacion.FECHA_RECLAMACION2 as cmp_maior_30_25, historial_reclamacion.MOTIVO_NO_RECLAMACION2 as cmp_maior_30_26, historial_reclamacion.MES3 as cmp_maior_30_27, historial_reclamacion.RECLAMO3 as cmp_maior_30_28, historial_reclamacion.FECHA_RECLAMACION3 as cmp_maior_30_29, historial_reclamacion.MOTIVO_NO_RECLAMACION3 as cmp_maior_30_30, historial_reclamacion.MES4 as cmp_maior_30_31, historial_reclamacion.RECLAMO4 as cmp_maior_30_32, historial_reclamacion.FECHA_RECLAMACION4 as cmp_maior_30_33, historial_reclamacion.MOTIVO_NO_RECLAMACION4 as cmp_maior_30_34, historial_reclamacion.MES5 as cmp_maior_30_35, historial_reclamacion.RECLAMO5 as cmp_maior_30_36, historial_reclamacion.FECHA_RECLAMACION5 as cmp_maior_30_37, historial_reclamacion.MOTIVO_NO_RECLAMACION5 as cmp_maior_30_38, historial_reclamacion.MES6 as cmp_maior_30_39, historial_reclamacion.RECLAMO6 as cmp_maior_30_40, historial_reclamacion.FECHA_RECLAMACION6 as cmp_maior_30_41, historial_reclamacion.MOTIVO_NO_RECLAMACION6 as cmp_maior_30_42, historial_reclamacion.MES7 as cmp_maior_30_43, historial_reclamacion.RECLAMO7 as cmp_maior_30_44, historial_reclamacion.FECHA_RECLAMACION7 as cmp_maior_30_45, historial_reclamacion.MOTIVO_NO_RECLAMACION7 as cmp_maior_30_46, historial_reclamacion.MES8 as cmp_maior_30_47, historial_reclamacion.RECLAMO8 as cmp_maior_30_48, historial_reclamacion.FECHA_RECLAMACION8 as cmp_maior_30_49, historial_reclamacion.MOTIVO_NO_RECLAMACION8 as cmp_maior_30_50, historial_reclamacion.MES9 as cmp_maior_30_51, historial_reclamacion.RECLAMO9 as cmp_maior_30_52, historial_reclamacion.FECHA_RECLAMACION9 as cmp_maior_30_53, historial_reclamacion.MOTIVO_NO_RECLAMACION9 as cmp_maior_30_54, historial_reclamacion.MES10 as cmp_maior_30_55, historial_reclamacion.RECLAMO10 as cmp_maior_30_56, historial_reclamacion.FECHA_RECLAMACION10 as cmp_maior_30_57, historial_reclamacion.MOTIVO_NO_RECLAMACION10 as cmp_maior_30_58, historial_reclamacion.MES11 as cmp_maior_30_59, historial_reclamacion.RECLAMO11 as cmp_maior_30_60, historial_reclamacion.FECHA_RECLAMACION11 as cmp_maior_30_61, historial_reclamacion.MOTIVO_NO_RECLAMACION11 as cmp_maior_30_62, historial_reclamacion.MES12 as cmp_maior_30_63, historial_reclamacion.RECLAMO12 as cmp_maior_30_64, historial_reclamacion.FECHA_RECLAMACION12 as cmp_maior_30_65, historial_reclamacion.MOTIVO_NO_RECLAMACION12 as cmp_maior_30_66 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_8, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_9, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_10, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_11, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_12, tratamiento.PUNTO_ENTREGA as cmp_maior_30_13, gestiones.RECLAMO_GESTION as cmp_maior_30_14, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_15, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_16, historial_reclamacion.ID_HISTORIAL_RECLAMACION as cmp_maior_30_17, historial_reclamacion.ANIO_HISTORIAL_RECLAMACION as cmp_maior_30_18, historial_reclamacion.MES1 as cmp_maior_30_19, historial_reclamacion.RECLAMO1 as cmp_maior_30_20, historial_reclamacion.FECHA_RECLAMACION1 as cmp_maior_30_21, historial_reclamacion.MOTIVO_NO_RECLAMACION1 as cmp_maior_30_22, historial_reclamacion.MES2 as cmp_maior_30_23, historial_reclamacion.RECLAMO2 as cmp_maior_30_24, historial_reclamacion.FECHA_RECLAMACION2 as cmp_maior_30_25, historial_reclamacion.MOTIVO_NO_RECLAMACION2 as cmp_maior_30_26, historial_reclamacion.MES3 as cmp_maior_30_27, historial_reclamacion.RECLAMO3 as cmp_maior_30_28, historial_reclamacion.FECHA_RECLAMACION3 as cmp_maior_30_29, historial_reclamacion.MOTIVO_NO_RECLAMACION3 as cmp_maior_30_30, historial_reclamacion.MES4 as cmp_maior_30_31, historial_reclamacion.RECLAMO4 as cmp_maior_30_32, historial_reclamacion.FECHA_RECLAMACION4 as cmp_maior_30_33, historial_reclamacion.MOTIVO_NO_RECLAMACION4 as cmp_maior_30_34, historial_reclamacion.MES5 as cmp_maior_30_35, historial_reclamacion.RECLAMO5 as cmp_maior_30_36, historial_reclamacion.FECHA_RECLAMACION5 as cmp_maior_30_37, historial_reclamacion.MOTIVO_NO_RECLAMACION5 as cmp_maior_30_38, historial_reclamacion.MES6 as cmp_maior_30_39, historial_reclamacion.RECLAMO6 as cmp_maior_30_40, historial_reclamacion.FECHA_RECLAMACION6 as cmp_maior_30_41, historial_reclamacion.MOTIVO_NO_RECLAMACION6 as cmp_maior_30_42, historial_reclamacion.MES7 as cmp_maior_30_43, historial_reclamacion.RECLAMO7 as cmp_maior_30_44, historial_reclamacion.FECHA_RECLAMACION7 as cmp_maior_30_45, historial_reclamacion.MOTIVO_NO_RECLAMACION7 as cmp_maior_30_46, historial_reclamacion.MES8 as cmp_maior_30_47, historial_reclamacion.RECLAMO8 as cmp_maior_30_48, historial_reclamacion.FECHA_RECLAMACION8 as cmp_maior_30_49, historial_reclamacion.MOTIVO_NO_RECLAMACION8 as cmp_maior_30_50, historial_reclamacion.MES9 as cmp_maior_30_51, historial_reclamacion.RECLAMO9 as cmp_maior_30_52, historial_reclamacion.FECHA_RECLAMACION9 as cmp_maior_30_53, historial_reclamacion.MOTIVO_NO_RECLAMACION9 as cmp_maior_30_54, historial_reclamacion.MES10 as cmp_maior_30_55, historial_reclamacion.RECLAMO10 as cmp_maior_30_56, historial_reclamacion.FECHA_RECLAMACION10 as cmp_maior_30_57, historial_reclamacion.MOTIVO_NO_RECLAMACION10 as cmp_maior_30_58, historial_reclamacion.MES11 as cmp_maior_30_59, historial_reclamacion.RECLAMO11 as cmp_maior_30_60, historial_reclamacion.FECHA_RECLAMACION11 as cmp_maior_30_61, historial_reclamacion.MOTIVO_NO_RECLAMACION11 as cmp_maior_30_62, historial_reclamacion.MES12 as cmp_maior_30_63, historial_reclamacion.RECLAMO12 as cmp_maior_30_64, historial_reclamacion.FECHA_RECLAMACION12 as cmp_maior_30_65, historial_reclamacion.MOTIVO_NO_RECLAMACION12 as cmp_maior_30_66 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_8, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_9, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_10, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_11, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_12, tratamiento.PUNTO_ENTREGA as cmp_maior_30_13, gestiones.RECLAMO_GESTION as cmp_maior_30_14, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_15, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_16, historial_reclamacion.ID_HISTORIAL_RECLAMACION as cmp_maior_30_17, historial_reclamacion.ANIO_HISTORIAL_RECLAMACION as cmp_maior_30_18, historial_reclamacion.MES1 as cmp_maior_30_19, historial_reclamacion.RECLAMO1 as cmp_maior_30_20, historial_reclamacion.FECHA_RECLAMACION1 as cmp_maior_30_21, historial_reclamacion.MOTIVO_NO_RECLAMACION1 as cmp_maior_30_22, historial_reclamacion.MES2 as cmp_maior_30_23, historial_reclamacion.RECLAMO2 as cmp_maior_30_24, historial_reclamacion.FECHA_RECLAMACION2 as cmp_maior_30_25, historial_reclamacion.MOTIVO_NO_RECLAMACION2 as cmp_maior_30_26, historial_reclamacion.MES3 as cmp_maior_30_27, historial_reclamacion.RECLAMO3 as cmp_maior_30_28, historial_reclamacion.FECHA_RECLAMACION3 as cmp_maior_30_29, historial_reclamacion.MOTIVO_NO_RECLAMACION3 as cmp_maior_30_30, historial_reclamacion.MES4 as cmp_maior_30_31, historial_reclamacion.RECLAMO4 as cmp_maior_30_32, historial_reclamacion.FECHA_RECLAMACION4 as cmp_maior_30_33, historial_reclamacion.MOTIVO_NO_RECLAMACION4 as cmp_maior_30_34, historial_reclamacion.MES5 as cmp_maior_30_35, historial_reclamacion.RECLAMO5 as cmp_maior_30_36, historial_reclamacion.FECHA_RECLAMACION5 as cmp_maior_30_37, historial_reclamacion.MOTIVO_NO_RECLAMACION5 as cmp_maior_30_38, historial_reclamacion.MES6 as cmp_maior_30_39, historial_reclamacion.RECLAMO6 as cmp_maior_30_40, historial_reclamacion.FECHA_RECLAMACION6 as cmp_maior_30_41, historial_reclamacion.MOTIVO_NO_RECLAMACION6 as cmp_maior_30_42, historial_reclamacion.MES7 as cmp_maior_30_43, historial_reclamacion.RECLAMO7 as cmp_maior_30_44, historial_reclamacion.FECHA_RECLAMACION7 as cmp_maior_30_45, historial_reclamacion.MOTIVO_NO_RECLAMACION7 as cmp_maior_30_46, historial_reclamacion.MES8 as cmp_maior_30_47, historial_reclamacion.RECLAMO8 as cmp_maior_30_48, historial_reclamacion.FECHA_RECLAMACION8 as cmp_maior_30_49, historial_reclamacion.MOTIVO_NO_RECLAMACION8 as cmp_maior_30_50, historial_reclamacion.MES9 as cmp_maior_30_51, historial_reclamacion.RECLAMO9 as cmp_maior_30_52, historial_reclamacion.FECHA_RECLAMACION9 as cmp_maior_30_53, historial_reclamacion.MOTIVO_NO_RECLAMACION9 as cmp_maior_30_54, historial_reclamacion.MES10 as cmp_maior_30_55, historial_reclamacion.RECLAMO10 as cmp_maior_30_56, historial_reclamacion.FECHA_RECLAMACION10 as cmp_maior_30_57, historial_reclamacion.MOTIVO_NO_RECLAMACION10 as cmp_maior_30_58, historial_reclamacion.MES11 as cmp_maior_30_59, historial_reclamacion.RECLAMO11 as cmp_maior_30_60, historial_reclamacion.FECHA_RECLAMACION11 as cmp_maior_30_61, historial_reclamacion.MOTIVO_NO_RECLAMACION11 as cmp_maior_30_62, historial_reclamacion.MES12 as cmp_maior_30_63, historial_reclamacion.RECLAMO12 as cmp_maior_30_64, historial_reclamacion.FECHA_RECLAMACION12 as cmp_maior_30_65, historial_reclamacion.MOTIVO_NO_RECLAMACION12 as cmp_maior_30_66 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, TO_DATE(TO_CHAR(gestiones.FECHA_COMUNICACION, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss') as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_8, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_9, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_10, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_11, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_12, tratamiento.PUNTO_ENTREGA as cmp_maior_30_13, gestiones.RECLAMO_GESTION as cmp_maior_30_14, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_15, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_16, historial_reclamacion.ID_HISTORIAL_RECLAMACION as cmp_maior_30_17, historial_reclamacion.ANIO_HISTORIAL_RECLAMACION as cmp_maior_30_18, historial_reclamacion.MES1 as cmp_maior_30_19, historial_reclamacion.RECLAMO1 as cmp_maior_30_20, historial_reclamacion.FECHA_RECLAMACION1 as cmp_maior_30_21, historial_reclamacion.MOTIVO_NO_RECLAMACION1 as cmp_maior_30_22, historial_reclamacion.MES2 as cmp_maior_30_23, historial_reclamacion.RECLAMO2 as cmp_maior_30_24, historial_reclamacion.FECHA_RECLAMACION2 as cmp_maior_30_25, historial_reclamacion.MOTIVO_NO_RECLAMACION2 as cmp_maior_30_26, historial_reclamacion.MES3 as cmp_maior_30_27, historial_reclamacion.RECLAMO3 as cmp_maior_30_28, historial_reclamacion.FECHA_RECLAMACION3 as cmp_maior_30_29, historial_reclamacion.MOTIVO_NO_RECLAMACION3 as cmp_maior_30_30, historial_reclamacion.MES4 as cmp_maior_30_31, historial_reclamacion.RECLAMO4 as cmp_maior_30_32, historial_reclamacion.FECHA_RECLAMACION4 as cmp_maior_30_33, historial_reclamacion.MOTIVO_NO_RECLAMACION4 as cmp_maior_30_34, historial_reclamacion.MES5 as cmp_maior_30_35, historial_reclamacion.RECLAMO5 as cmp_maior_30_36, historial_reclamacion.FECHA_RECLAMACION5 as cmp_maior_30_37, historial_reclamacion.MOTIVO_NO_RECLAMACION5 as cmp_maior_30_38, historial_reclamacion.MES6 as cmp_maior_30_39, historial_reclamacion.RECLAMO6 as cmp_maior_30_40, historial_reclamacion.FECHA_RECLAMACION6 as cmp_maior_30_41, historial_reclamacion.MOTIVO_NO_RECLAMACION6 as cmp_maior_30_42, historial_reclamacion.MES7 as cmp_maior_30_43, historial_reclamacion.RECLAMO7 as cmp_maior_30_44, historial_reclamacion.FECHA_RECLAMACION7 as cmp_maior_30_45, historial_reclamacion.MOTIVO_NO_RECLAMACION7 as cmp_maior_30_46, historial_reclamacion.MES8 as cmp_maior_30_47, historial_reclamacion.RECLAMO8 as cmp_maior_30_48, historial_reclamacion.FECHA_RECLAMACION8 as cmp_maior_30_49, historial_reclamacion.MOTIVO_NO_RECLAMACION8 as cmp_maior_30_50, historial_reclamacion.MES9 as cmp_maior_30_51, historial_reclamacion.RECLAMO9 as cmp_maior_30_52, historial_reclamacion.FECHA_RECLAMACION9 as cmp_maior_30_53, historial_reclamacion.MOTIVO_NO_RECLAMACION9 as cmp_maior_30_54, historial_reclamacion.MES10 as cmp_maior_30_55, historial_reclamacion.RECLAMO10 as cmp_maior_30_56, historial_reclamacion.FECHA_RECLAMACION10 as cmp_maior_30_57, historial_reclamacion.MOTIVO_NO_RECLAMACION10 as cmp_maior_30_58, historial_reclamacion.MES11 as cmp_maior_30_59, historial_reclamacion.RECLAMO11 as cmp_maior_30_60, historial_reclamacion.FECHA_RECLAMACION11 as cmp_maior_30_61, historial_reclamacion.MOTIVO_NO_RECLAMACION11 as cmp_maior_30_62, historial_reclamacion.MES12 as cmp_maior_30_63, historial_reclamacion.RECLAMO12 as cmp_maior_30_64, historial_reclamacion.FECHA_RECLAMACION12 as cmp_maior_30_65, historial_reclamacion.MOTIVO_NO_RECLAMACION12 as cmp_maior_30_66 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_8, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_9, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_10, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_11, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_12, tratamiento.PUNTO_ENTREGA as cmp_maior_30_13, gestiones.RECLAMO_GESTION as cmp_maior_30_14, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_15, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_16, historial_reclamacion.ID_HISTORIAL_RECLAMACION as cmp_maior_30_17, historial_reclamacion.ANIO_HISTORIAL_RECLAMACION as cmp_maior_30_18, historial_reclamacion.MES1 as cmp_maior_30_19, historial_reclamacion.RECLAMO1 as cmp_maior_30_20, historial_reclamacion.FECHA_RECLAMACION1 as cmp_maior_30_21, historial_reclamacion.MOTIVO_NO_RECLAMACION1 as cmp_maior_30_22, historial_reclamacion.MES2 as cmp_maior_30_23, historial_reclamacion.RECLAMO2 as cmp_maior_30_24, historial_reclamacion.FECHA_RECLAMACION2 as cmp_maior_30_25, historial_reclamacion.MOTIVO_NO_RECLAMACION2 as cmp_maior_30_26, historial_reclamacion.MES3 as cmp_maior_30_27, historial_reclamacion.RECLAMO3 as cmp_maior_30_28, historial_reclamacion.FECHA_RECLAMACION3 as cmp_maior_30_29, historial_reclamacion.MOTIVO_NO_RECLAMACION3 as cmp_maior_30_30, historial_reclamacion.MES4 as cmp_maior_30_31, historial_reclamacion.RECLAMO4 as cmp_maior_30_32, historial_reclamacion.FECHA_RECLAMACION4 as cmp_maior_30_33, historial_reclamacion.MOTIVO_NO_RECLAMACION4 as cmp_maior_30_34, historial_reclamacion.MES5 as cmp_maior_30_35, historial_reclamacion.RECLAMO5 as cmp_maior_30_36, historial_reclamacion.FECHA_RECLAMACION5 as cmp_maior_30_37, historial_reclamacion.MOTIVO_NO_RECLAMACION5 as cmp_maior_30_38, historial_reclamacion.MES6 as cmp_maior_30_39, historial_reclamacion.RECLAMO6 as cmp_maior_30_40, historial_reclamacion.FECHA_RECLAMACION6 as cmp_maior_30_41, historial_reclamacion.MOTIVO_NO_RECLAMACION6 as cmp_maior_30_42, historial_reclamacion.MES7 as cmp_maior_30_43, historial_reclamacion.RECLAMO7 as cmp_maior_30_44, historial_reclamacion.FECHA_RECLAMACION7 as cmp_maior_30_45, historial_reclamacion.MOTIVO_NO_RECLAMACION7 as cmp_maior_30_46, historial_reclamacion.MES8 as cmp_maior_30_47, historial_reclamacion.RECLAMO8 as cmp_maior_30_48, historial_reclamacion.FECHA_RECLAMACION8 as cmp_maior_30_49, historial_reclamacion.MOTIVO_NO_RECLAMACION8 as cmp_maior_30_50, historial_reclamacion.MES9 as cmp_maior_30_51, historial_reclamacion.RECLAMO9 as cmp_maior_30_52, historial_reclamacion.FECHA_RECLAMACION9 as cmp_maior_30_53, historial_reclamacion.MOTIVO_NO_RECLAMACION9 as cmp_maior_30_54, historial_reclamacion.MES10 as cmp_maior_30_55, historial_reclamacion.RECLAMO10 as cmp_maior_30_56, historial_reclamacion.FECHA_RECLAMACION10 as cmp_maior_30_57, historial_reclamacion.MOTIVO_NO_RECLAMACION10 as cmp_maior_30_58, historial_reclamacion.MES11 as cmp_maior_30_59, historial_reclamacion.RECLAMO11 as cmp_maior_30_60, historial_reclamacion.FECHA_RECLAMACION11 as cmp_maior_30_61, historial_reclamacion.MOTIVO_NO_RECLAMACION11 as cmp_maior_30_62, historial_reclamacion.MES12 as cmp_maior_30_63, historial_reclamacion.RECLAMO12 as cmp_maior_30_64, historial_reclamacion.FECHA_RECLAMACION12 as cmp_maior_30_65, historial_reclamacion.MOTIVO_NO_RECLAMACION12 as cmp_maior_30_66 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_8, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_9, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_10, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_11, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_12, tratamiento.PUNTO_ENTREGA as cmp_maior_30_13, gestiones.RECLAMO_GESTION as cmp_maior_30_14, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_15, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_16, historial_reclamacion.ID_HISTORIAL_RECLAMACION as cmp_maior_30_17, historial_reclamacion.ANIO_HISTORIAL_RECLAMACION as cmp_maior_30_18, historial_reclamacion.MES1 as cmp_maior_30_19, historial_reclamacion.RECLAMO1 as cmp_maior_30_20, historial_reclamacion.FECHA_RECLAMACION1 as cmp_maior_30_21, historial_reclamacion.MOTIVO_NO_RECLAMACION1 as cmp_maior_30_22, historial_reclamacion.MES2 as cmp_maior_30_23, historial_reclamacion.RECLAMO2 as cmp_maior_30_24, historial_reclamacion.FECHA_RECLAMACION2 as cmp_maior_30_25, historial_reclamacion.MOTIVO_NO_RECLAMACION2 as cmp_maior_30_26, historial_reclamacion.MES3 as cmp_maior_30_27, historial_reclamacion.RECLAMO3 as cmp_maior_30_28, historial_reclamacion.FECHA_RECLAMACION3 as cmp_maior_30_29, historial_reclamacion.MOTIVO_NO_RECLAMACION3 as cmp_maior_30_30, historial_reclamacion.MES4 as cmp_maior_30_31, historial_reclamacion.RECLAMO4 as cmp_maior_30_32, historial_reclamacion.FECHA_RECLAMACION4 as cmp_maior_30_33, historial_reclamacion.MOTIVO_NO_RECLAMACION4 as cmp_maior_30_34, historial_reclamacion.MES5 as cmp_maior_30_35, historial_reclamacion.RECLAMO5 as cmp_maior_30_36, historial_reclamacion.FECHA_RECLAMACION5 as cmp_maior_30_37, historial_reclamacion.MOTIVO_NO_RECLAMACION5 as cmp_maior_30_38, historial_reclamacion.MES6 as cmp_maior_30_39, historial_reclamacion.RECLAMO6 as cmp_maior_30_40, historial_reclamacion.FECHA_RECLAMACION6 as cmp_maior_30_41, historial_reclamacion.MOTIVO_NO_RECLAMACION6 as cmp_maior_30_42, historial_reclamacion.MES7 as cmp_maior_30_43, historial_reclamacion.RECLAMO7 as cmp_maior_30_44, historial_reclamacion.FECHA_RECLAMACION7 as cmp_maior_30_45, historial_reclamacion.MOTIVO_NO_RECLAMACION7 as cmp_maior_30_46, historial_reclamacion.MES8 as cmp_maior_30_47, historial_reclamacion.RECLAMO8 as cmp_maior_30_48, historial_reclamacion.FECHA_RECLAMACION8 as cmp_maior_30_49, historial_reclamacion.MOTIVO_NO_RECLAMACION8 as cmp_maior_30_50, historial_reclamacion.MES9 as cmp_maior_30_51, historial_reclamacion.RECLAMO9 as cmp_maior_30_52, historial_reclamacion.FECHA_RECLAMACION9 as cmp_maior_30_53, historial_reclamacion.MOTIVO_NO_RECLAMACION9 as cmp_maior_30_54, historial_reclamacion.MES10 as cmp_maior_30_55, historial_reclamacion.RECLAMO10 as cmp_maior_30_56, historial_reclamacion.FECHA_RECLAMACION10 as cmp_maior_30_57, historial_reclamacion.MOTIVO_NO_RECLAMACION10 as cmp_maior_30_58, historial_reclamacion.MES11 as cmp_maior_30_59, historial_reclamacion.RECLAMO11 as cmp_maior_30_60, historial_reclamacion.FECHA_RECLAMACION11 as cmp_maior_30_61, historial_reclamacion.MOTIVO_NO_RECLAMACION11 as cmp_maior_30_62, historial_reclamacion.MES12 as cmp_maior_30_63, historial_reclamacion.RECLAMO12 as cmp_maior_30_64, historial_reclamacion.FECHA_RECLAMACION12 as cmp_maior_30_65, historial_reclamacion.MOTIVO_NO_RECLAMACION12 as cmp_maior_30_66 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['order_grid'];
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
         $this->xml_registro = "<Informe_reclamacion_historial";
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
         $this->pacientes_codigo_xofigo = $rs->fields[9] ;  
         $this->pacientes_codigo_xofigo = (string)$this->pacientes_codigo_xofigo;
         $this->tratamiento_producto_tratamiento = $rs->fields[10] ;  
         $this->tratamiento_nombre_referencia = $rs->fields[11] ;  
         $this->tratamiento_dosis_tratamiento = $rs->fields[12] ;  
         $this->gestiones_numero_cajas = $rs->fields[13] ;  
         $this->tratamiento_asegurador_tratamiento = $rs->fields[14] ;  
         $this->tratamiento_operador_logistico_tratamiento = $rs->fields[15] ;  
         $this->tratamiento_punto_entrega = $rs->fields[16] ;  
         $this->gestiones_reclamo_gestion = $rs->fields[17] ;  
         $this->gestiones_fecha_reclamacion_gestion = $rs->fields[18] ;  
         $this->gestiones_causa_no_reclamacion_gestion = $rs->fields[19] ;  
         $this->historial_reclamacion_id_historial_reclamacion = $rs->fields[20] ;  
         $this->historial_reclamacion_id_historial_reclamacion = (string)$this->historial_reclamacion_id_historial_reclamacion;
         $this->historial_reclamacion_anio_historial_reclamacion = $rs->fields[21] ;  
         $this->historial_reclamacion_anio_historial_reclamacion = (string)$this->historial_reclamacion_anio_historial_reclamacion;
         $this->historial_reclamacion_mes1 = $rs->fields[22] ;  
         $this->historial_reclamacion_reclamo1 = $rs->fields[23] ;  
         $this->historial_reclamacion_fecha_reclamacion1 = $rs->fields[24] ;  
         $this->historial_reclamacion_motivo_no_reclamacion1 = $rs->fields[25] ;  
         $this->historial_reclamacion_mes2 = $rs->fields[26] ;  
         $this->historial_reclamacion_reclamo2 = $rs->fields[27] ;  
         $this->historial_reclamacion_fecha_reclamacion2 = $rs->fields[28] ;  
         $this->historial_reclamacion_motivo_no_reclamacion2 = $rs->fields[29] ;  
         $this->historial_reclamacion_mes3 = $rs->fields[30] ;  
         $this->historial_reclamacion_reclamo3 = $rs->fields[31] ;  
         $this->historial_reclamacion_fecha_reclamacion3 = $rs->fields[32] ;  
         $this->historial_reclamacion_motivo_no_reclamacion3 = $rs->fields[33] ;  
         $this->historial_reclamacion_mes4 = $rs->fields[34] ;  
         $this->historial_reclamacion_reclamo4 = $rs->fields[35] ;  
         $this->historial_reclamacion_fecha_reclamacion4 = $rs->fields[36] ;  
         $this->historial_reclamacion_motivo_no_reclamacion4 = $rs->fields[37] ;  
         $this->historial_reclamacion_mes5 = $rs->fields[38] ;  
         $this->historial_reclamacion_reclamo5 = $rs->fields[39] ;  
         $this->historial_reclamacion_fecha_reclamacion5 = $rs->fields[40] ;  
         $this->historial_reclamacion_motivo_no_reclamacion5 = $rs->fields[41] ;  
         $this->historial_reclamacion_mes6 = $rs->fields[42] ;  
         $this->historial_reclamacion_reclamo6 = $rs->fields[43] ;  
         $this->historial_reclamacion_fecha_reclamacion6 = $rs->fields[44] ;  
         $this->historial_reclamacion_motivo_no_reclamacion6 = $rs->fields[45] ;  
         $this->historial_reclamacion_mes7 = $rs->fields[46] ;  
         $this->historial_reclamacion_reclamo7 = $rs->fields[47] ;  
         $this->historial_reclamacion_fecha_reclamacion7 = $rs->fields[48] ;  
         $this->historial_reclamacion_motivo_no_reclamacion7 = $rs->fields[49] ;  
         $this->historial_reclamacion_mes8 = $rs->fields[50] ;  
         $this->historial_reclamacion_reclamo8 = $rs->fields[51] ;  
         $this->historial_reclamacion_fecha_reclamacion8 = $rs->fields[52] ;  
         $this->historial_reclamacion_motivo_no_reclamacion8 = $rs->fields[53] ;  
         $this->historial_reclamacion_mes9 = $rs->fields[54] ;  
         $this->historial_reclamacion_reclamo9 = $rs->fields[55] ;  
         $this->historial_reclamacion_fecha_reclamacion9 = $rs->fields[56] ;  
         $this->historial_reclamacion_motivo_no_reclamacion9 = $rs->fields[57] ;  
         $this->historial_reclamacion_mes10 = $rs->fields[58] ;  
         $this->historial_reclamacion_reclamo10 = $rs->fields[59] ;  
         $this->historial_reclamacion_fecha_reclamacion10 = $rs->fields[60] ;  
         $this->historial_reclamacion_motivo_no_reclamacion10 = $rs->fields[61] ;  
         $this->historial_reclamacion_mes11 = $rs->fields[62] ;  
         $this->historial_reclamacion_reclamo11 = $rs->fields[63] ;  
         $this->historial_reclamacion_fecha_reclamacion11 = $rs->fields[64] ;  
         $this->historial_reclamacion_motivo_no_reclamacion11 = $rs->fields[65] ;  
         $this->historial_reclamacion_mes12 = $rs->fields[66] ;  
         $this->historial_reclamacion_reclamo12 = $rs->fields[67] ;  
         $this->historial_reclamacion_fecha_reclamacion12 = $rs->fields[68] ;  
         $this->historial_reclamacion_motivo_no_reclamacion12 = $rs->fields[69] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['field_order'] as $Cada_col)
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
   //----- pacientes_id_paciente
   function NM_export_pacientes_id_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_id_paciente))
         {
             $this->pacientes_id_paciente = sc_convert_encoding($this->pacientes_id_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_id_paciente =\"" . $this->trata_dados($this->pacientes_id_paciente) . "\"";
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
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_fecha_comunicacion))
         {
             $this->gestiones_fecha_comunicacion = sc_convert_encoding($this->gestiones_fecha_comunicacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_fecha_comunicacion =\"" . $this->trata_dados($this->gestiones_fecha_comunicacion) . "\"";
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
   //----- pacientes_departamento_paciente
   function NM_export_pacientes_departamento_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_departamento_paciente))
         {
             $this->pacientes_departamento_paciente = sc_convert_encoding($this->pacientes_departamento_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_departamento_paciente =\"" . $this->trata_dados($this->pacientes_departamento_paciente) . "\"";
   }
   //----- pacientes_ciudad_paciente
   function NM_export_pacientes_ciudad_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_ciudad_paciente))
         {
             $this->pacientes_ciudad_paciente = sc_convert_encoding($this->pacientes_ciudad_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_ciudad_paciente =\"" . $this->trata_dados($this->pacientes_ciudad_paciente) . "\"";
   }
   //----- pacientes_estado_paciente
   function NM_export_pacientes_estado_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_estado_paciente))
         {
             $this->pacientes_estado_paciente = sc_convert_encoding($this->pacientes_estado_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_estado_paciente =\"" . $this->trata_dados($this->pacientes_estado_paciente) . "\"";
   }
   //----- pacientes_status_paciente
   function NM_export_pacientes_status_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_status_paciente))
         {
             $this->pacientes_status_paciente = sc_convert_encoding($this->pacientes_status_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_status_paciente =\"" . $this->trata_dados($this->pacientes_status_paciente) . "\"";
   }
   //----- pacientes_fecha_activacion_paciente
   function NM_export_pacientes_fecha_activacion_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_fecha_activacion_paciente))
         {
             $this->pacientes_fecha_activacion_paciente = sc_convert_encoding($this->pacientes_fecha_activacion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_fecha_activacion_paciente =\"" . $this->trata_dados($this->pacientes_fecha_activacion_paciente) . "\"";
   }
   //----- pacientes_codigo_xofigo
   function NM_export_pacientes_codigo_xofigo()
   {
         nmgp_Form_Num_Val($this->pacientes_codigo_xofigo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_codigo_xofigo))
         {
             $this->pacientes_codigo_xofigo = sc_convert_encoding($this->pacientes_codigo_xofigo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_codigo_xofigo =\"" . $this->trata_dados($this->pacientes_codigo_xofigo) . "\"";
   }
   //----- tratamiento_producto_tratamiento
   function NM_export_tratamiento_producto_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_producto_tratamiento))
         {
             $this->tratamiento_producto_tratamiento = sc_convert_encoding($this->tratamiento_producto_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_producto_tratamiento =\"" . $this->trata_dados($this->tratamiento_producto_tratamiento) . "\"";
   }
   //----- tratamiento_nombre_referencia
   function NM_export_tratamiento_nombre_referencia()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_nombre_referencia))
         {
             $this->tratamiento_nombre_referencia = sc_convert_encoding($this->tratamiento_nombre_referencia, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_nombre_referencia =\"" . $this->trata_dados($this->tratamiento_nombre_referencia) . "\"";
   }
   //----- tratamiento_dosis_tratamiento
   function NM_export_tratamiento_dosis_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_dosis_tratamiento))
         {
             $this->tratamiento_dosis_tratamiento = sc_convert_encoding($this->tratamiento_dosis_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_dosis_tratamiento =\"" . $this->trata_dados($this->tratamiento_dosis_tratamiento) . "\"";
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
   //----- tratamiento_asegurador_tratamiento
   function NM_export_tratamiento_asegurador_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_asegurador_tratamiento))
         {
             $this->tratamiento_asegurador_tratamiento = sc_convert_encoding($this->tratamiento_asegurador_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_asegurador_tratamiento =\"" . $this->trata_dados($this->tratamiento_asegurador_tratamiento) . "\"";
   }
   //----- tratamiento_operador_logistico_tratamiento
   function NM_export_tratamiento_operador_logistico_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_operador_logistico_tratamiento))
         {
             $this->tratamiento_operador_logistico_tratamiento = sc_convert_encoding($this->tratamiento_operador_logistico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_operador_logistico_tratamiento =\"" . $this->trata_dados($this->tratamiento_operador_logistico_tratamiento) . "\"";
   }
   //----- tratamiento_punto_entrega
   function NM_export_tratamiento_punto_entrega()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_punto_entrega))
         {
             $this->tratamiento_punto_entrega = sc_convert_encoding($this->tratamiento_punto_entrega, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_punto_entrega =\"" . $this->trata_dados($this->tratamiento_punto_entrega) . "\"";
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
   //----- gestiones_fecha_reclamacion_gestion
   function NM_export_gestiones_fecha_reclamacion_gestion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_fecha_reclamacion_gestion))
         {
             $this->gestiones_fecha_reclamacion_gestion = sc_convert_encoding($this->gestiones_fecha_reclamacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_fecha_reclamacion_gestion =\"" . $this->trata_dados($this->gestiones_fecha_reclamacion_gestion) . "\"";
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
   //----- historial_reclamacion_id_historial_reclamacion
   function NM_export_historial_reclamacion_id_historial_reclamacion()
   {
         nmgp_Form_Num_Val($this->historial_reclamacion_id_historial_reclamacion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_id_historial_reclamacion))
         {
             $this->historial_reclamacion_id_historial_reclamacion = sc_convert_encoding($this->historial_reclamacion_id_historial_reclamacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_id_historial_reclamacion =\"" . $this->trata_dados($this->historial_reclamacion_id_historial_reclamacion) . "\"";
   }
   //----- historial_reclamacion_anio_historial_reclamacion
   function NM_export_historial_reclamacion_anio_historial_reclamacion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_anio_historial_reclamacion))
         {
             $this->historial_reclamacion_anio_historial_reclamacion = sc_convert_encoding($this->historial_reclamacion_anio_historial_reclamacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_anio_historial_reclamacion =\"" . $this->trata_dados($this->historial_reclamacion_anio_historial_reclamacion) . "\"";
   }
   //----- historial_reclamacion_mes1
   function NM_export_historial_reclamacion_mes1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes1))
         {
             $this->historial_reclamacion_mes1 = sc_convert_encoding($this->historial_reclamacion_mes1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes1 =\"" . $this->trata_dados($this->historial_reclamacion_mes1) . "\"";
   }
   //----- historial_reclamacion_reclamo1
   function NM_export_historial_reclamacion_reclamo1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo1))
         {
             $this->historial_reclamacion_reclamo1 = sc_convert_encoding($this->historial_reclamacion_reclamo1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo1 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo1) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion1
   function NM_export_historial_reclamacion_fecha_reclamacion1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion1))
         {
             $this->historial_reclamacion_fecha_reclamacion1 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion1 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion1) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion1
   function NM_export_historial_reclamacion_motivo_no_reclamacion1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion1))
         {
             $this->historial_reclamacion_motivo_no_reclamacion1 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion1 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion1) . "\"";
   }
   //----- historial_reclamacion_mes2
   function NM_export_historial_reclamacion_mes2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes2))
         {
             $this->historial_reclamacion_mes2 = sc_convert_encoding($this->historial_reclamacion_mes2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes2 =\"" . $this->trata_dados($this->historial_reclamacion_mes2) . "\"";
   }
   //----- historial_reclamacion_reclamo2
   function NM_export_historial_reclamacion_reclamo2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo2))
         {
             $this->historial_reclamacion_reclamo2 = sc_convert_encoding($this->historial_reclamacion_reclamo2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo2 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo2) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion2
   function NM_export_historial_reclamacion_fecha_reclamacion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion2))
         {
             $this->historial_reclamacion_fecha_reclamacion2 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion2 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion2) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion2
   function NM_export_historial_reclamacion_motivo_no_reclamacion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion2))
         {
             $this->historial_reclamacion_motivo_no_reclamacion2 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion2 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion2) . "\"";
   }
   //----- historial_reclamacion_mes3
   function NM_export_historial_reclamacion_mes3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes3))
         {
             $this->historial_reclamacion_mes3 = sc_convert_encoding($this->historial_reclamacion_mes3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes3 =\"" . $this->trata_dados($this->historial_reclamacion_mes3) . "\"";
   }
   //----- historial_reclamacion_reclamo3
   function NM_export_historial_reclamacion_reclamo3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo3))
         {
             $this->historial_reclamacion_reclamo3 = sc_convert_encoding($this->historial_reclamacion_reclamo3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo3 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo3) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion3
   function NM_export_historial_reclamacion_fecha_reclamacion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion3))
         {
             $this->historial_reclamacion_fecha_reclamacion3 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion3 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion3) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion3
   function NM_export_historial_reclamacion_motivo_no_reclamacion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion3))
         {
             $this->historial_reclamacion_motivo_no_reclamacion3 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion3 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion3) . "\"";
   }
   //----- historial_reclamacion_mes4
   function NM_export_historial_reclamacion_mes4()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes4))
         {
             $this->historial_reclamacion_mes4 = sc_convert_encoding($this->historial_reclamacion_mes4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes4 =\"" . $this->trata_dados($this->historial_reclamacion_mes4) . "\"";
   }
   //----- historial_reclamacion_reclamo4
   function NM_export_historial_reclamacion_reclamo4()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo4))
         {
             $this->historial_reclamacion_reclamo4 = sc_convert_encoding($this->historial_reclamacion_reclamo4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo4 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo4) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion4
   function NM_export_historial_reclamacion_fecha_reclamacion4()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion4))
         {
             $this->historial_reclamacion_fecha_reclamacion4 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion4 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion4) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion4
   function NM_export_historial_reclamacion_motivo_no_reclamacion4()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion4))
         {
             $this->historial_reclamacion_motivo_no_reclamacion4 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion4 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion4) . "\"";
   }
   //----- historial_reclamacion_mes5
   function NM_export_historial_reclamacion_mes5()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes5))
         {
             $this->historial_reclamacion_mes5 = sc_convert_encoding($this->historial_reclamacion_mes5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes5 =\"" . $this->trata_dados($this->historial_reclamacion_mes5) . "\"";
   }
   //----- historial_reclamacion_reclamo5
   function NM_export_historial_reclamacion_reclamo5()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo5))
         {
             $this->historial_reclamacion_reclamo5 = sc_convert_encoding($this->historial_reclamacion_reclamo5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo5 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo5) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion5
   function NM_export_historial_reclamacion_fecha_reclamacion5()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion5))
         {
             $this->historial_reclamacion_fecha_reclamacion5 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion5 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion5) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion5
   function NM_export_historial_reclamacion_motivo_no_reclamacion5()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion5))
         {
             $this->historial_reclamacion_motivo_no_reclamacion5 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion5 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion5) . "\"";
   }
   //----- historial_reclamacion_mes6
   function NM_export_historial_reclamacion_mes6()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes6))
         {
             $this->historial_reclamacion_mes6 = sc_convert_encoding($this->historial_reclamacion_mes6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes6 =\"" . $this->trata_dados($this->historial_reclamacion_mes6) . "\"";
   }
   //----- historial_reclamacion_reclamo6
   function NM_export_historial_reclamacion_reclamo6()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo6))
         {
             $this->historial_reclamacion_reclamo6 = sc_convert_encoding($this->historial_reclamacion_reclamo6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo6 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo6) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion6
   function NM_export_historial_reclamacion_fecha_reclamacion6()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion6))
         {
             $this->historial_reclamacion_fecha_reclamacion6 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion6 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion6) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion6
   function NM_export_historial_reclamacion_motivo_no_reclamacion6()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion6))
         {
             $this->historial_reclamacion_motivo_no_reclamacion6 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion6 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion6) . "\"";
   }
   //----- historial_reclamacion_mes7
   function NM_export_historial_reclamacion_mes7()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes7))
         {
             $this->historial_reclamacion_mes7 = sc_convert_encoding($this->historial_reclamacion_mes7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes7 =\"" . $this->trata_dados($this->historial_reclamacion_mes7) . "\"";
   }
   //----- historial_reclamacion_reclamo7
   function NM_export_historial_reclamacion_reclamo7()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo7))
         {
             $this->historial_reclamacion_reclamo7 = sc_convert_encoding($this->historial_reclamacion_reclamo7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo7 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo7) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion7
   function NM_export_historial_reclamacion_fecha_reclamacion7()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion7))
         {
             $this->historial_reclamacion_fecha_reclamacion7 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion7 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion7) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion7
   function NM_export_historial_reclamacion_motivo_no_reclamacion7()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion7))
         {
             $this->historial_reclamacion_motivo_no_reclamacion7 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion7 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion7) . "\"";
   }
   //----- historial_reclamacion_mes8
   function NM_export_historial_reclamacion_mes8()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes8))
         {
             $this->historial_reclamacion_mes8 = sc_convert_encoding($this->historial_reclamacion_mes8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes8 =\"" . $this->trata_dados($this->historial_reclamacion_mes8) . "\"";
   }
   //----- historial_reclamacion_reclamo8
   function NM_export_historial_reclamacion_reclamo8()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo8))
         {
             $this->historial_reclamacion_reclamo8 = sc_convert_encoding($this->historial_reclamacion_reclamo8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo8 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo8) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion8
   function NM_export_historial_reclamacion_fecha_reclamacion8()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion8))
         {
             $this->historial_reclamacion_fecha_reclamacion8 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion8 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion8) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion8
   function NM_export_historial_reclamacion_motivo_no_reclamacion8()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion8))
         {
             $this->historial_reclamacion_motivo_no_reclamacion8 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion8 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion8) . "\"";
   }
   //----- historial_reclamacion_mes9
   function NM_export_historial_reclamacion_mes9()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes9))
         {
             $this->historial_reclamacion_mes9 = sc_convert_encoding($this->historial_reclamacion_mes9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes9 =\"" . $this->trata_dados($this->historial_reclamacion_mes9) . "\"";
   }
   //----- historial_reclamacion_reclamo9
   function NM_export_historial_reclamacion_reclamo9()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo9))
         {
             $this->historial_reclamacion_reclamo9 = sc_convert_encoding($this->historial_reclamacion_reclamo9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo9 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo9) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion9
   function NM_export_historial_reclamacion_fecha_reclamacion9()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion9))
         {
             $this->historial_reclamacion_fecha_reclamacion9 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion9 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion9) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion9
   function NM_export_historial_reclamacion_motivo_no_reclamacion9()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion9))
         {
             $this->historial_reclamacion_motivo_no_reclamacion9 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion9 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion9) . "\"";
   }
   //----- historial_reclamacion_mes10
   function NM_export_historial_reclamacion_mes10()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes10))
         {
             $this->historial_reclamacion_mes10 = sc_convert_encoding($this->historial_reclamacion_mes10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes10 =\"" . $this->trata_dados($this->historial_reclamacion_mes10) . "\"";
   }
   //----- historial_reclamacion_reclamo10
   function NM_export_historial_reclamacion_reclamo10()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo10))
         {
             $this->historial_reclamacion_reclamo10 = sc_convert_encoding($this->historial_reclamacion_reclamo10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo10 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo10) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion10
   function NM_export_historial_reclamacion_fecha_reclamacion10()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion10))
         {
             $this->historial_reclamacion_fecha_reclamacion10 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion10 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion10) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion10
   function NM_export_historial_reclamacion_motivo_no_reclamacion10()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion10))
         {
             $this->historial_reclamacion_motivo_no_reclamacion10 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion10 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion10) . "\"";
   }
   //----- historial_reclamacion_mes11
   function NM_export_historial_reclamacion_mes11()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes11))
         {
             $this->historial_reclamacion_mes11 = sc_convert_encoding($this->historial_reclamacion_mes11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes11 =\"" . $this->trata_dados($this->historial_reclamacion_mes11) . "\"";
   }
   //----- historial_reclamacion_reclamo11
   function NM_export_historial_reclamacion_reclamo11()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo11))
         {
             $this->historial_reclamacion_reclamo11 = sc_convert_encoding($this->historial_reclamacion_reclamo11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo11 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo11) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion11
   function NM_export_historial_reclamacion_fecha_reclamacion11()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion11))
         {
             $this->historial_reclamacion_fecha_reclamacion11 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion11 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion11) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion11
   function NM_export_historial_reclamacion_motivo_no_reclamacion11()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion11))
         {
             $this->historial_reclamacion_motivo_no_reclamacion11 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion11 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion11) . "\"";
   }
   //----- historial_reclamacion_mes12
   function NM_export_historial_reclamacion_mes12()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_mes12))
         {
             $this->historial_reclamacion_mes12 = sc_convert_encoding($this->historial_reclamacion_mes12, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_mes12 =\"" . $this->trata_dados($this->historial_reclamacion_mes12) . "\"";
   }
   //----- historial_reclamacion_reclamo12
   function NM_export_historial_reclamacion_reclamo12()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_reclamo12))
         {
             $this->historial_reclamacion_reclamo12 = sc_convert_encoding($this->historial_reclamacion_reclamo12, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_reclamo12 =\"" . $this->trata_dados($this->historial_reclamacion_reclamo12) . "\"";
   }
   //----- historial_reclamacion_fecha_reclamacion12
   function NM_export_historial_reclamacion_fecha_reclamacion12()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_fecha_reclamacion12))
         {
             $this->historial_reclamacion_fecha_reclamacion12 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion12, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_fecha_reclamacion12 =\"" . $this->trata_dados($this->historial_reclamacion_fecha_reclamacion12) . "\"";
   }
   //----- historial_reclamacion_motivo_no_reclamacion12
   function NM_export_historial_reclamacion_motivo_no_reclamacion12()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion12))
         {
             $this->historial_reclamacion_motivo_no_reclamacion12 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion12, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " historial_reclamacion_motivo_no_reclamacion12 =\"" . $this->trata_dados($this->historial_reclamacion_motivo_no_reclamacion12) . "\"";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Informe Reclamaciones Historial :: XML</TITLE>
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
<form name="Fdown" method="get" action="Informe_reclamacion_historial_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="Informe_reclamacion_historial"> 
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

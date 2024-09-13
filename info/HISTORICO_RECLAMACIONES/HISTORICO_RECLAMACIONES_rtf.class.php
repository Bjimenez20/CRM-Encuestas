<?php

class HISTORICO_RECLAMACIONES_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $texto_tag;
   var $arquivo;
   var $tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function HISTORICO_RECLAMACIONES_rtf()
   {
      $this->nm_data   = new nm_data("es");
      $this->texto_tag = "";
   }

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->arquivo    = "sc_rtf";
      $this->arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->arquivo   .= "_HISTORICO_RECLAMACIONES";
      $this->arquivo   .= ".rtf";
      $this->tit_doc    = "HISTORICO_RECLAMACIONES.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global
             $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['HISTORICO_RECLAMACIONES']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['HISTORICO_RECLAMACIONES']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['HISTORICO_RECLAMACIONES']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->pacientes_id_paciente = $Busca_temp['pacientes_id_paciente']; 
          $tmp_pos = strpos($this->pacientes_id_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_id_paciente = substr($this->pacientes_id_paciente, 0, $tmp_pos);
          }
          $this->pacientes_id_paciente_2 = $Busca_temp['pacientes_id_paciente_input_2']; 
          $this->pacientes_departamento_paciente = $Busca_temp['pacientes_departamento_paciente']; 
          $tmp_pos = strpos($this->pacientes_departamento_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_departamento_paciente = substr($this->pacientes_departamento_paciente, 0, $tmp_pos);
          }
          $this->pacientes_ciudad_paciente = $Busca_temp['pacientes_ciudad_paciente']; 
          $tmp_pos = strpos($this->pacientes_ciudad_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_ciudad_paciente = substr($this->pacientes_ciudad_paciente, 0, $tmp_pos);
          }
          $this->pacientes_estado_paciente = $Busca_temp['pacientes_estado_paciente']; 
          $tmp_pos = strpos($this->pacientes_estado_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_estado_paciente = substr($this->pacientes_estado_paciente, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['rtf_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['rtf_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['rtf_name']);
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
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_8, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_9, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_10, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_11, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_12, tratamiento.PUNTO_ENTREGA as cmp_maior_30_13, gestiones.RECLAMO_GESTION as cmp_maior_30_14, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_15, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_16, historial_reclamacion.ID_HISTORIAL_RECLAMACION as cmp_maior_30_17, historial_reclamacion.ANIO_HISTORIAL_RECLAMACION as cmp_maior_30_18, historial_reclamacion.MES1 as cmp_maior_30_19, historial_reclamacion.RECLAMO1 as cmp_maior_30_20, historial_reclamacion.FECHA_RECLAMACION1 as cmp_maior_30_21, historial_reclamacion.MOTIVO_NO_RECLAMACION1 as cmp_maior_30_22, historial_reclamacion.MES2 as cmp_maior_30_23, historial_reclamacion.RECLAMO2 as cmp_maior_30_24, historial_reclamacion.FECHA_RECLAMACION2 as cmp_maior_30_25, historial_reclamacion.MOTIVO_NO_RECLAMACION2 as cmp_maior_30_26, historial_reclamacion.MES3 as cmp_maior_30_27, historial_reclamacion.RECLAMO3 as cmp_maior_30_28, historial_reclamacion.FECHA_RECLAMACION3 as cmp_maior_30_29, historial_reclamacion.MOTIVO_NO_RECLAMACION3 as cmp_maior_30_30, historial_reclamacion.MES4 as cmp_maior_30_31, historial_reclamacion.RECLAMO4 as cmp_maior_30_32, historial_reclamacion.FECHA_RECLAMACION4 as cmp_maior_30_33, historial_reclamacion.MOTIVO_NO_RECLAMACION4 as cmp_maior_30_34, historial_reclamacion.MES5 as cmp_maior_30_35, historial_reclamacion.RECLAMO5 as cmp_maior_30_36, historial_reclamacion.FECHA_RECLAMACION5 as cmp_maior_30_37, historial_reclamacion.MOTIVO_NO_RECLAMACION5 as cmp_maior_30_38, historial_reclamacion.MES6 as cmp_maior_30_39, historial_reclamacion.RECLAMO6 as cmp_maior_30_40, historial_reclamacion.FECHA_RECLAMACION6 as cmp_maior_30_41, historial_reclamacion.MOTIVO_NO_RECLAMACION6 as cmp_maior_30_42, historial_reclamacion.MES7 as cmp_maior_30_43, historial_reclamacion.RECLAMO7 as cmp_maior_30_44, historial_reclamacion.FECHA_RECLAMACION7 as cmp_maior_30_45, historial_reclamacion.MOTIVO_NO_RECLAMACION7 as cmp_maior_30_46, historial_reclamacion.MES8 as cmp_maior_30_47, historial_reclamacion.RECLAMO8 as cmp_maior_30_48, historial_reclamacion.FECHA_RECLAMACION8 as cmp_maior_30_49, historial_reclamacion.MOTIVO_NO_RECLAMACION8 as cmp_maior_30_50, historial_reclamacion.MES9 as cmp_maior_30_51, historial_reclamacion.RECLAMO9 as cmp_maior_30_52, historial_reclamacion.FECHA_RECLAMACION9 as cmp_maior_30_53, historial_reclamacion.MOTIVO_NO_RECLAMACION9 as cmp_maior_30_54, historial_reclamacion.MES10 as cmp_maior_30_55, historial_reclamacion.RECLAMO10 as cmp_maior_30_56, historial_reclamacion.FECHA_RECLAMACION10 as cmp_maior_30_57, historial_reclamacion.MOTIVO_NO_RECLAMACION10 as cmp_maior_30_58, historial_reclamacion.MES11 as cmp_maior_30_59, historial_reclamacion.RECLAMO11 as cmp_maior_30_60, historial_reclamacion.FECHA_RECLAMACION11 as cmp_maior_30_61, historial_reclamacion.MOTIVO_NO_RECLAMACION11 as cmp_maior_30_62, historial_reclamacion.MES12 as cmp_maior_30_63, historial_reclamacion.RECLAMO12 as cmp_maior_30_64, historial_reclamacion.FECHA_RECLAMACION12 as cmp_maior_30_65, historial_reclamacion.MOTIVO_NO_RECLAMACION12 as cmp_maior_30_66 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_8, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_9, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_10, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_11, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_12, tratamiento.PUNTO_ENTREGA as cmp_maior_30_13, gestiones.RECLAMO_GESTION as cmp_maior_30_14, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_15, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_16, historial_reclamacion.ID_HISTORIAL_RECLAMACION as cmp_maior_30_17, historial_reclamacion.ANIO_HISTORIAL_RECLAMACION as cmp_maior_30_18, historial_reclamacion.MES1 as cmp_maior_30_19, historial_reclamacion.RECLAMO1 as cmp_maior_30_20, historial_reclamacion.FECHA_RECLAMACION1 as cmp_maior_30_21, historial_reclamacion.MOTIVO_NO_RECLAMACION1 as cmp_maior_30_22, historial_reclamacion.MES2 as cmp_maior_30_23, historial_reclamacion.RECLAMO2 as cmp_maior_30_24, historial_reclamacion.FECHA_RECLAMACION2 as cmp_maior_30_25, historial_reclamacion.MOTIVO_NO_RECLAMACION2 as cmp_maior_30_26, historial_reclamacion.MES3 as cmp_maior_30_27, historial_reclamacion.RECLAMO3 as cmp_maior_30_28, historial_reclamacion.FECHA_RECLAMACION3 as cmp_maior_30_29, historial_reclamacion.MOTIVO_NO_RECLAMACION3 as cmp_maior_30_30, historial_reclamacion.MES4 as cmp_maior_30_31, historial_reclamacion.RECLAMO4 as cmp_maior_30_32, historial_reclamacion.FECHA_RECLAMACION4 as cmp_maior_30_33, historial_reclamacion.MOTIVO_NO_RECLAMACION4 as cmp_maior_30_34, historial_reclamacion.MES5 as cmp_maior_30_35, historial_reclamacion.RECLAMO5 as cmp_maior_30_36, historial_reclamacion.FECHA_RECLAMACION5 as cmp_maior_30_37, historial_reclamacion.MOTIVO_NO_RECLAMACION5 as cmp_maior_30_38, historial_reclamacion.MES6 as cmp_maior_30_39, historial_reclamacion.RECLAMO6 as cmp_maior_30_40, historial_reclamacion.FECHA_RECLAMACION6 as cmp_maior_30_41, historial_reclamacion.MOTIVO_NO_RECLAMACION6 as cmp_maior_30_42, historial_reclamacion.MES7 as cmp_maior_30_43, historial_reclamacion.RECLAMO7 as cmp_maior_30_44, historial_reclamacion.FECHA_RECLAMACION7 as cmp_maior_30_45, historial_reclamacion.MOTIVO_NO_RECLAMACION7 as cmp_maior_30_46, historial_reclamacion.MES8 as cmp_maior_30_47, historial_reclamacion.RECLAMO8 as cmp_maior_30_48, historial_reclamacion.FECHA_RECLAMACION8 as cmp_maior_30_49, historial_reclamacion.MOTIVO_NO_RECLAMACION8 as cmp_maior_30_50, historial_reclamacion.MES9 as cmp_maior_30_51, historial_reclamacion.RECLAMO9 as cmp_maior_30_52, historial_reclamacion.FECHA_RECLAMACION9 as cmp_maior_30_53, historial_reclamacion.MOTIVO_NO_RECLAMACION9 as cmp_maior_30_54, historial_reclamacion.MES10 as cmp_maior_30_55, historial_reclamacion.RECLAMO10 as cmp_maior_30_56, historial_reclamacion.FECHA_RECLAMACION10 as cmp_maior_30_57, historial_reclamacion.MOTIVO_NO_RECLAMACION10 as cmp_maior_30_58, historial_reclamacion.MES11 as cmp_maior_30_59, historial_reclamacion.RECLAMO11 as cmp_maior_30_60, historial_reclamacion.FECHA_RECLAMACION11 as cmp_maior_30_61, historial_reclamacion.MOTIVO_NO_RECLAMACION11 as cmp_maior_30_62, historial_reclamacion.MES12 as cmp_maior_30_63, historial_reclamacion.RECLAMO12 as cmp_maior_30_64, historial_reclamacion.FECHA_RECLAMACION12 as cmp_maior_30_65, historial_reclamacion.MOTIVO_NO_RECLAMACION12 as cmp_maior_30_66 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_1, gestiones.FECHA_COMUNICACION as cmp_maior_30_2, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_3, pacientes.CIUDAD_PACIENTE as cmp_maior_30_4, pacientes.ESTADO_PACIENTE as cmp_maior_30_5, pacientes.STATUS_PACIENTE as cmp_maior_30_6, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_7, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_8, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_9, tratamiento.DOSIS_TRATAMIENTO as cmp_maior_30_10, gestiones.NUMERO_CAJAS as gestiones_numero_cajas, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_11, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_12, tratamiento.PUNTO_ENTREGA as cmp_maior_30_13, gestiones.RECLAMO_GESTION as cmp_maior_30_14, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_15, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_16, historial_reclamacion.ID_HISTORIAL_RECLAMACION as cmp_maior_30_17, historial_reclamacion.ANIO_HISTORIAL_RECLAMACION as cmp_maior_30_18, historial_reclamacion.MES1 as cmp_maior_30_19, historial_reclamacion.RECLAMO1 as cmp_maior_30_20, historial_reclamacion.FECHA_RECLAMACION1 as cmp_maior_30_21, historial_reclamacion.MOTIVO_NO_RECLAMACION1 as cmp_maior_30_22, historial_reclamacion.MES2 as cmp_maior_30_23, historial_reclamacion.RECLAMO2 as cmp_maior_30_24, historial_reclamacion.FECHA_RECLAMACION2 as cmp_maior_30_25, historial_reclamacion.MOTIVO_NO_RECLAMACION2 as cmp_maior_30_26, historial_reclamacion.MES3 as cmp_maior_30_27, historial_reclamacion.RECLAMO3 as cmp_maior_30_28, historial_reclamacion.FECHA_RECLAMACION3 as cmp_maior_30_29, historial_reclamacion.MOTIVO_NO_RECLAMACION3 as cmp_maior_30_30, historial_reclamacion.MES4 as cmp_maior_30_31, historial_reclamacion.RECLAMO4 as cmp_maior_30_32, historial_reclamacion.FECHA_RECLAMACION4 as cmp_maior_30_33, historial_reclamacion.MOTIVO_NO_RECLAMACION4 as cmp_maior_30_34, historial_reclamacion.MES5 as cmp_maior_30_35, historial_reclamacion.RECLAMO5 as cmp_maior_30_36, historial_reclamacion.FECHA_RECLAMACION5 as cmp_maior_30_37, historial_reclamacion.MOTIVO_NO_RECLAMACION5 as cmp_maior_30_38, historial_reclamacion.MES6 as cmp_maior_30_39, historial_reclamacion.RECLAMO6 as cmp_maior_30_40, historial_reclamacion.FECHA_RECLAMACION6 as cmp_maior_30_41, historial_reclamacion.MOTIVO_NO_RECLAMACION6 as cmp_maior_30_42, historial_reclamacion.MES7 as cmp_maior_30_43, historial_reclamacion.RECLAMO7 as cmp_maior_30_44, historial_reclamacion.FECHA_RECLAMACION7 as cmp_maior_30_45, historial_reclamacion.MOTIVO_NO_RECLAMACION7 as cmp_maior_30_46, historial_reclamacion.MES8 as cmp_maior_30_47, historial_reclamacion.RECLAMO8 as cmp_maior_30_48, historial_reclamacion.FECHA_RECLAMACION8 as cmp_maior_30_49, historial_reclamacion.MOTIVO_NO_RECLAMACION8 as cmp_maior_30_50, historial_reclamacion.MES9 as cmp_maior_30_51, historial_reclamacion.RECLAMO9 as cmp_maior_30_52, historial_reclamacion.FECHA_RECLAMACION9 as cmp_maior_30_53, historial_reclamacion.MOTIVO_NO_RECLAMACION9 as cmp_maior_30_54, historial_reclamacion.MES10 as cmp_maior_30_55, historial_reclamacion.RECLAMO10 as cmp_maior_30_56, historial_reclamacion.FECHA_RECLAMACION10 as cmp_maior_30_57, historial_reclamacion.MOTIVO_NO_RECLAMACION10 as cmp_maior_30_58, historial_reclamacion.MES11 as cmp_maior_30_59, historial_reclamacion.RECLAMO11 as cmp_maior_30_60, historial_reclamacion.FECHA_RECLAMACION11 as cmp_maior_30_61, historial_reclamacion.MOTIVO_NO_RECLAMACION11 as cmp_maior_30_62, historial_reclamacion.MES12 as cmp_maior_30_63, historial_reclamacion.RECLAMO12 as cmp_maior_30_64, historial_reclamacion.FECHA_RECLAMACION12 as cmp_maior_30_65, historial_reclamacion.MOTIVO_NO_RECLAMACION12 as cmp_maior_30_66 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      $this->texto_tag .= "<table>\r\n";
      $this->texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['pacientes_id_paciente'])) ? $this->New_label['pacientes_id_paciente'] : "ID PACIENTE"; 
          if ($Cada_col == "pacientes_id_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['gestiones_logro_comunicacion_gestion'])) ? $this->New_label['gestiones_logro_comunicacion_gestion'] : "LOGRO COMUNICACION GESTION"; 
          if ($Cada_col == "gestiones_logro_comunicacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['gestiones_fecha_comunicacion'])) ? $this->New_label['gestiones_fecha_comunicacion'] : "FECHA COMUNICACION"; 
          if ($Cada_col == "gestiones_fecha_comunicacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['gestiones_autor_gestion'])) ? $this->New_label['gestiones_autor_gestion'] : "AUTOR GESTION"; 
          if ($Cada_col == "gestiones_autor_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_departamento_paciente'])) ? $this->New_label['pacientes_departamento_paciente'] : "DEPARTAMENTO PACIENTE"; 
          if ($Cada_col == "pacientes_departamento_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_ciudad_paciente'])) ? $this->New_label['pacientes_ciudad_paciente'] : "CIUDAD PACIENTE"; 
          if ($Cada_col == "pacientes_ciudad_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_estado_paciente'])) ? $this->New_label['pacientes_estado_paciente'] : "ESTADO PACIENTE"; 
          if ($Cada_col == "pacientes_estado_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_status_paciente'])) ? $this->New_label['pacientes_status_paciente'] : "STATUS PACIENTE"; 
          if ($Cada_col == "pacientes_status_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_fecha_activacion_paciente'])) ? $this->New_label['pacientes_fecha_activacion_paciente'] : "FECHA ACTIVACION PACIENTE"; 
          if ($Cada_col == "pacientes_fecha_activacion_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_codigo_xofigo'])) ? $this->New_label['pacientes_codigo_xofigo'] : "CODIGO XOFIGO"; 
          if ($Cada_col == "pacientes_codigo_xofigo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_producto_tratamiento'])) ? $this->New_label['tratamiento_producto_tratamiento'] : "PRODUCTO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_producto_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_nombre_referencia'])) ? $this->New_label['tratamiento_nombre_referencia'] : "NOMBRE REFERENCIA"; 
          if ($Cada_col == "tratamiento_nombre_referencia" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_dosis_tratamiento'])) ? $this->New_label['tratamiento_dosis_tratamiento'] : "DOSIS TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_dosis_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['gestiones_numero_cajas'])) ? $this->New_label['gestiones_numero_cajas'] : "NUMERO CAJAS"; 
          if ($Cada_col == "gestiones_numero_cajas" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_asegurador_tratamiento'])) ? $this->New_label['tratamiento_asegurador_tratamiento'] : "ASEGURADOR TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_asegurador_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_operador_logistico_tratamiento'])) ? $this->New_label['tratamiento_operador_logistico_tratamiento'] : "OPERADOR LOGISTICO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_operador_logistico_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_punto_entrega'])) ? $this->New_label['tratamiento_punto_entrega'] : "PUNTO ENTREGA"; 
          if ($Cada_col == "tratamiento_punto_entrega" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['gestiones_reclamo_gestion'])) ? $this->New_label['gestiones_reclamo_gestion'] : "RECLAMO GESTION"; 
          if ($Cada_col == "gestiones_reclamo_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['gestiones_fecha_reclamacion_gestion'])) ? $this->New_label['gestiones_fecha_reclamacion_gestion'] : "FECHA RECLAMACION GESTION"; 
          if ($Cada_col == "gestiones_fecha_reclamacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['gestiones_causa_no_reclamacion_gestion'])) ? $this->New_label['gestiones_causa_no_reclamacion_gestion'] : "CAUSA NO RECLAMACION GESTION"; 
          if ($Cada_col == "gestiones_causa_no_reclamacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_id_historial_reclamacion'])) ? $this->New_label['historial_reclamacion_id_historial_reclamacion'] : "ID HISTORIAL RECLAMACION"; 
          if ($Cada_col == "historial_reclamacion_id_historial_reclamacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_anio_historial_reclamacion'])) ? $this->New_label['historial_reclamacion_anio_historial_reclamacion'] : "ANIO HISTORIAL RECLAMACION"; 
          if ($Cada_col == "historial_reclamacion_anio_historial_reclamacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes1'])) ? $this->New_label['historial_reclamacion_mes1'] : "MES1"; 
          if ($Cada_col == "historial_reclamacion_mes1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo1'])) ? $this->New_label['historial_reclamacion_reclamo1'] : "RECLAMO1"; 
          if ($Cada_col == "historial_reclamacion_reclamo1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion1'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion1'] : "FECHA RECLAMACION1"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion1'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion1'] : "MOTIVO NO RECLAMACION1"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes2'])) ? $this->New_label['historial_reclamacion_mes2'] : "MES2"; 
          if ($Cada_col == "historial_reclamacion_mes2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo2'])) ? $this->New_label['historial_reclamacion_reclamo2'] : "RECLAMO2"; 
          if ($Cada_col == "historial_reclamacion_reclamo2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion2'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion2'] : "FECHA RECLAMACION2"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion2'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion2'] : "MOTIVO NO RECLAMACION2"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes3'])) ? $this->New_label['historial_reclamacion_mes3'] : "MES3"; 
          if ($Cada_col == "historial_reclamacion_mes3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo3'])) ? $this->New_label['historial_reclamacion_reclamo3'] : "RECLAMO3"; 
          if ($Cada_col == "historial_reclamacion_reclamo3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion3'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion3'] : "FECHA RECLAMACION3"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion3'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion3'] : "MOTIVO NO RECLAMACION3"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes4'])) ? $this->New_label['historial_reclamacion_mes4'] : "MES4"; 
          if ($Cada_col == "historial_reclamacion_mes4" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo4'])) ? $this->New_label['historial_reclamacion_reclamo4'] : "RECLAMO4"; 
          if ($Cada_col == "historial_reclamacion_reclamo4" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion4'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion4'] : "FECHA RECLAMACION4"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion4" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion4'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion4'] : "MOTIVO NO RECLAMACION4"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion4" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes5'])) ? $this->New_label['historial_reclamacion_mes5'] : "MES5"; 
          if ($Cada_col == "historial_reclamacion_mes5" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo5'])) ? $this->New_label['historial_reclamacion_reclamo5'] : "RECLAMO5"; 
          if ($Cada_col == "historial_reclamacion_reclamo5" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion5'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion5'] : "FECHA RECLAMACION5"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion5" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion5'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion5'] : "MOTIVO NO RECLAMACION5"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion5" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes6'])) ? $this->New_label['historial_reclamacion_mes6'] : "MES6"; 
          if ($Cada_col == "historial_reclamacion_mes6" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo6'])) ? $this->New_label['historial_reclamacion_reclamo6'] : "RECLAMO6"; 
          if ($Cada_col == "historial_reclamacion_reclamo6" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion6'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion6'] : "FECHA RECLAMACION6"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion6" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion6'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion6'] : "MOTIVO NO RECLAMACION6"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion6" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes7'])) ? $this->New_label['historial_reclamacion_mes7'] : "MES7"; 
          if ($Cada_col == "historial_reclamacion_mes7" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo7'])) ? $this->New_label['historial_reclamacion_reclamo7'] : "RECLAMO7"; 
          if ($Cada_col == "historial_reclamacion_reclamo7" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion7'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion7'] : "FECHA RECLAMACION7"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion7" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion7'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion7'] : "MOTIVO NO RECLAMACION7"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion7" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes8'])) ? $this->New_label['historial_reclamacion_mes8'] : "MES8"; 
          if ($Cada_col == "historial_reclamacion_mes8" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo8'])) ? $this->New_label['historial_reclamacion_reclamo8'] : "RECLAMO8"; 
          if ($Cada_col == "historial_reclamacion_reclamo8" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion8'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion8'] : "FECHA RECLAMACION8"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion8" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion8'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion8'] : "MOTIVO NO RECLAMACION8"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion8" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes9'])) ? $this->New_label['historial_reclamacion_mes9'] : "MES9"; 
          if ($Cada_col == "historial_reclamacion_mes9" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo9'])) ? $this->New_label['historial_reclamacion_reclamo9'] : "RECLAMO9"; 
          if ($Cada_col == "historial_reclamacion_reclamo9" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion9'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion9'] : "FECHA RECLAMACION9"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion9" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion9'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion9'] : "MOTIVO NO RECLAMACION9"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion9" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes10'])) ? $this->New_label['historial_reclamacion_mes10'] : "MES10"; 
          if ($Cada_col == "historial_reclamacion_mes10" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo10'])) ? $this->New_label['historial_reclamacion_reclamo10'] : "RECLAMO10"; 
          if ($Cada_col == "historial_reclamacion_reclamo10" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion10'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion10'] : "FECHA RECLAMACION10"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion10" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion10'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion10'] : "MOTIVO NO RECLAMACION10"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion10" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes11'])) ? $this->New_label['historial_reclamacion_mes11'] : "MES11"; 
          if ($Cada_col == "historial_reclamacion_mes11" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo11'])) ? $this->New_label['historial_reclamacion_reclamo11'] : "RECLAMO11"; 
          if ($Cada_col == "historial_reclamacion_reclamo11" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion11'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion11'] : "FECHA RECLAMACION11"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion11" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion11'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion11'] : "MOTIVO NO RECLAMACION11"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion11" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_mes12'])) ? $this->New_label['historial_reclamacion_mes12'] : "MES12"; 
          if ($Cada_col == "historial_reclamacion_mes12" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo12'])) ? $this->New_label['historial_reclamacion_reclamo12'] : "RECLAMO12"; 
          if ($Cada_col == "historial_reclamacion_reclamo12" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion12'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion12'] : "FECHA RECLAMACION12"; 
          if ($Cada_col == "historial_reclamacion_fecha_reclamacion12" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion12'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion12'] : "MOTIVO NO RECLAMACION12"; 
          if ($Cada_col == "historial_reclamacion_motivo_no_reclamacion12" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->texto_tag .= "</tr>\r\n";
      while (!$rs->EOF)
      {
         $this->texto_tag .= "<tr>\r\n";
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
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->texto_tag .= "</table>\r\n";

      $rs->Close();
   }
   //----- pacientes_id_paciente
   function NM_export_pacientes_id_paciente()
   {
         nmgp_Form_Num_Val($this->pacientes_id_paciente, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->pacientes_id_paciente))
         {
             $this->pacientes_id_paciente = sc_convert_encoding($this->pacientes_id_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_id_paciente = str_replace('<', '&lt;', $this->pacientes_id_paciente);
         $this->pacientes_id_paciente = str_replace('>', '&gt;', $this->pacientes_id_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_id_paciente . "</td>\r\n";
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
         $this->gestiones_logro_comunicacion_gestion = str_replace('<', '&lt;', $this->gestiones_logro_comunicacion_gestion);
         $this->gestiones_logro_comunicacion_gestion = str_replace('>', '&gt;', $this->gestiones_logro_comunicacion_gestion);
         $this->texto_tag .= "<td>" . $this->gestiones_logro_comunicacion_gestion . "</td>\r\n";
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
         $this->gestiones_fecha_comunicacion = str_replace('<', '&lt;', $this->gestiones_fecha_comunicacion);
         $this->gestiones_fecha_comunicacion = str_replace('>', '&gt;', $this->gestiones_fecha_comunicacion);
         $this->texto_tag .= "<td>" . $this->gestiones_fecha_comunicacion . "</td>\r\n";
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
         $this->gestiones_autor_gestion = str_replace('<', '&lt;', $this->gestiones_autor_gestion);
         $this->gestiones_autor_gestion = str_replace('>', '&gt;', $this->gestiones_autor_gestion);
         $this->texto_tag .= "<td>" . $this->gestiones_autor_gestion . "</td>\r\n";
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
         $this->pacientes_departamento_paciente = str_replace('<', '&lt;', $this->pacientes_departamento_paciente);
         $this->pacientes_departamento_paciente = str_replace('>', '&gt;', $this->pacientes_departamento_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_departamento_paciente . "</td>\r\n";
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
         $this->pacientes_ciudad_paciente = str_replace('<', '&lt;', $this->pacientes_ciudad_paciente);
         $this->pacientes_ciudad_paciente = str_replace('>', '&gt;', $this->pacientes_ciudad_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_ciudad_paciente . "</td>\r\n";
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
         $this->pacientes_estado_paciente = str_replace('<', '&lt;', $this->pacientes_estado_paciente);
         $this->pacientes_estado_paciente = str_replace('>', '&gt;', $this->pacientes_estado_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_estado_paciente . "</td>\r\n";
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
         $this->pacientes_status_paciente = str_replace('<', '&lt;', $this->pacientes_status_paciente);
         $this->pacientes_status_paciente = str_replace('>', '&gt;', $this->pacientes_status_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_status_paciente . "</td>\r\n";
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
         $this->pacientes_fecha_activacion_paciente = str_replace('<', '&lt;', $this->pacientes_fecha_activacion_paciente);
         $this->pacientes_fecha_activacion_paciente = str_replace('>', '&gt;', $this->pacientes_fecha_activacion_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_fecha_activacion_paciente . "</td>\r\n";
   }
   //----- pacientes_codigo_xofigo
   function NM_export_pacientes_codigo_xofigo()
   {
         nmgp_Form_Num_Val($this->pacientes_codigo_xofigo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->pacientes_codigo_xofigo))
         {
             $this->pacientes_codigo_xofigo = sc_convert_encoding($this->pacientes_codigo_xofigo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_codigo_xofigo = str_replace('<', '&lt;', $this->pacientes_codigo_xofigo);
         $this->pacientes_codigo_xofigo = str_replace('>', '&gt;', $this->pacientes_codigo_xofigo);
         $this->texto_tag .= "<td>" . $this->pacientes_codigo_xofigo . "</td>\r\n";
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
         $this->tratamiento_producto_tratamiento = str_replace('<', '&lt;', $this->tratamiento_producto_tratamiento);
         $this->tratamiento_producto_tratamiento = str_replace('>', '&gt;', $this->tratamiento_producto_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_producto_tratamiento . "</td>\r\n";
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
         $this->tratamiento_nombre_referencia = str_replace('<', '&lt;', $this->tratamiento_nombre_referencia);
         $this->tratamiento_nombre_referencia = str_replace('>', '&gt;', $this->tratamiento_nombre_referencia);
         $this->texto_tag .= "<td>" . $this->tratamiento_nombre_referencia . "</td>\r\n";
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
         $this->tratamiento_dosis_tratamiento = str_replace('<', '&lt;', $this->tratamiento_dosis_tratamiento);
         $this->tratamiento_dosis_tratamiento = str_replace('>', '&gt;', $this->tratamiento_dosis_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_dosis_tratamiento . "</td>\r\n";
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
         $this->gestiones_numero_cajas = str_replace('<', '&lt;', $this->gestiones_numero_cajas);
         $this->gestiones_numero_cajas = str_replace('>', '&gt;', $this->gestiones_numero_cajas);
         $this->texto_tag .= "<td>" . $this->gestiones_numero_cajas . "</td>\r\n";
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
         $this->tratamiento_asegurador_tratamiento = str_replace('<', '&lt;', $this->tratamiento_asegurador_tratamiento);
         $this->tratamiento_asegurador_tratamiento = str_replace('>', '&gt;', $this->tratamiento_asegurador_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_asegurador_tratamiento . "</td>\r\n";
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
         $this->tratamiento_operador_logistico_tratamiento = str_replace('<', '&lt;', $this->tratamiento_operador_logistico_tratamiento);
         $this->tratamiento_operador_logistico_tratamiento = str_replace('>', '&gt;', $this->tratamiento_operador_logistico_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_operador_logistico_tratamiento . "</td>\r\n";
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
         $this->tratamiento_punto_entrega = str_replace('<', '&lt;', $this->tratamiento_punto_entrega);
         $this->tratamiento_punto_entrega = str_replace('>', '&gt;', $this->tratamiento_punto_entrega);
         $this->texto_tag .= "<td>" . $this->tratamiento_punto_entrega . "</td>\r\n";
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
         $this->gestiones_reclamo_gestion = str_replace('<', '&lt;', $this->gestiones_reclamo_gestion);
         $this->gestiones_reclamo_gestion = str_replace('>', '&gt;', $this->gestiones_reclamo_gestion);
         $this->texto_tag .= "<td>" . $this->gestiones_reclamo_gestion . "</td>\r\n";
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
         $this->gestiones_fecha_reclamacion_gestion = str_replace('<', '&lt;', $this->gestiones_fecha_reclamacion_gestion);
         $this->gestiones_fecha_reclamacion_gestion = str_replace('>', '&gt;', $this->gestiones_fecha_reclamacion_gestion);
         $this->texto_tag .= "<td>" . $this->gestiones_fecha_reclamacion_gestion . "</td>\r\n";
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
         $this->gestiones_causa_no_reclamacion_gestion = str_replace('<', '&lt;', $this->gestiones_causa_no_reclamacion_gestion);
         $this->gestiones_causa_no_reclamacion_gestion = str_replace('>', '&gt;', $this->gestiones_causa_no_reclamacion_gestion);
         $this->texto_tag .= "<td>" . $this->gestiones_causa_no_reclamacion_gestion . "</td>\r\n";
   }
   //----- historial_reclamacion_id_historial_reclamacion
   function NM_export_historial_reclamacion_id_historial_reclamacion()
   {
         nmgp_Form_Num_Val($this->historial_reclamacion_id_historial_reclamacion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->historial_reclamacion_id_historial_reclamacion))
         {
             $this->historial_reclamacion_id_historial_reclamacion = sc_convert_encoding($this->historial_reclamacion_id_historial_reclamacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_id_historial_reclamacion = str_replace('<', '&lt;', $this->historial_reclamacion_id_historial_reclamacion);
         $this->historial_reclamacion_id_historial_reclamacion = str_replace('>', '&gt;', $this->historial_reclamacion_id_historial_reclamacion);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_id_historial_reclamacion . "</td>\r\n";
   }
   //----- historial_reclamacion_anio_historial_reclamacion
   function NM_export_historial_reclamacion_anio_historial_reclamacion()
   {
         nmgp_Form_Num_Val($this->historial_reclamacion_anio_historial_reclamacion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->historial_reclamacion_anio_historial_reclamacion))
         {
             $this->historial_reclamacion_anio_historial_reclamacion = sc_convert_encoding($this->historial_reclamacion_anio_historial_reclamacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_anio_historial_reclamacion = str_replace('<', '&lt;', $this->historial_reclamacion_anio_historial_reclamacion);
         $this->historial_reclamacion_anio_historial_reclamacion = str_replace('>', '&gt;', $this->historial_reclamacion_anio_historial_reclamacion);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_anio_historial_reclamacion . "</td>\r\n";
   }
   //----- historial_reclamacion_mes1
   function NM_export_historial_reclamacion_mes1()
   {
         $this->historial_reclamacion_mes1 = html_entity_decode($this->historial_reclamacion_mes1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes1 = strip_tags($this->historial_reclamacion_mes1);
         if (!NM_is_utf8($this->historial_reclamacion_mes1))
         {
             $this->historial_reclamacion_mes1 = sc_convert_encoding($this->historial_reclamacion_mes1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes1 = str_replace('<', '&lt;', $this->historial_reclamacion_mes1);
         $this->historial_reclamacion_mes1 = str_replace('>', '&gt;', $this->historial_reclamacion_mes1);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes1 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo1
   function NM_export_historial_reclamacion_reclamo1()
   {
         $this->historial_reclamacion_reclamo1 = html_entity_decode($this->historial_reclamacion_reclamo1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo1 = strip_tags($this->historial_reclamacion_reclamo1);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo1))
         {
             $this->historial_reclamacion_reclamo1 = sc_convert_encoding($this->historial_reclamacion_reclamo1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo1 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo1);
         $this->historial_reclamacion_reclamo1 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo1);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo1 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion1
   function NM_export_historial_reclamacion_fecha_reclamacion1()
   {
         $this->historial_reclamacion_fecha_reclamacion1 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion1 = strip_tags($this->historial_reclamacion_fecha_reclamacion1);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion1))
         {
             $this->historial_reclamacion_fecha_reclamacion1 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion1 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion1);
         $this->historial_reclamacion_fecha_reclamacion1 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion1);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion1 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion1
   function NM_export_historial_reclamacion_motivo_no_reclamacion1()
   {
         $this->historial_reclamacion_motivo_no_reclamacion1 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion1 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion1);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion1))
         {
             $this->historial_reclamacion_motivo_no_reclamacion1 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion1 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion1);
         $this->historial_reclamacion_motivo_no_reclamacion1 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion1);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion1 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes2
   function NM_export_historial_reclamacion_mes2()
   {
         $this->historial_reclamacion_mes2 = html_entity_decode($this->historial_reclamacion_mes2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes2 = strip_tags($this->historial_reclamacion_mes2);
         if (!NM_is_utf8($this->historial_reclamacion_mes2))
         {
             $this->historial_reclamacion_mes2 = sc_convert_encoding($this->historial_reclamacion_mes2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes2 = str_replace('<', '&lt;', $this->historial_reclamacion_mes2);
         $this->historial_reclamacion_mes2 = str_replace('>', '&gt;', $this->historial_reclamacion_mes2);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes2 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo2
   function NM_export_historial_reclamacion_reclamo2()
   {
         $this->historial_reclamacion_reclamo2 = html_entity_decode($this->historial_reclamacion_reclamo2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo2 = strip_tags($this->historial_reclamacion_reclamo2);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo2))
         {
             $this->historial_reclamacion_reclamo2 = sc_convert_encoding($this->historial_reclamacion_reclamo2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo2 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo2);
         $this->historial_reclamacion_reclamo2 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo2);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo2 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion2
   function NM_export_historial_reclamacion_fecha_reclamacion2()
   {
         $this->historial_reclamacion_fecha_reclamacion2 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion2 = strip_tags($this->historial_reclamacion_fecha_reclamacion2);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion2))
         {
             $this->historial_reclamacion_fecha_reclamacion2 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion2 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion2);
         $this->historial_reclamacion_fecha_reclamacion2 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion2);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion2 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion2
   function NM_export_historial_reclamacion_motivo_no_reclamacion2()
   {
         $this->historial_reclamacion_motivo_no_reclamacion2 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion2 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion2);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion2))
         {
             $this->historial_reclamacion_motivo_no_reclamacion2 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion2 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion2);
         $this->historial_reclamacion_motivo_no_reclamacion2 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion2);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion2 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes3
   function NM_export_historial_reclamacion_mes3()
   {
         $this->historial_reclamacion_mes3 = html_entity_decode($this->historial_reclamacion_mes3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes3 = strip_tags($this->historial_reclamacion_mes3);
         if (!NM_is_utf8($this->historial_reclamacion_mes3))
         {
             $this->historial_reclamacion_mes3 = sc_convert_encoding($this->historial_reclamacion_mes3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes3 = str_replace('<', '&lt;', $this->historial_reclamacion_mes3);
         $this->historial_reclamacion_mes3 = str_replace('>', '&gt;', $this->historial_reclamacion_mes3);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes3 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo3
   function NM_export_historial_reclamacion_reclamo3()
   {
         $this->historial_reclamacion_reclamo3 = html_entity_decode($this->historial_reclamacion_reclamo3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo3 = strip_tags($this->historial_reclamacion_reclamo3);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo3))
         {
             $this->historial_reclamacion_reclamo3 = sc_convert_encoding($this->historial_reclamacion_reclamo3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo3 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo3);
         $this->historial_reclamacion_reclamo3 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo3);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo3 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion3
   function NM_export_historial_reclamacion_fecha_reclamacion3()
   {
         $this->historial_reclamacion_fecha_reclamacion3 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion3 = strip_tags($this->historial_reclamacion_fecha_reclamacion3);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion3))
         {
             $this->historial_reclamacion_fecha_reclamacion3 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion3 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion3);
         $this->historial_reclamacion_fecha_reclamacion3 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion3);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion3 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion3
   function NM_export_historial_reclamacion_motivo_no_reclamacion3()
   {
         $this->historial_reclamacion_motivo_no_reclamacion3 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion3 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion3);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion3))
         {
             $this->historial_reclamacion_motivo_no_reclamacion3 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion3 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion3);
         $this->historial_reclamacion_motivo_no_reclamacion3 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion3);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion3 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes4
   function NM_export_historial_reclamacion_mes4()
   {
         $this->historial_reclamacion_mes4 = html_entity_decode($this->historial_reclamacion_mes4, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes4 = strip_tags($this->historial_reclamacion_mes4);
         if (!NM_is_utf8($this->historial_reclamacion_mes4))
         {
             $this->historial_reclamacion_mes4 = sc_convert_encoding($this->historial_reclamacion_mes4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes4 = str_replace('<', '&lt;', $this->historial_reclamacion_mes4);
         $this->historial_reclamacion_mes4 = str_replace('>', '&gt;', $this->historial_reclamacion_mes4);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes4 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo4
   function NM_export_historial_reclamacion_reclamo4()
   {
         $this->historial_reclamacion_reclamo4 = html_entity_decode($this->historial_reclamacion_reclamo4, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo4 = strip_tags($this->historial_reclamacion_reclamo4);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo4))
         {
             $this->historial_reclamacion_reclamo4 = sc_convert_encoding($this->historial_reclamacion_reclamo4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo4 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo4);
         $this->historial_reclamacion_reclamo4 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo4);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo4 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion4
   function NM_export_historial_reclamacion_fecha_reclamacion4()
   {
         $this->historial_reclamacion_fecha_reclamacion4 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion4, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion4 = strip_tags($this->historial_reclamacion_fecha_reclamacion4);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion4))
         {
             $this->historial_reclamacion_fecha_reclamacion4 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion4 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion4);
         $this->historial_reclamacion_fecha_reclamacion4 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion4);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion4 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion4
   function NM_export_historial_reclamacion_motivo_no_reclamacion4()
   {
         $this->historial_reclamacion_motivo_no_reclamacion4 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion4, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion4 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion4);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion4))
         {
             $this->historial_reclamacion_motivo_no_reclamacion4 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion4 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion4);
         $this->historial_reclamacion_motivo_no_reclamacion4 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion4);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion4 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes5
   function NM_export_historial_reclamacion_mes5()
   {
         $this->historial_reclamacion_mes5 = html_entity_decode($this->historial_reclamacion_mes5, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes5 = strip_tags($this->historial_reclamacion_mes5);
         if (!NM_is_utf8($this->historial_reclamacion_mes5))
         {
             $this->historial_reclamacion_mes5 = sc_convert_encoding($this->historial_reclamacion_mes5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes5 = str_replace('<', '&lt;', $this->historial_reclamacion_mes5);
         $this->historial_reclamacion_mes5 = str_replace('>', '&gt;', $this->historial_reclamacion_mes5);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes5 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo5
   function NM_export_historial_reclamacion_reclamo5()
   {
         $this->historial_reclamacion_reclamo5 = html_entity_decode($this->historial_reclamacion_reclamo5, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo5 = strip_tags($this->historial_reclamacion_reclamo5);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo5))
         {
             $this->historial_reclamacion_reclamo5 = sc_convert_encoding($this->historial_reclamacion_reclamo5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo5 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo5);
         $this->historial_reclamacion_reclamo5 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo5);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo5 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion5
   function NM_export_historial_reclamacion_fecha_reclamacion5()
   {
         $this->historial_reclamacion_fecha_reclamacion5 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion5, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion5 = strip_tags($this->historial_reclamacion_fecha_reclamacion5);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion5))
         {
             $this->historial_reclamacion_fecha_reclamacion5 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion5 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion5);
         $this->historial_reclamacion_fecha_reclamacion5 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion5);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion5 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion5
   function NM_export_historial_reclamacion_motivo_no_reclamacion5()
   {
         $this->historial_reclamacion_motivo_no_reclamacion5 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion5, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion5 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion5);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion5))
         {
             $this->historial_reclamacion_motivo_no_reclamacion5 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion5 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion5);
         $this->historial_reclamacion_motivo_no_reclamacion5 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion5);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion5 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes6
   function NM_export_historial_reclamacion_mes6()
   {
         $this->historial_reclamacion_mes6 = html_entity_decode($this->historial_reclamacion_mes6, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes6 = strip_tags($this->historial_reclamacion_mes6);
         if (!NM_is_utf8($this->historial_reclamacion_mes6))
         {
             $this->historial_reclamacion_mes6 = sc_convert_encoding($this->historial_reclamacion_mes6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes6 = str_replace('<', '&lt;', $this->historial_reclamacion_mes6);
         $this->historial_reclamacion_mes6 = str_replace('>', '&gt;', $this->historial_reclamacion_mes6);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes6 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo6
   function NM_export_historial_reclamacion_reclamo6()
   {
         $this->historial_reclamacion_reclamo6 = html_entity_decode($this->historial_reclamacion_reclamo6, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo6 = strip_tags($this->historial_reclamacion_reclamo6);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo6))
         {
             $this->historial_reclamacion_reclamo6 = sc_convert_encoding($this->historial_reclamacion_reclamo6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo6 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo6);
         $this->historial_reclamacion_reclamo6 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo6);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo6 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion6
   function NM_export_historial_reclamacion_fecha_reclamacion6()
   {
         $this->historial_reclamacion_fecha_reclamacion6 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion6, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion6 = strip_tags($this->historial_reclamacion_fecha_reclamacion6);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion6))
         {
             $this->historial_reclamacion_fecha_reclamacion6 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion6 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion6);
         $this->historial_reclamacion_fecha_reclamacion6 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion6);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion6 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion6
   function NM_export_historial_reclamacion_motivo_no_reclamacion6()
   {
         $this->historial_reclamacion_motivo_no_reclamacion6 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion6, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion6 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion6);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion6))
         {
             $this->historial_reclamacion_motivo_no_reclamacion6 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion6 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion6);
         $this->historial_reclamacion_motivo_no_reclamacion6 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion6);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion6 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes7
   function NM_export_historial_reclamacion_mes7()
   {
         $this->historial_reclamacion_mes7 = html_entity_decode($this->historial_reclamacion_mes7, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes7 = strip_tags($this->historial_reclamacion_mes7);
         if (!NM_is_utf8($this->historial_reclamacion_mes7))
         {
             $this->historial_reclamacion_mes7 = sc_convert_encoding($this->historial_reclamacion_mes7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes7 = str_replace('<', '&lt;', $this->historial_reclamacion_mes7);
         $this->historial_reclamacion_mes7 = str_replace('>', '&gt;', $this->historial_reclamacion_mes7);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes7 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo7
   function NM_export_historial_reclamacion_reclamo7()
   {
         $this->historial_reclamacion_reclamo7 = html_entity_decode($this->historial_reclamacion_reclamo7, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo7 = strip_tags($this->historial_reclamacion_reclamo7);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo7))
         {
             $this->historial_reclamacion_reclamo7 = sc_convert_encoding($this->historial_reclamacion_reclamo7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo7 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo7);
         $this->historial_reclamacion_reclamo7 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo7);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo7 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion7
   function NM_export_historial_reclamacion_fecha_reclamacion7()
   {
         $this->historial_reclamacion_fecha_reclamacion7 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion7, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion7 = strip_tags($this->historial_reclamacion_fecha_reclamacion7);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion7))
         {
             $this->historial_reclamacion_fecha_reclamacion7 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion7 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion7);
         $this->historial_reclamacion_fecha_reclamacion7 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion7);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion7 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion7
   function NM_export_historial_reclamacion_motivo_no_reclamacion7()
   {
         $this->historial_reclamacion_motivo_no_reclamacion7 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion7, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion7 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion7);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion7))
         {
             $this->historial_reclamacion_motivo_no_reclamacion7 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion7 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion7);
         $this->historial_reclamacion_motivo_no_reclamacion7 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion7);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion7 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes8
   function NM_export_historial_reclamacion_mes8()
   {
         $this->historial_reclamacion_mes8 = html_entity_decode($this->historial_reclamacion_mes8, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes8 = strip_tags($this->historial_reclamacion_mes8);
         if (!NM_is_utf8($this->historial_reclamacion_mes8))
         {
             $this->historial_reclamacion_mes8 = sc_convert_encoding($this->historial_reclamacion_mes8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes8 = str_replace('<', '&lt;', $this->historial_reclamacion_mes8);
         $this->historial_reclamacion_mes8 = str_replace('>', '&gt;', $this->historial_reclamacion_mes8);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes8 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo8
   function NM_export_historial_reclamacion_reclamo8()
   {
         $this->historial_reclamacion_reclamo8 = html_entity_decode($this->historial_reclamacion_reclamo8, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo8 = strip_tags($this->historial_reclamacion_reclamo8);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo8))
         {
             $this->historial_reclamacion_reclamo8 = sc_convert_encoding($this->historial_reclamacion_reclamo8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo8 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo8);
         $this->historial_reclamacion_reclamo8 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo8);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo8 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion8
   function NM_export_historial_reclamacion_fecha_reclamacion8()
   {
         $this->historial_reclamacion_fecha_reclamacion8 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion8, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion8 = strip_tags($this->historial_reclamacion_fecha_reclamacion8);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion8))
         {
             $this->historial_reclamacion_fecha_reclamacion8 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion8 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion8);
         $this->historial_reclamacion_fecha_reclamacion8 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion8);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion8 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion8
   function NM_export_historial_reclamacion_motivo_no_reclamacion8()
   {
         $this->historial_reclamacion_motivo_no_reclamacion8 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion8, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion8 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion8);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion8))
         {
             $this->historial_reclamacion_motivo_no_reclamacion8 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion8 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion8);
         $this->historial_reclamacion_motivo_no_reclamacion8 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion8);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion8 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes9
   function NM_export_historial_reclamacion_mes9()
   {
         $this->historial_reclamacion_mes9 = html_entity_decode($this->historial_reclamacion_mes9, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes9 = strip_tags($this->historial_reclamacion_mes9);
         if (!NM_is_utf8($this->historial_reclamacion_mes9))
         {
             $this->historial_reclamacion_mes9 = sc_convert_encoding($this->historial_reclamacion_mes9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes9 = str_replace('<', '&lt;', $this->historial_reclamacion_mes9);
         $this->historial_reclamacion_mes9 = str_replace('>', '&gt;', $this->historial_reclamacion_mes9);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes9 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo9
   function NM_export_historial_reclamacion_reclamo9()
   {
         $this->historial_reclamacion_reclamo9 = html_entity_decode($this->historial_reclamacion_reclamo9, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo9 = strip_tags($this->historial_reclamacion_reclamo9);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo9))
         {
             $this->historial_reclamacion_reclamo9 = sc_convert_encoding($this->historial_reclamacion_reclamo9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo9 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo9);
         $this->historial_reclamacion_reclamo9 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo9);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo9 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion9
   function NM_export_historial_reclamacion_fecha_reclamacion9()
   {
         $this->historial_reclamacion_fecha_reclamacion9 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion9, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion9 = strip_tags($this->historial_reclamacion_fecha_reclamacion9);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion9))
         {
             $this->historial_reclamacion_fecha_reclamacion9 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion9 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion9);
         $this->historial_reclamacion_fecha_reclamacion9 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion9);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion9 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion9
   function NM_export_historial_reclamacion_motivo_no_reclamacion9()
   {
         $this->historial_reclamacion_motivo_no_reclamacion9 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion9, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion9 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion9);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion9))
         {
             $this->historial_reclamacion_motivo_no_reclamacion9 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion9 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion9);
         $this->historial_reclamacion_motivo_no_reclamacion9 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion9);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion9 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes10
   function NM_export_historial_reclamacion_mes10()
   {
         $this->historial_reclamacion_mes10 = html_entity_decode($this->historial_reclamacion_mes10, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes10 = strip_tags($this->historial_reclamacion_mes10);
         if (!NM_is_utf8($this->historial_reclamacion_mes10))
         {
             $this->historial_reclamacion_mes10 = sc_convert_encoding($this->historial_reclamacion_mes10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes10 = str_replace('<', '&lt;', $this->historial_reclamacion_mes10);
         $this->historial_reclamacion_mes10 = str_replace('>', '&gt;', $this->historial_reclamacion_mes10);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes10 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo10
   function NM_export_historial_reclamacion_reclamo10()
   {
         $this->historial_reclamacion_reclamo10 = html_entity_decode($this->historial_reclamacion_reclamo10, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo10 = strip_tags($this->historial_reclamacion_reclamo10);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo10))
         {
             $this->historial_reclamacion_reclamo10 = sc_convert_encoding($this->historial_reclamacion_reclamo10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo10 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo10);
         $this->historial_reclamacion_reclamo10 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo10);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo10 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion10
   function NM_export_historial_reclamacion_fecha_reclamacion10()
   {
         $this->historial_reclamacion_fecha_reclamacion10 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion10, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion10 = strip_tags($this->historial_reclamacion_fecha_reclamacion10);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion10))
         {
             $this->historial_reclamacion_fecha_reclamacion10 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion10 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion10);
         $this->historial_reclamacion_fecha_reclamacion10 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion10);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion10 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion10
   function NM_export_historial_reclamacion_motivo_no_reclamacion10()
   {
         $this->historial_reclamacion_motivo_no_reclamacion10 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion10, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion10 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion10);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion10))
         {
             $this->historial_reclamacion_motivo_no_reclamacion10 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion10 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion10);
         $this->historial_reclamacion_motivo_no_reclamacion10 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion10);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion10 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes11
   function NM_export_historial_reclamacion_mes11()
   {
         $this->historial_reclamacion_mes11 = html_entity_decode($this->historial_reclamacion_mes11, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes11 = strip_tags($this->historial_reclamacion_mes11);
         if (!NM_is_utf8($this->historial_reclamacion_mes11))
         {
             $this->historial_reclamacion_mes11 = sc_convert_encoding($this->historial_reclamacion_mes11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes11 = str_replace('<', '&lt;', $this->historial_reclamacion_mes11);
         $this->historial_reclamacion_mes11 = str_replace('>', '&gt;', $this->historial_reclamacion_mes11);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes11 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo11
   function NM_export_historial_reclamacion_reclamo11()
   {
         $this->historial_reclamacion_reclamo11 = html_entity_decode($this->historial_reclamacion_reclamo11, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo11 = strip_tags($this->historial_reclamacion_reclamo11);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo11))
         {
             $this->historial_reclamacion_reclamo11 = sc_convert_encoding($this->historial_reclamacion_reclamo11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo11 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo11);
         $this->historial_reclamacion_reclamo11 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo11);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo11 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion11
   function NM_export_historial_reclamacion_fecha_reclamacion11()
   {
         $this->historial_reclamacion_fecha_reclamacion11 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion11, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion11 = strip_tags($this->historial_reclamacion_fecha_reclamacion11);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion11))
         {
             $this->historial_reclamacion_fecha_reclamacion11 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion11 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion11);
         $this->historial_reclamacion_fecha_reclamacion11 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion11);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion11 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion11
   function NM_export_historial_reclamacion_motivo_no_reclamacion11()
   {
         $this->historial_reclamacion_motivo_no_reclamacion11 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion11, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion11 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion11);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion11))
         {
             $this->historial_reclamacion_motivo_no_reclamacion11 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion11 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion11);
         $this->historial_reclamacion_motivo_no_reclamacion11 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion11);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion11 . "</td>\r\n";
   }
   //----- historial_reclamacion_mes12
   function NM_export_historial_reclamacion_mes12()
   {
         $this->historial_reclamacion_mes12 = html_entity_decode($this->historial_reclamacion_mes12, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_mes12 = strip_tags($this->historial_reclamacion_mes12);
         if (!NM_is_utf8($this->historial_reclamacion_mes12))
         {
             $this->historial_reclamacion_mes12 = sc_convert_encoding($this->historial_reclamacion_mes12, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_mes12 = str_replace('<', '&lt;', $this->historial_reclamacion_mes12);
         $this->historial_reclamacion_mes12 = str_replace('>', '&gt;', $this->historial_reclamacion_mes12);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_mes12 . "</td>\r\n";
   }
   //----- historial_reclamacion_reclamo12
   function NM_export_historial_reclamacion_reclamo12()
   {
         $this->historial_reclamacion_reclamo12 = html_entity_decode($this->historial_reclamacion_reclamo12, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_reclamo12 = strip_tags($this->historial_reclamacion_reclamo12);
         if (!NM_is_utf8($this->historial_reclamacion_reclamo12))
         {
             $this->historial_reclamacion_reclamo12 = sc_convert_encoding($this->historial_reclamacion_reclamo12, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_reclamo12 = str_replace('<', '&lt;', $this->historial_reclamacion_reclamo12);
         $this->historial_reclamacion_reclamo12 = str_replace('>', '&gt;', $this->historial_reclamacion_reclamo12);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_reclamo12 . "</td>\r\n";
   }
   //----- historial_reclamacion_fecha_reclamacion12
   function NM_export_historial_reclamacion_fecha_reclamacion12()
   {
         $this->historial_reclamacion_fecha_reclamacion12 = html_entity_decode($this->historial_reclamacion_fecha_reclamacion12, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_fecha_reclamacion12 = strip_tags($this->historial_reclamacion_fecha_reclamacion12);
         if (!NM_is_utf8($this->historial_reclamacion_fecha_reclamacion12))
         {
             $this->historial_reclamacion_fecha_reclamacion12 = sc_convert_encoding($this->historial_reclamacion_fecha_reclamacion12, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_fecha_reclamacion12 = str_replace('<', '&lt;', $this->historial_reclamacion_fecha_reclamacion12);
         $this->historial_reclamacion_fecha_reclamacion12 = str_replace('>', '&gt;', $this->historial_reclamacion_fecha_reclamacion12);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_fecha_reclamacion12 . "</td>\r\n";
   }
   //----- historial_reclamacion_motivo_no_reclamacion12
   function NM_export_historial_reclamacion_motivo_no_reclamacion12()
   {
         $this->historial_reclamacion_motivo_no_reclamacion12 = html_entity_decode($this->historial_reclamacion_motivo_no_reclamacion12, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->historial_reclamacion_motivo_no_reclamacion12 = strip_tags($this->historial_reclamacion_motivo_no_reclamacion12);
         if (!NM_is_utf8($this->historial_reclamacion_motivo_no_reclamacion12))
         {
             $this->historial_reclamacion_motivo_no_reclamacion12 = sc_convert_encoding($this->historial_reclamacion_motivo_no_reclamacion12, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->historial_reclamacion_motivo_no_reclamacion12 = str_replace('<', '&lt;', $this->historial_reclamacion_motivo_no_reclamacion12);
         $this->historial_reclamacion_motivo_no_reclamacion12 = str_replace('>', '&gt;', $this->historial_reclamacion_motivo_no_reclamacion12);
         $this->texto_tag .= "<td>" . $this->historial_reclamacion_motivo_no_reclamacion12 . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $rtf_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['HISTORICO_RECLAMACIONES'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> -  :: RTF</TITLE>
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
   <td class="scExportTitle" style="height: 25px">RTF</td>
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
<form name="Fdown" method="get" action="HISTORICO_RECLAMACIONES_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="HISTORICO_RECLAMACIONES"> 
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

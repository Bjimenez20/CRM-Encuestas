<?php

class lis_pacientes_rtf
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
   function lis_pacientes_rtf()
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
      $this->arquivo   .= "_lis_pacientes";
      $this->arquivo   .= ".rtf";
      $this->tit_doc    = "lis_pacientes.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['lis_pacientes']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['lis_pacientes']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['lis_pacientes']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca'];
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
          $this->pacientes_estado_paciente = $Busca_temp['pacientes_estado_paciente']; 
          $tmp_pos = strpos($this->pacientes_estado_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_estado_paciente = substr($this->pacientes_estado_paciente, 0, $tmp_pos);
          }
          $this->pacientes_fecha_activacion_paciente = $Busca_temp['pacientes_fecha_activacion_paciente']; 
          $tmp_pos = strpos($this->pacientes_fecha_activacion_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_fecha_activacion_paciente = substr($this->pacientes_fecha_activacion_paciente, 0, $tmp_pos);
          }
          $this->pacientes_fecha_retiro_paciente = $Busca_temp['pacientes_fecha_retiro_paciente']; 
          $tmp_pos = strpos($this->pacientes_fecha_retiro_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_fecha_retiro_paciente = substr($this->pacientes_fecha_retiro_paciente, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['rtf_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['rtf_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['rtf_name']);
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['order_grid'];
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
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['field_order'] as $Cada_col)
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
          $SC_Label = (isset($this->New_label['pacientes_fecha_retiro_paciente'])) ? $this->New_label['pacientes_fecha_retiro_paciente'] : "FECHA RETIRO PACIENTE"; 
          if ($Cada_col == "pacientes_fecha_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_motivo_retiro_paciente'])) ? $this->New_label['pacientes_motivo_retiro_paciente'] : "MOTIVO RETIRO PACIENTE"; 
          if ($Cada_col == "pacientes_motivo_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_observacion_motivo_retiro_paciente'])) ? $this->New_label['pacientes_observacion_motivo_retiro_paciente'] : "OBSERVACION MOTIVO RETIRO PACIENTE"; 
          if ($Cada_col == "pacientes_observacion_motivo_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_identificacion_paciente'])) ? $this->New_label['pacientes_identificacion_paciente'] : "IDENTIFICACION PACIENTE"; 
          if ($Cada_col == "pacientes_identificacion_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_nombre_paciente'])) ? $this->New_label['pacientes_nombre_paciente'] : "NOMBRE PACIENTE"; 
          if ($Cada_col == "pacientes_nombre_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_apellido_paciente'])) ? $this->New_label['pacientes_apellido_paciente'] : "APELLIDO PACIENTE"; 
          if ($Cada_col == "pacientes_apellido_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_telefono_paciente'])) ? $this->New_label['pacientes_telefono_paciente'] : "TELEFONO PACIENTE"; 
          if ($Cada_col == "pacientes_telefono_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_telefono2_paciente'])) ? $this->New_label['pacientes_telefono2_paciente'] : "TELEFONO2 PACIENTE"; 
          if ($Cada_col == "pacientes_telefono2_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_telefono3_paciente'])) ? $this->New_label['pacientes_telefono3_paciente'] : "TELEFONO3 PACIENTE"; 
          if ($Cada_col == "pacientes_telefono3_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_correo_paciente'])) ? $this->New_label['pacientes_correo_paciente'] : "CORREO PACIENTE"; 
          if ($Cada_col == "pacientes_correo_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_direccion_paciente'])) ? $this->New_label['pacientes_direccion_paciente'] : "DIRECCION PACIENTE"; 
          if ($Cada_col == "pacientes_direccion_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_barrio_paciente'])) ? $this->New_label['pacientes_barrio_paciente'] : "BARRIO PACIENTE"; 
          if ($Cada_col == "pacientes_barrio_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['pacientes_genero_paciente'])) ? $this->New_label['pacientes_genero_paciente'] : "GENERO PACIENTE"; 
          if ($Cada_col == "pacientes_genero_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_fecha_nacimineto_paciente'])) ? $this->New_label['pacientes_fecha_nacimineto_paciente'] : "FECHA NACIMINETO PACIENTE"; 
          if ($Cada_col == "pacientes_fecha_nacimineto_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_edad_paciente'])) ? $this->New_label['pacientes_edad_paciente'] : "EDAD PACIENTE"; 
          if ($Cada_col == "pacientes_edad_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_acudiente_paciente'])) ? $this->New_label['pacientes_acudiente_paciente'] : "ACUDIENTE PACIENTE"; 
          if ($Cada_col == "pacientes_acudiente_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_telefono_acudiente_paciente'])) ? $this->New_label['pacientes_telefono_acudiente_paciente'] : "TELEFONO ACUDIENTE PACIENTE"; 
          if ($Cada_col == "pacientes_telefono_acudiente_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['pacientes_id_ultima_gestion'])) ? $this->New_label['pacientes_id_ultima_gestion'] : "ID ULTIMA GESTION"; 
          if ($Cada_col == "pacientes_id_ultima_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacientes_usuario_creacion'])) ? $this->New_label['pacientes_usuario_creacion'] : "USUARIO CREACION"; 
          if ($Cada_col == "pacientes_usuario_creacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_id_tratamiento'])) ? $this->New_label['tratamiento_id_tratamiento'] : "ID TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_id_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tratamiento_clasificacion_patologica_tratamiento'])) ? $this->New_label['tratamiento_clasificacion_patologica_tratamiento'] : "CLASIFICACION PATOLOGICA TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_clasificacion_patologica_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_tratamiento_previo'])) ? $this->New_label['tratamiento_tratamiento_previo'] : "TRATAMIENTO PREVIO"; 
          if ($Cada_col == "tratamiento_tratamiento_previo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_consentimiento_tratamiento'])) ? $this->New_label['tratamiento_consentimiento_tratamiento'] : "CONSENTIMIENTO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_consentimiento_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_fecha_inicio_terapia_tratamiento'])) ? $this->New_label['tratamiento_fecha_inicio_terapia_tratamiento'] : "FECHA INICIO TERAPIA TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_fecha_inicio_terapia_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_regimen_tratamiento'])) ? $this->New_label['tratamiento_regimen_tratamiento'] : "REGIMEN TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_regimen_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tratamiento_fecha_ultima_reclamacion_tratamiento'])) ? $this->New_label['tratamiento_fecha_ultima_reclamacion_tratamiento'] : "FECHA ULTIMA RECLAMACION TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_fecha_ultima_reclamacion_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_otros_operadores_tratamiento'])) ? $this->New_label['tratamiento_otros_operadores_tratamiento'] : "OTROS OPERADORES TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_otros_operadores_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_medios_adquisicion_tratamiento'])) ? $this->New_label['tratamiento_medios_adquisicion_tratamiento'] : "MEDIOS ADQUISICION TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_medios_adquisicion_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_ips_atiende_tratamiento'])) ? $this->New_label['tratamiento_ips_atiende_tratamiento'] : "IPS ATIENDE TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_ips_atiende_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_medico_tratamiento'])) ? $this->New_label['tratamiento_medico_tratamiento'] : "MEDICO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_medico_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_especialidad_tratamiento'])) ? $this->New_label['tratamiento_especialidad_tratamiento'] : "ESPECIALIDAD TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_especialidad_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_paramedico_tratamiento'])) ? $this->New_label['tratamiento_paramedico_tratamiento'] : "PARAMEDICO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_paramedico_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_zona_atencion_paramedico_tratamiento'])) ? $this->New_label['tratamiento_zona_atencion_paramedico_tratamiento'] : "ZONA ATENCION PARAMEDICO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_zona_atencion_paramedico_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_ciudad_base_paramedico_tratamiento'])) ? $this->New_label['tratamiento_ciudad_base_paramedico_tratamiento'] : "CIUDAD BASE PARAMEDICO TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_ciudad_base_paramedico_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tratamiento_notas_adjuntos_tratamiento'])) ? $this->New_label['tratamiento_notas_adjuntos_tratamiento'] : "NOTAS ADJUNTOS TRATAMIENTO"; 
          if ($Cada_col == "tratamiento_notas_adjuntos_tratamiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
         $this->pacientes_estado_paciente = $rs->fields[1] ;  
         $this->pacientes_fecha_activacion_paciente = $rs->fields[2] ;  
         $this->pacientes_fecha_retiro_paciente = $rs->fields[3] ;  
         $this->pacientes_motivo_retiro_paciente = $rs->fields[4] ;  
         $this->pacientes_observacion_motivo_retiro_paciente = $rs->fields[5] ;  
         $this->pacientes_identificacion_paciente = $rs->fields[6] ;  
         $this->pacientes_nombre_paciente = $rs->fields[7] ;  
         $this->pacientes_apellido_paciente = $rs->fields[8] ;  
         $this->pacientes_telefono_paciente = $rs->fields[9] ;  
         $this->pacientes_telefono2_paciente = $rs->fields[10] ;  
         $this->pacientes_telefono3_paciente = $rs->fields[11] ;  
         $this->pacientes_correo_paciente = $rs->fields[12] ;  
         $this->pacientes_direccion_paciente = $rs->fields[13] ;  
         $this->pacientes_barrio_paciente = $rs->fields[14] ;  
         $this->pacientes_departamento_paciente = $rs->fields[15] ;  
         $this->pacientes_ciudad_paciente = $rs->fields[16] ;  
         $this->pacientes_genero_paciente = $rs->fields[17] ;  
         $this->pacientes_fecha_nacimineto_paciente = $rs->fields[18] ;  
         $this->pacientes_edad_paciente = $rs->fields[19] ;  
         $this->pacientes_edad_paciente = (string)$this->pacientes_edad_paciente;
         $this->pacientes_acudiente_paciente = $rs->fields[20] ;  
         $this->pacientes_telefono_acudiente_paciente = $rs->fields[21] ;  
         $this->pacientes_codigo_xofigo = $rs->fields[22] ;  
         $this->pacientes_codigo_xofigo = (string)$this->pacientes_codigo_xofigo;
         $this->pacientes_status_paciente = $rs->fields[23] ;  
         $this->pacientes_id_ultima_gestion = $rs->fields[24] ;  
         $this->pacientes_id_ultima_gestion = (string)$this->pacientes_id_ultima_gestion;
         $this->pacientes_usuario_creacion = $rs->fields[25] ;  
         $this->tratamiento_id_tratamiento = $rs->fields[26] ;  
         $this->tratamiento_id_tratamiento = (string)$this->tratamiento_id_tratamiento;
         $this->tratamiento_producto_tratamiento = $rs->fields[27] ;  
         $this->tratamiento_nombre_referencia = $rs->fields[28] ;  
         $this->tratamiento_clasificacion_patologica_tratamiento = $rs->fields[29] ;  
         $this->tratamiento_tratamiento_previo = $rs->fields[30] ;  
         $this->tratamiento_consentimiento_tratamiento = $rs->fields[31] ;  
         $this->tratamiento_fecha_inicio_terapia_tratamiento = $rs->fields[32] ;  
         $this->tratamiento_regimen_tratamiento = $rs->fields[33] ;  
         $this->tratamiento_asegurador_tratamiento = $rs->fields[34] ;  
         $this->tratamiento_operador_logistico_tratamiento = $rs->fields[35] ;  
         $this->tratamiento_punto_entrega = $rs->fields[36] ;  
         $this->tratamiento_fecha_ultima_reclamacion_tratamiento = $rs->fields[37] ;  
         $this->tratamiento_otros_operadores_tratamiento = $rs->fields[38] ;  
         $this->tratamiento_medios_adquisicion_tratamiento = $rs->fields[39] ;  
         $this->tratamiento_ips_atiende_tratamiento = $rs->fields[40] ;  
         $this->tratamiento_medico_tratamiento = $rs->fields[41] ;  
         $this->tratamiento_especialidad_tratamiento = $rs->fields[42] ;  
         $this->tratamiento_paramedico_tratamiento = $rs->fields[43] ;  
         $this->tratamiento_zona_atencion_paramedico_tratamiento = $rs->fields[44] ;  
         $this->tratamiento_ciudad_base_paramedico_tratamiento = $rs->fields[45] ;  
         $this->tratamiento_notas_adjuntos_tratamiento = $rs->fields[46] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['field_order'] as $Cada_col)
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
         $this->pacientes_id_paciente = html_entity_decode($this->pacientes_id_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_id_paciente = strip_tags($this->pacientes_id_paciente);
         if (!NM_is_utf8($this->pacientes_id_paciente))
         {
             $this->pacientes_id_paciente = sc_convert_encoding($this->pacientes_id_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_id_paciente = str_replace('<', '&lt;', $this->pacientes_id_paciente);
         $this->pacientes_id_paciente = str_replace('>', '&gt;', $this->pacientes_id_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_id_paciente . "</td>\r\n";
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
   //----- pacientes_fecha_activacion_paciente
   function NM_export_pacientes_fecha_activacion_paciente()
   {
         $conteudo_x =  $this->pacientes_fecha_activacion_paciente;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->pacientes_fecha_activacion_paciente, "");
             $this->pacientes_fecha_activacion_paciente = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
         if (!NM_is_utf8($this->pacientes_fecha_activacion_paciente))
         {
             $this->pacientes_fecha_activacion_paciente = sc_convert_encoding($this->pacientes_fecha_activacion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_fecha_activacion_paciente = str_replace('<', '&lt;', $this->pacientes_fecha_activacion_paciente);
         $this->pacientes_fecha_activacion_paciente = str_replace('>', '&gt;', $this->pacientes_fecha_activacion_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_fecha_activacion_paciente . "</td>\r\n";
   }
   //----- pacientes_fecha_retiro_paciente
   function NM_export_pacientes_fecha_retiro_paciente()
   {
         $conteudo_x =  $this->pacientes_fecha_retiro_paciente;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->pacientes_fecha_retiro_paciente, "");
             $this->pacientes_fecha_retiro_paciente = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
         if (!NM_is_utf8($this->pacientes_fecha_retiro_paciente))
         {
             $this->pacientes_fecha_retiro_paciente = sc_convert_encoding($this->pacientes_fecha_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_fecha_retiro_paciente = str_replace('<', '&lt;', $this->pacientes_fecha_retiro_paciente);
         $this->pacientes_fecha_retiro_paciente = str_replace('>', '&gt;', $this->pacientes_fecha_retiro_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_fecha_retiro_paciente . "</td>\r\n";
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
         $this->pacientes_motivo_retiro_paciente = str_replace('<', '&lt;', $this->pacientes_motivo_retiro_paciente);
         $this->pacientes_motivo_retiro_paciente = str_replace('>', '&gt;', $this->pacientes_motivo_retiro_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_motivo_retiro_paciente . "</td>\r\n";
   }
   //----- pacientes_observacion_motivo_retiro_paciente
   function NM_export_pacientes_observacion_motivo_retiro_paciente()
   {
         $this->pacientes_observacion_motivo_retiro_paciente = html_entity_decode($this->pacientes_observacion_motivo_retiro_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_observacion_motivo_retiro_paciente = strip_tags($this->pacientes_observacion_motivo_retiro_paciente);
         if (!NM_is_utf8($this->pacientes_observacion_motivo_retiro_paciente))
         {
             $this->pacientes_observacion_motivo_retiro_paciente = sc_convert_encoding($this->pacientes_observacion_motivo_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_observacion_motivo_retiro_paciente = str_replace('<', '&lt;', $this->pacientes_observacion_motivo_retiro_paciente);
         $this->pacientes_observacion_motivo_retiro_paciente = str_replace('>', '&gt;', $this->pacientes_observacion_motivo_retiro_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_observacion_motivo_retiro_paciente . "</td>\r\n";
   }
   //----- pacientes_identificacion_paciente
   function NM_export_pacientes_identificacion_paciente()
   {
         $this->pacientes_identificacion_paciente = html_entity_decode($this->pacientes_identificacion_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_identificacion_paciente = strip_tags($this->pacientes_identificacion_paciente);
         if (!NM_is_utf8($this->pacientes_identificacion_paciente))
         {
             $this->pacientes_identificacion_paciente = sc_convert_encoding($this->pacientes_identificacion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_identificacion_paciente = str_replace('<', '&lt;', $this->pacientes_identificacion_paciente);
         $this->pacientes_identificacion_paciente = str_replace('>', '&gt;', $this->pacientes_identificacion_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_identificacion_paciente . "</td>\r\n";
   }
   //----- pacientes_nombre_paciente
   function NM_export_pacientes_nombre_paciente()
   {
         $this->pacientes_nombre_paciente = html_entity_decode($this->pacientes_nombre_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_nombre_paciente = strip_tags($this->pacientes_nombre_paciente);
         if (!NM_is_utf8($this->pacientes_nombre_paciente))
         {
             $this->pacientes_nombre_paciente = sc_convert_encoding($this->pacientes_nombre_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_nombre_paciente = str_replace('<', '&lt;', $this->pacientes_nombre_paciente);
         $this->pacientes_nombre_paciente = str_replace('>', '&gt;', $this->pacientes_nombre_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_nombre_paciente . "</td>\r\n";
   }
   //----- pacientes_apellido_paciente
   function NM_export_pacientes_apellido_paciente()
   {
         $this->pacientes_apellido_paciente = html_entity_decode($this->pacientes_apellido_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_apellido_paciente = strip_tags($this->pacientes_apellido_paciente);
         if (!NM_is_utf8($this->pacientes_apellido_paciente))
         {
             $this->pacientes_apellido_paciente = sc_convert_encoding($this->pacientes_apellido_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_apellido_paciente = str_replace('<', '&lt;', $this->pacientes_apellido_paciente);
         $this->pacientes_apellido_paciente = str_replace('>', '&gt;', $this->pacientes_apellido_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_apellido_paciente . "</td>\r\n";
   }
   //----- pacientes_telefono_paciente
   function NM_export_pacientes_telefono_paciente()
   {
         $this->pacientes_telefono_paciente = html_entity_decode($this->pacientes_telefono_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_telefono_paciente = strip_tags($this->pacientes_telefono_paciente);
         if (!NM_is_utf8($this->pacientes_telefono_paciente))
         {
             $this->pacientes_telefono_paciente = sc_convert_encoding($this->pacientes_telefono_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_telefono_paciente = str_replace('<', '&lt;', $this->pacientes_telefono_paciente);
         $this->pacientes_telefono_paciente = str_replace('>', '&gt;', $this->pacientes_telefono_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_telefono_paciente . "</td>\r\n";
   }
   //----- pacientes_telefono2_paciente
   function NM_export_pacientes_telefono2_paciente()
   {
         $this->pacientes_telefono2_paciente = html_entity_decode($this->pacientes_telefono2_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_telefono2_paciente = strip_tags($this->pacientes_telefono2_paciente);
         if (!NM_is_utf8($this->pacientes_telefono2_paciente))
         {
             $this->pacientes_telefono2_paciente = sc_convert_encoding($this->pacientes_telefono2_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_telefono2_paciente = str_replace('<', '&lt;', $this->pacientes_telefono2_paciente);
         $this->pacientes_telefono2_paciente = str_replace('>', '&gt;', $this->pacientes_telefono2_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_telefono2_paciente . "</td>\r\n";
   }
   //----- pacientes_telefono3_paciente
   function NM_export_pacientes_telefono3_paciente()
   {
         $this->pacientes_telefono3_paciente = html_entity_decode($this->pacientes_telefono3_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_telefono3_paciente = strip_tags($this->pacientes_telefono3_paciente);
         if (!NM_is_utf8($this->pacientes_telefono3_paciente))
         {
             $this->pacientes_telefono3_paciente = sc_convert_encoding($this->pacientes_telefono3_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_telefono3_paciente = str_replace('<', '&lt;', $this->pacientes_telefono3_paciente);
         $this->pacientes_telefono3_paciente = str_replace('>', '&gt;', $this->pacientes_telefono3_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_telefono3_paciente . "</td>\r\n";
   }
   //----- pacientes_correo_paciente
   function NM_export_pacientes_correo_paciente()
   {
         $this->pacientes_correo_paciente = html_entity_decode($this->pacientes_correo_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_correo_paciente = strip_tags($this->pacientes_correo_paciente);
         if (!NM_is_utf8($this->pacientes_correo_paciente))
         {
             $this->pacientes_correo_paciente = sc_convert_encoding($this->pacientes_correo_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_correo_paciente = str_replace('<', '&lt;', $this->pacientes_correo_paciente);
         $this->pacientes_correo_paciente = str_replace('>', '&gt;', $this->pacientes_correo_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_correo_paciente . "</td>\r\n";
   }
   //----- pacientes_direccion_paciente
   function NM_export_pacientes_direccion_paciente()
   {
         $this->pacientes_direccion_paciente = html_entity_decode($this->pacientes_direccion_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_direccion_paciente = strip_tags($this->pacientes_direccion_paciente);
         if (!NM_is_utf8($this->pacientes_direccion_paciente))
         {
             $this->pacientes_direccion_paciente = sc_convert_encoding($this->pacientes_direccion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_direccion_paciente = str_replace('<', '&lt;', $this->pacientes_direccion_paciente);
         $this->pacientes_direccion_paciente = str_replace('>', '&gt;', $this->pacientes_direccion_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_direccion_paciente . "</td>\r\n";
   }
   //----- pacientes_barrio_paciente
   function NM_export_pacientes_barrio_paciente()
   {
         $this->pacientes_barrio_paciente = html_entity_decode($this->pacientes_barrio_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_barrio_paciente = strip_tags($this->pacientes_barrio_paciente);
         if (!NM_is_utf8($this->pacientes_barrio_paciente))
         {
             $this->pacientes_barrio_paciente = sc_convert_encoding($this->pacientes_barrio_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_barrio_paciente = str_replace('<', '&lt;', $this->pacientes_barrio_paciente);
         $this->pacientes_barrio_paciente = str_replace('>', '&gt;', $this->pacientes_barrio_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_barrio_paciente . "</td>\r\n";
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
   //----- pacientes_genero_paciente
   function NM_export_pacientes_genero_paciente()
   {
         $this->pacientes_genero_paciente = html_entity_decode($this->pacientes_genero_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_genero_paciente = strip_tags($this->pacientes_genero_paciente);
         if (!NM_is_utf8($this->pacientes_genero_paciente))
         {
             $this->pacientes_genero_paciente = sc_convert_encoding($this->pacientes_genero_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_genero_paciente = str_replace('<', '&lt;', $this->pacientes_genero_paciente);
         $this->pacientes_genero_paciente = str_replace('>', '&gt;', $this->pacientes_genero_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_genero_paciente . "</td>\r\n";
   }
   //----- pacientes_fecha_nacimineto_paciente
   function NM_export_pacientes_fecha_nacimineto_paciente()
   {
         $conteudo_x =  $this->pacientes_fecha_nacimineto_paciente;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->pacientes_fecha_nacimineto_paciente, "");
             $this->pacientes_fecha_nacimineto_paciente = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
         if (!NM_is_utf8($this->pacientes_fecha_nacimineto_paciente))
         {
             $this->pacientes_fecha_nacimineto_paciente = sc_convert_encoding($this->pacientes_fecha_nacimineto_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_fecha_nacimineto_paciente = str_replace('<', '&lt;', $this->pacientes_fecha_nacimineto_paciente);
         $this->pacientes_fecha_nacimineto_paciente = str_replace('>', '&gt;', $this->pacientes_fecha_nacimineto_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_fecha_nacimineto_paciente . "</td>\r\n";
   }
   //----- pacientes_edad_paciente
   function NM_export_pacientes_edad_paciente()
   {
         nmgp_Form_Num_Val($this->pacientes_edad_paciente, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->pacientes_edad_paciente))
         {
             $this->pacientes_edad_paciente = sc_convert_encoding($this->pacientes_edad_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_edad_paciente = str_replace('<', '&lt;', $this->pacientes_edad_paciente);
         $this->pacientes_edad_paciente = str_replace('>', '&gt;', $this->pacientes_edad_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_edad_paciente . "</td>\r\n";
   }
   //----- pacientes_acudiente_paciente
   function NM_export_pacientes_acudiente_paciente()
   {
         $this->pacientes_acudiente_paciente = html_entity_decode($this->pacientes_acudiente_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_acudiente_paciente = strip_tags($this->pacientes_acudiente_paciente);
         if (!NM_is_utf8($this->pacientes_acudiente_paciente))
         {
             $this->pacientes_acudiente_paciente = sc_convert_encoding($this->pacientes_acudiente_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_acudiente_paciente = str_replace('<', '&lt;', $this->pacientes_acudiente_paciente);
         $this->pacientes_acudiente_paciente = str_replace('>', '&gt;', $this->pacientes_acudiente_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_acudiente_paciente . "</td>\r\n";
   }
   //----- pacientes_telefono_acudiente_paciente
   function NM_export_pacientes_telefono_acudiente_paciente()
   {
         $this->pacientes_telefono_acudiente_paciente = html_entity_decode($this->pacientes_telefono_acudiente_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_telefono_acudiente_paciente = strip_tags($this->pacientes_telefono_acudiente_paciente);
         if (!NM_is_utf8($this->pacientes_telefono_acudiente_paciente))
         {
             $this->pacientes_telefono_acudiente_paciente = sc_convert_encoding($this->pacientes_telefono_acudiente_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_telefono_acudiente_paciente = str_replace('<', '&lt;', $this->pacientes_telefono_acudiente_paciente);
         $this->pacientes_telefono_acudiente_paciente = str_replace('>', '&gt;', $this->pacientes_telefono_acudiente_paciente);
         $this->texto_tag .= "<td>" . $this->pacientes_telefono_acudiente_paciente . "</td>\r\n";
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
   //----- pacientes_id_ultima_gestion
   function NM_export_pacientes_id_ultima_gestion()
   {
         nmgp_Form_Num_Val($this->pacientes_id_ultima_gestion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->pacientes_id_ultima_gestion))
         {
             $this->pacientes_id_ultima_gestion = sc_convert_encoding($this->pacientes_id_ultima_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_id_ultima_gestion = str_replace('<', '&lt;', $this->pacientes_id_ultima_gestion);
         $this->pacientes_id_ultima_gestion = str_replace('>', '&gt;', $this->pacientes_id_ultima_gestion);
         $this->texto_tag .= "<td>" . $this->pacientes_id_ultima_gestion . "</td>\r\n";
   }
   //----- pacientes_usuario_creacion
   function NM_export_pacientes_usuario_creacion()
   {
         $this->pacientes_usuario_creacion = html_entity_decode($this->pacientes_usuario_creacion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_usuario_creacion = strip_tags($this->pacientes_usuario_creacion);
         if (!NM_is_utf8($this->pacientes_usuario_creacion))
         {
             $this->pacientes_usuario_creacion = sc_convert_encoding($this->pacientes_usuario_creacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->pacientes_usuario_creacion = str_replace('<', '&lt;', $this->pacientes_usuario_creacion);
         $this->pacientes_usuario_creacion = str_replace('>', '&gt;', $this->pacientes_usuario_creacion);
         $this->texto_tag .= "<td>" . $this->pacientes_usuario_creacion . "</td>\r\n";
   }
   //----- tratamiento_id_tratamiento
   function NM_export_tratamiento_id_tratamiento()
   {
         nmgp_Form_Num_Val($this->tratamiento_id_tratamiento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->tratamiento_id_tratamiento))
         {
             $this->tratamiento_id_tratamiento = sc_convert_encoding($this->tratamiento_id_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_id_tratamiento = str_replace('<', '&lt;', $this->tratamiento_id_tratamiento);
         $this->tratamiento_id_tratamiento = str_replace('>', '&gt;', $this->tratamiento_id_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_id_tratamiento . "</td>\r\n";
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
   //----- tratamiento_clasificacion_patologica_tratamiento
   function NM_export_tratamiento_clasificacion_patologica_tratamiento()
   {
         $this->tratamiento_clasificacion_patologica_tratamiento = html_entity_decode($this->tratamiento_clasificacion_patologica_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_clasificacion_patologica_tratamiento = strip_tags($this->tratamiento_clasificacion_patologica_tratamiento);
         if (!NM_is_utf8($this->tratamiento_clasificacion_patologica_tratamiento))
         {
             $this->tratamiento_clasificacion_patologica_tratamiento = sc_convert_encoding($this->tratamiento_clasificacion_patologica_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_clasificacion_patologica_tratamiento = str_replace('<', '&lt;', $this->tratamiento_clasificacion_patologica_tratamiento);
         $this->tratamiento_clasificacion_patologica_tratamiento = str_replace('>', '&gt;', $this->tratamiento_clasificacion_patologica_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_clasificacion_patologica_tratamiento . "</td>\r\n";
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
         $this->tratamiento_tratamiento_previo = str_replace('<', '&lt;', $this->tratamiento_tratamiento_previo);
         $this->tratamiento_tratamiento_previo = str_replace('>', '&gt;', $this->tratamiento_tratamiento_previo);
         $this->texto_tag .= "<td>" . $this->tratamiento_tratamiento_previo . "</td>\r\n";
   }
   //----- tratamiento_consentimiento_tratamiento
   function NM_export_tratamiento_consentimiento_tratamiento()
   {
         $this->tratamiento_consentimiento_tratamiento = html_entity_decode($this->tratamiento_consentimiento_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_consentimiento_tratamiento = strip_tags($this->tratamiento_consentimiento_tratamiento);
         if (!NM_is_utf8($this->tratamiento_consentimiento_tratamiento))
         {
             $this->tratamiento_consentimiento_tratamiento = sc_convert_encoding($this->tratamiento_consentimiento_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_consentimiento_tratamiento = str_replace('<', '&lt;', $this->tratamiento_consentimiento_tratamiento);
         $this->tratamiento_consentimiento_tratamiento = str_replace('>', '&gt;', $this->tratamiento_consentimiento_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_consentimiento_tratamiento . "</td>\r\n";
   }
   //----- tratamiento_fecha_inicio_terapia_tratamiento
   function NM_export_tratamiento_fecha_inicio_terapia_tratamiento()
   {
         $conteudo_x =  $this->tratamiento_fecha_inicio_terapia_tratamiento;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->tratamiento_fecha_inicio_terapia_tratamiento, "");
             $this->tratamiento_fecha_inicio_terapia_tratamiento = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
         if (!NM_is_utf8($this->tratamiento_fecha_inicio_terapia_tratamiento))
         {
             $this->tratamiento_fecha_inicio_terapia_tratamiento = sc_convert_encoding($this->tratamiento_fecha_inicio_terapia_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_fecha_inicio_terapia_tratamiento = str_replace('<', '&lt;', $this->tratamiento_fecha_inicio_terapia_tratamiento);
         $this->tratamiento_fecha_inicio_terapia_tratamiento = str_replace('>', '&gt;', $this->tratamiento_fecha_inicio_terapia_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_fecha_inicio_terapia_tratamiento . "</td>\r\n";
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
         $this->tratamiento_regimen_tratamiento = str_replace('<', '&lt;', $this->tratamiento_regimen_tratamiento);
         $this->tratamiento_regimen_tratamiento = str_replace('>', '&gt;', $this->tratamiento_regimen_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_regimen_tratamiento . "</td>\r\n";
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
   //----- tratamiento_fecha_ultima_reclamacion_tratamiento
   function NM_export_tratamiento_fecha_ultima_reclamacion_tratamiento()
   {
         $conteudo_x =  $this->tratamiento_fecha_ultima_reclamacion_tratamiento;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->tratamiento_fecha_ultima_reclamacion_tratamiento, "");
             $this->tratamiento_fecha_ultima_reclamacion_tratamiento = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
         if (!NM_is_utf8($this->tratamiento_fecha_ultima_reclamacion_tratamiento))
         {
             $this->tratamiento_fecha_ultima_reclamacion_tratamiento = sc_convert_encoding($this->tratamiento_fecha_ultima_reclamacion_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_fecha_ultima_reclamacion_tratamiento = str_replace('<', '&lt;', $this->tratamiento_fecha_ultima_reclamacion_tratamiento);
         $this->tratamiento_fecha_ultima_reclamacion_tratamiento = str_replace('>', '&gt;', $this->tratamiento_fecha_ultima_reclamacion_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_fecha_ultima_reclamacion_tratamiento . "</td>\r\n";
   }
   //----- tratamiento_otros_operadores_tratamiento
   function NM_export_tratamiento_otros_operadores_tratamiento()
   {
         $this->tratamiento_otros_operadores_tratamiento = html_entity_decode($this->tratamiento_otros_operadores_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_otros_operadores_tratamiento = strip_tags($this->tratamiento_otros_operadores_tratamiento);
         if (!NM_is_utf8($this->tratamiento_otros_operadores_tratamiento))
         {
             $this->tratamiento_otros_operadores_tratamiento = sc_convert_encoding($this->tratamiento_otros_operadores_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_otros_operadores_tratamiento = str_replace('<', '&lt;', $this->tratamiento_otros_operadores_tratamiento);
         $this->tratamiento_otros_operadores_tratamiento = str_replace('>', '&gt;', $this->tratamiento_otros_operadores_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_otros_operadores_tratamiento . "</td>\r\n";
   }
   //----- tratamiento_medios_adquisicion_tratamiento
   function NM_export_tratamiento_medios_adquisicion_tratamiento()
   {
         $this->tratamiento_medios_adquisicion_tratamiento = html_entity_decode($this->tratamiento_medios_adquisicion_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_medios_adquisicion_tratamiento = strip_tags($this->tratamiento_medios_adquisicion_tratamiento);
         if (!NM_is_utf8($this->tratamiento_medios_adquisicion_tratamiento))
         {
             $this->tratamiento_medios_adquisicion_tratamiento = sc_convert_encoding($this->tratamiento_medios_adquisicion_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_medios_adquisicion_tratamiento = str_replace('<', '&lt;', $this->tratamiento_medios_adquisicion_tratamiento);
         $this->tratamiento_medios_adquisicion_tratamiento = str_replace('>', '&gt;', $this->tratamiento_medios_adquisicion_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_medios_adquisicion_tratamiento . "</td>\r\n";
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
         $this->tratamiento_ips_atiende_tratamiento = str_replace('<', '&lt;', $this->tratamiento_ips_atiende_tratamiento);
         $this->tratamiento_ips_atiende_tratamiento = str_replace('>', '&gt;', $this->tratamiento_ips_atiende_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_ips_atiende_tratamiento . "</td>\r\n";
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
         $this->tratamiento_medico_tratamiento = str_replace('<', '&lt;', $this->tratamiento_medico_tratamiento);
         $this->tratamiento_medico_tratamiento = str_replace('>', '&gt;', $this->tratamiento_medico_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_medico_tratamiento . "</td>\r\n";
   }
   //----- tratamiento_especialidad_tratamiento
   function NM_export_tratamiento_especialidad_tratamiento()
   {
         $this->tratamiento_especialidad_tratamiento = html_entity_decode($this->tratamiento_especialidad_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_especialidad_tratamiento = strip_tags($this->tratamiento_especialidad_tratamiento);
         if (!NM_is_utf8($this->tratamiento_especialidad_tratamiento))
         {
             $this->tratamiento_especialidad_tratamiento = sc_convert_encoding($this->tratamiento_especialidad_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_especialidad_tratamiento = str_replace('<', '&lt;', $this->tratamiento_especialidad_tratamiento);
         $this->tratamiento_especialidad_tratamiento = str_replace('>', '&gt;', $this->tratamiento_especialidad_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_especialidad_tratamiento . "</td>\r\n";
   }
   //----- tratamiento_paramedico_tratamiento
   function NM_export_tratamiento_paramedico_tratamiento()
   {
         $this->tratamiento_paramedico_tratamiento = html_entity_decode($this->tratamiento_paramedico_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_paramedico_tratamiento = strip_tags($this->tratamiento_paramedico_tratamiento);
         if (!NM_is_utf8($this->tratamiento_paramedico_tratamiento))
         {
             $this->tratamiento_paramedico_tratamiento = sc_convert_encoding($this->tratamiento_paramedico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_paramedico_tratamiento = str_replace('<', '&lt;', $this->tratamiento_paramedico_tratamiento);
         $this->tratamiento_paramedico_tratamiento = str_replace('>', '&gt;', $this->tratamiento_paramedico_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_paramedico_tratamiento . "</td>\r\n";
   }
   //----- tratamiento_zona_atencion_paramedico_tratamiento
   function NM_export_tratamiento_zona_atencion_paramedico_tratamiento()
   {
         $this->tratamiento_zona_atencion_paramedico_tratamiento = html_entity_decode($this->tratamiento_zona_atencion_paramedico_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_zona_atencion_paramedico_tratamiento = strip_tags($this->tratamiento_zona_atencion_paramedico_tratamiento);
         if (!NM_is_utf8($this->tratamiento_zona_atencion_paramedico_tratamiento))
         {
             $this->tratamiento_zona_atencion_paramedico_tratamiento = sc_convert_encoding($this->tratamiento_zona_atencion_paramedico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_zona_atencion_paramedico_tratamiento = str_replace('<', '&lt;', $this->tratamiento_zona_atencion_paramedico_tratamiento);
         $this->tratamiento_zona_atencion_paramedico_tratamiento = str_replace('>', '&gt;', $this->tratamiento_zona_atencion_paramedico_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_zona_atencion_paramedico_tratamiento . "</td>\r\n";
   }
   //----- tratamiento_ciudad_base_paramedico_tratamiento
   function NM_export_tratamiento_ciudad_base_paramedico_tratamiento()
   {
         $this->tratamiento_ciudad_base_paramedico_tratamiento = html_entity_decode($this->tratamiento_ciudad_base_paramedico_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_ciudad_base_paramedico_tratamiento = strip_tags($this->tratamiento_ciudad_base_paramedico_tratamiento);
         if (!NM_is_utf8($this->tratamiento_ciudad_base_paramedico_tratamiento))
         {
             $this->tratamiento_ciudad_base_paramedico_tratamiento = sc_convert_encoding($this->tratamiento_ciudad_base_paramedico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_ciudad_base_paramedico_tratamiento = str_replace('<', '&lt;', $this->tratamiento_ciudad_base_paramedico_tratamiento);
         $this->tratamiento_ciudad_base_paramedico_tratamiento = str_replace('>', '&gt;', $this->tratamiento_ciudad_base_paramedico_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_ciudad_base_paramedico_tratamiento . "</td>\r\n";
   }
   //----- tratamiento_notas_adjuntos_tratamiento
   function NM_export_tratamiento_notas_adjuntos_tratamiento()
   {
         $this->tratamiento_notas_adjuntos_tratamiento = html_entity_decode($this->tratamiento_notas_adjuntos_tratamiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tratamiento_notas_adjuntos_tratamiento = strip_tags($this->tratamiento_notas_adjuntos_tratamiento);
         if (!NM_is_utf8($this->tratamiento_notas_adjuntos_tratamiento))
         {
             $this->tratamiento_notas_adjuntos_tratamiento = sc_convert_encoding($this->tratamiento_notas_adjuntos_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tratamiento_notas_adjuntos_tratamiento = str_replace('<', '&lt;', $this->tratamiento_notas_adjuntos_tratamiento);
         $this->tratamiento_notas_adjuntos_tratamiento = str_replace('>', '&gt;', $this->tratamiento_notas_adjuntos_tratamiento);
         $this->texto_tag .= "<td>" . $this->tratamiento_notas_adjuntos_tratamiento . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Listado Pacientes :: RTF</TITLE>
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
<form name="Fdown" method="get" action="lis_pacientes_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="lis_pacientes"> 
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

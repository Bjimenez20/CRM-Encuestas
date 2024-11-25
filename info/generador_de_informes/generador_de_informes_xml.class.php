<?php

class generador_de_informes_xml
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
   function generador_de_informes_xml()
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
      $this->arquivo     .= "_generador_de_informes";
      $this->arquivo_view = $this->arquivo . "_view.xml";
      $this->arquivo     .= ".xml";
      $this->tit_doc      = "generador_de_informes.xml";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['generador_de_informes']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['generador_de_informes']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['generador_de_informes']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->pacientes_fecha_activacion_paciente = $Busca_temp['pacientes_fecha_activacion_paciente']; 
          $tmp_pos = strpos($this->pacientes_fecha_activacion_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_fecha_activacion_paciente = substr($this->pacientes_fecha_activacion_paciente, 0, $tmp_pos);
          }
          $this->gestiones_fecha_comunicacion = $Busca_temp['gestiones_fecha_comunicacion']; 
          $tmp_pos = strpos($this->gestiones_fecha_comunicacion, "##@@");
          if ($tmp_pos !== false)
          {
              $this->gestiones_fecha_comunicacion = substr($this->gestiones_fecha_comunicacion, 0, $tmp_pos);
          }
          $this->gestiones_fecha_comunicacion_2 = $Busca_temp['gestiones_fecha_comunicacion_input_2']; 
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['xml_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['xml_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['xml_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->arquivo_view = $this->arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44, tratamiento.ID_PACIENTE_FK as cmp_maior_30_45, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_46, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_47, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_48, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_49, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_50, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_51, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_52, gestiones.ESPERADO_GESTION as cmp_maior_30_53, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_54, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_55, gestiones.RECLAMO_GESTION as cmp_maior_30_56, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_57, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_58, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_59, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_60, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_61, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_62, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_63, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_64, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_65, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_66, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_67, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_68, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_69, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_70, gestiones.USUARIO_ASIGANDO as cmp_maior_30_71, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_72, gestiones.FECHA_COMUNICACION as cmp_maior_30_73, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.NUMERO_CAJAS as gestiones_numero_cajas from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44, tratamiento.ID_PACIENTE_FK as cmp_maior_30_45, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_46, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_47, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_48, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_49, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_50, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_51, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_52, gestiones.ESPERADO_GESTION as cmp_maior_30_53, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_54, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_55, gestiones.RECLAMO_GESTION as cmp_maior_30_56, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_57, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_58, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_59, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_60, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_61, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_62, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_63, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_64, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_65, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_66, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_67, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_68, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_69, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_70, gestiones.USUARIO_ASIGANDO as cmp_maior_30_71, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_72, gestiones.FECHA_COMUNICACION as cmp_maior_30_73, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.NUMERO_CAJAS as gestiones_numero_cajas from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44, tratamiento.ID_PACIENTE_FK as cmp_maior_30_45, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_46, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_47, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_48, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_49, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_50, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_51, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_52, gestiones.ESPERADO_GESTION as cmp_maior_30_53, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_54, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_55, gestiones.RECLAMO_GESTION as cmp_maior_30_56, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_57, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_58, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_59, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_60, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_61, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_62, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_63, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_64, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_65, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_66, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_67, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_68, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_69, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_70, gestiones.USUARIO_ASIGANDO as cmp_maior_30_71, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_72, gestiones.FECHA_COMUNICACION as cmp_maior_30_73, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.NUMERO_CAJAS as gestiones_numero_cajas from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44, tratamiento.ID_PACIENTE_FK as cmp_maior_30_45, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_46, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_47, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_48, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_49, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_50, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_51, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_52, gestiones.ESPERADO_GESTION as cmp_maior_30_53, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_54, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_55, gestiones.RECLAMO_GESTION as cmp_maior_30_56, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_57, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_58, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_59, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_60, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_61, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_62, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_63, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_64, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_65, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_66, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_67, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_68, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_69, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_70, gestiones.USUARIO_ASIGANDO as cmp_maior_30_71, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_72, TO_DATE(TO_CHAR(gestiones.FECHA_COMUNICACION, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss') as cmp_maior_30_73, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.NUMERO_CAJAS as gestiones_numero_cajas from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44, tratamiento.ID_PACIENTE_FK as cmp_maior_30_45, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_46, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_47, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_48, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_49, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_50, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_51, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_52, gestiones.ESPERADO_GESTION as cmp_maior_30_53, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_54, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_55, gestiones.RECLAMO_GESTION as cmp_maior_30_56, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_57, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_58, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_59, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_60, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_61, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_62, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_63, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_64, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_65, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_66, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_67, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_68, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, LOTOFILE(gestiones.DESCRIPCION_COMUNICACION_GESTION, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as cmp_maior_30_69, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_70, gestiones.USUARIO_ASIGANDO as cmp_maior_30_71, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_72, gestiones.FECHA_COMUNICACION as cmp_maior_30_73, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.NUMERO_CAJAS as gestiones_numero_cajas from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44, tratamiento.ID_PACIENTE_FK as cmp_maior_30_45, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_46, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_47, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_48, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_49, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_50, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_51, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_52, gestiones.ESPERADO_GESTION as cmp_maior_30_53, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_54, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_55, gestiones.RECLAMO_GESTION as cmp_maior_30_56, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_57, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_58, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_59, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_60, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_61, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_62, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_63, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_64, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_65, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_66, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_67, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_68, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_69, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_70, gestiones.USUARIO_ASIGANDO as cmp_maior_30_71, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_72, gestiones.FECHA_COMUNICACION as cmp_maior_30_73, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.NUMERO_CAJAS as gestiones_numero_cajas from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['order_grid'];
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
         $this->xml_registro = "<generador_de_informes";
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
         $this->tratamiento_id_paciente_fk = $rs->fields[47] ;  
         $this->tratamiento_id_paciente_fk = (string)$this->tratamiento_id_paciente_fk;
         $this->gestiones_fecha_reclamacion_gestion = $rs->fields[48] ;  
         $this->gestiones_id_gestion = $rs->fields[49] ;  
         $this->gestiones_id_gestion = (string)$this->gestiones_id_gestion;
         $this->gestiones_motivo_comunicacion_gestion = $rs->fields[50] ;  
         $this->gestiones_medio_contacto_gestion = $rs->fields[51] ;  
         $this->gestiones_tipo_llamada_gestion = $rs->fields[52] ;  
         $this->gestiones_logro_comunicacion_gestion = $rs->fields[53] ;  
         $this->gestiones_motivo_no_comunicacion_gestion = $rs->fields[54] ;  
         $this->gestiones_numero_intentos_gestion = $rs->fields[55] ;  
         $this->gestiones_esperado_gestion = $rs->fields[56] ;  
         $this->gestiones_estado_ctc_gestion = $rs->fields[57] ;  
         $this->gestiones_estado_farmacia_gestion = $rs->fields[58] ;  
         $this->gestiones_reclamo_gestion = $rs->fields[59] ;  
         $this->gestiones_causa_no_reclamacion_gestion = $rs->fields[60] ;  
         $this->gestiones_dificultad_acceso_gestion = $rs->fields[61] ;  
         $this->gestiones_tipo_dificultad_gestion = $rs->fields[62] ;  
         $this->gestiones_envios_gestion = $rs->fields[63] ;  
         $this->gestiones_medicamentos_gestion = $rs->fields[64] ;  
         $this->gestiones_tipo_envio_gestion = $rs->fields[65] ;  
         $this->gestiones_evento_adverso_gestion = $rs->fields[66] ;  
         $this->gestiones_tipo_evento_adverso = $rs->fields[67] ;  
         $this->gestiones_genera_solicitud_gestion = $rs->fields[68] ;  
         $this->gestiones_fecha_proxima_llamada = $rs->fields[69] ;  
         $this->gestiones_motivo_proxima_llamada = $rs->fields[70] ;  
         $this->gestiones_observacion_proxima_llamada = $rs->fields[71] ;  
         $this->gestiones_consecutivo_gestion = $rs->fields[72] ;  
         $this->gestiones_autor_gestion = $rs->fields[73] ;  
         $this->gestiones_nota = $rs->fields[74] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->gestiones_descripcion_comunicacion_gestion = "";  
              if (is_file($rs_grid->fields[75])) 
              { 
                  $this->gestiones_descripcion_comunicacion_gestion = file_get_contents($rs_grid->fields[75]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->gestiones_descripcion_comunicacion_gestion = $this->Db->BlobDecode($rs->fields[75]) ;  
         } 
         else
         { 
             $this->gestiones_descripcion_comunicacion_gestion = $rs->fields[75] ;  
         } 
         $this->gestiones_fecha_programada_gestion = $rs->fields[76] ;  
         $this->gestiones_usuario_asigando = $rs->fields[77] ;  
         $this->gestiones_id_paciente_fk2 = $rs->fields[78] ;  
         $this->gestiones_id_paciente_fk2 = (string)$this->gestiones_id_paciente_fk2;
         $this->gestiones_fecha_comunicacion = $rs->fields[79] ;  
         $this->gestiones_estado_gestion = $rs->fields[80] ;  
         $this->gestiones_codigo_argus = $rs->fields[81] ;  
         $this->gestiones_numero_cajas = $rs->fields[82] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['field_order'] as $Cada_col)
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
   //----- pacientes_estado_paciente
   function NM_export_pacientes_estado_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_estado_paciente))
         {
             $this->pacientes_estado_paciente = sc_convert_encoding($this->pacientes_estado_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_estado_paciente =\"" . $this->trata_dados($this->pacientes_estado_paciente) . "\"";
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
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_fecha_activacion_paciente))
         {
             $this->pacientes_fecha_activacion_paciente = sc_convert_encoding($this->pacientes_fecha_activacion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_fecha_activacion_paciente =\"" . $this->trata_dados($this->pacientes_fecha_activacion_paciente) . "\"";
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
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_fecha_retiro_paciente))
         {
             $this->pacientes_fecha_retiro_paciente = sc_convert_encoding($this->pacientes_fecha_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_fecha_retiro_paciente =\"" . $this->trata_dados($this->pacientes_fecha_retiro_paciente) . "\"";
   }
   //----- pacientes_motivo_retiro_paciente
   function NM_export_pacientes_motivo_retiro_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_motivo_retiro_paciente))
         {
             $this->pacientes_motivo_retiro_paciente = sc_convert_encoding($this->pacientes_motivo_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_motivo_retiro_paciente =\"" . $this->trata_dados($this->pacientes_motivo_retiro_paciente) . "\"";
   }
   //----- pacientes_observacion_motivo_retiro_paciente
   function NM_export_pacientes_observacion_motivo_retiro_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_observacion_motivo_retiro_paciente))
         {
             $this->pacientes_observacion_motivo_retiro_paciente = sc_convert_encoding($this->pacientes_observacion_motivo_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_observacion_motivo_retiro_paciente =\"" . $this->trata_dados($this->pacientes_observacion_motivo_retiro_paciente) . "\"";
   }
   //----- pacientes_identificacion_paciente
   function NM_export_pacientes_identificacion_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_identificacion_paciente))
         {
             $this->pacientes_identificacion_paciente = sc_convert_encoding($this->pacientes_identificacion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_identificacion_paciente =\"" . $this->trata_dados($this->pacientes_identificacion_paciente) . "\"";
   }
   //----- pacientes_nombre_paciente
   function NM_export_pacientes_nombre_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_nombre_paciente))
         {
             $this->pacientes_nombre_paciente = sc_convert_encoding($this->pacientes_nombre_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_nombre_paciente =\"" . $this->trata_dados($this->pacientes_nombre_paciente) . "\"";
   }
   //----- pacientes_apellido_paciente
   function NM_export_pacientes_apellido_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_apellido_paciente))
         {
             $this->pacientes_apellido_paciente = sc_convert_encoding($this->pacientes_apellido_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_apellido_paciente =\"" . $this->trata_dados($this->pacientes_apellido_paciente) . "\"";
   }
   //----- pacientes_telefono_paciente
   function NM_export_pacientes_telefono_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_telefono_paciente))
         {
             $this->pacientes_telefono_paciente = sc_convert_encoding($this->pacientes_telefono_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_telefono_paciente =\"" . $this->trata_dados($this->pacientes_telefono_paciente) . "\"";
   }
   //----- pacientes_telefono2_paciente
   function NM_export_pacientes_telefono2_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_telefono2_paciente))
         {
             $this->pacientes_telefono2_paciente = sc_convert_encoding($this->pacientes_telefono2_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_telefono2_paciente =\"" . $this->trata_dados($this->pacientes_telefono2_paciente) . "\"";
   }
   //----- pacientes_telefono3_paciente
   function NM_export_pacientes_telefono3_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_telefono3_paciente))
         {
             $this->pacientes_telefono3_paciente = sc_convert_encoding($this->pacientes_telefono3_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_telefono3_paciente =\"" . $this->trata_dados($this->pacientes_telefono3_paciente) . "\"";
   }
   //----- pacientes_correo_paciente
   function NM_export_pacientes_correo_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_correo_paciente))
         {
             $this->pacientes_correo_paciente = sc_convert_encoding($this->pacientes_correo_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_correo_paciente =\"" . $this->trata_dados($this->pacientes_correo_paciente) . "\"";
   }
   //----- pacientes_direccion_paciente
   function NM_export_pacientes_direccion_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_direccion_paciente))
         {
             $this->pacientes_direccion_paciente = sc_convert_encoding($this->pacientes_direccion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_direccion_paciente =\"" . $this->trata_dados($this->pacientes_direccion_paciente) . "\"";
   }
   //----- pacientes_barrio_paciente
   function NM_export_pacientes_barrio_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_barrio_paciente))
         {
             $this->pacientes_barrio_paciente = sc_convert_encoding($this->pacientes_barrio_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_barrio_paciente =\"" . $this->trata_dados($this->pacientes_barrio_paciente) . "\"";
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
   //----- pacientes_genero_paciente
   function NM_export_pacientes_genero_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_genero_paciente))
         {
             $this->pacientes_genero_paciente = sc_convert_encoding($this->pacientes_genero_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_genero_paciente =\"" . $this->trata_dados($this->pacientes_genero_paciente) . "\"";
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
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_fecha_nacimineto_paciente))
         {
             $this->pacientes_fecha_nacimineto_paciente = sc_convert_encoding($this->pacientes_fecha_nacimineto_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_fecha_nacimineto_paciente =\"" . $this->trata_dados($this->pacientes_fecha_nacimineto_paciente) . "\"";
   }
   //----- pacientes_edad_paciente
   function NM_export_pacientes_edad_paciente()
   {
         nmgp_Form_Num_Val($this->pacientes_edad_paciente, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_edad_paciente))
         {
             $this->pacientes_edad_paciente = sc_convert_encoding($this->pacientes_edad_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_edad_paciente =\"" . $this->trata_dados($this->pacientes_edad_paciente) . "\"";
   }
   //----- pacientes_acudiente_paciente
   function NM_export_pacientes_acudiente_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_acudiente_paciente))
         {
             $this->pacientes_acudiente_paciente = sc_convert_encoding($this->pacientes_acudiente_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_acudiente_paciente =\"" . $this->trata_dados($this->pacientes_acudiente_paciente) . "\"";
   }
   //----- pacientes_telefono_acudiente_paciente
   function NM_export_pacientes_telefono_acudiente_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_telefono_acudiente_paciente))
         {
             $this->pacientes_telefono_acudiente_paciente = sc_convert_encoding($this->pacientes_telefono_acudiente_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_telefono_acudiente_paciente =\"" . $this->trata_dados($this->pacientes_telefono_acudiente_paciente) . "\"";
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
   //----- pacientes_status_paciente
   function NM_export_pacientes_status_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_status_paciente))
         {
             $this->pacientes_status_paciente = sc_convert_encoding($this->pacientes_status_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_status_paciente =\"" . $this->trata_dados($this->pacientes_status_paciente) . "\"";
   }
   //----- pacientes_id_ultima_gestion
   function NM_export_pacientes_id_ultima_gestion()
   {
         nmgp_Form_Num_Val($this->pacientes_id_ultima_gestion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_id_ultima_gestion))
         {
             $this->pacientes_id_ultima_gestion = sc_convert_encoding($this->pacientes_id_ultima_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_id_ultima_gestion =\"" . $this->trata_dados($this->pacientes_id_ultima_gestion) . "\"";
   }
   //----- pacientes_usuario_creacion
   function NM_export_pacientes_usuario_creacion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_usuario_creacion))
         {
             $this->pacientes_usuario_creacion = sc_convert_encoding($this->pacientes_usuario_creacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_usuario_creacion =\"" . $this->trata_dados($this->pacientes_usuario_creacion) . "\"";
   }
   //----- tratamiento_id_tratamiento
   function NM_export_tratamiento_id_tratamiento()
   {
         nmgp_Form_Num_Val($this->tratamiento_id_tratamiento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_id_tratamiento))
         {
             $this->tratamiento_id_tratamiento = sc_convert_encoding($this->tratamiento_id_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_id_tratamiento =\"" . $this->trata_dados($this->tratamiento_id_tratamiento) . "\"";
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
   //----- tratamiento_clasificacion_patologica_tratamiento
   function NM_export_tratamiento_clasificacion_patologica_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_clasificacion_patologica_tratamiento))
         {
             $this->tratamiento_clasificacion_patologica_tratamiento = sc_convert_encoding($this->tratamiento_clasificacion_patologica_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_clasificacion_patologica_tratamiento =\"" . $this->trata_dados($this->tratamiento_clasificacion_patologica_tratamiento) . "\"";
   }
   //----- tratamiento_tratamiento_previo
   function NM_export_tratamiento_tratamiento_previo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_tratamiento_previo))
         {
             $this->tratamiento_tratamiento_previo = sc_convert_encoding($this->tratamiento_tratamiento_previo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_tratamiento_previo =\"" . $this->trata_dados($this->tratamiento_tratamiento_previo) . "\"";
   }
   //----- tratamiento_consentimiento_tratamiento
   function NM_export_tratamiento_consentimiento_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_consentimiento_tratamiento))
         {
             $this->tratamiento_consentimiento_tratamiento = sc_convert_encoding($this->tratamiento_consentimiento_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_consentimiento_tratamiento =\"" . $this->trata_dados($this->tratamiento_consentimiento_tratamiento) . "\"";
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
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_fecha_inicio_terapia_tratamiento))
         {
             $this->tratamiento_fecha_inicio_terapia_tratamiento = sc_convert_encoding($this->tratamiento_fecha_inicio_terapia_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_fecha_inicio_terapia_tratamiento =\"" . $this->trata_dados($this->tratamiento_fecha_inicio_terapia_tratamiento) . "\"";
   }
   //----- tratamiento_regimen_tratamiento
   function NM_export_tratamiento_regimen_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_regimen_tratamiento))
         {
             $this->tratamiento_regimen_tratamiento = sc_convert_encoding($this->tratamiento_regimen_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_regimen_tratamiento =\"" . $this->trata_dados($this->tratamiento_regimen_tratamiento) . "\"";
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
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_fecha_ultima_reclamacion_tratamiento))
         {
             $this->tratamiento_fecha_ultima_reclamacion_tratamiento = sc_convert_encoding($this->tratamiento_fecha_ultima_reclamacion_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_fecha_ultima_reclamacion_tratamiento =\"" . $this->trata_dados($this->tratamiento_fecha_ultima_reclamacion_tratamiento) . "\"";
   }
   //----- tratamiento_otros_operadores_tratamiento
   function NM_export_tratamiento_otros_operadores_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_otros_operadores_tratamiento))
         {
             $this->tratamiento_otros_operadores_tratamiento = sc_convert_encoding($this->tratamiento_otros_operadores_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_otros_operadores_tratamiento =\"" . $this->trata_dados($this->tratamiento_otros_operadores_tratamiento) . "\"";
   }
   //----- tratamiento_medios_adquisicion_tratamiento
   function NM_export_tratamiento_medios_adquisicion_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_medios_adquisicion_tratamiento))
         {
             $this->tratamiento_medios_adquisicion_tratamiento = sc_convert_encoding($this->tratamiento_medios_adquisicion_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_medios_adquisicion_tratamiento =\"" . $this->trata_dados($this->tratamiento_medios_adquisicion_tratamiento) . "\"";
   }
   //----- tratamiento_ips_atiende_tratamiento
   function NM_export_tratamiento_ips_atiende_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_ips_atiende_tratamiento))
         {
             $this->tratamiento_ips_atiende_tratamiento = sc_convert_encoding($this->tratamiento_ips_atiende_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_ips_atiende_tratamiento =\"" . $this->trata_dados($this->tratamiento_ips_atiende_tratamiento) . "\"";
   }
   //----- tratamiento_medico_tratamiento
   function NM_export_tratamiento_medico_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_medico_tratamiento))
         {
             $this->tratamiento_medico_tratamiento = sc_convert_encoding($this->tratamiento_medico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_medico_tratamiento =\"" . $this->trata_dados($this->tratamiento_medico_tratamiento) . "\"";
   }
   //----- tratamiento_especialidad_tratamiento
   function NM_export_tratamiento_especialidad_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_especialidad_tratamiento))
         {
             $this->tratamiento_especialidad_tratamiento = sc_convert_encoding($this->tratamiento_especialidad_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_especialidad_tratamiento =\"" . $this->trata_dados($this->tratamiento_especialidad_tratamiento) . "\"";
   }
   //----- tratamiento_paramedico_tratamiento
   function NM_export_tratamiento_paramedico_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_paramedico_tratamiento))
         {
             $this->tratamiento_paramedico_tratamiento = sc_convert_encoding($this->tratamiento_paramedico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_paramedico_tratamiento =\"" . $this->trata_dados($this->tratamiento_paramedico_tratamiento) . "\"";
   }
   //----- tratamiento_zona_atencion_paramedico_tratamiento
   function NM_export_tratamiento_zona_atencion_paramedico_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_zona_atencion_paramedico_tratamiento))
         {
             $this->tratamiento_zona_atencion_paramedico_tratamiento = sc_convert_encoding($this->tratamiento_zona_atencion_paramedico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_zona_atencion_paramedico_tratamiento =\"" . $this->trata_dados($this->tratamiento_zona_atencion_paramedico_tratamiento) . "\"";
   }
   //----- tratamiento_ciudad_base_paramedico_tratamiento
   function NM_export_tratamiento_ciudad_base_paramedico_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_ciudad_base_paramedico_tratamiento))
         {
             $this->tratamiento_ciudad_base_paramedico_tratamiento = sc_convert_encoding($this->tratamiento_ciudad_base_paramedico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_ciudad_base_paramedico_tratamiento =\"" . $this->trata_dados($this->tratamiento_ciudad_base_paramedico_tratamiento) . "\"";
   }
   //----- tratamiento_notas_adjuntos_tratamiento
   function NM_export_tratamiento_notas_adjuntos_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_notas_adjuntos_tratamiento))
         {
             $this->tratamiento_notas_adjuntos_tratamiento = sc_convert_encoding($this->tratamiento_notas_adjuntos_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_notas_adjuntos_tratamiento =\"" . $this->trata_dados($this->tratamiento_notas_adjuntos_tratamiento) . "\"";
   }
   //----- tratamiento_id_paciente_fk
   function NM_export_tratamiento_id_paciente_fk()
   {
         nmgp_Form_Num_Val($this->tratamiento_id_paciente_fk, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_id_paciente_fk))
         {
             $this->tratamiento_id_paciente_fk = sc_convert_encoding($this->tratamiento_id_paciente_fk, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_id_paciente_fk =\"" . $this->trata_dados($this->tratamiento_id_paciente_fk) . "\"";
   }
   //----- gestiones_fecha_reclamacion_gestion
   function NM_export_gestiones_fecha_reclamacion_gestion()
   {
         $conteudo_x =  $this->gestiones_fecha_reclamacion_gestion;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->gestiones_fecha_reclamacion_gestion, "");
             $this->gestiones_fecha_reclamacion_gestion = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_fecha_reclamacion_gestion))
         {
             $this->gestiones_fecha_reclamacion_gestion = sc_convert_encoding($this->gestiones_fecha_reclamacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_fecha_reclamacion_gestion =\"" . $this->trata_dados($this->gestiones_fecha_reclamacion_gestion) . "\"";
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
         $conteudo_x =  $this->gestiones_fecha_proxima_llamada;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->gestiones_fecha_proxima_llamada, "");
             $this->gestiones_fecha_proxima_llamada = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
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
         $conteudo_x =  $this->gestiones_fecha_programada_gestion;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->gestiones_fecha_programada_gestion, "");
             $this->gestiones_fecha_programada_gestion = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
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
   //----- gestiones_numero_cajas
   function NM_export_gestiones_numero_cajas()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->gestiones_numero_cajas))
         {
             $this->gestiones_numero_cajas = sc_convert_encoding($this->gestiones_numero_cajas, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " gestiones_numero_cajas =\"" . $this->trata_dados($this->gestiones_numero_cajas) . "\"";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Generador de Informes :: XML</TITLE>
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
<form name="Fdown" method="get" action="generador_de_informes_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="generador_de_informes"> 
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

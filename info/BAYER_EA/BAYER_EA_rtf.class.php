<?php

class EA_rtf
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
   function EA_rtf()
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
      $this->arquivo   .= "_EA";
      $this->arquivo   .= ".rtf";
      $this->tit_doc    = "EA.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['EA']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['EA']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['EA']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->evento_adverso_fecha_staff = $Busca_temp['evento_adverso_fecha_staff']; 
          $tmp_pos = strpos($this->evento_adverso_fecha_staff, "##@@");
          if ($tmp_pos !== false)
          {
              $this->evento_adverso_fecha_staff = substr($this->evento_adverso_fecha_staff, 0, $tmp_pos);
          }
          $this->evento_adverso_id_evento_adverso = $Busca_temp['evento_adverso_id_evento_adverso']; 
          $tmp_pos = strpos($this->evento_adverso_id_evento_adverso, "##@@");
          if ($tmp_pos !== false)
          {
              $this->evento_adverso_id_evento_adverso = substr($this->evento_adverso_id_evento_adverso, 0, $tmp_pos);
          }
          $this->evento_adverso_id_evento_adverso_2 = $Busca_temp['evento_adverso_id_evento_adverso_input_2']; 
          $this->evento_adverso_pais = $Busca_temp['evento_adverso_pais']; 
          $tmp_pos = strpos($this->evento_adverso_pais, "##@@");
          if ($tmp_pos !== false)
          {
              $this->evento_adverso_pais = substr($this->evento_adverso_pais, 0, $tmp_pos);
          }
          $this->evento_adverso_tipo_reporte = $Busca_temp['evento_adverso_tipo_reporte']; 
          $tmp_pos = strpos($this->evento_adverso_tipo_reporte, "##@@");
          if ($tmp_pos !== false)
          {
              $this->evento_adverso_tipo_reporte = substr($this->evento_adverso_tipo_reporte, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['rtf_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['rtf_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['rtf_name']);
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, evento_adverso.PAIS as evento_adverso_pais, evento_adverso.TIPO_REPORTE as cmp_maior_30_2, evento_adverso.FECHA_STAFF as cmp_maior_30_3, evento_adverso.PRODUCTO as evento_adverso_producto, evento_adverso.CIUDAD as evento_adverso_ciudad, evento_adverso.GENERO as evento_adverso_genero, evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, evento_adverso.EMBARAZO as evento_adverso_embarazo, evento_adverso.FECHA_PARTO as cmp_maior_30_5, evento_adverso.DESENLACE as evento_adverso_desenlace, evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, evento_adverso.FAX_MEDICO as cmp_maior_30_10, evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, evento_adverso.INDICACION1 as cmp_maior_30_12, evento_adverso.FORMULACION1 as cmp_maior_30_13, evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, evento_adverso.INDICACION2 as cmp_maior_30_20, evento_adverso.FORMULACION2 as cmp_maior_30_21, evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, evento_adverso.INDICACION3 as cmp_maior_30_28, evento_adverso.FORMULACION3 as cmp_maior_30_29, evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, evento_adverso.DESENLACE1 as cmp_maior_30_41, evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, evento_adverso.DETALLES_EA1 as cmp_maior_30_53, evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, evento_adverso.DESENLACE2 as cmp_maior_30_57, evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, evento_adverso.DETALLES_EA2 as cmp_maior_30_69, evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, evento_adverso.DESENLACE3 as cmp_maior_30_73, evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, evento_adverso.DETALLES_EA3 as cmp_maior_30_85, evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, evento_adverso.PAIS as evento_adverso_pais, evento_adverso.TIPO_REPORTE as cmp_maior_30_2, evento_adverso.FECHA_STAFF as cmp_maior_30_3, evento_adverso.PRODUCTO as evento_adverso_producto, evento_adverso.CIUDAD as evento_adverso_ciudad, evento_adverso.GENERO as evento_adverso_genero, evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, evento_adverso.EMBARAZO as evento_adverso_embarazo, evento_adverso.FECHA_PARTO as cmp_maior_30_5, evento_adverso.DESENLACE as evento_adverso_desenlace, evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, evento_adverso.FAX_MEDICO as cmp_maior_30_10, evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, evento_adverso.INDICACION1 as cmp_maior_30_12, evento_adverso.FORMULACION1 as cmp_maior_30_13, evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, evento_adverso.INDICACION2 as cmp_maior_30_20, evento_adverso.FORMULACION2 as cmp_maior_30_21, evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, evento_adverso.INDICACION3 as cmp_maior_30_28, evento_adverso.FORMULACION3 as cmp_maior_30_29, evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, evento_adverso.DESENLACE1 as cmp_maior_30_41, evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, evento_adverso.DETALLES_EA1 as cmp_maior_30_53, evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, evento_adverso.DESENLACE2 as cmp_maior_30_57, evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, evento_adverso.DETALLES_EA2 as cmp_maior_30_69, evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, evento_adverso.DESENLACE3 as cmp_maior_30_73, evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, evento_adverso.DETALLES_EA3 as cmp_maior_30_85, evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, evento_adverso.PAIS as evento_adverso_pais, evento_adverso.TIPO_REPORTE as cmp_maior_30_2, evento_adverso.FECHA_STAFF as cmp_maior_30_3, evento_adverso.PRODUCTO as evento_adverso_producto, evento_adverso.CIUDAD as evento_adverso_ciudad, evento_adverso.GENERO as evento_adverso_genero, evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, evento_adverso.EMBARAZO as evento_adverso_embarazo, evento_adverso.FECHA_PARTO as cmp_maior_30_5, evento_adverso.DESENLACE as evento_adverso_desenlace, evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, evento_adverso.FAX_MEDICO as cmp_maior_30_10, evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, evento_adverso.INDICACION1 as cmp_maior_30_12, evento_adverso.FORMULACION1 as cmp_maior_30_13, evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, evento_adverso.INDICACION2 as cmp_maior_30_20, evento_adverso.FORMULACION2 as cmp_maior_30_21, evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, evento_adverso.INDICACION3 as cmp_maior_30_28, evento_adverso.FORMULACION3 as cmp_maior_30_29, evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, evento_adverso.DESENLACE1 as cmp_maior_30_41, evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, evento_adverso.DETALLES_EA1 as cmp_maior_30_53, evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, evento_adverso.DESENLACE2 as cmp_maior_30_57, evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, evento_adverso.DETALLES_EA2 as cmp_maior_30_69, evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, evento_adverso.DESENLACE3 as cmp_maior_30_73, evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, evento_adverso.DETALLES_EA3 as cmp_maior_30_85, evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, evento_adverso.PAIS as evento_adverso_pais, evento_adverso.TIPO_REPORTE as cmp_maior_30_2, evento_adverso.FECHA_STAFF as cmp_maior_30_3, evento_adverso.PRODUCTO as evento_adverso_producto, evento_adverso.CIUDAD as evento_adverso_ciudad, evento_adverso.GENERO as evento_adverso_genero, evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, evento_adverso.EMBARAZO as evento_adverso_embarazo, evento_adverso.FECHA_PARTO as cmp_maior_30_5, evento_adverso.DESENLACE as evento_adverso_desenlace, evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, evento_adverso.FAX_MEDICO as cmp_maior_30_10, evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, evento_adverso.INDICACION1 as cmp_maior_30_12, evento_adverso.FORMULACION1 as cmp_maior_30_13, evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, evento_adverso.INDICACION2 as cmp_maior_30_20, evento_adverso.FORMULACION2 as cmp_maior_30_21, evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, evento_adverso.INDICACION3 as cmp_maior_30_28, evento_adverso.FORMULACION3 as cmp_maior_30_29, evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, evento_adverso.DESENLACE1 as cmp_maior_30_41, evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, evento_adverso.DETALLES_EA1 as cmp_maior_30_53, evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, evento_adverso.DESENLACE2 as cmp_maior_30_57, evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, evento_adverso.DETALLES_EA2 as cmp_maior_30_69, evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, evento_adverso.DESENLACE3 as cmp_maior_30_73, evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, evento_adverso.DETALLES_EA3 as cmp_maior_30_85, evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, TO_DATE(TO_CHAR(evento_adverso.FECHA_EVENTO_ADVERSO, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss') as cmp_maior_30_98, evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, evento_adverso.PAIS as evento_adverso_pais, evento_adverso.TIPO_REPORTE as cmp_maior_30_2, evento_adverso.FECHA_STAFF as cmp_maior_30_3, evento_adverso.PRODUCTO as evento_adverso_producto, evento_adverso.CIUDAD as evento_adverso_ciudad, evento_adverso.GENERO as evento_adverso_genero, evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, evento_adverso.EMBARAZO as evento_adverso_embarazo, evento_adverso.FECHA_PARTO as cmp_maior_30_5, evento_adverso.DESENLACE as evento_adverso_desenlace, evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, evento_adverso.FAX_MEDICO as cmp_maior_30_10, evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, evento_adverso.INDICACION1 as cmp_maior_30_12, evento_adverso.FORMULACION1 as cmp_maior_30_13, evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, evento_adverso.INDICACION2 as cmp_maior_30_20, evento_adverso.FORMULACION2 as cmp_maior_30_21, evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, evento_adverso.INDICACION3 as cmp_maior_30_28, evento_adverso.FORMULACION3 as cmp_maior_30_29, evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, LOTOFILE(evento_adverso.INFORMACION_MUESTRA, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as cmp_maior_30_37, evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, evento_adverso.DESENLACE1 as cmp_maior_30_41, evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, evento_adverso.DETALLES_EA1 as cmp_maior_30_53, evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, evento_adverso.DESENLACE2 as cmp_maior_30_57, evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, evento_adverso.DETALLES_EA2 as cmp_maior_30_69, evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, evento_adverso.DESENLACE3 as cmp_maior_30_73, evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, evento_adverso.DETALLES_EA3 as cmp_maior_30_85, LOTOFILE(evento_adverso.INFORMACION_ADICIONAL, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as cmp_maior_30_86, evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT evento_adverso.ID_EVENTO_ADVERSO as cmp_maior_30_1, evento_adverso.PAIS as evento_adverso_pais, evento_adverso.TIPO_REPORTE as cmp_maior_30_2, evento_adverso.FECHA_STAFF as cmp_maior_30_3, evento_adverso.PRODUCTO as evento_adverso_producto, evento_adverso.CIUDAD as evento_adverso_ciudad, evento_adverso.GENERO as evento_adverso_genero, evento_adverso.FECHA_NACIMIENTO as cmp_maior_30_4, evento_adverso.EMBARAZO as evento_adverso_embarazo, evento_adverso.FECHA_PARTO as cmp_maior_30_5, evento_adverso.DESENLACE as evento_adverso_desenlace, evento_adverso.CUALES_DESENLACES as cmp_maior_30_6, evento_adverso.CONTACTO_DIRECTO as cmp_maior_30_7, evento_adverso.NOMBRE_MEDICO as cmp_maior_30_8, evento_adverso.TELEFONO_MEDICO as cmp_maior_30_9, evento_adverso.FAX_MEDICO as cmp_maior_30_10, evento_adverso.EMAIL_MEDICO as cmp_maior_30_11, evento_adverso.INDICACION1 as cmp_maior_30_12, evento_adverso.FORMULACION1 as cmp_maior_30_13, evento_adverso.REGIMEN_DOSIS1 as cmp_maior_30_14, evento_adverso.RUTA_ADMINISTRACION1 as cmp_maior_30_15, evento_adverso.NUMERO_LOTE1 as cmp_maior_30_16, evento_adverso.FECHA_EXPIRACION1 as cmp_maior_30_17, evento_adverso.FECHA_INICIO1 as cmp_maior_30_18, evento_adverso.TRATAMIENTO_CONTINUA1 as cmp_maior_30_19, evento_adverso.INDICACION2 as cmp_maior_30_20, evento_adverso.FORMULACION2 as cmp_maior_30_21, evento_adverso.REGIMEN_DOSIS2 as cmp_maior_30_22, evento_adverso.RUTA_ADMINISTRACION2 as cmp_maior_30_23, evento_adverso.NUMERO_LOTE2 as cmp_maior_30_24, evento_adverso.FECHA_EXPIRACION2 as cmp_maior_30_25, evento_adverso.FECHA_INICIO2 as cmp_maior_30_26, evento_adverso.TRATAMIENTO_CONTINUA2 as cmp_maior_30_27, evento_adverso.INDICACION3 as cmp_maior_30_28, evento_adverso.FORMULACION3 as cmp_maior_30_29, evento_adverso.REGIMEN_DOSIS3 as cmp_maior_30_30, evento_adverso.RUTA_ADMINISTRACION3 as cmp_maior_30_31, evento_adverso.NUMERO_LOTE3 as cmp_maior_30_32, evento_adverso.FECHA_EXPIRACION3 as cmp_maior_30_33, evento_adverso.FECHA_INICIO3 as cmp_maior_30_34, evento_adverso.TRATAMIENTO_CONTINUA3 as cmp_maior_30_35, evento_adverso.MUESTRA_DISPONIBLE as cmp_maior_30_36, evento_adverso.INFORMACION_MUESTRA as cmp_maior_30_37, evento_adverso.RELACION_MEDICAMENTO1 as cmp_maior_30_38, evento_adverso.RELACIONADO_DISPOSITIVO1 as cmp_maior_30_39, evento_adverso.FECHA_INICIO_EVENTO1 as cmp_maior_30_40, evento_adverso.DESENLACE1 as cmp_maior_30_41, evento_adverso.FECHA_RECUPERACION1 as cmp_maior_30_42, evento_adverso.FECHA_MUERTE1 as cmp_maior_30_43, evento_adverso.CRITERIO_SERIEDAD1 as cmp_maior_30_44, evento_adverso.CRITERIO_SERIEDAD_MUERTE1 as cmp_maior_30_45, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION1 as cmp_maior_30_46, evento_adverso.CRITERIO_SERIEDAD_AMENAZA1 as cmp_maior_30_47, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD1 as cmp_maior_30_48, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD1 as cmp_maior_30_49, evento_adverso.CRITERIO_SERIEDAD_EVENTO1 as cmp_maior_30_50, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA1 as cmp_maior_30_51, evento_adverso.CAUSA_MUERTE1 as cmp_maior_30_52, evento_adverso.DETALLES_EA1 as cmp_maior_30_53, evento_adverso.RELACION_MEDICAMENTO2 as cmp_maior_30_54, evento_adverso.RELACIONADO_DISPOSITIVO2 as cmp_maior_30_55, evento_adverso.FECHA_INICIO_EVENTO2 as cmp_maior_30_56, evento_adverso.DESENLACE2 as cmp_maior_30_57, evento_adverso.FECHA_RECUPERACION2 as cmp_maior_30_58, evento_adverso.FECHA_MUERTE2 as cmp_maior_30_59, evento_adverso.CRITERIO_SERIEDAD2 as cmp_maior_30_60, evento_adverso.CRITERIO_SERIEDAD_MUERTE2 as cmp_maior_30_61, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION2 as cmp_maior_30_62, evento_adverso.CRITERIO_SERIEDAD_AMENAZA2 as cmp_maior_30_63, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD2 as cmp_maior_30_64, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD2 as cmp_maior_30_65, evento_adverso.CRITERIO_SERIEDAD_EVENTO2 as cmp_maior_30_66, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA2 as cmp_maior_30_67, evento_adverso.CAUSA_MUERTE2 as cmp_maior_30_68, evento_adverso.DETALLES_EA2 as cmp_maior_30_69, evento_adverso.RELACION_MEDICAMENTO3 as cmp_maior_30_70, evento_adverso.RELACIONADO_DISPOSITIVO3 as cmp_maior_30_71, evento_adverso.FECHA_INICIO_EVENTO3 as cmp_maior_30_72, evento_adverso.DESENLACE3 as cmp_maior_30_73, evento_adverso.FECHA_RECUPERACION3 as cmp_maior_30_74, evento_adverso.FECHA_MUERTE3 as cmp_maior_30_75, evento_adverso.CRITERIO_SERIEDAD3 as cmp_maior_30_76, evento_adverso.CRITERIO_SERIEDAD_MUERTE3 as cmp_maior_30_77, evento_adverso.CRITERIO_SERIEDAD_HOSPITALIZACION3 as cmp_maior_30_78, evento_adverso.CRITERIO_SERIEDAD_AMENAZA3 as cmp_maior_30_79, evento_adverso.CRITERIO_SERIEDAD_INCAPACIDAD3 as cmp_maior_30_80, evento_adverso.CRITERIO_SERIEDAD_ANORMALIDAD3 as cmp_maior_30_81, evento_adverso.CRITERIO_SERIEDAD_EVENTO3 as cmp_maior_30_82, evento_adverso.CRITERIO_SERIEDAD_QUIRURGICA3 as cmp_maior_30_83, evento_adverso.CAUSA_MUERTE3 as cmp_maior_30_84, evento_adverso.DETALLES_EA3 as cmp_maior_30_85, evento_adverso.INFORMACION_ADICIONAL as cmp_maior_30_86, evento_adverso.NOMBRE_REPORTE as cmp_maior_30_87, evento_adverso.ID_PACIENTE_FK as cmp_maior_30_88, evento_adverso.MEDICAMENTO1 as cmp_maior_30_89, evento_adverso.MEDICAMENTO2 as cmp_maior_30_90, evento_adverso.MEDICAMENTO3 as cmp_maior_30_91, evento_adverso.INFORMACION_EA1 as cmp_maior_30_92, evento_adverso.INFORMACION_EA2 as cmp_maior_30_93, evento_adverso.INFORMACION_EA3 as cmp_maior_30_94, evento_adverso.FECHA_SUSPENCION1 as cmp_maior_30_95, evento_adverso.FECHA_SUSPENCION2 as cmp_maior_30_96, evento_adverso.FECHA_SUSPENCION3 as cmp_maior_30_97, evento_adverso.FECHA_EVENTO_ADVERSO as cmp_maior_30_98, evento_adverso.NOMBRE_REPORTANTE_PRIMARIO as cmp_maior_30_99, evento_adverso.TELEFONO_REPORTANTE_PRIMARIO as cmp_maior_30_100, evento_adverso.TIPO_REPORTANTE as cmp_maior_30_101 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['order_grid'];
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
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['evento_adverso_id_evento_adverso'])) ? $this->New_label['evento_adverso_id_evento_adverso'] : "ID EVENTO ADVERSO"; 
          if ($Cada_col == "evento_adverso_id_evento_adverso" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_pais'])) ? $this->New_label['evento_adverso_pais'] : "PAIS"; 
          if ($Cada_col == "evento_adverso_pais" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_tipo_reporte'])) ? $this->New_label['evento_adverso_tipo_reporte'] : "TIPO REPORTE"; 
          if ($Cada_col == "evento_adverso_tipo_reporte" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_staff'])) ? $this->New_label['evento_adverso_fecha_staff'] : "FECHA STAFF"; 
          if ($Cada_col == "evento_adverso_fecha_staff" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_producto'])) ? $this->New_label['evento_adverso_producto'] : "PRODUCTO"; 
          if ($Cada_col == "evento_adverso_producto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_ciudad'])) ? $this->New_label['evento_adverso_ciudad'] : "CIUDAD"; 
          if ($Cada_col == "evento_adverso_ciudad" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_genero'])) ? $this->New_label['evento_adverso_genero'] : "GENERO"; 
          if ($Cada_col == "evento_adverso_genero" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_nacimiento'])) ? $this->New_label['evento_adverso_fecha_nacimiento'] : "FECHA NACIMIENTO"; 
          if ($Cada_col == "evento_adverso_fecha_nacimiento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_embarazo'])) ? $this->New_label['evento_adverso_embarazo'] : "EMBARAZO"; 
          if ($Cada_col == "evento_adverso_embarazo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_parto'])) ? $this->New_label['evento_adverso_fecha_parto'] : "FECHA PARTO"; 
          if ($Cada_col == "evento_adverso_fecha_parto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_desenlace'])) ? $this->New_label['evento_adverso_desenlace'] : "DESENLACE"; 
          if ($Cada_col == "evento_adverso_desenlace" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_cuales_desenlaces'])) ? $this->New_label['evento_adverso_cuales_desenlaces'] : "CUALES DESENLACES"; 
          if ($Cada_col == "evento_adverso_cuales_desenlaces" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_contacto_directo'])) ? $this->New_label['evento_adverso_contacto_directo'] : "CONTACTO DIRECTO"; 
          if ($Cada_col == "evento_adverso_contacto_directo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_nombre_medico'])) ? $this->New_label['evento_adverso_nombre_medico'] : "NOMBRE MEDICO"; 
          if ($Cada_col == "evento_adverso_nombre_medico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_telefono_medico'])) ? $this->New_label['evento_adverso_telefono_medico'] : "TELEFONO MEDICO"; 
          if ($Cada_col == "evento_adverso_telefono_medico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fax_medico'])) ? $this->New_label['evento_adverso_fax_medico'] : "FAX MEDICO"; 
          if ($Cada_col == "evento_adverso_fax_medico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_email_medico'])) ? $this->New_label['evento_adverso_email_medico'] : "EMAIL MEDICO"; 
          if ($Cada_col == "evento_adverso_email_medico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_indicacion1'])) ? $this->New_label['evento_adverso_indicacion1'] : "INDICACION1"; 
          if ($Cada_col == "evento_adverso_indicacion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_formulacion1'])) ? $this->New_label['evento_adverso_formulacion1'] : "FORMULACION1"; 
          if ($Cada_col == "evento_adverso_formulacion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_regimen_dosis1'])) ? $this->New_label['evento_adverso_regimen_dosis1'] : "REGIMEN DOSIS1"; 
          if ($Cada_col == "evento_adverso_regimen_dosis1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_ruta_administracion1'])) ? $this->New_label['evento_adverso_ruta_administracion1'] : "RUTA ADMINISTRACION1"; 
          if ($Cada_col == "evento_adverso_ruta_administracion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_numero_lote1'])) ? $this->New_label['evento_adverso_numero_lote1'] : "NUMERO LOTE1"; 
          if ($Cada_col == "evento_adverso_numero_lote1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_expiracion1'])) ? $this->New_label['evento_adverso_fecha_expiracion1'] : "FECHA EXPIRACION1"; 
          if ($Cada_col == "evento_adverso_fecha_expiracion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio1'])) ? $this->New_label['evento_adverso_fecha_inicio1'] : "FECHA INICIO1"; 
          if ($Cada_col == "evento_adverso_fecha_inicio1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_tratamiento_continua1'])) ? $this->New_label['evento_adverso_tratamiento_continua1'] : "TRATAMIENTO CONTINUA1"; 
          if ($Cada_col == "evento_adverso_tratamiento_continua1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_indicacion2'])) ? $this->New_label['evento_adverso_indicacion2'] : "INDICACION2"; 
          if ($Cada_col == "evento_adverso_indicacion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_formulacion2'])) ? $this->New_label['evento_adverso_formulacion2'] : "FORMULACION2"; 
          if ($Cada_col == "evento_adverso_formulacion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_regimen_dosis2'])) ? $this->New_label['evento_adverso_regimen_dosis2'] : "REGIMEN DOSIS2"; 
          if ($Cada_col == "evento_adverso_regimen_dosis2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_ruta_administracion2'])) ? $this->New_label['evento_adverso_ruta_administracion2'] : "RUTA ADMINISTRACION2"; 
          if ($Cada_col == "evento_adverso_ruta_administracion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_numero_lote2'])) ? $this->New_label['evento_adverso_numero_lote2'] : "NUMERO LOTE2"; 
          if ($Cada_col == "evento_adverso_numero_lote2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_expiracion2'])) ? $this->New_label['evento_adverso_fecha_expiracion2'] : "FECHA EXPIRACION2"; 
          if ($Cada_col == "evento_adverso_fecha_expiracion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio2'])) ? $this->New_label['evento_adverso_fecha_inicio2'] : "FECHA INICIO2"; 
          if ($Cada_col == "evento_adverso_fecha_inicio2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_tratamiento_continua2'])) ? $this->New_label['evento_adverso_tratamiento_continua2'] : "TRATAMIENTO CONTINUA2"; 
          if ($Cada_col == "evento_adverso_tratamiento_continua2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_indicacion3'])) ? $this->New_label['evento_adverso_indicacion3'] : "INDICACION3"; 
          if ($Cada_col == "evento_adverso_indicacion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_formulacion3'])) ? $this->New_label['evento_adverso_formulacion3'] : "FORMULACION3"; 
          if ($Cada_col == "evento_adverso_formulacion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_regimen_dosis3'])) ? $this->New_label['evento_adverso_regimen_dosis3'] : "REGIMEN DOSIS3"; 
          if ($Cada_col == "evento_adverso_regimen_dosis3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_ruta_administracion3'])) ? $this->New_label['evento_adverso_ruta_administracion3'] : "RUTA ADMINISTRACION3"; 
          if ($Cada_col == "evento_adverso_ruta_administracion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_numero_lote3'])) ? $this->New_label['evento_adverso_numero_lote3'] : "NUMERO LOTE3"; 
          if ($Cada_col == "evento_adverso_numero_lote3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_expiracion3'])) ? $this->New_label['evento_adverso_fecha_expiracion3'] : "FECHA EXPIRACION3"; 
          if ($Cada_col == "evento_adverso_fecha_expiracion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio3'])) ? $this->New_label['evento_adverso_fecha_inicio3'] : "FECHA INICIO3"; 
          if ($Cada_col == "evento_adverso_fecha_inicio3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_tratamiento_continua3'])) ? $this->New_label['evento_adverso_tratamiento_continua3'] : "TRATAMIENTO CONTINUA3"; 
          if ($Cada_col == "evento_adverso_tratamiento_continua3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_muestra_disponible'])) ? $this->New_label['evento_adverso_muestra_disponible'] : "MUESTRA DISPONIBLE"; 
          if ($Cada_col == "evento_adverso_muestra_disponible" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_informacion_muestra'])) ? $this->New_label['evento_adverso_informacion_muestra'] : "INFORMACION MUESTRA"; 
          if ($Cada_col == "evento_adverso_informacion_muestra" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_relacion_medicamento1'])) ? $this->New_label['evento_adverso_relacion_medicamento1'] : "RELACION MEDICAMENTO1"; 
          if ($Cada_col == "evento_adverso_relacion_medicamento1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_relacionado_dispositivo1'])) ? $this->New_label['evento_adverso_relacionado_dispositivo1'] : "RELACIONADO DISPOSITIVO1"; 
          if ($Cada_col == "evento_adverso_relacionado_dispositivo1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio_evento1'])) ? $this->New_label['evento_adverso_fecha_inicio_evento1'] : "FECHA INICIO EVENTO1"; 
          if ($Cada_col == "evento_adverso_fecha_inicio_evento1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_desenlace1'])) ? $this->New_label['evento_adverso_desenlace1'] : "DESENLACE1"; 
          if ($Cada_col == "evento_adverso_desenlace1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_recuperacion1'])) ? $this->New_label['evento_adverso_fecha_recuperacion1'] : "FECHA RECUPERACION1"; 
          if ($Cada_col == "evento_adverso_fecha_recuperacion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_muerte1'])) ? $this->New_label['evento_adverso_fecha_muerte1'] : "FECHA MUERTE1"; 
          if ($Cada_col == "evento_adverso_fecha_muerte1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad1'])) ? $this->New_label['evento_adverso_criterio_seriedad1'] : "CRITERIO SERIEDAD1"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_muerte1'])) ? $this->New_label['evento_adverso_criterio_seriedad_muerte1'] : "CRITERIO SERIEDAD MUERTE1"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_muerte1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_hospitalizacion1'])) ? $this->New_label['evento_adverso_criterio_seriedad_hospitalizacion1'] : "CRITERIO SERIEDAD HOSPITALIZACION1"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_hospitalizacion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_amenaza1'])) ? $this->New_label['evento_adverso_criterio_seriedad_amenaza1'] : "CRITERIO SERIEDAD AMENAZA1"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_amenaza1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_incapacidad1'])) ? $this->New_label['evento_adverso_criterio_seriedad_incapacidad1'] : "CRITERIO SERIEDAD INCAPACIDAD1"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_incapacidad1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_anormalidad1'])) ? $this->New_label['evento_adverso_criterio_seriedad_anormalidad1'] : "CRITERIO SERIEDAD ANORMALIDAD1"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_anormalidad1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_evento1'])) ? $this->New_label['evento_adverso_criterio_seriedad_evento1'] : "CRITERIO SERIEDAD EVENTO1"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_evento1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_quirurgica1'])) ? $this->New_label['evento_adverso_criterio_seriedad_quirurgica1'] : "CRITERIO SERIEDAD QUIRURGICA1"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_quirurgica1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_causa_muerte1'])) ? $this->New_label['evento_adverso_causa_muerte1'] : "CAUSA MUERTE1"; 
          if ($Cada_col == "evento_adverso_causa_muerte1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_detalles_ea1'])) ? $this->New_label['evento_adverso_detalles_ea1'] : "DETALLES EA1"; 
          if ($Cada_col == "evento_adverso_detalles_ea1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_relacion_medicamento2'])) ? $this->New_label['evento_adverso_relacion_medicamento2'] : "RELACION MEDICAMENTO2"; 
          if ($Cada_col == "evento_adverso_relacion_medicamento2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_relacionado_dispositivo2'])) ? $this->New_label['evento_adverso_relacionado_dispositivo2'] : "RELACIONADO DISPOSITIVO2"; 
          if ($Cada_col == "evento_adverso_relacionado_dispositivo2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio_evento2'])) ? $this->New_label['evento_adverso_fecha_inicio_evento2'] : "FECHA INICIO EVENTO2"; 
          if ($Cada_col == "evento_adverso_fecha_inicio_evento2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_desenlace2'])) ? $this->New_label['evento_adverso_desenlace2'] : "DESENLACE2"; 
          if ($Cada_col == "evento_adverso_desenlace2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_recuperacion2'])) ? $this->New_label['evento_adverso_fecha_recuperacion2'] : "FECHA RECUPERACION2"; 
          if ($Cada_col == "evento_adverso_fecha_recuperacion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_muerte2'])) ? $this->New_label['evento_adverso_fecha_muerte2'] : "FECHA MUERTE2"; 
          if ($Cada_col == "evento_adverso_fecha_muerte2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad2'])) ? $this->New_label['evento_adverso_criterio_seriedad2'] : "CRITERIO SERIEDAD2"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_muerte2'])) ? $this->New_label['evento_adverso_criterio_seriedad_muerte2'] : "CRITERIO SERIEDAD MUERTE2"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_muerte2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_hospitalizacion2'])) ? $this->New_label['evento_adverso_criterio_seriedad_hospitalizacion2'] : "CRITERIO SERIEDAD HOSPITALIZACION2"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_hospitalizacion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_amenaza2'])) ? $this->New_label['evento_adverso_criterio_seriedad_amenaza2'] : "CRITERIO SERIEDAD AMENAZA2"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_amenaza2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_incapacidad2'])) ? $this->New_label['evento_adverso_criterio_seriedad_incapacidad2'] : "CRITERIO SERIEDAD INCAPACIDAD2"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_incapacidad2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_anormalidad2'])) ? $this->New_label['evento_adverso_criterio_seriedad_anormalidad2'] : "CRITERIO SERIEDAD ANORMALIDAD2"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_anormalidad2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_evento2'])) ? $this->New_label['evento_adverso_criterio_seriedad_evento2'] : "CRITERIO SERIEDAD EVENTO2"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_evento2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_quirurgica2'])) ? $this->New_label['evento_adverso_criterio_seriedad_quirurgica2'] : "CRITERIO SERIEDAD QUIRURGICA2"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_quirurgica2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_causa_muerte2'])) ? $this->New_label['evento_adverso_causa_muerte2'] : "CAUSA MUERTE2"; 
          if ($Cada_col == "evento_adverso_causa_muerte2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_detalles_ea2'])) ? $this->New_label['evento_adverso_detalles_ea2'] : "DETALLES EA2"; 
          if ($Cada_col == "evento_adverso_detalles_ea2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_relacion_medicamento3'])) ? $this->New_label['evento_adverso_relacion_medicamento3'] : "RELACION MEDICAMENTO3"; 
          if ($Cada_col == "evento_adverso_relacion_medicamento3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_relacionado_dispositivo3'])) ? $this->New_label['evento_adverso_relacionado_dispositivo3'] : "RELACIONADO DISPOSITIVO3"; 
          if ($Cada_col == "evento_adverso_relacionado_dispositivo3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio_evento3'])) ? $this->New_label['evento_adverso_fecha_inicio_evento3'] : "FECHA INICIO EVENTO3"; 
          if ($Cada_col == "evento_adverso_fecha_inicio_evento3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_desenlace3'])) ? $this->New_label['evento_adverso_desenlace3'] : "DESENLACE3"; 
          if ($Cada_col == "evento_adverso_desenlace3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_recuperacion3'])) ? $this->New_label['evento_adverso_fecha_recuperacion3'] : "FECHA RECUPERACION3"; 
          if ($Cada_col == "evento_adverso_fecha_recuperacion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_muerte3'])) ? $this->New_label['evento_adverso_fecha_muerte3'] : "FECHA MUERTE3"; 
          if ($Cada_col == "evento_adverso_fecha_muerte3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad3'])) ? $this->New_label['evento_adverso_criterio_seriedad3'] : "CRITERIO SERIEDAD3"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_muerte3'])) ? $this->New_label['evento_adverso_criterio_seriedad_muerte3'] : "CRITERIO SERIEDAD MUERTE3"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_muerte3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_hospitalizacion3'])) ? $this->New_label['evento_adverso_criterio_seriedad_hospitalizacion3'] : "CRITERIO SERIEDAD HOSPITALIZACION3"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_hospitalizacion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_amenaza3'])) ? $this->New_label['evento_adverso_criterio_seriedad_amenaza3'] : "CRITERIO SERIEDAD AMENAZA3"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_amenaza3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_incapacidad3'])) ? $this->New_label['evento_adverso_criterio_seriedad_incapacidad3'] : "CRITERIO SERIEDAD INCAPACIDAD3"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_incapacidad3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_anormalidad3'])) ? $this->New_label['evento_adverso_criterio_seriedad_anormalidad3'] : "CRITERIO SERIEDAD ANORMALIDAD3"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_anormalidad3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_evento3'])) ? $this->New_label['evento_adverso_criterio_seriedad_evento3'] : "CRITERIO SERIEDAD EVENTO3"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_evento3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_quirurgica3'])) ? $this->New_label['evento_adverso_criterio_seriedad_quirurgica3'] : "CRITERIO SERIEDAD QUIRURGICA3"; 
          if ($Cada_col == "evento_adverso_criterio_seriedad_quirurgica3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_causa_muerte3'])) ? $this->New_label['evento_adverso_causa_muerte3'] : "CAUSA MUERTE3"; 
          if ($Cada_col == "evento_adverso_causa_muerte3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_detalles_ea3'])) ? $this->New_label['evento_adverso_detalles_ea3'] : "DETALLES EA3"; 
          if ($Cada_col == "evento_adverso_detalles_ea3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_informacion_adicional'])) ? $this->New_label['evento_adverso_informacion_adicional'] : "INFORMACION ADICIONAL"; 
          if ($Cada_col == "evento_adverso_informacion_adicional" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_nombre_reporte'])) ? $this->New_label['evento_adverso_nombre_reporte'] : "NOMBRE REPORTE"; 
          if ($Cada_col == "evento_adverso_nombre_reporte" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_id_paciente_fk'])) ? $this->New_label['evento_adverso_id_paciente_fk'] : "ID PACIENTE FK"; 
          if ($Cada_col == "evento_adverso_id_paciente_fk" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_medicamento1'])) ? $this->New_label['evento_adverso_medicamento1'] : "MEDICAMENTO1"; 
          if ($Cada_col == "evento_adverso_medicamento1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_medicamento2'])) ? $this->New_label['evento_adverso_medicamento2'] : "MEDICAMENTO2"; 
          if ($Cada_col == "evento_adverso_medicamento2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_medicamento3'])) ? $this->New_label['evento_adverso_medicamento3'] : "MEDICAMENTO3"; 
          if ($Cada_col == "evento_adverso_medicamento3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_informacion_ea1'])) ? $this->New_label['evento_adverso_informacion_ea1'] : "INFORMACION EA1"; 
          if ($Cada_col == "evento_adverso_informacion_ea1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_informacion_ea2'])) ? $this->New_label['evento_adverso_informacion_ea2'] : "INFORMACION EA2"; 
          if ($Cada_col == "evento_adverso_informacion_ea2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_informacion_ea3'])) ? $this->New_label['evento_adverso_informacion_ea3'] : "INFORMACION EA3"; 
          if ($Cada_col == "evento_adverso_informacion_ea3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_suspencion1'])) ? $this->New_label['evento_adverso_fecha_suspencion1'] : "FECHA SUSPENCION1"; 
          if ($Cada_col == "evento_adverso_fecha_suspencion1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_suspencion2'])) ? $this->New_label['evento_adverso_fecha_suspencion2'] : "FECHA SUSPENCION2"; 
          if ($Cada_col == "evento_adverso_fecha_suspencion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_suspencion3'])) ? $this->New_label['evento_adverso_fecha_suspencion3'] : "FECHA SUSPENCION3"; 
          if ($Cada_col == "evento_adverso_fecha_suspencion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_fecha_evento_adverso'])) ? $this->New_label['evento_adverso_fecha_evento_adverso'] : "FECHA EVENTO ADVERSO"; 
          if ($Cada_col == "evento_adverso_fecha_evento_adverso" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_nombre_reportante_primario'])) ? $this->New_label['evento_adverso_nombre_reportante_primario'] : "NOMBRE REPORTANTE PRIMARIO"; 
          if ($Cada_col == "evento_adverso_nombre_reportante_primario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_telefono_reportante_primario'])) ? $this->New_label['evento_adverso_telefono_reportante_primario'] : "TELEFONO REPORTANTE PRIMARIO"; 
          if ($Cada_col == "evento_adverso_telefono_reportante_primario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_adverso_tipo_reportante'])) ? $this->New_label['evento_adverso_tipo_reportante'] : "TIPO REPORTANTE"; 
          if ($Cada_col == "evento_adverso_tipo_reportante" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
         $this->evento_adverso_id_evento_adverso = $rs->fields[0] ;  
         $this->evento_adverso_id_evento_adverso = (string)$this->evento_adverso_id_evento_adverso;
         $this->evento_adverso_pais = $rs->fields[1] ;  
         $this->evento_adverso_tipo_reporte = $rs->fields[2] ;  
         $this->evento_adverso_fecha_staff = $rs->fields[3] ;  
         $this->evento_adverso_producto = $rs->fields[4] ;  
         $this->evento_adverso_ciudad = $rs->fields[5] ;  
         $this->evento_adverso_genero = $rs->fields[6] ;  
         $this->evento_adverso_fecha_nacimiento = $rs->fields[7] ;  
         $this->evento_adverso_embarazo = $rs->fields[8] ;  
         $this->evento_adverso_fecha_parto = $rs->fields[9] ;  
         $this->evento_adverso_desenlace = $rs->fields[10] ;  
         $this->evento_adverso_cuales_desenlaces = $rs->fields[11] ;  
         $this->evento_adverso_contacto_directo = $rs->fields[12] ;  
         $this->evento_adverso_nombre_medico = $rs->fields[13] ;  
         $this->evento_adverso_telefono_medico = $rs->fields[14] ;  
         $this->evento_adverso_fax_medico = $rs->fields[15] ;  
         $this->evento_adverso_email_medico = $rs->fields[16] ;  
         $this->evento_adverso_indicacion1 = $rs->fields[17] ;  
         $this->evento_adverso_formulacion1 = $rs->fields[18] ;  
         $this->evento_adverso_regimen_dosis1 = $rs->fields[19] ;  
         $this->evento_adverso_ruta_administracion1 = $rs->fields[20] ;  
         $this->evento_adverso_numero_lote1 = $rs->fields[21] ;  
         $this->evento_adverso_fecha_expiracion1 = $rs->fields[22] ;  
         $this->evento_adverso_fecha_inicio1 = $rs->fields[23] ;  
         $this->evento_adverso_tratamiento_continua1 = $rs->fields[24] ;  
         $this->evento_adverso_indicacion2 = $rs->fields[25] ;  
         $this->evento_adverso_formulacion2 = $rs->fields[26] ;  
         $this->evento_adverso_regimen_dosis2 = $rs->fields[27] ;  
         $this->evento_adverso_ruta_administracion2 = $rs->fields[28] ;  
         $this->evento_adverso_numero_lote2 = $rs->fields[29] ;  
         $this->evento_adverso_fecha_expiracion2 = $rs->fields[30] ;  
         $this->evento_adverso_fecha_inicio2 = $rs->fields[31] ;  
         $this->evento_adverso_tratamiento_continua2 = $rs->fields[32] ;  
         $this->evento_adverso_indicacion3 = $rs->fields[33] ;  
         $this->evento_adverso_formulacion3 = $rs->fields[34] ;  
         $this->evento_adverso_regimen_dosis3 = $rs->fields[35] ;  
         $this->evento_adverso_ruta_administracion3 = $rs->fields[36] ;  
         $this->evento_adverso_numero_lote3 = $rs->fields[37] ;  
         $this->evento_adverso_fecha_expiracion3 = $rs->fields[38] ;  
         $this->evento_adverso_fecha_inicio3 = $rs->fields[39] ;  
         $this->evento_adverso_tratamiento_continua3 = $rs->fields[40] ;  
         $this->evento_adverso_muestra_disponible = $rs->fields[41] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->evento_adverso_informacion_muestra = "";  
              if (is_file($rs_grid->fields[42])) 
              { 
                  $this->evento_adverso_informacion_muestra = file_get_contents($rs_grid->fields[42]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->evento_adverso_informacion_muestra = $this->Db->BlobDecode($rs->fields[42]) ;  
         } 
         else
         { 
             $this->evento_adverso_informacion_muestra = $rs->fields[42] ;  
         } 
         $this->evento_adverso_relacion_medicamento1 = $rs->fields[43] ;  
         $this->evento_adverso_relacionado_dispositivo1 = $rs->fields[44] ;  
         $this->evento_adverso_fecha_inicio_evento1 = $rs->fields[45] ;  
         $this->evento_adverso_desenlace1 = $rs->fields[46] ;  
         $this->evento_adverso_fecha_recuperacion1 = $rs->fields[47] ;  
         $this->evento_adverso_fecha_muerte1 = $rs->fields[48] ;  
         $this->evento_adverso_criterio_seriedad1 = $rs->fields[49] ;  
         $this->evento_adverso_criterio_seriedad_muerte1 = $rs->fields[50] ;  
         $this->evento_adverso_criterio_seriedad_hospitalizacion1 = $rs->fields[51] ;  
         $this->evento_adverso_criterio_seriedad_amenaza1 = $rs->fields[52] ;  
         $this->evento_adverso_criterio_seriedad_incapacidad1 = $rs->fields[53] ;  
         $this->evento_adverso_criterio_seriedad_anormalidad1 = $rs->fields[54] ;  
         $this->evento_adverso_criterio_seriedad_evento1 = $rs->fields[55] ;  
         $this->evento_adverso_criterio_seriedad_quirurgica1 = $rs->fields[56] ;  
         $this->evento_adverso_causa_muerte1 = $rs->fields[57] ;  
         $this->evento_adverso_detalles_ea1 = $rs->fields[58] ;  
         $this->evento_adverso_relacion_medicamento2 = $rs->fields[59] ;  
         $this->evento_adverso_relacionado_dispositivo2 = $rs->fields[60] ;  
         $this->evento_adverso_fecha_inicio_evento2 = $rs->fields[61] ;  
         $this->evento_adverso_desenlace2 = $rs->fields[62] ;  
         $this->evento_adverso_fecha_recuperacion2 = $rs->fields[63] ;  
         $this->evento_adverso_fecha_muerte2 = $rs->fields[64] ;  
         $this->evento_adverso_criterio_seriedad2 = $rs->fields[65] ;  
         $this->evento_adverso_criterio_seriedad_muerte2 = $rs->fields[66] ;  
         $this->evento_adverso_criterio_seriedad_hospitalizacion2 = $rs->fields[67] ;  
         $this->evento_adverso_criterio_seriedad_amenaza2 = $rs->fields[68] ;  
         $this->evento_adverso_criterio_seriedad_incapacidad2 = $rs->fields[69] ;  
         $this->evento_adverso_criterio_seriedad_anormalidad2 = $rs->fields[70] ;  
         $this->evento_adverso_criterio_seriedad_evento2 = $rs->fields[71] ;  
         $this->evento_adverso_criterio_seriedad_quirurgica2 = $rs->fields[72] ;  
         $this->evento_adverso_causa_muerte2 = $rs->fields[73] ;  
         $this->evento_adverso_detalles_ea2 = $rs->fields[74] ;  
         $this->evento_adverso_relacion_medicamento3 = $rs->fields[75] ;  
         $this->evento_adverso_relacionado_dispositivo3 = $rs->fields[76] ;  
         $this->evento_adverso_fecha_inicio_evento3 = $rs->fields[77] ;  
         $this->evento_adverso_desenlace3 = $rs->fields[78] ;  
         $this->evento_adverso_fecha_recuperacion3 = $rs->fields[79] ;  
         $this->evento_adverso_fecha_muerte3 = $rs->fields[80] ;  
         $this->evento_adverso_criterio_seriedad3 = $rs->fields[81] ;  
         $this->evento_adverso_criterio_seriedad_muerte3 = $rs->fields[82] ;  
         $this->evento_adverso_criterio_seriedad_hospitalizacion3 = $rs->fields[83] ;  
         $this->evento_adverso_criterio_seriedad_amenaza3 = $rs->fields[84] ;  
         $this->evento_adverso_criterio_seriedad_incapacidad3 = $rs->fields[85] ;  
         $this->evento_adverso_criterio_seriedad_anormalidad3 = $rs->fields[86] ;  
         $this->evento_adverso_criterio_seriedad_evento3 = $rs->fields[87] ;  
         $this->evento_adverso_criterio_seriedad_quirurgica3 = $rs->fields[88] ;  
         $this->evento_adverso_causa_muerte3 = $rs->fields[89] ;  
         $this->evento_adverso_detalles_ea3 = $rs->fields[90] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->evento_adverso_informacion_adicional = "";  
              if (is_file($rs_grid->fields[91])) 
              { 
                  $this->evento_adverso_informacion_adicional = file_get_contents($rs_grid->fields[91]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->evento_adverso_informacion_adicional = $this->Db->BlobDecode($rs->fields[91]) ;  
         } 
         else
         { 
             $this->evento_adverso_informacion_adicional = $rs->fields[91] ;  
         } 
         $this->evento_adverso_nombre_reporte = $rs->fields[92] ;  
         $this->evento_adverso_id_paciente_fk = $rs->fields[93] ;  
         $this->evento_adverso_id_paciente_fk = (string)$this->evento_adverso_id_paciente_fk;
         $this->evento_adverso_medicamento1 = $rs->fields[94] ;  
         $this->evento_adverso_medicamento2 = $rs->fields[95] ;  
         $this->evento_adverso_medicamento3 = $rs->fields[96] ;  
         $this->evento_adverso_informacion_ea1 = $rs->fields[97] ;  
         $this->evento_adverso_informacion_ea2 = $rs->fields[98] ;  
         $this->evento_adverso_informacion_ea3 = $rs->fields[99] ;  
         $this->evento_adverso_fecha_suspencion1 = $rs->fields[100] ;  
         $this->evento_adverso_fecha_suspencion2 = $rs->fields[101] ;  
         $this->evento_adverso_fecha_suspencion3 = $rs->fields[102] ;  
         $this->evento_adverso_fecha_evento_adverso = $rs->fields[103] ;  
         $this->evento_adverso_nombre_reportante_primario = $rs->fields[104] ;  
         $this->evento_adverso_telefono_reportante_primario = $rs->fields[105] ;  
         $this->evento_adverso_tipo_reportante = $rs->fields[106] ;  
         $this->evento_adverso_informacion_muestra = "";
         $this->evento_adverso_informacion_adicional = "";
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['field_order'] as $Cada_col)
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
   //----- evento_adverso_id_evento_adverso
   function NM_export_evento_adverso_id_evento_adverso()
   {
         nmgp_Form_Num_Val($this->evento_adverso_id_evento_adverso, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->evento_adverso_id_evento_adverso))
         {
             $this->evento_adverso_id_evento_adverso = sc_convert_encoding($this->evento_adverso_id_evento_adverso, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_id_evento_adverso = str_replace('<', '&lt;', $this->evento_adverso_id_evento_adverso);
         $this->evento_adverso_id_evento_adverso = str_replace('>', '&gt;', $this->evento_adverso_id_evento_adverso);
         $this->texto_tag .= "<td>" . $this->evento_adverso_id_evento_adverso . "</td>\r\n";
   }
   //----- evento_adverso_pais
   function NM_export_evento_adverso_pais()
   {
         $this->evento_adverso_pais = html_entity_decode($this->evento_adverso_pais, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_pais = strip_tags($this->evento_adverso_pais);
         if (!NM_is_utf8($this->evento_adverso_pais))
         {
             $this->evento_adverso_pais = sc_convert_encoding($this->evento_adverso_pais, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_pais = str_replace('<', '&lt;', $this->evento_adverso_pais);
         $this->evento_adverso_pais = str_replace('>', '&gt;', $this->evento_adverso_pais);
         $this->texto_tag .= "<td>" . $this->evento_adverso_pais . "</td>\r\n";
   }
   //----- evento_adverso_tipo_reporte
   function NM_export_evento_adverso_tipo_reporte()
   {
         $this->evento_adverso_tipo_reporte = html_entity_decode($this->evento_adverso_tipo_reporte, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_tipo_reporte = strip_tags($this->evento_adverso_tipo_reporte);
         if (!NM_is_utf8($this->evento_adverso_tipo_reporte))
         {
             $this->evento_adverso_tipo_reporte = sc_convert_encoding($this->evento_adverso_tipo_reporte, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_tipo_reporte = str_replace('<', '&lt;', $this->evento_adverso_tipo_reporte);
         $this->evento_adverso_tipo_reporte = str_replace('>', '&gt;', $this->evento_adverso_tipo_reporte);
         $this->texto_tag .= "<td>" . $this->evento_adverso_tipo_reporte . "</td>\r\n";
   }
   //----- evento_adverso_fecha_staff
   function NM_export_evento_adverso_fecha_staff()
   {
         $this->evento_adverso_fecha_staff = html_entity_decode($this->evento_adverso_fecha_staff, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_staff = strip_tags($this->evento_adverso_fecha_staff);
         if (!NM_is_utf8($this->evento_adverso_fecha_staff))
         {
             $this->evento_adverso_fecha_staff = sc_convert_encoding($this->evento_adverso_fecha_staff, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_staff = str_replace('<', '&lt;', $this->evento_adverso_fecha_staff);
         $this->evento_adverso_fecha_staff = str_replace('>', '&gt;', $this->evento_adverso_fecha_staff);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_staff . "</td>\r\n";
   }
   //----- evento_adverso_producto
   function NM_export_evento_adverso_producto()
   {
         $this->evento_adverso_producto = html_entity_decode($this->evento_adverso_producto, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_producto = strip_tags($this->evento_adverso_producto);
         if (!NM_is_utf8($this->evento_adverso_producto))
         {
             $this->evento_adverso_producto = sc_convert_encoding($this->evento_adverso_producto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_producto = str_replace('<', '&lt;', $this->evento_adverso_producto);
         $this->evento_adverso_producto = str_replace('>', '&gt;', $this->evento_adverso_producto);
         $this->texto_tag .= "<td>" . $this->evento_adverso_producto . "</td>\r\n";
   }
   //----- evento_adverso_ciudad
   function NM_export_evento_adverso_ciudad()
   {
         $this->evento_adverso_ciudad = html_entity_decode($this->evento_adverso_ciudad, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_ciudad = strip_tags($this->evento_adverso_ciudad);
         if (!NM_is_utf8($this->evento_adverso_ciudad))
         {
             $this->evento_adverso_ciudad = sc_convert_encoding($this->evento_adverso_ciudad, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_ciudad = str_replace('<', '&lt;', $this->evento_adverso_ciudad);
         $this->evento_adverso_ciudad = str_replace('>', '&gt;', $this->evento_adverso_ciudad);
         $this->texto_tag .= "<td>" . $this->evento_adverso_ciudad . "</td>\r\n";
   }
   //----- evento_adverso_genero
   function NM_export_evento_adverso_genero()
   {
         $this->evento_adverso_genero = html_entity_decode($this->evento_adverso_genero, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_genero = strip_tags($this->evento_adverso_genero);
         if (!NM_is_utf8($this->evento_adverso_genero))
         {
             $this->evento_adverso_genero = sc_convert_encoding($this->evento_adverso_genero, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_genero = str_replace('<', '&lt;', $this->evento_adverso_genero);
         $this->evento_adverso_genero = str_replace('>', '&gt;', $this->evento_adverso_genero);
         $this->texto_tag .= "<td>" . $this->evento_adverso_genero . "</td>\r\n";
   }
   //----- evento_adverso_fecha_nacimiento
   function NM_export_evento_adverso_fecha_nacimiento()
   {
         $this->evento_adverso_fecha_nacimiento = html_entity_decode($this->evento_adverso_fecha_nacimiento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_nacimiento = strip_tags($this->evento_adverso_fecha_nacimiento);
         if (!NM_is_utf8($this->evento_adverso_fecha_nacimiento))
         {
             $this->evento_adverso_fecha_nacimiento = sc_convert_encoding($this->evento_adverso_fecha_nacimiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_nacimiento = str_replace('<', '&lt;', $this->evento_adverso_fecha_nacimiento);
         $this->evento_adverso_fecha_nacimiento = str_replace('>', '&gt;', $this->evento_adverso_fecha_nacimiento);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_nacimiento . "</td>\r\n";
   }
   //----- evento_adverso_embarazo
   function NM_export_evento_adverso_embarazo()
   {
         $this->evento_adverso_embarazo = html_entity_decode($this->evento_adverso_embarazo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_embarazo = strip_tags($this->evento_adverso_embarazo);
         if (!NM_is_utf8($this->evento_adverso_embarazo))
         {
             $this->evento_adverso_embarazo = sc_convert_encoding($this->evento_adverso_embarazo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_embarazo = str_replace('<', '&lt;', $this->evento_adverso_embarazo);
         $this->evento_adverso_embarazo = str_replace('>', '&gt;', $this->evento_adverso_embarazo);
         $this->texto_tag .= "<td>" . $this->evento_adverso_embarazo . "</td>\r\n";
   }
   //----- evento_adverso_fecha_parto
   function NM_export_evento_adverso_fecha_parto()
   {
         $this->evento_adverso_fecha_parto = html_entity_decode($this->evento_adverso_fecha_parto, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_parto = strip_tags($this->evento_adverso_fecha_parto);
         if (!NM_is_utf8($this->evento_adverso_fecha_parto))
         {
             $this->evento_adverso_fecha_parto = sc_convert_encoding($this->evento_adverso_fecha_parto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_parto = str_replace('<', '&lt;', $this->evento_adverso_fecha_parto);
         $this->evento_adverso_fecha_parto = str_replace('>', '&gt;', $this->evento_adverso_fecha_parto);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_parto . "</td>\r\n";
   }
   //----- evento_adverso_desenlace
   function NM_export_evento_adverso_desenlace()
   {
         $this->evento_adverso_desenlace = html_entity_decode($this->evento_adverso_desenlace, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_desenlace = strip_tags($this->evento_adverso_desenlace);
         if (!NM_is_utf8($this->evento_adverso_desenlace))
         {
             $this->evento_adverso_desenlace = sc_convert_encoding($this->evento_adverso_desenlace, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_desenlace = str_replace('<', '&lt;', $this->evento_adverso_desenlace);
         $this->evento_adverso_desenlace = str_replace('>', '&gt;', $this->evento_adverso_desenlace);
         $this->texto_tag .= "<td>" . $this->evento_adverso_desenlace . "</td>\r\n";
   }
   //----- evento_adverso_cuales_desenlaces
   function NM_export_evento_adverso_cuales_desenlaces()
   {
         $this->evento_adverso_cuales_desenlaces = html_entity_decode($this->evento_adverso_cuales_desenlaces, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_cuales_desenlaces = strip_tags($this->evento_adverso_cuales_desenlaces);
         if (!NM_is_utf8($this->evento_adverso_cuales_desenlaces))
         {
             $this->evento_adverso_cuales_desenlaces = sc_convert_encoding($this->evento_adverso_cuales_desenlaces, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_cuales_desenlaces = str_replace('<', '&lt;', $this->evento_adverso_cuales_desenlaces);
         $this->evento_adverso_cuales_desenlaces = str_replace('>', '&gt;', $this->evento_adverso_cuales_desenlaces);
         $this->texto_tag .= "<td>" . $this->evento_adverso_cuales_desenlaces . "</td>\r\n";
   }
   //----- evento_adverso_contacto_directo
   function NM_export_evento_adverso_contacto_directo()
   {
         $this->evento_adverso_contacto_directo = html_entity_decode($this->evento_adverso_contacto_directo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_contacto_directo = strip_tags($this->evento_adverso_contacto_directo);
         if (!NM_is_utf8($this->evento_adverso_contacto_directo))
         {
             $this->evento_adverso_contacto_directo = sc_convert_encoding($this->evento_adverso_contacto_directo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_contacto_directo = str_replace('<', '&lt;', $this->evento_adverso_contacto_directo);
         $this->evento_adverso_contacto_directo = str_replace('>', '&gt;', $this->evento_adverso_contacto_directo);
         $this->texto_tag .= "<td>" . $this->evento_adverso_contacto_directo . "</td>\r\n";
   }
   //----- evento_adverso_nombre_medico
   function NM_export_evento_adverso_nombre_medico()
   {
         $this->evento_adverso_nombre_medico = html_entity_decode($this->evento_adverso_nombre_medico, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_nombre_medico = strip_tags($this->evento_adverso_nombre_medico);
         if (!NM_is_utf8($this->evento_adverso_nombre_medico))
         {
             $this->evento_adverso_nombre_medico = sc_convert_encoding($this->evento_adverso_nombre_medico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_nombre_medico = str_replace('<', '&lt;', $this->evento_adverso_nombre_medico);
         $this->evento_adverso_nombre_medico = str_replace('>', '&gt;', $this->evento_adverso_nombre_medico);
         $this->texto_tag .= "<td>" . $this->evento_adverso_nombre_medico . "</td>\r\n";
   }
   //----- evento_adverso_telefono_medico
   function NM_export_evento_adverso_telefono_medico()
   {
         $this->evento_adverso_telefono_medico = html_entity_decode($this->evento_adverso_telefono_medico, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_telefono_medico = strip_tags($this->evento_adverso_telefono_medico);
         if (!NM_is_utf8($this->evento_adverso_telefono_medico))
         {
             $this->evento_adverso_telefono_medico = sc_convert_encoding($this->evento_adverso_telefono_medico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_telefono_medico = str_replace('<', '&lt;', $this->evento_adverso_telefono_medico);
         $this->evento_adverso_telefono_medico = str_replace('>', '&gt;', $this->evento_adverso_telefono_medico);
         $this->texto_tag .= "<td>" . $this->evento_adverso_telefono_medico . "</td>\r\n";
   }
   //----- evento_adverso_fax_medico
   function NM_export_evento_adverso_fax_medico()
   {
         $this->evento_adverso_fax_medico = html_entity_decode($this->evento_adverso_fax_medico, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fax_medico = strip_tags($this->evento_adverso_fax_medico);
         if (!NM_is_utf8($this->evento_adverso_fax_medico))
         {
             $this->evento_adverso_fax_medico = sc_convert_encoding($this->evento_adverso_fax_medico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fax_medico = str_replace('<', '&lt;', $this->evento_adverso_fax_medico);
         $this->evento_adverso_fax_medico = str_replace('>', '&gt;', $this->evento_adverso_fax_medico);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fax_medico . "</td>\r\n";
   }
   //----- evento_adverso_email_medico
   function NM_export_evento_adverso_email_medico()
   {
         $this->evento_adverso_email_medico = html_entity_decode($this->evento_adverso_email_medico, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_email_medico = strip_tags($this->evento_adverso_email_medico);
         if (!NM_is_utf8($this->evento_adverso_email_medico))
         {
             $this->evento_adverso_email_medico = sc_convert_encoding($this->evento_adverso_email_medico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_email_medico = str_replace('<', '&lt;', $this->evento_adverso_email_medico);
         $this->evento_adverso_email_medico = str_replace('>', '&gt;', $this->evento_adverso_email_medico);
         $this->texto_tag .= "<td>" . $this->evento_adverso_email_medico . "</td>\r\n";
   }
   //----- evento_adverso_indicacion1
   function NM_export_evento_adverso_indicacion1()
   {
         $this->evento_adverso_indicacion1 = html_entity_decode($this->evento_adverso_indicacion1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_indicacion1 = strip_tags($this->evento_adverso_indicacion1);
         if (!NM_is_utf8($this->evento_adverso_indicacion1))
         {
             $this->evento_adverso_indicacion1 = sc_convert_encoding($this->evento_adverso_indicacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_indicacion1 = str_replace('<', '&lt;', $this->evento_adverso_indicacion1);
         $this->evento_adverso_indicacion1 = str_replace('>', '&gt;', $this->evento_adverso_indicacion1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_indicacion1 . "</td>\r\n";
   }
   //----- evento_adverso_formulacion1
   function NM_export_evento_adverso_formulacion1()
   {
         $this->evento_adverso_formulacion1 = html_entity_decode($this->evento_adverso_formulacion1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_formulacion1 = strip_tags($this->evento_adverso_formulacion1);
         if (!NM_is_utf8($this->evento_adverso_formulacion1))
         {
             $this->evento_adverso_formulacion1 = sc_convert_encoding($this->evento_adverso_formulacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_formulacion1 = str_replace('<', '&lt;', $this->evento_adverso_formulacion1);
         $this->evento_adverso_formulacion1 = str_replace('>', '&gt;', $this->evento_adverso_formulacion1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_formulacion1 . "</td>\r\n";
   }
   //----- evento_adverso_regimen_dosis1
   function NM_export_evento_adverso_regimen_dosis1()
   {
         $this->evento_adverso_regimen_dosis1 = html_entity_decode($this->evento_adverso_regimen_dosis1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_regimen_dosis1 = strip_tags($this->evento_adverso_regimen_dosis1);
         if (!NM_is_utf8($this->evento_adverso_regimen_dosis1))
         {
             $this->evento_adverso_regimen_dosis1 = sc_convert_encoding($this->evento_adverso_regimen_dosis1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_regimen_dosis1 = str_replace('<', '&lt;', $this->evento_adverso_regimen_dosis1);
         $this->evento_adverso_regimen_dosis1 = str_replace('>', '&gt;', $this->evento_adverso_regimen_dosis1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_regimen_dosis1 . "</td>\r\n";
   }
   //----- evento_adverso_ruta_administracion1
   function NM_export_evento_adverso_ruta_administracion1()
   {
         $this->evento_adverso_ruta_administracion1 = html_entity_decode($this->evento_adverso_ruta_administracion1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_ruta_administracion1 = strip_tags($this->evento_adverso_ruta_administracion1);
         if (!NM_is_utf8($this->evento_adverso_ruta_administracion1))
         {
             $this->evento_adverso_ruta_administracion1 = sc_convert_encoding($this->evento_adverso_ruta_administracion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_ruta_administracion1 = str_replace('<', '&lt;', $this->evento_adverso_ruta_administracion1);
         $this->evento_adverso_ruta_administracion1 = str_replace('>', '&gt;', $this->evento_adverso_ruta_administracion1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_ruta_administracion1 . "</td>\r\n";
   }
   //----- evento_adverso_numero_lote1
   function NM_export_evento_adverso_numero_lote1()
   {
         $this->evento_adverso_numero_lote1 = html_entity_decode($this->evento_adverso_numero_lote1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_numero_lote1 = strip_tags($this->evento_adverso_numero_lote1);
         if (!NM_is_utf8($this->evento_adverso_numero_lote1))
         {
             $this->evento_adverso_numero_lote1 = sc_convert_encoding($this->evento_adverso_numero_lote1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_numero_lote1 = str_replace('<', '&lt;', $this->evento_adverso_numero_lote1);
         $this->evento_adverso_numero_lote1 = str_replace('>', '&gt;', $this->evento_adverso_numero_lote1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_numero_lote1 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_expiracion1
   function NM_export_evento_adverso_fecha_expiracion1()
   {
         $this->evento_adverso_fecha_expiracion1 = html_entity_decode($this->evento_adverso_fecha_expiracion1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_expiracion1 = strip_tags($this->evento_adverso_fecha_expiracion1);
         if (!NM_is_utf8($this->evento_adverso_fecha_expiracion1))
         {
             $this->evento_adverso_fecha_expiracion1 = sc_convert_encoding($this->evento_adverso_fecha_expiracion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_expiracion1 = str_replace('<', '&lt;', $this->evento_adverso_fecha_expiracion1);
         $this->evento_adverso_fecha_expiracion1 = str_replace('>', '&gt;', $this->evento_adverso_fecha_expiracion1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_expiracion1 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_inicio1
   function NM_export_evento_adverso_fecha_inicio1()
   {
         $this->evento_adverso_fecha_inicio1 = html_entity_decode($this->evento_adverso_fecha_inicio1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_inicio1 = strip_tags($this->evento_adverso_fecha_inicio1);
         if (!NM_is_utf8($this->evento_adverso_fecha_inicio1))
         {
             $this->evento_adverso_fecha_inicio1 = sc_convert_encoding($this->evento_adverso_fecha_inicio1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_inicio1 = str_replace('<', '&lt;', $this->evento_adverso_fecha_inicio1);
         $this->evento_adverso_fecha_inicio1 = str_replace('>', '&gt;', $this->evento_adverso_fecha_inicio1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_inicio1 . "</td>\r\n";
   }
   //----- evento_adverso_tratamiento_continua1
   function NM_export_evento_adverso_tratamiento_continua1()
   {
         $this->evento_adverso_tratamiento_continua1 = html_entity_decode($this->evento_adverso_tratamiento_continua1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_tratamiento_continua1 = strip_tags($this->evento_adverso_tratamiento_continua1);
         if (!NM_is_utf8($this->evento_adverso_tratamiento_continua1))
         {
             $this->evento_adverso_tratamiento_continua1 = sc_convert_encoding($this->evento_adverso_tratamiento_continua1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_tratamiento_continua1 = str_replace('<', '&lt;', $this->evento_adverso_tratamiento_continua1);
         $this->evento_adverso_tratamiento_continua1 = str_replace('>', '&gt;', $this->evento_adverso_tratamiento_continua1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_tratamiento_continua1 . "</td>\r\n";
   }
   //----- evento_adverso_indicacion2
   function NM_export_evento_adverso_indicacion2()
   {
         $this->evento_adverso_indicacion2 = html_entity_decode($this->evento_adverso_indicacion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_indicacion2 = strip_tags($this->evento_adverso_indicacion2);
         if (!NM_is_utf8($this->evento_adverso_indicacion2))
         {
             $this->evento_adverso_indicacion2 = sc_convert_encoding($this->evento_adverso_indicacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_indicacion2 = str_replace('<', '&lt;', $this->evento_adverso_indicacion2);
         $this->evento_adverso_indicacion2 = str_replace('>', '&gt;', $this->evento_adverso_indicacion2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_indicacion2 . "</td>\r\n";
   }
   //----- evento_adverso_formulacion2
   function NM_export_evento_adverso_formulacion2()
   {
         $this->evento_adverso_formulacion2 = html_entity_decode($this->evento_adverso_formulacion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_formulacion2 = strip_tags($this->evento_adverso_formulacion2);
         if (!NM_is_utf8($this->evento_adverso_formulacion2))
         {
             $this->evento_adverso_formulacion2 = sc_convert_encoding($this->evento_adverso_formulacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_formulacion2 = str_replace('<', '&lt;', $this->evento_adverso_formulacion2);
         $this->evento_adverso_formulacion2 = str_replace('>', '&gt;', $this->evento_adverso_formulacion2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_formulacion2 . "</td>\r\n";
   }
   //----- evento_adverso_regimen_dosis2
   function NM_export_evento_adverso_regimen_dosis2()
   {
         $this->evento_adverso_regimen_dosis2 = html_entity_decode($this->evento_adverso_regimen_dosis2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_regimen_dosis2 = strip_tags($this->evento_adverso_regimen_dosis2);
         if (!NM_is_utf8($this->evento_adverso_regimen_dosis2))
         {
             $this->evento_adverso_regimen_dosis2 = sc_convert_encoding($this->evento_adverso_regimen_dosis2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_regimen_dosis2 = str_replace('<', '&lt;', $this->evento_adverso_regimen_dosis2);
         $this->evento_adverso_regimen_dosis2 = str_replace('>', '&gt;', $this->evento_adverso_regimen_dosis2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_regimen_dosis2 . "</td>\r\n";
   }
   //----- evento_adverso_ruta_administracion2
   function NM_export_evento_adverso_ruta_administracion2()
   {
         $this->evento_adverso_ruta_administracion2 = html_entity_decode($this->evento_adverso_ruta_administracion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_ruta_administracion2 = strip_tags($this->evento_adverso_ruta_administracion2);
         if (!NM_is_utf8($this->evento_adverso_ruta_administracion2))
         {
             $this->evento_adverso_ruta_administracion2 = sc_convert_encoding($this->evento_adverso_ruta_administracion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_ruta_administracion2 = str_replace('<', '&lt;', $this->evento_adverso_ruta_administracion2);
         $this->evento_adverso_ruta_administracion2 = str_replace('>', '&gt;', $this->evento_adverso_ruta_administracion2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_ruta_administracion2 . "</td>\r\n";
   }
   //----- evento_adverso_numero_lote2
   function NM_export_evento_adverso_numero_lote2()
   {
         $this->evento_adverso_numero_lote2 = html_entity_decode($this->evento_adverso_numero_lote2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_numero_lote2 = strip_tags($this->evento_adverso_numero_lote2);
         if (!NM_is_utf8($this->evento_adverso_numero_lote2))
         {
             $this->evento_adverso_numero_lote2 = sc_convert_encoding($this->evento_adverso_numero_lote2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_numero_lote2 = str_replace('<', '&lt;', $this->evento_adverso_numero_lote2);
         $this->evento_adverso_numero_lote2 = str_replace('>', '&gt;', $this->evento_adverso_numero_lote2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_numero_lote2 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_expiracion2
   function NM_export_evento_adverso_fecha_expiracion2()
   {
         $this->evento_adverso_fecha_expiracion2 = html_entity_decode($this->evento_adverso_fecha_expiracion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_expiracion2 = strip_tags($this->evento_adverso_fecha_expiracion2);
         if (!NM_is_utf8($this->evento_adverso_fecha_expiracion2))
         {
             $this->evento_adverso_fecha_expiracion2 = sc_convert_encoding($this->evento_adverso_fecha_expiracion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_expiracion2 = str_replace('<', '&lt;', $this->evento_adverso_fecha_expiracion2);
         $this->evento_adverso_fecha_expiracion2 = str_replace('>', '&gt;', $this->evento_adverso_fecha_expiracion2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_expiracion2 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_inicio2
   function NM_export_evento_adverso_fecha_inicio2()
   {
         $this->evento_adverso_fecha_inicio2 = html_entity_decode($this->evento_adverso_fecha_inicio2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_inicio2 = strip_tags($this->evento_adverso_fecha_inicio2);
         if (!NM_is_utf8($this->evento_adverso_fecha_inicio2))
         {
             $this->evento_adverso_fecha_inicio2 = sc_convert_encoding($this->evento_adverso_fecha_inicio2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_inicio2 = str_replace('<', '&lt;', $this->evento_adverso_fecha_inicio2);
         $this->evento_adverso_fecha_inicio2 = str_replace('>', '&gt;', $this->evento_adverso_fecha_inicio2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_inicio2 . "</td>\r\n";
   }
   //----- evento_adverso_tratamiento_continua2
   function NM_export_evento_adverso_tratamiento_continua2()
   {
         $this->evento_adverso_tratamiento_continua2 = html_entity_decode($this->evento_adverso_tratamiento_continua2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_tratamiento_continua2 = strip_tags($this->evento_adverso_tratamiento_continua2);
         if (!NM_is_utf8($this->evento_adverso_tratamiento_continua2))
         {
             $this->evento_adverso_tratamiento_continua2 = sc_convert_encoding($this->evento_adverso_tratamiento_continua2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_tratamiento_continua2 = str_replace('<', '&lt;', $this->evento_adverso_tratamiento_continua2);
         $this->evento_adverso_tratamiento_continua2 = str_replace('>', '&gt;', $this->evento_adverso_tratamiento_continua2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_tratamiento_continua2 . "</td>\r\n";
   }
   //----- evento_adverso_indicacion3
   function NM_export_evento_adverso_indicacion3()
   {
         $this->evento_adverso_indicacion3 = html_entity_decode($this->evento_adverso_indicacion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_indicacion3 = strip_tags($this->evento_adverso_indicacion3);
         if (!NM_is_utf8($this->evento_adverso_indicacion3))
         {
             $this->evento_adverso_indicacion3 = sc_convert_encoding($this->evento_adverso_indicacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_indicacion3 = str_replace('<', '&lt;', $this->evento_adverso_indicacion3);
         $this->evento_adverso_indicacion3 = str_replace('>', '&gt;', $this->evento_adverso_indicacion3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_indicacion3 . "</td>\r\n";
   }
   //----- evento_adverso_formulacion3
   function NM_export_evento_adverso_formulacion3()
   {
         $this->evento_adverso_formulacion3 = html_entity_decode($this->evento_adverso_formulacion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_formulacion3 = strip_tags($this->evento_adverso_formulacion3);
         if (!NM_is_utf8($this->evento_adverso_formulacion3))
         {
             $this->evento_adverso_formulacion3 = sc_convert_encoding($this->evento_adverso_formulacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_formulacion3 = str_replace('<', '&lt;', $this->evento_adverso_formulacion3);
         $this->evento_adverso_formulacion3 = str_replace('>', '&gt;', $this->evento_adverso_formulacion3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_formulacion3 . "</td>\r\n";
   }
   //----- evento_adverso_regimen_dosis3
   function NM_export_evento_adverso_regimen_dosis3()
   {
         $this->evento_adverso_regimen_dosis3 = html_entity_decode($this->evento_adverso_regimen_dosis3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_regimen_dosis3 = strip_tags($this->evento_adverso_regimen_dosis3);
         if (!NM_is_utf8($this->evento_adverso_regimen_dosis3))
         {
             $this->evento_adverso_regimen_dosis3 = sc_convert_encoding($this->evento_adverso_regimen_dosis3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_regimen_dosis3 = str_replace('<', '&lt;', $this->evento_adverso_regimen_dosis3);
         $this->evento_adverso_regimen_dosis3 = str_replace('>', '&gt;', $this->evento_adverso_regimen_dosis3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_regimen_dosis3 . "</td>\r\n";
   }
   //----- evento_adverso_ruta_administracion3
   function NM_export_evento_adverso_ruta_administracion3()
   {
         $this->evento_adverso_ruta_administracion3 = html_entity_decode($this->evento_adverso_ruta_administracion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_ruta_administracion3 = strip_tags($this->evento_adverso_ruta_administracion3);
         if (!NM_is_utf8($this->evento_adverso_ruta_administracion3))
         {
             $this->evento_adverso_ruta_administracion3 = sc_convert_encoding($this->evento_adverso_ruta_administracion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_ruta_administracion3 = str_replace('<', '&lt;', $this->evento_adverso_ruta_administracion3);
         $this->evento_adverso_ruta_administracion3 = str_replace('>', '&gt;', $this->evento_adverso_ruta_administracion3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_ruta_administracion3 . "</td>\r\n";
   }
   //----- evento_adverso_numero_lote3
   function NM_export_evento_adverso_numero_lote3()
   {
         $this->evento_adverso_numero_lote3 = html_entity_decode($this->evento_adverso_numero_lote3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_numero_lote3 = strip_tags($this->evento_adverso_numero_lote3);
         if (!NM_is_utf8($this->evento_adverso_numero_lote3))
         {
             $this->evento_adverso_numero_lote3 = sc_convert_encoding($this->evento_adverso_numero_lote3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_numero_lote3 = str_replace('<', '&lt;', $this->evento_adverso_numero_lote3);
         $this->evento_adverso_numero_lote3 = str_replace('>', '&gt;', $this->evento_adverso_numero_lote3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_numero_lote3 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_expiracion3
   function NM_export_evento_adverso_fecha_expiracion3()
   {
         $this->evento_adverso_fecha_expiracion3 = html_entity_decode($this->evento_adverso_fecha_expiracion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_expiracion3 = strip_tags($this->evento_adverso_fecha_expiracion3);
         if (!NM_is_utf8($this->evento_adverso_fecha_expiracion3))
         {
             $this->evento_adverso_fecha_expiracion3 = sc_convert_encoding($this->evento_adverso_fecha_expiracion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_expiracion3 = str_replace('<', '&lt;', $this->evento_adverso_fecha_expiracion3);
         $this->evento_adverso_fecha_expiracion3 = str_replace('>', '&gt;', $this->evento_adverso_fecha_expiracion3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_expiracion3 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_inicio3
   function NM_export_evento_adverso_fecha_inicio3()
   {
         $this->evento_adverso_fecha_inicio3 = html_entity_decode($this->evento_adverso_fecha_inicio3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_inicio3 = strip_tags($this->evento_adverso_fecha_inicio3);
         if (!NM_is_utf8($this->evento_adverso_fecha_inicio3))
         {
             $this->evento_adverso_fecha_inicio3 = sc_convert_encoding($this->evento_adverso_fecha_inicio3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_inicio3 = str_replace('<', '&lt;', $this->evento_adverso_fecha_inicio3);
         $this->evento_adverso_fecha_inicio3 = str_replace('>', '&gt;', $this->evento_adverso_fecha_inicio3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_inicio3 . "</td>\r\n";
   }
   //----- evento_adverso_tratamiento_continua3
   function NM_export_evento_adverso_tratamiento_continua3()
   {
         $this->evento_adverso_tratamiento_continua3 = html_entity_decode($this->evento_adverso_tratamiento_continua3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_tratamiento_continua3 = strip_tags($this->evento_adverso_tratamiento_continua3);
         if (!NM_is_utf8($this->evento_adverso_tratamiento_continua3))
         {
             $this->evento_adverso_tratamiento_continua3 = sc_convert_encoding($this->evento_adverso_tratamiento_continua3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_tratamiento_continua3 = str_replace('<', '&lt;', $this->evento_adverso_tratamiento_continua3);
         $this->evento_adverso_tratamiento_continua3 = str_replace('>', '&gt;', $this->evento_adverso_tratamiento_continua3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_tratamiento_continua3 . "</td>\r\n";
   }
   //----- evento_adverso_muestra_disponible
   function NM_export_evento_adverso_muestra_disponible()
   {
         $this->evento_adverso_muestra_disponible = html_entity_decode($this->evento_adverso_muestra_disponible, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_muestra_disponible = strip_tags($this->evento_adverso_muestra_disponible);
         if (!NM_is_utf8($this->evento_adverso_muestra_disponible))
         {
             $this->evento_adverso_muestra_disponible = sc_convert_encoding($this->evento_adverso_muestra_disponible, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_muestra_disponible = str_replace('<', '&lt;', $this->evento_adverso_muestra_disponible);
         $this->evento_adverso_muestra_disponible = str_replace('>', '&gt;', $this->evento_adverso_muestra_disponible);
         $this->texto_tag .= "<td>" . $this->evento_adverso_muestra_disponible . "</td>\r\n";
   }
   //----- evento_adverso_informacion_muestra
   function NM_export_evento_adverso_informacion_muestra()
   {
         if (!NM_is_utf8($this->evento_adverso_informacion_muestra))
         {
             $this->evento_adverso_informacion_muestra = sc_convert_encoding($this->evento_adverso_informacion_muestra, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_informacion_muestra = str_replace('<', '&lt;', $this->evento_adverso_informacion_muestra);
         $this->evento_adverso_informacion_muestra = str_replace('>', '&gt;', $this->evento_adverso_informacion_muestra);
         $this->texto_tag .= "<td>" . $this->evento_adverso_informacion_muestra . "</td>\r\n";
   }
   //----- evento_adverso_relacion_medicamento1
   function NM_export_evento_adverso_relacion_medicamento1()
   {
         $this->evento_adverso_relacion_medicamento1 = html_entity_decode($this->evento_adverso_relacion_medicamento1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_relacion_medicamento1 = strip_tags($this->evento_adverso_relacion_medicamento1);
         if (!NM_is_utf8($this->evento_adverso_relacion_medicamento1))
         {
             $this->evento_adverso_relacion_medicamento1 = sc_convert_encoding($this->evento_adverso_relacion_medicamento1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_relacion_medicamento1 = str_replace('<', '&lt;', $this->evento_adverso_relacion_medicamento1);
         $this->evento_adverso_relacion_medicamento1 = str_replace('>', '&gt;', $this->evento_adverso_relacion_medicamento1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_relacion_medicamento1 . "</td>\r\n";
   }
   //----- evento_adverso_relacionado_dispositivo1
   function NM_export_evento_adverso_relacionado_dispositivo1()
   {
         $this->evento_adverso_relacionado_dispositivo1 = html_entity_decode($this->evento_adverso_relacionado_dispositivo1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_relacionado_dispositivo1 = strip_tags($this->evento_adverso_relacionado_dispositivo1);
         if (!NM_is_utf8($this->evento_adverso_relacionado_dispositivo1))
         {
             $this->evento_adverso_relacionado_dispositivo1 = sc_convert_encoding($this->evento_adverso_relacionado_dispositivo1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_relacionado_dispositivo1 = str_replace('<', '&lt;', $this->evento_adverso_relacionado_dispositivo1);
         $this->evento_adverso_relacionado_dispositivo1 = str_replace('>', '&gt;', $this->evento_adverso_relacionado_dispositivo1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_relacionado_dispositivo1 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_inicio_evento1
   function NM_export_evento_adverso_fecha_inicio_evento1()
   {
         $this->evento_adverso_fecha_inicio_evento1 = html_entity_decode($this->evento_adverso_fecha_inicio_evento1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_inicio_evento1 = strip_tags($this->evento_adverso_fecha_inicio_evento1);
         if (!NM_is_utf8($this->evento_adverso_fecha_inicio_evento1))
         {
             $this->evento_adverso_fecha_inicio_evento1 = sc_convert_encoding($this->evento_adverso_fecha_inicio_evento1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_inicio_evento1 = str_replace('<', '&lt;', $this->evento_adverso_fecha_inicio_evento1);
         $this->evento_adverso_fecha_inicio_evento1 = str_replace('>', '&gt;', $this->evento_adverso_fecha_inicio_evento1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_inicio_evento1 . "</td>\r\n";
   }
   //----- evento_adverso_desenlace1
   function NM_export_evento_adverso_desenlace1()
   {
         $this->evento_adverso_desenlace1 = html_entity_decode($this->evento_adverso_desenlace1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_desenlace1 = strip_tags($this->evento_adverso_desenlace1);
         if (!NM_is_utf8($this->evento_adverso_desenlace1))
         {
             $this->evento_adverso_desenlace1 = sc_convert_encoding($this->evento_adverso_desenlace1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_desenlace1 = str_replace('<', '&lt;', $this->evento_adverso_desenlace1);
         $this->evento_adverso_desenlace1 = str_replace('>', '&gt;', $this->evento_adverso_desenlace1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_desenlace1 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_recuperacion1
   function NM_export_evento_adverso_fecha_recuperacion1()
   {
         $this->evento_adverso_fecha_recuperacion1 = html_entity_decode($this->evento_adverso_fecha_recuperacion1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_recuperacion1 = strip_tags($this->evento_adverso_fecha_recuperacion1);
         if (!NM_is_utf8($this->evento_adverso_fecha_recuperacion1))
         {
             $this->evento_adverso_fecha_recuperacion1 = sc_convert_encoding($this->evento_adverso_fecha_recuperacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_recuperacion1 = str_replace('<', '&lt;', $this->evento_adverso_fecha_recuperacion1);
         $this->evento_adverso_fecha_recuperacion1 = str_replace('>', '&gt;', $this->evento_adverso_fecha_recuperacion1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_recuperacion1 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_muerte1
   function NM_export_evento_adverso_fecha_muerte1()
   {
         $this->evento_adverso_fecha_muerte1 = html_entity_decode($this->evento_adverso_fecha_muerte1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_muerte1 = strip_tags($this->evento_adverso_fecha_muerte1);
         if (!NM_is_utf8($this->evento_adverso_fecha_muerte1))
         {
             $this->evento_adverso_fecha_muerte1 = sc_convert_encoding($this->evento_adverso_fecha_muerte1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_muerte1 = str_replace('<', '&lt;', $this->evento_adverso_fecha_muerte1);
         $this->evento_adverso_fecha_muerte1 = str_replace('>', '&gt;', $this->evento_adverso_fecha_muerte1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_muerte1 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad1
   function NM_export_evento_adverso_criterio_seriedad1()
   {
         $this->evento_adverso_criterio_seriedad1 = html_entity_decode($this->evento_adverso_criterio_seriedad1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad1 = strip_tags($this->evento_adverso_criterio_seriedad1);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad1))
         {
             $this->evento_adverso_criterio_seriedad1 = sc_convert_encoding($this->evento_adverso_criterio_seriedad1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad1 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad1);
         $this->evento_adverso_criterio_seriedad1 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad1 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_muerte1
   function NM_export_evento_adverso_criterio_seriedad_muerte1()
   {
         $this->evento_adverso_criterio_seriedad_muerte1 = html_entity_decode($this->evento_adverso_criterio_seriedad_muerte1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_muerte1 = strip_tags($this->evento_adverso_criterio_seriedad_muerte1);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_muerte1))
         {
             $this->evento_adverso_criterio_seriedad_muerte1 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_muerte1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_muerte1 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_muerte1);
         $this->evento_adverso_criterio_seriedad_muerte1 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_muerte1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_muerte1 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_hospitalizacion1
   function NM_export_evento_adverso_criterio_seriedad_hospitalizacion1()
   {
         $this->evento_adverso_criterio_seriedad_hospitalizacion1 = html_entity_decode($this->evento_adverso_criterio_seriedad_hospitalizacion1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_hospitalizacion1 = strip_tags($this->evento_adverso_criterio_seriedad_hospitalizacion1);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_hospitalizacion1))
         {
             $this->evento_adverso_criterio_seriedad_hospitalizacion1 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_hospitalizacion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_hospitalizacion1 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_hospitalizacion1);
         $this->evento_adverso_criterio_seriedad_hospitalizacion1 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_hospitalizacion1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_hospitalizacion1 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_amenaza1
   function NM_export_evento_adverso_criterio_seriedad_amenaza1()
   {
         $this->evento_adverso_criterio_seriedad_amenaza1 = html_entity_decode($this->evento_adverso_criterio_seriedad_amenaza1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_amenaza1 = strip_tags($this->evento_adverso_criterio_seriedad_amenaza1);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_amenaza1))
         {
             $this->evento_adverso_criterio_seriedad_amenaza1 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_amenaza1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_amenaza1 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_amenaza1);
         $this->evento_adverso_criterio_seriedad_amenaza1 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_amenaza1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_amenaza1 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_incapacidad1
   function NM_export_evento_adverso_criterio_seriedad_incapacidad1()
   {
         $this->evento_adverso_criterio_seriedad_incapacidad1 = html_entity_decode($this->evento_adverso_criterio_seriedad_incapacidad1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_incapacidad1 = strip_tags($this->evento_adverso_criterio_seriedad_incapacidad1);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_incapacidad1))
         {
             $this->evento_adverso_criterio_seriedad_incapacidad1 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_incapacidad1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_incapacidad1 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_incapacidad1);
         $this->evento_adverso_criterio_seriedad_incapacidad1 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_incapacidad1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_incapacidad1 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_anormalidad1
   function NM_export_evento_adverso_criterio_seriedad_anormalidad1()
   {
         $this->evento_adverso_criterio_seriedad_anormalidad1 = html_entity_decode($this->evento_adverso_criterio_seriedad_anormalidad1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_anormalidad1 = strip_tags($this->evento_adverso_criterio_seriedad_anormalidad1);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_anormalidad1))
         {
             $this->evento_adverso_criterio_seriedad_anormalidad1 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_anormalidad1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_anormalidad1 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_anormalidad1);
         $this->evento_adverso_criterio_seriedad_anormalidad1 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_anormalidad1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_anormalidad1 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_evento1
   function NM_export_evento_adverso_criterio_seriedad_evento1()
   {
         $this->evento_adverso_criterio_seriedad_evento1 = html_entity_decode($this->evento_adverso_criterio_seriedad_evento1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_evento1 = strip_tags($this->evento_adverso_criterio_seriedad_evento1);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_evento1))
         {
             $this->evento_adverso_criterio_seriedad_evento1 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_evento1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_evento1 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_evento1);
         $this->evento_adverso_criterio_seriedad_evento1 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_evento1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_evento1 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_quirurgica1
   function NM_export_evento_adverso_criterio_seriedad_quirurgica1()
   {
         $this->evento_adverso_criterio_seriedad_quirurgica1 = html_entity_decode($this->evento_adverso_criterio_seriedad_quirurgica1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_quirurgica1 = strip_tags($this->evento_adverso_criterio_seriedad_quirurgica1);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_quirurgica1))
         {
             $this->evento_adverso_criterio_seriedad_quirurgica1 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_quirurgica1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_quirurgica1 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_quirurgica1);
         $this->evento_adverso_criterio_seriedad_quirurgica1 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_quirurgica1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_quirurgica1 . "</td>\r\n";
   }
   //----- evento_adverso_causa_muerte1
   function NM_export_evento_adverso_causa_muerte1()
   {
         $this->evento_adverso_causa_muerte1 = html_entity_decode($this->evento_adverso_causa_muerte1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_causa_muerte1 = strip_tags($this->evento_adverso_causa_muerte1);
         if (!NM_is_utf8($this->evento_adverso_causa_muerte1))
         {
             $this->evento_adverso_causa_muerte1 = sc_convert_encoding($this->evento_adverso_causa_muerte1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_causa_muerte1 = str_replace('<', '&lt;', $this->evento_adverso_causa_muerte1);
         $this->evento_adverso_causa_muerte1 = str_replace('>', '&gt;', $this->evento_adverso_causa_muerte1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_causa_muerte1 . "</td>\r\n";
   }
   //----- evento_adverso_detalles_ea1
   function NM_export_evento_adverso_detalles_ea1()
   {
         $this->evento_adverso_detalles_ea1 = html_entity_decode($this->evento_adverso_detalles_ea1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_detalles_ea1 = strip_tags($this->evento_adverso_detalles_ea1);
         if (!NM_is_utf8($this->evento_adverso_detalles_ea1))
         {
             $this->evento_adverso_detalles_ea1 = sc_convert_encoding($this->evento_adverso_detalles_ea1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_detalles_ea1 = str_replace('<', '&lt;', $this->evento_adverso_detalles_ea1);
         $this->evento_adverso_detalles_ea1 = str_replace('>', '&gt;', $this->evento_adverso_detalles_ea1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_detalles_ea1 . "</td>\r\n";
   }
   //----- evento_adverso_relacion_medicamento2
   function NM_export_evento_adverso_relacion_medicamento2()
   {
         $this->evento_adverso_relacion_medicamento2 = html_entity_decode($this->evento_adverso_relacion_medicamento2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_relacion_medicamento2 = strip_tags($this->evento_adverso_relacion_medicamento2);
         if (!NM_is_utf8($this->evento_adverso_relacion_medicamento2))
         {
             $this->evento_adverso_relacion_medicamento2 = sc_convert_encoding($this->evento_adverso_relacion_medicamento2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_relacion_medicamento2 = str_replace('<', '&lt;', $this->evento_adverso_relacion_medicamento2);
         $this->evento_adverso_relacion_medicamento2 = str_replace('>', '&gt;', $this->evento_adverso_relacion_medicamento2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_relacion_medicamento2 . "</td>\r\n";
   }
   //----- evento_adverso_relacionado_dispositivo2
   function NM_export_evento_adverso_relacionado_dispositivo2()
   {
         $this->evento_adverso_relacionado_dispositivo2 = html_entity_decode($this->evento_adverso_relacionado_dispositivo2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_relacionado_dispositivo2 = strip_tags($this->evento_adverso_relacionado_dispositivo2);
         if (!NM_is_utf8($this->evento_adverso_relacionado_dispositivo2))
         {
             $this->evento_adverso_relacionado_dispositivo2 = sc_convert_encoding($this->evento_adverso_relacionado_dispositivo2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_relacionado_dispositivo2 = str_replace('<', '&lt;', $this->evento_adverso_relacionado_dispositivo2);
         $this->evento_adverso_relacionado_dispositivo2 = str_replace('>', '&gt;', $this->evento_adverso_relacionado_dispositivo2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_relacionado_dispositivo2 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_inicio_evento2
   function NM_export_evento_adverso_fecha_inicio_evento2()
   {
         $this->evento_adverso_fecha_inicio_evento2 = html_entity_decode($this->evento_adverso_fecha_inicio_evento2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_inicio_evento2 = strip_tags($this->evento_adverso_fecha_inicio_evento2);
         if (!NM_is_utf8($this->evento_adverso_fecha_inicio_evento2))
         {
             $this->evento_adverso_fecha_inicio_evento2 = sc_convert_encoding($this->evento_adverso_fecha_inicio_evento2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_inicio_evento2 = str_replace('<', '&lt;', $this->evento_adverso_fecha_inicio_evento2);
         $this->evento_adverso_fecha_inicio_evento2 = str_replace('>', '&gt;', $this->evento_adverso_fecha_inicio_evento2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_inicio_evento2 . "</td>\r\n";
   }
   //----- evento_adverso_desenlace2
   function NM_export_evento_adverso_desenlace2()
   {
         $this->evento_adverso_desenlace2 = html_entity_decode($this->evento_adverso_desenlace2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_desenlace2 = strip_tags($this->evento_adverso_desenlace2);
         if (!NM_is_utf8($this->evento_adverso_desenlace2))
         {
             $this->evento_adverso_desenlace2 = sc_convert_encoding($this->evento_adverso_desenlace2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_desenlace2 = str_replace('<', '&lt;', $this->evento_adverso_desenlace2);
         $this->evento_adverso_desenlace2 = str_replace('>', '&gt;', $this->evento_adverso_desenlace2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_desenlace2 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_recuperacion2
   function NM_export_evento_adverso_fecha_recuperacion2()
   {
         $this->evento_adverso_fecha_recuperacion2 = html_entity_decode($this->evento_adverso_fecha_recuperacion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_recuperacion2 = strip_tags($this->evento_adverso_fecha_recuperacion2);
         if (!NM_is_utf8($this->evento_adverso_fecha_recuperacion2))
         {
             $this->evento_adverso_fecha_recuperacion2 = sc_convert_encoding($this->evento_adverso_fecha_recuperacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_recuperacion2 = str_replace('<', '&lt;', $this->evento_adverso_fecha_recuperacion2);
         $this->evento_adverso_fecha_recuperacion2 = str_replace('>', '&gt;', $this->evento_adverso_fecha_recuperacion2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_recuperacion2 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_muerte2
   function NM_export_evento_adverso_fecha_muerte2()
   {
         $this->evento_adverso_fecha_muerte2 = html_entity_decode($this->evento_adverso_fecha_muerte2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_muerte2 = strip_tags($this->evento_adverso_fecha_muerte2);
         if (!NM_is_utf8($this->evento_adverso_fecha_muerte2))
         {
             $this->evento_adverso_fecha_muerte2 = sc_convert_encoding($this->evento_adverso_fecha_muerte2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_muerte2 = str_replace('<', '&lt;', $this->evento_adverso_fecha_muerte2);
         $this->evento_adverso_fecha_muerte2 = str_replace('>', '&gt;', $this->evento_adverso_fecha_muerte2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_muerte2 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad2
   function NM_export_evento_adverso_criterio_seriedad2()
   {
         $this->evento_adverso_criterio_seriedad2 = html_entity_decode($this->evento_adverso_criterio_seriedad2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad2 = strip_tags($this->evento_adverso_criterio_seriedad2);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad2))
         {
             $this->evento_adverso_criterio_seriedad2 = sc_convert_encoding($this->evento_adverso_criterio_seriedad2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad2 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad2);
         $this->evento_adverso_criterio_seriedad2 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad2 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_muerte2
   function NM_export_evento_adverso_criterio_seriedad_muerte2()
   {
         $this->evento_adverso_criterio_seriedad_muerte2 = html_entity_decode($this->evento_adverso_criterio_seriedad_muerte2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_muerte2 = strip_tags($this->evento_adverso_criterio_seriedad_muerte2);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_muerte2))
         {
             $this->evento_adverso_criterio_seriedad_muerte2 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_muerte2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_muerte2 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_muerte2);
         $this->evento_adverso_criterio_seriedad_muerte2 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_muerte2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_muerte2 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_hospitalizacion2
   function NM_export_evento_adverso_criterio_seriedad_hospitalizacion2()
   {
         $this->evento_adverso_criterio_seriedad_hospitalizacion2 = html_entity_decode($this->evento_adverso_criterio_seriedad_hospitalizacion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_hospitalizacion2 = strip_tags($this->evento_adverso_criterio_seriedad_hospitalizacion2);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_hospitalizacion2))
         {
             $this->evento_adverso_criterio_seriedad_hospitalizacion2 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_hospitalizacion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_hospitalizacion2 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_hospitalizacion2);
         $this->evento_adverso_criterio_seriedad_hospitalizacion2 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_hospitalizacion2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_hospitalizacion2 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_amenaza2
   function NM_export_evento_adverso_criterio_seriedad_amenaza2()
   {
         $this->evento_adverso_criterio_seriedad_amenaza2 = html_entity_decode($this->evento_adverso_criterio_seriedad_amenaza2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_amenaza2 = strip_tags($this->evento_adverso_criterio_seriedad_amenaza2);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_amenaza2))
         {
             $this->evento_adverso_criterio_seriedad_amenaza2 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_amenaza2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_amenaza2 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_amenaza2);
         $this->evento_adverso_criterio_seriedad_amenaza2 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_amenaza2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_amenaza2 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_incapacidad2
   function NM_export_evento_adverso_criterio_seriedad_incapacidad2()
   {
         $this->evento_adverso_criterio_seriedad_incapacidad2 = html_entity_decode($this->evento_adverso_criterio_seriedad_incapacidad2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_incapacidad2 = strip_tags($this->evento_adverso_criterio_seriedad_incapacidad2);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_incapacidad2))
         {
             $this->evento_adverso_criterio_seriedad_incapacidad2 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_incapacidad2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_incapacidad2 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_incapacidad2);
         $this->evento_adverso_criterio_seriedad_incapacidad2 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_incapacidad2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_incapacidad2 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_anormalidad2
   function NM_export_evento_adverso_criterio_seriedad_anormalidad2()
   {
         $this->evento_adverso_criterio_seriedad_anormalidad2 = html_entity_decode($this->evento_adverso_criterio_seriedad_anormalidad2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_anormalidad2 = strip_tags($this->evento_adverso_criterio_seriedad_anormalidad2);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_anormalidad2))
         {
             $this->evento_adverso_criterio_seriedad_anormalidad2 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_anormalidad2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_anormalidad2 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_anormalidad2);
         $this->evento_adverso_criterio_seriedad_anormalidad2 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_anormalidad2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_anormalidad2 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_evento2
   function NM_export_evento_adverso_criterio_seriedad_evento2()
   {
         $this->evento_adverso_criterio_seriedad_evento2 = html_entity_decode($this->evento_adverso_criterio_seriedad_evento2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_evento2 = strip_tags($this->evento_adverso_criterio_seriedad_evento2);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_evento2))
         {
             $this->evento_adverso_criterio_seriedad_evento2 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_evento2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_evento2 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_evento2);
         $this->evento_adverso_criterio_seriedad_evento2 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_evento2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_evento2 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_quirurgica2
   function NM_export_evento_adverso_criterio_seriedad_quirurgica2()
   {
         $this->evento_adverso_criterio_seriedad_quirurgica2 = html_entity_decode($this->evento_adverso_criterio_seriedad_quirurgica2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_quirurgica2 = strip_tags($this->evento_adverso_criterio_seriedad_quirurgica2);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_quirurgica2))
         {
             $this->evento_adverso_criterio_seriedad_quirurgica2 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_quirurgica2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_quirurgica2 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_quirurgica2);
         $this->evento_adverso_criterio_seriedad_quirurgica2 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_quirurgica2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_quirurgica2 . "</td>\r\n";
   }
   //----- evento_adverso_causa_muerte2
   function NM_export_evento_adverso_causa_muerte2()
   {
         $this->evento_adverso_causa_muerte2 = html_entity_decode($this->evento_adverso_causa_muerte2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_causa_muerte2 = strip_tags($this->evento_adverso_causa_muerte2);
         if (!NM_is_utf8($this->evento_adverso_causa_muerte2))
         {
             $this->evento_adverso_causa_muerte2 = sc_convert_encoding($this->evento_adverso_causa_muerte2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_causa_muerte2 = str_replace('<', '&lt;', $this->evento_adverso_causa_muerte2);
         $this->evento_adverso_causa_muerte2 = str_replace('>', '&gt;', $this->evento_adverso_causa_muerte2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_causa_muerte2 . "</td>\r\n";
   }
   //----- evento_adverso_detalles_ea2
   function NM_export_evento_adverso_detalles_ea2()
   {
         $this->evento_adverso_detalles_ea2 = html_entity_decode($this->evento_adverso_detalles_ea2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_detalles_ea2 = strip_tags($this->evento_adverso_detalles_ea2);
         if (!NM_is_utf8($this->evento_adverso_detalles_ea2))
         {
             $this->evento_adverso_detalles_ea2 = sc_convert_encoding($this->evento_adverso_detalles_ea2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_detalles_ea2 = str_replace('<', '&lt;', $this->evento_adverso_detalles_ea2);
         $this->evento_adverso_detalles_ea2 = str_replace('>', '&gt;', $this->evento_adverso_detalles_ea2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_detalles_ea2 . "</td>\r\n";
   }
   //----- evento_adverso_relacion_medicamento3
   function NM_export_evento_adverso_relacion_medicamento3()
   {
         $this->evento_adverso_relacion_medicamento3 = html_entity_decode($this->evento_adverso_relacion_medicamento3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_relacion_medicamento3 = strip_tags($this->evento_adverso_relacion_medicamento3);
         if (!NM_is_utf8($this->evento_adverso_relacion_medicamento3))
         {
             $this->evento_adverso_relacion_medicamento3 = sc_convert_encoding($this->evento_adverso_relacion_medicamento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_relacion_medicamento3 = str_replace('<', '&lt;', $this->evento_adverso_relacion_medicamento3);
         $this->evento_adverso_relacion_medicamento3 = str_replace('>', '&gt;', $this->evento_adverso_relacion_medicamento3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_relacion_medicamento3 . "</td>\r\n";
   }
   //----- evento_adverso_relacionado_dispositivo3
   function NM_export_evento_adverso_relacionado_dispositivo3()
   {
         $this->evento_adverso_relacionado_dispositivo3 = html_entity_decode($this->evento_adverso_relacionado_dispositivo3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_relacionado_dispositivo3 = strip_tags($this->evento_adverso_relacionado_dispositivo3);
         if (!NM_is_utf8($this->evento_adverso_relacionado_dispositivo3))
         {
             $this->evento_adverso_relacionado_dispositivo3 = sc_convert_encoding($this->evento_adverso_relacionado_dispositivo3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_relacionado_dispositivo3 = str_replace('<', '&lt;', $this->evento_adverso_relacionado_dispositivo3);
         $this->evento_adverso_relacionado_dispositivo3 = str_replace('>', '&gt;', $this->evento_adverso_relacionado_dispositivo3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_relacionado_dispositivo3 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_inicio_evento3
   function NM_export_evento_adverso_fecha_inicio_evento3()
   {
         $this->evento_adverso_fecha_inicio_evento3 = html_entity_decode($this->evento_adverso_fecha_inicio_evento3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_inicio_evento3 = strip_tags($this->evento_adverso_fecha_inicio_evento3);
         if (!NM_is_utf8($this->evento_adverso_fecha_inicio_evento3))
         {
             $this->evento_adverso_fecha_inicio_evento3 = sc_convert_encoding($this->evento_adverso_fecha_inicio_evento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_inicio_evento3 = str_replace('<', '&lt;', $this->evento_adverso_fecha_inicio_evento3);
         $this->evento_adverso_fecha_inicio_evento3 = str_replace('>', '&gt;', $this->evento_adverso_fecha_inicio_evento3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_inicio_evento3 . "</td>\r\n";
   }
   //----- evento_adverso_desenlace3
   function NM_export_evento_adverso_desenlace3()
   {
         $this->evento_adverso_desenlace3 = html_entity_decode($this->evento_adverso_desenlace3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_desenlace3 = strip_tags($this->evento_adverso_desenlace3);
         if (!NM_is_utf8($this->evento_adverso_desenlace3))
         {
             $this->evento_adverso_desenlace3 = sc_convert_encoding($this->evento_adverso_desenlace3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_desenlace3 = str_replace('<', '&lt;', $this->evento_adverso_desenlace3);
         $this->evento_adverso_desenlace3 = str_replace('>', '&gt;', $this->evento_adverso_desenlace3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_desenlace3 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_recuperacion3
   function NM_export_evento_adverso_fecha_recuperacion3()
   {
         $this->evento_adverso_fecha_recuperacion3 = html_entity_decode($this->evento_adverso_fecha_recuperacion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_recuperacion3 = strip_tags($this->evento_adverso_fecha_recuperacion3);
         if (!NM_is_utf8($this->evento_adverso_fecha_recuperacion3))
         {
             $this->evento_adverso_fecha_recuperacion3 = sc_convert_encoding($this->evento_adverso_fecha_recuperacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_recuperacion3 = str_replace('<', '&lt;', $this->evento_adverso_fecha_recuperacion3);
         $this->evento_adverso_fecha_recuperacion3 = str_replace('>', '&gt;', $this->evento_adverso_fecha_recuperacion3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_recuperacion3 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_muerte3
   function NM_export_evento_adverso_fecha_muerte3()
   {
         $this->evento_adverso_fecha_muerte3 = html_entity_decode($this->evento_adverso_fecha_muerte3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_muerte3 = strip_tags($this->evento_adverso_fecha_muerte3);
         if (!NM_is_utf8($this->evento_adverso_fecha_muerte3))
         {
             $this->evento_adverso_fecha_muerte3 = sc_convert_encoding($this->evento_adverso_fecha_muerte3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_muerte3 = str_replace('<', '&lt;', $this->evento_adverso_fecha_muerte3);
         $this->evento_adverso_fecha_muerte3 = str_replace('>', '&gt;', $this->evento_adverso_fecha_muerte3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_muerte3 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad3
   function NM_export_evento_adverso_criterio_seriedad3()
   {
         $this->evento_adverso_criterio_seriedad3 = html_entity_decode($this->evento_adverso_criterio_seriedad3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad3 = strip_tags($this->evento_adverso_criterio_seriedad3);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad3))
         {
             $this->evento_adverso_criterio_seriedad3 = sc_convert_encoding($this->evento_adverso_criterio_seriedad3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad3 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad3);
         $this->evento_adverso_criterio_seriedad3 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad3 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_muerte3
   function NM_export_evento_adverso_criterio_seriedad_muerte3()
   {
         $this->evento_adverso_criterio_seriedad_muerte3 = html_entity_decode($this->evento_adverso_criterio_seriedad_muerte3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_muerte3 = strip_tags($this->evento_adverso_criterio_seriedad_muerte3);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_muerte3))
         {
             $this->evento_adverso_criterio_seriedad_muerte3 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_muerte3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_muerte3 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_muerte3);
         $this->evento_adverso_criterio_seriedad_muerte3 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_muerte3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_muerte3 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_hospitalizacion3
   function NM_export_evento_adverso_criterio_seriedad_hospitalizacion3()
   {
         $this->evento_adverso_criterio_seriedad_hospitalizacion3 = html_entity_decode($this->evento_adverso_criterio_seriedad_hospitalizacion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_hospitalizacion3 = strip_tags($this->evento_adverso_criterio_seriedad_hospitalizacion3);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_hospitalizacion3))
         {
             $this->evento_adverso_criterio_seriedad_hospitalizacion3 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_hospitalizacion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_hospitalizacion3 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_hospitalizacion3);
         $this->evento_adverso_criterio_seriedad_hospitalizacion3 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_hospitalizacion3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_hospitalizacion3 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_amenaza3
   function NM_export_evento_adverso_criterio_seriedad_amenaza3()
   {
         $this->evento_adverso_criterio_seriedad_amenaza3 = html_entity_decode($this->evento_adverso_criterio_seriedad_amenaza3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_amenaza3 = strip_tags($this->evento_adverso_criterio_seriedad_amenaza3);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_amenaza3))
         {
             $this->evento_adverso_criterio_seriedad_amenaza3 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_amenaza3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_amenaza3 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_amenaza3);
         $this->evento_adverso_criterio_seriedad_amenaza3 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_amenaza3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_amenaza3 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_incapacidad3
   function NM_export_evento_adverso_criterio_seriedad_incapacidad3()
   {
         $this->evento_adverso_criterio_seriedad_incapacidad3 = html_entity_decode($this->evento_adverso_criterio_seriedad_incapacidad3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_incapacidad3 = strip_tags($this->evento_adverso_criterio_seriedad_incapacidad3);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_incapacidad3))
         {
             $this->evento_adverso_criterio_seriedad_incapacidad3 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_incapacidad3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_incapacidad3 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_incapacidad3);
         $this->evento_adverso_criterio_seriedad_incapacidad3 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_incapacidad3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_incapacidad3 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_anormalidad3
   function NM_export_evento_adverso_criterio_seriedad_anormalidad3()
   {
         $this->evento_adverso_criterio_seriedad_anormalidad3 = html_entity_decode($this->evento_adverso_criterio_seriedad_anormalidad3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_anormalidad3 = strip_tags($this->evento_adverso_criterio_seriedad_anormalidad3);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_anormalidad3))
         {
             $this->evento_adverso_criterio_seriedad_anormalidad3 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_anormalidad3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_anormalidad3 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_anormalidad3);
         $this->evento_adverso_criterio_seriedad_anormalidad3 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_anormalidad3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_anormalidad3 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_evento3
   function NM_export_evento_adverso_criterio_seriedad_evento3()
   {
         $this->evento_adverso_criterio_seriedad_evento3 = html_entity_decode($this->evento_adverso_criterio_seriedad_evento3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_evento3 = strip_tags($this->evento_adverso_criterio_seriedad_evento3);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_evento3))
         {
             $this->evento_adverso_criterio_seriedad_evento3 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_evento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_evento3 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_evento3);
         $this->evento_adverso_criterio_seriedad_evento3 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_evento3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_evento3 . "</td>\r\n";
   }
   //----- evento_adverso_criterio_seriedad_quirurgica3
   function NM_export_evento_adverso_criterio_seriedad_quirurgica3()
   {
         $this->evento_adverso_criterio_seriedad_quirurgica3 = html_entity_decode($this->evento_adverso_criterio_seriedad_quirurgica3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_criterio_seriedad_quirurgica3 = strip_tags($this->evento_adverso_criterio_seriedad_quirurgica3);
         if (!NM_is_utf8($this->evento_adverso_criterio_seriedad_quirurgica3))
         {
             $this->evento_adverso_criterio_seriedad_quirurgica3 = sc_convert_encoding($this->evento_adverso_criterio_seriedad_quirurgica3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_criterio_seriedad_quirurgica3 = str_replace('<', '&lt;', $this->evento_adverso_criterio_seriedad_quirurgica3);
         $this->evento_adverso_criterio_seriedad_quirurgica3 = str_replace('>', '&gt;', $this->evento_adverso_criterio_seriedad_quirurgica3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_criterio_seriedad_quirurgica3 . "</td>\r\n";
   }
   //----- evento_adverso_causa_muerte3
   function NM_export_evento_adverso_causa_muerte3()
   {
         $this->evento_adverso_causa_muerte3 = html_entity_decode($this->evento_adverso_causa_muerte3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_causa_muerte3 = strip_tags($this->evento_adverso_causa_muerte3);
         if (!NM_is_utf8($this->evento_adverso_causa_muerte3))
         {
             $this->evento_adverso_causa_muerte3 = sc_convert_encoding($this->evento_adverso_causa_muerte3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_causa_muerte3 = str_replace('<', '&lt;', $this->evento_adverso_causa_muerte3);
         $this->evento_adverso_causa_muerte3 = str_replace('>', '&gt;', $this->evento_adverso_causa_muerte3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_causa_muerte3 . "</td>\r\n";
   }
   //----- evento_adverso_detalles_ea3
   function NM_export_evento_adverso_detalles_ea3()
   {
         $this->evento_adverso_detalles_ea3 = html_entity_decode($this->evento_adverso_detalles_ea3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_detalles_ea3 = strip_tags($this->evento_adverso_detalles_ea3);
         if (!NM_is_utf8($this->evento_adverso_detalles_ea3))
         {
             $this->evento_adverso_detalles_ea3 = sc_convert_encoding($this->evento_adverso_detalles_ea3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_detalles_ea3 = str_replace('<', '&lt;', $this->evento_adverso_detalles_ea3);
         $this->evento_adverso_detalles_ea3 = str_replace('>', '&gt;', $this->evento_adverso_detalles_ea3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_detalles_ea3 . "</td>\r\n";
   }
   //----- evento_adverso_informacion_adicional
   function NM_export_evento_adverso_informacion_adicional()
   {
         if (!NM_is_utf8($this->evento_adverso_informacion_adicional))
         {
             $this->evento_adverso_informacion_adicional = sc_convert_encoding($this->evento_adverso_informacion_adicional, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_informacion_adicional = str_replace('<', '&lt;', $this->evento_adverso_informacion_adicional);
         $this->evento_adverso_informacion_adicional = str_replace('>', '&gt;', $this->evento_adverso_informacion_adicional);
         $this->texto_tag .= "<td>" . $this->evento_adverso_informacion_adicional . "</td>\r\n";
   }
   //----- evento_adverso_nombre_reporte
   function NM_export_evento_adverso_nombre_reporte()
   {
         $this->evento_adverso_nombre_reporte = html_entity_decode($this->evento_adverso_nombre_reporte, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_nombre_reporte = strip_tags($this->evento_adverso_nombre_reporte);
         if (!NM_is_utf8($this->evento_adverso_nombre_reporte))
         {
             $this->evento_adverso_nombre_reporte = sc_convert_encoding($this->evento_adverso_nombre_reporte, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_nombre_reporte = str_replace('<', '&lt;', $this->evento_adverso_nombre_reporte);
         $this->evento_adverso_nombre_reporte = str_replace('>', '&gt;', $this->evento_adverso_nombre_reporte);
         $this->texto_tag .= "<td>" . $this->evento_adverso_nombre_reporte . "</td>\r\n";
   }
   //----- evento_adverso_id_paciente_fk
   function NM_export_evento_adverso_id_paciente_fk()
   {
         nmgp_Form_Num_Val($this->evento_adverso_id_paciente_fk, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->evento_adverso_id_paciente_fk))
         {
             $this->evento_adverso_id_paciente_fk = sc_convert_encoding($this->evento_adverso_id_paciente_fk, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_id_paciente_fk = str_replace('<', '&lt;', $this->evento_adverso_id_paciente_fk);
         $this->evento_adverso_id_paciente_fk = str_replace('>', '&gt;', $this->evento_adverso_id_paciente_fk);
         $this->texto_tag .= "<td>" . $this->evento_adverso_id_paciente_fk . "</td>\r\n";
   }
   //----- evento_adverso_medicamento1
   function NM_export_evento_adverso_medicamento1()
   {
         $this->evento_adverso_medicamento1 = html_entity_decode($this->evento_adverso_medicamento1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_medicamento1 = strip_tags($this->evento_adverso_medicamento1);
         if (!NM_is_utf8($this->evento_adverso_medicamento1))
         {
             $this->evento_adverso_medicamento1 = sc_convert_encoding($this->evento_adverso_medicamento1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_medicamento1 = str_replace('<', '&lt;', $this->evento_adverso_medicamento1);
         $this->evento_adverso_medicamento1 = str_replace('>', '&gt;', $this->evento_adverso_medicamento1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_medicamento1 . "</td>\r\n";
   }
   //----- evento_adverso_medicamento2
   function NM_export_evento_adverso_medicamento2()
   {
         $this->evento_adverso_medicamento2 = html_entity_decode($this->evento_adverso_medicamento2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_medicamento2 = strip_tags($this->evento_adverso_medicamento2);
         if (!NM_is_utf8($this->evento_adverso_medicamento2))
         {
             $this->evento_adverso_medicamento2 = sc_convert_encoding($this->evento_adverso_medicamento2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_medicamento2 = str_replace('<', '&lt;', $this->evento_adverso_medicamento2);
         $this->evento_adverso_medicamento2 = str_replace('>', '&gt;', $this->evento_adverso_medicamento2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_medicamento2 . "</td>\r\n";
   }
   //----- evento_adverso_medicamento3
   function NM_export_evento_adverso_medicamento3()
   {
         $this->evento_adverso_medicamento3 = html_entity_decode($this->evento_adverso_medicamento3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_medicamento3 = strip_tags($this->evento_adverso_medicamento3);
         if (!NM_is_utf8($this->evento_adverso_medicamento3))
         {
             $this->evento_adverso_medicamento3 = sc_convert_encoding($this->evento_adverso_medicamento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_medicamento3 = str_replace('<', '&lt;', $this->evento_adverso_medicamento3);
         $this->evento_adverso_medicamento3 = str_replace('>', '&gt;', $this->evento_adverso_medicamento3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_medicamento3 . "</td>\r\n";
   }
   //----- evento_adverso_informacion_ea1
   function NM_export_evento_adverso_informacion_ea1()
   {
         $this->evento_adverso_informacion_ea1 = html_entity_decode($this->evento_adverso_informacion_ea1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_informacion_ea1 = strip_tags($this->evento_adverso_informacion_ea1);
         if (!NM_is_utf8($this->evento_adverso_informacion_ea1))
         {
             $this->evento_adverso_informacion_ea1 = sc_convert_encoding($this->evento_adverso_informacion_ea1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_informacion_ea1 = str_replace('<', '&lt;', $this->evento_adverso_informacion_ea1);
         $this->evento_adverso_informacion_ea1 = str_replace('>', '&gt;', $this->evento_adverso_informacion_ea1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_informacion_ea1 . "</td>\r\n";
   }
   //----- evento_adverso_informacion_ea2
   function NM_export_evento_adverso_informacion_ea2()
   {
         $this->evento_adverso_informacion_ea2 = html_entity_decode($this->evento_adverso_informacion_ea2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_informacion_ea2 = strip_tags($this->evento_adverso_informacion_ea2);
         if (!NM_is_utf8($this->evento_adverso_informacion_ea2))
         {
             $this->evento_adverso_informacion_ea2 = sc_convert_encoding($this->evento_adverso_informacion_ea2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_informacion_ea2 = str_replace('<', '&lt;', $this->evento_adverso_informacion_ea2);
         $this->evento_adverso_informacion_ea2 = str_replace('>', '&gt;', $this->evento_adverso_informacion_ea2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_informacion_ea2 . "</td>\r\n";
   }
   //----- evento_adverso_informacion_ea3
   function NM_export_evento_adverso_informacion_ea3()
   {
         $this->evento_adverso_informacion_ea3 = html_entity_decode($this->evento_adverso_informacion_ea3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_informacion_ea3 = strip_tags($this->evento_adverso_informacion_ea3);
         if (!NM_is_utf8($this->evento_adverso_informacion_ea3))
         {
             $this->evento_adverso_informacion_ea3 = sc_convert_encoding($this->evento_adverso_informacion_ea3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_informacion_ea3 = str_replace('<', '&lt;', $this->evento_adverso_informacion_ea3);
         $this->evento_adverso_informacion_ea3 = str_replace('>', '&gt;', $this->evento_adverso_informacion_ea3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_informacion_ea3 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_suspencion1
   function NM_export_evento_adverso_fecha_suspencion1()
   {
         $this->evento_adverso_fecha_suspencion1 = html_entity_decode($this->evento_adverso_fecha_suspencion1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_suspencion1 = strip_tags($this->evento_adverso_fecha_suspencion1);
         if (!NM_is_utf8($this->evento_adverso_fecha_suspencion1))
         {
             $this->evento_adverso_fecha_suspencion1 = sc_convert_encoding($this->evento_adverso_fecha_suspencion1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_suspencion1 = str_replace('<', '&lt;', $this->evento_adverso_fecha_suspencion1);
         $this->evento_adverso_fecha_suspencion1 = str_replace('>', '&gt;', $this->evento_adverso_fecha_suspencion1);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_suspencion1 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_suspencion2
   function NM_export_evento_adverso_fecha_suspencion2()
   {
         $this->evento_adverso_fecha_suspencion2 = html_entity_decode($this->evento_adverso_fecha_suspencion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_suspencion2 = strip_tags($this->evento_adverso_fecha_suspencion2);
         if (!NM_is_utf8($this->evento_adverso_fecha_suspencion2))
         {
             $this->evento_adverso_fecha_suspencion2 = sc_convert_encoding($this->evento_adverso_fecha_suspencion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_suspencion2 = str_replace('<', '&lt;', $this->evento_adverso_fecha_suspencion2);
         $this->evento_adverso_fecha_suspencion2 = str_replace('>', '&gt;', $this->evento_adverso_fecha_suspencion2);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_suspencion2 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_suspencion3
   function NM_export_evento_adverso_fecha_suspencion3()
   {
         $this->evento_adverso_fecha_suspencion3 = html_entity_decode($this->evento_adverso_fecha_suspencion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_fecha_suspencion3 = strip_tags($this->evento_adverso_fecha_suspencion3);
         if (!NM_is_utf8($this->evento_adverso_fecha_suspencion3))
         {
             $this->evento_adverso_fecha_suspencion3 = sc_convert_encoding($this->evento_adverso_fecha_suspencion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_suspencion3 = str_replace('<', '&lt;', $this->evento_adverso_fecha_suspencion3);
         $this->evento_adverso_fecha_suspencion3 = str_replace('>', '&gt;', $this->evento_adverso_fecha_suspencion3);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_suspencion3 . "</td>\r\n";
   }
   //----- evento_adverso_fecha_evento_adverso
   function NM_export_evento_adverso_fecha_evento_adverso()
   {
         if (substr($this->evento_adverso_fecha_evento_adverso, 10, 1) == "-") 
         { 
             $this->evento_adverso_fecha_evento_adverso = substr($this->evento_adverso_fecha_evento_adverso, 0, 10) . " " . substr($this->evento_adverso_fecha_evento_adverso, 11);
         } 
         if (substr($this->evento_adverso_fecha_evento_adverso, 13, 1) == ".") 
         { 
            $this->evento_adverso_fecha_evento_adverso = substr($this->evento_adverso_fecha_evento_adverso, 0, 13) . ":" . substr($this->evento_adverso_fecha_evento_adverso, 14, 2) . ":" . substr($this->evento_adverso_fecha_evento_adverso, 17);
         } 
         $this->nm_data->SetaData($this->evento_adverso_fecha_evento_adverso, "YYYY-MM-DD HH:II:SS");
         $this->evento_adverso_fecha_evento_adverso = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         if (!NM_is_utf8($this->evento_adverso_fecha_evento_adverso))
         {
             $this->evento_adverso_fecha_evento_adverso = sc_convert_encoding($this->evento_adverso_fecha_evento_adverso, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_fecha_evento_adverso = str_replace('<', '&lt;', $this->evento_adverso_fecha_evento_adverso);
         $this->evento_adverso_fecha_evento_adverso = str_replace('>', '&gt;', $this->evento_adverso_fecha_evento_adverso);
         $this->texto_tag .= "<td>" . $this->evento_adverso_fecha_evento_adverso . "</td>\r\n";
   }
   //----- evento_adverso_nombre_reportante_primario
   function NM_export_evento_adverso_nombre_reportante_primario()
   {
         $this->evento_adverso_nombre_reportante_primario = html_entity_decode($this->evento_adverso_nombre_reportante_primario, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_nombre_reportante_primario = strip_tags($this->evento_adverso_nombre_reportante_primario);
         if (!NM_is_utf8($this->evento_adverso_nombre_reportante_primario))
         {
             $this->evento_adverso_nombre_reportante_primario = sc_convert_encoding($this->evento_adverso_nombre_reportante_primario, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_nombre_reportante_primario = str_replace('<', '&lt;', $this->evento_adverso_nombre_reportante_primario);
         $this->evento_adverso_nombre_reportante_primario = str_replace('>', '&gt;', $this->evento_adverso_nombre_reportante_primario);
         $this->texto_tag .= "<td>" . $this->evento_adverso_nombre_reportante_primario . "</td>\r\n";
   }
   //----- evento_adverso_telefono_reportante_primario
   function NM_export_evento_adverso_telefono_reportante_primario()
   {
         $this->evento_adverso_telefono_reportante_primario = html_entity_decode($this->evento_adverso_telefono_reportante_primario, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_telefono_reportante_primario = strip_tags($this->evento_adverso_telefono_reportante_primario);
         if (!NM_is_utf8($this->evento_adverso_telefono_reportante_primario))
         {
             $this->evento_adverso_telefono_reportante_primario = sc_convert_encoding($this->evento_adverso_telefono_reportante_primario, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_telefono_reportante_primario = str_replace('<', '&lt;', $this->evento_adverso_telefono_reportante_primario);
         $this->evento_adverso_telefono_reportante_primario = str_replace('>', '&gt;', $this->evento_adverso_telefono_reportante_primario);
         $this->texto_tag .= "<td>" . $this->evento_adverso_telefono_reportante_primario . "</td>\r\n";
   }
   //----- evento_adverso_tipo_reportante
   function NM_export_evento_adverso_tipo_reportante()
   {
         $this->evento_adverso_tipo_reportante = html_entity_decode($this->evento_adverso_tipo_reportante, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_adverso_tipo_reportante = strip_tags($this->evento_adverso_tipo_reportante);
         if (!NM_is_utf8($this->evento_adverso_tipo_reportante))
         {
             $this->evento_adverso_tipo_reportante = sc_convert_encoding($this->evento_adverso_tipo_reportante, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->evento_adverso_tipo_reportante = str_replace('<', '&lt;', $this->evento_adverso_tipo_reportante);
         $this->evento_adverso_tipo_reportante = str_replace('>', '&gt;', $this->evento_adverso_tipo_reportante);
         $this->texto_tag .= "<td>" . $this->evento_adverso_tipo_reportante . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['EA'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['EA'][$path_doc_md5][1] = $this->tit_doc;
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
<form name="Fdown" method="get" action="EA_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="EA"> 
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

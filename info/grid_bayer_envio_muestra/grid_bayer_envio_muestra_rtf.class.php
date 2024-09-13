<?php

class grid_envio_muestra_rtf
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
   function grid_envio_muestra_rtf()
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
      $this->arquivo   .= "_grid_envio_muestra";
      $this->arquivo   .= ".rtf";
      $this->tit_doc    = "grid_envio_muestra.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_envio_muestra']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_envio_muestra']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_envio_muestra']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['rtf_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['rtf_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['rtf_name']);
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.NOMBRE_PACIENTE as cmp_maior_30_1, pacientes.APELLIDO_PACIENTE as cmp_maior_30_2, pacientes.CIUDAD_PACIENTE as cmp_maior_30_3, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_4, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_5, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_6, envio_muestra.ESTATUS_PACIENTE as cmp_maior_30_7, envio_muestra.DOSIS as envio_muestra_dosis, envio_muestra.FECHA_SALIDA as cmp_maior_30_8, envio_muestra.FECHA_ENTREGA as cmp_maior_30_9, envio_muestra.NO_LOTE as envio_muestra_no_lote, envio_muestra.ESTADO as envio_muestra_estado, envio_muestra.USUARIO as envio_muestra_usuario, envio_muestra.FECHA_CREACION as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.NOMBRE_PACIENTE as cmp_maior_30_1, pacientes.APELLIDO_PACIENTE as cmp_maior_30_2, pacientes.CIUDAD_PACIENTE as cmp_maior_30_3, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_4, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_5, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_6, envio_muestra.ESTATUS_PACIENTE as cmp_maior_30_7, envio_muestra.DOSIS as envio_muestra_dosis, envio_muestra.FECHA_SALIDA as cmp_maior_30_8, envio_muestra.FECHA_ENTREGA as cmp_maior_30_9, envio_muestra.NO_LOTE as envio_muestra_no_lote, envio_muestra.ESTADO as envio_muestra_estado, envio_muestra.USUARIO as envio_muestra_usuario, envio_muestra.FECHA_CREACION as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.NOMBRE_PACIENTE as cmp_maior_30_1, pacientes.APELLIDO_PACIENTE as cmp_maior_30_2, pacientes.CIUDAD_PACIENTE as cmp_maior_30_3, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_4, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_5, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_6, envio_muestra.ESTATUS_PACIENTE as cmp_maior_30_7, envio_muestra.DOSIS as envio_muestra_dosis, envio_muestra.FECHA_SALIDA as cmp_maior_30_8, envio_muestra.FECHA_ENTREGA as cmp_maior_30_9, envio_muestra.NO_LOTE as envio_muestra_no_lote, envio_muestra.ESTADO as envio_muestra_estado, envio_muestra.USUARIO as envio_muestra_usuario, envio_muestra.FECHA_CREACION as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.NOMBRE_PACIENTE as cmp_maior_30_1, pacientes.APELLIDO_PACIENTE as cmp_maior_30_2, pacientes.CIUDAD_PACIENTE as cmp_maior_30_3, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_4, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_5, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_6, envio_muestra.ESTATUS_PACIENTE as cmp_maior_30_7, envio_muestra.DOSIS as envio_muestra_dosis, envio_muestra.FECHA_SALIDA as cmp_maior_30_8, envio_muestra.FECHA_ENTREGA as cmp_maior_30_9, envio_muestra.NO_LOTE as envio_muestra_no_lote, envio_muestra.ESTADO as envio_muestra_estado, envio_muestra.USUARIO as envio_muestra_usuario, TO_DATE(TO_CHAR(envio_muestra.FECHA_CREACION, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss') as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.NOMBRE_PACIENTE as cmp_maior_30_1, pacientes.APELLIDO_PACIENTE as cmp_maior_30_2, pacientes.CIUDAD_PACIENTE as cmp_maior_30_3, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_4, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_5, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_6, envio_muestra.ESTATUS_PACIENTE as cmp_maior_30_7, envio_muestra.DOSIS as envio_muestra_dosis, envio_muestra.FECHA_SALIDA as cmp_maior_30_8, envio_muestra.FECHA_ENTREGA as cmp_maior_30_9, envio_muestra.NO_LOTE as envio_muestra_no_lote, envio_muestra.ESTADO as envio_muestra_estado, envio_muestra.USUARIO as envio_muestra_usuario, envio_muestra.FECHA_CREACION as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.NOMBRE_PACIENTE as cmp_maior_30_1, pacientes.APELLIDO_PACIENTE as cmp_maior_30_2, pacientes.CIUDAD_PACIENTE as cmp_maior_30_3, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_4, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_5, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_6, envio_muestra.ESTATUS_PACIENTE as cmp_maior_30_7, envio_muestra.DOSIS as envio_muestra_dosis, envio_muestra.FECHA_SALIDA as cmp_maior_30_8, envio_muestra.FECHA_ENTREGA as cmp_maior_30_9, envio_muestra.NO_LOTE as envio_muestra_no_lote, envio_muestra.ESTADO as envio_muestra_estado, envio_muestra.USUARIO as envio_muestra_usuario, envio_muestra.FECHA_CREACION as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['order_grid'];
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
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['field_order'] as $Cada_col)
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
          $SC_Label = (isset($this->New_label['envio_muestra_estatus_paciente'])) ? $this->New_label['envio_muestra_estatus_paciente'] : "ESTATUS PACIENTE"; 
          if ($Cada_col == "envio_muestra_estatus_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['envio_muestra_dosis'])) ? $this->New_label['envio_muestra_dosis'] : "DOSIS"; 
          if ($Cada_col == "envio_muestra_dosis" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['envio_muestra_fecha_salida'])) ? $this->New_label['envio_muestra_fecha_salida'] : "FECHA SALIDA"; 
          if ($Cada_col == "envio_muestra_fecha_salida" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['envio_muestra_fecha_entrega'])) ? $this->New_label['envio_muestra_fecha_entrega'] : "FECHA ENTREGA"; 
          if ($Cada_col == "envio_muestra_fecha_entrega" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['envio_muestra_no_lote'])) ? $this->New_label['envio_muestra_no_lote'] : "NO LOTE"; 
          if ($Cada_col == "envio_muestra_no_lote" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['envio_muestra_estado'])) ? $this->New_label['envio_muestra_estado'] : "ESTADO"; 
          if ($Cada_col == "envio_muestra_estado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['envio_muestra_usuario'])) ? $this->New_label['envio_muestra_usuario'] : "USUARIO"; 
          if ($Cada_col == "envio_muestra_usuario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['envio_muestra_fecha_creacion'])) ? $this->New_label['envio_muestra_fecha_creacion'] : "FECHA CREACION"; 
          if ($Cada_col == "envio_muestra_fecha_creacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
         $this->pacientes_nombre_paciente = $rs->fields[1] ;  
         $this->pacientes_apellido_paciente = $rs->fields[2] ;  
         $this->pacientes_ciudad_paciente = $rs->fields[3] ;  
         $this->tratamiento_asegurador_tratamiento = $rs->fields[4] ;  
         $this->tratamiento_operador_logistico_tratamiento = $rs->fields[5] ;  
         $this->tratamiento_medico_tratamiento = $rs->fields[6] ;  
         $this->envio_muestra_estatus_paciente = $rs->fields[7] ;  
         $this->envio_muestra_dosis = $rs->fields[8] ;  
         $this->envio_muestra_fecha_salida = $rs->fields[9] ;  
         $this->envio_muestra_fecha_entrega = $rs->fields[10] ;  
         $this->envio_muestra_no_lote = $rs->fields[11] ;  
         $this->envio_muestra_estado = $rs->fields[12] ;  
         $this->envio_muestra_usuario = $rs->fields[13] ;  
         $this->envio_muestra_fecha_creacion = $rs->fields[14] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['field_order'] as $Cada_col)
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
   //----- envio_muestra_estatus_paciente
   function NM_export_envio_muestra_estatus_paciente()
   {
         $this->envio_muestra_estatus_paciente = html_entity_decode($this->envio_muestra_estatus_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->envio_muestra_estatus_paciente = strip_tags($this->envio_muestra_estatus_paciente);
         if (!NM_is_utf8($this->envio_muestra_estatus_paciente))
         {
             $this->envio_muestra_estatus_paciente = sc_convert_encoding($this->envio_muestra_estatus_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->envio_muestra_estatus_paciente = str_replace('<', '&lt;', $this->envio_muestra_estatus_paciente);
         $this->envio_muestra_estatus_paciente = str_replace('>', '&gt;', $this->envio_muestra_estatus_paciente);
         $this->texto_tag .= "<td>" . $this->envio_muestra_estatus_paciente . "</td>\r\n";
   }
   //----- envio_muestra_dosis
   function NM_export_envio_muestra_dosis()
   {
         $this->envio_muestra_dosis = html_entity_decode($this->envio_muestra_dosis, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->envio_muestra_dosis = strip_tags($this->envio_muestra_dosis);
         if (!NM_is_utf8($this->envio_muestra_dosis))
         {
             $this->envio_muestra_dosis = sc_convert_encoding($this->envio_muestra_dosis, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->envio_muestra_dosis = str_replace('<', '&lt;', $this->envio_muestra_dosis);
         $this->envio_muestra_dosis = str_replace('>', '&gt;', $this->envio_muestra_dosis);
         $this->texto_tag .= "<td>" . $this->envio_muestra_dosis . "</td>\r\n";
   }
   //----- envio_muestra_fecha_salida
   function NM_export_envio_muestra_fecha_salida()
   {
         $this->envio_muestra_fecha_salida = html_entity_decode($this->envio_muestra_fecha_salida, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->envio_muestra_fecha_salida = strip_tags($this->envio_muestra_fecha_salida);
         if (!NM_is_utf8($this->envio_muestra_fecha_salida))
         {
             $this->envio_muestra_fecha_salida = sc_convert_encoding($this->envio_muestra_fecha_salida, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->envio_muestra_fecha_salida = str_replace('<', '&lt;', $this->envio_muestra_fecha_salida);
         $this->envio_muestra_fecha_salida = str_replace('>', '&gt;', $this->envio_muestra_fecha_salida);
         $this->texto_tag .= "<td>" . $this->envio_muestra_fecha_salida . "</td>\r\n";
   }
   //----- envio_muestra_fecha_entrega
   function NM_export_envio_muestra_fecha_entrega()
   {
         $this->envio_muestra_fecha_entrega = html_entity_decode($this->envio_muestra_fecha_entrega, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->envio_muestra_fecha_entrega = strip_tags($this->envio_muestra_fecha_entrega);
         if (!NM_is_utf8($this->envio_muestra_fecha_entrega))
         {
             $this->envio_muestra_fecha_entrega = sc_convert_encoding($this->envio_muestra_fecha_entrega, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->envio_muestra_fecha_entrega = str_replace('<', '&lt;', $this->envio_muestra_fecha_entrega);
         $this->envio_muestra_fecha_entrega = str_replace('>', '&gt;', $this->envio_muestra_fecha_entrega);
         $this->texto_tag .= "<td>" . $this->envio_muestra_fecha_entrega . "</td>\r\n";
   }
   //----- envio_muestra_no_lote
   function NM_export_envio_muestra_no_lote()
   {
         $this->envio_muestra_no_lote = html_entity_decode($this->envio_muestra_no_lote, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->envio_muestra_no_lote = strip_tags($this->envio_muestra_no_lote);
         if (!NM_is_utf8($this->envio_muestra_no_lote))
         {
             $this->envio_muestra_no_lote = sc_convert_encoding($this->envio_muestra_no_lote, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->envio_muestra_no_lote = str_replace('<', '&lt;', $this->envio_muestra_no_lote);
         $this->envio_muestra_no_lote = str_replace('>', '&gt;', $this->envio_muestra_no_lote);
         $this->texto_tag .= "<td>" . $this->envio_muestra_no_lote . "</td>\r\n";
   }
   //----- envio_muestra_estado
   function NM_export_envio_muestra_estado()
   {
         $this->envio_muestra_estado = html_entity_decode($this->envio_muestra_estado, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->envio_muestra_estado = strip_tags($this->envio_muestra_estado);
         if (!NM_is_utf8($this->envio_muestra_estado))
         {
             $this->envio_muestra_estado = sc_convert_encoding($this->envio_muestra_estado, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->envio_muestra_estado = str_replace('<', '&lt;', $this->envio_muestra_estado);
         $this->envio_muestra_estado = str_replace('>', '&gt;', $this->envio_muestra_estado);
         $this->texto_tag .= "<td>" . $this->envio_muestra_estado . "</td>\r\n";
   }
   //----- envio_muestra_usuario
   function NM_export_envio_muestra_usuario()
   {
         $this->envio_muestra_usuario = html_entity_decode($this->envio_muestra_usuario, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->envio_muestra_usuario = strip_tags($this->envio_muestra_usuario);
         if (!NM_is_utf8($this->envio_muestra_usuario))
         {
             $this->envio_muestra_usuario = sc_convert_encoding($this->envio_muestra_usuario, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->envio_muestra_usuario = str_replace('<', '&lt;', $this->envio_muestra_usuario);
         $this->envio_muestra_usuario = str_replace('>', '&gt;', $this->envio_muestra_usuario);
         $this->texto_tag .= "<td>" . $this->envio_muestra_usuario . "</td>\r\n";
   }
   //----- envio_muestra_fecha_creacion
   function NM_export_envio_muestra_fecha_creacion()
   {
         if (substr($this->envio_muestra_fecha_creacion, 10, 1) == "-") 
         { 
             $this->envio_muestra_fecha_creacion = substr($this->envio_muestra_fecha_creacion, 0, 10) . " " . substr($this->envio_muestra_fecha_creacion, 11);
         } 
         if (substr($this->envio_muestra_fecha_creacion, 13, 1) == ".") 
         { 
            $this->envio_muestra_fecha_creacion = substr($this->envio_muestra_fecha_creacion, 0, 13) . ":" . substr($this->envio_muestra_fecha_creacion, 14, 2) . ":" . substr($this->envio_muestra_fecha_creacion, 17);
         } 
         $this->nm_data->SetaData($this->envio_muestra_fecha_creacion, "YYYY-MM-DD HH:II:SS");
         $this->envio_muestra_fecha_creacion = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         if (!NM_is_utf8($this->envio_muestra_fecha_creacion))
         {
             $this->envio_muestra_fecha_creacion = sc_convert_encoding($this->envio_muestra_fecha_creacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->envio_muestra_fecha_creacion = str_replace('<', '&lt;', $this->envio_muestra_fecha_creacion);
         $this->envio_muestra_fecha_creacion = str_replace('>', '&gt;', $this->envio_muestra_fecha_creacion);
         $this->texto_tag .= "<td>" . $this->envio_muestra_fecha_creacion . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_envio_muestra'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> - envio_muestra :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_envio_muestra_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_envio_muestra"> 
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

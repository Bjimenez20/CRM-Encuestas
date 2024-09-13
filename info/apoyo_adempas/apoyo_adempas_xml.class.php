<?php

class apoyo_adempas_xml
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
   function apoyo_adempas_xml()
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
      $this->arquivo     .= "_apoyo_adempas";
      $this->arquivo_view = $this->arquivo . "_view.xml";
      $this->arquivo     .= ".xml";
      $this->tit_doc      = "apoyo_adempas.xml";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['apoyo_adempas']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['apoyo_adempas']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['apoyo_adempas']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['campos_busca'];
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
          $this->brindar_apoyo_fecha_apoyo = $Busca_temp['brindar_apoyo_fecha_apoyo']; 
          $tmp_pos = strpos($this->brindar_apoyo_fecha_apoyo, "##@@");
          if ($tmp_pos !== false)
          {
              $this->brindar_apoyo_fecha_apoyo = substr($this->brindar_apoyo_fecha_apoyo, 0, $tmp_pos);
          }
          $this->brindar_apoyo_fecha_apoyo_2 = $Busca_temp['brindar_apoyo_fecha_apoyo_input_2']; 
          $this->brindar_apoyo_motivo = $Busca_temp['brindar_apoyo_motivo']; 
          $tmp_pos = strpos($this->brindar_apoyo_motivo, "##@@");
          if ($tmp_pos !== false)
          {
              $this->brindar_apoyo_motivo = substr($this->brindar_apoyo_motivo, 0, $tmp_pos);
          }
          $this->brindar_apoyo_dosis = $Busca_temp['brindar_apoyo_dosis']; 
          $tmp_pos = strpos($this->brindar_apoyo_dosis, "##@@");
          if ($tmp_pos !== false)
          {
              $this->brindar_apoyo_dosis = substr($this->brindar_apoyo_dosis, 0, $tmp_pos);
          }
          $this->brindar_apoyo_razon_apoyo = $Busca_temp['brindar_apoyo_razon_apoyo']; 
          $tmp_pos = strpos($this->brindar_apoyo_razon_apoyo, "##@@");
          if ($tmp_pos !== false)
          {
              $this->brindar_apoyo_razon_apoyo = substr($this->brindar_apoyo_razon_apoyo, 0, $tmp_pos);
          }
          $this->tratamiento_asegurador_tratamiento = $Busca_temp['tratamiento_asegurador_tratamiento']; 
          $tmp_pos = strpos($this->tratamiento_asegurador_tratamiento, "##@@");
          if ($tmp_pos !== false)
          {
              $this->tratamiento_asegurador_tratamiento = substr($this->tratamiento_asegurador_tratamiento, 0, $tmp_pos);
          }
          $this->tratamiento_operador_logistico_tratamiento = $Busca_temp['tratamiento_operador_logistico_tratamiento']; 
          $tmp_pos = strpos($this->tratamiento_operador_logistico_tratamiento, "##@@");
          if ($tmp_pos !== false)
          {
              $this->tratamiento_operador_logistico_tratamiento = substr($this->tratamiento_operador_logistico_tratamiento, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['xml_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['xml_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['xml_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->arquivo_view = $this->arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_3, str_replace (convert(char(10),brindar_apoyo.FECHA_APOYO,102), '.', '-') + ' ' + convert(char(8),brindar_apoyo.FECHA_APOYO,20) as cmp_maior_30_4, brindar_apoyo.MOTIVO as brindar_apoyo_motivo, brindar_apoyo.DOSIS as brindar_apoyo_dosis, DATE_FORMAT(brindar_apoyo.FECHA_APOYO,'%m') as mes, brindar_apoyo.RAZON_APOYO as cmp_maior_30_5, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_6, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_7, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_8, pacientes.CIUDAD_PACIENTE as cmp_maior_30_9, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_3, brindar_apoyo.FECHA_APOYO as cmp_maior_30_4, brindar_apoyo.MOTIVO as brindar_apoyo_motivo, brindar_apoyo.DOSIS as brindar_apoyo_dosis, DATE_FORMAT(brindar_apoyo.FECHA_APOYO,'%m') as mes, brindar_apoyo.RAZON_APOYO as cmp_maior_30_5, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_6, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_7, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_8, pacientes.CIUDAD_PACIENTE as cmp_maior_30_9, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_3, convert(char(23),brindar_apoyo.FECHA_APOYO,121) as cmp_maior_30_4, brindar_apoyo.MOTIVO as brindar_apoyo_motivo, brindar_apoyo.DOSIS as brindar_apoyo_dosis, DATE_FORMAT(brindar_apoyo.FECHA_APOYO,'%m') as mes, brindar_apoyo.RAZON_APOYO as cmp_maior_30_5, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_6, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_7, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_8, pacientes.CIUDAD_PACIENTE as cmp_maior_30_9, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_3, brindar_apoyo.FECHA_APOYO as cmp_maior_30_4, brindar_apoyo.MOTIVO as brindar_apoyo_motivo, brindar_apoyo.DOSIS as brindar_apoyo_dosis, DATE_FORMAT(brindar_apoyo.FECHA_APOYO,'%m') as mes, brindar_apoyo.RAZON_APOYO as cmp_maior_30_5, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_6, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_7, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_8, pacientes.CIUDAD_PACIENTE as cmp_maior_30_9, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_3, EXTEND(brindar_apoyo.FECHA_APOYO, YEAR TO FRACTION) as cmp_maior_30_4, brindar_apoyo.MOTIVO as brindar_apoyo_motivo, brindar_apoyo.DOSIS as brindar_apoyo_dosis, DATE_FORMAT(brindar_apoyo.FECHA_APOYO,'%m') as mes, brindar_apoyo.RAZON_APOYO as cmp_maior_30_5, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_6, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_7, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_8, pacientes.CIUDAD_PACIENTE as cmp_maior_30_9, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_3, brindar_apoyo.FECHA_APOYO as cmp_maior_30_4, brindar_apoyo.MOTIVO as brindar_apoyo_motivo, brindar_apoyo.DOSIS as brindar_apoyo_dosis, DATE_FORMAT(brindar_apoyo.FECHA_APOYO,'%m') as mes, brindar_apoyo.RAZON_APOYO as cmp_maior_30_5, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_6, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_7, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_8, pacientes.CIUDAD_PACIENTE as cmp_maior_30_9, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_10 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['order_grid'];
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
         $this->xml_registro = "<apoyo_adempas";
         $this->pacientes_id_paciente = $rs->fields[0] ;  
         $this->pacientes_estado_paciente = $rs->fields[1] ;  
         $this->pacientes_fecha_activacion_paciente = $rs->fields[2] ;  
         $this->tratamiento_fecha_inicio_terapia_tratamiento = $rs->fields[3] ;  
         $this->brindar_apoyo_fecha_apoyo = $rs->fields[4] ;  
         $this->brindar_apoyo_motivo = $rs->fields[5] ;  
         $this->brindar_apoyo_dosis = $rs->fields[6] ;  
         $this->mes = $rs->fields[7] ;  
         $this->brindar_apoyo_razon_apoyo = $rs->fields[8] ;  
         $this->tratamiento_asegurador_tratamiento = $rs->fields[9] ;  
         $this->tratamiento_operador_logistico_tratamiento = $rs->fields[10] ;  
         $this->tratamiento_medico_tratamiento = $rs->fields[11] ;  
         $this->pacientes_ciudad_paciente = $rs->fields[12] ;  
         $this->pacientes_departamento_paciente = $rs->fields[13] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['field_order'] as $Cada_col)
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
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_fecha_activacion_paciente))
         {
             $this->pacientes_fecha_activacion_paciente = sc_convert_encoding($this->pacientes_fecha_activacion_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_fecha_activacion_paciente =\"" . $this->trata_dados($this->pacientes_fecha_activacion_paciente) . "\"";
   }
   //----- tratamiento_fecha_inicio_terapia_tratamiento
   function NM_export_tratamiento_fecha_inicio_terapia_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_fecha_inicio_terapia_tratamiento))
         {
             $this->tratamiento_fecha_inicio_terapia_tratamiento = sc_convert_encoding($this->tratamiento_fecha_inicio_terapia_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_fecha_inicio_terapia_tratamiento =\"" . $this->trata_dados($this->tratamiento_fecha_inicio_terapia_tratamiento) . "\"";
   }
   //----- brindar_apoyo_fecha_apoyo
   function NM_export_brindar_apoyo_fecha_apoyo()
   {
         if (substr($this->brindar_apoyo_fecha_apoyo, 10, 1) == "-") 
         { 
             $this->brindar_apoyo_fecha_apoyo = substr($this->brindar_apoyo_fecha_apoyo, 0, 10) . " " . substr($this->brindar_apoyo_fecha_apoyo, 11);
         } 
         if (substr($this->brindar_apoyo_fecha_apoyo, 13, 1) == ".") 
         { 
            $this->brindar_apoyo_fecha_apoyo = substr($this->brindar_apoyo_fecha_apoyo, 0, 13) . ":" . substr($this->brindar_apoyo_fecha_apoyo, 14, 2) . ":" . substr($this->brindar_apoyo_fecha_apoyo, 17);
         } 
         $this->nm_data->SetaData($this->brindar_apoyo_fecha_apoyo, "YYYY-MM-DD HH:II:SS");
         $this->brindar_apoyo_fecha_apoyo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->brindar_apoyo_fecha_apoyo))
         {
             $this->brindar_apoyo_fecha_apoyo = sc_convert_encoding($this->brindar_apoyo_fecha_apoyo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " brindar_apoyo_fecha_apoyo =\"" . $this->trata_dados($this->brindar_apoyo_fecha_apoyo) . "\"";
   }
   //----- brindar_apoyo_motivo
   function NM_export_brindar_apoyo_motivo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->brindar_apoyo_motivo))
         {
             $this->brindar_apoyo_motivo = sc_convert_encoding($this->brindar_apoyo_motivo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " brindar_apoyo_motivo =\"" . $this->trata_dados($this->brindar_apoyo_motivo) . "\"";
   }
   //----- brindar_apoyo_dosis
   function NM_export_brindar_apoyo_dosis()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->brindar_apoyo_dosis))
         {
             $this->brindar_apoyo_dosis = sc_convert_encoding($this->brindar_apoyo_dosis, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " brindar_apoyo_dosis =\"" . $this->trata_dados($this->brindar_apoyo_dosis) . "\"";
   }
   //----- mes
   function NM_export_mes()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->mes))
         {
             $this->mes = sc_convert_encoding($this->mes, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " mes =\"" . $this->trata_dados($this->mes) . "\"";
   }
   //----- brindar_apoyo_razon_apoyo
   function NM_export_brindar_apoyo_razon_apoyo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->brindar_apoyo_razon_apoyo))
         {
             $this->brindar_apoyo_razon_apoyo = sc_convert_encoding($this->brindar_apoyo_razon_apoyo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " brindar_apoyo_razon_apoyo =\"" . $this->trata_dados($this->brindar_apoyo_razon_apoyo) . "\"";
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
   //----- tratamiento_medico_tratamiento
   function NM_export_tratamiento_medico_tratamiento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tratamiento_medico_tratamiento))
         {
             $this->tratamiento_medico_tratamiento = sc_convert_encoding($this->tratamiento_medico_tratamiento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tratamiento_medico_tratamiento =\"" . $this->trata_dados($this->tratamiento_medico_tratamiento) . "\"";
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
   //----- pacientes_departamento_paciente
   function NM_export_pacientes_departamento_paciente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacientes_departamento_paciente))
         {
             $this->pacientes_departamento_paciente = sc_convert_encoding($this->pacientes_departamento_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pacientes_departamento_paciente =\"" . $this->trata_dados($this->pacientes_departamento_paciente) . "\"";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['apoyo_adempas'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Apoyo Adempas :: XML</TITLE>
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
<form name="Fdown" method="get" action="apoyo_adempas_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="apoyo_adempas"> 
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

<?php

class Conciliacion_in_rtf
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
   function Conciliacion_in_rtf()
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
      $this->arquivo   .= "_Conciliacion_in";
      $this->arquivo   .= ".rtf";
      $this->tit_doc    = "Conciliacion_in.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Conciliacion_in']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Conciliacion_in']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Conciliacion_in']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->pacientes_telefono_paciente = $Busca_temp['pacientes_telefono_paciente']; 
          $tmp_pos = strpos($this->pacientes_telefono_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_telefono_paciente = substr($this->pacientes_telefono_paciente, 0, $tmp_pos);
          }
          $this->pacientes_fecha_activacion_paciente = $Busca_temp['pacientes_fecha_activacion_paciente']; 
          $tmp_pos = strpos($this->pacientes_fecha_activacion_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_fecha_activacion_paciente = substr($this->pacientes_fecha_activacion_paciente, 0, $tmp_pos);
          }
          $this->pacientes_nombre_paciente = $Busca_temp['pacientes_nombre_paciente']; 
          $tmp_pos = strpos($this->pacientes_nombre_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_nombre_paciente = substr($this->pacientes_nombre_paciente, 0, $tmp_pos);
          }
          $this->pacientes_apellido_paciente = $Busca_temp['pacientes_apellido_paciente']; 
          $tmp_pos = strpos($this->pacientes_apellido_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_apellido_paciente = substr($this->pacientes_apellido_paciente, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['rtf_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['rtf_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['rtf_name']);
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_1, pacientes.NOMBRE_PACIENTE as cmp_maior_30_2, pacientes.APELLIDO_PACIENTE as cmp_maior_30_3, pacientes.TELEFONO_PACIENTE as cmp_maior_30_4, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_5, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_6, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_7, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_8, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_9 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_1, pacientes.NOMBRE_PACIENTE as cmp_maior_30_2, pacientes.APELLIDO_PACIENTE as cmp_maior_30_3, pacientes.TELEFONO_PACIENTE as cmp_maior_30_4, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_5, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_6, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_7, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_8, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_9 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_1, pacientes.NOMBRE_PACIENTE as cmp_maior_30_2, pacientes.APELLIDO_PACIENTE as cmp_maior_30_3, pacientes.TELEFONO_PACIENTE as cmp_maior_30_4, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_5, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_6, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_7, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_8, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_9 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_1, pacientes.NOMBRE_PACIENTE as cmp_maior_30_2, pacientes.APELLIDO_PACIENTE as cmp_maior_30_3, pacientes.TELEFONO_PACIENTE as cmp_maior_30_4, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_5, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_6, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_7, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_8, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_9 from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_1, pacientes.NOMBRE_PACIENTE as cmp_maior_30_2, pacientes.APELLIDO_PACIENTE as cmp_maior_30_3, pacientes.TELEFONO_PACIENTE as cmp_maior_30_4, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_5, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_6, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_7, LOTOFILE(gestiones.DESCRIPCION_COMUNICACION_GESTION, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as cmp_maior_30_8, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_9 from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_1, pacientes.NOMBRE_PACIENTE as cmp_maior_30_2, pacientes.APELLIDO_PACIENTE as cmp_maior_30_3, pacientes.TELEFONO_PACIENTE as cmp_maior_30_4, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_5, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_6, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_7, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_8, gestiones.AUTOR_GESTION as gestiones_autor_gestion, pacientes.ID_PACIENTE as pacientes_id_paciente, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_9 from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['order_grid'];
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
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['field_order'] as $Cada_col)
      { 
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
          $SC_Label = (isset($this->New_label['gestiones_descripcion_comunicacion_gestion'])) ? $this->New_label['gestiones_descripcion_comunicacion_gestion'] : "DESCRIPCION COMUNICACION GESTION"; 
          if ($Cada_col == "gestiones_descripcion_comunicacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['gestiones_evento_adverso_gestion'])) ? $this->New_label['gestiones_evento_adverso_gestion'] : "EVENTO ADVERSO GESTION"; 
          if ($Cada_col == "gestiones_evento_adverso_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
         $this->pacientes_fecha_activacion_paciente = $rs->fields[0] ;  
         $this->pacientes_nombre_paciente = $rs->fields[1] ;  
         $this->pacientes_apellido_paciente = $rs->fields[2] ;  
         $this->pacientes_telefono_paciente = $rs->fields[3] ;  
         $this->pacientes_telefono2_paciente = $rs->fields[4] ;  
         $this->pacientes_telefono3_paciente = $rs->fields[5] ;  
         $this->tratamiento_producto_tratamiento = $rs->fields[6] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->gestiones_descripcion_comunicacion_gestion = "";  
              if (is_file($rs_grid->fields[7])) 
              { 
                  $this->gestiones_descripcion_comunicacion_gestion = file_get_contents($rs_grid->fields[7]);  
              } 
          } 
         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
         { 
             $this->gestiones_descripcion_comunicacion_gestion = $this->Db->BlobDecode($rs->fields[7]) ;  
         } 
         else
         { 
             $this->gestiones_descripcion_comunicacion_gestion = $rs->fields[7] ;  
         } 
         $this->gestiones_autor_gestion = $rs->fields[8] ;  
         $this->pacientes_id_paciente = $rs->fields[9] ;  
         $this->pacientes_id_paciente = (string)$this->pacientes_id_paciente;
         $this->gestiones_evento_adverso_gestion = $rs->fields[10] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['field_order'] as $Cada_col)
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
   //----- gestiones_descripcion_comunicacion_gestion
   function NM_export_gestiones_descripcion_comunicacion_gestion()
   {
         $this->gestiones_descripcion_comunicacion_gestion = html_entity_decode($this->gestiones_descripcion_comunicacion_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_descripcion_comunicacion_gestion = strip_tags($this->gestiones_descripcion_comunicacion_gestion);
         if (!NM_is_utf8($this->gestiones_descripcion_comunicacion_gestion))
         {
             $this->gestiones_descripcion_comunicacion_gestion = sc_convert_encoding($this->gestiones_descripcion_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->gestiones_descripcion_comunicacion_gestion = str_replace('<', '&lt;', $this->gestiones_descripcion_comunicacion_gestion);
         $this->gestiones_descripcion_comunicacion_gestion = str_replace('>', '&gt;', $this->gestiones_descripcion_comunicacion_gestion);
         $this->texto_tag .= "<td>" . $this->gestiones_descripcion_comunicacion_gestion . "</td>\r\n";
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
   //----- gestiones_evento_adverso_gestion
   function NM_export_gestiones_evento_adverso_gestion()
   {
         $this->gestiones_evento_adverso_gestion = html_entity_decode($this->gestiones_evento_adverso_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_evento_adverso_gestion = strip_tags($this->gestiones_evento_adverso_gestion);
         if (!NM_is_utf8($this->gestiones_evento_adverso_gestion))
         {
             $this->gestiones_evento_adverso_gestion = sc_convert_encoding($this->gestiones_evento_adverso_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->gestiones_evento_adverso_gestion = str_replace('<', '&lt;', $this->gestiones_evento_adverso_gestion);
         $this->gestiones_evento_adverso_gestion = str_replace('>', '&gt;', $this->gestiones_evento_adverso_gestion);
         $this->texto_tag .= "<td>" . $this->gestiones_evento_adverso_gestion . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Conciliacion_in'][$path_doc_md5][1] = $this->tit_doc;
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
<form name="Fdown" method="get" action="Conciliacion_in_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="Conciliacion_in"> 
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

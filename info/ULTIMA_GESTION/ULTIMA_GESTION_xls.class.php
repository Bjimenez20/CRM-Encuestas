<?php

class ultima_gestion_xls
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $xls_dados;
   var $xls_workbook;
   var $xls_col;
   var $xls_row;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $arquivo;
   var $tit_doc;
   //---- 
   function ultima_gestion_xls()
   {
   }

   //---- 
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $this->xls_row = 1;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
      $this->xls_col    = 0;
      $this->nm_data    = new nm_data("es");
      $this->arquivo    = "sc_xls";
      $this->arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->arquivo   .= "_ultima_gestion";
      $this->arquivo   .= ".xls";
      $this->tit_doc    = "ultima_gestion.xls";
      $this->xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $this->xls_dados = new PHPExcel();
      $this->xls_dados->setActiveSheetIndex(0);
      $this->Nm_ActiveSheet = $this->xls_dados->getActiveSheet();
      if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
      {
          $this->Nm_ActiveSheet->setRightToLeft(true);
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['ultima_gestion']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['ultima_gestion']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['ultima_gestion']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['xls_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['xls_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['xls_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['xls_name']);
          $this->xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_5, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_10, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_11, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_12, gestiones.FECHA_COMUNICACION as cmp_maior_30_13, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_14, gestiones.AUTOR_GESTION as gestiones_autor_gestion from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_5, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_10, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_11, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_12, gestiones.FECHA_COMUNICACION as cmp_maior_30_13, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_14, gestiones.AUTOR_GESTION as gestiones_autor_gestion from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_5, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_10, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_11, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_12, gestiones.FECHA_COMUNICACION as cmp_maior_30_13, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_14, gestiones.AUTOR_GESTION as gestiones_autor_gestion from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_5, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_10, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_11, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_12, TO_DATE(TO_CHAR(gestiones.FECHA_COMUNICACION, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss') as cmp_maior_30_13, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_14, gestiones.AUTOR_GESTION as gestiones_autor_gestion from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_5, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_10, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_11, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_12, gestiones.FECHA_COMUNICACION as cmp_maior_30_13, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_14, gestiones.AUTOR_GESTION as gestiones_autor_gestion from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_5, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_10, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_11, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_12, gestiones.FECHA_COMUNICACION as cmp_maior_30_13, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_14, gestiones.AUTOR_GESTION as gestiones_autor_gestion from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['pacientes_id_paciente'])) ? $this->New_label['pacientes_id_paciente'] : "PAP"; 
          if ($Cada_col == "pacientes_id_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_estado_paciente'])) ? $this->New_label['pacientes_estado_paciente'] : "ESTADO PACIENTE"; 
          if ($Cada_col == "pacientes_estado_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_fecha_activacion_paciente'])) ? $this->New_label['pacientes_fecha_activacion_paciente'] : "FECHA ACTIVACION PACIENTE"; 
          if ($Cada_col == "pacientes_fecha_activacion_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_fecha_retiro_paciente'])) ? $this->New_label['pacientes_fecha_retiro_paciente'] : "FECHA RETIRO PACIENTE"; 
          if ($Cada_col == "pacientes_fecha_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_motivo_retiro_paciente'])) ? $this->New_label['pacientes_motivo_retiro_paciente'] : "MOTIVO RETIRO PACIENTE"; 
          if ($Cada_col == "pacientes_motivo_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_identificacion_paciente'])) ? $this->New_label['pacientes_identificacion_paciente'] : "IDENTIFICACION PACIENTE"; 
          if ($Cada_col == "pacientes_identificacion_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_observacion_motivo_retiro_paciente'])) ? $this->New_label['pacientes_observacion_motivo_retiro_paciente'] : "OBSERVACION MOTIVO RETIRO PACIENTE"; 
          if ($Cada_col == "pacientes_observacion_motivo_retiro_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_nombre_paciente'])) ? $this->New_label['pacientes_nombre_paciente'] : "NOMBRE PACIENTE"; 
          if ($Cada_col == "pacientes_nombre_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_apellido_paciente'])) ? $this->New_label['pacientes_apellido_paciente'] : "APELLIDO PACIENTE"; 
          if ($Cada_col == "pacientes_apellido_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_telefono_paciente'])) ? $this->New_label['pacientes_telefono_paciente'] : "TELEFONO PACIENTE"; 
          if ($Cada_col == "pacientes_telefono_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['pacientes_id_ultima_gestion'])) ? $this->New_label['pacientes_id_ultima_gestion'] : "ID ULTIMA GESTION"; 
          if ($Cada_col == "pacientes_id_ultima_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_id_gestion'])) ? $this->New_label['gestiones_id_gestion'] : "ID GESTION"; 
          if ($Cada_col == "gestiones_id_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_motivo_comunicacion_gestion'])) ? $this->New_label['gestiones_motivo_comunicacion_gestion'] : "MOTIVO COMUNICACION GESTION"; 
          if ($Cada_col == "gestiones_motivo_comunicacion_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_fecha_programada_gestion'])) ? $this->New_label['gestiones_fecha_programada_gestion'] : "FECHA PROGRAMADA GESTION"; 
          if ($Cada_col == "gestiones_fecha_programada_gestion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
          $SC_Label = (isset($this->New_label['gestiones_fecha_comunicacion'])) ? $this->New_label['gestiones_fecha_comunicacion'] : "FECHA COMUNICACION"; 
          if ($Cada_col == "gestiones_fecha_comunicacion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->xls_col))->setAutoSize(true);
              $this->xls_col++;
          }
      } 
      while (!$rs->EOF)
      {
         $this->xls_col = 0;
         $this->xls_row++;
         $this->pacientes_id_paciente = $rs->fields[0] ;  
         $this->pacientes_id_paciente = (string)$this->pacientes_id_paciente;
         $this->pacientes_estado_paciente = $rs->fields[1] ;  
         $this->pacientes_fecha_activacion_paciente = $rs->fields[2] ;  
         $this->pacientes_fecha_retiro_paciente = $rs->fields[3] ;  
         $this->pacientes_motivo_retiro_paciente = $rs->fields[4] ;  
         $this->pacientes_identificacion_paciente = $rs->fields[5] ;  
         $this->pacientes_observacion_motivo_retiro_paciente = $rs->fields[6] ;  
         $this->pacientes_nombre_paciente = $rs->fields[7] ;  
         $this->pacientes_apellido_paciente = $rs->fields[8] ;  
         $this->pacientes_telefono_paciente = $rs->fields[9] ;  
         $this->pacientes_id_ultima_gestion = $rs->fields[10] ;  
         $this->pacientes_id_ultima_gestion = (string)$this->pacientes_id_ultima_gestion;
         $this->gestiones_id_gestion = $rs->fields[11] ;  
         $this->gestiones_id_gestion = (string)$this->gestiones_id_gestion;
         $this->gestiones_motivo_comunicacion_gestion = $rs->fields[12] ;  
         $this->gestiones_fecha_programada_gestion = $rs->fields[13] ;  
         $this->gestiones_fecha_comunicacion = $rs->fields[14] ;  
         $this->tratamiento_producto_tratamiento = $rs->fields[15] ;  
         $this->gestiones_autor_gestion = $rs->fields[16] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if (isset($this->NM_Row_din[$this->xls_row]))
         { 
             $this->Nm_ActiveSheet->getRowDimension($this->xls_row)->setRowHeight($this->NM_Row_din[$this->xls_row]);
         } 
         $rs->MoveNext();
      }
      if (isset($this->NM_Col_din))
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      $rs->Close();
      $objWriter = new PHPExcel_Writer_Excel5($this->xls_dados);
      $objWriter->save($this->xls_f);
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
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_id_paciente);
         $this->xls_col++;
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
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_estado_paciente);
         $this->xls_col++;
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
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_fecha_activacion_paciente);
         $this->xls_col++;
   }
   //----- pacientes_fecha_retiro_paciente
   function NM_export_pacientes_fecha_retiro_paciente()
   {
         $this->pacientes_fecha_retiro_paciente = html_entity_decode($this->pacientes_fecha_retiro_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacientes_fecha_retiro_paciente = strip_tags($this->pacientes_fecha_retiro_paciente);
         if (!NM_is_utf8($this->pacientes_fecha_retiro_paciente))
         {
             $this->pacientes_fecha_retiro_paciente = sc_convert_encoding($this->pacientes_fecha_retiro_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_fecha_retiro_paciente);
         $this->xls_col++;
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
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_motivo_retiro_paciente);
         $this->xls_col++;
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
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_identificacion_paciente);
         $this->xls_col++;
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
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_observacion_motivo_retiro_paciente);
         $this->xls_col++;
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
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_nombre_paciente);
         $this->xls_col++;
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
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_apellido_paciente);
         $this->xls_col++;
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
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_telefono_paciente);
         $this->xls_col++;
   }
   //----- pacientes_id_ultima_gestion
   function NM_export_pacientes_id_ultima_gestion()
   {
         $conteudo = str_replace($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['decimal_db'], "", $conteudo); 
         $this->nm_gera_mask($this->pacientes_id_ultima_gestion, "zzzzz"); 
         if (!NM_is_utf8($this->pacientes_id_ultima_gestion))
         {
             $this->pacientes_id_ultima_gestion = sc_convert_encoding($this->pacientes_id_ultima_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->pacientes_id_ultima_gestion);
         $this->xls_col++;
   }
   //----- gestiones_id_gestion
   function NM_export_gestiones_id_gestion()
   {
         $conteudo = str_replace($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['decimal_db'], "", $conteudo); 
         $this->nm_gera_mask($this->gestiones_id_gestion, "zzzzz"); 
         if (!NM_is_utf8($this->gestiones_id_gestion))
         {
             $this->gestiones_id_gestion = sc_convert_encoding($this->gestiones_id_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_id_gestion);
         $this->xls_col++;
   }
   //----- gestiones_motivo_comunicacion_gestion
   function NM_export_gestiones_motivo_comunicacion_gestion()
   {
         $this->gestiones_motivo_comunicacion_gestion = html_entity_decode($this->gestiones_motivo_comunicacion_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_motivo_comunicacion_gestion = strip_tags($this->gestiones_motivo_comunicacion_gestion);
         if (!NM_is_utf8($this->gestiones_motivo_comunicacion_gestion))
         {
             $this->gestiones_motivo_comunicacion_gestion = sc_convert_encoding($this->gestiones_motivo_comunicacion_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_motivo_comunicacion_gestion);
         $this->xls_col++;
   }
   //----- gestiones_fecha_programada_gestion
   function NM_export_gestiones_fecha_programada_gestion()
   {
         $this->gestiones_fecha_programada_gestion = html_entity_decode($this->gestiones_fecha_programada_gestion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->gestiones_fecha_programada_gestion = strip_tags($this->gestiones_fecha_programada_gestion);
         if (!NM_is_utf8($this->gestiones_fecha_programada_gestion))
         {
             $this->gestiones_fecha_programada_gestion = sc_convert_encoding($this->gestiones_fecha_programada_gestion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_fecha_programada_gestion);
         $this->xls_col++;
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
         if (!NM_is_utf8($this->gestiones_fecha_comunicacion))
         {
             $this->gestiones_fecha_comunicacion = sc_convert_encoding($this->gestiones_fecha_comunicacion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->xls_col) . $this->xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->xls_col) . $this->xls_row, $this->gestiones_fecha_comunicacion);
         $this->xls_col++;
   }

   function calc_cell($col)
   {
       $arr_alfa = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
       $val_ret = "";
       $result = $col + 1;
       while ($result > 26)
       {
           $cel      = $result % 26;
           $result   = $result / 26;
           if ($cel == 0)
           {
               $cel    = 26;
               $result--;
           }
           $val_ret = $arr_alfa[$cel] . $val_ret;
       }
       $val_ret = $arr_alfa[$result] . $val_ret;
       return $val_ret;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['xls_file']);
      if (is_file($this->xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion']['xls_file'] = $this->xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['ultima_gestion'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Ultima Gestion :: Excel</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XLS</td>
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
<form name="Fdown" method="get" action="ultima_gestion_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="ultima_gestion"> 
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

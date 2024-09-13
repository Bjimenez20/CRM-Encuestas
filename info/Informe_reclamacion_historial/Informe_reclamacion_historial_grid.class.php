<?php
class Informe_reclamacion_historial_grid
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Tot;
   var $Lin_impressas;
   var $Lin_final;
   var $Rows_span;
   var $NM_colspan;
   var $rs_grid;
   var $nm_grid_ini;
   var $nm_grid_sem_reg;
   var $nm_prim_linha;
   var $Rec_ini;
   var $Rec_fim;
   var $nmgp_reg_start;
   var $nmgp_reg_inicial;
   var $nmgp_reg_final;
   var $SC_seq_register;
   var $SC_seq_page;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $NM_raiz_img; 
   var $Ind_lig_mult; 
   var $NM_opcao; 
   var $NM_flag_antigo; 
   var $nm_campos_cab = array();
   var $NM_cmp_hidden = array();
   var $nmgp_botoes = array();
   var $Cmps_ord_def = array();
   var $nmgp_label_quebras = array();
   var $nmgp_prim_pag_pdf;
   var $Campos_Mens_erro;
   var $Print_All;
   var $NM_field_over;
   var $NM_field_click;
   var $progress_fp;
   var $progress_tot;
   var $progress_now;
   var $progress_lim_tot;
   var $progress_lim_now;
   var $progress_lim_qtd;
   var $progress_grid;
   var $progress_pdf;
   var $progress_res;
   var $progress_graf;
   var $count_ger;
   var $pacientes_id_paciente_Old;
   var $arg_sum_pacientes_id_paciente;
   var $Label_pacientes_id_paciente;
   var $sc_proc_quebra_pacientes_id_paciente;
   var $count_pacientes_id_paciente;
   var $pacientes_estado_paciente_Old;
   var $arg_sum_pacientes_estado_paciente;
   var $Label_pacientes_estado_paciente;
   var $sc_proc_quebra_pacientes_estado_paciente;
   var $count_pacientes_estado_paciente;
   var $pacientes_id_paciente;
   var $gestiones_logro_comunicacion_gestion;
   var $gestiones_fecha_comunicacion;
   var $gestiones_autor_gestion;
   var $pacientes_departamento_paciente;
   var $pacientes_ciudad_paciente;
   var $pacientes_estado_paciente;
   var $pacientes_status_paciente;
   var $pacientes_fecha_activacion_paciente;
   var $pacientes_codigo_xofigo;
   var $tratamiento_producto_tratamiento;
   var $tratamiento_nombre_referencia;
   var $tratamiento_dosis_tratamiento;
   var $gestiones_numero_cajas;
   var $tratamiento_asegurador_tratamiento;
   var $tratamiento_operador_logistico_tratamiento;
   var $tratamiento_punto_entrega;
   var $gestiones_reclamo_gestion;
   var $gestiones_fecha_reclamacion_gestion;
   var $gestiones_causa_no_reclamacion_gestion;
   var $historial_reclamacion_id_historial_reclamacion;
   var $historial_reclamacion_anio_historial_reclamacion;
   var $historial_reclamacion_mes1;
   var $historial_reclamacion_reclamo1;
   var $historial_reclamacion_fecha_reclamacion1;
   var $historial_reclamacion_motivo_no_reclamacion1;
   var $historial_reclamacion_mes2;
   var $historial_reclamacion_reclamo2;
   var $historial_reclamacion_fecha_reclamacion2;
   var $historial_reclamacion_motivo_no_reclamacion2;
   var $historial_reclamacion_mes3;
   var $historial_reclamacion_reclamo3;
   var $historial_reclamacion_fecha_reclamacion3;
   var $historial_reclamacion_motivo_no_reclamacion3;
   var $historial_reclamacion_mes4;
   var $historial_reclamacion_reclamo4;
   var $historial_reclamacion_fecha_reclamacion4;
   var $historial_reclamacion_motivo_no_reclamacion4;
   var $historial_reclamacion_mes5;
   var $historial_reclamacion_reclamo5;
   var $historial_reclamacion_fecha_reclamacion5;
   var $historial_reclamacion_motivo_no_reclamacion5;
   var $historial_reclamacion_mes6;
   var $historial_reclamacion_reclamo6;
   var $historial_reclamacion_fecha_reclamacion6;
   var $historial_reclamacion_motivo_no_reclamacion6;
   var $historial_reclamacion_mes7;
   var $historial_reclamacion_reclamo7;
   var $historial_reclamacion_fecha_reclamacion7;
   var $historial_reclamacion_motivo_no_reclamacion7;
   var $historial_reclamacion_mes8;
   var $historial_reclamacion_reclamo8;
   var $historial_reclamacion_fecha_reclamacion8;
   var $historial_reclamacion_motivo_no_reclamacion8;
   var $historial_reclamacion_mes9;
   var $historial_reclamacion_reclamo9;
   var $historial_reclamacion_fecha_reclamacion9;
   var $historial_reclamacion_motivo_no_reclamacion9;
   var $historial_reclamacion_mes10;
   var $historial_reclamacion_reclamo10;
   var $historial_reclamacion_fecha_reclamacion10;
   var $historial_reclamacion_motivo_no_reclamacion10;
   var $historial_reclamacion_mes11;
   var $historial_reclamacion_reclamo11;
   var $historial_reclamacion_fecha_reclamacion11;
   var $historial_reclamacion_motivo_no_reclamacion11;
   var $historial_reclamacion_mes12;
   var $historial_reclamacion_reclamo12;
   var $historial_reclamacion_fecha_reclamacion12;
   var $historial_reclamacion_motivo_no_reclamacion12;
//--- 
 function monta_grid($linhas = 0)
 {
   global $nm_saida;

   clearstatcache();
   $this->NM_cor_embutida();
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       $this->nm_fim_grid();
   } 
   else 
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
       { 
           include_once($this->Ini->path_embutida . "Informe_reclamacion_historial/" . $this->Ini->Apl_resumo); 
       } 
       else 
       { 
           include_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
       } 
       $this->Res         = new Informe_reclamacion_historial_resumo();
       $this->Res->Db     = $this->Db;
       $this->Res->Erro   = $this->Erro;
       $this->Res->Ini    = $this->Ini;
       $this->Res->Lookup = $this->Lookup;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pdf_res'])
       {
           $this->cabecalho();
       } 
       $nm_saida->saida(" <TR>\r\n");
       $nm_saida->saida("  <TD id='sc_grid_content'  colspan=1>\r\n");
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       $nmgrp_apl_opcao= $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
           $this->nmgp_embbed_placeholder_top();
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pdf_res'] && (!isset($_GET['flash_graf']) || 'chart' != $_GET['flash_graf']))
       {
           $this->grid();
       }
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_embbed_placeholder_bot();
           $this->nmgp_barra_bot();
       } 
       $nm_saida->saida("   </table>\r\n");
       $nm_saida->saida("  </TD>\r\n");
       $nm_saida->saida(" </TR>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf")
       { 
           if (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
           {
               $this->Res->monta_resumo(true);
               require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
               $this->Graf  = new Informe_reclamacion_historial_grafico();
               $this->Graf->Db     = $this->Db;
               $this->Graf->Erro   = $this->Erro;
               $this->Graf->Ini    = $this->Ini;
               $this->Graf->Lookup = $this->Lookup;
               $this->Graf->monta_grafico();
               exit;
           }
           else
           {
               $this->Res->monta_html_ini_pdf();
               $this->Res->monta_resumo();
               $this->Res->monta_html_fim_pdf();
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['graf_pdf'] == "S")
       { 
           if (isset($_GET['flash_graf']) && 'pdf' == $_GET['flash_graf'])
           {
               $this->grafico_pdf_flash();
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "grid";
           } 
           elseif (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf")
           { 
               $this->grafico_pdf();
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "grid";
           } 
           else 
           { 
               $this->nm_fim_grid();
           } 
       } 
       else 
       { 
           $flag_apaga_pdf_log = TRUE;
           if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf")
           { 
               $flag_apaga_pdf_log = FALSE;
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "igual";
           } 
           $this->nm_fim_grid($flag_apaga_pdf_log);
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'];
 }
 function resume($linhas = 0)
 {
    $this->Lin_impressas = 0;
    $this->Lin_final     = FALSE;
    $this->grid($linhas);
 }
//--- 
 function inicializa()
 {
   global $nm_saida, $NM_run_iframe,
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det,
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->Ind_lig_mult = 0;
   $this->nm_data    = new nm_data("es");
   $this->Css_Cmp = array();
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = trim(substr($cada_css, 1, $Pos1 - 1));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['doc_word'])
       { 
           $this->Css_Cmp[$Tag] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['Lig_Md5'] = array();
   }
   $this->force_toolbar = false;
   if (count($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp']) > 1)
   {
       $this->width_tabula_quebra  = (((count($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp']) - 1) * 13) + 3) . "px";
       $this->width_tabula_display = "''";
   }
   else
   {
       $this->width_tabula_quebra  = "0px";
       $this->width_tabula_display = "none";
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['mostra_edit'] = "N";
   }
   $this->sc_proc_quebra_pacientes_id_paciente = false;
   $this->sc_proc_quebra_pacientes_estado_paciente = false;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("Informe_reclamacion_historial", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_2'] = "on";
   $this->nmgp_botoes['exit'] = "on";
   $this->nmgp_botoes['first'] = "on";
   $this->nmgp_botoes['back'] = "on";
   $this->nmgp_botoes['forward'] = "on";
   $this->nmgp_botoes['last'] = "on";
   $this->nmgp_botoes['pdf'] = "on";
   $this->nmgp_botoes['xls'] = "on";
   $this->nmgp_botoes['xml'] = "on";
   $this->nmgp_botoes['csv'] = "on";
   $this->nmgp_botoes['rtf'] = "on";
   $this->nmgp_botoes['word'] = "on";
   $this->nmgp_botoes['export'] = "on";
   $this->nmgp_botoes['print'] = "on";
   $this->nmgp_botoes['summary'] = "on";
   $this->nmgp_botoes['sel_col'] = "on";
   $this->nmgp_botoes['sort_col'] = "on";
   $this->nmgp_botoes['qsearch'] = "on";
   $this->nmgp_botoes['gantt'] = "on";
   $this->nmgp_botoes['groupby'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp']))
   { 
       $this->nmgp_botoes['summary'] = "off";
   } 
   $this->sc_proc_grid = false; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['doc_word'])
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq_ant'];  
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "muda_qt_linhas";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "Informe_reclamacion_historial/Informe_reclamacion_historial_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "Informe_reclamacion_historial_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_pdf'] != "pdf")  
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
       } 
       else 
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = "pdf";
       } 
   } 
   else 
   { 
       $this->nm_location = $_SESSION['scriptcase']['contr_link_emb'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new Informe_reclamacion_historial_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid'] = 10;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['rows'];  
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Ind_Groupby'] == "sc_free_group_by") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_select'] = array(); 
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_sql']['pacientes.ID_PACIENTE']))
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_select']['pacientes.ID_PACIENTE'] = 'ASC'; 
           } 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Ind_Groupby'] == "sc_free_group_by") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_quebra'] = array(); 
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_sql'] as $SC_Sql_col => $SC_Sql_order)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_quebra'][$SC_Sql_col] = $SC_Sql_order;
           }
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "igual" ;  
       }
       elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_quebra'][$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "inicio" ;  
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_grid'] = ""; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_quebra'][$nmgp_ordem] == "asc") 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_quebra'][$nmgp_ordem] = "desc"; 
           }   
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_quebra'][$nmgp_ordem] = "asc"; 
           }   
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_cmp'] = $nmgp_ordem;  
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_quebra'][$nmgp_ordem]);  
       }   
       else   
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_grid'] = $nmgp_ordem  ; 
       }   
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao']       = "igual" ; 
   } 
// 
   $this->count_ger = 0;
   $this->arg_sum_pacientes_id_paciente = "";
   $this->count_pacientes_id_paciente = 0;
   $this->arg_sum_pacientes_estado_paciente = "";
   $this->count_pacientes_estado_paciente = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['tot_geral'][1] ;  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid'] == "all") 
   { 
       $this->Tot->quebra_geral() ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['tot_geral'][1];
   } 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_total']);
       $this->Tot->quebra_geral() ; 
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['contr_array_resumo']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['contr_array_resumo'] = "NAO";
       } 
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['tot_geral'][1];
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_resumo'])) 
   { 
       $nmgp_select = "SELECT count(*) from " . $this->Ini->nm_tabela; 
       $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq']; 
       if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'])) 
       { 
           $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_resumo']; 
       } 
       else
       { 
           $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_resumo'] . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $rt_grid = $this->Db->Execute($nmgp_select) ; 
       if ($rt_grid === false && !$rt_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit ; 
       }  
       $this->count_ger = $rt_grid->fields[0];
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_total'] = $rt_grid->fields[0];  
       
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] = 0 ; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start--; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
//----- 
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
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_quebra'] as $campo => $ordem) 
   {
       if (!empty($campos_order)) 
       {
           $campos_order .= ", ";
       }
       $campos_order .= $campo . " " . $ordem;
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ordem_desc']; 
   } 
   elseif (!empty($campos_order_select)) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $campos_order_select; 
   } 
   elseif (!empty($campos_order)) 
   { 
       $nmgp_order_by = " order by " . $campos_order; 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" || isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['paginacao']))
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
   }  
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
   }  
   else 
   { 
       $this->pacientes_id_paciente = $this->rs_grid->fields[0] ;  
       $this->pacientes_id_paciente = (string)$this->pacientes_id_paciente;
       $this->gestiones_logro_comunicacion_gestion = $this->rs_grid->fields[1] ;  
       $this->gestiones_fecha_comunicacion = $this->rs_grid->fields[2] ;  
       $this->gestiones_autor_gestion = $this->rs_grid->fields[3] ;  
       $this->pacientes_departamento_paciente = $this->rs_grid->fields[4] ;  
       $this->pacientes_ciudad_paciente = $this->rs_grid->fields[5] ;  
       $this->pacientes_estado_paciente = $this->rs_grid->fields[6] ;  
       $this->pacientes_status_paciente = $this->rs_grid->fields[7] ;  
       $this->pacientes_fecha_activacion_paciente = $this->rs_grid->fields[8] ;  
       $this->pacientes_codigo_xofigo = $this->rs_grid->fields[9] ;  
       $this->pacientes_codigo_xofigo = (string)$this->pacientes_codigo_xofigo;
       $this->tratamiento_producto_tratamiento = $this->rs_grid->fields[10] ;  
       $this->tratamiento_nombre_referencia = $this->rs_grid->fields[11] ;  
       $this->tratamiento_dosis_tratamiento = $this->rs_grid->fields[12] ;  
       $this->gestiones_numero_cajas = $this->rs_grid->fields[13] ;  
       $this->tratamiento_asegurador_tratamiento = $this->rs_grid->fields[14] ;  
       $this->tratamiento_operador_logistico_tratamiento = $this->rs_grid->fields[15] ;  
       $this->tratamiento_punto_entrega = $this->rs_grid->fields[16] ;  
       $this->gestiones_reclamo_gestion = $this->rs_grid->fields[17] ;  
       $this->gestiones_fecha_reclamacion_gestion = $this->rs_grid->fields[18] ;  
       $this->gestiones_causa_no_reclamacion_gestion = $this->rs_grid->fields[19] ;  
       $this->historial_reclamacion_id_historial_reclamacion = $this->rs_grid->fields[20] ;  
       $this->historial_reclamacion_id_historial_reclamacion = (string)$this->historial_reclamacion_id_historial_reclamacion;
       $this->historial_reclamacion_anio_historial_reclamacion = $this->rs_grid->fields[21] ;  
       $this->historial_reclamacion_anio_historial_reclamacion = (string)$this->historial_reclamacion_anio_historial_reclamacion;
       $this->historial_reclamacion_mes1 = $this->rs_grid->fields[22] ;  
       $this->historial_reclamacion_reclamo1 = $this->rs_grid->fields[23] ;  
       $this->historial_reclamacion_fecha_reclamacion1 = $this->rs_grid->fields[24] ;  
       $this->historial_reclamacion_motivo_no_reclamacion1 = $this->rs_grid->fields[25] ;  
       $this->historial_reclamacion_mes2 = $this->rs_grid->fields[26] ;  
       $this->historial_reclamacion_reclamo2 = $this->rs_grid->fields[27] ;  
       $this->historial_reclamacion_fecha_reclamacion2 = $this->rs_grid->fields[28] ;  
       $this->historial_reclamacion_motivo_no_reclamacion2 = $this->rs_grid->fields[29] ;  
       $this->historial_reclamacion_mes3 = $this->rs_grid->fields[30] ;  
       $this->historial_reclamacion_reclamo3 = $this->rs_grid->fields[31] ;  
       $this->historial_reclamacion_fecha_reclamacion3 = $this->rs_grid->fields[32] ;  
       $this->historial_reclamacion_motivo_no_reclamacion3 = $this->rs_grid->fields[33] ;  
       $this->historial_reclamacion_mes4 = $this->rs_grid->fields[34] ;  
       $this->historial_reclamacion_reclamo4 = $this->rs_grid->fields[35] ;  
       $this->historial_reclamacion_fecha_reclamacion4 = $this->rs_grid->fields[36] ;  
       $this->historial_reclamacion_motivo_no_reclamacion4 = $this->rs_grid->fields[37] ;  
       $this->historial_reclamacion_mes5 = $this->rs_grid->fields[38] ;  
       $this->historial_reclamacion_reclamo5 = $this->rs_grid->fields[39] ;  
       $this->historial_reclamacion_fecha_reclamacion5 = $this->rs_grid->fields[40] ;  
       $this->historial_reclamacion_motivo_no_reclamacion5 = $this->rs_grid->fields[41] ;  
       $this->historial_reclamacion_mes6 = $this->rs_grid->fields[42] ;  
       $this->historial_reclamacion_reclamo6 = $this->rs_grid->fields[43] ;  
       $this->historial_reclamacion_fecha_reclamacion6 = $this->rs_grid->fields[44] ;  
       $this->historial_reclamacion_motivo_no_reclamacion6 = $this->rs_grid->fields[45] ;  
       $this->historial_reclamacion_mes7 = $this->rs_grid->fields[46] ;  
       $this->historial_reclamacion_reclamo7 = $this->rs_grid->fields[47] ;  
       $this->historial_reclamacion_fecha_reclamacion7 = $this->rs_grid->fields[48] ;  
       $this->historial_reclamacion_motivo_no_reclamacion7 = $this->rs_grid->fields[49] ;  
       $this->historial_reclamacion_mes8 = $this->rs_grid->fields[50] ;  
       $this->historial_reclamacion_reclamo8 = $this->rs_grid->fields[51] ;  
       $this->historial_reclamacion_fecha_reclamacion8 = $this->rs_grid->fields[52] ;  
       $this->historial_reclamacion_motivo_no_reclamacion8 = $this->rs_grid->fields[53] ;  
       $this->historial_reclamacion_mes9 = $this->rs_grid->fields[54] ;  
       $this->historial_reclamacion_reclamo9 = $this->rs_grid->fields[55] ;  
       $this->historial_reclamacion_fecha_reclamacion9 = $this->rs_grid->fields[56] ;  
       $this->historial_reclamacion_motivo_no_reclamacion9 = $this->rs_grid->fields[57] ;  
       $this->historial_reclamacion_mes10 = $this->rs_grid->fields[58] ;  
       $this->historial_reclamacion_reclamo10 = $this->rs_grid->fields[59] ;  
       $this->historial_reclamacion_fecha_reclamacion10 = $this->rs_grid->fields[60] ;  
       $this->historial_reclamacion_motivo_no_reclamacion10 = $this->rs_grid->fields[61] ;  
       $this->historial_reclamacion_mes11 = $this->rs_grid->fields[62] ;  
       $this->historial_reclamacion_reclamo11 = $this->rs_grid->fields[63] ;  
       $this->historial_reclamacion_fecha_reclamacion11 = $this->rs_grid->fields[64] ;  
       $this->historial_reclamacion_motivo_no_reclamacion11 = $this->rs_grid->fields[65] ;  
       $this->historial_reclamacion_mes12 = $this->rs_grid->fields[66] ;  
       $this->historial_reclamacion_reclamo12 = $this->rs_grid->fields[67] ;  
       $this->historial_reclamacion_fecha_reclamacion12 = $this->rs_grid->fields[68] ;  
       $this->historial_reclamacion_motivo_no_reclamacion12 = $this->rs_grid->fields[69] ;  
       if (!isset($this->pacientes_id_paciente)) { $this->pacientes_id_paciente = ""; }
       if (!isset($this->pacientes_estado_paciente)) { $this->pacientes_estado_paciente = ""; }
       $this->arg_sum_pacientes_id_paciente = " = " . $this->pacientes_id_paciente;
       $this->arg_sum_pacientes_estado_paciente = " = " . $this->Db->qstr($this->pacientes_estado_paciente);
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $this->SC_sep_quebra = false;
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Ind_Groupby'] == "sc_free_group_by") 
       {
           $this->pacientes_id_paciente_Old = $this->pacientes_id_paciente ; 
           $this->pacientes_estado_paciente_Old = $this->pacientes_estado_paciente ; 
           $sql_where = "";
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp'] as $cmp => $sql)
           {
               $cmp_qb     = $this->$cmp;
               $tmp        = "arg_sum_" . $cmp;
               $sql_where .= (!empty($sql_where)) ? " and " : "";
               $sql_where .= $sql . $this->$tmp;
               $tmp        = "quebra_" . $cmp . "_sc_free_group_by";
               $this->$tmp($cmp_qb, $sql_where);
           }
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->pacientes_id_paciente = $this->rs_grid->fields[0] ;  
           $this->gestiones_logro_comunicacion_gestion = $this->rs_grid->fields[1] ;  
           $this->gestiones_fecha_comunicacion = $this->rs_grid->fields[2] ;  
           $this->gestiones_autor_gestion = $this->rs_grid->fields[3] ;  
           $this->pacientes_departamento_paciente = $this->rs_grid->fields[4] ;  
           $this->pacientes_ciudad_paciente = $this->rs_grid->fields[5] ;  
           $this->pacientes_estado_paciente = $this->rs_grid->fields[6] ;  
           $this->pacientes_status_paciente = $this->rs_grid->fields[7] ;  
           $this->pacientes_fecha_activacion_paciente = $this->rs_grid->fields[8] ;  
           $this->pacientes_codigo_xofigo = $this->rs_grid->fields[9] ;  
           $this->tratamiento_producto_tratamiento = $this->rs_grid->fields[10] ;  
           $this->tratamiento_nombre_referencia = $this->rs_grid->fields[11] ;  
           $this->tratamiento_dosis_tratamiento = $this->rs_grid->fields[12] ;  
           $this->gestiones_numero_cajas = $this->rs_grid->fields[13] ;  
           $this->tratamiento_asegurador_tratamiento = $this->rs_grid->fields[14] ;  
           $this->tratamiento_operador_logistico_tratamiento = $this->rs_grid->fields[15] ;  
           $this->tratamiento_punto_entrega = $this->rs_grid->fields[16] ;  
           $this->gestiones_reclamo_gestion = $this->rs_grid->fields[17] ;  
           $this->gestiones_fecha_reclamacion_gestion = $this->rs_grid->fields[18] ;  
           $this->gestiones_causa_no_reclamacion_gestion = $this->rs_grid->fields[19] ;  
           $this->historial_reclamacion_id_historial_reclamacion = $this->rs_grid->fields[20] ;  
           $this->historial_reclamacion_anio_historial_reclamacion = $this->rs_grid->fields[21] ;  
           $this->historial_reclamacion_mes1 = $this->rs_grid->fields[22] ;  
           $this->historial_reclamacion_reclamo1 = $this->rs_grid->fields[23] ;  
           $this->historial_reclamacion_fecha_reclamacion1 = $this->rs_grid->fields[24] ;  
           $this->historial_reclamacion_motivo_no_reclamacion1 = $this->rs_grid->fields[25] ;  
           $this->historial_reclamacion_mes2 = $this->rs_grid->fields[26] ;  
           $this->historial_reclamacion_reclamo2 = $this->rs_grid->fields[27] ;  
           $this->historial_reclamacion_fecha_reclamacion2 = $this->rs_grid->fields[28] ;  
           $this->historial_reclamacion_motivo_no_reclamacion2 = $this->rs_grid->fields[29] ;  
           $this->historial_reclamacion_mes3 = $this->rs_grid->fields[30] ;  
           $this->historial_reclamacion_reclamo3 = $this->rs_grid->fields[31] ;  
           $this->historial_reclamacion_fecha_reclamacion3 = $this->rs_grid->fields[32] ;  
           $this->historial_reclamacion_motivo_no_reclamacion3 = $this->rs_grid->fields[33] ;  
           $this->historial_reclamacion_mes4 = $this->rs_grid->fields[34] ;  
           $this->historial_reclamacion_reclamo4 = $this->rs_grid->fields[35] ;  
           $this->historial_reclamacion_fecha_reclamacion4 = $this->rs_grid->fields[36] ;  
           $this->historial_reclamacion_motivo_no_reclamacion4 = $this->rs_grid->fields[37] ;  
           $this->historial_reclamacion_mes5 = $this->rs_grid->fields[38] ;  
           $this->historial_reclamacion_reclamo5 = $this->rs_grid->fields[39] ;  
           $this->historial_reclamacion_fecha_reclamacion5 = $this->rs_grid->fields[40] ;  
           $this->historial_reclamacion_motivo_no_reclamacion5 = $this->rs_grid->fields[41] ;  
           $this->historial_reclamacion_mes6 = $this->rs_grid->fields[42] ;  
           $this->historial_reclamacion_reclamo6 = $this->rs_grid->fields[43] ;  
           $this->historial_reclamacion_fecha_reclamacion6 = $this->rs_grid->fields[44] ;  
           $this->historial_reclamacion_motivo_no_reclamacion6 = $this->rs_grid->fields[45] ;  
           $this->historial_reclamacion_mes7 = $this->rs_grid->fields[46] ;  
           $this->historial_reclamacion_reclamo7 = $this->rs_grid->fields[47] ;  
           $this->historial_reclamacion_fecha_reclamacion7 = $this->rs_grid->fields[48] ;  
           $this->historial_reclamacion_motivo_no_reclamacion7 = $this->rs_grid->fields[49] ;  
           $this->historial_reclamacion_mes8 = $this->rs_grid->fields[50] ;  
           $this->historial_reclamacion_reclamo8 = $this->rs_grid->fields[51] ;  
           $this->historial_reclamacion_fecha_reclamacion8 = $this->rs_grid->fields[52] ;  
           $this->historial_reclamacion_motivo_no_reclamacion8 = $this->rs_grid->fields[53] ;  
           $this->historial_reclamacion_mes9 = $this->rs_grid->fields[54] ;  
           $this->historial_reclamacion_reclamo9 = $this->rs_grid->fields[55] ;  
           $this->historial_reclamacion_fecha_reclamacion9 = $this->rs_grid->fields[56] ;  
           $this->historial_reclamacion_motivo_no_reclamacion9 = $this->rs_grid->fields[57] ;  
           $this->historial_reclamacion_mes10 = $this->rs_grid->fields[58] ;  
           $this->historial_reclamacion_reclamo10 = $this->rs_grid->fields[59] ;  
           $this->historial_reclamacion_fecha_reclamacion10 = $this->rs_grid->fields[60] ;  
           $this->historial_reclamacion_motivo_no_reclamacion10 = $this->rs_grid->fields[61] ;  
           $this->historial_reclamacion_mes11 = $this->rs_grid->fields[62] ;  
           $this->historial_reclamacion_reclamo11 = $this->rs_grid->fields[63] ;  
           $this->historial_reclamacion_fecha_reclamacion11 = $this->rs_grid->fields[64] ;  
           $this->historial_reclamacion_motivo_no_reclamacion11 = $this->rs_grid->fields[65] ;  
           $this->historial_reclamacion_mes12 = $this->rs_grid->fields[66] ;  
           $this->historial_reclamacion_reclamo12 = $this->rs_grid->fields[67] ;  
           $this->historial_reclamacion_fecha_reclamacion12 = $this->rs_grid->fields[68] ;  
           $this->historial_reclamacion_motivo_no_reclamacion12 = $this->rs_grid->fields[69] ;  
           if (!isset($this->pacientes_id_paciente)) { $this->pacientes_id_paciente = ""; }
           if (!isset($this->pacientes_estado_paciente)) { $this->pacientes_estado_paciente = ""; }
       } 
   } 
   $this->nmgp_reg_inicial = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final'] + 1;
   $this->nmgp_reg_final   = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid'];
   $this->nmgp_reg_final   = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Informe Reclamaciones Historial :: PDF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
           if ($_SESSION['scriptcase']['proc_mobile'])
           {
?>
              <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
           }
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
 <SCRIPT LANGUAGE="Javascript" SRC="<?php echo $this->Ini->path_js; ?>/nm_gauge.js"></SCRIPT>
</HEAD>
<BODY scrolling="no">
<table class="scGridTabela" style="padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;"><tr class="scGridFieldOddVert"><td>
<?php echo $this->Ini->Nm_lang['lang_pdff_gnrt']; ?>...<br>
<?php
           $this->progress_grid    = $this->rs_grid->RecordCount();
           $this->progress_pdf     = 0;
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pivot_charts']) : 0;
           $this->progress_graf    = 0;
           $this->progress_tot     = 0;
           $this->progress_now     = 0;
           $this->progress_lim_tot = 0;
           $this->progress_lim_now = 0;
           if (-1 < $this->progress_grid)
           {
               $this->progress_lim_qtd = (250 < $this->progress_grid) ? 250 : $this->progress_grid;
               $this->progress_lim_tot = floor($this->progress_grid / $this->progress_lim_qtd);
               $this->progress_pdf     = floor($this->progress_grid * 0.25) + 1;
               $this->progress_tot     = $this->progress_grid + $this->progress_pdf + $this->progress_res + $this->progress_graf;
               $str_pbfile             = isset($_GET['pbfile']) ? urldecode($_GET['pbfile']) : $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
               $this->progress_fp      = fopen($str_pbfile, 'w');
               fwrite($this->progress_fp, "PDF\n");
               fwrite($this->progress_fp, $this->Ini->path_js   . "\n");
               fwrite($this->progress_fp, $this->Ini->path_prod . "/img/\n");
               fwrite($this->progress_fp, $this->progress_tot   . "\n");
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_strt'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               fwrite($this->progress_fp, "1_#NM#_" . $lang_protect . "...\n");
               flush();
           }
       }
       $nm_fundo_pagina = ""; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
       $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>Informe Reclamaciones Historial</TITLE>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
           $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
       { 
           $nm_saida->saida("   <form name=\"form_ajax_redir_1\" method=\"post\" style=\"display: none\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . session_id() . "\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $nm_saida->saida("   <form name=\"form_ajax_redir_2\" method=\"post\" style=\"display: none\"> \r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . session_id() . "\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"Informe_reclamacion_historial_jquery.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"Informe_reclamacion_historial_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';</script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <style type=\"text/css\">\r\n");
           $nm_saida->saida("     #quicksearchph_top {\r\n");
           $nm_saida->saida("       position: relative;\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     #quicksearchph_top img {\r\n");
           $nm_saida->saida("       position: absolute;\r\n");
           $nm_saida->saida("       top: 0;\r\n");
           $nm_saida->saida("       right: 0;\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   </style>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           $nm_saida->saida("   var SC_Link_View = false;\r\n");
           if ($this->Ini->SC_Link_View)
           {
               $nm_saida->saida("   SC_Link_View = true;\r\n");
           }
           $nm_saida->saida("   var Qsearch_ok = true;\r\n");
           if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] != "on")
           {
               $nm_saida->saida("   Qsearch_ok = false;\r\n");
           }
           $nm_saida->saida("   var scQSInit = true;\r\n");
           $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid']) . ";\r\n");
           $nm_saida->saida("  function SC_init_jquery(){ \r\n");
           $nm_saida->saida("   \$(function(){ \r\n");
           if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
           {
               $nm_saida->saida("     \$('#SC_fast_search_top').keyup(function(e) {\r\n");
               $nm_saida->saida("       scQuickSearchKeyUp('top', e);\r\n");
               $nm_saida->saida("     });\r\n");
           }
           $nm_saida->saida("     $('#id_F0_top').keyup(function(e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("          return false; \r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#id_F0_bot').keyup(function(e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("          return false; \r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpText\").mouseover(function() { $(this).addClass(\"scBtnGrpTextOver\"); }).mouseout(function() { $(this).removeClass(\"scBtnGrpTextOver\"); });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpClick\").find(\"a\").click(function(e){\r\n");
           $nm_saida->saida("        e.preventDefault();\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpClick\").click(function(){\r\n");
           $nm_saida->saida("        var aObj = $(this).find(\"a\"), aHref = aObj.attr(\"href\");\r\n");
           $nm_saida->saida("        if (\"javascript:\" == aHref.substr(0, 11)) {\r\n");
           $nm_saida->saida("           eval(aHref.substr(11));\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("        else {\r\n");
           $nm_saida->saida("           aObj.trigger(\"click\");\r\n");
           $nm_saida->saida("        }\r\n");
           $nm_saida->saida("      }).mouseover(function(){\r\n");
           $nm_saida->saida("        $(this).css(\"cursor\", \"pointer\");\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }); \r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  SC_init_jquery();\r\n");
           $nm_saida->saida("   \$(window).load(function() {\r\n");
           if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
           {
               $nm_saida->saida("     scQuickSearchInit(false, '');\r\n");
               $nm_saida->saida("     $('#SC_fast_search_top').listen();\r\n");
               $nm_saida->saida("     scQuickSearchKeyUp('top', null);\r\n");
               $nm_saida->saida("     scQSInit = false;\r\n");
           }
           $nm_saida->saida("   });\r\n");
           $nm_saida->saida("   function scQuickSearchSubmit_top() {\r\n");
           $nm_saida->saida("     document.F0_top.nmgp_opcao.value = 'fast_search';\r\n");
           $nm_saida->saida("     document.F0_top.submit();\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scQuickSearchInit(bPosOnly, sPos) {\r\n");
           $nm_saida->saida("     if (!bPosOnly) {\r\n");
           $nm_saida->saida("       if ('' == sPos || 'top' == sPos) scQuickSearchSize('SC_fast_search_top', 'SC_fast_search_close_top', 'SC_fast_search_submit_top', 'quicksearchph_top');\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scQuickSearchSize(sIdInput, sIdClose, sIdSubmit, sPlaceHolder) {\r\n");
           $nm_saida->saida("     if($('#' + sIdInput).length)\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("         var oInput = $('#' + sIdInput),\r\n");
           $nm_saida->saida("             oClose = $('#' + sIdClose),\r\n");
           $nm_saida->saida("             oSubmit = $('#' + sIdSubmit),\r\n");
           $nm_saida->saida("             oPlace = $('#' + sPlaceHolder),\r\n");
           $nm_saida->saida("             iInputP = parseInt(oInput.css('padding-right')) || 0,\r\n");
           $nm_saida->saida("             iInputB = parseInt(oInput.css('border-right-width')) || 0,\r\n");
           $nm_saida->saida("             iInputW = oInput.outerWidth(),\r\n");
           $nm_saida->saida("             iPlaceW = oPlace.outerWidth(),\r\n");
           $nm_saida->saida("             oInputO = oInput.offset(),\r\n");
           $nm_saida->saida("             oPlaceO = oPlace.offset(),\r\n");
           $nm_saida->saida("             iNewRight;\r\n");
           $nm_saida->saida("         iNewRight = (iPlaceW - iInputW) - (oInputO.left - oPlaceO.left) + iInputB + 1;\r\n");
           $nm_saida->saida("         oInput.css({\r\n");
           $nm_saida->saida("           'height': Math.max(oInput.height(), 16) + 'px',\r\n");
           $nm_saida->saida("           'padding-right': iInputP + 16 + " . $this->Ini->Str_qs_image_padding . " + 'px'\r\n");
           $nm_saida->saida("         });\r\n");
           $nm_saida->saida("         oClose.css({\r\n");
           $nm_saida->saida("           'right': iNewRight + " . $this->Ini->Str_qs_image_padding . " + 'px',\r\n");
           $nm_saida->saida("           'cursor': 'pointer'\r\n");
           $nm_saida->saida("         });\r\n");
           $nm_saida->saida("         oSubmit.css({\r\n");
           $nm_saida->saida("           'right': iNewRight + " . $this->Ini->Str_qs_image_padding . " + 'px',\r\n");
           $nm_saida->saida("           'cursor': 'pointer'\r\n");
           $nm_saida->saida("         });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scQuickSearchKeyUp(sPos, e) {\r\n");
           $nm_saida->saida("    if(typeof scQSInitVal !== 'undefined')\r\n");
           $nm_saida->saida("    {\r\n");
           $nm_saida->saida("     if ('' != scQSInitVal && $('#SC_fast_search_' + sPos).val() == scQSInitVal && scQSInit) {\r\n");
           $nm_saida->saida("       $('#SC_fast_search_close_' + sPos).show();\r\n");
           $nm_saida->saida("       $('#SC_fast_search_submit_' + sPos).hide();\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     else {\r\n");
           $nm_saida->saida("       $('#SC_fast_search_close_' + sPos).hide();\r\n");
           $nm_saida->saida("       $('#SC_fast_search_submit_' + sPos).show();\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     if (null != e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("         if ('top' == sPos) nm_gp_submit_qsearch('top');\r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGroupByShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).success(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGroupByHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSaveGridShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).success(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSaveGridHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_save_grid_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_save_grid_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).success(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnOrderCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).success(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnOrderCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   var scBtnGrpStatus = {};\r\n");
           $nm_saida->saida("   function scBtnGrpShow(sGroup) {\r\n");
           $nm_saida->saida("     var btnPos = $('#sc_btgp_btn_' + sGroup).offset();\r\n");
           $nm_saida->saida("     scBtnGrpStatus[sGroup] = 'open';\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).mouseout(function() {\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup + ' span a').click(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       scBtnGrpHide(sGroup);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup).css({\r\n");
           $nm_saida->saida("       'left': btnPos.left\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseleave(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .show('fast');\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGrpHide(sGroup) {\r\n");
           $nm_saida->saida("     if ('over' != scBtnGrpStatus[sGroup]) {\r\n");
           $nm_saida->saida("       $('#sc_btgp_div_' + sGroup).hide('fast');\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   </script> \r\n");
       } 
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_Informe_reclamacion_historial_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
       {
           $this->NM_field_over  = 0;
           $this->NM_field_click = 0;
           $Css_sub_cons = array();
           if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
           { 
               $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
               $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw'])) 
               { 
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw'] as $Apl => $Css_apl)
                   {
                       $Css_sub_cons[] = $Css_apl;
                       $Css_sub_cons[] = str_replace(".css", $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css", $Css_apl);
                   }
               } 
           } 
           else 
           { 
               $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
               $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css'])) 
               { 
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css'] as $Apl => $Css_apl)
                   {
                       $Css_sub_cons[] = $Css_apl;
                       $Css_sub_cons[] = str_replace(".css", $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css", $Css_apl);
                   }
               } 
           } 
           if (is_file($this->Ini->path_css . $NM_css_file))
           {
               $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   if (substr(trim($NM_line_css), 0, 16) == ".scGridFieldOver" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_over = 1;
                   }
                   if (substr(trim($NM_line_css), 0, 17) == ".scGridFieldClick" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_click = 1;
                   }
                   $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                   if ($write_css) {@fwrite($NM_css, "    " .  $NM_line_css . "\r\n");}
               }
           }
           if (is_file($this->Ini->path_css . $NM_css_dir))
           {
               $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   if (substr(trim($NM_line_css), 0, 16) == ".scGridFieldOver" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_over = 1;
                   }
                   if (substr(trim($NM_line_css), 0, 17) == ".scGridFieldClick" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_click = 1;
                   }
                   $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                   if ($write_css) {@fwrite($NM_css, "    " .  $NM_line_css . "\r\n");}
               }
           }
           if (!empty($Css_sub_cons))
           {
               $Css_sub_cons = array_unique($Css_sub_cons);
               foreach ($Css_sub_cons as $Cada_css_sub)
               {
                   if (is_file($this->Ini->path_css . $Cada_css_sub))
                   {
                       $compl_css = str_replace(".", "_", $Cada_css_sub);
                       $temp_css  = explode("/", $compl_css);
                       if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
                       $NM_css_attr = file($this->Ini->path_css . $Cada_css_sub);
                       foreach ($NM_css_attr as $NM_line_css)
                       {
                           $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                           if ($write_css) {@fwrite($NM_css, "    ." .  $compl_css . "_" . substr(trim($NM_line_css), 1) . "\r\n");}
                       }
                   }
               }
           }
       }
       if ($write_css) {@fclose($NM_css);}
           $this->NM_css_val_embed .= "win";
           $this->NM_css_ajx_embed .= "ult_set";
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       elseif ($this->NM_opcao == "print" || $this->Print_All)
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_Informe_reclamacion_historial_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['num_css'] . '.css');
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("  </style>\r\n");
       }
       else
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_Informe_reclamacion_historial_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $nm_saida->saida("  </style>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
           $nm_saida->saida("  </style>\r\n");
       }
       $nm_saida->saida("  </HEAD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $cada_css = ".Informe_reclamacion_historial_" . substr($cada_css, 1);
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
       $nm_saida->saida("  <body class=\"" . $this->css_scGridPage . "\" " . $str_iframe_body . " style=\"" . $css_body . "\">\r\n");
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none; position: absolute; left: 50px; top: 50px\"><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" && !$this->Print_All)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Ind_Groupby'] == "sc_free_group_by")
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pdf_res'])
               {
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_othr_smry_msge'] . "</H1></div>\r\n");
               } 
               else
               {
                   $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">ID PACIENTE</H1></div>\r\n");
               } 
           }
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = "";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pdf_res'])
       {
           return;
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
   }  
 }  
 function NM_cor_embutida()
 {  
   $compl_css = "";
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   {
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['Informe_reclamacion_historial']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['Informe_reclamacion_historial']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['Informe_reclamacion_historial']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['Informe_reclamacion_historial']) . "_";
           } 
       }
   }
   $temp_css  = explode("/", $compl_css);
   if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
   $this->css_scGridPage           = $compl_css . "scGridPage";
   $this->css_scGridPageLink       = $compl_css . "scGridPageLink";
   $this->css_scGridToolbar        = $compl_css . "scGridToolbar";
   $this->css_scGridToolbarPadd    = $compl_css . "scGridToolbarPadding";
   $this->css_css_toolbar_obj      = $compl_css . "css_toolbar_obj";
   $this->css_scGridHeader         = $compl_css . "scGridHeader";
   $this->css_scGridHeaderFont     = $compl_css . "scGridHeaderFont";
   $this->css_scGridFooter         = $compl_css . "scGridFooter";
   $this->css_scGridFooterFont     = $compl_css . "scGridFooterFont";
   $this->css_scGridBlock          = $compl_css . "scGridBlock";
   $this->css_scGridBlockFont      = $compl_css . "scGridBlockFont";
   $this->css_scGridBlockAlign     = $compl_css . "scGridBlockAlign";
   $this->css_scGridTotal          = $compl_css . "scGridTotal";
   $this->css_scGridTotalFont      = $compl_css . "scGridTotalFont";
   $this->css_scGridSubtotal       = $compl_css . "scGridSubtotal";
   $this->css_scGridSubtotalFont   = $compl_css . "scGridSubtotalFont";
   $this->css_scGridFieldEven      = $compl_css . "scGridFieldEven";
   $this->css_scGridFieldEvenFont  = $compl_css . "scGridFieldEvenFont";
   $this->css_scGridFieldEvenVert  = $compl_css . "scGridFieldEvenVert";
   $this->css_scGridFieldEvenLink  = $compl_css . "scGridFieldEvenLink";
   $this->css_scGridFieldOdd       = $compl_css . "scGridFieldOdd";
   $this->css_scGridFieldOddFont   = $compl_css . "scGridFieldOddFont";
   $this->css_scGridFieldOddVert   = $compl_css . "scGridFieldOddVert";
   $this->css_scGridFieldOddLink   = $compl_css . "scGridFieldOddLink";
   $this->css_scGridFieldClick     = $compl_css . "scGridFieldClick";
   $this->css_scGridFieldOver      = $compl_css . "scGridFieldOver";
   $this->css_scGridLabel          = $compl_css . "scGridLabel";
   $this->css_scGridLabelVert      = $compl_css . "scGridLabelVert";
   $this->css_scGridLabelFont      = $compl_css . "scGridLabelFont";
   $this->css_scGridLabelLink      = $compl_css . "scGridLabelLink";
   $this->css_scGridTabela         = $compl_css . "scGridTabela";
   $this->css_scGridTabelaTd       = $compl_css . "scGridTabelaTd";
   $this->css_scGridBlockBg        = $compl_css . "scGridBlockBg";
   $this->css_scGridBlockLineBg    = $compl_css . "scGridBlockLineBg";
   $this->css_scGridBlockSpaceBg   = $compl_css . "scGridBlockSpaceBg";
   $this->css_scGridLabelNowrap    = "";
   $this->css_scAppDivMoldura      = $compl_css . "scAppDivMoldura";
   $this->css_scAppDivHeader       = $compl_css . "scAppDivHeader";
   $this->css_scAppDivHeaderText   = $compl_css . "scAppDivHeaderText";
   $this->css_scAppDivContent      = $compl_css . "scAppDivContent";
   $this->css_scAppDivContentText  = $compl_css . "scAppDivContentText";
   $this->css_scAppDivToolbar      = $compl_css . "scAppDivToolbar";
   $this->css_scAppDivToolbarInput = $compl_css . "scAppDivToolbarInput";

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida']) ? "Informe_reclamacion_historial_" : "";
   $this->css_sep = " ";
   $this->css_pacientes_id_paciente_label = $compl_css_emb . "css_pacientes_id_paciente_label";
   $this->css_pacientes_id_paciente_grid_line = $compl_css_emb . "css_pacientes_id_paciente_grid_line";
   $this->css_gestiones_logro_comunicacion_gestion_label = $compl_css_emb . "css_gestiones_logro_comunicacion_gestion_label";
   $this->css_gestiones_logro_comunicacion_gestion_grid_line = $compl_css_emb . "css_gestiones_logro_comunicacion_gestion_grid_line";
   $this->css_gestiones_fecha_comunicacion_label = $compl_css_emb . "css_gestiones_fecha_comunicacion_label";
   $this->css_gestiones_fecha_comunicacion_grid_line = $compl_css_emb . "css_gestiones_fecha_comunicacion_grid_line";
   $this->css_gestiones_autor_gestion_label = $compl_css_emb . "css_gestiones_autor_gestion_label";
   $this->css_gestiones_autor_gestion_grid_line = $compl_css_emb . "css_gestiones_autor_gestion_grid_line";
   $this->css_pacientes_departamento_paciente_label = $compl_css_emb . "css_pacientes_departamento_paciente_label";
   $this->css_pacientes_departamento_paciente_grid_line = $compl_css_emb . "css_pacientes_departamento_paciente_grid_line";
   $this->css_pacientes_ciudad_paciente_label = $compl_css_emb . "css_pacientes_ciudad_paciente_label";
   $this->css_pacientes_ciudad_paciente_grid_line = $compl_css_emb . "css_pacientes_ciudad_paciente_grid_line";
   $this->css_pacientes_estado_paciente_label = $compl_css_emb . "css_pacientes_estado_paciente_label";
   $this->css_pacientes_estado_paciente_grid_line = $compl_css_emb . "css_pacientes_estado_paciente_grid_line";
   $this->css_pacientes_status_paciente_label = $compl_css_emb . "css_pacientes_status_paciente_label";
   $this->css_pacientes_status_paciente_grid_line = $compl_css_emb . "css_pacientes_status_paciente_grid_line";
   $this->css_pacientes_fecha_activacion_paciente_label = $compl_css_emb . "css_pacientes_fecha_activacion_paciente_label";
   $this->css_pacientes_fecha_activacion_paciente_grid_line = $compl_css_emb . "css_pacientes_fecha_activacion_paciente_grid_line";
   $this->css_pacientes_codigo_xofigo_label = $compl_css_emb . "css_pacientes_codigo_xofigo_label";
   $this->css_pacientes_codigo_xofigo_grid_line = $compl_css_emb . "css_pacientes_codigo_xofigo_grid_line";
   $this->css_tratamiento_producto_tratamiento_label = $compl_css_emb . "css_tratamiento_producto_tratamiento_label";
   $this->css_tratamiento_producto_tratamiento_grid_line = $compl_css_emb . "css_tratamiento_producto_tratamiento_grid_line";
   $this->css_tratamiento_nombre_referencia_label = $compl_css_emb . "css_tratamiento_nombre_referencia_label";
   $this->css_tratamiento_nombre_referencia_grid_line = $compl_css_emb . "css_tratamiento_nombre_referencia_grid_line";
   $this->css_tratamiento_dosis_tratamiento_label = $compl_css_emb . "css_tratamiento_dosis_tratamiento_label";
   $this->css_tratamiento_dosis_tratamiento_grid_line = $compl_css_emb . "css_tratamiento_dosis_tratamiento_grid_line";
   $this->css_gestiones_numero_cajas_label = $compl_css_emb . "css_gestiones_numero_cajas_label";
   $this->css_gestiones_numero_cajas_grid_line = $compl_css_emb . "css_gestiones_numero_cajas_grid_line";
   $this->css_tratamiento_asegurador_tratamiento_label = $compl_css_emb . "css_tratamiento_asegurador_tratamiento_label";
   $this->css_tratamiento_asegurador_tratamiento_grid_line = $compl_css_emb . "css_tratamiento_asegurador_tratamiento_grid_line";
   $this->css_tratamiento_operador_logistico_tratamiento_label = $compl_css_emb . "css_tratamiento_operador_logistico_tratamiento_label";
   $this->css_tratamiento_operador_logistico_tratamiento_grid_line = $compl_css_emb . "css_tratamiento_operador_logistico_tratamiento_grid_line";
   $this->css_tratamiento_punto_entrega_label = $compl_css_emb . "css_tratamiento_punto_entrega_label";
   $this->css_tratamiento_punto_entrega_grid_line = $compl_css_emb . "css_tratamiento_punto_entrega_grid_line";
   $this->css_gestiones_reclamo_gestion_label = $compl_css_emb . "css_gestiones_reclamo_gestion_label";
   $this->css_gestiones_reclamo_gestion_grid_line = $compl_css_emb . "css_gestiones_reclamo_gestion_grid_line";
   $this->css_gestiones_fecha_reclamacion_gestion_label = $compl_css_emb . "css_gestiones_fecha_reclamacion_gestion_label";
   $this->css_gestiones_fecha_reclamacion_gestion_grid_line = $compl_css_emb . "css_gestiones_fecha_reclamacion_gestion_grid_line";
   $this->css_gestiones_causa_no_reclamacion_gestion_label = $compl_css_emb . "css_gestiones_causa_no_reclamacion_gestion_label";
   $this->css_gestiones_causa_no_reclamacion_gestion_grid_line = $compl_css_emb . "css_gestiones_causa_no_reclamacion_gestion_grid_line";
   $this->css_historial_reclamacion_id_historial_reclamacion_label = $compl_css_emb . "css_historial_reclamacion_id_historial_reclamacion_label";
   $this->css_historial_reclamacion_id_historial_reclamacion_grid_line = $compl_css_emb . "css_historial_reclamacion_id_historial_reclamacion_grid_line";
   $this->css_historial_reclamacion_anio_historial_reclamacion_label = $compl_css_emb . "css_historial_reclamacion_anio_historial_reclamacion_label";
   $this->css_historial_reclamacion_anio_historial_reclamacion_grid_line = $compl_css_emb . "css_historial_reclamacion_anio_historial_reclamacion_grid_line";
   $this->css_historial_reclamacion_mes1_label = $compl_css_emb . "css_historial_reclamacion_mes1_label";
   $this->css_historial_reclamacion_mes1_grid_line = $compl_css_emb . "css_historial_reclamacion_mes1_grid_line";
   $this->css_historial_reclamacion_reclamo1_label = $compl_css_emb . "css_historial_reclamacion_reclamo1_label";
   $this->css_historial_reclamacion_reclamo1_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo1_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion1_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion1_label";
   $this->css_historial_reclamacion_fecha_reclamacion1_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion1_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion1_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion1_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion1_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion1_grid_line";
   $this->css_historial_reclamacion_mes2_label = $compl_css_emb . "css_historial_reclamacion_mes2_label";
   $this->css_historial_reclamacion_mes2_grid_line = $compl_css_emb . "css_historial_reclamacion_mes2_grid_line";
   $this->css_historial_reclamacion_reclamo2_label = $compl_css_emb . "css_historial_reclamacion_reclamo2_label";
   $this->css_historial_reclamacion_reclamo2_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo2_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion2_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion2_label";
   $this->css_historial_reclamacion_fecha_reclamacion2_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion2_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion2_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion2_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion2_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion2_grid_line";
   $this->css_historial_reclamacion_mes3_label = $compl_css_emb . "css_historial_reclamacion_mes3_label";
   $this->css_historial_reclamacion_mes3_grid_line = $compl_css_emb . "css_historial_reclamacion_mes3_grid_line";
   $this->css_historial_reclamacion_reclamo3_label = $compl_css_emb . "css_historial_reclamacion_reclamo3_label";
   $this->css_historial_reclamacion_reclamo3_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo3_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion3_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion3_label";
   $this->css_historial_reclamacion_fecha_reclamacion3_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion3_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion3_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion3_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion3_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion3_grid_line";
   $this->css_historial_reclamacion_mes4_label = $compl_css_emb . "css_historial_reclamacion_mes4_label";
   $this->css_historial_reclamacion_mes4_grid_line = $compl_css_emb . "css_historial_reclamacion_mes4_grid_line";
   $this->css_historial_reclamacion_reclamo4_label = $compl_css_emb . "css_historial_reclamacion_reclamo4_label";
   $this->css_historial_reclamacion_reclamo4_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo4_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion4_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion4_label";
   $this->css_historial_reclamacion_fecha_reclamacion4_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion4_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion4_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion4_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion4_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion4_grid_line";
   $this->css_historial_reclamacion_mes5_label = $compl_css_emb . "css_historial_reclamacion_mes5_label";
   $this->css_historial_reclamacion_mes5_grid_line = $compl_css_emb . "css_historial_reclamacion_mes5_grid_line";
   $this->css_historial_reclamacion_reclamo5_label = $compl_css_emb . "css_historial_reclamacion_reclamo5_label";
   $this->css_historial_reclamacion_reclamo5_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo5_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion5_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion5_label";
   $this->css_historial_reclamacion_fecha_reclamacion5_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion5_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion5_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion5_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion5_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion5_grid_line";
   $this->css_historial_reclamacion_mes6_label = $compl_css_emb . "css_historial_reclamacion_mes6_label";
   $this->css_historial_reclamacion_mes6_grid_line = $compl_css_emb . "css_historial_reclamacion_mes6_grid_line";
   $this->css_historial_reclamacion_reclamo6_label = $compl_css_emb . "css_historial_reclamacion_reclamo6_label";
   $this->css_historial_reclamacion_reclamo6_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo6_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion6_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion6_label";
   $this->css_historial_reclamacion_fecha_reclamacion6_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion6_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion6_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion6_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion6_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion6_grid_line";
   $this->css_historial_reclamacion_mes7_label = $compl_css_emb . "css_historial_reclamacion_mes7_label";
   $this->css_historial_reclamacion_mes7_grid_line = $compl_css_emb . "css_historial_reclamacion_mes7_grid_line";
   $this->css_historial_reclamacion_reclamo7_label = $compl_css_emb . "css_historial_reclamacion_reclamo7_label";
   $this->css_historial_reclamacion_reclamo7_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo7_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion7_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion7_label";
   $this->css_historial_reclamacion_fecha_reclamacion7_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion7_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion7_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion7_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion7_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion7_grid_line";
   $this->css_historial_reclamacion_mes8_label = $compl_css_emb . "css_historial_reclamacion_mes8_label";
   $this->css_historial_reclamacion_mes8_grid_line = $compl_css_emb . "css_historial_reclamacion_mes8_grid_line";
   $this->css_historial_reclamacion_reclamo8_label = $compl_css_emb . "css_historial_reclamacion_reclamo8_label";
   $this->css_historial_reclamacion_reclamo8_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo8_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion8_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion8_label";
   $this->css_historial_reclamacion_fecha_reclamacion8_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion8_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion8_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion8_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion8_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion8_grid_line";
   $this->css_historial_reclamacion_mes9_label = $compl_css_emb . "css_historial_reclamacion_mes9_label";
   $this->css_historial_reclamacion_mes9_grid_line = $compl_css_emb . "css_historial_reclamacion_mes9_grid_line";
   $this->css_historial_reclamacion_reclamo9_label = $compl_css_emb . "css_historial_reclamacion_reclamo9_label";
   $this->css_historial_reclamacion_reclamo9_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo9_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion9_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion9_label";
   $this->css_historial_reclamacion_fecha_reclamacion9_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion9_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion9_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion9_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion9_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion9_grid_line";
   $this->css_historial_reclamacion_mes10_label = $compl_css_emb . "css_historial_reclamacion_mes10_label";
   $this->css_historial_reclamacion_mes10_grid_line = $compl_css_emb . "css_historial_reclamacion_mes10_grid_line";
   $this->css_historial_reclamacion_reclamo10_label = $compl_css_emb . "css_historial_reclamacion_reclamo10_label";
   $this->css_historial_reclamacion_reclamo10_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo10_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion10_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion10_label";
   $this->css_historial_reclamacion_fecha_reclamacion10_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion10_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion10_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion10_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion10_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion10_grid_line";
   $this->css_historial_reclamacion_mes11_label = $compl_css_emb . "css_historial_reclamacion_mes11_label";
   $this->css_historial_reclamacion_mes11_grid_line = $compl_css_emb . "css_historial_reclamacion_mes11_grid_line";
   $this->css_historial_reclamacion_reclamo11_label = $compl_css_emb . "css_historial_reclamacion_reclamo11_label";
   $this->css_historial_reclamacion_reclamo11_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo11_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion11_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion11_label";
   $this->css_historial_reclamacion_fecha_reclamacion11_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion11_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion11_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion11_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion11_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion11_grid_line";
   $this->css_historial_reclamacion_mes12_label = $compl_css_emb . "css_historial_reclamacion_mes12_label";
   $this->css_historial_reclamacion_mes12_grid_line = $compl_css_emb . "css_historial_reclamacion_mes12_grid_line";
   $this->css_historial_reclamacion_reclamo12_label = $compl_css_emb . "css_historial_reclamacion_reclamo12_label";
   $this->css_historial_reclamacion_reclamo12_grid_line = $compl_css_emb . "css_historial_reclamacion_reclamo12_grid_line";
   $this->css_historial_reclamacion_fecha_reclamacion12_label = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion12_label";
   $this->css_historial_reclamacion_fecha_reclamacion12_grid_line = $compl_css_emb . "css_historial_reclamacion_fecha_reclamacion12_grid_line";
   $this->css_historial_reclamacion_motivo_no_reclamacion12_label = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion12_label";
   $this->css_historial_reclamacion_motivo_no_reclamacion12_grid_line = $compl_css_emb . "css_historial_reclamacion_motivo_no_reclamacion12_grid_line";
 }  
// 
//----- 
 function cabecalho()
 {
   global
          $nm_saida;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['cab']))
   {
       return; 
   }
   $nm_cab_filtro   = ""; 
   $nm_cab_filtrobr = ""; 
   $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
   $Lim   = strlen($Str_date);
   $Ult   = "";
   $Arr_D = array();
   for ($I = 0; $I < $Lim; $I++)
   {
       $Char = substr($Str_date, $I, 1);
       if ($Char != $Ult)
       {
           $Arr_D[] = $Char;
       }
       $Ult = $Char;
   }
   $Prim = true;
   $Str  = "";
   foreach ($Arr_D as $Cada_d)
   {
       $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
       $Str .= $Cada_d;
       $Prim = false;
   }
   $Str = str_replace("a", "Y", $Str);
   $Str = str_replace("y", "Y", $Str);
   $nm_data_fixa = date($Str); 
   $this->sc_proc_grid = false; 
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['cond_pesq'];
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['cond_pesq'], 0, $trab_pos);
       $nm_cab_filtrobr = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and . "<br />", $nm_cab_filtro);
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $nm_cab_filtro;
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       if ($trab_pos === false)
       {
       }
       else  
       {  
          $nm_cab_filtro = substr($nm_cab_filtro, 0, $trab_pos) . " " .  $nm_cond_filtro_or . $nm_cond_filtro_and . substr($nm_cab_filtro, $trab_pos + 5);
          $nm_cab_filtro = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and, $nm_cab_filtro);
       }   
   }   
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS"); 
   $nm_saida->saida(" <TR id=\"sc_grid_head\">\r\n");
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sv_dt_head'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sv_dt_head']['fix'] = $nm_data_fixa;
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sv_dt_head']['fix'] != $nm_data_fixa)
   {
       $nm_refresch_cab_rod = true;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
   } 
   $nm_saida->saida("<style>\r\n");
   $nm_saida->saida("#lin1_col1 { padding-left:9px; padding-top:7px;  height:27px; overflow:hidden; text-align:left;}			 \r\n");
   $nm_saida->saida("#lin1_col2 { padding-right:9px; padding-top:7px; height:27px; text-align:right; overflow:hidden;   font-size:12px; font-weight:normal;}\r\n");
   $nm_saida->saida("</style>\r\n");
   $nm_saida->saida("<div style=\"width: 100%\">\r\n");
   $nm_saida->saida(" <div class=\"" . $this->css_scGridHeader . "\" style=\"height:11px; display: block; border-width:0px; \"></div>\r\n");
   $nm_saida->saida(" <div style=\"height:37px; border-width:0px 0px 1px 0px;  border-style: dashed; border-color:#ddd; display: block\">\r\n");
   $nm_saida->saida(" 	<table style=\"width:100%; border-collapse:collapse; padding:0;\">\r\n");
   $nm_saida->saida("    	<tr>\r\n");
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>Informe Reclamaciones Historial</span></td>\r\n");
   $nm_saida->saida("            <td id=\"lin1_col2\" class=\"" . $this->css_scGridHeaderFont . "\"><span>" . $nm_data_fixa . "</span></td>\r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("</div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_head', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida(" </TR>\r\n");
 }
// 
 function label_grid($linhas = 0)
 {
   global 
           $nm_saida;
   static $nm_seq_titulos   = 0; 
   $contr_embutida = false;
   $salva_htm_emb  = "";
   if (1 < $linhas)
   {
      $this->Lin_impressas++;
   }
   $nm_seq_titulos++; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_label'])
      { 
          if (!isset($_SESSION['scriptcase']['saida_var']) || !$_SESSION['scriptcase']['saida_var']) 
          { 
              $_SESSION['scriptcase']['saida_var']  = true;
              $_SESSION['scriptcase']['saida_html'] = "";
              $contr_embutida = true;
          } 
          else 
          { 
              $salva_htm_emb = $_SESSION['scriptcase']['saida_html'];
              $_SESSION['scriptcase']['saida_html'] = "";
          } 
      } 
   $nm_saida->saida("    <TR id=\"tit_Informe_reclamacion_historial#?#" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_label']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion12_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion12_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
   } 
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_label'])
     { 
         if (isset($_SESSION['scriptcase']['saida_var']) && $_SESSION['scriptcase']['saida_var'])
         { 
             $Cod_Html = $_SESSION['scriptcase']['saida_html'];
             $pos_tag = strpos($Cod_Html, "<TD ");
             $Cod_Html = substr($Cod_Html, $pos_tag);
             $pos      = 0;
             $pos_tag  = false;
             $pos_tmp  = true; 
             $tmp      = $Cod_Html;
             while ($pos_tmp)
             {
                $pos = strpos($tmp, "</TR>", $pos);
                if ($pos !== false)
                {
                    $pos_tag = $pos;
                    $pos += 4;
                }
                else
                {
                    $pos_tmp = false;
                }
             }
             $Cod_Html = substr($Cod_Html, 0, $pos_tag);
             $Nm_temp = explode("</TD>", $Cod_Html);
             $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['cols_emb'] = count($Nm_temp) - 1;
             if ($contr_embutida) 
             { 
                 $_SESSION['scriptcase']['saida_var']  = false;
                 $nm_saida->saida($Cod_Html);
             } 
             else 
             { 
                 $_SESSION['scriptcase']['saida_html'] = $salva_htm_emb . $Cod_Html;
             } 
         } 
     } 
     $NM_seq_lab = 1;
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels'] as $NM_cmp => $NM_lab)
     {
         if (empty($NM_lab) || $NM_lab == "&nbsp;")
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels'][$NM_cmp] = "No_Label" . $NM_seq_lab;
             $NM_seq_lab++;
         }
     } 
   } 
 }
 function NM_label_pacientes_id_paciente()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pacientes_id_paciente'])) ? $this->New_label['pacientes_id_paciente'] : "ID PACIENTE"; 
   if (!isset($this->NM_cmp_hidden['pacientes_id_paciente']) || $this->NM_cmp_hidden['pacientes_id_paciente'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pacientes_id_paciente_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pacientes_id_paciente_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_gestiones_logro_comunicacion_gestion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['gestiones_logro_comunicacion_gestion'])) ? $this->New_label['gestiones_logro_comunicacion_gestion'] : "LOGRO COMUNICACION GESTION"; 
   if (!isset($this->NM_cmp_hidden['gestiones_logro_comunicacion_gestion']) || $this->NM_cmp_hidden['gestiones_logro_comunicacion_gestion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_gestiones_logro_comunicacion_gestion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_gestiones_logro_comunicacion_gestion_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_gestiones_fecha_comunicacion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['gestiones_fecha_comunicacion'])) ? $this->New_label['gestiones_fecha_comunicacion'] : "FECHA COMUNICACION"; 
   if (!isset($this->NM_cmp_hidden['gestiones_fecha_comunicacion']) || $this->NM_cmp_hidden['gestiones_fecha_comunicacion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_gestiones_fecha_comunicacion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_gestiones_fecha_comunicacion_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_gestiones_autor_gestion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['gestiones_autor_gestion'])) ? $this->New_label['gestiones_autor_gestion'] : "AUTOR GESTION"; 
   if (!isset($this->NM_cmp_hidden['gestiones_autor_gestion']) || $this->NM_cmp_hidden['gestiones_autor_gestion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_gestiones_autor_gestion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_gestiones_autor_gestion_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_pacientes_departamento_paciente()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pacientes_departamento_paciente'])) ? $this->New_label['pacientes_departamento_paciente'] : "DEPARTAMENTO PACIENTE"; 
   if (!isset($this->NM_cmp_hidden['pacientes_departamento_paciente']) || $this->NM_cmp_hidden['pacientes_departamento_paciente'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pacientes_departamento_paciente_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pacientes_departamento_paciente_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_pacientes_ciudad_paciente()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pacientes_ciudad_paciente'])) ? $this->New_label['pacientes_ciudad_paciente'] : "CIUDAD PACIENTE"; 
   if (!isset($this->NM_cmp_hidden['pacientes_ciudad_paciente']) || $this->NM_cmp_hidden['pacientes_ciudad_paciente'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pacientes_ciudad_paciente_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pacientes_ciudad_paciente_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_pacientes_estado_paciente()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pacientes_estado_paciente'])) ? $this->New_label['pacientes_estado_paciente'] : "ESTADO PACIENTE"; 
   if (!isset($this->NM_cmp_hidden['pacientes_estado_paciente']) || $this->NM_cmp_hidden['pacientes_estado_paciente'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pacientes_estado_paciente_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pacientes_estado_paciente_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_pacientes_status_paciente()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pacientes_status_paciente'])) ? $this->New_label['pacientes_status_paciente'] : "STATUS PACIENTE"; 
   if (!isset($this->NM_cmp_hidden['pacientes_status_paciente']) || $this->NM_cmp_hidden['pacientes_status_paciente'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pacientes_status_paciente_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pacientes_status_paciente_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_pacientes_fecha_activacion_paciente()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pacientes_fecha_activacion_paciente'])) ? $this->New_label['pacientes_fecha_activacion_paciente'] : "FECHA ACTIVACION PACIENTE"; 
   if (!isset($this->NM_cmp_hidden['pacientes_fecha_activacion_paciente']) || $this->NM_cmp_hidden['pacientes_fecha_activacion_paciente'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pacientes_fecha_activacion_paciente_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pacientes_fecha_activacion_paciente_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_pacientes_codigo_xofigo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pacientes_codigo_xofigo'])) ? $this->New_label['pacientes_codigo_xofigo'] : "CODIGO XOFIGO"; 
   if (!isset($this->NM_cmp_hidden['pacientes_codigo_xofigo']) || $this->NM_cmp_hidden['pacientes_codigo_xofigo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pacientes_codigo_xofigo_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pacientes_codigo_xofigo_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_tratamiento_producto_tratamiento()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tratamiento_producto_tratamiento'])) ? $this->New_label['tratamiento_producto_tratamiento'] : "PRODUCTO TRATAMIENTO"; 
   if (!isset($this->NM_cmp_hidden['tratamiento_producto_tratamiento']) || $this->NM_cmp_hidden['tratamiento_producto_tratamiento'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tratamiento_producto_tratamiento_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tratamiento_producto_tratamiento_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_tratamiento_nombre_referencia()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tratamiento_nombre_referencia'])) ? $this->New_label['tratamiento_nombre_referencia'] : "NOMBRE REFERENCIA"; 
   if (!isset($this->NM_cmp_hidden['tratamiento_nombre_referencia']) || $this->NM_cmp_hidden['tratamiento_nombre_referencia'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tratamiento_nombre_referencia_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tratamiento_nombre_referencia_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_tratamiento_dosis_tratamiento()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tratamiento_dosis_tratamiento'])) ? $this->New_label['tratamiento_dosis_tratamiento'] : "DOSIS TRATAMIENTO"; 
   if (!isset($this->NM_cmp_hidden['tratamiento_dosis_tratamiento']) || $this->NM_cmp_hidden['tratamiento_dosis_tratamiento'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tratamiento_dosis_tratamiento_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tratamiento_dosis_tratamiento_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_gestiones_numero_cajas()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['gestiones_numero_cajas'])) ? $this->New_label['gestiones_numero_cajas'] : "NUMERO CAJAS"; 
   if (!isset($this->NM_cmp_hidden['gestiones_numero_cajas']) || $this->NM_cmp_hidden['gestiones_numero_cajas'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_gestiones_numero_cajas_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_gestiones_numero_cajas_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_tratamiento_asegurador_tratamiento()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tratamiento_asegurador_tratamiento'])) ? $this->New_label['tratamiento_asegurador_tratamiento'] : "ASEGURADOR TRATAMIENTO"; 
   if (!isset($this->NM_cmp_hidden['tratamiento_asegurador_tratamiento']) || $this->NM_cmp_hidden['tratamiento_asegurador_tratamiento'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tratamiento_asegurador_tratamiento_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tratamiento_asegurador_tratamiento_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_tratamiento_operador_logistico_tratamiento()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tratamiento_operador_logistico_tratamiento'])) ? $this->New_label['tratamiento_operador_logistico_tratamiento'] : "OPERADOR LOGISTICO TRATAMIENTO"; 
   if (!isset($this->NM_cmp_hidden['tratamiento_operador_logistico_tratamiento']) || $this->NM_cmp_hidden['tratamiento_operador_logistico_tratamiento'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tratamiento_operador_logistico_tratamiento_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tratamiento_operador_logistico_tratamiento_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_tratamiento_punto_entrega()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tratamiento_punto_entrega'])) ? $this->New_label['tratamiento_punto_entrega'] : "PUNTO ENTREGA"; 
   if (!isset($this->NM_cmp_hidden['tratamiento_punto_entrega']) || $this->NM_cmp_hidden['tratamiento_punto_entrega'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tratamiento_punto_entrega_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tratamiento_punto_entrega_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_gestiones_reclamo_gestion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['gestiones_reclamo_gestion'])) ? $this->New_label['gestiones_reclamo_gestion'] : "RECLAMO GESTION"; 
   if (!isset($this->NM_cmp_hidden['gestiones_reclamo_gestion']) || $this->NM_cmp_hidden['gestiones_reclamo_gestion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_gestiones_reclamo_gestion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_gestiones_reclamo_gestion_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_gestiones_fecha_reclamacion_gestion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['gestiones_fecha_reclamacion_gestion'])) ? $this->New_label['gestiones_fecha_reclamacion_gestion'] : "FECHA RECLAMACION GESTION"; 
   if (!isset($this->NM_cmp_hidden['gestiones_fecha_reclamacion_gestion']) || $this->NM_cmp_hidden['gestiones_fecha_reclamacion_gestion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_gestiones_fecha_reclamacion_gestion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_gestiones_fecha_reclamacion_gestion_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_gestiones_causa_no_reclamacion_gestion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['gestiones_causa_no_reclamacion_gestion'])) ? $this->New_label['gestiones_causa_no_reclamacion_gestion'] : "CAUSA NO RECLAMACION GESTION"; 
   if (!isset($this->NM_cmp_hidden['gestiones_causa_no_reclamacion_gestion']) || $this->NM_cmp_hidden['gestiones_causa_no_reclamacion_gestion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_gestiones_causa_no_reclamacion_gestion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_gestiones_causa_no_reclamacion_gestion_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_id_historial_reclamacion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_id_historial_reclamacion'])) ? $this->New_label['historial_reclamacion_id_historial_reclamacion'] : "ID HISTORIAL RECLAMACION"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_id_historial_reclamacion']) || $this->NM_cmp_hidden['historial_reclamacion_id_historial_reclamacion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_id_historial_reclamacion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_id_historial_reclamacion_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_anio_historial_reclamacion()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_anio_historial_reclamacion'])) ? $this->New_label['historial_reclamacion_anio_historial_reclamacion'] : "ANIO HISTORIAL RECLAMACION"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_anio_historial_reclamacion']) || $this->NM_cmp_hidden['historial_reclamacion_anio_historial_reclamacion'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_anio_historial_reclamacion_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_anio_historial_reclamacion_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes1'])) ? $this->New_label['historial_reclamacion_mes1'] : "MES1"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes1']) || $this->NM_cmp_hidden['historial_reclamacion_mes1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo1'])) ? $this->New_label['historial_reclamacion_reclamo1'] : "RECLAMO1"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo1']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion1'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion1'] : "FECHA RECLAMACION1"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion1']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion1'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion1'] : "MOTIVO NO RECLAMACION1"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion1']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes2'])) ? $this->New_label['historial_reclamacion_mes2'] : "MES2"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes2']) || $this->NM_cmp_hidden['historial_reclamacion_mes2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo2'])) ? $this->New_label['historial_reclamacion_reclamo2'] : "RECLAMO2"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo2']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion2'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion2'] : "FECHA RECLAMACION2"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion2']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion2'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion2'] : "MOTIVO NO RECLAMACION2"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion2']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes3'])) ? $this->New_label['historial_reclamacion_mes3'] : "MES3"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes3']) || $this->NM_cmp_hidden['historial_reclamacion_mes3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo3'])) ? $this->New_label['historial_reclamacion_reclamo3'] : "RECLAMO3"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo3']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion3'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion3'] : "FECHA RECLAMACION3"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion3']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion3'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion3'] : "MOTIVO NO RECLAMACION3"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion3']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes4()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes4'])) ? $this->New_label['historial_reclamacion_mes4'] : "MES4"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes4']) || $this->NM_cmp_hidden['historial_reclamacion_mes4'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes4_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes4_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo4()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo4'])) ? $this->New_label['historial_reclamacion_reclamo4'] : "RECLAMO4"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo4']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo4'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo4_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo4_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion4()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion4'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion4'] : "FECHA RECLAMACION4"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion4']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion4'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion4_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion4_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion4()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion4'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion4'] : "MOTIVO NO RECLAMACION4"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion4']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion4'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion4_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion4_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes5()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes5'])) ? $this->New_label['historial_reclamacion_mes5'] : "MES5"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes5']) || $this->NM_cmp_hidden['historial_reclamacion_mes5'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes5_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes5_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo5()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo5'])) ? $this->New_label['historial_reclamacion_reclamo5'] : "RECLAMO5"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo5']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo5'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo5_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo5_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion5()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion5'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion5'] : "FECHA RECLAMACION5"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion5']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion5'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion5_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion5_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion5()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion5'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion5'] : "MOTIVO NO RECLAMACION5"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion5']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion5'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion5_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion5_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes6()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes6'])) ? $this->New_label['historial_reclamacion_mes6'] : "MES6"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes6']) || $this->NM_cmp_hidden['historial_reclamacion_mes6'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes6_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes6_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo6()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo6'])) ? $this->New_label['historial_reclamacion_reclamo6'] : "RECLAMO6"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo6']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo6'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo6_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo6_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion6()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion6'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion6'] : "FECHA RECLAMACION6"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion6']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion6'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion6_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion6_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion6()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion6'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion6'] : "MOTIVO NO RECLAMACION6"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion6']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion6'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion6_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion6_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes7()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes7'])) ? $this->New_label['historial_reclamacion_mes7'] : "MES7"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes7']) || $this->NM_cmp_hidden['historial_reclamacion_mes7'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes7_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes7_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo7()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo7'])) ? $this->New_label['historial_reclamacion_reclamo7'] : "RECLAMO7"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo7']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo7'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo7_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo7_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion7()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion7'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion7'] : "FECHA RECLAMACION7"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion7']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion7'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion7_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion7_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion7()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion7'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion7'] : "MOTIVO NO RECLAMACION7"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion7']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion7'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion7_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion7_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes8()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes8'])) ? $this->New_label['historial_reclamacion_mes8'] : "MES8"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes8']) || $this->NM_cmp_hidden['historial_reclamacion_mes8'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes8_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes8_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo8()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo8'])) ? $this->New_label['historial_reclamacion_reclamo8'] : "RECLAMO8"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo8']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo8'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo8_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo8_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion8()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion8'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion8'] : "FECHA RECLAMACION8"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion8']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion8'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion8_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion8_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion8()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion8'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion8'] : "MOTIVO NO RECLAMACION8"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion8']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion8'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion8_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion8_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes9()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes9'])) ? $this->New_label['historial_reclamacion_mes9'] : "MES9"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes9']) || $this->NM_cmp_hidden['historial_reclamacion_mes9'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes9_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes9_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo9()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo9'])) ? $this->New_label['historial_reclamacion_reclamo9'] : "RECLAMO9"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo9']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo9'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo9_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo9_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion9()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion9'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion9'] : "FECHA RECLAMACION9"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion9']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion9'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion9_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion9_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion9()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion9'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion9'] : "MOTIVO NO RECLAMACION9"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion9']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion9'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion9_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion9_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes10()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes10'])) ? $this->New_label['historial_reclamacion_mes10'] : "MES10"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes10']) || $this->NM_cmp_hidden['historial_reclamacion_mes10'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes10_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes10_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo10()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo10'])) ? $this->New_label['historial_reclamacion_reclamo10'] : "RECLAMO10"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo10']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo10'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo10_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo10_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion10()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion10'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion10'] : "FECHA RECLAMACION10"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion10']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion10'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion10_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion10_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion10()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion10'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion10'] : "MOTIVO NO RECLAMACION10"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion10']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion10'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion10_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion10_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes11()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes11'])) ? $this->New_label['historial_reclamacion_mes11'] : "MES11"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes11']) || $this->NM_cmp_hidden['historial_reclamacion_mes11'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes11_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes11_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo11()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo11'])) ? $this->New_label['historial_reclamacion_reclamo11'] : "RECLAMO11"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo11']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo11'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo11_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo11_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion11()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion11'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion11'] : "FECHA RECLAMACION11"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion11']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion11'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion11_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion11_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion11()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion11'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion11'] : "MOTIVO NO RECLAMACION11"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion11']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion11'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion11_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion11_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_mes12()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes12'])) ? $this->New_label['historial_reclamacion_mes12'] : "MES12"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes12']) || $this->NM_cmp_hidden['historial_reclamacion_mes12'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_mes12_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_mes12_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_reclamo12()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo12'])) ? $this->New_label['historial_reclamacion_reclamo12'] : "RECLAMO12"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo12']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo12'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_reclamo12_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_reclamo12_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_fecha_reclamacion12()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion12'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion12'] : "FECHA RECLAMACION12"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion12']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion12'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion12_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion12_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_historial_reclamacion_motivo_no_reclamacion12()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion12'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion12'] : "MOTIVO NO RECLAMACION12"; 
   if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion12']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion12'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion12_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion12_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida;
   $fecha_tr               = "</tr>";
   $this->Ini->qual_linha  = "par";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ini_cor_grid']);
       }
   }
   static $nm_seq_execucoes = 0; 
   static $nm_seq_titulos   = 0; 
   $this->Rows_span = 1;
   $nm_seq_execucoes++; 
   $nm_seq_titulos++; 
   $this->nm_prim_linha  = true; 
   $this->Ini->nm_cont_lin = 0; 
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['pacientes_id_paciente'])) ? $this->New_label['pacientes_id_paciente'] : "ID PACIENTE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['pacientes_id_paciente'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['gestiones_logro_comunicacion_gestion'])) ? $this->New_label['gestiones_logro_comunicacion_gestion'] : "LOGRO COMUNICACION GESTION"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['gestiones_logro_comunicacion_gestion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['gestiones_fecha_comunicacion'])) ? $this->New_label['gestiones_fecha_comunicacion'] : "FECHA COMUNICACION"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['gestiones_fecha_comunicacion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['gestiones_autor_gestion'])) ? $this->New_label['gestiones_autor_gestion'] : "AUTOR GESTION"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['gestiones_autor_gestion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pacientes_departamento_paciente'])) ? $this->New_label['pacientes_departamento_paciente'] : "DEPARTAMENTO PACIENTE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['pacientes_departamento_paciente'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pacientes_ciudad_paciente'])) ? $this->New_label['pacientes_ciudad_paciente'] : "CIUDAD PACIENTE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['pacientes_ciudad_paciente'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pacientes_estado_paciente'])) ? $this->New_label['pacientes_estado_paciente'] : "ESTADO PACIENTE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['pacientes_estado_paciente'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pacientes_status_paciente'])) ? $this->New_label['pacientes_status_paciente'] : "STATUS PACIENTE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['pacientes_status_paciente'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pacientes_fecha_activacion_paciente'])) ? $this->New_label['pacientes_fecha_activacion_paciente'] : "FECHA ACTIVACION PACIENTE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['pacientes_fecha_activacion_paciente'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['pacientes_codigo_xofigo'])) ? $this->New_label['pacientes_codigo_xofigo'] : "CODIGO XOFIGO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['pacientes_codigo_xofigo'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tratamiento_producto_tratamiento'])) ? $this->New_label['tratamiento_producto_tratamiento'] : "PRODUCTO TRATAMIENTO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['tratamiento_producto_tratamiento'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tratamiento_nombre_referencia'])) ? $this->New_label['tratamiento_nombre_referencia'] : "NOMBRE REFERENCIA"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['tratamiento_nombre_referencia'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tratamiento_dosis_tratamiento'])) ? $this->New_label['tratamiento_dosis_tratamiento'] : "DOSIS TRATAMIENTO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['tratamiento_dosis_tratamiento'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['gestiones_numero_cajas'])) ? $this->New_label['gestiones_numero_cajas'] : "NUMERO CAJAS"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['gestiones_numero_cajas'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tratamiento_asegurador_tratamiento'])) ? $this->New_label['tratamiento_asegurador_tratamiento'] : "ASEGURADOR TRATAMIENTO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['tratamiento_asegurador_tratamiento'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tratamiento_operador_logistico_tratamiento'])) ? $this->New_label['tratamiento_operador_logistico_tratamiento'] : "OPERADOR LOGISTICO TRATAMIENTO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['tratamiento_operador_logistico_tratamiento'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tratamiento_punto_entrega'])) ? $this->New_label['tratamiento_punto_entrega'] : "PUNTO ENTREGA"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['tratamiento_punto_entrega'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['gestiones_reclamo_gestion'])) ? $this->New_label['gestiones_reclamo_gestion'] : "RECLAMO GESTION"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['gestiones_reclamo_gestion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['gestiones_fecha_reclamacion_gestion'])) ? $this->New_label['gestiones_fecha_reclamacion_gestion'] : "FECHA RECLAMACION GESTION"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['gestiones_fecha_reclamacion_gestion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['gestiones_causa_no_reclamacion_gestion'])) ? $this->New_label['gestiones_causa_no_reclamacion_gestion'] : "CAUSA NO RECLAMACION GESTION"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['gestiones_causa_no_reclamacion_gestion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_id_historial_reclamacion'])) ? $this->New_label['historial_reclamacion_id_historial_reclamacion'] : "ID HISTORIAL RECLAMACION"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_id_historial_reclamacion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_anio_historial_reclamacion'])) ? $this->New_label['historial_reclamacion_anio_historial_reclamacion'] : "ANIO HISTORIAL RECLAMACION"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_anio_historial_reclamacion'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes1'])) ? $this->New_label['historial_reclamacion_mes1'] : "MES1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo1'])) ? $this->New_label['historial_reclamacion_reclamo1'] : "RECLAMO1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion1'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion1'] : "FECHA RECLAMACION1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion1'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion1'] : "MOTIVO NO RECLAMACION1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes2'])) ? $this->New_label['historial_reclamacion_mes2'] : "MES2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo2'])) ? $this->New_label['historial_reclamacion_reclamo2'] : "RECLAMO2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion2'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion2'] : "FECHA RECLAMACION2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion2'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion2'] : "MOTIVO NO RECLAMACION2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes3'])) ? $this->New_label['historial_reclamacion_mes3'] : "MES3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo3'])) ? $this->New_label['historial_reclamacion_reclamo3'] : "RECLAMO3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion3'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion3'] : "FECHA RECLAMACION3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion3'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion3'] : "MOTIVO NO RECLAMACION3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes4'])) ? $this->New_label['historial_reclamacion_mes4'] : "MES4"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes4'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo4'])) ? $this->New_label['historial_reclamacion_reclamo4'] : "RECLAMO4"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo4'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion4'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion4'] : "FECHA RECLAMACION4"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion4'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion4'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion4'] : "MOTIVO NO RECLAMACION4"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion4'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes5'])) ? $this->New_label['historial_reclamacion_mes5'] : "MES5"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes5'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo5'])) ? $this->New_label['historial_reclamacion_reclamo5'] : "RECLAMO5"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo5'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion5'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion5'] : "FECHA RECLAMACION5"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion5'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion5'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion5'] : "MOTIVO NO RECLAMACION5"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion5'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes6'])) ? $this->New_label['historial_reclamacion_mes6'] : "MES6"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes6'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo6'])) ? $this->New_label['historial_reclamacion_reclamo6'] : "RECLAMO6"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo6'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion6'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion6'] : "FECHA RECLAMACION6"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion6'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion6'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion6'] : "MOTIVO NO RECLAMACION6"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion6'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes7'])) ? $this->New_label['historial_reclamacion_mes7'] : "MES7"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes7'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo7'])) ? $this->New_label['historial_reclamacion_reclamo7'] : "RECLAMO7"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo7'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion7'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion7'] : "FECHA RECLAMACION7"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion7'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion7'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion7'] : "MOTIVO NO RECLAMACION7"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion7'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes8'])) ? $this->New_label['historial_reclamacion_mes8'] : "MES8"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes8'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo8'])) ? $this->New_label['historial_reclamacion_reclamo8'] : "RECLAMO8"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo8'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion8'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion8'] : "FECHA RECLAMACION8"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion8'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion8'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion8'] : "MOTIVO NO RECLAMACION8"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion8'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes9'])) ? $this->New_label['historial_reclamacion_mes9'] : "MES9"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes9'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo9'])) ? $this->New_label['historial_reclamacion_reclamo9'] : "RECLAMO9"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo9'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion9'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion9'] : "FECHA RECLAMACION9"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion9'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion9'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion9'] : "MOTIVO NO RECLAMACION9"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion9'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes10'])) ? $this->New_label['historial_reclamacion_mes10'] : "MES10"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes10'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo10'])) ? $this->New_label['historial_reclamacion_reclamo10'] : "RECLAMO10"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo10'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion10'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion10'] : "FECHA RECLAMACION10"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion10'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion10'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion10'] : "MOTIVO NO RECLAMACION10"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion10'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes11'])) ? $this->New_label['historial_reclamacion_mes11'] : "MES11"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes11'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo11'])) ? $this->New_label['historial_reclamacion_reclamo11'] : "RECLAMO11"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo11'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion11'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion11'] : "FECHA RECLAMACION11"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion11'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion11'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion11'] : "MOTIVO NO RECLAMACION11"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion11'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_mes12'])) ? $this->New_label['historial_reclamacion_mes12'] : "MES12"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_mes12'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_reclamo12'])) ? $this->New_label['historial_reclamacion_reclamo12'] : "RECLAMO12"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_reclamo12'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_fecha_reclamacion12'])) ? $this->New_label['historial_reclamacion_fecha_reclamacion12'] : "FECHA RECLAMACION12"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_fecha_reclamacion12'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['historial_reclamacion_motivo_no_reclamacion12'])) ? $this->New_label['historial_reclamacion_motivo_no_reclamacion12'] : "MOTIVO NO RECLAMACION12"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['labels']['historial_reclamacion_motivo_no_reclamacion12'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['Informe_reclamacion_historial']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_grid'])
           {
               $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['cols_emb'];
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_Informe_reclamacion_historial#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['cab_embutida'] != "S")
               {
                   $this->label_grid($linhas);
               }
               $this->NM_calc_span();
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridFieldOdd . "\"  style=\"padding: 0px; font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\" colspan = \"" . $this->NM_colspan . "\" align=\"center\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "\r\n");
               $nm_saida->saida("  </td></tr>\r\n");
               $nm_saida->saida("  </table></td></tr></table>\r\n");
               $this->Lin_final = $this->rs_grid->EOF;
               if ($this->Lin_final)
               {
                   $this->rs_grid->Close();
               }
           }
       }
       else
       {
           $nm_saida->saida(" <TR> \r\n");
           $nm_saida->saida("  <td id=\"sc_grid_body\" class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
       }
       return;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['force_toolbar']);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_Informe_reclamacion_historial#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = " id=\"apl_Informe_reclamacion_historial#?#1\"";
   } 
   $nm_saida->saida("  <TD id=\"sc_grid_body\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-296998e5\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final'] = 0;
   } 
   $this->SC_top       = array();
   $this->SC_bot       = array();
   $this->SC_pag_prt   = array();
   $this->SC_pag_pdf   = array();
   $this->SC_pag_all   = array();
   $this->SC_top[]     = "pacientes_id_paciente"; 
   $this->SC_pag_pdf[] = "pacientes_id_paciente"; 
   $this->SC_top[]     = "pacientes_estado_paciente"; 
   $this->SC_pag_pdf[] = "pacientes_estado_paciente"; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final'] == 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Ind_Groupby'] == "sc_free_group_by") 
   {
       $Nivel_gb = 1;
       $this->Tab_Nv_tree = array();
       $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp']);
       $this->Ult_qb_free = $this->Nivel_gbBot;
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp'] as $cmp => $sql)
       {
           $this->Tab_Nv_tree[$cmp] = $Nivel_gb;
           $Nivel_gb++;
           if (in_array($cmp, $this->SC_top))
           {
               $tmp = "quebra_" . $cmp . "_sc_free_group_by_top";
               $this->$tmp();
           }
       }
   }
   $this->nmgp_prim_pag_pdf = false;
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $ini_grid = true;
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          //---------- Gauge ----------
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" && -1 < $this->progress_grid)
          {
              $this->progress_now++;
              if (0 == $this->progress_lim_now)
              {
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_rows'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
                  fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n");
              }
              $this->progress_lim_now++;
              if ($this->progress_lim_tot == $this->progress_lim_now)
              {
                  $this->progress_lim_now = 0;
              }
          }
          $this->Lin_impressas++;
          $this->pacientes_id_paciente = $this->rs_grid->fields[0] ;  
          $this->pacientes_id_paciente = (string)$this->pacientes_id_paciente;
          $this->gestiones_logro_comunicacion_gestion = $this->rs_grid->fields[1] ;  
          $this->gestiones_fecha_comunicacion = $this->rs_grid->fields[2] ;  
          $this->gestiones_autor_gestion = $this->rs_grid->fields[3] ;  
          $this->pacientes_departamento_paciente = $this->rs_grid->fields[4] ;  
          $this->pacientes_ciudad_paciente = $this->rs_grid->fields[5] ;  
          $this->pacientes_estado_paciente = $this->rs_grid->fields[6] ;  
          $this->pacientes_status_paciente = $this->rs_grid->fields[7] ;  
          $this->pacientes_fecha_activacion_paciente = $this->rs_grid->fields[8] ;  
          $this->pacientes_codigo_xofigo = $this->rs_grid->fields[9] ;  
          $this->pacientes_codigo_xofigo = (string)$this->pacientes_codigo_xofigo;
          $this->tratamiento_producto_tratamiento = $this->rs_grid->fields[10] ;  
          $this->tratamiento_nombre_referencia = $this->rs_grid->fields[11] ;  
          $this->tratamiento_dosis_tratamiento = $this->rs_grid->fields[12] ;  
          $this->gestiones_numero_cajas = $this->rs_grid->fields[13] ;  
          $this->tratamiento_asegurador_tratamiento = $this->rs_grid->fields[14] ;  
          $this->tratamiento_operador_logistico_tratamiento = $this->rs_grid->fields[15] ;  
          $this->tratamiento_punto_entrega = $this->rs_grid->fields[16] ;  
          $this->gestiones_reclamo_gestion = $this->rs_grid->fields[17] ;  
          $this->gestiones_fecha_reclamacion_gestion = $this->rs_grid->fields[18] ;  
          $this->gestiones_causa_no_reclamacion_gestion = $this->rs_grid->fields[19] ;  
          $this->historial_reclamacion_id_historial_reclamacion = $this->rs_grid->fields[20] ;  
          $this->historial_reclamacion_id_historial_reclamacion = (string)$this->historial_reclamacion_id_historial_reclamacion;
          $this->historial_reclamacion_anio_historial_reclamacion = $this->rs_grid->fields[21] ;  
          $this->historial_reclamacion_anio_historial_reclamacion = (string)$this->historial_reclamacion_anio_historial_reclamacion;
          $this->historial_reclamacion_mes1 = $this->rs_grid->fields[22] ;  
          $this->historial_reclamacion_reclamo1 = $this->rs_grid->fields[23] ;  
          $this->historial_reclamacion_fecha_reclamacion1 = $this->rs_grid->fields[24] ;  
          $this->historial_reclamacion_motivo_no_reclamacion1 = $this->rs_grid->fields[25] ;  
          $this->historial_reclamacion_mes2 = $this->rs_grid->fields[26] ;  
          $this->historial_reclamacion_reclamo2 = $this->rs_grid->fields[27] ;  
          $this->historial_reclamacion_fecha_reclamacion2 = $this->rs_grid->fields[28] ;  
          $this->historial_reclamacion_motivo_no_reclamacion2 = $this->rs_grid->fields[29] ;  
          $this->historial_reclamacion_mes3 = $this->rs_grid->fields[30] ;  
          $this->historial_reclamacion_reclamo3 = $this->rs_grid->fields[31] ;  
          $this->historial_reclamacion_fecha_reclamacion3 = $this->rs_grid->fields[32] ;  
          $this->historial_reclamacion_motivo_no_reclamacion3 = $this->rs_grid->fields[33] ;  
          $this->historial_reclamacion_mes4 = $this->rs_grid->fields[34] ;  
          $this->historial_reclamacion_reclamo4 = $this->rs_grid->fields[35] ;  
          $this->historial_reclamacion_fecha_reclamacion4 = $this->rs_grid->fields[36] ;  
          $this->historial_reclamacion_motivo_no_reclamacion4 = $this->rs_grid->fields[37] ;  
          $this->historial_reclamacion_mes5 = $this->rs_grid->fields[38] ;  
          $this->historial_reclamacion_reclamo5 = $this->rs_grid->fields[39] ;  
          $this->historial_reclamacion_fecha_reclamacion5 = $this->rs_grid->fields[40] ;  
          $this->historial_reclamacion_motivo_no_reclamacion5 = $this->rs_grid->fields[41] ;  
          $this->historial_reclamacion_mes6 = $this->rs_grid->fields[42] ;  
          $this->historial_reclamacion_reclamo6 = $this->rs_grid->fields[43] ;  
          $this->historial_reclamacion_fecha_reclamacion6 = $this->rs_grid->fields[44] ;  
          $this->historial_reclamacion_motivo_no_reclamacion6 = $this->rs_grid->fields[45] ;  
          $this->historial_reclamacion_mes7 = $this->rs_grid->fields[46] ;  
          $this->historial_reclamacion_reclamo7 = $this->rs_grid->fields[47] ;  
          $this->historial_reclamacion_fecha_reclamacion7 = $this->rs_grid->fields[48] ;  
          $this->historial_reclamacion_motivo_no_reclamacion7 = $this->rs_grid->fields[49] ;  
          $this->historial_reclamacion_mes8 = $this->rs_grid->fields[50] ;  
          $this->historial_reclamacion_reclamo8 = $this->rs_grid->fields[51] ;  
          $this->historial_reclamacion_fecha_reclamacion8 = $this->rs_grid->fields[52] ;  
          $this->historial_reclamacion_motivo_no_reclamacion8 = $this->rs_grid->fields[53] ;  
          $this->historial_reclamacion_mes9 = $this->rs_grid->fields[54] ;  
          $this->historial_reclamacion_reclamo9 = $this->rs_grid->fields[55] ;  
          $this->historial_reclamacion_fecha_reclamacion9 = $this->rs_grid->fields[56] ;  
          $this->historial_reclamacion_motivo_no_reclamacion9 = $this->rs_grid->fields[57] ;  
          $this->historial_reclamacion_mes10 = $this->rs_grid->fields[58] ;  
          $this->historial_reclamacion_reclamo10 = $this->rs_grid->fields[59] ;  
          $this->historial_reclamacion_fecha_reclamacion10 = $this->rs_grid->fields[60] ;  
          $this->historial_reclamacion_motivo_no_reclamacion10 = $this->rs_grid->fields[61] ;  
          $this->historial_reclamacion_mes11 = $this->rs_grid->fields[62] ;  
          $this->historial_reclamacion_reclamo11 = $this->rs_grid->fields[63] ;  
          $this->historial_reclamacion_fecha_reclamacion11 = $this->rs_grid->fields[64] ;  
          $this->historial_reclamacion_motivo_no_reclamacion11 = $this->rs_grid->fields[65] ;  
          $this->historial_reclamacion_mes12 = $this->rs_grid->fields[66] ;  
          $this->historial_reclamacion_reclamo12 = $this->rs_grid->fields[67] ;  
          $this->historial_reclamacion_fecha_reclamacion12 = $this->rs_grid->fields[68] ;  
          $this->historial_reclamacion_motivo_no_reclamacion12 = $this->rs_grid->fields[69] ;  
          if (!isset($this->pacientes_id_paciente)) { $this->pacientes_id_paciente = ""; }
          if (!isset($this->pacientes_estado_paciente)) { $this->pacientes_estado_paciente = ""; }
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf")
          {
              $this->Res->nm_acum_res_unit($this->rs_grid);
          }
          $this->arg_sum_pacientes_id_paciente = " = " . $this->pacientes_id_paciente;
          $this->arg_sum_pacientes_estado_paciente = " = " . $this->Db->qstr($this->pacientes_estado_paciente);
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final'] + 1; 
          if (!$ini_grid) {
              $this->SC_sep_quebra = true;
          }
          else {
              $ini_grid = false;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['rows_emb']++;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Ind_Groupby'] == "sc_free_group_by") 
          {  
              $SC_arg_Gby = array();
              $SC_arg_Sql = array();
              $SC_arg_Gby['pacientes_id_paciente'] = (isset($this->pacientes_id_paciente)) ? $this->pacientes_id_paciente : "";
              $SC_arg_Gby['pacientes_estado_paciente'] = (isset($this->pacientes_estado_paciente)) ? $this->pacientes_estado_paciente : "";
              $SC_lst_Gby = array();
              $gb_ok      = false;
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp'] as $cmp => $sql)
              {
                  $SC_arg_Sql[$cmp] = $sql;
                  $temp = $cmp . "_Old";
                  if ($SC_arg_Gby[$cmp] != $this->$temp || $gb_ok)
                  {
                      $SC_lst_Gby[] = $cmp;
                      $gb_ok = true;
                  }
              }
              $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp']);
              krsort ($SC_lst_Gby);
              $Qb_page = true;
              foreach ($SC_lst_Gby as $Ind => $cmp)
              {
                  if (in_array($cmp, $this->SC_bot))
                  {
                      $tmp = "quebra_" . $cmp . "_sc_free_group_by_bot";
                      $this->$tmp($this->Nivel_gbBot);
                      $this->Nivel_gbBot--;
                  }
                  if ($this->Print_All && in_array($cmp, $this->SC_pag_prt) && $Qb_page)
                  {
                      $this->nm_quebra_pagina("pagina"); 
                  }
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" && in_array($cmp, $this->SC_pag_all) && $Qb_page)
                  {
                      $this->nm_quebra_pagina("pagina"); 
                  }
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" && !$this->Print_All && in_array($cmp, $this->SC_pag_pdf) && $Qb_page)
                  {
                      $this->nm_quebra_pagina("pagina"); 
                  }
                  $Qb_page = false;
                  $sql_where = "";
                  $cmp_qb     = $this->$cmp;
                  foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp'] as $Col_Gb => $Sql)
                  {
                      $tmp        = "arg_sum_" . $Col_Gb;
                      $sql_where .= (!empty($sql_where)) ? " and " : "";
                      $sql_where .= $SC_arg_Sql[$Col_Gb] . $this->$tmp;
                      if ($Col_Gb == $cmp)
                      {
                          break;
                      }
                  }
                  $tmp        = "quebra_" . $cmp . "_sc_free_group_by";
                  $this->$tmp($cmp_qb, $sql_where);
              }
              $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp']);
              ksort ($SC_lst_Gby);
              foreach ($SC_lst_Gby as $Ind => $cmp)
              {
                  if (in_array($cmp, $this->SC_top))
                  {
                      $tmp = "quebra_" . $cmp . "_sc_free_group_by_top";
                      $this->$tmp();
                  }
              }
              if (!empty($SC_lst_Gby))
              {
                  $nm_houve_quebra = "S";
                  $this->pacientes_id_paciente_Old = (isset($this->pacientes_id_paciente)) ? $this->pacientes_id_paciente : "";
                  $this->pacientes_estado_paciente_Old = (isset($this->pacientes_estado_paciente)) ? $this->pacientes_estado_paciente : "";
              }
          }  
          $this->sc_proc_grid = true;
          if ($nm_houve_quebra == "S" || $nm_inicio_pag == 0)
          { 
              $this->label_grid($linhas);
              $nm_houve_quebra = "N";
          } 
          $nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['final']; 
          $this->Ini->cor_link_dados = ($this->Ini->cor_link_dados == $this->css_scGridFieldOddLink) ? $this->css_scGridFieldEvenLink : $this->css_scGridFieldOddLink; 
          $this->Ini->qual_linha   = ($this->Ini->qual_linha == "par") ? "impar" : "par";
          if ("impar" == $this->Ini->qual_linha)
          {
              $this->css_line_back = $this->css_scGridFieldOdd;
              $this->css_line_fonf = $this->css_scGridFieldOddFont;
          }
          else
          {
              $this->css_line_back = $this->css_scGridFieldEven;
              $this->css_line_fonf = $this->css_scGridFieldEvenFont;
          }
          $NM_destaque = " onmouseover=\"over_tr(this, '" . $this->css_line_back . "');\" onmouseout=\"out_tr(this, '" . $this->css_line_back . "');\" onclick=\"click_tr(this, '" . $this->css_line_back . "');\"";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
          }
          $nm_saida->saida("    <TR  class=\"" . $this->css_line_back . "\"" . $NM_destaque . ">\r\n");
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion12_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">&nbsp;</TD>\r\n");
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion12_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
          } 
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" || isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['paginacao']))
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
      $this->Lin_final = $this->rs_grid->EOF;
      if ($this->Lin_final)
      {
         $this->rs_grid->Close();
      }
   } 
   else
   {
      $this->rs_grid->Close();
   }
   if ($this->rs_grid->EOF) 
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Ind_Groupby'] == "sc_free_group_by")
       {
           $SC_lst_Gby = array();
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp'] as $cmp => $sql)
           {
               $SC_lst_Gby[] = $cmp;
           }
           $this->Nivel_gbBot = count($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp']);
           krsort ($SC_lst_Gby);
           foreach ($SC_lst_Gby as $Ind => $cmp)
           {
               if (in_array($cmp, $this->SC_bot))
               {
                   $tmp = "quebra_" . $cmp . "_sc_free_group_by_bot";
                   $this->$tmp($this->Nivel_gbBot);
                   $this->Nivel_gbBot--;
               }
           }
       }
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['exibe_total'] == "S")
       { 
           $this->quebra_geral_top() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_grid'])
   { 
       return; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf")
   { 
      $this->Res->finaliza_arrays();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Ind_Groupby'] == "sc_free_group_by")
      {
          ksort($this->Res->array_total_pacientes_id_paciente);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['arr_total']['pacientes_id_paciente'] = $this->Res->array_total_pacientes_id_paciente;
          ksort($this->Res->array_total_pacientes_estado_paciente);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['arr_total']['pacientes_estado_paciente'] = $this->Res->array_total_pacientes_estado_paciente;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['contr_array_resumo'] = "OK";
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao']       = "igual" ; 
   } 
 }
 function NM_grid_pacientes_id_paciente()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pacientes_id_paciente']) || $this->NM_cmp_hidden['pacientes_id_paciente'] != "off") { 
          $conteudo = $this->pacientes_id_paciente; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pacientes_id_paciente_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pacientes_id_paciente_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pacientes_id_paciente_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_gestiones_logro_comunicacion_gestion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['gestiones_logro_comunicacion_gestion']) || $this->NM_cmp_hidden['gestiones_logro_comunicacion_gestion'] != "off") { 
          $conteudo = $this->gestiones_logro_comunicacion_gestion; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_gestiones_logro_comunicacion_gestion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_gestiones_logro_comunicacion_gestion_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_gestiones_logro_comunicacion_gestion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_gestiones_fecha_comunicacion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['gestiones_fecha_comunicacion']) || $this->NM_cmp_hidden['gestiones_fecha_comunicacion'] != "off") { 
          $conteudo = NM_encode_input($this->gestiones_fecha_comunicacion); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               if (substr($conteudo, 10, 1) == "-") 
               { 
                  $conteudo = substr($conteudo, 0, 10) . " " . substr($conteudo, 11);
               } 
               if (substr($conteudo, 13, 1) == ".") 
               { 
                  $conteudo = substr($conteudo, 0, 13) . ":" . substr($conteudo, 14, 2) . ":" . substr($conteudo, 17);
               } 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD HH:II:SS");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
               } 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_gestiones_fecha_comunicacion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_gestiones_fecha_comunicacion_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_gestiones_fecha_comunicacion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_gestiones_autor_gestion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['gestiones_autor_gestion']) || $this->NM_cmp_hidden['gestiones_autor_gestion'] != "off") { 
          $conteudo = $this->gestiones_autor_gestion; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_gestiones_autor_gestion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_gestiones_autor_gestion_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_gestiones_autor_gestion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pacientes_departamento_paciente()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pacientes_departamento_paciente']) || $this->NM_cmp_hidden['pacientes_departamento_paciente'] != "off") { 
          $conteudo = $this->pacientes_departamento_paciente; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pacientes_departamento_paciente_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pacientes_departamento_paciente_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pacientes_departamento_paciente_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pacientes_ciudad_paciente()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pacientes_ciudad_paciente']) || $this->NM_cmp_hidden['pacientes_ciudad_paciente'] != "off") { 
          $conteudo = $this->pacientes_ciudad_paciente; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pacientes_ciudad_paciente_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pacientes_ciudad_paciente_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pacientes_ciudad_paciente_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pacientes_estado_paciente()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pacientes_estado_paciente']) || $this->NM_cmp_hidden['pacientes_estado_paciente'] != "off") { 
          $conteudo = $this->pacientes_estado_paciente; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pacientes_estado_paciente_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pacientes_estado_paciente_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pacientes_estado_paciente_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pacientes_status_paciente()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pacientes_status_paciente']) || $this->NM_cmp_hidden['pacientes_status_paciente'] != "off") { 
          $conteudo = $this->pacientes_status_paciente; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pacientes_status_paciente_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pacientes_status_paciente_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pacientes_status_paciente_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pacientes_fecha_activacion_paciente()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pacientes_fecha_activacion_paciente']) || $this->NM_cmp_hidden['pacientes_fecha_activacion_paciente'] != "off") { 
          $conteudo = $this->pacientes_fecha_activacion_paciente; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pacientes_fecha_activacion_paciente_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pacientes_fecha_activacion_paciente_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pacientes_fecha_activacion_paciente_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_pacientes_codigo_xofigo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pacientes_codigo_xofigo']) || $this->NM_cmp_hidden['pacientes_codigo_xofigo'] != "off") { 
          $conteudo = NM_encode_input($this->pacientes_codigo_xofigo); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pacientes_codigo_xofigo_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pacientes_codigo_xofigo_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_pacientes_codigo_xofigo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tratamiento_producto_tratamiento()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tratamiento_producto_tratamiento']) || $this->NM_cmp_hidden['tratamiento_producto_tratamiento'] != "off") { 
          $conteudo = $this->tratamiento_producto_tratamiento; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tratamiento_producto_tratamiento_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tratamiento_producto_tratamiento_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tratamiento_producto_tratamiento_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tratamiento_nombre_referencia()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tratamiento_nombre_referencia']) || $this->NM_cmp_hidden['tratamiento_nombre_referencia'] != "off") { 
          $conteudo = $this->tratamiento_nombre_referencia; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tratamiento_nombre_referencia_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tratamiento_nombre_referencia_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tratamiento_nombre_referencia_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tratamiento_dosis_tratamiento()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tratamiento_dosis_tratamiento']) || $this->NM_cmp_hidden['tratamiento_dosis_tratamiento'] != "off") { 
          $conteudo = $this->tratamiento_dosis_tratamiento; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tratamiento_dosis_tratamiento_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tratamiento_dosis_tratamiento_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tratamiento_dosis_tratamiento_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_gestiones_numero_cajas()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['gestiones_numero_cajas']) || $this->NM_cmp_hidden['gestiones_numero_cajas'] != "off") { 
          $conteudo = $this->gestiones_numero_cajas; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_gestiones_numero_cajas_grid_line . "\"  style=\"" . $this->Css_Cmp['css_gestiones_numero_cajas_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_gestiones_numero_cajas_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tratamiento_asegurador_tratamiento()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tratamiento_asegurador_tratamiento']) || $this->NM_cmp_hidden['tratamiento_asegurador_tratamiento'] != "off") { 
          $conteudo = $this->tratamiento_asegurador_tratamiento; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tratamiento_asegurador_tratamiento_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tratamiento_asegurador_tratamiento_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tratamiento_asegurador_tratamiento_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tratamiento_operador_logistico_tratamiento()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tratamiento_operador_logistico_tratamiento']) || $this->NM_cmp_hidden['tratamiento_operador_logistico_tratamiento'] != "off") { 
          $conteudo = $this->tratamiento_operador_logistico_tratamiento; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tratamiento_operador_logistico_tratamiento_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tratamiento_operador_logistico_tratamiento_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tratamiento_operador_logistico_tratamiento_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tratamiento_punto_entrega()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tratamiento_punto_entrega']) || $this->NM_cmp_hidden['tratamiento_punto_entrega'] != "off") { 
          $conteudo = $this->tratamiento_punto_entrega; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tratamiento_punto_entrega_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tratamiento_punto_entrega_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tratamiento_punto_entrega_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_gestiones_reclamo_gestion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['gestiones_reclamo_gestion']) || $this->NM_cmp_hidden['gestiones_reclamo_gestion'] != "off") { 
          $conteudo = $this->gestiones_reclamo_gestion; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_gestiones_reclamo_gestion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_gestiones_reclamo_gestion_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_gestiones_reclamo_gestion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_gestiones_fecha_reclamacion_gestion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['gestiones_fecha_reclamacion_gestion']) || $this->NM_cmp_hidden['gestiones_fecha_reclamacion_gestion'] != "off") { 
          $conteudo = $this->gestiones_fecha_reclamacion_gestion; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_gestiones_fecha_reclamacion_gestion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_gestiones_fecha_reclamacion_gestion_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_gestiones_fecha_reclamacion_gestion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_gestiones_causa_no_reclamacion_gestion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['gestiones_causa_no_reclamacion_gestion']) || $this->NM_cmp_hidden['gestiones_causa_no_reclamacion_gestion'] != "off") { 
          $conteudo = $this->gestiones_causa_no_reclamacion_gestion; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_gestiones_causa_no_reclamacion_gestion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_gestiones_causa_no_reclamacion_gestion_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_gestiones_causa_no_reclamacion_gestion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_id_historial_reclamacion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_id_historial_reclamacion']) || $this->NM_cmp_hidden['historial_reclamacion_id_historial_reclamacion'] != "off") { 
          $conteudo = NM_encode_input($this->historial_reclamacion_id_historial_reclamacion); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_id_historial_reclamacion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_id_historial_reclamacion_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_id_historial_reclamacion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_anio_historial_reclamacion()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_anio_historial_reclamacion']) || $this->NM_cmp_hidden['historial_reclamacion_anio_historial_reclamacion'] != "off") { 
          $conteudo = $this->historial_reclamacion_anio_historial_reclamacion; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_anio_historial_reclamacion_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_anio_historial_reclamacion_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_anio_historial_reclamacion_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes1']) || $this->NM_cmp_hidden['historial_reclamacion_mes1'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo1']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo1'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion1']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion1'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion1']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion1'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes2']) || $this->NM_cmp_hidden['historial_reclamacion_mes2'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo2']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo2'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion2']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion2'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion2']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion2'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes3']) || $this->NM_cmp_hidden['historial_reclamacion_mes3'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo3']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo3'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion3']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion3'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion3']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion3'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes4()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes4']) || $this->NM_cmp_hidden['historial_reclamacion_mes4'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes4; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes4_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes4_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes4_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo4()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo4']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo4'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo4; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo4_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo4_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo4_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion4()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion4']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion4'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion4; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion4_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion4_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion4_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion4()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion4']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion4'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion4; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion4_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion4_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion4_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes5()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes5']) || $this->NM_cmp_hidden['historial_reclamacion_mes5'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes5; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes5_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes5_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes5_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo5()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo5']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo5'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo5; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo5_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo5_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo5_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion5()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion5']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion5'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion5; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion5_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion5_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion5_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion5()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion5']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion5'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion5; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion5_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion5_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion5_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes6()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes6']) || $this->NM_cmp_hidden['historial_reclamacion_mes6'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes6; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes6_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes6_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes6_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo6()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo6']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo6'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo6; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo6_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo6_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo6_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion6()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion6']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion6'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion6; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion6_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion6_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion6_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion6()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion6']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion6'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion6; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion6_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion6_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion6_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes7()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes7']) || $this->NM_cmp_hidden['historial_reclamacion_mes7'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes7; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes7_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes7_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes7_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo7()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo7']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo7'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo7; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo7_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo7_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo7_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion7()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion7']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion7'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion7; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion7_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion7_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion7_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion7()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion7']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion7'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion7; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion7_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion7_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion7_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes8()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes8']) || $this->NM_cmp_hidden['historial_reclamacion_mes8'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes8; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes8_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes8_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes8_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo8()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo8']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo8'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo8; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo8_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo8_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo8_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion8()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion8']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion8'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion8; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion8_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion8_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion8_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion8()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion8']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion8'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion8; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion8_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion8_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion8_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes9()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes9']) || $this->NM_cmp_hidden['historial_reclamacion_mes9'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes9; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes9_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes9_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes9_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo9()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo9']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo9'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo9; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo9_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo9_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo9_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion9()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion9']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion9'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion9; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion9_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion9_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion9_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion9()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion9']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion9'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion9; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion9_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion9_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion9_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes10()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes10']) || $this->NM_cmp_hidden['historial_reclamacion_mes10'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes10; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes10_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes10_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes10_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo10()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo10']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo10'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo10; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo10_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo10_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo10_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion10()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion10']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion10'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion10; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion10_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion10_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion10_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion10()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion10']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion10'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion10; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion10_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion10_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion10_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes11()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes11']) || $this->NM_cmp_hidden['historial_reclamacion_mes11'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes11; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes11_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes11_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes11_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo11()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo11']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo11'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo11; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo11_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo11_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo11_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion11()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion11']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion11'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion11; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion11_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion11_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion11_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion11()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion11']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion11'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion11; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion11_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion11_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion11_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_mes12()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_mes12']) || $this->NM_cmp_hidden['historial_reclamacion_mes12'] != "off") { 
          $conteudo = $this->historial_reclamacion_mes12; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_mes12_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_mes12_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_mes12_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_reclamo12()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_reclamo12']) || $this->NM_cmp_hidden['historial_reclamacion_reclamo12'] != "off") { 
          $conteudo = $this->historial_reclamacion_reclamo12; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_reclamo12_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_reclamo12_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_reclamo12_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_fecha_reclamacion12()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion12']) || $this->NM_cmp_hidden['historial_reclamacion_fecha_reclamacion12'] != "off") { 
          $conteudo = $this->historial_reclamacion_fecha_reclamacion12; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_fecha_reclamacion12_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_fecha_reclamacion12_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_fecha_reclamacion12_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_historial_reclamacion_motivo_no_reclamacion12()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion12']) || $this->NM_cmp_hidden['historial_reclamacion_motivo_no_reclamacion12'] != "off") { 
          $conteudo = $this->historial_reclamacion_motivo_no_reclamacion12; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_historial_reclamacion_motivo_no_reclamacion12_grid_line . "\"  style=\"" . $this->Css_Cmp['css_historial_reclamacion_motivo_no_reclamacion12_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_historial_reclamacion_motivo_no_reclamacion12_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 71;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'])
   {
       $this->NM_colspan++;
   }
   foreach ($this->NM_cmp_hidden as $Cmp => $Hidden)
   {
       if ($Hidden == "off")
       {
           $this->NM_colspan--;
       }
   }
 }
 function nm_quebra_pagina($nm_parms)
 {
    global $nm_saida;
    if ($this->nmgp_prim_pag_pdf && $nm_parms == "pagina")
    {
        $this->nmgp_prim_pag_pdf = false;
        return;
    }
    $this->Ini->nm_cont_lin++;
    if (($this->Ini->nm_limite_lin > 0 && $this->Ini->nm_cont_lin > $this->Ini->nm_limite_lin) || $nm_parms == "pagina" || $nm_parms == "resumo" || $nm_parms == "total")
    {
        $nm_saida->saida("</TABLE></TD></TR>\r\n");
        $this->Ini->nm_cont_lin = ($nm_parms == "pagina") ? 0 : 1;
        if ($this->Print_All)
        {
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['print_navigator']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['print_navigator'] == "Netscape")
            {
                $nm_saida->saida("</TABLE><TABLE id=\"main_table_grid\" style=\"page-break-before:always;\" align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
            }
            else
            {
                $nm_saida->saida("</TABLE><TABLE id=\"main_table_grid\" class=\"scGridBorder\" style=\"page-break-before:always;\" align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
            }
        }
        else
        {
            $nm_saida->saida("<tr><td style=\"border-width:0;height:1px;padding:0\"><span style=\"display: none;\">&nbsp;</span><div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></td></tr>\r\n");
        }
        if ($nm_parms != "resumo" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
        {
            $this->cabecalho();
        }
        $nm_saida->saida(" <TR> \r\n");
        $nm_saida->saida("  <TD style=\"padding: 0px; vertical-align: top;\"> \r\n");
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
        if ($nm_parms != "resumo" && $nm_parms != "pagina")
        {
            $this->label_grid();
        }
    }
 }
 function quebra_pacientes_id_paciente_sc_free_group_by($Cmp_qb, $Where_qb) 
 {
   global $tot_pacientes_id_paciente;
   $this->sc_proc_quebra_pacientes_estado_paciente = false;
   $this->sc_proc_quebra_pacientes_id_paciente = true; 
   $this->Tot->quebra_pacientes_id_paciente_sc_free_group_by($Cmp_qb, $Where_qb);
   $conteudo = $tot_pacientes_id_paciente[0] ;  
   $this->count_pacientes_id_paciente = $tot_pacientes_id_paciente[1];
   $this->campos_quebra_pacientes_id_paciente = array(); 
   $conteudo = $this->pacientes_id_paciente; 
   $this->campos_quebra_pacientes_id_paciente[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['pacientes_id_paciente']))
   {
       $this->campos_quebra_pacientes_id_paciente[0]['lab'] = $this->nmgp_label_quebras['pacientes_id_paciente']; 
   }
   else
   {
       $this->campos_quebra_pacientes_id_paciente[0]['lab'] = "ID PACIENTE"; 
   }
   $this->sc_proc_quebra_pacientes_id_paciente = false; 
 } 
 function quebra_pacientes_estado_paciente_sc_free_group_by($Cmp_qb, $Where_qb) 
 {
   global $tot_pacientes_estado_paciente;
   $this->sc_proc_quebra_pacientes_id_paciente = false;
   $this->sc_proc_quebra_pacientes_estado_paciente = true; 
   $this->Tot->quebra_pacientes_estado_paciente_sc_free_group_by($Cmp_qb, $Where_qb);
   $conteudo = $tot_pacientes_estado_paciente[0] ;  
   $this->count_pacientes_estado_paciente = $tot_pacientes_estado_paciente[1];
   $this->campos_quebra_pacientes_estado_paciente = array(); 
   $conteudo = $this->pacientes_estado_paciente; 
   $this->campos_quebra_pacientes_estado_paciente[0]['cmp'] = $conteudo; 
   if (isset($this->nmgp_label_quebras['pacientes_estado_paciente']))
   {
       $this->campos_quebra_pacientes_estado_paciente[0]['lab'] = $this->nmgp_label_quebras['pacientes_estado_paciente']; 
   }
   else
   {
       $this->campos_quebra_pacientes_estado_paciente[0]['lab'] = "ESTADO PACIENTE"; 
   }
   $this->sc_proc_quebra_pacientes_estado_paciente = false; 
 } 
 function quebra_pacientes_id_paciente_sc_free_group_by_top() 
 { global
          $pacientes_id_paciente_ant_desc, 
          $nm_saida, $tot_pacientes_id_paciente; 
   $this->SC_tab_quebra = (count($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp']) > 1) ? 10 * $this->Tab_Nv_tree['pacientes_id_paciente'] : 0;
   $pacientes_id_paciente_ant_desc = $this->campos_quebra_pacientes_id_paciente[0]['cmp'];
   static $cont_quebra_pacientes_id_paciente = 0; 
   $cont_quebra_pacientes_id_paciente++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H2 style=\"font-size:0;padding:1px\">" .  $this->campos_quebra_pacientes_id_paciente[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H2></div>";
   }
   $conteudo = $tot_pacientes_id_paciente[0] ;  
   if ($this->SC_sep_quebra)
   {
       $this->SC_sep_quebra = false;
   $nm_saida->saida("<tr>\r\n");
   $nm_saida->saida("<td class=\"" . $this->css_scGridBlockSpaceBg . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
   $nm_saida->saida("</tr>\r\n");
   }
   $colspan = $this->NM_colspan;
   $this->Label_pacientes_id_paciente = "<table>"; 
   foreach ($this->campos_quebra_pacientes_id_paciente as $cada_campo) 
   { 
       $this->Label_pacientes_id_paciente .= "<tr>"; 
       if ($this->SC_tab_quebra > 0)
       {
           $this->Label_pacientes_id_paciente .= "<td class=\"" . $this->css_scGridBlockLineBg . "\" style=\"width: " . $this->SC_tab_quebra . "px;\">&nbsp;</td>"; 
       }
       $this->Label_pacientes_id_paciente .= "<td>" . $cada_campo['lab'] . "</td><td> => </td>";
       $this->Label_pacientes_id_paciente .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_pacientes_id_paciente .= "</tr>"; 
   } 
   $this->Label_pacientes_id_paciente .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"  NOWRAP " . "colspan=\"" . $colspan . "\"" . " align=\"left\">" . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_pacientes_id_paciente . $nm_fecha_pdf_old . "</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_pacientes_estado_paciente_sc_free_group_by_top() 
 { global
          $pacientes_estado_paciente_ant_desc, 
          $nm_saida, $tot_pacientes_estado_paciente; 
   $this->SC_tab_quebra = (count($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Gb_Free_cmp']) > 1) ? 10 * $this->Tab_Nv_tree['pacientes_estado_paciente'] : 0;
   $pacientes_estado_paciente_ant_desc = $this->campos_quebra_pacientes_estado_paciente[0]['cmp'];
   static $cont_quebra_pacientes_estado_paciente = 0; 
   $cont_quebra_pacientes_estado_paciente++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_old = "";
   $nm_fecha_pdf_new = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   $nm_fecha_pdf_new  = "";
   $this->NM_calc_span();
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" && !$this->Print_All)
   {
       $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H3 style=\"font-size:0;padding:1px\">" .  $this->campos_quebra_pacientes_estado_paciente[0]['cmp'] ;
       $nm_fecha_pdf_new = "</H3></div>";
   }
   $conteudo = $tot_pacientes_estado_paciente[0] ;  
   if ($this->SC_sep_quebra)
   {
       $this->SC_sep_quebra = false;
   $nm_saida->saida("<tr>\r\n");
   $nm_saida->saida("<td class=\"" . $this->css_scGridBlockSpaceBg . "\" style=\"height: 10px;\" colspan=\"" . $this->NM_colspan . "\">&nbsp;</td>\r\n");
   $nm_saida->saida("</tr>\r\n");
   }
   $colspan = $this->NM_colspan;
   $this->Label_pacientes_estado_paciente = "<table>"; 
   foreach ($this->campos_quebra_pacientes_estado_paciente as $cada_campo) 
   { 
       $this->Label_pacientes_estado_paciente .= "<tr>"; 
       if ($this->SC_tab_quebra > 0)
       {
           $this->Label_pacientes_estado_paciente .= "<td class=\"" . $this->css_scGridBlockLineBg . "\" style=\"width: " . $this->SC_tab_quebra . "px;\">&nbsp;</td>"; 
       }
       $this->Label_pacientes_estado_paciente .= "<td>" . $cada_campo['lab'] . "</td><td> => </td>";
       $this->Label_pacientes_estado_paciente .= "<td>" . $cada_campo['cmp'] . "</td>";
       $this->Label_pacientes_estado_paciente .= "</tr>"; 
   } 
   $this->Label_pacientes_estado_paciente .= "</table>"; 
   $nm_saida->saida("    <TR >\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlock . "\" style=\"text-align:left;\"   " . "colspan=\"" . $colspan . "\"" . " align=\"left\">" . $nm_nivel_book_pdf . $nm_fecha_pdf_new  . $this->Label_pacientes_estado_paciente . $nm_fecha_pdf_old . "</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida_grid'] && $this->nm_prim_linha)
   { 
       $nm_saida->saida("##NM@@"); 
       $this->nm_prim_linha = false; 
    } 
 } 
 function quebra_geral_top() 
 {
   global $nm_saida; 
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
   function nmgp_barra_top_normal()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=hidden id=\"script_session_f0_top\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'][2] : "";
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
          {
              $this->Ini->Arr_result['setVar'][] = array('var' => 'change_fast_top', 'value' => "");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_cmp))
          {
              $OPC_cmp = NM_conv_charset($OPC_cmp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_arg))
          {
              $OPC_arg = NM_conv_charset($OPC_arg, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_dat))
          {
              $OPC_dat = NM_conv_charset($OPC_dat, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $nm_saida->saida("          <input type=\"hidden\"  id=\"fast_search_f0_top\" name=\"nmgp_fast_search\" value=\"SC_all_Cmp\">\r\n");
          $nm_saida->saida("          <input type=\"hidden\" id=\"cond_fast_search_f0_top\" name=\"nmgp_cond_fast_search\" value=\"qp\">\r\n");
          $nm_saida->saida("          <script type=\"text/javascript\">var scQSInitVal = \"" . addslashes($OPC_dat) . "\";</script>\r\n");
          $nm_saida->saida("          <span id=\"quicksearchph_top\">\r\n");
          $nm_saida->saida("           <input type=\"text\" id=\"SC_fast_search_top\" class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" name=\"nmgp_arg_fast_search\" value=\"" . NM_encode_input($OPC_dat) . "\" size=\"10\" onChange=\"change_fast_top = 'CH';\" alt=\"{watermark:'" . $this->Ini->Nm_lang['lang_othr_qk_watermark'] . "', watermarkClass:'css_toolbar_objWm', maxLength: 255}\">\r\n");
          $nm_saida->saida("           <img style=\"display: none\" id=\"SC_fast_search_close_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "\" onclick=\"document.getElementById('SC_fast_search_top').value = ''; nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("           <img style=\"display: none\" id=\"SC_fast_search_submit_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_search . "\" onclick=\"nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("          </span>\r\n");
          $NM_btn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $UseAlias =  "N";
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
              $UseAlias =  "N";
          }
          else
          {
              $UseAlias =  "S";
          }
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnOrderCamposShow('" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Groupby_hide']))
              {
                  $Q_count++;
                  if ($QB == "sc_free_group_by")
                  {
                      $Q_free = true;
                  }
              }
          }
          if ($Q_count > 1 || $Q_free)
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnGroupByShow('" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "sel_groupby_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
      }
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn = true;
          $nm_saida->saida("           <table style=\"border-collapse: collapse; border-width: 0; display: none; position: absolute; z-index: 1000\" id=\"sc_btgp_div_group_1_top\">\r\n");
              $nm_saida->saida("           <tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&language=es&conf_socor=S&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0')", "nm_gp_move('xls', '0')", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0')", "nm_gp_move('xml', '0')", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '1')", "nm_gp_move('csv', '1')", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr>\r\n");
          $nm_saida->saida("           </table>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if (is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Img_sep_grid))
      {
          if ($NM_btn)
          {
              $NM_btn = false;
              $NM_ult_sep = "NM_sep_1";
              $nm_saida->saida("          <img id=\"NM_sep_1\" src=\"" . $this->Ini->path_img_global . $this->Ini->Img_sep_grid . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
          }
      }
      if (is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Img_sep_grid))
      {
          if ($NM_btn)
          {
              $NM_btn = false;
              $NM_ult_sep = "NM_sep_2";
              $nm_saida->saida("          <img id=\"NM_sep_2\" src=\"" . $this->Ini->path_img_global . $this->Ini->Img_sep_grid . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
          }
      }
      if (is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Img_sep_grid))
      {
          if ($NM_btn)
          {
              $NM_btn = false;
              $NM_ult_sep = "NM_sep_3";
              $nm_saida->saida("          <img id=\"NM_sep_3\" src=\"" . $this->Ini->path_img_global . $this->Ini->Img_sep_grid . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
          }
      }
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0')", "nm_gp_move('resumo', '0')", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
                  $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      if (is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Img_sep_grid))
      {
          if ($NM_btn)
          {
              $NM_btn = false;
              $NM_ult_sep = "NM_sep_4";
              $nm_saida->saida("          <img id=\"NM_sep_4\" src=\"" . $this->Ini->path_img_global . $this->Ini->Img_sep_grid . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
          }
      }
          if (is_file("Informe_reclamacion_historial_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("Informe_reclamacion_historial_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'])
      {
         if ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
         elseif (!$this->Ini->SC_Link_View && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
      }
      elseif ($this->nmgp_botoes['exit'] == "on")
      {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_modal'])
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove()", "self.parent.tb_remove()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
        else
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "window.close()", "window.close()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_bot_normal()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
      $this->NM_calc_span();
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_bot\" name=\"F0_bot\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_bot\" name=\"sc_truta_f0_bot\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_bot\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=hidden id=\"script_session_f0_bot\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_bot\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['paginacao']))
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid'];
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "birpara", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav)", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav)", "brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $Page_Atu   = ceil($this->nmgp_reg_inicial / $Reg_Page);
              $nm_saida->saida("          <input id=\"rec_f0_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" name=\"rec\" value=\"" . NM_encode_input($Page_Atu) . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
              $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['paginacao']))
          {
              $nm_saida->saida("          <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
              $nm_saida->saida("          <select class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" id=\"quant_linhas_f0_bot\" name=\"nmgp_quant_linhas\" onchange=\"sc_ind = document.getElementById('quant_linhas_f0_bot').selectedIndex; nm_gp_submit_ajax('muda_qt_linhas', document.getElementById('quant_linhas_f0_bot').options[sc_ind].value)\"> \r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid'] == 10) ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid'] == 20) ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid'] == 50) ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']))
          {
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio_off", "nm_gp_submit_rec('ini')", "nm_gp_submit_rec('ini')", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini')", "nm_gp_submit_rec('ini')", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']))
          {
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna_off", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['paginacao']))
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['qt_lin_grid'];
              $Max_link   = 5;
              $Mid_link   = ceil($Max_link / 2);
              $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
              $Qtd_Pages  = ceil($this->count_ger / $Reg_Page);
              $Page_Atu   = ceil($this->nmgp_reg_final / $Reg_Page);
              $Link_ini   = 1;
              if ($Page_Atu > $Max_link)
              {
                  $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
              }
              elseif ($Page_Atu > $Mid_link)
              {
                  $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
              }
              if (($Qtd_Pages - $Link_ini) < $Max_link)
              {
                  $Link_ini = ($Qtd_Pages - $Max_link) + 1;
              }
              if ($Link_ini < 1)
              {
                  $Link_ini = 1;
              }
              for ($x = 0; $x < $Max_link && $Link_ini <= $Qtd_Pages; $x++)
              {
                  $rec = (($Link_ini - 1) * $Reg_Page) + 1;
                  if ($Link_ini == $Page_Atu)
                  {
                      $nm_saida->saida("            <span class=\"scGridToolbarNavOpen\" style=\"vertical-align: middle;\">" . $Link_ini . "</span>\r\n");
                  }
                  else
                  {
                      $nm_saida->saida("            <a class=\"scGridToolbarNav\" style=\"vertical-align: middle;\" href=\"javascript: nm_gp_submit_rec(" . $rec . ")\">" . $Link_ini . "</a>\r\n");
                  }
                  $Link_ini++;
                  if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
                  {
                      $nm_saida->saida("            <img src=\"" . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
                  }
              }
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim')", "nm_gp_submit_rec('fim')", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if (empty($this->nm_grid_sem_reg))
          {
              $nm_sumario = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
              $nm_sumario = str_replace("?start?", $this->nmgp_reg_inicial, $nm_sumario);
              $nm_sumario = str_replace("?final?", $this->nmgp_reg_final, $nm_sumario);
              $nm_sumario = str_replace("?total?", $this->count_ger, $nm_sumario);
              $nm_saida->saida("           <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border:0px;\">" . $nm_sumario . "</span>\r\n");
              $NM_btn = true;
          }
          if (is_file("Informe_reclamacion_historial_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("Informe_reclamacion_historial_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_bot', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top_mobile()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=hidden id=\"script_session_f0_top\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['fast_search'][2] : "";
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
          {
              $this->Ini->Arr_result['setVar'][] = array('var' => 'change_fast_top', 'value' => "");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_cmp))
          {
              $OPC_cmp = NM_conv_charset($OPC_cmp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_arg))
          {
              $OPC_arg = NM_conv_charset($OPC_arg, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($OPC_dat))
          {
              $OPC_dat = NM_conv_charset($OPC_dat, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $nm_saida->saida("          <input type=\"hidden\"  id=\"fast_search_f0_top\" name=\"nmgp_fast_search\" value=\"SC_all_Cmp\">\r\n");
          $nm_saida->saida("          <input type=\"hidden\" id=\"cond_fast_search_f0_top\" name=\"nmgp_cond_fast_search\" value=\"qp\">\r\n");
          $nm_saida->saida("          <script type=\"text/javascript\">var scQSInitVal = \"" . addslashes($OPC_dat) . "\";</script>\r\n");
          $nm_saida->saida("          <span id=\"quicksearchph_top\">\r\n");
          $nm_saida->saida("           <input type=\"text\" id=\"SC_fast_search_top\" class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" name=\"nmgp_arg_fast_search\" value=\"" . NM_encode_input($OPC_dat) . "\" size=\"10\" onChange=\"change_fast_top = 'CH';\" alt=\"{watermark:'" . $this->Ini->Nm_lang['lang_othr_qk_watermark'] . "', watermarkClass:'css_toolbar_objWm', maxLength: 255}\">\r\n");
          $nm_saida->saida("           <img style=\"display: none\" id=\"SC_fast_search_close_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "\" onclick=\"document.getElementById('SC_fast_search_top').value = ''; nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("           <img style=\"display: none\" id=\"SC_fast_search_submit_top\" src=\"" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_search . "\" onclick=\"nm_gp_submit_qsearch('top');\">\r\n");
          $nm_saida->saida("          </span>\r\n");
          $NM_btn = true;
      }
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn = true;
          $nm_saida->saida("           <table style=\"border-collapse: collapse; border-width: 0; display: none; position: absolute; z-index: 1000\" id=\"sc_btgp_div_group_1_top\">\r\n");
              $nm_saida->saida("           <tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&language=es&conf_socor=S&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_config_word.php?nm_cor=AM&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0')", "nm_gp_move('xls', '0')", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0')", "nm_gp_move('xml', '0')", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '1')", "nm_gp_move('csv', '1')", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_move('rtf', '0')", "nm_gp_move('rtf', '0')", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_config_print.php?nm_opc=AM&nm_cor=AM&language=es&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr>\r\n");
          $nm_saida->saida("           </table>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      if ($this->nmgp_botoes['group_2'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_2_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_2", "scBtnGrpShow('group_2_top')", "scBtnGrpShow('group_2_top')", "sc_btgp_btn_group_2_top", "", "" . $this->Ini->Nm_lang['lang_btns_settings'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_settings'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn = true;
          $nm_saida->saida("           <table style=\"border-collapse: collapse; border-width: 0; display: none; position: absolute; z-index: 1000\" id=\"sc_btgp_div_group_2_top\">\r\n");
              $nm_saida->saida("           <tr><td class=\"scBtnGrpBackground\">\r\n");
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $UseAlias =  "N";
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
              $UseAlias =  "N";
          }
          else
          {
              $UseAlias =  "S";
          }
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnOrderCamposShow('" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['groupby'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['SC_Groupby_hide']))
              {
                  $Q_count++;
                  if ($QB == "sc_free_group_by")
                  {
                      $Q_free = true;
                  }
              }
          }
          if ($Q_count > 1 || $Q_free)
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnGroupByShow('" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_sel_groupby.php?opc_ret=igual&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "sel_groupby_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
          }
      }
          if ($this->nmgp_botoes['summary'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
          {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bresumo", "nm_gp_move('resumo', '0')", "nm_gp_move('resumo', '0')", "res_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
          }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
              $nm_saida->saida("           </td></tr>\r\n");
          $nm_saida->saida("           </table>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_2_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_2_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if (is_file("Informe_reclamacion_historial_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("Informe_reclamacion_historial_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_bot_mobile()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
      $this->NM_calc_span();
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_bot\" name=\"F0_bot\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_bot\" name=\"sc_truta_f0_bot\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_bot\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=hidden id=\"script_session_f0_bot\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_bot\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao_print'] != "print") 
      {
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']))
          {
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio_off", "nm_gp_submit_rec('ini')", "nm_gp_submit_rec('ini')", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini')", "nm_gp_submit_rec('ini')", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']))
          {
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna_off", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg))
          {
              $nm_sumario = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
              $nm_sumario = str_replace("?start?", $this->nmgp_reg_inicial, $nm_sumario);
              $nm_sumario = str_replace("?final?", $this->nmgp_reg_final, $nm_sumario);
              $nm_sumario = str_replace("?total?", $this->count_ger, $nm_sumario);
              $nm_saida->saida("           <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border:0px;\">" . $nm_sumario . "</span>\r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim')", "nm_gp_submit_rec('fim')", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if (is_file("Informe_reclamacion_historial_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("Informe_reclamacion_historial_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_bot', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top()
   {
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_barra_top_mobile();
       }
       else
       {
           $this->nmgp_barra_top_normal();
       }
   }
   function nmgp_barra_bot()
   {
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_barra_bot_mobile();
       }
       else
       {
           $this->nmgp_barra_bot_normal();
       }
   }
   function nmgp_embbed_placeholder_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function nmgp_embbed_placeholder_bot()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
//--- 
//--- 
 function grafico_pdf()
 {
   global $nm_saida, $nm_lang;
   require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
   $this->Graf  = new Informe_reclamacion_historial_grafico();
   $this->Graf->Db     = $this->Db;
   $this->Graf->Erro   = $this->Erro;
   $this->Graf->Ini    = $this->Ini;
   $this->Graf->Lookup = $this->Lookup;
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pivot_charts']))
   {
       $this->Graf->monta_grafico('', 'pdf_lib');
       $nm_saida->saida("<B><div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_btns_chrt_pdff_hint'] . "</H1></div></B>\r\n");
       $iChartCount = 1;
       $iChartTotal = sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pivot_charts']);
       $sChartLang  = isset($this->Ini->Nm_lang['lang_pdff_pcht']) ? $this->Ini->Nm_lang['lang_pdff_pcht'] : 'Generating chart';
       if (!NM_is_utf8($sChartLang))
       {
           $sChartLang = sc_convert_encoding($sChartLang, "UTF-8", $_SESSION['scriptcase']['charset']);
       }
       $bChartFP = false;
      if (!isset($this->progress_fp) || !$this->progress_fp)
      {
           $bChartFP           = true;
           $str_pbfile         = isset($_GET['pbfile']) ? urldecode($_GET['pbfile']) : $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
           $this->progress_fp  = fopen($str_pbfile, 'a');
           $this->progress_now = 90;
           $this->progress_res = 0;
      }
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pivot_charts'] as $chart_index => $chart_data)
       {
           $nm_saida->saida("<table><tr><td style=\"border-width:0;height:1px;padding:0\"><span style=\"display: none;\">&nbsp;</span><div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></td></tr></table>\r\n");
           $nm_saida->saida("<table><tr><td>\r\n");
           $tit_graf = $chart_data['title'];
           if ('' != $chart_data['subtitle'])
           {
               $tit_graf .= ' - ' . $chart_data['subtitle'];
           }
           if ('UTF-8' != $_SESSION['scriptcase']['charset'])
           {
               $tit_graf = sc_convert_encoding($tit_graf, $_SESSION['scriptcase']['charset'], 'UTF-8');
           }
           $tit_book_marks = str_replace(" ", "&nbsp;", $tit_graf);
           $nm_saida->saida("<b><h2>$tit_book_marks</h2></b>\r\n");
           if ($this->progress_fp)
           {
               fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $sChartLang . " " . $iChartCount . "/" . $iChartTotal . "...\n");
               $iChartCount++;
               if (0 < $this->progress_res)
               {
                   $this->progress_now++;
               }
           }
           $this->Graf->monta_grafico($chart_index, 'pdf');
           $nm_saida->saida("</td></tr></table>\r\n");
       }
       if ($bChartFP)
       {
           $lang_protect = $this->Ini->Nm_lang['lang_pdff_gnrt'];
           if (!NM_is_utf8($lang_protect))
           {
               $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
           }
           fwrite($this->progress_fp, 90 . "_#NM#_" . $lang_protect . "...\n");
           fclose($this->progress_fp);
       }
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['charts_html']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['charts_html'])
       {
            $nm_saida->saida("<script type=\"text/javascript\">\r\n");
            $nm_saida->saida("{$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['charts_html']}\r\n");
            $nm_saida->saida("</script>\r\n");
       }
   }
   $nm_saida->saida("</body>\r\n");
   $nm_saida->saida("</HTML>\r\n");
 }
//--- 
//--- 
 function grafico_pdf_flash()
 {
   global $nm_saida, $nm_lang;
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['chart_list']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['chart_list'] as $arr_chart)
       {
           $nm_saida->saida("<table><tr><td style=\"border-width:0;height:1px;padding:0\"><span style=\"display: none;\">&nbsp;</span><div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></td></tr></table>\r\n");
       $nm_saida->saida("<b><div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_btns_chrt_pdff_hint'] . "</H1></div></b>\r\n");
           $nm_saida->saida("<table><tr><td>\r\n");
           $tit_graf       = $arr_chart[1];
           if ('UTF-8' != $_SESSION['scriptcase']['charset'])
           {
               $tit_graf = sc_convert_encoding($tit_graf, $_SESSION['scriptcase']['charset'], 'UTF-8');
           }
           $tit_book_marks = str_replace(" ", "&nbsp;", $tit_graf);
           $nm_saida->saida("<b><h2>$tit_book_marks</h2></b>\r\n");
           $nm_saida->saida("<img src=\"" . $arr_chart[0] . ".png\"/>\r\n");
           $_SESSION['scriptcase']['sc_num_img']++;
           $nm_saida->saida("</td></tr></table>\r\n");
       }
   }
   $nm_saida->saida("</body>\r\n");
   $nm_saida->saida("</HTML>\r\n");
 }
//--- 
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
 function check_btns()
 {
 }
 function nm_fim_grid($flag_apaga_pdf_log = TRUE)
 {
   global
   $nm_saida, $nm_url_saida, $NMSC_modal;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
        return;
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['embutida'])
   { 
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']))
       {
           $temp = array();
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               $temp[] = $NM_aplic;
           }
           $temp = array_unique($temp);
           foreach ($temp as $NM_aplic)
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
               { 
                   $this->Ini->Arr_result['setArr'][] = array('var' => ' NM_tab_' . $NM_aplic, 'value' => '');
               } 
               $nm_saida->saida("   NM_tab_" . $NM_aplic . " = new Array();\r\n");
           }
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               foreach ($resto as $NM_ind => $NM_quebra)
               {
                   foreach ($NM_quebra as $NM_nivel => $NM_tipo)
                   {
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
                       { 
                           $this->Ini->Arr_result['setVar'][] = array('var' => ' NM_tab_' . $NM_aplic . '[' . $NM_ind . ']', 'value' => $NM_tipo . $NM_nivel);
                       } 
                       $nm_saida->saida("   NM_tab_" . $NM_aplic . "[" . $NM_ind . "] = '" . $NM_tipo . $NM_nivel . "';\r\n");
                   }
               }
           }
       }
   }
   $nm_saida->saida("   function NM_liga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = parseInt (Obj[tbody].substr(3));\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = parseInt (Obj[ind].substr(3));\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if (Nivel == Nv && Tp == 'top')\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if (((Nivel + 1) == Nv && Tp == 'top') || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='';\r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function NM_apaga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = Obj[tbody].substr(3);\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = Obj[ind].substr(3);\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if ((Nivel == Nv && Tp == 'top') || Nv < Nivel)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if ((Nivel != Nv) || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='none';\r\n");
   $nm_saida->saida("               if (Tp == 'top')\r\n");
   $nm_saida->saida("               {\r\n");
   $nm_saida->saida("                   document.getElementById('b_open_' + Apl + '_' + ind).style.display='';\r\n");
   $nm_saida->saida("                   document.getElementById('b_close_' + Apl + '_' + ind).style.display='none';\r\n");
   $nm_saida->saida("               } \r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   NM_obj_ant = '';\r\n");
   $nm_saida->saida("   function NM_apaga_div_lig(obj_nome)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      if (NM_obj_ant != '')\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_obj_ant.style.display='none';\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      obj = document.getElementById(obj_nome);\r\n");
   $nm_saida->saida("      NM_obj_ant = obj;\r\n");
   $nm_saida->saida("      ind_time = setTimeout(\"obj.style.display='none'\", 300);\r\n");
   $nm_saida->saida("      return ind_time;\r\n");
   $nm_saida->saida("   }\r\n");
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   if (@is_file($str_pbfile) && $flag_apaga_pdf_log)
   {
      @unlink($str_pbfile);
   }
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "");
       }
   }
   if (isset($this->redir_modal) && !empty($this->redir_modal))
   {
       echo $this->redir_modal;
   }
   $nm_saida->saida("   </script>\r\n");
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("      parent.scAjaxDetailHeight('Informe_reclamacion_historial', $(document).innerHeight());\r\n");
       $nm_saida->saida("   </script>\r\n");
   }
   $nm_saida->saida("   </HTML>\r\n");
 }
//--- 
//--- 
 function form_navegacao()
 {
   global
   $nm_saida, $nm_url_saida;
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   $nm_saida->saida("   <form name=\"F3\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_chave\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_ordem\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"Informe_reclamacion_historial\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parm_acum\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_quant_linhas\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_orig_pesq\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F4\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"rec\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"rec\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_call_php\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F5\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"Informe_reclamacion_historial_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("  <form name=\"Fdoc_word\" method=\"post\" \r\n");
   $nm_saida->saida("        action=\"./\" \r\n");
   $nm_saida->saida("        target=\"_self\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"doc_word\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_word\" value=\"AM\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_navegator_print\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("    document.Fdoc_word.nmgp_navegator_print.value = navigator.appName;\r\n");
   $nm_saida->saida("   function nm_gp_word_conf(cor)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("       document.Fdoc_word.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var obj_tr      = \"\";\r\n");
   $nm_saida->saida("   var css_tr      = \"\";\r\n");
   $nm_saida->saida("   var field_over  = " . $this->NM_field_over . ";\r\n");
   $nm_saida->saida("   var field_click = " . $this->NM_field_click . ";\r\n");
   $nm_saida->saida("   function over_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_over != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj.className = '" . $this->css_scGridFieldOver . "';\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function out_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_over != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj.className = class_obj;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function click_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_click != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr != \"\")\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           obj_tr.className = css_tr;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       css_tr        = class_obj;\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           obj_tr     = '';\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj_tr        = obj;\r\n");
   $nm_saida->saida("       css_tr        = class_obj;\r\n");
   $nm_saida->saida("       obj.className = '" . $this->css_scGridFieldClick . "';\r\n");
   $nm_saida->saida("   }\r\n");
   if ($this->Rec_ini == 0)
   {
       $nm_saida->saida("   nm_gp_ini = \"ini\";\r\n");
   }
   else
   {
       $nm_saida->saida("   nm_gp_ini = \"\";\r\n");
   }
   $nm_saida->saida("   nm_gp_rec_ini = \"" . $this->Rec_ini . "\";\r\n");
   $nm_saida->saida("   nm_gp_rec_fim = \"" . $this->Rec_fim . "\";\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['ajax_nav'])
   {
       if ($this->Rec_ini == 0)
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "ini");
       }
       else
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "");
       }
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_ini', 'value' => $this->Rec_ini);
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_fim', 'value' => $this->Rec_fim);
   }
   $nm_saida->saida("   function nm_gp_submit_rec(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (nm_gp_ini == \"ini\" && (campo == \"ini\" || campo == nm_gp_rec_ini)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      if (nm_gp_fim == \"fim\" && (campo == \"fim\" || campo == nm_gp_rec_fim)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      nm_gp_submit_ajax(\"rec\", campo); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit_qsearch(pos) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      var out_qsearch = \"\";\r\n");
   $nm_saida->saida("       out_qsearch = document.getElementById('fast_search_f0_' + pos).value;\r\n");
   $nm_saida->saida("       out_qsearch += \"_SCQS_\" + document.getElementById('cond_fast_search_f0_' + pos).value;\r\n");
   $nm_saida->saida("       out_qsearch += \"_SCQS_\" + document.getElementById('SC_fast_search_' + pos).value;\r\n");
   $nm_saida->saida("       ajax_navigate('fast_search', out_qsearch); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit_ajax(opc, parm) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      ajax_navigate(opc, parm); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit2(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      nm_gp_submit_ajax(\"ordem\", campo); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit3(parms, parm_acum, opc) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target               = \"_self\"; \r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parm_acum.value = parm_acum ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_opcao.value     = opc ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = \"\";\r\n");
   $nm_saida->saida("      document.F3.action               = \"./\"  ;\r\n");
   $nm_saida->saida("      document.F3.submit() ;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_submit_modal(parms, t_parent) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (t_parent == 'S' && typeof parent.tb_show == 'function')\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("           parent.tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("         tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_move(tipo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F6.target = \"_self\"; \r\n");
   $nm_saida->saida("      document.F6.submit() ;\r\n");
   $nm_saida->saida("      return;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_move(x, y, z, p, g) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       document.F3.action           = \"./\"  ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_parms.value = \"SC_null\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_orig_pesq.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_url_saida.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_opcao.value = x; \r\n");
   $nm_saida->saida("       document.F3.nmgp_outra_jan.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.target = \"_self\"; \r\n");
   $nm_saida->saida("       if (y == 1) \r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.target = \"_blank\"; \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (\"busca\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.nmgp_orig_pesq.value = z; \r\n");
   $nm_saida->saida("           z = '';\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (z != null && z != '') \r\n");
   $nm_saida->saida("       { \r\n");
   $nm_saida->saida("           document.F3.nmgp_tipo_pdf.value = z; \r\n");
   $nm_saida->saida("       } \r\n");
   $nm_saida->saida("       if (\"xls\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   if (!extension_loaded("zip"))
   {
       $nm_saida->saida("           alert (\"" . html_entity_decode($this->Ini->Nm_lang['lang_othr_prod_xtzp'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\");\r\n");
       $nm_saida->saida("           return false;\r\n");
   } 
   $nm_saida->saida("       }\r\n");
   $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['Informe_reclamacion_historial_iframe_params'] = array(
       'str_tmp'    => $this->Ini->path_imag_temp,
       'str_prod'   => $this->Ini->path_prod,
       'str_btn'    => $this->Ini->Str_btn_css,
       'str_lang'   => $this->Ini->str_lang,
       'str_schema' => $this->Ini->str_schema_all,
   );
   $nm_saida->saida("       if (\"pdf\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           window.location = \"" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_iframe.php?scsess=" . session_id() . "&str_tmp=" . $this->Ini->path_imag_temp . "&str_prod=" . $this->Ini->path_prod . "&str_btn=" . $this->Ini->Str_btn_css . "&str_lang=" . $this->Ini->str_lang . "&str_schema=" . $this->Ini->str_schema_all . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&pbfile=" . urlencode($str_pbfile) . "&jspath=" . urlencode($this->Ini->path_js) . "&sc_apbgcol=" . urlencode($this->Ini->path_css) . "&sc_tp_pdf=\" + z + \"&sc_parms_pdf=\" + p + \"&sc_graf_pdf=\" + g;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.submit();  \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_print_conf(tp, cor)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       window.open('" . $this->Ini->path_link . "Informe_reclamacion_historial/Informe_reclamacion_historial_iframe_prt.php?path_botoes=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&opcao=print&tp_print=' + tp + '&cor_print=' + cor,'','location=no,menubar,resizable,scrollbars,status=no,toolbar');\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   nm_img = new Image();\r\n");
   $nm_saida->saida("   function nm_mostra_img(imagem, altura, largura)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       tb_show(\"\", imagem, \"\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_mostra_doc(campo1, campo2, campo3, campo4)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       while (campo2.lastIndexOf(\"&\") != -1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("          campo2 = campo2.replace(\"&\" , \"**Ecom**\");\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       while (campo2.lastIndexOf(\"#\") != -1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("          campo2 = campo2.replace(\"#\" , \"**Jvel**\");\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       while (campo2.lastIndexOf(\"+\") != -1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("          campo2 = campo2.replace(\"+\" , \"**Plus**\");\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       NovaJanela = window.open (campo4 + \"?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nm_cod_doc=\" + campo1 + \"&nm_nome_doc=\" + campo2 + \"&nm_cod_apl=\" + campo3, \"ScriptCase\", \"resizable\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_escreve_window()\r\n");
   $nm_saida->saida("   {\r\n");
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campo_psq_ret']) && empty($this->nm_grid_sem_reg))
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['sc_modal'])
      {
          $nm_saida->saida("          var Obj_Form = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Doc = parent;\r\n");
          $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campo_psq_ret'] . "\");\r\n");
          $nm_saida->saida("          }\r\n");
      }
      else
      {
          $nm_saida->saida("          var Obj_Form = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Doc = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['campo_psq_ret'] . "\");\r\n");
          $nm_saida->saida("          }\r\n");
      }
          $nm_saida->saida("          else\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = null;\r\n");
          $nm_saida->saida("          }\r\n");
      $nm_saida->saida("          if (Obj_Form.value != document.Fpesq.nm_ret_psq.value)\r\n");
      $nm_saida->saida("          {\r\n");
      $nm_saida->saida("              Obj_Form.value = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              if (null != Obj_Readonly)\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Readonly.innerHTML = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              }\r\n");
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['js_apos_busca'] . "();\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              else if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
     else
     {
      $nm_saida->saida("              if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
      $nm_saida->saida("          }\r\n");
      $nm_saida->saida("      }\r\n");
   }
   $nm_saida->saida("      document.F5.action = \"Informe_reclamacion_historial_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['reg_start']))
   {
       $nm_saida->saida("      parent.scAjaxDetailStatus('Informe_reclamacion_historial');\r\n");
       $nm_saida->saida("      parent.scAjaxDetailHeight('Informe_reclamacion_historial', $(document).innerHeight());\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>

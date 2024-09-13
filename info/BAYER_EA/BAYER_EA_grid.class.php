<?php
class EA_grid
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
   var $evento_adverso_id_evento_adverso;
   var $evento_adverso_pais;
   var $evento_adverso_tipo_reporte;
   var $evento_adverso_fecha_staff;
   var $evento_adverso_producto;
   var $evento_adverso_ciudad;
   var $evento_adverso_genero;
   var $evento_adverso_fecha_nacimiento;
   var $evento_adverso_embarazo;
   var $evento_adverso_fecha_parto;
   var $evento_adverso_desenlace;
   var $evento_adverso_cuales_desenlaces;
   var $evento_adverso_contacto_directo;
   var $evento_adverso_nombre_medico;
   var $evento_adverso_telefono_medico;
   var $evento_adverso_fax_medico;
   var $evento_adverso_email_medico;
   var $evento_adverso_indicacion1;
   var $evento_adverso_formulacion1;
   var $evento_adverso_regimen_dosis1;
   var $evento_adverso_ruta_administracion1;
   var $evento_adverso_numero_lote1;
   var $evento_adverso_fecha_expiracion1;
   var $evento_adverso_fecha_inicio1;
   var $evento_adverso_tratamiento_continua1;
   var $evento_adverso_indicacion2;
   var $evento_adverso_formulacion2;
   var $evento_adverso_regimen_dosis2;
   var $evento_adverso_ruta_administracion2;
   var $evento_adverso_numero_lote2;
   var $evento_adverso_fecha_expiracion2;
   var $evento_adverso_fecha_inicio2;
   var $evento_adverso_tratamiento_continua2;
   var $evento_adverso_indicacion3;
   var $evento_adverso_formulacion3;
   var $evento_adverso_regimen_dosis3;
   var $evento_adverso_ruta_administracion3;
   var $evento_adverso_numero_lote3;
   var $evento_adverso_fecha_expiracion3;
   var $evento_adverso_fecha_inicio3;
   var $evento_adverso_tratamiento_continua3;
   var $evento_adverso_muestra_disponible;
   var $evento_adverso_informacion_muestra;
   var $evento_adverso_relacion_medicamento1;
   var $evento_adverso_relacionado_dispositivo1;
   var $evento_adverso_fecha_inicio_evento1;
   var $evento_adverso_desenlace1;
   var $evento_adverso_fecha_recuperacion1;
   var $evento_adverso_fecha_muerte1;
   var $evento_adverso_criterio_seriedad1;
   var $evento_adverso_criterio_seriedad_muerte1;
   var $evento_adverso_criterio_seriedad_hospitalizacion1;
   var $evento_adverso_criterio_seriedad_amenaza1;
   var $evento_adverso_criterio_seriedad_incapacidad1;
   var $evento_adverso_criterio_seriedad_anormalidad1;
   var $evento_adverso_criterio_seriedad_evento1;
   var $evento_adverso_criterio_seriedad_quirurgica1;
   var $evento_adverso_causa_muerte1;
   var $evento_adverso_detalles_ea1;
   var $evento_adverso_relacion_medicamento2;
   var $evento_adverso_relacionado_dispositivo2;
   var $evento_adverso_fecha_inicio_evento2;
   var $evento_adverso_desenlace2;
   var $evento_adverso_fecha_recuperacion2;
   var $evento_adverso_fecha_muerte2;
   var $evento_adverso_criterio_seriedad2;
   var $evento_adverso_criterio_seriedad_muerte2;
   var $evento_adverso_criterio_seriedad_hospitalizacion2;
   var $evento_adverso_criterio_seriedad_amenaza2;
   var $evento_adverso_criterio_seriedad_incapacidad2;
   var $evento_adverso_criterio_seriedad_anormalidad2;
   var $evento_adverso_criterio_seriedad_evento2;
   var $evento_adverso_criterio_seriedad_quirurgica2;
   var $evento_adverso_causa_muerte2;
   var $evento_adverso_detalles_ea2;
   var $evento_adverso_relacion_medicamento3;
   var $evento_adverso_relacionado_dispositivo3;
   var $evento_adverso_fecha_inicio_evento3;
   var $evento_adverso_desenlace3;
   var $evento_adverso_fecha_recuperacion3;
   var $evento_adverso_fecha_muerte3;
   var $evento_adverso_criterio_seriedad3;
   var $evento_adverso_criterio_seriedad_muerte3;
   var $evento_adverso_criterio_seriedad_hospitalizacion3;
   var $evento_adverso_criterio_seriedad_amenaza3;
   var $evento_adverso_criterio_seriedad_incapacidad3;
   var $evento_adverso_criterio_seriedad_anormalidad3;
   var $evento_adverso_criterio_seriedad_evento3;
   var $evento_adverso_criterio_seriedad_quirurgica3;
   var $evento_adverso_causa_muerte3;
   var $evento_adverso_detalles_ea3;
   var $evento_adverso_informacion_adicional;
   var $evento_adverso_nombre_reporte;
   var $evento_adverso_id_paciente_fk;
   var $evento_adverso_medicamento1;
   var $evento_adverso_medicamento2;
   var $evento_adverso_medicamento3;
   var $evento_adverso_informacion_ea1;
   var $evento_adverso_informacion_ea2;
   var $evento_adverso_informacion_ea3;
   var $evento_adverso_fecha_suspencion1;
   var $evento_adverso_fecha_suspencion2;
   var $evento_adverso_fecha_suspencion3;
   var $evento_adverso_fecha_evento_adverso;
   var $evento_adverso_nombre_reportante_primario;
   var $evento_adverso_telefono_reportante_primario;
   var $evento_adverso_tipo_reportante;
//--- 
 function monta_grid($linhas = 0)
 {
   global $nm_saida;

   clearstatcache();
   $this->NM_cor_embutida();
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       $this->nm_fim_grid();
   } 
   else 
   { 
       $this->cabecalho();
       $nm_saida->saida(" <TR>\r\n");
       $nm_saida->saida("  <TD id='sc_grid_content'  colspan=1>\r\n");
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       $nmgrp_apl_opcao= $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
           $this->nmgp_embbed_placeholder_top();
       } 
       $this->grid();
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_embbed_placeholder_bot();
           $this->nmgp_barra_bot();
       } 
       $nm_saida->saida("   </table>\r\n");
       $nm_saida->saida("  </TD>\r\n");
       $nm_saida->saida(" </TR>\r\n");
       $flag_apaga_pdf_log = TRUE;
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'];
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
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "EA/EA_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = trim(substr($cada_css, 1, $Pos1 - 1));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['doc_word'])
       { 
           $this->Css_Cmp[$Tag] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['Lig_Md5'] = array();
   }
   $this->force_toolbar = false;
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['EA']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['EA']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['EA']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['mostra_edit'] = "N";
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("EA", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
   $this->nmgp_botoes['filter'] = "on";
   $this->nmgp_botoes['pdf'] = "on";
   $this->nmgp_botoes['xls'] = "on";
   $this->nmgp_botoes['xml'] = "on";
   $this->nmgp_botoes['csv'] = "on";
   $this->nmgp_botoes['rtf'] = "on";
   $this->nmgp_botoes['word'] = "on";
   $this->nmgp_botoes['export'] = "on";
   $this->nmgp_botoes['print'] = "on";
   $this->nmgp_botoes['sel_col'] = "on";
   $this->nmgp_botoes['sort_col'] = "on";
   $this->nmgp_botoes['qsearch'] = "on";
   $this->nmgp_botoes['gantt'] = "on";
   $this->nmgp_botoes['groupby'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->Cmps_ord_def['cmp_maior_30_1'] = " desc";
   $this->Cmps_ord_def["evento_adverso.ID_EVENTO_ADVERSO"] = "";
   $this->Cmps_ord_def['evento_adverso_pais'] = " asc";
   $this->Cmps_ord_def["evento_adverso.PAIS"] = "";
   $this->Cmps_ord_def['cmp_maior_30_2'] = " asc";
   $this->Cmps_ord_def["evento_adverso.TIPO_REPORTE"] = "";
   $this->Cmps_ord_def['cmp_maior_30_3'] = " asc";
   $this->Cmps_ord_def["evento_adverso.FECHA_STAFF"] = "";
   $this->Cmps_ord_def['evento_adverso_producto'] = " asc";
   $this->Cmps_ord_def["evento_adverso.PRODUCTO"] = "";
   $this->Cmps_ord_def['evento_adverso_ciudad'] = " asc";
   $this->Cmps_ord_def["evento_adverso.CIUDAD"] = "";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['EA']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['EA']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['EA']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['SC_Gb_Free_cmp']))
   { 
       $this->nmgp_botoes['summary'] = "off";
   } 
   $this->sc_proc_grid = false; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['doc_word'])
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq_ant'];  
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
       $evento_adverso_id_evento_adverso_2 = $Busca_temp['evento_adverso_id_evento_adverso_input_2']; 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "muda_qt_linhas";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "EA/EA_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "EA_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_pdf'] != "pdf")  
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new EA_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid'] = 10;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['EA']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['EA']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['EA']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['EA']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['EA']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['EA']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['EA']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['EA']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['rows'];  
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid']; 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_select'] = array(); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_select']; 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "igual" ;  
       }
       elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_quebra'][$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "inicio" ;  
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_grid'] = ""; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_quebra'][$nmgp_ordem] == "asc") 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_quebra'][$nmgp_ordem] = "desc"; 
           }   
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_quebra'][$nmgp_ordem] = "asc"; 
           }   
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_cmp'] = $nmgp_ordem;  
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_quebra'][$nmgp_ordem]);  
       }   
       else   
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_grid'] = $nmgp_ordem  ; 
       }   
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao']       = "igual" ; 
   } 
// 
   $this->count_ger = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid'] == "all") 
   { 
       $this->Tot->quebra_geral() ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['tot_geral'][1];
   } 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_total']);
       $this->Tot->quebra_geral() ; 
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] = 0 ; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] > 0) 
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
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_desc']; 
   } 
   if (!empty($campos_order_select)) 
   { 
       if (!empty($nmgp_order_by)) 
       { 
          $nmgp_order_by .= ", " . $campos_order_select; 
       } 
       else 
       { 
          $nmgp_order_by = " order by $campos_order_select"; 
       } 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf" || isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['paginacao']))
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
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
       $this->evento_adverso_id_evento_adverso = $this->rs_grid->fields[0] ;  
       $this->evento_adverso_id_evento_adverso = (string)$this->evento_adverso_id_evento_adverso;
       $this->evento_adverso_pais = $this->rs_grid->fields[1] ;  
       $this->evento_adverso_tipo_reporte = $this->rs_grid->fields[2] ;  
       $this->evento_adverso_fecha_staff = $this->rs_grid->fields[3] ;  
       $this->evento_adverso_producto = $this->rs_grid->fields[4] ;  
       $this->evento_adverso_ciudad = $this->rs_grid->fields[5] ;  
       $this->evento_adverso_genero = $this->rs_grid->fields[6] ;  
       $this->evento_adverso_fecha_nacimiento = $this->rs_grid->fields[7] ;  
       $this->evento_adverso_embarazo = $this->rs_grid->fields[8] ;  
       $this->evento_adverso_fecha_parto = $this->rs_grid->fields[9] ;  
       $this->evento_adverso_desenlace = $this->rs_grid->fields[10] ;  
       $this->evento_adverso_cuales_desenlaces = $this->rs_grid->fields[11] ;  
       $this->evento_adverso_contacto_directo = $this->rs_grid->fields[12] ;  
       $this->evento_adverso_nombre_medico = $this->rs_grid->fields[13] ;  
       $this->evento_adverso_telefono_medico = $this->rs_grid->fields[14] ;  
       $this->evento_adverso_fax_medico = $this->rs_grid->fields[15] ;  
       $this->evento_adverso_email_medico = $this->rs_grid->fields[16] ;  
       $this->evento_adverso_indicacion1 = $this->rs_grid->fields[17] ;  
       $this->evento_adverso_formulacion1 = $this->rs_grid->fields[18] ;  
       $this->evento_adverso_regimen_dosis1 = $this->rs_grid->fields[19] ;  
       $this->evento_adverso_ruta_administracion1 = $this->rs_grid->fields[20] ;  
       $this->evento_adverso_numero_lote1 = $this->rs_grid->fields[21] ;  
       $this->evento_adverso_fecha_expiracion1 = $this->rs_grid->fields[22] ;  
       $this->evento_adverso_fecha_inicio1 = $this->rs_grid->fields[23] ;  
       $this->evento_adverso_tratamiento_continua1 = $this->rs_grid->fields[24] ;  
       $this->evento_adverso_indicacion2 = $this->rs_grid->fields[25] ;  
       $this->evento_adverso_formulacion2 = $this->rs_grid->fields[26] ;  
       $this->evento_adverso_regimen_dosis2 = $this->rs_grid->fields[27] ;  
       $this->evento_adverso_ruta_administracion2 = $this->rs_grid->fields[28] ;  
       $this->evento_adverso_numero_lote2 = $this->rs_grid->fields[29] ;  
       $this->evento_adverso_fecha_expiracion2 = $this->rs_grid->fields[30] ;  
       $this->evento_adverso_fecha_inicio2 = $this->rs_grid->fields[31] ;  
       $this->evento_adverso_tratamiento_continua2 = $this->rs_grid->fields[32] ;  
       $this->evento_adverso_indicacion3 = $this->rs_grid->fields[33] ;  
       $this->evento_adverso_formulacion3 = $this->rs_grid->fields[34] ;  
       $this->evento_adverso_regimen_dosis3 = $this->rs_grid->fields[35] ;  
       $this->evento_adverso_ruta_administracion3 = $this->rs_grid->fields[36] ;  
       $this->evento_adverso_numero_lote3 = $this->rs_grid->fields[37] ;  
       $this->evento_adverso_fecha_expiracion3 = $this->rs_grid->fields[38] ;  
       $this->evento_adverso_fecha_inicio3 = $this->rs_grid->fields[39] ;  
       $this->evento_adverso_tratamiento_continua3 = $this->rs_grid->fields[40] ;  
       $this->evento_adverso_muestra_disponible = $this->rs_grid->fields[41] ;  
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
       { 
           $this->evento_adverso_informacion_muestra = "";  
           if (is_file($this->rs_grid->fields[42])) 
           { 
               $this->evento_adverso_informacion_muestra = file_get_contents($this->rs_grid->fields[42]);  
           } 
       } 
       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
       { 
           $this->evento_adverso_informacion_muestra = $this->Db->BlobDecode($this->rs_grid->fields[42]) ;  
       } 
       else
       { 
           $this->evento_adverso_informacion_muestra = $this->rs_grid->fields[42] ;  
       } 
       $this->evento_adverso_relacion_medicamento1 = $this->rs_grid->fields[43] ;  
       $this->evento_adverso_relacionado_dispositivo1 = $this->rs_grid->fields[44] ;  
       $this->evento_adverso_fecha_inicio_evento1 = $this->rs_grid->fields[45] ;  
       $this->evento_adverso_desenlace1 = $this->rs_grid->fields[46] ;  
       $this->evento_adverso_fecha_recuperacion1 = $this->rs_grid->fields[47] ;  
       $this->evento_adverso_fecha_muerte1 = $this->rs_grid->fields[48] ;  
       $this->evento_adverso_criterio_seriedad1 = $this->rs_grid->fields[49] ;  
       $this->evento_adverso_criterio_seriedad_muerte1 = $this->rs_grid->fields[50] ;  
       $this->evento_adverso_criterio_seriedad_hospitalizacion1 = $this->rs_grid->fields[51] ;  
       $this->evento_adverso_criterio_seriedad_amenaza1 = $this->rs_grid->fields[52] ;  
       $this->evento_adverso_criterio_seriedad_incapacidad1 = $this->rs_grid->fields[53] ;  
       $this->evento_adverso_criterio_seriedad_anormalidad1 = $this->rs_grid->fields[54] ;  
       $this->evento_adverso_criterio_seriedad_evento1 = $this->rs_grid->fields[55] ;  
       $this->evento_adverso_criterio_seriedad_quirurgica1 = $this->rs_grid->fields[56] ;  
       $this->evento_adverso_causa_muerte1 = $this->rs_grid->fields[57] ;  
       $this->evento_adverso_detalles_ea1 = $this->rs_grid->fields[58] ;  
       $this->evento_adverso_relacion_medicamento2 = $this->rs_grid->fields[59] ;  
       $this->evento_adverso_relacionado_dispositivo2 = $this->rs_grid->fields[60] ;  
       $this->evento_adverso_fecha_inicio_evento2 = $this->rs_grid->fields[61] ;  
       $this->evento_adverso_desenlace2 = $this->rs_grid->fields[62] ;  
       $this->evento_adverso_fecha_recuperacion2 = $this->rs_grid->fields[63] ;  
       $this->evento_adverso_fecha_muerte2 = $this->rs_grid->fields[64] ;  
       $this->evento_adverso_criterio_seriedad2 = $this->rs_grid->fields[65] ;  
       $this->evento_adverso_criterio_seriedad_muerte2 = $this->rs_grid->fields[66] ;  
       $this->evento_adverso_criterio_seriedad_hospitalizacion2 = $this->rs_grid->fields[67] ;  
       $this->evento_adverso_criterio_seriedad_amenaza2 = $this->rs_grid->fields[68] ;  
       $this->evento_adverso_criterio_seriedad_incapacidad2 = $this->rs_grid->fields[69] ;  
       $this->evento_adverso_criterio_seriedad_anormalidad2 = $this->rs_grid->fields[70] ;  
       $this->evento_adverso_criterio_seriedad_evento2 = $this->rs_grid->fields[71] ;  
       $this->evento_adverso_criterio_seriedad_quirurgica2 = $this->rs_grid->fields[72] ;  
       $this->evento_adverso_causa_muerte2 = $this->rs_grid->fields[73] ;  
       $this->evento_adverso_detalles_ea2 = $this->rs_grid->fields[74] ;  
       $this->evento_adverso_relacion_medicamento3 = $this->rs_grid->fields[75] ;  
       $this->evento_adverso_relacionado_dispositivo3 = $this->rs_grid->fields[76] ;  
       $this->evento_adverso_fecha_inicio_evento3 = $this->rs_grid->fields[77] ;  
       $this->evento_adverso_desenlace3 = $this->rs_grid->fields[78] ;  
       $this->evento_adverso_fecha_recuperacion3 = $this->rs_grid->fields[79] ;  
       $this->evento_adverso_fecha_muerte3 = $this->rs_grid->fields[80] ;  
       $this->evento_adverso_criterio_seriedad3 = $this->rs_grid->fields[81] ;  
       $this->evento_adverso_criterio_seriedad_muerte3 = $this->rs_grid->fields[82] ;  
       $this->evento_adverso_criterio_seriedad_hospitalizacion3 = $this->rs_grid->fields[83] ;  
       $this->evento_adverso_criterio_seriedad_amenaza3 = $this->rs_grid->fields[84] ;  
       $this->evento_adverso_criterio_seriedad_incapacidad3 = $this->rs_grid->fields[85] ;  
       $this->evento_adverso_criterio_seriedad_anormalidad3 = $this->rs_grid->fields[86] ;  
       $this->evento_adverso_criterio_seriedad_evento3 = $this->rs_grid->fields[87] ;  
       $this->evento_adverso_criterio_seriedad_quirurgica3 = $this->rs_grid->fields[88] ;  
       $this->evento_adverso_causa_muerte3 = $this->rs_grid->fields[89] ;  
       $this->evento_adverso_detalles_ea3 = $this->rs_grid->fields[90] ;  
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
       { 
           $this->evento_adverso_informacion_adicional = "";  
           if (is_file($this->rs_grid->fields[91])) 
           { 
               $this->evento_adverso_informacion_adicional = file_get_contents($this->rs_grid->fields[91]);  
           } 
       } 
       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
       { 
           $this->evento_adverso_informacion_adicional = $this->Db->BlobDecode($this->rs_grid->fields[91]) ;  
       } 
       else
       { 
           $this->evento_adverso_informacion_adicional = $this->rs_grid->fields[91] ;  
       } 
       $this->evento_adverso_nombre_reporte = $this->rs_grid->fields[92] ;  
       $this->evento_adverso_id_paciente_fk = $this->rs_grid->fields[93] ;  
       $this->evento_adverso_id_paciente_fk = (string)$this->evento_adverso_id_paciente_fk;
       $this->evento_adverso_medicamento1 = $this->rs_grid->fields[94] ;  
       $this->evento_adverso_medicamento2 = $this->rs_grid->fields[95] ;  
       $this->evento_adverso_medicamento3 = $this->rs_grid->fields[96] ;  
       $this->evento_adverso_informacion_ea1 = $this->rs_grid->fields[97] ;  
       $this->evento_adverso_informacion_ea2 = $this->rs_grid->fields[98] ;  
       $this->evento_adverso_informacion_ea3 = $this->rs_grid->fields[99] ;  
       $this->evento_adverso_fecha_suspencion1 = $this->rs_grid->fields[100] ;  
       $this->evento_adverso_fecha_suspencion2 = $this->rs_grid->fields[101] ;  
       $this->evento_adverso_fecha_suspencion3 = $this->rs_grid->fields[102] ;  
       $this->evento_adverso_fecha_evento_adverso = $this->rs_grid->fields[103] ;  
       $this->evento_adverso_nombre_reportante_primario = $this->rs_grid->fields[104] ;  
       $this->evento_adverso_telefono_reportante_primario = $this->rs_grid->fields[105] ;  
       $this->evento_adverso_tipo_reportante = $this->rs_grid->fields[106] ;  
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
       { 
           if (!empty($this->evento_adverso_informacion_muestra))
           { 
               $this->evento_adverso_informacion_muestra = $this->Db->BlobDecode($this->evento_adverso_informacion_muestra, false, true, "BLOB");
           }
           if (!empty($this->evento_adverso_informacion_adicional))
           { 
               $this->evento_adverso_informacion_adicional = $this->Db->BlobDecode($this->evento_adverso_informacion_adicional, false, true, "BLOB");
           }
       }
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $this->SC_sep_quebra = false;
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->evento_adverso_id_evento_adverso = $this->rs_grid->fields[0] ;  
           $this->evento_adverso_pais = $this->rs_grid->fields[1] ;  
           $this->evento_adverso_tipo_reporte = $this->rs_grid->fields[2] ;  
           $this->evento_adverso_fecha_staff = $this->rs_grid->fields[3] ;  
           $this->evento_adverso_producto = $this->rs_grid->fields[4] ;  
           $this->evento_adverso_ciudad = $this->rs_grid->fields[5] ;  
           $this->evento_adverso_genero = $this->rs_grid->fields[6] ;  
           $this->evento_adverso_fecha_nacimiento = $this->rs_grid->fields[7] ;  
           $this->evento_adverso_embarazo = $this->rs_grid->fields[8] ;  
           $this->evento_adverso_fecha_parto = $this->rs_grid->fields[9] ;  
           $this->evento_adverso_desenlace = $this->rs_grid->fields[10] ;  
           $this->evento_adverso_cuales_desenlaces = $this->rs_grid->fields[11] ;  
           $this->evento_adverso_contacto_directo = $this->rs_grid->fields[12] ;  
           $this->evento_adverso_nombre_medico = $this->rs_grid->fields[13] ;  
           $this->evento_adverso_telefono_medico = $this->rs_grid->fields[14] ;  
           $this->evento_adverso_fax_medico = $this->rs_grid->fields[15] ;  
           $this->evento_adverso_email_medico = $this->rs_grid->fields[16] ;  
           $this->evento_adverso_indicacion1 = $this->rs_grid->fields[17] ;  
           $this->evento_adverso_formulacion1 = $this->rs_grid->fields[18] ;  
           $this->evento_adverso_regimen_dosis1 = $this->rs_grid->fields[19] ;  
           $this->evento_adverso_ruta_administracion1 = $this->rs_grid->fields[20] ;  
           $this->evento_adverso_numero_lote1 = $this->rs_grid->fields[21] ;  
           $this->evento_adverso_fecha_expiracion1 = $this->rs_grid->fields[22] ;  
           $this->evento_adverso_fecha_inicio1 = $this->rs_grid->fields[23] ;  
           $this->evento_adverso_tratamiento_continua1 = $this->rs_grid->fields[24] ;  
           $this->evento_adverso_indicacion2 = $this->rs_grid->fields[25] ;  
           $this->evento_adverso_formulacion2 = $this->rs_grid->fields[26] ;  
           $this->evento_adverso_regimen_dosis2 = $this->rs_grid->fields[27] ;  
           $this->evento_adverso_ruta_administracion2 = $this->rs_grid->fields[28] ;  
           $this->evento_adverso_numero_lote2 = $this->rs_grid->fields[29] ;  
           $this->evento_adverso_fecha_expiracion2 = $this->rs_grid->fields[30] ;  
           $this->evento_adverso_fecha_inicio2 = $this->rs_grid->fields[31] ;  
           $this->evento_adverso_tratamiento_continua2 = $this->rs_grid->fields[32] ;  
           $this->evento_adverso_indicacion3 = $this->rs_grid->fields[33] ;  
           $this->evento_adverso_formulacion3 = $this->rs_grid->fields[34] ;  
           $this->evento_adverso_regimen_dosis3 = $this->rs_grid->fields[35] ;  
           $this->evento_adverso_ruta_administracion3 = $this->rs_grid->fields[36] ;  
           $this->evento_adverso_numero_lote3 = $this->rs_grid->fields[37] ;  
           $this->evento_adverso_fecha_expiracion3 = $this->rs_grid->fields[38] ;  
           $this->evento_adverso_fecha_inicio3 = $this->rs_grid->fields[39] ;  
           $this->evento_adverso_tratamiento_continua3 = $this->rs_grid->fields[40] ;  
           $this->evento_adverso_muestra_disponible = $this->rs_grid->fields[41] ;  
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
           { 
               $this->evento_adverso_informacion_muestra = "";  
               if (is_file($this->rs_grid->fields[42])) 
               { 
                   $this->evento_adverso_informacion_muestra = file_get_contents($this->rs_grid->fields[42]);  
               } 
           } 
           elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
           { 
               $this->evento_adverso_informacion_muestra = $this->Db->BlobDecode($this->rs_grid->fields[42]) ;  
           } 
           else
           { 
               $this->evento_adverso_informacion_muestra = $this->rs_grid->fields[42] ;  
           } 
           $this->evento_adverso_relacion_medicamento1 = $this->rs_grid->fields[43] ;  
           $this->evento_adverso_relacionado_dispositivo1 = $this->rs_grid->fields[44] ;  
           $this->evento_adverso_fecha_inicio_evento1 = $this->rs_grid->fields[45] ;  
           $this->evento_adverso_desenlace1 = $this->rs_grid->fields[46] ;  
           $this->evento_adverso_fecha_recuperacion1 = $this->rs_grid->fields[47] ;  
           $this->evento_adverso_fecha_muerte1 = $this->rs_grid->fields[48] ;  
           $this->evento_adverso_criterio_seriedad1 = $this->rs_grid->fields[49] ;  
           $this->evento_adverso_criterio_seriedad_muerte1 = $this->rs_grid->fields[50] ;  
           $this->evento_adverso_criterio_seriedad_hospitalizacion1 = $this->rs_grid->fields[51] ;  
           $this->evento_adverso_criterio_seriedad_amenaza1 = $this->rs_grid->fields[52] ;  
           $this->evento_adverso_criterio_seriedad_incapacidad1 = $this->rs_grid->fields[53] ;  
           $this->evento_adverso_criterio_seriedad_anormalidad1 = $this->rs_grid->fields[54] ;  
           $this->evento_adverso_criterio_seriedad_evento1 = $this->rs_grid->fields[55] ;  
           $this->evento_adverso_criterio_seriedad_quirurgica1 = $this->rs_grid->fields[56] ;  
           $this->evento_adverso_causa_muerte1 = $this->rs_grid->fields[57] ;  
           $this->evento_adverso_detalles_ea1 = $this->rs_grid->fields[58] ;  
           $this->evento_adverso_relacion_medicamento2 = $this->rs_grid->fields[59] ;  
           $this->evento_adverso_relacionado_dispositivo2 = $this->rs_grid->fields[60] ;  
           $this->evento_adverso_fecha_inicio_evento2 = $this->rs_grid->fields[61] ;  
           $this->evento_adverso_desenlace2 = $this->rs_grid->fields[62] ;  
           $this->evento_adverso_fecha_recuperacion2 = $this->rs_grid->fields[63] ;  
           $this->evento_adverso_fecha_muerte2 = $this->rs_grid->fields[64] ;  
           $this->evento_adverso_criterio_seriedad2 = $this->rs_grid->fields[65] ;  
           $this->evento_adverso_criterio_seriedad_muerte2 = $this->rs_grid->fields[66] ;  
           $this->evento_adverso_criterio_seriedad_hospitalizacion2 = $this->rs_grid->fields[67] ;  
           $this->evento_adverso_criterio_seriedad_amenaza2 = $this->rs_grid->fields[68] ;  
           $this->evento_adverso_criterio_seriedad_incapacidad2 = $this->rs_grid->fields[69] ;  
           $this->evento_adverso_criterio_seriedad_anormalidad2 = $this->rs_grid->fields[70] ;  
           $this->evento_adverso_criterio_seriedad_evento2 = $this->rs_grid->fields[71] ;  
           $this->evento_adverso_criterio_seriedad_quirurgica2 = $this->rs_grid->fields[72] ;  
           $this->evento_adverso_causa_muerte2 = $this->rs_grid->fields[73] ;  
           $this->evento_adverso_detalles_ea2 = $this->rs_grid->fields[74] ;  
           $this->evento_adverso_relacion_medicamento3 = $this->rs_grid->fields[75] ;  
           $this->evento_adverso_relacionado_dispositivo3 = $this->rs_grid->fields[76] ;  
           $this->evento_adverso_fecha_inicio_evento3 = $this->rs_grid->fields[77] ;  
           $this->evento_adverso_desenlace3 = $this->rs_grid->fields[78] ;  
           $this->evento_adverso_fecha_recuperacion3 = $this->rs_grid->fields[79] ;  
           $this->evento_adverso_fecha_muerte3 = $this->rs_grid->fields[80] ;  
           $this->evento_adverso_criterio_seriedad3 = $this->rs_grid->fields[81] ;  
           $this->evento_adverso_criterio_seriedad_muerte3 = $this->rs_grid->fields[82] ;  
           $this->evento_adverso_criterio_seriedad_hospitalizacion3 = $this->rs_grid->fields[83] ;  
           $this->evento_adverso_criterio_seriedad_amenaza3 = $this->rs_grid->fields[84] ;  
           $this->evento_adverso_criterio_seriedad_incapacidad3 = $this->rs_grid->fields[85] ;  
           $this->evento_adverso_criterio_seriedad_anormalidad3 = $this->rs_grid->fields[86] ;  
           $this->evento_adverso_criterio_seriedad_evento3 = $this->rs_grid->fields[87] ;  
           $this->evento_adverso_criterio_seriedad_quirurgica3 = $this->rs_grid->fields[88] ;  
           $this->evento_adverso_causa_muerte3 = $this->rs_grid->fields[89] ;  
           $this->evento_adverso_detalles_ea3 = $this->rs_grid->fields[90] ;  
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
           { 
               $this->evento_adverso_informacion_adicional = "";  
               if (is_file($this->rs_grid->fields[91])) 
               { 
                   $this->evento_adverso_informacion_adicional = file_get_contents($this->rs_grid->fields[91]);  
               } 
           } 
           elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
           { 
               $this->evento_adverso_informacion_adicional = $this->Db->BlobDecode($this->rs_grid->fields[91]) ;  
           } 
           else
           { 
               $this->evento_adverso_informacion_adicional = $this->rs_grid->fields[91] ;  
           } 
           $this->evento_adverso_nombre_reporte = $this->rs_grid->fields[92] ;  
           $this->evento_adverso_id_paciente_fk = $this->rs_grid->fields[93] ;  
           $this->evento_adverso_medicamento1 = $this->rs_grid->fields[94] ;  
           $this->evento_adverso_medicamento2 = $this->rs_grid->fields[95] ;  
           $this->evento_adverso_medicamento3 = $this->rs_grid->fields[96] ;  
           $this->evento_adverso_informacion_ea1 = $this->rs_grid->fields[97] ;  
           $this->evento_adverso_informacion_ea2 = $this->rs_grid->fields[98] ;  
           $this->evento_adverso_informacion_ea3 = $this->rs_grid->fields[99] ;  
           $this->evento_adverso_fecha_suspencion1 = $this->rs_grid->fields[100] ;  
           $this->evento_adverso_fecha_suspencion2 = $this->rs_grid->fields[101] ;  
           $this->evento_adverso_fecha_suspencion3 = $this->rs_grid->fields[102] ;  
           $this->evento_adverso_fecha_evento_adverso = $this->rs_grid->fields[103] ;  
           $this->evento_adverso_nombre_reportante_primario = $this->rs_grid->fields[104] ;  
           $this->evento_adverso_telefono_reportante_primario = $this->rs_grid->fields[105] ;  
           $this->evento_adverso_tipo_reportante = $this->rs_grid->fields[106] ;  
       } 
   } 
   $this->nmgp_reg_inicial = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final'] + 1;
   $this->nmgp_reg_final   = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid'];
   $this->nmgp_reg_final   = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> -  :: PDF</TITLE>
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
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['pivot_charts']) : 0;
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
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
       $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - </TITLE>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
           $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"EA_jquery.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"EA_ajax.js\"></script>\r\n");
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
           $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid']) . ";\r\n");
           $nm_saida->saida("  function scSetFixedHeaders() {\r\n");
           $nm_saida->saida("   var divScroll, gridHeaders, headerPlaceholder;\r\n");
           $nm_saida->saida("   gridHeaders = $(\".sc-ui-grid-header-row-EA-1\");\r\n");
           $nm_saida->saida("   headerPlaceholder = $(\"#sc-id-fixedheaders-placeholder\");\r\n");
           $nm_saida->saida("   scSetFixedHeadersContents(gridHeaders, headerPlaceholder);\r\n");
           $nm_saida->saida("   scSetFixedHeadersSize(gridHeaders);\r\n");
           $nm_saida->saida("   scSetFixedHeadersPosition(gridHeaders, headerPlaceholder);\r\n");
           $nm_saida->saida("   if (scIsHeaderVisible(gridHeaders)) {\r\n");
           $nm_saida->saida("    headerPlaceholder.hide();\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   else {\r\n");
           $nm_saida->saida("    headerPlaceholder.show();\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scSetFixedHeadersPosition(gridHeaders, headerPlaceholder) {\r\n");
           $nm_saida->saida("   headerPlaceholder.css({\"top\": \"0\", \"left\": (Math.floor(gridHeaders.position().left) - $(document).scrollLeft()) + \"px\"});\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scIsHeaderVisible(gridHeaders) {\r\n");
           $nm_saida->saida("   return gridHeaders.offset().top > $(document).scrollTop();\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scSetFixedHeadersContents(gridHeaders, headerPlaceholder) {\r\n");
           $nm_saida->saida("   var i, htmlContent;\r\n");
           $nm_saida->saida("   htmlContent = \"<table id=\\\"sc-id-fixed-headers\\\" class=\\\"scGridTabela\\\">\";\r\n");
           $nm_saida->saida("   for (i = 0; i < gridHeaders.length; i++) {\r\n");
           $nm_saida->saida("    htmlContent += \"<tr class=\\\"scGridLabel\\\" id=\\\"sc-id-fixed-headers-row-\" + i + \"\\\">\" + $(gridHeaders[i]).html() + \"</tr>\";\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   htmlContent += \"</table>\";\r\n");
           $nm_saida->saida("   headerPlaceholder.html(htmlContent);\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scSetFixedHeadersSize(gridHeaders) {\r\n");
           $nm_saida->saida("   var i, j, headerColumns, gridColumns, cellHeight, cellWidth, tableOriginal, tableHeaders;\r\n");
           $nm_saida->saida("   tableOriginal = $(\"#sc-ui-grid-body-01ca8eae\");\r\n");
           $nm_saida->saida("   tableHeaders = document.getElementById(\"sc-id-fixed-headers\");\r\n");
           $nm_saida->saida("   $(tableHeaders).css(\"width\", $(tableOriginal).outerWidth());\r\n");
           $nm_saida->saida("   for (i = 0; i < gridHeaders.length; i++) {\r\n");
           $nm_saida->saida("    headerColumns = $(\"#sc-id-fixed-headers-row-\" + i).find(\"td\");\r\n");
           $nm_saida->saida("    gridColumns = $(gridHeaders[i]).find(\"td\");\r\n");
           $nm_saida->saida("    for (j = 0; j < gridColumns.length; j++) {\r\n");
           $nm_saida->saida("     if (window.getComputedStyle(gridColumns[j])) {\r\n");
           $nm_saida->saida("      cellWidth = window.getComputedStyle(gridColumns[j]).width;\r\n");
           $nm_saida->saida("      cellHeight = window.getComputedStyle(gridColumns[j]).height;\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     else {\r\n");
           $nm_saida->saida("      cellWidth = $(gridColumns[j]).width() + \"px\";\r\n");
           $nm_saida->saida("      cellHeight = $(gridColumns[j]).height() + \"px\";\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $(headerColumns[j]).css({\r\n");
           $nm_saida->saida("      \"width\": cellWidth,\r\n");
           $nm_saida->saida("      \"height\": cellHeight\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function SC_init_jquery(isScrollNav){ \r\n");
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
           $nm_saida->saida("  SC_init_jquery(false);\r\n");
           $nm_saida->saida("   \$(window).load(function() {\r\n");
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ancor_save']);
           }
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
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_EA_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
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
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_EA_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['num_css'] . '.css');
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_EA_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
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
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "EA/EA_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "EA/EA_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
           $nm_saida->saida("  </style>\r\n");
       }
       $nm_saida->saida("  </HEAD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "EA/EA_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $cada_css = ".EA_" . substr($cada_css, 1);
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
       $nm_saida->saida("  <body class=\"" . $this->css_scGridPage . "\" " . $str_iframe_body . " style=\"" . $css_body . "\">\r\n");
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none; position: absolute; left: 50px; top: 50px\"><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf" && !$this->Print_All)
       { 
           $nm_saida->saida("      <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = "";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['doc_word'])
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
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   {
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['EA']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['EA']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['EA']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['EA']) . "_";
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

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida']) ? "EA_" : "";
   $this->css_sep = " ";
   $this->css_evento_adverso_id_evento_adverso_label = $compl_css_emb . "css_evento_adverso_id_evento_adverso_label";
   $this->css_evento_adverso_id_evento_adverso_grid_line = $compl_css_emb . "css_evento_adverso_id_evento_adverso_grid_line";
   $this->css_evento_adverso_pais_label = $compl_css_emb . "css_evento_adverso_pais_label";
   $this->css_evento_adverso_pais_grid_line = $compl_css_emb . "css_evento_adverso_pais_grid_line";
   $this->css_evento_adverso_tipo_reporte_label = $compl_css_emb . "css_evento_adverso_tipo_reporte_label";
   $this->css_evento_adverso_tipo_reporte_grid_line = $compl_css_emb . "css_evento_adverso_tipo_reporte_grid_line";
   $this->css_evento_adverso_fecha_staff_label = $compl_css_emb . "css_evento_adverso_fecha_staff_label";
   $this->css_evento_adverso_fecha_staff_grid_line = $compl_css_emb . "css_evento_adverso_fecha_staff_grid_line";
   $this->css_evento_adverso_producto_label = $compl_css_emb . "css_evento_adverso_producto_label";
   $this->css_evento_adverso_producto_grid_line = $compl_css_emb . "css_evento_adverso_producto_grid_line";
   $this->css_evento_adverso_ciudad_label = $compl_css_emb . "css_evento_adverso_ciudad_label";
   $this->css_evento_adverso_ciudad_grid_line = $compl_css_emb . "css_evento_adverso_ciudad_grid_line";
   $this->css_evento_adverso_genero_label = $compl_css_emb . "css_evento_adverso_genero_label";
   $this->css_evento_adverso_genero_grid_line = $compl_css_emb . "css_evento_adverso_genero_grid_line";
   $this->css_evento_adverso_fecha_nacimiento_label = $compl_css_emb . "css_evento_adverso_fecha_nacimiento_label";
   $this->css_evento_adverso_fecha_nacimiento_grid_line = $compl_css_emb . "css_evento_adverso_fecha_nacimiento_grid_line";
   $this->css_evento_adverso_embarazo_label = $compl_css_emb . "css_evento_adverso_embarazo_label";
   $this->css_evento_adverso_embarazo_grid_line = $compl_css_emb . "css_evento_adverso_embarazo_grid_line";
   $this->css_evento_adverso_fecha_parto_label = $compl_css_emb . "css_evento_adverso_fecha_parto_label";
   $this->css_evento_adverso_fecha_parto_grid_line = $compl_css_emb . "css_evento_adverso_fecha_parto_grid_line";
   $this->css_evento_adverso_desenlace_label = $compl_css_emb . "css_evento_adverso_desenlace_label";
   $this->css_evento_adverso_desenlace_grid_line = $compl_css_emb . "css_evento_adverso_desenlace_grid_line";
   $this->css_evento_adverso_cuales_desenlaces_label = $compl_css_emb . "css_evento_adverso_cuales_desenlaces_label";
   $this->css_evento_adverso_cuales_desenlaces_grid_line = $compl_css_emb . "css_evento_adverso_cuales_desenlaces_grid_line";
   $this->css_evento_adverso_contacto_directo_label = $compl_css_emb . "css_evento_adverso_contacto_directo_label";
   $this->css_evento_adverso_contacto_directo_grid_line = $compl_css_emb . "css_evento_adverso_contacto_directo_grid_line";
   $this->css_evento_adverso_nombre_medico_label = $compl_css_emb . "css_evento_adverso_nombre_medico_label";
   $this->css_evento_adverso_nombre_medico_grid_line = $compl_css_emb . "css_evento_adverso_nombre_medico_grid_line";
   $this->css_evento_adverso_telefono_medico_label = $compl_css_emb . "css_evento_adverso_telefono_medico_label";
   $this->css_evento_adverso_telefono_medico_grid_line = $compl_css_emb . "css_evento_adverso_telefono_medico_grid_line";
   $this->css_evento_adverso_fax_medico_label = $compl_css_emb . "css_evento_adverso_fax_medico_label";
   $this->css_evento_adverso_fax_medico_grid_line = $compl_css_emb . "css_evento_adverso_fax_medico_grid_line";
   $this->css_evento_adverso_email_medico_label = $compl_css_emb . "css_evento_adverso_email_medico_label";
   $this->css_evento_adverso_email_medico_grid_line = $compl_css_emb . "css_evento_adverso_email_medico_grid_line";
   $this->css_evento_adverso_indicacion1_label = $compl_css_emb . "css_evento_adverso_indicacion1_label";
   $this->css_evento_adverso_indicacion1_grid_line = $compl_css_emb . "css_evento_adverso_indicacion1_grid_line";
   $this->css_evento_adverso_formulacion1_label = $compl_css_emb . "css_evento_adverso_formulacion1_label";
   $this->css_evento_adverso_formulacion1_grid_line = $compl_css_emb . "css_evento_adverso_formulacion1_grid_line";
   $this->css_evento_adverso_regimen_dosis1_label = $compl_css_emb . "css_evento_adverso_regimen_dosis1_label";
   $this->css_evento_adverso_regimen_dosis1_grid_line = $compl_css_emb . "css_evento_adverso_regimen_dosis1_grid_line";
   $this->css_evento_adverso_ruta_administracion1_label = $compl_css_emb . "css_evento_adverso_ruta_administracion1_label";
   $this->css_evento_adverso_ruta_administracion1_grid_line = $compl_css_emb . "css_evento_adverso_ruta_administracion1_grid_line";
   $this->css_evento_adverso_numero_lote1_label = $compl_css_emb . "css_evento_adverso_numero_lote1_label";
   $this->css_evento_adverso_numero_lote1_grid_line = $compl_css_emb . "css_evento_adverso_numero_lote1_grid_line";
   $this->css_evento_adverso_fecha_expiracion1_label = $compl_css_emb . "css_evento_adverso_fecha_expiracion1_label";
   $this->css_evento_adverso_fecha_expiracion1_grid_line = $compl_css_emb . "css_evento_adverso_fecha_expiracion1_grid_line";
   $this->css_evento_adverso_fecha_inicio1_label = $compl_css_emb . "css_evento_adverso_fecha_inicio1_label";
   $this->css_evento_adverso_fecha_inicio1_grid_line = $compl_css_emb . "css_evento_adverso_fecha_inicio1_grid_line";
   $this->css_evento_adverso_tratamiento_continua1_label = $compl_css_emb . "css_evento_adverso_tratamiento_continua1_label";
   $this->css_evento_adverso_tratamiento_continua1_grid_line = $compl_css_emb . "css_evento_adverso_tratamiento_continua1_grid_line";
   $this->css_evento_adverso_indicacion2_label = $compl_css_emb . "css_evento_adverso_indicacion2_label";
   $this->css_evento_adverso_indicacion2_grid_line = $compl_css_emb . "css_evento_adverso_indicacion2_grid_line";
   $this->css_evento_adverso_formulacion2_label = $compl_css_emb . "css_evento_adverso_formulacion2_label";
   $this->css_evento_adverso_formulacion2_grid_line = $compl_css_emb . "css_evento_adverso_formulacion2_grid_line";
   $this->css_evento_adverso_regimen_dosis2_label = $compl_css_emb . "css_evento_adverso_regimen_dosis2_label";
   $this->css_evento_adverso_regimen_dosis2_grid_line = $compl_css_emb . "css_evento_adverso_regimen_dosis2_grid_line";
   $this->css_evento_adverso_ruta_administracion2_label = $compl_css_emb . "css_evento_adverso_ruta_administracion2_label";
   $this->css_evento_adverso_ruta_administracion2_grid_line = $compl_css_emb . "css_evento_adverso_ruta_administracion2_grid_line";
   $this->css_evento_adverso_numero_lote2_label = $compl_css_emb . "css_evento_adverso_numero_lote2_label";
   $this->css_evento_adverso_numero_lote2_grid_line = $compl_css_emb . "css_evento_adverso_numero_lote2_grid_line";
   $this->css_evento_adverso_fecha_expiracion2_label = $compl_css_emb . "css_evento_adverso_fecha_expiracion2_label";
   $this->css_evento_adverso_fecha_expiracion2_grid_line = $compl_css_emb . "css_evento_adverso_fecha_expiracion2_grid_line";
   $this->css_evento_adverso_fecha_inicio2_label = $compl_css_emb . "css_evento_adverso_fecha_inicio2_label";
   $this->css_evento_adverso_fecha_inicio2_grid_line = $compl_css_emb . "css_evento_adverso_fecha_inicio2_grid_line";
   $this->css_evento_adverso_tratamiento_continua2_label = $compl_css_emb . "css_evento_adverso_tratamiento_continua2_label";
   $this->css_evento_adverso_tratamiento_continua2_grid_line = $compl_css_emb . "css_evento_adverso_tratamiento_continua2_grid_line";
   $this->css_evento_adverso_indicacion3_label = $compl_css_emb . "css_evento_adverso_indicacion3_label";
   $this->css_evento_adverso_indicacion3_grid_line = $compl_css_emb . "css_evento_adverso_indicacion3_grid_line";
   $this->css_evento_adverso_formulacion3_label = $compl_css_emb . "css_evento_adverso_formulacion3_label";
   $this->css_evento_adverso_formulacion3_grid_line = $compl_css_emb . "css_evento_adverso_formulacion3_grid_line";
   $this->css_evento_adverso_regimen_dosis3_label = $compl_css_emb . "css_evento_adverso_regimen_dosis3_label";
   $this->css_evento_adverso_regimen_dosis3_grid_line = $compl_css_emb . "css_evento_adverso_regimen_dosis3_grid_line";
   $this->css_evento_adverso_ruta_administracion3_label = $compl_css_emb . "css_evento_adverso_ruta_administracion3_label";
   $this->css_evento_adverso_ruta_administracion3_grid_line = $compl_css_emb . "css_evento_adverso_ruta_administracion3_grid_line";
   $this->css_evento_adverso_numero_lote3_label = $compl_css_emb . "css_evento_adverso_numero_lote3_label";
   $this->css_evento_adverso_numero_lote3_grid_line = $compl_css_emb . "css_evento_adverso_numero_lote3_grid_line";
   $this->css_evento_adverso_fecha_expiracion3_label = $compl_css_emb . "css_evento_adverso_fecha_expiracion3_label";
   $this->css_evento_adverso_fecha_expiracion3_grid_line = $compl_css_emb . "css_evento_adverso_fecha_expiracion3_grid_line";
   $this->css_evento_adverso_fecha_inicio3_label = $compl_css_emb . "css_evento_adverso_fecha_inicio3_label";
   $this->css_evento_adverso_fecha_inicio3_grid_line = $compl_css_emb . "css_evento_adverso_fecha_inicio3_grid_line";
   $this->css_evento_adverso_tratamiento_continua3_label = $compl_css_emb . "css_evento_adverso_tratamiento_continua3_label";
   $this->css_evento_adverso_tratamiento_continua3_grid_line = $compl_css_emb . "css_evento_adverso_tratamiento_continua3_grid_line";
   $this->css_evento_adverso_muestra_disponible_label = $compl_css_emb . "css_evento_adverso_muestra_disponible_label";
   $this->css_evento_adverso_muestra_disponible_grid_line = $compl_css_emb . "css_evento_adverso_muestra_disponible_grid_line";
   $this->css_evento_adverso_informacion_muestra_label = $compl_css_emb . "css_evento_adverso_informacion_muestra_label";
   $this->css_evento_adverso_informacion_muestra_grid_line = $compl_css_emb . "css_evento_adverso_informacion_muestra_grid_line";
   $this->css_evento_adverso_relacion_medicamento1_label = $compl_css_emb . "css_evento_adverso_relacion_medicamento1_label";
   $this->css_evento_adverso_relacion_medicamento1_grid_line = $compl_css_emb . "css_evento_adverso_relacion_medicamento1_grid_line";
   $this->css_evento_adverso_relacionado_dispositivo1_label = $compl_css_emb . "css_evento_adverso_relacionado_dispositivo1_label";
   $this->css_evento_adverso_relacionado_dispositivo1_grid_line = $compl_css_emb . "css_evento_adverso_relacionado_dispositivo1_grid_line";
   $this->css_evento_adverso_fecha_inicio_evento1_label = $compl_css_emb . "css_evento_adverso_fecha_inicio_evento1_label";
   $this->css_evento_adverso_fecha_inicio_evento1_grid_line = $compl_css_emb . "css_evento_adverso_fecha_inicio_evento1_grid_line";
   $this->css_evento_adverso_desenlace1_label = $compl_css_emb . "css_evento_adverso_desenlace1_label";
   $this->css_evento_adverso_desenlace1_grid_line = $compl_css_emb . "css_evento_adverso_desenlace1_grid_line";
   $this->css_evento_adverso_fecha_recuperacion1_label = $compl_css_emb . "css_evento_adverso_fecha_recuperacion1_label";
   $this->css_evento_adverso_fecha_recuperacion1_grid_line = $compl_css_emb . "css_evento_adverso_fecha_recuperacion1_grid_line";
   $this->css_evento_adverso_fecha_muerte1_label = $compl_css_emb . "css_evento_adverso_fecha_muerte1_label";
   $this->css_evento_adverso_fecha_muerte1_grid_line = $compl_css_emb . "css_evento_adverso_fecha_muerte1_grid_line";
   $this->css_evento_adverso_criterio_seriedad1_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad1_label";
   $this->css_evento_adverso_criterio_seriedad1_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad1_grid_line";
   $this->css_evento_adverso_criterio_seriedad_muerte1_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_muerte1_label";
   $this->css_evento_adverso_criterio_seriedad_muerte1_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_muerte1_grid_line";
   $this->css_evento_adverso_criterio_seriedad_hospitalizacion1_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_hospitalizacion1_label";
   $this->css_evento_adverso_criterio_seriedad_hospitalizacion1_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_hospitalizacion1_grid_line";
   $this->css_evento_adverso_criterio_seriedad_amenaza1_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_amenaza1_label";
   $this->css_evento_adverso_criterio_seriedad_amenaza1_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_amenaza1_grid_line";
   $this->css_evento_adverso_criterio_seriedad_incapacidad1_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_incapacidad1_label";
   $this->css_evento_adverso_criterio_seriedad_incapacidad1_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_incapacidad1_grid_line";
   $this->css_evento_adverso_criterio_seriedad_anormalidad1_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_anormalidad1_label";
   $this->css_evento_adverso_criterio_seriedad_anormalidad1_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_anormalidad1_grid_line";
   $this->css_evento_adverso_criterio_seriedad_evento1_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_evento1_label";
   $this->css_evento_adverso_criterio_seriedad_evento1_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_evento1_grid_line";
   $this->css_evento_adverso_criterio_seriedad_quirurgica1_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_quirurgica1_label";
   $this->css_evento_adverso_criterio_seriedad_quirurgica1_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_quirurgica1_grid_line";
   $this->css_evento_adverso_causa_muerte1_label = $compl_css_emb . "css_evento_adverso_causa_muerte1_label";
   $this->css_evento_adverso_causa_muerte1_grid_line = $compl_css_emb . "css_evento_adverso_causa_muerte1_grid_line";
   $this->css_evento_adverso_detalles_ea1_label = $compl_css_emb . "css_evento_adverso_detalles_ea1_label";
   $this->css_evento_adverso_detalles_ea1_grid_line = $compl_css_emb . "css_evento_adverso_detalles_ea1_grid_line";
   $this->css_evento_adverso_relacion_medicamento2_label = $compl_css_emb . "css_evento_adverso_relacion_medicamento2_label";
   $this->css_evento_adverso_relacion_medicamento2_grid_line = $compl_css_emb . "css_evento_adverso_relacion_medicamento2_grid_line";
   $this->css_evento_adverso_relacionado_dispositivo2_label = $compl_css_emb . "css_evento_adverso_relacionado_dispositivo2_label";
   $this->css_evento_adverso_relacionado_dispositivo2_grid_line = $compl_css_emb . "css_evento_adverso_relacionado_dispositivo2_grid_line";
   $this->css_evento_adverso_fecha_inicio_evento2_label = $compl_css_emb . "css_evento_adverso_fecha_inicio_evento2_label";
   $this->css_evento_adverso_fecha_inicio_evento2_grid_line = $compl_css_emb . "css_evento_adverso_fecha_inicio_evento2_grid_line";
   $this->css_evento_adverso_desenlace2_label = $compl_css_emb . "css_evento_adverso_desenlace2_label";
   $this->css_evento_adverso_desenlace2_grid_line = $compl_css_emb . "css_evento_adverso_desenlace2_grid_line";
   $this->css_evento_adverso_fecha_recuperacion2_label = $compl_css_emb . "css_evento_adverso_fecha_recuperacion2_label";
   $this->css_evento_adverso_fecha_recuperacion2_grid_line = $compl_css_emb . "css_evento_adverso_fecha_recuperacion2_grid_line";
   $this->css_evento_adverso_fecha_muerte2_label = $compl_css_emb . "css_evento_adverso_fecha_muerte2_label";
   $this->css_evento_adverso_fecha_muerte2_grid_line = $compl_css_emb . "css_evento_adverso_fecha_muerte2_grid_line";
   $this->css_evento_adverso_criterio_seriedad2_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad2_label";
   $this->css_evento_adverso_criterio_seriedad2_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad2_grid_line";
   $this->css_evento_adverso_criterio_seriedad_muerte2_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_muerte2_label";
   $this->css_evento_adverso_criterio_seriedad_muerte2_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_muerte2_grid_line";
   $this->css_evento_adverso_criterio_seriedad_hospitalizacion2_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_hospitalizacion2_label";
   $this->css_evento_adverso_criterio_seriedad_hospitalizacion2_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_hospitalizacion2_grid_line";
   $this->css_evento_adverso_criterio_seriedad_amenaza2_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_amenaza2_label";
   $this->css_evento_adverso_criterio_seriedad_amenaza2_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_amenaza2_grid_line";
   $this->css_evento_adverso_criterio_seriedad_incapacidad2_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_incapacidad2_label";
   $this->css_evento_adverso_criterio_seriedad_incapacidad2_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_incapacidad2_grid_line";
   $this->css_evento_adverso_criterio_seriedad_anormalidad2_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_anormalidad2_label";
   $this->css_evento_adverso_criterio_seriedad_anormalidad2_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_anormalidad2_grid_line";
   $this->css_evento_adverso_criterio_seriedad_evento2_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_evento2_label";
   $this->css_evento_adverso_criterio_seriedad_evento2_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_evento2_grid_line";
   $this->css_evento_adverso_criterio_seriedad_quirurgica2_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_quirurgica2_label";
   $this->css_evento_adverso_criterio_seriedad_quirurgica2_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_quirurgica2_grid_line";
   $this->css_evento_adverso_causa_muerte2_label = $compl_css_emb . "css_evento_adverso_causa_muerte2_label";
   $this->css_evento_adverso_causa_muerte2_grid_line = $compl_css_emb . "css_evento_adverso_causa_muerte2_grid_line";
   $this->css_evento_adverso_detalles_ea2_label = $compl_css_emb . "css_evento_adverso_detalles_ea2_label";
   $this->css_evento_adverso_detalles_ea2_grid_line = $compl_css_emb . "css_evento_adverso_detalles_ea2_grid_line";
   $this->css_evento_adverso_relacion_medicamento3_label = $compl_css_emb . "css_evento_adverso_relacion_medicamento3_label";
   $this->css_evento_adverso_relacion_medicamento3_grid_line = $compl_css_emb . "css_evento_adverso_relacion_medicamento3_grid_line";
   $this->css_evento_adverso_relacionado_dispositivo3_label = $compl_css_emb . "css_evento_adverso_relacionado_dispositivo3_label";
   $this->css_evento_adverso_relacionado_dispositivo3_grid_line = $compl_css_emb . "css_evento_adverso_relacionado_dispositivo3_grid_line";
   $this->css_evento_adverso_fecha_inicio_evento3_label = $compl_css_emb . "css_evento_adverso_fecha_inicio_evento3_label";
   $this->css_evento_adverso_fecha_inicio_evento3_grid_line = $compl_css_emb . "css_evento_adverso_fecha_inicio_evento3_grid_line";
   $this->css_evento_adverso_desenlace3_label = $compl_css_emb . "css_evento_adverso_desenlace3_label";
   $this->css_evento_adverso_desenlace3_grid_line = $compl_css_emb . "css_evento_adverso_desenlace3_grid_line";
   $this->css_evento_adverso_fecha_recuperacion3_label = $compl_css_emb . "css_evento_adverso_fecha_recuperacion3_label";
   $this->css_evento_adverso_fecha_recuperacion3_grid_line = $compl_css_emb . "css_evento_adverso_fecha_recuperacion3_grid_line";
   $this->css_evento_adverso_fecha_muerte3_label = $compl_css_emb . "css_evento_adverso_fecha_muerte3_label";
   $this->css_evento_adverso_fecha_muerte3_grid_line = $compl_css_emb . "css_evento_adverso_fecha_muerte3_grid_line";
   $this->css_evento_adverso_criterio_seriedad3_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad3_label";
   $this->css_evento_adverso_criterio_seriedad3_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad3_grid_line";
   $this->css_evento_adverso_criterio_seriedad_muerte3_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_muerte3_label";
   $this->css_evento_adverso_criterio_seriedad_muerte3_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_muerte3_grid_line";
   $this->css_evento_adverso_criterio_seriedad_hospitalizacion3_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_hospitalizacion3_label";
   $this->css_evento_adverso_criterio_seriedad_hospitalizacion3_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_hospitalizacion3_grid_line";
   $this->css_evento_adverso_criterio_seriedad_amenaza3_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_amenaza3_label";
   $this->css_evento_adverso_criterio_seriedad_amenaza3_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_amenaza3_grid_line";
   $this->css_evento_adverso_criterio_seriedad_incapacidad3_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_incapacidad3_label";
   $this->css_evento_adverso_criterio_seriedad_incapacidad3_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_incapacidad3_grid_line";
   $this->css_evento_adverso_criterio_seriedad_anormalidad3_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_anormalidad3_label";
   $this->css_evento_adverso_criterio_seriedad_anormalidad3_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_anormalidad3_grid_line";
   $this->css_evento_adverso_criterio_seriedad_evento3_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_evento3_label";
   $this->css_evento_adverso_criterio_seriedad_evento3_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_evento3_grid_line";
   $this->css_evento_adverso_criterio_seriedad_quirurgica3_label = $compl_css_emb . "css_evento_adverso_criterio_seriedad_quirurgica3_label";
   $this->css_evento_adverso_criterio_seriedad_quirurgica3_grid_line = $compl_css_emb . "css_evento_adverso_criterio_seriedad_quirurgica3_grid_line";
   $this->css_evento_adverso_causa_muerte3_label = $compl_css_emb . "css_evento_adverso_causa_muerte3_label";
   $this->css_evento_adverso_causa_muerte3_grid_line = $compl_css_emb . "css_evento_adverso_causa_muerte3_grid_line";
   $this->css_evento_adverso_detalles_ea3_label = $compl_css_emb . "css_evento_adverso_detalles_ea3_label";
   $this->css_evento_adverso_detalles_ea3_grid_line = $compl_css_emb . "css_evento_adverso_detalles_ea3_grid_line";
   $this->css_evento_adverso_informacion_adicional_label = $compl_css_emb . "css_evento_adverso_informacion_adicional_label";
   $this->css_evento_adverso_informacion_adicional_grid_line = $compl_css_emb . "css_evento_adverso_informacion_adicional_grid_line";
   $this->css_evento_adverso_nombre_reporte_label = $compl_css_emb . "css_evento_adverso_nombre_reporte_label";
   $this->css_evento_adverso_nombre_reporte_grid_line = $compl_css_emb . "css_evento_adverso_nombre_reporte_grid_line";
   $this->css_evento_adverso_id_paciente_fk_label = $compl_css_emb . "css_evento_adverso_id_paciente_fk_label";
   $this->css_evento_adverso_id_paciente_fk_grid_line = $compl_css_emb . "css_evento_adverso_id_paciente_fk_grid_line";
   $this->css_evento_adverso_medicamento1_label = $compl_css_emb . "css_evento_adverso_medicamento1_label";
   $this->css_evento_adverso_medicamento1_grid_line = $compl_css_emb . "css_evento_adverso_medicamento1_grid_line";
   $this->css_evento_adverso_medicamento2_label = $compl_css_emb . "css_evento_adverso_medicamento2_label";
   $this->css_evento_adverso_medicamento2_grid_line = $compl_css_emb . "css_evento_adverso_medicamento2_grid_line";
   $this->css_evento_adverso_medicamento3_label = $compl_css_emb . "css_evento_adverso_medicamento3_label";
   $this->css_evento_adverso_medicamento3_grid_line = $compl_css_emb . "css_evento_adverso_medicamento3_grid_line";
   $this->css_evento_adverso_informacion_ea1_label = $compl_css_emb . "css_evento_adverso_informacion_ea1_label";
   $this->css_evento_adverso_informacion_ea1_grid_line = $compl_css_emb . "css_evento_adverso_informacion_ea1_grid_line";
   $this->css_evento_adverso_informacion_ea2_label = $compl_css_emb . "css_evento_adverso_informacion_ea2_label";
   $this->css_evento_adverso_informacion_ea2_grid_line = $compl_css_emb . "css_evento_adverso_informacion_ea2_grid_line";
   $this->css_evento_adverso_informacion_ea3_label = $compl_css_emb . "css_evento_adverso_informacion_ea3_label";
   $this->css_evento_adverso_informacion_ea3_grid_line = $compl_css_emb . "css_evento_adverso_informacion_ea3_grid_line";
   $this->css_evento_adverso_fecha_suspencion1_label = $compl_css_emb . "css_evento_adverso_fecha_suspencion1_label";
   $this->css_evento_adverso_fecha_suspencion1_grid_line = $compl_css_emb . "css_evento_adverso_fecha_suspencion1_grid_line";
   $this->css_evento_adverso_fecha_suspencion2_label = $compl_css_emb . "css_evento_adverso_fecha_suspencion2_label";
   $this->css_evento_adverso_fecha_suspencion2_grid_line = $compl_css_emb . "css_evento_adverso_fecha_suspencion2_grid_line";
   $this->css_evento_adverso_fecha_suspencion3_label = $compl_css_emb . "css_evento_adverso_fecha_suspencion3_label";
   $this->css_evento_adverso_fecha_suspencion3_grid_line = $compl_css_emb . "css_evento_adverso_fecha_suspencion3_grid_line";
   $this->css_evento_adverso_fecha_evento_adverso_label = $compl_css_emb . "css_evento_adverso_fecha_evento_adverso_label";
   $this->css_evento_adverso_fecha_evento_adverso_grid_line = $compl_css_emb . "css_evento_adverso_fecha_evento_adverso_grid_line";
   $this->css_evento_adverso_nombre_reportante_primario_label = $compl_css_emb . "css_evento_adverso_nombre_reportante_primario_label";
   $this->css_evento_adverso_nombre_reportante_primario_grid_line = $compl_css_emb . "css_evento_adverso_nombre_reportante_primario_grid_line";
   $this->css_evento_adverso_telefono_reportante_primario_label = $compl_css_emb . "css_evento_adverso_telefono_reportante_primario_label";
   $this->css_evento_adverso_telefono_reportante_primario_grid_line = $compl_css_emb . "css_evento_adverso_telefono_reportante_primario_grid_line";
   $this->css_evento_adverso_tipo_reportante_label = $compl_css_emb . "css_evento_adverso_tipo_reportante_label";
   $this->css_evento_adverso_tipo_reportante_grid_line = $compl_css_emb . "css_evento_adverso_tipo_reportante_grid_line";
 }  
// 
//----- 
 function cabecalho()
 {
   global
          $nm_saida;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cond_pesq'], 0, $trab_pos);
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
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sv_dt_head']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sv_dt_head'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sv_dt_head']['fix'] = $nm_data_fixa;
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sv_dt_head'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sv_dt_head']['fix'] != $nm_data_fixa)
   {
       $nm_refresch_cab_rod = true;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sv_dt_head']['fix'] = $nm_data_fixa;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf")
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
   $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - </span></td>\r\n");
   $nm_saida->saida("            <td id=\"lin1_col2\" class=\"" . $this->css_scGridHeaderFont . "\"><span>" . $nm_data_fixa . "</span></td>\r\n");
   $nm_saida->saida("        </tr>\r\n");
   $nm_saida->saida("    </table>		 \r\n");
   $nm_saida->saida(" </div>\r\n");
   $nm_saida->saida("</div>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'] && $nm_refresch_cab_rod)
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
   $tmp_header_row = $nm_seq_titulos;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_label'])
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
   $nm_saida->saida("    <TR id=\"tit_EA__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-EA-" . $tmp_header_row . "\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_tipo_reportante_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
   } 
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_label'])
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
             $css_emb = "<style type=\"text/css\">";
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "EA/EA_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $css_emb .= ".EA_" . substr($cada_css, 1);
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cols_emb'] = count($Nm_temp) - 1;
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
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels'] as $NM_cmp => $NM_lab)
     {
         if (empty($NM_lab) || $NM_lab == "&nbsp;")
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels'][$NM_cmp] = "No_Label" . $NM_seq_lab;
             $NM_seq_lab++;
         }
     } 
   } 
 }
 function NM_label_evento_adverso_id_evento_adverso()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_id_evento_adverso'])) ? $this->New_label['evento_adverso_id_evento_adverso'] : "ID EVENTO ADVERSO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_id_evento_adverso']) || $this->NM_cmp_hidden['evento_adverso_id_evento_adverso'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_id_evento_adverso_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_id_evento_adverso_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf")
   {
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $NM_cmp_class =  "evento_adverso.ID_EVENTO_ADVERSO";
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      {
          $NM_cmp_class =  "evento_adverso.ID_EVENTO_ADVERSO";
      }
      else
      {
          $NM_cmp_class =  "cmp_maior_30_1";
      }
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_cmp'] == $NM_cmp_class)
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_pais()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_pais'])) ? $this->New_label['evento_adverso_pais'] : "PAIS"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_pais']) || $this->NM_cmp_hidden['evento_adverso_pais'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_pais_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_pais_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf")
   {
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $NM_cmp_class =  "evento_adverso.PAIS";
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      {
          $NM_cmp_class =  "evento_adverso.PAIS";
      }
      else
      {
          $NM_cmp_class =  "evento_adverso_pais";
      }
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_cmp'] == $NM_cmp_class)
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_tipo_reporte()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_tipo_reporte'])) ? $this->New_label['evento_adverso_tipo_reporte'] : "TIPO REPORTE"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_tipo_reporte']) || $this->NM_cmp_hidden['evento_adverso_tipo_reporte'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_tipo_reporte_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_tipo_reporte_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf")
   {
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $NM_cmp_class =  "evento_adverso.TIPO_REPORTE";
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      {
          $NM_cmp_class =  "evento_adverso.TIPO_REPORTE";
      }
      else
      {
          $NM_cmp_class =  "cmp_maior_30_2";
      }
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_cmp'] == $NM_cmp_class)
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_staff()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_staff'])) ? $this->New_label['evento_adverso_fecha_staff'] : "FECHA STAFF"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_staff']) || $this->NM_cmp_hidden['evento_adverso_fecha_staff'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_staff_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_staff_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf")
   {
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $NM_cmp_class =  "evento_adverso.FECHA_STAFF";
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      {
          $NM_cmp_class =  "evento_adverso.FECHA_STAFF";
      }
      else
      {
          $NM_cmp_class =  "cmp_maior_30_3";
      }
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_cmp'] == $NM_cmp_class)
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_producto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_producto'])) ? $this->New_label['evento_adverso_producto'] : "PRODUCTO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_producto']) || $this->NM_cmp_hidden['evento_adverso_producto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_producto_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_producto_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf")
   {
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $NM_cmp_class =  "evento_adverso.PRODUCTO";
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      {
          $NM_cmp_class =  "evento_adverso.PRODUCTO";
      }
      else
      {
          $NM_cmp_class =  "evento_adverso_producto";
      }
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_cmp'] == $NM_cmp_class)
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_ciudad()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_ciudad'])) ? $this->New_label['evento_adverso_ciudad'] : "CIUDAD"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_ciudad']) || $this->NM_cmp_hidden['evento_adverso_ciudad'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_ciudad_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_ciudad_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf")
   {
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $NM_cmp_class =  "evento_adverso.CIUDAD";
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      {
          $NM_cmp_class =  "evento_adverso.CIUDAD";
      }
      else
      {
          $NM_cmp_class =  "evento_adverso_ciudad";
      }
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_cmp'] == $NM_cmp_class)
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('" . $NM_cmp_class . "')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_genero()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_genero'])) ? $this->New_label['evento_adverso_genero'] : "GENERO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_genero']) || $this->NM_cmp_hidden['evento_adverso_genero'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_genero_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_genero_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_nacimiento()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_nacimiento'])) ? $this->New_label['evento_adverso_fecha_nacimiento'] : "FECHA NACIMIENTO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_nacimiento']) || $this->NM_cmp_hidden['evento_adverso_fecha_nacimiento'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_nacimiento_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_nacimiento_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_embarazo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_embarazo'])) ? $this->New_label['evento_adverso_embarazo'] : "EMBARAZO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_embarazo']) || $this->NM_cmp_hidden['evento_adverso_embarazo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_embarazo_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_embarazo_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_parto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_parto'])) ? $this->New_label['evento_adverso_fecha_parto'] : "FECHA PARTO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_parto']) || $this->NM_cmp_hidden['evento_adverso_fecha_parto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_parto_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_parto_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_desenlace()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_desenlace'])) ? $this->New_label['evento_adverso_desenlace'] : "DESENLACE"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_desenlace']) || $this->NM_cmp_hidden['evento_adverso_desenlace'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_desenlace_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_desenlace_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_cuales_desenlaces()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_cuales_desenlaces'])) ? $this->New_label['evento_adverso_cuales_desenlaces'] : "CUALES DESENLACES"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_cuales_desenlaces']) || $this->NM_cmp_hidden['evento_adverso_cuales_desenlaces'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_cuales_desenlaces_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_cuales_desenlaces_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_contacto_directo()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_contacto_directo'])) ? $this->New_label['evento_adverso_contacto_directo'] : "CONTACTO DIRECTO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_contacto_directo']) || $this->NM_cmp_hidden['evento_adverso_contacto_directo'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_contacto_directo_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_contacto_directo_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_nombre_medico()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_nombre_medico'])) ? $this->New_label['evento_adverso_nombre_medico'] : "NOMBRE MEDICO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_nombre_medico']) || $this->NM_cmp_hidden['evento_adverso_nombre_medico'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_nombre_medico_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_nombre_medico_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_telefono_medico()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_telefono_medico'])) ? $this->New_label['evento_adverso_telefono_medico'] : "TELEFONO MEDICO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_telefono_medico']) || $this->NM_cmp_hidden['evento_adverso_telefono_medico'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_telefono_medico_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_telefono_medico_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fax_medico()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fax_medico'])) ? $this->New_label['evento_adverso_fax_medico'] : "FAX MEDICO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fax_medico']) || $this->NM_cmp_hidden['evento_adverso_fax_medico'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fax_medico_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fax_medico_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_email_medico()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_email_medico'])) ? $this->New_label['evento_adverso_email_medico'] : "EMAIL MEDICO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_email_medico']) || $this->NM_cmp_hidden['evento_adverso_email_medico'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_email_medico_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_email_medico_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_indicacion1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_indicacion1'])) ? $this->New_label['evento_adverso_indicacion1'] : "INDICACION1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_indicacion1']) || $this->NM_cmp_hidden['evento_adverso_indicacion1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_indicacion1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_indicacion1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_formulacion1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_formulacion1'])) ? $this->New_label['evento_adverso_formulacion1'] : "FORMULACION1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_formulacion1']) || $this->NM_cmp_hidden['evento_adverso_formulacion1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_formulacion1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_formulacion1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_regimen_dosis1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_regimen_dosis1'])) ? $this->New_label['evento_adverso_regimen_dosis1'] : "REGIMEN DOSIS1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_regimen_dosis1']) || $this->NM_cmp_hidden['evento_adverso_regimen_dosis1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_regimen_dosis1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_regimen_dosis1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_ruta_administracion1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_ruta_administracion1'])) ? $this->New_label['evento_adverso_ruta_administracion1'] : "RUTA ADMINISTRACION1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_ruta_administracion1']) || $this->NM_cmp_hidden['evento_adverso_ruta_administracion1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_ruta_administracion1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_ruta_administracion1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_numero_lote1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_numero_lote1'])) ? $this->New_label['evento_adverso_numero_lote1'] : "NUMERO LOTE1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_numero_lote1']) || $this->NM_cmp_hidden['evento_adverso_numero_lote1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_numero_lote1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_numero_lote1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_expiracion1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_expiracion1'])) ? $this->New_label['evento_adverso_fecha_expiracion1'] : "FECHA EXPIRACION1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_expiracion1']) || $this->NM_cmp_hidden['evento_adverso_fecha_expiracion1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_expiracion1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_expiracion1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_inicio1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio1'])) ? $this->New_label['evento_adverso_fecha_inicio1'] : "FECHA INICIO1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio1']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_inicio1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_inicio1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_tratamiento_continua1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_tratamiento_continua1'])) ? $this->New_label['evento_adverso_tratamiento_continua1'] : "TRATAMIENTO CONTINUA1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_tratamiento_continua1']) || $this->NM_cmp_hidden['evento_adverso_tratamiento_continua1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_tratamiento_continua1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_tratamiento_continua1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_indicacion2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_indicacion2'])) ? $this->New_label['evento_adverso_indicacion2'] : "INDICACION2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_indicacion2']) || $this->NM_cmp_hidden['evento_adverso_indicacion2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_indicacion2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_indicacion2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_formulacion2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_formulacion2'])) ? $this->New_label['evento_adverso_formulacion2'] : "FORMULACION2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_formulacion2']) || $this->NM_cmp_hidden['evento_adverso_formulacion2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_formulacion2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_formulacion2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_regimen_dosis2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_regimen_dosis2'])) ? $this->New_label['evento_adverso_regimen_dosis2'] : "REGIMEN DOSIS2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_regimen_dosis2']) || $this->NM_cmp_hidden['evento_adverso_regimen_dosis2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_regimen_dosis2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_regimen_dosis2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_ruta_administracion2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_ruta_administracion2'])) ? $this->New_label['evento_adverso_ruta_administracion2'] : "RUTA ADMINISTRACION2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_ruta_administracion2']) || $this->NM_cmp_hidden['evento_adverso_ruta_administracion2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_ruta_administracion2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_ruta_administracion2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_numero_lote2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_numero_lote2'])) ? $this->New_label['evento_adverso_numero_lote2'] : "NUMERO LOTE2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_numero_lote2']) || $this->NM_cmp_hidden['evento_adverso_numero_lote2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_numero_lote2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_numero_lote2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_expiracion2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_expiracion2'])) ? $this->New_label['evento_adverso_fecha_expiracion2'] : "FECHA EXPIRACION2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_expiracion2']) || $this->NM_cmp_hidden['evento_adverso_fecha_expiracion2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_expiracion2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_expiracion2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_inicio2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio2'])) ? $this->New_label['evento_adverso_fecha_inicio2'] : "FECHA INICIO2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio2']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_inicio2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_inicio2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_tratamiento_continua2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_tratamiento_continua2'])) ? $this->New_label['evento_adverso_tratamiento_continua2'] : "TRATAMIENTO CONTINUA2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_tratamiento_continua2']) || $this->NM_cmp_hidden['evento_adverso_tratamiento_continua2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_tratamiento_continua2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_tratamiento_continua2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_indicacion3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_indicacion3'])) ? $this->New_label['evento_adverso_indicacion3'] : "INDICACION3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_indicacion3']) || $this->NM_cmp_hidden['evento_adverso_indicacion3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_indicacion3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_indicacion3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_formulacion3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_formulacion3'])) ? $this->New_label['evento_adverso_formulacion3'] : "FORMULACION3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_formulacion3']) || $this->NM_cmp_hidden['evento_adverso_formulacion3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_formulacion3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_formulacion3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_regimen_dosis3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_regimen_dosis3'])) ? $this->New_label['evento_adverso_regimen_dosis3'] : "REGIMEN DOSIS3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_regimen_dosis3']) || $this->NM_cmp_hidden['evento_adverso_regimen_dosis3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_regimen_dosis3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_regimen_dosis3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_ruta_administracion3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_ruta_administracion3'])) ? $this->New_label['evento_adverso_ruta_administracion3'] : "RUTA ADMINISTRACION3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_ruta_administracion3']) || $this->NM_cmp_hidden['evento_adverso_ruta_administracion3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_ruta_administracion3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_ruta_administracion3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_numero_lote3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_numero_lote3'])) ? $this->New_label['evento_adverso_numero_lote3'] : "NUMERO LOTE3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_numero_lote3']) || $this->NM_cmp_hidden['evento_adverso_numero_lote3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_numero_lote3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_numero_lote3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_expiracion3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_expiracion3'])) ? $this->New_label['evento_adverso_fecha_expiracion3'] : "FECHA EXPIRACION3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_expiracion3']) || $this->NM_cmp_hidden['evento_adverso_fecha_expiracion3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_expiracion3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_expiracion3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_inicio3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio3'])) ? $this->New_label['evento_adverso_fecha_inicio3'] : "FECHA INICIO3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio3']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_inicio3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_inicio3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_tratamiento_continua3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_tratamiento_continua3'])) ? $this->New_label['evento_adverso_tratamiento_continua3'] : "TRATAMIENTO CONTINUA3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_tratamiento_continua3']) || $this->NM_cmp_hidden['evento_adverso_tratamiento_continua3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_tratamiento_continua3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_tratamiento_continua3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_muestra_disponible()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_muestra_disponible'])) ? $this->New_label['evento_adverso_muestra_disponible'] : "MUESTRA DISPONIBLE"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_muestra_disponible']) || $this->NM_cmp_hidden['evento_adverso_muestra_disponible'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_muestra_disponible_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_muestra_disponible_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_informacion_muestra()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_muestra'])) ? $this->New_label['evento_adverso_informacion_muestra'] : "INFORMACION MUESTRA"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_muestra']) || $this->NM_cmp_hidden['evento_adverso_informacion_muestra'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_informacion_muestra_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_informacion_muestra_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_relacion_medicamento1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_relacion_medicamento1'])) ? $this->New_label['evento_adverso_relacion_medicamento1'] : "RELACION MEDICAMENTO1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_relacion_medicamento1']) || $this->NM_cmp_hidden['evento_adverso_relacion_medicamento1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_relacion_medicamento1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_relacion_medicamento1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_relacionado_dispositivo1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_relacionado_dispositivo1'])) ? $this->New_label['evento_adverso_relacionado_dispositivo1'] : "RELACIONADO DISPOSITIVO1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo1']) || $this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_relacionado_dispositivo1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_relacionado_dispositivo1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_inicio_evento1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio_evento1'])) ? $this->New_label['evento_adverso_fecha_inicio_evento1'] : "FECHA INICIO EVENTO1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento1']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_inicio_evento1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_inicio_evento1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_desenlace1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_desenlace1'])) ? $this->New_label['evento_adverso_desenlace1'] : "DESENLACE1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_desenlace1']) || $this->NM_cmp_hidden['evento_adverso_desenlace1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_desenlace1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_desenlace1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_recuperacion1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_recuperacion1'])) ? $this->New_label['evento_adverso_fecha_recuperacion1'] : "FECHA RECUPERACION1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_recuperacion1']) || $this->NM_cmp_hidden['evento_adverso_fecha_recuperacion1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_recuperacion1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_recuperacion1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_muerte1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_muerte1'])) ? $this->New_label['evento_adverso_fecha_muerte1'] : "FECHA MUERTE1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_muerte1']) || $this->NM_cmp_hidden['evento_adverso_fecha_muerte1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_muerte1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_muerte1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad1'])) ? $this->New_label['evento_adverso_criterio_seriedad1'] : "CRITERIO SERIEDAD1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_muerte1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_muerte1'])) ? $this->New_label['evento_adverso_criterio_seriedad_muerte1'] : "CRITERIO SERIEDAD MUERTE1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_muerte1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_muerte1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_hospitalizacion1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_hospitalizacion1'])) ? $this->New_label['evento_adverso_criterio_seriedad_hospitalizacion1'] : "CRITERIO SERIEDAD HOSPITALIZACION1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_hospitalizacion1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_hospitalizacion1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_amenaza1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_amenaza1'])) ? $this->New_label['evento_adverso_criterio_seriedad_amenaza1'] : "CRITERIO SERIEDAD AMENAZA1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_amenaza1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_amenaza1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_incapacidad1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_incapacidad1'])) ? $this->New_label['evento_adverso_criterio_seriedad_incapacidad1'] : "CRITERIO SERIEDAD INCAPACIDAD1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_incapacidad1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_incapacidad1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_anormalidad1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_anormalidad1'])) ? $this->New_label['evento_adverso_criterio_seriedad_anormalidad1'] : "CRITERIO SERIEDAD ANORMALIDAD1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_anormalidad1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_anormalidad1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_evento1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_evento1'])) ? $this->New_label['evento_adverso_criterio_seriedad_evento1'] : "CRITERIO SERIEDAD EVENTO1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_evento1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_evento1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_quirurgica1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_quirurgica1'])) ? $this->New_label['evento_adverso_criterio_seriedad_quirurgica1'] : "CRITERIO SERIEDAD QUIRURGICA1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_quirurgica1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_quirurgica1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_causa_muerte1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_causa_muerte1'])) ? $this->New_label['evento_adverso_causa_muerte1'] : "CAUSA MUERTE1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_causa_muerte1']) || $this->NM_cmp_hidden['evento_adverso_causa_muerte1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_causa_muerte1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_causa_muerte1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_detalles_ea1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_detalles_ea1'])) ? $this->New_label['evento_adverso_detalles_ea1'] : "DETALLES EA1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_detalles_ea1']) || $this->NM_cmp_hidden['evento_adverso_detalles_ea1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_detalles_ea1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_detalles_ea1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_relacion_medicamento2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_relacion_medicamento2'])) ? $this->New_label['evento_adverso_relacion_medicamento2'] : "RELACION MEDICAMENTO2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_relacion_medicamento2']) || $this->NM_cmp_hidden['evento_adverso_relacion_medicamento2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_relacion_medicamento2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_relacion_medicamento2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_relacionado_dispositivo2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_relacionado_dispositivo2'])) ? $this->New_label['evento_adverso_relacionado_dispositivo2'] : "RELACIONADO DISPOSITIVO2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo2']) || $this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_relacionado_dispositivo2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_relacionado_dispositivo2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_inicio_evento2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio_evento2'])) ? $this->New_label['evento_adverso_fecha_inicio_evento2'] : "FECHA INICIO EVENTO2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento2']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_inicio_evento2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_inicio_evento2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_desenlace2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_desenlace2'])) ? $this->New_label['evento_adverso_desenlace2'] : "DESENLACE2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_desenlace2']) || $this->NM_cmp_hidden['evento_adverso_desenlace2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_desenlace2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_desenlace2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_recuperacion2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_recuperacion2'])) ? $this->New_label['evento_adverso_fecha_recuperacion2'] : "FECHA RECUPERACION2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_recuperacion2']) || $this->NM_cmp_hidden['evento_adverso_fecha_recuperacion2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_recuperacion2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_recuperacion2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_muerte2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_muerte2'])) ? $this->New_label['evento_adverso_fecha_muerte2'] : "FECHA MUERTE2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_muerte2']) || $this->NM_cmp_hidden['evento_adverso_fecha_muerte2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_muerte2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_muerte2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad2'])) ? $this->New_label['evento_adverso_criterio_seriedad2'] : "CRITERIO SERIEDAD2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_muerte2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_muerte2'])) ? $this->New_label['evento_adverso_criterio_seriedad_muerte2'] : "CRITERIO SERIEDAD MUERTE2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_muerte2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_muerte2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_hospitalizacion2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_hospitalizacion2'])) ? $this->New_label['evento_adverso_criterio_seriedad_hospitalizacion2'] : "CRITERIO SERIEDAD HOSPITALIZACION2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_hospitalizacion2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_hospitalizacion2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_amenaza2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_amenaza2'])) ? $this->New_label['evento_adverso_criterio_seriedad_amenaza2'] : "CRITERIO SERIEDAD AMENAZA2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_amenaza2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_amenaza2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_incapacidad2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_incapacidad2'])) ? $this->New_label['evento_adverso_criterio_seriedad_incapacidad2'] : "CRITERIO SERIEDAD INCAPACIDAD2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_incapacidad2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_incapacidad2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_anormalidad2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_anormalidad2'])) ? $this->New_label['evento_adverso_criterio_seriedad_anormalidad2'] : "CRITERIO SERIEDAD ANORMALIDAD2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_anormalidad2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_anormalidad2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_evento2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_evento2'])) ? $this->New_label['evento_adverso_criterio_seriedad_evento2'] : "CRITERIO SERIEDAD EVENTO2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_evento2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_evento2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_quirurgica2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_quirurgica2'])) ? $this->New_label['evento_adverso_criterio_seriedad_quirurgica2'] : "CRITERIO SERIEDAD QUIRURGICA2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_quirurgica2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_quirurgica2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_causa_muerte2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_causa_muerte2'])) ? $this->New_label['evento_adverso_causa_muerte2'] : "CAUSA MUERTE2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_causa_muerte2']) || $this->NM_cmp_hidden['evento_adverso_causa_muerte2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_causa_muerte2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_causa_muerte2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_detalles_ea2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_detalles_ea2'])) ? $this->New_label['evento_adverso_detalles_ea2'] : "DETALLES EA2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_detalles_ea2']) || $this->NM_cmp_hidden['evento_adverso_detalles_ea2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_detalles_ea2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_detalles_ea2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_relacion_medicamento3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_relacion_medicamento3'])) ? $this->New_label['evento_adverso_relacion_medicamento3'] : "RELACION MEDICAMENTO3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_relacion_medicamento3']) || $this->NM_cmp_hidden['evento_adverso_relacion_medicamento3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_relacion_medicamento3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_relacion_medicamento3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_relacionado_dispositivo3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_relacionado_dispositivo3'])) ? $this->New_label['evento_adverso_relacionado_dispositivo3'] : "RELACIONADO DISPOSITIVO3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo3']) || $this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_relacionado_dispositivo3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_relacionado_dispositivo3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_inicio_evento3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio_evento3'])) ? $this->New_label['evento_adverso_fecha_inicio_evento3'] : "FECHA INICIO EVENTO3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento3']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_inicio_evento3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_inicio_evento3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_desenlace3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_desenlace3'])) ? $this->New_label['evento_adverso_desenlace3'] : "DESENLACE3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_desenlace3']) || $this->NM_cmp_hidden['evento_adverso_desenlace3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_desenlace3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_desenlace3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_recuperacion3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_recuperacion3'])) ? $this->New_label['evento_adverso_fecha_recuperacion3'] : "FECHA RECUPERACION3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_recuperacion3']) || $this->NM_cmp_hidden['evento_adverso_fecha_recuperacion3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_recuperacion3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_recuperacion3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_muerte3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_muerte3'])) ? $this->New_label['evento_adverso_fecha_muerte3'] : "FECHA MUERTE3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_muerte3']) || $this->NM_cmp_hidden['evento_adverso_fecha_muerte3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_muerte3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_muerte3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad3'])) ? $this->New_label['evento_adverso_criterio_seriedad3'] : "CRITERIO SERIEDAD3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_muerte3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_muerte3'])) ? $this->New_label['evento_adverso_criterio_seriedad_muerte3'] : "CRITERIO SERIEDAD MUERTE3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_muerte3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_muerte3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_hospitalizacion3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_hospitalizacion3'])) ? $this->New_label['evento_adverso_criterio_seriedad_hospitalizacion3'] : "CRITERIO SERIEDAD HOSPITALIZACION3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_hospitalizacion3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_hospitalizacion3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_amenaza3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_amenaza3'])) ? $this->New_label['evento_adverso_criterio_seriedad_amenaza3'] : "CRITERIO SERIEDAD AMENAZA3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_amenaza3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_amenaza3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_incapacidad3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_incapacidad3'])) ? $this->New_label['evento_adverso_criterio_seriedad_incapacidad3'] : "CRITERIO SERIEDAD INCAPACIDAD3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_incapacidad3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_incapacidad3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_anormalidad3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_anormalidad3'])) ? $this->New_label['evento_adverso_criterio_seriedad_anormalidad3'] : "CRITERIO SERIEDAD ANORMALIDAD3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_anormalidad3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_anormalidad3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_evento3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_evento3'])) ? $this->New_label['evento_adverso_criterio_seriedad_evento3'] : "CRITERIO SERIEDAD EVENTO3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_evento3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_evento3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_criterio_seriedad_quirurgica3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_quirurgica3'])) ? $this->New_label['evento_adverso_criterio_seriedad_quirurgica3'] : "CRITERIO SERIEDAD QUIRURGICA3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_quirurgica3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_quirurgica3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_causa_muerte3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_causa_muerte3'])) ? $this->New_label['evento_adverso_causa_muerte3'] : "CAUSA MUERTE3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_causa_muerte3']) || $this->NM_cmp_hidden['evento_adverso_causa_muerte3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_causa_muerte3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_causa_muerte3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_detalles_ea3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_detalles_ea3'])) ? $this->New_label['evento_adverso_detalles_ea3'] : "DETALLES EA3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_detalles_ea3']) || $this->NM_cmp_hidden['evento_adverso_detalles_ea3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_detalles_ea3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_detalles_ea3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_informacion_adicional()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_adicional'])) ? $this->New_label['evento_adverso_informacion_adicional'] : "INFORMACION ADICIONAL"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_adicional']) || $this->NM_cmp_hidden['evento_adverso_informacion_adicional'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_informacion_adicional_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_informacion_adicional_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_nombre_reporte()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_nombre_reporte'])) ? $this->New_label['evento_adverso_nombre_reporte'] : "NOMBRE REPORTE"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_nombre_reporte']) || $this->NM_cmp_hidden['evento_adverso_nombre_reporte'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_nombre_reporte_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_nombre_reporte_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_id_paciente_fk()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_id_paciente_fk'])) ? $this->New_label['evento_adverso_id_paciente_fk'] : "ID PACIENTE FK"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_id_paciente_fk']) || $this->NM_cmp_hidden['evento_adverso_id_paciente_fk'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_id_paciente_fk_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_id_paciente_fk_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_medicamento1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_medicamento1'])) ? $this->New_label['evento_adverso_medicamento1'] : "MEDICAMENTO1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_medicamento1']) || $this->NM_cmp_hidden['evento_adverso_medicamento1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_medicamento1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_medicamento1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_medicamento2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_medicamento2'])) ? $this->New_label['evento_adverso_medicamento2'] : "MEDICAMENTO2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_medicamento2']) || $this->NM_cmp_hidden['evento_adverso_medicamento2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_medicamento2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_medicamento2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_medicamento3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_medicamento3'])) ? $this->New_label['evento_adverso_medicamento3'] : "MEDICAMENTO3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_medicamento3']) || $this->NM_cmp_hidden['evento_adverso_medicamento3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_medicamento3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_medicamento3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_informacion_ea1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_ea1'])) ? $this->New_label['evento_adverso_informacion_ea1'] : "INFORMACION EA1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_ea1']) || $this->NM_cmp_hidden['evento_adverso_informacion_ea1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_informacion_ea1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_informacion_ea1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_informacion_ea2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_ea2'])) ? $this->New_label['evento_adverso_informacion_ea2'] : "INFORMACION EA2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_ea2']) || $this->NM_cmp_hidden['evento_adverso_informacion_ea2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_informacion_ea2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_informacion_ea2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_informacion_ea3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_ea3'])) ? $this->New_label['evento_adverso_informacion_ea3'] : "INFORMACION EA3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_ea3']) || $this->NM_cmp_hidden['evento_adverso_informacion_ea3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_informacion_ea3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_informacion_ea3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_suspencion1()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_suspencion1'])) ? $this->New_label['evento_adverso_fecha_suspencion1'] : "FECHA SUSPENCION1"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_suspencion1']) || $this->NM_cmp_hidden['evento_adverso_fecha_suspencion1'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_suspencion1_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_suspencion1_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_suspencion2()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_suspencion2'])) ? $this->New_label['evento_adverso_fecha_suspencion2'] : "FECHA SUSPENCION2"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_suspencion2']) || $this->NM_cmp_hidden['evento_adverso_fecha_suspencion2'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_suspencion2_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_suspencion2_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_suspencion3()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_suspencion3'])) ? $this->New_label['evento_adverso_fecha_suspencion3'] : "FECHA SUSPENCION3"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_suspencion3']) || $this->NM_cmp_hidden['evento_adverso_fecha_suspencion3'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_suspencion3_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_suspencion3_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_fecha_evento_adverso()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_evento_adverso'])) ? $this->New_label['evento_adverso_fecha_evento_adverso'] : "FECHA EVENTO ADVERSO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_evento_adverso']) || $this->NM_cmp_hidden['evento_adverso_fecha_evento_adverso'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_fecha_evento_adverso_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_fecha_evento_adverso_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_nombre_reportante_primario()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_nombre_reportante_primario'])) ? $this->New_label['evento_adverso_nombre_reportante_primario'] : "NOMBRE REPORTANTE PRIMARIO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_nombre_reportante_primario']) || $this->NM_cmp_hidden['evento_adverso_nombre_reportante_primario'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_nombre_reportante_primario_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_nombre_reportante_primario_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_telefono_reportante_primario()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_telefono_reportante_primario'])) ? $this->New_label['evento_adverso_telefono_reportante_primario'] : "TELEFONO REPORTANTE PRIMARIO"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_telefono_reportante_primario']) || $this->NM_cmp_hidden['evento_adverso_telefono_reportante_primario'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_telefono_reportante_primario_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_telefono_reportante_primario_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_evento_adverso_tipo_reportante()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['evento_adverso_tipo_reportante'])) ? $this->New_label['evento_adverso_tipo_reportante'] : "TIPO REPORTANTE"; 
   if (!isset($this->NM_cmp_hidden['evento_adverso_tipo_reportante']) || $this->NM_cmp_hidden['evento_adverso_tipo_reportante'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_evento_adverso_tipo_reportante_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_evento_adverso_tipo_reportante_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ini_cor_grid']);
       }
   }
   static $nm_seq_execucoes = 0; 
   static $nm_seq_titulos   = 0; 
   $this->SC_ancora = "";
   $this->Rows_span = 1;
   $nm_seq_execucoes++; 
   $nm_seq_titulos++; 
   $this->nm_prim_linha  = true; 
   $this->Ini->nm_cont_lin = 0; 
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['evento_adverso_id_evento_adverso'])) ? $this->New_label['evento_adverso_id_evento_adverso'] : "ID EVENTO ADVERSO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_id_evento_adverso'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_pais'])) ? $this->New_label['evento_adverso_pais'] : "PAIS"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_pais'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_tipo_reporte'])) ? $this->New_label['evento_adverso_tipo_reporte'] : "TIPO REPORTE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_tipo_reporte'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_staff'])) ? $this->New_label['evento_adverso_fecha_staff'] : "FECHA STAFF"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_staff'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_producto'])) ? $this->New_label['evento_adverso_producto'] : "PRODUCTO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_producto'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_ciudad'])) ? $this->New_label['evento_adverso_ciudad'] : "CIUDAD"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_ciudad'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_genero'])) ? $this->New_label['evento_adverso_genero'] : "GENERO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_genero'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_nacimiento'])) ? $this->New_label['evento_adverso_fecha_nacimiento'] : "FECHA NACIMIENTO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_nacimiento'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_embarazo'])) ? $this->New_label['evento_adverso_embarazo'] : "EMBARAZO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_embarazo'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_parto'])) ? $this->New_label['evento_adverso_fecha_parto'] : "FECHA PARTO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_parto'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_desenlace'])) ? $this->New_label['evento_adverso_desenlace'] : "DESENLACE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_desenlace'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_cuales_desenlaces'])) ? $this->New_label['evento_adverso_cuales_desenlaces'] : "CUALES DESENLACES"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_cuales_desenlaces'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_contacto_directo'])) ? $this->New_label['evento_adverso_contacto_directo'] : "CONTACTO DIRECTO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_contacto_directo'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_nombre_medico'])) ? $this->New_label['evento_adverso_nombre_medico'] : "NOMBRE MEDICO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_nombre_medico'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_telefono_medico'])) ? $this->New_label['evento_adverso_telefono_medico'] : "TELEFONO MEDICO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_telefono_medico'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fax_medico'])) ? $this->New_label['evento_adverso_fax_medico'] : "FAX MEDICO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fax_medico'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_email_medico'])) ? $this->New_label['evento_adverso_email_medico'] : "EMAIL MEDICO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_email_medico'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_indicacion1'])) ? $this->New_label['evento_adverso_indicacion1'] : "INDICACION1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_indicacion1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_formulacion1'])) ? $this->New_label['evento_adverso_formulacion1'] : "FORMULACION1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_formulacion1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_regimen_dosis1'])) ? $this->New_label['evento_adverso_regimen_dosis1'] : "REGIMEN DOSIS1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_regimen_dosis1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_ruta_administracion1'])) ? $this->New_label['evento_adverso_ruta_administracion1'] : "RUTA ADMINISTRACION1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_ruta_administracion1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_numero_lote1'])) ? $this->New_label['evento_adverso_numero_lote1'] : "NUMERO LOTE1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_numero_lote1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_expiracion1'])) ? $this->New_label['evento_adverso_fecha_expiracion1'] : "FECHA EXPIRACION1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_expiracion1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio1'])) ? $this->New_label['evento_adverso_fecha_inicio1'] : "FECHA INICIO1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_inicio1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_tratamiento_continua1'])) ? $this->New_label['evento_adverso_tratamiento_continua1'] : "TRATAMIENTO CONTINUA1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_tratamiento_continua1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_indicacion2'])) ? $this->New_label['evento_adverso_indicacion2'] : "INDICACION2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_indicacion2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_formulacion2'])) ? $this->New_label['evento_adverso_formulacion2'] : "FORMULACION2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_formulacion2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_regimen_dosis2'])) ? $this->New_label['evento_adverso_regimen_dosis2'] : "REGIMEN DOSIS2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_regimen_dosis2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_ruta_administracion2'])) ? $this->New_label['evento_adverso_ruta_administracion2'] : "RUTA ADMINISTRACION2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_ruta_administracion2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_numero_lote2'])) ? $this->New_label['evento_adverso_numero_lote2'] : "NUMERO LOTE2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_numero_lote2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_expiracion2'])) ? $this->New_label['evento_adverso_fecha_expiracion2'] : "FECHA EXPIRACION2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_expiracion2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio2'])) ? $this->New_label['evento_adverso_fecha_inicio2'] : "FECHA INICIO2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_inicio2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_tratamiento_continua2'])) ? $this->New_label['evento_adverso_tratamiento_continua2'] : "TRATAMIENTO CONTINUA2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_tratamiento_continua2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_indicacion3'])) ? $this->New_label['evento_adverso_indicacion3'] : "INDICACION3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_indicacion3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_formulacion3'])) ? $this->New_label['evento_adverso_formulacion3'] : "FORMULACION3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_formulacion3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_regimen_dosis3'])) ? $this->New_label['evento_adverso_regimen_dosis3'] : "REGIMEN DOSIS3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_regimen_dosis3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_ruta_administracion3'])) ? $this->New_label['evento_adverso_ruta_administracion3'] : "RUTA ADMINISTRACION3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_ruta_administracion3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_numero_lote3'])) ? $this->New_label['evento_adverso_numero_lote3'] : "NUMERO LOTE3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_numero_lote3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_expiracion3'])) ? $this->New_label['evento_adverso_fecha_expiracion3'] : "FECHA EXPIRACION3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_expiracion3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio3'])) ? $this->New_label['evento_adverso_fecha_inicio3'] : "FECHA INICIO3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_inicio3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_tratamiento_continua3'])) ? $this->New_label['evento_adverso_tratamiento_continua3'] : "TRATAMIENTO CONTINUA3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_tratamiento_continua3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_muestra_disponible'])) ? $this->New_label['evento_adverso_muestra_disponible'] : "MUESTRA DISPONIBLE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_muestra_disponible'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_muestra'])) ? $this->New_label['evento_adverso_informacion_muestra'] : "INFORMACION MUESTRA"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_informacion_muestra'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_relacion_medicamento1'])) ? $this->New_label['evento_adverso_relacion_medicamento1'] : "RELACION MEDICAMENTO1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_relacion_medicamento1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_relacionado_dispositivo1'])) ? $this->New_label['evento_adverso_relacionado_dispositivo1'] : "RELACIONADO DISPOSITIVO1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_relacionado_dispositivo1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio_evento1'])) ? $this->New_label['evento_adverso_fecha_inicio_evento1'] : "FECHA INICIO EVENTO1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_inicio_evento1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_desenlace1'])) ? $this->New_label['evento_adverso_desenlace1'] : "DESENLACE1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_desenlace1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_recuperacion1'])) ? $this->New_label['evento_adverso_fecha_recuperacion1'] : "FECHA RECUPERACION1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_recuperacion1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_muerte1'])) ? $this->New_label['evento_adverso_fecha_muerte1'] : "FECHA MUERTE1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_muerte1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad1'])) ? $this->New_label['evento_adverso_criterio_seriedad1'] : "CRITERIO SERIEDAD1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_muerte1'])) ? $this->New_label['evento_adverso_criterio_seriedad_muerte1'] : "CRITERIO SERIEDAD MUERTE1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_muerte1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_hospitalizacion1'])) ? $this->New_label['evento_adverso_criterio_seriedad_hospitalizacion1'] : "CRITERIO SERIEDAD HOSPITALIZACION1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_hospitalizacion1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_amenaza1'])) ? $this->New_label['evento_adverso_criterio_seriedad_amenaza1'] : "CRITERIO SERIEDAD AMENAZA1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_amenaza1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_incapacidad1'])) ? $this->New_label['evento_adverso_criterio_seriedad_incapacidad1'] : "CRITERIO SERIEDAD INCAPACIDAD1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_incapacidad1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_anormalidad1'])) ? $this->New_label['evento_adverso_criterio_seriedad_anormalidad1'] : "CRITERIO SERIEDAD ANORMALIDAD1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_anormalidad1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_evento1'])) ? $this->New_label['evento_adverso_criterio_seriedad_evento1'] : "CRITERIO SERIEDAD EVENTO1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_evento1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_quirurgica1'])) ? $this->New_label['evento_adverso_criterio_seriedad_quirurgica1'] : "CRITERIO SERIEDAD QUIRURGICA1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_quirurgica1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_causa_muerte1'])) ? $this->New_label['evento_adverso_causa_muerte1'] : "CAUSA MUERTE1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_causa_muerte1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_detalles_ea1'])) ? $this->New_label['evento_adverso_detalles_ea1'] : "DETALLES EA1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_detalles_ea1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_relacion_medicamento2'])) ? $this->New_label['evento_adverso_relacion_medicamento2'] : "RELACION MEDICAMENTO2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_relacion_medicamento2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_relacionado_dispositivo2'])) ? $this->New_label['evento_adverso_relacionado_dispositivo2'] : "RELACIONADO DISPOSITIVO2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_relacionado_dispositivo2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio_evento2'])) ? $this->New_label['evento_adverso_fecha_inicio_evento2'] : "FECHA INICIO EVENTO2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_inicio_evento2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_desenlace2'])) ? $this->New_label['evento_adverso_desenlace2'] : "DESENLACE2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_desenlace2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_recuperacion2'])) ? $this->New_label['evento_adverso_fecha_recuperacion2'] : "FECHA RECUPERACION2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_recuperacion2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_muerte2'])) ? $this->New_label['evento_adverso_fecha_muerte2'] : "FECHA MUERTE2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_muerte2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad2'])) ? $this->New_label['evento_adverso_criterio_seriedad2'] : "CRITERIO SERIEDAD2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_muerte2'])) ? $this->New_label['evento_adverso_criterio_seriedad_muerte2'] : "CRITERIO SERIEDAD MUERTE2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_muerte2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_hospitalizacion2'])) ? $this->New_label['evento_adverso_criterio_seriedad_hospitalizacion2'] : "CRITERIO SERIEDAD HOSPITALIZACION2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_hospitalizacion2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_amenaza2'])) ? $this->New_label['evento_adverso_criterio_seriedad_amenaza2'] : "CRITERIO SERIEDAD AMENAZA2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_amenaza2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_incapacidad2'])) ? $this->New_label['evento_adverso_criterio_seriedad_incapacidad2'] : "CRITERIO SERIEDAD INCAPACIDAD2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_incapacidad2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_anormalidad2'])) ? $this->New_label['evento_adverso_criterio_seriedad_anormalidad2'] : "CRITERIO SERIEDAD ANORMALIDAD2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_anormalidad2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_evento2'])) ? $this->New_label['evento_adverso_criterio_seriedad_evento2'] : "CRITERIO SERIEDAD EVENTO2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_evento2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_quirurgica2'])) ? $this->New_label['evento_adverso_criterio_seriedad_quirurgica2'] : "CRITERIO SERIEDAD QUIRURGICA2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_quirurgica2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_causa_muerte2'])) ? $this->New_label['evento_adverso_causa_muerte2'] : "CAUSA MUERTE2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_causa_muerte2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_detalles_ea2'])) ? $this->New_label['evento_adverso_detalles_ea2'] : "DETALLES EA2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_detalles_ea2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_relacion_medicamento3'])) ? $this->New_label['evento_adverso_relacion_medicamento3'] : "RELACION MEDICAMENTO3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_relacion_medicamento3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_relacionado_dispositivo3'])) ? $this->New_label['evento_adverso_relacionado_dispositivo3'] : "RELACIONADO DISPOSITIVO3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_relacionado_dispositivo3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_inicio_evento3'])) ? $this->New_label['evento_adverso_fecha_inicio_evento3'] : "FECHA INICIO EVENTO3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_inicio_evento3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_desenlace3'])) ? $this->New_label['evento_adverso_desenlace3'] : "DESENLACE3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_desenlace3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_recuperacion3'])) ? $this->New_label['evento_adverso_fecha_recuperacion3'] : "FECHA RECUPERACION3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_recuperacion3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_muerte3'])) ? $this->New_label['evento_adverso_fecha_muerte3'] : "FECHA MUERTE3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_muerte3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad3'])) ? $this->New_label['evento_adverso_criterio_seriedad3'] : "CRITERIO SERIEDAD3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_muerte3'])) ? $this->New_label['evento_adverso_criterio_seriedad_muerte3'] : "CRITERIO SERIEDAD MUERTE3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_muerte3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_hospitalizacion3'])) ? $this->New_label['evento_adverso_criterio_seriedad_hospitalizacion3'] : "CRITERIO SERIEDAD HOSPITALIZACION3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_hospitalizacion3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_amenaza3'])) ? $this->New_label['evento_adverso_criterio_seriedad_amenaza3'] : "CRITERIO SERIEDAD AMENAZA3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_amenaza3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_incapacidad3'])) ? $this->New_label['evento_adverso_criterio_seriedad_incapacidad3'] : "CRITERIO SERIEDAD INCAPACIDAD3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_incapacidad3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_anormalidad3'])) ? $this->New_label['evento_adverso_criterio_seriedad_anormalidad3'] : "CRITERIO SERIEDAD ANORMALIDAD3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_anormalidad3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_evento3'])) ? $this->New_label['evento_adverso_criterio_seriedad_evento3'] : "CRITERIO SERIEDAD EVENTO3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_evento3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_criterio_seriedad_quirurgica3'])) ? $this->New_label['evento_adverso_criterio_seriedad_quirurgica3'] : "CRITERIO SERIEDAD QUIRURGICA3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_criterio_seriedad_quirurgica3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_causa_muerte3'])) ? $this->New_label['evento_adverso_causa_muerte3'] : "CAUSA MUERTE3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_causa_muerte3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_detalles_ea3'])) ? $this->New_label['evento_adverso_detalles_ea3'] : "DETALLES EA3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_detalles_ea3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_adicional'])) ? $this->New_label['evento_adverso_informacion_adicional'] : "INFORMACION ADICIONAL"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_informacion_adicional'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_nombre_reporte'])) ? $this->New_label['evento_adverso_nombre_reporte'] : "NOMBRE REPORTE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_nombre_reporte'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_id_paciente_fk'])) ? $this->New_label['evento_adverso_id_paciente_fk'] : "ID PACIENTE FK"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_id_paciente_fk'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_medicamento1'])) ? $this->New_label['evento_adverso_medicamento1'] : "MEDICAMENTO1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_medicamento1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_medicamento2'])) ? $this->New_label['evento_adverso_medicamento2'] : "MEDICAMENTO2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_medicamento2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_medicamento3'])) ? $this->New_label['evento_adverso_medicamento3'] : "MEDICAMENTO3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_medicamento3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_ea1'])) ? $this->New_label['evento_adverso_informacion_ea1'] : "INFORMACION EA1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_informacion_ea1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_ea2'])) ? $this->New_label['evento_adverso_informacion_ea2'] : "INFORMACION EA2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_informacion_ea2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_informacion_ea3'])) ? $this->New_label['evento_adverso_informacion_ea3'] : "INFORMACION EA3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_informacion_ea3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_suspencion1'])) ? $this->New_label['evento_adverso_fecha_suspencion1'] : "FECHA SUSPENCION1"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_suspencion1'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_suspencion2'])) ? $this->New_label['evento_adverso_fecha_suspencion2'] : "FECHA SUSPENCION2"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_suspencion2'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_suspencion3'])) ? $this->New_label['evento_adverso_fecha_suspencion3'] : "FECHA SUSPENCION3"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_suspencion3'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_fecha_evento_adverso'])) ? $this->New_label['evento_adverso_fecha_evento_adverso'] : "FECHA EVENTO ADVERSO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_fecha_evento_adverso'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_nombre_reportante_primario'])) ? $this->New_label['evento_adverso_nombre_reportante_primario'] : "NOMBRE REPORTANTE PRIMARIO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_nombre_reportante_primario'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_telefono_reportante_primario'])) ? $this->New_label['evento_adverso_telefono_reportante_primario'] : "TELEFONO REPORTANTE PRIMARIO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_telefono_reportante_primario'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['evento_adverso_tipo_reportante'])) ? $this->New_label['evento_adverso_tipo_reportante'] : "TIPO REPORTANTE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['labels']['evento_adverso_tipo_reportante'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['EA']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['EA']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['EA']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_EA#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cab_embutida'] != "S")
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
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
       }
       return;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['force_toolbar']);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_EA#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = " id=\"apl_EA#?#1\"";
   } 
   $nm_saida->saida("  <TD id=\"sc_grid_body\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-01ca8eae\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['cab_embutida'] != "S" )
      { 
          $this->label_grid($linhas);
      } 
   } 
   else 
   { 
      $this->label_grid($linhas);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final'] = 0;
   } 
   $this->nmgp_prim_pag_pdf = false;
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $ini_grid = true;
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          //---------- Gauge ----------
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf" && -1 < $this->progress_grid)
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
          $this->evento_adverso_id_evento_adverso = $this->rs_grid->fields[0] ;  
          $this->evento_adverso_id_evento_adverso = (string)$this->evento_adverso_id_evento_adverso;
          $this->evento_adverso_pais = $this->rs_grid->fields[1] ;  
          $this->evento_adverso_tipo_reporte = $this->rs_grid->fields[2] ;  
          $this->evento_adverso_fecha_staff = $this->rs_grid->fields[3] ;  
          $this->evento_adverso_producto = $this->rs_grid->fields[4] ;  
          $this->evento_adverso_ciudad = $this->rs_grid->fields[5] ;  
          $this->evento_adverso_genero = $this->rs_grid->fields[6] ;  
          $this->evento_adverso_fecha_nacimiento = $this->rs_grid->fields[7] ;  
          $this->evento_adverso_embarazo = $this->rs_grid->fields[8] ;  
          $this->evento_adverso_fecha_parto = $this->rs_grid->fields[9] ;  
          $this->evento_adverso_desenlace = $this->rs_grid->fields[10] ;  
          $this->evento_adverso_cuales_desenlaces = $this->rs_grid->fields[11] ;  
          $this->evento_adverso_contacto_directo = $this->rs_grid->fields[12] ;  
          $this->evento_adverso_nombre_medico = $this->rs_grid->fields[13] ;  
          $this->evento_adverso_telefono_medico = $this->rs_grid->fields[14] ;  
          $this->evento_adverso_fax_medico = $this->rs_grid->fields[15] ;  
          $this->evento_adverso_email_medico = $this->rs_grid->fields[16] ;  
          $this->evento_adverso_indicacion1 = $this->rs_grid->fields[17] ;  
          $this->evento_adverso_formulacion1 = $this->rs_grid->fields[18] ;  
          $this->evento_adverso_regimen_dosis1 = $this->rs_grid->fields[19] ;  
          $this->evento_adverso_ruta_administracion1 = $this->rs_grid->fields[20] ;  
          $this->evento_adverso_numero_lote1 = $this->rs_grid->fields[21] ;  
          $this->evento_adverso_fecha_expiracion1 = $this->rs_grid->fields[22] ;  
          $this->evento_adverso_fecha_inicio1 = $this->rs_grid->fields[23] ;  
          $this->evento_adverso_tratamiento_continua1 = $this->rs_grid->fields[24] ;  
          $this->evento_adverso_indicacion2 = $this->rs_grid->fields[25] ;  
          $this->evento_adverso_formulacion2 = $this->rs_grid->fields[26] ;  
          $this->evento_adverso_regimen_dosis2 = $this->rs_grid->fields[27] ;  
          $this->evento_adverso_ruta_administracion2 = $this->rs_grid->fields[28] ;  
          $this->evento_adverso_numero_lote2 = $this->rs_grid->fields[29] ;  
          $this->evento_adverso_fecha_expiracion2 = $this->rs_grid->fields[30] ;  
          $this->evento_adverso_fecha_inicio2 = $this->rs_grid->fields[31] ;  
          $this->evento_adverso_tratamiento_continua2 = $this->rs_grid->fields[32] ;  
          $this->evento_adverso_indicacion3 = $this->rs_grid->fields[33] ;  
          $this->evento_adverso_formulacion3 = $this->rs_grid->fields[34] ;  
          $this->evento_adverso_regimen_dosis3 = $this->rs_grid->fields[35] ;  
          $this->evento_adverso_ruta_administracion3 = $this->rs_grid->fields[36] ;  
          $this->evento_adverso_numero_lote3 = $this->rs_grid->fields[37] ;  
          $this->evento_adverso_fecha_expiracion3 = $this->rs_grid->fields[38] ;  
          $this->evento_adverso_fecha_inicio3 = $this->rs_grid->fields[39] ;  
          $this->evento_adverso_tratamiento_continua3 = $this->rs_grid->fields[40] ;  
          $this->evento_adverso_muestra_disponible = $this->rs_grid->fields[41] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->evento_adverso_informacion_muestra = "";  
              if (is_file($this->rs_grid->fields[42])) 
              { 
                  $this->evento_adverso_informacion_muestra = file_get_contents($this->rs_grid->fields[42]);  
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $this->evento_adverso_informacion_muestra = $this->Db->BlobDecode($this->rs_grid->fields[42]) ;  
          } 
          else 
          { 
              $this->evento_adverso_informacion_muestra = $this->rs_grid->fields[42] ;  
          } 
          $this->evento_adverso_relacion_medicamento1 = $this->rs_grid->fields[43] ;  
          $this->evento_adverso_relacionado_dispositivo1 = $this->rs_grid->fields[44] ;  
          $this->evento_adverso_fecha_inicio_evento1 = $this->rs_grid->fields[45] ;  
          $this->evento_adverso_desenlace1 = $this->rs_grid->fields[46] ;  
          $this->evento_adverso_fecha_recuperacion1 = $this->rs_grid->fields[47] ;  
          $this->evento_adverso_fecha_muerte1 = $this->rs_grid->fields[48] ;  
          $this->evento_adverso_criterio_seriedad1 = $this->rs_grid->fields[49] ;  
          $this->evento_adverso_criterio_seriedad_muerte1 = $this->rs_grid->fields[50] ;  
          $this->evento_adverso_criterio_seriedad_hospitalizacion1 = $this->rs_grid->fields[51] ;  
          $this->evento_adverso_criterio_seriedad_amenaza1 = $this->rs_grid->fields[52] ;  
          $this->evento_adverso_criterio_seriedad_incapacidad1 = $this->rs_grid->fields[53] ;  
          $this->evento_adverso_criterio_seriedad_anormalidad1 = $this->rs_grid->fields[54] ;  
          $this->evento_adverso_criterio_seriedad_evento1 = $this->rs_grid->fields[55] ;  
          $this->evento_adverso_criterio_seriedad_quirurgica1 = $this->rs_grid->fields[56] ;  
          $this->evento_adverso_causa_muerte1 = $this->rs_grid->fields[57] ;  
          $this->evento_adverso_detalles_ea1 = $this->rs_grid->fields[58] ;  
          $this->evento_adverso_relacion_medicamento2 = $this->rs_grid->fields[59] ;  
          $this->evento_adverso_relacionado_dispositivo2 = $this->rs_grid->fields[60] ;  
          $this->evento_adverso_fecha_inicio_evento2 = $this->rs_grid->fields[61] ;  
          $this->evento_adverso_desenlace2 = $this->rs_grid->fields[62] ;  
          $this->evento_adverso_fecha_recuperacion2 = $this->rs_grid->fields[63] ;  
          $this->evento_adverso_fecha_muerte2 = $this->rs_grid->fields[64] ;  
          $this->evento_adverso_criterio_seriedad2 = $this->rs_grid->fields[65] ;  
          $this->evento_adverso_criterio_seriedad_muerte2 = $this->rs_grid->fields[66] ;  
          $this->evento_adverso_criterio_seriedad_hospitalizacion2 = $this->rs_grid->fields[67] ;  
          $this->evento_adverso_criterio_seriedad_amenaza2 = $this->rs_grid->fields[68] ;  
          $this->evento_adverso_criterio_seriedad_incapacidad2 = $this->rs_grid->fields[69] ;  
          $this->evento_adverso_criterio_seriedad_anormalidad2 = $this->rs_grid->fields[70] ;  
          $this->evento_adverso_criterio_seriedad_evento2 = $this->rs_grid->fields[71] ;  
          $this->evento_adverso_criterio_seriedad_quirurgica2 = $this->rs_grid->fields[72] ;  
          $this->evento_adverso_causa_muerte2 = $this->rs_grid->fields[73] ;  
          $this->evento_adverso_detalles_ea2 = $this->rs_grid->fields[74] ;  
          $this->evento_adverso_relacion_medicamento3 = $this->rs_grid->fields[75] ;  
          $this->evento_adverso_relacionado_dispositivo3 = $this->rs_grid->fields[76] ;  
          $this->evento_adverso_fecha_inicio_evento3 = $this->rs_grid->fields[77] ;  
          $this->evento_adverso_desenlace3 = $this->rs_grid->fields[78] ;  
          $this->evento_adverso_fecha_recuperacion3 = $this->rs_grid->fields[79] ;  
          $this->evento_adverso_fecha_muerte3 = $this->rs_grid->fields[80] ;  
          $this->evento_adverso_criterio_seriedad3 = $this->rs_grid->fields[81] ;  
          $this->evento_adverso_criterio_seriedad_muerte3 = $this->rs_grid->fields[82] ;  
          $this->evento_adverso_criterio_seriedad_hospitalizacion3 = $this->rs_grid->fields[83] ;  
          $this->evento_adverso_criterio_seriedad_amenaza3 = $this->rs_grid->fields[84] ;  
          $this->evento_adverso_criterio_seriedad_incapacidad3 = $this->rs_grid->fields[85] ;  
          $this->evento_adverso_criterio_seriedad_anormalidad3 = $this->rs_grid->fields[86] ;  
          $this->evento_adverso_criterio_seriedad_evento3 = $this->rs_grid->fields[87] ;  
          $this->evento_adverso_criterio_seriedad_quirurgica3 = $this->rs_grid->fields[88] ;  
          $this->evento_adverso_causa_muerte3 = $this->rs_grid->fields[89] ;  
          $this->evento_adverso_detalles_ea3 = $this->rs_grid->fields[90] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->evento_adverso_informacion_adicional = "";  
              if (is_file($this->rs_grid->fields[91])) 
              { 
                  $this->evento_adverso_informacion_adicional = file_get_contents($this->rs_grid->fields[91]);  
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $this->evento_adverso_informacion_adicional = $this->Db->BlobDecode($this->rs_grid->fields[91]) ;  
          } 
          else 
          { 
              $this->evento_adverso_informacion_adicional = $this->rs_grid->fields[91] ;  
          } 
          $this->evento_adverso_nombre_reporte = $this->rs_grid->fields[92] ;  
          $this->evento_adverso_id_paciente_fk = $this->rs_grid->fields[93] ;  
          $this->evento_adverso_id_paciente_fk = (string)$this->evento_adverso_id_paciente_fk;
          $this->evento_adverso_medicamento1 = $this->rs_grid->fields[94] ;  
          $this->evento_adverso_medicamento2 = $this->rs_grid->fields[95] ;  
          $this->evento_adverso_medicamento3 = $this->rs_grid->fields[96] ;  
          $this->evento_adverso_informacion_ea1 = $this->rs_grid->fields[97] ;  
          $this->evento_adverso_informacion_ea2 = $this->rs_grid->fields[98] ;  
          $this->evento_adverso_informacion_ea3 = $this->rs_grid->fields[99] ;  
          $this->evento_adverso_fecha_suspencion1 = $this->rs_grid->fields[100] ;  
          $this->evento_adverso_fecha_suspencion2 = $this->rs_grid->fields[101] ;  
          $this->evento_adverso_fecha_suspencion3 = $this->rs_grid->fields[102] ;  
          $this->evento_adverso_fecha_evento_adverso = $this->rs_grid->fields[103] ;  
          $this->evento_adverso_nombre_reportante_primario = $this->rs_grid->fields[104] ;  
          $this->evento_adverso_telefono_reportante_primario = $this->rs_grid->fields[105] ;  
          $this->evento_adverso_tipo_reportante = $this->rs_grid->fields[106] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          { 
              if (!empty($this->evento_adverso_informacion_muestra))
              { 
                  $this->evento_adverso_informacion_muestra = $this->Db->BlobDecode($this->evento_adverso_informacion_muestra, false, true, "BLOB");
              }
              if (!empty($this->evento_adverso_informacion_adicional))
              { 
                  $this->evento_adverso_informacion_adicional = $this->Db->BlobDecode($this->evento_adverso_informacion_adicional, false, true, "BLOB");
              }
          }
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final'] + 1; 
          if (!$ini_grid) {
              $this->SC_sep_quebra = true;
          }
          else {
              $ini_grid = false;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['rows_emb']++;
          $this->sc_proc_grid = true;
          $nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['final']; 
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
          }
          $this->SC_ancora = $this->SC_seq_page;
          $nm_saida->saida("    <TR  class=\"" . $this->css_line_back . "\"" . $NM_destaque . " id=\"SC_ancor" . $this->SC_ancora . "\">\r\n");
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_tipo_reportante_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
          } 
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf" || isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['paginacao']))
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
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
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['exibe_total'] == "S")
       { 
           $this->quebra_geral_top() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao']       = "igual" ; 
   } 
 }
 function NM_grid_evento_adverso_id_evento_adverso()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_id_evento_adverso']) || $this->NM_cmp_hidden['evento_adverso_id_evento_adverso'] != "off") { 
          $conteudo = NM_encode_input($this->evento_adverso_id_evento_adverso); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_id_evento_adverso_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_id_evento_adverso_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_id_evento_adverso_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_pais()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_pais']) || $this->NM_cmp_hidden['evento_adverso_pais'] != "off") { 
          $conteudo = $this->evento_adverso_pais; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_pais_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_pais_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_pais_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_tipo_reporte()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_tipo_reporte']) || $this->NM_cmp_hidden['evento_adverso_tipo_reporte'] != "off") { 
          $conteudo = $this->evento_adverso_tipo_reporte; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_tipo_reporte_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_tipo_reporte_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_tipo_reporte_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_staff()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_staff']) || $this->NM_cmp_hidden['evento_adverso_fecha_staff'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_staff; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_staff_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_staff_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_staff_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_producto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_producto']) || $this->NM_cmp_hidden['evento_adverso_producto'] != "off") { 
          $conteudo = $this->evento_adverso_producto; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_producto_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_producto_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_producto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_ciudad()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_ciudad']) || $this->NM_cmp_hidden['evento_adverso_ciudad'] != "off") { 
          $conteudo = $this->evento_adverso_ciudad; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_ciudad_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_ciudad_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_ciudad_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_genero()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_genero']) || $this->NM_cmp_hidden['evento_adverso_genero'] != "off") { 
          $conteudo = $this->evento_adverso_genero; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_genero_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_genero_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_genero_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_nacimiento()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_nacimiento']) || $this->NM_cmp_hidden['evento_adverso_fecha_nacimiento'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_nacimiento; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_nacimiento_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_nacimiento_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_nacimiento_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_embarazo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_embarazo']) || $this->NM_cmp_hidden['evento_adverso_embarazo'] != "off") { 
          $conteudo = $this->evento_adverso_embarazo; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_embarazo_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_embarazo_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_embarazo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_parto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_parto']) || $this->NM_cmp_hidden['evento_adverso_fecha_parto'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_parto; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_parto_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_parto_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_parto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_desenlace()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_desenlace']) || $this->NM_cmp_hidden['evento_adverso_desenlace'] != "off") { 
          $conteudo = $this->evento_adverso_desenlace; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_desenlace_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_desenlace_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_desenlace_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_cuales_desenlaces()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_cuales_desenlaces']) || $this->NM_cmp_hidden['evento_adverso_cuales_desenlaces'] != "off") { 
          $conteudo = $this->evento_adverso_cuales_desenlaces; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_cuales_desenlaces_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_cuales_desenlaces_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_cuales_desenlaces_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_contacto_directo()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_contacto_directo']) || $this->NM_cmp_hidden['evento_adverso_contacto_directo'] != "off") { 
          $conteudo = $this->evento_adverso_contacto_directo; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_contacto_directo_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_contacto_directo_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_contacto_directo_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_nombre_medico()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_nombre_medico']) || $this->NM_cmp_hidden['evento_adverso_nombre_medico'] != "off") { 
          $conteudo = $this->evento_adverso_nombre_medico; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_nombre_medico_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_nombre_medico_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_nombre_medico_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_telefono_medico()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_telefono_medico']) || $this->NM_cmp_hidden['evento_adverso_telefono_medico'] != "off") { 
          $conteudo = $this->evento_adverso_telefono_medico; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_telefono_medico_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_telefono_medico_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_telefono_medico_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fax_medico()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fax_medico']) || $this->NM_cmp_hidden['evento_adverso_fax_medico'] != "off") { 
          $conteudo = $this->evento_adverso_fax_medico; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fax_medico_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fax_medico_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fax_medico_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_email_medico()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_email_medico']) || $this->NM_cmp_hidden['evento_adverso_email_medico'] != "off") { 
          $conteudo = $this->evento_adverso_email_medico; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_email_medico_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_email_medico_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_email_medico_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_indicacion1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_indicacion1']) || $this->NM_cmp_hidden['evento_adverso_indicacion1'] != "off") { 
          $conteudo = $this->evento_adverso_indicacion1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_indicacion1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_indicacion1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_indicacion1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_formulacion1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_formulacion1']) || $this->NM_cmp_hidden['evento_adverso_formulacion1'] != "off") { 
          $conteudo = $this->evento_adverso_formulacion1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_formulacion1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_formulacion1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_formulacion1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_regimen_dosis1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_regimen_dosis1']) || $this->NM_cmp_hidden['evento_adverso_regimen_dosis1'] != "off") { 
          $conteudo = $this->evento_adverso_regimen_dosis1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_regimen_dosis1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_regimen_dosis1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_regimen_dosis1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_ruta_administracion1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_ruta_administracion1']) || $this->NM_cmp_hidden['evento_adverso_ruta_administracion1'] != "off") { 
          $conteudo = $this->evento_adverso_ruta_administracion1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_ruta_administracion1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_ruta_administracion1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_ruta_administracion1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_numero_lote1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_numero_lote1']) || $this->NM_cmp_hidden['evento_adverso_numero_lote1'] != "off") { 
          $conteudo = $this->evento_adverso_numero_lote1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_numero_lote1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_numero_lote1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_numero_lote1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_expiracion1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_expiracion1']) || $this->NM_cmp_hidden['evento_adverso_fecha_expiracion1'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_expiracion1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_expiracion1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_expiracion1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_expiracion1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_inicio1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio1']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio1'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_inicio1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_inicio1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_inicio1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_inicio1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_tratamiento_continua1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_tratamiento_continua1']) || $this->NM_cmp_hidden['evento_adverso_tratamiento_continua1'] != "off") { 
          $conteudo = $this->evento_adverso_tratamiento_continua1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_tratamiento_continua1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_tratamiento_continua1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_tratamiento_continua1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_indicacion2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_indicacion2']) || $this->NM_cmp_hidden['evento_adverso_indicacion2'] != "off") { 
          $conteudo = $this->evento_adverso_indicacion2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_indicacion2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_indicacion2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_indicacion2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_formulacion2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_formulacion2']) || $this->NM_cmp_hidden['evento_adverso_formulacion2'] != "off") { 
          $conteudo = $this->evento_adverso_formulacion2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_formulacion2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_formulacion2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_formulacion2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_regimen_dosis2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_regimen_dosis2']) || $this->NM_cmp_hidden['evento_adverso_regimen_dosis2'] != "off") { 
          $conteudo = $this->evento_adverso_regimen_dosis2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_regimen_dosis2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_regimen_dosis2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_regimen_dosis2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_ruta_administracion2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_ruta_administracion2']) || $this->NM_cmp_hidden['evento_adverso_ruta_administracion2'] != "off") { 
          $conteudo = $this->evento_adverso_ruta_administracion2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_ruta_administracion2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_ruta_administracion2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_ruta_administracion2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_numero_lote2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_numero_lote2']) || $this->NM_cmp_hidden['evento_adverso_numero_lote2'] != "off") { 
          $conteudo = $this->evento_adverso_numero_lote2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_numero_lote2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_numero_lote2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_numero_lote2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_expiracion2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_expiracion2']) || $this->NM_cmp_hidden['evento_adverso_fecha_expiracion2'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_expiracion2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_expiracion2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_expiracion2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_expiracion2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_inicio2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio2']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio2'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_inicio2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_inicio2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_inicio2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_inicio2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_tratamiento_continua2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_tratamiento_continua2']) || $this->NM_cmp_hidden['evento_adverso_tratamiento_continua2'] != "off") { 
          $conteudo = $this->evento_adverso_tratamiento_continua2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_tratamiento_continua2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_tratamiento_continua2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_tratamiento_continua2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_indicacion3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_indicacion3']) || $this->NM_cmp_hidden['evento_adverso_indicacion3'] != "off") { 
          $conteudo = $this->evento_adverso_indicacion3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_indicacion3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_indicacion3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_indicacion3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_formulacion3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_formulacion3']) || $this->NM_cmp_hidden['evento_adverso_formulacion3'] != "off") { 
          $conteudo = $this->evento_adverso_formulacion3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_formulacion3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_formulacion3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_formulacion3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_regimen_dosis3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_regimen_dosis3']) || $this->NM_cmp_hidden['evento_adverso_regimen_dosis3'] != "off") { 
          $conteudo = $this->evento_adverso_regimen_dosis3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_regimen_dosis3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_regimen_dosis3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_regimen_dosis3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_ruta_administracion3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_ruta_administracion3']) || $this->NM_cmp_hidden['evento_adverso_ruta_administracion3'] != "off") { 
          $conteudo = $this->evento_adverso_ruta_administracion3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_ruta_administracion3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_ruta_administracion3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_ruta_administracion3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_numero_lote3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_numero_lote3']) || $this->NM_cmp_hidden['evento_adverso_numero_lote3'] != "off") { 
          $conteudo = $this->evento_adverso_numero_lote3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_numero_lote3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_numero_lote3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_numero_lote3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_expiracion3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_expiracion3']) || $this->NM_cmp_hidden['evento_adverso_fecha_expiracion3'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_expiracion3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_expiracion3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_expiracion3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_expiracion3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_inicio3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio3']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio3'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_inicio3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_inicio3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_inicio3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_inicio3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_tratamiento_continua3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_tratamiento_continua3']) || $this->NM_cmp_hidden['evento_adverso_tratamiento_continua3'] != "off") { 
          $conteudo = $this->evento_adverso_tratamiento_continua3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_tratamiento_continua3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_tratamiento_continua3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_tratamiento_continua3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_muestra_disponible()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_muestra_disponible']) || $this->NM_cmp_hidden['evento_adverso_muestra_disponible'] != "off") { 
          $conteudo = $this->evento_adverso_muestra_disponible; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_muestra_disponible_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_muestra_disponible_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_muestra_disponible_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_informacion_muestra()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_muestra']) || $this->NM_cmp_hidden['evento_adverso_informacion_muestra'] != "off") { 
          $conteudo = $this->evento_adverso_informacion_muestra; 
          if ($conteudo == "" || empty($this->evento_adverso_informacion_muestra) || $this->evento_adverso_informacion_muestra == "none" || $this->evento_adverso_informacion_muestra == "*nm*") 
          { 
              $conteudo = "&nbsp;" ;  
              $out_evento_adverso_informacion_muestra = "" ; 
          } 
          else   
          { 
              $out_evento_adverso_informacion_muestra = $this->Ini->path_imag_temp . "/sc_evento_adverso_informacion_muestra_" . $_SESSION['scriptcase']['sc_num_img'] . session_id() . ".jpg" ;   
              $_SESSION['scriptcase']['sc_num_img']++ ; 
              $arq_evento_adverso_informacion_muestra = fopen($this->Ini->root . $out_evento_adverso_informacion_muestra, "w") ;  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
              { 
                  $nm_tmp = nm_conv_img_access(substr($conteudo, 0, 12));
                  if (substr($nm_tmp, 0, 4) == "*nm*") 
                  { 
                      $conteudo = nm_conv_img_access($conteudo);
                  } 
              } 
              if (substr($conteudo, 0, 4) == "*nm*") 
              { 
                  $conteudo = substr($conteudo, 4) ; 
                  $conteudo = base64_decode($conteudo) ; 
              } 
              $img_pos_bm = strpos($conteudo, "BM") ; 
              if (!$img_pos_bm === FALSE && $img_pos_bm == 78) 
              { 
                  $conteudo = substr($conteudo, $img_pos_bm) ; 
              } 
              fwrite($arq_evento_adverso_informacion_muestra, $conteudo) ;  
              fclose($arq_evento_adverso_informacion_muestra) ;  
              $sc_obj_img = new nm_trata_img($this->Ini->root . $out_evento_adverso_informacion_muestra);
              $nm_image_largura = $sc_obj_img->getWidth();
              $nm_image_altura  = $sc_obj_img->getHeight();
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_pdf'] != "pdf") 
              { 
                  $conteudo = "<a href=\"javascript:nm_mostra_img('" . $out_evento_adverso_informacion_muestra . "', $nm_image_altura, $nm_image_largura)\"><img border=\"0\" src=\"$out_evento_adverso_informacion_muestra\"/></a>"; 
              } 
              else 
              { 
                  $conteudo = "<img border=\"0\" src=\"" . $this->NM_raiz_img . $out_evento_adverso_informacion_muestra . "\"/>"; 
              } 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_informacion_muestra_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_informacion_muestra_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_informacion_muestra_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_relacion_medicamento1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_relacion_medicamento1']) || $this->NM_cmp_hidden['evento_adverso_relacion_medicamento1'] != "off") { 
          $conteudo = $this->evento_adverso_relacion_medicamento1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_relacion_medicamento1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_relacion_medicamento1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_relacion_medicamento1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_relacionado_dispositivo1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo1']) || $this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo1'] != "off") { 
          $conteudo = $this->evento_adverso_relacionado_dispositivo1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_relacionado_dispositivo1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_relacionado_dispositivo1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_relacionado_dispositivo1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_inicio_evento1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento1']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento1'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_inicio_evento1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_inicio_evento1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_inicio_evento1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_inicio_evento1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_desenlace1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_desenlace1']) || $this->NM_cmp_hidden['evento_adverso_desenlace1'] != "off") { 
          $conteudo = $this->evento_adverso_desenlace1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_desenlace1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_desenlace1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_desenlace1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_recuperacion1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_recuperacion1']) || $this->NM_cmp_hidden['evento_adverso_fecha_recuperacion1'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_recuperacion1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_recuperacion1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_recuperacion1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_recuperacion1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_muerte1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_muerte1']) || $this->NM_cmp_hidden['evento_adverso_fecha_muerte1'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_muerte1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_muerte1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_muerte1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_muerte1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad1'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_muerte1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte1'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_muerte1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_muerte1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_muerte1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_muerte1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_hospitalizacion1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion1'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_hospitalizacion1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_hospitalizacion1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_hospitalizacion1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_hospitalizacion1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_amenaza1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza1'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_amenaza1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_amenaza1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_amenaza1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_amenaza1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_incapacidad1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad1'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_incapacidad1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_incapacidad1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_incapacidad1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_incapacidad1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_anormalidad1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad1'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_anormalidad1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_anormalidad1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_anormalidad1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_anormalidad1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_evento1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento1'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_evento1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_evento1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_evento1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_evento1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_quirurgica1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica1']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica1'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_quirurgica1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_quirurgica1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_quirurgica1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_quirurgica1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_causa_muerte1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_causa_muerte1']) || $this->NM_cmp_hidden['evento_adverso_causa_muerte1'] != "off") { 
          $conteudo = $this->evento_adverso_causa_muerte1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_causa_muerte1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_causa_muerte1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_causa_muerte1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_detalles_ea1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_detalles_ea1']) || $this->NM_cmp_hidden['evento_adverso_detalles_ea1'] != "off") { 
          $conteudo = $this->evento_adverso_detalles_ea1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_detalles_ea1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_detalles_ea1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_detalles_ea1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_relacion_medicamento2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_relacion_medicamento2']) || $this->NM_cmp_hidden['evento_adverso_relacion_medicamento2'] != "off") { 
          $conteudo = $this->evento_adverso_relacion_medicamento2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_relacion_medicamento2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_relacion_medicamento2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_relacion_medicamento2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_relacionado_dispositivo2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo2']) || $this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo2'] != "off") { 
          $conteudo = $this->evento_adverso_relacionado_dispositivo2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_relacionado_dispositivo2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_relacionado_dispositivo2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_relacionado_dispositivo2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_inicio_evento2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento2']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento2'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_inicio_evento2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_inicio_evento2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_inicio_evento2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_inicio_evento2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_desenlace2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_desenlace2']) || $this->NM_cmp_hidden['evento_adverso_desenlace2'] != "off") { 
          $conteudo = $this->evento_adverso_desenlace2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_desenlace2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_desenlace2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_desenlace2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_recuperacion2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_recuperacion2']) || $this->NM_cmp_hidden['evento_adverso_fecha_recuperacion2'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_recuperacion2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_recuperacion2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_recuperacion2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_recuperacion2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_muerte2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_muerte2']) || $this->NM_cmp_hidden['evento_adverso_fecha_muerte2'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_muerte2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_muerte2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_muerte2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_muerte2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad2'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_muerte2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte2'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_muerte2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_muerte2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_muerte2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_muerte2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_hospitalizacion2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion2'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_hospitalizacion2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_hospitalizacion2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_hospitalizacion2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_hospitalizacion2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_amenaza2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza2'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_amenaza2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_amenaza2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_amenaza2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_amenaza2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_incapacidad2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad2'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_incapacidad2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_incapacidad2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_incapacidad2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_incapacidad2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_anormalidad2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad2'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_anormalidad2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_anormalidad2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_anormalidad2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_anormalidad2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_evento2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento2'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_evento2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_evento2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_evento2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_evento2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_quirurgica2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica2']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica2'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_quirurgica2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_quirurgica2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_quirurgica2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_quirurgica2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_causa_muerte2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_causa_muerte2']) || $this->NM_cmp_hidden['evento_adverso_causa_muerte2'] != "off") { 
          $conteudo = $this->evento_adverso_causa_muerte2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_causa_muerte2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_causa_muerte2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_causa_muerte2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_detalles_ea2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_detalles_ea2']) || $this->NM_cmp_hidden['evento_adverso_detalles_ea2'] != "off") { 
          $conteudo = $this->evento_adverso_detalles_ea2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_detalles_ea2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_detalles_ea2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_detalles_ea2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_relacion_medicamento3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_relacion_medicamento3']) || $this->NM_cmp_hidden['evento_adverso_relacion_medicamento3'] != "off") { 
          $conteudo = $this->evento_adverso_relacion_medicamento3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_relacion_medicamento3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_relacion_medicamento3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_relacion_medicamento3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_relacionado_dispositivo3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo3']) || $this->NM_cmp_hidden['evento_adverso_relacionado_dispositivo3'] != "off") { 
          $conteudo = $this->evento_adverso_relacionado_dispositivo3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_relacionado_dispositivo3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_relacionado_dispositivo3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_relacionado_dispositivo3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_inicio_evento3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento3']) || $this->NM_cmp_hidden['evento_adverso_fecha_inicio_evento3'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_inicio_evento3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_inicio_evento3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_inicio_evento3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_inicio_evento3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_desenlace3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_desenlace3']) || $this->NM_cmp_hidden['evento_adverso_desenlace3'] != "off") { 
          $conteudo = $this->evento_adverso_desenlace3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_desenlace3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_desenlace3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_desenlace3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_recuperacion3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_recuperacion3']) || $this->NM_cmp_hidden['evento_adverso_fecha_recuperacion3'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_recuperacion3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_recuperacion3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_recuperacion3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_recuperacion3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_muerte3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_muerte3']) || $this->NM_cmp_hidden['evento_adverso_fecha_muerte3'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_muerte3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_muerte3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_muerte3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_muerte3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad3'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_muerte3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_muerte3'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_muerte3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_muerte3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_muerte3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_muerte3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_hospitalizacion3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_hospitalizacion3'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_hospitalizacion3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_hospitalizacion3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_hospitalizacion3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_hospitalizacion3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_amenaza3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_amenaza3'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_amenaza3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_amenaza3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_amenaza3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_amenaza3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_incapacidad3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_incapacidad3'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_incapacidad3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_incapacidad3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_incapacidad3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_incapacidad3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_anormalidad3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_anormalidad3'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_anormalidad3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_anormalidad3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_anormalidad3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_anormalidad3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_evento3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_evento3'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_evento3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_evento3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_evento3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_evento3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_criterio_seriedad_quirurgica3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica3']) || $this->NM_cmp_hidden['evento_adverso_criterio_seriedad_quirurgica3'] != "off") { 
          $conteudo = $this->evento_adverso_criterio_seriedad_quirurgica3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_criterio_seriedad_quirurgica3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_criterio_seriedad_quirurgica3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_criterio_seriedad_quirurgica3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_causa_muerte3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_causa_muerte3']) || $this->NM_cmp_hidden['evento_adverso_causa_muerte3'] != "off") { 
          $conteudo = $this->evento_adverso_causa_muerte3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_causa_muerte3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_causa_muerte3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_causa_muerte3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_detalles_ea3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_detalles_ea3']) || $this->NM_cmp_hidden['evento_adverso_detalles_ea3'] != "off") { 
          $conteudo = $this->evento_adverso_detalles_ea3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_detalles_ea3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_detalles_ea3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_detalles_ea3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_informacion_adicional()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_adicional']) || $this->NM_cmp_hidden['evento_adverso_informacion_adicional'] != "off") { 
          $conteudo = $this->evento_adverso_informacion_adicional; 
          if ($conteudo == "" || empty($this->evento_adverso_informacion_adicional) || $this->evento_adverso_informacion_adicional == "none" || $this->evento_adverso_informacion_adicional == "*nm*") 
          { 
              $conteudo = "&nbsp;" ;  
              $out_evento_adverso_informacion_adicional = "" ; 
          } 
          else   
          { 
              $out_evento_adverso_informacion_adicional = $this->Ini->path_imag_temp . "/sc_evento_adverso_informacion_adicional_" . $_SESSION['scriptcase']['sc_num_img'] . session_id() . ".jpg" ;   
              $_SESSION['scriptcase']['sc_num_img']++ ; 
              $arq_evento_adverso_informacion_adicional = fopen($this->Ini->root . $out_evento_adverso_informacion_adicional, "w") ;  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
              { 
                  $nm_tmp = nm_conv_img_access(substr($conteudo, 0, 12));
                  if (substr($nm_tmp, 0, 4) == "*nm*") 
                  { 
                      $conteudo = nm_conv_img_access($conteudo);
                  } 
              } 
              if (substr($conteudo, 0, 4) == "*nm*") 
              { 
                  $conteudo = substr($conteudo, 4) ; 
                  $conteudo = base64_decode($conteudo) ; 
              } 
              $img_pos_bm = strpos($conteudo, "BM") ; 
              if (!$img_pos_bm === FALSE && $img_pos_bm == 78) 
              { 
                  $conteudo = substr($conteudo, $img_pos_bm) ; 
              } 
              fwrite($arq_evento_adverso_informacion_adicional, $conteudo) ;  
              fclose($arq_evento_adverso_informacion_adicional) ;  
              $sc_obj_img = new nm_trata_img($this->Ini->root . $out_evento_adverso_informacion_adicional);
              $nm_image_largura = $sc_obj_img->getWidth();
              $nm_image_altura  = $sc_obj_img->getHeight();
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida_pdf'] != "pdf") 
              { 
                  $conteudo = "<a href=\"javascript:nm_mostra_img('" . $out_evento_adverso_informacion_adicional . "', $nm_image_altura, $nm_image_largura)\"><img border=\"0\" src=\"$out_evento_adverso_informacion_adicional\"/></a>"; 
              } 
              else 
              { 
                  $conteudo = "<img border=\"0\" src=\"" . $this->NM_raiz_img . $out_evento_adverso_informacion_adicional . "\"/>"; 
              } 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_informacion_adicional_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_informacion_adicional_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_informacion_adicional_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_nombre_reporte()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_nombre_reporte']) || $this->NM_cmp_hidden['evento_adverso_nombre_reporte'] != "off") { 
          $conteudo = $this->evento_adverso_nombre_reporte; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_nombre_reporte_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_nombre_reporte_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_nombre_reporte_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_id_paciente_fk()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_id_paciente_fk']) || $this->NM_cmp_hidden['evento_adverso_id_paciente_fk'] != "off") { 
          $conteudo = NM_encode_input($this->evento_adverso_id_paciente_fk); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_id_paciente_fk_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_id_paciente_fk_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_id_paciente_fk_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_medicamento1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_medicamento1']) || $this->NM_cmp_hidden['evento_adverso_medicamento1'] != "off") { 
          $conteudo = $this->evento_adverso_medicamento1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_medicamento1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_medicamento1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_medicamento1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_medicamento2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_medicamento2']) || $this->NM_cmp_hidden['evento_adverso_medicamento2'] != "off") { 
          $conteudo = $this->evento_adverso_medicamento2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_medicamento2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_medicamento2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_medicamento2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_medicamento3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_medicamento3']) || $this->NM_cmp_hidden['evento_adverso_medicamento3'] != "off") { 
          $conteudo = $this->evento_adverso_medicamento3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_medicamento3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_medicamento3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_medicamento3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_informacion_ea1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_ea1']) || $this->NM_cmp_hidden['evento_adverso_informacion_ea1'] != "off") { 
          $conteudo = $this->evento_adverso_informacion_ea1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_informacion_ea1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_informacion_ea1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_informacion_ea1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_informacion_ea2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_ea2']) || $this->NM_cmp_hidden['evento_adverso_informacion_ea2'] != "off") { 
          $conteudo = $this->evento_adverso_informacion_ea2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_informacion_ea2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_informacion_ea2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_informacion_ea2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_informacion_ea3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_informacion_ea3']) || $this->NM_cmp_hidden['evento_adverso_informacion_ea3'] != "off") { 
          $conteudo = $this->evento_adverso_informacion_ea3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_informacion_ea3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_informacion_ea3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_informacion_ea3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_suspencion1()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_suspencion1']) || $this->NM_cmp_hidden['evento_adverso_fecha_suspencion1'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_suspencion1; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_suspencion1_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_suspencion1_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_suspencion1_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_suspencion2()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_suspencion2']) || $this->NM_cmp_hidden['evento_adverso_fecha_suspencion2'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_suspencion2; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_suspencion2_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_suspencion2_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_suspencion2_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_suspencion3()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_suspencion3']) || $this->NM_cmp_hidden['evento_adverso_fecha_suspencion3'] != "off") { 
          $conteudo = $this->evento_adverso_fecha_suspencion3; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_suspencion3_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_suspencion3_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_suspencion3_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_fecha_evento_adverso()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_fecha_evento_adverso']) || $this->NM_cmp_hidden['evento_adverso_fecha_evento_adverso'] != "off") { 
          $conteudo = NM_encode_input($this->evento_adverso_fecha_evento_adverso); 
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
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_fecha_evento_adverso_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_fecha_evento_adverso_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_fecha_evento_adverso_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_nombre_reportante_primario()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_nombre_reportante_primario']) || $this->NM_cmp_hidden['evento_adverso_nombre_reportante_primario'] != "off") { 
          $conteudo = $this->evento_adverso_nombre_reportante_primario; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_nombre_reportante_primario_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_nombre_reportante_primario_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_nombre_reportante_primario_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_telefono_reportante_primario()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_telefono_reportante_primario']) || $this->NM_cmp_hidden['evento_adverso_telefono_reportante_primario'] != "off") { 
          $conteudo = $this->evento_adverso_telefono_reportante_primario; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_telefono_reportante_primario_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_telefono_reportante_primario_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_telefono_reportante_primario_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_evento_adverso_tipo_reportante()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['evento_adverso_tipo_reportante']) || $this->NM_cmp_hidden['evento_adverso_tipo_reportante'] != "off") { 
          $conteudo = $this->evento_adverso_tipo_reportante; 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_evento_adverso_tipo_reportante_grid_line . "\"  style=\"" . $this->Css_Cmp['css_evento_adverso_tipo_reportante_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_evento_adverso_tipo_reportante_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 107;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'][2] : "";
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "EA/EA_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnSelCamposShow('" . $this->Ini->path_link . "EA/EA_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "selcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "EA/EA_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnOrderCamposShow('" . $this->Ini->path_link . "EA/EA_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
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
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "EA/EA_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=XX&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&language=es&conf_socor=S&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "EA/EA_config_word.php?nm_cor=AM&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0')", "nm_gp_move('xls', '0')", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0')", "nm_gp_move('xml', '0')", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '0')", "nm_gp_move('csv', '0')", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
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
          if (is_file("EA_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("EA_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full)
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'])
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_modal'])
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
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['paginacao']))
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid'];
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "birpara", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav)", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav)", "brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $Page_Atu   = ceil($this->nmgp_reg_inicial / $Reg_Page);
              $nm_saida->saida("          <input id=\"rec_f0_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" name=\"rec\" value=\"" . NM_encode_input($Page_Atu) . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
              $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['paginacao']))
          {
              $nm_saida->saida("          <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
              $nm_saida->saida("          <select class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" id=\"quant_linhas_f0_bot\" name=\"nmgp_quant_linhas\" onchange=\"sc_ind = document.getElementById('quant_linhas_f0_bot').selectedIndex; nm_gp_submit_ajax('muda_qt_linhas', document.getElementById('quant_linhas_f0_bot').options[sc_ind].value)\"> \r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid'] == 10) ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid'] == 20) ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid'] == 50) ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['paginacao']))
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['qt_lin_grid'];
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']))
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
          if (is_file("EA_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("EA_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print") 
      {
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['qsearch'] == "on")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['fast_search'][2] : "";
          $nm_saida->saida("           <script type=\"text/javascript\">var change_fast_top = \"\";</script>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "EA/EA_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=XX&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&language=es&conf_socor=S&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['word'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "word_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "EA/EA_config_word.php?nm_cor=AM&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0')", "nm_gp_move('xls', '0')", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['xml'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml', '0')", "nm_gp_move('xml', '0')", "xml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['csv'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv', '0')", "nm_gp_move('csv', '0')", "csv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['rtf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_move('rtf', '0')", "nm_gp_move('rtf', '0')", "rtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "EA/EA_config_print.php?nm_opc=AM&nm_cor=AM&language=es&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
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
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['filter'] == "on"  && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpesquisa", "nm_gp_move('busca', '0', 'grid')", "nm_gp_move('busca', '0', 'grid')", "pesq_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_2_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "EA/EA_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnSelCamposShow('" . $this->Ini->path_link . "EA/EA_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "selcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if ($this->nmgp_botoes['sort_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsort", "scBtnOrderCamposShow('" . $this->Ini->path_link . "EA/EA_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnOrderCamposShow('" . $this->Ini->path_link . "EA/EA_order_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "ordcmp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_2", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
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
          if (is_file("EA_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("EA_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao_print'] != "print") 
      {
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim')", "nm_gp_submit_rec('fim')", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if (is_file("EA_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("EA_help.txt"); 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
   { 
        return;
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   <div id=\"sc-id-fixedheaders-placeholder\" style=\"display: none; position: fixed; top: 0\"></div>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['EA']['embutida'])
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   $nm_saida->saida("  $(window).scroll(function() {\r\n");
   $nm_saida->saida("   scSetFixedHeaders();\r\n");
   $nm_saida->saida("  }).resize(function() {\r\n");
   $nm_saida->saida("   scSetFixedHeaders();\r\n");
   $nm_saida->saida("  });\r\n");
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
       $nm_saida->saida("      parent.scAjaxDetailHeight('EA', $(document).innerHeight());\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"EA\"/>\r\n");
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
   $nm_saida->saida("                     action=\"EA_pesq.class.php\" \r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['ajax_nav'])
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
   $nm_saida->saida("   function nm_gp_submit3(parms, parm_acum, opc, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target               = \"_self\"; \r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parm_acum.value = parm_acum ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_opcao.value     = opc ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = \"\";\r\n");
   $nm_saida->saida("      document.F3.action               = \"./\"  ;\r\n");
   $nm_saida->saida("      if (ancor != null) {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['EA_iframe_params'] = array(
       'str_tmp'    => $this->Ini->path_imag_temp,
       'str_prod'   => $this->Ini->path_prod,
       'str_btn'    => $this->Ini->Str_btn_css,
       'str_lang'   => $this->Ini->str_lang,
       'str_schema' => $this->Ini->str_schema_all,
   );
   $nm_saida->saida("       if (\"pdf\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           window.location = \"" . $this->Ini->path_link . "EA/EA_iframe.php?scsess=" . session_id() . "&str_tmp=" . $this->Ini->path_imag_temp . "&str_prod=" . $this->Ini->path_prod . "&str_btn=" . $this->Ini->Str_btn_css . "&str_lang=" . $this->Ini->str_lang . "&str_schema=" . $this->Ini->str_schema_all . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&pbfile=" . urlencode($str_pbfile) . "&jspath=" . urlencode($this->Ini->path_js) . "&sc_apbgcol=" . urlencode($this->Ini->path_css) . "&sc_tp_pdf=\" + z + \"&sc_parms_pdf=\" + p + \"&sc_graf_pdf=\" + g;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if ((x == 'igual' || x == 'edit') && NM_ancor_ult_lig != \"\")\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("                ajax_save_ancor(\"F3\", NM_ancor_ult_lig);\r\n");
   $nm_saida->saida("                NM_ancor_ult_lig = \"\";\r\n");
   $nm_saida->saida("            } else {\r\n");
   $nm_saida->saida("                document.F3.submit() ;\r\n");
   $nm_saida->saida("            } \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_print_conf(tp, cor)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       window.open('" . $this->Ini->path_link . "EA/EA_iframe_prt.php?path_botoes=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&opcao=print&tp_print=' + tp + '&cor_print=' + cor,'','location=no,menubar,resizable,scrollbars,status=no,toolbar');\r\n");
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
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campo_psq_ret']) && empty($this->nm_grid_sem_reg))
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['sc_modal'])
      {
          $nm_saida->saida("          var Obj_Form = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Doc = parent;\r\n");
          $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campo_psq_ret'] . "\");\r\n");
          $nm_saida->saida("          }\r\n");
      }
      else
      {
          $nm_saida->saida("          var Obj_Form = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Doc = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['campo_psq_ret'] . "\");\r\n");
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
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['EA']['js_apos_busca'] . "();\r\n");
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
   $nm_saida->saida("      document.F5.action = \"EA_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['EA']['reg_start']))
   {
       $nm_saida->saida("      parent.scAjaxDetailStatus('EA');\r\n");
       $nm_saida->saida("      parent.scAjaxDetailHeight('EA', $(document).innerHeight());\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>

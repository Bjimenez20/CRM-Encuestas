<?php

class generador_de_informes_resumo
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $total;
   var $tipo;
   var $nm_data;
   var $NM_res_sem_reg;
   var $NM_export;
   var $prim_linha;
   var $que_linha;
   var $css_line_back; 
   var $css_line_fonf; 
   var $comando_grafico;
   var $resumo_campos;
   var $nm_location;
   var $Print_All;
   var $NM_raiz_img; 
   var $NM_tit_val; 
   var $NM_totaliz_hrz; 
   var $link_graph_tot; 
   var $Tot_ger; 
   var $array_total_pacientes_id_paciente;
   var $array_total_pacientes_estado_paciente;
   var $array_total_pacientes_fecha_activacion_paciente;
   var $array_total_pacientes_fecha_retiro_paciente;
   var $array_total_pacientes_motivo_retiro_paciente;
   var $array_total_pacientes_observacion_motivo_retiro_paciente;
   var $array_total_pacientes_identificacion_paciente;
   var $array_total_pacientes_nombre_paciente;
   var $array_total_pacientes_apellido_paciente;
   var $array_total_pacientes_telefono_paciente;
   var $array_total_pacientes_telefono2_paciente;
   var $array_total_pacientes_telefono3_paciente;
   var $array_total_pacientes_correo_paciente;
   var $array_total_pacientes_direccion_paciente;
   var $array_total_pacientes_barrio_paciente;
   var $array_total_pacientes_departamento_paciente;
   var $array_total_pacientes_ciudad_paciente;
   var $array_total_pacientes_genero_paciente;
   var $array_total_pacientes_fecha_nacimineto_paciente;
   var $array_total_pacientes_edad_paciente;
   var $array_total_pacientes_acudiente_paciente;
   var $array_total_pacientes_telefono_acudiente_paciente;
   var $array_total_pacientes_codigo_xofigo;
   var $array_total_pacientes_status_paciente;
   var $array_total_pacientes_id_ultima_gestion;
   var $array_total_pacientes_usuario_creacion;
   var $array_total_tratamiento_id_tratamiento;
   var $array_total_tratamiento_producto_tratamiento;
   var $array_total_tratamiento_nombre_referencia;
   var $array_total_tratamiento_clasificacion_patologica_tratamiento;
   var $array_total_tratamiento_tratamiento_previo;
   var $array_total_tratamiento_consentimiento_tratamiento;
   var $array_total_tratamiento_fecha_inicio_terapia_tratamiento;
   var $array_total_tratamiento_regimen_tratamiento;
   var $array_total_tratamiento_asegurador_tratamiento;
   var $array_total_tratamiento_operador_logistico_tratamiento;
   var $array_total_tratamiento_punto_entrega;
   var $array_total_tratamiento_fecha_ultima_reclamacion_tratamiento;
   var $array_total_tratamiento_otros_operadores_tratamiento;
   var $array_total_tratamiento_medios_adquisicion_tratamiento;
   var $array_total_tratamiento_ips_atiende_tratamiento;
   var $array_total_tratamiento_medico_tratamiento;
   var $array_total_tratamiento_especialidad_tratamiento;
   var $array_total_tratamiento_paramedico_tratamiento;
   var $array_total_tratamiento_zona_atencion_paramedico_tratamiento;
   var $array_total_tratamiento_ciudad_base_paramedico_tratamiento;
   var $array_total_tratamiento_notas_adjuntos_tratamiento;
   var $array_total_tratamiento_id_paciente_fk;
   var $array_total_gestiones_id_gestion;
   var $array_total_gestiones_motivo_comunicacion_gestion;
   var $array_total_gestiones_medio_contacto_gestion;
   var $array_total_gestiones_tipo_llamada_gestion;
   var $array_total_gestiones_logro_comunicacion_gestion;
   var $array_total_gestiones_motivo_no_comunicacion_gestion;
   var $array_total_gestiones_numero_intentos_gestion;
   var $array_total_gestiones_esperado_gestion;
   var $array_total_gestiones_estado_ctc_gestion;
   var $array_total_gestiones_estado_farmacia_gestion;
   var $array_total_gestiones_reclamo_gestion;
   var $array_total_gestiones_causa_no_reclamacion_gestion;
   var $array_total_gestiones_dificultad_acceso_gestion;
   var $array_total_gestiones_tipo_dificultad_gestion;
   var $array_total_gestiones_envios_gestion;
   var $array_total_gestiones_medicamentos_gestion;
   var $array_total_gestiones_tipo_envio_gestion;
   var $array_total_gestiones_evento_adverso_gestion;
   var $array_total_gestiones_tipo_evento_adverso;
   var $array_total_gestiones_genera_solicitud_gestion;
   var $array_total_gestiones_fecha_proxima_llamada;
   var $array_total_gestiones_motivo_proxima_llamada;
   var $array_total_gestiones_observacion_proxima_llamada;
   var $array_total_gestiones_fecha_reclamacion_gestion;
   var $array_total_gestiones_consecutivo_gestion;
   var $array_total_gestiones_autor_gestion;
   var $array_total_gestiones_nota;
   var $array_total_gestiones_fecha_programada_gestion;
   var $array_total_gestiones_usuario_asigando;
   var $array_total_gestiones_id_paciente_fk2;
   var $array_total_gestiones_fecha_comunicacion;
   var $array_total_gestiones_estado_gestion;
   var $array_total_gestiones_codigo_argus;
   var $array_total_gestiones_numero_cajas;
   var $array_total_geral;
   var $array_tot_lin;
   var $array_final;
   var $array_links;
   var $array_links_tit;
   var $array_export;
   var $quant_colunas;
   var $conv_col;
   var $count_ger;
   var $sc_proc_quebra_pacientes_id_paciente;
   var $count_pacientes_id_paciente;
   var $sc_proc_quebra_pacientes_estado_paciente;
   var $count_pacientes_estado_paciente;
   var $sc_proc_quebra_pacientes_fecha_activacion_paciente;
   var $count_pacientes_fecha_activacion_paciente;
   var $sc_proc_quebra_pacientes_fecha_retiro_paciente;
   var $count_pacientes_fecha_retiro_paciente;
   var $sc_proc_quebra_pacientes_motivo_retiro_paciente;
   var $count_pacientes_motivo_retiro_paciente;
   var $sc_proc_quebra_pacientes_observacion_motivo_retiro_paciente;
   var $count_pacientes_observacion_motivo_retiro_paciente;
   var $sc_proc_quebra_pacientes_identificacion_paciente;
   var $count_pacientes_identificacion_paciente;
   var $sc_proc_quebra_pacientes_nombre_paciente;
   var $count_pacientes_nombre_paciente;
   var $sc_proc_quebra_pacientes_apellido_paciente;
   var $count_pacientes_apellido_paciente;
   var $sc_proc_quebra_pacientes_telefono_paciente;
   var $count_pacientes_telefono_paciente;
   var $sc_proc_quebra_pacientes_telefono2_paciente;
   var $count_pacientes_telefono2_paciente;
   var $sc_proc_quebra_pacientes_telefono3_paciente;
   var $count_pacientes_telefono3_paciente;
   var $sc_proc_quebra_pacientes_correo_paciente;
   var $count_pacientes_correo_paciente;
   var $sc_proc_quebra_pacientes_direccion_paciente;
   var $count_pacientes_direccion_paciente;
   var $sc_proc_quebra_pacientes_barrio_paciente;
   var $count_pacientes_barrio_paciente;
   var $sc_proc_quebra_pacientes_departamento_paciente;
   var $count_pacientes_departamento_paciente;
   var $sc_proc_quebra_pacientes_ciudad_paciente;
   var $count_pacientes_ciudad_paciente;
   var $sc_proc_quebra_pacientes_genero_paciente;
   var $count_pacientes_genero_paciente;
   var $sc_proc_quebra_pacientes_fecha_nacimineto_paciente;
   var $count_pacientes_fecha_nacimineto_paciente;
   var $sc_proc_quebra_pacientes_edad_paciente;
   var $count_pacientes_edad_paciente;
   var $sc_proc_quebra_pacientes_acudiente_paciente;
   var $count_pacientes_acudiente_paciente;
   var $sc_proc_quebra_pacientes_telefono_acudiente_paciente;
   var $count_pacientes_telefono_acudiente_paciente;
   var $sc_proc_quebra_pacientes_codigo_xofigo;
   var $count_pacientes_codigo_xofigo;
   var $sc_proc_quebra_pacientes_status_paciente;
   var $count_pacientes_status_paciente;
   var $sc_proc_quebra_pacientes_id_ultima_gestion;
   var $count_pacientes_id_ultima_gestion;
   var $sc_proc_quebra_pacientes_usuario_creacion;
   var $count_pacientes_usuario_creacion;
   var $sc_proc_quebra_tratamiento_id_tratamiento;
   var $count_tratamiento_id_tratamiento;
   var $sc_proc_quebra_tratamiento_producto_tratamiento;
   var $count_tratamiento_producto_tratamiento;
   var $sc_proc_quebra_tratamiento_nombre_referencia;
   var $count_tratamiento_nombre_referencia;
   var $sc_proc_quebra_tratamiento_clasificacion_patologica_tratamiento;
   var $count_tratamiento_clasificacion_patologica_tratamiento;
   var $sc_proc_quebra_tratamiento_tratamiento_previo;
   var $count_tratamiento_tratamiento_previo;
   var $sc_proc_quebra_tratamiento_consentimiento_tratamiento;
   var $count_tratamiento_consentimiento_tratamiento;
   var $sc_proc_quebra_tratamiento_fecha_inicio_terapia_tratamiento;
   var $count_tratamiento_fecha_inicio_terapia_tratamiento;
   var $sc_proc_quebra_tratamiento_regimen_tratamiento;
   var $count_tratamiento_regimen_tratamiento;
   var $sc_proc_quebra_tratamiento_asegurador_tratamiento;
   var $count_tratamiento_asegurador_tratamiento;
   var $sc_proc_quebra_tratamiento_operador_logistico_tratamiento;
   var $count_tratamiento_operador_logistico_tratamiento;
   var $sc_proc_quebra_tratamiento_punto_entrega;
   var $count_tratamiento_punto_entrega;
   var $sc_proc_quebra_tratamiento_fecha_ultima_reclamacion_tratamiento;
   var $count_tratamiento_fecha_ultima_reclamacion_tratamiento;
   var $sc_proc_quebra_tratamiento_otros_operadores_tratamiento;
   var $count_tratamiento_otros_operadores_tratamiento;
   var $sc_proc_quebra_tratamiento_medios_adquisicion_tratamiento;
   var $count_tratamiento_medios_adquisicion_tratamiento;
   var $sc_proc_quebra_tratamiento_ips_atiende_tratamiento;
   var $count_tratamiento_ips_atiende_tratamiento;
   var $sc_proc_quebra_tratamiento_medico_tratamiento;
   var $count_tratamiento_medico_tratamiento;
   var $sc_proc_quebra_tratamiento_especialidad_tratamiento;
   var $count_tratamiento_especialidad_tratamiento;
   var $sc_proc_quebra_tratamiento_paramedico_tratamiento;
   var $count_tratamiento_paramedico_tratamiento;
   var $sc_proc_quebra_tratamiento_zona_atencion_paramedico_tratamiento;
   var $count_tratamiento_zona_atencion_paramedico_tratamiento;
   var $sc_proc_quebra_tratamiento_ciudad_base_paramedico_tratamiento;
   var $count_tratamiento_ciudad_base_paramedico_tratamiento;
   var $sc_proc_quebra_tratamiento_notas_adjuntos_tratamiento;
   var $count_tratamiento_notas_adjuntos_tratamiento;
   var $sc_proc_quebra_tratamiento_id_paciente_fk;
   var $count_tratamiento_id_paciente_fk;
   var $sc_proc_quebra_gestiones_id_gestion;
   var $count_gestiones_id_gestion;
   var $sc_proc_quebra_gestiones_motivo_comunicacion_gestion;
   var $count_gestiones_motivo_comunicacion_gestion;
   var $sc_proc_quebra_gestiones_medio_contacto_gestion;
   var $count_gestiones_medio_contacto_gestion;
   var $sc_proc_quebra_gestiones_tipo_llamada_gestion;
   var $count_gestiones_tipo_llamada_gestion;
   var $sc_proc_quebra_gestiones_logro_comunicacion_gestion;
   var $count_gestiones_logro_comunicacion_gestion;
   var $sc_proc_quebra_gestiones_motivo_no_comunicacion_gestion;
   var $count_gestiones_motivo_no_comunicacion_gestion;
   var $sc_proc_quebra_gestiones_numero_intentos_gestion;
   var $count_gestiones_numero_intentos_gestion;
   var $sc_proc_quebra_gestiones_esperado_gestion;
   var $count_gestiones_esperado_gestion;
   var $sc_proc_quebra_gestiones_estado_ctc_gestion;
   var $count_gestiones_estado_ctc_gestion;
   var $sc_proc_quebra_gestiones_estado_farmacia_gestion;
   var $count_gestiones_estado_farmacia_gestion;
   var $sc_proc_quebra_gestiones_reclamo_gestion;
   var $count_gestiones_reclamo_gestion;
   var $sc_proc_quebra_gestiones_causa_no_reclamacion_gestion;
   var $count_gestiones_causa_no_reclamacion_gestion;
   var $sc_proc_quebra_gestiones_dificultad_acceso_gestion;
   var $count_gestiones_dificultad_acceso_gestion;
   var $sc_proc_quebra_gestiones_tipo_dificultad_gestion;
   var $count_gestiones_tipo_dificultad_gestion;
   var $sc_proc_quebra_gestiones_envios_gestion;
   var $count_gestiones_envios_gestion;
   var $sc_proc_quebra_gestiones_medicamentos_gestion;
   var $count_gestiones_medicamentos_gestion;
   var $sc_proc_quebra_gestiones_tipo_envio_gestion;
   var $count_gestiones_tipo_envio_gestion;
   var $sc_proc_quebra_gestiones_evento_adverso_gestion;
   var $count_gestiones_evento_adverso_gestion;
   var $sc_proc_quebra_gestiones_tipo_evento_adverso;
   var $count_gestiones_tipo_evento_adverso;
   var $sc_proc_quebra_gestiones_genera_solicitud_gestion;
   var $count_gestiones_genera_solicitud_gestion;
   var $sc_proc_quebra_gestiones_fecha_proxima_llamada;
   var $count_gestiones_fecha_proxima_llamada;
   var $sc_proc_quebra_gestiones_motivo_proxima_llamada;
   var $count_gestiones_motivo_proxima_llamada;
   var $sc_proc_quebra_gestiones_observacion_proxima_llamada;
   var $count_gestiones_observacion_proxima_llamada;
   var $sc_proc_quebra_gestiones_fecha_reclamacion_gestion;
   var $count_gestiones_fecha_reclamacion_gestion;
   var $sc_proc_quebra_gestiones_consecutivo_gestion;
   var $count_gestiones_consecutivo_gestion;
   var $sc_proc_quebra_gestiones_autor_gestion;
   var $count_gestiones_autor_gestion;
   var $sc_proc_quebra_gestiones_nota;
   var $count_gestiones_nota;
   var $sc_proc_quebra_gestiones_fecha_programada_gestion;
   var $count_gestiones_fecha_programada_gestion;
   var $sc_proc_quebra_gestiones_usuario_asigando;
   var $count_gestiones_usuario_asigando;
   var $sc_proc_quebra_gestiones_id_paciente_fk2;
   var $count_gestiones_id_paciente_fk2;
   var $sc_proc_quebra_gestiones_fecha_comunicacion;
   var $count_gestiones_fecha_comunicacion;
   var $sc_proc_quebra_gestiones_estado_gestion;
   var $count_gestiones_estado_gestion;
   var $sc_proc_quebra_gestiones_codigo_argus;
   var $count_gestiones_codigo_argus;
   var $sc_proc_quebra_gestiones_numero_cajas;
   var $count_gestiones_numero_cajas;

   //---- 
   function generador_de_informes_resumo($tipo = "")
   {
      $this->Graf_left_dat   = false;
      $this->Graf_left_tot   = false;
      $this->NM_export       = false;
      $this->NM_totaliz_hrz  = false;
      $this->link_graph_tot  = array();
      $this->array_final     = array();
      $this->array_links     = array();
      $this->array_links_tit = array();
      $this->array_export    = array();
      $this->resumo_campos                                                      = array();
      $this->comando_grafico                                                    = array();
      $this->array_total_pacientes_id_paciente                            = array();
      $this->array_total_pacientes_estado_paciente                        = array();
      $this->array_total_pacientes_fecha_activacion_paciente              = array();
      $this->array_total_pacientes_fecha_retiro_paciente                  = array();
      $this->array_total_pacientes_motivo_retiro_paciente                 = array();
      $this->array_total_pacientes_observacion_motivo_retiro_paciente     = array();
      $this->array_total_pacientes_identificacion_paciente                = array();
      $this->array_total_pacientes_nombre_paciente                        = array();
      $this->array_total_pacientes_apellido_paciente                      = array();
      $this->array_total_pacientes_telefono_paciente                      = array();
      $this->array_total_pacientes_telefono2_paciente                     = array();
      $this->array_total_pacientes_telefono3_paciente                     = array();
      $this->array_total_pacientes_correo_paciente                        = array();
      $this->array_total_pacientes_direccion_paciente                     = array();
      $this->array_total_pacientes_barrio_paciente                        = array();
      $this->array_total_pacientes_departamento_paciente                  = array();
      $this->array_total_pacientes_ciudad_paciente                        = array();
      $this->array_total_pacientes_genero_paciente                        = array();
      $this->array_total_pacientes_fecha_nacimineto_paciente              = array();
      $this->array_total_pacientes_edad_paciente                          = array();
      $this->array_total_pacientes_acudiente_paciente                     = array();
      $this->array_total_pacientes_telefono_acudiente_paciente            = array();
      $this->array_total_pacientes_codigo_xofigo                          = array();
      $this->array_total_pacientes_status_paciente                        = array();
      $this->array_total_pacientes_id_ultima_gestion                      = array();
      $this->array_total_pacientes_usuario_creacion                       = array();
      $this->array_total_tratamiento_id_tratamiento                       = array();
      $this->array_total_tratamiento_producto_tratamiento                 = array();
      $this->array_total_tratamiento_nombre_referencia                    = array();
      $this->array_total_tratamiento_clasificacion_patologica_tratamiento = array();
      $this->array_total_tratamiento_tratamiento_previo                   = array();
      $this->array_total_tratamiento_consentimiento_tratamiento           = array();
      $this->array_total_tratamiento_fecha_inicio_terapia_tratamiento     = array();
      $this->array_total_tratamiento_regimen_tratamiento                  = array();
      $this->array_total_tratamiento_asegurador_tratamiento               = array();
      $this->array_total_tratamiento_operador_logistico_tratamiento       = array();
      $this->array_total_tratamiento_punto_entrega                        = array();
      $this->array_total_tratamiento_fecha_ultima_reclamacion_tratamiento = array();
      $this->array_total_tratamiento_otros_operadores_tratamiento         = array();
      $this->array_total_tratamiento_medios_adquisicion_tratamiento       = array();
      $this->array_total_tratamiento_ips_atiende_tratamiento              = array();
      $this->array_total_tratamiento_medico_tratamiento                   = array();
      $this->array_total_tratamiento_especialidad_tratamiento             = array();
      $this->array_total_tratamiento_paramedico_tratamiento               = array();
      $this->array_total_tratamiento_zona_atencion_paramedico_tratamiento = array();
      $this->array_total_tratamiento_ciudad_base_paramedico_tratamiento   = array();
      $this->array_total_tratamiento_notas_adjuntos_tratamiento           = array();
      $this->array_total_tratamiento_id_paciente_fk                       = array();
      $this->array_total_gestiones_id_gestion                             = array();
      $this->array_total_gestiones_motivo_comunicacion_gestion            = array();
      $this->array_total_gestiones_medio_contacto_gestion                 = array();
      $this->array_total_gestiones_tipo_llamada_gestion                   = array();
      $this->array_total_gestiones_logro_comunicacion_gestion             = array();
      $this->array_total_gestiones_motivo_no_comunicacion_gestion         = array();
      $this->array_total_gestiones_numero_intentos_gestion                = array();
      $this->array_total_gestiones_esperado_gestion                       = array();
      $this->array_total_gestiones_estado_ctc_gestion                     = array();
      $this->array_total_gestiones_estado_farmacia_gestion                = array();
      $this->array_total_gestiones_reclamo_gestion                        = array();
      $this->array_total_gestiones_causa_no_reclamacion_gestion           = array();
      $this->array_total_gestiones_dificultad_acceso_gestion              = array();
      $this->array_total_gestiones_tipo_dificultad_gestion                = array();
      $this->array_total_gestiones_envios_gestion                         = array();
      $this->array_total_gestiones_medicamentos_gestion                   = array();
      $this->array_total_gestiones_tipo_envio_gestion                     = array();
      $this->array_total_gestiones_evento_adverso_gestion                 = array();
      $this->array_total_gestiones_tipo_evento_adverso                    = array();
      $this->array_total_gestiones_genera_solicitud_gestion               = array();
      $this->array_total_gestiones_fecha_proxima_llamada                  = array();
      $this->array_total_gestiones_motivo_proxima_llamada                 = array();
      $this->array_total_gestiones_observacion_proxima_llamada            = array();
      $this->array_total_gestiones_fecha_reclamacion_gestion              = array();
      $this->array_total_gestiones_consecutivo_gestion                    = array();
      $this->array_total_gestiones_autor_gestion                          = array();
      $this->array_total_gestiones_nota                                   = array();
      $this->array_total_gestiones_fecha_programada_gestion               = array();
      $this->array_total_gestiones_usuario_asigando                       = array();
      $this->array_total_gestiones_id_paciente_fk2                        = array();
      $this->array_total_gestiones_fecha_comunicacion                     = array();
      $this->array_total_gestiones_estado_gestion                         = array();
      $this->array_total_gestiones_codigo_argus                           = array();
      $this->array_total_gestiones_numero_cajas                           = array();
      $this->array_general_total = array();
      $this->nm_data = new nm_data("es");
      if ("" != $tipo && "out" == strtolower($tipo))
      {
         $this->tipo = "out";
      }
      else
      {
         $this->tipo = "pag";
      }
      $this->nmgp_botoes['group_1'] = "on";
      $this->nmgp_botoes['pdf'] = "on";
      $this->nmgp_botoes['word'] = "on";
      $this->nmgp_botoes['xls'] = "on";
      $this->nmgp_botoes['xml'] = "on";
      $this->nmgp_botoes['csv'] = "on";
      $this->nmgp_botoes['rtf'] = "on";
      $this->nmgp_botoes['imp'] = "on";
      $this->nmgp_botoes['pdf']  = "on";
      $this->nmgp_botoes['word'] = "on";
      $this->nmgp_botoes['xls']  = "on";
      $this->nmgp_botoes['xml']  = "on";
      $this->nmgp_botoes['csv']  = "on";
      $this->nmgp_botoes['rtf']  = "on";
      $this->nmgp_botoes['print']  = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['generador_de_informes']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['generador_de_informes']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['generador_de_informes']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
   }

   //---- 
   function resumo_export()
   { 
      $this->NM_export = true;
      $this->monta_resumo();
   } 

   function monta_resumo($b_export = false)
   {
       global $nm_saida;

      $this->NM_res_sem_reg = false;
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_resumo']);
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['res_hrz']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['res_hrz'] = $this->NM_totaliz_hrz;
      } 
      $this->NM_totaliz_hrz = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['res_hrz'];
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']) && !$this->NM_export)
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("generador_de_informes", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['iframe_menu'] && !$this->NM_export && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['array_graf_pdf'] = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_resumo'] = "";
      $this->inicializa_vars();
      $this->total->quebra_geral();
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['tot_geral'] as $ind => $val)
      {
           if ($ind > 0)
           {
               $this->array_total_geral[$ind - 1] = $val;
           }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['contr_array_resumo'] == "OK" && $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['contr_total_geral'] == "OK")
      {
          $this->array_total_pacientes_id_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_id_paciente'];
          $this->array_total_pacientes_estado_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_estado_paciente'];
          $this->array_total_pacientes_fecha_activacion_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_fecha_activacion_paciente'];
          $this->array_total_pacientes_fecha_retiro_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_fecha_retiro_paciente'];
          $this->array_total_pacientes_motivo_retiro_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_motivo_retiro_paciente'];
          $this->array_total_pacientes_observacion_motivo_retiro_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_observacion_motivo_retiro_paciente'];
          $this->array_total_pacientes_identificacion_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_identificacion_paciente'];
          $this->array_total_pacientes_nombre_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_nombre_paciente'];
          $this->array_total_pacientes_apellido_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_apellido_paciente'];
          $this->array_total_pacientes_telefono_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_telefono_paciente'];
          $this->array_total_pacientes_telefono2_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_telefono2_paciente'];
          $this->array_total_pacientes_telefono3_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_telefono3_paciente'];
          $this->array_total_pacientes_correo_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_correo_paciente'];
          $this->array_total_pacientes_direccion_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_direccion_paciente'];
          $this->array_total_pacientes_barrio_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_barrio_paciente'];
          $this->array_total_pacientes_departamento_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_departamento_paciente'];
          $this->array_total_pacientes_ciudad_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_ciudad_paciente'];
          $this->array_total_pacientes_genero_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_genero_paciente'];
          $this->array_total_pacientes_fecha_nacimineto_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_fecha_nacimineto_paciente'];
          $this->array_total_pacientes_edad_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_edad_paciente'];
          $this->array_total_pacientes_acudiente_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_acudiente_paciente'];
          $this->array_total_pacientes_telefono_acudiente_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_telefono_acudiente_paciente'];
          $this->array_total_pacientes_codigo_xofigo = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_codigo_xofigo'];
          $this->array_total_pacientes_status_paciente = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_status_paciente'];
          $this->array_total_pacientes_id_ultima_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_id_ultima_gestion'];
          $this->array_total_pacientes_usuario_creacion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_usuario_creacion'];
          $this->array_total_tratamiento_id_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_id_tratamiento'];
          $this->array_total_tratamiento_producto_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_producto_tratamiento'];
          $this->array_total_tratamiento_nombre_referencia = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_nombre_referencia'];
          $this->array_total_tratamiento_clasificacion_patologica_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_clasificacion_patologica_tratamiento'];
          $this->array_total_tratamiento_tratamiento_previo = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_tratamiento_previo'];
          $this->array_total_tratamiento_consentimiento_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_consentimiento_tratamiento'];
          $this->array_total_tratamiento_fecha_inicio_terapia_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_fecha_inicio_terapia_tratamiento'];
          $this->array_total_tratamiento_regimen_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_regimen_tratamiento'];
          $this->array_total_tratamiento_asegurador_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_asegurador_tratamiento'];
          $this->array_total_tratamiento_operador_logistico_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_operador_logistico_tratamiento'];
          $this->array_total_tratamiento_punto_entrega = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_punto_entrega'];
          $this->array_total_tratamiento_fecha_ultima_reclamacion_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_fecha_ultima_reclamacion_tratamiento'];
          $this->array_total_tratamiento_otros_operadores_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_otros_operadores_tratamiento'];
          $this->array_total_tratamiento_medios_adquisicion_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_medios_adquisicion_tratamiento'];
          $this->array_total_tratamiento_ips_atiende_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_ips_atiende_tratamiento'];
          $this->array_total_tratamiento_medico_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_medico_tratamiento'];
          $this->array_total_tratamiento_especialidad_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_especialidad_tratamiento'];
          $this->array_total_tratamiento_paramedico_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_paramedico_tratamiento'];
          $this->array_total_tratamiento_zona_atencion_paramedico_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_zona_atencion_paramedico_tratamiento'];
          $this->array_total_tratamiento_ciudad_base_paramedico_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_ciudad_base_paramedico_tratamiento'];
          $this->array_total_tratamiento_notas_adjuntos_tratamiento = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_notas_adjuntos_tratamiento'];
          $this->array_total_tratamiento_id_paciente_fk = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_id_paciente_fk'];
          $this->array_total_gestiones_id_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_id_gestion'];
          $this->array_total_gestiones_motivo_comunicacion_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_motivo_comunicacion_gestion'];
          $this->array_total_gestiones_medio_contacto_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_medio_contacto_gestion'];
          $this->array_total_gestiones_tipo_llamada_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_tipo_llamada_gestion'];
          $this->array_total_gestiones_logro_comunicacion_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_logro_comunicacion_gestion'];
          $this->array_total_gestiones_motivo_no_comunicacion_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_motivo_no_comunicacion_gestion'];
          $this->array_total_gestiones_numero_intentos_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_numero_intentos_gestion'];
          $this->array_total_gestiones_esperado_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_esperado_gestion'];
          $this->array_total_gestiones_estado_ctc_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_estado_ctc_gestion'];
          $this->array_total_gestiones_estado_farmacia_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_estado_farmacia_gestion'];
          $this->array_total_gestiones_reclamo_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_reclamo_gestion'];
          $this->array_total_gestiones_causa_no_reclamacion_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_causa_no_reclamacion_gestion'];
          $this->array_total_gestiones_dificultad_acceso_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_dificultad_acceso_gestion'];
          $this->array_total_gestiones_tipo_dificultad_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_tipo_dificultad_gestion'];
          $this->array_total_gestiones_envios_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_envios_gestion'];
          $this->array_total_gestiones_medicamentos_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_medicamentos_gestion'];
          $this->array_total_gestiones_tipo_envio_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_tipo_envio_gestion'];
          $this->array_total_gestiones_evento_adverso_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_evento_adverso_gestion'];
          $this->array_total_gestiones_tipo_evento_adverso = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_tipo_evento_adverso'];
          $this->array_total_gestiones_genera_solicitud_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_genera_solicitud_gestion'];
          $this->array_total_gestiones_fecha_proxima_llamada = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_fecha_proxima_llamada'];
          $this->array_total_gestiones_motivo_proxima_llamada = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_motivo_proxima_llamada'];
          $this->array_total_gestiones_observacion_proxima_llamada = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_observacion_proxima_llamada'];
          $this->array_total_gestiones_fecha_reclamacion_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_fecha_reclamacion_gestion'];
          $this->array_total_gestiones_consecutivo_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_consecutivo_gestion'];
          $this->array_total_gestiones_autor_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_autor_gestion'];
          $this->array_total_gestiones_nota = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_nota'];
          $this->array_total_gestiones_fecha_programada_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_fecha_programada_gestion'];
          $this->array_total_gestiones_usuario_asigando = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_usuario_asigando'];
          $this->array_total_gestiones_id_paciente_fk2 = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_id_paciente_fk2'];
          $this->array_total_gestiones_fecha_comunicacion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_fecha_comunicacion'];
          $this->array_total_gestiones_estado_gestion = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_estado_gestion'];
          $this->array_total_gestiones_codigo_argus = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_codigo_argus'];
          $this->array_total_gestiones_numero_cajas = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_numero_cajas'];
      }
      else
      {
          $this->array_total_pacientes_id_paciente = array();
          $this->array_total_pacientes_estado_paciente = array();
          $this->array_total_pacientes_fecha_activacion_paciente = array();
          $this->array_total_pacientes_fecha_retiro_paciente = array();
          $this->array_total_pacientes_motivo_retiro_paciente = array();
          $this->array_total_pacientes_observacion_motivo_retiro_paciente = array();
          $this->array_total_pacientes_identificacion_paciente = array();
          $this->array_total_pacientes_nombre_paciente = array();
          $this->array_total_pacientes_apellido_paciente = array();
          $this->array_total_pacientes_telefono_paciente = array();
          $this->array_total_pacientes_telefono2_paciente = array();
          $this->array_total_pacientes_telefono3_paciente = array();
          $this->array_total_pacientes_correo_paciente = array();
          $this->array_total_pacientes_direccion_paciente = array();
          $this->array_total_pacientes_barrio_paciente = array();
          $this->array_total_pacientes_departamento_paciente = array();
          $this->array_total_pacientes_ciudad_paciente = array();
          $this->array_total_pacientes_genero_paciente = array();
          $this->array_total_pacientes_fecha_nacimineto_paciente = array();
          $this->array_total_pacientes_edad_paciente = array();
          $this->array_total_pacientes_acudiente_paciente = array();
          $this->array_total_pacientes_telefono_acudiente_paciente = array();
          $this->array_total_pacientes_codigo_xofigo = array();
          $this->array_total_pacientes_status_paciente = array();
          $this->array_total_pacientes_id_ultima_gestion = array();
          $this->array_total_pacientes_usuario_creacion = array();
          $this->array_total_tratamiento_id_tratamiento = array();
          $this->array_total_tratamiento_producto_tratamiento = array();
          $this->array_total_tratamiento_nombre_referencia = array();
          $this->array_total_tratamiento_clasificacion_patologica_tratamiento = array();
          $this->array_total_tratamiento_tratamiento_previo = array();
          $this->array_total_tratamiento_consentimiento_tratamiento = array();
          $this->array_total_tratamiento_fecha_inicio_terapia_tratamiento = array();
          $this->array_total_tratamiento_regimen_tratamiento = array();
          $this->array_total_tratamiento_asegurador_tratamiento = array();
          $this->array_total_tratamiento_operador_logistico_tratamiento = array();
          $this->array_total_tratamiento_punto_entrega = array();
          $this->array_total_tratamiento_fecha_ultima_reclamacion_tratamiento = array();
          $this->array_total_tratamiento_otros_operadores_tratamiento = array();
          $this->array_total_tratamiento_medios_adquisicion_tratamiento = array();
          $this->array_total_tratamiento_ips_atiende_tratamiento = array();
          $this->array_total_tratamiento_medico_tratamiento = array();
          $this->array_total_tratamiento_especialidad_tratamiento = array();
          $this->array_total_tratamiento_paramedico_tratamiento = array();
          $this->array_total_tratamiento_zona_atencion_paramedico_tratamiento = array();
          $this->array_total_tratamiento_ciudad_base_paramedico_tratamiento = array();
          $this->array_total_tratamiento_notas_adjuntos_tratamiento = array();
          $this->array_total_tratamiento_id_paciente_fk = array();
          $this->array_total_gestiones_id_gestion = array();
          $this->array_total_gestiones_motivo_comunicacion_gestion = array();
          $this->array_total_gestiones_medio_contacto_gestion = array();
          $this->array_total_gestiones_tipo_llamada_gestion = array();
          $this->array_total_gestiones_logro_comunicacion_gestion = array();
          $this->array_total_gestiones_motivo_no_comunicacion_gestion = array();
          $this->array_total_gestiones_numero_intentos_gestion = array();
          $this->array_total_gestiones_esperado_gestion = array();
          $this->array_total_gestiones_estado_ctc_gestion = array();
          $this->array_total_gestiones_estado_farmacia_gestion = array();
          $this->array_total_gestiones_reclamo_gestion = array();
          $this->array_total_gestiones_causa_no_reclamacion_gestion = array();
          $this->array_total_gestiones_dificultad_acceso_gestion = array();
          $this->array_total_gestiones_tipo_dificultad_gestion = array();
          $this->array_total_gestiones_envios_gestion = array();
          $this->array_total_gestiones_medicamentos_gestion = array();
          $this->array_total_gestiones_tipo_envio_gestion = array();
          $this->array_total_gestiones_evento_adverso_gestion = array();
          $this->array_total_gestiones_tipo_evento_adverso = array();
          $this->array_total_gestiones_genera_solicitud_gestion = array();
          $this->array_total_gestiones_fecha_proxima_llamada = array();
          $this->array_total_gestiones_motivo_proxima_llamada = array();
          $this->array_total_gestiones_observacion_proxima_llamada = array();
          $this->array_total_gestiones_fecha_reclamacion_gestion = array();
          $this->array_total_gestiones_consecutivo_gestion = array();
          $this->array_total_gestiones_autor_gestion = array();
          $this->array_total_gestiones_nota = array();
          $this->array_total_gestiones_fecha_programada_gestion = array();
          $this->array_total_gestiones_usuario_asigando = array();
          $this->array_total_gestiones_id_paciente_fk2 = array();
          $this->array_total_gestiones_fecha_comunicacion = array();
          $this->array_total_gestiones_estado_gestion = array();
          $this->array_total_gestiones_codigo_argus = array();
          $this->array_total_gestiones_numero_cajas = array();
          $this->totaliza();
          $this->finaliza_arrays();
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['tot_geral'][1]) || $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['tot_geral'][1] == 0)
      {
          $this->NM_res_sem_reg = true;
      }
      $this->resumo_init();
      if ($this->NM_res_sem_reg)
      {
          $this->resumo_sem_reg();
          $this->resumo_final();
          return;
      }
      $this->completeMatrix();
      $this->buildMatrix();
      $this->buildChart();
      if ($b_export)
      {
          return;
      }
      $this->drawMatrix();
      $this->resumo_final();
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['contr_label_graf'] = array();
      if (isset($this->nmgp_label_quebras) && !empty($this->nmgp_label_quebras))
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['contr_label_graf'] = $this->nmgp_label_quebras;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_id_paciente'] = $this->array_total_pacientes_id_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_estado_paciente'] = $this->array_total_pacientes_estado_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_fecha_activacion_paciente'] = $this->array_total_pacientes_fecha_activacion_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_fecha_retiro_paciente'] = $this->array_total_pacientes_fecha_retiro_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_motivo_retiro_paciente'] = $this->array_total_pacientes_motivo_retiro_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_observacion_motivo_retiro_paciente'] = $this->array_total_pacientes_observacion_motivo_retiro_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_identificacion_paciente'] = $this->array_total_pacientes_identificacion_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_nombre_paciente'] = $this->array_total_pacientes_nombre_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_apellido_paciente'] = $this->array_total_pacientes_apellido_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_telefono_paciente'] = $this->array_total_pacientes_telefono_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_telefono2_paciente'] = $this->array_total_pacientes_telefono2_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_telefono3_paciente'] = $this->array_total_pacientes_telefono3_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_correo_paciente'] = $this->array_total_pacientes_correo_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_direccion_paciente'] = $this->array_total_pacientes_direccion_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_barrio_paciente'] = $this->array_total_pacientes_barrio_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_departamento_paciente'] = $this->array_total_pacientes_departamento_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_ciudad_paciente'] = $this->array_total_pacientes_ciudad_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_genero_paciente'] = $this->array_total_pacientes_genero_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_fecha_nacimineto_paciente'] = $this->array_total_pacientes_fecha_nacimineto_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_edad_paciente'] = $this->array_total_pacientes_edad_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_acudiente_paciente'] = $this->array_total_pacientes_acudiente_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_telefono_acudiente_paciente'] = $this->array_total_pacientes_telefono_acudiente_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_codigo_xofigo'] = $this->array_total_pacientes_codigo_xofigo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_status_paciente'] = $this->array_total_pacientes_status_paciente;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_id_ultima_gestion'] = $this->array_total_pacientes_id_ultima_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['pacientes_usuario_creacion'] = $this->array_total_pacientes_usuario_creacion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_id_tratamiento'] = $this->array_total_tratamiento_id_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_producto_tratamiento'] = $this->array_total_tratamiento_producto_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_nombre_referencia'] = $this->array_total_tratamiento_nombre_referencia;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_clasificacion_patologica_tratamiento'] = $this->array_total_tratamiento_clasificacion_patologica_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_tratamiento_previo'] = $this->array_total_tratamiento_tratamiento_previo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_consentimiento_tratamiento'] = $this->array_total_tratamiento_consentimiento_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_fecha_inicio_terapia_tratamiento'] = $this->array_total_tratamiento_fecha_inicio_terapia_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_regimen_tratamiento'] = $this->array_total_tratamiento_regimen_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_asegurador_tratamiento'] = $this->array_total_tratamiento_asegurador_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_operador_logistico_tratamiento'] = $this->array_total_tratamiento_operador_logistico_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_punto_entrega'] = $this->array_total_tratamiento_punto_entrega;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_fecha_ultima_reclamacion_tratamiento'] = $this->array_total_tratamiento_fecha_ultima_reclamacion_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_otros_operadores_tratamiento'] = $this->array_total_tratamiento_otros_operadores_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_medios_adquisicion_tratamiento'] = $this->array_total_tratamiento_medios_adquisicion_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_ips_atiende_tratamiento'] = $this->array_total_tratamiento_ips_atiende_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_medico_tratamiento'] = $this->array_total_tratamiento_medico_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_especialidad_tratamiento'] = $this->array_total_tratamiento_especialidad_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_paramedico_tratamiento'] = $this->array_total_tratamiento_paramedico_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_zona_atencion_paramedico_tratamiento'] = $this->array_total_tratamiento_zona_atencion_paramedico_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_ciudad_base_paramedico_tratamiento'] = $this->array_total_tratamiento_ciudad_base_paramedico_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_notas_adjuntos_tratamiento'] = $this->array_total_tratamiento_notas_adjuntos_tratamiento;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['tratamiento_id_paciente_fk'] = $this->array_total_tratamiento_id_paciente_fk;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_id_gestion'] = $this->array_total_gestiones_id_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_motivo_comunicacion_gestion'] = $this->array_total_gestiones_motivo_comunicacion_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_medio_contacto_gestion'] = $this->array_total_gestiones_medio_contacto_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_tipo_llamada_gestion'] = $this->array_total_gestiones_tipo_llamada_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_logro_comunicacion_gestion'] = $this->array_total_gestiones_logro_comunicacion_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_motivo_no_comunicacion_gestion'] = $this->array_total_gestiones_motivo_no_comunicacion_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_numero_intentos_gestion'] = $this->array_total_gestiones_numero_intentos_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_esperado_gestion'] = $this->array_total_gestiones_esperado_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_estado_ctc_gestion'] = $this->array_total_gestiones_estado_ctc_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_estado_farmacia_gestion'] = $this->array_total_gestiones_estado_farmacia_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_reclamo_gestion'] = $this->array_total_gestiones_reclamo_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_causa_no_reclamacion_gestion'] = $this->array_total_gestiones_causa_no_reclamacion_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_dificultad_acceso_gestion'] = $this->array_total_gestiones_dificultad_acceso_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_tipo_dificultad_gestion'] = $this->array_total_gestiones_tipo_dificultad_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_envios_gestion'] = $this->array_total_gestiones_envios_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_medicamentos_gestion'] = $this->array_total_gestiones_medicamentos_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_tipo_envio_gestion'] = $this->array_total_gestiones_tipo_envio_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_evento_adverso_gestion'] = $this->array_total_gestiones_evento_adverso_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_tipo_evento_adverso'] = $this->array_total_gestiones_tipo_evento_adverso;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_genera_solicitud_gestion'] = $this->array_total_gestiones_genera_solicitud_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_fecha_proxima_llamada'] = $this->array_total_gestiones_fecha_proxima_llamada;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_motivo_proxima_llamada'] = $this->array_total_gestiones_motivo_proxima_llamada;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_observacion_proxima_llamada'] = $this->array_total_gestiones_observacion_proxima_llamada;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_fecha_reclamacion_gestion'] = $this->array_total_gestiones_fecha_reclamacion_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_consecutivo_gestion'] = $this->array_total_gestiones_consecutivo_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_autor_gestion'] = $this->array_total_gestiones_autor_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_nota'] = $this->array_total_gestiones_nota;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_fecha_programada_gestion'] = $this->array_total_gestiones_fecha_programada_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_usuario_asigando'] = $this->array_total_gestiones_usuario_asigando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_id_paciente_fk2'] = $this->array_total_gestiones_id_paciente_fk2;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_fecha_comunicacion'] = $this->array_total_gestiones_fecha_comunicacion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_estado_gestion'] = $this->array_total_gestiones_estado_gestion;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_codigo_argus'] = $this->array_total_gestiones_codigo_argus;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_total']['gestiones_numero_cajas'] = $this->array_total_gestiones_numero_cajas;
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['contr_array_resumo'] = "OK";
   }

   function completeMatrix()
   {
       $this->comp_align       = array();
       $this->comp_display     = array();
       $this->comp_field       = array();
       $this->comp_field_nm    = array();
       $this->comp_fill        = array();
       $this->comp_group       = array();
       $this->comp_index       = array();
       $this->comp_label       = array();
       $this->comp_links_fl    = array();
       $this->comp_links_gr    = array();
       $this->comp_order       = array();
       $this->comp_order_col   = '';
       $this->comp_order_level = '';
       $this->comp_order_sort  = '';
       $this->comp_sum         = array();
       $this->comp_sum_order   = array();
       $this->comp_sum_display = array();
       $this->comp_sum_dummy   = array();
       $this->comp_sum_fn      = array();
       $this->comp_sum_lnk     = array();
       $this->comp_sum_css     = array();
       $this->comp_tabular     = true;
       $this->comp_totals_a    = array();
       $this->comp_totals_al   = array();
       $this->comp_totals_g    = array();
       $this->comp_totals_x    = array();
       $this->comp_totals_y    = array();
       $this->comp_x_axys      = array();
       $this->comp_y_axys      = array();

       $this->show_totals_x = true;
       $this->show_totals_y = true;
       //-----
       $prep_field = array();
       $prep_field['pacientes_id_paciente'] = "PAP";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "PAP"; 
       $prep_field['pacientes_estado_paciente'] = "ESTADO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ESTADO PACIENTE"; 
       $prep_field['pacientes_fecha_activacion_paciente'] = "FECHA ACTIVACION PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "FECHA ACTIVACION PACIENTE"; 
       $prep_field['pacientes_fecha_retiro_paciente'] = "FECHA RETIRO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "FECHA RETIRO PACIENTE"; 
       $prep_field['pacientes_motivo_retiro_paciente'] = "MOTIVO RETIRO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "MOTIVO RETIRO PACIENTE"; 
       $prep_field['pacientes_observacion_motivo_retiro_paciente'] = "OBSERVACION MOTIVO RETIRO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "OBSERVACION MOTIVO RETIRO PACIENTE"; 
       $prep_field['pacientes_identificacion_paciente'] = "IDENTIFICACION PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "IDENTIFICACION PACIENTE"; 
       $prep_field['pacientes_nombre_paciente'] = "NOMBRE PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "NOMBRE PACIENTE"; 
       $prep_field['pacientes_apellido_paciente'] = "APELLIDO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "APELLIDO PACIENTE"; 
       $prep_field['pacientes_telefono_paciente'] = "TELEFONO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "TELEFONO PACIENTE"; 
       $prep_field['pacientes_telefono2_paciente'] = "TELEFONO2 PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "TELEFONO2 PACIENTE"; 
       $prep_field['pacientes_telefono3_paciente'] = "TELEFONO3 PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "TELEFONO3 PACIENTE"; 
       $prep_field['pacientes_correo_paciente'] = "CORREO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "CORREO PACIENTE"; 
       $prep_field['pacientes_direccion_paciente'] = "DIRECCION PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "DIRECCION PACIENTE"; 
       $prep_field['pacientes_barrio_paciente'] = "BARRIO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "BARRIO PACIENTE"; 
       $prep_field['pacientes_departamento_paciente'] = "DEPARTAMENTO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "DEPARTAMENTO PACIENTE"; 
       $prep_field['pacientes_ciudad_paciente'] = "CIUDAD PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "CIUDAD PACIENTE"; 
       $prep_field['pacientes_genero_paciente'] = "GENERO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "GENERO PACIENTE"; 
       $prep_field['pacientes_fecha_nacimineto_paciente'] = "FECHA NACIMINETO PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "FECHA NACIMINETO PACIENTE"; 
       $prep_field['pacientes_edad_paciente'] = "EDAD PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "EDAD PACIENTE"; 
       $prep_field['pacientes_acudiente_paciente'] = "ACUDIENTE PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ACUDIENTE PACIENTE"; 
       $prep_field['pacientes_telefono_acudiente_paciente'] = "TELEFONO ACUDIENTE PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "TELEFONO ACUDIENTE PACIENTE"; 
       $prep_field['pacientes_codigo_xofigo'] = "CODIGO XOFIGO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "CODIGO XOFIGO"; 
       $prep_field['pacientes_status_paciente'] = "STATUS PACIENTE";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "STATUS PACIENTE"; 
       $prep_field['pacientes_id_ultima_gestion'] = "ID ULTIMA GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ID ULTIMA GESTION"; 
       $prep_field['pacientes_usuario_creacion'] = "USUARIO CREACION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "USUARIO CREACION"; 
       $prep_field['tratamiento_id_tratamiento'] = "ID TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ID TRATAMIENTO"; 
       $prep_field['tratamiento_producto_tratamiento'] = "PRODUCTO TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "PRODUCTO TRATAMIENTO"; 
       $prep_field['tratamiento_nombre_referencia'] = "NOMBRE REFERENCIA";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "NOMBRE REFERENCIA"; 
       $prep_field['tratamiento_clasificacion_patologica_tratamiento'] = "CLASIFICACION PATOLOGICA TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "CLASIFICACION PATOLOGICA TRATAMIENTO"; 
       $prep_field['tratamiento_tratamiento_previo'] = "TRATAMIENTO PREVIO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "TRATAMIENTO PREVIO"; 
       $prep_field['tratamiento_consentimiento_tratamiento'] = "CONSENTIMIENTO TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "CONSENTIMIENTO TRATAMIENTO"; 
       $prep_field['tratamiento_fecha_inicio_terapia_tratamiento'] = "FECHA INICIO TERAPIA TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "FECHA INICIO TERAPIA TRATAMIENTO"; 
       $prep_field['tratamiento_regimen_tratamiento'] = "REGIMEN TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "REGIMEN TRATAMIENTO"; 
       $prep_field['tratamiento_asegurador_tratamiento'] = "ASEGURADOR TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ASEGURADOR TRATAMIENTO"; 
       $prep_field['tratamiento_operador_logistico_tratamiento'] = "OPERADOR LOGISTICO TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "OPERADOR LOGISTICO TRATAMIENTO"; 
       $prep_field['tratamiento_punto_entrega'] = "PUNTO ENTREGA";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "PUNTO ENTREGA"; 
       $prep_field['tratamiento_fecha_ultima_reclamacion_tratamiento'] = "FECHA ULTIMA RECLAMACION TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "FECHA ULTIMA RECLAMACION TRATAMIENTO"; 
       $prep_field['tratamiento_otros_operadores_tratamiento'] = "OTROS OPERADORES TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "OTROS OPERADORES TRATAMIENTO"; 
       $prep_field['tratamiento_medios_adquisicion_tratamiento'] = "MEDIOS ADQUISICION TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "MEDIOS ADQUISICION TRATAMIENTO"; 
       $prep_field['tratamiento_ips_atiende_tratamiento'] = "IPS ATIENDE TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "IPS ATIENDE TRATAMIENTO"; 
       $prep_field['tratamiento_medico_tratamiento'] = "MEDICO TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "MEDICO TRATAMIENTO"; 
       $prep_field['tratamiento_especialidad_tratamiento'] = "ESPECIALIDAD TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ESPECIALIDAD TRATAMIENTO"; 
       $prep_field['tratamiento_paramedico_tratamiento'] = "PARAMEDICO TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "PARAMEDICO TRATAMIENTO"; 
       $prep_field['tratamiento_zona_atencion_paramedico_tratamiento'] = "ZONA ATENCION PARAMEDICO TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ZONA ATENCION PARAMEDICO TRATAMIENTO"; 
       $prep_field['tratamiento_ciudad_base_paramedico_tratamiento'] = "CIUDAD BASE PARAMEDICO TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "CIUDAD BASE PARAMEDICO TRATAMIENTO"; 
       $prep_field['tratamiento_notas_adjuntos_tratamiento'] = "NOTAS ADJUNTOS TRATAMIENTO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "NOTAS ADJUNTOS TRATAMIENTO"; 
       $prep_field['tratamiento_id_paciente_fk'] = "ID PACIENTE FK";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ID PACIENTE FK"; 
       $prep_field['gestiones_id_gestion'] = "ID GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ID GESTION"; 
       $prep_field['gestiones_motivo_comunicacion_gestion'] = "MOTIVO COMUNICACION GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "MOTIVO COMUNICACION GESTION"; 
       $prep_field['gestiones_medio_contacto_gestion'] = "MEDIO CONTACTO GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "MEDIO CONTACTO GESTION"; 
       $prep_field['gestiones_tipo_llamada_gestion'] = "TIPO LLAMADA GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "TIPO LLAMADA GESTION"; 
       $prep_field['gestiones_logro_comunicacion_gestion'] = "LOGRO COMUNICACION GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "LOGRO COMUNICACION GESTION"; 
       $prep_field['gestiones_motivo_no_comunicacion_gestion'] = "MOTIVO NO COMUNICACION GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "MOTIVO NO COMUNICACION GESTION"; 
       $prep_field['gestiones_numero_intentos_gestion'] = "NUMERO INTENTOS GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "NUMERO INTENTOS GESTION"; 
       $prep_field['gestiones_esperado_gestion'] = "ESPERADO GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ESPERADO GESTION"; 
       $prep_field['gestiones_estado_ctc_gestion'] = "ESTADO CTC GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ESTADO CTC GESTION"; 
       $prep_field['gestiones_estado_farmacia_gestion'] = "ESTADO FARMACIA GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ESTADO FARMACIA GESTION"; 
       $prep_field['gestiones_reclamo_gestion'] = "RECLAMO GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "RECLAMO GESTION"; 
       $prep_field['gestiones_causa_no_reclamacion_gestion'] = "CAUSA NO RECLAMACION GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "CAUSA NO RECLAMACION GESTION"; 
       $prep_field['gestiones_dificultad_acceso_gestion'] = "DIFICULTAD ACCESO GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "DIFICULTAD ACCESO GESTION"; 
       $prep_field['gestiones_tipo_dificultad_gestion'] = "TIPO DIFICULTAD GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "TIPO DIFICULTAD GESTION"; 
       $prep_field['gestiones_envios_gestion'] = "ENVIOS GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ENVIOS GESTION"; 
       $prep_field['gestiones_medicamentos_gestion'] = "MEDICAMENTOS GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "MEDICAMENTOS GESTION"; 
       $prep_field['gestiones_tipo_envio_gestion'] = "TIPO ENVIO GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "TIPO ENVIO GESTION"; 
       $prep_field['gestiones_evento_adverso_gestion'] = "EVENTO ADVERSO GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "EVENTO ADVERSO GESTION"; 
       $prep_field['gestiones_tipo_evento_adverso'] = "TIPO EVENTO ADVERSO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "TIPO EVENTO ADVERSO"; 
       $prep_field['gestiones_genera_solicitud_gestion'] = "GENERA SOLICITUD GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "GENERA SOLICITUD GESTION"; 
       $prep_field['gestiones_fecha_proxima_llamada'] = "FECHA PROXIMA LLAMADA";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "FECHA PROXIMA LLAMADA"; 
       $prep_field['gestiones_motivo_proxima_llamada'] = "MOTIVO PROXIMA LLAMADA";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "MOTIVO PROXIMA LLAMADA"; 
       $prep_field['gestiones_observacion_proxima_llamada'] = "OBSERVACION PROXIMA LLAMADA";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "OBSERVACION PROXIMA LLAMADA"; 
       $prep_field['gestiones_fecha_reclamacion_gestion'] = "FECHA RECLAMACION GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "FECHA RECLAMACION GESTION"; 
       $prep_field['gestiones_consecutivo_gestion'] = "CONSECUTIVO GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "CONSECUTIVO GESTION"; 
       $prep_field['gestiones_autor_gestion'] = "AUTOR GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "AUTOR GESTION"; 
       $prep_field['gestiones_nota'] = "NOTA";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "NOTA"; 
       $prep_field['gestiones_fecha_programada_gestion'] = "FECHA PROGRAMADA GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "FECHA PROGRAMADA GESTION"; 
       $prep_field['gestiones_usuario_asigando'] = "USUARIO ASIGANDO";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "USUARIO ASIGANDO"; 
       $prep_field['gestiones_id_paciente_fk2'] = "ID PACIENTE FK2";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ID PACIENTE FK2"; 
       $prep_field['gestiones_fecha_comunicacion'] = "FECHA COMUNICACION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "FECHA COMUNICACION"; 
       $prep_field['gestiones_estado_gestion'] = "ESTADO GESTION";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "ESTADO GESTION"; 
       $prep_field['gestiones_codigo_argus'] = "CODIGO ARGUS";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "CODIGO ARGUS"; 
       $prep_field['gestiones_numero_cajas'] = "NUMERO CAJAS";
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['labels'][''] = "NUMERO CAJAS"; 
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? "" : ",";
          $Str_gb .= '"' . $prep_field[$cmp_gb] . '"';
       }
       eval ("\$this->comp_field = array(" . $Str_gb . ");");;

       //-----
       $ix = 0;
       $this->comp_field_nm = array();
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
           $this->comp_field_nm[$cmp_gb] = $ix;
           $ix++;
       }

       //-----
       $this->comp_sum = array(
           1 => "" .  $this->Ini->Nm_lang['lang_othr_rows'] . "",
       );

       //-----
       $this->comp_sum_order = array(
           1,
       );

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_order']))
       {
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_order'][] = $i_sum;
           }
       }
       else
       {
           $this->comp_sum_order = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_order'];
       }

       //-----
       $this->comp_sum_display = array(
           1 => true,
       );

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_display']))
       {
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_display'][$i_sum] = array('label' => $l_sum, 'display' => $this->comp_sum_display[$i_sum]);
           }
       }
       else
       {
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_display'][$i_sum]))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_display'][$i_sum] = array('label' => $l_sum, 'display' => $this->comp_sum_display[$i_sum]);
               }
               else
               {
                   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_display'][$i_sum]['label']))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_display'][$i_sum]['label'] = $l_sum;
                   }
                   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_display'][$i_sum]['display']))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_display'][$i_sum]['display'] = $this->comp_sum_display[$i_sum];
                   }
               }
           }
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_display'] as $i_sum => $d_sum)
           {
               $this->comp_sum_display[$i_sum] = $d_sum['display'];
           }
       }

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_control']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['summarizing_fields_control'] = array(
               'NM_Count' => array(
                   'label' => "" .  $this->Ini->Nm_lang['lang_othr_rows'] . "",
                   'label_field' => "" .  $this->Ini->Nm_lang['lang_othr_rows'] . "",
                   'options' => array(
                       array('op' => 'C', 'index' => '1', 'label' => "C", 'abbrev' => "C"),
                   ),
                   'select' => "<select class=\"sc-ui-select-NM_Count\" onChange=\"scSummChange($(this))\" style=\"display: none\"><option value=\"1\" class=\"sc-ui-select-option-C\">C</option></select>",
               ),
           );
       }
       //-----
       $this->comp_sum_dummy = array(
           0,
       );

       //-----
       $this->comp_sum_fn = array(
           1 => "C",
       );

       //-----
       $this->comp_sum_lnk = array(
           1 => array('field' => "nm_count", 'show' => false),
       );

       //-----
       $this->comp_sum_css = array(
           1 => "css_NM_Count_",
       );

       //-----
      $Str_gb   = "";
      $Arr_gb   = array();
      $Arr_name = array();
      $Arr_lab  = array();
      $Control  = "";
      $Ctr_lab  = "";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $Arr_gb[]   = $cmp_gb;
          $Arr_name[] = "array_total_" . $cmp_gb . $Control;
          $Arr_lab[]  = $Ctr_lab;
          $Control   .= "[\$campo_" . $cmp_gb . "]";
          $Ctr_lab   .= "[\$dados_" . $cmp_gb . "[2]]";
      }
      for ($ix = 0; $ix < sizeof($Arr_gb); $ix++)
      {
          $Str_gb .= "foreach (\$this->" . $Arr_name[$ix] . " as \$campo_" . $Arr_gb[$ix] . " => \$dados_" . $Arr_gb[$ix] . ")";
          $Str_gb .= "{";
          $Str_gb .= "    if (!in_array(\$campo_" . $Arr_gb[$ix] . ", \$this->comp_label[" . $ix . "]" . $Arr_lab[$ix] . ", true)) {";
          $Str_gb .= "         \$this->comp_index[" . $ix . "][\$dados_" . $Arr_gb[$ix] . "[2] ] = \$dados_" . $Arr_gb[$ix] . "[1];";
          $Str_gb .= "         \$this->comp_label[" . $ix . "]" . $Arr_lab[$ix] . "[ \$dados_" . $Arr_gb[$ix] . "[2] ] = \$dados_" . $Arr_gb[$ix] . "[1];";
          $Str_gb .= "    }";
      }
      for ($ix = 0; $ix < sizeof($Arr_gb); $ix++)
      {
          $Str_gb .= "}";
      }
      eval ($Str_gb);

       //-----
       $x = 0;
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($x == 0) ? $x : ", " . $x;
          $x++;
       }
       eval ("\$this->comp_y_axys = array(" . $Str_gb . ");");;
       $this->comp_x_axys = array();

       $Arr_parms = array();
       $Arr_parms['pacientes_id_paciente']['alin'] = "''";
       $Arr_parms['pacientes_id_paciente']['link'] = "S";
       $Arr_parms['pacientes_estado_paciente']['alin'] = "''";
       $Arr_parms['pacientes_estado_paciente']['link'] = "S";
       $Arr_parms['pacientes_fecha_activacion_paciente']['alin'] = "''";
       $Arr_parms['pacientes_fecha_activacion_paciente']['link'] = "S";
       $Arr_parms['pacientes_fecha_retiro_paciente']['alin'] = "''";
       $Arr_parms['pacientes_fecha_retiro_paciente']['link'] = "S";
       $Arr_parms['pacientes_motivo_retiro_paciente']['alin'] = "''";
       $Arr_parms['pacientes_motivo_retiro_paciente']['link'] = "S";
       $Arr_parms['pacientes_observacion_motivo_retiro_paciente']['alin'] = "''";
       $Arr_parms['pacientes_observacion_motivo_retiro_paciente']['link'] = "S";
       $Arr_parms['pacientes_identificacion_paciente']['alin'] = "''";
       $Arr_parms['pacientes_identificacion_paciente']['link'] = "S";
       $Arr_parms['pacientes_nombre_paciente']['alin'] = "''";
       $Arr_parms['pacientes_nombre_paciente']['link'] = "S";
       $Arr_parms['pacientes_apellido_paciente']['alin'] = "''";
       $Arr_parms['pacientes_apellido_paciente']['link'] = "S";
       $Arr_parms['pacientes_telefono_paciente']['alin'] = "''";
       $Arr_parms['pacientes_telefono_paciente']['link'] = "S";
       $Arr_parms['pacientes_telefono2_paciente']['alin'] = "''";
       $Arr_parms['pacientes_telefono2_paciente']['link'] = "S";
       $Arr_parms['pacientes_telefono3_paciente']['alin'] = "''";
       $Arr_parms['pacientes_telefono3_paciente']['link'] = "S";
       $Arr_parms['pacientes_correo_paciente']['alin'] = "''";
       $Arr_parms['pacientes_correo_paciente']['link'] = "S";
       $Arr_parms['pacientes_direccion_paciente']['alin'] = "''";
       $Arr_parms['pacientes_direccion_paciente']['link'] = "S";
       $Arr_parms['pacientes_barrio_paciente']['alin'] = "''";
       $Arr_parms['pacientes_barrio_paciente']['link'] = "S";
       $Arr_parms['pacientes_departamento_paciente']['alin'] = "''";
       $Arr_parms['pacientes_departamento_paciente']['link'] = "S";
       $Arr_parms['pacientes_ciudad_paciente']['alin'] = "''";
       $Arr_parms['pacientes_ciudad_paciente']['link'] = "S";
       $Arr_parms['pacientes_genero_paciente']['alin'] = "''";
       $Arr_parms['pacientes_genero_paciente']['link'] = "S";
       $Arr_parms['pacientes_fecha_nacimineto_paciente']['alin'] = "''";
       $Arr_parms['pacientes_fecha_nacimineto_paciente']['link'] = "S";
       $Arr_parms['pacientes_edad_paciente']['alin'] = "''";
       $Arr_parms['pacientes_edad_paciente']['link'] = "S";
       $Arr_parms['pacientes_acudiente_paciente']['alin'] = "''";
       $Arr_parms['pacientes_acudiente_paciente']['link'] = "S";
       $Arr_parms['pacientes_telefono_acudiente_paciente']['alin'] = "''";
       $Arr_parms['pacientes_telefono_acudiente_paciente']['link'] = "S";
       $Arr_parms['pacientes_codigo_xofigo']['alin'] = "''";
       $Arr_parms['pacientes_codigo_xofigo']['link'] = "S";
       $Arr_parms['pacientes_status_paciente']['alin'] = "''";
       $Arr_parms['pacientes_status_paciente']['link'] = "S";
       $Arr_parms['pacientes_id_ultima_gestion']['alin'] = "''";
       $Arr_parms['pacientes_id_ultima_gestion']['link'] = "S";
       $Arr_parms['pacientes_usuario_creacion']['alin'] = "''";
       $Arr_parms['pacientes_usuario_creacion']['link'] = "S";
       $Arr_parms['tratamiento_id_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_id_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_producto_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_producto_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_nombre_referencia']['alin'] = "''";
       $Arr_parms['tratamiento_nombre_referencia']['link'] = "S";
       $Arr_parms['tratamiento_clasificacion_patologica_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_clasificacion_patologica_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_tratamiento_previo']['alin'] = "''";
       $Arr_parms['tratamiento_tratamiento_previo']['link'] = "S";
       $Arr_parms['tratamiento_consentimiento_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_consentimiento_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_fecha_inicio_terapia_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_fecha_inicio_terapia_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_regimen_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_regimen_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_asegurador_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_asegurador_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_operador_logistico_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_operador_logistico_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_punto_entrega']['alin'] = "''";
       $Arr_parms['tratamiento_punto_entrega']['link'] = "S";
       $Arr_parms['tratamiento_fecha_ultima_reclamacion_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_fecha_ultima_reclamacion_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_otros_operadores_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_otros_operadores_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_medios_adquisicion_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_medios_adquisicion_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_ips_atiende_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_ips_atiende_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_medico_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_medico_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_especialidad_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_especialidad_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_paramedico_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_paramedico_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_zona_atencion_paramedico_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_zona_atencion_paramedico_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_ciudad_base_paramedico_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_ciudad_base_paramedico_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_notas_adjuntos_tratamiento']['alin'] = "''";
       $Arr_parms['tratamiento_notas_adjuntos_tratamiento']['link'] = "S";
       $Arr_parms['tratamiento_id_paciente_fk']['alin'] = "''";
       $Arr_parms['tratamiento_id_paciente_fk']['link'] = "S";
       $Arr_parms['gestiones_id_gestion']['alin'] = "''";
       $Arr_parms['gestiones_id_gestion']['link'] = "S";
       $Arr_parms['gestiones_motivo_comunicacion_gestion']['alin'] = "''";
       $Arr_parms['gestiones_motivo_comunicacion_gestion']['link'] = "S";
       $Arr_parms['gestiones_medio_contacto_gestion']['alin'] = "''";
       $Arr_parms['gestiones_medio_contacto_gestion']['link'] = "S";
       $Arr_parms['gestiones_tipo_llamada_gestion']['alin'] = "''";
       $Arr_parms['gestiones_tipo_llamada_gestion']['link'] = "S";
       $Arr_parms['gestiones_logro_comunicacion_gestion']['alin'] = "''";
       $Arr_parms['gestiones_logro_comunicacion_gestion']['link'] = "S";
       $Arr_parms['gestiones_motivo_no_comunicacion_gestion']['alin'] = "''";
       $Arr_parms['gestiones_motivo_no_comunicacion_gestion']['link'] = "S";
       $Arr_parms['gestiones_numero_intentos_gestion']['alin'] = "''";
       $Arr_parms['gestiones_numero_intentos_gestion']['link'] = "S";
       $Arr_parms['gestiones_esperado_gestion']['alin'] = "''";
       $Arr_parms['gestiones_esperado_gestion']['link'] = "S";
       $Arr_parms['gestiones_estado_ctc_gestion']['alin'] = "''";
       $Arr_parms['gestiones_estado_ctc_gestion']['link'] = "S";
       $Arr_parms['gestiones_estado_farmacia_gestion']['alin'] = "''";
       $Arr_parms['gestiones_estado_farmacia_gestion']['link'] = "S";
       $Arr_parms['gestiones_reclamo_gestion']['alin'] = "''";
       $Arr_parms['gestiones_reclamo_gestion']['link'] = "S";
       $Arr_parms['gestiones_causa_no_reclamacion_gestion']['alin'] = "''";
       $Arr_parms['gestiones_causa_no_reclamacion_gestion']['link'] = "S";
       $Arr_parms['gestiones_dificultad_acceso_gestion']['alin'] = "''";
       $Arr_parms['gestiones_dificultad_acceso_gestion']['link'] = "S";
       $Arr_parms['gestiones_tipo_dificultad_gestion']['alin'] = "''";
       $Arr_parms['gestiones_tipo_dificultad_gestion']['link'] = "S";
       $Arr_parms['gestiones_envios_gestion']['alin'] = "''";
       $Arr_parms['gestiones_envios_gestion']['link'] = "S";
       $Arr_parms['gestiones_medicamentos_gestion']['alin'] = "''";
       $Arr_parms['gestiones_medicamentos_gestion']['link'] = "S";
       $Arr_parms['gestiones_tipo_envio_gestion']['alin'] = "''";
       $Arr_parms['gestiones_tipo_envio_gestion']['link'] = "S";
       $Arr_parms['gestiones_evento_adverso_gestion']['alin'] = "''";
       $Arr_parms['gestiones_evento_adverso_gestion']['link'] = "S";
       $Arr_parms['gestiones_tipo_evento_adverso']['alin'] = "''";
       $Arr_parms['gestiones_tipo_evento_adverso']['link'] = "S";
       $Arr_parms['gestiones_genera_solicitud_gestion']['alin'] = "''";
       $Arr_parms['gestiones_genera_solicitud_gestion']['link'] = "S";
       $Arr_parms['gestiones_fecha_proxima_llamada']['alin'] = "''";
       $Arr_parms['gestiones_fecha_proxima_llamada']['link'] = "S";
       $Arr_parms['gestiones_motivo_proxima_llamada']['alin'] = "''";
       $Arr_parms['gestiones_motivo_proxima_llamada']['link'] = "S";
       $Arr_parms['gestiones_observacion_proxima_llamada']['alin'] = "''";
       $Arr_parms['gestiones_observacion_proxima_llamada']['link'] = "S";
       $Arr_parms['gestiones_fecha_reclamacion_gestion']['alin'] = "''";
       $Arr_parms['gestiones_fecha_reclamacion_gestion']['link'] = "S";
       $Arr_parms['gestiones_consecutivo_gestion']['alin'] = "''";
       $Arr_parms['gestiones_consecutivo_gestion']['link'] = "S";
       $Arr_parms['gestiones_autor_gestion']['alin'] = "''";
       $Arr_parms['gestiones_autor_gestion']['link'] = "S";
       $Arr_parms['gestiones_nota']['alin'] = "''";
       $Arr_parms['gestiones_nota']['link'] = "S";
       $Arr_parms['gestiones_fecha_programada_gestion']['alin'] = "''";
       $Arr_parms['gestiones_fecha_programada_gestion']['link'] = "S";
       $Arr_parms['gestiones_usuario_asigando']['alin'] = "''";
       $Arr_parms['gestiones_usuario_asigando']['link'] = "S";
       $Arr_parms['gestiones_id_paciente_fk2']['alin'] = "''";
       $Arr_parms['gestiones_id_paciente_fk2']['link'] = "S";
       $Arr_parms['gestiones_fecha_comunicacion']['alin'] = "''";
       $Arr_parms['gestiones_fecha_comunicacion']['link'] = "S";
       $Arr_parms['gestiones_estado_gestion']['alin'] = "''";
       $Arr_parms['gestiones_estado_gestion']['link'] = "S";
       $Arr_parms['gestiones_codigo_argus']['alin'] = "''";
       $Arr_parms['gestiones_codigo_argus']['link'] = "S";
       $Arr_parms['gestiones_numero_cajas']['alin'] = "''";
       $Arr_parms['gestiones_numero_cajas']['link'] = "S";
       $Arr_parms['pacientes_id_paciente']['fill'] = "true";
       $Arr_parms['pacientes_id_paciente']['order'] = "label";
       $Arr_parms['pacientes_estado_paciente']['fill'] = "true";
       $Arr_parms['pacientes_estado_paciente']['order'] = "label";
       $Arr_parms['pacientes_fecha_activacion_paciente']['fill'] = "true";
       $Arr_parms['pacientes_fecha_activacion_paciente']['order'] = "label";
       $Arr_parms['pacientes_fecha_retiro_paciente']['fill'] = "true";
       $Arr_parms['pacientes_fecha_retiro_paciente']['order'] = "label";
       $Arr_parms['pacientes_motivo_retiro_paciente']['fill'] = "true";
       $Arr_parms['pacientes_motivo_retiro_paciente']['order'] = "label";
       $Arr_parms['pacientes_observacion_motivo_retiro_paciente']['fill'] = "true";
       $Arr_parms['pacientes_observacion_motivo_retiro_paciente']['order'] = "label";
       $Arr_parms['pacientes_identificacion_paciente']['fill'] = "true";
       $Arr_parms['pacientes_identificacion_paciente']['order'] = "label";
       $Arr_parms['pacientes_nombre_paciente']['fill'] = "true";
       $Arr_parms['pacientes_nombre_paciente']['order'] = "label";
       $Arr_parms['pacientes_apellido_paciente']['fill'] = "true";
       $Arr_parms['pacientes_apellido_paciente']['order'] = "label";
       $Arr_parms['pacientes_telefono_paciente']['fill'] = "true";
       $Arr_parms['pacientes_telefono_paciente']['order'] = "label";
       $Arr_parms['pacientes_telefono2_paciente']['fill'] = "true";
       $Arr_parms['pacientes_telefono2_paciente']['order'] = "label";
       $Arr_parms['pacientes_telefono3_paciente']['fill'] = "true";
       $Arr_parms['pacientes_telefono3_paciente']['order'] = "label";
       $Arr_parms['pacientes_correo_paciente']['fill'] = "true";
       $Arr_parms['pacientes_correo_paciente']['order'] = "label";
       $Arr_parms['pacientes_direccion_paciente']['fill'] = "true";
       $Arr_parms['pacientes_direccion_paciente']['order'] = "label";
       $Arr_parms['pacientes_barrio_paciente']['fill'] = "true";
       $Arr_parms['pacientes_barrio_paciente']['order'] = "label";
       $Arr_parms['pacientes_departamento_paciente']['fill'] = "true";
       $Arr_parms['pacientes_departamento_paciente']['order'] = "label";
       $Arr_parms['pacientes_ciudad_paciente']['fill'] = "true";
       $Arr_parms['pacientes_ciudad_paciente']['order'] = "label";
       $Arr_parms['pacientes_genero_paciente']['fill'] = "true";
       $Arr_parms['pacientes_genero_paciente']['order'] = "label";
       $Arr_parms['pacientes_fecha_nacimineto_paciente']['fill'] = "true";
       $Arr_parms['pacientes_fecha_nacimineto_paciente']['order'] = "label";
       $Arr_parms['pacientes_edad_paciente']['fill'] = "true";
       $Arr_parms['pacientes_edad_paciente']['order'] = "label";
       $Arr_parms['pacientes_acudiente_paciente']['fill'] = "true";
       $Arr_parms['pacientes_acudiente_paciente']['order'] = "label";
       $Arr_parms['pacientes_telefono_acudiente_paciente']['fill'] = "true";
       $Arr_parms['pacientes_telefono_acudiente_paciente']['order'] = "label";
       $Arr_parms['pacientes_codigo_xofigo']['fill'] = "true";
       $Arr_parms['pacientes_codigo_xofigo']['order'] = "label";
       $Arr_parms['pacientes_status_paciente']['fill'] = "true";
       $Arr_parms['pacientes_status_paciente']['order'] = "label";
       $Arr_parms['pacientes_id_ultima_gestion']['fill'] = "true";
       $Arr_parms['pacientes_id_ultima_gestion']['order'] = "label";
       $Arr_parms['pacientes_usuario_creacion']['fill'] = "true";
       $Arr_parms['pacientes_usuario_creacion']['order'] = "label";
       $Arr_parms['tratamiento_id_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_id_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_producto_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_producto_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_nombre_referencia']['fill'] = "true";
       $Arr_parms['tratamiento_nombre_referencia']['order'] = "label";
       $Arr_parms['tratamiento_clasificacion_patologica_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_clasificacion_patologica_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_tratamiento_previo']['fill'] = "true";
       $Arr_parms['tratamiento_tratamiento_previo']['order'] = "label";
       $Arr_parms['tratamiento_consentimiento_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_consentimiento_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_fecha_inicio_terapia_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_fecha_inicio_terapia_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_regimen_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_regimen_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_asegurador_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_asegurador_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_operador_logistico_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_operador_logistico_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_punto_entrega']['fill'] = "true";
       $Arr_parms['tratamiento_punto_entrega']['order'] = "label";
       $Arr_parms['tratamiento_fecha_ultima_reclamacion_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_fecha_ultima_reclamacion_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_otros_operadores_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_otros_operadores_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_medios_adquisicion_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_medios_adquisicion_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_ips_atiende_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_ips_atiende_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_medico_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_medico_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_especialidad_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_especialidad_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_paramedico_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_paramedico_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_zona_atencion_paramedico_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_zona_atencion_paramedico_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_ciudad_base_paramedico_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_ciudad_base_paramedico_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_notas_adjuntos_tratamiento']['fill'] = "true";
       $Arr_parms['tratamiento_notas_adjuntos_tratamiento']['order'] = "label";
       $Arr_parms['tratamiento_id_paciente_fk']['fill'] = "true";
       $Arr_parms['tratamiento_id_paciente_fk']['order'] = "label";
       $Arr_parms['gestiones_id_gestion']['fill'] = "true";
       $Arr_parms['gestiones_id_gestion']['order'] = "label";
       $Arr_parms['gestiones_motivo_comunicacion_gestion']['fill'] = "true";
       $Arr_parms['gestiones_motivo_comunicacion_gestion']['order'] = "label";
       $Arr_parms['gestiones_medio_contacto_gestion']['fill'] = "true";
       $Arr_parms['gestiones_medio_contacto_gestion']['order'] = "label";
       $Arr_parms['gestiones_tipo_llamada_gestion']['fill'] = "true";
       $Arr_parms['gestiones_tipo_llamada_gestion']['order'] = "label";
       $Arr_parms['gestiones_logro_comunicacion_gestion']['fill'] = "true";
       $Arr_parms['gestiones_logro_comunicacion_gestion']['order'] = "label";
       $Arr_parms['gestiones_motivo_no_comunicacion_gestion']['fill'] = "true";
       $Arr_parms['gestiones_motivo_no_comunicacion_gestion']['order'] = "label";
       $Arr_parms['gestiones_numero_intentos_gestion']['fill'] = "true";
       $Arr_parms['gestiones_numero_intentos_gestion']['order'] = "label";
       $Arr_parms['gestiones_esperado_gestion']['fill'] = "true";
       $Arr_parms['gestiones_esperado_gestion']['order'] = "label";
       $Arr_parms['gestiones_estado_ctc_gestion']['fill'] = "true";
       $Arr_parms['gestiones_estado_ctc_gestion']['order'] = "label";
       $Arr_parms['gestiones_estado_farmacia_gestion']['fill'] = "true";
       $Arr_parms['gestiones_estado_farmacia_gestion']['order'] = "label";
       $Arr_parms['gestiones_reclamo_gestion']['fill'] = "true";
       $Arr_parms['gestiones_reclamo_gestion']['order'] = "label";
       $Arr_parms['gestiones_causa_no_reclamacion_gestion']['fill'] = "true";
       $Arr_parms['gestiones_causa_no_reclamacion_gestion']['order'] = "label";
       $Arr_parms['gestiones_dificultad_acceso_gestion']['fill'] = "true";
       $Arr_parms['gestiones_dificultad_acceso_gestion']['order'] = "label";
       $Arr_parms['gestiones_tipo_dificultad_gestion']['fill'] = "true";
       $Arr_parms['gestiones_tipo_dificultad_gestion']['order'] = "label";
       $Arr_parms['gestiones_envios_gestion']['fill'] = "true";
       $Arr_parms['gestiones_envios_gestion']['order'] = "label";
       $Arr_parms['gestiones_medicamentos_gestion']['fill'] = "true";
       $Arr_parms['gestiones_medicamentos_gestion']['order'] = "label";
       $Arr_parms['gestiones_tipo_envio_gestion']['fill'] = "true";
       $Arr_parms['gestiones_tipo_envio_gestion']['order'] = "label";
       $Arr_parms['gestiones_evento_adverso_gestion']['fill'] = "true";
       $Arr_parms['gestiones_evento_adverso_gestion']['order'] = "label";
       $Arr_parms['gestiones_tipo_evento_adverso']['fill'] = "true";
       $Arr_parms['gestiones_tipo_evento_adverso']['order'] = "label";
       $Arr_parms['gestiones_genera_solicitud_gestion']['fill'] = "true";
       $Arr_parms['gestiones_genera_solicitud_gestion']['order'] = "label";
       $Arr_parms['gestiones_fecha_proxima_llamada']['fill'] = "true";
       $Arr_parms['gestiones_fecha_proxima_llamada']['order'] = "label";
       $Arr_parms['gestiones_motivo_proxima_llamada']['fill'] = "true";
       $Arr_parms['gestiones_motivo_proxima_llamada']['order'] = "label";
       $Arr_parms['gestiones_observacion_proxima_llamada']['fill'] = "true";
       $Arr_parms['gestiones_observacion_proxima_llamada']['order'] = "label";
       $Arr_parms['gestiones_fecha_reclamacion_gestion']['fill'] = "true";
       $Arr_parms['gestiones_fecha_reclamacion_gestion']['order'] = "label";
       $Arr_parms['gestiones_consecutivo_gestion']['fill'] = "true";
       $Arr_parms['gestiones_consecutivo_gestion']['order'] = "label";
       $Arr_parms['gestiones_autor_gestion']['fill'] = "true";
       $Arr_parms['gestiones_autor_gestion']['order'] = "label";
       $Arr_parms['gestiones_nota']['fill'] = "true";
       $Arr_parms['gestiones_nota']['order'] = "label";
       $Arr_parms['gestiones_fecha_programada_gestion']['fill'] = "true";
       $Arr_parms['gestiones_fecha_programada_gestion']['order'] = "label";
       $Arr_parms['gestiones_usuario_asigando']['fill'] = "true";
       $Arr_parms['gestiones_usuario_asigando']['order'] = "label";
       $Arr_parms['gestiones_id_paciente_fk2']['fill'] = "true";
       $Arr_parms['gestiones_id_paciente_fk2']['order'] = "label";
       $Arr_parms['gestiones_fecha_comunicacion']['fill'] = "true";
       $Arr_parms['gestiones_fecha_comunicacion']['order'] = "value";
       $Arr_parms['gestiones_estado_gestion']['fill'] = "true";
       $Arr_parms['gestiones_estado_gestion']['order'] = "label";
       $Arr_parms['gestiones_codigo_argus']['fill'] = "true";
       $Arr_parms['gestiones_codigo_argus']['order'] = "label";
       $Arr_parms['gestiones_numero_cajas']['fill'] = "true";
       $Arr_parms['gestiones_numero_cajas']['order'] = "label";
       //-----
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? "" : ", ";
          $Str_gb .= $Arr_parms[$cmp_gb]['alin'];
       }
       eval ("\$this->comp_align = array(" . $Str_gb . ");");;

       //-----
       $x = 0;
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
           if ($Arr_parms[$cmp_gb]['link'] == "S")
           {
              $Str_gb .= ($Str_gb == "") ? $x : ", " . $x;
           }
          $x++;
       }
       eval ("\$this->comp_links_gr = array(" . $Str_gb . ");");;

       //-----
       $prep_links_fl = array();
       $prep_links_fl['pacientes_id_paciente'] = array(0 => 'pacientes.ID_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_estado_paciente'] = array(0 => 'pacientes.ESTADO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_fecha_activacion_paciente'] = array(0 => 'pacientes.FECHA_ACTIVACION_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_fecha_retiro_paciente'] = array(0 => 'pacientes.FECHA_RETIRO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_motivo_retiro_paciente'] = array(0 => 'pacientes.MOTIVO_RETIRO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_observacion_motivo_retiro_paciente'] = array(0 => 'pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_identificacion_paciente'] = array(0 => 'pacientes.IDENTIFICACION_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_nombre_paciente'] = array(0 => 'pacientes.NOMBRE_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_apellido_paciente'] = array(0 => 'pacientes.APELLIDO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_telefono_paciente'] = array(0 => 'pacientes.TELEFONO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_telefono2_paciente'] = array(0 => 'pacientes.TELEFONO2_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_telefono3_paciente'] = array(0 => 'pacientes.TELEFONO3_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_correo_paciente'] = array(0 => 'pacientes.CORREO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_direccion_paciente'] = array(0 => 'pacientes.DIRECCION_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_barrio_paciente'] = array(0 => 'pacientes.BARRIO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_departamento_paciente'] = array(0 => 'pacientes.DEPARTAMENTO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_ciudad_paciente'] = array(0 => 'pacientes.CIUDAD_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_genero_paciente'] = array(0 => 'pacientes.GENERO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_fecha_nacimineto_paciente'] = array(0 => 'pacientes.FECHA_NACIMINETO_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_edad_paciente'] = array(0 => 'pacientes.EDAD_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_acudiente_paciente'] = array(0 => 'pacientes.ACUDIENTE_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_telefono_acudiente_paciente'] = array(0 => 'pacientes.TELEFONO_ACUDIENTE_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_codigo_xofigo'] = array(0 => 'pacientes.CODIGO_XOFIGO', 1 => '@aspass@');
       $prep_links_fl['pacientes_status_paciente'] = array(0 => 'pacientes.STATUS_PACIENTE', 1 => '@aspass@');
       $prep_links_fl['pacientes_id_ultima_gestion'] = array(0 => 'pacientes.ID_ULTIMA_GESTION', 1 => '@aspass@');
       $prep_links_fl['pacientes_usuario_creacion'] = array(0 => 'pacientes.USUARIO_CREACION', 1 => '@aspass@');
       $prep_links_fl['tratamiento_id_tratamiento'] = array(0 => 'tratamiento.ID_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_producto_tratamiento'] = array(0 => 'tratamiento.PRODUCTO_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_nombre_referencia'] = array(0 => 'tratamiento.NOMBRE_REFERENCIA', 1 => '@aspass@');
       $prep_links_fl['tratamiento_clasificacion_patologica_tratamiento'] = array(0 => 'tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_tratamiento_previo'] = array(0 => 'tratamiento.TRATAMIENTO_PREVIO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_consentimiento_tratamiento'] = array(0 => 'tratamiento.CONSENTIMIENTO_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_fecha_inicio_terapia_tratamiento'] = array(0 => 'tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_regimen_tratamiento'] = array(0 => 'tratamiento.REGIMEN_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_asegurador_tratamiento'] = array(0 => 'tratamiento.ASEGURADOR_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_operador_logistico_tratamiento'] = array(0 => 'tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_punto_entrega'] = array(0 => 'tratamiento.PUNTO_ENTREGA', 1 => '@aspass@');
       $prep_links_fl['tratamiento_fecha_ultima_reclamacion_tratamiento'] = array(0 => 'tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_otros_operadores_tratamiento'] = array(0 => 'tratamiento.OTROS_OPERADORES_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_medios_adquisicion_tratamiento'] = array(0 => 'tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_ips_atiende_tratamiento'] = array(0 => 'tratamiento.IPS_ATIENDE_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_medico_tratamiento'] = array(0 => 'tratamiento.MEDICO_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_especialidad_tratamiento'] = array(0 => 'tratamiento.ESPECIALIDAD_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_paramedico_tratamiento'] = array(0 => 'tratamiento.PARAMEDICO_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_zona_atencion_paramedico_tratamiento'] = array(0 => 'tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_ciudad_base_paramedico_tratamiento'] = array(0 => 'tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_notas_adjuntos_tratamiento'] = array(0 => 'tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO', 1 => '@aspass@');
       $prep_links_fl['tratamiento_id_paciente_fk'] = array(0 => 'tratamiento.ID_PACIENTE_FK', 1 => '@aspass@');
       $prep_links_fl['gestiones_id_gestion'] = array(0 => 'gestiones.ID_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_motivo_comunicacion_gestion'] = array(0 => 'gestiones.MOTIVO_COMUNICACION_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_medio_contacto_gestion'] = array(0 => 'gestiones.MEDIO_CONTACTO_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_tipo_llamada_gestion'] = array(0 => 'gestiones.TIPO_LLAMADA_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_logro_comunicacion_gestion'] = array(0 => 'gestiones.LOGRO_COMUNICACION_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_motivo_no_comunicacion_gestion'] = array(0 => 'gestiones.MOTIVO_NO_COMUNICACION_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_numero_intentos_gestion'] = array(0 => 'gestiones.NUMERO_INTENTOS_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_esperado_gestion'] = array(0 => 'gestiones.ESPERADO_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_estado_ctc_gestion'] = array(0 => 'gestiones.ESTADO_CTC_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_estado_farmacia_gestion'] = array(0 => 'gestiones.ESTADO_FARMACIA_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_reclamo_gestion'] = array(0 => 'gestiones.RECLAMO_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_causa_no_reclamacion_gestion'] = array(0 => 'gestiones.CAUSA_NO_RECLAMACION_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_dificultad_acceso_gestion'] = array(0 => 'gestiones.DIFICULTAD_ACCESO_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_tipo_dificultad_gestion'] = array(0 => 'gestiones.TIPO_DIFICULTAD_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_envios_gestion'] = array(0 => 'gestiones.ENVIOS_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_medicamentos_gestion'] = array(0 => 'gestiones.MEDICAMENTOS_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_tipo_envio_gestion'] = array(0 => 'gestiones.TIPO_ENVIO_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_evento_adverso_gestion'] = array(0 => 'gestiones.EVENTO_ADVERSO_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_tipo_evento_adverso'] = array(0 => 'gestiones.TIPO_EVENTO_ADVERSO', 1 => '@aspass@');
       $prep_links_fl['gestiones_genera_solicitud_gestion'] = array(0 => 'gestiones.GENERA_SOLICITUD_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_fecha_proxima_llamada'] = array(0 => 'gestiones.FECHA_PROXIMA_LLAMADA', 1 => '@aspass@');
       $prep_links_fl['gestiones_motivo_proxima_llamada'] = array(0 => 'gestiones.MOTIVO_PROXIMA_LLAMADA', 1 => '@aspass@');
       $prep_links_fl['gestiones_observacion_proxima_llamada'] = array(0 => 'gestiones.OBSERVACION_PROXIMA_LLAMADA', 1 => '@aspass@');
       $prep_links_fl['gestiones_fecha_reclamacion_gestion'] = array(0 => 'gestiones.FECHA_RECLAMACION_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_consecutivo_gestion'] = array(0 => 'gestiones.CONSECUTIVO_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_autor_gestion'] = array(0 => 'gestiones.AUTOR_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_nota'] = array(0 => 'gestiones.NOTA', 1 => '@aspass@');
       $prep_links_fl['gestiones_fecha_programada_gestion'] = array(0 => 'gestiones.FECHA_PROGRAMADA_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_usuario_asigando'] = array(0 => 'gestiones.USUARIO_ASIGANDO', 1 => '@aspass@');
       $prep_links_fl['gestiones_id_paciente_fk2'] = array(0 => 'gestiones.ID_PACIENTE_FK2', 1 => '@aspass@');
       $prep_links_fl['gestiones_fecha_comunicacion'] = array(0 => 'gestiones.FECHA_COMUNICACION', 1 => '@aspass@');
       $prep_links_fl['gestiones_estado_gestion'] = array(0 => 'gestiones.ESTADO_GESTION', 1 => '@aspass@');
       $prep_links_fl['gestiones_codigo_argus'] = array(0 => 'gestiones.CODIGO_ARGUS', 1 => '@aspass@');
       $prep_links_fl['gestiones_numero_cajas'] = array(0 => 'gestiones.NUMERO_CAJAS', 1 => '@aspass@');
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
           if (isset($prep_links_fl[$cmp_gb]))
           {
              $Str_gb .= "array('name' => '" . $prep_links_fl[$cmp_gb][0] . "', 'prot' => '" . $prep_links_fl[$cmp_gb][1] . "'),";
           }
       }
       eval ("\$this->comp_links_fl = array(" . $Str_gb . ");");;

       //-----
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? "" : ", ";
          $Str_gb .= $Arr_parms[$cmp_gb]['fill'];
       }
       eval ("\$this->comp_fill = array(" . $Str_gb . ");");;

       //-----
       $x = 0;
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? $x : ", " . $x;
          $Str_gb .= " => 'label'";
          $x++;
       }
       eval ("\$this->comp_display = array(" . $Str_gb . ");");;

       //-----
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? "" : ", ";
          $Str_gb .= $Arr_parms[$cmp_gb]['order'];
       }
       eval ("\$this->comp_order = array(" . $Str_gb . ");");;

       //-----
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_group_by'] = $this->comp_field;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_x_axys']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_x_axys'] = $this->comp_x_axys;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_y_axys']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_y_axys'] = $this->comp_y_axys;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_fill']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_fill'] = $this->comp_fill;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order'] = $this->comp_order;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_tabular']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_tabular'] = $this->comp_tabular;
       }

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_col']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_col'] = 0;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_level']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_level'] = 0;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_sort']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_sort'] = '';
       }
       if (isset($_POST['change_sort']) && 'Y' == $_POST['change_sort'])
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_sort'] = $_POST['sort_ord'];
           if ('' == $_POST['sort_ord'])
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_col']  = 0;
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_col']  = $_POST['sort_col'];
           }
       }

       $this->comp_x_axys      = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_x_axys'];
       $this->comp_y_axys      = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_y_axys'];
       $this->comp_fill        = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_fill'];
       $this->comp_order       = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order'];
       $this->comp_order_col   = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_col'];
       $this->comp_order_level = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_level'];
       $this->comp_order_sort  = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_order_sort'];
       $this->comp_tabular     = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_tabular'];

       if (1 >= sizeof($this->comp_y_axys))
       {
           $this->comp_tabular = false;
       }

       //-----
       for ($i = 0; $i < sizeof($this->comp_label); $i++) {
           if ('label' == $this->comp_order[$i]) {
               asort($this->comp_index[$i]);
               $this->comp_label[$i] = $this->arrangeLabelList($this->comp_label[$i], $i, 'asort');
           }
           else {
               ksort($this->comp_index[$i]);
               $this->comp_label[$i] = $this->arrangeLabelList($this->comp_label[$i], $i, 'ksort');
           }
       }

       //-----
      $Str_gb   = "";
      $Arr_gb   = array();
      $Arr_name = array();
      $Arr_lab  = array();
      $Arr_grp  = array();
      $Control  = "";
      $Ctr_grp  = "";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $Ctr_grp   .= "[\$campo_" . $cmp_gb . "]";
          $Arr_gb[]   = $cmp_gb;
          $Arr_name[] = "array_total_" . $cmp_gb;
          $Arr_lab[]  = $Control;
          $Arr_grp[]  = $Ctr_grp;
          $Control   .= "[\$campo_" . $cmp_gb . "]";
      }
      for ($ix = 0; $ix < sizeof($Arr_gb); $ix++)
      {
          $Str_gb .= "foreach (\$this->comp_label[" . $ix . "]" . $Arr_lab[$ix] . " as \$campo_" . $Arr_gb[$ix] . " => \$dados_" . $Arr_gb[$ix] . ") {";
          $Str_gb .= "    if (isset(\$this->" . $Arr_name[$ix] . $Arr_grp[$ix] . ")) {";
          $Str_gb .= "        \$this->comp_group" . $Arr_grp[$ix] . " = array();";
          $Str_gb .= "    }";
      }
      for ($ix = 0; $ix < sizeof($Arr_gb); $ix++)
      {
          $Str_gb .= "}";
      }
      eval ($Str_gb);

   }

   function arrangeLabelList($label, $level, $method) {
       $new_label = $label;

       if (0 == $level) {
           if ('reverse' == $method) {
               $new_label = array_reverse($new_label, true);
           }
           elseif ('asort' == $method) {
               asort($new_label);
           }
           else {
               ksort($new_label);
           }
       }
       else {
           foreach ($label as $i => $sub_label) {
               $new_label[$i] = $this->arrangeLabelList($sub_label, $level - 1, $method);
           }
       }

       return $new_label;
   }

   function getCompData($level, $params = array()) {
      $Str_gb   = "";
      $Arr_name = array();
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $Arr_name[] = "array_total_" . $cmp_gb;
      }
      for ($ix = 0; $ix < sizeof($Arr_name); $ix++)
      {
          $Str_gb .= "    if (\$level == " . $ix . ") {";
          $Str_gb .= "        \$return = \$this->" . $Arr_name[$ix] . ";";
          $Str_gb .= "    }";
      }
      eval ($Str_gb);

       if (array() == $params) {
           return $return;
       }

       foreach ($params as $i_param => $param) {
           if (!isset($return[$param])) {
               return 0;
           }

           $return = $return[$param];
       }

       return $return;
   }   

   function buildMatrix()
   {
       $this->build_labels = $this->getXAxys();
       $this->build_data   = $this->getYAxys();
   }

   function getXAxys()
   {
       $a_axys = array();

       if (0 == sizeof($this->comp_x_axys))
       {
           if (0 < sizeof($this->comp_sum))
           {
               foreach ($this->comp_sum_order as $i_sum)
               {
                   if ($this->comp_sum_display[$i_sum])
                   {
                       $l_sum = $this->comp_sum[$i_sum];
                       $chart    = '0|' . ($i_sum - 1) . '|';
                       $a_axys[] = array(
                           'group'    => 1,
                           'value'    => $i_sum,
                           'label'    => $l_sum,
                           'function' => $this->comp_sum_fn[$i_sum],
                           'params'   => array($i_sum - 1),
                           'children' => array(),
                           'chart'    => $chart,
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                       );
                   }
               }
           }
           else
           {
               $a_axys = array();
           }
           $a_labels[] = $a_axys;
       }
       else
       {
           foreach ($this->comp_index[0] as $i_group => $l_group)
           {
               $a_params = array($i_group);
               $a_axys[] = array(
                   'group'    => 0,
                   'value'    => $i_group,
                   'label'    => $l_group,
                   'params'   => $a_params,
                   'children' => $this->addChildren(1, $this->comp_fill[1], $this->comp_group[$i_group], $a_params),
               );
           }

           $a_labels = array();
           $this->addChildrenLabel($a_axys, $a_labels);
       }

       if ($this->show_totals_x && 0 < sizeof($this->comp_x_axys))
       {
           $a_labels[0][] = array(
               'group'   => -1,
               'value'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
               'label'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
               'params'  => array(),
               'colspan' => sizeof($this->comp_sum),
               'rowspan' => sizeof($this->comp_x_axys),
           );
           foreach ($this->comp_sum_order as $i_sum)
           {
               if ($this->comp_sum_display[$i_sum])
               {
                   $s_label = $this->comp_sum[$i_sum];
                   $a_labels[sizeof($this->comp_x_axys)][] = array(
                       'group'    => -1,
                       'value'    => $s_label,
                       'label'    => $s_label,
                       'function' => $this->comp_sum_fn[$i_sum],
                       'params'   => array(),
                       'chart'    => 'T|' . ($i_sum - 1),
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                   );
               }
           }
       }

       return $a_labels;
   }

   function addChildren($group, $fill, $children, $params)
   {
       if (!isset($this->comp_x_axys[$group]))
       {
           if (0 < sizeof($this->comp_sum))
           {
               $a_sum = array();
               foreach ($this->comp_sum_order as $i_sum)
               {
                   if ($this->comp_sum_display[$i_sum])
                   {
                       $l_sum = $this->comp_sum[$i_sum];
                       $chart    = $group . '|' . ($i_sum - 1) . '|' . implode('|', $params);
                       $params_n = array_merge($params, array($i_sum - 1));
                       $a_sum[] = array(
                           'group'    => $group,
                           'value'    => $i_sum,
                           'label'    => $l_sum,
                           'function' => $this->comp_sum_fn[$i_sum],
                           'params'   => $params_n,
                           'children' => array(),
                           'chart'    => $chart,
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                       );
                   }
               }
               return $a_sum;
           }
           else
           {
               return array();
           }
       }

       $a_axys = array();

       if ($fill)
       {
           foreach ($this->comp_index[$group] as $i_group => $l_group)
           {
               $params_n = array_merge($params, array($i_group));
               $a_axys[] = array(
                   'group'    => $group,
                   'value'    => $i_group,
                   'label'    => $l_group,
                   'params'   => $params_n,
                   'children' => $this->addChildren($group + 1, $this->comp_fill[$group + 1], $children[$i_group], $params_n),
               );
           }
       }
       else
       {
           foreach ($children as $i_group => $a_group)
           {
               $params_n = array_merge($params, array($i_group));
               $a_axys[] = array(
                   'group'    => $group,
                   'value'    => $i_group,
                   'label'    => $this->comp_index[$group][$i_group],
                   'params'   => $params_n,
                   'children' => $this->addChildren($group + 1, $this->comp_fill[$group + 1], $children[$i_group], $params_n),
               );
           }
       }

       return $a_axys;
   }

   function countChildren($children)
   {
       if (empty($children))
       {
           return 1;
       }

       $i = 0;
       foreach ($children as $data)
       {
           $i += $this->countChildren($data['children']);
       }
       return $i;
   }

   function addChildrenLabel($children, &$a_labels)
   {
       foreach ($children as $a_cols)
       {
           $a_labels[$a_cols['group']][] = array(
               'group'    => $a_cols['group'],
               'value'    => $a_cols['value'],
               'label'    => $a_cols['label'],
               'function' => isset($a_cols['function']) ? $a_cols['function'] : '',
               'params'   => $a_cols['params'],
               'colspan'  => $this->countChildren($a_cols['children']),
               'chart'    => isset($a_cols['chart']) ? $a_cols['chart'] : '',
               'css'      => isset($a_cols['css'])   ? $a_cols['css']   : '',
           );
           if (!empty($a_cols['children']))
           {
               $this->addChildrenLabel($a_cols['children'], $a_labels);
           }
       }
   }

   function getYAxys()
   {
       $a_axys = array();

       $this->addYChildren(0, $this->comp_group, $a_axys, array());
       $this->fixOrder($a_axys);
       $this->orderBy($a_axys, $this->comp_order_sort, $this->comp_order_col - 1, 0, array());
       $this->comp_chart_axys = $a_axys;

       $a_data              = array();
       $i_row               = 0;
       $this->subtotal_data = array();
       $this->addYChildrenData($a_axys, $a_data, $i_row, 0, array(), array());

       if (!empty($this->subtotal_data))
       {
           end($this->subtotal_data);
           $i_max = key($this->subtotal_data);
           for ($i = $i_max; $i >= 0; $i--)
           {
               $a_data[] = $this->subtotal_data[$i];
           }
       }

       $this->makeTabular($a_data);

       $this->buildTotalsY($a_data);

       return $a_data;
   }

   function addYChildren($group, $tree, &$axys, $param)
   {
       $comp_label = $this->comp_label[$group];
       $tmp_param  = $param;
       while (!empty($tmp_param))
       {
           $tmp_index  = array_shift($tmp_param);
           $comp_label = $comp_label[$tmp_index];
       }
       foreach ($comp_label as $i_group => $l_group)
       {
           if (isset($tree[$i_group]))
           {
               $new_param = array_merge($param, array($i_group));
               if (in_array($group, $this->comp_y_axys))
               {
                   if (!isset($axys[$i_group]))
                   {
                       $axys[$i_group] = array(
                           'group'    => $group,
                           'value'    => $i_group,
                           'label'    => $l_group,
                           'children' => array(),
                       );
                   }
                   $this->addYChildren($group + 1, $tree[$i_group], $axys[$i_group]['children'], $new_param);
               }
               else
               {
                   $this->addYChildren($group + 1, $tree[$i_group], $axys, $new_param);
               }
           }
       }
   }

   function fixOrder(&$axys)
   {
       $n_axys = array();
       $key    = key($axys);
       $group  = $axys[$key]['group'];

       foreach ($this->comp_index[$group] as $i_group => $l_group)
       {
           if (isset($axys[$i_group]))
           {
               $n_axys[$i_group] = $axys[$i_group];
           }
           if (!empty($n_axys[$i_group]['children']))
           {
               $this->fixOrder($n_axys[$i_group]['children']);
           }
       }

       $axys = $n_axys;
   }

   function orderBy(&$axys, $ord, $col, $level, $keys)
   {
       if (-1 == $col || '' == $ord)
       {
           return;
       }

       if ($this->comp_order_level <= $level)
       {
           $n_axys = array();
           $o_axys = array();

           foreach ($axys as $i_group => $d_group)
           {
               $o_axys[$i_group] = 0;
           }

           $a_order = $this->getOrderArray($this->getCompData($level), $ord, $col, $keys, $o_axys);

           foreach ($a_order as $i_group => $v_group)
           {
               $n_axys[$i_group] = $axys[$i_group];
           }

           $axys = $n_axys;
       }

       foreach ($axys as $i_group => $d_group)
       {
           if (!empty($d_group['children']))
           {
               $n_keys = array_merge($keys, array($i_group));
               $this->orderBy($axys[$i_group]['children'], $ord, $col, $level + 1, $n_keys);
           }
       }
   }

   function getOrderArray($data, $ord, $col, $keys, $elem)
   {
       while (!empty($keys))
       {
           $key = key($keys);

           if (isset($data[ $keys[$key] ]))
           {
               $data = $data[ $keys[$key] ];
           }

           unset($keys[$key]);
       }

       foreach ($elem as $i_group => $v_group)
       {
           if (isset($data[$i_group]) && isset($data[$i_group][$col]))
           {
               $elem[$i_group] = $data[$i_group][$col];
           }
       }

       if ('a' == $ord)
       {
           asort($elem);
       }
       else
       {
           arsort($elem);
       }

       return $elem;
   }

   function addYChildrenData($axys, &$data, &$row, $level, $params, $tab_col)
   {
       foreach ($axys as $i_data)
       {
           $params_n = array_merge($params, array($i_data['value']));
           if (sizeof($this->comp_y_axys) > $level + 1)
           {
               $tab_col[$level]['label'] = $i_data['label'];
               $tab_col[$level]['group'] = $i_data['group'];
           }
           $b_subtotal = !(!$this->comp_tabular || ($this->comp_tabular && sizeof($this->comp_y_axys) == $level + 1));
           if (1)
           {
               $new_data = array();
               if ($this->comp_tabular)
               {
                   foreach ($tab_col as $i_tab_col => $a_col_data)
                   {
                       $new_data[] = array(
                           'level'  => $level,
                           'label'  => $a_col_data['label'],
                           'link'   => in_array($a_col_data['group'], $this->comp_links_gr) ? $this->getLabelLink($params, $i_tab_col, false) : '',
                       );
                   }
               }
               if (!$b_subtotal)
               {
                   $new_data[] = array(
                       'level'  => $level,
                       'group'  => $i_data['group'],
                       'value'  => $i_data['value'],
                       'label'  => $i_data['label'],
                       'params' => $params_n,
                       'link'   => in_array($i_data['group'], $this->comp_links_gr) ? $this->getLabelLink($params_n, -1, false) : '',
                   );
               }
               else
               {
                   $new_data[] = array(
                       'level'   => $level,
                       'group'   => $i_data['group'],
                       'value'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
                       'label'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
                       'params'  => $params_n,
                       'link'    => '',
                       'colspan' => sizeof($this->comp_y_axys) - sizeof($params_n),
                   );
               }
               $a_columns = 1 == sizeof($this->build_labels)
                          ? current($this->build_labels)
                          : $this->build_labels[sizeof($this->build_labels) - 1];
               if (0 < sizeof($this->comp_x_axys))
               {
                   $this->initTotalsX();
               }
               $i = 0;
               foreach ($a_columns as $a_col_data)
               {
                   if (-1 < $a_col_data['group'])
                   {
                       $val = $this->getCellValue($a_col_data['params'], $params_n);
                       $fmt = isset($a_col_data['params']) ? $a_col_data['params'][sizeof($a_col_data['params']) - 1] : 0;
                       $key = '';
                       $lnk = $this->getDataLinkParams($params_n, $a_col_data['params']);
                       if (1 == sizeof($this->comp_x_axys))
                       {
                           $key = $this->addTotalsG($i_data, $a_col_data, $params, $val);
                       }
                       unset($a_col_data['chart']);
                       if (sizeof($this->comp_y_axys) - 1 > $level)
                       {
                           $a_chart_params = $a_col_data['params'];
                           unset($a_chart_params[sizeof($a_col_data['params']) - 1]);
                           if (0 < sizeof($params_n))
                           {
                               for ($j = 0; $j < sizeof($params_n); $j++)
                               {
                                   $a_chart_params[] = $params_n[$j];
                               }
                           }
                           $a_col_data['chart'] = ($i_data['group'] + 1). '|' . $fmt . '|' . implode('|', $a_chart_params);
                       }
                       $new_data[] = array(
                           'level'     => -1,
                           'value'     => $val,
                           'format'    => $fmt,
                           'link_fld'  => $fmt + 1,
                           'link_data' => $lnk,
                           'chart'     => isset($a_col_data['chart']) ? $a_col_data['chart'] : '',
                           'css'       => isset($a_col_data['css'])   ? $a_col_data['css']   : '',
                           'subtotal'  => $b_subtotal,
                       );
                       if (0 < sizeof($this->comp_x_axys))
                       {
                           $i_col_x = array_pop($a_col_data['params']);
                           $this->addTotalsX($i_col_x, $val, $key);
                           if (0 == $level && 1 == sizeof($this->comp_x_axys))
                           {
                               $this->addTotalsA ('anal', $i_col_x, $val, $a_col_data['params'][0]);
                               $this->addTotalsAL('anal', $i_col_x, $val, $i_data['value']);
                           }
                       }
                       if (($this->comp_tabular || 0 == $level) && !$b_subtotal)
                       {
                           $this->addTotalsY($i, $val, $a_col_data['function'], $fmt);
                       }
                       $i++;
                   }
               }
               if (0 < sizeof($this->comp_x_axys))
               {
                   $this->buildTotalsX($new_data, $i, $level, $i_data['label'], $b_subtotal);
               }
               if (!$b_subtotal)
               {
                   $data[$row] = $new_data;
                   $row++;
               }
               elseif ($this->show_totals_y)
               {
                   if (!isset($this->subtotal_data[$level]))
                   {
                       $this->subtotal_data[$level] = $new_data;
                   }
                   else
                   {
                       end($this->subtotal_data);
                       $i_max = key($this->subtotal_data);
                       for ($i = $i_max; $i >= $level; $i--)
                       {
                           $data[$row] = $this->subtotal_data[$i];
                           $row++;
                           if ($i != $level)
                           {
                               unset($this->subtotal_data[$i]);
                           }
                       }
                       $this->subtotal_data[$level] = $new_data;
                   }
               }
           }
           $this->addYChildrenData($i_data['children'], $data, $row, $level + 1, $params_n, $tab_col);
       }
   }

   function getDataLinkParams($param, $col)
   {
       $a_par = array();

       if (1 < sizeof($col))
       {
           for ($i = 0; $i < sizeof($col) - 1; $i++)
           {
               $a_par[] = $col[$i];
           }
       }

       return implode('|', array_merge($a_par, $param));
   }

   function getDataLink($field, $data, $value)
   {
       if (!isset($this->comp_sum_lnk[$field]) || !$this->comp_sum_lnk[$field]['show'])
       {
           return $value;
       }

       $s_link_field = $this->comp_sum_lnk[$field]['field'];

       $a_link = array(
       );

       if (!isset($a_link[$s_link_field]))
       {
           return $value;
       }

       $a_data = explode('|', $data);
       $a_par  = array();
       $b_ok   = true;

       foreach ($a_link[$s_link_field]['param'] as $s_param => $a_param)
       {
           if ('C' == $a_param['type'])
           {
               if (!isset($a_data[ $this->comp_field_nm[ $a_param['value'] ] ]))
               {
                   $b_ok = false;
               }
               else
               {
                   $a_par[$s_param] = $a_data[ $this->comp_field_nm[ $a_param['value'] ] ];
               }
           }
           else
           {
               $a_par[$s_param] = $a_param['value'];
           }
       }

       if (!$b_ok)
       {
           return $value;
       }

       $b_modal = false;
       if (false !== strpos($a_link[$s_link_field]['html'], '__NM_FLD_PAR_M__'))
       {
           $b_modal                       = true;
           $a_link[$s_link_field]['html'] = str_replace('__NM_FLD_PAR_M__', '__NM_FLD_PAR__', $a_link[$s_link_field]['html']);
       }

       $return = str_replace('__NM_FLD_PAR__', $this->getDataLinkValue($a_par), $a_link[$s_link_field]['html']) . $value . '</a>';

       return $b_modal ? $this->getModalLink($return) :  $return;
   }

   function getDataLinkValue($param)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $i . '?#?' . $v;
       }

       return implode('?@?', $a_links);
   }

   function getModalLink($param)
   {
       return str_replace(array('?#?', '?@?'), array('*scin', '*scout'), $param);
   }

   function getLabelLink($param, $i_tmp = -1, $bProtect = true)
   {
       $a_links = array();

       if (-1 == $i_tmp)
       {
           foreach ($param as $i => $v)
           {
               $i_fld     = $i + sizeof($this->comp_x_axys);
               $a_links[] = $this->comp_links_fl[$i_fld]['name'] . '?#?' . $this->comp_links_fl[$i_fld]['prot'] . $this->getChartText($v, $bProtect) . $this->comp_links_fl[$i_fld]['prot'];
           }
       }
       else
       {
           for ($i = 0; $i <= $i_tmp; $i++)
           {
               $v         = $param[$i];
               $i_fld     = $i + sizeof($this->comp_x_axys);
               $a_links[] = $this->comp_links_fl[$i_fld]['name'] . '?#?' . $this->comp_links_fl[$i_fld]['prot'] . $this->getChartText($v, $bProtect) . $this->comp_links_fl[$i_fld]['prot'];
           }
       }

       return implode('?@?', $a_links);
   }

   function getChartLink($param, $bProtect = true)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $this->comp_links_fl[$i]['name'] . '?#?' . $this->comp_links_fl[$i]['prot'] . $this->getChartText($v, $bProtect) . $this->comp_links_fl[$i]['prot'];
       }

       return implode('?@?', $a_links);
   }

   function getCellValue($aColPar, $aRowPar)
   {
       $i_tot = array_pop($aColPar);
       $a_val = (0 == sizeof($this->comp_x_axys))
              ? array_merge($aRowPar, array($i_tot))
              : array_merge($aColPar, $aRowPar, array($i_tot));
       return $this->getCompDataCell($a_val, $this->getCompData(sizeof($aColPar) + sizeof($aRowPar) - 1));
   }

   function getCompDataCell($par, $data)
   {
       $key = key($par);
       $cur = $par[$key];
       if (is_array($data[$cur]))
       {
           unset($par[$key]);
           return $this->getCompDataCell($par, $data[$cur]);
       }
       elseif (isset($data[$cur]))
       {
           return $data[$cur];
       }
       else
       {
           return 0;
       }
   }

   function makeTabular(&$a_data)
   {
       if ($this->comp_tabular)
       {
           $a_labels = array();
           foreach ($a_data as $row => $columns)
           {
               for ($i = 0; $i < sizeof($this->comp_y_axys) - 1; $i++)
               {
                   if (!isset($a_labels[$i]))
                   {
                       $a_labels[$i] = array(
                           'old'  => $columns[$i]['label'],
                           'row'  => $row,
                           'span' => 1,
                       );
                   }
                   elseif ($a_labels[$i]['old'] == $columns[$i]['label'])
                   {
                       unset($a_data[$row][$i]);
                       $a_labels[$i]['span']++;
                   }
                   else
                   {
                       $a_data[ $a_labels[$i]['row'] ][$i]['rowspan'] = $a_labels[$i]['span'];
                       $a_labels[$i]['old']  = $columns[$i]['label'];
                       $a_labels[$i]['row']  = $row;
                       $a_labels[$i]['span'] = 1;
                   }
               }
           }
           foreach ($a_labels as $i_col => $a_col_data)
           {
               $a_data[ $a_col_data['row'] ][$i_col]['rowspan'] = $a_col_data['span'];
           }
       }
   }

   function initTotalsX()
   {
       $this->comp_totals_x = array();

       if (!$this->show_totals_x)
       {
           return;
       }

       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $this->comp_totals_x[$i_sum - 1] = array('values' => array(), 'chart' => '');
           }
       }
   }

   function addTotalsX($col, $val, $chart)
   {
       if (!$this->show_totals_x)
       {
           return;
       }

       $this->comp_totals_x[$col]['chart']    = $chart;
       $this->comp_totals_x[$col]['values'][] = $val;
   }

   function buildTotalsX(&$row, $col, $level, $label, $sub)
   {
       if (!$this->show_totals_x)
       {
           return;
       }

       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $i_temp[$i_sum - 1] = '';
           }
       }

       $key = key($this->comp_totals_x);

       for ($i = 0; $i < sizeof($this->comp_totals_x[$key]['values']); $i++)
       {
           foreach ($this->comp_sum_order as $i_sum)
           {
               if ($this->comp_sum_display[$i_sum])
               {
                   $l_sum = $this->comp_sum[$i_sum];
                   if ('' == $i_temp[$i_sum - 1])
                   {
                       $i_temp[$i_sum - 1] = $this->comp_totals_x[$i_sum - 1]['values'][$i];
                   }
                   elseif ('M' == $this->comp_sum_fn[$i_sum])
                   {
                       $i_temp[$i_sum - 1] = min($i_temp[$i_sum - 1], $this->comp_totals_x[$i_sum - 1]['values'][$i]);
                   }
                   elseif ('X' == $this->comp_sum_fn[$i_sum])
                   {
                       $i_temp[$i_sum - 1] = max($i_temp[$i_sum - 1], $this->comp_totals_x[$i_sum - 1]['values'][$i]);
                   }
                   else
                   {
                       $i_temp[$i_sum - 1] += $this->comp_totals_x[$i_sum - 1]['values'][$i];
                   }
               }
           }
       }
       foreach ($this->comp_sum as $i_sum => $l_sum)
       {
           if ('A' == $this->comp_sum_fn[$i_sum])
           {
               $i_temp[$i_sum - 1] /= sizeof($this->comp_totals_x[$i_sum - 1]['values']);
           }
           if ('P' == $this->comp_sum_fn[$i_sum])
           {
               $i_temp[$i_sum - 1] = 100.00;
           }
       }
       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $row[] = array(
                   'total'  => true,
                   'level'  => -1,
                   'value'  => $i_temp[$i_sum - 1],
                   'format' => $i_sum - 1,
                   'chart'  => $this->comp_totals_x[$i_sum - 1]['chart'],
               );
               if (0 == $level && 1 == sizeof($this->comp_x_axys))
               {
                   $this->addTotalsA('sint', $i_sum - 1, $i_temp[$i_sum - 1], $label);
               }
               if (($this->comp_tabular || 0 == $level) && !$sub)
               {
                   $this->addTotalsY($col + ($i_sum - 1), $i_temp[$i_sum - 1], $this->comp_sum_fn[$i_sum], $i_sum - 1);
               }
           }
       }
   }

   function addTotalsA($mode, $col, $val, $label)
   {
       if (!isset($this->comp_totals_a[$col]))
       {
           $this->comp_totals_a[$col] = array(
               'labels' => array(),
               'values' => array(
                   'anal' => array(),
                   'sint' => array(),
               ),
           );
       }
       if ('sint' == $mode)
       {
           $this->comp_totals_a[$col]['labels'][]         = $label;
           $this->comp_totals_a[$col]['values']['sint'][] = $val;
       }
       elseif ('anal' == $mode)
       {
           if (isset($this->comp_index[ $this->comp_x_axys[0] ][$label]))
           {
               $label = $this->comp_index[ $this->comp_x_axys[0] ][$label];
           }
           $this->comp_totals_a[$col]['values']['anal'][$label][] = $val;
       }
   }

   function addTotalsAL($mode, $col, $val, $label)
   {
       if (!isset($this->comp_totals_al[$col]))
       {
           $this->comp_totals_al[$col] = array(
               'labels' => array(),
               'values' => array(
                   'anal' => array(),
                   'sint' => array(),
               ),
           );
       }
       if ('sint' == $mode)
       {
           $this->comp_totals_al[$col]['labels'][]         = $label;
           $this->comp_totals_al[$col]['values']['sint'][] = $val;
       }
       elseif ('anal' == $mode)
       {
           if (isset($this->comp_index[ $this->comp_y_axys[0] ][$label]))
           {
               $label = $this->comp_index[ $this->comp_y_axys[0] ][$label];
           }
           $this->comp_totals_al[$col]['values']['anal'][$label][] = $val;
       }
   }

   function addTotalsY($col, $val, $fun, $fmt)
   {
       if (!$this->show_totals_y)
       {
           return;
       }

       if (!isset($this->comp_totals_y[$col]))
       {
           $this->comp_totals_y[$col] = array(
               'format'   => $fmt,
               'function' => $fun,
               'values'   => array(),
           );
       }
       $this->comp_totals_y[$col]['values'][] = $val;
   }

   function buildTotalsY(&$matrix)
   {
       if (!$this->show_totals_y)
       {
           return;
       }

       $row = sizeof($matrix);

       $matrix[$row][] = array(
           'group'   => -1,
           'value'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
           'label'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
           'params'  => array(),
           'colspan' => $this->comp_tabular ? sizeof($this->comp_y_axys) : 1,
       );

       $aTotals = array();
       foreach ($this->comp_totals_y as $cols)
       {
           $iSum           = $this->buildColumnTotal($cols['function'], $cols['values']);
           $aTotals[]      = $iSum;
           $matrix[$row][] = array(
               'total'  => true,
               'level'  => -1,
               'value'  => $iSum,
               'format' => $cols['format'],
           );
           $this->array_general_total[] = $iSum;
       }

       if (1 == sizeof($this->comp_x_axys))
       {
           $i_count = 0;
           $aLabels = array();
           foreach ($this->comp_index[0] as $group_label)
           {
               $aLabels[] = $group_label;
               foreach ($this->comp_sum as $i_sum => $l_sum)
               {
                   $this->comp_totals_al[$i_sum - 1]['values']['sint'][] = $aTotals[$i_count];
                   $i_count++;
               }
           }
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               $this->comp_totals_al[$i_sum - 1]['labels'] = $aLabels;
           }
       }
   }

   function addTotalsG($line, $column, $param, $value)
   {
       $s_item  = $column['params'][0];
       $i_total = $column['params'][1];
       $param[] = $line['value'];
       $s_key   = 'G|' . $i_total . '|' . implode('|', $param);

       if (!isset($this->comp_totals_g[$s_key]))
       {
           $this->comp_totals_g[$s_key] = array(
               'title'    => $this->getChartText($this->comp_sum[$i_total + 1]),
               'show_sub' => true,
               'subtitle' => $this->getChartText($this->getChartSubtitle($param, 1)),
               'label_x'  => $this->getChartText($this->comp_field[0]),
               'label_y'  => $this->getChartText($this->comp_sum[$i_total + 1]),
               'labels'   => array(),
               'values'   => array(
                   'sint' => array(0 => array()),
               ),
           );
       }

       $this->comp_totals_g[$s_key]['labels'][]            = isset($this->comp_index[0][$s_item]) ? $this->comp_index[0][$s_item] : $s_item;
       $this->comp_totals_g[$s_key]['values']['sint'][0][] = $value;

       return $s_key;
   }

   function buildColumnTotal($fun, $rows)
   {
       $total = '';

       foreach ($rows as $val)
       {
           if ('' == $total)
           {
               $total = $val;
           }
           elseif ('M' == $fun)
           {
               $total = min($total, $val);
           }
           elseif ('X' == $fun)
           {
               $total = max($total, $val);
           }
           else
           {
               $total += $val;
           }
       }

       if ('A' == $fun)
       {
           $total /= sizeof($rows);
       }
       if ('P' == $fun)
       {
           $total = 100.00;
       }

       return $total;
   }

   function buildChart()
   {
       $this->comp_chart_data   = array();

       $prep_chart_config = array(
           'pacientes_id_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("PAP"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_estado_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ESTADO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_fecha_activacion_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("FECHA ACTIVACION PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_fecha_retiro_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("FECHA RETIRO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_motivo_retiro_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("MOTIVO RETIRO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_observacion_motivo_retiro_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("OBSERVACION MOTIVO RETIRO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_identificacion_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("IDENTIFICACION PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_nombre_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("NOMBRE PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_apellido_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("APELLIDO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_telefono_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("TELEFONO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_telefono2_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("TELEFONO2 PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_telefono3_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("TELEFONO3 PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_correo_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("CORREO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_direccion_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("DIRECCION PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_barrio_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("BARRIO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_departamento_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("DEPARTAMENTO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_ciudad_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("CIUDAD PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_genero_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("GENERO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_fecha_nacimineto_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("FECHA NACIMINETO PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_edad_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("EDAD PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_acudiente_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ACUDIENTE PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_telefono_acudiente_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("TELEFONO ACUDIENTE PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_codigo_xofigo' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("CODIGO XOFIGO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_status_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("STATUS PACIENTE"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_id_ultima_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ID ULTIMA GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_usuario_creacion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("USUARIO CREACION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_id_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ID TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_producto_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("PRODUCTO TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_nombre_referencia' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("NOMBRE REFERENCIA"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_clasificacion_patologica_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("CLASIFICACION PATOLOGICA TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_tratamiento_previo' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("TRATAMIENTO PREVIO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_consentimiento_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("CONSENTIMIENTO TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_fecha_inicio_terapia_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("FECHA INICIO TERAPIA TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_regimen_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("REGIMEN TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_asegurador_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ASEGURADOR TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_operador_logistico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("OPERADOR LOGISTICO TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_punto_entrega' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("PUNTO ENTREGA"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_fecha_ultima_reclamacion_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("FECHA ULTIMA RECLAMACION TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_otros_operadores_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("OTROS OPERADORES TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_medios_adquisicion_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("MEDIOS ADQUISICION TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_ips_atiende_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("IPS ATIENDE TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_medico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("MEDICO TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_especialidad_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ESPECIALIDAD TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_paramedico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("PARAMEDICO TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_zona_atencion_paramedico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ZONA ATENCION PARAMEDICO TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_ciudad_base_paramedico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("CIUDAD BASE PARAMEDICO TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_notas_adjuntos_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("NOTAS ADJUNTOS TRATAMIENTO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_id_paciente_fk' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ID PACIENTE FK"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_id_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ID GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_motivo_comunicacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("MOTIVO COMUNICACION GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_medio_contacto_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("MEDIO CONTACTO GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_tipo_llamada_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("TIPO LLAMADA GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_logro_comunicacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("LOGRO COMUNICACION GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_motivo_no_comunicacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("MOTIVO NO COMUNICACION GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_numero_intentos_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("NUMERO INTENTOS GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_esperado_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ESPERADO GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_estado_ctc_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ESTADO CTC GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_estado_farmacia_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ESTADO FARMACIA GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_reclamo_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("RECLAMO GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_causa_no_reclamacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("CAUSA NO RECLAMACION GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_dificultad_acceso_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("DIFICULTAD ACCESO GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_tipo_dificultad_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("TIPO DIFICULTAD GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_envios_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ENVIOS GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_medicamentos_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("MEDICAMENTOS GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_tipo_envio_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("TIPO ENVIO GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_evento_adverso_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("EVENTO ADVERSO GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_tipo_evento_adverso' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("TIPO EVENTO ADVERSO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_genera_solicitud_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("GENERA SOLICITUD GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_fecha_proxima_llamada' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("FECHA PROXIMA LLAMADA"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_motivo_proxima_llamada' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("MOTIVO PROXIMA LLAMADA"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_observacion_proxima_llamada' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("OBSERVACION PROXIMA LLAMADA"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_fecha_reclamacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("FECHA RECLAMACION GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_consecutivo_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("CONSECUTIVO GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_autor_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("AUTOR GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_nota' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("NOTA"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_fecha_programada_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("FECHA PROGRAMADA GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_usuario_asigando' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("USUARIO ASIGANDO"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_id_paciente_fk2' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ID PACIENTE FK2"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_fecha_comunicacion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("FECHA COMUNICACION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_estado_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("ESTADO GESTION"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_codigo_argus' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("CODIGO ARGUS"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_numero_cajas' => array(
           '0' => array(
               'title'    => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText("NUMERO CAJAS"),
               'label_y'  => $this->getChartText("" .  $this->Ini->Nm_lang['lang_othr_rows'] . ""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
       );
       $prepG_chart_config = array(
           'pacientes_id_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_estado_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_fecha_activacion_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_fecha_retiro_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_motivo_retiro_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_observacion_motivo_retiro_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_identificacion_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_nombre_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_apellido_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_telefono_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_telefono2_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_telefono3_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_correo_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_direccion_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_barrio_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_departamento_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_ciudad_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_genero_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_fecha_nacimineto_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_edad_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_acudiente_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_telefono_acudiente_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_codigo_xofigo' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_status_paciente' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_id_ultima_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'pacientes_usuario_creacion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_id_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_producto_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_nombre_referencia' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_clasificacion_patologica_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_tratamiento_previo' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_consentimiento_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_fecha_inicio_terapia_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_regimen_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_asegurador_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_operador_logistico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_punto_entrega' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_fecha_ultima_reclamacion_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_otros_operadores_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_medios_adquisicion_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_ips_atiende_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_medico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_especialidad_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_paramedico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_zona_atencion_paramedico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_ciudad_base_paramedico_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_notas_adjuntos_tratamiento' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'tratamiento_id_paciente_fk' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_id_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_motivo_comunicacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_medio_contacto_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_tipo_llamada_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_logro_comunicacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_motivo_no_comunicacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_numero_intentos_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_esperado_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_estado_ctc_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_estado_farmacia_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_reclamo_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_causa_no_reclamacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_dificultad_acceso_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_tipo_dificultad_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_envios_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_medicamentos_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_tipo_envio_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_evento_adverso_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_tipo_evento_adverso' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_genera_solicitud_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_fecha_proxima_llamada' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_motivo_proxima_llamada' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_observacion_proxima_llamada' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_fecha_reclamacion_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_consecutivo_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_autor_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_nota' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_fecha_programada_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_usuario_asigando' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_id_paciente_fk2' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_fecha_comunicacion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_estado_gestion' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_codigo_argus' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
           'gestiones_numero_cajas' => array(
           '0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
           ),
       );
       $this->comp_chart_config = array(
           'T|0' => array(
               'title'    => $this->getChartText(""),
               'show_sub' => true,
               'subtitle' => "",
               'label_x'  => $this->getChartText(""),
               'label_y'  => $this->getChartText(""),
               'format'   => $this->formatChartValue(0),
           ),
       );
       $x = 0;
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          foreach ($prep_chart_config[$cmp_gb] as $i_tot => $conf_tot)
          {
              $this->comp_chart_config[$x . "|" . $i_tot] = $conf_tot;
          }
          $x++;
       }
       $x = 0;
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          foreach ($prepG_chart_config[$cmp_gb] as $i_tot => $conf_tot)
          {
              $this->comp_chart_config["G|" . $x . "|" . $i_tot] = $conf_tot;
          }
          $x++;
       }

       $aTotalGeneral = false ? $this->comp_totals_al : $this->comp_totals_a;
       if (!empty($aTotalGeneral))
       {
           foreach ($aTotalGeneral as $i_total => $a_total)
           {
               if (isset($this->comp_chart_config['T|' . $i_total]))
               {
                   if (false)
                   {
                       $sTitleAxysX  = $this->comp_field[0];
                       $sTitleLegend = '' != $this->comp_chart_config[$key]['label_x']  ? $this->comp_chart_config[$key]['label_x']  : $this->getChartText($this->comp_field[sizeof($this->comp_x_axys)]);
                   }
                   else
                   {
                       $sTitleAxysX  = '' != $this->comp_chart_config[$key]['label_x']  ? $this->comp_chart_config[$key]['label_x']  : $this->getChartText($this->comp_field[sizeof($this->comp_x_axys)]);
                       $sTitleLegend = $this->comp_field[0];
                   }
                   $key = 'T|' . $i_total;
                   $this->comp_chart_data[$key] = array(
                       'title'    => '' != $this->comp_chart_config[$key]['title']    ? $this->comp_chart_config[$key]['title']    : $this->getChartText($this->Ini->Nm_lang['lang_othr_chrt_totl']),
                       'show_sub' => $this->comp_chart_config[$key]['show_sub'],
                       'subtitle' => '' != $this->comp_chart_config[$key]['subtitle'] ? $this->comp_chart_config[$key]['subtitle'] : $this->getChartText($this->comp_sum[$i_total + 1]),
                       'legend'   => $sTitleLegend,
                       'label_x'  => $sTitleAxysX,
                       'label_y'  => '' != $this->comp_chart_config[$key]['label_y']  ? $this->comp_chart_config[$key]['label_y']  : $this->getChartText($this->comp_sum[$i_total + 1]),
                       'format'   => $this->comp_chart_config[$key]['format'],
                       'labels'   => $a_total['labels'],
                       'values'   => array(
                           'anal' => $a_total['values']['anal'],
                           'sint' => array($a_total['values']['sint']),
                       ),
                   );
               }
           }
       }

       foreach ($this->comp_y_axys as $i_group)
       {
           $this->addGroupCharts($this->comp_chart_data, $this->getCompData($i_group), $i_group, $i_group, array());
       }

       if (!empty($this->comp_totals_g))
       {
           foreach ($this->comp_totals_g as $chart => $data)
           {
               $info = explode('|', $chart);
               $key  = 'G|' . (sizeof($info) - 2) . '|' . $info[1];
               if (isset($this->comp_chart_config[$key]))
               {
                   $this->comp_chart_data[$chart]             = $data;
                   $this->comp_chart_data[$chart]['show_sub'] = $this->comp_chart_config[$key]['show_sub'];
                   if ('' != $this->comp_chart_config[$key]['title'])
                   {
                       $this->comp_chart_data[$chart]['title'] = $this->comp_chart_config[$key]['title'];
                   }
                   if ('' != $this->comp_chart_config[$key]['subtitle'])
                   {
                       $this->comp_chart_data[$chart]['subtitle'] = $this->comp_chart_config[$key]['subtitle'];
                   }
                   if ('' != $this->comp_chart_config[$key]['label_x'])
                   {
                       $this->comp_chart_data[$chart]['label_x'] = $this->comp_chart_config[$key]['label_x'];
                   }
                   if ('' != $this->comp_chart_config[$key]['label_y'])
                   {
                       $this->comp_chart_data[$chart]['label_y'] = $this->comp_chart_config[$key]['label_y'];
                   }
               }
           }
       }

       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_charts']    = $this->comp_chart_data;
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['comb_table_data'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['comb_table_def']  = array();

       require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
       $this->Graf  = new generador_de_informes_grafico();
       $this->Graf->Db     = $this->Db;
       $this->Graf->Erro   = $this->Erro;
       $this->Graf->Ini    = $this->Ini;
       $this->Graf->Lookup = $this->Lookup;
       foreach ($this->comp_chart_data as $sChartKey => $aChartData)
       {
           $this->Graf->monta_grafico($sChartKey, 'xml');
       }
   }

   function formatChartValue($total)
   {
       $arr_param = array();

       if ($total == 0)
       {
           $arr_param = array(
               'decimals'          => "0",
               'decimalSeparator'  => "",
               'thousandSeparator' => "",
               'trailingZeros'     => "0",
               'monetarySymbol'    => "",
               'monetaryPosition'  => "",
               'monetarySpace'     => "",
               'monetaryDecimal'   => "",
               'monetaryThousands' => "",
               'formatNumberScale' => "0",
           );
       }

       $aFormat   = array();
       $sFormat   = '';
       $sMonetIni = '';
       $sMonetEnd = '';

       if ('' != $arr_param['monetarySymbol'])
       {
           if ('' == $arr_param['monetaryPosition'] || 'left' == $arr_param['monetaryPosition'])
           {
               $sMonetIni = $arr_param['monetarySymbol'] . $arr_param['monetarySpace'];
               $sMonetEnd = '';
           }
           else
           {
               $sMonetIni = '';
               $sMonetEnd = $arr_param['monetarySpace'] . $arr_param['monetarySymbol'];
           }
           $arr_param['decimalSeparator']  = $arr_param['monetaryDecimal'];
           $arr_param['thousandSeparator'] = $arr_param['monetaryThousands'];
       }
       if ('' == $arr_param['decimals'])
       {
           $arr_param['decimals'] = 0;
           unset($arr_param['trailingZeros']);
       }
       else
       {
           $arr_param['forceDecimals'] = 1;
       }
       if ('' == $arr_param['trailingZeros'])
       {
           unset($arr_param['trailingZeros']);
       }
       if ('' != $sMonetIni)
       {
           $arr_param['numberPrefix'] = $sMonetIni;
       }
       if ('' != $sMonetEnd)
       {
           $arr_param['numberSuffix'] = $sMonetEnd;
       }
       unset($arr_param['monetarySymbol']);
       unset($arr_param['monetaryPosition']);
       unset($arr_param['monetarySpace']);
       unset($arr_param['monetaryDecimal']);
       unset($arr_param['monetaryThousands']);

       if (',' == $arr_param['decimalSeparator'])
       {
           unset($arr_param['decimalSeparator']);
           $arr_param['decimalSeparator'] = ',';
       }
       if (',' == $arr_param['thousandSeparator'])
       {
           unset($arr_param['thousandSeparator']);
           $arr_param['thousandSeparator'] = ',';
       }

       if (isset($arr_param['formatNumberScale']) && '1' == $arr_param['formatNumberScale'])
       {
           unset($arr_param['trailingZeros']);
           $arr_param['decimals'] = 0;
       }

       foreach ($arr_param as $i => $v)
       {
           if ('' !== $v)
           {
               $aFormat[] = $i . "=\"" . $v . "\"";
           }
       }
       if (!empty($aFormat))
       {
           $sFormat = implode(' ', $aFormat);
       }

       return $sFormat;
   }

   function addGroupCharts(&$charts, $data, $group, $level, $param)
   {
       if (0 == $level)
       {
           $a_keys   = array();
           $a_totals = array();
           $this->getKeysTotals($a_keys, $a_totals, $data, $param);
           foreach ($a_totals as $i_total => $values)
           {
               $key_data  = $key_config = $group . '|' . $i_total;
               $key_data .= '|' . implode('|', $param);
               if (isset($this->comp_chart_config[$key_config]))
               {
                   $this->comp_chart_data[$key_data]                      = $this->comp_chart_config[$key_config];
                   $this->comp_chart_data[$key_data]['param']             = $param;
                   $this->comp_chart_data[$key_data]['summ_idx']          = $i_total;
                   $this->comp_chart_data[$key_data]['summ_fn']           = $this->comp_sum_fn[$i_total + 1];
                   $this->comp_chart_data[$key_data]['labels']            = $this->getGroupLabels($group, $a_keys);
                   $this->comp_chart_data[$key_data]['db_values']         = $a_keys;
                   $this->comp_chart_data[$key_data]['label_order']       = $this->comp_order[$group];
                   $this->comp_chart_data[$key_data]['values']['sint'][0] = $values;
                   $grid_links = array();
                   $xml_links  = array();
                   foreach ($a_keys as $tmp_key)
                   {
                       $link_index   = array_merge($param, array($tmp_key));
                       $grid_links[] = $this->getChartLink($link_index, -1);
                       $xml_links[]  = 'sc_generador_de_informes_' . session_id() . '_' . implode('_', array_merge(array($group + 1, $i_total), $link_index)) . '.xml';
                   }
                   $this->comp_chart_data[$key_data]['grid_links'] = $grid_links;
                   $this->comp_chart_data[$key_data]['xml_links']  = (sizeof($this->comp_y_axys) > $group + 1) ? $xml_links : array();
                   $this->comp_chart_data[$key_data]['xml']        = 'sc_generador_de_informes_' . session_id() . '_' . implode('_', array_merge(array($group, $i_total), $param)) . '.xml';
                   if (0 < $group && !empty($param))
                   {
                       $this->comp_chart_data[$key_data]['subtitle'] = $this->getChartText($this->getChartSubtitle($param));
                   }
                   if (0 == sizeof($this->comp_x_axys) && empty($param))
                   {
                       $this->getAnaliticCharts($i_total, $this->comp_chart_data[$key_data]);
                   }
               }
           }
       }
       else
       {
           foreach ($data as $key => $list)
           {
               $this->addGroupCharts($charts, $list, $group, $level - 1, array_merge($param, array($key)));
           }
       }
   }

   function getKeysTotals(&$a_keys, &$a_totals, $data, $param)
   {
       for ($i = 0; $i < sizeof($this->comp_x_axys); $i++)
       {
           $key_param = key($param);
           unset($param[$key_param]);
       }
       $list_data = $this->comp_chart_axys;
       foreach ($param as $now_param)
       {
           $list_data = $list_data[$now_param]['children'];
       }
       $list_data = array_keys($list_data);
       $size = sizeof($this->comp_sum_dummy);
       foreach ($list_data as $k_group)
       {
           if (isset($data[$k_group])) {
               $totals = $data[$k_group];
           }
           else {
               $totals = $this->comp_sum_dummy;
           }
           $a_keys[] = $k_group;
           $count    = 0;
           foreach ($totals as $i_total => $v_total)
           {
               if ($count == $size)
               {
                   break;
               }
               $a_totals[$i_total][] = $v_total;
               $count++;
           }
       }
       if (!empty($param))
       {
           $a_indexes = $this->getRealIndexes($this->comp_chart_axys, $param);
           foreach ($a_keys as $i => $v)
           {
               if (!in_array($v, $a_indexes))
               {
                   unset($a_keys[$i]);
                   foreach ($a_totals as $t => $l)
                   {
                       unset($a_totals[$t][$i]);
                   }
               }
           }
           $a_keys = array_values($a_keys);
           foreach ($a_totals as $t => $l)
           {
               $a_totals[$t] = array_values($a_totals[$t]);
           }
       }
   }

   function getRealIndexes($data, $param)
   {
       if (empty($param))
       {
           $a_indexes = array();
           foreach ($data as $i => $v)
           {
               $a_indexes[] = $i;
           }
           return $a_indexes;
       }
       else
       {
           $key = key($param);
           $val = $param[$key];
           unset($param[$key]);
           return $this->getRealIndexes($data[$val]['children'], $param);
       }
   }

   function getGroupLabels($group, $keys)
   {
       $a_labels = array();
       foreach ($keys as $key)
       {
           $a_labels[] = isset($this->comp_index[$group][$key]) ? $this->comp_index[$group][$key] : $key;
       }
       return $a_labels;
   }

   function getChartSubtitle($param, $s = 0)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $this->comp_field[$i + $s] . ' = ' . $this->comp_index[$i + $s][$v];
       }

       return implode(' :: ', $a_links);
   }

   function getAnaliticCharts($total, &$chart_data)
   {
       $chart_data['labels_anal']           = array();
       $chart_data['legend']                = $this->comp_field[1];
       $chart_data['values']['anal']        = array();
       $chart_data['values']['anal_values'] = array();
       $chart_data['values']['anal_links']  = array();

       foreach ($this->comp_index[0] as $i_0 => $v_0)
       {
           $chart_data['labels_anal'][] = $v_0;
       }
       foreach ($this->comp_index[1] as $i_1 => $v_1)
       {
           $chart_data['values']['anal'][$v_1] = array();
           foreach ($this->comp_index[0] as $i_0 => $v_0)
           {
               $vCompData                                  = $this->getCompData(1, array($i_0, $i_1, $total));
               $chart_data['values']['anal'][$v_1][]       = isset($vCompData) ? $vCompData : 0;
               $chart_data['values']['anal_values'][$v_1]  = $i_1;
               $chart_data['values']['anal_links'][$i_1][] = $this->getChartLink(array($i_0, $i_1), -1);
           }
       }
   }

   function getChartText($s, $bProtect = true)
   {
       if (!$bProtect)
       {
           return $s;
       }
       if ('UTF-8' != $_SESSION['scriptcase']['charset'])
       {
           $s = sc_convert_encoding($s, 'UTF-8', $_SESSION['scriptcase']['charset']);
       }
       return function_exists('html_entity_decode') ? html_entity_decode($s, ENT_COMPAT | ENT_HTML401, 'UTF-8') : $s;
   }

   function drawMatrix()
   {
       global $nm_saida;

       if ($this->NM_export)
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_export']['label'] = $this->build_labels;
           $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['arr_export']['data']  = $this->build_data;
           return;
       }

       $nm_saida->saida("<tr><td class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
       $nm_saida->saida("<table class=\"scGridTabela\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");

       $this->drawMatrixLabels();

       $s_class = 'scGridFieldOdd';
       foreach ($this->build_data as $lines)
       {
           $this->prim_linha = false;
           $nm_saida->saida(" <tr>\r\n");
           foreach ($lines as $columns)
           {
               $this->NM_graf_left = $this->Graf_left_dat;
               if (0 <= $columns['level'])
               {
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida'])
                   {
                       $s_label   = '' != $columns['link'] ? "<a href=\"javascript: nm_link_cons('" . $columns['link'] . "')\" class=\"scGridBlockLink\">" . $columns['label'] . '</a>' : $columns['label'];
                   }
                   else
                   {
                       $s_label   = $columns['label'];
                   }
                   $s_style   = '';
                   $s_text    = $this->comp_tabular ? $s_label : str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $columns['level']) . $s_label;
                   $s_class_v = 'scGridBlock';
               }
               else
               {
                   $s_style = '';
                   if (isset($columns['total']) && $columns['total'])
                   {
                       $s_style   = ' style="text-align: right"';
                       $s_text    = $this->formatValue($columns['format'], $columns['value']);
                       $s_class_v = 'scGridTotal';
                       $this->NM_graf_left = $this->Graf_left_tot;
                   }
                   elseif (isset($columns['subtotal']) && $columns['subtotal'])
                   {
                       $s_text    = $this->formatValue($columns['format'], $columns['value']);
                       $s_class_v = 'scGridSubtotal';
                   }
                   else
                   {
                       $s_text    = $this->getDataLink($columns['link_fld'], $columns['link_data'], $this->formatValue($columns['format'], $columns['value']));
                       $s_class_v = $s_class;
                   }
               }
               $css     = ('' != $columns['css']) ? ' ' . $columns['css'] . '_field' : '';
               $colspan = (isset($columns['colspan']) && 1 < $columns['colspan']) ? ' colspan="' . $columns['colspan'] . '"' : '';
               $rowspan = (isset($columns['rowspan']) && 1 < $columns['rowspan']) ? ' rowspan="' . $columns['rowspan'] . '"' : '';
               $chart   = (($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida']) && isset($columns['chart']) && '' != $columns['chart'] && isset($this->comp_chart_data[ $columns['chart'] ]))
                        ? nmButtonOutput($this->arr_buttons, "bgraf", "nm_graf_submit_2('" . $columns['chart'] . "')", "nm_graf_submit_2('" . $columns['chart'] . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->comp_chart_data[ $columns['chart'] ]['label_x'] . " X " . $this->comp_chart_data[ $columns['chart'] ]['label_y'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "") : '';
               if ($this->NM_graf_left)
               {
                   $nm_saida->saida("  <td" . $s_style . " class=\"" . $s_class_v . ' ' . $s_class_v . "Font" . $css . "\"" . $colspan . "" . $rowspan . ">" . $chart . "" . $s_text . "</td>\r\n");
               }
               else
               {
                   $nm_saida->saida("  <td" . $s_style . " class=\"" . $s_class_v . ' ' . $s_class_v . "Font" . $css . "\"" . $colspan . "" . $rowspan . ">" . $s_text . "" . $chart . "</td>\r\n");
               }
           }
           $nm_saida->saida(" </tr>\r\n");
           if ('scGridFieldOdd' == $s_class)
           {
               $s_class                   = 'scGridFieldEven';
               $this->Ini->cor_link_dados = 'scGridFieldEvenLink';
           }
           else
           {
               $s_class                   = 'scGridFieldOdd';
               $this->Ini->cor_link_dados = 'scGridFieldOddLink';
           }
       }

       $nm_saida->saida("</table>\r\n");
       $nm_saida->saida("</td></tr>\r\n");
   }

   function drawMatrixLabels()
   {
       global $nm_saida;

       $this->prim_linha = true;

       $apl_cab_resumo = $this->Ini->Nm_lang['lang_othr_smry_msge'];

       $b_display = false;
       foreach ($this->build_labels as $lines)
       {
           $nm_saida->saida(" <tr class=\"scGridLabel\">\r\n");
           if (!$b_display)
           {
               $s_colspan = $this->comp_tabular ? ' colspan="' . sizeof($this->comp_y_axys) .'"' : '';
               $nm_saida->saida("  <td class=\"scGridLabelFont\" rowspan=\"" . sizeof($this->build_labels) . "\"" . $s_colspan . ">\r\n");
               if (0 < $this->comp_order_col)
               {
                   $nm_saida->saida("    <a href=\"javascript: changeSort('0', '0')\" class=\"scGridLabelLink \">\r\n");
               }
               $nm_saida->saida("   " . $apl_cab_resumo . "\r\n");
               if (0 < $this->comp_order_col)
               {
                   $nm_saida->saida("    <IMG style=\"vertical-align: middle\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc . "\" BORDER=\"0\"/>\r\n");
                   $nm_saida->saida("    </a>\r\n");
               }
               $nm_saida->saida("  </td>\r\n");
               $b_display = true;
           }
           foreach ($lines as $columns)
           {
               $this->NM_graf_left = $this->Graf_left_dat;
               if (isset($columns['group']) && $columns['group'] == -1)
               {
                   $this->NM_graf_left = $this->Graf_left_tot;
               }
               if ('C' == $columns['function'])
               {
                   $style = ' style="text-align: right"';
               }
               elseif ('' == $columns['function'] && '' != $this->comp_align[ $columns['group'] ])
               {
                   $style = ' style="text-align: ' . $this->comp_align[ $columns['group'] ] . '"';
               }
               else
               {
                   $style = '';
               }
               $css       = ('' != $columns['css']) ? ' ' . $columns['css'] . '_label' : '';
               $colspan   = (isset($columns['colspan']) && 1 < $columns['colspan']) ? ' colspan="' . $columns['colspan'] . '"' : '';
               $rowspan   = (isset($columns['rowspan']) && 1 < $columns['rowspan']) ? ' rowspan="' . $columns['rowspan'] . '"' : '';
               $col_label = $this->getColumnLabel($columns['label'], $columns['params'][0], $css);
               $col_float = $columns['label'] != $col_label ? 'float: left' : '';
               $chart   = (($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida']) && isset($columns['chart']) && '' != $columns['chart'] && isset($this->comp_chart_data[ $columns['chart'] ]))
                        ? nmButtonOutput($this->arr_buttons, "bgraf", "nm_graf_submit_2('" . $columns['chart'] . "')", "nm_graf_submit_2('" . $columns['chart'] . "')", "", "", "", "$col_float", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->comp_chart_data[ $columns['chart'] ]['label_x'] . " X " . $this->comp_chart_data[ $columns['chart'] ]['label_y'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "") : '';
               if ($this->NM_graf_left)
               {
                   $nm_saida->saida("  <td" . $style . " class=\"scGridLabelFont" . $css . "\"" . $colspan . "" . $rowspan . ">" . $chart . "" . $col_label . "</td>\r\n");
               }
               else
               {
                   $nm_saida->saida("  <td" . $style . " class=\"scGridLabelFont" . $css . "\"" . $colspan . "" . $rowspan . ">" . $col_label . "" . $chart . "</td>\r\n");
               }
           }
           $nm_saida->saida(" </tr>\r\n");
       }
   }

   function getColumnLabel($label, $col, $css="")
   {
       if (0 != sizeof($this->comp_x_axys))
       {
           return $label;
       }

       if (0 == $col)
       {
           $nome_img = $this->Ini->Label_sort;
           $sort     = 'a';
           if (isset($this->comp_order_col) && $this->comp_order_col == $col + 1)
           {
               if ($this->comp_order_sort == 'd')
               {
                   $nome_img = $this->Ini->Label_sort_desc;
                   $sort     = '';
               }
               else
               {
                   $nome_img = $this->Ini->Label_sort_asc;
                   $sort     = 'd';
               }
           }
           if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
           {
               $this->Ini->Label_sort_pos = "right_field";
           }
           if (empty($nome_img))
           {
               $link_img = nl2br($label);
           }
           elseif ($this->Ini->Label_sort_pos == "right_field")
           {
               $link_img = nl2br($label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
           }
           elseif ($this->Ini->Label_sort_pos == "left_field")
           {
               $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($label);
           }
           elseif ($this->Ini->Label_sort_pos == "right_cell")
           {
               $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($label);
           }
           elseif ($this->Ini->Label_sort_pos == "left_cell")
           {
               $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($label);
           }
           return "<a href=\"javascript: changeSort(" . ($col + 1) . ", '" . $sort . "')\" class=\"scGridLabelLink" . $css . "\">" . $link_img . '</a>';
       }

       return $label;
   }

   function formatValue($total, $valor_campo)
   {
       if ($total == 0)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "");
       }
       return $valor_campo;
   }

   //---- 
   function resumo_init()
   {
      $this->arr_buttons['group_group_1']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_img",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__gear.png",
          'style'            => "default",
      );

      $this->monta_css();
      if ($this->NM_export)
      {
          return;
      }
      if ("out" == $this->tipo)
      {
         $this->monta_html_ini();
         $this->monta_cabecalho();
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "pdf")
         {
             $this->monta_barra_top();
             $this->monta_embbed_placeholder_top();
         }
      }
      elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] == "pdf" || $this->Print_All)
      {
          $this->monta_cabecalho();
      }
   }

   function monta_css()
   {
      global $nm_saida, $nmgp_tipo_pdf, $nmgp_cor_print;
       $compl_css = "";
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida'])
       {
           include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida'])
       {
          if (($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['generador_de_informes']))
               {
                   $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['generador_de_informes']) . "_";
               } 
           } 
           else 
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['generador_de_informes']))
               {
                   $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['generador_de_informes']) . "_";
               } 
           }
       }
       $temp_css  = explode("/", $compl_css);
       if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
       $this->css_scGridPage          = $compl_css . "scGridPage";
       $this->css_scGridToolbar       = $compl_css . "scGridToolbar";
       $this->css_scGridToolbarPadd   = $compl_css . "scGridToolbarPadding";
       $this->css_css_toolbar_obj     = $compl_css . "css_toolbar_obj";
       $this->css_scGridHeader        = $compl_css . "scGridHeader";
       $this->css_scGridHeaderFont    = $compl_css . "scGridHeaderFont";
       $this->css_scGridFooter        = $compl_css . "scGridFooter";
       $this->css_scGridFooterFont    = $compl_css . "scGridFooterFont";
       $this->css_scGridTotal         = $compl_css . "scGridTotal";
       $this->css_scGridTotalFont     = $compl_css . "scGridTotalFont";
       $this->css_scGridFieldEven     = $compl_css . "scGridFieldEven";
       $this->css_scGridFieldEvenFont = $compl_css . "scGridFieldEvenFont";
       $this->css_scGridFieldEvenVert = $compl_css . "scGridFieldEvenVert";
       $this->css_scGridFieldEvenLink = $compl_css . "scGridFieldEvenLink";
       $this->css_scGridFieldOdd      = $compl_css . "scGridFieldOdd";
       $this->css_scGridFieldOddFont  = $compl_css . "scGridFieldOddFont";
       $this->css_scGridFieldOddVert  = $compl_css . "scGridFieldOddVert";
       $this->css_scGridFieldOddLink  = $compl_css . "scGridFieldOddLink";
       $this->css_scGridLabel         = $compl_css . "scGridLabel";
       $this->css_scGridLabelFont     = $compl_css . "scGridLabelFont";
       $this->css_scGridLabelLink     = $compl_css . "scGridLabelLink";
       $this->css_scGridTabela        = $compl_css . "scGridTabela";
       $this->css_scGridTabelaTd      = $compl_css . "scGridTabelaTd";
       $this->css_scAppDivMoldura     = $compl_css . "scAppDivMoldura";
       $this->css_scAppDivHeader      = $compl_css . "scAppDivHeader";
       $this->css_scAppDivHeaderText  = $compl_css . "scAppDivHeaderText";
       $this->css_scAppDivContent     = $compl_css . "scAppDivContent";
       $this->css_scAppDivContentText = $compl_css . "scAppDivContentText";
       $this->css_scAppDivToolbar     = $compl_css . "scAppDivToolbar";
       $this->css_scAppDivToolbarInput= $compl_css . "scAppDivToolbarInput";
   }

   function resumo_sem_reg()
   {
      global $nm_saida;
      $res_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
      $nm_saida->saida("  <TR> <TD class=\"scGridFieldOdd scGridFieldOddFont\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
$nm_saida->saida("     " . $res_sem_reg . "</TD> </TR>\r\n");
   }

   //---- 
   function resumo_final()
   {
      if ($this->NM_export)
      {
          return;
      }
      if ("out" == $this->tipo)
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "pdf")
         {
             $this->monta_embbed_placeholder_bot();
             $this->monta_barra_bot();
         }
      }
      if ("out" == $this->tipo)
      {
         $this->monta_html_fim();
      }
   }

   //---- 
   function inicializa_vars()
   {
      $this->Tot_ger = false;
      if ("out" == $this->tipo)
      {
         require_once($this->Ini->path_aplicacao . "generador_de_informes_total.class.php"); 
      }
      $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['print_all'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['doc_word'])
      { 
          $this->NM_raiz_img = $this->Ini->root; 
      } 
      else 
      { 
          $this->NM_raiz_img = ""; 
      } 
      if ($this->Print_All)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] = "print";
          $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_res_prt; 
      }
      else
      {
          $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_res; 
      }
      $this->total   = new generador_de_informes_total($this->Ini->sc_page);
      $this->prep_modulos("total");
      if ($this->NM_export)
      {
          return;
      }
      $this->que_linha = "impar";
      $this->css_line_back = $this->css_scGridFieldOdd;
      $this->css_line_fonf = $this->css_scGridFieldOddFont;
      $this->Ini->cor_link_dados = $this->css_scGridFieldOddLink;
   }

   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   //---- 
   function totaliza()
   {
      $this->total->resumo_sc_free_group_by("res", $this->array_total_pacientes_id_paciente, $this->array_total_pacientes_estado_paciente, $this->array_total_pacientes_fecha_activacion_paciente, $this->array_total_pacientes_fecha_retiro_paciente, $this->array_total_pacientes_motivo_retiro_paciente, $this->array_total_pacientes_observacion_motivo_retiro_paciente, $this->array_total_pacientes_identificacion_paciente, $this->array_total_pacientes_nombre_paciente, $this->array_total_pacientes_apellido_paciente, $this->array_total_pacientes_telefono_paciente, $this->array_total_pacientes_telefono2_paciente, $this->array_total_pacientes_telefono3_paciente, $this->array_total_pacientes_correo_paciente, $this->array_total_pacientes_direccion_paciente, $this->array_total_pacientes_barrio_paciente, $this->array_total_pacientes_departamento_paciente, $this->array_total_pacientes_ciudad_paciente, $this->array_total_pacientes_genero_paciente, $this->array_total_pacientes_fecha_nacimineto_paciente, $this->array_total_pacientes_edad_paciente, $this->array_total_pacientes_acudiente_paciente, $this->array_total_pacientes_telefono_acudiente_paciente, $this->array_total_pacientes_codigo_xofigo, $this->array_total_pacientes_status_paciente, $this->array_total_pacientes_id_ultima_gestion, $this->array_total_pacientes_usuario_creacion, $this->array_total_tratamiento_id_tratamiento, $this->array_total_tratamiento_producto_tratamiento, $this->array_total_tratamiento_nombre_referencia, $this->array_total_tratamiento_clasificacion_patologica_tratamiento, $this->array_total_tratamiento_tratamiento_previo, $this->array_total_tratamiento_consentimiento_tratamiento, $this->array_total_tratamiento_fecha_inicio_terapia_tratamiento, $this->array_total_tratamiento_regimen_tratamiento, $this->array_total_tratamiento_asegurador_tratamiento, $this->array_total_tratamiento_operador_logistico_tratamiento, $this->array_total_tratamiento_punto_entrega, $this->array_total_tratamiento_fecha_ultima_reclamacion_tratamiento, $this->array_total_tratamiento_otros_operadores_tratamiento, $this->array_total_tratamiento_medios_adquisicion_tratamiento, $this->array_total_tratamiento_ips_atiende_tratamiento, $this->array_total_tratamiento_medico_tratamiento, $this->array_total_tratamiento_especialidad_tratamiento, $this->array_total_tratamiento_paramedico_tratamiento, $this->array_total_tratamiento_zona_atencion_paramedico_tratamiento, $this->array_total_tratamiento_ciudad_base_paramedico_tratamiento, $this->array_total_tratamiento_notas_adjuntos_tratamiento, $this->array_total_tratamiento_id_paciente_fk, $this->array_total_gestiones_id_gestion, $this->array_total_gestiones_motivo_comunicacion_gestion, $this->array_total_gestiones_medio_contacto_gestion, $this->array_total_gestiones_tipo_llamada_gestion, $this->array_total_gestiones_logro_comunicacion_gestion, $this->array_total_gestiones_motivo_no_comunicacion_gestion, $this->array_total_gestiones_numero_intentos_gestion, $this->array_total_gestiones_esperado_gestion, $this->array_total_gestiones_estado_ctc_gestion, $this->array_total_gestiones_estado_farmacia_gestion, $this->array_total_gestiones_reclamo_gestion, $this->array_total_gestiones_causa_no_reclamacion_gestion, $this->array_total_gestiones_dificultad_acceso_gestion, $this->array_total_gestiones_tipo_dificultad_gestion, $this->array_total_gestiones_envios_gestion, $this->array_total_gestiones_medicamentos_gestion, $this->array_total_gestiones_tipo_envio_gestion, $this->array_total_gestiones_evento_adverso_gestion, $this->array_total_gestiones_tipo_evento_adverso, $this->array_total_gestiones_genera_solicitud_gestion, $this->array_total_gestiones_fecha_proxima_llamada, $this->array_total_gestiones_motivo_proxima_llamada, $this->array_total_gestiones_observacion_proxima_llamada, $this->array_total_gestiones_fecha_reclamacion_gestion, $this->array_total_gestiones_consecutivo_gestion, $this->array_total_gestiones_autor_gestion, $this->array_total_gestiones_nota, $this->array_total_gestiones_fecha_programada_gestion, $this->array_total_gestiones_usuario_asigando, $this->array_total_gestiones_id_paciente_fk2, $this->array_total_gestiones_fecha_comunicacion, $this->array_total_gestiones_estado_gestion, $this->array_total_gestiones_codigo_argus, $this->array_total_gestiones_numero_cajas);
      ksort($this->array_total_pacientes_id_paciente);
      ksort($this->array_total_pacientes_estado_paciente);
      ksort($this->array_total_pacientes_fecha_activacion_paciente);
      ksort($this->array_total_pacientes_fecha_retiro_paciente);
      ksort($this->array_total_pacientes_motivo_retiro_paciente);
      ksort($this->array_total_pacientes_observacion_motivo_retiro_paciente);
      ksort($this->array_total_pacientes_identificacion_paciente);
      ksort($this->array_total_pacientes_nombre_paciente);
      ksort($this->array_total_pacientes_apellido_paciente);
      ksort($this->array_total_pacientes_telefono_paciente);
      ksort($this->array_total_pacientes_telefono2_paciente);
      ksort($this->array_total_pacientes_telefono3_paciente);
      ksort($this->array_total_pacientes_correo_paciente);
      ksort($this->array_total_pacientes_direccion_paciente);
      ksort($this->array_total_pacientes_barrio_paciente);
      ksort($this->array_total_pacientes_departamento_paciente);
      ksort($this->array_total_pacientes_ciudad_paciente);
      ksort($this->array_total_pacientes_genero_paciente);
      ksort($this->array_total_pacientes_fecha_nacimineto_paciente);
      ksort($this->array_total_pacientes_edad_paciente);
      ksort($this->array_total_pacientes_acudiente_paciente);
      ksort($this->array_total_pacientes_telefono_acudiente_paciente);
      ksort($this->array_total_pacientes_codigo_xofigo);
      ksort($this->array_total_pacientes_status_paciente);
      ksort($this->array_total_pacientes_id_ultima_gestion);
      ksort($this->array_total_pacientes_usuario_creacion);
      ksort($this->array_total_tratamiento_id_tratamiento);
      ksort($this->array_total_tratamiento_producto_tratamiento);
      ksort($this->array_total_tratamiento_nombre_referencia);
      ksort($this->array_total_tratamiento_clasificacion_patologica_tratamiento);
      ksort($this->array_total_tratamiento_tratamiento_previo);
      ksort($this->array_total_tratamiento_consentimiento_tratamiento);
      ksort($this->array_total_tratamiento_fecha_inicio_terapia_tratamiento);
      ksort($this->array_total_tratamiento_regimen_tratamiento);
      ksort($this->array_total_tratamiento_asegurador_tratamiento);
      ksort($this->array_total_tratamiento_operador_logistico_tratamiento);
      ksort($this->array_total_tratamiento_punto_entrega);
      ksort($this->array_total_tratamiento_fecha_ultima_reclamacion_tratamiento);
      ksort($this->array_total_tratamiento_otros_operadores_tratamiento);
      ksort($this->array_total_tratamiento_medios_adquisicion_tratamiento);
      ksort($this->array_total_tratamiento_ips_atiende_tratamiento);
      ksort($this->array_total_tratamiento_medico_tratamiento);
      ksort($this->array_total_tratamiento_especialidad_tratamiento);
      ksort($this->array_total_tratamiento_paramedico_tratamiento);
      ksort($this->array_total_tratamiento_zona_atencion_paramedico_tratamiento);
      ksort($this->array_total_tratamiento_ciudad_base_paramedico_tratamiento);
      ksort($this->array_total_tratamiento_notas_adjuntos_tratamiento);
      ksort($this->array_total_tratamiento_id_paciente_fk);
      ksort($this->array_total_gestiones_id_gestion);
      ksort($this->array_total_gestiones_motivo_comunicacion_gestion);
      ksort($this->array_total_gestiones_medio_contacto_gestion);
      ksort($this->array_total_gestiones_tipo_llamada_gestion);
      ksort($this->array_total_gestiones_logro_comunicacion_gestion);
      ksort($this->array_total_gestiones_motivo_no_comunicacion_gestion);
      ksort($this->array_total_gestiones_numero_intentos_gestion);
      ksort($this->array_total_gestiones_esperado_gestion);
      ksort($this->array_total_gestiones_estado_ctc_gestion);
      ksort($this->array_total_gestiones_estado_farmacia_gestion);
      ksort($this->array_total_gestiones_reclamo_gestion);
      ksort($this->array_total_gestiones_causa_no_reclamacion_gestion);
      ksort($this->array_total_gestiones_dificultad_acceso_gestion);
      ksort($this->array_total_gestiones_tipo_dificultad_gestion);
      ksort($this->array_total_gestiones_envios_gestion);
      ksort($this->array_total_gestiones_medicamentos_gestion);
      ksort($this->array_total_gestiones_tipo_envio_gestion);
      ksort($this->array_total_gestiones_evento_adverso_gestion);
      ksort($this->array_total_gestiones_tipo_evento_adverso);
      ksort($this->array_total_gestiones_genera_solicitud_gestion);
      ksort($this->array_total_gestiones_fecha_proxima_llamada);
      ksort($this->array_total_gestiones_motivo_proxima_llamada);
      ksort($this->array_total_gestiones_observacion_proxima_llamada);
      ksort($this->array_total_gestiones_fecha_reclamacion_gestion);
      ksort($this->array_total_gestiones_consecutivo_gestion);
      ksort($this->array_total_gestiones_autor_gestion);
      ksort($this->array_total_gestiones_nota);
      ksort($this->array_total_gestiones_fecha_programada_gestion);
      ksort($this->array_total_gestiones_usuario_asigando);
      ksort($this->array_total_gestiones_id_paciente_fk2);
      ksort($this->array_total_gestiones_fecha_comunicacion);
      ksort($this->array_total_gestiones_estado_gestion);
      ksort($this->array_total_gestiones_codigo_argus);
      ksort($this->array_total_gestiones_numero_cajas);
      if ("out" == $this->tipo)
      {
         $this->total->quebra_geral();
      }
   }

   //----- 
   function monta_html_ini($first_table = true)
   {
      global $nm_saida, $nmgp_tipo_pdf, $nmgp_cor_print;

      if ($first_table)
      {

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida'])
      { 
          $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\">\r\n");
          return;
      } 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['doc_word'])
{
       $nm_saida->saida("<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:word\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
}
$nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
$nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
      $nm_saida->saida("<HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
      $nm_saida->saida("<HEAD>\r\n");
      $nm_saida->saida(" <TITLE>Generador de Informes</TITLE>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['doc_word'])
{
      $nm_saida->saida(" <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
}
       $css_body = "";
      $nm_saida->saida(" <style type=\"text/css\">\r\n");
      $nm_saida->saida("  BODY { " . $css_body . " }\r\n");
      $nm_saida->saida(" </style>\r\n");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['doc_word'])
      { 
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"generador_de_informes_ajax.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\">var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';</script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
          $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid.css\"  type=\"text/css\"/> \r\n");
          $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"  type=\"text/css\"/> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['num_css']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['num_css'] = rand(0, 1000);
      }
      $NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_generador_de_informes_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['num_css'] . '.css', 'w');
      if (($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
      {
          $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
          $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      }
      else
      {
          $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
          $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      }
      if (is_file($this->Ini->path_css . $NM_css_file))
      {
          $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
          foreach ($NM_css_attr as $NM_line_css)
          {
              $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
              @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
          }
      }
      if (is_file($this->Ini->path_css . $NM_css_dir))
      {
          $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
          foreach ($NM_css_attr as $NM_line_css)
          {
              $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
              @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
          }
      }
      @fclose($NM_css);
     $this->Ini->summary_css = $this->Ini->path_imag_temp . '/sc_css_generador_de_informes_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['num_css'] . '.css';
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] == "print")
     {
         $nm_saida->saida("  <style type=\"text/css\">\r\n");
         $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_generador_de_informes_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['num_css'] . '.css');
         foreach ($NM_css as $cada_css)
         {
              $nm_saida->saida("  " . str_replace("rn", "", $cada_css) . "\r\n");
         }
         $nm_saida->saida("  </style>\r\n");
     }
     else
     {
         $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->summary_css . "\" type=\"text/css\" media=\"screen\" />\r\n");
     }
      $nm_saida->saida(" <style type=\"text/css\">\r\n");
       $nm_saida->saida(" .scGridTabela TD { white-space: nowrap }\r\n");
      $nm_saida->saida(" </style>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           $nm_saida->saida("   $(function(){ \r\n");
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
$nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "generador_de_informes/generador_de_informes_res_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     function scBtnGroupByShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).success(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnGroupByHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSaveGridShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).success(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_save_grid_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_save_grid_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSaveGridHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSelCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).success(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSelCamposHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnOrderCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).success(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnOrderCamposHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   </script>\r\n");

if ($_SESSION['scriptcase']['proc_mobile'])
{
       $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n");
}

      $nm_saida->saida("</HEAD>\r\n");
      $nm_saida->saida(" <BODY class=\"" . $this->css_scGridPage . "\">\r\n");
      $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] == "pdf")
      { 
              $nm_saida->saida("  <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_othr_smry_msge'] . "</H1></div>\r\n");
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['doc_word'])
      { 
          $nm_saida->saida("      <STYLE>\r\n");
          $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow}\r\n");
          $nm_saida->saida("      </STYLE>\r\n");
          $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px\"></div>\r\n");
      } 

      }

       $chart_height = '';
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
           $summary_width = "width=\"100%\"";
       }
       else
       {
           $summary_width = "width=\"\"";
       }
      $nm_saida->saida("<TABLE id=\"main_table_res\" cellspacing=0 cellpadding=0 align=\"left\" valign=\"top\" " . $summary_width . $chart_height . ">\r\n");
      $nm_saida->saida(" <TR>\r\n");
      $nm_saida->saida("  <TD" . $chart_height . ">\r\n");
      $nm_saida->saida("  <div class=\"scGridBorder\"" . $chart_height . ">\r\n");
      $nm_saida->saida("  <table width='100%' cellspacing=0 cellpadding=0" . $chart_height . ">\r\n");
      $nm_saida->saida("<TR>\r\n");
      $nm_saida->saida("<TD style=\"padding: 0px\">\r\n");
      $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; border-collapse: collapse\" width=\"100%\">\r\n");
   }

   //-----  top
   function monta_barra_top()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_top\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
         $nm_saida->saida("    <TR>\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
      if (!$this->grid_emb_form && $this->nmgp_botoes['group_1'] == "on")
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn = true;
          $nm_saida->saida("           <table style=\"border-collapse: collapse; border-width: 0; display: none; position: absolute; z-index: 1000\" id=\"sc_btgp_div_group_1_top\">\r\n");
              $nm_saida->saida("           <tr><td class=\"scBtnGrpBackground\">\r\n");
      if (!$this->grid_emb_form && $this->nmgp_botoes['pdf'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "Rpdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "generador_de_informes/generador_de_informes_config_pdf.php?nm_opc=pdf_res&nm_target=0&nm_cor=cor&papel=1&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=S&language=es&conf_socor=S&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if (!$this->grid_emb_form && $this->nmgp_botoes['word'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bword", "", "", "Rrtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "generador_de_informes/generador_de_informes_config_word.php?nm_cor=AM&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['xls'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls_res', '0')", "nm_gp_move('xls_res', '0')", "Rxls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if (!$this->grid_emb_form && $this->nmgp_botoes['xml'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bxml", "nm_gp_move('xml_res', '0')", "nm_gp_move('xml_res', '0')", "Rxml_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['csv'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcsv", "nm_gp_move('csv_res', '0')", "nm_gp_move('csv_res', '0')", "Rcsv_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
      if (!$this->grid_emb_form && $this->nmgp_botoes['rtf'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "brtf", "nm_gp_move('rtf_res', '0')", "nm_gp_move('rtf_res', '0')", "Rrtf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "group_1", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
              $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
      if (!$this->grid_emb_form && $this->nmgp_botoes['print'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "Rprint_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "generador_de_informes/generador_de_informes_config_print.php?nm_opc=resumo&nm_cor=AM&language=es&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "");
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
      if (!$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bconf_graf", "", "", "Rgraf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "generador_de_informes/generador_de_informes_config_graf_flash.php?nome_apl=generador_de_informes&campo_apl=nm_resumo_graf&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=es&tp_apl=cns_htm&KeepThis=true&TB_iframe=true&height=450&width=400&modal=true", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
      if (!$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "smry_conf", "summaryConfig()", "summaryConfig()", "Rconfig_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opc_psq'] && !$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
          $Q_free  = false;
          $Q_count = 0;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_All_Groupby'] as $QB => $Tp)
          {
              if (!in_array($QB, $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Groupby_hide']) && $Tp == "all")
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
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bgroupby", "scBtnGroupByShow('" . $this->Ini->path_link . "generador_de_informes/generador_de_informes_sel_groupby.php?opc_ret=resumo&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnGroupByShow('" . $this->Ini->path_link . "generador_de_informes/generador_de_informes_sel_groupby.php?opc_ret=resumo&path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "sel_groupby_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
      }
      if (!$this->grid_emb_form && !$this->NM_res_sem_reg)
      {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "blink_resumogrid", "nm_gp_move('inicio', '0')", "nm_gp_move('inicio', '0')", "Rrotac_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
         if (is_file("generador_de_informes_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("generador_de_informes_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "Rhelp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
      if (!$this->grid_emb_form)
      {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('igual', '0')", "nm_gp_move('igual', '0')", "Rsai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\">\r\n");
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\">\r\n");
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   function monta_embbed_placeholder_top()
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
   //-----  bot
   function monta_barra_bot()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_bot\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
         $nm_saida->saida("    <TR>\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\">\r\n");
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\">\r\n");
         if (is_file("generador_de_informes_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("generador_de_informes_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "Rhelp_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   function monta_embbed_placeholder_bot()
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
   //----- 
   function monta_html_fim()
   {
      global $nm_saida;
      $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
      $nm_saida->saida("</TABLE>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida'])
      { 
          return;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['doc_word'])
      { 
      $nm_saida->saida("</BODY>\r\n");
      $nm_saida->saida("</HTML>\r\n");
          return;
      } 
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['doc_word'])
{ 
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("</TD>\r\n");
      $nm_saida->saida("</TR>\r\n");
      $nm_saida->saida("</TABLE>\r\n");
       $nm_saida->saida("<script type=\"text/javascript\">\r\n");
       $nm_saida->saida("function summaryConfig() {\r\n");
       $nm_saida->saida("  tb_show('', 'generador_de_informes_config_pivot.php?nome_apl=generador_de_informes&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=es&TB_iframe=true&modal=true&height=300&width=500', '');\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function changeSort(col, ord) {\r\n");
       $nm_saida->saida("  document.refresh_config.change_sort.value = 'Y';\r\n");
       $nm_saida->saida("  document.refresh_config.sort_col.value = col;\r\n");
       $nm_saida->saida("  document.refresh_config.sort_ord.value = ord;\r\n");
       $nm_saida->saida("  document.refresh_config.submit();\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("</script>\r\n");
       $nm_saida->saida("<form name=\"refresh_config\" method=\"post\" action=\"./\" style=\"display: none\">\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"nmgp_opcao\" value=\"resumo\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"change_sort\" value=\"N\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"sort_col\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"sort_ord\" />\r\n");
       $nm_saida->saida("</form>\r\n");
}
      $nm_saida->saida("<FORM name=\"F3\" method=\"post\" action=\"./\"\r\n");
      $nm_saida->saida("                                  target = \"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_chave\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_opcao\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_ordem\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_chave_det\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_quant_linhas\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_url_saida\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_parms\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_outra_jan\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_orig_pesq\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
      $nm_saida->saida("</FORM>\r\n");
      $nm_saida->saida("<form name=\"FRES\" method=\"post\" \r\n");
      $nm_saida->saida("                    action=\"\" \r\n");
      $nm_saida->saida("                    target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
      $nm_saida->saida("</form> \r\n");
      $nm_saida->saida("<form name=\"FCONS\" method=\"post\" \r\n");
      $nm_saida->saida("                    action=\"./\" \r\n");
      $nm_saida->saida("                    target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_opcao\" value=\"link_res\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_parms_where\" value=\"\" />\r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
      $nm_saida->saida("</form> \r\n");
      $nm_saida->saida("<form name=\"Fgraf\" method=\"post\" \r\n");
      $nm_saida->saida("                   action=\"./\" \r\n");
      $nm_saida->saida("                   target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_opcao\" value=\"grafico\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"campo\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nivel_quebra\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"campo_val\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_parms\" value=\"\" />\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"summary_css\" value=\"" . NM_encode_input($this->Ini->summary_css) . "\"/> \r\n");
      $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("<form name=\"Fdoc_word\" method=\"post\" \r\n");
   $nm_saida->saida("      action=\"./\" \r\n");
   $nm_saida->saida("      target=\"_self\"> \r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_opcao\" value=\"doc_word_res\"/> \r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_cor_word\" value=\"AM\"/> \r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_navegator_print\" value=\"\"/> \r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"> \r\n");
   $nm_saida->saida("</form> \r\n");
      $nm_saida->saida("<SCRIPT language=\"Javascript\">\r\n");
   $nm_saida->saida(" function nm_gp_word_conf(cor)\r\n");
   $nm_saida->saida(" {\r\n");
   $nm_saida->saida("     document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("     document.Fdoc_word.submit();\r\n");
   $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_link_cons(x) \r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     document.FCONS.nmgp_parms_where.value = x;\r\n");
      $nm_saida->saida("     document.FCONS.submit();\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida("   function nm_gp_print_conf(tp, cor)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       window.open('" . $this->Ini->path_link . "generador_de_informes/generador_de_informes_iframe_prt.php?path_botoes=" . $this->Ini->path_botoes . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&opcao=res_print&cor_print=' + cor,'','location=no,menubar,resizable,scrollbars,status=no,toolbar');\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida(" function nm_gp_move(x, y, z, p, g) \r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("  document.F3.nmgp_opcao.value = x;\r\n");
      $nm_saida->saida("  document.F3.target = \"_self\"; \r\n");
      $nm_saida->saida("  if (y == 1) \r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.target = \"_blank\"; \r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (\"busca\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.nmgp_orig_pesq.value = z; \r\n");
      $nm_saida->saida("      z = '';\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (z != null && z != '') \r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("     document.F3.nmgp_tipo_pdf.value = z;\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  document.F3.script_case_init.value = \"" . NM_encode_input($this->Ini->sc_page) . "\" ;\r\n");
      $nm_saida->saida("  if (\"xls_res\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      if (!extension_loaded("zip"))
      {
      $nm_saida->saida("      alert (\"" . html_entity_decode($this->Ini->Nm_lang['lang_othr_prod_xtzp'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\");\r\n");
      $nm_saida->saida("      return false;\r\n");
      } 
      $nm_saida->saida("  }\r\n");
      $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['generador_de_informes_iframe_params'] = array(
          'str_tmp'    => $this->Ini->path_imag_temp,
          'str_prod'   => $this->Ini->path_prod,
          'str_btn'    => $this->Ini->Str_btn_css,
          'str_lang'   => $this->Ini->str_lang,
          'str_schema' => $this->Ini->str_schema_all,
      );
      $nm_saida->saida("  if (\"pdf_res\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
   $nm_saida->saida("      window.location = \"" . $this->Ini->path_link . "generador_de_informes/generador_de_informes_iframe.php?nmgp_opcao=pdf_res&scsess=" . session_id() . "&str_tmp=" . $this->Ini->path_imag_temp . "&str_prod=" . $this->Ini->path_prod . "&str_btn=" . $this->Ini->Str_btn_css . "&str_lang=" . $this->Ini->str_lang . "&str_schema=" . $this->Ini->str_schema_all . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&pbfile=" . urlencode($str_pbfile) . "&jspath=" . urlencode($this->Ini->path_js) . "&sc_apbgcol=" . urlencode($this->Ini->path_css) . "&sc_tp_pdf=\" + z + \"&sc_parms_pdf=\" + p + \"&sc_graf_pdf=\" + g;\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  else\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.submit();\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        if (target == '_blank') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            window.open (apl_lig);\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        else\r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            window.location = apl_lig;\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        return;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    if (target == 'modal') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        par_modal = '?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal';\r\n");
      $nm_saida->saida("        if (opc != null && opc != '') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            par_modal += '&nmgp_opcao=grid';\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        if (parms != null && parms != '') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            par_modal += '&nmgp_parms=' + parms;\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
      $nm_saida->saida("        return;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.target               = target; \r\n");
      $nm_saida->saida("    if (target == '_blank') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.action               = apl_lig  ;\r\n");
      $nm_saida->saida("    if (opc != null && opc != '') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    else\r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_opcao.value = \"\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
      $nm_saida->saida("    document.F3.nmgp_parms.value = parms ;\r\n");
      $nm_saida->saida("    document.F3.submit() ;\r\n");
      $nm_saida->saida("    document.F3.nmgp_outra_jan.value = \"\";\r\n");
      $nm_saida->saida("    document.F3.nmgp_parms.value = \"\";\r\n");
      $nm_saida->saida("    document.F3.action = \"./\";\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida("   var tem_hint;\r\n");
      $nm_saida->saida("   function nm_mostra_hint(nm_obj, nm_evt, nm_mens)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (nm_mens == \"\")\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           return;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       tem_hint = true;\r\n");
      $nm_saida->saida("       if (document.layers)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           theString=\"<DIV CLASS='ttip'>\" + nm_mens + \"</DIV>\";\r\n");
      $nm_saida->saida("           document.tooltip.document.write(theString);\r\n");
      $nm_saida->saida("           document.tooltip.document.close();\r\n");
      $nm_saida->saida("           document.tooltip.left = nm_evt.pageX + 14;\r\n");
      $nm_saida->saida("           document.tooltip.top = nm_evt.pageY + 2;\r\n");
      $nm_saida->saida("           document.tooltip.visibility = \"show\";\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           if(document.getElementById)\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("              nmdg_nav = navigator.appName;\r\n");
      $nm_saida->saida("              elm = document.getElementById(\"tooltip\");\r\n");
      $nm_saida->saida("              elml = nm_obj;\r\n");
      $nm_saida->saida("              elm.innerHTML = nm_mens;\r\n");
      $nm_saida->saida("              if (nmdg_nav == \"Netscape\")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  elm.style.height = elml.style.height;\r\n");
      $nm_saida->saida("                  elm.style.top = nm_evt.pageY + 2;\r\n");
      $nm_saida->saida("                  elm.style.left = nm_evt.pageX + 14;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              else\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  elm.style.top = nm_evt.y + document.body.scrollTop + 10;\r\n");
      $nm_saida->saida("                  elm.style.left = nm_evt.x + document.body.scrollLeft + 10;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              elm.style.visibility = \"visible\";\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_apaga_hint()\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (!tem_hint)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           return;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       tem_hint = false;\r\n");
      $nm_saida->saida("       if (document.layers)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.tooltip.visibility = \"hidden\";\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           if(document.getElementById)\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("              elm.style.visibility = \"hidden\";\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida(" function nm_graf_submit(campo, nivel, campo_val, parms, target) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    document.Fgraf.campo.value = campo ;\r\n");
      $nm_saida->saida("    document.Fgraf.nivel_quebra.value = nivel ;\r\n");
      $nm_saida->saida("    document.Fgraf.campo_val.value = campo_val ;\r\n");
      $nm_saida->saida("    document.Fgraf.nmgp_parms.value   = parms ;\r\n");
      $nm_saida->saida("    if (target != null) \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.Fgraf.target = target; \r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.Fgraf.submit() ;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function nm_graf_submit_2(chart)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("    var oldAction = document.Fgraf.action;\r\n");
      $nm_saida->saida("    document.Fgraf.action = nm_url_rand(document.Fgraf.action);\r\n");
      $nm_saida->saida("    document.Fgraf.nmgp_parms.value = chart;\r\n");
      $nm_saida->saida("    document.Fgraf.target = \"_blank\";\r\n");
      $nm_saida->saida("    document.Fgraf.submit();\r\n");
      $nm_saida->saida("    document.Fgraf.action = oldAction;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function nm_open_popup(parms)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_url_rand(v_str_url)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("  str_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';\r\n");
      $nm_saida->saida("  str_rand  = v_str_url;\r\n");
      $nm_saida->saida("  str_rand += (-1 == v_str_url.indexOf('?')) ? '?' : '&';\r\n");
      $nm_saida->saida("  str_rand += 'r=';\r\n");
      $nm_saida->saida("  for (i = 0; i < 8; i++)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("   str_rand += str_chars.charAt(Math.round(str_chars.length * Math.random()));\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  return str_rand;\r\n");
      $nm_saida->saida(" }\r\n");
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp']))
      {
        $nm_saida->saida("     $(document).ready(function(){\r\n");
          $nm_saida->saida("     document.getElementById('sel_groupby_top').click();\r\n");
        $nm_saida->saida("     });\r\n");
      }
      $nm_saida->saida("</SCRIPT>\r\n");
      $nm_saida->saida("</BODY>\r\n");
      $nm_saida->saida("</HTML>\r\n");
   }

   function monta_html_ini_pdf()
   {
      global $nm_saida;
       $tp_quebra = "";
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['num_css']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['num_css']))
       {
           $NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_generador_de_informes_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['num_css'] . '.css', 'a');
           $NM_css_file = $this->Ini->root . $this->Ini->path_link . "generador_de_informes/generador_de_informes_res_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']). ".css";
           if (is_file($NM_css_file))
           {
               $NM_css_attr = file($NM_css_file);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   @fwrite($NM_css, "    " . $NM_line_css . "\r\n");
               }
           }
           @fclose($NM_css);
       }
       $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['print_all'];
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pdf_res'])
       {
           $nm_saida->saida("<TR>\r\n");
           $nm_saida->saida("<TD style=\"padding: 0px\">\r\n");
           $tp_quebra = "<table><tr><td style=\"border-width:0;height:1px;padding:0\"><span style=\"display: none;\">&nbsp;</span><div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></td></tr></table>";
           $tp_quebra .= "<div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" .$this->Ini->Nm_lang['lang_othr_smry_msge'] . "</H1></div>";
       }
       if ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['print_all'])
       {
           $tp_quebra = "<table><tr><td style=\"border-width:0;height:1px;padding:0\"><span style=\"display: none;\">&nbsp;</span><div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></td></tr></table>";
       }
       $nm_saida->saida("" . $tp_quebra . "\r\n");
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
           $summary_width = "width=\"100%\"";
       }
       else
       {
           $summary_width = "width=\"100%\"";
       }
       $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" align=\"left\" valign=\"top\" " . $summary_width . ">\r\n");
       $nm_saida->saida("<TR>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px\">\r\n");
       $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\">\r\n");
   }
   function monta_html_fim_pdf()
   {
      global $nm_saida;
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("</TD>\r\n");
      $nm_saida->saida("</TR>\r\n");
      $nm_saida->saida("</TABLE>\r\n");
   }
//--- 
//--- 
 function grafico_pdf()
 {
   global $nm_saida, $nm_lang;
   require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
   $this->Graf  = new generador_de_informes_grafico();
   $this->Graf->Db     = $this->Db;
   $this->Graf->Erro   = $this->Erro;
   $this->Graf->Ini    = $this->Ini;
   $this->Graf->Lookup = $this->Lookup;
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_charts']))
   {
       $this->Graf->monta_grafico('', 'pdf_lib');
       $nm_saida->saida("<B><div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_btns_chrt_pdff_hint'] . "</H1></div></B>\r\n");
       $iChartCount = 1;
       $iChartTotal = sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_charts']);
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
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['pivot_charts'] as $chart_index => $chart_data)
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['charts_html']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['charts_html'])
       {
            $nm_saida->saida("<script type=\"text/javascript\">\r\n");
            $nm_saida->saida("{$_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['charts_html']}\r\n");
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
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['chart_list']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['chart_list'] as $arr_chart)
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
   //----- 
   function monta_cabecalho()
   {
      global $nm_saida;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['embutida'])
      { 
          return;
      } 
      $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
      $nm_cab_filtro   = ""; 
      $nm_cab_filtrobr = ""; 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca']))
      { 
        $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca'];
        if ($_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
          $pacientes_fecha_activacion_paciente = $Busca_temp['pacientes_fecha_activacion_paciente']; 
          $tmp_pos = strpos($pacientes_fecha_activacion_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $pacientes_fecha_activacion_paciente = substr($pacientes_fecha_activacion_paciente, 0, $tmp_pos);
          }
          $gestiones_fecha_comunicacion = $Busca_temp['gestiones_fecha_comunicacion']; 
          $tmp_pos = strpos($gestiones_fecha_comunicacion, "##@@");
          if ($tmp_pos !== false)
          {
              $gestiones_fecha_comunicacion = substr($gestiones_fecha_comunicacion, 0, $tmp_pos);
          }
          $gestiones_fecha_comunicacion_2 = $Busca_temp['gestiones_fecha_comunicacion_input_2']; 
      } 
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['cond_pesq']))
      {  
          $pos       = 0;
          $trab_pos  = false;
          $pos_tmp   = true; 
          $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['cond_pesq'];
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
          $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
          $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
          $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['cond_pesq'], 0, $trab_pos);
          $nm_cab_filtrobr = str_replace("##*@@", ", " . $nm_cond_filtro_or . "<br />", $nm_cab_filtro);
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
             $nm_cab_filtro = str_replace("##*@@", ", " . $nm_cond_filtro_or, $nm_cab_filtro);
          }   
      }   
      $nm_saida->saida(" <TR align=\"center\">\r\n");
      $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
      $nm_saida->saida("<style>\r\n");
      $nm_saida->saida("#lin1_col1 { padding-left:9px; padding-top:7px;  height:27px; overflow:hidden; text-align:left;}			 \r\n");
      $nm_saida->saida("#lin1_col2 { padding-right:9px; padding-top:7px; height:27px; text-align:right; overflow:hidden;   font-size:12px; font-weight:normal;}\r\n");
      $nm_saida->saida("</style>\r\n");
      $nm_saida->saida("<div style=\"width: 100%\">\r\n");
      $nm_saida->saida(" <div class=\"" . $this->css_scGridHeader . "\" style=\"height:11px; display: block; border-width:0px; \"></div>\r\n");
      $nm_saida->saida(" <div style=\"height:37px; border-width:0px 0px 1px 0px;  border-style: dashed; border-color:#ddd; display: block\">\r\n");
      $nm_saida->saida(" 	<table style=\"width:100%; border-collapse:collapse; padding:0;\">\r\n");
      $nm_saida->saida("    	<tr>\r\n");
      $nm_saida->saida("        	<td id=\"lin1_col1\" class=\"" . $this->css_scGridHeaderFont . "\"><span>Generador de Informes</span></td>\r\n");
      $nm_saida->saida("            <td id=\"lin1_col2\" class=\"" . $this->css_scGridHeaderFont . "\"><span></span></td>\r\n");
      $nm_saida->saida("        </tr>\r\n");
      $nm_saida->saida("    </table>		 \r\n");
      $nm_saida->saida(" </div>\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("  </TD>\r\n");
      $nm_saida->saida(" </TR>\r\n");
   }


   //---- 
   function inicializa_arrays()
   {
      $this->array_total_pacientes_id_paciente = array();
      $this->array_total_pacientes_estado_paciente = array();
      $this->array_total_pacientes_fecha_activacion_paciente = array();
      $this->array_total_pacientes_fecha_retiro_paciente = array();
      $this->array_total_pacientes_motivo_retiro_paciente = array();
      $this->array_total_pacientes_observacion_motivo_retiro_paciente = array();
      $this->array_total_pacientes_identificacion_paciente = array();
      $this->array_total_pacientes_nombre_paciente = array();
      $this->array_total_pacientes_apellido_paciente = array();
      $this->array_total_pacientes_telefono_paciente = array();
      $this->array_total_pacientes_telefono2_paciente = array();
      $this->array_total_pacientes_telefono3_paciente = array();
      $this->array_total_pacientes_correo_paciente = array();
      $this->array_total_pacientes_direccion_paciente = array();
      $this->array_total_pacientes_barrio_paciente = array();
      $this->array_total_pacientes_departamento_paciente = array();
      $this->array_total_pacientes_ciudad_paciente = array();
      $this->array_total_pacientes_genero_paciente = array();
      $this->array_total_pacientes_fecha_nacimineto_paciente = array();
      $this->array_total_pacientes_edad_paciente = array();
      $this->array_total_pacientes_acudiente_paciente = array();
      $this->array_total_pacientes_telefono_acudiente_paciente = array();
      $this->array_total_pacientes_codigo_xofigo = array();
      $this->array_total_pacientes_status_paciente = array();
      $this->array_total_pacientes_id_ultima_gestion = array();
      $this->array_total_pacientes_usuario_creacion = array();
      $this->array_total_tratamiento_id_tratamiento = array();
      $this->array_total_tratamiento_producto_tratamiento = array();
      $this->array_total_tratamiento_nombre_referencia = array();
      $this->array_total_tratamiento_clasificacion_patologica_tratamiento = array();
      $this->array_total_tratamiento_tratamiento_previo = array();
      $this->array_total_tratamiento_consentimiento_tratamiento = array();
      $this->array_total_tratamiento_fecha_inicio_terapia_tratamiento = array();
      $this->array_total_tratamiento_regimen_tratamiento = array();
      $this->array_total_tratamiento_asegurador_tratamiento = array();
      $this->array_total_tratamiento_operador_logistico_tratamiento = array();
      $this->array_total_tratamiento_punto_entrega = array();
      $this->array_total_tratamiento_fecha_ultima_reclamacion_tratamiento = array();
      $this->array_total_tratamiento_otros_operadores_tratamiento = array();
      $this->array_total_tratamiento_medios_adquisicion_tratamiento = array();
      $this->array_total_tratamiento_ips_atiende_tratamiento = array();
      $this->array_total_tratamiento_medico_tratamiento = array();
      $this->array_total_tratamiento_especialidad_tratamiento = array();
      $this->array_total_tratamiento_paramedico_tratamiento = array();
      $this->array_total_tratamiento_zona_atencion_paramedico_tratamiento = array();
      $this->array_total_tratamiento_ciudad_base_paramedico_tratamiento = array();
      $this->array_total_tratamiento_notas_adjuntos_tratamiento = array();
      $this->array_total_tratamiento_id_paciente_fk = array();
      $this->array_total_gestiones_id_gestion = array();
      $this->array_total_gestiones_motivo_comunicacion_gestion = array();
      $this->array_total_gestiones_medio_contacto_gestion = array();
      $this->array_total_gestiones_tipo_llamada_gestion = array();
      $this->array_total_gestiones_logro_comunicacion_gestion = array();
      $this->array_total_gestiones_motivo_no_comunicacion_gestion = array();
      $this->array_total_gestiones_numero_intentos_gestion = array();
      $this->array_total_gestiones_esperado_gestion = array();
      $this->array_total_gestiones_estado_ctc_gestion = array();
      $this->array_total_gestiones_estado_farmacia_gestion = array();
      $this->array_total_gestiones_reclamo_gestion = array();
      $this->array_total_gestiones_causa_no_reclamacion_gestion = array();
      $this->array_total_gestiones_dificultad_acceso_gestion = array();
      $this->array_total_gestiones_tipo_dificultad_gestion = array();
      $this->array_total_gestiones_envios_gestion = array();
      $this->array_total_gestiones_medicamentos_gestion = array();
      $this->array_total_gestiones_tipo_envio_gestion = array();
      $this->array_total_gestiones_evento_adverso_gestion = array();
      $this->array_total_gestiones_tipo_evento_adverso = array();
      $this->array_total_gestiones_genera_solicitud_gestion = array();
      $this->array_total_gestiones_fecha_proxima_llamada = array();
      $this->array_total_gestiones_motivo_proxima_llamada = array();
      $this->array_total_gestiones_observacion_proxima_llamada = array();
      $this->array_total_gestiones_fecha_reclamacion_gestion = array();
      $this->array_total_gestiones_consecutivo_gestion = array();
      $this->array_total_gestiones_autor_gestion = array();
      $this->array_total_gestiones_nota = array();
      $this->array_total_gestiones_fecha_programada_gestion = array();
      $this->array_total_gestiones_usuario_asigando = array();
      $this->array_total_gestiones_id_paciente_fk2 = array();
      $this->array_total_gestiones_fecha_comunicacion = array();
      $this->array_total_gestiones_estado_gestion = array();
      $this->array_total_gestiones_codigo_argus = array();
      $this->array_total_gestiones_numero_cajas = array();
   }

   //---- 
   function adiciona_registro($quebra_pacientes_id_paciente, $quebra_pacientes_estado_paciente, $quebra_pacientes_fecha_activacion_paciente, $quebra_pacientes_fecha_retiro_paciente, $quebra_pacientes_motivo_retiro_paciente, $quebra_pacientes_observacion_motivo_retiro_paciente, $quebra_pacientes_identificacion_paciente, $quebra_pacientes_nombre_paciente, $quebra_pacientes_apellido_paciente, $quebra_pacientes_telefono_paciente, $quebra_pacientes_telefono2_paciente, $quebra_pacientes_telefono3_paciente, $quebra_pacientes_correo_paciente, $quebra_pacientes_direccion_paciente, $quebra_pacientes_barrio_paciente, $quebra_pacientes_departamento_paciente, $quebra_pacientes_ciudad_paciente, $quebra_pacientes_genero_paciente, $quebra_pacientes_fecha_nacimineto_paciente, $quebra_pacientes_edad_paciente, $quebra_pacientes_acudiente_paciente, $quebra_pacientes_telefono_acudiente_paciente, $quebra_pacientes_codigo_xofigo, $quebra_pacientes_status_paciente, $quebra_pacientes_id_ultima_gestion, $quebra_pacientes_usuario_creacion, $quebra_tratamiento_id_tratamiento, $quebra_tratamiento_producto_tratamiento, $quebra_tratamiento_nombre_referencia, $quebra_tratamiento_clasificacion_patologica_tratamiento, $quebra_tratamiento_tratamiento_previo, $quebra_tratamiento_consentimiento_tratamiento, $quebra_tratamiento_fecha_inicio_terapia_tratamiento, $quebra_tratamiento_regimen_tratamiento, $quebra_tratamiento_asegurador_tratamiento, $quebra_tratamiento_operador_logistico_tratamiento, $quebra_tratamiento_punto_entrega, $quebra_tratamiento_fecha_ultima_reclamacion_tratamiento, $quebra_tratamiento_otros_operadores_tratamiento, $quebra_tratamiento_medios_adquisicion_tratamiento, $quebra_tratamiento_ips_atiende_tratamiento, $quebra_tratamiento_medico_tratamiento, $quebra_tratamiento_especialidad_tratamiento, $quebra_tratamiento_paramedico_tratamiento, $quebra_tratamiento_zona_atencion_paramedico_tratamiento, $quebra_tratamiento_ciudad_base_paramedico_tratamiento, $quebra_tratamiento_notas_adjuntos_tratamiento, $quebra_tratamiento_id_paciente_fk, $quebra_gestiones_id_gestion, $quebra_gestiones_motivo_comunicacion_gestion, $quebra_gestiones_medio_contacto_gestion, $quebra_gestiones_tipo_llamada_gestion, $quebra_gestiones_logro_comunicacion_gestion, $quebra_gestiones_motivo_no_comunicacion_gestion, $quebra_gestiones_numero_intentos_gestion, $quebra_gestiones_esperado_gestion, $quebra_gestiones_estado_ctc_gestion, $quebra_gestiones_estado_farmacia_gestion, $quebra_gestiones_reclamo_gestion, $quebra_gestiones_causa_no_reclamacion_gestion, $quebra_gestiones_dificultad_acceso_gestion, $quebra_gestiones_tipo_dificultad_gestion, $quebra_gestiones_envios_gestion, $quebra_gestiones_medicamentos_gestion, $quebra_gestiones_tipo_envio_gestion, $quebra_gestiones_evento_adverso_gestion, $quebra_gestiones_tipo_evento_adverso, $quebra_gestiones_genera_solicitud_gestion, $quebra_gestiones_fecha_proxima_llamada, $quebra_gestiones_motivo_proxima_llamada, $quebra_gestiones_observacion_proxima_llamada, $quebra_gestiones_fecha_reclamacion_gestion, $quebra_gestiones_consecutivo_gestion, $quebra_gestiones_autor_gestion, $quebra_gestiones_nota, $quebra_gestiones_fecha_programada_gestion, $quebra_gestiones_usuario_asigando, $quebra_gestiones_id_paciente_fk2, $quebra_gestiones_fecha_comunicacion, $quebra_gestiones_estado_gestion, $quebra_gestiones_codigo_argus, $quebra_gestiones_numero_cajas, $quebra_pacientes_id_paciente_orig, $quebra_pacientes_estado_paciente_orig, $quebra_pacientes_fecha_activacion_paciente_orig, $quebra_pacientes_fecha_retiro_paciente_orig, $quebra_pacientes_motivo_retiro_paciente_orig, $quebra_pacientes_observacion_motivo_retiro_paciente_orig, $quebra_pacientes_identificacion_paciente_orig, $quebra_pacientes_nombre_paciente_orig, $quebra_pacientes_apellido_paciente_orig, $quebra_pacientes_telefono_paciente_orig, $quebra_pacientes_telefono2_paciente_orig, $quebra_pacientes_telefono3_paciente_orig, $quebra_pacientes_correo_paciente_orig, $quebra_pacientes_direccion_paciente_orig, $quebra_pacientes_barrio_paciente_orig, $quebra_pacientes_departamento_paciente_orig, $quebra_pacientes_ciudad_paciente_orig, $quebra_pacientes_genero_paciente_orig, $quebra_pacientes_fecha_nacimineto_paciente_orig, $quebra_pacientes_edad_paciente_orig, $quebra_pacientes_acudiente_paciente_orig, $quebra_pacientes_telefono_acudiente_paciente_orig, $quebra_pacientes_codigo_xofigo_orig, $quebra_pacientes_status_paciente_orig, $quebra_pacientes_id_ultima_gestion_orig, $quebra_pacientes_usuario_creacion_orig, $quebra_tratamiento_id_tratamiento_orig, $quebra_tratamiento_producto_tratamiento_orig, $quebra_tratamiento_nombre_referencia_orig, $quebra_tratamiento_clasificacion_patologica_tratamiento_orig, $quebra_tratamiento_tratamiento_previo_orig, $quebra_tratamiento_consentimiento_tratamiento_orig, $quebra_tratamiento_fecha_inicio_terapia_tratamiento_orig, $quebra_tratamiento_regimen_tratamiento_orig, $quebra_tratamiento_asegurador_tratamiento_orig, $quebra_tratamiento_operador_logistico_tratamiento_orig, $quebra_tratamiento_punto_entrega_orig, $quebra_tratamiento_fecha_ultima_reclamacion_tratamiento_orig, $quebra_tratamiento_otros_operadores_tratamiento_orig, $quebra_tratamiento_medios_adquisicion_tratamiento_orig, $quebra_tratamiento_ips_atiende_tratamiento_orig, $quebra_tratamiento_medico_tratamiento_orig, $quebra_tratamiento_especialidad_tratamiento_orig, $quebra_tratamiento_paramedico_tratamiento_orig, $quebra_tratamiento_zona_atencion_paramedico_tratamiento_orig, $quebra_tratamiento_ciudad_base_paramedico_tratamiento_orig, $quebra_tratamiento_notas_adjuntos_tratamiento_orig, $quebra_tratamiento_id_paciente_fk_orig, $quebra_gestiones_id_gestion_orig, $quebra_gestiones_motivo_comunicacion_gestion_orig, $quebra_gestiones_medio_contacto_gestion_orig, $quebra_gestiones_tipo_llamada_gestion_orig, $quebra_gestiones_logro_comunicacion_gestion_orig, $quebra_gestiones_motivo_no_comunicacion_gestion_orig, $quebra_gestiones_numero_intentos_gestion_orig, $quebra_gestiones_esperado_gestion_orig, $quebra_gestiones_estado_ctc_gestion_orig, $quebra_gestiones_estado_farmacia_gestion_orig, $quebra_gestiones_reclamo_gestion_orig, $quebra_gestiones_causa_no_reclamacion_gestion_orig, $quebra_gestiones_dificultad_acceso_gestion_orig, $quebra_gestiones_tipo_dificultad_gestion_orig, $quebra_gestiones_envios_gestion_orig, $quebra_gestiones_medicamentos_gestion_orig, $quebra_gestiones_tipo_envio_gestion_orig, $quebra_gestiones_evento_adverso_gestion_orig, $quebra_gestiones_tipo_evento_adverso_orig, $quebra_gestiones_genera_solicitud_gestion_orig, $quebra_gestiones_fecha_proxima_llamada_orig, $quebra_gestiones_motivo_proxima_llamada_orig, $quebra_gestiones_observacion_proxima_llamada_orig, $quebra_gestiones_fecha_reclamacion_gestion_orig, $quebra_gestiones_consecutivo_gestion_orig, $quebra_gestiones_autor_gestion_orig, $quebra_gestiones_nota_orig, $quebra_gestiones_fecha_programada_gestion_orig, $quebra_gestiones_usuario_asigando_orig, $quebra_gestiones_id_paciente_fk2_orig, $quebra_gestiones_fecha_comunicacion_orig, $quebra_gestiones_estado_gestion_orig, $quebra_gestiones_codigo_argus_orig, $quebra_gestiones_numero_cajas_orig)
   {
      $contr_arr = "";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $temp       = "quebra_" . $cmp_gb . "_orig";
          $contr_arr .= "['" . $$temp . "']";
          $arr_name   = "array_total_" . $cmp_gb . $contr_arr;
          $cmp_look   = "quebra_" . $cmp_gb;
          $cmp_orig   = "quebra_" . $cmp_gb . "_orig";
          eval ('
          if (!isset($this->' . $arr_name . '))
          {
              $this->' . $arr_name . '[0] = 1;
              $this->' . $arr_name . '[1] = "' . $$cmp_look . '";
              $this->' . $arr_name . '[2] = "' . $$cmp_orig . '";
          }
          else
          {
              $this->' . $arr_name . '[0]++;
          }
          ');
      }
   }

   //---- 
   function finaliza_arrays()
   {
   }

   function prepara_resumo()
   {
      $this->inicializa_vars();
      $this->resumo_init();
      $this->inicializa_arrays();
   }

   function finaliza_resumo()
   {
      $this->finaliza_arrays();
   }

//
   function nm_acumula_resumo($nm_tipo="resumo")
   {
     global $nm_lang;
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
       $gestiones_fecha_comunicacion_2 = $Busca_temp['gestiones_fecha_comunicacion_input_2']; 
       $this->gestiones_fecha_comunicacion_2 = $Busca_temp['gestiones_fecha_comunicacion_input_2']; 
     } 
     $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_orig'];
     $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq'];
     $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq_filtro'];
     $this->nm_field_dinamico = array();
     $this->nm_order_dinamico = array();
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ""; 
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
     else 
     { 
         $nmgp_select = "SELECT pacientes.ID_PACIENTE as pacientes_id_paciente, pacientes.ESTADO_PACIENTE as cmp_maior_30_1, pacientes.FECHA_ACTIVACION_PACIENTE as cmp_maior_30_2, pacientes.FECHA_RETIRO_PACIENTE as cmp_maior_30_3, pacientes.MOTIVO_RETIRO_PACIENTE as cmp_maior_30_4, pacientes.OBSERVACION_MOTIVO_RETIRO_PACIENTE as cmp_maior_30_5, pacientes.IDENTIFICACION_PACIENTE as cmp_maior_30_6, pacientes.NOMBRE_PACIENTE as cmp_maior_30_7, pacientes.APELLIDO_PACIENTE as cmp_maior_30_8, pacientes.TELEFONO_PACIENTE as cmp_maior_30_9, pacientes.TELEFONO2_PACIENTE as cmp_maior_30_10, pacientes.TELEFONO3_PACIENTE as cmp_maior_30_11, pacientes.CORREO_PACIENTE as cmp_maior_30_12, pacientes.DIRECCION_PACIENTE as cmp_maior_30_13, pacientes.BARRIO_PACIENTE as cmp_maior_30_14, pacientes.DEPARTAMENTO_PACIENTE as cmp_maior_30_15, pacientes.CIUDAD_PACIENTE as cmp_maior_30_16, pacientes.GENERO_PACIENTE as cmp_maior_30_17, pacientes.FECHA_NACIMINETO_PACIENTE as cmp_maior_30_18, pacientes.EDAD_PACIENTE as pacientes_edad_paciente, pacientes.ACUDIENTE_PACIENTE as cmp_maior_30_19, pacientes.TELEFONO_ACUDIENTE_PACIENTE as cmp_maior_30_20, pacientes.CODIGO_XOFIGO as pacientes_codigo_xofigo, pacientes.STATUS_PACIENTE as cmp_maior_30_21, pacientes.ID_ULTIMA_GESTION as cmp_maior_30_22, pacientes.USUARIO_CREACION as cmp_maior_30_23, tratamiento.ID_TRATAMIENTO as cmp_maior_30_24, tratamiento.PRODUCTO_TRATAMIENTO as cmp_maior_30_25, tratamiento.NOMBRE_REFERENCIA as cmp_maior_30_26, tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO as cmp_maior_30_27, tratamiento.TRATAMIENTO_PREVIO as cmp_maior_30_28, tratamiento.CONSENTIMIENTO_TRATAMIENTO as cmp_maior_30_29, tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO as cmp_maior_30_30, tratamiento.REGIMEN_TRATAMIENTO as cmp_maior_30_31, tratamiento.ASEGURADOR_TRATAMIENTO as cmp_maior_30_32, tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO as cmp_maior_30_33, tratamiento.PUNTO_ENTREGA as cmp_maior_30_34, tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO as cmp_maior_30_35, tratamiento.OTROS_OPERADORES_TRATAMIENTO as cmp_maior_30_36, tratamiento.MEDIOS_ADQUISICION_TRATAMIENTO as cmp_maior_30_37, tratamiento.IPS_ATIENDE_TRATAMIENTO as cmp_maior_30_38, tratamiento.MEDICO_TRATAMIENTO as cmp_maior_30_39, tratamiento.ESPECIALIDAD_TRATAMIENTO as cmp_maior_30_40, tratamiento.PARAMEDICO_TRATAMIENTO as cmp_maior_30_41, tratamiento.ZONA_ATENCION_PARAMEDICO_TRATAMIENTO as cmp_maior_30_42, tratamiento.CIUDAD_BASE_PARAMEDICO_TRATAMIENTO as cmp_maior_30_43, tratamiento.NOTAS_ADJUNTOS_TRATAMIENTO as cmp_maior_30_44, tratamiento.ID_PACIENTE_FK as cmp_maior_30_45, gestiones.FECHA_RECLAMACION_GESTION as cmp_maior_30_46, gestiones.ID_GESTION as gestiones_id_gestion, gestiones.MOTIVO_COMUNICACION_GESTION as cmp_maior_30_47, gestiones.MEDIO_CONTACTO_GESTION as cmp_maior_30_48, gestiones.TIPO_LLAMADA_GESTION as cmp_maior_30_49, gestiones.LOGRO_COMUNICACION_GESTION as cmp_maior_30_50, gestiones.MOTIVO_NO_COMUNICACION_GESTION as cmp_maior_30_51, gestiones.NUMERO_INTENTOS_GESTION as cmp_maior_30_52, gestiones.ESPERADO_GESTION as cmp_maior_30_53, gestiones.ESTADO_CTC_GESTION as cmp_maior_30_54, gestiones.ESTADO_FARMACIA_GESTION as cmp_maior_30_55, gestiones.RECLAMO_GESTION as cmp_maior_30_56, gestiones.CAUSA_NO_RECLAMACION_GESTION as cmp_maior_30_57, gestiones.DIFICULTAD_ACCESO_GESTION as cmp_maior_30_58, gestiones.TIPO_DIFICULTAD_GESTION as cmp_maior_30_59, gestiones.ENVIOS_GESTION as gestiones_envios_gestion, gestiones.MEDICAMENTOS_GESTION as cmp_maior_30_60, gestiones.TIPO_ENVIO_GESTION as cmp_maior_30_61, gestiones.EVENTO_ADVERSO_GESTION as cmp_maior_30_62, gestiones.TIPO_EVENTO_ADVERSO as cmp_maior_30_63, gestiones.GENERA_SOLICITUD_GESTION as cmp_maior_30_64, gestiones.FECHA_PROXIMA_LLAMADA as cmp_maior_30_65, gestiones.MOTIVO_PROXIMA_LLAMADA as cmp_maior_30_66, gestiones.OBSERVACION_PROXIMA_LLAMADA as cmp_maior_30_67, gestiones.CONSECUTIVO_GESTION as cmp_maior_30_68, gestiones.AUTOR_GESTION as gestiones_autor_gestion, gestiones.NOTA as gestiones_nota, gestiones.DESCRIPCION_COMUNICACION_GESTION as cmp_maior_30_69, gestiones.FECHA_PROGRAMADA_GESTION as cmp_maior_30_70, gestiones.USUARIO_ASIGANDO as cmp_maior_30_71, gestiones.ID_PACIENTE_FK2 as cmp_maior_30_72, gestiones.FECHA_COMUNICACION as cmp_maior_30_73, gestiones.ESTADO_GESTION as gestiones_estado_gestion, gestiones.CODIGO_ARGUS as gestiones_codigo_argus, gestiones.NUMERO_CAJAS as gestiones_numero_cajas from " . $this->Ini->nm_tabela; 
     } 
     $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['where_pesq']; 
     $temp = "";
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['SC_Gb_Free_sql'] as $cmp_gb => $ord)
     {
         $temp .= (empty($temp)) ? $cmp_gb . " " . $ord : ", " . $cmp_gb . " " . $ord;
     }
     $nmgp_order_by = " order by " . $temp;
     $nmgp_select .= $nmgp_order_by; 
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
     $rs_res = $this->Db->Execute($nmgp_select) ; 
     if ($rs_res === false && !$rs_graf->EOF) 
     { 
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
// 
     if ($nm_tipo != "resumo") 
     {  
          $this->nm_acum_res_unit($rs_res, $nm_tipo);
     }  
     else  
     {  
         while (!$rs_res->EOF) 
         {  
                $this->nm_acum_res_unit($rs_res, "resumo");
                $rs_res->MoveNext();
         }  
     }  
     $rs_res->Close();
   }
// 
   function nm_acum_res_unit($rs_res, $nm_tipo="resumo")
   {
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca']))
            { 
                $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['generador_de_informes']['campos_busca'];
                if ($_SESSION['scriptcase']['charset'] != "UTF-8")
                {
                    $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
                }
            } 
            $this->pacientes_id_paciente = $rs_res->fields[0] ;  
            $this->pacientes_estado_paciente = $rs_res->fields[1] ;  
            $this->pacientes_fecha_activacion_paciente = $rs_res->fields[2] ;  
            $this->pacientes_fecha_retiro_paciente = $rs_res->fields[3] ;  
            $this->pacientes_motivo_retiro_paciente = $rs_res->fields[4] ;  
            $this->pacientes_observacion_motivo_retiro_paciente = $rs_res->fields[5] ;  
            $this->pacientes_identificacion_paciente = $rs_res->fields[6] ;  
            $this->pacientes_nombre_paciente = $rs_res->fields[7] ;  
            $this->pacientes_apellido_paciente = $rs_res->fields[8] ;  
            $this->pacientes_telefono_paciente = $rs_res->fields[9] ;  
            $this->pacientes_telefono2_paciente = $rs_res->fields[10] ;  
            $this->pacientes_telefono3_paciente = $rs_res->fields[11] ;  
            $this->pacientes_correo_paciente = $rs_res->fields[12] ;  
            $this->pacientes_direccion_paciente = $rs_res->fields[13] ;  
            $this->pacientes_barrio_paciente = $rs_res->fields[14] ;  
            $this->pacientes_departamento_paciente = $rs_res->fields[15] ;  
            $this->pacientes_ciudad_paciente = $rs_res->fields[16] ;  
            $this->pacientes_genero_paciente = $rs_res->fields[17] ;  
            $this->pacientes_fecha_nacimineto_paciente = $rs_res->fields[18] ;  
            $this->pacientes_edad_paciente = $rs_res->fields[19] ;  
            $this->pacientes_acudiente_paciente = $rs_res->fields[20] ;  
            $this->pacientes_telefono_acudiente_paciente = $rs_res->fields[21] ;  
            $this->pacientes_codigo_xofigo = $rs_res->fields[22] ;  
            $this->pacientes_status_paciente = $rs_res->fields[23] ;  
            $this->pacientes_id_ultima_gestion = $rs_res->fields[24] ;  
            $this->pacientes_usuario_creacion = $rs_res->fields[25] ;  
            $this->tratamiento_id_tratamiento = $rs_res->fields[26] ;  
            $this->tratamiento_producto_tratamiento = $rs_res->fields[27] ;  
            $this->tratamiento_nombre_referencia = $rs_res->fields[28] ;  
            $this->tratamiento_clasificacion_patologica_tratamiento = $rs_res->fields[29] ;  
            $this->tratamiento_tratamiento_previo = $rs_res->fields[30] ;  
            $this->tratamiento_consentimiento_tratamiento = $rs_res->fields[31] ;  
            $this->tratamiento_fecha_inicio_terapia_tratamiento = $rs_res->fields[32] ;  
            $this->tratamiento_regimen_tratamiento = $rs_res->fields[33] ;  
            $this->tratamiento_asegurador_tratamiento = $rs_res->fields[34] ;  
            $this->tratamiento_operador_logistico_tratamiento = $rs_res->fields[35] ;  
            $this->tratamiento_punto_entrega = $rs_res->fields[36] ;  
            $this->tratamiento_fecha_ultima_reclamacion_tratamiento = $rs_res->fields[37] ;  
            $this->tratamiento_otros_operadores_tratamiento = $rs_res->fields[38] ;  
            $this->tratamiento_medios_adquisicion_tratamiento = $rs_res->fields[39] ;  
            $this->tratamiento_ips_atiende_tratamiento = $rs_res->fields[40] ;  
            $this->tratamiento_medico_tratamiento = $rs_res->fields[41] ;  
            $this->tratamiento_especialidad_tratamiento = $rs_res->fields[42] ;  
            $this->tratamiento_paramedico_tratamiento = $rs_res->fields[43] ;  
            $this->tratamiento_zona_atencion_paramedico_tratamiento = $rs_res->fields[44] ;  
            $this->tratamiento_ciudad_base_paramedico_tratamiento = $rs_res->fields[45] ;  
            $this->tratamiento_notas_adjuntos_tratamiento = $rs_res->fields[46] ;  
            $this->tratamiento_id_paciente_fk = $rs_res->fields[47] ;  
            $this->gestiones_fecha_reclamacion_gestion = $rs_res->fields[48] ;  
            $this->gestiones_id_gestion = $rs_res->fields[49] ;  
            $this->gestiones_motivo_comunicacion_gestion = $rs_res->fields[50] ;  
            $this->gestiones_medio_contacto_gestion = $rs_res->fields[51] ;  
            $this->gestiones_tipo_llamada_gestion = $rs_res->fields[52] ;  
            $this->gestiones_logro_comunicacion_gestion = $rs_res->fields[53] ;  
            $this->gestiones_motivo_no_comunicacion_gestion = $rs_res->fields[54] ;  
            $this->gestiones_numero_intentos_gestion = $rs_res->fields[55] ;  
            $this->gestiones_esperado_gestion = $rs_res->fields[56] ;  
            $this->gestiones_estado_ctc_gestion = $rs_res->fields[57] ;  
            $this->gestiones_estado_farmacia_gestion = $rs_res->fields[58] ;  
            $this->gestiones_reclamo_gestion = $rs_res->fields[59] ;  
            $this->gestiones_causa_no_reclamacion_gestion = $rs_res->fields[60] ;  
            $this->gestiones_dificultad_acceso_gestion = $rs_res->fields[61] ;  
            $this->gestiones_tipo_dificultad_gestion = $rs_res->fields[62] ;  
            $this->gestiones_envios_gestion = $rs_res->fields[63] ;  
            $this->gestiones_medicamentos_gestion = $rs_res->fields[64] ;  
            $this->gestiones_tipo_envio_gestion = $rs_res->fields[65] ;  
            $this->gestiones_evento_adverso_gestion = $rs_res->fields[66] ;  
            $this->gestiones_tipo_evento_adverso = $rs_res->fields[67] ;  
            $this->gestiones_genera_solicitud_gestion = $rs_res->fields[68] ;  
            $this->gestiones_fecha_proxima_llamada = $rs_res->fields[69] ;  
            $this->gestiones_motivo_proxima_llamada = $rs_res->fields[70] ;  
            $this->gestiones_observacion_proxima_llamada = $rs_res->fields[71] ;  
            $this->gestiones_consecutivo_gestion = $rs_res->fields[72] ;  
            $this->gestiones_autor_gestion = $rs_res->fields[73] ;  
            $this->gestiones_nota = $rs_res->fields[74] ;  
            $this->gestiones_descripcion_comunicacion_gestion = $rs_res->fields[75] ;  
            $this->gestiones_fecha_programada_gestion = $rs_res->fields[76] ;  
            $this->gestiones_usuario_asigando = $rs_res->fields[77] ;  
            $this->gestiones_id_paciente_fk2 = $rs_res->fields[78] ;  
            $this->gestiones_fecha_comunicacion = $rs_res->fields[79] ;  
            $this->gestiones_estado_gestion = $rs_res->fields[80] ;  
            $this->gestiones_codigo_argus = $rs_res->fields[81] ;  
            $this->gestiones_numero_cajas = $rs_res->fields[82] ;  
            $this->gestiones_fecha_comunicacion = substr($this->gestiones_fecha_comunicacion, 0, 10);
            $this->pacientes_id_paciente_orig = $this->pacientes_id_paciente;
            $this->pacientes_estado_paciente_orig = $this->pacientes_estado_paciente;
            $this->pacientes_fecha_activacion_paciente_orig = $this->pacientes_fecha_activacion_paciente;
            $this->pacientes_fecha_retiro_paciente_orig = $this->pacientes_fecha_retiro_paciente;
            $this->pacientes_motivo_retiro_paciente_orig = $this->pacientes_motivo_retiro_paciente;
            $this->pacientes_observacion_motivo_retiro_paciente_orig = $this->pacientes_observacion_motivo_retiro_paciente;
            $this->pacientes_identificacion_paciente_orig = $this->pacientes_identificacion_paciente;
            $this->pacientes_nombre_paciente_orig = $this->pacientes_nombre_paciente;
            $this->pacientes_apellido_paciente_orig = $this->pacientes_apellido_paciente;
            $this->pacientes_telefono_paciente_orig = $this->pacientes_telefono_paciente;
            $this->pacientes_telefono2_paciente_orig = $this->pacientes_telefono2_paciente;
            $this->pacientes_telefono3_paciente_orig = $this->pacientes_telefono3_paciente;
            $this->pacientes_correo_paciente_orig = $this->pacientes_correo_paciente;
            $this->pacientes_direccion_paciente_orig = $this->pacientes_direccion_paciente;
            $this->pacientes_barrio_paciente_orig = $this->pacientes_barrio_paciente;
            $this->pacientes_departamento_paciente_orig = $this->pacientes_departamento_paciente;
            $this->pacientes_ciudad_paciente_orig = $this->pacientes_ciudad_paciente;
            $this->pacientes_genero_paciente_orig = $this->pacientes_genero_paciente;
            $this->pacientes_fecha_nacimineto_paciente_orig = $this->pacientes_fecha_nacimineto_paciente;
            $this->pacientes_edad_paciente_orig = $this->pacientes_edad_paciente;
            $this->pacientes_acudiente_paciente_orig = $this->pacientes_acudiente_paciente;
            $this->pacientes_telefono_acudiente_paciente_orig = $this->pacientes_telefono_acudiente_paciente;
            $this->pacientes_codigo_xofigo_orig = $this->pacientes_codigo_xofigo;
            $this->pacientes_status_paciente_orig = $this->pacientes_status_paciente;
            $this->pacientes_id_ultima_gestion_orig = $this->pacientes_id_ultima_gestion;
            $this->pacientes_usuario_creacion_orig = $this->pacientes_usuario_creacion;
            $this->tratamiento_id_tratamiento_orig = $this->tratamiento_id_tratamiento;
            $this->tratamiento_producto_tratamiento_orig = $this->tratamiento_producto_tratamiento;
            $this->tratamiento_nombre_referencia_orig = $this->tratamiento_nombre_referencia;
            $this->tratamiento_clasificacion_patologica_tratamiento_orig = $this->tratamiento_clasificacion_patologica_tratamiento;
            $this->tratamiento_tratamiento_previo_orig = $this->tratamiento_tratamiento_previo;
            $this->tratamiento_consentimiento_tratamiento_orig = $this->tratamiento_consentimiento_tratamiento;
            $this->tratamiento_fecha_inicio_terapia_tratamiento_orig = $this->tratamiento_fecha_inicio_terapia_tratamiento;
            $this->tratamiento_regimen_tratamiento_orig = $this->tratamiento_regimen_tratamiento;
            $this->tratamiento_asegurador_tratamiento_orig = $this->tratamiento_asegurador_tratamiento;
            $this->tratamiento_operador_logistico_tratamiento_orig = $this->tratamiento_operador_logistico_tratamiento;
            $this->tratamiento_punto_entrega_orig = $this->tratamiento_punto_entrega;
            $this->tratamiento_fecha_ultima_reclamacion_tratamiento_orig = $this->tratamiento_fecha_ultima_reclamacion_tratamiento;
            $this->tratamiento_otros_operadores_tratamiento_orig = $this->tratamiento_otros_operadores_tratamiento;
            $this->tratamiento_medios_adquisicion_tratamiento_orig = $this->tratamiento_medios_adquisicion_tratamiento;
            $this->tratamiento_ips_atiende_tratamiento_orig = $this->tratamiento_ips_atiende_tratamiento;
            $this->tratamiento_medico_tratamiento_orig = $this->tratamiento_medico_tratamiento;
            $this->tratamiento_especialidad_tratamiento_orig = $this->tratamiento_especialidad_tratamiento;
            $this->tratamiento_paramedico_tratamiento_orig = $this->tratamiento_paramedico_tratamiento;
            $this->tratamiento_zona_atencion_paramedico_tratamiento_orig = $this->tratamiento_zona_atencion_paramedico_tratamiento;
            $this->tratamiento_ciudad_base_paramedico_tratamiento_orig = $this->tratamiento_ciudad_base_paramedico_tratamiento;
            $this->tratamiento_notas_adjuntos_tratamiento_orig = $this->tratamiento_notas_adjuntos_tratamiento;
            $this->tratamiento_id_paciente_fk_orig = $this->tratamiento_id_paciente_fk;
            $this->gestiones_id_gestion_orig = $this->gestiones_id_gestion;
            $this->gestiones_motivo_comunicacion_gestion_orig = $this->gestiones_motivo_comunicacion_gestion;
            $this->gestiones_medio_contacto_gestion_orig = $this->gestiones_medio_contacto_gestion;
            $this->gestiones_tipo_llamada_gestion_orig = $this->gestiones_tipo_llamada_gestion;
            $this->gestiones_logro_comunicacion_gestion_orig = $this->gestiones_logro_comunicacion_gestion;
            $this->gestiones_motivo_no_comunicacion_gestion_orig = $this->gestiones_motivo_no_comunicacion_gestion;
            $this->gestiones_numero_intentos_gestion_orig = $this->gestiones_numero_intentos_gestion;
            $this->gestiones_esperado_gestion_orig = $this->gestiones_esperado_gestion;
            $this->gestiones_estado_ctc_gestion_orig = $this->gestiones_estado_ctc_gestion;
            $this->gestiones_estado_farmacia_gestion_orig = $this->gestiones_estado_farmacia_gestion;
            $this->gestiones_reclamo_gestion_orig = $this->gestiones_reclamo_gestion;
            $this->gestiones_causa_no_reclamacion_gestion_orig = $this->gestiones_causa_no_reclamacion_gestion;
            $this->gestiones_dificultad_acceso_gestion_orig = $this->gestiones_dificultad_acceso_gestion;
            $this->gestiones_tipo_dificultad_gestion_orig = $this->gestiones_tipo_dificultad_gestion;
            $this->gestiones_envios_gestion_orig = $this->gestiones_envios_gestion;
            $this->gestiones_medicamentos_gestion_orig = $this->gestiones_medicamentos_gestion;
            $this->gestiones_tipo_envio_gestion_orig = $this->gestiones_tipo_envio_gestion;
            $this->gestiones_evento_adverso_gestion_orig = $this->gestiones_evento_adverso_gestion;
            $this->gestiones_tipo_evento_adverso_orig = $this->gestiones_tipo_evento_adverso;
            $this->gestiones_genera_solicitud_gestion_orig = $this->gestiones_genera_solicitud_gestion;
            $this->gestiones_fecha_proxima_llamada_orig = $this->gestiones_fecha_proxima_llamada;
            $this->gestiones_motivo_proxima_llamada_orig = $this->gestiones_motivo_proxima_llamada;
            $this->gestiones_observacion_proxima_llamada_orig = $this->gestiones_observacion_proxima_llamada;
            $this->gestiones_fecha_reclamacion_gestion_orig = $this->gestiones_fecha_reclamacion_gestion;
            $this->gestiones_consecutivo_gestion_orig = $this->gestiones_consecutivo_gestion;
            $this->gestiones_autor_gestion_orig = $this->gestiones_autor_gestion;
            $this->gestiones_nota_orig = $this->gestiones_nota;
            $this->gestiones_fecha_programada_gestion_orig = $this->gestiones_fecha_programada_gestion;
            $this->gestiones_usuario_asigando_orig = $this->gestiones_usuario_asigando;
            $this->gestiones_id_paciente_fk2_orig = $this->gestiones_id_paciente_fk2;
            $this->gestiones_fecha_comunicacion_orig = $this->gestiones_fecha_comunicacion;
            $this->gestiones_estado_gestion_orig = $this->gestiones_estado_gestion;
            $this->gestiones_codigo_argus_orig = $this->gestiones_codigo_argus;
            $this->gestiones_numero_cajas_orig = $this->gestiones_numero_cajas;
            $conteudo_x =  $this->pacientes_fecha_activacion_paciente;
            nm_conv_limpa_dado($conteudo_x, "");
            if (is_numeric($conteudo_x) && $conteudo_x > 0) 
            { 
                $this->nm_data->SetaData($this->pacientes_fecha_activacion_paciente, "");
                $this->pacientes_fecha_activacion_paciente = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
            } 
            $conteudo_x =  $this->pacientes_fecha_retiro_paciente;
            nm_conv_limpa_dado($conteudo_x, "");
            if (is_numeric($conteudo_x) && $conteudo_x > 0) 
            { 
                $this->nm_data->SetaData($this->pacientes_fecha_retiro_paciente, "");
                $this->pacientes_fecha_retiro_paciente = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
            } 
            $conteudo_x =  $this->pacientes_fecha_nacimineto_paciente;
            nm_conv_limpa_dado($conteudo_x, "");
            if (is_numeric($conteudo_x) && $conteudo_x > 0) 
            { 
                $this->nm_data->SetaData($this->pacientes_fecha_nacimineto_paciente, "");
                $this->pacientes_fecha_nacimineto_paciente = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
            } 
            nmgp_Form_Num_Val($this->pacientes_edad_paciente, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            nmgp_Form_Num_Val($this->pacientes_codigo_xofigo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            nmgp_Form_Num_Val($this->pacientes_id_ultima_gestion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            nmgp_Form_Num_Val($this->tratamiento_id_tratamiento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $conteudo_x =  $this->tratamiento_fecha_inicio_terapia_tratamiento;
            nm_conv_limpa_dado($conteudo_x, "");
            if (is_numeric($conteudo_x) && $conteudo_x > 0) 
            { 
                $this->nm_data->SetaData($this->tratamiento_fecha_inicio_terapia_tratamiento, "");
                $this->tratamiento_fecha_inicio_terapia_tratamiento = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
            } 
            $conteudo_x =  $this->tratamiento_fecha_ultima_reclamacion_tratamiento;
            nm_conv_limpa_dado($conteudo_x, "");
            if (is_numeric($conteudo_x) && $conteudo_x > 0) 
            { 
                $this->nm_data->SetaData($this->tratamiento_fecha_ultima_reclamacion_tratamiento, "");
                $this->tratamiento_fecha_ultima_reclamacion_tratamiento = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
            } 
            nmgp_Form_Num_Val($this->tratamiento_id_paciente_fk, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            nmgp_Form_Num_Val($this->gestiones_id_gestion, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $conteudo_x =  $this->gestiones_fecha_proxima_llamada;
            nm_conv_limpa_dado($conteudo_x, "");
            if (is_numeric($conteudo_x) && $conteudo_x > 0) 
            { 
                $this->nm_data->SetaData($this->gestiones_fecha_proxima_llamada, "");
                $this->gestiones_fecha_proxima_llamada = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
            } 
            $conteudo_x =  $this->gestiones_fecha_reclamacion_gestion;
            nm_conv_limpa_dado($conteudo_x, "");
            if (is_numeric($conteudo_x) && $conteudo_x > 0) 
            { 
                $this->nm_data->SetaData($this->gestiones_fecha_reclamacion_gestion, "");
                $this->gestiones_fecha_reclamacion_gestion = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
            } 
            $conteudo_x =  $this->gestiones_fecha_programada_gestion;
            nm_conv_limpa_dado($conteudo_x, "");
            if (is_numeric($conteudo_x) && $conteudo_x > 0) 
            { 
                $this->nm_data->SetaData($this->gestiones_fecha_programada_gestion, "");
                $this->gestiones_fecha_programada_gestion = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
            } 
            nmgp_Form_Num_Val($this->gestiones_id_paciente_fk2, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            if (substr($this->gestiones_fecha_comunicacion, 10, 1) == "-") 
            { 
                $this->gestiones_fecha_comunicacion = substr($this->gestiones_fecha_comunicacion, 0, 10) . " " . substr($this->gestiones_fecha_comunicacion, 11);
            } 
            if (substr($this->gestiones_fecha_comunicacion, 13, 1) == ".") 
            { 
               $this->gestiones_fecha_comunicacion = substr($this->gestiones_fecha_comunicacion, 0, 13) . ":" . substr($this->gestiones_fecha_comunicacion, 14, 2) . ":" . substr($this->gestiones_fecha_comunicacion, 17);
            } 
            $this->nm_data->SetaData($this->gestiones_fecha_comunicacion, "YYYY-MM-DD");
            $this->gestiones_fecha_comunicacion = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa"));
            if ($nm_tipo == "resumo")
            {
                $this->adiciona_registro($this->pacientes_id_paciente, $this->pacientes_estado_paciente, $this->pacientes_fecha_activacion_paciente, $this->pacientes_fecha_retiro_paciente, $this->pacientes_motivo_retiro_paciente, $this->pacientes_observacion_motivo_retiro_paciente, $this->pacientes_identificacion_paciente, $this->pacientes_nombre_paciente, $this->pacientes_apellido_paciente, $this->pacientes_telefono_paciente, $this->pacientes_telefono2_paciente, $this->pacientes_telefono3_paciente, $this->pacientes_correo_paciente, $this->pacientes_direccion_paciente, $this->pacientes_barrio_paciente, $this->pacientes_departamento_paciente, $this->pacientes_ciudad_paciente, $this->pacientes_genero_paciente, $this->pacientes_fecha_nacimineto_paciente, $this->pacientes_edad_paciente, $this->pacientes_acudiente_paciente, $this->pacientes_telefono_acudiente_paciente, $this->pacientes_codigo_xofigo, $this->pacientes_status_paciente, $this->pacientes_id_ultima_gestion, $this->pacientes_usuario_creacion, $this->tratamiento_id_tratamiento, $this->tratamiento_producto_tratamiento, $this->tratamiento_nombre_referencia, $this->tratamiento_clasificacion_patologica_tratamiento, $this->tratamiento_tratamiento_previo, $this->tratamiento_consentimiento_tratamiento, $this->tratamiento_fecha_inicio_terapia_tratamiento, $this->tratamiento_regimen_tratamiento, $this->tratamiento_asegurador_tratamiento, $this->tratamiento_operador_logistico_tratamiento, $this->tratamiento_punto_entrega, $this->tratamiento_fecha_ultima_reclamacion_tratamiento, $this->tratamiento_otros_operadores_tratamiento, $this->tratamiento_medios_adquisicion_tratamiento, $this->tratamiento_ips_atiende_tratamiento, $this->tratamiento_medico_tratamiento, $this->tratamiento_especialidad_tratamiento, $this->tratamiento_paramedico_tratamiento, $this->tratamiento_zona_atencion_paramedico_tratamiento, $this->tratamiento_ciudad_base_paramedico_tratamiento, $this->tratamiento_notas_adjuntos_tratamiento, $this->tratamiento_id_paciente_fk, $this->gestiones_id_gestion, $this->gestiones_motivo_comunicacion_gestion, $this->gestiones_medio_contacto_gestion, $this->gestiones_tipo_llamada_gestion, $this->gestiones_logro_comunicacion_gestion, $this->gestiones_motivo_no_comunicacion_gestion, $this->gestiones_numero_intentos_gestion, $this->gestiones_esperado_gestion, $this->gestiones_estado_ctc_gestion, $this->gestiones_estado_farmacia_gestion, $this->gestiones_reclamo_gestion, $this->gestiones_causa_no_reclamacion_gestion, $this->gestiones_dificultad_acceso_gestion, $this->gestiones_tipo_dificultad_gestion, $this->gestiones_envios_gestion, $this->gestiones_medicamentos_gestion, $this->gestiones_tipo_envio_gestion, $this->gestiones_evento_adverso_gestion, $this->gestiones_tipo_evento_adverso, $this->gestiones_genera_solicitud_gestion, $this->gestiones_fecha_proxima_llamada, $this->gestiones_motivo_proxima_llamada, $this->gestiones_observacion_proxima_llamada, $this->gestiones_fecha_reclamacion_gestion, $this->gestiones_consecutivo_gestion, $this->gestiones_autor_gestion, $this->gestiones_nota, $this->gestiones_fecha_programada_gestion, $this->gestiones_usuario_asigando, $this->gestiones_id_paciente_fk2, $this->gestiones_fecha_comunicacion, $this->gestiones_estado_gestion, $this->gestiones_codigo_argus, $this->gestiones_numero_cajas, $this->pacientes_id_paciente_orig,  $this->pacientes_estado_paciente_orig,  $this->pacientes_fecha_activacion_paciente_orig,  $this->pacientes_fecha_retiro_paciente_orig,  $this->pacientes_motivo_retiro_paciente_orig,  $this->pacientes_observacion_motivo_retiro_paciente_orig,  $this->pacientes_identificacion_paciente_orig,  $this->pacientes_nombre_paciente_orig,  $this->pacientes_apellido_paciente_orig,  $this->pacientes_telefono_paciente_orig,  $this->pacientes_telefono2_paciente_orig,  $this->pacientes_telefono3_paciente_orig,  $this->pacientes_correo_paciente_orig,  $this->pacientes_direccion_paciente_orig,  $this->pacientes_barrio_paciente_orig,  $this->pacientes_departamento_paciente_orig,  $this->pacientes_ciudad_paciente_orig,  $this->pacientes_genero_paciente_orig,  $this->pacientes_fecha_nacimineto_paciente_orig,  $this->pacientes_edad_paciente_orig,  $this->pacientes_acudiente_paciente_orig,  $this->pacientes_telefono_acudiente_paciente_orig,  $this->pacientes_codigo_xofigo_orig,  $this->pacientes_status_paciente_orig,  $this->pacientes_id_ultima_gestion_orig,  $this->pacientes_usuario_creacion_orig,  $this->tratamiento_id_tratamiento_orig,  $this->tratamiento_producto_tratamiento_orig,  $this->tratamiento_nombre_referencia_orig,  $this->tratamiento_clasificacion_patologica_tratamiento_orig,  $this->tratamiento_tratamiento_previo_orig,  $this->tratamiento_consentimiento_tratamiento_orig,  $this->tratamiento_fecha_inicio_terapia_tratamiento_orig,  $this->tratamiento_regimen_tratamiento_orig,  $this->tratamiento_asegurador_tratamiento_orig,  $this->tratamiento_operador_logistico_tratamiento_orig,  $this->tratamiento_punto_entrega_orig,  $this->tratamiento_fecha_ultima_reclamacion_tratamiento_orig,  $this->tratamiento_otros_operadores_tratamiento_orig,  $this->tratamiento_medios_adquisicion_tratamiento_orig,  $this->tratamiento_ips_atiende_tratamiento_orig,  $this->tratamiento_medico_tratamiento_orig,  $this->tratamiento_especialidad_tratamiento_orig,  $this->tratamiento_paramedico_tratamiento_orig,  $this->tratamiento_zona_atencion_paramedico_tratamiento_orig,  $this->tratamiento_ciudad_base_paramedico_tratamiento_orig,  $this->tratamiento_notas_adjuntos_tratamiento_orig,  $this->tratamiento_id_paciente_fk_orig,  $this->gestiones_id_gestion_orig,  $this->gestiones_motivo_comunicacion_gestion_orig,  $this->gestiones_medio_contacto_gestion_orig,  $this->gestiones_tipo_llamada_gestion_orig,  $this->gestiones_logro_comunicacion_gestion_orig,  $this->gestiones_motivo_no_comunicacion_gestion_orig,  $this->gestiones_numero_intentos_gestion_orig,  $this->gestiones_esperado_gestion_orig,  $this->gestiones_estado_ctc_gestion_orig,  $this->gestiones_estado_farmacia_gestion_orig,  $this->gestiones_reclamo_gestion_orig,  $this->gestiones_causa_no_reclamacion_gestion_orig,  $this->gestiones_dificultad_acceso_gestion_orig,  $this->gestiones_tipo_dificultad_gestion_orig,  $this->gestiones_envios_gestion_orig,  $this->gestiones_medicamentos_gestion_orig,  $this->gestiones_tipo_envio_gestion_orig,  $this->gestiones_evento_adverso_gestion_orig,  $this->gestiones_tipo_evento_adverso_orig,  $this->gestiones_genera_solicitud_gestion_orig,  $this->gestiones_fecha_proxima_llamada_orig,  $this->gestiones_motivo_proxima_llamada_orig,  $this->gestiones_observacion_proxima_llamada_orig,  $this->gestiones_fecha_reclamacion_gestion_orig,  $this->gestiones_consecutivo_gestion_orig,  $this->gestiones_autor_gestion_orig,  $this->gestiones_nota_orig,  $this->gestiones_fecha_programada_gestion_orig,  $this->gestiones_usuario_asigando_orig,  $this->gestiones_id_paciente_fk2_orig,  $this->gestiones_fecha_comunicacion_orig,  $this->gestiones_estado_gestion_orig,  $this->gestiones_codigo_argus_orig,  $this->gestiones_numero_cajas_orig);
            }
   }
//
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
}
?>

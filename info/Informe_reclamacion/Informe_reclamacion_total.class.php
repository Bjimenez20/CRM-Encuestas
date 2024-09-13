<?php

class Informe_reclamacion_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function Informe_reclamacion_total($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("es");
      if (isset($_SESSION['sc_session'][$this->sc_page]['Informe_reclamacion']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['Informe_reclamacion']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      } 
   }

   //---- 
   function quebra_geral()
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp " . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp " . $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['contr_total_geral'] = "OK";
   } 

   //-----  id_paciente
   function quebra_id_paciente_sc_free_group_by($id_paciente, $Where_qb) 
   {
      global $tot_id_paciente ;  
      $tot_id_paciente = array() ;  
      $tot_id_paciente[0] = $id_paciente ; 
   }
   //-----  estado_paciente
   function quebra_estado_paciente_sc_free_group_by($estado_paciente, $Where_qb) 
   {
      global $tot_estado_paciente ;  
      $tot_estado_paciente = array() ;  
      $tot_estado_paciente[0] = $estado_paciente ; 
   }

   //----- 
   function resumo_sc_free_group_by($destino_resumo, &$array_total_id_paciente, &$array_total_estado_paciente)
   {
      global $nada, $nm_lang;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['campos_busca']))
   { 
      $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['campos_busca'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
   } 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['where_pesq_filtro'];
   $temp = "";
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['SC_Gb_Free_sql'] as $cmp_gb => $ord)
   {
       $temp .= (empty($temp)) ? $cmp_gb . " " . $ord : ", " . $cmp_gb . " " . $ord;
   }
   $nmgp_order_by = (!empty($temp)) ? " order by " . $temp : "";
   $free_group_by = "";
   $all_sql_free  = array();
   $all_sql_free[] = "ID_PACIENTE";
   $all_sql_free[] = "ESTADO_PACIENTE";
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['SC_Gb_Free_sql'] as $cmp_gb => $ord)
   {
       $free_group_by .= (empty($free_group_by)) ? $cmp_gb : ", " . $cmp_gb;
   }
   foreach ($all_sql_free as $cmp_gb)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['SC_Gb_Free_sql'][$cmp_gb]))
       {
           $free_group_by .= (empty($free_group_by)) ? $cmp_gb : ", " . $cmp_gb;
       }
   }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
         $comando  = "select count(*), ID_PACIENTE, ESTADO_PACIENTE from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp " .  $this->sc_where_atual . " group by " . $free_group_by . " " . $nmgp_order_by;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
         $comando  = "select count(*), ID_PACIENTE, ESTADO_PACIENTE from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp " .  $this->sc_where_atual . " group by " . $free_group_by . " " .  $nmgp_order_by;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
         $comando  = "select count(*), ID_PACIENTE, ESTADO_PACIENTE from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp " . $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
      } 
      else 
      { 
         $comando  = "select count(*), ID_PACIENTE, ESTADO_PACIENTE from (SELECT    pacientes.ID_PACIENTE,    pacientes.DEPARTAMENTO_PACIENTE,    pacientes.CIUDAD_PACIENTE,    pacientes.ESTADO_PACIENTE,    pacientes.STATUS_PACIENTE,    pacientes.FECHA_ACTIVACION_PACIENTE,    pacientes.FECHA_RETIRO_PACIENTE,    pacientes.MOTIVO_RETIRO_PACIENTE,    pacientes.CODIGO_XOFIGO,    pacientes.ID_ULTIMA_GESTION,     tratamiento.ID_TRATAMIENTO,    tratamiento.PRODUCTO_TRATAMIENTO,    tratamiento.NOMBRE_REFERENCIA,    tratamiento.DOSIS_TRATAMIENTO,    tratamiento.FECHA_INICIO_TERAPIA_TRATAMIENTO,    tratamiento.ASEGURADOR_TRATAMIENTO,     tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO,    tratamiento.PUNTO_ENTREGA,        tratamiento.IPS_ATIENDE_TRATAMIENTO,    tratamiento.REGIMEN_TRATAMIENTO,    tratamiento.MEDICO_TRATAMIENTO,    tratamiento.FECHA_ULTIMA_RECLAMACION_TRATAMIENTO,               tratamiento.CLASIFICACION_PATOLOGICA_TRATAMIENTO,    tratamiento.TRATAMIENTO_PREVIO,    tratamiento.ID_PACIENTE_FK,     gestiones.ID_GESTION,    gestiones.LOGRO_COMUNICACION_GESTION,    gestiones.CAUSA_NO_RECLAMACION_GESTION,    gestiones.RECLAMO_GESTION,    gestiones.FECHA_RECLAMACION_GESTION,    gestiones.FECHA_COMUNICACION,    gestiones.FECHA_PROGRAMADA_GESTION,    gestiones.AUTOR_GESTION,    gestiones.DESCRIPCION_COMUNICACION_GESTION,    gestiones.FECHA_MEDICAMENTO_HASTA,       gestiones.NUMERO_CAJAS,    gestiones.PAAP,    gestiones.SUB_PAAP,    gestiones.BARRERA,    gestiones.FECHA_INI_PAAP,    gestiones.FECHA_FIN_PAAP   FROM pacientes     INNER JOIN gestiones ON  pacientes.ID_PACIENTE = gestiones.ID_PACIENTE_FK2    INNER JOIN tratamiento ON pacientes.ID_PACIENTE = tratamiento.ID_PACIENTE_FK  WHERE gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) nm_sel_esp " . $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
      } 
      if ($destino_resumo != "gra") 
      {
          $comando = str_replace("avg(", "sum(", $comando); 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($comando))
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit;
      }
      $array_db_total = $this->get_array($rt);
      $rt->Close();
      foreach ($array_db_total as $registro)
      {
         $id_paciente      = $registro[1];
         $id_paciente_orig = $registro[1];
         $conteudo = $registro[1];
         $id_paciente = $conteudo;
         if (null === $id_paciente)
         {
             $id_paciente = '';
         }
         if (null === $id_paciente_orig)
         {
             $id_paciente_orig = '';
         }
         $val_grafico_id_paciente = $id_paciente;
         $estado_paciente      = $registro[2];
         $estado_paciente_orig = $registro[2];
         $conteudo = $registro[2];
         $estado_paciente = $conteudo;
         if (null === $estado_paciente)
         {
             $estado_paciente = '';
         }
         if (null === $estado_paciente_orig)
         {
             $estado_paciente_orig = '';
         }
         $val_grafico_estado_paciente = $estado_paciente;
         $contr_arr = "";
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
         {
             $temp       = $cmp_gb . "_orig";
             $contr_arr .= "[\"" . str_replace('"', '\"', $$temp) . "\"]";
             $arr_name   = "array_total_" . $cmp_gb . $contr_arr;
            eval ('
             if (!isset($' . $arr_name . '))
             {
                 $' . $arr_name . '[0] = ' . $registro[0] . ';
                 $' . $arr_name . '[1] = $val_grafico_' . $cmp_gb . ';
                 $' . $arr_name . '[2] = "' . str_replace('"', '\"', $$temp) . '";
             }
             else
             {
                 $' . $arr_name . '[0] += ' . $registro[0] . ';
             }
            ');
         }
      }
   }
   //-----
   function get_array($rs)
   {
       if ('ado_mssql' != $this->Ini->nm_tpbanco)
       {
           return $rs->GetArray();
       }

       $array_db_total = array();
       while (!$rs->EOF)
       {
           $arr_row = array();
           foreach ($rs->fields as $k => $v)
           {
               $arr_row[$k] = $v . '';
           }
           $array_db_total[] = $arr_row;
           $rs->MoveNext();
       }
       return $array_db_total;
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

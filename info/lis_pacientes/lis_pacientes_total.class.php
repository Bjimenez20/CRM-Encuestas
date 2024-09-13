<?php

class lis_pacientes_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function lis_pacientes_total($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("es");
      if (isset($_SESSION['sc_session'][$this->sc_page]['lis_pacientes']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['lis_pacientes']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca'];
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
          $pacientes_id_paciente_2 = $Busca_temp['pacientes_id_paciente_input_2']; 
          $this->pacientes_id_paciente_2 = $Busca_temp['pacientes_id_paciente_input_2']; 
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
          $this->pacientes_fecha_retiro_paciente = $Busca_temp['pacientes_fecha_retiro_paciente']; 
          $tmp_pos = strpos($this->pacientes_fecha_retiro_paciente, "##@@");
          if ($tmp_pos !== false)
          {
              $this->pacientes_fecha_retiro_paciente = substr($this->pacientes_fecha_retiro_paciente, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral()
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['contr_total_geral'] = "OK";
   } 

   //-----  pacientes_id_paciente
   function quebra_pacientes_id_paciente_sc_free_group_by($pacientes_id_paciente, $Where_qb) 
   {
      global $tot_pacientes_id_paciente ;  
      $tot_pacientes_id_paciente = array() ;  
      $tot_pacientes_id_paciente[0] = $pacientes_id_paciente ; 
   }
   //-----  pacientes_estado_paciente
   function quebra_pacientes_estado_paciente_sc_free_group_by($pacientes_estado_paciente, $Where_qb) 
   {
      global $tot_pacientes_estado_paciente ;  
      $tot_pacientes_estado_paciente = array() ;  
      $tot_pacientes_estado_paciente[0] = $pacientes_estado_paciente ; 
   }
   //-----  pacientes_motivo_retiro_paciente
   function quebra_pacientes_motivo_retiro_paciente_sc_free_group_by($pacientes_motivo_retiro_paciente, $Where_qb) 
   {
      global $tot_pacientes_motivo_retiro_paciente ;  
      $tot_pacientes_motivo_retiro_paciente = array() ;  
      $tot_pacientes_motivo_retiro_paciente[0] = $pacientes_motivo_retiro_paciente ; 
   }
   //-----  pacientes_genero_paciente
   function quebra_pacientes_genero_paciente_sc_free_group_by($pacientes_genero_paciente, $Where_qb) 
   {
      global $tot_pacientes_genero_paciente ;  
      $tot_pacientes_genero_paciente = array() ;  
      $tot_pacientes_genero_paciente[0] = $pacientes_genero_paciente ; 
   }
   //-----  tratamiento_producto_tratamiento
   function quebra_tratamiento_producto_tratamiento_sc_free_group_by($tratamiento_producto_tratamiento, $Where_qb) 
   {
      global $tot_tratamiento_producto_tratamiento ;  
      $tot_tratamiento_producto_tratamiento = array() ;  
      $tot_tratamiento_producto_tratamiento[0] = $tratamiento_producto_tratamiento ; 
   }
   //-----  tratamiento_medico_tratamiento
   function quebra_tratamiento_medico_tratamiento_sc_free_group_by($tratamiento_medico_tratamiento, $Where_qb) 
   {
      global $tot_tratamiento_medico_tratamiento ;  
      $tot_tratamiento_medico_tratamiento = array() ;  
      $tot_tratamiento_medico_tratamiento[0] = $tratamiento_medico_tratamiento ; 
   }

   //----- 
   function resumo_sc_free_group_by($destino_resumo, &$array_total_pacientes_id_paciente, &$array_total_pacientes_estado_paciente, &$array_total_pacientes_motivo_retiro_paciente, &$array_total_pacientes_genero_paciente, &$array_total_tratamiento_producto_tratamiento, &$array_total_tratamiento_medico_tratamiento)
   {
      global $nada, $nm_lang;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca']))
   { 
      $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['campos_busca'];
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
       $this->pacientes_id_paciente_2 = $Busca_temp['pacientes_id_paciente_input_2']; 
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
       $this->pacientes_fecha_retiro_paciente = $Busca_temp['pacientes_fecha_retiro_paciente']; 
       $tmp_pos = strpos($this->pacientes_fecha_retiro_paciente, "##@@");
       if ($tmp_pos !== false)
       {
           $this->pacientes_fecha_retiro_paciente = substr($this->pacientes_fecha_retiro_paciente, 0, $tmp_pos);
       }
   } 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['where_pesq_filtro'];
   $temp = "";
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['SC_Gb_Free_sql'] as $cmp_gb => $ord)
   {
       $temp .= (empty($temp)) ? $cmp_gb . " " . $ord : ", " . $cmp_gb . " " . $ord;
   }
   $nmgp_order_by = (!empty($temp)) ? " order by " . $temp : "";
   $free_group_by = "";
   $all_sql_free  = array();
   $all_sql_free[] = "pacientes.ID_PACIENTE";
   $all_sql_free[] = "pacientes.ESTADO_PACIENTE";
   $all_sql_free[] = "pacientes.MOTIVO_RETIRO_PACIENTE";
   $all_sql_free[] = "pacientes.GENERO_PACIENTE";
   $all_sql_free[] = "tratamiento.PRODUCTO_TRATAMIENTO";
   $all_sql_free[] = "tratamiento.MEDICO_TRATAMIENTO";
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['SC_Gb_Free_sql'] as $cmp_gb => $ord)
   {
       $free_group_by .= (empty($free_group_by)) ? $cmp_gb : ", " . $cmp_gb;
   }
   foreach ($all_sql_free as $cmp_gb)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['SC_Gb_Free_sql'][$cmp_gb]))
       {
           $free_group_by .= (empty($free_group_by)) ? $cmp_gb : ", " . $cmp_gb;
       }
   }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
         $comando  = "select count(*), pacientes.ID_PACIENTE, pacientes.ESTADO_PACIENTE, pacientes.MOTIVO_RETIRO_PACIENTE, pacientes.GENERO_PACIENTE, tratamiento.PRODUCTO_TRATAMIENTO, tratamiento.MEDICO_TRATAMIENTO from " . $this->Ini->nm_tabela . " " .  $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $comando  = "select count(*), pacientes.ID_PACIENTE, pacientes.ESTADO_PACIENTE, pacientes.MOTIVO_RETIRO_PACIENTE, pacientes.GENERO_PACIENTE, tratamiento.PRODUCTO_TRATAMIENTO, tratamiento.MEDICO_TRATAMIENTO from " . $this->Ini->nm_tabela . " " .  $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
         $comando  = "select count(*), pacientes.ID_PACIENTE, pacientes.ESTADO_PACIENTE, pacientes.MOTIVO_RETIRO_PACIENTE, pacientes.GENERO_PACIENTE, tratamiento.PRODUCTO_TRATAMIENTO, tratamiento.MEDICO_TRATAMIENTO from " . $this->Ini->nm_tabela . " " . $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
      } 
      else 
      { 
         $comando  = "select count(*), pacientes.ID_PACIENTE, pacientes.ESTADO_PACIENTE, pacientes.MOTIVO_RETIRO_PACIENTE, pacientes.GENERO_PACIENTE, tratamiento.PRODUCTO_TRATAMIENTO, tratamiento.MEDICO_TRATAMIENTO from " . $this->Ini->nm_tabela . " " . $this->sc_where_atual . " group by " . $free_group_by . "  " . $nmgp_order_by;
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
         $pacientes_id_paciente      = $registro[1];
         $pacientes_id_paciente_orig = $registro[1];
         $conteudo = $registro[1];
         $pacientes_id_paciente = $conteudo;
         if (null === $pacientes_id_paciente)
         {
             $pacientes_id_paciente = '';
         }
         if (null === $pacientes_id_paciente_orig)
         {
             $pacientes_id_paciente_orig = '';
         }
         $val_grafico_pacientes_id_paciente = $pacientes_id_paciente;
         $pacientes_estado_paciente      = $registro[2];
         $pacientes_estado_paciente_orig = $registro[2];
         $conteudo = $registro[2];
         $pacientes_estado_paciente = $conteudo;
         if (null === $pacientes_estado_paciente)
         {
             $pacientes_estado_paciente = '';
         }
         if (null === $pacientes_estado_paciente_orig)
         {
             $pacientes_estado_paciente_orig = '';
         }
         $val_grafico_pacientes_estado_paciente = $pacientes_estado_paciente;
         $pacientes_motivo_retiro_paciente      = $registro[3];
         $pacientes_motivo_retiro_paciente_orig = $registro[3];
         $conteudo = $registro[3];
         $pacientes_motivo_retiro_paciente = $conteudo;
         if (null === $pacientes_motivo_retiro_paciente)
         {
             $pacientes_motivo_retiro_paciente = '';
         }
         if (null === $pacientes_motivo_retiro_paciente_orig)
         {
             $pacientes_motivo_retiro_paciente_orig = '';
         }
         $val_grafico_pacientes_motivo_retiro_paciente = $pacientes_motivo_retiro_paciente;
         $pacientes_genero_paciente      = $registro[4];
         $pacientes_genero_paciente_orig = $registro[4];
         $conteudo = $registro[4];
         $pacientes_genero_paciente = $conteudo;
         if (null === $pacientes_genero_paciente)
         {
             $pacientes_genero_paciente = '';
         }
         if (null === $pacientes_genero_paciente_orig)
         {
             $pacientes_genero_paciente_orig = '';
         }
         $val_grafico_pacientes_genero_paciente = $pacientes_genero_paciente;
         $tratamiento_producto_tratamiento      = $registro[5];
         $tratamiento_producto_tratamiento_orig = $registro[5];
         $conteudo = $registro[5];
         $tratamiento_producto_tratamiento = $conteudo;
         if (null === $tratamiento_producto_tratamiento)
         {
             $tratamiento_producto_tratamiento = '';
         }
         if (null === $tratamiento_producto_tratamiento_orig)
         {
             $tratamiento_producto_tratamiento_orig = '';
         }
         $val_grafico_tratamiento_producto_tratamiento = $tratamiento_producto_tratamiento;
         $tratamiento_medico_tratamiento      = $registro[6];
         $tratamiento_medico_tratamiento_orig = $registro[6];
         $conteudo = $registro[6];
         $tratamiento_medico_tratamiento = $conteudo;
         if (null === $tratamiento_medico_tratamiento)
         {
             $tratamiento_medico_tratamiento = '';
         }
         if (null === $tratamiento_medico_tratamiento_orig)
         {
             $tratamiento_medico_tratamiento_orig = '';
         }
         $val_grafico_tratamiento_medico_tratamiento = $tratamiento_medico_tratamiento;
         $contr_arr = "";
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['lis_pacientes']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
         {
             $temp       = $cmp_gb . "_orig";
             $contr_arr .= "['" . $$temp . "']";
             $arr_name   = "array_total_" . $cmp_gb . $contr_arr;
            eval ('
             if (!isset($' . $arr_name . '))
             {
                 $' . $arr_name . '[0] = ' . $registro[0] . ';
                 $' . $arr_name . '[1] = $val_grafico_' . $cmp_gb . ';
                 $' . $arr_name . '[2] = "' . $$temp . '";
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

<?php

class Informe_reclamacion_historial_res_csv
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $array_titulos;
   var $array_linhas;

   var $arquivo;
   var $tit_doc;
   var $delim_dados;
   var $delim_line;
   var $delim_col;
   var $sc_proc_grid; 

   //---- 
   function Informe_reclamacion_historial_csv()
   {
      $this->nm_data   = new nm_data("es");
   }

   //---- 
   function monta_csv()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
      $this->array_titulos = array();
      $this->array_linhas  = array();
      $this->arquivo       = "sc_csv";
      $this->arquivo      .= "_" . date('YmdHis') . "_" . rand(0, 1000);
      $this->arquivo      .= "_Informe_reclamacion_historial";
      $this->arquivo      .= ".csv";
      $this->tit_doc    = "Informe_reclamacion_historial.csv";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['csv_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['csv_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['csv_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['csv_name']);
      }
      $this->Res           = new Informe_reclamacion_historial_resumo("out");
      $this->prep_modulos("Res");
      $this->delim_dados = "\"";
      $this->delim_col   = ";";
      $this->delim_line  = "\r\n";
   }

   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   //----- 
   function grava_arquivo()
   {
      $csv_f      = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo, "w");
      $this->Res->resumo_export();
      $this->array_titulos = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['arr_export']['label'];
      $this->array_linhas  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['arr_export']['data'];
      $this->comp_y_axys  = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pivot_y_axys'];
      $this->comp_tabular = $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['pivot_tabular'];
      if (1 >= sizeof($this->comp_y_axys))
      {
          $this->comp_tabular = false;
      }
      $this->grava_titulos($csv_f);
      $this->control_lines = array();
      foreach ($this->array_linhas as $lines)
      {
         $this->grava_linha($csv_f, $lines);
      }
      fclose($csv_f);
   }

   function grava_titulos($csv_f)
   {
      $b_display = false;
      $contr_rowspan = array();
      $contr_colspan = array();
      foreach ($this->array_titulos as $lines)
      {
           $csv_registro = "";
           $col = 0;
           if (!$b_display)
           {
               $colspan = $this->comp_tabular ? sizeof($this->comp_y_axys) : 1;
               $contr_rowspan[$col] = sizeof($this->array_titulos);
               $contr_colspan[$col] = $colspan;
               $campo_titulo = $this->Ini->Nm_lang['lang_othr_smry_msge'];
               if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($campo_titulo))
               {
                   $campo_titulo = sc_convert_encoding($campo_titulo, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $csv_registro .= $this->delim_dados . str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $campo_titulo) . $this->delim_dados;
               if ($colspan > 1)
               {
                   for ($x = 1; $x < $colspan; $x++)
                   {
                       $csv_registro .= $this->delim_col . $this->delim_dados . $this->delim_dados;
                   }
               }
               $b_display = true;
               $col += $colspan;
           }
           foreach ($lines as $columns)
           {
               $col_ok = false;
               $colspan = (isset($columns['colspan']) && 1 < $columns['colspan']) ? $columns['colspan'] : 1;
               while (!$col_ok)
               {
                   $prim = true;
                   if (isset($contr_rowspan[$col]) && 1 < $contr_rowspan[$col])
                   {
                       $contr_rowspan[$col]--;
                       $col_sp = $contr_colspan[$col];
                       for ($x = 0; $x < $col_sp; $x++)
                       {
                           if (!$prim)
                           {
                               $csv_registro .= $this->delim_col;
                           }
                           $csv_registro .= $this->delim_dados . $this->delim_dados;
                           $col ++;
                           $prim = false;
                       }
                   }
                   else
                   {
                       $col_ok = true;
                   }
               }
               if (isset($columns['rowspan']) && 1 < $columns['rowspan'])
               {
                   $contr_rowspan[$col] = $columns['rowspan'];
                   $contr_colspan[$col] = $colspan;
               }
               $campo_titulo = $columns['label'];
               if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($campo_titulo))
               {
                   $campo_titulo = sc_convert_encoding($campo_titulo, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $csv_registro .= $this->delim_col . $this->delim_dados . str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $campo_titulo) . $this->delim_dados;
               if ($colspan > 1)
               {
                   for ($x = 1; $x < $colspan; $x++)
                   {
                       $csv_registro .= $this->delim_col . $this->delim_dados . $this->delim_dados;
                   }
               }
               $col += $colspan;
           }
           foreach ($contr_rowspan as $col_t => $row)
           {
               if ($col_t >= $col && $row > 1)
               {
                   $contr_rowspan[$col]--;
               }
           }
           $csv_registro .= $this->delim_line;
           fwrite($csv_f, $csv_registro);
      }
   }
   function grava_linha($csv_f, $lines)
   {
       $csv_registro = "";
       $prim = true;
       $col     = 0;
       $colspan = 0;
       foreach ($lines as $ind => $columns)
       {
           $col = $ind + $colspan;
           if (isset($columns['colspan']) && $columns['colspan'] > 0)
           {
              $colspan = $columns['colspan'] - 1;
           }
           if (0 <= $columns['level'])
           {
              $cada_dado = $columns['label'];
           }
           else
           {
               $cada_dado = $columns['value'];
           }
           $cada_dado = str_replace("&nbsp;", "", $cada_dado);
           if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($cada_dado))
           {
               $cada_dado = sc_convert_encoding($cada_dado, "UTF-8", $_SESSION['scriptcase']['charset']);
           }
           $cada_dado = $this->delim_dados . str_replace($this->delim_dados, $this->delim_dados . $this->delim_dados, $cada_dado) . $this->delim_dados;
           if ($prim)
           {
               for ($x = ($ind + 1); $x < count($this->control_lines); $x++)
               {
                   $this->control_lines[$x] = $this->delim_dados . $this->delim_dados;
               }
               $prim = false;
           }
           $this->control_lines[$col] = $cada_dado;
       }
       $csv_registro = implode($this->delim_col, $this->control_lines) . $this->delim_line;
       fwrite($csv_f, $csv_registro);
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
      global $nm_url_saida;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Informe_reclamacion_historial'][$path_doc_md5][1] = $this->tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML>
<HEAD>
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
</HEAD>
<BODY>
<SCRIPT>
    window.location='<?php echo $this->Ini->path_imag_temp . "/" . $this->arquivo; ?>';
</SCRIPT>
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

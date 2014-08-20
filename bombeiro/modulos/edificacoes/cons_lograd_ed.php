<?
 include ('../../templates/head_erro.htm');
?>
<?
  $arquivo="protocolo.php";
  require_once 'lib/loader.php';
  // incluindo a classe
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
// campo de seleção
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  // executando a consulta
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  }
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

  if (isset($_GET["txt_nm_logradouro"])) {
    if (isset($_GET["hdn_limit"])) {
      $limit=$_GET["hdn_limit"];
    } else {
      $limit=0;
    }
    $restringir=10;
    /*
    $sql="SELECT ID_BATALHAO,ID_COMPANIA,ID_PELOTAO,ID_GRUPAMENTO FROM ".TBL_USUARIO." WHERE ID_USUARIO='".$usuario."'";
    $conn->query($sql);
    $lotacao = $conn->fetch_row();
    */
    $NM_LOGRADOURO=$_GET["txt_nm_logradouro"];
    $ID_CIDADE=$_GET["hdn_id_cidade"];
    if ($NM_LOGRADOURO!="") {
      $NM_FONETICA=nr_txt_fonetica($NM_LOGRADOURO);
    } else {
      $NM_FONETICA="";
    }
    if ($NM_FONETICA!="") {
      if ((!isset($_GET["hdn_fim"]))||(@$_GET["hdn_fim"]=="")) {
        $query="SELECT ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO,NM_BAIRROS,ID_CEP,".TBL_LOGRADOURO.".ID_CIDADE ID_CIDADE,NM_CIDADE, ".TBL_CEP.".CH_AGUARDO AS CH_AGUARDO_CEP, ".TBL_LOGRADOURO.".CH_AGUARDO AS CH_AGUARDO_LOG, ".TBL_BAIRROS.".CH_AGUARDO AS CH_AGUARDO_BAIRRO FROM ".TBL_LOGRADOURO." LEFT JOIN ".TBL_CIDADE." ON (".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_LOGRADOURO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CEP.".ID_CIDADE) LEFT JOIN ".TBL_UF." ON (".TBL_CIDADE.".ID_UF=".TBL_UF.".ID_UF) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_LOGRADOURO.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_LOGRADOURO.".ID_CIDADE=$ID_CIDADE AND ".TBL_LOGRADOURO.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO ='".$usuario."')";
        $conn->query($query);
        if ($conn->get_status()==false) {
          die($conn->get_msg());
        }
        $rows=$conn->num_rows();
        $fim=(ceil($rows/$restringir)-1);
      } else {
        $fim=$_GET["hdn_fim"];
      }
      if ($fim<1) {
        $fim="";
      }
      if ($limit=="") {
        $limit=0;
      }
      $query="SELECT ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO,".TBL_LOGRADOURO.".ID_BAIRROS ID_BAIRROS,NM_BAIRROS,ID_CEP,".TBL_LOGRADOURO.".ID_CIDADE ID_CIDADE,NM_CIDADE, ".TBL_CEP.".CH_AGUARDO AS CH_AGUARDO_CEP, ".TBL_LOGRADOURO.".CH_AGUARDO AS CH_AGUARDO_LOG, ".TBL_BAIRROS.".CH_AGUARDO AS CH_AGUARDO_BAIRRO FROM ".TBL_LOGRADOURO." LEFT JOIN ".TBL_CIDADE." ON (".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_LOGRADOURO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CEP.".ID_CIDADE) LEFT JOIN ".TBL_UF." ON (".TBL_CIDADE.".ID_UF=".TBL_UF.".ID_UF) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_LOGRADOURO.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_LOGRADOURO.".ID_CIDADE=$ID_CIDADE AND ".TBL_LOGRADOURO.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO ='".$usuario."') LIMIT ".$limit." , 10";
    } else {
      $fim="";
      $limit=0;
      $query="SELECT ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO,".TBL_LOGRADOURO.".ID_BAIRROS ID_BAIRROS,NM_BAIRROS,ID_CEP,".TBL_LOGRADOURO.".ID_CIDADE ID_CIDADE,NM_CIDADE, ".TBL_CEP.".CH_AGUARDO AS CH_AGUARDO_CEP, ".TBL_LOGRADOURO.".CH_AGUARDO AS CH_AGUARDO_LOG, ".TBL_BAIRROS.".CH_AGUARDO AS CH_AGUARDO_BAIRRO FROM ".TBL_LOGRADOURO." LEFT JOIN ".TBL_CIDADE." ON (".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_LOGRADOURO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CEP.".ID_CIDADE) LEFT JOIN ".TBL_UF." ON (".TBL_CIDADE.".ID_UF=".TBL_UF.".ID_UF) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_LOGRADOURO.".ID_LOGRADOURO=0 AND ".TBL_LOGRADOURO.".ID_CIDADE=$ID_CIDADE AND ".TBL_LOGRADOURO.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO ='".$usuario."') LIMIT ".$limit." , 10";
    }

    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
//     echo "aqui:$rows\n";
?>
<body>
<script language="javascript" type="text/javascript">//<!--
function sbmit () {
  document.form1.hdn_limit.value=0;
  document.form1.hdn_fim.value="";
  window.document.form1.submit();
}
function consulta_ret(id_prefixo,id_logradouro,nm_logradouro,id_bairros,nm_bairros,id_cep,id_cidade,ch_aguardo) {
  var frm=window.opener.document.frm_edificacao;
  frm.cmb_id_tp_prefixo.value=id_prefixo;
  frm.hdn_id_logradouro.value=id_logradouro;
  frm.txt_nm_logradouro.value=nm_logradouro;
  frm.hdn_id_bairro.value=id_bairros;
  frm.txt_nm_bairro.value=nm_bairros;
  frm.txt_id_cep.value=id_cep;
  CEP(frm.txt_id_cep);
  //frm.cmb_id_cidade.value=id_cidade;
  
  //radio_ed(window.opener.document.frm_protocolo.rdo_guarda_logradouro,ch_aguardo);
  frm.txt_nm_complemento.focus();
  //window.open("?campo="+reg,"consulusr","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
  window.close();
}
//-->
</script>
<?
 include ('../../templates/cab.htm');
?>
<form method="GET" target="_self" name="form1">
<fieldset>
<legend>Consulta Logradouro</legend>
<table width="90%" cellspacing="0" border="0" cellpadding="5" align="center">
  <tr valign="center">
    <td>Logradouro</td>
    <td><input type="text" size="50" maxlength="100" class="campo_obr" value="<?=$NM_LOGRADOURO?>" name="txt_nm_logradouro">
        <input type="hidden" name="hdn_limit" value="">
        <input type="hidden" name="hdn_fim" value="<?=$fim?>">
        <input type="hidden" name="hdn_id_cidade" value="<?=$ID_CIDADE?>">
    </td>
    <td><input type="button" name="btn_consulta" value="Consulta" title="Nova Consulta" class="botao" style="background-image : url('../../imagens/botao.gif');" onclick="sbmit()"></td>
  </tr>
  <tr valign="center">
    <td colspan="3">
<?
    if ($rows>0) {
?>
<table width="100%" cellspacing="0" border="1" cellpadding="0" align="center">
  <tr>
    <th>LOGRADOURO</th>
    <th>BAIRRO</th>
    <th>CEP</th>
    <th>MUNICÍPIO</th>
    <th>LOGRADOURO NÃO CONFIRMADO</th>
  </tr>
<!-- <? var_dump($tupula); ?> -->
<?
        while ($tupula = $conn->fetch_row()) {
        echo "<!--\n";
        var_dump($tupula);
        echo "\n-->\n";

          if (($tupula["CH_AGUARDO_CEP"]=="S")||($tupula["CH_AGUARDO_LOG"]=="S")||($tupula["CH_AGUARDO_BAIRRO"]=="S")) {
            $CH_AGUARDO="S";
          } else {
            $CH_AGUARDO="N";
          }
?>
  <tr>
    <td><a href="javascript:consulta_ret('<?=$tupula["ID_TP_LOGRADOURO"]?>','<?=$tupula["ID_LOGRADOURO"]?>','<?=$tupula["NM_LOGRADOURO"]?>','<?=$tupula["ID_BAIRROS"]?>','<?=$tupula["NM_BAIRROS"]?>','<?=$tupula["ID_CEP"]?>','<?=$tupula["ID_CIDADE"]?>','<?=$CH_AGUARDO?>')"><?=$tupula["NM_LOGRADOURO"];?></a></td>
    <td><a href="javascript:consulta_ret('<?=$tupula["ID_TP_LOGRADOURO"]?>','<?=$tupula["ID_LOGRADOURO"]?>','<?=$tupula["NM_LOGRADOURO"]?>','<?=$tupula["ID_BAIRROS"]?>','<?=$tupula["NM_BAIRROS"]?>','<?=$tupula["ID_CEP"]?>','<?=$tupula["ID_CIDADE"]?>','<?=$CH_AGUARDO?>')"><?=$tupula["NM_BAIRROS"];?></a></td>
    <td><a href="javascript:consulta_ret('<?=$tupula["ID_TP_LOGRADOURO"]?>','<?=$tupula["ID_LOGRADOURO"]?>','<?=$tupula["NM_LOGRADOURO"]?>','<?=$tupula["ID_BAIRROS"]?>','<?=$tupula["NM_BAIRROS"]?>','<?=$tupula["ID_CEP"]?>','<?=$tupula["ID_CIDADE"]?>','<?=$CH_AGUARDO?>')"><?=formatCEP($tupula["ID_CEP"]);?></a></td>
    <td><a href="javascript:consulta_ret('<?=$tupula["ID_TP_LOGRADOURO"]?>','<?=$tupula["ID_LOGRADOURO"]?>','<?=$tupula["NM_LOGRADOURO"]?>','<?=$tupula["ID_BAIRROS"]?>','<?=$tupula["NM_BAIRROS"]?>','<?=$tupula["ID_CEP"]?>','<?=$tupula["ID_CIDADE"]?>','<?=$CH_AGUARDO?>')"><?=$tupula["NM_CIDADE"];?></a></td>
    <td><a href="javascript:consulta_ret('<?=$tupula["ID_TP_LOGRADOURO"]?>','<?=$tupula["ID_LOGRADOURO"]?>','<?=$tupula["NM_LOGRADOURO"]?>','<?=$tupula["ID_BAIRROS"]?>','<?=$tupula["NM_BAIRROS"]?>','<?=$tupula["ID_CEP"]?>','<?=$tupula["ID_CIDADE"]?>','<?=$CH_AGUARDO?>')"><?=$CH_AGUARDO?></a></td>
  </tr>
<?
        }
        $limit_ant=$limit-$restringir;
        $limit+=$restringir;
?>
<script language="javascript" type="text/javascript">//<!--
function envia(tipo) {
  switch (tipo) {
    case 1:
      document.form1.hdn_limit.value='0';
      break;
    case 2:
      document.form1.hdn_limit.value='<?=$limit_ant?>';
      break;
    case 3:
      document.form1.hdn_limit.value='<?=$limit?>';
      break;
    case 4:
      document.form1.hdn_limit.value='<?=$fim?>';
      break;
  }
  document.form1.submit();
}
//-->
</script>
  <input type="hidden" name="hdn_limit" value="">
  <input type="hidden" name="hdn_fim" value="<?=$fim?>">
<table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
  <tr>
<?
      if ($limit_ant>=0) {
?>
    <td><input type="button" value="Primeiro" name="btn_primeiro" title="Primeiros 10 Registros" onclick="envia(1)"></td>
    <td><input type="button" value="Anterior" name="btn_anterior" title="10 Registros Anteriores" onclick="envia(2)"></td>
<?
      } else {
?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
<?
      }
      if ($fim>=$limit) {
?>
    <td>
    <input type="button" value="Próximo" name="btn_proximo" title="Próximos 10 Registros" onclick="envia(3)">
    </td>
    <td><input type="button" value="Último" name="btn_ultimo" title="Últimos 10 Registros" onclick="envia(4)"></td>
<?
      } else {
?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
<?
      }
?>
  </tr>
</table>
</table>
</td>
  </tr>
</table>
<?
    } else {
?>
<script language="javascript" type="text/javascript">
//<!--
  alert("Registros não encontrados!!!");
  <?="//".$NM_FONETICA?>
  ///window.close();
// -->
</script>
<?
    }
?>
</fieldset>
</form>
<?
  } 
?>
</body>
</html>

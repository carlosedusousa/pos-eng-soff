<?
 include ('../../templates/head_erro.htm');
?>
<?
  $arquivo="cad_logradouro.php";
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
        $query="SELECT ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO FROM ".TBL_LOGRADOURO." WHERE ".TBL_LOGRADOURO.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_LOGRADOURO.".ID_CIDADE=$ID_CIDADE";
        $conn->query($query);
        if ($conn->get_status()==false) {
          die($conn->get_msg());
        }
        $rows=$conn->num_rows();
        $fim=(ceil($rows/$restringir)-1);
      }
      if ($fim<1) {
        $fim="";
      }
      if ($limit=="") {
        $limit=0;
      }
      $query="SELECT ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO FROM ".TBL_LOGRADOURO." WHERE ".TBL_LOGRADOURO.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_LOGRADOURO.".ID_CIDADE=$ID_CIDADE ORDER BY NM_LOGRADOURO LIMIT ".$limit." , 10";
    } else {
      $fim="";
      $limit=0;
      $query="SELECT ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO FROM ".TBL_LOGRADOURO." WHERE ".TBL_LOGRADOURO.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_LOGRADOURO.".ID_CIDADE=$ID_CIDADE ORDER BY NM_LOGRADOURO  LIMIT ".$limit." , 10";
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
function consulta_ret(id_prefixo,id_logradouro,nm_logradouro) {
  var frm=window.opener.document.frm_cad_logradouro;
  frm.cmb_id_tp_logradouro.value=id_prefixo;
  frm.hdn_id_logradouro.value=id_logradouro;
  frm.txt_nm_logradouro.value=nm_logradouro;
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
    <td>
        <input type="hidden" name="hdn_id_cidade" value="<?=$ID_CIDADE?>">
        <input type="text" size="50" maxlength="100" class="campo_obr" value="<?=$NM_LOGRADOURO?>" name="txt_nm_logradouro">
        <input type="hidden" name="hdn_limit" value="">
        <input type="hidden" name="hdn_fim" value="<?=$fim?>">
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
    <th>CÓDIGO LOGRADOURO</th>
    <th>LOGRADOURO</th>
  </tr>
<!-- <? var_dump($tupula); ?> -->
<?
        while ($tupula = $conn->fetch_row()) {
        echo "<!--\n";
        var_dump($tupula);
        echo "\n-->\n";
?>
  <tr>
    <td><a href="javascript:consulta_ret('<?=$tupula["ID_TP_LOGRADOURO"]?>','<?=$tupula["ID_LOGRADOURO"]?>','<?=$tupula["NM_LOGRADOURO"]?>')"><?=$tupula["ID_LOGRADOURO"];?></a></td>
    <td><a href="javascript:consulta_ret('<?=$tupula["ID_TP_LOGRADOURO"]?>','<?=$tupula["ID_LOGRADOURO"]?>','<?=$tupula["NM_LOGRADOURO"]?>')"><?=$tupula["NM_LOGRADOURO"];?></a></td>
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
  <tr><td colspan="4">
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
</td>
</tr>
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

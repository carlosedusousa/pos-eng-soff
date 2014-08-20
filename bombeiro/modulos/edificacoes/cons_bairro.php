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

  if (isset($_GET["txt_nm_bairros"])) {
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
    $NM_BAIRROS=$_GET["txt_nm_bairros"];
    if ($NM_BAIRROS!="") {
      $NM_FONETICA=nr_txt_fonetica($NM_BAIRROS);
    } else {
      $NM_FONETICA="";
    }
    if ($NM_FONETICA!="") {
      if ((!isset($_GET["hdn_fim"]))||(@$_GET["hdn_fim"]=="")) {
        $query="SELECT ".TBL_BAIRROS.".ID_BAIRROS, ".TBL_BAIRROS.".NM_BAIRROS, IF(".TBL_BAIRROS.".CH_AGUARDO='N','NÃO','SIM') AS CH_AGUARDO FROM ".TBL_BAIRROS." WHERE ".TBL_BAIRROS.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_BAIRROS.".ID_CIDADE=".$_GET["hdn_id_cidade"];
        $conn->query($query);
        if ($conn->get_status()==false) {
          die($conn->get_msg());
        }
        $rows=$conn->num_rows();
        $fim=(ceil($rows/$restringir)-1);
      } else {
        $fim=$_GET["hdn_fim"];
      }
      echo "<!--aqui :".@$fim."|".@$rows."/".@$restringir."|==>".@$query."-->\n";
      if (@$fim<1) {
        $fim="";
      }
      if ($limit=="") {
        $limit=0;
      }
      $query="SELECT ".TBL_BAIRROS.".ID_BAIRROS, ".TBL_BAIRROS.".NM_BAIRROS, IF(".TBL_BAIRROS.".CH_AGUARDO='N','NÃO','SIM') AS CH_AGUARDO FROM ".TBL_BAIRROS." WHERE ".TBL_BAIRROS.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_BAIRROS.".ID_CIDADE=".$_GET["hdn_id_cidade"]." ORDER BY ".TBL_BAIRROS.".NM_BAIRROS LIMIT ".$limit." , 10";
    } else {
      $fim="";
      $limit=0;
      $query="SELECT ".TBL_BAIRROS.".ID_BAIRROS, ".TBL_BAIRROS.".NM_BAIRROS, IF(".TBL_BAIRROS.".CH_AGUARDO='N','NÃO','SIM') AS CH_AGUARDO FROM ".TBL_BAIRROS." WHERE ".TBL_BAIRROS.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_BAIRROS.".ID_CIDADE=".$_GET["hdn_id_cidade"]." ORDER BY ".TBL_BAIRROS.".NM_BAIRROS LIMIT ".$limit." , 10";
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
  if (document.form1.hdn_nome.value!=document.form1.txt_nm_bairros.value) {
    document.form1.hdn_limit.value=0;
    document.form1.hdn_fim.value="";
  }
  window.document.form1.submit();
}
function consulta_ret(id_bairros,nm_bairros) {
  var frm=window.opener.document.frm_cad_logradouro;
  frm.hdn_id_bairro.value=id_bairros;
  frm.txt_nm_bairro.value=nm_bairros;
  if (frm.hdn_id_logradouro.value!="") {
    alert("ATENÇÃO NOVO BAIRRO SERÁ CADASTROS PARA O LOGRADOURO SELECIONADO!!");
  }
//  radio_ed(window.opener.document.frm_cad_logradouro.rdo_guarda_logradouro,ch_aguardo);
//  frm.txt_nm_complemento.focus();
  //window.open("?campo="+reg,"consulusr","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
  window.close();
}

//-->
</script>
<?
 include ('../../templates/cab.htm');
?>
<form method="GET" target="_self" name="form1" onsubmit="sbmit()">
<fieldset>
<legend>Consulta Logradouro</legend>
<table width="90%" cellspacing="0" border="0" cellpadding="5" align="center">
  <tr valign="center">
    <td>Logradouro</td>
    <td><input type="text" size="50" maxlength="100" class="campo_obr" value="<?=$NM_BAIRROS?>" name="txt_nm_bairros">
        <input type="hidden" name="hdn_limit" value="">
        <input type="hidden" name="hdn_fim" value="<?=$fim?>">
        <input type="hidden" name="hdn_nome" value="<?=$NM_BAIRROS?>">
        <input type="hidden" name="hdn_id_cidade" value="<?=$_GET["hdn_id_cidade"]?>">
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
    <th>BAIRRO</th>
    <th>AGUARDA VALIDAÇÃO</th>
  </tr>
<?
        while ($tupula = $conn->fetch_row()) {
?>
  <tr>
    <td><a href="javascript:consulta_ret('<?=$tupula["ID_BAIRROS"]?>','<?=$tupula["NM_BAIRROS"]?>')"><?=$tupula["NM_BAIRROS"];?></a></td>
    <td><a href="javascript:consulta_ret('<?=$tupula["ID_BAIRROS"]?>','<?=$tupula["NM_BAIRROS"]?>')"><?=$tupula["CH_AGUARDO"];?></a></td>
  </tr>
<?
        }
        $limit_ant=$limit-$restringir;
        $limit+=$restringir;
?>
<script language="javascript" type="text/javascript">
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
      document.form1.hdn_limit.value='<?=$fim*10?>';
      break;
  }
  document.form1.submit();
}
</script>
<!--  <input type="hidden" name="hdn_limit" value="">
  <input type="hidden" name="hdn_fim" value="<?=$fim?>">-->
<table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
  <tr>
<?
      if ($limit_ant>=0) {
?>
    <td><input type="button" value="Primeiro" name="btn_primeiro" title="Primeiros 10 Registros" onclick="envia(1)" class="botao" style="background-image : url('../../imagens/botao.gif');"></td>
    <td><input type="button" value="Anterior" name="btn_anterior" title="10 Registros Anteriores" onclick="envia(2)" class="botao" style="background-image : url('../../imagens/botao.gif');"></td>
<?
      } else {
?>
    <td><input type="button" value="Primeiro" name="btn_primeiro" title="Primeiros 10 Registros" onclick="envia(1)" class="botao" style="background-image : url('../../imagens/botao.gif');visibility:hidden;" disabled="true"></td>
    <td><input type="button" value="Anterior" name="btn_anterior" title="10 Registros Anteriores" onclick="envia(2)" class="botao" style="background-image : url('../../imagens/botao.gif');visibility:hidden;" disabled="true"></td>
<?
      }
      if (($fim*10)>=$limit) {
?>
    <td>
    <input type="button" value="Próximo" name="btn_proximo" title="Próximos 10 Registros" onclick="envia(3)" class="botao" style="background-image : url('../../imagens/botao.gif');">
    </td>
    <td><input type="button" value="Último" name="btn_ultimo" title="Últimos 10 Registros" onclick="envia(4)" class="botao" style="background-image : url('../../imagens/botao.gif');"></td>
<?
      } else {
?>
    <td>
    <input type="button" value="Próximo" name="btn_proximo" title="Próximos 10 Registros" onclick="envia(3)" class="botao" style="background-image : url('../../imagens/botao.gif');visibility:hidden;" disabled="true">
    </td>
    <td><input type="button" value="Último" name="btn_ultimo" title="Últimos 10 Registros" onclick="envia(4)" class="botao" style="background-image : url('../../imagens/botao.gif');visibility:hidden;" disabled="true"></td>

<!--    <td width="50">&nbsp;</td>
    <td width="50">&nbsp;</td>-->
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

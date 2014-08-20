<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?
  if ((@$_POST["hdn_from"]!="")&&(@$_POST["hdn_campo"]!="")&&(@$_POST["hdn_desc_campos"]!="")&&(@$_POST["hdn_arquivo"]!="")&&(@$_POST["hdn_bd"]!="")&&(@$_POST["hdn_where"]!="")&&(@$_POST["hdn_arq_envio"]!="")&&(@$_POST["hdn_chave"]!="")) {
?>
<form method="POST" target="_self" name="form1">
<?
    $chave=$_POST["hdn_chave"];
    $arq_envio=$_POST["hdn_arq_envio"];
//echo "arquivo: ".$arq_envio;
    $restringir=1;
    $arquivo=$_POST["hdn_arquivo"];
    require_once 'lib/loader.php';
    // incluindo a classe
    $BD=$_POST["hdn_bd"];
    $conn= new BD (BD_HOST, BD_USER, BD_PASS, $BD);
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
// campo de seleção
    $desc_campos=explode(",",$_POST["hdn_desc_campos"]);
    //=strtoupper($_POST["campo"]);
    $from=$_POST["hdn_from"];
    if (isset($_POST["hdn_cp_asso"])) {
      $campos=explode(",",$_POST["hdn_cp_asso"]);
    } else {
      $campos=explode(",",$_POST["hdn_campo"]);
    }
    $cp_asso=implode(",",$campos);
    $where=$_POST["hdn_where"];
    if (isset($_POST["hdn_limit"])) {
      $limit=$_POST["hdn_limit"];
    } else {
      $limit=0;
    }
    if (!isset($_POST["hdn_fim"])) {
      $query="SELECT ".$_POST["hdn_campo"]." FROM ".$from." WHERE ".$where;
      $conn->query($query);
      if ($conn->get_status()==false) {
        die($conn->get_msg());
      }
      $rows=$conn->num_rows();
      $fim=(ceil($rows/$restringir)-1);
    } else {
      $fim=$_POST["hdn_fim"];
    }
    $query="SELECT ".$_POST["hdn_campo"]." FROM ".$from." WHERE ".$where." LIMIT ".$limit." , 1";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
//     echo "aqui:$rows\n";
    if ($rows>0) {
?>
<table width="90%" cellspacing="5" border="1" cellpadding="0" align="center">
  <tr>
<?
        for ($i=0;$i<count($desc_campos);$i++) {
?>
    <th><?=$desc_campos[$i];?></th>
<?
        }
?>
  </tr>
<?
        while ($tupula = $conn->fetch_row()) {
?>
  <tr>
<?
          for ($i=0;$i<count($campos);$i++) {
?>
    <td><a href="javascript:consulta('<?=$tupula[$chave]?>')"><?=$tupula[$campos[$i]];?></a></td>
<?
          }
?>
  </tr>
<?
        }
        $limit_ant=$limit-$restringir;
        $limit+=$restringir;
?>
<script language="javascript" type="text/javascript">//<!--
function consulta(reg) {
  <?=$arq_envio?>.value=reg;
  <?=$arq_envio?>.focus();
  //window.open("<?=$arq_envio?>?campo="+reg,"consulusr","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
  window.close();
}
function envia(tipo) {
  switch (tipo) {
    case 1:
      document.form1.hdn_limit.value=0;
      break;
    case 2:
      document.form1.hdn_limit.value=<?=$limit_ant?>;
      break;
    case 3:
      document.form1.hdn_limit.value=<?=$limit?>;
      break;
    case 4:
      document.form1.hdn_limit.value=<?=$fim?>;
      break;
  }
  document.form1.submit();
}
//-->
</script>
  <input type="hidden" name="hdn_from" value="<?=$_POST["hdn_from"]?>">
  <input type="hidden" name="hdn_where" value="<?=$_POST["hdn_where"]?>">
  <input type="hidden" name="hdn_campo" value="<?=$_POST["hdn_campo"]?>">
  <input type="hidden" name="hdn_desc_campos" value="<?=$_POST["hdn_desc_campos"]?>">
  <input type="hidden" name="hdn_bd" value="<?=$_POST["hdn_bd"]?>">
  <input type="hidden" name="hdn_arquivo" value="<?=$_POST["hdn_arquivo"]?>">
  <input type="hidden" name="hdn_cp_asso" value="<?=$_POST["hdn_cp_asso"]?>">
  <input type="hidden" name="hdn_limit" value="">
  <input type="hidden" name="hdn_fim" value="<?=$fim?>">
  <input type="hidden" name="hdn_arq_envio" value="<?=$_POST["hdn_arq_envio"]?>">
  <input type="hidden" name="hdn_chave" value="<?=$_POST["hdn_chave"]?>">
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
<?
    } else {
?>
<script language="javascript" type="text/javascript">
//<!--
  alert("Registros não encontrados!!!");
  window.close();
// -->
</script>
<?
    }
?>
</form>
<?
  } elseif ((@$_GET["form"]!="")&& (@$_GET["pre_campo"]!="")&&(count($_POST)<2)) {
?>
<form method="POST" target="_self" name="form1">
  <input type="hidden" name="hdn_from" value="">
  <input type="hidden" name="hdn_where" value="">
  <input type="hidden" name="hdn_campo" value="">
  <input type="hidden" name="hdn_desc_campos" value="">
  <input type="hidden" name="hdn_bd" value="">
  <input type="hidden" name="hdn_arquivo" value="">
  <input type="hidden" name="hdn_cp_asso" value="">
  <input type="hidden" name="hdn_arq_envio" value="">
  <input type="hidden" name="hdn_chave" value="">

<script language="javascript" type="text/javascript">
//<!--
  document.form1.hdn_from.value=window.opener.document.<?=$_GET["form"]?>.<?=$_GET["pre_campo"]?>_from.value;
  var aux = window.opener.document.<?=$_GET["form"]?>.<?=$_GET["pre_campo"]?>_where.value;
  document.form1.hdn_where.value=aux.replace("pesquisa","<?=$_GET["clausula"]?>");
  document.form1.hdn_campo.value=window.opener.document.<?=$_GET["form"]?>.<?=$_GET["pre_campo"]?>_campo.value;
  document.form1.hdn_desc_campos.value=window.opener.document.<?=$_GET["form"]?>.<?=$_GET["pre_campo"]?>_desc_campos.value;
  document.form1.hdn_bd.value=window.opener.document.<?=$_GET["form"]?>.<?=$_GET["pre_campo"]?>_bd.value;
  document.form1.hdn_arquivo.value=window.opener.document.<?=$_GET["form"]?>.<?=$_GET["pre_campo"]?>_arquivo.value;
  document.form1.hdn_cp_asso.value=window.opener.document.<?=$_GET["form"]?>.<?=$_GET["pre_campo"]?>_cp_asso.value;
  document.form1.hdn_arq_envio.value=window.opener.document.<?=$_GET["form"]?>.hdn_arq_envio.value;
  document.form1.hdn_chave.value=window.opener.document.<?=$_GET["form"]?>.hdn_chave.value;
<?

?>
  document.form1.submit();
// -->
</script>
</form>
<?
  } else {
//  var_dump($_POST);
?>
<script language="javascript" type="text/javascript">
//<!--
  alert("Parâmetros Errados");
  window.close();
// -->
</script>
<?
  }
?>
</body>
</html>

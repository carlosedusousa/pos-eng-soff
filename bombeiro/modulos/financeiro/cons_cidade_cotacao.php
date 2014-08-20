<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="JavaScript" type="text/javascript" src="../../js/sigat_div.js"></script>
<body>
<?
  if (@$_GET["campo"]!="") {
    require_once 'lib/loader.php';
    // incluindo a classe
// Conectando ao BD BD ($host, $user, $pass, $db)

  $arquivo="cotacao.php";
  
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  // executando a consulta
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  }

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();
// campo de seleção
    $ID_INDICE=strtoupper($_GET["campo"]);
    $ID_DT_COTACAO=strtoupper($_GET["campo2"]);
    $query="SELECT ".TBL_CIDADE.".ID_CIDADE,".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' AND ".TBL_CIDADE.".ID_CIDADE NOT IN (SELECT ".TBL_COTACAO.".ID_CIDADE FROM ".TBL_COTACAO." WHERE ".TBL_COTACAO.".ID_INDICE=$ID_INDICE AND ".TBL_COTACAO.".ID_DT_COTACAO='$ID_DT_COTACAO') AND ".TBL_CIDADE.".ID_UF IN ('SC') AND ".TBL_CIDADE.".ID_CIDADE>300 ORDER BY ".TBL_CIDADE.".NM_CIDADE";
    echo "aqui:$query\n<br>";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
?>
<script language="javascript" type="text/javascript"><!--
  var frm=window.opener.document.frm_cotacao;
<?
    $rows=$conn->num_rows();
?>
  var from=frm.cmb_id_cidade;
  from.length=0;
<?
    if ($rows>0) {
      $controle=0;
      while ($cidade_escolha = $conn->fetch_row()) {
?>
  from.options[<?=$controle?>]=new Option("<?=$cidade_escolha["NM_CIDADE"]?>","<?=$cidade_escolha["ID_CIDADE"]?>");
<?
        $controle++;
      }
    } else {
?>
  var mx= from.options.length++;
  from.options[mx].value="";
  from.options[mx].text="---------------------------------------------";
<?
    }
    $query_cidade_cotacao="SELECT ".TBL_CIDADE.".ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." JOIN ".TBL_CIDADES_USR." ON (".TBL_CIDADE.".ID_CIDADE=".TBL_CIDADES_USR.".ID_CIDADE) JOIN ".TBL_COTACAO." ON (".TBL_CIDADE.".ID_CIDADE=".TBL_COTACAO.".ID_CIDADE) WHERE ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' AND ".TBL_COTACAO.".ID_INDICE=$ID_INDICE AND ".TBL_COTACAO.".ID_DT_COTACAO='$ID_DT_COTACAO' ORDER BY ".TBL_CIDADE.".NM_CIDADE";
    //echo "//aqui 2:$query_cidade_cotacao\n<br>";
     $conn->query($query_cidade_cotacao);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows_cid_cot=$conn->num_rows();
    if ($rows_cid_cot>0) {
      $controle=0;
?>
  var from=frm.cmb_id_cidade_cotacao;
  from.length=0;
  frm.hdn_id_cidade_cotacao.value="";
<?
      while ($cidade_cotacao = $conn->fetch_row()) {
?>
  from.options[<?=$controle?>]=new Option("<?=$cidade_cotacao["NM_CIDADE"]?>","<?=$cidade_cotacao["ID_CIDADE"]?>");
  frm.hdn_id_cidade_cotacao.value+="<?=$cidade_cotacao["ID_CIDADE"]?>^";
<?
        $controle++;
      }
  }
$quer_cotacao="SELECT ".TBL_COTACAO.".VL_COTACAO FROM ".TBL_COTACAO." WHERE ".TBL_COTACAO.".ID_INDICE=$ID_INDICE AND ".TBL_COTACAO.".ID_DT_COTACAO='$ID_DT_COTACAO'";
      $conn->query($quer_cotacao);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows_cotacao=$conn->num_rows();
    $VL_COTACAO=0;
    if ($rows_cotacao>0) {
    $cotacao = $conn->fetch_row();
    $VL_COTACAO=str_replace(".",",",$cotacao["VL_COTACAO"]);
?>
  frm.txt_vl_cotacao.value="<?=$VL_COTACAO?>";
  FormatNumero(frm.txt_vl_cotacao);
  decimal(frm.txt_vl_cotacao,6);
  frm.btn_incluir.value="Alterar";
  frm.hdn_controle.value="2";
  frm.cmb_id_indice.readOnly=true;
  frm.txt_id_dt_cotacao.readOnly=true;
  
<?
  } else {
?>
  frm.txt_vl_cotacao.value="<?=$VL_COTACAO?>";
  FormatNumero(frm.txt_vl_cotacao);
  decimal(frm.txt_vl_cotacao,6);
/*
  frm.cmb_id_indice.value="";
  frm.txt_id_dt_cotacao.value="";
  frm.btn_incluir.value="Incluir";
  frm.hdn_controle.value="1";
  frm.cmb_id_indice.focus();
  */
<?
  }
  mysql_close();
}
?>
// --></script>
<script language="javascript" type="text/javascript">
//<!--
window.close();
// -->
</script>
</body>
</html>

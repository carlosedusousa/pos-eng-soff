<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?
  if (@$_GET["campo"]!="") {
    require_once 'lib/loader.php';
    // incluindo a classe
// Conectando ao BD BD ($host, $user, $pass, $db)

  $arquivo="indice.php";
  
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
// campo de seleção
    $ID_INDICE=strtoupper($_GET["campo"]);
    $query="SELECT ID_INDICE,NM_INDICE,NM_REDUZ_INDICE,CH_PERIODICIDADE FROM ".TBL_INDICE." WHERE ID_INDICE='".$ID_INDICE."'";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
    if ($rows>0) {
      $tupula = $conn->fetch_row();
?>
<script language="javascript" type="text/javascript"><!--
  var frm=window.opener.document.frm_indice;
  if (window.opener.confirm("Exite Registro para esta Rotina. Deseja Carregar?")) {
    frm.txt_id_indice.value="<?=$tupula["ID_INDICE"]?>";
    frm.txt_nm_indice.value="<?=$tupula["NM_INDICE"]?>";
    frm.txt_nm_reduz_indice.value="<?=$tupula["NM_REDUZ_INDICE"]?>";
    frm.cmb_ch_periodicidade.value="<?=$tupula["CH_PERIODICIDADE"]?>";
    frm.btn_incluir.value="Alterar";
    frm.hdn_controle.value="2";
    frm.txt_id_indice.readOnly=true;
  } else {
    frm.txt_id_indice.value="";
    frm.txt_id_indice.focus();
  }
// -->
</script>
<?
    }
  }
  mysql_close();
?>
<script language="javascript" type="text/javascript">
//<!--
window.close();
// -->
</script>
</body>
</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?
  if ((@$_GET["campo"]!="") && (@$_GET["campo2"]!="") && (@$_GET["campo3"]!="")) {
    require_once 'lib/loader.php';
    // incluindo a classe
// Conectando ao BD BD ($host, $user, $pass, $db)

  $arquivo="tp_servicos.php";
  
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
    $ID_CIDADE=strtoupper($_GET["campo"]);
    $ID_SERVICO=$_GET["campo2"];
    $ID_TP_SERVICO=$_GET["campo3"];
    $query="SELECT NM_TP_SERVICO FROM ".TBL_TP_SERVICO." WHERE ID_TP_SERVICO=$ID_TP_SERVICO AND ID_SERVICO=$ID_SERVICO AND ID_CIDADE=$ID_CIDADE";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
    if ($rows>0) {
      $tupula = $conn->fetch_row();
?>
<script language="javascript" type="text/javascript">//<!--
var frm = window.opener.document.frm_tp_servico;
if (window.opener.confirm("Exite Registro para esta Rotina. Deseja Carregar?")) {
  frm.txt_nm_tp_servico.value="<?=$tupula["NM_TP_SERVICO"]?>";
  frm.btn_incluir.value="Alterar";
  frm.hdn_controle.value="2";
  frm.txt_id_tp_servico.readOnly=true;
} else {
  frm.txt_id_tp_servico.value="";
  frm.txt_nm_tp_servico.focus();
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

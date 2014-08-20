<? //echo "<pre>get "; print_r($_GET); print_r($_POST); echo "</pre>"; exit; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <script language="JavaScript" type="text/javascript" src="../../js/sigat_div.js"></script>
</head>
<body>
<?
  if (@$_GET["campo1"]!="") {
    require_once 'lib/loader.php';
    // incluindo a classe
// Conectando ao BD BD ($host, $user, $pass, $db)

  $arquivo="edificacao.php";
  
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

// campo de selecao
    $ID_CNPJ_CPF=str_replace(".","",str_replace("/","",str_replace("-","",strtoupper($_GET["campo1"]))));
    $query="SELECT ID_CNPJ_CPF, NM_PESSOA, NR_FONE, DE_EMAIL_PESSOA FROM ".TBL_PESSOA." WHERE ID_CNPJ_CPF='$ID_CNPJ_CPF' LIMIT 1";
//echo $query;
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
    if ($rows>0) {
      $tupula = $conn->fetch_row();
?>
<script language="javascript" type="text/javascript">//<!--
var frm=window.opener.document.frm_edificacao;
if (window.opener.confirm("Exite Registro para este Proprietário. Deseja Carregar?")) {
  frm.txt_nr_cnpjcpf_proprietario.value="<?=@$tupula['ID_CNPJ_CPF']?>";
  cpfcnpj(frm.txt_nr_cnpjcpf_proprietario)
  frm.txt_nm_proprietario.value="<?=@$tupula['NM_PESSOA']?>";
  frm.txt_nr_fone_proprietario.value="<?=@$tupula['NR_FONE']?>";
  frm.txt_de_email_proprietario.value="<?=@$tupula['DE_EMAIL_PESSOA']?>";

} else {
  frm.value="";
  frm.focus();
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

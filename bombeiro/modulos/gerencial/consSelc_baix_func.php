<? // echo __file__; exit; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<body>
<script language="JavaScript" type="text/javascript">
<?
  if (@$_GET["campo"]!="") {
    $ID_CIDADE=$_GET["campo"];
  require_once 'lib/loader.php';
  // incluindo a classe

    $conn=  new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_PROJETOS);
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $sql=" SELECT ".TBL_PROT_FUNC.".ID_PROT_FUNC FROM ".TBL_PROT_FUNC." LEFT JOIN ".TBL_COB_BOLETO." ON (".TBL_PROT_FUNC.".ID_PROT_FUNC=".TBL_COB_BOLETO.".ID_PROT_FUNC AND ".TBL_PROT_FUNC.".ID_CIDADE=".TBL_COB_BOLETO.".ID_CIDADE) WHERE  ".TBL_PROT_FUNC.".ID_CIDADE=$ID_CIDADE AND DT_PAGAMENTO IS NULL AND ID_COBRANCA_BOLETO IS NOT NULL";
      echo "// aqui0:$sql\n";
    $res= $conn->query($sql);
    $rows=$conn->num_rows();
    if ($rows>0) {
    ?>
window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options.length=0;
sec_cmb_id_protocolo=window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options.length++;
window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options[sec_cmb_id_protocolo].text='---------------';
window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options[sec_cmb_id_protocolo].value='';
sec_cmb_id_protocolo= '';
    <?
    while ($tupula = $conn->fetch_row()) {
      ?>
sec_cmb_id_protocolo=window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options.length++;
window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options[sec_cmb_id_protocolo].text="<?=$tupula["ID_PROT_FUNC"]?>";
window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options[sec_cmb_id_protocolo].value="<?=$tupula["ID_PROT_FUNC"]?>";
      <?
    }
  } else {
    ?>
window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options.length=0;\n";
sec_cmb_id_protocolo=window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options.length++;
window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options[sec_cmb_id_protocolo].text='---------------';
window.opener.document.frm_baixa_projeto.cmb_id_protocolo.options[sec_cmb_id_protocolo].value='';
    <?
  }
}
?>
</script>
<script language="JavaScript" type="text/javascript">
  window.close();
</script>
</body>
</html>
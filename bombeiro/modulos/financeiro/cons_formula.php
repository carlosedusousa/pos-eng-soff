<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="JavaScript" type="text/javascript" src="../../js/sigat_div.js"></script>
<body>
<?
  if ((@$_GET["campo"]!="") && (@$_GET["campo2"]!="") && (@$_GET["campo3"]!="") && (@$_GET["campo4"]!="")) {
    require_once 'lib/loader.php';
    // incluindo a classe
// Conectando ao BD BD ($host, $user, $pass, $db)

  $arquivo="formula.php";

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
    $ID_FORMULA=$_GET["campo4"];
    $query="SELECT ID_INDICE, NM_FORMULA, NR_MAX_PARCELA, VL_MIN_PARCELA, VL_MAX_PARCELA, CH_BASE_AREA, VL_MIN_AREA, VL_MAX_AREA, NR_PRAZO_VENCTO, DE_FORMULA FROM ".TBL_FORMULA." WHERE ID_FORMULA=$ID_FORMULA AND ID_TP_SERVICO=$ID_TP_SERVICO AND ID_SERVICO=$ID_SERVICO AND ID_CIDADE=$ID_CIDADE";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
    if ($rows>0) {
      $tupula = $conn->fetch_row();
?>
<script language="javascript" type="text/javascript">//<!--
var frm=window.opener.document.frm_formula;
if (window.opener.confirm("Exite Registro para esta Rotina. Deseja Carregar?")) {
  frm.txt_nm_formula.value="<?=$tupula["NM_FORMULA"]?>";
  frm.cmb_id_indice.value="<?=$tupula["ID_INDICE"]?>";
  frm.cmb_ch_base_area.value="<?=$tupula["CH_BASE_AREA"]?>";
  frm.cmb_nr_max_parcela.value="<?=$tupula["NR_MAX_PARCELA"]?>";
  frm.cmb_nr_prazo_vencto.value="<?=$tupula["NR_PRAZO_VENCTO"]?>";
  frm.txt_vl_min_area.value="<?=str_replace('.',',',$tupula["VL_MIN_AREA"])?>";
  FormatNumero(frm.txt_vl_min_area);
  decimal(frm.txt_vl_min_area,2);
  frm.txt_vl_max_area.value="<?=str_replace('.',',',$tupula["VL_MAX_AREA"])?>";
  FormatNumero(frm.txt_vl_max_area);
  decimal(frm.txt_vl_max_area,2);
  frm.txt_vl_min_parcela.value="<?=str_replace('.',',',$tupula["VL_MIN_PARCELA"])?>";
  FormatNumero(frm.txt_vl_min_parcela);
  decimal(frm.txt_vl_min_parcela,2);
  frm.txt_vl_max_parcela.value="<?=str_replace('.',',',$tupula["VL_MAX_PARCELA"])?>";
  FormatNumero(frm.txt_vl_max_parcela);
  decimal(frm.txt_vl_max_parcela,2);
  frm.txt_de_formula.value="<?=trim(str_replace('$RESULTADO=','',$tupula["DE_FORMULA"]))?>";
  frm.btn_incluir.value="Alterar";
  frm.hdn_controle.value="2";
} else {
  frm.cmb_id_formula.value="0";
  frm.txt_nm_formula.focus();
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

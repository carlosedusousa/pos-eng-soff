<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta Rotina</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?
  if (@$_GET["campo"]!="") {
    require_once 'lib/loader.php';
    // incluindo a classe
// Conectando ao BD BD ($host, $user, $pass, $db)

  $arquivo="rotinas.php";
  
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
    
    $rotina=strtoupper($_GET["campo"]);
    $query="SELECT ID_ROTINA, NM_ROTINA, NM_ARQ_ROTINA, ID_MODULO FROM ".TBL_ROTINAS." WHERE ID_ROTINA='".$rotina."'";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
    if ($rows>0) {
      $tupula = $conn->fetch_row();
?>
<script language="javascript" type="text/javascript"><!--
var frm_cons=window.opener.document.frm_rotinas;
if (window.opener.confirm("Exite Registro para esta Rotina. Deseja Carregar?")) {
  frm_cons.txt_id_rotina.value="<? echo $tupula["ID_ROTINA"]; ?>";
  frm_cons.txt_nm_rotina.value="<? echo $tupula["NM_ROTINA"]; ?>";
  frm_cons.txt_nm_arq_rotina.value="<? echo $tupula["NM_ARQ_ROTINA"]; ?>";
  frm_cons.cmb_id_modulo.value="<? echo $tupula["ID_MODULO"]; ?>";
<?
echo "//aqui :$global_alteracao\n";
if ($global_alteracao=="S") {
?>
  frm_cons.btn_incluir.disabled=false;
  frm_cons.btn_incluir.value="Alterar";
  frm_cons.btn_incluir.style.backgroundImage="url('../../imagens/botao.gif')";
<?
      } else {
?>
  frm_cons.btn_incluir.disabled=false;
  frm_cons.btn_incluir.value="Alterar";
  //alert(frm_cons.btn_incluir.style.backgroundImage);
  frm_cons.btn_incluir.style.backgroundImage="url('../../imagens/botao2.gif')";

  frm_cons.btn_incluir.disabled=true;
<?
      }
?>
  frm_cons.hdn_controle.value="2";
  frm_cons.txt_id_rotina.readOnly=true;
} else {
  frm_cons.txt_id_rotina.value="";
  frm_cons.txt_id_rotina.focus();
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

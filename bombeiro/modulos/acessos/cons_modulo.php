<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta Módulo</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?
  if (@$_GET["campo"]!="") {
    require_once 'lib/loader.php';

    // incluindo a classe
// Conectando ao BD BD ($host, $user, $pass, $db)

  $arquivo="modulos.php";
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
    
    $modulo=strtoupper($_GET["campo"]);
    $query="SELECT ID_MODULO, NM_MODULO, NM_DIR_MODULO FROM ".TBL_MODULOS." WHERE ID_MODULO='".$modulo."'";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
?>
<script language="javascript" type="text/javascript">//<!--
var frm_cons=window.opener.document.frm_modulo;
<?
    $rows=$conn->num_rows();
    if ($rows>0) {
      $tupula = $conn->fetch_row();
?>
if (window.opener.confirm("Exite Registro para esta Módulo. Deseja Carregar?")) {
  frm_cons.txt_id_modulo.value="<?=$tupula["ID_MODULO"];?>";
  frm_cons.txt_nm_modulo.value="<?=$tupula["NM_MODULO"];?>";
  frm_cons.cmb_nm_dir_modulo.value="<?=$tupula["NM_DIR_MODULO"];?>";
<?
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
  frm_cons.txt_id_modulo.readOnly=true;
} else {
  frm_cons.txt_id_modulo.value="";
  frm_cons.txt_id_modulo.focus();
}

<?
    } else {
?>
  frm_cons.txt_id_modulo.value="";
  frm_cons.txt_nm_modulo.focus();
<?
    }
  }
  mysql_close();
?>
// -->
</script>
<script language="javascript" type="text/javascript">
//<!--
window.close();
// -->
</script>
</body>
</html>

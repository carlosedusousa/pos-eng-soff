<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta Usuário</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?
  if (@$_GET["campo"]!="") {
    require_once 'lib/loader.php';
    $arquivo="cidade_usuario.php";
    $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $sql= "SELECT ID_ROTINA,NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
    // executando a consulta
    $res= $conn->query($sql);
    $rows_rotina=$conn->num_rows();
    if ($rows_rotina>0) {
      $rotina = $conn->fetch_row();
    }
  
    $global_obj_sessao->load($rotina["ID_ROTINA"]);

    $login=strtoupper($_GET["campo"]);
    $query="SELECT ID_USUARIO,NM_USUARIO FROM ".TBL_USUARIO." WHERE ID_USUARIO='".$login."'";
    $conn->query($query);
    $rows=$conn->num_rows();
    if ($rows>0) {
      $tupula = $conn->fetch_row();
?>
<script language="javascript" type="text/javascript">//<!--
var frm_cons=window.opener.document.frm_cidade_gbm;
  frm_cons.txt_id_usuario.value="<? echo $tupula["ID_USUARIO"]; ?>";
  frm_cons.txt_nm_usuario.value="<? echo $tupula["NM_USUARIO"]; ?>";
  frm_cons.txt_id_usuario.readOnly=true;
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

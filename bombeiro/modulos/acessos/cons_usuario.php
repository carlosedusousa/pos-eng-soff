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
    $arquivo="usuario.php";
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

    $login=strtoupper($_GET["campo"]);
    $query="SELECT ID_USUARIO, NM_USUARIO, ID_PERFIL, ID_POSTO, ID_BATALHAO, ID_COMPANIA, ID_PELOTAO, ID_GRUPAMENTO, ID_CIDADE FROM ".TBL_USUARIO." WHERE ID_USUARIO='".$login."'";
    $conn->query($query);
    $rows=$conn->num_rows();
    if ($rows>0) {
      $tupula = $conn->fetch_row();
?>
<script language="javascript" type="text/javascript">//<!--
var frm_cons=window.opener.document.frm_usuario;
if (window.opener.confirm("Exite Registro para este Login. Deseja Carregar?")) {
<?
      $query="SELECT ID_COMPANIA, NM_COMPANIA FROM ".TBL_COMPANIA." WHERE ID_BATALHAO=".$tupula["ID_BATALHAO"];
      $conn->query($query);
      echo "frm_cons.cmb_id_compania.options.length=0;\n";
      while ($companhia=$conn->fetch_row()) {
        echo "sec_cmb_id_compania=frm_cons.cmb_id_compania.options.length++;\n";
        echo "frm_cons.cmb_id_compania.options[sec_cmb_id_compania].value='".$companhia["ID_COMPANIA"]."';\n";
        echo "frm_cons.cmb_id_compania.options[sec_cmb_id_compania].text='".$companhia["NM_COMPANIA"]."';\n";
      }
      $query="SELECT ID_PELOTAO, NM_PELOTAO FROM ".TBL_PELOTAO." WHERE ID_BATALHAO=".$tupula["ID_BATALHAO"]." AND ID_COMPANIA=".$tupula["ID_COMPANIA"];
      $conn->query($query);
      echo "frm_cons.cmb_id_pelotao.options.length=0;\n";
      while ($pelotao=$conn->fetch_row()) {
        echo "sec_cmb_id_pelotao=frm_cons.cmb_id_pelotao.options.length++;\n";
        echo "frm_cons.cmb_id_pelotao.options[sec_cmb_id_pelotao].value='".$pelotao["ID_PELOTAO"]."';\n";
        echo "frm_cons.cmb_id_pelotao.options[sec_cmb_id_pelotao].text='".$pelotao["NM_PELOTAO"]."';\n";
      }
      
      $query="SELECT ID_GRUPAMENTO, NM_GRUPAMENTO FROM ".TBL_GRUPAMENTO." WHERE ID_BATALHAO=".$tupula["ID_BATALHAO"]." AND ID_COMPANIA=".$tupula["ID_COMPANIA"]." AND ID_PELOTAO=".$tupula["ID_PELOTAO"];
      $conn->query($query);
      echo "frm_cons.cmb_id_grupamento.options.length=0;\n";
      while ($grupamento=$conn->fetch_row()) {
        echo "sec_cmb_id_grupamento=frm_cons.cmb_id_grupamento.options.length++;\n";
        echo "frm_cons.cmb_id_grupamento.options[sec_cmb_id_grupamento].value='".$grupamento["ID_GRUPAMENTO"]."';\n";
        echo "frm_cons.cmb_id_grupamento.options[sec_cmb_id_grupamento].text='".$grupamento["NM_GRUPAMENTO"]."';\n";
      }
?>
  frm_cons.txt_id_usuario.value="<? echo $tupula["ID_USUARIO"]; ?>";
  frm_cons.txt_nm_usuario.value="<? echo $tupula["NM_USUARIO"]; ?>";
  frm_cons.cmb_perfil.value="<? echo $tupula["ID_PERFIL"]; ?>";
  frm_cons.cmb_id_posto.value="<? echo $tupula["ID_POSTO"]; ?>";
  frm_cons.cmb_id_batalhao.value="<? echo $tupula["ID_BATALHAO"]; ?>";
  frm_cons.cmb_id_compania.value="<? echo $tupula["ID_COMPANIA"]; ?>";
  frm_cons.cmb_id_pelotao.value="<? echo $tupula["ID_PELOTAO"]; ?>";
  frm_cons.cmb_id_grupamento.value="<? echo $tupula["ID_GRUPAMENTO"]; ?>";
  frm_cons.cmb_id_cidade.value="<?=$tupula["ID_CIDADE"]?>";
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
  frm_cons.psw_ps_senha.disabled=true;
  frm_cons.psw_ps_senha_confirma.disabled=true;
  frm_cons.txt_id_usuario.readOnly=true;
} else {
  frm_cons.txt_id_usuario.value="";
  frm_cons.txt_id_usuario.focus();
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta Perfilamento</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?
  if (@$_GET["campo"]!="") {
    require_once 'lib/loader.php';
    $arquivo="perfilamento.php";
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

    $perfil=strtoupper($_GET["campo"]);
    $query="SELECT ID_ROTINA, CH_CONSULTA, CH_INCLUSAO, CH_ALTERACAO, CH_EXCLUSAO FROM ".TBL_PERFILAMENTO_ACESSO." WHERE ID_PERFIL='".$perfil."'";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
?>
<script language="javascript" type="text/javascript">//<!--
var frm_cons=window.opener.document.frm_perfilamento;
<?
    $rows=$conn->num_rows();
    if ($rows>0) {
      while ($tupula = $conn->fetch_row()) {
?>
frm_cons.hdn_<?=$tupula["ID_ROTINA"];?>_perm.value="<? echo $tupula["CH_CONSULTA"]."^".$tupula["CH_INCLUSAO"]."^".$tupula["CH_ALTERACAO"]."^".$tupula["CH_EXCLUSAO"];
?>";
<?
        if ($tupula["CH_CONSULTA"]=="S") {
?>
    frm_cons["chk_<?=$tupula["ID_ROTINA"];?>_C"].checked=true;
<?
        } else {
?>
    frm_cons["chk_<?=$tupula["ID_ROTINA"];?>_C"].checked=false;
<?
        }
        if ($tupula["CH_INCLUSAO"]=="S") {
?>
    frm_cons["chk_<?=$tupula["ID_ROTINA"];?>_I"].checked=true;
<?
        } else {
?>
    frm_cons["chk_<?=$tupula["ID_ROTINA"];?>_I"].checked=false;
<?
        }
        if ($tupula["CH_ALTERACAO"]=="S") {
?>
    frm_cons["chk_<?=$tupula["ID_ROTINA"];?>_A"].checked=true;
<?
        } else {
?>
    frm_cons["chk_<?=$tupula["ID_ROTINA"];?>_A"].checked=false;
<?
        }
        if ($tupula["CH_EXCLUSAO"]=="S") {
?>
    frm_cons["chk_<?=$tupula["ID_ROTINA"];?>_E"].checked=true;
<?
        } else {
?>
    frm_cons["chk_<?=$tupula["ID_ROTINA"];?>_E"].checked=false;
<?
        }
?>
    if (frm_cons.hdn_<?=$tupula["ID_ROTINA"];?>_perm.value=="S^S^S^S") {
      frm_cons.chk_<?=$tupula["ID_ROTINA"];?>_comp.checked=true;
    } else {
      frm_cons.chk_<?=$tupula["ID_ROTINA"];?>_comp.checked=false;
    }
<?
      }
    }
?>
// --></script>
<?
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

<?
 //include ('../../templates/head_cons.htm');
?>
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="engenheiro.php";
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

//echo "<!--\n$sql\n-->";
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();
  if (@$_GET["hdn_campo"]=="") {
?>
<script language="javascript" type="text/javascript">//<!--
  alert("Informação sem Campo de Origem. Contate o DITI!");
  window.close();
//--></script>
<?
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function ed_seta(crea,engenheiro) {
      document.frm_consulta_engenheiro.hdn_id_crea.value=crea;
      document.frm_consulta_engenheiro.hdn_nm_engenheiro.value=engenheiro;
    }
    function novo_reg() {
      window.location.href="engenheiro.php?hdn_campo=<?=$_GET["hdn_campo"]?>&hdn_controle=1";
    }
    function alterar_reg() {
      window.location.href="engenheiro.php?hdn_campo=<?=$_GET["hdn_campo"]?>&hdn_controle=2&hdn_id_crea="+document.frm_consulta_engenheiro.hdn_id_crea.value+"&hdn_nm_engenheiro="+document.frm_consulta_engenheiro.hdn_nm_engenheiro.value;
    }
    function carregar_reg() {
      window.opener.document.frm_vist_habitese.hdn_id_crea_<?=trim($_GET["hdn_campo"])?>.value=document.frm_consulta_engenheiro.hdn_id_crea.value;
      window.opener.document.frm_vist_habitese.txt_nm_engenheiro_<?=trim($_GET["hdn_campo"])?>.value=document.frm_consulta_engenheiro.hdn_nm_engenheiro.value;
      window.close();
    }
    function ajustaspan1() {
      var obj=document.getElementById("corpo");
      var objln=document.getElementById("lncorpo");
      var objtb=document.getElementById("tbcorpo");
        obj.style.height="290px";
        objln.style.height="295px";
      /*
        obj.style.height="295px";
        objln.style.height="300px";
      */
        objtb.style.marginLeft="0px";
    }
//--></script>

<body onload="ajustaspan1()">
<?
 //include ('../../templates/cab_cons.htm');
?>

          <form target="_self" method="get" name="frm_consulta_engenheiro" onreset="retorna(this)" onsubmit="return validaForm(this,'txt_pesq_engenheiro,Nome da Pesquisa,t')">
           <table width="95%" cellspacing="0" border="0" cellpadding="0" align="center">
<head>
           <link rel="stylesheet" type="text/css" href="./../../css/menu.css">
	<link type="text/css" rel="stylesheet" href="./../../css/calendario.css" />
	<link rel="stylesheet" type="text/css" href="./../../css/ebombeiro.css">
</head>
              <tr>


            <table width="95%" cellspacing="0" border="0" cellpadding="0" align="center">
              <tr>
                <td>
                  <input type="hidden" name="hdn_id_crea" value="">
                  <input type="hidden" name="hdn_nm_engenheiro" value="">
                  <input type="hidden" name="hdn_campo" value="<?=$_GET["hdn_campo"]?>">
                  Tipo de Pesquisa
                </td>
                <td>
                  <select name="cmb_campo" >
                    <option value="1">Número CREA</option>
                    <option value="2" selected>Nome do Engeheiro</option>
                  </select>
                </td>
                <td>
                <input type="text" name="txt_pesq_engenheiro" value="<?=@$_GET["txt_pesq_engenheiro"]?>" class="campo_obr">
                </td>
                <td>
                  <input type="submit" name="btn_pesquisa" value="Pesquisar" class="botao" title="Pesquisa Edificação">
                </td>
              </tr>
              <tr>
                <td colspan=4>
                  <table width="100%" cellspacing="0" cellpadding="0" border="1">
                    <tr style="font-weight : bold;">
                      <td> Seleção</td>
                      <td>N° CREA</td>
                      <td>Nome Engeheiro</td>
                    </tr>
<?
/*
ID_CREA
NM_ENGENHEIRO
NM_ENGENHEIRO_FONETICA
*/
if ((@$_GET["cmb_campo"]!="")&&(@$_GET["txt_pesq_engenheiro"]!="")) {
    $pesquisa_fo=nr_txt_fonetica($_GET["txt_pesq_engenheiro"]);
    if ($_GET["cmb_campo"]==1) {
      $pesquisa_fo=$_GET["txt_pesq_engenheiro"];
      $query="SELECT ".TBL_ENGENHEIRO.".ID_CREA,".TBL_ENGENHEIRO.".NM_ENGENHEIRO FROM ".TBL_ENGENHEIRO." WHERE ".TBL_ENGENHEIRO.".ID_CREA =$pesquisa_fo ORDER BY ".TBL_ENGENHEIRO.".NM_ENGENHEIRO";
    } else {
      $query="SELECT ".TBL_ENGENHEIRO.".ID_CREA,".TBL_ENGENHEIRO.".NM_ENGENHEIRO FROM ".TBL_ENGENHEIRO." WHERE ".TBL_ENGENHEIRO.".NM_ENGENHEIRO_FONETICA LIKE '%$pesquisa_fo%' ORDER BY ".TBL_ENGENHEIRO.".NM_ENGENHEIRO";
    }
    echo "<!--aqui 0:$query-->\n";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
    if ($rows>0) {
      $cont=1;
      while ($tupula = $conn->fetch_row()) {
        $resto=$cont%2;
        if ($resto!=0) {
?>
                    <tr style="background-color : #4ab;">   <!--#9bd5ff;-->
<?
        } else {
?>
                    <tr style="background-color : #ffffff;">
<?
        }
        $cont++;
?>
                      <td><input type="radio" name="rdn_edificacoa" onChange="ed_seta('<?=$tupula["ID_CREA"]?>','<?=$tupula["NM_ENGENHEIRO"]?>')"></td>
                      <td><?=$tupula["ID_CREA"]?></td>
                      <td><?=$tupula["NM_ENGENHEIRO"]?></td>
                    </tr>
<?
    }
  }
}
?>
                  </table>
                </td>
              </tr>
           </table>

<?

  include('/var/www/sistemacbm/templates/btn_cons.htm');

?>
          </form>
<?
 // include ('../../templates/footer.htm');
?>

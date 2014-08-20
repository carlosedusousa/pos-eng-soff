<?
 include ('../../templates/head_cons.htm');
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
  
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();
  
  if ((@$_GET["hdn_campo"]!="")&&(@$_GET["txt_id_crea"]!="")&&(@$_GET["txt_nm_engenheiro"]!="")&&(@$_GET["hdn_controle_altera"]!="")) {
    $ID_CREA=formataCampo($_GET["txt_id_crea"],"NT","7");
    $NM_ENGENHEIRO=formataCampo($_GET["txt_nm_engenheiro"]);
    $NM_ENGENHEIRO_FONETICA=formataCampo(nr_txt_fonetica($_GET["txt_nm_engenheiro"]));
    if ($_GET["hdn_controle"]==1) {
      $query="INSERT INTO ".TBL_ENGENHEIRO."  (ID_CREA, NM_ENGENHEIRO, NM_ENGENHEIRO_FONETICA) VALUES ($ID_CREA,$NM_ENGENHEIRO,$NM_ENGENHEIRO_FONETICA)";
    }
    if ($_GET["hdn_controle"]==2) {
      $query="UPDATE ".TBL_ENGENHEIRO."  SET NM_ENGENHEIRO=$NM_ENGENHEIRO, NM_ENGENHEIRO_FONETICA=$NM_ENGENHEIRO_FONETICA WHERE ".TBL_ENGENHEIRO.".ID_CREA=$ID_CREA";
    }
    echo "<!--aqui 0:$query-->\n";
    $res= $conn->query($query);
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
      $ID_CODIGO_RETORNO=$ID_CREA;
      include ('../../templates/retorno.htm');
?>
      <script language="javascript" type="text/javascript">//<!--
        window.opener.document.frm_edificacao.hdn_id_crea_<?=trim($_GET["hdn_campo"])?>.value=<?=$ID_CREA?>;
        window.opener.document.frm_edificacao.txt_nm_engenheiro_<?=trim($_GET["hdn_campo"])?>.value="<?=$_GET["txt_nm_engenheiro"]?>";
        window.close();
      //--></script>
<?
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo,arq) {
      if (campo.value!="") {
        window.open(arq+"?campo="+campo.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
      window.history.back();
      //frm.txt_id_rotina.readOnly=false;
    }
    function inclui() {
      document.frm_engenheiro.hdn_controle_altera.value="1";
    }
//--></script>
<body onload="ajustaspan();inclui()">
<?
 include ('../../templates/cab_cons.htm');
?>

          <form target="_self" method="get" name="frm_engenheiro" onreset="retorna(this)" onsubmit="return validaForm(this,'txt_id_crea,Número do CREA,t','txt_nm_engenheiro,Nome do Engenheiro,t')">
            <input type="hidden" name="hdn_campo" value="<?=@$_GET["hdn_campo"]?>">
            <input type="hidden" name="hdn_controle_altera" value="">
            <table width="95%" cellspacing="0" border="0" cellpadding="0" align="center">
              <tr>
                <td colspan="4">
                  <fieldset>
                    <legend>Engenheiro</legend>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td>N° CREA
                        </td>
                        <td><input type="text" size="10" name="txt_id_crea" maxlength="8" value="<?=@$_GET["hdn_id_crea"]?>" title="Número do CREA" class="campo_obr" onBlur="valida_crea(this)">
                        </td>
                        <td>Nome
                        </td>
                        <td><input type="text" name="txt_nm_engenheiro" size="50" maxlength="100" class="campo_obr" value="<?=@$_GET["hdn_nm_engenheiro"]?>">
                        </td>
                      </tr>

<?

  include('../../templates/btn_inc.htm');

?>
                  </fieldset>
                </td>
              </tr>
            </table>

          </form>
<?
  include ('../../templates/footer.htm');
?>
<!--  aqui:<?=@$_GET["hdn_controle"]?>            -->
<?
  if (@$_GET["hdn_controle"]==2) {
?>
<script language="javascript" type="text/javascript">//<!--
  var frm_cons=document.frm_engenheiro;
  frm_cons.btn_incluir.disabled=false;
  frm_cons.btn_incluir.value="Alterar";
  frm_cons.hdn_controle.value="<?=$_GET["hdn_controle"]?>";
  frm_cons.btn_incluir.style.backgroundImage="url('../../imagens/botao.gif')";
//--></script>
<?
  }
?>
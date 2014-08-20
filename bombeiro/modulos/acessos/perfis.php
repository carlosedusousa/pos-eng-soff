<?
 include ('../../templates/headA.htm');
?>
<?
  $erro="";
/*
  require_once 'conf/conf_bd.php';
  // incluindo a classe
  require_once 'class/class_mysql.php';
  require_once 'class/class_sessao_sigat.php';
*/
  require_once 'lib/loader.php';

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="perfis.php";
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
// Verifica Campos Obrigatórios
  if (@$_POST["txt_nm_perfil"]!="") {
    // string da query

    $NM_PERFIL    =formataCampo(strtoupper($_POST["txt_nm_perfil"]));
    if ($_POST["hdn_controle"]==1) {
      if ($global_inclusao=="S") {
        $sql= "INSERT INTO PERFIS  (ID_PERFIL,NM_PERFIL) values('',$NM_PERFIL)";
      } else {
        $sql="";
        $erro=MSG_ERR_INC;
      }
    }
    if ($_POST["hdn_controle"]==2) {
      if ($global_alteracao=="S") {
        $ID_PERFIL   =formataCampo(strtoupper($_POST["txt_id_perfil"]));
        // vriável de mensagem
        $ID_CODIGO_RETORNO=$ID_PERFIL;
        $sql= "UPDATE PERFIS  set NM_PERFIL=".$NM_PERFIL." WHERE ID_PERFIL=".$ID_PERFIL;
      } else {
        $sql="";
        $erro=MSG_ERR_ALT;
      }
    }
    // executando o insert
    //echo "aqui 0:".$sql."\n";
    if ($sql!="") {
      $res= $conn->query($sql);
    }
    // testando se houve algum erro
    //echo "aqui :".$conn->get_status()."\n";
    if ($conn->get_status()==false) {
      //erro_alert($conn->getMessage());
      die ($res->get_msg());
    } else {
?>
<?
      include ('../../templates/retorno.htm');
?>
<?
    }
  } else {
    if ((isset($_POST["nm_rotina"]))&& (isset($_POST["txt_nm_arq_rotina"]))) {
      $erro= "echo '<tr><td align=\"center\" style=\"background-color : #f7ff05; color : #ff0000; font-weight : bold;\">OS CAMPOS ASSINALADOS SÃO OBRIGATÓRIOS</td></tr>'\n";
    }
  }
?>
<script language="JavaScript" type="text/javascript">
    function consultaReg(campo) {
      if (campo.value!="") {
        window.open("cons_perfis.php?campo="+campo.value,"consulusr","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
<?
if ($global_inclusao=="S") {
?>
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.btn_incluir.style.backgroundImage="url('../../imagens/botao.gif')";
<?
} else {

?>
      frm.btn_incluir.style.backgroundImage="url('../../imagens/botao2.gif')";
<?
}
?>
      frm.txt_id_perfil.readOnly=false;
    }
</script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>
          <form target="_self" enctype="multipart/form-data" method="post" name="frm_perfis" onreset="retorna(this)" onsubmit="return validaForm(this,'txt_nm_perfil,Nome do Perfil,t')">
            <table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
              <tr>
                <td>Código</td>
                <td><input type="text" class="campo" name="txt_id_perfil" size="10" maxlength="9" align="right" value="" title="Códigp do Perfil de Acesso, para incluir permanece em branco" onblur="consultaReg(this)" onkeypress="return validaTecla(this, event, 'n')">
                </td>
              </tr>
              <tr>
                <td>Nome</td>
                <td>
                <input type="text" class="campo_obr" name="txt_nm_perfil" size="50" maxlength="50" value="" title="Nome do Perfil de Acesso">
                </td>
              </tr>
<?
  include('../../templates/btn_inc.htm');
?>
            </table>
          </form>
<?
  include ('../../templates/footer.htm');
?>

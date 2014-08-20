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
// VERIFICA CAMPOS OBRIGATÓRIOS
  if (@$_POST["txt_nm_modulo"]!="") {
    // string da query

    $NM_MODULO    =formataCampo(strtoupper($_POST["txt_nm_modulo"]));
    $NM_DIR_MODULO    =formataCampo($_POST["cmb_nm_dir_modulo"],"t","l");
    if ($_POST["hdn_controle"]==1) {
      if ($global_inclusao=="S") {
        $sql= "INSERT INTO ".TBL_MODULOS."  (ID_MODULO,NM_MODULO,NM_DIR_MODULO) values('',$NM_MODULO,$NM_DIR_MODULO)";
      } else {
        $sql="";
        $erro=MSG_ERR_INC;
      }
    }
    if ($_POST["hdn_controle"]==2) {
      if ($global_alteracao=="S") {
        $ID_MODULO   =formataCampo($_POST["txt_id_modulo"],'n');
        $sql= "UPDATE ".TBL_MODULOS."  set NM_MODULO=".$NM_MODULO.",NM_DIR_MODULO=".$NM_DIR_MODULO." WHERE ID_MODULO=".$ID_MODULO;
      } else {
        $sql="";
        $erro=MSG_ERR_ALT;
      }
    }
    // executando o insert
    if ($sql!="") {
      $res= $conn->query($sql);
    }
    // testando se houve algum erro
    if ($conn->get_status()==false) {
      //erro_alert($conn->getMessage());
      die ($res->get_msg());
    } else {
?>
<script language="JavaScript" type="text/javascript">//<!--
  <?
    if (@$conn->insert_id()!="") {
      if (($_POST["hdn_controle"]==1)&&($global_inclusao=="S")) {
        echo "alert(\"Registro Inserido com o Código:".$conn->insert_id()."\");\n";
      }
    }
    if (($_POST["hdn_controle"]==2)&&($global_alteracao=="S")) {
      echo "alert(\"Registro Alterado com o Código:".$ID_MODULO."\");\n";
    }
  ?>
//--></script>
<?
    }
  } else {
    if ((isset($_POST["nm_rotina"]))&& (isset($_POST["txt_nm_arq_rotina"]))) {
      $erro= "echo '<tr><td align=\"center\" style=\"background-color : #f7ff05; color : #ff0000; font-weight : bold;\">OS CAMPOS ASSINALADOS SÃO OBRIGATÓRIOS</td></tr>'\n";
    }
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo,arq) {
      if (campo.value!="") {
        window.open(arq+"?campo="+campo.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
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
      frm.txt_id_modulo.readOnly=false;
    }
//--></script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_modulo" onreset="retorna(this)" onsubmit="return validaForm(this,'nome_campo,Descritivo,tipo')">
            <table cellspacing="0" border="0" cellpadding="5" align="center" width="90%">
              <tr>
                <td>Código</td>
                <td><input type="text" name="txt_id_modulo" value="" class="campo" align="right" title="Código do Módulo se Existir" onblur="consultaReg(this,'cons_modulo.php')" onkeypress="return validaTecla(this, event, 'n')"></td>
              </tr>
              <tr>
                <td>Modulo</td>
                <td><input type="text" name="txt_nm_modulo" class="campo_obr" value="" title="Nome do Módulo"></td>
              </tr>
              <tr>
                <td>Diretório</td>
                <td>
                <select name="cmb_nm_dir_modulo" class="campo" title="Nome do Diretório onde estão amazenados os arquivos">
                  <option value="">------</option>
                  <option value="../acessos">Acessos</option>
                  <option value="../analise">Análise</option>
                  <option value="../cadastros">Cadastros</option>
                  <option value="../edificacoes">Edificação</option>
                  <option value="../financeiro">Financeiro</option>
                  <option value="../funcionamento">Funcionamento</option>
                  <option value="../gerencial">Gerencial</option>
                  <option value="../habitese">Habite-se</option>
                  <option value="../manutencao">Manutenção</option>
                  <option value="../misc">Miscelânea</option>
                  <option value="../protocolo">Protocolo</option>
                  <option value="../solicitacoes">Solicitações</option>
                </select>
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

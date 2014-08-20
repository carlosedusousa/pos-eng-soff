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
// VERIFICA CAMPOS OBRIGATÓRIOS
  if ((@$_POST["txt_nm_rotina"]!="")&&(@$_POST["txt_nm_arq_rotina"])) {
    // string da query

    $NM_ROTINA    =formataCampo(strtoupper($_POST["txt_nm_rotina"]));
    $ID_MODULO    =formataCampo($_POST["cmb_id_modulo"],"n");
    $NM_ARQ_ROTINA=strtolower(formataCampo($_POST["txt_nm_arq_rotina"]));
    if ($_POST["hdn_controle"]==1) {
      if ($global_inclusao=="S") {
        $sql= "INSERT INTO ".TBL_ROTINAS."  (ID_ROTINA,NM_ROTINA,NM_ARQ_ROTINA,ID_MODULO) values('',$NM_ROTINA,$NM_ARQ_ROTINA,$ID_MODULO)";
      } else {
        $sql="";
        $erro=MSG_ERR_INC;
      }
    }
    if ($_POST["hdn_controle"]==2) {
      if ($global_alteracao=="S") {
        $ID_ROTINA   =formataCampo(strtoupper($_POST["txt_id_rotina"]));
        // vriável de mensagem
        $ID_CODIGO_RETORNO=$ID_ROTINA;
        $sql= "UPDATE ".TBL_ROTINAS."  set NM_ROTINA=".$NM_ROTINA.",NM_ARQ_ROTINA=".$NM_ARQ_ROTINA.",ID_MODULO=".$ID_MODULO." WHERE ID_ROTINA=".$ID_ROTINA;
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
      die ($conn->get_msg());
    } else {
?>
<?
      include ('../../templates/retorno.htm');
?>
<?
    }
  } else {
    if ((isset($_POST["nm_rotina"]))&& (isset($_POST["txt_nm_arq_rotina"]))) {
      $erro= MSG_ERR_OBR;
    }
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo) {
      if (campo.value!="") {
        window.open("cons_rotina.php?campo="+campo.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
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
      frm.txt_id_rotina.readOnly=false;
    }

//--></script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_rotinas" onreset="retorna(this)" onsubmit="return validaForm(this,'txt_nm_rotina,Nome da Rotina,t','txt_nm_arq_rotina,Nome do Arquivo,t')">
            <table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
              <tr>
                <td>Código</td>
                <td><input type="text" name="txt_id_rotina" align="right" class="campo" title="Código da Rotina se for alterar, na inclusão em branco" onblur="consultaReg(this)" onkeypress="return validaTecla(this, event, 'n')"></td>
                <td>Nome</td>
                <td><input type="text" name="txt_nm_rotina" class="campo_obr" title="Nome da Rotina" size="50" maxlength="50"></td>
              </tr>
              <tr>
                <td>Arquivo</td>
                <td><input type="text" name="txt_nm_arq_rotina" class="campo_obr" title="Nome do Arquivo" size="30" maxlength="50" style="text-transform : lowercase;"></td>
                <td>Módulo</td>
                <td>
                  <select name="cmb_id_modulo" title="Modulo que pertence a Rotina">
                    <option value="">-------------</option>
                     <?
                      // string da query
                      $sql= "SELECT ID_MODULO, NM_MODULO FROM ".TBL_MODULOS." ORDER BY NM_MODULO ASC";
                      // executando a consulta
                      $res= $conn->query($sql);
  
                      // testando se houve algum erro
                      if ($conn->get_status()==false) {
                        die($conn->get_msg());
                      }
                      $rows=$conn->num_rows();
                      if ($rows>0) {
                        while ($tupula = $conn->fetch_row()) {
                          echo "\t\t\t\t\t\t\t\t\t\t<option value=\"".$tupula['ID_MODULO']."\">";
                          echo $tupula['NM_MODULO'];
                          echo "</option>\n";
                        }
                      }
                    ?>
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

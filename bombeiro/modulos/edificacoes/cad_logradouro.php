<?
 include ('../../templates/head.htm');
?>
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="cad_logradouro.php";
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
  if ((@$_POST["hdn_id_cidade"]!="") && (@$_POST["txt_id_cep"]!="")  && (@$_POST["cmb_id_tp_logradouro"]!="")  && (@$_POST["txt_nm_logradouro"]!="") && (@$_POST["txt_nm_bairro"]!="") && (@$_POST["hdn_id_cep_ant"]!="") && (@$_POST["hdn_id_logradouro_ant"]!="") && (@$_POST["hdn_id_bairros_ant"]!="") && (($global_inclusao=="S")||($global_alteracao=="S")) ) {
    $ID_CIDADE=formataCampo($_POST["hdn_id_cidade"],'N');
    $ID_CEP=formataCampo($_POST["txt_id_cep"],'N');
    $ID_CEP_ANT=formataCampo($_POST["hdn_id_cep_ant"],'N');
    $ID_LOGRADOURO=formataCampo($_POST["hdn_id_logradouro"],'N');
    $ID_LOGRADOURO_ANT=formataCampo($_POST["hdn_id_logradouro_ant"],'N');
    $ID_TP_LOGRADOURO=formataCampo($_POST["cmb_id_tp_logradouro"],'N');
    $NM_LOGRADOURO=formataCampo($_POST["txt_nm_logradouro"]);
    $NM_FONETICA_LOGRADOURO=formataCampo(nr_txt_fonetica($_POST["txt_nm_logradouro"]));
    $ID_BAIRROS=formataCampo($_POST["hdn_id_bairro"],'N');
    $ID_BAIRROS_ANT=formataCampo($_POST["hdn_id_bairros_ant"],'N');
    $NM_BAIRROS=formataCampo($_POST["txt_nm_bairro"]);
    $NM_FONETICA_BAIRROS=formataCampo(nr_txt_fonetica($_POST["txt_nm_bairro"]));
    $query_trans="BEGIN";
    $conn->query($query_trans);
    $query_trans="COMMIT";
    $ERRO_TRANS="";
    
    $query_bairro="SELECT ID_BAIRROS FROM ".TBL_BAIRROS." WHERE ID_CIDADE=$ID_CIDADE AND ID_BAIRROS=$ID_BAIRROS";
    $conn->query($query_bairro);
    $rows_bairro=$conn->num_rows();
    if ($rows_bairro>0) {
      $query_bairro="UPDATE ".TBL_BAIRROS." SET NM_BAIRROS=$NM_BAIRROS, NM_FONETICA=$NM_FONETICA_BAIRROS, DT_AGUARDO=CURDATE(), CH_AGUARDO='N', ID_USUARIO='$usuario' WHERE ID_CIDADE=$ID_CIDADE AND ID_BAIRROS=$ID_BAIRROS";
      $conn->query($query_bairro);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
    } else {
      $query_bairro="UPDATE ".TBL_BAIRROS." SET ID_BAIRROS=$ID_BAIRROS, NM_BAIRROS=$NM_BAIRROS, NM_FONETICA=$NM_FONETICA_BAIRROS, DT_AGUARDO=CURDATE(), CH_AGUARDO='N', ID_USUARIO='$usuario' WHERE ID_CIDADE=$ID_CIDADE AND ID_BAIRROS=$ID_BAIRROS_ANT";
      $conn->query($query_bairro);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
    }
    
    $query_logra="SELECT ID_LOGRADOURO FROM ".TBL_LOGRADOURO." WHERE ID_CIDADE=$ID_CIDADE AND ID_LOGRADOURO=$ID_LOGRADOURO";
    $conn->query($query_logra);
    $rows_logra=$conn->num_rows();
    if ($rows_logra>0) {
      $query_logra="UPDATE ".TBL_LOGRADOURO." SET NM_LOGRADOURO=$NM_LOGRADOURO, NM_FONETICA=$NM_FONETICA_LOGRADOURO, ID_BAIRROS=$ID_BAIRROS, ID_CIDADE_BAIRROS=$ID_CIDADE, DT_AGUARDO=CURDATE(), CH_AGUARDO='N', ID_USUARIO='$usuario' WHERE ID_CIDADE=$ID_CIDADE AND ID_LOGRADOURO=$ID_LOGRADOURO";
      $conn->query($query_logra);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
    } else {
      $query_logra="UPDATE ".TBL_LOGRADOURO." SET ID_LOGRADOURO=$ID_LOGRADOURO, NM_LOGRADOURO=$NM_LOGRADOURO, NM_FONETICA=$NM_FONETICA_LOGRADOURO, ID_BAIRROS=$ID_BAIRROS, ID_CIDADE_BAIRROS=$ID_CIDADE_BAIRROS, ID_TP_LOGRADOURO=$ID_TP_LOGRADOURO, DT_AGUARDO=CURDATE(), CH_AGUARDO='N', ID_USUARIO='$usuario' WHERE ID_CIDADE=$ID_CIDADE AND ID_LOGRADOURO=$ID_LOGRADOURO_ANT";
      $conn->query($query_logra);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
    }
    
    $query_cep="SELECT ID_CEP FROM ".TBL_CEP." WHERE ID_CEP=$ID_CEP AND ID_LOGRADOURO=$ID_LOGRADOURO AND ID_CIDADE=$ID_CIDADE";
    $conn->query($query_cep);
    $rows_cep=$conn->num_rows();
    if ($rows_cep<1) {
      $query_cep="UPDATE ".TBL_CEP." SET ID_CEP=$ID_CEP, ID_LOGRADOURO=$ID_LOGRADOURO, CH_AGUARDO='N',DT_AGUARDO=CURDATE(), ID_USUARIO='$usuario' WHERE ID_CEP=$ID_CEP_ANT AND ID_LOGRADOURO=$ID_LOGRADOURO_ANT AND ID_CIDADE=$ID_CIDADE";
      $conn->query($query_cep);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
    }
    $conn->query($query_trans);
    if (($conn->get_status()==false)|| ($ERRO_TRANS!="")) {
      $ERRO_TRANS.=$conn->get_msg()."\n";
      die($ERRO_TRANS);
    } else {
?>
<script language="javascript" type="text/javascript">//<!--
  alert("Logradouro Validado com Sucesso!!");
  var local=window.location.href;
  var array_local=local.split("/");
  var novo_local="";
  for (var inicial=0; inicial<array_local.length;inicial++) {
    if (array_local[inicial].indexOf(".php")>-1) {
      novo_local+="pen_logradouro.php";
    } else {
      novo_local+=array_local[inicial]+"/";
    }
  }
  window.location.href=novo_local;
//--></script>
<?
    }
  } elseif (($global_inclusao!="S")&&($global_alteracao!="S")){
    if ($global_inclusao!="S") {
      $erro=MSG_ERR_INC;
    } else {
      $erro=MSG_ERR_ALT;
    }
  } else {
    if ((isset($_POST["hdn_id_cidade"])) && (isset($_POST["txt_id_cep"])) && (isset($_POST["cmb_id_tp_logradouro"])) && (isset($_POST["txt_nm_logradouro"])) && (isset($_POST["txt_nm_bairro"])) && (isset($_POST["hdn_id_cep_ant"])) && (isset($_POST["hdn_id_logradouro_ant"])) && (isset($_POST["hdn_id_bairros_ant"]))) {
      $erro=MSG_ERR_OBR;
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
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      //frm.txt_id_rotina.readOnly=false;
    }
    function cons_logra(valor,cidade) {
      window.open("cons_logra_pen.php?txt_nm_logradouro="+valor+"&hdn_id_cidade="+cidade,"cons_logradouro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=400,innerwidth=780,innerheight=400")
    }
    function cons_bairro(valor,cidade) {
      window.open("cons_bairro_pen.php?txt_nm_bairros="+valor+"&hdn_id_cidade="+cidade,"cons_bairro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=400,innerwidth=780,innerheight=400")
    }
//--></script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_cad_logradouro" onreset="retorna(this)" onsubmit="return validaForm(this,'nome_campo,Descritivo,tipo')">
            <table width="95%" cellspacing="0" border="0" cellpadding="2" align="center">
              <tr>
                <td colspan="4">
                  <fieldset>
                    <legend>Validação de Logradouro</legend>
                <table>
                <td>Cidade</td>
                <td width="350">
                  <input type="hidden" name="hdn_id_cidade" value="">
                  <input type="text" name="txt_nm_cidade" value="" class="campo_obr" readOnly="true" size="50" maxlength="100" title="Nome da Cidade">
                </td>
                <td>CEP</td>
                <td>
                  <input type="text" name="txt_id_cep" value="" class="campo_obr" size="12" maxlength="10">
                </td>
              </tr>
              <tr>
                <td colspan="4">
                  <table width="100%" cellspacing="0" border="0" cellpadding="2">
                    <td>Nome Logradouro</td>
                    <td>
                      <select name="cmb_id_tp_logradouro" value="" class="campo_obr" title="Prefixo do Logradouro">
                        <option value="">---------------</option>
                      <?
                        $query_tp_logra="SELECT ID_TP_LOGRADOURO, NM_TP_LOGRADOURO FROM ".TBL_TP_LOGRADOURO;
                        $conn->query($query_tp_logra);
                        while ($tupula=$conn->fetch_row()) {
                      ?>
                        <option value="<?=$tupula["ID_TP_LOGRADOURO"]?>"><?=$tupula["NM_TP_LOGRADOURO"]?></option>
                      <?
                        }
                      ?>
                      </select>
                    </td>
                    <td>
                      <input type="hidden" name="hdn_id_logradouro" value="" class="campo_obr" size="6" maxlength="5" title="Código do Logradouro">
                      <input type="text" name="txt_nm_logradouro" value="" class="campo_obr" size="29" maxlength="100" title="Nome do Logradouro">
                    </td>
                    <td>
                      <input type="button" name="btn_cons_logra" value="Logradouro" class="botao" style="background-image : url('../../imagens/botao.gif');" onClick="cons_logra(document.frm_cad_logradouro.txt_nm_logradouro.value,document.frm_cad_logradouro.hdn_id_cidade.value)">
                    </td>
                  </tr>
                  <tr>
                    <td>Nome Bairro</td>
                    <td colspan="2">
                      <input type="hidden" name="hdn_id_bairro" value="" class="campo_obr" size="6" maxlength="5" title="Código do Bairro">
                      <input type="text" name="txt_nm_bairro" value="" class="campo_obr" size="45" maxlength="50" title="Nome do Bairro">
                    </td>
                    <td>
                      <input type="button" name="btn_cons_bairro" value="Bairro" class="botao" style="background-image : url('../../imagens/botao.gif');" onClick="cons_bairro(document.frm_cad_logradouro.txt_nm_bairro.value,document.frm_cad_logradouro.hdn_id_cidade.value)">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            </table>
            </fieldset>
            </td>
            </tr>
<?
  if ((@$_POST["hdn_id_cep"]!="") && (@$_POST["hdn_id_cidade"]!="") && (@$_POST["hdn_id_logradouro"]!="") && (@$_POST["hdn_id_bairros"]!="")) {
    $query_cons="SELECT ".TBL_CIDADE.".ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE, ".TBL_CEP.".ID_CEP, ".TBL_LOGRADOURO.".ID_LOGRADOURO, ".TBL_LOGRADOURO.".NM_LOGRADOURO, ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO, ".TBL_BAIRROS.".ID_BAIRROS, ".TBL_BAIRROS.".NM_BAIRROS FROM ".TBL_CEP." LEFT JOIN ".TBL_LOGRADOURO." ON (".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE AND ".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE AND ".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS) LEFT JOIN ".TBL_CIDADE." USING(ID_CIDADE) WHERE ".TBL_CIDADE.".ID_CIDADE=".$_POST["hdn_id_cidade"]." AND ".TBL_CEP.".ID_CEP=".$_POST["hdn_id_cep"]." AND ".TBL_LOGRADOURO.".ID_LOGRADOURO=".$_POST["hdn_id_logradouro"];
    $conn->query($query_cons);
    $tupula_cons=$conn->fetch_row(); 
?>
            <tr>
              <td colspan="4">
                <script language="javascript" type="text/javascript">//<!--
                  var frm_at=document.frm_cad_logradouro;
                  frm_at.hdn_id_cidade.value="<?=$tupula_cons["ID_CIDADE"]?>";
                  frm_at.txt_nm_cidade.value="<?=$tupula_cons["NM_CIDADE"]?>";
                  frm_at.txt_id_cep.value="<?=formatCEP($tupula_cons["ID_CEP"])?>";
                  frm_at.cmb_id_tp_logradouro.value="<?=$tupula_cons["ID_TP_LOGRADOURO"]?>";
                  frm_at.hdn_id_logradouro.value="<?=$tupula_cons["ID_LOGRADOURO"]?>";
                  frm_at.txt_nm_logradouro.value="<?=$tupula_cons["NM_LOGRADOURO"]?>";
                  frm_at.hdn_id_bairro.value="<?=$tupula_cons["ID_BAIRROS"]?>";
                  frm_at.txt_nm_bairro.value="<?=$tupula_cons["NM_BAIRROS"]?>";
                //--></script>
                <fieldset>
                  <legend>Logradouro Pendente</legend>
                  <table width="95%" cellspacing="0" border="1" cellpadding="2">
                    <tr>
                      <td>CEP</td>
                      <td class="td_obr">
                        <?=formatCEP($tupula_cons["ID_CEP"])?>
                        <input type="hidden" name="hdn_id_cep_ant" value="<?=$tupula_cons["ID_CEP"]?>">
                      </td>
                      <td>Logradouro</td>
                      <td class="td_obr">
                        <?=$tupula_cons["NM_LOGRADOURO"]?>
                        <input type="hidden" name="hdn_id_logradouro_ant" value="<?=$tupula_cons["NM_LOGRADOURO"]?>">
                      </td>
                    <tr>
                    <tr>
                      <td>Bairro</td>
                      <td class="td_obr">
                        <?=$tupula_cons["NM_BAIRROS"]?>
                        <input type="hidden" name="hdn_id_bairros_ant" value="<?=$tupula_cons["NM_BAIRROS"]?>">
                      </td>
                      <td>Cidade</td>
                      <td class="td_obr"><?=$tupula_cons["NM_CIDADE"]?></td>
                    <tr>
                  </table>
                </fieldset>
              </td>
            </tr>
<?
  }
  include('../../templates/btn_salva.htm');
?>
            </table>
          </form>
<?
  include ('../../templates/footer.htm');
?>

<?
// include ('../../templates/head.htm');
?>
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="servicos.php";
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
  if ((@$_POST["cmb_id_cidade"]!="") && (@$_POST["txt_nm_servico"]!="") && (@$_POST["cmb_ch_boleto_ccbsc"]!="") && (@$_POST["hdn_controle"]!="") && (@$_POST["cmb_ch_operacao"]!="")) {
    $ID_CIDADE=$_POST["cmb_id_cidade"];
    if ($_POST["txt_id_servico"]=="") {
      $ID_SERVICO=0;
    } else {
      $ID_SERVICO=$_POST["txt_id_servico"];
    }
    $NM_SERVICO=formataCampo($_POST["txt_nm_servico"]);
    $CH_BOLETO_CCBSC=formataCampo($_POST["cmb_ch_boleto_ccbsc"]);
    $CH_OPERACAO=formataCampo($_POST["cmb_ch_operacao"]);
    if ($_POST["hdn_controle"]==1) {
      if ($global_inclusao=="S") {
        $sql= "INSERT INTO ".TBL_SERVICO."  (ID_CIDADE, ID_SERVICO, NM_SERVICO, CH_BOLETO_CCBSC,CH_OPERACAO) VALUES ($ID_CIDADE,$ID_SERVICO,$NM_SERVICO,$CH_BOLETO_CCBSC,$CH_OPERACAO)";
      } else {
        $sql="";
        $erro=MSG_ERR_INC;
      }
    }
    if ($_POST["hdn_controle"]==2) {
      if ($global_alteracao=="S") {
        // vriável de mensagem
        $ID_CODIGO_RETORNO=$ID_SERVICO;
        $sql= "UPDATE ".TBL_SERVICO."  set NM_SERVICO=$NM_SERVICO,CH_BOLETO_CCBSC=$CH_BOLETO_CCBSC, CH_OPERACAO=$CH_OPERACAO WHERE ID_SERVICO=$ID_SERVICO AND ID_CIDADE=$ID_CIDADE";
      } else {
        $sql="";
        $erro=MSG_ERR_ALT;
      }
    }
    if ($sql!="") {
      $res= $conn->query($sql);
    }
    if ($conn->get_status()==false) {
      die ($conn->get_msg());
    } else {
     // include ('../../templates/retorno.htm');
    }
  } else {
    if ((isset($_POST["cmb_id_cidade"]))&& (isset($_POST["txt_id_servico"])) && (isset($_POST["txt_nm_servico"])) && (isset($_POST["cmb_ch_boleto_ccbsc"])) && (isset($_POST["cmb_ch_operacao"]))) {
      $erro= MSG_ERR_OBR;
    }
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo1,campo2,campo3,arq) {
      if ((campo1.value!="") && (campo2.value!="")&& (campo2.value!=campo3.value)) {
        window.open(arq+"?campo="+campo1.value+"&campo2="+campo2.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
        campo3.value=campo2.value;
      }
    }
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.txt_id_servico.readOnly=false;
    }
//--></script>
<body onload="ajustaspan()">
<?
 //include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_servicos" onreset="retorna(this)" onsubmit="return validaForm(this,'cmb_id_cidade,Cidade,n','txt_nm_servico,Nome do Serviço,t','cmb_ch_boleto_ccbsc,Boleto CCB,t','cmb_ch_operacao,Operacionalização,t')">
            <table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
              <tr>
                <td width="20">Cidade</td>
                <td width="40">
                  <select name="cmb_id_cidade" class="campo_obr" title="Nome da Cidade onde é Prestado o Serviço" onChange="javascript:document.frm_servicos.hdn_id_servico.value='n'; consultaReg(this,document.frm_servicos.txt_id_servico,document.frm_servicos.hdn_id_servico,'cons_servicos.php');">
                    <option value="">-------</option>
                    <?
                      $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_USUARIO ='".$usuario."' ORDER BY NM_CIDADE";
                      $res= $conn->query($sql);
                      if ($conn->get_status()==false) {
                        die($conn->get_msg());
                      }
                      while ($tupula = $conn->fetch_row()) {
                    ?>
                    <option value="<?=$tupula['ID_CIDADE']?>"><?=$tupula['NM_CIDADE']?></option>
                    <?
                      }
                    ?>
                  </select>
                </td>
                <td width="130">Código do Serviço</td>
                <td>
                  <input type="hidden" name="hdn_id_servico" value="">
                  <input type="text" name="txt_id_servico" class="campo_obr" title="Nome da Rotina" size="6" maxlength="5" align="right" onBlur="consultaReg(document.frm_servicos.cmb_id_cidade,this,document.frm_servicos.hdn_id_servico,'cons_servicos.php')">
                </td>
              </tr>
              <tr>
                <td>Nome</td>
                <td colspan="3"><input type="text" name="txt_nm_servico" size="70" maxlength="50" class="campo_obr" title="Nome do Serviço"></td>
              </tr>
              <tr>
                <td>Boleto CCB</td>
                <td>
                  <select name="cmb_ch_boleto_ccbsc" class="campo_obr" title="Sim para Boleto Impresso pelo CCB, Não para boleto impresso por outros">
                    <option value="S">Sim</option>
                    <option value="N" selected>Não</option>
                  </select>
                </td>
                <td>Operacionalização</td>
                <td>
                  <select name="cmb_ch_operacao" class="campo_obr" title="Operação onde o Serviço será Executado">
                    <option value="">------------------------<option>
                    <option value="P">Projeto</option>
                    <option value="H">Habite-se</option>
                    <option value="F">Funcionamento</option>
                    <option value="G">Projeto Funcionamento</option>
                    <option value="M">Manutenção</option>
                    <option value="T">Todos</option>
                  </select>
                </td>
              </tr>

<?
  include('./templates/btn_inc.htm');
?>
            </table>
          </form>
<?
//  include ('../../templates/footer.htm');
?>

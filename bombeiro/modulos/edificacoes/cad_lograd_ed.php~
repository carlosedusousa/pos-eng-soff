<?
  $erro="";
  require_once 'lib/loader.php';

  $arquivo="cad_logradouro.php";
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  }
  
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();
  
$campos_preenchidos=true;
$campos_existe=true;
$campos_obr= array('txt_id_cep'=>"'txt_id_cep,Número do CEP,t'",
'txt_nm_logradouro'=>"'txt_nm_logradouro,Nome do Logradouro,t'",
'cmb_id_tp_logradouro'=>"'cmb_id_tp_logradouro,Prefixo do Logradouro,n'",
'txt_nm_bairro'=>"'txt_nm_bairro,Nome do Bairro,t'"
);

foreach($campos_obr as $campos_key=>$campos_value) {
  if ($campos_preenchidos==true) {
    if (!isset($_POST[$campos_key])) {
      $campos_existe=false;
      $campos_preenchidos=false;
    } else {
      if ($_POST[$campos_key]=="") {
        $campos_preenchidos=false;
      }
    }
  }
}
$campos_js=implode(",",$campos_obr);
  if ($campos_preenchidos) {
    $ID_CIDADE=formataCampo($_POST["hdn_id_cidade"],'N');
    $ID_CEP=formataCampo($_POST["txt_id_cep"],'N');
    $ID_LOGRADOURO=formataCampo($_POST["hdn_id_logradouro"],'N','D');
    $ID_TP_LOGRADOURO=formataCampo($_POST["cmb_id_tp_logradouro"],'N');
    $NM_LOGRADOURO=formataCampo($_POST["txt_nm_logradouro"]);
    $NM_FONETICA_LOGRADOURO=formataCampo(nr_txt_fonetica($_POST["txt_nm_logradouro"]));
    $ID_BAIRROS=formataCampo($_POST["hdn_id_bairro"],'N','D');
    $NM_BAIRROS=formataCampo($_POST["txt_nm_bairro"]);
    $NM_FONETICA_BAIRROS=formataCampo(nr_txt_fonetica($_POST["txt_nm_bairro"]));
    $DE_COMPLEMENTO=formataCampo($_POST["txt_de_complemento"]);
    $query_trans="BEGIN";
    $conn->query($query_trans);
    $query_trans="COMMIT";
    $ERRO_TRANS="";
    
    $query_bairro="SELECT ID_BAIRROS FROM ".TBL_BAIRROS." WHERE ID_CIDADE=$ID_CIDADE AND ID_BAIRROS=$ID_BAIRROS";
    $conn->query($query_bairro);
    $rows_bairro=$conn->num_rows();
    if ($rows_bairro>0) {
      $query_bairro="UPDATE ".TBL_BAIRROS." SET NM_BAIRROS=$NM_BAIRROS, NM_FONETICA=$NM_FONETICA_BAIRROS, DT_AGUARDO=CURDATE(), CH_AGUARDO='S', ID_USUARIO='$usuario' WHERE ID_CIDADE=$ID_CIDADE AND ID_BAIRROS=$ID_BAIRROS";
    } else {
      $query_bairro="INSERT INTO ".TBL_BAIRROS." (ID_CIDADE, ID_BAIRROS, NM_BAIRROS, NM_FONETICA, DT_AGUARDO, CH_AGUARDO, ID_USUARIO) VALUES ($ID_CIDADE, $ID_BAIRROS, $NM_BAIRROS, $NM_FONETICA_BAIRROS, CURDATE(), 'S', '$usuario')";
    }
    $conn->query($query_bairro);
    echo "<!--aqui bairro:$query_bairro-->\n";
    if ($conn->get_status()==false) {
      $ERRO_TRANS.=$conn->get_msg()."\n";
      $query_trans="ROLLBACK";
    }
    if ($ID_BAIRROS==0) {
      $ID_BAIRROS=$conn->insert_id();
    }

    $query_logra="SELECT ID_LOGRADOURO FROM ".TBL_LOGRADOURO." WHERE ID_CIDADE=$ID_CIDADE AND ID_LOGRADOURO=$ID_LOGRADOURO";
    $conn->query($query_logra);
    $rows_logra=$conn->num_rows();
    if ($rows_logra>0) {
      $query_logra="UPDATE ".TBL_LOGRADOURO." SET NM_LOGRADOURO=$NM_LOGRADOURO, NM_FONETICA=$NM_FONETICA_LOGRADOURO, ID_BAIRROS=$ID_BAIRROS, ID_CIDADE_BAIRROS=$ID_CIDADE, DT_AGUARDO=CURDATE(), CH_AGUARDO='S', ID_USUARIO='$usuario' WHERE ID_CIDADE=$ID_CIDADE AND ID_LOGRADOURO=$ID_LOGRADOURO";
    } else {
      $query_logra="INSERT INTO ".TBL_LOGRADOURO." (ID_CIDADE, ID_LOGRADOURO, NM_LOGRADOURO, NM_FONETICA, ID_BAIRROS, ID_CIDADE_BAIRROS, ID_TP_LOGRADOURO, DT_AGUARDO, CH_AGUARDO, ID_USUARIO) VALUES ($ID_CIDADE, $ID_LOGRADOURO, $NM_LOGRADOURO, $NM_FONETICA_LOGRADOURO, $ID_BAIRROS, $ID_CIDADE, $ID_TP_LOGRADOURO, CURDATE(), 'S', '$usuario')";
    }
    
    echo "<!--aqui logra:$query_logra-->\n";
    $conn->query($query_logra);
    if ($conn->get_status()==false) {
      $ERRO_TRANS.=$conn->get_msg()."\n";
      $query_trans="ROLLBACK";
    } else {
      if ($ID_LOGRADOURO==0) {
        $ID_LOGRADOURO=$conn->insert_id();
      }
    }
    $query_cep="SELECT ID_CEP FROM ".TBL_CEP." WHERE ID_CEP=$ID_CEP AND ID_LOGRADOURO=$ID_LOGRADOURO AND ID_CIDADE=$ID_CIDADE";
    $conn->query($query_cep);
    $rows_cep=$conn->num_rows();
    if ($rows_cep>0) {
      $query_cep="UPDATE ".TBL_CEP." SET DE_COMPLEMENTO=$DE_COMPLEMENTO, CH_AGUARDO='S',DT_AGUARDO=CURDATE(), ID_USUARIO='$usuario' WHERE ID_CEP=$ID_CEP AND ID_CIDADE=$ID_CIDADE AND ID_LOGRADOURO=$ID_LOGRADOURO";
    } else {
      $query_cep="INSERT INTO ".TBL_CEP." (ID_CIDADE, ID_CEP, ID_LOGRADOURO, DE_COMPLEMENTO, CH_AGUARDO, DT_AGUARDO, ID_USUARIO) VALUES ($ID_CIDADE, $ID_CEP, $ID_LOGRADOURO, $DE_COMPLEMENTO, 'S', CURDATE(), '$usuario')";
    }
    echo "<!--aqui cep:$query_cep-->\n";

    $conn->query($query_cep);
    if ($conn->get_status()==false) {
      $ERRO_TRANS.=$conn->get_msg()."\n";
      $query_trans="ROLLBACK";
    }
    $conn->query($query_trans);
    if (($conn->get_status()==false)|| ($ERRO_TRANS!="")) {
      $ERRO_TRANS.=$conn->get_msg()."\n";
      mysql_query("ROLLBACK");
      die($ERRO_TRANS);
    } else {
     include ('../../templates/retorno.htm');
     $query_tp_logra="SELECT NM_TP_LOGRADOURO FROM ".TBL_TP_LOGRADOURO." WHERE ID_TP_LOGRADOURO=$ID_TP_LOGRADOURO";
     $conn->query($query_tp_logra);
     $tupula=$conn->fetch_row();
?>
<script language="javascript" type="text/javascript">//<!--
  var frm_ret=window.opener.document.frm_edificacao;
  frm_ret.txt_nm_tp_logradouro.value="<?=$tupula["NM_TP_LOGRADOURO"]?>";
  frm_ret.hdn_id_logradouro.value="<?=$ID_LOGRADOURO?>";
  frm_ret.txt_nm_logradouro.value="<?=str_replace("'","",$NM_LOGRADOURO)?>";
  frm_ret.txt_nm_bairro.value="<?=str_replace("'","",$NM_BAIRROS)?>";
  frm_ret.hdn_id_cep.value="<?=$ID_CEP?>";
  frm_ret.txt_nr_cep.value="<?=$ID_CEP?>";
  CEP(frm_ret.txt_nr_cep);
  window.close();
//--></script>
<?
    }
  } else {
    if ($campos_existe) {
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
      window.close();
    }
    function cons_logra(valor,cidade) {
      window.open("cons_logradouro.php?txt_nm_logradouro="+valor+"&hdn_id_cidade="+cidade,"cons_logradouro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=450,innerwidth=780,innerheight=450")
    }
    function cons_bairro(valor,cidade) {
      window.open("cons_bairro.php?txt_nm_bairros="+valor+"&hdn_id_cidade="+cidade,"cons_bairro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=450,innerwidth=780,innerheight=450")
    }
    function cons_cep(valor,cidade) {
      if (valor!="") {
        window.open("cons_cep.php?hdn_id_cep="+valor+"&hdn_id_cidade="+cidade,"cons_bairro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=450,innerwidth=780,innerheight=450")
      }
    }
    function ajustaspan1() {
      var obj=document.getElementById("corpo");
      var objln=document.getElementById("lncorpo");
      var objtb=document.getElementById("tbcorpo");
        obj.style.height="290px";
        objln.style.height="295px";
        objtb.style.marginLeft="0px";
        document.frm_cad_logradouro.btn_limpar.value="Fechar";
    }
//--></script>
<body onload="ajustaspan1()">

<form target="_self" enctype="multipart/form-data" method="post" name="frm_cad_logradouro" onreset="retorna(this)" onsubmit="return validaForm(this,<?=$campos_js?>)">
  <input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">
     <table width="90%" cellspacing="2" border="0" cellpadding="2">
    <head>
      <link rel="stylesheet" type="text/css" href="./../../css/menu.css">
      <link type="text/css" rel="stylesheet" href="./../../css/calendario.css" />
      <link rel="stylesheet" type="text/css" href="./../../css/ebombeiro.css">
    </head>
              <tr>
                <td colspan="4">
                  <fieldset>
                    <legend>Cadastro de Logradouro</legend>
                <table width="100%" cellspacing="2" border="0" cellpadding="2">

                <td align="right">Cidade</td>
                <td >
                  <input type="hidden" name="hdn_id_cidade" value="">
                  <input type="text" name="txt_nm_cidade" value="" class="campo_obr" readOnly="true" size="30" maxlength="100" title="Nome da Cidade">
                  <input type="text" name="txt_id_cep" value="" class="campo_obr" size="15" maxlength="10" onBlur="cons_cep(this.value,document.frm_cad_logradouro.hdn_id_cidade.value)">
              </tr>
              <tr>
                <td colspan="4">
                 <table width="100%" cellspacing="2" border="0" cellpadding="2">
                    <td align="right" nowrap="true">Nome Logradouro</td>
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
                      <input type="text" name="txt_nm_logradouro" value="" class="campo_obr" size="42" maxlength="100" title="Nome do Logradouro" onChange="javascript:document.frm_cad_logradouro.hdn_id_logradouro.value='';">
                    </td>
                    <td>
                      <input type="button" name="btn_cons_logra" value="Logradouro" class="botao" onClick="cons_logra(document.frm_cad_logradouro.txt_nm_logradouro.value,document.frm_cad_logradouro.hdn_id_cidade.value)">
                    </td>
                  </tr>
                  <tr>
                    <td align="right" nowrap="true">Nome Bairro</td>
                    <td colspan="2">
                      <input type="hidden" name="hdn_id_bairro" value="" class="campo_obr" size="6" maxlength="5" title="Código do Bairro">
                      <input type="text" name="txt_nm_bairro" value="" class="campo_obr" size="70" maxlength="50" title="Nome do Bairro" onChange="javascript:document.frm_cad_logradouro.hdn_id_bairro.value='';document.frm_cad_logradouro.hdn_id_logradouro.value='';">
                    </td>
                    <td>
                      <input type="button" name="btn_cons_bairro" value="Bairro" class="botao" onClick="cons_bairro(document.frm_cad_logradouro.txt_nm_bairro.value,document.frm_cad_logradouro.hdn_id_cidade.value)">
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
  include('../../templates/btn_salva.htm');
?>
            </table>
          </form>
<?
  if ((@$_GET["txt_id_cep"]!="") && (@$_GET["hdn_id_cidade"]!="")) {
?>
<script language="javascript" type="text/javascript">//<!--
  document.frm_cad_logradouro.txt_id_cep.value="<?=$_GET["txt_id_cep"]?>";
  document.frm_cad_logradouro.txt_nm_logradouro.value="<?=@$_GET["txt_nm_logradouro"]?>";
  document.frm_cad_logradouro.txt_nm_bairro.value="<?=@$_GET["txt_nm_bairro"]?>";
  document.frm_cad_logradouro.hdn_id_cidade.value="<?=$_GET["hdn_id_cidade"]?>";
  document.frm_cad_logradouro.txt_nm_cidade.value="<?=@$_GET["txt_nm_cidade"]?>";
  if (window.confirm("Deseja Consultar CEP: <?=$_GET["txt_id_cep"]?>?")) {
    cons_cep(document.frm_cad_logradouro.txt_id_cep.value,document.frm_cad_logradouro.hdn_id_cidade.value);
  }
//--></script>
<?
  } elseif (@$_GET["hdn_id_cidade"]!="") {
?>
<script language="javascript" type="text/javascript">//<!--
  document.frm_cad_logradouro.hdn_id_cidade.value="<?=$_GET["hdn_id_cidade"]?>";
  document.frm_cad_logradouro.txt_nm_cidade.value="<?=@$_GET["txt_nm_cidade"]?>";
//--></script>
<?
  } else {
?>
<script language="javascript" type="text/javascript">//<!--
  alert("ERRO Código da Cidade Indefinido!!!");
  window.close();
//--></script>
<?
  } 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <script language="JavaScript" type="text/javascript" src="../../js/sigat_div.js"></script>
</head>
<body>
<?
  if ((@$_GET["campo"]!="")&&(@$_GET["campo2"]!="")) {
    $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
    $arquivo="analise.php";
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
    $perfil=$global_obj_sessao->is_perfiled_in();
// campo de seleção
    $ID_CIDADE=$_GET["campo"];
    $ID_PROTOCOLO=strtoupper($_GET["campo2"]);
    $gerencia=$_GET["gerencia"];
    $query="SELECT ".TBL_ANALISE.".ID_ANALISE, ".TBL_ANALISE.".ID_CNPJ_CPF_SOLICITANTE, ".TBL_PESSOA.".NM_PESSOA, ".TBL_PESSOA.".NR_FONE, ".TBL_PESSOA.".DE_EMAIL_PESSOA, ".TBL_ANALISE.".ID_EDIFICACAO,".TBL_ANALISE.".CH_PARCER, ".TBL_ANALISE.".DE_INDEFERIMENTO, ".TBL_PROTOCOLOS.".ID_SOLICITACAO, ".TBL_PROTOCOLOS.".ID_TIPO_SOLICITACAO, ".TBL_EDIFICACAO.".NM_EDIFICACAO, ".TBL_EDIFICACAO.".NR_EDIFICACAO, ".TBL_EDIFICACAO.".NM_COMPLEMENTO, ".TBL_EDIFICACAO.".VL_AREA_CONSTRUIDA, ".TBL_EDIFICACAO.".ID_CEP, ".TBL_EDIFICACAO.".ID_LOGRADOURO, ".TBL_LOGRADOURO.".NM_LOGRADOURO, ".TBL_LOGRADOURO.".ID_BAIRROS, ".TBL_BAIRROS.".NM_BAIRROS, ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO,".TBL_CARAC_ED.".ID_CARC_EDIFICACAO, ".TBL_CARAC_ED.".DE_PLANO_ACAO FROM ".TBL_ANALISE." LEFT JOIN ".TBL_PROTOCOLOS." ON (".TBL_ANALISE.".ID_PROTOCOLO=".TBL_PROTOCOLOS.".ID_PROTOCOLO AND ".TBL_ANALISE.".ID_CIDADE=".TBL_PROTOCOLOS.".ID_CIDADE) LEFT JOIN ".TBL_PESSOA." ON (".TBL_ANALISE.".ID_CNPJ_CPF_SOLICITANTE=".TBL_PESSOA.".ID_CNPJ_CPF AND ".TBL_ANALISE.".ID_CIDADE_PESSOA=".TBL_PESSOA.".ID_CIDADE) LEFT JOIN ".TBL_EDIFICACAO." ON (".TBL_ANALISE.".ID_EDIFICACAO=".TBL_EDIFICACAO.".ID_EDIFICACAO AND ".TBL_ANALISE.".ID_CIDADE_EDIFICACAO=".TBL_EDIFICACAO.".ID_CIDADE) LEFT JOIN ".TBL_CARAC_ED." ON (".TBL_EDIFICACAO.".ID_EDIFICACAO=".TBL_CARAC_ED.".ID_EDIFICACAO AND ".TBL_EDIFICACAO.".ID_CIDADE=".TBL_CARAC_ED.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_EDIFICACAO.".ID_CEP=".TBL_CEP.".ID_CEP AND ".TBL_EDIFICACAO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_EDIFICACAO.".ID_CIDADE_CEP=".TBL_CEP.".ID_CIDADE) LEFT JOIN ".TBL_LOGRADOURO." ON (".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) WHERE ".TBL_ANALISE.".ID_PROTOCOLO=$ID_PROTOCOLO AND ".TBL_ANALISE.".ID_CIDADE=$ID_CIDADE AND (".TBL_CARAC_ED.".CH_ATIVO='S' OR ".TBL_CARAC_ED.".CH_ATIVO IS NULL) ORDER BY ".TBL_CARAC_ED.".CH_ATIVO";


    $conn->query($query);
     if ($conn->get_status()==false) {
       die($conn->get_msg());
    }


    $rows=$conn->num_rows();

    if ($rows>0) {

	  while($registro = $conn->fetch_row()) {
		$registros[] = $registro;
	  }

	  $tupula = $registros[count($registros)-1];

?>
<script language="javascript" type="text/javascript">//<!--
var afrm = window.opener.document.frm_analise
if (window.opener.confirm("Exite Análise para este Protocolo. Deseja Carregar?")) {
  

afrm.hdn_id_solicitacao.value="<?=$tupula["ID_SOLICITACAO"]?>";
afrm.hdn_id_tipo_solicitacao.value="<?=$tupula["ID_TIPO_SOLICITACAO"]?>";
afrm.txt_id_edificacao.value="<?=$tupula["ID_EDIFICACAO"]?>";
afrm.hdn_id_carac_edificacao.value="<?=$tupula["ID_CARC_EDIFICACAO"]?>";
afrm.hdn_de_plano_acao.value="<?=$tupula["DE_PLANO_ACAO"]?>";
afrm.hdn_id_analise.value="<?=$tupula["ID_ANALISE"]?>";
afrm.txt_nr_cnpjcpf_solicitante.value="<?=$tupula["ID_CNPJ_CPF_SOLICITANTE"]?>";
window.opener.cpfcnpj(afrm.txt_nr_cnpjcpf_solicitante);
afrm.txt_nm_solicitante.value="<?=$tupula["NM_PESSOA"]?>";
afrm.txt_nr_fone_solicitante.value="<?=$tupula["NR_FONE"]?>";
afrm.txt_nm_email_solicitante.value="<?=$tupula["DE_EMAIL_PESSOA"]?>";
afrm.txt_nm_edificacao.value="<?=$tupula["NM_EDIFICACAO"]?>";
afrm.hdn_id_tp_prefixo.value="<?=$tupula["ID_TP_LOGRADOURO"]?>";
afrm.txt_nm_tp_prefixo.value="<?=$tupula["NM_TP_LOGRADOURO"]?>";
afrm.txt_nm_logradouro.value="<?=$tupula["NM_LOGRADOURO"]?>";
afrm.txt_nr_edificacao.value="<?=$tupula["NR_EDIFICACAO"]?>";
afrm.txt_nm_bairro.value="<?=$tupula["NM_BAIRROS"]?>";
afrm.txt_id_cep.value="<?=$tupula["ID_CEP"]?>";
afrm.txt_nm_complemento.value="<?=$tupula["NM_COMPLEMENTO"]?>";
afrm.txt_vl_area_construida.value="<?=str_replace(".",",",$tupula["VL_AREA_CONSTRUIDA"])?>";
FormatNumero(afrm.txt_vl_area_construida);
decimal(afrm.txt_vl_area_construida,2);
afrm.cmb_ch_parecer.value="<?=$tupula["CH_PARCER"]?>";
<?
/*
  if (@$gerencia!="1"){
  	if ($tupula["CH_PARCER"]=="D"){
*/
?>
  afrm.btn_incluir.disabled=true;
  afrm.btn_incluir.style.backgroundImage="url('../../imagens/botao2.gif')";
  //afrm.btn_edificacao.disabled=true;
  //afrm.btn_edificacao.style.backgroundImage="url('../../imagens/botao2.gif')";
  afrm.btn_edificacao.disabled=false;
  afrm.btn_edificacao.style.backgroundImage="url('../../imagens/botao.gif')";
  //window.opener.alert("Análise Deferida, Alteração Negada!!");
<?
/*
  }
  	} 
*/
  if ($tupula["CH_PARCER"]=="I" || $tupula["CH_PARCER"]=="D") {
?>
  afrm.txa_mtv_indeferimento.disabled=false;
  afrm.hdn_mtv_indeferimento.value="I";
<?
      $DE_OBSERVACOES=str_replace("\"","\\\"",str_replace("\n","\r",$tupula["DE_INDEFERIMENTO"]));
      if (strpos($DE_OBSERVACOES,"\n")>(-1)) {
        $de_obs=explode("\n",$DE_OBSERVACOES);
      } elseif (strpos($DE_OBSERVACOES,"\r")>(-1)) {
        $de_obs=explode("\r",$DE_OBSERVACOES);
      } else {
        $de_obs[0]=str_replace("\n","\\n",str_replace("\r","\\r",$tupula["DE_INDEFERIMENTO"]));
      }
?>
  afrm.txa_mtv_indeferimento.value="<?=$de_obs[0]?>";
<?
  if (count($de_obs)>1) {
    for ($i=1;$i<count($de_obs);$i++) {
?>
  afrm.txa_mtv_indeferimento.value+="\n";
  afrm.txa_mtv_indeferimento.value+="<?=$de_obs[$i]?>";
<?
    }
  }
?>
  afrm.btn_incluir.disabled=false;
  afrm.btn_incluir.style.backgroundImage="url('../../imagens/botao.gif')";
  afrm.btn_edificacao.disabled=false;
  afrm.btn_edificacao.style.backgroundImage="url('../../imagens/botao.gif')";

<?
  } else {
?>
  afrm.btn_incluir.disabled=false;
  afrm.btn_incluir.style.backgroundImage="url('../../imagens/botao.gif')";
  afrm.btn_edificacao.disabled=false;
  afrm.btn_edificacao.style.backgroundImage="url('../../imagens/botao.gif')";
<?
  }
?>
//  afrm.txt_id_.readOnly=true;
} else {
  afrm.txt_id_protocolo.value="";
  afrm.txt_id_protocolo.focus();
}
// --></script>
<?
    } else {
?>
<script language="javascript" type="text/javascript">//<!--
window.opener.alert("Não Exite Análise para o Protocolo:<?=$ID_PROTOCOLO?>!!");
// --></script>

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

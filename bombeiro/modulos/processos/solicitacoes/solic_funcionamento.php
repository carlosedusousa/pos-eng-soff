<? //echo "<pre>asdf"; print_r($_REQUEST); echo "</pre>"; exit; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title>SIGAT - SOLICITAÇÃO DE FUNCIONAMENTO</title>
  <link rel="stylesheet" type="text/css" href="../../css/menu.css">
  <link rel="stylesheet" type="text/css" href="../../css/sigat.css">
  <script language="JavaScript" type="text/javascript" src="../../js/sigat_div.js"></script>
  <script language="JavaScript" type="text/javascript" src="../../js/editcombo.js"></script>
  <script language="JavaScript" type="text/javascript">
    if (window.screen) {
      tamtela=screen.availWidth;
      if (tamtela>800) {
        var MENU_POS1 = new Array();
          // tamanhos de itens dos diferentes néveis do menu
          MENU_POS1['height'] = [20, 20, 20];
          MENU_POS1['width'] = [152, 147, 147];
          // menu block offset from the origin:
          //  for root level origin is upper left corner of the page
          //  for other levels origin is upper left corner of parent item
          MENU_POS1['block_top'] = [100, 20, 0];
          MENU_POS1['block_left'] = [125, 0, 141];
          // offsets between items of the same level
          MENU_POS1['top'] = [0, 20, 20];
          MENU_POS1['left'] = [152, 0, 0];
          // time in milliseconds before menu is hidden after cursor has gone out
          // of any items
          MENU_POS1['hide_delay'] = [200, 200, 200];
      } else {
        var MENU_POS1 = new Array();
        // tamanhos de itens dos diferentes néveis do menu
        MENU_POS1['height'] = [20, 20, 20];
        MENU_POS1['width'] = [152, 147, 147];
        // menu block offset from the origin:
        //  for root level origin is upper left corner of the page
        //  for other levels origin is upper left corner of parent item
        MENU_POS1['block_top'] = [100, 20, 0];
        MENU_POS1['block_left'] = [5, 0, 141];
        // offsets between items of the same level
        MENU_POS1['top'] = [0, 20, 20];
        MENU_POS1['left'] = [152, 0, 0];
        // time in milliseconds before menu is hidden after cursor has gone out
        // of any items
        MENU_POS1['hide_delay'] = [200, 200, 200];
      }
    }
    function ajustaspan() {
      var obj=document.getElementById("corpo");
      var objln=document.getElementById("lncorpo");
      var objtb=document.getElementById("tbcorpo");
      if (tamtela>800) {
        obj.style.height="440px";
        objln.style.height="440px";
        //alert(objtb.style.marginLeft);
        objtb.style.marginLeft="125px";
       // alert(objtb.style.left);
      } else {
        obj.style.height="295px";
        objln.style.height="300px";
        objtb.style.marginLeft="0px";
      }
    }
  </script>
</head>
<?
  $erro="";
  require_once 'lib/loader_client.php';
  $userlogin=USUARIO_SOLICITACAO;
  $passwd=SENHA_SOLICITACAO;
  $rotina="25";
  $ses=$global_obj_sessao->authenticate ($userlogin, $passwd,$rotina);
// Conectando ao BD
  $arquivo="solic_funcionamento.php";

  $conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) die($conn->get_msg());

  if ($_POST['hdn_id_cidade']) {

    /* Responsavel pela troca do host do banco onde sera feita a insercao da solicitacao via WEB */
    $sql = "select CADASTROS.TP_SERVIDOR.NM_IP from CADASTROS.CIDADE_SERVIDOR LEFT JOIN CADASTROS.TP_SERVIDOR USING (ID_SERVIDOR) where CADASTROS.CIDADE_SERVIDOR.ID_CIDADE = $_POST[hdn_id_cidade]";
    //echo "sql: $sql"; exit;
    $conn->query($sql);
    if ($registro = $conn->fetch_row()) $host = $registro['NM_IP']; else die("Cidade n&atilde;o dadastrada no banco de dados<br>Fazer solicita&ccedil;&atilde;o no protocolo da cidade");
    //echo "host: $host"; exit;
    $conn = new BD ($host, BD_USER, BD_PASS, BD_NOME_SOLICITACAO);
    if ($conn->get_status()==false) die($conn->get_msg());
    //echo "<pre>"; print_r($conn); echo "</pre>"; exit;
  }

  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  // executando a consulta
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row();

$campos_preenchidos=true;
$campos_existe=true;
  
$campos_obr= array('txt_nr_cnpj_empresa'=>"'txt_nr_cnpj_empresa,CNPJ da Empresa Solicitante,t'",
'txt_nm_solicitante'=>"'txt_nm_solicitante,Razão Social,t'",
'txt_nm_fantasia_empresa'=>"'txt_nm_fantasia_empresa,Nome Fantasia do Solicitante,t'",
'txt_nm_contato'=>"'txt_nm_contato,Nome da Pessoa de Contato,t'",
'txt_nr_fone_empresa'=>"'txt_nr_fone_empresa,Número do Fone Solicitante,n'",
'txt_de_email_empresa'=>"'txt_de_email_empresa,E-mail da Empresa Solicitante,e'",
'txt_nm_proprietario'=>"'txt_nm_proprietario,Nome Proprietário Edificação,t'",
'txt_nr_cnpjcpf_proprietario'=>"'txt_nr_cnpjcpf_proprietario,CNPJ/CPF do Proprietário Edificação,t'",
'txt_fone_proprietario'=>"'txt_fone_proprietario,Número do Fone do Proprietário da Edificação,t'",
'txt_de_email_proprietario'=>"'txt_de_email_proprietario,E-mail do Proprietário da Edificação,e'",
'txt_nm_edificacao'=>"'txt_nm_edificacao,Nome da Edificação,t'",
'cmb_id_tp_prefixo'=>"'cmb_id_tp_prefixo,Prefixo do Logradouro,t'",
'txt_nm_logradouro'=>"'txt_nm_logradouro,Nome do Logradouro,t'",
'hdn_id_cidade'=>"'hdn_id_cidade,Cidade da Edificação,t'",
'txt_nm_bairro'=>"'txt_nm_bairro,Nome do Bairro,t'",
'txt_nr_cep'=>"'txt_nr_cep,Número do CEP,t'",
'txt_vl_area_tot_const'=>"'txt_vl_area_tot_const,Valor da Área total Construída,t'",
'cmb_id_ocupacao'=>"'cmb_id_ocupacao,Tipo de Ocupação,n'",
'cmb_id_risco'=>"'cmb_id_risco,Tipo Risco da Edificação,n'",
'cmb_id_situacao'=>"'cmb_id_situacao,Situação da Edificação,n'",
'cmb_id_tp_construcao'=>"'cmb_id_tp_construcao,Tipo de Construção'",
'cmb_nr_pavimentos'=>"'cmb_nr_pavimentos,Número de Pavimentos,n'",
'cmb_nr_blocos'=>"'cmb_nr_blocos,Número de Blocos,n'"
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
    // string da query
    $ID_SOLIC_FUNC   			= "0";
    $ID_TP_FUNC        			= "'S'";
    $NR_CNPJ_EMPRESA       		= formataCampo($_POST["txt_nr_cnpj_empresa"],'VN');
    $NM_RAZAO_SOCIAL        	= formataCampo($_POST["txt_nm_solicitante"]);
    $NM_FANTASIA_EMPRESA		= formataCampo($_POST["txt_nm_fantasia_empresa"]);
    $NM_CONTATO					= formataCampo($_POST["txt_nm_contato"]);
    $NR_FONE_EMPRESA        	= formataCampo($_POST["txt_nr_fone_empresa"],"VN");
    $DE_EMAIL_EMPRESA       	= formataCampo($_POST["txt_de_email_empresa"],"t","l");
    $NR_CNPJ_CPF_PROPRIETARIO	= formataCampo(str_replace("-","",str_replace("/","",str_replace(".","",$_POST["txt_nr_cnpjcpf_proprietario"]))));
    $NM_PROPRIETARIO            = formataCampo($_POST["txt_nm_proprietario"]);
    $NR_FONE_PROPRIETARIO       = formataCampo($_POST["txt_fone_proprietario"],"n");
    $DE_EMAIL_PROPRIETARIO      = formataCampo($_POST["txt_de_email_proprietario"],"t","l");
    $NM_EDIFICACOES          	= formataCampo($_POST["txt_nm_edificacao"]);
    $NM_FANTASIA                = formataCampo(@$_POST["txt_nm_fantasia"]);
    $NM_LOGRADOURO              = formataCampo($_POST["txt_nm_logradouro"]);
    $NR_EDIFICACOES          	= formataCampo(@$_POST["txt_nr_numero"],"n");
    $NR_CEP                     = formataCampo(@$_POST["txt_nr_cep"],"n");
    $NM_BAIRRO                  = formataCampo($_POST["txt_nm_bairro"]);
    $NM_COMPLEMENTO             = formataCampo(@$_POST["txt_nm_complemento"]);
    $VL_AREA_CONSTRUIDA         = formataCampo($_POST["txt_vl_area_tot_const"],"D");
    $ID_RISCO					= formataCampo($_POST["cmb_id_risco"],'N');
    $ID_TP_CONSTRUCAO			= formataCampo($_POST["cmb_id_tp_construcao"],"N");
    $ID_OCUPACAO				= formataCampo($_POST["cmb_id_ocupacao"],"N");
    $ID_SITUACAO				= formataCampo($_POST["cmb_id_situacao"],"N");
    $NR_PAVIMENTOS				= formataCampo($_POST["cmb_nr_pavimentos"],"N");
    $NR_BLOCOS					= formataCampo($_POST["cmb_nr_blocos"],"N");
    $ID_CIDADE                  = formataCampo($_POST["hdn_id_cidade"],"N");
    $CH_PROTOCOLADO             = "'S'";
    $ID_TP_LOGRADOURO           = $_POST["cmb_id_tp_prefixo"];
    $CH_PAGO					= "'N'";
    $DT_SOLICITACAO       		= "CURDATE()";
    $nomes_desc					= explode("^",$_POST["hdn_nm_desc_funcionamento"]);
    $valores_desc				= explode("^",$_POST["hdn_vl_desc_funcionamento"]);
    $blocos_desc				= explode("^",$_POST["hdn_nm_bloco_desc_funcionamento"]);
    $CH_TP_FUNCIONAMENTO		= $_POST["cmb_ch_tp_funcionamento"];
    $ID_CIDADE_CEP				= $ID_CIDADE;
    $ID_USUARIO					= "'$userlogin'";
    $CH_AGUARDO_LOGRADOURO		= "'S'";
    $DT_AGUARDO_LOGRADOURO		= "CURDATE()";
    $PROTOCOLO_REGIN            = formataCampo(@$_POST["hdn_protocolo_regin"],"n");


    $l_cpfcnpj	= str_replace('.','',(str_replace('-','',(str_replace('/','',$_POST['txt_nr_cnpj_empresa'])))));
    $l_cidade	= $_POST['hdn_id_cidade'];

	// verificar se já existe solicitação deste CPF/CNPJ

	$sql="SELECT ".
		TBL_SOL_FUNC.".ID_CIDADE, ".TBL_SOL_FUNC.".ID_SOLIC_FUNC, ".TBL_SOL_FUNC.".ID_TP_FUNC, ".
		TBL_SOL_FUNC.".NM_EDIFICACOES, ".
		TBL_SOL_FUNC.".NM_LOGRADOURO, ".
		TBL_SOL_FUNC.".ID_CEP, ".
		TBL_SOL_FUNC.".NM_BAIRRO, ".
		TBL_SOL_FUNC.".NR_EDIFICACOES, ".
		TBL_SOL_FUNC.".NM_FANTASIA_EMPRESA, ".
		TBL_SOL_FUNC.".CH_PROTOCOLADO, ".
		TBL_SOL_FUNC.".NR_CNPJ_EMPRESA, ".
		TBL_SOL_FUNC.".NM_RAZAO_SOCIAL, ".
		TBL_CIDADE.".NM_CIDADE, DATE_FORMAT(".TBL_SOL_FUNC.".DT_SOLICITACAO,'%d/%m/%Y') DT_SOLICITACAOS, (TO_DAYS('".date("Y-m-d")."') - TO_DAYS(".TBL_SOL_FUNC.".DT_SOLICITACAO)) AS DIAS FROM ".
		TBL_SOL_FUNC." JOIN ".TBL_CIDADE." USING(ID_CIDADE) " .
	 "WHERE ".
	 	TBL_SOL_FUNC.".CH_PROTOCOLADO IN ('S','J','P') AND ".
		TBL_SOL_FUNC.".NR_CNPJ_EMPRESA = ".$l_cpfcnpj." AND ".
	 	TBL_SOL_FUNC.".ID_CIDADE = ".$l_cidade." ".
	 "ORDER BY DT_SOLICITACAO ASC, NM_CIDADE ASC";

//echo "sql: $sql"; exit;

	$conn->query($sql);
	$rows_pendente=$conn->num_rows();
	$encontrouSolicitacao = false;
	while ($pendente = $conn->fetch_row()) {
		if(!$encontrouSolicitacao) $encontrouSolicitacao = true;
		$solicitacoes[] = $pendente;
	} 

	//echo "<pre>"; print_r(@$solicitacoes); echo "</pre>";

//echo "<pre>"; print_r($solicitacoes); echo "</pre>"; exit;

	if(!$encontrouSolicitacao || @$_POST[btn_enviar_solicitacao]) {

		// INSERIR REGISTRO 
		
	    $query_trans="BEGIN";
	    $res= $conn->query($query_trans);
	    $query_trans="COMMIT";
	    $sql= "INSERT INTO ".TBL_SOL_FUNC." (ID_CIDADE, ID_SOLIC_FUNC, ID_TP_FUNC, CH_PAGO, NR_CNPJ_EMPRESA, NM_RAZAO_SOCIAL, NR_FONE_EMPRESA, DE_EMAIL_EMPRESA, NR_CNPJ_CPF_PROPRIETARIO, NM_PROPRIETARIO, NR_FONE_PROPRIETARIO, DE_EMAIL_PROPRIETARIO, NM_EDIFICACOES, NM_FANTASIA, ID_TP_LOGRADOURO, NM_LOGRADOURO, NR_EDIFICACOES, NR_CEP, NM_BAIRRO, NM_COMPLEMENTO, VL_AREA_CONSTRUIDA, CH_PROTOCOLADO, DT_SOLICITACAO, CH_AGUARDO_LOGRADOURO, DT_AGUARDO_LOGRADOURO, ID_USUARIO, ID_RISCO, ID_TP_CONSTRUCAO, ID_OCUPACAO, ID_SITUACAO, NM_CONTATO, NM_FANTASIA_EMPRESA, CH_TP_FUNC, " .
            "PROTOCOLO_REGIN" .
        ") VALUES ($ID_CIDADE, $ID_SOLIC_FUNC,$ID_TP_FUNC,$CH_PAGO, $NR_CNPJ_EMPRESA, $NM_RAZAO_SOCIAL, $NR_FONE_EMPRESA, $DE_EMAIL_EMPRESA, $NR_CNPJ_CPF_PROPRIETARIO, $NM_PROPRIETARIO, $NR_FONE_PROPRIETARIO, $DE_EMAIL_PROPRIETARIO, $NM_EDIFICACOES, $NM_FANTASIA, $ID_TP_LOGRADOURO, $NM_LOGRADOURO, $NR_EDIFICACOES, $NR_CEP, $NM_BAIRRO, $NM_COMPLEMENTO, $VL_AREA_CONSTRUIDA, $CH_PROTOCOLADO, $DT_SOLICITACAO, $CH_AGUARDO_LOGRADOURO, $DT_AGUARDO_LOGRADOURO, $ID_USUARIO, $ID_RISCO, $ID_TP_CONSTRUCAO, $ID_OCUPACAO, $ID_SITUACAO, $NM_CONTATO, $NM_FANTASIA_EMPRESA, '$CH_TP_FUNCIONAMENTO','$PROTOCOLO_REGIN')";
	    // executando o insert
	    $res = $conn->query($sql);
	    // testando se houve algum erro
	    if ($conn->get_status()==false) {
	      $query_trans="ROLLBACK";
	      mysql_query($query_trans);
	      die($conn->get_msg());
	    } else {
	      $ID_SOLIC_FUNC=mysql_insert_id();
	      $ID_DESC_FUNC=0;
	      $query_desc_sub="";
	      if ($CH_TP_FUNCIONAMENTO=="P") {
	        for ($num_desc=0; $num_desc<count($nomes_desc); $num_desc++) {
	          if ((trim($nomes_desc[$num_desc])!="") && (trim($valores_desc[$num_desc])!="")) {
	            $NM_DESC_FUNC=formataCampo($nomes_desc[$num_desc]);
	            $VL_AREA_DESC_VISTORIAS=formataCampo($valores_desc[$num_desc],"D");
				// $NR_PAVIMENTOS_DESC=formataCampo($pavimentos_desc[$num_desc],"N");
	            $NR_PAVIMENTOS_DESC=0;
	            $NM_BLOCO=formataCampo($blocos_desc[$num_desc]);
	            if ($query_desc_sub!="") {
	              $query_desc_sub.=",\n";
	            }
	            $query_desc_sub.=" ($ID_CIDADE, $ID_SOLIC_FUNC, $ID_TP_FUNC, $ID_DESC_FUNC, $NM_DESC_FUNC, $NR_PAVIMENTOS_DESC, $NM_BLOCO, $VL_AREA_DESC_VISTORIAS)";
	          }
	        }
	      } else {
	        $query_desc_sub.=" ($ID_CIDADE, $ID_SOLIC_FUNC, $ID_TP_FUNC, $ID_DESC_FUNC, 'ÁREA TOTAL DA EDIFICAÇÃO', $NR_PAVIMENTOS, 'TODOS', $VL_AREA_CONSTRUIDA)";
	      }
	      $query_desc="INSERT INTO ".TBL_DESC_FUNC." (ID_CIDADE, ID_SOLIC_FUNC, ID_TP_FUNC, ID_DESC_FUNC, NM_DESC_FUNC, NR_PAVIMENTO, NM_BLOCO, VL_AREA_DESC_FUNC) VALUES $query_desc_sub;";
	        $res= $conn->query($query_desc);
	        if ($conn->get_status()==false) {
	          $query_trans="ROLLBACK";
	          mysql_query($query_trans);
	          die($conn->get_msg());
	        } else {
	        	echo "<script>alert('Solicitação enviada com sucesso!');</script>";
	        }
	        $res= $conn->query($query_trans);
	
			?> <script language="JavaScript" type="text/javascript"> <?
			if ($ID_SOLIC_FUNC>0) {
		      //echo "alert('RELATÓRIO!');\n";
		      echo 'window.open("rsolic_funcionamento.php?id_solicitacao='.@$ID_SOLIC_FUNC.'&id_cidade='.@$ID_CIDADE.'&id_tipo_solicitacao='.@$ID_TP_FUNC.'","xdes","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");';
		      echo "window.location.href='$arquivo';\n";
			}
			?> </script> <?
	    }

	} // (!$encontrouSolicitacao || @$_POST[btn_enviar_solicitacao])	

  } else {
    if ($campos_existe) {
      $erro= "echo '<tr><td align=\"center\" style=\"background-color : #f7ff05; color : #ff0000; font-weight : bold;\">OS CAMPOS ASSINALADOS SÃO OBRIGATÓRIOS</td></tr>';\n";
    }

  }

?>
<script language="JavaScript" type="text/javascript">
function carrega_desc(camp_desc) {
  var dfrm=document.frm_solic_funcionamento;
  if (camp_desc.value!="") {
    dfrm.hdn_id_desc_funcionamento_tmp.value=camp_desc.value;
    var indice_car=camp_desc.value-1;
    var nomes=dfrm.hdn_nm_desc_funcionamento.value.split("^");
    var valores=dfrm.hdn_vl_desc_funcionamento.value.split("^");
    var blocos=dfrm.hdn_nm_bloco_desc_funcionamento.value.split("^");
    dfrm.txt_nm_desc_funcionamento_tmp.value=nomes[indice_car];
    dfrm.txt_vl_desc_funcionamento_tmp.value=valores[indice_car];
    dfrm.txt_nm_bloco_desc_funcionamento_tmp.value=blocos[indice_car];
    dfrm.btn_incluir_desc.disabled=false;
    dfrm.btn_incluir_desc;
    dfrm.btn_incluir_desc.disabled=true;
    dfrm.btn_excluir_desc.disabled=false;
    dfrm.btn_excluir_desc;
  } else {
    dfrm.txt_nm_desc_funcionamento_tmp.value="";
    dfrm.txt_vl_desc_funcionamento_tmp.value="";
    dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";
    dfrm.hdn_id_desc_funcionamento_tmp.value="";
    dfrm.btn_incluir_desc.disabled=false;
    dfrm.btn_incluir_desc;
    dfrm.btn_incluir_desc.disabled=true;
    dfrm.btn_excluir_desc.disabled=false;
    dfrm.btn_excluir_desc;
    dfrm.btn_excluir_desc.disabled=true;
  }
}
function insere_desc() {
  var dfrm=document.frm_solic_funcionamento;
  var nomes=dfrm.hdn_nm_desc_funcionamento.value.split("^");
  for (var i=0; i<nomes.length; i++) {
    if (nomes[i]==dfrm.txt_nm_desc_funcionamento_tmp.value) {
      alert("Nome da Referência já Existe!!");
      return;
    }
  }
  sec_cmb_desc_funcionamento=dfrm.cmb_desc_funcionamento.options.length++;
  dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text=dfrm.txt_nm_desc_funcionamento_tmp.value;
  dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value=sec_cmb_desc_funcionamento;
  dfrm.hdn_nm_desc_funcionamento.value+=dfrm.txt_nm_desc_funcionamento_tmp.value+"^";
  dfrm.hdn_vl_desc_funcionamento.value+=dfrm.txt_vl_desc_funcionamento_tmp.value+"^";
  dfrm.hdn_nm_bloco_desc_funcionamento.value+=dfrm.txt_nm_bloco_desc_funcionamento_tmp.value+"^";
//   dfrm.hdn_nr_pavimento_desc_funcionamento.value+=dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value+"^";
  dfrm.txt_nm_desc_funcionamento_tmp.value="";

  if (dfrm.txt_vl_tot_vistoria.value=="") {
    dfrm.txt_vl_tot_vistoria.value=dfrm.txt_vl_desc_funcionamento_tmp.value;
  } else {
    var valor_tmp=dfrm.txt_vl_desc_funcionamento_tmp.value;
    var tot=dfrm.txt_vl_tot_vistoria.value;
    while (tot.indexOf(".")>-1) {
      tot=tot.replace(".","");
    }
    while (tot.indexOf(",")>-1) {
      tot=tot.replace(",",".");
    }
    while (valor_tmp.indexOf(".")>-1) {
      valor_tmp=valor_tmp.replace(".","");
    }
    while (valor_tmp.indexOf(",")>-1) {
      valor_tmp=valor_tmp.replace(",",".");
    }
    tot=parseFloat(tot)+parseFloat(valor_tmp)+"";
    while (tot.indexOf(".")>-1) {
      tot=tot.replace(".",",");
    }
    dfrm.txt_vl_tot_vistoria.value=tot;
    FormatNumero(dfrm.txt_vl_tot_vistoria);
    decimal(dfrm.txt_vl_tot_vistoria,2);
  }
  dfrm.txt_vl_desc_funcionamento_tmp.value="";
  dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";
//   dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=0;
  dfrm.txt_nm_desc_funcionamento_tmp.focus();
  dfrm.btn_incluir_desc.disabled=false;
  dfrm.btn_incluir_desc;
  dfrm.btn_incluir_desc.disabled=true;

  //alert(dfrm.hdn_nm_desc_funcionamento.value+"\n"+dfrm.hdn_vl_desc_funcionamento.value+"\n"+sec_cmb_desc_funcionamento);
}
function exclui_desc() {
  var dfrm=document.frm_solic_funcionamento;
  var indice_excluido=dfrm.hdn_id_desc_funcionamento_tmp.value;
  var sec_cmb_desc_funcionamento="";
  if (dfrm.cmb_desc_funcionamento.value!="") {
    dfrm.cmb_desc_funcionamento.options.length=0;
    sec_cmb_desc_funcionamento=dfrm.cmb_desc_funcionamento.options.length++;
    dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text="----------------";
    dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value="";
    
    var nomes=dfrm.hdn_nm_desc_funcionamento.value.split("^");
    var valores=dfrm.hdn_vl_desc_funcionamento.value.split("^");
    var blocos=dfrm.hdn_nm_bloco_desc_funcionamento.value.split("^");
    var tot=0;
    var valor_tmp="";
//     var andar=dfrm.hdn_nr_pavimento_desc_funcionamento.value.split("^");
    dfrm.hdn_nm_desc_funcionamento.value="";
    dfrm.hdn_vl_desc_funcionamento.value="";
    dfrm.hdn_nm_bloco_desc_funcionamento.value="";
//     dfrm.hdn_nr_pavimento_desc_funcionamento.value="";
    dfrm.txt_nm_desc_funcionamento_tmp.value="";
    dfrm.txt_vl_desc_funcionamento_tmp.value="";
    dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";
//     dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=0;
    for (var i=0; i<nomes.length;i++) {
      if ((i!=(dfrm.hdn_id_desc_funcionamento_tmp.value-1)) && (nomes[i]!="")) {
        sec_cmb_desc_funcionamento=dfrm.cmb_desc_funcionamento.options.length++;
        dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text=nomes[i];
        dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value=sec_cmb_desc_funcionamento;
        dfrm.hdn_nm_desc_funcionamento.value+=nomes[i]+"^";
        dfrm.hdn_vl_desc_funcionamento.value+=valores[i]+"^";
        valor_tmp=valores[i];
        while (valor_tmp.indexOf(".")>-1) {
          valor_tmp=valor_tmp.replace(".","");
        }
        while (valor_tmp.indexOf(",")>-1) {
          valor_tmp=valor_tmp.replace(",",".");
        }
        tot=parseFloat(tot)+parseFloat(valor_tmp);
        dfrm.hdn_nm_bloco_desc_funcionamento.value+=blocos[i]+"^";
//         dfrm.hdn_nr_pavimento_desc_funcionamento.value+=andar[i]+"^";
      }
    }
    tot=tot+"";
    while (tot.indexOf(".")>-1) {
      tot=tot.replace(".",",");
    }
    dfrm.txt_vl_tot_vistoria.value=tot;
    FormatNumero(dfrm.txt_vl_tot_vistoria);
    decimal(dfrm.txt_vl_tot_vistoria,2);
    dfrm.btn_incluir_desc.disabled=false;
    dfrm.btn_incluir_desc;
    dfrm.btn_excluir_desc.disabled=false;
    dfrm.btn_excluir_desc;
    dfrm.btn_excluir_desc.disabled=true;
  }
}
function muda_desc() {
  var vfrm=document.frm_solic_funcionamento;
  var sec_cmb_desc_funcionamento="";
  if ((vfrm.txt_nm_desc_funcionamento_tmp.value!="") && (vfrm.txt_vl_desc_funcionamento_tmp.value!="")) {
    vfrm.btn_incluir_desc.disabled=false;
    vfrm.btn_incluir_desc;
  } else {
      vfrm.btn_incluir_desc.disabled=false;
      vfrm.btn_incluir_desc;
      vfrm.btn_incluir_desc.disabled=true;
      vfrm.btn_excluir_desc.disabled=false;
      vfrm.btn_excluir_desc;
      vfrm.btn_excluir_desc.disabled=true;
  }
}
function muda_desc_tp(tp_vist) {
  var vfrm=document.frm_solic_funcionamento;
  var sec_cmb_desc_funcionamento="";
  if (tp_vist.value=="P") {
    vfrm.cmb_desc_funcionamento.disabled=false;
    vfrm.txt_nm_desc_funcionamento_tmp.disabled=false;
    vfrm.txt_nm_bloco_desc_funcionamento_tmp.disabled=false;
//     vfrm.cmb_nr_pavimento_desc_funcionamento_tmp.disabled=false;
    vfrm.txt_vl_desc_funcionamento_tmp.disabled=false;
  } else {
    var sec_cmb_desc_funcionamento="";
    vfrm.cmb_desc_funcionamento.options.length=0;
    sec_cmb_desc_funcionamento=vfrm.cmb_desc_funcionamento.options.length++;
    vfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text="----------------";
    vfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value="";
    vfrm.cmb_desc_funcionamento.disabled=true;
    vfrm.txt_nm_desc_funcionamento_tmp.disabled=true;
    vfrm.txt_nm_bloco_desc_funcionamento_tmp.disabled=true;
//     vfrm.cmb_nr_pavimento_desc_funcionamento_tmp.disabled=true;
    vfrm.txt_vl_desc_funcionamento_tmp.disabled=true;
    vfrm.hdn_nm_desc_funcionamento.value="";
    vfrm.hdn_vl_desc_funcionamento.value="";
//     vfrm.hdn_nr_pavimento_desc_funcionamento.value="";
    vfrm.hdn_nm_bloco_desc_funcionamento.value="";
    vfrm.btn_incluir_desc.disabled=false;
    vfrm.btn_incluir_desc;
    vfrm.btn_incluir_desc.disabled=true;
    vfrm.btn_excluir_desc.disabled=false;
    vfrm.btn_excluir_desc;
    vfrm.btn_excluir_desc.disabled=true;
  }
}
  function valida_prop() {
    var frm=document.frm_solic_funcionamento;
    if ((frm.txt_nr_cnpj_empresa.value!="") && (frm.txt_nr_cnpjcpf_proprietario.value!="")) {
      if ((frm.txt_nr_cnpj_empresa.value==frm.txt_nr_cnpjcpf_proprietario.value) && (frm.txt_nm_solicitante.value!="") && (frm.txt_nm_proprietario.value=="")) {
        frm.txt_nm_proprietario.value=frm.txt_nm_solicitante.value;
        frm.txt_fone_proprietario.value=frm.txt_nr_fone_empresa.value;
        frm.txt_de_email_proprietario.value=frm.txt_de_email_empresa.value;
        frm.txt_nm_edificacao.focus();
      } else {
        if ((frm.txt_nr_cnpj_empresa.value==frm.txt_nr_cnpjcpf_proprietario.value) && (frm.txt_nm_solicitante.value!=frm.txt_nm_proprietario.value)) {
//          frm.txt_nm_proprietario.focus();
          alert("Nome do Empresa diferente do Prorietário com mesmo CNPJ/CPF!");
          frm.txt_nm_proprietario.value="";
          frm.txt_nr_cnpjcpf_proprietario.value="";
          frm.txt_nm_proprietario.focus();
        }
      }
    }
  }

function valida_desc_habitese() {
  var vfrm=document.frm_solic_funcionamento;
  var desc_erro="";
  var valores_desc_calc=document.frm_solic_funcionamento.hdn_vl_desc_funcionamento.value;
  var vl_vist=0;
  var valor_tmp=document.frm_solic_funcionamento.txt_vl_desc_funcionamento_tmp.value;
  var vl_tot=document.frm_solic_funcionamento.txt_vl_area_tot_const.value;
  while (vl_tot.indexOf(".")>-1) {
    vl_tot=vl_tot.replace(".","");
  }
  while (vl_tot.indexOf(",")>-1) {
    vl_tot=vl_tot.replace(",",".");
  }
  while (valor_tmp.indexOf(".")>-1) {
    valor_tmp=valor_tmp.replace(".","");
  }
  while (valor_tmp.indexOf(",")>-1) {
    valor_tmp=valor_tmp.replace(",",".");
  }
  while (valores_desc_calc.indexOf(".")>-1) {
    valores_desc_calc=valores_desc_calc.replace(".","");
  }
  while (valores_desc_calc.indexOf(",")>-1) {
    valores_desc_calc=valores_desc_calc.replace(",",".");
  }
  var valores_desc=valores_desc_calc.split("^");
  for (var i=0; i<valores_desc.length; i++) {
    if (!isNaN(parseFloat(valores_desc[i]))) {
      vl_vist=parseFloat(vl_vist)+parseFloat(valores_desc[i]);
    }
  }
  if (isNaN(parseFloat(vl_tot))) {
    vl_tot=-9999999.99;
  }
  if (isNaN(vl_vist)) {
    vl_vist=parseFloat(valor_tmp);
  } else {
    vl_vist=parseFloat(vl_vist)+parseFloat(valor_tmp);
  }
  if (vfrm.txt_nm_desc_funcionamento_tmp.value=="") {
    desc_erro="=> N° ou Referência da Sala\n";
  }
  if (vfrm.txt_vl_desc_funcionamento_tmp.value=="") {
    desc_erro+="=> Valor da Área\n";
  }
//   if (vfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=="") {
//     desc_erro+="=> Pavimento/Andar\n";
//   }
  if (parseFloat(vl_tot)<parseFloat(vl_vist)) {
    desc_erro+="=> Área de Vistoria MENOR que Área Construída\n";
  }
  if (desc_erro!="") {
    alert("Os campos são Obrigatórios!\n"+desc_erro+"Verifique!!!");
  } else {
    insere_desc();
  }
}

  function consultar_regin(protocolo) {
    if (protocolo.length == 14) {
        window.open("consultar_regin.php?protocolo="+protocolo,"","toolbar=no, location=no, directories=no, scrollbars=no, status=yes, innerheight=yes, innerwidth=yes");    
    } else {
        alert('Número do protocolo deve possuir 14 dígitos');
        document.frm_solic_funcionamento.reset();
    }

  }

</script>
<body  onload="ajustaspan()">
<table style="height : 167px; margin-left : 0px; width : 764px;" valign="middle" border="0" cellpadding="0" cellspacing="0" id="tbcorpo">
  <tbody>
    <tr height="125">
      <td align="left" valign="top"><img src="../../imagens/barrasigat.jpg" alt="" align="middle" border="0" height="115" width="760"></td>
    </tr>
    <?
      if ($erro!="") {
        eval($erro);
      }
    ?>
    <tr valign="top" id="lncorpo" style="height:300px;">
      <td> <span style="position: absolute; overflow: auto; height: 295px; width: 760px;" id="corpo">

<? if(@$encontrouSolicitacao) { ?>

  <form target="_self" enctype="multipart/form-data" method="post" name="frm_solic_funcionamento" onSubmit="return validaForm(this,<?=$campos_js?>)">
  <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">

  <? foreach($_POST as $nome => $valor) { ?>
	  <input type="hidden" name="<?=$nome?>" value="<?=$valor?>"/>
  <? } ?>	
    <!-- SOLICITANTE -->
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Empresa</legend>
          <table>
            <tr>
              <td>Nome</td>
              <td><input type="text" name="txt_nm_solicitante" value="<?=$_POST['txt_nm_solicitante']?>" 
              size="50" maxlength="100" class="campo_obr" title="Nome do Solicitante de Análise da Edificação" 
              onblur="valida_prop()"></td>
              <td>CNPJ/CPF</td>
              <td><input type="text" name="txt_nr_cnpj_empresa" value="<?=$_POST['txt_nr_cnpj_empresa']?>" size="20" maxlength="18" class="campo_obr" title="CPF ou CNPJ do Solicitante de Análise da Edificação" onblur="cpfcnpj(this);valida_prop();" value=""></td>
            </tr>
          </table>
          <table>
            <tr>
              <td width="30">Fone</td>
              <td><input type="text" name="txt_nr_fone_empresa" value="<?=$_POST['txt_nr_fone_empresa']?>" size="13" maxlength="12" class="campo_obr" title="Fone do Solicitante de Análise da Edificação"></td>
              <td>E-mail</td>
              <td><input type="text" name="txt_de_email_empresa" value="<?=$_POST['txt_de_email_empresa']?>" size="61" maxlength="100" class="campo_obr" title="E-mail do Solicitante de Análise da Edificação" style="text-transform : none;"></td>
            </tr>
          </table>
        </fieldset>
      </td>
    </tr>
    <!-- SOLICITAÇÕES -->
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Solicitações Protocoladas para este CPF/CNPJ</legend>
          <table width="100%">
            <tr>
              <td colspan="2"><b><br>
              <? if(count($solicitacoes)==1) { ?>
              	Existe a seguinte solicitação de vistoria para este CPF/CNPJ:
              <? } else { ?>
              	Existem <?=count($solicitacoes)?> solicitações de vistoria para este CPF/CNPJ:
              <? } ?>
              </b><br><br></td>
			</tr>              
            <tr>
              <td colspan="2">
              	<table border="0" width="100%" align="center">
				<? foreach($solicitacoes as $solicitacao) { ?>
					<tr>
						<td align="right" width="100">Data:&nbsp;</td> 
						<td><b><?=$solicitacao['DT_SOLICITACAOS']?>
						<? if($solicitacao['CH_PROTOCOLADO']=='P') echo " (protocolado)"; ?>
						</b></td>
					</tr> 
					<tr>
						<td align="right">Empresa:&nbsp;</td> 
						<td><?=$solicitacao['NR_CNPJ_EMPRESA']?> - <?=$solicitacao['NM_RAZAO_SOCIAL']?></td>
					</tr> 
					<tr>
						<td align="right">Edificação:&nbsp;</td> 
						<td><?=$solicitacao['NM_EDIFICACOES']?></td>
					</tr> 
					<tr>
						<td align="right">Nome Fantasia:&nbsp;</td> 
						<td><?=$solicitacao['NM_FANTASIA_EMPRESA']?></td>
					</tr> 
					<tr>
						<td align="right">Logradouro:&nbsp;</td> 
						<td><?=$solicitacao['NM_LOGRADOURO']?>, <?=$solicitacao['NR_EDIFICACOES']?></td>
					</tr> 
					<tr>
						<td align="right">CEP:&nbsp;</td> 
						<td><?=$solicitacao['ID_CEP']?>  <?=$solicitacao['NM_BAIRRO']?>/<?=$solicitacao['NM_CIDADE']?></td>
					</tr> 
					<tr>
						<td colspan="2">&nbsp;</td> 
					</tr> 
				<? } ?>
              	</table>
              </td>
            </tr>
          </table>
        </fieldset>
      </td>
    </tr>
    <!-- BOTÕES -->
    <tr valign="top" align="center">
      <td>
        <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
          <tr align="center" valign="center">
            <td>
              <input type="submit" name="btn_enviar_solicitacao" value="Enviar" align="middle" title="Enviar Solicitação" class="botao" >
            </td>
            <td>
              <input type="button" name="btn_voltar" value="Voltar" onclick="javascript:history.back();" align="middle" title="Voltar ao formulário" class="botao" >
            </td>
          </tr>
        </table>
    </tr>
  </table>
  </form>


<? } else { ?>


     <form target="_self" enctype="multipart/form-data" method="post" name="frm_solic_funcionamento" onSubmit="return validaForm(this,<?=$campos_js?>)">
      <input type="hidden" name="hdn_protocolo_regin" value=""/>

  <table style="width: 100%; text-align: left;" cellpadding="2" cellspacing="2" border="0">

    <tr>
        <td>
            <fieldset>
            <legend>Regin</legend>
            <script>
                function verificar_cbx(cbx, txt) {
                    if (cbx.checked) {
                        txt.disabled = false;
                    } else {
                        txt.disabled = true;
                    }
                }
            </script>
            <table width="100%" cellpading="5" border="0">
                <tr>
                <td align="center">
                <input type="checkbox" name="cbx_regin" onchange="verificar_cbx(this,txt_protocolo_regin)" value="1" >
                Existe protocolo de consulta de viabilidade expedido pelo REGIN/JUCESC&nbsp;&nbsp;
                <input 
                    disabled="true" 
                    type="text" 
                    name="txt_protocolo_regin" 
                    value="<?=$_POST['txt_protocolo_regin']?>"  
                    class="campo"
                    size="18"
                    maxlength="14"
                    onblur="consultar_regin(this.value);"
                ></td>
              </tr>
                <!--
                <tr>
                    <td align="center">
                        <input type="checkbox" name="cbx_re" onchange="verificar_cbx(this,txt_re)" value="1" >
                        Existe registro da edifica&ccedil;&atilde;o do Corpo de Bombeiros (RE)
                        <input 
                            disabled="true" 
                            type="text" 
                            name="txt_re" 
                            value="<?=$_POST['txt_re']?>"  
                            class="campo"
                            size="5"
                        >
                    </td>
                </tr>
                -->
            </table>
            </fieldset>
        </td>
    </tr>

    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Empresa</legend>
          <table>
            <tr>
              <td>CNPJ</td>
              <td><input type="text" name="txt_nr_cnpj_empresa" size="20" maxlength="18" class="campo_obr" title="CPF ou CNPJ da Empresa Solicitante de Funcionamento da Edificação" onblur="cpfcnpj(this)" value=""></td>
              <td>Razão Social</td>
              <td><input type="text" name="txt_nm_solicitante" size="50" maxlength="100" class="campo_obr" title="Razão Social da Empresa Solicitante do Funcionamento"></td>
            </tr>
          </table>
          <table>
            <tr>
              <td>Nome Fantasia<br>Empresa</td>
              <td><input type="text" name="txt_nm_fantasia_empresa" size="30" maxlength="100" class="campo_obr" title="Nome Fantasia da Empresa Solicitante"></td>
              <td>Nome Contato</td>
              <td><input type="text" name="txt_nm_contato" size="30" maxlength="100" class="campo_obr" title="Nome do Responsável da Empresa Solicitante"></td>
            </tr>
          </table>
          <table>
            <tr>
              <td width="30">Fone</td>
              <td><input type="text" name="txt_nr_fone_empresa" size="13" maxlength="12" class="campo_obr" title="Fone do Solicitante de Funcionamento da Edificação"></td>
              <td>E-mail</td>
              <td><input type="text" name="txt_de_email_empresa" size="61" maxlength="100" class="campo_obr" title="E-mail do Solicitante de Funcionamento da Edificação" style="text-transform : none;"></td>
            </tr>
          </table>
        </fieldset> 
      </td>
    </tr>
    <tr>
      <td colspan="2" style="vertical-align: top;">
        <fieldset>
          <legend>Proprietário da Edificação</legend>
            <table>
              <tr>
                <td>Nome</td>
                <td><input type="text" name="txt_nm_proprietario" size="50" maxlength="100" class="campo_obr" title="Nome do Proprietário da Edificação"></td>
                <td>CNPJ/CPF</td>
                <td><input type="text" name="txt_nr_cnpjcpf_proprietario" size="20" maxlength="18" class="campo_obr" title="CNPJ ou CPF do Proprietário da Edificação" onblur="cpfcnpj(this);valida_prop();"  value=""></td>
              </tr>
            </table>
            <table>
              <tr>
                <td width="30">Fone</td>
                <td><input type="text" name="txt_fone_proprietario" size="13" maxlength="12" class="campo_obr" title="Fone do Proprietário da Edificação"></td>
                <td>E-mail</td>
                <td><input type="text" name="txt_de_email_proprietario" size="61" maxlength="100" class="campo_obr" title="E-mail do Prorietário da Edificação" style="text-transform : none;"></td>
              </tr>
            </table>
        </fieldset>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="vertical-align: top;">
        <fieldset>
          <legend>Edificação</legend>
          <TABLE width="90%" cellspacing="0" border="0" cellpadding="0">
            <tr>
              <TD>Nome</TD>
              <TD><INPUT type="text" name="txt_nm_edificacao" size="30" maxlength="100" class="campo_obr" title="Nome da Edificação"></td>
              <TD>Nome Fantasia</TD>
              <TD><INPUT type="text" name="txt_nm_fantasia" size="30" maxlength="100" title="Nome Fantasia da Edifição" class="campo"></TD>
            </tr>
          </TABLE>
          <fieldset>
          <legend>Endereço</legend>
          <table cellspacing="0" border="0" cellpadding="2">
            <tr>
              <td>
                Logradouro
              </td>
              <td>
                          <select name="cmb_id_tp_prefixo" class="campo_obr">
                          <option value="">--</option>
<?
                            $sql_tp_logradouro="SELECT ID_TP_LOGRADOURO, NM_TP_LOGRADOURO FROM ".TBL_TP_LOGRADOURO;
                            $conn->query($sql_tp_logradouro);
                            while ($cidade=$conn->fetch_row()) {
?>
                            <option value="<?=$cidade["ID_TP_LOGRADOURO"]?>"><?=$cidade["NM_TP_LOGRADOURO"]?></option>
<?
                           }
?>
                          </select>
              </td>
              <td>Nome</td>
              <td>
                <input type="text" name="txt_nm_logradouro" size="40" maxlength="100" title="Nome do Logradouro" class="campo_obr">
              </td>
            </tr>
            <tr>
              <td>N°</td>
              <td>
                <input type="text" name="txt_nr_numero" size="5" maxlength="6" class="campo" title="Número do Endereço da Edificação" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)">
              </td>
              <td>Cidade</td>
              <td>
                <select name="hdn_id_cidade" value="" class="campo_obr">
                  <option value="">--------</option>
                  <?
                    //$sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' ORDER BY NM_CIDADE";
                    $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO = '$userlogin' ORDER BY NM_CIDADE";
                    $res= $conn->query($sql);
                    if ($conn->get_status()==false) {
                      die($conn->get_msg());
                    }
                    while ($tupula = $conn->fetch_row()) {
                  ?>
                  <option value="<?=$tupula["ID_CIDADE"]?>"><?=$tupula["NM_CIDADE"]?></option>
                  <?
                    }
                  ?>
                </select>
              </td>
            </tr>

<? /*
              <td>
                  <?
                      $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO = '$userlogin' ORDER BY NM_CIDADE";
                      $res= $conn->query($sql);
                      if ($conn->get_status()==false) {
                        die($conn->get_msg());
                      }
                      $ITENS[0]="''";
                      $LINKS[0]="''";
                      $ALTS[0]="''";
                      $count=1;
                      while ($tupula = $conn->fetch_row()) {
                        $ITENS[$count]="'".$tupula["NM_CIDADE"]."'";
                        $LINKS[$count]="'".$tupula["ID_CIDADE"]."'";
                        $ALTS[$count]="''";
                        $count++;
                      }
                      $J_ITENS=implode(",",$ITENS);
                      $J_LINKS=implode(",",$LINKS);
                      $J_ALTS=implode(",",$ALTS);
                  ?>
                  <input type="hidden" name="hdn_id_cidade" value="">
                  <input type="text" name="cme_id_cidade" size="30" maxlength="50" value="" class="campo_obr" style="text-align: left; font-size: 10px;  background-image: url(../../imagens/combo.gif); background-repeat: no-repeat; background-position: right top; background-color: #FFFFFF; color: #000000; border: 1px SOLID #AAAAAA" onfocus="actb(this,event,cme_id_cidade_edCombItens,cme_id_cidade_edCombLinks,cme_id_cidade_edCombAlts,120)">
                  <script language='JavaScript'>//<!--
                    cme_id_cidade_edCombItens=new Array(<?=$J_ITENS?>); // LISTA DE CONTEÚDOS QUE VÃO APARECER
                    cme_id_cidade_edCombLinks=new Array(<?=$J_LINKS?>); // LISTA DE CHAVES
                    cme_id_cidade_edCombAlts=new Array(<?=$J_ALTS?>); // LISTA DE CONEÚDOS PARA TITLE - NÃO ESTÁ IMPLEMENTADO
                    var campo_destino=document.frm_solic_funcionamento.hdn_id_cidade;
                    var campo_blur = "var xxxx=1;";
                  //--></script>
              </td>
*/ ?>              
            </tr>
            <tr>
              <td>Bairro</td>
              <td><input type="text" name="txt_nm_bairro" size="20" maxlength="50" class="campo_obr" title="Bairro da Edificação"></td>
             <td>CEP</td>
              <td>
                <input type="text" name="txt_nr_cep" size="9" maxlength="10" class="campo" title="Número do CEP da Edificação" onkeypress="return validaTecla(this, event, 'n')" onblur="CEP(this)">
              </td>
             </tr>
             <tr>
              <td align="right">Complemento</td>
              <td><input type="text" name="txt_nm_complemento" size="30" maxlength="100" class="campo" title="Complemento do Endereço da Edificação"></td>
              <td>Área Total<br>Construída</td>
              <td nowrap="true">
                <input type="text" name="txt_vl_area_tot_const" size="25" maxlength="17" align="right" class="campo_obr" title="Área total contruida da Edificação" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)">
                <em>(m²)</em>
              </td>
            </tr>
          </table>
          </fieldset>
          <fieldset>
            <legend>Caracteristicas da Edficação</legend>
            <table width="95%" cellpadding="2" cellspacing="0" align="left" border="0">
                <tr>
                  <td>
                    <table width="95%" cellspacing="0" border="0" cellpadding="2">
                      <tr>
                        <td>Ocupação</td>
                        <td><select name="cmb_id_ocupacao" class="campo_obr" title="Classificação da Edificação quanto a sua Ocupação">
                              <option value="">--------</option>
                              <?
                              // string da query
                              $sql= "SELECT ID_OCUPACAO, NM_OCUPACAO FROM ".TBL_TP_OCUPACAO;
                              // executando a consulta
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }
      
                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_OCUPACAO']."\">";
                                echo $tupula['NM_OCUPACAO'];
                                echo "</option>\n";
                              }
                            ?>
                            </select>
                        </td>
                        <td>Risco</td>
                        <td>
                          <select name="cmb_id_risco" class="campo_obr" title="Classe de risco de incêndio da Edificação">
                            <option value="">-------</option>
                            <?
                              // string da query
                              $sql= "SELECT ID_RISCO, NM_RISCO FROM ".TBL_TP_RISCO;
                              // executando a consulta
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }
      
                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_RISCO']."\">";
                                echo $tupula['NM_RISCO'];
                                echo "</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Situação</td>
                        <td>
                          <select name="cmb_id_situacao" title="Situação da edificação quanto a sua construção" class="campo_obr">
                            <option value="">--------</option>
                            <?
                              // string da query
                              $sql= "SELECT ID_SITUACAO, NM_SITUACAO FROM ".TBL_TP_SITUACAO;
                              // executando a consulta
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }
      
                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_SITUACAO']."\">";
                                echo $tupula['NM_SITUACAO'];
                                echo "</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                        <td>Tipo</td>
                        <td>
                          <select name="cmb_id_tp_construcao" class="campo_obr" title="Tipo de contrução da Edificação">
                            <option value="">--------</option>
                            <?
                              // string da query
                              $sql= "SELECT ID_TP_CONSTRUCAO, NM_TP_CONSTRUCAO FROM ".TBL_TP_CONSTRUCAO;
                              // executando a consulta
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }
      
                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_TP_CONSTRUCAO']."\">";
                                echo $tupula['NM_TP_CONSTRUCAO'];
                                echo "</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>N° Pavimentos</td>
                        <td>
                          <select name="cmb_nr_pavimentos" class="campo_obr" title="Número de pavimentos da edificação">
                            <?
                              for ($i=1;$i<=35;$i++) {
                                echo "<option value=\"".$i."\">".$i."</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                        <td>N° Blocos</td>
                        <td>
                          <select name="cmb_nr_blocos" class="campo_obr" title="Número de Blocos da Edificação">
                            <?
                              for ($i=1;$i<=20;$i++) {
                                echo "<option value=\"".$i."\">".$i."</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                      </tr>
                  </table>
                </td>
              </tr>
            </table>
          </fieldset>
          <fieldset>
            <legend>Área de Vistoria</legend>
            <table width="50%" cellspacing="0" cellpadding="2" align="center" border="0">
              <tr>
                <td>Tipo de Vistoria</td>
                <td>
                  <select name="cmb_ch_tp_funcionamento" class="campo_obr" onChange="muda_desc_tp(this)">
                    <option value="T" selected>TODA A EDIFICAÇÃO</option>
                    <option value="P">PARCIAL</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Salas Cadastradas</td>
                <td>
                  <select name="cmb_desc_funcionamento" class="campo" onChange="carrega_desc(this)" disabled="true">
                    <option value="">----------------</option>
                  </select>
                  <input type="hidden" name="hdn_nm_desc_funcionamento" value="">
                  <input type="hidden" name="hdn_vl_desc_funcionamento" value="">
                  <input type="hidden" name="hdn_nm_bloco_desc_funcionamento" value="">
                  <!--<input type="hidden" name="hdn_nr_pavimento_desc_funcionamento" value="">-->
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <table width="99%" cellpadding="0" cellspacing="2" align="center" border="0">
                    <tr>
                      <td>Local a Ser Vistoriado</td>
                      <td colspan="2">
                        <input type="hidden" name="hdn_id_desc_funcionamento_tmp" value="">
                        <input type="text" name="txt_nm_desc_funcionamento_tmp" class="campo_obr" size="30" maxlength="50" value="" onkeyup="muda_desc()" disabled="true">
                      </td>
                    </tr>
                    <tr>
                      <td>Complemento</td>
                      <td colspan="2">
                        <input type="text" name="txt_nm_bloco_desc_funcionamento_tmp" class="campo" size="35" maxlength="50" value="" disabled="true">
                      </td>
                    </tr>
<!--                    <tr>
                      <td>Pavimento/Andar</td>
                      <td colspan="2">
                          <select name="cmb_nr_pavimento_desc_funcionamento_tmp" class="campo_obr" disabled="true">
                            <option value="0" selected disabled="true">Térreo</option>
                            <?
                              for ($i=1;$i<35;$i++) {
                            ?>
                            <option value="<?=$i?>"><?printf("%02d",$i);?>° andar</option>
                            <?
                              }
                            ?>
                          </select>
                      </td>
                    </tr>-->
                    <tr>
                      <td>Área</td>
                      <td>
                        <input type="text" name="txt_vl_desc_funcionamento_tmp" class="campo_obr" size="30" maxlength="50" align="right" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this);muda_desc();" onblur="decimal(this,2)" value="" disabled="true">
                      </td>
                      <td>
                        <em>(m²)</em>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="center">
                        <input type="button" name="btn_incluir_desc" value="Incluir" class="botao" disabled="true" onClick="valida_desc_habitese()">&nbsp;
                        <input type="button" name="btn_excluir_desc" value="Excluir" class="botao" disabled="true" onClick="exclui_desc()">
                      </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Área Total<br>a Ser Vistoriada</td>
                      <td colspan="2">
                        <input type="text" name="txt_vl_tot_vistoria" readOnly="true" class="campo_obr" size="30" align="right">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </fieldset>
        </fieldset>
      </tr>
    </tr>
    <tr valign="top" align="center">
      <td>
        <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
          <tr align="center" valign="center">
            <td>
              <input type="submit" name="btn_enviar" value="Enviar" align="middle" title="Confirma a Solicitação de Funcionamento" class="botao" >
            </td>
            <td>
              <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa as Informações" class="botao" >
            </td>
          </tr>
        </table>
    </tr>
  </table>

<? } // if($encontrouSolicitacao) { ?>

  </form>

      </span></td>
    </tr>

	<? //include ('../../templates/footer.htm'); ?>

  </tbody>
</table>
</body>
</html>
<?

/*

Filtro para o preenchimento da RE (aprovado X pendente)

1 Sala ou ambiente comercial no pavimento térreo ou com acesso a salão ou galeria térreo
2 Usa GLP em quantidade maior que 90 kg
3 Area total ocupada em M2  > '750'
4 Número de Pavimentos utilizados na edificação pela empresa (Utilizar somente números) > '2'
5 Número de Pavimentos total do imóvel (utilizar somente números)
6 Numero de Blocos

*/

//$global_obj_sessao->logout();
?>
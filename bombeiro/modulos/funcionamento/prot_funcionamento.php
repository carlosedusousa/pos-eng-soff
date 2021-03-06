<?
  require_once 'lib/loader.php';

  $arquivo="prot_funcionamento.php";
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) die($conn->get_msg());
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row();
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();
  unset($erro);
  $erro="";
  $campos_preenchidos=true;
  $campos_existe=true;

  $campos_obr= array('txt_nr_cnpj_empresa'=>"'txt_nr_cnpj_empresa,CNPJ da Empresa Solicitante,t'",
  'txt_nm_empresa'=>"'txt_nm_empresa,Raz�o Social,t'",
  'txt_nm_fantasia_empresa'=>"'txt_nm_fantasia_empresa,Nome Fantasia do Solicitante,t'",
  'txt_nm_contato'=>"'txt_nm_contato,Nome da Pessoa de Contato,t'",
  'txt_nr_fone_empresa'=>"'txt_nr_fone_empresa,N�mero do Fone Solicitante,n'",
  'txt_de_email_empresa'=>"'txt_de_email_empresa,E-mail da Empresa Solicitante,e'",
  'txt_nm_edificacao'=>"'txt_nm_edificacao,Nome da Edifica��o,t'",
  'cmb_id_tp_prefixo'=>"'cmb_id_tp_prefixo,Prefixo do Logradouro,t'",
  'txt_nm_logradouro'=>"'txt_nm_logradouro,Nome do Logradouro,t'",
  'hdn_id_cidade'=>"'hdn_id_cidade,Cidade da Edifica��o,t'",
  'txt_nm_bairro'=>"'txt_nm_bairro,Nome do Bairro,t'",
  'txt_id_cep'=>"'txt_id_cep,N�mero do CEP,t'",
  'txt_vl_area_tot_const'=>"'txt_vl_area_tot_const,Valor da �rea total Constru�da,t'",
  'txt_vl_area_vistoria'=>"'txt_vl_area_vistoria,Valor da �rea a ser Vistoriada,t'",
  'cmb_id_servico'=>"'cmb_id_servico,Servi�o Prestado,n'",
  'cmb_id_tp_servico'=>"'cmb_id_tp_servico,Tipo de Servi�o,n'"
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

  if (@$_POST["txt_id_prot_funcionamento"]=="") $ID_PROT_FUNC=0; 
  else $ID_PROT_FUNC = formataCampo($_POST["txt_id_prot_funcionamento"],'N');

      $ID_SOLIC_FUNC		= formataCampo($_POST["hdn_id_solic_funcionamento"],'N');
      $ID_TP_FUNC		= formataCampo($_POST["hdn_id_tp_funcionamento"],'SN');
      $NM_RAZAO_SOCIAL		= formataCampo($_POST["txt_nm_empresa"]);
      $NR_FONE_EMPRESA		= formataCampo($_POST["txt_nr_fone_empresa"],'VN');
      $NR_CNPJ_EMPRESA		= formataCampo($_POST["txt_nr_cnpj_empresa"],'VN');
      $DE_EMAIL_EMPRESA		= formataCampo($_POST["txt_de_email_empresa"],'t','l');
      $NM_EDIFICACAO		= formataCampo($_POST["txt_nm_edificacao"]);
      $ID_LOGRADOURO		= formataCampo($_POST["hdn_id_logradouro"],'N','O');
      $NM_LOGRADOURO		= formataCampo($_POST["txt_nm_logradouro"]);
      $NR_EDIFICACAO		= formataCampo($_POST["txt_nr_edificacao"],'N');
      $ID_BAIRROS		= formataCampo($_POST["hdn_id_bairro"],'N','O');
      $NR_CEP			= formataCampo($_POST["txt_id_cep"],'N');
      $VL_AREA_CONSTRUIDA	= formataCampo($_POST["txt_vl_area_tot_const"],'D');
      $VL_AREA_VISTORIADA	= formataCampo($_POST["txt_vl_area_vistoria"],'D');
      $NM_COMPLEMENTO		= formataCampo($_POST["txt_nm_complemento"]);
      $NM_BAIRRO		= formataCampo($_POST["txt_nm_bairro"]);
      $ID_SERVICO		= $_POST["cmb_id_servico"];
      $ID_TP_SERVICO		= $_POST["cmb_id_tp_servico"];
      $controle			= $_POST["hdn_controle"];
      $ID_CIDADE_ANT		= $_POST["hdn_id_cidade_ant"];
      $ID_TP_LOGRADOURO		= $_POST["cmb_id_tp_prefixo"];
      $ID_CIDADE		= $_POST["hdn_id_cidade"];
      $ID_CEP			= $NR_CEP;

  if (($ID_LOGRADOURO!="NULL")&&($ID_CEP!="NULL")) {
    $ID_CIDADE_CEP=$ID_CIDADE;
    $CH_AGUARDO_LOGRADOURO="'N'";
  } else {
    $ID_CIDADE_CEP="NULL";
    $ID_LOGRADOURO="NULL";
    $ID_CEP="NULL";
    $CH_AGUARDO_LOGRADOURO="'S'";
  }

    $l_cpfcnpj	= str_replace('.','',(str_replace('-','',(str_replace('/','',$_POST['txt_nr_cnpj_empresa'])))));
    $l_cidade	= $_POST['hdn_id_cidade'];
    $l_endereco	= explode('-',$_POST['txt_nm_logradouro']);
    $l_endereco = $l_endereco[0];
    $l_nr		= $_POST["txt_nr_edificacao"];
    if(!$l_nr) $l_nr = 'NULL'; 

	$sql="SELECT ".
		TBL_SOL_FUNC.".ID_CIDADE, ".
		TBL_SOL_FUNC.".ID_SOLIC_FUNC, ".
		TBL_SOL_FUNC.".ID_TP_FUNC, ".
		TBL_SOL_FUNC.".NM_EDIFICACOES, ".
		TBL_SOL_FUNC.".NM_FANTASIA_EMPRESA, ".
		TBL_SOL_FUNC.".NM_LOGRADOURO, ".
		TBL_SOL_FUNC.".NR_EDIFICACOES, ".
		TBL_SOL_FUNC.".ID_CEP, ".
		TBL_SOL_FUNC.".NM_BAIRRO, ".
		TBL_CIDADE.".NM_CIDADE, DATE_FORMAT(".TBL_SOL_FUNC.".DT_SOLICITACAO,'%d/%m/%Y') DT_SOLICITACAOS, " .
		"(TO_DAYS('".date("Y-m-d")."') - TO_DAYS(".TBL_SOL_FUNC.".DT_SOLICITACAO)) AS DIAS " .
	"FROM ".TBL_SOL_FUNC." JOIN ".TBL_CIDADE." USING(ID_CIDADE) " .
	"WHERE ".
		TBL_SOL_FUNC.".CH_PROTOCOLADO <> 'S' AND ".
		TBL_SOL_FUNC.".NR_EDIFICACOES = ".$l_nr." AND ".
		TBL_SOL_FUNC.".NM_LOGRADOURO like '%".$l_endereco."%' AND ".
		TBL_SOL_FUNC.".ID_CIDADE = ".$l_cidade." AND ".
		TBL_SOL_FUNC.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."') " .
	"ORDER BY DT_SOLICITACAO ASC, NM_CIDADE ASC";


	$conn->query($sql);
	$rows_pendente=$conn->num_rows();
	$encontrouSolicitacao = false;
	while ($pendente = $conn->fetch_row()) {
		if($encontrouSolicitacao == false) $encontrouSolicitacao = true;
		$solicitacoes[] = $pendente;
	} 

	if(!$encontrouSolicitacao || @$_POST[btn_enviar_solicitacao]) {
	  $query_trans="BEGIN";
	  $conn->query($query_trans);
	  $query_trans="COMMIT";
	  $ERRO_TRANS="";
	  if ($global_inclusao=='S') {
	    $query_solicit="UPDATE ".TBL_SOL_FUNC." SET NR_CNPJ_EMPRESA=$NR_CNPJ_EMPRESA, NM_RAZAO_SOCIAL=$NM_RAZAO_SOCIAL, NR_FONE_EMPRESA=$NR_FONE_EMPRESA, DE_EMAIL_EMPRESA=$DE_EMAIL_EMPRESA, CH_PROTOCOLADO='P', NM_LOGRADOURO=$NM_LOGRADOURO, NR_CEP=$NR_CEP, NM_BAIRRO=$NM_BAIRRO, ID_CEP=$ID_CEP, ID_LOGRADOURO=$ID_LOGRADOURO, ID_CIDADE_CEP=$ID_CIDADE_CEP, CH_AGUARDO_LOGRADOURO=$CH_AGUARDO_LOGRADOURO WHERE ID_SOLIC_FUNC=$ID_SOLIC_FUNC AND ID_CIDADE=$ID_CIDADE_ANT AND ID_TP_FUNC=$ID_TP_FUNC";
	    $conn->query($query_solicit);
	    if ($conn->get_status()==false) {
	      $ERRO_TRANS.="ERRO NA SOLICITACAO:".$conn->get_msg()."\n";
	      $query_trans="ROLLBACK";
	    }
	    if ($ID_CIDADE!=$ID_CIDADE_ANT) {
	      $query_solicit="INSERT INTO ".TBL_SOL_FUNC." (ID_CIDADE, ID_SOLIC_FUNC, ID_TP_FUNC, CH_PAGO, CH_TP_FUNC, NR_CNPJ_EMPRESA, NM_RAZAO_SOCIAL, NM_FANTASIA_EMPRESA,NM_CONTATO, NR_FONE_EMPRESA, DE_EMAIL_EMPRESA, NR_CNPJ_CPF_PROPRIETARIO, NM_PROPRIETARIO, NR_FONE_PROPRIETARIO, DE_EMAIL_PROPRIETARIO, NM_EDIFICACOES, NM_FANTASIA, ID_TP_LOGRADOURO, NM_LOGRADOURO, NR_EDIFICACOES, ID_CEP, ID_LOGRADOURO, ID_CIDADE_CEP, NR_CEP, NM_BAIRRO, NM_COMPLEMENTO, VL_AREA_CONSTRUIDA, CH_PROTOCOLADO, DT_SOLICITACAO, CH_AGUARDO_LOGRADOURO, DT_AGUARDO_LOGRADOURO, ID_USUARIO, ID_RISCO, ID_TP_CONSTRUCAO, ID_OCUPACAO, ID_SITUACAO, NR_PAVIMENTOS, NR_BLOCOS) SELECT $ID_CIDADE, 0, 'P', CH_PAGO, CH_TP_FUNC, NR_CNPJ_EMPRESA, NM_RAZAO_SOCIAL, NM_FANTASIA_EMPRESA,NM_CONTATO, NR_FONE_EMPRESA, DE_EMAIL_EMPRESA, NR_CNPJ_CPF_PROPRIETARIO, NM_PROPRIETARIO, NR_FONE_PROPRIETARIO, DE_EMAIL_PROPRIETARIO, NM_EDIFICACOES, NM_FANTASIA, ID_TP_LOGRADOURO, NM_LOGRADOURO, NR_EDIFICACOES, ID_CEP, ID_LOGRADOURO, ID_CIDADE_CEP, NR_CEP, NM_BAIRRO, NM_COMPLEMENTO, VL_AREA_CONSTRUIDA, 'P', DT_SOLICITACAO, CH_AGUARDO_LOGRADOURO, DT_AGUARDO_LOGRADOURO, ID_USUARIO, ID_RISCO, ID_TP_CONSTRUCAO, ID_OCUPACAO, ID_SITUACAO, NR_PAVIMENTOS, NR_BLOCOS FROM ".TBL_SOL_FUNC." WHERE ID_CIDADE=$ID_CIDADE_ANT AND ID_SOLIC_FUNC=$ID_SOLIC_FUNC AND ID_TP_FUNC=$ID_TP_FUNC";
	      $conn->query($query_solicit);
	      if ($conn->get_status()==false) {
	        $ERRO_TRANS.="ERRO NA SOLICITACAO ALT CIDADE:".$conn->get_msg()."\n";
	        $query_trans="ROLLBACK";
	      }
	      $NEW_ID_SOLIC_FUNC=$conn->insert_id();
	      $NEW_ID_TP_FUNC="'P'";
	      $query_solicit_desc="INSERT INTO ".TBL_DESC_FUNC." (ID_CIDADE, ID_SOLIC_FUNC, ID_TP_FUNC, ID_DESC_FUNC, NM_DESC_FUNC, NR_PAVIMENTO, NM_BLOCO, VL_AREA_DESC_FUNC) SELECT $ID_CIDADE, $NEW_ID_SOLIC_FUNC, $NEW_ID_TP_FUNC, 0, NM_DESC_FUNC, NR_PAVIMENTO, NM_BLOCO, VL_AREA_DESC_FUNC FROM ".TBL_DESC_FUNC." WHERE ID_CIDADE=$ID_CIDADE_ANT AND ID_TP_FUNC=$ID_TP_FUNC AND ID_SOLIC_FUNC=$ID_SOLIC_FUNC";
	      $conn->query($query_solicit_desc);
	      if ($conn->get_status()==false) {
	        $ERRO_TRANS.="ERRO NA SOLICITACAO DESC ALT CIDADE:".$conn->get_msg()."\n";
	        $query_trans="ROLLBACK";
	      }
	      $query_solicit_desc="DELETE FROM ".TBL_DESC_FUNC." WHERE ID_CIDADE=$ID_CIDADE_ANT AND ID_SOLIC_FUNC=$ID_SOLIC_FUNC AND ID_TP_FUNC=$ID_TP_FUNC";
	      $conn->query($query_solicit_desc);
	      if ($conn->get_status()==false) {
	        $ERRO_TRANS.="ERRO NA SOLICITACAO DESC DELETE CIDADE:".$conn->get_msg()."\n";
	        $query_trans="ROLLBACK";
	      }
	      $query_solicit="DELETE FROM ".TBL_SOL_FUNC." WHERE ID_CIDADE=$ID_CIDADE_ANT AND ID_SOLIC_FUNC=$ID_SOLIC_FUNC AND ID_TP_FUNC=$ID_TP_FUNC";
	      $conn->query($query_solicit);
	      if ($conn->get_status()==false) {
	        $ERRO_TRANS.="ERRO NA SOLICITACAO DESC DELETE CIDADE:".$conn->get_msg()."\n";
	        $query_trans="ROLLBACK";
	      }
	      $ID_SOLIC_FUNC=$NEW_ID_SOLIC_FUNC;
	      $ID_TP_FUNC=$NEW_ID_TP_FUNC;
	    }
	
	    $query_prot="INSERT INTO ".TBL_PROT_FUNC." (ID_PROT_FUNC, ID_CIDADE, ID_SOLIC_FUNC, ID_TP_FUNC, CH_VISTORIADO, DT_PROTOCOLADO, ID_TP_SERVICO, ID_SERVICO, ID_CIDADE_SERVICO, VL_VISTORIA, ID_USUARIO) VALUES ($ID_PROT_FUNC, $ID_CIDADE, $ID_SOLIC_FUNC,$ID_TP_FUNC, 'N', CURDATE(), $ID_TP_SERVICO, $ID_SERVICO,$ID_CIDADE, $VL_AREA_VISTORIADA,'$usuario')";
	    $conn->query($query_prot);
	    if ($conn->get_status()==false) {
	      $ERRO_TRANS.="ERRO NO PROTOCOLO:".$conn->get_msg()."\n";
	      $query_trans="ROLLBACK";
	    }
	    $ID_PROT_FUNC=$conn->insert_id();
	    $ID_PROT_FUNC_RES=$ID_PROT_FUNC;
	    $query_formula="SELECT NR_MAX_PARCELA, NR_PRAZO_VENCTO, DE_FORMULA, VL_MIN_PARCELA, VL_MAX_PARCELA FROM ".TBL_FORMULA." WHERE ".TBL_FORMULA.".ID_CIDADE=$ID_CIDADE AND ID_TP_SERVICO=$ID_TP_SERVICO AND ID_SERVICO=$ID_SERVICO AND VL_MIN_AREA<=$VL_AREA_VISTORIADA AND VL_MAX_AREA>=$VL_AREA_VISTORIADA";
	    $conn->query($query_formula);
	    if ($conn->get_status()==false) {
	      $ERRO_TRANS.="ERRO NA SELE��O DO SERVI�O: ".$conn->get_msg()."\n";
	      $query_trans="ROLLBACK";
	    }
	    $fetch_formula=$conn->fetch_row();
	    $VL_DESC_ABATIMENTO=0;
	    $VL_OUTRAS_DEDUCOES=0;
	    $VL_MULTA_MORA=0;
	    $VL_OUTROS_ACRESCIMOS=0;
	    $DT_VENCIMENTO=date("Y-m-d", mktime(0,0,0,date("m",time()), (date("d",time())+$fetch_formula["NR_PRAZO_VENCTO"]), date("Y", time())));
	    $RESULTADO=0;
	    $VL_AREA=$VL_AREA_VISTORIADA;
	    eval($fetch_formula["DE_FORMULA"].";");
	    if ($RESULTADO>0) {
	      $vl_parcela=$RESULTADO/$fetch_formula["NR_MAX_PARCELA"];
	      $VL_COBRANCA=$vl_parcela-$VL_DESC_ABATIMENTO-$VL_OUTRAS_DEDUCOES+$VL_MULTA_MORA+$VL_OUTROS_ACRESCIMOS;
	      if ($vl_parcela>=$fetch_formula["VL_MIN_PARCELA"]) {
	        $NR_PARCELA=$fetch_formula["NR_MAX_PARCELA"];
	      } else {
	        $NR_PARCELA=1;
	      }
	
	      $VL_COBRANCA=$vl_parcela-$VL_DESC_ABATIMENTO-$VL_OUTRAS_DEDUCOES+$VL_MULTA_MORA+$VL_OUTROS_ACRESCIMOS;
	      if ($vl_parcela>=$fetch_formula["VL_MIN_PARCELA"]) {
	        $NR_PARCELA=$fetch_formula["NR_MAX_PARCELA"];
	      } else {
	        $NR_PARCELA=1;
	      }
	      for ($NR_PARCELA=1;$NR_PARCELA<=$fetch_formula["NR_MAX_PARCELA"];$NR_PARCELA++) {
	        if ($NR_PARCELA>1) {
	          $data_venc=explode("-",$DT_VENCIMENTO);
	          $DT_VENCIMENTO=date("Y-m-d", mktime(0,0,0,($data_venc[1]+1), $data_venc[2], $data_venc[0]));
	        }
	        $ID_COBRANCA_BOLETO=0;
	        $query_boleto="REPLACE INTO ".TBL_COB_BOLETO." (ID_CIDADE, ID_COBRANCA_BOLETO, ID_PROT_FUNC, ID_CIDADE_PROT_FUNC, CH_TIPO_COBRANCA, NR_PARCELA, DT_GERACAO, DT_VENCIMENTO, VL_TOTAL_COBRADO, VL_COBRANCA_DOC, VL_DESC_ABATIMENTO, VL_OUTRAS_DEDUCOES, VL_MULTA_MORA, VL_OUTROS_ACRESCIMOS, VL_COBRANCA) VALUES ($ID_CIDADE, $ID_COBRANCA_BOLETO, $ID_PROT_FUNC_RES,$ID_CIDADE, 'F', $NR_PARCELA, CURDATE(), '$DT_VENCIMENTO',$RESULTADO,$vl_parcela,$VL_DESC_ABATIMENTO,$VL_OUTRAS_DEDUCOES,$VL_MULTA_MORA,$VL_OUTROS_ACRESCIMOS,$VL_COBRANCA)";
	        $conn->query($query_boleto);
	        if ($conn->get_status()==false) {
	          $ERRO_TRANS.="ERRO NA CRIA��O DO BOLETO: ".$conn->get_msg()."\n";
	          $query_trans="ROLLBACK";
	        }
	      }
	    }
	    if (trim($ERRO_TRANS)=="") {
	      $conn->query($query_trans);
	    }
	    if ($conn->get_status()==false) {
	      $ERRO_TRANS.="ERRO NTRANSA��O:".$conn->get_msg()."\n";
	      $query_trans="ROLLBACK";
	      mysql_query($query_trans);
	      die($ERRO_TRANS);
	    }

	  } else {
	    $erro=MSG_ERR_INC;
	  }
	} 

} else {
    if ($campos_existe) {
      $erro= MSG_ERR_OBR;
    }
}

  if (@$ID_PROT_FUNC!="") {
?>

<form name="form_index" method="post">
  <input type="hidden" name="op_menu" value="">
</form>

<script language="javascript" type="text/javascript">//<!--

window.confirm("Solicita��o Protocolada com o n�mero <?=$ID_PROT_FUNC?>")

f = document.form_index;
f.op_menu.value='vist_func_pendent';
f.submit();


//--></script>
<?
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo,arq) {
      if (campo.value!="") {
        window.open(arq+"?campo="+campo.value,"consulprot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
<?
if ($global_inclusao=="S") {
?>
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.btn_incluir;
<?
} else {

?>
      frm.btn_incluir;
<?
}
?>
      frm.txt_id_prot_funcionamento.readOnly=false;
    }
    function cons_logra(valor,cidade) {
      if (cidade!="") {
        window.open("./modulos/processos/protocolo/cons_logra_func.php?txt_nm_logradouro="+valor+"&hdn_id_cidade="+cidade,"cons_logradouro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=400,innerwidth=780,innerheight=400");
      } else {
        alert("Cidade deve ser selecionada!");
      }
    }

    function consultaSelc(formulario,cmb_campo,tabela,atrib,cond,obrigatorio,campo_atual,campos_limpos,novo) {
      if ((campo_atual.value != "" )&&(campo_atual.value != 0)) {
         window.open("./php/consultaSelc.php?formulario="+formulario+"&cmb_campo="+cmb_campo+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio+"&novo="+novo,"consulsec","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      } else {
        var cmp = campos_limpos.split(",");
        for (var i=0;i<cmp.length;i++) {
          window.document.frm_prot_funcionamento[cmp[i]].options.length=0;
          sec_cmb=window.document.frm_prot_funcionamento[cmp[i]].options.length++;
          window.document.frm_prot_funcionamento[cmp[i]].options[sec_cmb].text='_____________________';
          window.document.frm_prot_funcionamento[cmp[i]].options[sec_cmb].value='0';
        }
      }
    }
    function verifica_valor(){
      var vfrm=document.frm_prot_funcionamento;
      var desc_erro="";
      var vl_vist=vfrm.txt_vl_area_vistoria.value;
      var vl_tot=vfrm.txt_vl_area_tot_const.value;
      while (vl_tot.indexOf(".")>-1) {
        vl_tot=vl_tot.replace(".","");
      }
      while (vl_tot.indexOf(",")>-1) {
        vl_tot=vl_tot.replace(",",".");
      }
      while (vl_vist.indexOf(".")>-1) {
        vl_vist=vl_vist.replace(".","");
      }
      while (vl_vist.indexOf(",")>-1) {
        vl_vist=vl_vist.replace(",",".");
      }
      if (isNaN(parseFloat(vl_tot))) {
        vl_tot=-9999999.99;
      }
      if (isNaN(vl_vist)) {
        vl_vist=999999999999;
      }
      if (parseFloat(vl_tot)<parseFloat(vl_vist)) {
        desc_erro+="=> �rea de Vistoria MENOR que �rea Constru�da\n";
      }
      if (desc_erro!="") {
        alert("ATEN��O!\n"+desc_erro+"Verifique!!!");
      }
    }
    function servico(cidade) {
      consultaSelc("frm_prot_funcionamento","cmb_id_servico","<?=TBL_SERVICO?>","ID_SERVICO,NM_SERVICO","CH_OPERACAO IN ("+document.frm_prot_funcionamento.hdn_opracao.value+") AND ID_CIDADE="+cidade,"",document.frm_prot_funcionamento.hdn_id_cidade,"cmb_id_servico,cmb_id_tp_servico","")
    }

//--></script>
<body onload="ajustaspan()">

<? if(@$encontrouSolicitacao) { ?>

  <form target="_self" enctype="multipart/form-data" method="post" name="frm_prot_funcionamento" onreset="retorna(this)" onsubmit="return validaForm(this,<?=$campos_js?>)">
  <input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">
  <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">

  <? foreach($_POST as $nome => $valor) { ?>
	  <input type="hidden" name="<?=$nome?>" value="<?=$valor?>"/>
  <? } ?>	
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
                    <legend>Empresa</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
                      <tr>
                        <td>
		  <table width="100%" border="0" cellpadding="2" cellspacing="2">
                            <tr>
                              <td>CNPJ</td>
                              <td><input type="text" name="txt_nr_cnpj_empresa" value="<?=$_POST['txt_nr_cnpj_empresa']?>" size="20" maxlength="18" class="campo_obr" title="CPF ou CNPJ da Empresa Solicitante de Funcionamento da Edifica��o" onblur="cpfcnpj(this)" value=""></td>
                              <td>Raz�o Social</td>
                              <td><input type="text" name="txt_nm_empresa" value="<?=$_POST['txt_nm_empresa']?>" size="50" maxlength="100" class="campo_obr" title="Raz�o Social da Empresa Solicitante do Funcionamento"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
			<table width="100%" border="0" cellpadding="2" cellspacing="2">
                            <tr>
                              <td>Nome Fantasia<br>Empresa</td>
                              <td><input type="text" name="txt_nm_fantasia_empresa" value="<?=$_POST['txt_nm_fantasia_empresa']?>" size="30" maxlength="100" class="campo_obr" title="Nome Fantasia da Empresa Solicitante"></td>
                              <td>Nome Contato</td>
                              <td><input type="text" name="txt_nm_contato" value="<?=$_POST['txt_nm_contato']?>" size="30" maxlength="100" class="campo_obr" title="Nome do Respons�vel da Empresa Solicitante"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
			  <table width="100%" border="0" cellpadding="2" cellspacing="2">
                            <tr>
                              <td width="30">Fone</td>
                              <td><input type="text" name="txt_nr_fone_empresa" value="<?=$_POST['txt_nr_fone_empresa']?>" size="13" maxlength="12" class="campo_obr" title="Fone do Solicitante de Funcionamento da Edifica��o"></td>
                              <td>E-mail</td>
                              <td><input type="text" name="txt_de_email_empresa" value="<?=$_POST['txt_de_email_empresa']?>" size="61" maxlength="100" class="campo_obr" title="E-mail do Solicitante de Funcionamento da Edifica��o" style="text-transform : none;"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </fieldset>
	      </td>
	    </tr>
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Solicita��es Protocoladas</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td colspan="2"><b><br>
              <? if(count($solicitacoes)==1) { ?>
              	Existe a seguinte solicita��o protocolada para este endere�o:
              <? } else { ?>
              	Existem <?=count($solicitacoes)?> solicita��es protocoladas para este endere�o:
              <? } ?>
              </b><br><br></td>
			</tr>              
            <tr>
              <td colspan="2">
              	<table border="0" width="100%" align="center">
				<? foreach($solicitacoes as $solicitacao) { ?>
					<tr>
						<td align="right" width="100">Data:&nbsp;</td> 
						<td><b><?=$solicitacao['DT_SOLICITACAOS']?></b></td>
					</tr> 
					<tr>
						<td align="right">Edifica��o:&nbsp;</td> 
						<td><?=$solicitacao['NM_EDIFICACOES']?></td>
					</tr> 
					<tr>
						<td align="right">Nome Fantasia:&nbsp;</td> 
						<td><? if($solicitacao['NM_FANTASIA_EMPRESA']) echo "$solicitacao[NM_FANTASIA_EMPRESA]"; else echo "<i>n�o informado</i>";?></td>
					</tr> 
					<tr>
						<td align="right">Logradouro:&nbsp;</td> 
						<td><?=$solicitacao['NM_LOGRADOURO']?>, <?=$solicitacao['NR_EDIFICACOES']?></td>
					</tr> 
					<tr>
						<td align="right">CEP:&nbsp;</td> 
						<td><?=$ID_CEP?>  <?=$solicitacao['NM_BAIRRO']?>/<?=$solicitacao['NM_CIDADE']?></td>
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
    <tr valign="top" align="center">
      <td>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr align="center" valign="center">
            <td>
              <input type="submit" name="btn_enviar_solicitacao" value="Enviar" align="middle" title="Enviar Solicita��o" class="botao" >
            </td>
            <td>
              <input type="button" name="btn_voltar" value="Voltar" onclick="javascript:history.back();" align="middle" title="Voltar ao formul�rio" class="botao" >
            </td>
          </tr>
        </table>
    </tr>
  </table>
  </form>

<? } else { ?>

<form target="_self" enctype="multipart/form-data" method="post" name="frm_prot_funcionamento" onreset="retorna(this)" onsubmit="return validaForm(this,<?=$campos_js?>)">
<input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td>
      <fieldset>
	<legend>Protocolo</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
	  <tr>
	    <td align="right">N� Protocolo</td>
	    <td>
	      <input type="hidden" name="hdn_id_cidade_ant" value="">
	      <input type="text" name="txt_id_prot_funcionamento" value="" class="campo" align="right" title="N�mero do Protocolo" size="15" maxlength="11" onblur="consultaReg(this,'cons_prot_funcionamento.php')">
	    </td>
	    <td align="right">Data Protocolo</td>
	    <td><input type="text" name="txt_dt_protocolo" value="<?=Date('d/m/Y', Time())?>" class="campo" readOnly="true" title="Data de Protocolamento" size="15" maxlength="10"></td>
	  </tr>
	</table>
      </fieldset>
      </td>
    </tr>
    <tr>
      <td>
	<fieldset>
	  <legend>Solicitante</legend>
	  <input type="hidden" name="hdn_id_solic_funcionamento" value="<?=@$_POST["hdn_id_solic_funcionamento"]?>">
<?
	  if (@$_POST["hdn_id_tp_funcionamento"]!="") {
?>
	  <input type="hidden" name="hdn_id_tp_funcionamento" value="<?=@$_POST["hdn_id_tp_funcionamento"]?>">
<?
	  } else {
?>
	  <input type="hidden" name="hdn_id_tp_funcionamento" value="P">
<?
	  }
?>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
	  <tr>
	    <td>
              <table  width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
                <td align="right">CNPJ</td>
		  <td>
		    <input type="text" name="txt_nr_cnpj_empresa" size="35" maxlength="18" class="campo_obr" title="CPF ou CNPJ da Empresa Solicitante de Funcionamento da Edifica��o" onblur="cpfcnpj(this)" value="">
		  </td>
                <td nowrap="true" align="right">Raz�o Social</td>
                 <td>
		    <input type="text" name="txt_nm_empresa" size="60" maxlength="100" class="campo_obr" title="Raz�o Social da Empresa Solicitante do Funcionamento">
		 </td>
            </tr>
              <tr>
		<td align="right" nowrap="true">Nome Fantasia Empresa</td>
             	 <td>
		   <input type="text" name="txt_nm_fantasia_empresa" size="35" maxlength="100" class="campo_obr" title="Nome Fantasia da Empresa Solicitante">
		 </td>
               	<td align="right">Nome Contato</td>
		 <td>
		   <input type="text" name="txt_nm_contato" size="60" maxlength="100" class="campo_obr" title="Nome do Respons�vel da Empresa Solicitante">
		 </td>
              </tr>
		<tr>
		  <td  align="right" width="30">Fone</td>
		  <td><input type="text" name="txt_nr_fone_empresa" size="35" maxlength="12" class="campo_obr" title="Fone do Solicitante de Funcionamento da Edifica��o"></td>
		  <td align="right">E-mail</td>
		  <td><input type="text" name="txt_de_email_empresa" size="60" maxlength="100" class="campo_obr" title="E-mail do Solicitante de Funcionamento da Edifica��o" style="text-transform : none;"></td>
		</tr>
	      </table>
	    </td>
	  </tr>
	</table>
      </fieldset>
    </td>
  </tr>
  <tr>
    <td>
      <fieldset>
	<legend>Edifica��o</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
	  <tr>
	    <td align="right">Nome</td>
	    <td colspan="3"><input type="text" name="txt_nm_edificacao" size="58" class="campo_obr" title="Nome da Edifica��o" value="" readOnly="true"></td>
	  </tr>
	    <tr>
	    <td align="right">Tipo</td>
	    <td>
	      <select name="cmb_id_tp_prefixo" class="campo_obr">
	      <option value="">---------------</option>
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
	    <td align="right">Logradouro</td>
	    <td>
	      <input type="hidden" name="hdn_id_logradouro" value="" readOnly="true">
	      <input type="text" size="60" class="campo_obr" value="" name="txt_nm_logradouro" title="Nome do Logradouro" maxlength="100">
	    </td>
	  </tr>
	  <tr>
	    <td align="right">N�</td>
	    <td height="10"><input type="text" size="21" maxlength="5" name="txt_nr_edificacao" align="right" class="campo" title="N�mero da Edifica��o no Logradouro" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)" readOnly="true"></td>
	    <td align="right">Bairro</td>
	    <td>
	      <input type="hidden" name="hdn_id_bairro" value="">
	      <input type="text" size="60" maxlength="60" value="" name="txt_nm_bairro" class="campo_obr" title="Nome do Bairro" readOnly="true"></td>
	  </tr>
	  <tr>
	    <td align="right">CEP</td>
	    <td><input type="text" size="25" maxlength="10" name="txt_id_cep" value="" class="campo_obr" title="N�mero do CEP" onkeypress="return validaTecla(this, event, 'n')" onblur="CEP(this)" readOnly="true"></td>
	    <td align="right">Cidade</td>
	    <td>
	    <?
	      if ((@$_POST["hdn_id_solic_funcionamento"]!="") && (@$_POST["hdn_id_cidade"]!="") && (@$_POST["hdn_id_tp_funcionamento"]!="")){
		$sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." WHERE ID_UF IN ('SC') ORDER BY NM_CIDADE";
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
	      <input type="text" name="cme_id_cidade" size="60" maxlength="50" value="" class="campo_obr" style="text-align: left; font-size: 12px;  background-repeat: no-repeat; background-position: right top; background-color: #FFFFFF; color: #000000; border: 1px SOLID #AAAAAA" onfocus="actb(this,event,cme_id_cidade_edCombItens,cme_id_cidade_edCombLinks,cme_id_cidade_edCombAlts,120)">
	      <script language='JavaScript'>//<!--
		cme_id_cidade_edCombItens=new Array(<?=$J_ITENS?>);
		cme_id_cidade_edCombLinks=new Array(<?=$J_LINKS?>);
		cme_id_cidade_edCombAlts=new Array(<?=$J_ALTS?>);
		var campo_destino=document.frm_prot_funcionamento.hdn_id_cidade;
		var campo_blur = "var xxxx=1;";
	      //--></script>
	    <?
	      } else {
	    ?>
	      <input type="hidden" name="hdn_id_cidade" value="">
	      <input type="text" name="txt_nm_cidade" size="40" maxlength="100" readOnly="true" class="campo_obr">
	    <?
	      }
	    ?>
	    </td>
	    </tr>
	    <tr>
	      <td align="right">Complemento</td>
	      <td colspan="2"><input type="text" name="txt_nm_complemento" class="campo" size="50" maxlength="100" value="" title="Complemento do Endere�o da Edifica��o" readOnly="true"></td>
	      <td>
		<input type="button" name="btn_valida_logradouro" value="Validar" class="botao"  title="Validar o Logradouro Existente" onClick="cons_logra(document.frm_prot_funcionamento.txt_nm_logradouro.value,document.frm_prot_funcionamento.hdn_id_cidade.value)">
	      </td>
	    </tr>
	    <tr>
	      <td align="right">�rea Construida</td>
	      <td><input type="text" align="right" name="txt_vl_area_tot_const" size="25" class="campo_obr" title="Valor da �rea Total Construida da Edifica��o" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2);verifica_valor();" readOnly="true"></td>
	      <td align="right">�rea de Vistoria</td>
	      <td>
		<input type="text" align="right" name="txt_vl_area_vistoria" size="25" class="campo_obr" title="Valor da �rea a ser Vistoriada" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2);verifica_valor();">
	      </td>
	    </tr>
	</table>
      </fieldset>
    </td>
  </tr>
  <tr>
    <td>
      <fieldset>
	<legend align="left">Financeiro</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
	  <tr>
	    <td align="right">Servi�o</td>
	    <td>
	      <input type="hidden" name="hdn_opracao" value="'F','T'">
	      <select name="cmb_id_servico" class="campo_obr" title="Servi�o a Ser Prestado" onChange="consultaSelc(this.form.name,'cmb_id_tp_servico','<?=TBL_TP_SERVICO?>','ID_TP_SERVICO,NM_TP_SERVICO','ID_SERVICO='+this.value+' AND ID_CIDADE='+document.frm_prot_funcionamento.hdn_id_cidade.value,'s',this,'cmb_id_tp_servico','');">
		<option value="">____________________</option>
	      </select>
	    </td>
	    <td align="right">Tipo Servi�o</td>
	    <td>
	      <select name="cmb_id_tp_servico" class="campo_obr" title="Tipo de Servi�o a Ser Prestado">
		<option value="">_____________________</option>
	      </select>
	    </td>
	  </tr>
	</table>
      </fieldset>
    </td>
  </tr>

<? include('./templates/btn_inc.htm'); ?>

</table>

<?

  if ((@$_POST["hdn_id_solic_funcionamento"]!="") && (@$_POST["hdn_id_cidade"]!="") && (@$_POST["hdn_id_tp_funcionamento"]!="")){

    $sql = "SELECT ".TBL_SOL_FUNC.".ID_CIDADE, ".TBL_SOL_FUNC.".ID_SOLIC_FUNC, ".TBL_SOL_FUNC.".ID_TP_FUNC, ".TBL_SOL_FUNC.".CH_PAGO, ".TBL_SOL_FUNC.".CH_TP_FUNC, ".TBL_SOL_FUNC.".NR_CNPJ_EMPRESA, ".TBL_SOL_FUNC.".NM_RAZAO_SOCIAL, ".TBL_SOL_FUNC.".NM_FANTASIA_EMPRESA, ".TBL_SOL_FUNC.".NM_CONTATO, ".TBL_SOL_FUNC.".NR_FONE_EMPRESA, ".TBL_SOL_FUNC.".DE_EMAIL_EMPRESA, ".TBL_SOL_FUNC.".NR_CNPJ_CPF_PROPRIETARIO, ".TBL_SOL_FUNC.".NM_PROPRIETARIO, ".TBL_SOL_FUNC.".NR_FONE_PROPRIETARIO, ".TBL_SOL_FUNC.".DE_EMAIL_PROPRIETARIO, ".TBL_SOL_FUNC.".NM_EDIFICACOES, ".TBL_SOL_FUNC.".NM_FANTASIA, ".TBL_SOL_FUNC.".ID_TP_LOGRADOURO, ".TBL_SOL_FUNC.".NM_LOGRADOURO, ".TBL_SOL_FUNC.".NR_EDIFICACOES, ".TBL_SOL_FUNC.".NR_CEP, ".TBL_SOL_FUNC.".NM_BAIRRO, ".TBL_SOL_FUNC.".NM_COMPLEMENTO, ".TBL_SOL_FUNC.".VL_AREA_CONSTRUIDA, ".TBL_SOL_FUNC.".CH_PROTOCOLADO, DATE_FORMAT(".TBL_SOL_FUNC.".DT_SOLICITACAO,'%d/%m/%Y') AS DT_SOLICITACAO, ".TBL_SOL_FUNC.".ID_USUARIO, ".TBL_CIDADE.".NM_CIDADE, SUM(".TBL_DESC_FUNC.".VL_AREA_DESC_FUNC) AS VL_AREA_DESC_VISTORIAS FROM ".TBL_SOL_FUNC." LEFT JOIN ".TBL_CIDADE." ON(".TBL_SOL_FUNC.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_DESC_FUNC." ON(".TBL_SOL_FUNC.".ID_SOLIC_FUNC=".TBL_DESC_FUNC.".ID_SOLIC_FUNC AND ".TBL_SOL_FUNC.".ID_TP_FUNC=".TBL_DESC_FUNC.".ID_TP_FUNC AND ".TBL_SOL_FUNC.".ID_CIDADE=".TBL_DESC_FUNC.".ID_CIDADE) WHERE ".TBL_SOL_FUNC.".ID_SOLIC_FUNC=".$_POST["hdn_id_solic_funcionamento"]." and ".TBL_SOL_FUNC.".ID_TP_FUNC='".$_POST["hdn_id_tp_funcionamento"]."' AND ".TBL_SOL_FUNC.".ID_CIDADE=".$_POST["hdn_id_cidade"]." GROUP BY ".TBL_SOL_FUNC.".ID_SOLIC_FUNC, ".TBL_SOL_FUNC.".ID_TP_FUNC, ".TBL_SOL_FUNC.".ID_CIDADE";

    $conn->query($sql);
    $row_solicita = $conn->num_rows();

    if ($row_solicita>0) {

      $solicitacao = $conn->fetch_row();
      $NM_RAZAO_SOCIAL		= $solicitacao["NM_RAZAO_SOCIAL"];
      $NR_FONE_EMPRESA    	= $solicitacao["NR_FONE_EMPRESA"];
      $NR_CNPJ_EMPRESA 		= $solicitacao["NR_CNPJ_EMPRESA"];
      $DE_EMAIL_EMPRESA   	= $solicitacao["DE_EMAIL_EMPRESA"];
      $NM_CONTATO		= $solicitacao["NM_CONTATO"];
      $NM_FANTASIA_EMPRESA	= $solicitacao["NM_FANTASIA_EMPRESA"];
      $NM_EDIFICACAO		= $solicitacao["NM_EDIFICACOES"];
      $NM_LOGRADOURO		= $solicitacao["NM_LOGRADOURO"];
      $NR_EDIFICACAO		= $solicitacao["NR_EDIFICACOES"];
      $NM_BAIRROS		= $solicitacao["NM_BAIRRO"];
      $NR_CEP			= $solicitacao["NR_CEP"];
      $ID_CIDADE		= $solicitacao["ID_CIDADE"];
      $ID_TP_PREFIXO		= $solicitacao["ID_TP_LOGRADOURO"];
      $NM_COMPLEMENTO		= $solicitacao["NM_COMPLEMENTO"];
      $VL_AREA_CONSTRUIDA	= $solicitacao["VL_AREA_CONSTRUIDA"];
      $NM_CIDADE		= $solicitacao["NM_CIDADE"];
      $DT_SOLICITACAO		= $solicitacao["DT_SOLICITACAO"];
      $VL_AREA_DESC_VISTORIAS   = $solicitacao["VL_AREA_DESC_VISTORIAS"];

	    ?>
	    <script language="javascript" type="text/javascript">//<!--
	    var frm_at=document.frm_prot_funcionamento;
	    frm_at.txt_id_prot_funcionamento.readOnly=true;
	    frm_at.hdn_id_tp_funcionamento.value="<?=$_POST["hdn_id_tp_funcionamento"]?>";
	    frm_at.txt_nm_empresa.value="<?=$NM_RAZAO_SOCIAL?>";
	    frm_at.txt_nm_fantasia_empresa.value="<?=$NM_FANTASIA_EMPRESA?>";
	    frm_at.txt_nm_contato.value="<?=$NM_CONTATO?>";
	    frm_at.txt_nr_fone_empresa.value="<?=$NR_FONE_EMPRESA?>";
	    frm_at.txt_nr_cnpj_empresa.value="<?=$NR_CNPJ_EMPRESA?>";
	    cpfcnpj(frm_at.txt_nr_cnpj_empresa);
	    frm_at.txt_de_email_empresa.value="<?=$DE_EMAIL_EMPRESA?>";
	    frm_at.txt_nm_edificacao.value="<?=$NM_EDIFICACAO?>";
	    frm_at.txt_nm_edificacao.readOnly=true;
	    frm_at.txt_nm_logradouro.value="<?=$NM_LOGRADOURO?>";
	    frm_at.txt_nr_edificacao.value="<?=$NR_EDIFICACAO?>";
	    FormatNumero(frm_at.txt_nr_edificacao);
	    frm_at.txt_nm_bairro.value="<?=$NM_BAIRROS?>";
	    frm_at.txt_id_cep.value="<?=$NR_CEP?>";
	    CEP(frm_at.txt_id_cep);
	    frm_at.txt_vl_area_tot_const.value="<?=str_replace(".",",",$VL_AREA_CONSTRUIDA)?>";
	    FormatNumero(frm_at.txt_vl_area_tot_const);
	    decimal(frm_at.txt_vl_area_tot_const,2);
	    frm_at.txt_vl_area_vistoria.value="<?=str_replace(".",",",$VL_AREA_DESC_VISTORIAS)?>";
	    FormatNumero(frm_at.txt_vl_area_vistoria);
	    decimal(frm_at.txt_vl_area_vistoria,2);
	    frm_at.txt_nm_complemento.value="<?=str_replace('"',' ',$NM_COMPLEMENTO)?>";
	    frm_at.hdn_id_cidade.value="<?=$ID_CIDADE?>";
	    frm_at.cme_id_cidade.value="<?=$NM_CIDADE?>";
	    frm_at.hdn_id_cidade_ant.value="<?=$ID_CIDADE?>";
	    frm_at.cmb_id_tp_prefixo.value="<?=$ID_TP_PREFIXO?>";
	    verifica_valor();
	    <?
	      $query_servico="SELECT ID_SERVICO,NM_SERVICO FROM ".TBL_SERVICO." WHERE ID_CIDADE=$ID_CIDADE AND CH_OPERACAO IN ('F','T')";
	      $conn->query($query_servico);
	    ?>
	    var sec_cmb_id_servico_pen=0;
	    frm_at.cmb_id_servico.options.length=0;
	    sec_cmb_id_servico_pen=frm_at.cmb_id_servico.options.length++;
	    frm_at.cmb_id_servico.options[sec_cmb_id_servico_pen].value="";
	    <?
	      if ($conn->num_rows()>0) {
		while ($fetch_servico=$conn->fetch_row()) {
		    ?>
		    sec_cmb_id_servico_pen=frm_at.cmb_id_servico.options.length++;
		    frm_at.cmb_id_servico.options[sec_cmb_id_servico_pen].text="<?=$fetch_servico["NM_SERVICO"]?>";
		    frm_at.cmb_id_servico.options[sec_cmb_id_servico_pen].value="<?=$fetch_servico["ID_SERVICO"]?>";
		    <?
	    }
	    }
	?>
	</script>
	<?
	    }
	  }
	?>
          </form>
<? } ?>


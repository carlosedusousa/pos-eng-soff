<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title>SIGAT - SOLICITAÇÃO DE HABITE-SE</title>
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
  $arquivo="solic_analise_func.php";
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

$campos_preenchidos=true;
$campos_existe=true;
  
$campos_obr= array('txt_nm_solicitante'=>"'txt_nm_solicitante,Nome do Solicitante,t'",
'txt_nr_cnpjcpf_solicitante'=>"'txt_nr_cnpjcpf_solicitante,CPF/CNPJ do Solicitante,t'",
'txt_fone_solicitante'=>"'txt_fone_solicitante,Fone do Solicitante,n'",
'txt_de_email_solicitante'=>"'txt_de_email_solicitante,Email do Solicitante,e'",
'txt_nm_proprietario'=>"'txt_nm_proprietario,Nome do Proprietário,t'",
'txt_nr_cnpjcpf_proprietario'=>"'txt_nr_cnpjcpf_proprietario,CPF/CNPJ do Proprietário,t'",
'txt_fone_proprietario'=>"'txt_fone_proprietario,Fone do Proprietário,n'",
'txt_de_email_proprietario'=>"'txt_de_email_proprietario,E-mail do Proprietário,e'",
'txt_nm_edificacao'=>"'txt_nm_edificacao,Nome da Edificação,t'",
'cmb_id_tp_prefixo'=>"'cmb_id_tp_prefixo,Prefixo do Logradouro,t'",
'txt_nm_logradouro'=>"'txt_nm_logradouro,Logradouro,t'",
'cmb_id_cidade'=>"'cmb_id_cidade,Cidade,t'",
'txt_nm_bairro'=>"'txt_nm_bairro,Bairro,t'",
'txt_nr_area_tot_const'=>"'txt_nr_area_tot_const,Àrea total Contruida,t'",
'txt_nr_altura'=>"'txt_nr_altura,Altura,t'",
'txt_nr_area_pavimento'=>"'txt_nr_area_pavimento,Área do Pavimento,t'",
'cbm_id_ocupacao'=>"'cbm_id_ocupacao,Ocupação,t'",
'cmb_id_risco'=>"'cmb_id_risco,Risco,t'",
'cmb_id_tp_construcao'=>"'cmb_id_tp_construcao,Tipo da Contrução,t'",
'cmb_nr_pavimentos'=>"'cmb_nr_pavimentos,Nº de Pavimentos,t'",
'cmb_nr_blocos'=>"'cmb_nr_blocos,Nº de Blocos,t'",
'cmb_id_situacao'=>"'cmb_id_situacao,Situação da Edificação,t'"
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

//echo "<pre>"; print_r($_POST); echo "</pre>";
  
  if ($campos_preenchidos) {
    // string da query
    $ID_SOLICITACAO             ="''";
    $ID_TIPO_SOLICITACAO        ="'FP'";
    $CNPJ_CPF_SOLICITANTE       = formataCampo(str_replace("-","",str_replace("/","",str_replace(".","",$_POST["txt_nr_cnpjcpf_solicitante"]))));
    $NM_SOLICITANTE             = formataCampo($_POST["txt_nm_solicitante"]);
    $NM_FANTASIA_EMPRESA        = formataCampo($_POST["txt_nm_fantasia_empresa"]);
    $NM_CONTATO                 = formataCampo($_POST["txt_nm_contato"]);
    $NR_FONE_SOLICITANTE        = formataCampo($_POST["txt_fone_solicitante"],"n");
    $DE_EMAIL_SOLICITANTE       = formataCampo($_POST["txt_de_email_solicitante"],"t","l");
    $CNPJ_CPF_PROPRIETARIO      = formataCampo(str_replace("-","",str_replace("/","",str_replace(".","",$_POST["txt_nr_cnpjcpf_proprietario"]))));
    $NM_PROPRIETARIO            = formataCampo($_POST["txt_nm_proprietario"]);
    $NR_FONE_PROPRIETARIO       = formataCampo($_POST["txt_fone_proprietario"],"n");
    $DE_EMAIL_PROPRIETARIO      = formataCampo($_POST["txt_de_email_proprietario"],"t","l");
    $NM_EDIFICACOES_LX          = formataCampo($_POST["txt_nm_edificacao"]);
    $NM_FANTASIA                = formataCampo(@$_POST["txt_nm_fantasia"]);
    $NM_LOGRADOURO              = formataCampo($_POST["txt_nm_logradouro"]);
    $NR_EDIFICACOES_LX          = formataCampo(@$_POST["txt_nr_numero"],"n","O");
    $NR_CEP                     = formataCampo(@$_POST["txt_nr_cep"],"n");
    $NM_BAIRRO                  = formataCampo($_POST["txt_nm_bairro"]);
    $NM_COMPLEMENTO             = formataCampo(@$_POST["txt_nm_complemento"]);
    $VL_AREA_CONTRUIDA          = formataCampo($_POST["txt_nr_area_tot_const"],"D");
    $VL_ALTURA                  = formataCampo($_POST["txt_nr_altura"],"D");
    $VL_AREA_TIPO               = formataCampo($_POST["txt_nr_area_pavimento"],"D");
    $NR_PAVIMENTOS              = formataCampo($_POST["cmb_nr_pavimentos"],"N");
    $NR_BLOCOS                  = formataCampo($_POST["cmb_nr_blocos"],"N");
    $CH_SIS_PREVENTIVO_EXTINTOR = formataCampo(@$_POST["chk_ch_extintor"],'sn');
    $NR_ESCADA_COMUM            = formataCampo(@$_POST["cmb_nr_escada_comum"],"n","D");
    $NR_ESCADA_PROTEGIDA        = formataCampo(@$_POST["cmb_nr_protegida"],"n","D");
    $NR_ESCADA_ENC              = formataCampo(@$_POST["cmb_nr_enclausurada"],"n","D");
    $NR_ESCADA_PROVA_FUMACA     = formataCampo(@$_POST["cmb_nr_esc_fumaca"],"n","D");
    $NR_ESCADA_PRESSU           = formataCampo(@$_POST["cmb_nr_pressurizada"],"n","D");
    $NR_RAMPA                   = formataCampo(@$_POST["cmb_nr_rampa"],"n","D");
    $NR_ELEV_EMERGENCIA         = formataCampo(@$_POST["cmb_nr_elev_emerg"],"n","D");
    $NR_RESG_AEREO              = formataCampo(@$_POST["cmb_nr_reg_aereo"],"n","D");
    $NR_PASSARELA               = formataCampo(@$_POST["cmb_nr_passarela"],"n","D");
    $ID_RISCO                   = formataCampo($_POST["cmb_id_risco"],"N");
    $ID_SITUACAO                = formataCampo(@$_POST["cmb_id_situacao"],"N");
    $ID_TP_CONSTRUCAO           = formataCampo($_POST["cmb_id_tp_construcao"],"N");
    $ID_OCUPACAO                = formataCampo($_POST["cbm_id_ocupacao"],"N");
    $ID_TP_ALARME_INCENDIO      = formataCampo(@$_POST["cmb_id_tp_detc_incendio"],"N",'O');
    $ID_ILU_EMERG               = formataCampo(@$_POST["cmb_id_iluminacao_emergencia"],"N",'O');
    $ID_TP_PARA_RAIO            = formataCampo(@$_POST["cmb_id_raio"],"N",'O');
    $CH_COMB_GN                 = formataCampo(@$_POST["chk_ch_gn"],'sn');
    $CH_COMB_GLP                = formataCampo(@$_POST["chk_ch_clp"],'sn');
    $ID_TP_RECIPIENTE           = formataCampo(@$_POST["cmb_id_recipiente"],"N",'O');
    $ID_TP_INSTALACAO           = formataCampo(@$_POST["cmb_id_tp_instalacao"],"N",'O');
    $CH_ABANDONO                = formataCampo(@$_POST["chk_ch_abandono"],'sn');
    $CH_FIXO_CO2                = formataCampo(@$_POST["chk_fixo_co2"],'sn');
    $CH_SPRINKLER               = formataCampo(@$_POST["chk_ch_sprinkler"],'sn');
    $CH_ANCORA_CABO				= formataCampo(@$_POST["chk_ch_ancora_cabo"],'sn');
    $CH_MULSYFIRE               = formataCampo(@$_POST["chk_ch_mulsyfire"],'sn');
    $NM_OUTROS                  = formataCampo(@$_POST["txt_nm_outros"]);
    $ID_CIDADE                  = formataCampo($_POST["cmb_id_cidade"],"N");
    $CH_PROTOCOLADO             = "'S'";
    $ID_ADUCAO                  = formataCampo(@$_POST["cmd_id_aducao"],"N",'O');
    $ID_TP_LOGRADOURO           = $_POST["cmb_id_tp_prefixo"];
    $nomes_desc					= explode("^",$_POST["hdn_nm_desc_funcionamento"]);
    $valores_desc				= explode("^",$_POST["hdn_vl_desc_funcionamento"]);
    $blocos_desc				= explode("^",$_POST["hdn_nm_bloco_desc_funcionamento"]);

    $l_cpfcnpj	= str_replace('.','',(str_replace('-','',(str_replace('/','',$_POST['txt_nr_cnpjcpf_solicitante'])))));
    $l_cidade	= $_POST['cmb_id_cidade'];

	// verificar se já existe solicitação deste CPF/CNPJ

	$sql="SELECT ID_SOLICITACAO,".
		TBL_SOLICITACAO.".ID_CIDADE,ID_TIPO_SOLICITACAO, " .
		TBL_SOLICITACAO.".NM_FANTASIA_EMPRESA, " .
		TBL_SOLICITACAO.".NM_LOGRADOURO, " .
		TBL_SOLICITACAO.". NR_EDIFICACOES_LX, " .
		TBL_SOLICITACAO.".NR_CEP, " .
		TBL_SOLICITACAO.".CH_PROTOCOLADO, " .
		TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO, " .
		TBL_SOLICITACAO.".NM_BAIRRO, " .
		"NM_EDIFICACOES_LX, " .
		"DATE_FORMAT(DT_SOLICITACAO,'%d/%m/%Y') DT_SOLICITACAOS, " .
		"(TO_DAYS('".date("Y-m-d")."') - TO_DAYS(DT_SOLICITACAO)) AS DIAS, " .
		"NM_CIDADE " .
		"FROM ".TBL_SOLICITACAO." JOIN ".TBL_CIDADE." USING(ID_CIDADE) " .
		"WHERE ".
			TBL_SOLICITACAO.".CNPJ_CPF_SOLICITANTE = ".$l_cpfcnpj." AND ".
			TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO IN ('FS','FP') AND ".
			TBL_SOLICITACAO.".ID_CIDADE = $l_cidade " .
		"ORDER BY CH_PROTOCOLADO ASC , DT_SOLICITACAO DESC";

	$conn->query($sql);
	$rows_pendente=$conn->num_rows();
	$encontrouSolicitacao = false;
	while ($pendente = $conn->fetch_row()) {
		if(!$encontrouSolicitacao) $encontrouSolicitacao = true;
		$solicitacoes[] = $pendente;
	} 

	//echo "<pre>"; print_r(@$solicitacoes); echo "</pre>"; exit;

	if(!$encontrouSolicitacao || @$_POST[btn_enviar_solicitacao]) {

		// INSERIR REGISTRO 
	    $query_trans="BEGIN";
	    $res= $conn->query($query_trans);
	    $query_trans="COMMIT";
	    $ERRO_TRANS="";
	    //echo "<!--aqui 0:$CNPJ_CPF_SOLICITANTE==>$CNPJ_CPF_PROPRIETARIO===>$CH_SIS_PREVENTIVO_EXTINTOR-->\n";
	    $sql= "INSERT INTO ".TBL_SOLICITACAO."  (ID_SOLICITACAO,ID_TIPO_SOLICITACAO,CNPJ_CPF_SOLICITANTE,NM_SOLICITANTE, NM_FANTASIA_EMPRESA, NM_CONTATO, NR_FONE_SOLICITANTE, DE_EMAIL_SOLICITANTE, CNPJ_CPF_PROPRIETARIO, NM_PROPRIETARIO, NR_FONE_PROPRIETARIO, DE_EMAIL_PROPRIETARIO, NM_EDIFICACOES_LX, NM_FANTASIA ,NM_LOGRADOURO, NR_EDIFICACOES_LX, NR_CEP, NM_BAIRRO, NM_COMPLEMENTO, VL_AREA_CONTRUIDA, VL_ALTURA, VL_AREA_TIPO, NR_PAVIMENTOS, NR_BLOCOS, CH_SIS_PREVENTIVO_EXTINTOR, NR_ESCADA_COMUM, NR_ESCADA_PROTEGIDA,NR_ESCADA_ENC, NR_ESCADA_PROVA_FUMACA, NR_ESCADA_PRESSU, NR_RAMPA, NR_ELEV_EMERGENCIA, NR_RESG_AEREO, NR_PASSARELA, ID_RISCO, ID_SITUACAO, ID_TP_CONSTRUCAO, ID_OCUPACAO, ID_TP_ALARME_INCENDIO, ID_ILU_EMERG, ID_TP_PARA_RAIO,  CH_COMB_GN, CH_COMB_GLP, ID_TP_RECIPIENTE, ID_TP_INSTALACAO, CH_ABANDONO, CH_FIXO_CO2, CH_SPRINKLER, CH_ANCORA_CABO, CH_MULSYFIRE, NM_OUTROS, ID_CIDADE, CH_PROTOCOLADO, ID_ADUCAO, DT_SOLICITACAO, ID_TP_LOGRADOURO) values ($ID_SOLICITACAO, $ID_TIPO_SOLICITACAO, $CNPJ_CPF_SOLICITANTE, $NM_SOLICITANTE, $NM_FANTASIA_EMPRESA, $NM_CONTATO, $NR_FONE_SOLICITANTE, $DE_EMAIL_SOLICITANTE, $CNPJ_CPF_PROPRIETARIO, $NM_PROPRIETARIO, $NR_FONE_PROPRIETARIO, $DE_EMAIL_PROPRIETARIO, $NM_EDIFICACOES_LX, $NM_FANTASIA, $NM_LOGRADOURO, $NR_EDIFICACOES_LX, $NR_CEP, $NM_BAIRRO, $NM_COMPLEMENTO, $VL_AREA_CONTRUIDA, $VL_ALTURA, $VL_AREA_TIPO, $NR_PAVIMENTOS, $NR_BLOCOS, $CH_SIS_PREVENTIVO_EXTINTOR, $NR_ESCADA_COMUM, $NR_ESCADA_PROTEGIDA, $NR_ESCADA_ENC, $NR_ESCADA_PROVA_FUMACA, $NR_ESCADA_PRESSU, $NR_RAMPA, $NR_ELEV_EMERGENCIA, $NR_RESG_AEREO, $NR_PASSARELA, $ID_RISCO, $ID_SITUACAO, $ID_TP_CONSTRUCAO, $ID_OCUPACAO, $ID_TP_ALARME_INCENDIO, $ID_ILU_EMERG, $ID_TP_PARA_RAIO, $CH_COMB_GN, $CH_COMB_GLP, $ID_TP_RECIPIENTE, $ID_TP_INSTALACAO, $CH_ABANDONO, $CH_FIXO_CO2,   $CH_SPRINKLER, $CH_ANCORA_CABO, $CH_MULSYFIRE, $NM_OUTROS, $ID_CIDADE, $CH_PROTOCOLADO, $ID_ADUCAO, CURDATE(), $ID_TP_LOGRADOURO)";
	    // executando o insert
	   //echo "<!--aqui :\n$sql\n-->";
	    $res= $conn->query($sql);
	    // testando se houve algum erro
	    if ($conn->get_status()==false) {
	      $ERRO_TRANS="SOLICITAÇÃO: ".$conn->get_msg()."\n";
	      $query_trans="ROLLBACK";
	    }
	    $ID_SOLIC_ANALISE_FUNC=$conn->insert_id();
	    $ID_DESC_ANALISE_FUNC=0;
	    $query_desc_sub="";
	    for ($num_desc=0; $num_desc<count($nomes_desc); $num_desc++) {
	      if ((trim($nomes_desc[$num_desc])!="") && (trim($valores_desc[$num_desc])!="")) {
	        $NM_DESC_ANALISE_FUNC=formataCampo($nomes_desc[$num_desc]);
	        $VL_AREA_DESC_VISTORIAS=formataCampo($valores_desc[$num_desc],"D");
	        $NR_PAVIMENTOS_DESC=0;
	        $NM_BLOCO=formataCampo($blocos_desc[$num_desc]);
	        if ($query_desc_sub!="") {
	          $query_desc_sub.=",\n";
	        }
	        $query_desc_sub.=" ($ID_CIDADE, $ID_SOLIC_ANALISE_FUNC, $ID_TIPO_SOLICITACAO, $ID_DESC_ANALISE_FUNC, $NM_DESC_ANALISE_FUNC, $NR_PAVIMENTOS_DESC, $NM_BLOCO, $VL_AREA_DESC_VISTORIAS)";
	      }
	    }
	    $query_desc="INSERT INTO ".TBL_SOL_AN_FUNC." (ID_CIDADE, ID_SOLICITACAO, ID_TIPO_SOLICITACAO, ID_DESC_ANALISE_FUNC, NM_DESC_ANALISE_FUNC, NR_PAVIMENTO, NM_BLOCO, VL_AREA_DESC_FUNC) VALUES $query_desc_sub;";
	    $res= $conn->query($query_desc);
	    if ($conn->get_status()==false) {
	      $query_trans="ROLLBACK";
	      $ERRO_TRANS.="DESCRITIVO :".$conn->get_msg()."\n";
	    }
	    $res= $conn->query($query_trans);
	    if (($conn->get_status()==false) || ($ERRO_TRANS!="")) {
	      $query_trans="ROLLBACK";
	      mysql_query($query_trans);
	      die($ERRO_TRANS);
	    } else {
			?> <script language="JavaScript" type="text/javascript"> <?
			    if ((@$ID_SOLIC_ANALISE_FUNC!="")&&(@$ID_CIDADE!="")&&(@$ID_TIPO_SOLICITACAO!="")) {
			      echo 'window.open("rsolic_an_func.php?id_solicitacao='.$ID_SOLIC_ANALISE_FUNC.'&id_cidade='.$ID_CIDADE.'&id_tipo_solicitacao='.$ID_TIPO_SOLICITACAO.'","xdes","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");';
			      echo "window.location.href='$arquivo';\n";
			    }
			 ?> </script> <? 
			echo "<script>alert('Solicitação enviada com sucesso!');</script>";
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
  var dfrm=document.frm_solicitacao;
  if (camp_desc.value!="") {
    dfrm.hdn_id_desc_funcionamento_tmp.value=camp_desc.value;
    var indice_car=camp_desc.value-1;
    var nomes=dfrm.hdn_nm_desc_funcionamento.value.split("^");
    var valores=dfrm.hdn_vl_desc_funcionamento.value.split("^");
    var blocos=dfrm.hdn_nm_bloco_desc_funcionamento.value.split("^");
//     var andar=dfrm.hdn_nr_pavimento_desc_funcionamento.value.split("^");
    dfrm.txt_nm_desc_funcionamento_tmp.value=nomes[indice_car];
    dfrm.txt_vl_desc_funcionamento_tmp.value=valores[indice_car];
    dfrm.txt_nm_bloco_desc_funcionamento_tmp.value=blocos[indice_car];
//     dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=andar[indice_car];
    dfrm.btn_incluir_desc.disabled=false;
    dfrm.btn_incluir_desc;
    dfrm.btn_incluir_desc.disabled=true;
    dfrm.btn_excluir_desc.disabled=false;
    dfrm.btn_excluir_desc;
  } else {
    dfrm.txt_nm_desc_funcionamento_tmp.value="";
    dfrm.txt_vl_desc_funcionamento_tmp.value="";
    dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";
//     dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=0;
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
  var dfrm=document.frm_solicitacao;
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
  var dfrm=document.frm_solicitacao;
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
  var vfrm=document.frm_solicitacao;
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
/*
function muda_desc_tp(tp_vist) {
  var vfrm=document.frm_solicitacao;
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
}*/

function valida_desc_habitese() {
  var vfrm=document.frm_solicitacao;
  var desc_erro="";
  var valores_desc_calc=document.frm_solicitacao.hdn_vl_desc_funcionamento.value;
  var vl_vist=0;
  var valor_tmp=document.frm_solicitacao.txt_vl_desc_funcionamento_tmp.value;
  var vl_tot=document.frm_solicitacao.txt_nr_area_tot_const.value;
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
  if (parseFloat(vl_tot)==parseFloat(vl_vist)) {
    desc_erro+="=> Área de Vistoria IGUAL que Área Construída\nFAÇA UMA SOLICITAÇÃO DE PROJETO!\nOU ACERTE A ÁREA DE VISTORIA";
  }
  if (desc_erro!="") {
    alert("Os campos são Obrigatórios!\n"+desc_erro+"Verifique!!!");
  } else {
    insere_desc();
  }
}

</script>
<script language="JavaScript" type="text/javascript">
  function valida_prop() {
    var frm=document.frm_solicitacao;
    if ((frm.txt_nr_cnpjcpf_solicitante.value!="") && (frm.txt_nr_cnpjcpf_proprietario.value!="")) {
      if ((frm.txt_nr_cnpjcpf_solicitante.value==frm.txt_nr_cnpjcpf_proprietario.value) && (frm.txt_nm_solicitante.value!="") && (frm.txt_nm_proprietario.value=="")) {
        frm.txt_nm_proprietario.value=frm.txt_nm_solicitante.value;
        frm.txt_fone_proprietario.value=frm.txt_fone_solicitante.value;
        frm.txt_de_email_proprietario.value=frm.txt_de_email_solicitante.value;
        frm.txt_nm_edificacao.focus();
      } else {
        if ((frm.txt_nr_cnpjcpf_solicitante.value==frm.txt_nr_cnpjcpf_proprietario.value) && (frm.txt_nm_solicitante.value!=frm.txt_nm_proprietario.value)) {
          alert("Nome do Solicitante diferente do Prorietário com mesmo CNPJ/CPF!");
          frm.txt_nm_proprietario.value="";
          frm.txt_nr_cnpjcpf_proprietario.value="";
          frm.txt_nm_proprietario.focus();
        }
      }
    }
  }
</script>
<body  onload="ajustaspan()">
<table style="height : 167px; margin-left : 0px; width : 764px;" valign="middle" border="0" cellpadding="0" cellspacing="0" id="tbcorpo">
  <tbody>
    <!--<tr height="125">
      <td align="left" valign="top"><img src="../../imagens/barrasigat.jpg" alt="" align="middle" border="0" height="115" width="760"></td>
    </tr>-->
    <?
      if ($erro!="") {
        eval($erro);
      }
    ?>
    <tr valign="top" id="lncorpo" style="height:300px;">
      <td> <span style="position: absolute; overflow: auto; height: 295px; width: 760px;" id="corpo">

<? if(@$encontrouSolicitacao) { ?>

  <form target="_self" enctype="multipart/form-data" method="post" name="frm_solicitacao" onSubmit="return validaForm(this,<?=$campos_js?>)">
  <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">

  <? foreach($_POST as $nome => $valor) { ?>
	  <input type="hidden" name="<?=$nome?>" value="<?=$valor?>"/>
  <? } ?>	
    <!-- SOLICITANTE -->
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Solicitante</legend>
          <table>
            <tr>
              <td>Nome</td>
              <td><input type="text" name="txt_nm_solicitante" value="<?=$_POST['txt_nm_solicitante']?>" 
              size="50" maxlength="100" class="campo_obr" title="Nome do Solicitante de Análise da Edificação" 
              onblur="valida_prop()"></td>
              <td>CNPJ/CPF</td>
              <td><input type="text" name="txt_nr_cnpjcpf_solicitante" value="<?=$_POST['txt_nr_cnpjcpf_solicitante']?>" size="20" maxlength="18" class="campo_obr" title="CPF ou CNPJ do Solicitante de Análise da Edificação" onblur="cpfcnpj(this);valida_prop();" value=""></td>
            </tr>
          </table>
          <table>
            <tr>
              <td width="30">Fone</td>
              <td><input type="text" name="txt_fone_solicitante" value="<?=$_POST['txt_fone_solicitante']?>" size="13" maxlength="12" class="campo_obr" title="Fone do Solicitante de Análise da Edificação"></td>
              <td>E-mail</td>
              <td><input type="text" name="txt_de_email_solicitante" value="<?=$_POST['txt_de_email_solicitante']?>" size="61" maxlength="100" class="campo_obr" title="E-mail do Solicitante de Análise da Edificação" style="text-transform : none;"></td>
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
						<td><b><?=$solicitacao['DT_SOLICITACAOS']?><? if($solicitacao['CH_PROTOCOLADO']!='S') echo "(solicitado)"; elseif($solicitacao['CH_PROTOCOLADO']!='P') echo "(protocolado)"; else echo "($solicitacao[CH_PROTOCOLADO])"; ?>
						</b></td>
					</tr> 
					<tr>
						<td align="right">Edificação:&nbsp;</td> 
						<td><?=$solicitacao['NM_EDIFICACOES_LX']?></td>
					</tr> 
					<tr>
						<td align="right">Nome Fantasia:&nbsp;</td> 
						<td><? if($solicitacao['NM_FANTASIA_EMPRESA']) echo "$solicitacao[NM_FANTASIA_EMPRESA]"; else echo "<i>não informado</i>";?></td>
					</tr> 
					<tr>
						<td align="right">Logradouro:&nbsp;</td> 
						<td><?=$solicitacao['NM_LOGRADOURO']?>, <?=$solicitacao['NR_EDIFICACOES_LX']?></td>
					</tr> 
					<tr>
						<td align="right">CEP:&nbsp;</td> 
						<td><?=$solicitacao['NR_CEP']?>  <?=$solicitacao['NM_BAIRRO']?>/<?=$solicitacao['NM_CIDADE']?></td>
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


     <form target="_self" enctype="multipart/form-data" method="post" name="frm_solicitacao" onSubmit="return validaForm(this,<?=$campos_js?>)">
  <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Solicitante</legend>
          <table>
            <tr>
              <td>Empresa</td>
              <td><input type="text" name="txt_nm_solicitante" size="50" maxlength="100" class="campo_obr" title="Nome do Solicitante de Análise da Edificação" onblur="valida_prop()"></td>
              <td>CNPJ</td>
              <td><input type="text" name="txt_nr_cnpjcpf_solicitante" size="20" maxlength="18" class="campo_obr" title="CPF ou CNPJ do Solicitante de Análise da Edificação" onblur="cpfcnpj(this);valida_prop();" value=""></td>
            </tr>
          </table>
          <table>
            <tr>
              <td>Nome Fantasia</td>
              <td><input type="text" name="txt_nm_fantasia_empresa" size="35" maxlength="100" class="campo" title="Nome Fantasia da Empresa Solicitante" onblur="valida_prop()"></td>
              <td>Contato</td>
              <td><input type="text" name="txt_nm_contato" size="35" maxlength="100" class="campo" title="Nome do Contato da Empresa" value=""></td>
            </tr>
          </table>
          <table>
            <tr>
              <td width="30">Fone</td>
              <td><input type="text" name="txt_fone_solicitante" size="13" maxlength="12" class="campo_obr" title="Fone do Solicitante de Análise da Edificação"></td>
              <td>E-mail</td>
              <td><input type="text" name="txt_de_email_solicitante" size="61" maxlength="100" class="campo_obr" title="E-mail do Solicitante de Análise da Edificação" style="text-transform : none;"></td>
            </tr>
          </table>
        </fieldset> 
      </td>
    </tr>
    <tr>
      <td colspan="2" style="vertical-align: top;">
        <fieldset>
          <legend>Proprietário</legend>
            <table>
              <tr>
                <td>Nome</td>
                <td><input type="text" name="txt_nm_proprietario" size="50" maxlength="100" class="campo_obr" title="Nome do Proprietário da Edificação" onblur="valida_prop()"></td>
                <td>CNPJ/CPF</td>
                <td><input type="text" name="txt_nr_cnpjcpf_proprietario" size="20" maxlength="18" class="campo_obr" title="CNPJ ou CPF do Proprietário da Edificação" onblur="cpfcnpj(this);valida_prop();" value=""></td>
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
              <td colspan="2">
                <input type="text" name="txt_nm_logradouro" size="28" maxlength="100" title="Nome do Logradouro" class="campo_obr">
              </td>
              <td>N°</td>
              <td>
                <input type="text" name="txt_nr_numero" size="5" maxlength="6" class="campo" title="Número do Endereço da Edificação" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)">
              </td>
            </tr>
            <tr>



            <td>Cidade</td>
              <td colspan="6">
                <select name="cmb_id_cidade" value="" class="campo_obr">
                  <option value="">--------</option>
                  <?
                    $sql= "SELECT ID_CIDADE, NM_CIDADE, ID_UF FROM ".TBL_CIDADE." WHERE ID_UF ='SC' AND ".TBL_CIDADE.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO = '$userlogin') ORDER BY ID_UF, NM_CIDADE";
                    //$sql = "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' ORDER BY NM_CIDADE";
                    $res = $conn->query($sql);
                    if ($conn->get_status()==false) {
                      die($conn->get_msg());
                    }
                    while ($tupla = $conn->fetch_row()) {
                  ?>
                  <option value="<?=$tupla["ID_CIDADE"]?>"><?=$tupla["NM_CIDADE"]?></option>
                  <?
                    }
                  ?>
                </select>
              </td>

            </tr>



<? /*
            <td>Cidade</td>
              <td colspan="6">
                <select name="cmb_id_cidade" value="" class="campo_obr">
                  <option value="">--------</option>
                  <?
                    $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' ORDER BY NM_CIDADE";
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
*/ ?>

            </tr>
            <tr>
              <td colspan=6>
                <table width="95%" cellpadding="2" cellspacing="0" border="0" align="left">
                  <tr>
                    <td>Bairro</td>
                    <td><input type="text" name="txt_nm_bairro" size="20" maxlength="50" class="campo_obr" title="Bairro da Edificação"></td>
                   <td>CEP</td>
                    <td><input type="text" name="txt_nr_cep" size="9" maxlength="10" class="campo" title="Número do CEP da Edificação" onkeypress="return validaTecla(this, event, 'n')" onblur="CEP(this)"></td>
                    <td align="rigth">Complemento</td>
                    <td><input type="text" name="txt_nm_complemento" size="18" maxlength="100" class="campo" title="Complemento do Endereço da Edificação"></td>
                   </tr>
                  </table>
                </td>
            </tr>
          </table>
          </fieldset>
          <fieldset>
            <legend>Caracteristica</legend>
              <table width="95%" cellspacing="0" border="0" cellpadding="2">
                <tr>
                  <td>Área Total Construida</td>
                  <td nowrap="true">
                    <input type="text" name="txt_nr_area_tot_const" size="11" maxlength="12" align="right" class="campo_obr" title="Área total contruida da Edificação" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)"><em>(m²)</em>
                  </td>
                  <td>Altura</td>
                  <td nowrap="true"><input type="text" name="txt_nr_altura" size="8" maxlength="9" align="right" class="campo_obr" title="Altura do Piso de Descarga (Saída) até a altura do último piso útil da Edificação (Ex.: 1 andar altura=0)" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)"><em>(m)</em></td>
                  <td>Área do Pavimento Tipo</td>
                  <td nowrap="true"> <input type="text" name="txt_nr_area_pavimento" size="9" maxlength="10" align="right" class="campo_obr" title="Área do MAIOR Pavimento da Edificação" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)"><em>(m²)</em></td>
                </tr>
              </table>
              <table width="95%" cellspacing="0" border="0" cellpadding="2">
                <tr>
                  <td>Ocupação</td>
                  <td><select name="cbm_id_ocupacao" class="campo_obr" title="Classificação da Edificação quanto a sua Ocupação">
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
                        for ($i=1;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
              </table>
          </fieldset>
          <fieldset>
            <legend>Área de Vistoria</legend>
            <table width="70%" cellspacing="0" cellpadding="2" align="center" border="0">
<!--              <tr>
                <td>Tipo de Vistoria</td>
                <td>
                  <select name="cmb_ch_tp_funcionamento" class="campo_obr" onChange="muda_desc_tp(this)">
                    <option value="T" selected>TODA A EDIFICAÇÃO</option>
                    <option value="P">PARCIAL</option>
                  </select>
                </td>
              </tr>-->
              <tr>
                <td>Salas Cadastradas</td>
                <td>
                  <select name="cmb_desc_funcionamento" class="campo" onChange="carrega_desc(this)">
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
                        <input type="text" name="txt_nm_desc_funcionamento_tmp" class="campo_obr" size="30" maxlength="50" value="" onkeyup="muda_desc()">
                      </td>
                    </tr>
                    <tr>
                      <td>Complemento</td>
                      <td colspan="2">
                        <input type="text" name="txt_nm_bloco_desc_funcionamento_tmp" class="campo" size="35" maxlength="50" value="">
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
                        <input type="text" name="txt_vl_desc_funcionamento_tmp" class="campo_obr" size="30" maxlength="50" align="right" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this);muda_desc();" onblur="decimal(this,2)" value="">
                      </td>
                      <td>
                        <em>(m²)</em>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="center">
                        <input type="button" name="btn_incluir_desc" value="Incluir" class="botao"  disabled="true" onClick="valida_desc_habitese()">&nbsp;
                        <input type="button" name="btn_excluir_desc" value="Excluir" class="botao"  disabled="true" onClick="exclui_desc()">
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
          <fieldset>
          <legend>Sistema de Segurança Contra Incêndios</legend>
          <label title="Marque a opção se possuir o sistema">
            <input type="checkbox" name="chk_ch_extintor" onchange="check(this)" value="N">Sistema Preventivo por Extintor</label>
            <table width="100%" cellspacing="0" border="0" cellpadding="0">
              <tr>
                <td valign="top" colspan="2">
                  <fieldset>
                    <legend><label><input type="checkbox" name="chk_sis_hidra_prev" onchange="controle_multiplo(this.form,this,'cmd_id_aducao')">Sistema Hidraulico Preventivo</label></legend>
                    Tipo de Adução
                    <select name="cmd_id_aducao" class="campo" title="Método pelo qual a água é pressurizada" disabled="true">
                      <option value="">----------</option>
                      <?
                        // string da query
                        $sql= "SELECT ID_ADUCAO, NM_ADUCAO FROM ".TBL_TP_ADUCAO;
                        // executando a consulta
                        $res= $conn->query($sql);
                        // testando se houve algum erro
                        if ($conn->get_status()==false) {
                          die($conn->get_msg());
                        }

                        while ($tupula = $conn->fetch_row()) {
                          echo "<option value=\"".$tupula['ID_ADUCAO']."\">";
                          echo $tupula['NM_ADUCAO'];
                          echo "</option>\n";
                        }
                      ?>
                    </select>
                    <!--<br><br><br><br><br><br>-->
                  </fieldset>
                </td>
<!--                <td>
                  <fieldset>
                    <legend>Responsável Técnico Projeto</legend>
                    <table width="90%" cellspacing="0" cellpadding="2" align="center">
                      <tr align="center">
                        <td>Nome</td>
                        <td>CREA</td>
                      </tr>
                      <tr>
                        <td><input type="text" name="txt_nm_engenheiro1" size="43" maxlength="100" class="campo_obr" title="Nome do Engenheiro"></td>
                        <td><input type="text" name="txt_nr_crea1" size="7" maxlength="8" class="campo_obr" title="Número do CREA" onblur="valida_crea(this)"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="txt_nm_engenheiro2" size="50" maxlength="100" class="campo" title="Nome do Engenheiro"></td>
                        <td><input type="text" name="txt_nr_crea2" size="7" maxlength="8" class="campo" title="Número do CREA" onblur="valida_crea(this)"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="txt_nm_engenheiro3" size="50" maxlength="100" class="campo" title="Nome do Engenheiro"></td>
                        <td><input type="text" name="txt_nr_crea3" size="7" maxlength="8" class="campo" title="Número do CREA" onblur="valida_crea(this)"></td>
                      </tr>
                    </table>
                </fieldset>
                </td>-->
              </tr>
            </table>
            <fieldset>
              <legend>
                <label>
                  <input type="checkbox" name="chk_ch_saida_emer" onchange="controle_multiplo(this.form,this,'chk_esc_comum','chk_esc_pres','chk_esc_protegida','chk_rampa','chk_esc_enclausurada','chk_elev_emergencia','chk_esc_fumaca','chk_resg_aereo','chk_passarela','cmb_nr_escada_comum','cmb_nr_pressurizada','cmb_nr_protegida','cmb_nr_rampa','cmb_nr_enclausurada','cmb_nr_elev_emerg','cmb_nr_esc_fumaca','cmb_nr_reg_aereo','cmb_nr_passarela')">Saída de Emergência
                </label>
              </legend>
              <table width="90%" cellspacing="0" border="0" cellpadding="2" align="center">
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" name="chk_esc_comum" onchange="controle_multiplo(this.form,this,'cmb_nr_escada_comum')" class="campo" disabled="true">Escada Comum
                    </label>
                  </td>
                  <td>
                    <select name="cmb_nr_escada_comum" class="campo" title="Número de escadas comuns que possui a edificação" disabled="true">
                      <?
                        for ($i=0;$i<=20;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                  <td>
                    <label>
                      <input type="checkbox" name="chk_esc_pres" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_pressurizada')" disabled="true">Escada Pressurizada
                    </label>
                  </td>
                  <td>
                    <select name="cmb_nr_pressurizada" class="campo" title="Número de escadas pressurizadas" disabled="true">
                      <?
                        for ($i=0;$i<=20;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label><input type="checkbox" name="chk_esc_protegida" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_protegida')" disabled="true">Escada Protegida</label></td>
                  <td>
                    <select name="cmb_nr_protegida" class="campo" title="Número de escadas protegidas" disabled="true">
                      <?
                        for ($i=0;$i<=20;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                  <td>
                    <label>
                      <input type="checkbox" name="chk_rampa" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_rampa')" disabled="true">Rampa
                    </label>
                  </td>
                  <td>
                    <select name="cmb_nr_rampa" disabled="true" class="campo" title="Número de Rampas da Edificação">
                      <?
                        for ($i=0;$i<=20;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" name="chk_esc_enclausurada" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_enclausurada')" disabled="true">Escada Enclausurada
                    </label>
                  </td>
                  <td>
                    <select name="cmb_nr_enclausurada" disabled="true" class="campo" title="Número de Escadas Enclausuradas da Edificação">
                      <?
                        for ($i=0;$i<=20;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                  <td>
                    <label>
                      <input type="checkbox" name="chk_elev_emergencia" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_elev_emerg')" disabled="true">Elevador de Emergência
                    </label>
                  </td>
                  <td>
                    <select name="cmb_nr_elev_emerg" disabled="true" class="campo" title="Número de Elevadores de Emergência da Edificação">
                      <?
                        for ($i=0;$i<=10;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" name="chk_esc_fumaca" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_esc_fumaca')" disabled="true">
                    Escada Enclausurada a<br>
                    Prova de Fumaça</label>
                  </td>
                  <td>
                    <select name="cmb_nr_esc_fumaca" class="campo" title="Número de Escadas Enclausuradas a Prova de Fumaça da Edificação" disabled="true">
                      <?
                        for ($i=0;$i<=20;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                  <td>
                  <label>
                  <input type="checkbox" name="chk_resg_aereo" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_reg_aereo')" disabled="true">Local para Resgate Aéreo</label></td>
                  <td>
                    <select name="cmb_nr_reg_aereo" disabled="true" class="campo" title="Número de Locais para Resgate Aéreo da Edificação">
                      <?
                        for ($i=0;$i<=10;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><label><input type="checkbox" name="chk_passarela" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_passarela')" disabled="true">Passarela</label></td>
                  <td>
                    <select name="cmb_nr_passarela" disabled="true" class="campo" title="Número de Passarelas da Edificação">
                      <?
                        for ($i=0;$i<=10;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
              </table>
            </fieldset>
            <table width="100%" cellspacing="0" cellpadding="2" border="0">
              <tr>
                <td>
                  <fieldset>
                    <legend><label>
                      <input type="checkbox" name="chk_detec_incendio" class="campo" onchange="controle_multiplo(this.form,this,'cmb_id_tp_detc_incendio')">Sistema de Alarme de Detecção de Incêndios</label>
                    </legend>
                    <table width="80%" cellspacing="0" border="0" cellpadding="0">
                      <tr>
                        <td>Tipo</td>
                        <td>
                          <select name="cmb_id_tp_detc_incendio" class="campo" title="Tipo de alarme de detecção de incêndio"  disabled="true">
                            <option value="">---------</option>
                            <?
                              // string da query
                              $sql= "SELECT ID_TP_ALARME_INCENDIO, NM_TP_ALARME_INCENDIO FROM ".TBL_TP_ALARME_INCENDIO;
                              // executando a consulta
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }
                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_TP_ALARME_INCENDIO']."\">";
                                echo $tupula['NM_TP_ALARME_INCENDIO'];
                                echo "</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </fieldset>
                  <fieldset>
                    <legend><label>
                      <input type="checkbox" name="chk_ilu_emergencia" class="campo" onchange="controle_multiplo(this.form,this,'cmb_id_iluminacao_emergencia')">Iluminação de Emergência</label>
                    </legend>
                      <table width="80%" cellspacing="0" border="0" cellpadding="0">
                        <tr>
                          <td>Tipo</td>
                          <td><select name="cmb_id_iluminacao_emergencia" class="campo" title="Tipo de iluminação de emergência quanto a sua alimentação de energia" disabled="true">
                                <option value="">------------</option>
                                <?
                                  // string da query
                                  $sql= "SELECT ID_ILU_EMERG, NM_ILU_EMERG FROM ".TBL_TP_ILU_EMER;
                                  // executando a consulta
                                  $res= $conn->query($sql);
                                  // testando se houve algum erro
                                  if ($conn->get_status()==false) {
                                    die($conn->get_msg());
                                  }
                                  while ($tupula = $conn->fetch_row()) {
                                    echo "<option value=\"".$tupula['ID_ILU_EMERG']."\">";
                                    echo $tupula['NM_ILU_EMERG'];
                                    echo "</option>\n";
                                  }
                                ?>
                              </select></td>
                        </tr>
                      </table>
                  </fieldset>
                </td>
                <td valign="top" align="left">
                  <fieldset>
                    <legend><label>
                      <input type="checkbox" name="chk_gas_canalizado" class="campo" onchange="controle_multiplo(this.form,this,'chk_ch_clp','cmb_id_recipiente','chk_ch_gn','cmb_id_tp_instalacao')">Gás Canalizado</label>
                    </legend>
                    <table width="100%" cellspacing="0" border="0" cellpadding="2">
                      <tr>
                        <td>
                          <label><input type="checkbox" name="chk_ch_clp" class="campo" disabled="true" onchange="controle_multiplo(this.form,this,'cmb_id_recipiente'),check(this)" value="N">GLP</label>
                        </td>
                        <td>Recipiente</td>
                        <td>
                          <select name="cmb_id_recipiente" class="campo" title="Modelo de cilindro quanto a sua carga" disabled="true">
                            <option value="">------------</option>
                            <?
                              // string da query
                              $sql= "SELECT ID_TP_RECIPIENTE, NM_TP_RECIPIENTE FROM ".TBL_TP_RECIPIENTE;
                              // executando a consulta
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }

                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_TP_RECIPIENTE']."\">";
                                echo $tupula['NM_TP_RECIPIENTE'];
                                echo "</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label><input type="checkbox" name="chk_ch_gn" class="campo" title="Caso possua gás natural" disabled="true" onchange="controle_multiplo(this.form,this,'cmb_id_tp_instalacao'),check(this)" value="N">GN(Gás Natural)</label>
                        </td>
                        <td>Tipo de Instalação</td>
                        <td>
                          <select name="cmb_id_tp_instalacao" class="campo" title="Objeto de uso da instalação" disabled="true">
                            <option value="">---------</option>
                            <?
                              // string da query
                              $sql= "SELECT ID_TP_INSTALACAO, NM_TP_INSTALACAO FROM ".TBL_TP_INSTALACAO;
                              // executando a consulta
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }

                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_TP_INSTALACAO']."\">";
                                echo $tupula['NM_TP_INSTALACAO'];
                                echo "</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                      </tr>
                    </table>
                    <br><br>
                  </fieldset>
                </td>
              </tr>
            </table>
            <table width="100%" cellspacing="0" border="0" cellpadding="2">
              <tr>
                <td width="150">
                  <fieldset>
                    <legend><label><input type="checkbox" name="chk_prt_atmos" class="campo" onchange="controle_multiplo(this.form,this,'cmb_id_raio')">Sistema de Proteção Contra descarga Atmosférica</label></legend>
                    <table width="90%" cellspacing="0" border="0" cellpadding="0">
                      <tr>
                        <td>Metodo de Proteção</td>
                        <td>
                          <select name="cmb_id_raio" class="campo" title="Tipo de proteção utilizada no sistema de proteção contra descarga atmosférica" disabled="true">
                            <option value="">------------</option>
                            <?
                              // string da query
                              $sql= "SELECT ID_TP_PARA_RAIO, NM_TP_PARA_RAIO FROM ".TBL_TP_PARA_RAIO;
                              // executando a consulta NM_TP_PARA_RAIOtrue
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }

                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_TP_PARA_RAIO']."\">";
                                echo $tupula['NM_TP_PARA_RAIO'];
                                echo "</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
                <td>
                  <table width="100%" cellspacing="0" border="0" cellpadding="0">
                    <tr>
                      <td>
                        <label><input type="checkbox" name="chk_ch_abandono" class="campo" title="Indica se existe sinalização de abandono de local na edificação" onchange="check(this)" value="N">Sinalização de Abandono de local</label>
                      </td>
                      <td>
                        <label><input type="checkbox" name="chk_fixo_co2" class="campo" title="Indica se existe sistema fixo de proteção por gás carbônico na edificação" onchange="check(this)" value="N">Sistema fixo de CO<sub>2</sub></label>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <table width="100%" cellspacing="0" border="0" cellpadding="0">
                    <tr>
                      <td>
                        <label><input type="checkbox" name="chk_ch_sprinkler" class="campo" title="Indica se existe sistema de água nebulizada na edificação" onchange="check(this)" value="N">Sprinkler</label>
                      </td>
                      <td>
                        <label><input type="checkbox" name="chk_ch_ancora_cabo" class="campo" title="Indica se existe sistema destinado a ancoragem de cabo de salvamento na edificação" onchange="check(this)" value="N">Dispositivo de Ancoragem de cabo</label>
                      </td>
                      <td>
                        <label><input type="checkbox" name="chk_ch_mulsyfire" class="campo" title="Indica se existe sistema de água nebulizada de alta pressão na edificação" onchange="check(this)" value="N">Mulsyfire</label>
                      </td>
                      <td>
                        <label><input type="checkbox" name="chk_outros" class="campo" title="Indica se existem outros sistemas especiais de segurança fora dos padronizados na edificação" onchange="controle_multiplo(this.form,this,'txt_nm_outros')">Outros</label>
                        <input type="text" name="txt_nm_outros" size="20" maxlength="100" class="campo" title="Sistemas especiais de segurança fora dos padronizados na edificação" disabled="true">
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
              <input type="submit" name="btn_enviar" value="Enviar" align="middle" title="Confirma a Solicitação de Análise" class="botao" >
            </td>
            <td>
              <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa as Informações" class="botao" >
            </td>
          </tr>
        </table>
    </tr>
  </table>
  </form>

<? } // if($encontrouSolicitacao) { ?>

      </span></td>
    </tr>
	<?// include ('../../templates/footer.htm'); ?>
  </tbody>
</table>
</body>
</html>

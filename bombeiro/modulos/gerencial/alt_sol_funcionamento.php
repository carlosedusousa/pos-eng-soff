<? //echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

  include ('../../templates/head.htm');

  $erro = "";
  require_once 'lib/loader.php';

  $arquivo = "solic_funcionamento.php";
  $conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) die($conn->get_msg());

  $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res = $conn->query($sql);
  $rows_rotina = $conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row();

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

  $campos_preenchidos=true;
  $campos_existe=true;

  $campos_obr= array (

    'hdn_id_solic_func'=>"'hdn_id_solic_func,Chave primária da alteração,t'",
    'txt_nr_cnpj_empresa'=>"'txt_nr_cnpj_empresa,CNPJ da Empresa Solicitante,t'",
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
    'cmb_id_cidade'=>"'cmb_id_cidade,Cidade da Edificação,t'",
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
    $ID_SOLIC_FUNC   		= formataCampo($_POST["hdn_id_solic_func"],"N");
    $ID_TP_FUNC        		= "'P'";
    $NR_CNPJ_EMPRESA       	= formataCampo($_POST["txt_nr_cnpj_empresa"],'VN');
    $NM_RAZAO_SOCIAL    	= formataCampo($_POST["txt_nm_solicitante"]);
    $NM_FANTASIA_EMPRESA	= formataCampo($_POST["txt_nm_fantasia_empresa"]);
    $NM_CONTATO			= formataCampo($_POST["txt_nm_contato"]);
    $NR_FONE_EMPRESA        	= formataCampo($_POST["txt_nr_fone_empresa"],"VN");
    $DE_EMAIL_EMPRESA       	= formataCampo($_POST["txt_de_email_empresa"],"t","l");
    $NR_CNPJ_CPF_PROPRIETARIO	= formataCampo(str_replace("-", "", str_replace ("/", "", str_replace (".", "", $_POST["txt_nr_cnpjcpf_proprietario"]))));
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
    $VL_AREA_CONSTRUIDA		= formataCampo($_POST["txt_vl_area_tot_const"],"D");
    $ID_RISCO			= formataCampo($_POST["cmb_id_risco"],'N');
    $ID_TP_CONSTRUCAO		= formataCampo($_POST["cmb_id_tp_construcao"],"N");
    $ID_OCUPACAO		= formataCampo($_POST["cmb_id_ocupacao"],"N");
    $ID_SITUACAO		= formataCampo($_POST["cmb_id_situacao"],"N");
    $NR_PAVIMENTOS		= formataCampo($_POST["cmb_nr_pavimentos"],"N");
    $NR_BLOCOS			= formataCampo($_POST["cmb_nr_blocos"],"N");
    $ID_CIDADE                  = formataCampo($_POST["cmb_id_cidade"],"N");
    $CH_PROTOCOLADO             = "'S'";
    $ID_TP_LOGRADOURO           = $_POST["cmb_id_tp_prefixo"];
    $CH_PAGO			= "'N'";
    $DT_SOLICITACAO       	= "CURDATE()";
    $nomes_desc			= explode("^",$_POST["hdn_nm_desc_funcionamento"]);
    $valores_desc		= explode("^",$_POST["hdn_vl_desc_funcionamento"]);
    $blocos_desc		= explode("^",$_POST["hdn_nm_bloco_desc_funcionamento"]);
    $CH_TP_FUNCIONAMENTO	= $_POST["cmb_ch_tp_funcionamento"];
    $ID_CIDADE_CEP		= $ID_CIDADE;
    $ID_USUARIO			= "'$usuario'";
    $CH_AGUARDO_LOGRADOURO	= "'S'";
    $DT_AGUARDO_LOGRADOURO	= "CURDATE()";

    $l_cpfcnpj	= str_replace('.','',(str_replace('-','',(str_replace('/','',$_POST['txt_nr_cnpj_empresa'])))));
    $l_cidade	= $_POST['cmb_id_cidade'];

    if(@$_POST['btn_alterar']) {

        $sql = "update ".TBL_SOL_FUNC." set " .
            "NR_CNPJ_EMPRESA = $NR_CNPJ_EMPRESA, " . 
            "NM_RAZAO_SOCIAL = $NM_RAZAO_SOCIAL, " . 
            "NR_FONE_EMPRESA = $NR_FONE_EMPRESA, " . 
            "DE_EMAIL_EMPRESA = $DE_EMAIL_EMPRESA, " . 
            "NR_CNPJ_CPF_PROPRIETARIO = $NR_CNPJ_CPF_PROPRIETARIO, " . 
            "NM_PROPRIETARIO = $NM_PROPRIETARIO, " . 
            "NR_FONE_PROPRIETARIO = $NR_FONE_PROPRIETARIO, " . 
            "DE_EMAIL_PROPRIETARIO = $DE_EMAIL_PROPRIETARIO, " . 
            "NM_EDIFICACOES = $NM_EDIFICACOES, " . 
            "NM_FANTASIA = $NM_FANTASIA, " . 
            "ID_TP_LOGRADOURO = $ID_TP_LOGRADOURO, " . 
            "NM_LOGRADOURO = $NM_LOGRADOURO, " . 
            "NR_EDIFICACOES = $NR_EDIFICACOES, " . 
            "NR_CEP = $NR_CEP, " . 
            "NM_BAIRRO = $NM_BAIRRO, " . 
            "NM_COMPLEMENTO = $NM_COMPLEMENTO, " . 
            "VL_AREA_CONSTRUIDA = $VL_AREA_CONSTRUIDA, " . 
            "ID_RISCO = $ID_RISCO, " . 
            "ID_TP_CONSTRUCAO = $ID_TP_CONSTRUCAO, " . 
            "ID_OCUPACAO = $ID_OCUPACAO, " . 
            "ID_SITUACAO = $ID_SITUACAO, " . 
            "NM_CONTATO = $NM_CONTATO, " . 
            "NM_FANTASIA_EMPRESA = $NM_FANTASIA_EMPRESA " . 
        "where " .
            "ID_CIDADE = $ID_CIDADE and " .
            "ID_SOLIC_FUNC = $ID_SOLIC_FUNC ". 
        ";";
        $conn->query($sql);
        if ($conn->get_status()==false) die($conn->get_msg());
            
    }

  }

  include ('../../templates/cab.htm');

?>
<script language="JavaScript" type="text/javascript">
function carrega_desc(camp_desc) {
  var dfrm=document.frm_solic_funcionamento;
  if (camp_desc.value!="") {
    dfrm.hdn_id_desc_funcionamento_tmp.value=camp_desc.value; // 
    var indice_car=camp_desc.value-1;
    var nomes=dfrm.hdn_nm_desc_funcionamento.value.split("^");
    var valores=dfrm.hdn_vl_desc_funcionamento.value.split("^");
    var blocos=dfrm.hdn_nm_bloco_desc_funcionamento.value.split("^");
    //var andar=dfrm.hdn_nr_pavimento_desc_funcionamento.value.split("^");
    dfrm.txt_nm_desc_funcionamento_tmp.value=nomes[indice_car];
    dfrm.txt_vl_desc_funcionamento_tmp.value=valores[indice_car];
    dfrm.txt_nm_bloco_desc_funcionamento_tmp.value=blocos[indice_car];
    //dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=andar[indice_car];
    dfrm.btn_incluir_desc.disabled=false;
    dfrm.btn_incluir_desc.style.backgroundImage="url('../../imagens/botao2.gif')";
    dfrm.btn_incluir_desc.disabled=true;
    dfrm.btn_excluir_desc.disabled=false;
    dfrm.btn_excluir_desc.style.backgroundImage="url('../../imagens/botao.gif')";
  } else {
    dfrm.txt_nm_desc_funcionamento_tmp.value="";
    dfrm.txt_vl_desc_funcionamento_tmp.value="";
    dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";
    //dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=0;
    dfrm.hdn_id_desc_funcionamento_tmp.value="";
    dfrm.btn_incluir_desc.disabled=false;
    dfrm.btn_incluir_desc.style.backgroundImage="url('../../imagens/botao2.gif')";
    dfrm.btn_incluir_desc.disabled=true;
    dfrm.btn_excluir_desc.disabled=false;
    dfrm.btn_excluir_desc.style.backgroundImage="url('../../imagens/botao2.gif')";
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
  //dfrm.hdn_nr_pavimento_desc_funcionamento.value+=dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value+"^";
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
  //dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=0;
  dfrm.txt_nm_desc_funcionamento_tmp.focus();
  dfrm.btn_incluir_desc.disabled=false;
  dfrm.btn_incluir_desc.style.backgroundImage="url('../../imagens/botao2.gif')";
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
    //var andar=dfrm.hdn_nr_pavimento_desc_funcionamento.value.split("^");
    dfrm.hdn_nm_desc_funcionamento.value="";
    dfrm.hdn_vl_desc_funcionamento.value="";
    dfrm.hdn_nm_bloco_desc_funcionamento.value="";
    //dfrm.hdn_nr_pavimento_desc_funcionamento.value="";
    dfrm.txt_nm_desc_funcionamento_tmp.value="";
    dfrm.txt_vl_desc_funcionamento_tmp.value="";
    dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";
    //dfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=0;
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
        //dfrm.hdn_nr_pavimento_desc_funcionamento.value+=andar[i]+"^";
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
    dfrm.btn_incluir_desc.style.backgroundImage="url('../../imagens/botao.gif')";
    dfrm.btn_excluir_desc.disabled=false;
    dfrm.btn_excluir_desc.style.backgroundImage="url('../../imagens/botao2.gif')";
    dfrm.btn_excluir_desc.disabled=true;
  }
}
function muda_desc() {
  var vfrm=document.frm_solic_funcionamento;
  var sec_cmb_desc_funcionamento="";
  if ((vfrm.txt_nm_desc_funcionamento_tmp.value!="") && (vfrm.txt_vl_desc_funcionamento_tmp.value!="")) {
    vfrm.btn_incluir_desc.disabled=false;
    vfrm.btn_incluir_desc.style.backgroundImage="url('../../imagens/botao.gif')";
  } else {
      vfrm.btn_incluir_desc.disabled=false;
      vfrm.btn_incluir_desc.style.backgroundImage="url('../../imagens/botao2.gif')";
      vfrm.btn_incluir_desc.disabled=true;
      vfrm.btn_excluir_desc.disabled=false;
      vfrm.btn_excluir_desc.style.backgroundImage="url('../../imagens/botao2.gif')";
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
    //vfrm.cmb_nr_pavimento_desc_funcionamento_tmp.disabled=false;
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
    //vfrm.cmb_nr_pavimento_desc_funcionamento_tmp.disabled=true;
    vfrm.txt_vl_desc_funcionamento_tmp.disabled=true;
    vfrm.hdn_nm_desc_funcionamento.value="";
    vfrm.hdn_vl_desc_funcionamento.value="";
    //vfrm.hdn_nr_pavimento_desc_funcionamento.value="";
    vfrm.hdn_nm_bloco_desc_funcionamento.value="";
    vfrm.btn_incluir_desc.disabled=false;
    vfrm.btn_incluir_desc.style.backgroundImage="url('../../imagens/botao2.gif')";
    vfrm.btn_incluir_desc.disabled=true;
    vfrm.btn_excluir_desc.disabled=false;
    vfrm.btn_excluir_desc.style.backgroundImage="url('../../imagens/botao2.gif')";
    vfrm.btn_excluir_desc.disabled=true;
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
    //if (vfrm.cmb_nr_pavimento_desc_funcionamento_tmp.value=="") {
    //desc_erro+="=> Pavimento/Andar\n";
    //}
  if (parseFloat(vl_tot)<parseFloat(vl_vist)) {
    desc_erro+="=> Área de Vistoria MENOR que Área Construída\n";
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
    var frm=document.frm_solic_funcionamento;
    if ((frm.txt_nr_cnpj_empresa.value!="") && (frm.txt_nr_cnpjcpf_proprietario.value!="")) {
      if ((frm.txt_nr_cnpj_empresa.value==frm.txt_nr_cnpjcpf_proprietario.value) && (frm.txt_nm_solicitante.value!="") && (frm.txt_nm_proprietario.value=="")) {
        frm.txt_nm_proprietario.value=frm.txt_nm_solicitante.value;
        frm.txt_fone_proprietario.value=frm.txt_nr_fone_empresa.value;
        frm.txt_de_email_proprietario.value=frm.txt_de_email_empresa.value;
        frm.txt_nm_edificacao.focus();
      } else {
        if ((frm.txt_nr_cnpj_empresa.value==frm.txt_nr_cnpjcpf_proprietario.value) && (frm.txt_nm_solicitante.value!=frm.txt_nm_proprietario.value)) {
          //frm.txt_nm_proprietario.focus();
          alert("Nome do Empresa diferente do Prorietário com mesmo CNPJ/CPF!");
          frm.txt_nm_proprietario.value="";
          frm.txt_nr_cnpjcpf_proprietario.value="";
          frm.txt_nm_proprietario.focus();
        }
      }
    }
  }

  function verificarIgualdade() {
    var frm=document.frm_solic_funcionamento;
    if(frm.cbx_prop_igual_solic.checked) {
		frm.txt_nm_proprietario.value=frm.txt_nm_solicitante.value;
		frm.txt_nr_cnpjcpf_proprietario.value=frm.txt_nr_cnpj_empresa.value;
		frm.txt_fone_proprietario.value=frm.txt_nr_fone_empresa.value;
		frm.txt_de_email_proprietario.value=frm.txt_de_email_empresa.value;
    } else {
	  	frm.txt_nm_proprietario.value='';
	  	frm.txt_nr_cnpjcpf_proprietario.value='';
	  	frm.txt_fone_proprietario.value='';
	  	frm.txt_de_email_proprietario.value='';
    }
  }

  function consultar_vist_func(cidade, protocolo, formulario) {
    window.open("consultar_vist_func.php?cidade="+cidade+"&protocolo="+protocolo+"&formulario="+formulario,"","toolbar=no, location=no, directories=no, scrollbars=no, status=yes, innerheight=yes, innerwidth=yes");
  }


</script>
<body  onload="ajustaspan()">

<!-- Consulta pelo protocolo de funcionamento -->
    <fieldset>
        <legend>Consulta pelo Protocolo de Funcionamento</legend>
        <form name="form_consultar_vist_func">
            <table border="0" width="100%">
            <tr>
                <td>
                    <select name="combo_cidade" value="" class="campo_obr">
                    <option value=""> - - - - - - - - - escolha cidade - - - - - - - - - </option>
                    <?
                        $sql = "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' ORDER BY NM_CIDADE";
                        $res = $conn->query($sql);
                        if ($conn->get_status()==false) die($conn->get_msg());
                while ($tupula = $conn->fetch_row()) { 
                    if ($tupula["ID_CIDADE"] == $_POST['cmb_id_cidade']) $selected = 'selected="selected"'; else $selected = ''; ?>
                    ?><option value="<?=$tupula["ID_CIDADE"]?>" <?=$selected?> ><?=$tupula["NM_CIDADE"]?></option><? 
                } 
                    ?>
                    </select>
                    Protocolo <input 
                        type="text" 
                        name="txt_id_prot_func" 
                        value="<?=$_POST['txt_id_prot_func']?>"  
                        size="6" 
                        class="campo_obr"                                                                   
                        onblur="consultar_vist_func(form_consultar_vist_func.combo_cidade.value,this.value,'frm_solic_funcionamento');"
                    >
                </td>
            </tr>
            </table>
        </form>
    </fieldset>

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
          <legend>Solicitante</legend>
          <table>
            <tr>
              <td>Nome</td>
              <td><input type="text" name="txt_nm_solicitante" value="<?=$_POST['txt_nm_solicitante']?>" 
              size="50" maxlength="100" class="campo_obr" title="Nome do Solicitante de Análise da Edificação" 
              onblur="valida_prop()"></td>
              <td>CNPJ/CPF</td>
              <td><input type="text" name="txt_nr_cnpj_empresa" value="<?=$_POST['txt_nr_cnpj_empresa']?>" size="20" maxlength="18" class="campo_obr" onblur="cpfcnpj(this);valida_prop();" value=""></td>
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
              <input type="submit" name="btn_alterar_solicitacao" value="Alterar" align="middle" title="Alterar Solicitação" class="botao" style="background-image : url('../../imagens/botao.gif');">
            </td>
            <td>
              <input type="button" name="btn_voltar" value="Voltar" onclick="javascript:history.back();" align="middle" title="Voltar ao formulário" class="botao" style="background-image : url('../../imagens/botao.gif');">
            </td>
          </tr>
        </table>
    </tr>
  </table>
  </form>

<? } else { ?>

  <form target="_self" enctype="multipart/form-data" method="post" name="frm_solic_funcionamento" onSubmit="return validaForm(this,<?=$campos_js?>)">
    <input type="hidden" name="hdn_id_solic_func" value="">
  <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Empresa</legend>
          <table>
            <tr>
              <td>CNPJ</td>
              <td>
                <input 
                    type="text" 
                    name="txt_nr_cnpj_empresa" 
                    size="20" 
                    maxlength="18" 
                    class="campo_obr" 
                    onblur="
                        cpfcnpj(this);
                        valida_prop();
                    "
                    value=""
                >
              </td>
              <td>Razão Social</td>
              <td><input type="text" name="txt_nm_solicitante" size="50" maxlength="100" class="campo_obr" title="Razão Social da Empresa Solicitante do Funcionamento" onblur="valida_prop()"></td>
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
                <td>&nbsp;</td>
                <td colspan="3">
                <input type="checkbox" name="cbx_prop_igual_solic" onclick="verificarIgualdade()"> Proprietário igual a empresa
              </tr>
              <tr>
                <td>Nome</td>
                <td><input type="text" name="txt_nm_proprietario" size="50" maxlength="100" class="campo_obr" title="Nome do Proprietário da Edificação" onblur="valida_prop()"></td>
                <td>CNPJ/CPF</td>
                <td>
                    <input 
                        type="text" 
                        name="txt_nr_cnpjcpf_proprietario" 
                        size="20" 
                        maxlength="18" 
                        class="campo_obr"  
                        onblur="
                            cpfcnpj(this);
                            valida_prop();
                            consultar_vist_func();
                        " 
                        value=""
                    >
                </td>
              </tr>
            </table>
            <table>
              <tr>
                <td width="30">Fone</td>
                <td><input type="text" name="txt_fone_proprietario" size="13" maxlength="12" class="campo_obr" title="Fone do Proprietário da Edificação"></td>
mvs                <td>E-mail</td>
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
                    while ($cidade=$conn->fetch_row()) { ?>
                        <option value="<?=$cidade["ID_TP_LOGRADOURO"]?>"><?=$cidade["NM_TP_LOGRADOURO"]?></option>
                    <? } ?>
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
                <select name="cmb_id_cidade" value="" class="campo_obr">
                  <option value=""> - - - - - - - - - - - - - - - - - - - - - - - - - </option>
                  <?
                    $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' ORDER BY NM_CIDADE";
                    $res= $conn->query($sql);
                    if ($conn->get_status()==false) die($conn->get_msg());
                    while ($tupula = $conn->fetch_row()) { 
                        ?><option value="<?=$tupula["ID_CIDADE"]?>"><?=$tupula["NM_CIDADE"]?></option><? 
                    } 
                  ?>
                </select>
              </td>
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
                            <option value=""> - - - - - - - - - - - - - -  - - -  - - -  - - -  - - -  - - - </option>
                              <?
                              $sql= "SELECT ID_OCUPACAO, NM_OCUPACAO FROM ".TBL_TP_OCUPACAO;
                              $res= $conn->query($sql);
                              if ($conn->get_status()==false) die($conn->get_msg());
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
                            <option value=""> - - - - - - - - - - - - - - </option>
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
                            <option value=""> - - - - - - - - - - - - - - </option>
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
                            <option value=""> - - - - - - - - - - - - - - </option>
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
                    <option value=""> - - - - - - - - - - - - - - - - </option>
                  </select>
                  <input type="hidden" name="hdn_nm_desc_funcionamento" value="">
                  <input type="hidden" name="hdn_vl_desc_funcionamento" value="">
                  <input type="hidden" name="hdn_nm_bloco_desc_funcionamento" value="">
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
                        <input type="button" name="btn_incluir_desc" value="Incluir" class="botao" style="background-image : url('../../imagens/botao2.gif');" disabled="true" onClick="valida_desc_habitese()">&nbsp;
                        <input type="button" name="btn_excluir_desc" value="Excluir" class="botao" style="background-image : url('../../imagens/botao2.gif');" disabled="true" onClick="exclui_desc()">
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
              <input type="submit" name="btn_alterar" value="Alterar" align="middle" title="Confirma a Alteração de Solicitação de Funcionamento" class="botao" style="background-image : url('../../imagens/botao.gif');">
            </td>
            <td>
              <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa as Informações" class="botao" style="background-image : url('../../imagens/botao.gif');">
            </td>
          </tr>
        </table>
    </tr>
  </table>
  </form>
<? } // if($encontrouSolicitacao) { ?>
      </span></td>
    </tr>
	<? include ('../../templates/footer.htm'); ?>
  </tbody>
</table>
</body>
</html>
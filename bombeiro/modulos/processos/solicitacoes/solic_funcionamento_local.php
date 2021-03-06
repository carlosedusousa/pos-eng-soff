<? 
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
    'txt_nr_cnpj_empresa'=>"'txt_nr_cnpj_empresa,CNPJ da Empresa Solicitante,t'",
    'txt_nm_solicitante'=>"'txt_nm_solicitante,Raz�o Social,t'",
    'txt_nm_fantasia_empresa'=>"'txt_nm_fantasia_empresa,Nome Fantasia do Solicitante,t'",
    'txt_nm_contato'=>"'txt_nm_contato,Nome da Pessoa de Contato,t'",
    'txt_nr_fone_empresa'=>"'txt_nr_fone_empresa,N�mero do Fone Solicitante,n'",
    'txt_de_email_empresa'=>"'txt_de_email_empresa,E-mail da Empresa Solicitante,e'",
    'txt_nm_proprietario'=>"'txt_nm_proprietario,Nome Propriet�rio Edifica��o,t'",
    'txt_nr_cnpjcpf_proprietario'=>"'txt_nr_cnpjcpf_proprietario,CNPJ/CPF do Propriet�rio Edifica��o,t'",
    'txt_fone_proprietario'=>"'txt_fone_proprietario,N�mero do Fone do Propriet�rio da Edifica��o,t'",
    'txt_de_email_proprietario'=>"'txt_de_email_proprietario,E-mail do Propriet�rio da Edifica��o,e'",
    'txt_nm_edificacao'=>"'txt_nm_edificacao,Nome da Edifica��o,t'",
    'cmb_id_tp_prefixo'=>"'cmb_id_tp_prefixo,Prefixo do Logradouro,t'",
    'txt_nm_logradouro'=>"'txt_nm_logradouro,Nome do Logradouro,t'",
    'cmb_id_cidade'=>"'cmb_id_cidade,Cidade da Edifica��o,t'",
    'txt_nm_bairro'=>"'txt_nm_bairro,Nome do Bairro,t'",
    'txt_nr_cep'=>"'txt_nr_cep,N�mero do CEP,t'",
    'txt_vl_area_tot_const'=>"'txt_vl_area_tot_const,Valor da �rea total Constru�da,t'",
    'cmb_id_ocupacao'=>"'cmb_id_ocupacao,Tipo de Ocupa��o,n'",
    'cmb_id_risco'=>"'cmb_id_risco,Tipo Risco da Edifica��o,n'",
    'cmb_id_situacao'=>"'cmb_id_situacao,Situa��o da Edifica��o,n'",
    'cmb_id_tp_construcao'=>"'cmb_id_tp_construcao,Tipo de Constru��o'",
    'cmb_nr_pavimentos'=>"'cmb_nr_pavimentos,N�mero de Pavimentos,n'",
    'cmb_nr_blocos'=>"'cmb_nr_blocos,N�mero de Blocos,n'"
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

    $ID_SOLIC_FUNC   		= "0";
    $ID_TP_FUNC        		= "'P'";
    $NR_CNPJ_EMPRESA       	= formataCampo($_POST["txt_nr_cnpj_empresa"],'VN');
    $NM_RAZAO_SOCIAL    	= formataCampo($_POST["txt_nm_solicitante"]);
    $NM_FANTASIA_EMPRESA	= formataCampo($_POST["txt_nm_fantasia_empresa"]);
    $NM_CONTATO			= formataCampo($_POST["txt_nm_contato"]);
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

    $sql = "SELECT ".
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
            TBL_SOL_FUNC.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."') " .
        "ORDER BY DT_SOLICITACAO ASC, NM_CIDADE ASC ". 
    ";";

    $conn->query($sql);
    $rows_pendente=$conn->num_rows();
    $encontrouSolicitacao = false;

    while ($pendente = $conn->fetch_row()) {
        if(!$encontrouSolicitacao) $encontrouSolicitacao = true;
        $solicitacoes[] = $pendente;
    } 

    if(!$encontrouSolicitacao || @$_POST[btn_enviar_solicitacao]) {

        $query_trans = "BEGIN";
        $res = $conn->query($query_trans);
        $query_trans = "COMMIT";
        $sql = "INSERT INTO ".TBL_SOL_FUNC." (" .
            "ID_CIDADE, ID_SOLIC_FUNC, " .
            "ID_TP_FUNC, CH_PAGO, NR_CNPJ_EMPRESA, NM_RAZAO_SOCIAL, " .
            "NR_FONE_EMPRESA, DE_EMAIL_EMPRESA, NR_CNPJ_CPF_PROPRIETARIO, " .
            "NM_PROPRIETARIO, NR_FONE_PROPRIETARIO, DE_EMAIL_PROPRIETARIO, NM_EDIFICACOES, " .
            "NM_FANTASIA, ID_TP_LOGRADOURO, NM_LOGRADOURO, NR_EDIFICACOES, NR_CEP, NM_BAIRRO, " .
            "NM_COMPLEMENTO, VL_AREA_CONSTRUIDA, CH_PROTOCOLADO, DT_SOLICITACAO, " .
            "CH_AGUARDO_LOGRADOURO, DT_AGUARDO_LOGRADOURO, ID_USUARIO, ID_RISCO, " .
            "ID_TP_CONSTRUCAO, ID_OCUPACAO, ID_SITUACAO, NM_CONTATO, NM_FANTASIA_EMPRESA,CH_TP_FUNC" .
        ") VALUES (" .
            "$ID_CIDADE, $ID_SOLIC_FUNC,$ID_TP_FUNC,$CH_PAGO, $NR_CNPJ_EMPRESA, $NM_RAZAO_SOCIAL, " .
            "$NR_FONE_EMPRESA, $DE_EMAIL_EMPRESA, $NR_CNPJ_CPF_PROPRIETARIO, $NM_PROPRIETARIO, " .
            "$NR_FONE_PROPRIETARIO, $DE_EMAIL_PROPRIETARIO, $NM_EDIFICACOES, $NM_FANTASIA, " .
            "$ID_TP_LOGRADOURO, $NM_LOGRADOURO, $NR_EDIFICACOES, $NR_CEP, $NM_BAIRRO, " .
            "$NM_COMPLEMENTO, $VL_AREA_CONSTRUIDA, $CH_PROTOCOLADO, $DT_SOLICITACAO, " .
            "$CH_AGUARDO_LOGRADOURO, $DT_AGUARDO_LOGRADOURO, $ID_USUARIO, $ID_RISCO, " .
            "$ID_TP_CONSTRUCAO, $ID_OCUPACAO, $ID_SITUACAO, $NM_CONTATO, $NM_FANTASIA_EMPRESA,'$CH_TP_FUNCIONAMENTO')"; 
      
        $res = $conn->query($sql);

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
                    $NR_PAVIMENTOS_DESC=0;
                    $NM_BLOCO=formataCampo($blocos_desc[$num_desc]);
                    if ($query_desc_sub!="") $query_desc_sub.=",\n";
                    $query_desc_sub.=" ($ID_CIDADE, $ID_SOLIC_FUNC, $ID_TP_FUNC, $ID_DESC_FUNC, $NM_DESC_FUNC, $NR_PAVIMENTOS_DESC, $NM_BLOCO, $VL_AREA_DESC_VISTORIAS)";
                    }
                }
            } else {
                $query_desc_sub .= " ($ID_CIDADE, $ID_SOLIC_FUNC, $ID_TP_FUNC, $ID_DESC_FUNC, '�REA TOTAL DA EDIFICA��O', $NR_PAVIMENTOS, 'TODOS', $VL_AREA_CONSTRUIDA)";
            }
            $query_desc = "INSERT INTO ".TBL_DESC_FUNC." (ID_CIDADE, ID_SOLIC_FUNC, ID_TP_FUNC, ID_DESC_FUNC, NM_DESC_FUNC, NR_PAVIMENTO, NM_BLOCO, VL_AREA_DESC_FUNC) VALUES $query_desc_sub;";
            $res = $conn->query($query_desc);
            if ($conn->get_status()==false) {
                $query_trans="ROLLBACK";
                mysql_query($query_trans);
                die($conn->get_msg());
            } else {
?>
	    <script language="JavaScript" type="text/javascript">
		window.confirm("Solicita��o enviada com sucesso!");
	    </script>
<?
            }

            $res = $conn->query($query_trans);

?>
<form name="form_index" method="post">
  <input type="hidden" name="op_menu" value="">
</form>

<script language="JavaScript" type="text/javascript">

    f = document.form_index;
    f.op_menu.value='index';
    f.submit();

//--></script>


<?
        }
            
    }

  } else {

    if ($campos_existe) {
        $erro = "echo '<tr><td align=\"center\" style=\"background-color : #f7ff05; color : #ff0000; font-weight : bold;\">OS CAMPOS ASSINALADOS S�O OBRIGAT�RIOS</td></tr>';\n";
    }

  }
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
      alert("Nome da Refer�ncia j� Existe!!");
      return;
    }
  }
  sec_cmb_desc_funcionamento=dfrm.cmb_desc_funcionamento.options.length++;
  dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text=dfrm.txt_nm_desc_funcionamento_tmp.value;
  dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value=sec_cmb_desc_funcionamento;
  dfrm.hdn_nm_desc_funcionamento.value+=dfrm.txt_nm_desc_funcionamento_tmp.value+"^";
  dfrm.hdn_vl_desc_funcionamento.value+=dfrm.txt_vl_desc_funcionamento_tmp.value+"^";
  dfrm.hdn_nm_bloco_desc_funcionamento.value+=dfrm.txt_nm_bloco_desc_funcionamento_tmp.value+"^";
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
  dfrm.txt_nm_desc_funcionamento_tmp.focus();
  dfrm.btn_incluir_desc.disabled=false;
  dfrm.btn_incluir_desc;
  dfrm.btn_incluir_desc.disabled=true;

}
function exclui_desc() {
  var dfrm=document.frm_solic_funcionamento;
  var indice_excluido=dfrm.hdn_id_desc_funcionamento_tmp.value;
  var sec_cmb_desc_funcionamento="";
  if (dfrm.cmb_desc_funcionamento.value!="") {
    dfrm.cmb_desc_funcionamento.options.length=0;
    sec_cmb_desc_funcionamento=dfrm.cmb_desc_funcionamento.options.length++;
    dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text="________________";
    dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value="";

    var nomes=dfrm.hdn_nm_desc_funcionamento.value.split("^");
    var valores=dfrm.hdn_vl_desc_funcionamento.value.split("^");
    var blocos=dfrm.hdn_nm_bloco_desc_funcionamento.value.split("^");
    var tot=0;
    var valor_tmp="";
    dfrm.hdn_nm_desc_funcionamento.value="";
    dfrm.hdn_vl_desc_funcionamento.value="";
    dfrm.hdn_nm_bloco_desc_funcionamento.value="";
    dfrm.txt_nm_desc_funcionamento_tmp.value="";
    dfrm.txt_vl_desc_funcionamento_tmp.value="";
    dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";

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
    vfrm.txt_vl_desc_funcionamento_tmp.disabled=false;
  } else {
    var sec_cmb_desc_funcionamento="";
    vfrm.cmb_desc_funcionamento.options.length=0;
    sec_cmb_desc_funcionamento=vfrm.cmb_desc_funcionamento.options.length++;
    vfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text="__________________";
    vfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value="";
    vfrm.cmb_desc_funcionamento.disabled=true;
    vfrm.txt_nm_desc_funcionamento_tmp.disabled=true;
    vfrm.txt_nm_bloco_desc_funcionamento_tmp.disabled=true;
    vfrm.txt_vl_desc_funcionamento_tmp.disabled=true;
    vfrm.hdn_nm_desc_funcionamento.value="";
    vfrm.hdn_vl_desc_funcionamento.value="";
    vfrm.hdn_nm_bloco_desc_funcionamento.value="";
    vfrm.btn_incluir_desc.disabled=false;
    vfrm.btn_incluir_desc;
    vfrm.btn_incluir_desc.disabled=true;
    vfrm.btn_excluir_desc.disabled=false;
    vfrm.btn_excluir_desc;
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
    desc_erro="=> N� ou Refer�ncia da Sala\n";
  }
  if (vfrm.txt_vl_desc_funcionamento_tmp.value=="") {
    desc_erro+="=> Valor da �rea\n";
  }
  if (parseFloat(vl_tot)<parseFloat(vl_vist)) {
    desc_erro+="=> �rea de Vistoria MENOR que �rea Constru�da\n";
  }
  if (desc_erro!="") {
    alert("Os campos s�o Obrigat�rios!\n"+desc_erro+"Verifique!!!");
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
          alert("Nome do Empresa diferente do Proriet�rio com mesmo CNPJ/CPF!");
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
    window.open("./modulos/processos/solicitacoes/consultar_vist_func.php?cidade="+cidade+"&protocolo="+protocolo+"&formulario="+formulario,"","toolbar=no, location=no, directories=no, scrollbars=no, status=yes, innerheight=yes, innerwidth=yes");
  }


</script>
<body  onload="ajustaspan()">
  <table width="100%">
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
	<fieldset>
	    <legend>Consulta pelo Protocolo de Funcionamento</legend>
	    <form name="form_consultar_vist_func">
	      <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">
			<td align="left">Protocolo <input type="text" name="txt_nm_solicitante" value="<?=$_POST['txt_nm_solicitante']?>"  size="15" class="campo_obr">&nbsp;
			<select name="combo_cidade" value="" class="campo_obr"  onblur="consultar_vist_func(this.value,form_consultar_vist_func.txt_nm_solicitante.value,'frm_solic_funcionamento');">
			<option value=""> ESCOLHA A CIDADE</option>
			<?
			    $sql = "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' ORDER BY NM_CIDADE";
			    $res = $conn->query($sql);
			    if ($conn->get_status()==false) die($conn->get_msg());
			    while ($tupula = $conn->fetch_row()) { 
				?><option value="<?=$tupula["ID_CIDADE"]?>"><?=$tupula["NM_CIDADE"]?></option><? 
			    } 
			?>
			</select>
		    </td>
			<td>
			    Seleciode um Protocolo existente para incluir como novo <br> ou inclua uma nova solicita��o cadastrando as informa��es abaixo.
			</td>


		</table>
	    </form>
	</fieldset>
    </table>
<? if(@$encontrouSolicitacao) { ?>

<form target="_self" enctype="multipart/form-data" method="post" name="frm_solic_funcionamento" onSubmit="return validaForm(this,<?=$campos_js?>)">
<table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">
  <? foreach($_POST as $nome => $valor) { ?>
        <input type="hidden" name="<?=$nome?>" value="<?=$valor?>"/>
  <? } ?>	
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Solicitante</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td align="right" nowrap="true" >Nome</td>
              <td><input type="text" name="txt_nm_solicitante" value="<?=$_POST['txt_nm_solicitante']?>" 
              size="70" maxlength="100" class="campo_obr" title="Nome do Solicitante de An�lise da Edifica��o" 
              onblur="valida_prop()"></td>
              <td align="right" nowrap="true" >CNPJ/CPF</td>
              <td><input type="text" name="txt_nr_cnpj_empresa" value="<?=$_POST['txt_nr_cnpj_empresa']?>" size="30" maxlength="18" class="campo_obr" onblur="cpfcnpj(this);valida_prop();" value=""></td>
            </tr>
            <tr>
              <td align="right" nowrap="true" >E-mail</td>
              <td><input type="text" name="txt_de_email_empresa" value="<?=$_POST['txt_de_email_empresa']?>" size="70" maxlength="100" class="campo_obr" title="E-mail do Solicitante de An�lise da Edifica��o" style="text-transform : none;"></td>
	      <td align="right" nowrap="true" >Fone</td>
              <td><input type="text" name="txt_nr_fone_empresa" value="<?=$_POST['txt_nr_fone_empresa']?>" size="30" maxlength="12" class="campo_obr" title="Fone do Solicitante de An�lise da Edifica��o"></td>
	    </tr>
          </table>
        </fieldset>
      </td>
    </tr>
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Solicita��es Protocoladas para este CPF/CNPJ</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td colspan="2"><b><br>
              <? if(count($solicitacoes)==1) { ?>
              	Existe a seguinte solicita��o de vistoria para este CPF/CNPJ:
              <? } else { ?>
              	Existem <?=count($solicitacoes)?> solicita��es de vistoria para este CPF/CNPJ:
              <? } ?>
              </b><br><br></td>
			</tr>              
            <tr>
              <td colspan="2">
               <table width="100%" border="0" cellpadding="2" cellspacing="2">
                    <? foreach($solicitacoes as $solicitacao) { ?>
                        <tr>
                            <td align="right" width="100" nowrap="true" >Data:&nbsp;</td> 
                            <td><b><?=$solicitacao['DT_SOLICITACAOS']?>
                            <? if($solicitacao['CH_PROTOCOLADO']=='P') echo " (protocolado)"; ?>
                            </b></td>
                        </tr> 
                        <tr>
                            <td align="right" nowrap="true" >Empresa:&nbsp;</td> 
                            <td><?=$solicitacao['NR_CNPJ_EMPRESA']?> - <?=$solicitacao['NM_RAZAO_SOCIAL']?></td>
                        </tr> 
                        <tr>
                            <td align="right" nowrap="true" >Edifica��o:&nbsp;</td> 
                            <td><?=$solicitacao['NM_EDIFICACOES']?></td>
                        </tr> 
                        <tr>
                            <td align="right" nowrap="true" >Nome Fantasia:&nbsp;</td> 
                            <td><?=$solicitacao['NM_FANTASIA_EMPRESA']?></td>
                        </tr> 
                        <tr>
                            <td align="right" nowrap="true" >Logradouro:&nbsp;</td> 
                            <td><?=$solicitacao['NM_LOGRADOURO']?>, <?=$solicitacao['NR_EDIFICACOES']?></td>
                        </tr> 
                        <tr>
                            <td align="right" nowrap="true" >CEP:&nbsp;</td> 
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
    <tr valign="top" align="center">
      <td>
        <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
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

<form target="_self" enctype="multipart/form-data" method="post" name="frm_solic_funcionamento" onSubmit="return validaForm(this,<?=$campos_js?>)">
<input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">
  <table width="100%">
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Empresa</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td align="right">CNPJ</td>
              <td>
                <input type="text" name="txt_nr_cnpj_empresa" size="30" maxlength="18" class="campo_obr" onblur="cpfcnpj(this);valida_prop();" value="">
              </td>
              <td align="right">Raz�o Social</td>
              <td><input type="text" name="txt_nm_solicitante" size="61" maxlength="100" class="campo_obr" title="Raz�o Social da Empresa Solicitante do Funcionamento" onblur="valida_prop()"></td>
            </tr>
            <tr>
              <td nowrap="true" align="right"> Nome Fantasia Empresa </td>
              <td><input type="text" name="txt_nm_fantasia_empresa" size="30" maxlength="100" class="campo_obr" title="Nome Fantasia da Empresa Solicitante"></td>
              <td align="right">Nome Contato</td>
              <td><input type="text" name="txt_nm_contato" size="61" maxlength="100" class="campo_obr" title="Nome do Respons�vel da Empresa Solicitante"></td>
            </tr>
            <tr>
              <td align="right">Fone</td>
              <td><input type="text" name="txt_nr_fone_empresa" size="30" maxlength="12" class="campo_obr" title="Fone do Solicitante de Funcionamento da Edifica��o"></td>
              <td align="right">E-mail</td>
              <td><input type="text" name="txt_de_email_empresa" size="61" maxlength="100" class="campo_obr" title="E-mail do Solicitante de Funcionamento da Edifica��o" style="text-transform : none;"></td>
            </tr>
          </table>
        </fieldset>
      </td>
    </tr>
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Propriet�rio da Edifica��o</legend>
            <table  width="100%" border="0" cellpadding="2" cellspacing="2">
              <tr>
                <td>
                <input type="checkbox" name="cbx_prop_igual_solic" onclick="verificarIgualdade()"> Propriet�rio igual a empresa
              </tr>
	    </table>
              <table  width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
                <td align="right">CNPJ/CPF</td>
                <td> 
		   <input type="text" name="txt_nr_cnpjcpf_proprietario" size="30" maxlength="18" class="campo_obr"  onblur="cpfcnpj(this);valida_prop();consultar_vist_func();" value="">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td nowrap="true" align="right">Nome</td>
                <td><input type="text" name="txt_nm_proprietario" size="75" maxlength="100" class="campo_obr" title="Nome do Propriet�rio da Edifica��o" onblur="valida_prop()">
		</td>
            </tr>
              <tr>
                <td align="right">Fone</td>
                <td><input type="text" name="txt_fone_proprietario" size="30" maxlength="12" class="campo_obr" title="Fone do Propriet�rio da Edifica��o"></td>
               <td align="right">E-mail</td>   
                <td><input type="text" name="txt_de_email_proprietario" size="75" maxlength="100" class="campo_obr" title="E-mail do Proriet�rio da Edifica��o" style="text-transform : none;"></td>
              </tr>
            </table>
        </fieldset>
      </td>
    </tr>
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Edifica��o</legend>
          <fieldset>
          <legend>Nome da Edifica��o</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td width="108" align="right">Nome</td>
              <td><input type="text" name="txt_nm_edificacao" size="50" maxlength="100" class="campo_obr" title="Nome da Edifica��o"></td>
              <td width="110" align="right" nowrap="true">Nome Fantasia</td>
              <td><input type="text" name="txt_nm_fantasia" size="50" maxlength="100" title="Nome Fantasia da Edifi��o" class="campo"></td>
            </tr>
          </table>
          </fieldset>
          <fieldset>
          <legend>Endere�o</legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td align="right">Logradouro</td>
              <td>
                <select name="cmb_id_tp_prefixo" class="campo_obr">
                    <option value="">_</option>
                    <?
                    $sql_tp_logradouro="SELECT ID_TP_LOGRADOURO, NM_TP_LOGRADOURO FROM ".TBL_TP_LOGRADOURO;
                    $conn->query($sql_tp_logradouro);
                    while ($cidade=$conn->fetch_row()) { ?>
                        <option value="<?=$cidade["ID_TP_LOGRADOURO"]?>"><?=$cidade["NM_TP_LOGRADOURO"]?></option>
                    <? } ?>
                </select>
              </td>
              <td align="right">Nome</td>
              <td>
                <input type="text" name="txt_nm_logradouro" size="61" maxlength="100" title="Nome do Logradouro" class="campo_obr">
              </td>
            </tr>
            <tr>
              <td align="right">N�</td>
              <td>
                <input type="text" name="txt_nr_numero" size="21" maxlength="6" class="campo" title="N�mero do Endere�o da Edifica��o" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)">
              </td>
              <td align="right">Bairro</td>
              <td><input type="text" name="txt_nm_bairro" size="61" maxlength="50" class="campo_obr" title="Bairro da Edifica��o"></td>
              
            </tr>
            <tr>
	      <td align="right">Cidade</td>
              <td>
                <select name="cmb_id_cidade" value="" class="campo_obr">
                  <option value=""> ESCOLHA A CIDADE </option>
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
             <td align="right">CEP</td>
              <td>
                <input type="text" name="txt_nr_cep" size="21" maxlength="40" class="campo" title="N�mero do CEP da Edifica��o" onkeypress="return validaTecla(this, event, 'n')" onblur="CEP(this)">
              </td>
             </tr>
             <tr>
              <td align="right">Complemento</td>
              <td><input type="text" name="txt_nm_complemento" size="28" maxlength="100" class="campo" title="Complemento do Endere�o da Edifica��o"></td>
              <td align="right" nowrap="true">�rea Total Constru�da</td>
              <td nowrap="true">
                <input type="text" name="txt_vl_area_tot_const" size="61" maxlength="17" align="right" class="campo_obr" title="�rea total contruida da Edifica��o" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)">
                <em>(m�)</em>
              </td>
            </tr>
          </table>
          </fieldset>
          <fieldset>
            <legend>Caracteristicas da Edfica��o</legend>
	    <table width="100%" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td>
		    <table width="100%" border="0" cellpadding="2" cellspacing="2">
                      <tr>
                        <td align="right">Ocupa��o</td>
                        <td><select name="cmb_id_ocupacao" class="campo_obr" title="Classifica��o da Edifica��o quanto a sua Ocupa��o">
                            <option value="">___________________________________</option>
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
                        <td align="right">Risco</td>
                        <td>
                          <select name="cmb_id_risco" class="campo_obr" title="Classe de risco de inc�ndio da Edifica��o">
                            <option value="">___________________________________</option>
                            <?
                              $sql= "SELECT ID_RISCO, NM_RISCO FROM ".TBL_TP_RISCO;
                              $res= $conn->query($sql);
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
                        <td align="right">Situa��o</td>
                        <td>
                          <select name="cmb_id_situacao" title="Situa��o da edifica��o quanto a sua constru��o" class="campo_obr">
                            <option value="">___________________________________</option>
                            <?
                              $sql= "SELECT ID_SITUACAO, NM_SITUACAO FROM ".TBL_TP_SITUACAO;
                              $res= $conn->query($sql);
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
                        <td align="right">Tipo</td>
                        <td>
                          <select name="cmb_id_tp_construcao" class="campo_obr" title="Tipo de contru��o da Edifica��o">
                            <option value="">___________________________________</option>
                            <?
                              $sql= "SELECT ID_TP_CONSTRUCAO, NM_TP_CONSTRUCAO FROM ".TBL_TP_CONSTRUCAO;
                              $res= $conn->query($sql);
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
                        <td align="right">N� Pavimentos</td>
                        <td>
                          <select name="cmb_nr_pavimentos" class="campo_obr" title="N�mero de pavimentos da edifica��o">
                            <?
                              for ($i=1;$i<=35;$i++) {
                                echo "<option value=\"".$i."\">".$i."</option>\n";
                              }
                            ?>
                          </select>
                        </td>
                        <td align="right">N� Blocos</td>
                        <td>
                          <select name="cmb_nr_blocos" class="campo_obr" title="N�mero de Blocos da Edifica��o">
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
            <legend>�rea de Vistoria</legend>
            <table width="100%" cellspacing="1" cellpadding="2" align="center" border="0">
              <tr>
                <td align="right">Tipo de Vistoria</td>
                <td>
                  <select name="cmb_ch_tp_funcionamento" class="campo_obr" onChange="muda_desc_tp(this)">
                    <option value="T" selected>TODA A EDIFICA��O</option>
                    <option value="P">PARCIAL</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="right">Salas Cadastradas</td>
                <td>
                  <select name="cmb_desc_funcionamento" class="campo" onChange="carrega_desc(this)" disabled="true">
                    <option value="">__________________</option>
                  </select>
                  <input type="hidden" name="hdn_nm_desc_funcionamento" value="">
                  <input type="hidden" name="hdn_vl_desc_funcionamento" value="">
                  <input type="hidden" name="hdn_nm_bloco_desc_funcionamento" value="">
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <table width="100%" cellpadding="0" cellspacing="2" align="center" border="0">
                    <tr>
                      <td align="right">Local a Ser Vistoriado</td>
                      <td colspan="2">
                        <input type="hidden" name="hdn_id_desc_funcionamento_tmp" value="">
                        <input type="text" name="txt_nm_desc_funcionamento_tmp" class="campo_obr" size="30" maxlength="50" value="" onkeyup="muda_desc()" disabled="true">
                      </td>
                    </tr>
                    <tr>
                      <td align="right">Complemento</td>
                      <td colspan="2">
                        <input type="text" name="txt_nm_bloco_desc_funcionamento_tmp" class="campo" size="25" maxlength="50" value="" disabled="true">
                      </td>
                    </tr>
                    <tr>
                      <td align="right">�rea</td>
                      <td>
                        <input type="text" name="txt_vl_desc_funcionamento_tmp" class="campo_obr" size="30" maxlength="50" align="right" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this);muda_desc();" onblur="decimal(this,2)" value="" disabled="true">
                        <em>(m�)</em>
                      </td>
                    </tr>
		    <tr>
		    <td>
		    <td align ="left">
			<input type="button" name="btn_incluir_desc" value="Incluir" class="botao"  disabled="true" onClick="valida_desc_habitese()">&nbsp;&nbsp;&nbsp;
			<input type="button" name="btn_excluir_desc" value="Excluir" class="botao"  disabled="true" onClick="exclui_desc()">
		    </td>

	      </tr>
              <tr>
                      <td align="right">�rea Total a Ser Vistoriada</td>
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
              <input type="submit" name="btn_enviar" value="Enviar" align="middle" title="Confirma a Solicita��o de Funcionamento" class="botao" >
            </td>
            <td>
              <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa as Informa��es" class="botao" >
            </td>
          </tr>
        </table>
    </tr>
  </table>
  </form>
<? } ?>
</body>
</html>
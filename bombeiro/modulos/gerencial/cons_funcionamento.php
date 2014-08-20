<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <script language="JavaScript" type="text/javascript" src="../../js/sigat_div.js"></script>
</head>
<body>
<?
  if ((@$_GET["campo1"]!="") && (@$_GET["campo2"]!="")) {
    require_once 'lib/loader.php';
    // incluindo a classe
// Conectando ao BD BD ($host, $user, $pass, $db)

  $arquivo="vist_funcionamento.php";
  
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

// campo de seleção
    $ID_CIDADE=strtoupper($_GET["campo1"]);
    $ID_PROT_FUNC=strtoupper($_GET["campo2"]);
    $gerencia=$_GET["gerencia"];
    
// excluídos
		
		$query = 
			"SELECT ".
				TBL_PROT_FUNC.".CH_EXCLUIDO AS PROTOCOLO_EXCLUIDO, ".
				TBL_PROT_FUNC.".DE_EXCLUIDO AS PROTOCOLO_MOTIVO, ".
				TBL_SOL_FUNC.".CH_EXCLUIDO AS SOLICITACAO_EXCLUIDA, ".
				TBL_SOL_FUNC.".DE_EXCLUIDO AS SOLICITACAO_MOTIVO, ".
				TBL_VISTORIA_FUNC.".CH_EXCLUIDO AS VISTORIA_EXCLUIDA, ".
				TBL_VISTORIA_FUNC.".DE_EXCLUIDO AS VISTORIA_MOTIVO, ".
				TBL_COB_BOLETO.".CH_EXCLUIDO AS TAXA_EXCLUIDA, ".
				TBL_COB_BOLETO.".DE_EXCLUIDO AS TAXA_MOTIVO ".
				" FROM ".TBL_PROT_FUNC." LEFT JOIN ".TBL_COB_BOLETO." ON (".
						 TBL_PROT_FUNC.".ID_PROT_FUNC=".TBL_COB_BOLETO.".ID_PROT_FUNC AND ".
						 TBL_PROT_FUNC.".ID_CIDADE=".TBL_COB_BOLETO.".ID_CIDADE_PROT_FUNC)" .
						 " LEFT JOIN ".TBL_SOL_FUNC." ON (".
									   TBL_SOL_FUNC.".ID_SOLIC_FUNC=".TBL_PROT_FUNC.".ID_SOLIC_FUNC AND ".
									   TBL_SOL_FUNC.".ID_CIDADE=".TBL_PROT_FUNC.".ID_CIDADE)" .
									   " LEFT JOIN ".TBL_VISTORIA_FUNC." ON (".
													 TBL_VISTORIA_FUNC.".ID_PROT_FUNC=".TBL_PROT_FUNC.".ID_PROT_FUNC AND ".
													 TBL_VISTORIA_FUNC.".ID_CIDADE=".TBL_PROT_FUNC.".ID_CIDADE)" .
									   " WHERE ".
									   TBL_PROT_FUNC.".ID_PROT_FUNC=$ID_PROT_FUNC AND ".
									   TBL_PROT_FUNC.".ID_CIDADE=$ID_CIDADE";

	    $conn->query($query);
	    //echo $query; exit;
		if ($conn->get_status()==false) die($conn->get_msg());

		if ($tupla = $conn->fetch_row()) {

			if($tupla["SOLICITACAO_EXCLUIDA"]=='S') $cbxSolicitacao = true;	else $cbxSolicitacao = false;
			if($tupla["PROTOCOLO_EXCLUIDO"]=='S') $cbxProtocolo = true; else $cbxProtocolo = false;
			if($tupla["VISTORIA_EXCLUIDA"]=='S') $cbxVistoria = true; else $cbxVistoria = false;
			if($tupla["TAXA_EXCLUIDA"]=='S') $cbxTaxa = true; else $cbxTaxa = false;

			// Descrição da exclusão
			$txaMtvExclusao = '';
			if($tupla["TAXA_MOTIVO"]) $txaMtvExclusao = $tupla["TAXA_MOTIVO"];
			if($tupla["VISTORIA_MOTIVO"]) $txaMtvExclusao = $tupla["VISTORIA_MOTIVO"];
			if($tupla["PROTOCOLO_MOTIVO"]) $txaMtvExclusao = $tupla["PROTOCOLO_MOTIVO"];
			if($tupla["SOLICITACAO_MOTIVO"]) $txaMtvExclusao = $tupla["SOLICITACAO_MOTIVO"];
			
		}


// fim excluídos
    
    $query="SELECT ".TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC
, ".TBL_VISTORIA_FUNC.".DE_OBSERVACOES
, ".TBL_VISTORIA_FUNC.".CH_PARECER
, ".TBL_PROT_FUNC.".ID_PROT_FUNC
, ".TBL_PROT_FUNC.".ID_CIDADE
, ".TBL_PROT_FUNC.".VL_VISTORIA
, ".TBL_SOL_FUNC.".ID_SOLIC_FUNC
, ".TBL_SOL_FUNC.".ID_TP_FUNC
, ".TBL_SOL_FUNC.".CH_PAGO
, ".TBL_SOL_FUNC.".CH_TP_FUNC
, ".TBL_VISTORIA_FUNC.".ID_CNPJ_EMPRESA AS NR_CNPJ_EMPRESA
, ".TBL_PESSOA.".NM_PESSOA AS NM_RAZAO_SOCIAL
, ".TBL_PESSOA.".NM_FANTASIA AS NM_FANTASIA_EMPRESA
, ".TBL_PESSOA.".NM_CONTATO
, ".TBL_PESSOA.".NR_FONE AS NR_FONE_EMPRESA
, ".TBL_PESSOA.".DE_EMAIL_PESSOA AS DE_EMAIL_EMPRESA
, ".TBL_EDIFICACAO.".ID_EDIFICACAO
, ".TBL_EDIFICACAO.".NM_EDIFICACAO AS NM_EDIFICACOES
, ".TBL_EDIFICACAO.".NM_FANTASIA_1 AS NM_FANTASIA
, ".TBL_LOGRADOURO.".NM_LOGRADOURO
, ".TBL_EDIFICACAO.".NR_EDIFICACAO AS NR_EDIFICACOES
, ".TBL_EDIFICACAO.".ID_CEP AS NR_CEP
, ".TBL_LOGRADOURO.".ID_LOGRADOURO
, ".TBL_BAIRROS.".ID_BAIRROS
, ".TBL_BAIRROS.".NM_BAIRROS AS NM_BAIRRO
, ".TBL_EDIFICACAO.".NM_COMPLEMENTO
, ".TBL_EDIFICACAO.".VL_AREA_CONSTRUIDA
, ".TBL_SOL_FUNC.".CH_PROTOCOLADO
, ".TBL_SOL_FUNC.".DT_SOLICITACAO
, ".TBL_EDIFICACAO.".NR_PAVIMENTOS
, ".TBL_EDIFICACAO.".NR_BLOCOS
, ".TBL_ESTABELECIMENTO.".ID_ESTABELECIMENTO
, ".TBL_ESTABELECIMENTO.".NM_ESTABELECIMENTO AS NM_DESC_FUNC
, ".TBL_ESTABELECIMENTO.".NR_PAVIMENTO
, ".TBL_ESTABELECIMENTO.".NM_BLOCO
, ".TBL_ESTABELECIMENTO.".VL_AREA AS VL_AREA_DESC_FUNC
, ".TBL_CIDADE.".NM_CIDADE
, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO
FROM ".TBL_VISTORIA_FUNC." LEFT JOIN ".TBL_PROT_FUNC." ON (".TBL_VISTORIA_FUNC.".ID_PROT_FUNC=".TBL_PROT_FUNC.".ID_PROT_FUNC AND ".TBL_VISTORIA_FUNC.".ID_CIDADE=".TBL_PROT_FUNC.".ID_CIDADE)
 LEFT JOIN ".TBL_PESSOA." ON (".TBL_VISTORIA_FUNC.".ID_CNPJ_EMPRESA=".TBL_PESSOA.".ID_CNPJ_CPF AND ".TBL_VISTORIA_FUNC.".ID_CIDADE_EMPRESA=".TBL_PESSOA.".ID_CIDADE)
 LEFT JOIN ".TBL_VIST_ESTAB." ON (".TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC=".TBL_VIST_ESTAB.".ID_VISTORIA_FUNC AND ".TBL_VISTORIA_FUNC.".ID_CIDADE=".TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA)
 LEFT JOIN ".TBL_ESTABELECIMENTO." ON (".TBL_VIST_ESTAB.".ID_ESTABELECIMENTO=".TBL_ESTABELECIMENTO.".ID_ESTABELECIMENTO AND ".TBL_VIST_ESTAB.".ID_EDIFICACAO=".TBL_ESTABELECIMENTO.".ID_EDIFICACAO AND ".TBL_VIST_ESTAB.".ID_CIDADE_ESTAB=".TBL_ESTABELECIMENTO.".ID_CIDADE)
 LEFT JOIN ".TBL_EDIFICACAO." ON (".TBL_ESTABELECIMENTO.".ID_EDIFICACAO=".TBL_EDIFICACAO.".ID_EDIFICACAO AND ".TBL_ESTABELECIMENTO.".ID_CIDADE=".TBL_EDIFICACAO.".ID_CIDADE)
 LEFT JOIN ".TBL_SOL_FUNC." ON(".TBL_PROT_FUNC.".ID_SOLIC_FUNC=".TBL_SOL_FUNC.".ID_SOLIC_FUNC AND ".TBL_PROT_FUNC.".ID_TP_FUNC=".TBL_SOL_FUNC.".ID_TP_FUNC AND ".TBL_PROT_FUNC.".ID_CIDADE=".TBL_SOL_FUNC.".ID_CIDADE)
 LEFT JOIN ".TBL_CIDADE." ON(".TBL_SOL_FUNC.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE)
 LEFT JOIN ".TBL_CEP." ON (".TBL_EDIFICACAO.".ID_CEP=".TBL_CEP.".ID_CEP AND ".TBL_EDIFICACAO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_EDIFICACAO.".ID_CIDADE_CEP=".TBL_CEP.".ID_CIDADE)
 LEFT JOIN ".TBL_LOGRADOURO." ON (".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE)
 LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE)
 LEFT JOIN ".TBL_TP_LOGRADOURO." ON(".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO)
WHERE ".TBL_PROT_FUNC.".ID_CIDADE=".$ID_CIDADE." AND ".TBL_PROT_FUNC.".ID_PROT_FUNC=".$ID_PROT_FUNC;
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $row_solicita=$conn->num_rows();
    $count=1;
    if ($row_solicita>0) {
      while ($solicitacao=$conn->fetch_row()) {
        if ($count==1) {
          $ID_VISTORIA_FUNC=$solicitacao["ID_VISTORIA_FUNC"];
          $ID_CIDADE=$solicitacao["ID_CIDADE"];
          $NM_RAZAO_SOCIAL                    =$solicitacao["NM_RAZAO_SOCIAL"];
          $NR_FONE_EMPRESA         =$solicitacao["NR_FONE_EMPRESA"];
          $NM_CONTATO=$solicitacao["NM_CONTATO"];
          $NM_FANTASIA_EMPRESA=$solicitacao["NM_FANTASIA_EMPRESA"];
          $NR_CNPJ_EMPRESA    =$solicitacao["NR_CNPJ_EMPRESA"];
          $DE_EMAIL_EMPRESA   =$solicitacao["DE_EMAIL_EMPRESA"];
          $NM_EDIFICACOES     =$solicitacao["NM_EDIFICACOES"];
          $NM_LOGRADOURO      =$solicitacao["NM_LOGRADOURO"];
          $NR_EDIFICACAO      =$solicitacao["NR_EDIFICACOES"];
          $NM_BAIRRO          =$solicitacao["NM_BAIRRO"];
          $NR_CEP             =$solicitacao["NR_CEP"];
          $NM_CIDADE          =$solicitacao["NM_CIDADE"];
          $NM_COMPLEMENTO     =$solicitacao["NM_COMPLEMENTO"];
          $VL_AREA_CONSTRUIDA =$solicitacao["VL_AREA_CONSTRUIDA"];
          $VL_VISTORIA        =$solicitacao["VL_VISTORIA"];
          $NM_CIDADE          =$solicitacao["NM_CIDADE"];
          $NM_TP_LOGRADOURO   =$solicitacao["NM_TP_LOGRADOURO"];
          $ID_TP_FUNC         =$solicitacao["ID_TP_FUNC"];
          $ID_SOLIC_FUNC      =$solicitacao["ID_SOLIC_FUNC"];
          $ID_PROT_FUNC       =$solicitacao["ID_PROT_FUNC"];
          $CH_TP_FUNC=$solicitacao["CH_TP_FUNC"];
          $ID_EDIFICACAO=$solicitacao["ID_EDIFICACAO"];
          $CH_PARECER=$solicitacao["CH_PARECER"];
          $DE_OBSERVACOES=str_replace("\"","\\\"",str_replace("\n","\r",$solicitacao["DE_OBSERVACOES"]));
          if (strpos($DE_OBSERVACOES,"\n")>(-1)) {
            $de_obs=explode("\n",$DE_OBSERVACOES);
          } elseif (strpos($DE_OBSERVACOES,"\r")>(-1)) {
            $de_obs=explode("\r",$DE_OBSERVACOES);
          } else {
            $de_obs[0]=str_replace("\n","\\n",str_replace("\r","\\r",$solicitacao["DE_OBSERVACOES"]));
          }
//          $DE_OBSERVACOES=str_replace("\n","\\n",str_replace("\r","\\r",$solicitacao["DE_OBSERVACOES"]));
?>
<script language="javascript" type="text/javascript">//<!--
var frm=window.opener.document.frm_vist_funcionamento;
if (window.opener.confirm("Exite Registro para esta Rotina. Deseja Carregar?")) {

	frm.cbx_solicitacao.checked="<?=$cbxSolicitacao;?>";
	frm.cbx_protocolo.checked="<?=$cbxProtocolo;?>";
	frm.cbx_vistoria.checked="<?=$cbxVistoria;?>";
	frm.cbx_taxa.checked="<?=$cbxTaxa;?>";
	frm.txa_mtv_exclusao.value="<?=$txaMtvExclusao;?>";

  //frm.btn_incluir.disabled=false;
  //frm.btn_incluir.style.backgroundImage="url('../../imagens/botao.gif')";
  //frm.btn_incluir.value="Alterar";
  //frm.hdn_controle.value="2";
  //frm.txt_id_.readOnly=true;
  frm.hdn_id_vist_func.value="<?=$ID_VISTORIA_FUNC?>";
  //frm.txt_id_prot_funcionamento.readOnly=true;
  frm.txt_id_prot_funcionamento.value="<?=$ID_PROT_FUNC?>";
  frm.hdn_id_tp_sol_funcionamento.value="<?=$ID_TP_FUNC?>";
  frm.hdn_id_sol_funcionamento.value="<?=$ID_SOLIC_FUNC?>";
  frm.txt_id_edificacao.value="<?=$ID_EDIFICACAO?>";
  frm.txt_nm_razao_social.value="<?=$NM_RAZAO_SOCIAL?>";
  frm.txt_nm_razao_social.readOnly=true;
  //frm.txt_nr_fone_empresa.value="<?=$NR_FONE_EMPRESA?>";
  //frm.txt_nr_fone_empresa.readOnly=true;
  frm.txt_nr_cnpj_empresa.value="<?=$NR_CNPJ_EMPRESA?>";
  cpfcnpj(frm.txt_nr_cnpj_empresa);
  frm.txt_nr_cnpj_empresa.readOnly=true;
  //frm.txt_de_email_empresa.value="<?=$DE_EMAIL_EMPRESA?>";
  //frm.txt_de_email_empresa.readOnly=true;
  frm.txt_nm_contato.value="<?=$NM_CONTATO?>";
  frm.txt_nm_fantasia_empresa.value="<?=$NM_FANTASIA_EMPRESA?>";
  frm.txt_nm_edificacao.value="<?=$NM_EDIFICACOES?>";
  frm.txt_nm_edificacao.readOnly=true;
  frm.txt_nm_logradouro.value="<?=$NM_LOGRADOURO?>";
  frm.txt_nr_edificacao.value="<?=$NR_EDIFICACAO?>";
  FormatNumero(frm.txt_nr_edificacao);
  frm.txt_nm_bairro.value="<?=$NM_BAIRRO?>";
  frm.txt_id_cep.value="<?=$NR_CEP?>";
  CEP(frm.txt_id_cep);
  frm.txt_vl_area_construida.value="<?=str_replace(".",",",$VL_AREA_CONSTRUIDA)?>";
  FormatNumero(frm.txt_vl_area_construida);
  decimal(frm.txt_vl_area_construida,2);
  frm.txt_nm_complemento.value="<?=$NM_COMPLEMENTO?>";
  frm.hdn_id_cidade.value="<?=$ID_CIDADE?>";
  frm.txt_nm_cidade.value="<?=$NM_CIDADE?>";
  frm.txt_nm_tp_logradouro.value="<?=$NM_TP_LOGRADOURO?>";
  //frm.hdn_mtv_indeferimento.value=1;
  frm.txt_vl_area_vistoriada.value="<?=str_replace(".",",",$VL_VISTORIA)?>";
  FormatNumero(frm.txt_vl_area_vistoriada);
  decimal(frm.txt_vl_area_vistoriada,2);
  frm.cmb_ch_tp_funcionamento.value="<?=$CH_TP_FUNC?>";
  //frm.cmb_ch_parecer.value="<?=$CH_PARECER?>";
  frm.hdn_mtv_indeferimento.value="<?=$CH_PARECER?>";
  frm.txa_mtv_indeferimento.disabled=false;
  frm.txa_mtv_indeferimento.value="<?=$de_obs[0]?>";
<?
          if (count($de_obs)>1) {
            for ($i=1;$i<count($de_obs);$i++) {
?>
  frm.txa_mtv_indeferimento.value+="\n";
  frm.txa_mtv_indeferimento.value+="<?=$de_obs[$i]?>";
<?
            }
          }
          $count=2;
        }
        $ID_ESTABELECIMENTO=$solicitacao["ID_ESTABELECIMENTO"];
        $NM_DESC_FUNC=$solicitacao["NM_DESC_FUNC"];
        $NM_BLOCO=$solicitacao["NM_BLOCO"];
        $NR_PAVIMENTO=$solicitacao["NR_PAVIMENTO"];
        $VL_AREA_DESC_FUNC=$solicitacao["VL_AREA_DESC_FUNC"];
        if ($CH_TP_FUNC=='P') {
  ?>
  frm.hdn_id_estab.value="<?=$ID_ESTABELECIMENTO?>^";
  window.opener.muda_desc_tp(frm.cmb_ch_tp_funcionamento);
  frm.txt_nm_desc_funcionamento_tmp.value="<?=$NM_DESC_FUNC?>";
  frm.txt_nm_bloco_desc_funcionamento_tmp.value="<?=$NM_BLOCO?>";
  // frm.cmb_nr_pavimento_desc_funcionamento_tmp.value="<?=$NR_PAVIMENTO?>";
  frm.txt_vl_desc_funcionamento_tmp.value="<?=str_replace(".",",",$VL_AREA_DESC_FUNC)?>";
  FormatNumero(frm.txt_vl_desc_funcionamento_tmp);
  decimal(frm.txt_vl_desc_funcionamento_tmp,2);
  window.opener.insere_desc();
<?
        }
      }

###############
?>
} else {
  frm.value="";
  frm.focus();
}
// -->
</script>
<?
    } else {
?>
<script language="javascript" type="text/javascript">
//<!--
  window.opener.alert("Protocolo não encontrado para esta cidade!");
  window.opener.resetForm();
// -->
</script>

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
 
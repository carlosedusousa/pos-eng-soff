<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?// echo("teste edificacao_cons"); exit; ?>
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <script language="JavaScript" type="text/javascript" src="../../js/sistemacbm.js"></script>
</head>
<body>

<?php
	
    if ((@$_GET["campo1"]!="") && (@$_GET["campo2"]!="")) {
    require_once 'lib/loader.php';

  $arquivo="edificacao.php";

  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  
  // executando a consulta
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  }

  $global_obj_sessao->load($rotina["ID_ROTINA"]);

    // campo de seleção
    $ID_EDIFICACAO=strtoupper($_GET["campo1"]);
    $ID_CIDADE=strtoupper($_GET["campo2"]);
    $query="SELECT
".TBL_EDIFICACAO.".ID_CIDADE,
".TBL_EDIFICACAO.".ID_EDIFICACAO,
".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO,
".TBL_EDIFICACAO.".ID_CIDADE_PESSOA,
".TBL_EDIFICACAO.".NM_EDIFICACAO,
".TBL_EDIFICACAO.".NM_FANTASIA_1,
".TBL_EDIFICACAO.".NM_FANTASIA_2,
".TBL_EDIFICACAO.".NR_EDIFICACAO,
".TBL_EDIFICACAO.".NM_COMPLEMENTO,
".TBL_EDIFICACAO.".VL_AREA_CONSTRUIDA,
".TBL_EDIFICACAO.".VL_ALTURA,
".TBL_EDIFICACAO.".VL_AREA_TIPO,
".TBL_EDIFICACAO.".NR_PAVIMENTOS,
".TBL_EDIFICACAO.".NR_BLOCOS,
".TBL_EDIFICACAO.".ID_RISCO,
".TBL_EDIFICACAO.".ID_SITUACAO,
".TBL_EDIFICACAO.".ID_TP_CONSTRUCAO,
".TBL_EDIFICACAO.".ID_OCUPACAO,
".TBL_EDIFICACAO.".ID_CEP,
".TBL_EDIFICACAO.".ID_LOGRADOURO,
".TBL_LOGRADOURO.".NM_LOGRADOURO,
".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO,
".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO,
".TBL_PESSOA.".NM_PESSOA,
".TBL_PESSOA.".NR_FONE,
".TBL_PESSOA.".DE_EMAIL_PESSOA, 
".TBL_BAIRROS.".NM_BAIRROS,
".TBL_CARAC_ED.".ID_CARC_EDIFICACAO,
".TBL_CARAC_ED.".CH_SIS_PREVENTIVO_EXTINTOR,
".TBL_CARAC_ED.".ID_ADUCAO,
".TBL_CARAC_ED.".CH_COMB_GLP,
".TBL_CARAC_ED.".ID_TP_RECIPIENTE,
".TBL_CARAC_ED.".CH_COMB_GN,
".TBL_CARAC_ED.".ID_TP_INSTALACAO,
".TBL_CARAC_ED.".NR_ESCADA_COMUM,
".TBL_CARAC_ED.".NR_ESCADA_PROTEGIDA,
".TBL_CARAC_ED.".NR_ESCADA_ENC, 
".TBL_CARAC_ED.".NR_ESCADA_PROVA_FUMACA, 
".TBL_CARAC_ED.".NR_ESCADA_PRESSU,
".TBL_CARAC_ED.".NR_RAMPA,  
".TBL_CARAC_ED.".NR_ELEV_EMERGENCIA,  
".TBL_CARAC_ED.".NR_RESG_AEREO,
".TBL_CARAC_ED.".NR_PASSARELA,      
".TBL_CARAC_ED.".ID_TP_PARA_RAIO,      
".TBL_CARAC_ED.".ID_TP_CAPTORES,      
".TBL_CARAC_ED.".ID_TP_ATERRAMENTO,      
".TBL_CARAC_ED.".ID_TP_ABANDONO,      
".TBL_CARAC_ED.".CH_SPRINKLER,      
".TBL_CARAC_ED.".CH_MULSYFIRE,      
".TBL_CARAC_ED.".CH_FIXO_CO2,      
".TBL_CARAC_ED.".CH_ANCORA_CABO,      
".TBL_CARAC_ED.".NR_DETEC_INCEDIO,
".TBL_CARAC_ED.".NR_DETEC_FUMACA, 
".TBL_CARAC_ED.".NR_DETEC_VEL, 
".TBL_CARAC_ED.".NR_DETEC_QMC,  
".TBL_CARAC_ED.".NR_PONTOS,         	
".TBL_CARAC_ED.".NR_PQS, 
".TBL_CARAC_ED.".NR_AGUA,
".TBL_CARAC_ED.".NR_ESPUMA,
".TBL_CARAC_ED.".NR_CO2, 
".TBL_CARAC_ED.".PONTOS_INSTALADOS,
".TBL_CARAC_ED.".DE_OUTROS,   
".TBL_CARAC_ED.".NR_DETEC_FUMACA,
".TBL_CARAC_ED.".NR_DETEC_VEL,
".TBL_CARAC_ED.".NR_DETEC_QMC,  
".TBL_CARAC_ED.".NR_PONTOS,    
".TBL_CARAC_ED.".PONTOS_INSTALADOS,    
".TBL_CARAC_ED.".QTD_GN,
".TBL_CARAC_ED.".QTD_GLP, 
".TBL_CARAC_ED.".ID_ILU_EMERG

FROM ".TBL_EDIFICACAO." ".

	"LEFT JOIN ".TBL_CARAC_ED." ON (".
		TBL_EDIFICACAO.".ID_CIDADE = ".TBL_CARAC_ED.".ID_CIDADE AND ".
		TBL_EDIFICACAO.".ID_EDIFICACAO = ".TBL_CARAC_ED.".ID_EDIFICACAO) " .
	"LEFT JOIN ".TBL_CEP." ON (".
		TBL_EDIFICACAO.".ID_CEP=".TBL_CEP.".ID_CEP AND ".
		TBL_EDIFICACAO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".
		TBL_EDIFICACAO.".ID_CIDADE_CEP=".TBL_CEP.".ID_CIDADE)
	LEFT JOIN ".TBL_LOGRADOURO." ON (".
		TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".
		TBL_LOGRADOURO.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE)
	LEFT JOIN ".TBL_BAIRROS." ON (".
		TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".
		TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE)
	LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".
		TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO)
	LEFT JOIN ".TBL_PESSOA." ON (".
		TBL_EDIFICACAO.".ID_CIDADE_PESSOA=".TBL_PESSOA.".ID_CIDADE AND ".
		TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO=".TBL_PESSOA.".ID_CNPJ_CPF)
WHERE ".
	TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE AND ".
	TBL_EDIFICACAO.".ID_EDIFICACAO=$ID_EDIFICACAO";

$conn->query($query);
// echo "$query";exit;
$dados = null;
 $tupula = $conn->fetch_row();
//while ($tupla = $conn->fetch_row()) $dados[] = $tupla;
//  echo "<pre>"; print_r($tupula); echo "</pre>"; exit;


$conn->query($query);

    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }

    $rows = $conn->num_rows();
    $historico=0;

    if ($rows < 1) {

      $historico = 1;

      // FLORIANOPOLIS
      if ($ID_CIDADE==8105) {
	      $tabela="IMPORTACAO.EDIFICACOES_FLO";
	      $query="";
      } 
      
      // CAPINZAL
      elseif ($ID_CIDADE==8075) {
	      $tabela="IMPORTACAO.EDIFICACOES_CNZ";
	      $query="";
      } 
      
      // BRUSQUE
      elseif ($ID_CIDADE==8055) {
	      $tabela="IMPORTACAO.EDIFICACOES_BQE";
	      $query="";
      } 
      
      // ITAPIRANGA
      elseif ($ID_CIDADE==8165) {
	      $tabela="IMPORTACAO.EDIFICACOES_IPX";
	      $query="";
      } 
      
      // PORTO UNIAO
      elseif ($ID_CIDADE==8267) {
	      $tabela="IMPORTACAO.EDIFICACOES_PUN";
	      $query="";
      } 
      
      // RIO NEGRINHO
      elseif ($ID_CIDADE==8295) {
	      $tabela="IMPORTACAO.EDIFICACOES_RIN";
	      $query="";
      } 
      
      // SAO MIGUEL
      elseif ($ID_CIDADE==8339) {
	      $tabela="IMPORTACAO.EDIFICACOES_SGE";
	      $query="";
      } 
      
      // SAO JOAQUIM
      elseif ($ID_CIDADE==8325) {
	      $tabela="IMPORTACAO.EDIFICACOES_SJQ";
	      $query="";
      } 
      
      // TIJUCAS
      elseif ($ID_CIDADE==8355) {
	      $tabela="IMPORTACAO.EDIFICACOES_TIJ";
	      $query="";
      } 
      
      // TUBARAO
      elseif ($ID_CIDADE==8367) {
	      $tabela="IMPORTACAO.EDIFICACOES_TRO";
	      $query="";
      }
      
      // CURITIBANOS
      elseif ($ID_CIDADE==8093) {
	      $tabela="IMPORTACAO.EDIFICACOES_CBS";
	      $query="";
      } 
      
      // LAGUNA
      elseif ($ID_CIDADE==8185) {
	      $tabela="IMPORTACAO.EDIFICACOES_LGA";
	      $query="";	
      } 
      
      // ORLEANS
      elseif ($ID_CIDADE==8229) {
	      $tabela="IMPORTACAO.EDIFICACOES_OLS";
	      $query="";
      } 
      
      // SAO JOSE
      elseif ($ID_CIDADE==8327) {
	      $tabela="IMPORTACAO.EDIFICACOES_SOO";
	      $query="";
      } 
      
      // GASPAR
      elseif ($ID_CIDADE==8117) {
	      $tabela="IMPORTACAO.EDIFICACOES_GPR";
	      $query="";
      } 
      
      // CHAPECO
      elseif ($ID_CIDADE==8081) {
	      $tabela="IMPORTACAO.EDIFICACOES_CCO";
	      $query="";
      } 
      
      // LAGES
      elseif ($ID_CIDADE==8183) {
	      $tabela="IMPORTACAO.EDIFICACOES_LGS";
	      $query="";
      } 
      
      // SAO BENTO DO SUL
      elseif ($ID_CIDADE==8311) {
	      $tabela="IMPORTACAO.EDIFICACOES_SBS";
	      $query="";
      } 
      
      // MAFRA
      elseif ($ID_CIDADE==8199) {
	      $tabela="IMPORTACAO.EDIFICACOES_MRA";
	      $query="";
      } 
      
      // BALNEARIO CAMBORIU
      elseif ($ID_CIDADE==8039) {
	      $tabela="IMPORTACAO.EDIFICACOES_BCU";
	      $query="";
      } 
      
      // BOMBINHAS
      elseif ($ID_CIDADE==5537) {
	      $tabela="IMPORTACAO.EDIFICACOES_BOMB";
	      $query="";	
      } 
      
      // BLUMENAU
      elseif ($ID_CIDADE==8047) {
	      $tabela="IMPORTACAO.EDIFICACOES_BNU";
	      $query="";
      }  
      
      // CAMBORIU
      elseif ($ID_CIDADE==8061) {
	      $tabela="IMPORTACAO.EDIFICACOES_CBW";
	      $query="";
      }				      

      //falta itajai (iai), rio do sul (rsl),canoinhas (cni),itapema (iea),

      // ITAJAÍ
      elseif ($ID_CIDADE==8161) {
	      $tabela="IMPORTACAO.EDIFICACOES_IAI";
	      $query="";
      }
      
      // RIO DO SUL				      
      elseif ($ID_CIDADE==8291) {
	      $tabela="IMPORTACAO.EDIFICACOES_RSL";
	      $query="";
      }
      
      // CANOINHAS				      
      elseif ($ID_CIDADE==8073) {
	      $tabela="IMPORTACAO.EDIFICACOES_CNI";
	      $query="";
      }
      
      // ITAPEMA				      
      elseif ($ID_CIDADE==8163) {
	      $tabela="IMPORTACAO.EDIFICACOES_IEA";
	      $query="";
      }				      
      
    	if ($query=="") {
        $query="SELECT ANALISTA,
                       AREACONSTRUIDAm2 AS VL_AREA_CONSTRUIDA,
                       ATERRAMPARARAIOS,
                       IF(CLASSEEDIFICACAO IN (3,4,5,6,7),6,IF(CLASSEEDIFICACAO IN (8,9,10,11,57),7,IF(CLASSEEDIFICACAO IN (15,16,17,18,19,20),11,IF(CLASSEEDIFICACAO IN (21,22,23,24,25),12,IF(CLASSEEDIFICACAO IN (26,27,28),13,IF(CLASSEEDIFICACAO IN (29,30,31,32),14,IF(CLASSEEDIFICACAO IN (33,34,35,36,37,38,39,40,41,42,43,44,45),15,IF(CLASSEEDIFICACAO IN (46,47,48,49,50,51,52,53),16,IF(CLASSEEDIFICACAO IN (54,55),17,IF(CLASSEEDIFICACAO =56,18,IF(CLASSEEDIFICACAO =1,2,IF(CLASSEEDIFICACAO =2,1,IF(CLASSEEDIFICACAO =12,8,IF(CLASSEEDIFICACAO =13,9,IF(CLASSEEDIFICACAO=14,10,''))))))))))))))) AS ID_OCUPACAO,
                       REPLACE(REPLACE(REPLACE(REPLACE(CNPJCPFPROPIETARIO,'.',''),'/',''),' ',''),'-','') AS ID_CNPJ_CPF_PROPRIETARIO,
                       COMPLEMENTO AS NM_COMPLEMENTO,
                       ESTADODOIMOVEL,
                       FANTASIA1 AS NM_FANTASIA_1,
                       FANTASIA2 AS NM_FANTASIA_2,
                       (SELECT ID_TP_LOGRADOURO FROM ".TBL_TP_LOGRADOURO." WHERE NM_TP_LOGRADOURO=UPPER(TIPOLOGRADOURO)) AS ID_TP_LOGRADOURO,
                       UPPER(TIPOLOGRADOURO) AS NM_TP_LOGRADOURO,
                       REPLACE(REPLACE(REPLACE(CEP,' ',''),'-',''),'.','') AS ID_CEP,
                       UPPER(NOMELOGRADOURO) AS NM_LOGRADOURO,
                       UPPER(NOMEBAIRRO) AS NM_BAIRROS,
                       (SELECT ID_CIDADE FROM ".TBL_CIDADE." WHERE NM_CIDADE=UPPER(NOMECIDADE)) AS ID_CIDADE,
                       NOMEEDIFICACAO AS NM_EDIFICACAO,
                       NUMDEBLOCOS AS NR_BLOCOS,
                       NUMEDIFICACAO AS NR_EDIFICACAO,
                       NUMPAVIMENTOS AS NR_PAVIMENTOS,
                       PROPRIETARIO AS NM_PESSOA,
                       IF(RISCOEDIFICACAO IN (1,4,5),1,RISCOEDIFICACAO) AS ID_RISCO,
                       IF(SITUACAOEDIFICACAO IN (2,3),1,IF(SITUACAOEDIFICACAO=1,3,SITUACAOEDIFICACAO)) AS ID_SITUACAO,
                       IF(TIPOCONSTRUCAO=3,4,IF(TIPOCONSTRUCAO=4,3,IF(TIPOCONSTRUCAO=5,1,TIPOCONSTRUCAO))) AS ID_TP_CONSTRUCAO,
                       iagID AS ID_EDIFICACAO
                  FROM $tabela
                 WHERE iagID=$ID_EDIFICACAO";
      }
    }

		$conn->query($query);
		if ($conn->get_status()==false) {
			die($conn->get_msg());
		}
	    $rows=$conn->num_rows();

    if ($rows>0) {
      $tupula = $conn->fetch_row();
      if (isset($tupula['ID_CIDADE'])) {
        $ID_CIDADE=$tupula['ID_CIDADE'];
      }

//echo "<pre>"; print_r($tupula); echo "</pre>"; exit;


?>

<script language="javascript" type="text/javascript">

var frm = window.opener.document.frm_edificacao;

	<? if ($historico == 0) { ?>
 
		if (window.opener.confirm("Existe Registro para esta Edificação. Deseja Carregar?")) {
			frm.btn_incluir.value="Alterar";
			frm.hdn_controle.value="2";

	<? } else { ?>

		if (window.opener.confirm("Exite Registro HISTÓRICO para esta Edificação. Deseja Carregar?")) {
	
	<? } ?>



	<? if ($tupula['CH_SIS_PREVENTIVO_EXTINTOR'] == 'S') { ?>
		frm.rdo_ch_extintor[0].checked = "true";
	<? } ?>
	
	   frm.chk_ch_glp.disabled= false;	
	<? if ($tupula['CH_COMB_GLP'] == 'S') { ?>
		frm.chk_ch_glp.checked = true;
	<? } elseif ($tupula['CH_COMB_GLP'] == 'N') { ?>
		frm.chk_ch_glp.checked = false;
	<? } ?>

frm.chk_ch_gn.disabled= false;			
	<? if ($tupula['CH_COMB_GN'] == 'S') { ?>
		frm.chk_ch_gn.checked = true;
	<? } elseif ($tupula['CH_COMB_GN'] == 'N') { ?>
		frm.chk_ch_gn.checked = false;
	<? } ?>


	frm.chk_ch_sprinkler.disabled = false;
	<? /*if ($tupula['CH_SPRINKLER'] == 'S') { ?>
		frm.chk_ch_sprinkler.checked = true;
	<? } elseif ($tupula['CH_SPRINKLER'] == 'N') { ?>
		frm.chk_ch_sprinkler.checked = false;
	<? } */?>


    <?if($tupula['CH_SPRINKLER'] == 'S') { ?>
		frm.chk_ch_sprinkler.checked = true;
	<? } elseif ($tupula['CH_SPRINKLER'] == 'N') { ?>
		frm.chk_ch_sprinkler.checked = false;
	<? } ?>
	
frm.chk_ch_mulsyfire.disabled = false;
	<? if ($tupula['CH_MULSYFIRE'] == 'S') { ?>
		frm.chk_ch_mulsyfire.checked = true;
	<? } elseif ($tupula['CH_MULSYFIRE'] == 'N') { ?>
		frm.chk_ch_mulsyfire.checked = false;
	<? } ?>

	<? if ($tupula['CH_FIXO_CO2'] == 'S') { ?>
frm.chk_ch_co2.checked = true;
	<? } elseif ($tupula['CH_FIXO_CO2'] == 'N') { ?>
		frm.chk_ch_co2.checked = false;
	<? } ?>

	<? if ($tupula['DE_OUTROS']) { ?>
frm.chk_outros.disabled = false;
frm.chk_outros.checked = true;
	<? } else { ?>
		frm.chk_outros.checked = false;
	<? }?>
frm.chk_ch_ancora_cabo.disabled = false;		
	<? if ($tupula['CH_ANCORA_CABO'] == 'S') { ?>
frm.chk_ch_ancora_cabo.checked = true;
	<? } elseif ($tupula['CH_ANCORA_CABO'] == 'N') { ?>
		frm.chk_ch_ancora_cabo.checked = false;
	<? } ?>

    <? if ($tupula['NR_ESCADA_COMUM'] > 0 ) { ?>
		frm.chk_esc_comum.disabled = false;
		frm.chk_esc_comum.checked = true;
    <? } else { ?>
       frm.chk_esc_comum.checked = false;
    <? } ?>

<? if ($tupula['NR_ESCADA_PROTEGIDA'] > 0 ) { ?>
frm.chk_esc_protegida.disabled = false;				 
frm.chk_esc_protegida.checked = true;
  <? } else { ?>
     frm.chk_esc_protegida.checked = false;
    <? } ?>

 
<? if ($tupula['NR_ESCADA_ENC'] > 0 ) { ?>
frm.chk_esc_enclausurada.disabled = false;				 	
frm.chk_esc_enclausurada.checked = true;
  <? } else { ?>
     frm.chk_esc_enclausurada.checked = false;
    <? } ?>


 
<? if ($tupula['NR_ESCADA_PROVA_FUMACA'] > 0 ) { ?>
frm.chk_esc_fumaca.disabled = false;				 	
frm.chk_esc_fumaca.checked = true;
  <? } else { ?>
     frm.chk_esc_fumaca.checked = false;
    <? } ?>


 
<? if ($tupula['NR_ESCADA_PRESSU'] > 0 ) { ?>
frm.chk_esc_pres.disabled = false;				 		 
frm.chk_esc_pres.checked = true;
  <? } else { ?>
     frm.chk_esc_pres.checked = false;
    <? } ?>


 
<? if ($tupula['NR_RAMPA'] > 0 ) { ?>
frm.chk_rampa.disabled = false;				 		 	
 frm.chk_rampa.checked = true;
  <? } else { ?>
     frm.chk_rampa.checked = false;
    <? } ?>


 
<? if ($tupula['NR_ELEV_EMERGENCIA'] > 0 ) { ?>
frm.chk_elev_emergencia.disabled = false;				 		 		 
frm.chk_elev_emergencia.checked = true;
  <? } else { ?>
     frm.chk_elev_emergencia.checked = false;
    <? } ?>


 
<? if ($tupula['NR_RESG_AEREO'] > 0 ) { ?>
frm.chk_resg_aereo.disabled = false;				 		 		 	 
frm.chk_resg_aereo.checked = true;
  <? } else { ?>
     frm.chk_resg_aereo.checked = false;
    <? } ?>


<? if ($tupula['NR_PQS'] > 0 ) { ?>
frm.chk_pqs.disabled = false;				 		 		 	 	 
frm.chk_pqs.checked = true;
  <? } else { ?>
     frm.chk_pqs.checked = false;
    <? } ?>

<? if ($tupula['NR_AGUA'] > 0 ) { ?>
frm.chk_agua.disabled = false;				 		 		 	 	 
frm.chk_agua.checked = true;
  <? } else { ?>
     frm.chk_agua.checked = false;
    <? } ?>

<? if ($tupula['NR_ESPUMA'] > 0 ) { ?>
frm.chk_espuma.disabled = false;				 		 		 	 	 
frm.chk_espuma.checked = true;
  <? } else { ?>
     frm.chk_espuma.checked = false;
    <? } ?>

<? if ($tupula['NR_CO2'] > 0 ) { ?>
frm.chk_co2.disabled = false;				 		 		 	 	 
frm.chk_co2.checked = true;
  <? } else { ?>
     frm.chk_co2.checked = false;
    <? } ?>

 <? if ($tupula['NR_DETEC_FUMACA'] > 0 ) { ?>
 frm.chk_dec_fumaca.disabled = false;				 		 		 	 	 
 frm.chk_dec_fumaca.checked = true;
   <? } else { ?>
     frm.chk_pqs.checked = false;
     <? } ?>
 
 <? if ($tupula['NR_DETEC_VEL'] > 0 ) { ?>
 frm.chk_dec_termo.disabled = false;				 		 		 	 	 
 frm.chk_dec_termo.checked = true;
   <? } else { ?>
      frm.chk_pqs.checked = false;
     <? } ?>

 <? if ($tupula['NR_DETEC_QMC'] > 0 ) { ?>
 frm.chk_dec_quimico.disabled = false;				 		 		 	 	 
 frm.chk_dec_quimico.checked = true;
   <? } else { ?>
      frm.chk_pqs.checked = false;
     <? } ?>

<? if ($tupula['NR_PONTOS'] > 0 ) { ?>
 frm.chk_acioanamento.disabled = false;				 		 		 	 	 
 frm.chk_acioanamento.checked = true;
   <? } else { ?>
      frm.chk_pqs.checked = false;
     <? } ?>

                                        
<? if ($tupula['NR_PASSARELA'] > 0 ) { ?>
frm.chk_passarela.disabled = false;				 		 		 	 	 
frm.chk_passarela.checked = true;
  <? } else { ?>
     frm.chk_passarela.checked = false;
    <? } ?>

 <? if ($tupula['ID_TP_RECIPIENTE']) if ($tupula['ID_TP_RECIPIENTE']> 0) { ?>
	frm.rdo_gas_can[0].checked = true;
  <? } else { ?>
	frm.rdo_gas_can[1].checked = false;
    <? } ?>

<? if ($tupula['ID_TP_INSTALACAO'] > 0) { ?>
	frm.rdo_gas_can[0].checked = true;
  <? } else { ?>
	frm.rdo_gas_can[1].checked = false;
    <? } ?>

  <?/* if ($tupula['$ID_TP_RECIPIENTE'] > 0 ) { ?>
 		frm.cmb_qt_glp.disabled = false;
  <? } */ ?>

frm.cmb_id_iluminacao_emergencia.value="<?=@$tupula['ID_ILU_EMERG']?>";
frm.cmb_id_iluminacao_emergencia.disabled = false;	


<? if ($tupula['ID_ILU_EMERG']) {?>
	
     <? $saida_emergencia = '1'; ?>
	 <? if ($tupula['ID_ILU_EMERG']) if ($tupula['ID_ILU_EMERG'] > 0) $saida_emergencia = '0'; ?>
      	frm.rdo_ilu_emergencia[<?=$saida_emergencia?>].checked = true;
  <?}?>


	frm.cmb_id_aducao.disabled = false;  
	frm.cmb_id_aducao.value="<?=@$tupula['ID_ADUCAO']?>";

   <? if ($tupula['ID_ADUCAO'] > 0) $saida_emergencia = '0'; ?>
	
	frm.cmb_id_tp_instalacao.disabled = false;
	frm.cmb_id_tp_instalacao.value="<?=@$tupula['ID_TP_INSTALACAO']?>";
	frm.chk_ch_gn.disabled= false;			
	<? if ($tupula['CH_COMB_GN'] == 'S') { ?>
		frm.chk_ch_gn.checked = true;
	<? } elseif ($tupula['CH_COMB_GN'] == 'N') { ?>
		frm.chk_ch_gn.checked = false;
	<? } ?>
		

	<? if ($tupula['ID_ADUCAO']) { ?>
		<? if ($tupula['ID_ADUCAO'] > 0) $saida_emergencia = '0'; else $saida_emergencia = '1'; ?>
		frm.rdo_hidraulico_preventivo[<?=$saida_emergencia?>].checked = true;
	<? } ?>

  <? if ($tupula['ID_TP_INSTALACAO']) if ($tupula['ID_TP_INSTALACAO'] > 0) $saida_emergencia = '0'; ?>

		frm.cmb_id_recipiente.disabled = false;
		frm.cmb_id_recipiente.value="<?=@$tupula['ID_TP_RECIPIENTE']?>";
   <? if ($tupula['ID_TP_RECIPIENTE']) if ($tupula['ID_TP_RECIPIENTE'] > 0) $saida_emergencia = '0'; ?>

		
  <? if ($tupula['NR_ESCADA_PRESSU'] ||
		$tupula['NR_ESCADA_COMUM'] ||
		$tupula['NR_RAMPA'] ||
		$tupula['NR_ESCADA_PROTEGIDA'] ||
		$tupula['NR_ELEV_EMERGENCIA'] ||
		$tupula['NR_ESCADA_ENC'] ||
		$tupula['NR_RESG_AEREO'] ||
		$tupula['NR_ESCADA_PROVA_FUMACA'] ||
		$tupula['NR_PASSARELA']
	) { ?>
	<? $saida_emergencia = '1'; ?>
		frm.cmb_nr_pressurizada.disabled = false;	
		frm.cmb_nr_pressurizada.value="<?=@$tupula['NR_ESCADA_PRESSU']?>";
	<? if ($tupula['NR_ESCADA_PRESSU']) if ($tupula['NR_ESCADA_PRESSU'] > 0) $saida_emergencia = '0'; ?>
		frm.cmb_nr_escada_comum.disabled = false;	
	frm.cmb_nr_escada_comum.value="<?=@$tupula['NR_ESCADA_COMUM']?>";
	<? if ($tupula['NR_ESCADA_COMUM'] > 0) $saida_emergencia = '0'; ?>
		frm.cmb_nr_rampa.disabled = false;		
		frm.cmb_nr_rampa.value="<?=@$tupula['NR_RAMPA']?>";
	<? if ($tupula['NR_RAMPA'] > 0) $saida_emergencia = '0'; ?>
		frm.cmb_nr_protegida.disabled = false;		
		frm.cmb_nr_protegida.value="<?=@$tupula['NR_ESCADA_PROTEGIDA']?>";
	<? if ($tupula['NR_ESCADA_PROTEGIDA'] > 0) $saida_emergencia = '0'; ?>
		frm.cmb_nr_elev_emerg.disabled = false;		
		frm.cmb_nr_elev_emerg.value="<?=@$tupula['NR_ELEV_EMERGENCIA']?>";
	<? if ($tupula['NR_ELEV_EMERGENCIA'] > 0) $saida_emergencia = '0'; ?>
		frm.cmb_nr_enclausurada.disabled = false;		
		frm.cmb_nr_enclausurada.value="<?=@$tupula['NR_ESCADA_ENC']?>";
	<? if ($tupula['NR_ESCADA_ENC'] > 0) $saida_emergencia = '0'; ?>
		frm.cmb_nr_reg_aereo.disabled = false;		
		frm.cmb_nr_reg_aereo.value="<?=@$tupula['NR_RESG_AEREO']?>";
	<? if ($tupula['NR_RESG_AEREO'] > 0) $saida_emergencia = '0'; ?>
		frm.cmb_nr_esc_fumaca.disabled = false;		
		frm.cmb_nr_esc_fumaca.value="<?=@$tupula['NR_ESCADA_PROVA_FUMACA']?>";
	<? if ($tupula['NR_ESCADA_PROVA_FUMACA'] > 0) $saida_emergencia = '0'; ?> 
		frm.cmb_nr_passarela.disabled = false;		
		frm.cmb_nr_passarela.value="<?=@$tupula['NR_PASSARELA']?>";  
	<? if ($tupula['NR_PASSARELA'] > 0) $saida_emergencia = '0'; ?>
		frm.rdo_saida_emergencia.disabled = false;		
		frm.rdo_saida_emergencia[<?=$saida_emergencia?>].checked = true;
  <? } ?>


 
<? if ($tupula['NR_PQS'] || $tupula['NR_AGUA'] ||$tupula['NR_ESPUMA'] || $tupula['NR_CO2']) { ?>
	<? $saida_emergencia = '1'; ?>
 	frm.cmb_nr_pqs.disabled = false;	
	frm.cmb_nr_pqs.value="<?=@$tupula['NR_PQS']?>";
	<? if ($tupula['NR_PQS']) if ($tupula['NR_PQS'] > 0) $saida_emergencia = '0'; ?>
	frm.cmb_agua.disabled = false;	
    frm.cmb_agua.value="<?=@$tupula['NR_AGUA']?>";
<? if ($tupula['NR_AGUA'] > 0) $saida_emergencia = '0'; ?>
	frm.cmb_espuma.disabled = false;	
	frm.cmb_espuma.value="<?=@$tupula['NR_ESPUMA']?>";
<? if ($tupula['NR_ESPUMA'] > 0) $saida_emergencia = '0'; ?> 
    frm.cmb_co2.disabled = false;	
	frm.cmb_co2.value="<?=@$tupula['NR_CO2']?>";
 <? if ($tupula['NR_CO2'] > 0) $saida_emergencia = '0'; ?>
frm.rdo_ch_extintor.disabled = false;		
frm.rdo_ch_extintor[<?=$saida_emergencia?>].checked = true;
<? } ?>

<? if ($tupula['NR_DETEC_FUMACA'] || $tupula['NR_DETEC_VEL'] ||$tupula['NR_DETEC_QMC'] || $tupula['NR_PONTOS']) { ?>
	<? $saida_emergencia = '1'; ?>
 	frm.cmb_nr_fumaca.disabled = false;	
	frm.cmb_nr_fumaca.value="<?=@$tupula['NR_DETEC_FUMACA']?>";
	<? if ($tupula['NR_DETEC_FUMACA']) if ($tupula['NR_DETEC_FUMACA'] > 0) $saida_emergencia = '0'; ?>
	frm.cmb_nr_velocimetrico.disabled = false;	
    frm.cmb_nr_velocimetrico.value="<?=@$tupula['NR_DETEC_VEL']?>";
<? if ($tupula['NR_DETEC_VEL'] > 0) $saida_emergencia = '0'; ?>
	frm.txa_local_instalados.disabled = false;	
    frm.txa_local_instalados.value="<?=@$tupula['PONTOS_INSTALADOS']?>";
<? if ($tupula['PONTOS_INSTALADOS'] > 0) $saida_emergencia = '0'; ?>
	frm.cmb_dec_quimico.disabled = false;	
	frm.cmb_dec_quimico.value="<?=@$tupula['NR_DETEC_QMC']?>";
<? if ($tupula['NR_DETEC_QMC'] > 0) $saida_emergencia = '0'; ?> 
    frm.cmb_nr_acioanamento.disabled = false;	
	frm.cmb_nr_acioanamento.value="<?=@$tupula['NR_PONTOS']?>";
 <? if ($tupula['NR_PONTOS'] > 0) $saida_emergencia = '0'; ?>
frm.rdo_alarme.disabled = false;		
frm.rdo_alarme[<?=$saida_emergencia?>].checked = true;
<? } ?>
  <? if ($tupula['ID_TP_PARA_RAIO'] or $tupula['ID_TP_CAPTORES'] or $tupula['ID_TP_ATERRAMENTO']) {?>

	<? $saida_emergencia = '1'; ?>
     frm.cmb_id_pararaio.disabled = false;	
	frm.cmb_id_pararaio.value="<?=@$tupula['ID_TP_PARA_RAIO']?>";   
	<? if ($tupula['ID_TP_PARA_RAIO']) if ($tupula['ID_TP_PARA_RAIO'] > 0) $saida_emergencia = '0'; ?>
	frm.cmb_id_captores.disabled = false;

	frm.cmb_id_captores.value="<?=@$tupula['ID_TP_CAPTORES']?>";

	<? if ($tupula['ID_TP_CAPTORES']) if ($tupula['ID_TP_CAPTORES'] > 0) $saida_emergencia = '0'; ?>
	frm.cmb_id_aterramento.disabled = false;
	frm.cmb_id_aterramento.value="<?=@$tupula['ID_TP_ATERRAMENTO']?>";   
	<? if ($tupula['ID_TP_ATERRAMENTO']) if ($tupula['ID_TP_ATERRAMENTO'] > 0) $saida_emergencia = '0'; ?>

	frm.rdo_descarga_admosferica[<?=$saida_emergencia?>].checked = true;

  <?}?>

 <? if ($tupula['ID_TP_ABANDONO']) {?>
	
     <? $saida_emergencia = '1'; ?>
	 
	  frm.cmb_id_abandono.disabled = false;	 
	  frm.cmb_id_abandono.value ="<?=@$tupula['ID_TP_ABANDONO']?>";  
	 <? if ($tupula['ID_TP_ABANDONO']) if ($tupula['ID_TP_ABANDONO'] > 0) $saida_emergencia = '0'; ?>
      	frm.rdo_ch_abandono[<?=$saida_emergencia?>].checked = true;
  <?}?>

  frm.hdn_id_carc_edificacao.value="<?=@$tupula['ID_CARC_EDIFICACAO']?>";
  frm.txt_nm_outros.disabled= false;
  frm.txt_nm_outros.value="<?=@$tupula['DE_OUTROS']?>";      
  frm.txt_id_edificacao.readOnly=true;
  frm.txt_nr_cnpjcpf_proprietario.value="<?=@$tupula['ID_CNPJ_CPF_PROPRIETARIO']?>";
  cpfcnpj(frm.txt_nr_cnpjcpf_proprietario)
  frm.txt_nm_proprietario.value="<?=@$tupula['NM_PESSOA']?>";
  frm.txt_nr_fone_proprietario.value="<?=@$tupula['NR_FONE']?>";
  frm.txt_de_email_proprietario.value="<?=@$tupula['DE_EMAIL_PESSOA']?>";
  frm.txt_id_edificacao.value="<?=@$tupula['ID_EDIFICACAO']?>";
  frm.txt_nm_edificacao.value="<?=@$tupula['NM_EDIFICACAO']?>";
  frm.txt_nm_fantasia_1.value="<?=@$tupula['NM_FANTASIA_1']?>";
  frm.txt_nm_fantasia_2.value="<?=@$tupula['NM_FANTASIA_2']?>";
  frm.hdn_id_tp_logradouro.value="<?=@$tupula['ID_TP_LOGRADOURO']?>";
  frm.txt_nm_tp_logradouro.value="<?=@$tupula['NM_TP_LOGRADOURO']?>";
  frm.hdn_id_logradouro.value="<?=@$tupula['ID_LOGRADOURO']?>";
  frm.txt_nm_logradouro.value="<?=@$tupula['NM_LOGRADOURO']?>";
  frm.txt_nr_edificacao.value="<?=@$tupula['NR_EDIFICACAO']?>";
  frm.hdn_id_cidade.value="<?=@$ID_CIDADE?>";
  frm.cmb_id_cidade.value="<?=@$ID_CIDADE?>";
  frm.txt_nm_bairro.value="<?=@$tupula['NM_BAIRROS']?>";
  frm.hdn_id_cep.value="<?=@$tupula['ID_CEP']?>";
  frm.txt_nr_cep.value="<?=@$tupula['ID_CEP']?>";
  CEP(frm.txt_nr_cep);
  frm.txt_nm_complemento.value="<?=@$tupula['NM_COMPLEMENTO']?>";

frm.cmb_nr_pqs.value="<?=@$tupula['NR_PQS']?>";   
frm.cmb_agua.value="<?=@$tupula['NR_AGUA']?>";   
frm.cmb_espuma.value="<?=@$tupula['NR_ESPUMA']?>";   
frm.cmb_co2.value="<?=@$tupula['NR_CO2']?>";   

frm.cmb_nr_fumaca.value="<?=@$tupula['NR_DETEC_FUMACA']?>";   
frm.cmb_nr_velocimetrico.value="<?=@$tupula['NR_DETEC_VEL']?>";   
frm.cmb_dec_quimico.value="<?=@$tupula['NR_DETEC_QMC']?>";   
frm.cmb_nr_acioanamento.value="<?=@$tupula['NR_PONTOS']?>";   
frm.txa_local_instalados.value="<?=@$tupula['PONTOS_INSTALADOS']?>";   
frm.cmb_qt_gn.value="<?=@$tupula['QTD_GN']?>";   
frm.cmb_qt_glp.value="<?=@$tupula['QTD_GLP']?>";   
  <?
  if (@$tupula['VL_AREA_CONSTRUIDA']=="") {
    $tupula['VL_AREA_CONSTRUIDA']="0.00";
  }
  if (@$tupula['VL_ALTURA']=="") {
    $tupula['VL_ALTURA']="0.00";
  }
  if (@$tupula['VL_AREA_TIPO']=="") {
    $tupula['VL_AREA_TIPO']="0.00";
  }
  ?>
  frm.txt_vl_area_construida.value="<?=str_replace(".",",",$tupula['VL_AREA_CONSTRUIDA'])?>";
  FormatNumero(frm.txt_vl_area_construida);
  decimal(frm.txt_vl_area_construida,2);
  frm.txt_vl_altura.value="<?=str_replace(".",",",$tupula['VL_ALTURA'])?>";
  FormatNumero(frm.txt_vl_altura);
  decimal(frm.txt_vl_altura,2);
  frm.txt_vl_area_pavimento.value="<?=str_replace(".",",",$tupula['VL_AREA_TIPO'])?>";
  FormatNumero(frm.txt_vl_area_pavimento);
  decimal(frm.txt_vl_area_pavimento,2);
  frm.cmb_id_risco.value="<?=@$tupula['ID_RISCO']?>";
  frm.cmb_id_ocupacao.value="<?=@$tupula['ID_OCUPACAO']?>";
  frm.cmb_id_situacao.value="<?=@$tupula['ID_SITUACAO']?>";
  frm.cmb_id_tp_construcao.value="<?=@$tupula['ID_TP_CONSTRUCAO']?>";
  frm.cmb_nr_pavimentos.value="<?=@$tupula['NR_PAVIMENTOS']?>";
  frm.cmb_nr_blocos.value="<?=@$tupula['NR_BLOCOS']?>";

} else {
  frm.txt_id_edificacao.value="";
  frm.txt_nm_edificacao.focus();
}
</script>

<?
    }
  }
  mysql_close();
?>
<script language="javascript" type="text/javascript">
//<!--
//  window.close();
// -->
</script>
</body>
</html>

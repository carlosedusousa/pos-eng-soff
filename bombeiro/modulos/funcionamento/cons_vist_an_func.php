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

  $arquivo="vist_an_func.php";
  
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
    $ID_PROT_ANALISE_FUNC=strtoupper($_GET["campo2"]);
    echo "chegou: ".$ID_PROT_ANALISE_FUNC." and ".$ID_CIDADE;
    $query="SELECT ".TBL_AN_FUNC.".ID_ANALISE_FUNC FROM ".TBL_AN_FUNC." JOIN ".TBL_PROT_AN_FUNC." USING(ID_PROT_ANALISE_FUNC,ID_CIDADE) WHERE ".TBL_PROT_AN_FUNC.".ID_PROT_ANALISE_FUNC=$ID_PROT_ANALISE_FUNC AND ".TBL_PROT_AN_FUNC.".ID_CIDADE=$ID_CIDADE ORDER BY ".TBL_AN_FUNC.".ID_ANALISE_FUNC DESC LIMIT 1";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $analise=$conn->fetch_row();
    $ID_ANALISE_FUNC=$analise["ID_ANALISE_FUNC"];
    $query="SELECT ".TBL_AN_FUNC.".ID_ANALISE_FUNC
, ".TBL_AN_FUNC.".DE_INDEFERIMENTO as DE_OBSERVACOES
, ".TBL_AN_FUNC.".CH_PARECER
, ".TBL_PROT_AN_FUNC.".ID_PROT_ANALISE_FUNC
, ".TBL_PROT_AN_FUNC.".ID_CIDADE
, ".TBL_SOLICITACAO.".ID_SOLICITACAO
, ".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO
, ".TBL_SOLICITACAO.".CH_PAGO
, ".TBL_AN_FUNC.".ID_CNPJ_EMPRESA AS NR_CNPJ_EMPRESA
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
, ".TBL_SOLICITACAO.".CH_PROTOCOLADO
, ".TBL_SOLICITACAO.".DT_SOLICITACAO
, ".TBL_EDIFICACAO.".NR_PAVIMENTOS
, ".TBL_EDIFICACAO.".NR_BLOCOS
, ".TBL_ESTABELECIMENTO.".ID_ESTABELECIMENTO
, ".TBL_ESTABELECIMENTO.".NM_ESTABELECIMENTO AS NM_DESC_FUNC
, ".TBL_ESTABELECIMENTO.".NR_PAVIMENTO
, ".TBL_ESTABELECIMENTO.".NM_BLOCO
, ".TBL_ESTABELECIMENTO.".VL_AREA AS VL_AREA_DESC_FUNC
, ".TBL_CIDADE.".NM_CIDADE
, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO
, ".TBL_AN_FUNC.".CH_SIS_PREVENTIVO_EXTINTOR
, ".TBL_AN_FUNC.".ID_ADUCAO
, ".TBL_AN_FUNC.".CH_COMB_GLP
, ".TBL_AN_FUNC.".ID_TP_RECIPIENTE
, ".TBL_AN_FUNC.".CH_COMB_GN
, ".TBL_AN_FUNC.".ID_TP_INSTALACAO
, ".TBL_AN_FUNC.".ID_TP_ALARME_INCENDIO
, ".TBL_AN_FUNC.".NR_ESCADA_COMUM
, ".TBL_AN_FUNC.".NR_ESCADA_PROTEGIDA
, ".TBL_AN_FUNC.".NR_ESCADA_ENC
, ".TBL_AN_FUNC.".NR_ESCADA_PROVA_FUMACA
, ".TBL_AN_FUNC.".NR_ESCADA_PRESSU
, ".TBL_AN_FUNC.".NR_RAMPA
, ".TBL_AN_FUNC.".NR_ELEV_EMERGENCIA
, ".TBL_AN_FUNC.".NR_RESG_AEREO
, ".TBL_AN_FUNC.".NR_PASSARELA
, ".TBL_AN_FUNC.".ID_TP_PARA_RAIO
, ".TBL_AN_FUNC.".ID_TP_CAPTORES
, ".TBL_AN_FUNC.".ID_TP_ATERRAMENTO
, ".TBL_AN_FUNC.".ID_TP_ABANDONO
, ".TBL_AN_FUNC.".CH_SPRINKLER
, ".TBL_AN_FUNC.".CH_MULSYFIRE
, ".TBL_AN_FUNC.".CH_FIXO_CO2
, ".TBL_AN_FUNC.".CH_ANCORA_CABO
, ".TBL_AN_FUNC.".DE_OUTROS
, ".TBL_AN_FUNC.".ID_ILU_EMERG
, ".TBL_AN_FUNC.".DE_PLANO_ACAO
, IF(".TBL_AN_FUNC.".ID_TP_ABANDONO IS NULL,'N','S') AS CH_ABANDONO
FROM ".TBL_AN_FUNC." LEFT JOIN ".TBL_PROT_AN_FUNC." ON (".TBL_AN_FUNC.".ID_PROT_ANALISE_FUNC=".TBL_PROT_AN_FUNC.".ID_PROT_ANALISE_FUNC AND ".TBL_AN_FUNC.".ID_CIDADE=".TBL_PROT_AN_FUNC.".ID_CIDADE)
 LEFT JOIN ".TBL_PESSOA." ON (".TBL_AN_FUNC.".ID_CNPJ_EMPRESA=".TBL_PESSOA.".ID_CNPJ_CPF AND ".TBL_AN_FUNC.".ID_CIDADE_EMPRESA=".TBL_PESSOA.".ID_CIDADE)
 LEFT JOIN ".TBL_AN_ESTAB." ON (".TBL_AN_FUNC.".ID_ANALISE_FUNC=".TBL_AN_ESTAB.".ID_ANALISE_FUNC AND ".TBL_AN_FUNC.".ID_CIDADE=".TBL_AN_ESTAB.".ID_CIDADE_ANALISE_VIST)
 LEFT JOIN ".TBL_ESTABELECIMENTO." ON (".TBL_AN_ESTAB.".ID_ESTABELECIMENTO=".TBL_ESTABELECIMENTO.".ID_ESTABELECIMENTO AND ".TBL_AN_ESTAB.".ID_EDIFICACAO=".TBL_ESTABELECIMENTO.".ID_EDIFICACAO AND ".TBL_AN_ESTAB.".ID_CIDADE_ESTAB=".TBL_ESTABELECIMENTO.".ID_CIDADE)
 LEFT JOIN ".TBL_EDIFICACAO." ON (".TBL_ESTABELECIMENTO.".ID_EDIFICACAO=".TBL_EDIFICACAO.".ID_EDIFICACAO AND ".TBL_ESTABELECIMENTO.".ID_CIDADE=".TBL_EDIFICACAO.".ID_CIDADE)
 LEFT JOIN ".TBL_SOLICITACAO." ON(".TBL_PROT_AN_FUNC.".ID_SOLICITACAO=".TBL_SOLICITACAO.".ID_SOLICITACAO AND ".TBL_PROT_AN_FUNC.".ID_TIPO_SOLICITACAO=".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO AND ".TBL_PROT_AN_FUNC.".ID_CIDADE=".TBL_SOLICITACAO.".ID_CIDADE)
 LEFT JOIN ".TBL_CIDADE." ON(".TBL_SOLICITACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE)
 LEFT JOIN ".TBL_CEP." ON (".TBL_EDIFICACAO.".ID_CEP=".TBL_CEP.".ID_CEP AND ".TBL_EDIFICACAO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_EDIFICACAO.".ID_CIDADE_CEP=".TBL_CEP.".ID_CIDADE)
 LEFT JOIN ".TBL_LOGRADOURO." ON (".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE)
 LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE)
 LEFT JOIN ".TBL_TP_LOGRADOURO." ON(".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO)
WHERE ".TBL_AN_FUNC.".ID_CIDADE=".$ID_CIDADE." AND ".TBL_AN_FUNC.".ID_ANALISE_FUNC=".$ID_ANALISE_FUNC;
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $row_solicita=$conn->num_rows();
    $count=1;
    if ($row_solicita>0) {
      while ($solicitacao=$conn->fetch_row()) {
        if ($count==1) {
          $ID_ANALISE_FUNC=$solicitacao["ID_ANALISE_FUNC"];
          $ID_CIDADE=$solicitacao["ID_CIDADE"];
          $NM_RAZAO_SOCIAL                    =$solicitacao["NM_RAZAO_SOCIAL"];
          $NR_FONE_EMPRESA         =$solicitacao["NR_FONE_EMPRESA"];
          $NM_CONTATO=$solicitacao["NM_CONTATO"];
          $NM_FANTASIA_EMPRESA=$solicitacao["NM_FANTASIA_EMPRESA"];
          $NR_CNPJ_EMPRESA    =$solicitacao["NR_CNPJ_EMPRESA"];
          $DE_EMAIL_EMPRESA       =$solicitacao["DE_EMAIL_EMPRESA"];
          $NM_EDIFICACOES                    =$solicitacao["NM_EDIFICACOES"];
          $NM_LOGRADOURO                  =$solicitacao["NM_LOGRADOURO"];
          $NR_EDIFICACAO                      =$solicitacao["NR_EDIFICACOES"];
          $NM_BAIRRO                              =$solicitacao["NM_BAIRRO"];
          $NR_CEP                                      =$solicitacao["NR_CEP"];
          $NM_CIDADE                              =$solicitacao["NM_CIDADE"];
          $NM_COMPLEMENTO               =$solicitacao["NM_COMPLEMENTO"];
          $VL_AREA_CONSTRUIDA          =$solicitacao["VL_AREA_CONSTRUIDA"];
          $VL_VISTORIA            ="0.00";//$solicitacao["VL_VISTORIA"];
          $NM_CIDADE                              =$solicitacao["NM_CIDADE"];
          $NM_TP_LOGRADOURO            =$solicitacao["NM_TP_LOGRADOURO"];
          $ID_TIPO_SOLICITACAO            =$solicitacao["ID_TIPO_SOLICITACAO"];
          $ID_SOLICITACAO                       =$solicitacao["ID_SOLICITACAO"];
          $ID_PROT_ANALISE_FUNC                         =$solicitacao["ID_PROT_ANALISE_FUNC"];
          //$CH_TP_FUNC=$solicitacao["CH_TP_FUNC"];
          $ID_EDIFICACAO=$solicitacao["ID_EDIFICACAO"];
          $CH_PARECER=$solicitacao["CH_PARECER"];
          $CH_SIS_PREVENTIVO_EXTINTOR=$solicitacao["CH_SIS_PREVENTIVO_EXTINTOR"];
          $NR_ESCADA_COMUM=$solicitacao["NR_ESCADA_COMUM"];
          $NR_ESCADA_PROTEGIDA=$solicitacao["NR_ESCADA_PROTEGIDA"];
          $NR_ESCADA_ENC=$solicitacao["NR_ESCADA_ENC"];
          $NR_ESCADA_PROVA_FUMACA=$solicitacao["NR_ESCADA_PROVA_FUMACA"];
          $NR_ESCADA_PRESSU=$solicitacao["NR_ESCADA_PRESSU"];
          $NR_RAMPA=$solicitacao["NR_RAMPA"];
          $NR_ELEV_EMERGENCIA=$solicitacao["NR_ELEV_EMERGENCIA"];
          $NR_RESG_AEREO=$solicitacao["NR_RESG_AEREO"];
          $NR_PASSARELA=$solicitacao["NR_PASSARELA"];
          $ID_TP_ALARME_INCENDIO=$solicitacao["ID_TP_ALARME_INCENDIO"];
          $ID_ADUCAO=$solicitacao["ID_ADUCAO"];
          $CH_COMB_GLP=$solicitacao["CH_COMB_GLP"];
          $ID_TP_RECIPIENTE=$solicitacao["ID_TP_RECIPIENTE"];
          $CH_COMB_GN=$solicitacao["CH_COMB_GN"];
          $ID_TP_INSTALACAO=$solicitacao["ID_TP_INSTALACAO"];
          $ID_TP_PARA_RAIO=$solicitacao["ID_TP_PARA_RAIO"];
          $ID_TP_CAPTORES=$solicitacao["ID_TP_CAPTORES"];
          $ID_TP_ATERRAMENTO=$solicitacao["ID_TP_ATERRAMENTO"];
          $ID_TP_ABANDONO=$solicitacao["ID_TP_ABANDONO"];
          $CH_ABANDONO=$solicitacao["CH_ABANDONO"];
          $CH_SPRINKLER=$solicitacao["CH_SPRINKLER"];
          $CH_MULSYFIRE=$solicitacao["CH_MULSYFIRE"];
          $CH_FIXO_CO2=$solicitacao["CH_FIXO_CO2"];
          $CH_ANCORA_CABO=$solicitacao["CH_ANCORA_CABO"];
          $DE_OUTROS=$solicitacao["DE_OUTROS"];
          $DE_PLANO_ACAO=str_replace("\"","\\\"",str_replace("\n","^",str_replace("\r","",trim($solicitacao["DE_PLANO_ACAO"]))));
           //$DE_PLANO_ACAO=str_replace("\r","",$DE_PLANO_ACAO);
          if (strpos($DE_PLANO_ACAO,"^")>(-1)) {
            $de_plano=explode("^",$DE_PLANO_ACAO);
          } else {
            $de_plano[0]=str_replace("^","\\n",$solicitacao["DE_PLANO_ACAO"]);
          }
//          echo "aqui :".$DE_PLANO_ACAO,"^"."<==>".$solicitacao["DE_PLANO_ACAO"]."<>".implode("|",$de_plano);
          $ID_ILU_EMERG=$solicitacao["ID_ILU_EMERG"];
          $DE_OBSERVACOES=str_replace("\"","\\\"",str_replace("\n","^",str_replace("\r","",$solicitacao["DE_OBSERVACOES"])));
          if (strpos($DE_OBSERVACOES,"^")>(-1)) {
            $de_obs=explode("^",$DE_OBSERVACOES);
          } else {
            $de_obs[0]=str_replace("^","\\n",$solicitacao["DE_OBSERVACOES"]);
          }
//          $DE_OBSERVACOES=str_replace("\n","\\n",str_replace("\r","\\r",$solicitacao["DE_OBSERVACOES"]));
?>
<script language="javascript" type="text/javascript">//<!--
var frm=window.opener.document.frm_vist_an_func;
if (window.opener.confirm("Exite Registro para esta Rotina. Deseja Carregar?")) {
  frm.btn_incluir.disabled=false;
  frm.btn_incluir;
  frm.btn_incluir.value="Alterar";
  frm.hdn_controle.value="2";
//  frm.txt_id_.readOnly=true;
  frm.hdn_id_vist_func.value="<?=$ID_ANALISE_FUNC?>";
  frm.txt_id_prot_funcionamento.readOnly=true;
  frm.txt_id_prot_funcionamento.value="<?=$ID_PROT_ANALISE_FUNC?>";
  frm.hdn_id_tp_sol_funcionamento.value="<?=$ID_TIPO_SOLICITACAO?>";
  frm.hdn_id_sol_funcionamento.value="<?=$ID_SOLICITACAO?>";
  frm.txt_id_edificacao.value="<?=$ID_EDIFICACAO?>";
  frm.txt_nm_razao_social.value="<?=$NM_RAZAO_SOCIAL?>";
  frm.txt_nm_razao_social.readOnly=true;
  frm.txt_nr_fone_empresa.value="<?=$NR_FONE_EMPRESA?>";
  frm.txt_nr_fone_empresa.readOnly=true;
  frm.txt_nr_cnpj_empresa.value="<?=$NR_CNPJ_EMPRESA?>";
  cpfcnpj(frm.txt_nr_cnpj_empresa);
  frm.txt_nr_cnpj_empresa.readOnly=true;
  frm.txt_de_email_empresa.value="<?=$DE_EMAIL_EMPRESA?>";
  frm.txt_de_email_empresa.readOnly=true;
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
  frm.cmb_id_cidade.value="<?=$ID_CIDADE?>";
  frm.txt_nm_cidade.value="<?=$NM_CIDADE?>";
  frm.txt_nm_tp_logradouro.value="<?=$NM_TP_LOGRADOURO?>";
  //frm.hdn_mtv_indeferimento.value=1;
  //frm.txt_vl_area_vistoriada.value="<?=str_replace(".",",",$VL_VISTORIA)?>";
  //FormatNumero(frm.txt_vl_area_vistoriada);
  //decimal(frm.txt_vl_area_vistoriada,2);
  //frm.cmb_ch_tp_funcionamento.value="<?=@$CH_TP_FUNC?>";
  frm.cmb_ch_parecer.value="<?=$CH_PARECER?>";
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
?>
  frm.cmb_id_tp_detc_incendio.value="<?=$ID_TP_ALARME_INCENDIO?>";
<?
    if (($CH_SIS_PREVENTIVO_EXTINTOR=="")||($CH_SIS_PREVENTIVO_EXTINTOR=="NULL")) { $CH_SIS_PREVENTIVO_EXTINTOR="N"; }
    
?>
  radio_ed(frm.rdo_ch_extintor,"<?=$CH_SIS_PREVENTIVO_EXTINTOR?>");
  frm.hdn_ctr_extintor.value="<?=$CH_SIS_PREVENTIVO_EXTINTOR?>";
  <?
     if  ($ID_ADUCAO!="") { 
  ?>
      radio_ed(frm.rdo_hidraulico_preventivo,"S");
      frm.cmb_id_aducao.disabled=false;
      frm.cmb_id_aducao.value="<?=$ID_ADUCAO?>";
      frm.hdn_ctr_aducao.value="<?=$ID_ADUCAO?>";
  <? 
    } else {
  ?>
      radio_ed(frm.rdo_hidraulico_preventivo,"N");
      frm.hdn_ctr_aducao.value="N";
  <?
    }
    if ((($CH_COMB_GLP!="")||($CH_COMB_GN!=""))&&(($CH_COMB_GLP!="N")||($CH_COMB_GN!="N"))) { 
  ?>
    radio_ed(frm.rdo_gas_can,"S");
    frm.hdn_ctr_gas.value="S";
    frm.chk_ch_gn.disabled=false;
    frm.chk_ch_glp.disabled=false;
  <? 
      if (trim($ID_TP_RECIPIENTE)!="") { 
  ?>
        check_ed(frm.chk_ch_glp,"<?=$CH_COMB_GLP?>");
        frm.cmb_id_recipiente.disabled=false;
        frm.cmb_id_recipiente.value="<?=$ID_TP_RECIPIENTE?>";
        frm.hdn_ctr_gas.value="<?=$ID_TP_RECIPIENTE?>";
  <?
      }
      if (trim($ID_TP_INSTALACAO)!="") {
  ?>
        check_ed(frm.chk_ch_gn,"<?=$CH_COMB_GN?>");
        frm.cmb_id_tp_instalacao.disabled=false;
        frm.cmb_id_tp_instalacao.value="<?=$ID_TP_INSTALACAO?>";
        frm.hdn_ctr_gas.value="<?=$ID_TP_INSTALACAO?>";
  <?
      }
    } else {
  ?>
    radio_ed(frm.rdo_gas_can,"N");
    frm.hdn_ctr_gas.value="N";
  <?
    }
    if ($ID_ILU_EMERG!="") {
  ?>
      radio_ed(frm.rdo_ilu_emergencia,"S");
      frm.cmb_id_iluminacao_emergencia.disabled=false;
      frm.cmb_id_iluminacao_emergencia.value="<?=$ID_ILU_EMERG?>";
      frm.hdn_ctr_iluminacao.value="<?=$ID_ILU_EMERG?>";
  <?
    } else {
  ?>
      radio_ed(frm.rdo_ilu_emergencia,"N");
      frm.hdn_ctr_iluminacao.value="N";
  <?
    }
    if (($NR_ESCADA_COMUM>0) || ($NR_ESCADA_PROTEGIDA>0) || ($NR_ESCADA_ENC>0) || ($NR_ESCADA_PROVA_FUMACA>0) || ($NR_ESCADA_PRESSU>0) || ($NR_RAMPA>0) || ($NR_ELEV_EMERGENCIA>0) || ($NR_RESG_AEREO>0) || ($NR_PASSARELA>0)) {
  ?>
      radio_ed(frm.rdo_saida_emergencia,"S");
      frm.hdn_saida_emergencia.value="N";
  <?
      if ($NR_ESCADA_PRESSU>0) {
  ?>
        frm.chk_esc_pres.disabled=false;
        check_ed(frm.chk_esc_pres,"S");
        frm.cmb_nr_pressurizada.disabled=false;
        frm.cmb_nr_pressurizada.value="<?=$NR_ESCADA_PRESSU?>";
  <?
      }
      if ($NR_ESCADA_COMUM>0) {
  ?>
        frm.chk_esc_comum.disabled=false;
        check_ed(frm.chk_esc_comum,"S");
        frm.cmb_nr_escada_comum.disabled=false;
        frm.cmb_nr_escada_comum.value="<?=$NR_ESCADA_COMUM?>";
  <?
      }
      if ($NR_RAMPA>0) {
  ?>
        frm.chk_rampa.disabled=false;
        check_ed(frm.chk_rampa,"S");
        frm.cmb_nr_rampa.disabled=false;
        frm.cmb_nr_rampa.value="<?=$NR_RAMPA?>";
  <?
      }
      if ($NR_ESCADA_PROTEGIDA>0) {
  ?>
        frm.chk_esc_protegida.disabled=false;
        check_ed(frm.chk_esc_protegida,"S");
        frm.cmb_nr_protegida.disabled=false;
        frm.cmb_nr_protegida.value="<?=$NR_ESCADA_PROTEGIDA?>";
  <?
      }
      if ($NR_ELEV_EMERGENCIA>0) {
  ?>
        frm.chk_elev_emergencia.disabled=false;
        check_ed(frm.chk_elev_emergencia,"S");
        frm.cmb_nr_elev_emerg.disabled=false;
        frm.cmb_nr_elev_emerg.value="<?=$NR_ELEV_EMERGENCIA?>";
  <?
      }
      if ($NR_ESCADA_ENC>0) {
  ?>
        frm.chk_esc_enclausurada.disabled=false;
        check_ed(frm.chk_esc_enclausurada,"S");
        frm.cmb_nr_enclausurada.disabled=false;
        frm.cmb_nr_enclausurada.value="<?=$NR_ESCADA_ENC?>";
  <?
      }
      if ($NR_RESG_AEREO>0) {
  ?>
        frm.chk_resg_aereo.disabled=false;
        check_ed(frm.chk_resg_aereo,"S");
        frm.cmb_nr_reg_aereo.disabled=false;
        frm.cmb_nr_reg_aereo.value="<?=$NR_RESG_AEREO?>";
  <?
      }
      if ($NR_ESCADA_PROVA_FUMACA>0) {
  ?>
        frm.chk_esc_fumaca.disabled=false;
        check_ed(frm.chk_esc_fumaca,"S");
        frm.cmb_nr_esc_fumaca.disabled=false;
        frm.cmb_nr_esc_fumaca.value="<?=$NR_ESCADA_PROVA_FUMACA?>";
  <?
      }
      if ($NR_PASSARELA>0) {
  ?>
        frm.chk_passarela.disabled=false;
        check_ed(frm.chk_passarela,"S");
        frm.cmb_nr_passarela.disabled=false;
        frm.cmb_nr_passarela.value="<?=$NR_PASSARELA?>";
  <?
      }
  ?>
      controle_multiplos(frm,1,'chk_esc_comum','chk_esc_pres','chk_esc_protegida','chk_rampa','chk_esc_enclausurada','chk_elev_emergencia','chk_esc_fumaca','chk_resg_aereo','chk_passarela','cmb_nr_escada_comum','cmb_nr_pressurizada','cmb_nr_protegida','cmb_nr_rampa','cmb_nr_enclausurada','cmb_nr_elev_emerg','cmb_nr_esc_fumaca','cmb_nr_reg_aereo','cmb_nr_passarela')
  <?
    } else {
  ?>
      radio_ed(frm.rdo_saida_emergencia,"N");
      frm.hdn_saida_emergencia.value="N";
  <?
    }
    if (($ID_TP_PARA_RAIO!="") || ($ID_TP_CAPTORES!="") || ($ID_TP_ATERRAMENTO!="")) {
  ?>
  
      radio_ed(frm.rdo_descarga_admosferica,"S");
      frm.cmb_id_pararaio.disabled=false;
      frm.cmb_id_captores.disabled=false;
      frm.cmb_id_aterramento.disabled=false;
      frm.cmb_id_pararaio.value="<?=$ID_TP_PARA_RAIO?>";
      frm.cmb_id_captores.value="<?=$ID_TP_CAPTORES?>";
      frm.cmb_id_aterramento.value="<?=$ID_TP_ATERRAMENTO?>";
      if ((frm.cmb_id_pararaio.value!="") || (frm.cmb_id_captores.value!="") || (frm.cmb_id_aterramento.value!="")) {
        frm.hdn_ctr_raio.value="S";
      }
  <?
    } else {
  ?>
      radio_ed(frm.rdo_descarga_admosferica,"N");
      frm.hdn_ctr_raio.value="N";
  <?
    }
    if ($CH_ABANDONO=="S") {
  ?>
      radio_ed(frm.rdo_ch_abandono,"S");
      frm.cmb_id_abandono.disabled=false;
      frm.cmb_id_abandono.value="<?=$ID_TP_ABANDONO?>";
      frm.hdn_ctr_abandono.value="<?=$ID_TP_ABANDONO?>";
  <?
    } else {
  ?>
      radio_ed(frm.rdo_ch_abandono,"N");
      frm.hdn_ctr_abandono.value="N";
  <?
    }
  ?>
  check_ed(frm.chk_ch_sprinkler,"<?=$CH_SPRINKLER?>");
  check_ed(frm.chk_ch_mulsyfire,"<?=$CH_MULSYFIRE?>");
  check_ed(frm.chk_ch_ancora_cabo,"<?=$CH_ANCORA_CABO?>");
  check_ed(frm.chk_ch_co2,"<?=$CH_FIXO_CO2?>");
  <?
    if ($DE_OUTROS!="") {
  ?>
      check_ed(frm.chk_outros,"S");
      frm.txt_nm_outros.disabled=false;
      frm.txt_nm_outros.value="<?=$DE_OUTROS?>";
  <?
    }
  ?>
  frm.txt_vl_area_vistoriada.value="";
  frm.txa_de_plano.value="<?=$de_plano[0]?>";
  <?
  if (count($de_plano)>1) {
    for ($i=1;$i<count($de_plano);$i++) {
?>
  frm.txa_de_plano.value+="\n";
  frm.txa_de_plano.value+="<?=$de_plano[$i]?>";
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
  ?>
  frm.hdn_id_estab.value="<?=$ID_ESTABELECIMENTO?>^";
  frm.txt_nm_desc_funcionamento_tmp.value="<?=$NM_DESC_FUNC?>";
  frm.txt_nm_bloco_desc_funcionamento_tmp.value="<?=$NM_BLOCO?>";
  // frm.cmb_nr_pavimento_desc_funcionamento_tmp.value="<?=$NR_PAVIMENTO?>";
  frm.txt_vl_desc_funcionamento_tmp.value="<?=str_replace(".",",",$VL_AREA_DESC_FUNC)?>";
  FormatNumero(frm.txt_vl_desc_funcionamento_tmp);
  decimal(frm.txt_vl_desc_funcionamento_tmp,2);
  window.opener.valida_desc_func();

<?
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

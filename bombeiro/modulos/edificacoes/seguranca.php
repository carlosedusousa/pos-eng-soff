<?
 include ('../../templates/head_cons.htm');
?>
<!--
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="seguranca.php";
  
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    $erro=$conn->get_msg();
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

  if (($erro=="")&&(@$_POST["rdo_ch_extintor"]!="") && (@$_POST["rdo_hidraulico_preventivo"]!="")  && (@$_POST["rdo_gas_can"]!="") && (@$_POST["rdo_ilu_emergencia"]!="")  && (@$_POST["rdo_saida_emergencia"]!="")&&(@$_POST["rdo_descarga_admosferica"]!="") && (@$_POST["rdo_ch_abandono"]!="")) {
    
    $ID_CIDADE= formataCampo($_POST["hdn_id_cidade"]);
    $ID_EDIFICACAO= formataCampo($_POST["hdn_id_edificacao"]);
    if ($_POST["hdn_id_carac_edificacao"]=="") {
      $ID_CARC_EDIFICACAO=0;
    } else {
      $ID_CARC_EDIFICACAO=$_POST["hdn_id_carac_edificacao"];
    }
    $CH_ATIVO= "'N'";
    $DT_CARC_EDIFICACAO= "CURDATE()";
    $CH_SIS_PREVENTIVO_EXTINTOR= formataCampo($_POST["rdo_ch_extintor"],"SN");
    $ID_ADUCAO= formataCampo(@$_POST["cmb_id_aducao"]);
    $CH_COMB_GLP= formataCampo(@$_POST["chk_ch_glp"],"SN");
    $ID_TP_RECIPIENTE= formataCampo(@$_POST["cmb_id_recipiente"]);
    $CH_COMB_GN= formataCampo(@$_POST["chk_ch_gn"],"SN");
    $ID_TP_INSTALACAO= formataCampo(@$_POST["cmb_id_tp_instalacao"]);
    //$ID_TP_ALARME_INCENDIO= formataCampo($_POST["cmb"]);
    $NR_ESCADA_COMUM= formataCampo(@$_POST["cmb_nr_escada_comum"],'N','D');
    echo "aqui 0:".@$_POST["cmb_nr_protegida"]."==>".formataCampo(@$_POST["cmb_nr_protegida"],'N','D')."\n<br>";
    $NR_ESCADA_PROTEGIDA= formataCampo(@$_POST["cmb_nr_protegida"],'N','D');
    $NR_ESCADA_ENC= formataCampo(@$_POST["cmb_nr_enclausurada"],'N','D');
    $NR_ESCADA_PROVA_FUMACA= formataCampo(@$_POST["cmb_nr_esc_fumaca"],'N','D');
    $NR_ESCADA_PRESSU= formataCampo(@$_POST["cmb_nr_pressurizada"],'N','D');
    $NR_RAMPA= formataCampo(@$_POST["cmb_nr_rampa"],'N','D');
    $NR_ELEV_EMERGENCIA= formataCampo(@$_POST["cmb_nr_elev_emerg"],'N','D');
    $NR_RESG_AEREO= formataCampo(@$_POST["cmb_nr_reg_aereo"],'N','D');
    $NR_PASSARELA= formataCampo(@$_POST["cmb_nr_passarela"],'N','D');
    $ID_TP_PARA_RAIO= formataCampo(@$_POST["cmb_id_pararaio"]);
    $ID_TP_CAPTORES= formataCampo(@$_POST["cmb_id_captores"]);
    $ID_TP_ATERRAMENTO= formataCampo(@$_POST["cmb_id_aterramento"]);
    $ID_TP_ABANDONO= formataCampo(@$_POST["cmb_id_abandono"]);
    $CH_SPRINKLER= formataCampo(@$_POST["chk_ch_sprinkler"],"sn");
    $CH_MULSYFIRE= formataCampo(@$_POST["chk_ch_mulsyfire"],"sn");
    $CH_FIXO_CO2= formataCampo(@$_POST["chk_ch_co2"],"sn");
    $CH_ANCORA_CABO= formataCampo(@$_POST["chk_ch_ancora_cabo"],"sn");
    $DE_OUTROS= formataCampo(@$_POST["txt_nm_outros"]);
    $ID_ILU_EMERG= formataCampo(@$_POST["cmb_id_iluminacao_emergencia"]);
    $DE_PLANO_ACAO=formataCampo($_POST["hdn_de_plano_acao"],"t","L");

    if ($ID_CARC_EDIFICACAO==0) {
      $query_carc_insert=" INSERT INTO ".TBL_CARAC_ED." (ID_CIDADE,  ID_EDIFICACAO,  ID_CARC_EDIFICACAO,  CH_ATIVO,  DT_CARC_EDIFICACAO,  CH_SIS_PREVENTIVO_EXTINTOR,  ID_ADUCAO,  CH_COMB_GLP,  ID_TP_RECIPIENTE,  CH_COMB_GN,  ID_TP_INSTALACAO,  NR_ESCADA_COMUM,  NR_ESCADA_PROTEGIDA,  NR_ESCADA_ENC,  NR_ESCADA_PROVA_FUMACA,  NR_ESCADA_PRESSU,  NR_RAMPA,  NR_ELEV_EMERGENCIA,  NR_RESG_AEREO,  NR_PASSARELA,  ID_TP_PARA_RAIO,  ID_TP_CAPTORES,  ID_TP_ATERRAMENTO,  ID_TP_ABANDONO,  CH_SPRINKLER,  CH_MULSYFIRE,  CH_FIXO_CO2,  CH_ANCORA_CABO,  DE_OUTROS,  ID_ILU_EMERG, DE_PLANO_ACAO) VALUES ($ID_CIDADE, $ID_EDIFICACAO, $ID_CARC_EDIFICACAO, $CH_ATIVO, $DT_CARC_EDIFICACAO, $CH_SIS_PREVENTIVO_EXTINTOR, $ID_ADUCAO, $CH_COMB_GLP, $ID_TP_RECIPIENTE, $CH_COMB_GN, $ID_TP_INSTALACAO, $NR_ESCADA_COMUM, $NR_ESCADA_PROTEGIDA, $NR_ESCADA_ENC, $NR_ESCADA_PROVA_FUMACA, $NR_ESCADA_PRESSU, $NR_RAMPA, $NR_ELEV_EMERGENCIA, $NR_RESG_AEREO, $NR_PASSARELA, $ID_TP_PARA_RAIO, $ID_TP_CAPTORES, $ID_TP_ATERRAMENTO, $ID_TP_ABANDONO, $CH_SPRINKLER, $CH_MULSYFIRE, $CH_FIXO_CO2, $CH_ANCORA_CABO, $DE_OUTROS, $ID_ILU_EMERG,$DE_PLANO_ACAO)";
    } else {
      $query_carc_insert=" UPDATE ".TBL_CARAC_ED." SET DT_CARC_EDIFICACAO=$DT_CARC_EDIFICACAO,  CH_SIS_PREVENTIVO_EXTINTOR=$CH_SIS_PREVENTIVO_EXTINTOR,  ID_ADUCAO=$ID_ADUCAO,  CH_COMB_GLP=$CH_COMB_GLP,  ID_TP_RECIPIENTE=$ID_TP_RECIPIENTE,  CH_COMB_GN=$CH_COMB_GN,  ID_TP_INSTALACAO=$ID_TP_INSTALACAO,  NR_ESCADA_COMUM=$NR_ESCADA_COMUM,  NR_ESCADA_PROTEGIDA=$NR_ESCADA_PROTEGIDA,  NR_ESCADA_ENC=$NR_ESCADA_ENC,  NR_ESCADA_PROVA_FUMACA=$NR_ESCADA_PROVA_FUMACA,  NR_ESCADA_PRESSU=$NR_ESCADA_PRESSU,  NR_RAMPA=$NR_RAMPA,  NR_ELEV_EMERGENCIA=$NR_ELEV_EMERGENCIA,  NR_RESG_AEREO=$NR_RESG_AEREO,  NR_PASSARELA=$NR_PASSARELA,  ID_TP_PARA_RAIO=$ID_TP_PARA_RAIO,  ID_TP_CAPTORES=$ID_TP_CAPTORES,  ID_TP_ATERRAMENTO=$ID_TP_ATERRAMENTO,  ID_TP_ABANDONO=$ID_TP_ABANDONO,  CH_SPRINKLER=$CH_SPRINKLER,  CH_MULSYFIRE=$CH_MULSYFIRE,  CH_FIXO_CO2=$CH_FIXO_CO2,  CH_ANCORA_CABO=$CH_ANCORA_CABO,  DE_OUTROS=$DE_OUTROS,  ID_ILU_EMERG=$ID_ILU_EMERG, DE_PLANO_ACAO=$DE_PLANO_ACAO WHERE ID_CIDADE=$ID_CIDADE AND ID_EDIFICACAO=$ID_EDIFICACAO AND ID_CARC_EDIFICACAO=$ID_CARC_EDIFICACAO";
    }
    echo "<!--aqui 0:\n$query_carc_insert\n-->\n";
    $conn->query($query_carc_insert);
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $ID_CARC_EDIFICACAO=$conn->insert_id();
    $ID_CODIGO_RETORNO=$ID_CARC_EDIFICACAO;
?>
-->
<script language="javascript" type="text/javascript">//<!--
  window.opener.document.frm_analise.hdn_id_carac_edificacao.value="<?=$ID_CARC_EDIFICACAO?>";
  window.close();
//--></script>
<!--
<?
  include ('../../templates/retorno.htm');
  }
?>
  -->
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo,arq) {
      if (campo.value!="") {
        window.open(arq+"?campo="+campo.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      //frm.txt_id_rotina.readOnly=false;
    }
//--></script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab_cons.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_seguranca" onreset="retorna(this)" onsubmit="return validaForm(this,'hdn_id_cidade,Cidade Não Identificado,n','hdn_id_edificacao,Edificação não Identificada,t','hdn_ctr_extintor,Sis Preventivo de Extintor,t','rdo_hidraulico_preventivo,Sis Hidraulico Preventivo,t','hdn_ctr_aducao,Tipo da Adução,t','rdo_gas_can,Gás Canalizado,t','hdn_ctr_gas,Tipo de Gás,t','rdo_ilu_emergencia,Iluminação de Emergência,t','hdn_ctr_iluminacao,Tipo de Iluminação,t','rdo_saida_emergencia,Saída de Emergência,t','rdo_descarga_admosferica,Descarga Atmosférica,t','hdn_ctr_raio,Tipo de Proteção Descarga,t','rdo_ch_abandono,Sinalização de Abandono,t','hdn_ctr_abandono,Tipo Sinalização,t')">
            <input type="hidden" name="hdn_de_plano_acao" value="">
            <input type="hidden" name="hdn_id_carac_edificacao" value="">
            <input type="hidden" name="hdn_id_cidade" value="">
            <input type="hidden" name="hdn_id_edificacao" value="">
            <table width="95%" cellspacing="0" border="0" cellpadding="0" align="center">
              <tr>
                <td  colspan="3" >
                  <fieldset>
                  <legend>Sistema de Segurança Contra Incêndios</legend>
                  <table width="95%" cellspacing="2" border="0" cellpadding="0" align="center">
                    <tr>
                      <td  colspan="2" >Possui Sistema Preventivo por Extintor?</td>
                    </tr>
                    <tr>
                      <td colspan="3" class="campo_obr">
                      <input type="hidden" name="hdn_ctr_extintor" value="">
                      <label><input type="radio" name="rdo_ch_extintor" class="campo" value="S" onChange="javascript:document.frm_seguranca.hdn_ctr_extintor.value='S';">Sim</label>
                      <label><input type="radio" name="rdo_ch_extintor" class="campo" value="N" onChange="javascript:document.frm_seguranca.hdn_ctr_extintor.value='N';">Não</label>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"><hr></td>
                    </tr>
                    <tr>
                      <td width="33%">Possui Sistema Hidraulico Preventivo?</td>
                      <td colspan="2">Tipo da Adução</td>
                    </tr>
                    <tr>
                      <td class="campo_obr">
                        <input type="hidden" name="hdn_ctr_aducao" value="">
                        <label><input type="radio" name="rdo_hidraulico_preventivo" onChange="javascript:document.frm_seguranca.cmb_id_aducao.disabled=false; document.frm_seguranca.hdn_ctr_aducao.value='';" class="campo" value="S">Sim</label>
                        <label><input type="radio" name="rdo_hidraulico_preventivo" onChange="javascript:document.frm_seguranca.cmb_id_aducao.disabled=true; document.frm_seguranca.hdn_ctr_aducao.value='N';" class="campo" value="N">Não</label>
                      </td>
                      <td colspan="2">
                        <select name="cmb_id_aducao" class="campo_obr" title="Método pelo qual a água é pressurizada" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_aducao.value=this.value;">
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
?>
                          <option value="<?=$tupula['ID_ADUCAO']?>"><?=$tupula['NM_ADUCAO']?></option>
<?
                        }
?>
                    </select>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"><hr></td>
                    </tr>
                    <tr>
                      <td>Possui Gás Canalizado?</td>
                      <td>Combustível</td>
                      <td>Recipiente</td>
                    </tr>
                    <tr>
                      <td class="campo_obr">
                        <input type="hidden" name="hdn_ctr_gas" value="">
                        <label><input type="radio" name="rdo_gas_can" onChange="javascript:document.frm_seguranca.hdn_ctr_gas.value='';controle_multiplos(this.form,1,'chk_ch_glp','cmb_id_recipiente','chk_ch_gn','cmb_id_tp_instalacao');" class="campo" value="S">Sim</label>
                        <label><input type="radio" name="rdo_gas_can" onChange="javascript:document.frm_seguranca.hdn_ctr_gas.value='N';controle_multiplos(this.form,2,'chk_ch_glp','cmb_id_recipiente','chk_ch_gn','cmb_id_tp_instalacao');" value="N">Não</label>
                      </td>
                      <td>
                        <label><input type="checkbox" name="chk_ch_glp" onChange="controle_multiplo(this.form,this,'cmb_id_recipiente');check(this);" class="campo" disabled="true">GLP</label>
                      </td>
                      <td>
                        <select name="cmb_id_recipiente" class="campo" title="Modelo de cilindro quanto a sua carga" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_gas.value=this.value;">
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
?>
                            <option value="<?=$tupula['ID_TP_RECIPIENTE']?>"><?=$tupula['NM_TP_RECIPIENTE']?></option>
<?
                              }
?>
                          </select>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Combustível</td>
                      <td>Tipo</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>
                        <label><input type="checkbox" name="chk_ch_gn" class="campo" title="Caso possua gás natural" disabled="true" onchange="controle_multiplo(this.form,this,'cmb_id_tp_instalacao');check(this)">GN(Gás Natural)</label>
                      </td>
                      <td>
                      <select name="cmb_id_tp_instalacao" class="campo" title="Objeto de uso da instalação" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_gas.value=this.value;">
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
?>
                            <option value="<?=$tupula['ID_TP_INSTALACAO']?>"><?=$tupula['NM_TP_INSTALACAO']?></option>
<?
                              }
?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"><hr></td>
                    </tr>
                    <tr>
                      <td>Possui Iluminação de Emergência?</td>
                      <td colspan="2">Tipo</td>
                    </tr>
                    <tr>
                      <td class="campo_obr">
                        <input type="hidden" name="hdn_ctr_iluminacao" value="">
                        <label><input type="radio" name="rdo_ilu_emergencia" onChange="javascript:document.frm_seguranca.cmb_id_iluminacao_emergencia.disabled=false;document.frm_seguranca.hdn_ctr_iluminacao.value='';document.frm_seguranca.cmb_id_iluminacao_emergencia.value='';" class="campo" value="S">Sim</label>
                        <label><input type="radio" name="rdo_ilu_emergencia" onChange="javascript:document.frm_seguranca.cmb_id_iluminacao_emergencia.disabled=true;document.frm_seguranca.hdn_ctr_iluminacao.value='N';" class="campo" value="N">Não</label>
                      </td>
                      <td colspan="2">
                        <select name="cmb_id_iluminacao_emergencia" class="campo" title="Tipo de iluminação de emergência quanto a sua alimentação de energia" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_iluminacao.value=this.value;">
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
?>
                          <option value="<?=$tupula['ID_ILU_EMERG']?>"><?=$tupula['NM_ILU_EMERG']?></option>
<?
                                  }
?>
                              </select>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"><hr></td>
                    </tr>
                    <tr>
                      <td colspan="3">Possui Saída de Emergência</td>
                    </tr>
                    <tr>
                      <td colspan="3">
                        <table cellspacing="0" cellpadding="0" align="center" border="0" width="100%">
                          <tr>
                            <td class="campo_obr">
                              <label><input type="radio" name="rdo_saida_emergencia" onChange="controle_multiplos(this.form,1,'chk_esc_comum','chk_esc_pres','chk_esc_protegida','chk_rampa','chk_esc_enclausurada','chk_elev_emergencia','chk_esc_fumaca','chk_resg_aereo','chk_passarela','cmb_nr_escada_comum','cmb_nr_pressurizada','cmb_nr_protegida','cmb_nr_rampa','cmb_nr_enclausurada','cmb_nr_elev_emerg','cmb_nr_esc_fumaca','cmb_nr_reg_aereo','cmb_nr_passarela')" class="campo" value="S">Sim</label>
                              <label><input type="radio" name="rdo_saida_emergencia" onChange="controle_multiplos(this.form,2,'chk_esc_comum','chk_esc_pres','chk_esc_protegida','chk_rampa','chk_esc_enclausurada','chk_elev_emergencia','chk_esc_fumaca','chk_resg_aereo','chk_passarela','cmb_nr_escada_comum','cmb_nr_pressurizada','cmb_nr_protegida','cmb_nr_rampa','cmb_nr_enclausurada','cmb_nr_elev_emerg','cmb_nr_esc_fumaca','cmb_nr_reg_aereo','cmb_nr_passarela')" class="campo" value="N">Não</label>
                            </td>
                            <td>&nbsp;</td>
                            <td style="font-weight : bold;">Dispositivo</td>
                            <td style="font-weight : bold;">Quantidade</td>
                          </tr>
                          <tr>
                            <td style="font-weight : bold;">Dispositivo</td>
                            <td style="font-weight : bold;">Quantidade</td>
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
                                <input type="checkbox" name="chk_esc_protegida" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_protegida')" disabled="true">Escada Protegida
                              </label>
                            </td>
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
                                <input type="checkbox" name="chk_resg_aereo" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_reg_aereo')" disabled="true">Local para Resgate Aéreo
                              </label>
                            </td>
                            <td>
                              <select name="cmb_nr_reg_aereo" disabled="NM_TP_PARA_RAIOtrue" class="campo" title="Número de Locais para Resgate Aéreo da Edificação">
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
                                <input type="checkbox" name="chk_esc_fumaca" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_esc_fumaca')" disabled="true">Escada Enclausurada a<br> Prova de Fumaça
                              </label>
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
                                <input type="checkbox" name="chk_passarela" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_passarela')" disabled="true">Passarela
                              </label>
                            </td>
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
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"><hr><td>
                    </tr>
                    <tr>
                      <td colspan="3">Possui Proteção Contra Descarga Atmosférica?</td>
                    </tr>
                    <tr>
                      <td class="campo_obr">
                        <label>
                          <input type="hidden" name="hdn_ctr_raio" value="">
                          <input type="radio" name="rdo_descarga_admosferica" value="S" onChange="javascript:controle_multiplos(this.form,1,'cmb_id_pararaio','cmb_id_captores','cmb_id_aterramento');document.frm_seguranca.hdn_ctr_raio.value='';" >Sim
                        </label>
                        <label>
                          <input type="radio" name="rdo_descarga_admosferica" value="N" onChange="javascript:controle_multiplos(this.form,2,'cmb_id_pararaio','cmb_id_captores','cmb_id_aterramento');document.frm_seguranca.hdn_ctr_raio.value='N';">Não
                        </label>
                      </td>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Método de Proteção</td>
                      <td>Tipo de Captores</td>
                      <td>Tipo de Aterramento</td>
                    </tr>
                    <tr>
                      <td>
                        <select name="cmb_id_pararaio" title="Tipo de Pararaio" disabled="true" onChange="javascript:document.frm_seguranca..value=this.value;">
                          <option value="">-------------------</option>
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
                      <td>
                        <select name="cmb_id_captores" title="Tipo de Captores" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_raio.value=this.value;">
                          <option value="">-------------------</option>
                          <?
                              // string da query
                              $sql= "SELECT ID_TP_CAPTORES , NM_TP_CAPTORES FROM ".TBL_TP_CAPTORES;
                              // executando a consulta NM_TP_PARA_RAIOtrue
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }

                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_TP_CAPTORES']."\">";
                                echo $tupula['NM_TP_CAPTORES'];
                                echo "</option>\n";
                              }
                          ?>
                        </select>
                      </td>
                      <td>
                        <select name="cmb_id_aterramento" title="Tipo de Aterramento" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_raio.value=this.value;">
                          <option value="">-------------------</option>
                          <?
                              // string da query
                              $sql= "SELECT ID_TP_ATERRAMENTO , NM_TP_ATERRAMENTO FROM ".TBL_TP_ATERRAMENTO;
                              // executando a consulta NM_TP_PARA_RAIOtrue
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }

                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_TP_ATERRAMENTO']."\">";
                                echo $tupula['NM_TP_ATERRAMENTO'];
                                echo "</option>\n";
                              }
                          ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"><hr></td>
                    </tr>
                    <tr>
                      <td colspan="2">Possui Sinalização de Abandono de Local</td>
                      <td>Tipo</td>
                    </tr>
                    <tr>
                      <td class="campo_obr">
                        <input type="hidden" name="hdn_ctr_abandono" value="">
                        <label>
                          <input type="radio" name="rdo_ch_abandono" value="S" onChange="javascript:controle_multiplos(this.form,1,'cmb_id_abandono');document.frm_seguranca.hdn_ctr_abandono.value='';" >Sim
                        </label>
                        <label>
                          <input type="radio" name="rdo_ch_abandono" value="N" onChange="javascript:controle_multiplos(this.form,2,'cmb_id_abandono');document.frm_seguranca.hdn_ctr_abandono.value='N';">Não
                        </label>
                      </td>
                      <td>&nbsp;</td>
                      <td>
                        <select name="cmb_id_abandono" title="Tipo de Sinalização de Abandono" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_abandono.value=this.value;">
                          <option value="">--------------------</option>
                          <?
                              // string da query
                              $sql= "SELECT ID_TP_ABANDONO, NM_TP_ABANDONO FROM ".TBL_TP_ABANDONO;
                              // executando a consulta NM_TP_PARA_RAIOtrue
                              $res= $conn->query($sql);
                              // testando se houve algum erro
                              if ($conn->get_status()==false) {
                                die($conn->get_msg());
                              }

                              while ($tupula = $conn->fetch_row()) {
                                echo "<option value=\"".$tupula['ID_TP_ABANDONO']."\">";
                                echo $tupula['NM_TP_ABANDONO'];
                                echo "</option>\n";
                              }
                          ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"><hr></td>
                    </tr>
                    <tr>
                      <td colspan="3">Outros Sistemas Marque as Caixas de Seleção para os Existentes</td>
                    </tr>
                    <tr>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_ch_sprinkler" class="campo" value="N">Sprinkler
                        </label>
                      </td>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_ch_mulsyfire" class="campo" value="N">Mulsyfire
                        </label>
                      </td>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_ch_co2" class="campo" value="N">Sistema Fixo de CO<sub>2</sub>
                        </label>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_ch_co2" class="campo" value="N">Sistema Fixo de CO<sub>2</sub>
                        </label>
                      </td>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_ch_ancora_cabo" class="campo" value="N">Ancoragem de Cabo
                        </label>
                      </td>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_outros" class="campo" onChange="controle_multiplo(this.form,this,'txt_nm_outros')">Outros
                        </label>
                        <input type="text" name="txt_nm_outros" value="" title="Outros Dispositivos" disabled="true">
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
  if (@$_GET["hdn_novos"]>=0) {
    if (@$_GET["hdn_novos"]>0) {
      $query_carc="SELECT ID_CIDADE, ID_EDIFICACAO, ID_CARC_EDIFICACAO, CH_SIS_PREVENTIVO_EXTINTOR, ID_ADUCAO, CH_COMB_GLP, ID_TP_RECIPIENTE, CH_COMB_GN, ID_TP_INSTALACAO, ID_TP_ALARME_INCENDIO, NR_ESCADA_COMUM, NR_ESCADA_PROTEGIDA, NR_ESCADA_ENC, NR_ESCADA_PROVA_FUMACA, NR_ESCADA_PRESSU, NR_RAMPA, NR_ELEV_EMERGENCIA, NR_RESG_AEREO, NR_PASSARELA, ID_TP_PARA_RAIO, ID_TP_CAPTORES, ID_TP_ATERRAMENTO, ID_TP_ABANDONO, CH_SPRINKLER, CH_MULSYFIRE, CH_FIXO_CO2, CH_ANCORA_CABO, DE_OUTROS, DE_PLANO_ACAO, ID_ILU_EMERG FROM ".TBL_CARAC_ED." WHERE CH_ATIVO='S' AND ID_CIDADE=".$_GET["hdn_id_cidade"]." AND ID_EDIFICACAO=".$_GET["hdn_id_edificacao"]." AND ID_CARC_EDIFICACAO=".$_GET["hdn_novos"];
      $conn->query($query_carc);
      $carac_fetch=$conn->fetch_row();
      $ID_CIDADE=$carac_fetch["ID_CIDADE"];
      $ID_EDIFICACAO=$carac_fetch["ID_EDIFICACAO"];
      $ID_CARC_EDIFICACAO=$carac_fetch["ID_CARC_EDIFICACAO"];
      $CH_SIS_PREVENTIVO_EXTINTOR=$carac_fetch["CH_SIS_PREVENTIVO_EXTINTOR"];
      $ID_ADUCAO=$carac_fetch["ID_ADUCAO"];
      $CH_COMB_GLP=$carac_fetch["CH_COMB_GLP"];
      $ID_TP_RECIPIENTE=$carac_fetch["ID_TP_RECIPIENTE"];
      $CH_COMB_GN=$carac_fetch["CH_COMB_GN"];
      $ID_TP_INSTALACAO=$carac_fetch["ID_TP_INSTALACAO"];
      $ID_TP_ALARME_INCENDIO=$carac_fetch["ID_TP_ALARME_INCENDIO"];
      $NR_ESCADA_COMUM=$carac_fetch["NR_ESCADA_COMUM"];
      $NR_ESCADA_PROTEGIDA=$carac_fetch["NR_ESCADA_PROTEGIDA"];
      $NR_ESCADA_ENC=$carac_fetch["NR_ESCADA_ENC"];
      $NR_ESCADA_PROVA_FUMACA=$carac_fetch["NR_ESCADA_PROVA_FUMACA"];
      $NR_ESCADA_PRESSU=$carac_fetch["NR_ESCADA_PRESSU"];
      $NR_RAMPA=$carac_fetch["NR_RAMPA"];
      $NR_ELEV_EMERGENCIA=$carac_fetch["NR_ELEV_EMERGENCIA"];
      $NR_RESG_AEREO=$carac_fetch["NR_RESG_AEREO"];
      $NR_PASSARELA=$carac_fetch["NR_PASSARELA"];
      $ID_TP_PARA_RAIO=$carac_fetch["ID_TP_PARA_RAIO"];
      $ID_TP_CAPTORES=$carac_fetch["ID_TP_CAPTORES"];
      $ID_TP_ATERRAMENTO=$carac_fetch["ID_TP_ATERRAMENTO"];
      $ID_TP_ABANDONO=$carac_fetch["ID_TP_ABANDONO"];
      if ($ID_TP_ATERRAMENTO!="") {
        $CH_ABANDONO="S";
      } else {
        $CH_ABANDONO="N";
      }
      $CH_SPRINKLER=$carac_fetch["CH_SPRINKLER"];
      $CH_MULSYFIRE=$carac_fetch["CH_MULSYFIRE"];
      $CH_FIXO_CO2=$carac_fetch["CH_FIXO_CO2"];
      $CH_ANCORA_CABO=$carac_fetch["CH_ANCORA_CABO"];
      $DE_OUTROS=$carac_fetch["DE_OUTROS"];
      $DE_PLANO_ACAO=$carac_fetch["DE_PLANO_ACAO"];
      $ID_ILU_EMERG=$carac_fetch["ID_ILU_EMERG"];
      $ALTERACAO="S";
    } else {
      $query_carc=" SELECT ID_CIDADE, CH_SIS_PREVENTIVO_EXTINTOR, NR_ESCADA_COMUM, NR_ESCADA_PROTEGIDA, NR_ESCADA_ENC, NR_ESCADA_PROVA_FUMACA, NR_ESCADA_PRESSU, NR_RAMPA, NR_ELEV_EMERGENCIA, NR_RESG_AEREO, NR_PASSARELA, ID_TP_ALARME_INCENDIO, ID_ILU_EMERG, ID_TP_PARA_RAIO, CH_COMB_GN, CH_COMB_GLP, ID_TP_RECIPIENTE, ID_TP_INSTALACAO, CH_ABANDONO, CH_FIXO_CO2, CH_SPRINKLER, CH_ANCORA_CABO, CH_MULSYFIRE, NM_OUTROS, ID_ADUCAO FROM ".TBL_SOLICITACAO." WHERE   ".TBL_SOLICITACAO.".ID_SOLICITACAO=".@$_GET["hdn_id_solicitacao"]." AND ".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO='".@$_GET["hdn_id_tipo_solicitacao"]."' AND ".TBL_SOLICITACAO.".ID_CIDADE=".@$_GET["hdn_id_cidade"];
      $conn->query($query_carc);
      $carac_fetch=$conn->fetch_row();
      $ID_CARC_EDIFICACAO="N";
      $ID_CIDADE=$carac_fetch["ID_CIDADE"];
      $ID_SOLICITACAO=@$_GET["hdn_id_solicitacao"];
      $ID_TIPO_SOLICITACAO=@$_GET["hdn_id_tipo_solicitacao"];
      $ID_EDIFICACAO=$_GET["hdn_id_edificacao"];
      $ID_CARC_EDIFICACAO="";
      $CH_SIS_PREVENTIVO_EXTINTOR=$carac_fetch["CH_SIS_PREVENTIVO_EXTINTOR"];
      $NR_ESCADA_COMUM=$carac_fetch["NR_ESCADA_COMUM"];
      $NR_ESCADA_PROTEGIDA=$carac_fetch["NR_ESCADA_PROTEGIDA"];
      $NR_ESCADA_ENC=$carac_fetch["NR_ESCADA_ENC"];
      $NR_ESCADA_PROVA_FUMACA=$carac_fetch["NR_ESCADA_PROVA_FUMACA"];
      $NR_ESCADA_PRESSU=$carac_fetch["NR_ESCADA_PRESSU"];
      $NR_RAMPA=$carac_fetch["NR_RAMPA"];
      $NR_ELEV_EMERGENCIA=$carac_fetch["NR_ELEV_EMERGENCIA"];
      $NR_RESG_AEREO=$carac_fetch["NR_RESG_AEREO"];
      $NR_PASSARELA=$carac_fetch["NR_PASSARELA"];
      $ID_TP_ALARME_INCENDIO=$carac_fetch["ID_TP_ALARME_INCENDIO"];
      $ID_ADUCAO=$carac_fetch["ID_ADUCAO"];
      $CH_COMB_GLP=$carac_fetch["CH_COMB_GLP"];
      $ID_TP_RECIPIENTE=$carac_fetch["ID_TP_RECIPIENTE"];
      $CH_COMB_GN=$carac_fetch["CH_COMB_GN"];
      $ID_TP_INSTALACAO=$carac_fetch["ID_TP_INSTALACAO"];
      $ID_TP_PARA_RAIO=$carac_fetch["ID_TP_PARA_RAIO"];
      $ID_TP_CAPTORES="";
      $ID_TP_ATERRAMENTO="";
      $ID_TP_ABANDONO="";
      $CH_ABANDONO=$carac_fetch["CH_ABANDONO"];
      $CH_SPRINKLER=$carac_fetch["CH_SPRINKLER"];
      $CH_MULSYFIRE=$carac_fetch["CH_MULSYFIRE"];
      $CH_FIXO_CO2=$carac_fetch["CH_FIXO_CO2"];
      $CH_ANCORA_CABO=$carac_fetch["CH_ANCORA_CABO"];
      $DE_OUTROS=$carac_fetch["NM_OUTROS"];
      $DE_PLANO_ACAO="";
      $ID_ILU_EMERG=$carac_fetch["ID_ILU_EMERG"];
    }
    if (($CH_SIS_PREVENTIVO_EXTINTOR=="")||($CH_SIS_PREVENTIVO_EXTINTOR=="NULL")) { $CH_SIS_PREVENTIVO_EXTINTOR="N"; }
    
?>
<script language="javascript" type="text/javascript">//<!--
  var frm_at=document.frm_seguranca;
  frm_at.hdn_id_cidade.value="<?=$ID_CIDADE?>";
  frm_at.hdn_id_edificacao.value="<?=$ID_EDIFICACAO?>";
  radio_ed(frm_at.rdo_ch_extintor,"<?=$CH_SIS_PREVENTIVO_EXTINTOR?>");
  frm_at.hdn_ctr_extintor.value="<?=$CH_SIS_PREVENTIVO_EXTINTOR?>";
  <?
     if  ($ID_ADUCAO!="") { 
  ?>
      radio_ed(frm_at.rdo_hidraulico_preventivo,"S");
      frm_at.cmb_id_aducao.disabled=false;
      frm_at.cmb_id_aducao.value="<?=$ID_ADUCAO?>";
      frm_at.hdn_ctr_aducao.value="<?=$ID_ADUCAO?>";
  <? 
    } else {
  ?>
      radio_ed(frm_at.rdo_hidraulico_preventivo,"N");
      frm_at.hdn_ctr_aducao.value="N";
  <?
    }
    if ((($CH_COMB_GLP!="")||($CH_COMB_GN!=""))&&(($CH_COMB_GLP!="N")||($CH_COMB_GN!="N"))) { 
  ?>
    radio_ed(frm_at.rdo_gas_can,"S");
    frm_at.hdn_ctr_gas.value="S";
    frm_at.chk_ch_gn.disabled=false;
    frm_at.chk_ch_glp.disabled=false;
  <? 
      if (trim($ID_TP_RECIPIENTE)!="") { 
  ?>
        check_ed(frm_at.chk_ch_glp,"<?=$CH_COMB_GLP?>");
        frm_at.cmb_id_recipiente.disabled=false;
        frm_at.cmb_id_recipiente.value="<?=$ID_TP_RECIPIENTE?>";
        frm_at.hdn_ctr_gas.value="<?=$ID_TP_RECIPIENTE?>";
  <?
      }
      if (trim($ID_TP_INSTALACAO)!="") {
  ?>
        check_ed(frm_at.chk_ch_gn,"<?=$CH_COMB_GN?>");
        frm_at.cmb_id_tp_instalacao.disabled=false;
        frm_at.cmb_id_tp_instalacao.value="<?=$ID_TP_INSTALACAO?>";
        frm_at.hdn_ctr_gas.value="<?=$ID_TP_INSTALACAO?>";
  <?
      }
    } else {
  ?>
    radio_ed(frm_at.rdo_gas_can,"N");
    frm_at.hdn_ctr_gas.value="N";
  <?
    }
    if ($ID_ILU_EMERG!="") {
  ?>
      radio_ed(frm_at.rdo_ilu_emergencia,"S");
      frm_at.cmb_id_iluminacao_emergencia.disabled=false;
      frm_at.cmb_id_iluminacao_emergencia.value="<?=$ID_ILU_EMERG?>";
      frm_at.hdn_ctr_iluminacao.value="<?=$ID_ILU_EMERG?>";
  <?
    } else {
  ?>
      radio_ed(frm_at.rdo_ilu_emergencia,"N");
      frm_at.hdn_ctr_iluminacao.value="N";
  <?
    }
    if (($NR_ESCADA_COMUM>0) || ($NR_ESCADA_PROTEGIDA>0) || ($NR_ESCADA_ENC>0) || ($NR_ESCADA_PROVA_FUMACA>0) || ($NR_ESCADA_PRESSU>0) || ($NR_RAMPA>0) || ($NR_ELEV_EMERGENCIA>0) || ($NR_RESG_AEREO>0) || ($NR_PASSARELA>0)) {
  ?>
      radio_ed(frm_at.rdo_saida_emergencia,"S");
  <?
      if ($NR_ESCADA_PRESSU>0) {
  ?>
        frm_at.chk_esc_pres.disabled=false;
        check_ed(frm_at.chk_esc_pres,"S");
        frm_at.cmb_nr_pressurizada.disabled=false;
        frm_at.cmb_nr_pressurizada.value="<?=$NR_ESCADA_PRESSU?>";
  <?
      }
      if ($NR_ESCADA_COMUM>0) {
  ?>
        frm_at.chk_esc_comum.disabled=false;
        check_ed(frm_at.chk_esc_comum,"S");
        frm_at.cmb_nr_escada_comum.disabled=false;
        frm_at.cmb_nr_escada_comum.value="<?=$NR_ESCADA_COMUM?>";
  <?
      }
      if ($NR_RAMPA>0) {
  ?>
        frm_at.chk_rampa.disabled=false;
        check_ed(frm_at.chk_rampa,"S");
        frm_at.cmb_nr_rampa.disabled=false;
        frm_at.cmb_nr_rampa.value="<?=$NR_RAMPA?>";
  <?
      }
      if ($NR_ESCADA_PROTEGIDA>0) {
  ?>
        frm_at.chk_esc_protegida.disabled=false;
        check_ed(frm_at.chk_esc_protegida,"S");
        frm_at.cmb_nr_protegida.disabled=false;
        frm_at.cmb_nr_protegida.value="<?=$NR_ESCADA_PROTEGIDA?>";
  <?
      }
      if ($NR_ELEV_EMERGENCIA>0) {
  ?>
        frm_at.chk_elev_emergencia.disabled=false;
        check_ed(frm_at.chk_elev_emergencia,"S");
        frm_at.cmb_nr_elev_emerg.disabled=false;
        frm_at.cmb_nr_elev_emerg.value="<?=$NR_ELEV_EMERGENCIA?>";
  <?
      }
      if ($NR_ESCADA_ENC>0) {
  ?>
        frm_at.chk_esc_enclausurada.disabled=false;
        check_ed(frm_at.chk_esc_enclausurada,"S");
        frm_at.cmb_nr_enclausurada.disabled=false;
        frm_at.cmb_nr_enclausurada.value="<?=$NR_ESCADA_ENC?>";
  <?
      }
      if ($NR_RESG_AEREO>0) {
  ?>
        frm_at.chk_resg_aereo.disabled=false;
        check_ed(frm_at.chk_resg_aereo,"S");
        frm_at.cmb_nr_reg_aereo.disabled=false;
        frm_at.cmb_nr_reg_aereo.value="<?=$NR_RESG_AEREO?>";
  <?
      }
      if ($NR_ESCADA_PROVA_FUMACA>0) {
  ?>
        frm_at.chk_esc_fumaca.disabled=false;
        check_ed(frm_at.chk_esc_fumaca,"S");
        frm_at.cmb_nr_esc_fumaca.disabled=false;
        frm_at.cmb_nr_esc_fumaca.value="<?=$NR_ESCADA_PROVA_FUMACA?>";
  <?
      }
      if ($NR_PASSARELA>0) {
  ?>
        frm_at.chk_passarela.disabled=false;
        check_ed(frm_at.chk_passarela,"S");
        frm_at.cmb_nr_passarela.disabled=false;
        frm_at.cmb_nr_passarela.value="<?=$NR_PASSARELA?>";
  <?
      }
    } else {
  ?>
      radio_ed(frm_at.rdo_saida_emergencia,"N");
  <?
    }
    if (($ID_TP_PARA_RAIO!="") || ($ID_TP_CAPTORES!="") || ($ID_TP_ATERRAMENTO!="")) {
  ?>
  
      radio_ed(frm_at.rdo_descarga_admosferica,"S");
      frm_at.cmb_id_pararaio.disabled=false;
      frm_at.cmb_id_captores.disabled=false;
      frm_at.cmb_id_aterramento.disabled=false;
      frm_at.cmb_id_pararaio.value="<?=$ID_TP_PARA_RAIO?>";
      frm_at.cmb_id_captores.value="<?=$ID_TP_CAPTORES?>";
      frm_at.cmb_id_aterramento.value="<?=$ID_TP_ATERRAMENTO?>";
      if ((frm_at.cmb_id_pararaio.value!="") || (frm_at.cmb_id_captores.value!="") || (frm_at.cmb_id_aterramento.value!="")) {
        frm_at.hdn_ctr_raio.value="S";
      }
  <?
    } else {
  ?>
      radio_ed(frm_at.rdo_descarga_admosferica,"N");
      frm_at.hdn_ctr_raio.value="N";
  <?
    }
    if ($CH_ABANDONO=="S") {
  ?>
      radio_ed(frm_at.rdo_ch_abandono,"S");
      frm_at.cmb_id_abandono.disabled=false;
      frm_at.cmb_id_abandono.value="<?=$ID_TP_ABANDONO?>";
  <?
    } else {
  ?>
      radio_ed(frm_at.rdo_ch_abandono,"N");
      frm_at.hdn_ctr_abandono.value="N";
  <?
    }
  ?>
  check_ed(frm_at.chk_ch_sprinkler,"<?=$CH_SPRINKLER?>");
  check_ed(frm_at.chk_ch_mulsyfire,"<?=$CH_MULSYFIRE?>");
  check_ed(frm_at.chk_ch_ancora_cabo,"<?=$CH_ANCORA_CABO?>");
  check_ed(frm_at.chk_ch_co2,"<?=$CH_FIXO_CO2?>");
  <?
    if ($DE_OUTROS!="") {
  ?>
      check_ed(frm_at.chk_outros,"S");
      frm_at.txt_nm_outros.disabled=false;
      frm_at.txt_nm_outros.value="<?=$DE_OUTROS?>";
  <?
    }
  ?>
  <? 
    if ($DE_PLANO_ACAO=="") {
  ?>
    frm_at.hdn_de_plano_acao.value=window.opener.document.frm_analise.hdn_de_plano_acao.value;
  <?
    } else {
  ?>
    frm_at.hdn_de_plano_acao.value="<?=$DE_PLANO_ACAO?>";
  <?
    }
  ?>
  frm_at.hdn_id_carac_edificacao.value="<?=$ID_CARC_EDIFICACAO?>";
//--></script>
<?
  }
?>
<?
  //include ('../../templates/footer.htm');
?>
</body>
</html>
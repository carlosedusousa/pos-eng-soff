<?
  $erro="";
  require_once 'lib/loader.php';
  // especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";
  // Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="alt_analise.php";
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

  if ((@$_POST["txt_id_protocolo"]!="") && (@$_POST["txt_nr_cnpjcpf_solicitante"]!="") && (@$_POST["txt_nm_solicitante"]!="") && (@$_POST["txt_nr_fone_solicitante"]!="") && (@$_POST["txt_nm_email_solicitante"]!="") && (@$_POST["txt_nm_edificacao"]!="") && (@$_POST["hdn_id_cidade"]!="") && (@$_POST["txt_vl_area_construida"]!="") && (@$_POST["txt_nm_usuario"]!="") && (@$_POST["cmb_ch_parecer"]!="") && (@$_POST["hdn_mtv_indeferimento"]!="")) {
    
    if (@$_POST["hdn_id_analise"]!="") {
      $ID_ANALISE=formataCampo($_POST["hdn_id_analise"],"N");
    } else {
      $ID_ANALISE=0;
    }
    $ID_CIDADE=formataCampo($_POST["hdn_id_cidade"],"N");
    $ID_TP_PESSOA="'S'";
    $ID_SOLICITACAO=$_POST["hdn_id_solicitacao"];
    $ID_TIPO_SOLICITACAO=formataCampo($_POST["hdn_id_tipo_solicitacao"]);
    $ID_EDIFICACAO=$_POST["txt_id_edificacao"];
    $ID_CARC_EDIFICACAO=$_POST["hdn_id_carac_edificacao"];
    $ID_PROTOCOLO=formataCampo($_POST["txt_id_protocolo"],"N");
    $ID_CNPJ_CPF_SOLICITANTE=formataCampo(formataCampo($_POST["txt_nr_cnpjcpf_solicitante"],"N"));
    $NM_SOLICITANTE=formataCampo($_POST["txt_nm_solicitante"]);
    $NM_PESSOA_FONETICA=formataCampo(nr_txt_fonetica($_POST["txt_nm_solicitante"]));
    $NR_FONE_SOLICITANTE=formataCampo($_POST["txt_nr_fone_solicitante"],"N");
    $NM_EMAIL_SOLICITANTE=formataCampo($_POST["txt_nm_email_solicitante"],"T","L");
    $DT_ANALISE="CURDATE()";
    $ID_USUARIO_CAD=formataCampo($usuario,"T","L");
    $CH_PARCER=formataCampo($_POST["cmb_ch_parecer"]);
    $DE_INDEFERIMENTO=formataCampo(@$_POST["txa_mtv_indeferimento"],"T","L");

    $erro_query="";
    $query_trans="BEGIN";
    $conn->query($query_trans);
    
    $query_pessoa="SELECT ID_TP_PESSOA FROM ".TBL_PESSOA." WHERE ID_CNPJ_CPF=$ID_CNPJ_CPF_SOLICITANTE AND ID_CIDADE=$ID_CIDADE";
    $conn->query($query_pessoa);
    if ($conn->num_rows()>0) {
      $pessoa_fetch=$conn->fetch_row();
      if ($pessoa_fetch["ID_TP_PESSOA"]!="S") {
        $ID_TP_PESSOA="'A'";
      }
      $query_pessoa="UPDATE ".TBL_PESSOA." SET ID_TP_PESSOA=$ID_TP_PESSOA, NM_PESSOA=$NM_SOLICITANTE, NM_PESSOA_FONETICA=$NM_PESSOA_FONETICA, NR_FONE=$NR_FONE_SOLICITANTE, DE_EMAIL_PESSOA=$NM_EMAIL_SOLICITANTE WHERE ".TBL_PESSOA.".ID_CNPJ_CPF=$ID_CNPJ_CPF_SOLICITANTE AND ".TBL_PESSOA.".ID_CIDADE=$ID_CIDADE";
    } else {
      $query_pessoa="INSERT INTO ".TBL_PESSOA." (ID_CNPJ_CPF, ID_CIDADE, ID_TP_PESSOA, NM_PESSOA, NM_PESSOA_FONETICA, NR_FONE, DE_EMAIL_PESSOA) VALUES ($ID_CNPJ_CPF_SOLICITANTE,$ID_CIDADE,$ID_TP_PESSOA, $NM_SOLICITANTE,$NM_PESSOA_FONETICA,$NR_FONE_SOLICITANTE,$NM_EMAIL_SOLICITANTE)";
    }
    $conn->query($query_pessoa);
     if ($conn->get_status()==false) {
      $erro_query= "pessoa:\n".$conn->get_msg()."\n";
    } 

    $query_solictacao="UPDATE ".TBL_SOLICITACAO." SET CH_PROTOCOLADO='A' WHERE ".TBL_SOLICITACAO.".ID_SOLICITACAO=$ID_SOLICITACAO AND ".TBL_SOLICITACAO.".ID_CIDADE=$ID_CIDADE AND ".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO=$ID_TIPO_SOLICITACAO";
    $conn->query($query_solictacao);
    if ($conn->get_status()==false) {
      $erro_query= "solicitacao:\n".$conn->get_msg()."\n";
    }
    
    $query_protocolo="UPDATE ".TBL_PROTOCOLOS." SET CH_ANALISE='S' WHERE ID_PROTOCOLO=$ID_PROTOCOLO AND ID_CIDADE=$ID_CIDADE";
    $conn->query($query_protocolo);
    if ($conn->get_status()==false) {
      $erro_query= "solicitacao:\n".$conn->get_msg()."\n";
    }
    
    
    $query_trans="COMMIT";
/*
    if ($_POST["hdn_controle"]==1) {
      if ($global_inclusao=="S") {
        $query_analise="INSERT INTO ".TBL_ANALISE." (ID_CIDADE,ID_ANALISE,ID_PROTOCOLO,ID_CNPJ_CPF_SOLICITANTE, ID_CIDADE_PESSOA, ID_EDIFICACAO, ID_CIDADE_EDIFICACAO, CH_PARCER, DE_INDEFERIMENTO, ID_USUARIO, DT_ANALISE) VALUES ($ID_CIDADE, $ID_ANALISE, $ID_PROTOCOLO, $ID_CNPJ_CPF_SOLICITANTE, $ID_CIDADE, $ID_EDIFICACAO, $ID_CIDADE, $CH_PARCER, $DE_INDEFERIMENTO, $ID_USUARIO_CAD, $DT_ANALISE)";
      } else {
        $query_analise="";
        $query_trans="ROLLBACK";
        $erro=MSG_ERR_INC;
      }
    }
 */
//    if ($_POST["hdn_controle"]==2) {
      if ($global_alteracao=="S") {
        $query_analise="UPDATE ".TBL_ANALISE." SET ID_PROTOCOLO=$ID_PROTOCOLO, ID_CNPJ_CPF_SOLICITANTE=$ID_CNPJ_CPF_SOLICITANTE, ID_CIDADE_PESSOA=$ID_CIDADE, ID_EDIFICACAO=$ID_EDIFICACAO, ID_CIDADE_EDIFICACAO=$ID_CIDADE, CH_PARCER=$CH_PARCER, DE_INDEFERIMENTO=$DE_INDEFERIMENTO, ID_USUARIO=$ID_USUARIO_CAD,DT_ANALISE=$DT_ANALISE WHERE ".TBL_ANALISE.".ID_ANALISE=$ID_ANALISE AND ".TBL_ANALISE.".ID_CIDADE=$ID_CIDADE";
      } else {
        $query_analise="";
        $query_trans="ROLLBACK";
        $erro=MSG_ERR_ALT;
      }
//    }
     if ($query_analise!="") {
      $res= $conn->query($query_analise);
      if ($ID_ANALISE==0) {
        $ID_ANALISE=$conn->insert_id();
      }
      if ($conn->get_status()==false) {
        $erro_query= "analise:\n".$conn->get_msg()."\n";
      }
    }
    
    $query_carac="UPDATE ".TBL_CARAC_ED." SET CH_ATIVO='N' WHERE ID_CIDADE=$ID_CIDADE AND ID_EDIFICACAO=$ID_EDIFICACAO AND  CH_ATIVO='S'";
    $conn->query($query_carac);
    if ($conn->get_status()==false) {
      $erro_query= "característica desmarc:\n".$conn->get_msg()."\n";
    }
    
     $query_carac="UPDATE ".TBL_CARAC_ED." SET ID_ANALISE=$ID_ANALISE, ID_CIDADE_ANALISE=$ID_CIDADE, CH_ATIVO='S' WHERE ID_CIDADE=$ID_CIDADE AND ID_EDIFICACAO=$ID_EDIFICACAO AND ID_CARC_EDIFICACAO=$ID_CARC_EDIFICACAO";
    $conn->query($query_carac);
    if ($conn->get_status()==false) {
      $erro_query= "característica:\n".$conn->get_msg()."\n";
    } 
    
    if ($erro_query!="") {
      $query_trans="ROLLBACK";
      die("ERRO");
    }
    $conn->query($query_trans);
    if ($erro_query!="") {
      die("CONTATE O ADMINISTRADOR!!\n".$erro_query);
    } else {
      $ID_CODIGO_RETORNO=$ID_PROTOCOLO;
      $query_pgto="SELECT ".TBL_COB_BOLETO.".DT_PAGAMENTO FROM ".TBL_COB_BOLETO." WHERE ID_PROTOCOLO=$ID_PROTOCOLO AND ID_CIDADE_PROTOCOLO=$ID_CIDADE AND DT_PAGAMENTO IS NOT NULL";
      $conn->query($query_pgto);
      $flg_pgto=0;
      if ($conn->num_rows()>0) {
        $flg_pgto=1;
      }
      
     // include ('../../templates/retorno.htm');
?>
<script language="javascript" type="text/javascript">//<!--
<?
  if ($flg_pgto==0) {
?>
if (window.confirm("Pagamente Pendente, Deseja Pagar?")) {
    window.open("./modulos/analise/ranalise.php?txt_id_analise=<?=$ID_ANALISE?>&txt_id_cidade=<?=$ID_CIDADE?>","window_pgto","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=500,innerwidth=780,innerheight=500");
  } else {
    if (window.confirm("Deseja Imprimir Análise!")) {
      window.open("./modulos/analise/ranalise.php?txt_id_analise=<?=$ID_ANALISE?>&txt_id_cidade=<?=$ID_CIDADE?>","relanalise","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
    }
  }
<?
  } else {
?>
  if (window.confirm("Deseja Imprimir Análise!")) {
    window.open("./modulos/analise/ranalise.php?txt_id_analise=<?=$ID_ANALISE?>&txt_id_cidade=<?=$ID_CIDADE?>","relanalise","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
  }
<?
  }
?>
  window.location.href="alt_analise.php";
//--></script>
<?
    }
}
?>
 <script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo1,campo2,arq) {
      if ((campo1.value!="")&&(campo2.value!="")) {
        window.open(arq+"?gerencia="+1+"&campo="+campo1.value+"&campo2="+campo2.value,"consulanalise","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.txt_id_protocolo.readOnly=false;
    }
    function verpend(campo) {
      if (campo.value!="") {
        document.frm_analise.txa_mtv_indeferimento.disabled=false;
        document.frm_analise.hdn_mtv_indeferimento.value=document.frm_analise.txa_mtv_indeferimento.value;
        document.frm_analise.txa_mtv_indeferimento.focus();
      } else {
        document.frm_analise.txa_mtv_indeferimento.disabled=true;
        document.frm_analise.hdn_mtv_indeferimento.value="";
      }
    }
    function verfica_textarea(campo) {
      document.frm_analise.hdn_mtv_indeferimento.value=campo.value;
    }
    function envia(edificacao) {
      var frm_ed = document.frm_analise;
      window.open("./modulos/edificacoes/edificacao_p.php?hdn_id_solicitacao="+frm_ed.hdn_id_solicitacao.value+"&hdn_id_cidade="+frm_ed.hdn_id_cidade.value+"&hdn_id_tipo_solicitacao="+frm_ed.hdn_id_tipo_solicitacao.value+"&hdn_id_edificacao="+edificacao+"&alt=1","cad_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=500,innerwidth=780,innerheight=500")
    }
    function envia_cons_ed() {
      var frm_ed = document.frm_analise;
      window.open("./modulos/edificacoes/consulta_edificacao.php?hdn_id_cidade="+frm_ed.hdn_id_cidade.value,"cons_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=500,innerwidth=780,innerheight=500")
    }
//--></script>
<body onload="ajustaspan()">

<?
 //include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_analise" onreset="retorna(this)" onsubmit="return validaForm(this,'hdn_mtv_indeferimento,Motivo do Indeferimento,t','txt_id_edificacao,Nenhuma Edificação Selecionada,t','hdn_id_carac_edificacao,Nenhum Sistema de Segurança Selecionado,t')">


<input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">



            <table width="95%" cellspacing="0" border="0" cellpadding="5" align="center">
              <tr>
                <td>
                  <fieldset>
                    <legend>Alteração de Análise</legend>
                    <table width="100%" cellspacing="0" border="0" cellpadding="0" align="left">


            <td>Cidade</td>
              <td>
                <select name="hdn_id_cidade" value="" class="campo_obr">
                  <option value="">--------</option>
                  <?
                    //$sql= "SELECT ID_CIDADE, NM_CIDADE, ID_UF FROM ".TBL_CIDADE." WHERE ID_UF ='SC' AND ".TBL_CIDADE.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO = '$userlogin') ORDER BY ID_UF, NM_CIDADE";
                    $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_USUARIO ='".$usuario."' ORDER BY NM_CIDADE";
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

<!-- Cidade -->
<? /*
                        <td>Cidade</td>
                        <td>
                          <?
                              $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_USUARIO ='".$usuario."' ORDER BY NM_CIDADE";
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
                            var campo_destino=document.frm_analise.hdn_id_cidade;
                            var campo_blur = "consultaReg(document.frm_analise.hdn_id_cidade,document.frm_analise.txt_id_protocolo,'analise_cons.php');";
                          //--></script>
                        </td>
*/
?>
<!--  -->

                        <td width="70" align="center">Protocolo</td>
                        <td>
                          <input type="hidden" name="hdn_id_solicitacao" value="">
                          <input type="hidden" name="hdn_id_tipo_solicitacao" value="">
<!--                           <input type="hidden" name="hdn_id_edificacao" value=""> -->
                          <input type="hidden" name="hdn_id_carac_edificacao" value="">
                          <input type="hidden" name="hdn_de_plano_acao" value="">
                          <input type="hidden" name="hdn_id_analise" value="">
                          <input type="text" name="txt_id_protocolo" class="campo_obr" size="15" maxlength="11" value="" title="Número do Protocolo" onblur="consultaReg(document.frm_analise.hdn_id_cidade,this,'./modulos/analise/analise_cons.php')">
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4">
                        <fieldset>
                          <legend>Solicitante</legend>
                          <table width="100%" cellspacing="0" border="0" cellpadding="2" align="center">
                            <tr>
                              <td>CNPJ/CPF</td>
                              <td><input type="text" name="txt_nr_cnpjcpf_solicitante" class="campo_obr" title="CNPJ/CPF do Solicitante" size="20" value="" onblur="cpfcnpj(this)"></td>
                              <td>Nome</td>
                              <td><input type="text" name="txt_nm_solicitante" class="campo_obr" title="Nome do Solicitante do Projeto" size="50" value=""></td>
                            </tr>
                            <tr>
                              <td>Fone</td>
                              <td><input type="text" name="txt_nr_fone_solicitante" class="campo_obr" title="Fone do Solicitante" size="20" value=""></td>
                              <td>E-mail</td>
                              <td><input type="text" name="txt_nm_email_solicitante" class="campo_obr" title="E-mail do Solicitante do Projeto" size="50" value="" style="text-transform : none;"></td>
                            </tr>
                          </table>
                        </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4">
                        <fieldset>
                          <legend>Edificação</legend>
                          <table width="100%" cellspacing="0" border="0" cellpadding="2" align="center">
                            <tr>
                              <td>RE</td>
                              <td>
                                <input type="text" name="txt_id_edificacao" value="" class="campo_obr" size="15" maxlength="10" align="right" readOnly="true">
                              </td>
                              <td>Nome</td>
                              <td colspan="3"><input type="text" name="txt_nm_edificacao" size="50" class="campo_obr" title="Nome da Edificação" value="" readOnly="true"></td>
                            </tr>
                            <tr>
                              <td>Tipo</td>
                              <td>
                                <input type="hidden" name="hdn_id_tp_prefixo" value="">
                                <input type="text" name="txt_nm_tp_prefixo" size="17" class="campo_obr" title="Tipo do Logradouro" value="" readOnly="true">
                              </td>
                              <td>Logradouro</td>
                              <td>
                                <input type="text" size="50" class="campo_obr" value="" name="txt_nm_logradouro" title="Nome do Logradouro" maxlength="100" readOnly="true">
                              </td>
                            </tr>
                            <tr>
                              <td>N°</td>
                              <td><input type="text" size="6" maxlength="5" name="txt_nr_edificacao" align="right" class="campo" title="Número da Edificação no Logradouro" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)" readOnly="true"></td>
                              <td>Bairro</td>
                              <td><input type="text" size="50" maxlength="50" value="" name="txt_nm_bairro" class="campo_obr" title="Nome do Bairro" readOnly="true"></td>
                            </tr>
                            <tr>
                              <td>CEP</td>
                              <td colspan="3"><input type="text" size="11" maxlength="10" name="txt_id_cep" value="" class="campo_obr" title="Número do CEP" onkeypress="return validaTecla(this, event, 'n')" onblur="CEP(this)" readOnly="true"></td>
                            </tr>
                            <tr>
                              <td>Complemento</td>
                              <td><input type="text" name="txt_nm_complemento" class="campo" size="20" maxlength="100" value="" title="Complemento do Endereço da Edificação" readOnly="true"></td>
                              <td>Área Construida</td>
                              <td>
                              <input type="text" align="right" name="txt_vl_area_construida" class="campo_obr" title="Valor da Área Total Construida da Edificação" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)" readOnly="true"><em>(m²)</em>
                              <input name="btn_edificacao" type="button" value="Edificação" class="botao"  onClick="envia_cons_ed()">
                              </td>
                            </tr>
                          </table>
                        </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4">
                          <fieldset>
                          <legend>Análise</legend>
                            <table width="100%" cellspacing="0" border="0" cellpadding="2" align="center">
                              <tr>
                                <td>Analista</td>
                                <td>
<?
  $query_usuario="SELECT NM_USUARIO FROM ".TBL_USUARIO." WHERE ID_USUARIO='$usuario'";
  $conn->query($query_usuario);
  $fetch_usuario=$conn->fetch_row();
?>
                                  <input type="text" name="txt_nm_usuario" size="82" class="campo_obr" title="Nome do Analista" value="<?=$fetch_usuario["NM_USUARIO"]?>" readOnly="true">
                                </td>
                              </tr>
                              <tr>
                                <td>Parecer</td>
                                <td>
                                  <select name="cmb_ch_parecer" class="campo_obr" onchange="verpend(this)">
                                    <option value="">-------------</option>
                                    <option value="D">Deferido</option>
                                    <option value="I">Indeferido</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                  Motivo do Indeferimento<br>
                                  <input type="hidden" name="hdn_mtv_indeferimento" value="">
                                  <textarea name="txa_mtv_indeferimento" cols="105" rows="10" class="campo" disabled="true" onblur="verfica_textarea(this)" style="text-transform : none;"></textarea>
                                </td>
                              </tr>
                            </table>




                          </fieldset>
                        </td>
                      </tr>

 <?
/*

<tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            */
  include('./templates/btn_inc.htm');

?>
                    </table>
<?
/*
 if ((@$_POST["hdn_id_protocolo"]!="") && (@$_POST["hdn_id_cidade"]!="") ){
    $sql="SELECT ".TBL_PROTOCOLOS.".ID_PROTOCOLO, ".TBL_SOLICITACAO.".CNPJ_CPF_SOLICITANTE, ".TBL_SOLICITACAO.".NM_SOLICITANTE, ".TBL_SOLICITACAO.".NR_FONE_SOLICITANTE, ".TBL_SOLICITACAO.".DE_EMAIL_SOLICITANTE, ".TBL_SOLICITACAO.".NM_EDIFICACOES_LX, ".TBL_SOLICITACAO.".NM_LOGRADOURO, ".TBL_SOLICITACAO.".NR_EDIFICACOES_LX, ".TBL_SOLICITACAO.".NR_CEP, ".TBL_SOLICITACAO.".NM_BAIRRO, ".TBL_SOLICITACAO.".NM_COMPLEMENTO, ".TBL_SOLICITACAO.".VL_AREA_CONTRUIDA, ".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO, ".TBL_SOLICITACAO.".ID_SOLICITACAO, ".TBL_SOLICITACAO.".ID_TP_LOGRADOURO,".TBL_PROTOCOLOS.".ID_CIDADE,".TBL_CIDADE.".NM_CIDADE,".TBL_SOLICITACAO.".ID_TP_LOGRADOURO,".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO FROM ".TBL_PROTOCOLOS." JOIN ".TBL_SOLICITACAO." USING(ID_CIDADE,ID_TIPO_SOLICITACAO,ID_SOLICITACAO) JOIN ".TBL_CIDADE." ON (".TBL_CIDADE.".ID_CIDADE=".TBL_SOLICITACAO.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_SOLICITACAO.".ID_TP_LOGRADOURO) WHERE ".TBL_PROTOCOLOS.".ID_PROTOCOLO = ".$_POST["hdn_id_protocolo"]." AND ".TBL_PROTOCOLOS.".ID_CIDADE=".$_POST["hdn_id_cidade"]." AND ".TBL_PROTOCOLOS.".CH_ANALISE='N' AND ".TBL_SOLICITACAO.".CH_PROTOCOLADO='P'";
    echo "<!--aqui :$sql-->\n";
    $conn->query($sql);
    $row_solicita=$conn->num_rows();
    if ($row_solicita>0) {
      $solicitacao=$conn->fetch_row();
      $NM_SOLICITANTE                    =$solicitacao["NM_SOLICITANTE"];
      $NR_FONE_SOLICITANTE         =$solicitacao["NR_FONE_SOLICITANTE"];
      $NR_CNPJCPF_SOLICITANTE    =$solicitacao["CNPJ_CPF_SOLICITANTE"];
      $NM_EMAIL_SOLICITANTE       =$solicitacao["DE_EMAIL_SOLICITANTE"];
      $NM_EDIFICACAO                      =$solicitacao["NM_EDIFICACOES_LX"];
      $NM_LOGRADOURO                  =$solicitacao["NM_LOGRADOURO"];
      $NR_EDIFICACAO                      =$solicitacao["NR_EDIFICACOES_LX"];
      $NM_BAIRRO                              =$solicitacao["NM_BAIRRO"];
      $NR_CEP                                      =$solicitacao["NR_CEP"];
      $ID_CIDADE                                =$solicitacao["ID_CIDADE"];
      $ID_TP_PREFIXO                        =$solicitacao["ID_TP_LOGRADOURO"];
      $NM_COMPLEMENTO               =$solicitacao["NM_COMPLEMENTO"];
      $VL_AREA_CONSTRUIDA          =$solicitacao["VL_AREA_CONTRUIDA"];
      $NM_CIDADE                              =$solicitacao["NM_CIDADE"];
      $ID_TP_LOGRADOURO               =$solicitacao["ID_TP_LOGRADOURO"];
      $NM_TP_LOGRADOURO            =$solicitacao["NM_TP_LOGRADOURO"];
      $ID_TIPO_SOLICITACAO            =$solicitacao["ID_TIPO_SOLICITACAO"];
      $ID_SOLICITACAO                       =$solicitacao["ID_SOLICITACAO"];
      $ID_PROTOCOLO                         =$solicitacao["ID_PROTOCOLO"];
?>
<script language="javascript" type="text/javascript">//<!--
var frm_at=document.frm_analise;
frm_at.txt_id_protocolo.readOnly=true;
frm_at.txt_id_protocolo.value="<?=$ID_PROTOCOLO?>";
frm_at.hdn_id_tipo_solicitacao.value="<?=$ID_TIPO_SOLICITACAO?>";
frm_at.hdn_id_solicitacao.value="<?=$ID_SOLICITACAO?>";
frm_at.txt_nm_solicitante.value="<?=$NM_SOLICITANTE?>";
frm_at.txt_nm_solicitante.readOnly=true;
frm_at.txt_nr_fone_solicitante.value="<?=$NR_FONE_SOLICITANTE?>";
frm_at.txt_nr_fone_solicitante.readOnly=true;
frm_at.txt_nr_cnpjcpf_solicitante.value="<?=$NR_CNPJCPF_SOLICITANTE?>";
cpfcnpj(frm_at.txt_nr_cnpjcpf_solicitante);
frm_at.txt_nr_cnpjcpf_solicitante.readOnly=true;
frm_at.txt_nm_email_solicitante.value="<?=$NM_EMAIL_SOLICITANTE?>";
frm_at.txt_nm_email_solicitante.readOnly=true;
frm_at.txt_nm_edificacao.value="<?=$NM_EDIFICACAO?>";
frm_at.txt_nm_edificacao.readOnly=true;
frm_at.txt_nm_logradouro.value="<?=$NM_LOGRADOURO?>";
frm_at.txt_nr_edificacao.value="<?=$NR_EDIFICACAO?>";
FormatNumero(frm_at.txt_nr_edificacao);
frm_at.txt_nm_bairro.value="<?=$NM_BAIRRO?>";
frm_at.txt_id_cep.value="<?=$NR_CEP?>";
CEP(frm_at.txt_id_cep);
frm_at.txt_vl_area_construida.value="<?=str_replace(".",",",$VL_AREA_CONSTRUIDA)?>";
FormatNumero(frm_at.txt_vl_area_construida);
decimal(frm_at.txt_vl_area_construida,2);
frm_at.txt_nm_complemento.value="<?=$NM_COMPLEMENTO?>";
frm_at.hdn_id_cidade.value="<?=$ID_CIDADE?>";
frm_at.txt_nm_cidade.value="<?=$NM_CIDADE?>";
frm_at.hdn_id_tp_prefixo.value="<?=$ID_TP_LOGRADOURO?>";
frm_at.txt_nm_tp_prefixo.value="<?=$NM_TP_LOGRADOURO?>";
frm_at.hdn_mtv_indeferimento.value=1;

//-->
</script>
<?
  }
}
*/
?>
                  </fieldset>
                </td>
              </tr>
            </table>
<!--<script language="javascript" type="text/javascript">//<!
document.frm_analise.btn_incluir.value="Alterar";
document.frm_analise.btn_incluir.disabled=true;
document.frm_analise.btn_incluir.style.backgroundImage="url('../../imagens/botao2.gif')";
document.frm_analise.hdn_controle.value="2";
document.frm_analise.btn_edificacao.disabled=true;
document.frm_analise.btn_edificacao.style.backgroundImage="url('../../imagens/botao2.gif')";

//--></script>
          </form>
<?
 // include ('../../templates/footer.htm');
?>

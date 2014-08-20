<?
  $erro="";
  if (isset($_GET["form_padrao"])) {
    $form_padrao=$_GET["form_padrao"];
  } else {
    $form_padrao=$_POST["form_padrao"];
  }
  require_once 'lib/loader.php';
  $arquivo="edificacao.php";
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
  if ((@$_POST["hdn_carrega"]==1)&&(@$_POST["hdn_id_cidade"]!="")&&(@$_POST["hdn_id_edificacao"]!="")) {
    $query_ed="SELECT ".TBL_EDIFICACAO.".ID_EDIFICACAO, ".TBL_EDIFICACAO.".NM_EDIFICACAO, ".TBL_EDIFICACAO.".NM_FANTASIA_1, ".TBL_EDIFICACAO.".NM_FANTASIA_2, ".TBL_EDIFICACAO.".NR_EDIFICACAO, ".TBL_EDIFICACAO.".ID_CEP, ".TBL_EDIFICACAO.".NM_COMPLEMENTO, ".TBL_EDIFICACAO.".VL_AREA_CONSTRUIDA, ".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO, ".TBL_LOGRADOURO.".ID_LOGRADOURO ,".TBL_LOGRADOURO.".NM_LOGRADOURO, ".TBL_BAIRROS.".ID_BAIRROS, ".TBL_BAIRROS.".NM_BAIRROS, ".TBL_CIDADE.".ID_CIDADE ,".TBL_CIDADE.".NM_CIDADE, ".TBL_EDIFICACAO.".ID_RISCO, ".TBL_EDIFICACAO.".ID_SITUACAO, ".TBL_EDIFICACAO.".ID_TP_CONSTRUCAO, ".TBL_EDIFICACAO.".ID_OCUPACAO, ".TBL_EDIFICACAO.".VL_ALTURA, ".TBL_EDIFICACAO.".VL_AREA_TIPO, ".TBL_EDIFICACAO.".NR_PAVIMENTOS, ".TBL_EDIFICACAO.".NR_BLOCOS, ".TBL_PESSOA.".ID_CNPJ_CPF, ".TBL_PESSOA.".NM_PESSOA, ".TBL_PESSOA.".NR_FONE, ".TBL_PESSOA.".DE_EMAIL_PESSOA FROM ".TBL_EDIFICACAO." LEFT JOIN ".TBL_PESSOA." ON (".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO=".TBL_PESSOA.".ID_CNPJ_CPF AND ".TBL_EDIFICACAO.".ID_CIDADE_PESSOA=".TBL_PESSOA.".ID_CIDADE) LEFT JOIN ".TBL_CIDADE." ON (".TBL_EDIFICACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_EDIFICACAO.".ID_CEP=".TBL_CEP.".ID_CEP AND ".TBL_EDIFICACAO.".ID_CIDADE_CEP=".TBL_CEP.".ID_CIDADE AND ".TBL_EDIFICACAO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO) LEFT JOIN ".TBL_LOGRADOURO." ON (".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) WHERE ".TBL_EDIFICACAO.".ID_CIDADE=".$_POST["hdn_id_cidade"]." AND ".TBL_EDIFICACAO.".ID_EDIFICACAO=".$_POST["hdn_id_edificacao"];
    // echo "<!--aqui:\n$query_ed\n-->\n";
    $res= $conn->query($query_ed);
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $edificacao=$conn->fetch_row();
?>
  <script language="javascript" type="text/javascript">//<!--
    window.opener.document.<?=$form_padrao?>.txt_nm_edificacao.value="<?=$edificacao["NM_EDIFICACAO"]?>";
    window.opener.document.<?=$form_padrao?>.txt_id_edificacao.value="<?=$edificacao["ID_EDIFICACAO"]?>";
    window.opener.document.<?=$form_padrao?>.hdn_id_tp_logradouro.value="<?=$edificacao["ID_TP_LOGRADOURO"]?>";
    window.opener.document.<?=$form_padrao?>.txt_nm_tp_logradouro.value="<?=$edificacao["NM_TP_LOGRADOURO"]?>";
    window.opener.document.<?=$form_padrao?>.txt_nm_logradouro.value="<?=$edificacao["NM_LOGRADOURO"]?>";
    window.opener.document.<?=$form_padrao?>.txt_nr_edificacao.value="<?=$edificacao["NR_EDIFICACAO"]?>";
    window.opener.document.<?=$form_padrao?>.txt_nm_bairro.value="<?=$edificacao["NM_BAIRROS"]?>";
<?
  if ($form_padrao=="frm_edificacao") {
?>
    window.opener.document.<?=$form_padrao?>.txt_nm_fantasia_1.value="<?=$edificacao["NM_FANTASIA_1"]?>";
    window.opener.document.<?=$form_padrao?>.txt_nm_fantasia_2.value="<?=$edificacao["NM_FANTASIA_2"]?>";
    window.opener.document.<?=$form_padrao?>.txt_nr_cep.value="<?=$edificacao["ID_CEP"]?>";
    CEP(window.opener.document.<?=$form_padrao?>.txt_nr_cep);
    window.opener.document.<?=$form_padrao?>.hdn_id_cep.value="<?=$edificacao["ID_CEP"]?>";
    window.opener.document.<?=$form_padrao?>.hdn_id_logradouro.value="<?=$edificacao["ID_LOGRADOURO"]?>";
    window.opener.document.<?=$form_padrao?>.cmb_id_cidade.value="<?=$edificacao["ID_CIDADE"]?>";
    window.opener.document.<?=$form_padrao?>.txt_nr_cnpjcpf_proprietario.value="<?=$edificacao["ID_CNPJ_CPF"]?>";
    cpfcnpj(window.opener.document.<?=$form_padrao?>.txt_nr_cnpjcpf_proprietario);
    window.opener.document.<?=$form_padrao?>.txt_nm_proprietario.value="<?=$edificacao["NM_PESSOA"]?>";
    window.opener.document.<?=$form_padrao?>.txt_nr_fone_proprietario.value="<?=$edificacao["NR_FONE"]?>";
    window.opener.document.<?=$form_padrao?>.txt_de_email_proprietario.value="<?=$edificacao["DE_EMAIL_PESSOA"]?>";
    window.opener.document.<?=$form_padrao?>.txt_vl_altura.value="<?=str_replace(".",",",$edificacao["VL_ALTURA"])?>";
    FormatNumero(window.opener.document.<?=$form_padrao?>.txt_vl_altura);
    decimal(window.opener.document.<?=$form_padrao?>.txt_vl_altura,2);
    window.opener.document.<?=$form_padrao?>.txt_vl_area_pavimento.value="<?=str_replace(".",",",$edificacao["VL_AREA_TIPO"])?>";
    FormatNumero(window.opener.document.<?=$form_padrao?>.txt_vl_area_pavimento);
    decimal(window.opener.document.<?=$form_padrao?>.txt_vl_area_pavimento,2);
    window.opener.document.<?=$form_padrao?>.cmb_id_risco.value="<?=$edificacao["ID_RISCO"]?>";
    window.opener.document.<?=$form_padrao?>.cmb_id_ocupacao.value="<?=$edificacao["ID_OCUPACAO"]?>";
    window.opener.document.<?=$form_padrao?>.cmb_id_situacao.value="<?=$edificacao["ID_SITUACAO"]?>";
    window.opener.document.<?=$form_padrao?>.cmb_id_tp_construcao.value="<?=$edificacao["ID_TP_CONSTRUCAO"]?>";
    window.opener.document.<?=$form_padrao?>.cmb_nr_pavimentos.value="<?=$edificacao["NR_PAVIMENTOS"]?>";
    window.opener.document.<?=$form_padrao?>.cmb_nr_blocos.value="<?=$edificacao["NR_BLOCOS"]?>";
    window.opener.document.<?=$form_padrao?>.btn_incluir.value="Alterar";
    window.opener.document.<?=$form_padrao?>.hdn_controle.value="2";

<?
  } else {
?>
    window.opener.document.<?=$form_padrao?>.txt_id_cep.value="<?=$edificacao["ID_CEP"]?>";
    CEP(window.opener.document.<?=$form_padrao?>.txt_id_cep);
    window.opener.document.<?=$form_padrao?>.txt_nm_cidade.value="<?=$edificacao["NM_CIDADE"]?>";
<?
  }
?>
    window.opener.document.<?=$form_padrao?>.hdn_id_cidade.value="<?=$edificacao["ID_CIDADE"]?>";
    window.opener.document.<?=$form_padrao?>.txt_nm_complemento.value="<?=$edificacao["NM_COMPLEMENTO"]?>";
    window.opener.document.<?=$form_padrao?>.txt_vl_area_construida.value="<?=str_replace(".",",",$edificacao["VL_AREA_CONSTRUIDA"])?>";
    FormatNumero(window.opener.document.<?=$form_padrao?>.txt_vl_area_construida);
    decimal(window.opener.document.<?=$form_padrao?>.txt_vl_area_construida,2);
    window.close();
  //--></script>

<?
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function ed_seta(edificacao,cidade) {
      document.frm_consulta_edifcacao.hdn_id_cidade.value=cidade;
      document.frm_consulta_edifcacao.hdn_id_edificacao.value=edificacao;
    }
    function novo_reg() {
      window.opener.envia(0);
      window.close();
    }
    function alterar_reg() {
      window.opener.envia(document.frm_consulta_edifcacao.hdn_id_edificacao.value);
      window.close();
    }
    function carregar_reg() {
      document.frm_consulta_edifcacao.hdn_carrega.value="1";
      document.frm_consulta_edifcacao.submit();
    }
    function ajustaspan1() {
      var obj=document.getElementById("corpo");
      var objln=document.getElementById("lncorpo");
      var objtb=document.getElementById("tbcorpo");
        obj.style.height="290px";
        objln.style.height="295px";
        objtb.style.marginLeft="0px";
    }
//--></script>
<body onload="ajustaspan1()">
  <form target="_self" enctype="multipart/form-data" method="post" name="frm_consulta_edifcacao" onreset="retorna(this)" onsubmit="return validaForm(this,'txt_pesq_edificacao,Nome da Pesquisa,t')">
  <fieldset>
  <legend>Consulta Edificação</legend>
    <table width="100%" border="0" cellpadding="2" cellspacing="2" align="center">
    <head>
	<link rel="stylesheet" type="text/css" href="./../../css/menu.css">
	<link type="text/css" rel="stylesheet" href="./../../css/calendario.css" />
	<link rel="stylesheet" type="text/css" href="./../../css/ebombeiro.css">
    </head>
    <tr>
	<table width="100%" border="0" cellpadding="2" cellspacing="2" align="center">
	  <tr>
	    <td align="left">
		    <input type="hidden" name="hdn_form" value="<?=$form_padrao?>">
		    <input type="hidden" name="hdn_id_cidade" value="">
		    <input type="hidden" name="hdn_id_edificacao" value="">
		    <input type="hidden" name="hdn_carrega" value="">
		  Tipo de Pesquisa
		  <select name="cmb_campo" >
		    <option value="NM_EDIFICACAO_FONETICA">Nome da Edificação</option>
		    <option value="NM_FANTASIA_FONETICA_1">Nome da Fantasia 1</option>
		    <option value="NM_FANTASIA_FONETICA_2">Nome da Fantasia 2</option>
		  </select>
		    <input type="text" name="txt_pesq_edificacao" size="48" value="" class="campo_obr" title="Nome da Edificação">
	    </td>
	    <td align="left">
		  <input type="submit" name="btn_pesquisa" value="Pesquisar" class="botao"  title="Pesquisa Edificação">
	    </td>
	  </tr>
	  <tr>
	  <td colspan=4>
	      <table width="100%" border="0" cellpadding="2" cellspacing="2" align="center">
		<tr style="font-weight : bold;">
		<td> Seleção</td>
		    <td>Nome Edificação</td>
		    <td>Nome Fantasia 1</td>
		    <td>Nome Fantasia 2</td>
		</tr>
	      <?

	      if ((@$_POST["cmb_campo"]!="")&&(@$_POST["txt_pesq_edificacao"]!="")&&(@$_POST["hdn_id_cidade"]!="")) {
		$pesquisa_fo=nr_txt_fonetica($_POST["txt_pesq_edificacao"]);
		$query="SELECT ".TBL_EDIFICACAO.".ID_EDIFICACAO,".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_EDIFICACAO.".NM_EDIFICACAO, ".TBL_EDIFICACAO.".NM_FANTASIA_1, ".TBL_EDIFICACAO.".NM_FANTASIA_2 FROM ".TBL_EDIFICACAO." WHERE ".TBL_EDIFICACAO.".ID_CIDADE=".$_POST["hdn_id_cidade"]." AND ".TBL_EDIFICACAO.".".$_POST["cmb_campo"]." LIKE '%".$pesquisa_fo."%' ORDER BY ".TBL_EDIFICACAO.".".$_POST["cmb_campo"];

		$conn->query($query);
		  if ($conn->get_status()==false) {
		    die($conn->get_msg());
		  }
		$rows=$conn->num_rows();
		  if ($rows>0) {
		    $cont=1;
		    while ($tupula = $conn->fetch_row()) {
		    $resto=$cont%2;
		    if ($resto!=0) {
	      ?>
		    <tr style="background-color : #f5f5f5;">
	      <?
		    } else {
	      ?>
		    <tr style="background-color : #ffffff;">
	      <?
		    }
		  $cont++;
	      ?>
		  <td><input type="radio" name="rdn_edificacoa" onChange="ed_seta('<?=$tupula["ID_EDIFICACAO"]?>','<?=$tupula["ID_CIDADE"]?>')"></td>
		      <td><?=$tupula["NM_EDIFICACAO"]?></td>
		      <td><?=$tupula["NM_FANTASIA_1"]?></td>
		      <td><?=$tupula["NM_FANTASIA_2"]?></td>
		  </tr>
	      <?
		  }
		}
	      }
	      ?>
	      </table>
	  </td>
	  </tr>
	  </table>
    </fieldset>
	<?
	    include('/var/www/bombeiro/templates/btn_cons.htm');
	?>
    </form>
    <?
    if ($form_padrao=="frm_edificacao") {
    ?>
	<script language="javascript" type="text/javascript">
	    document.frm_consulta_edifcacao.btn_novo.disabled=true;
	    document.frm_consulta_edifcacao.btn_novo.style.visibility="hidden";
	    document.frm_consulta_edifcacao.btn_alterar.disabled=true;
	    document.frm_consulta_edifcacao.btn_alterar.style.visibility="hidden";
	</script>
	<?
	}
	?>
	    <script language="javascript" type="text/javascript">//<!--
	<?
	    if (@$_GET["hdn_id_cidade"]!="") {
	?>
	    document.frm_consulta_edifcacao.hdn_id_cidade.value="<?=$_GET["hdn_id_cidade"]?>";
	<?
	    } elseif (@$_POST["hdn_id_cidade"]!="") {
	?>
	    document.frm_consulta_edifcacao.hdn_id_cidade.value="<?=$_POST["hdn_id_cidade"]?>";
	<?
	    } else {
	?>
	    window.opener.alert("A Cidade Deve Ser Selecionada!!");
	    window.close();
	<?
	    }
	?>
	//-->
	</script>
    </span>
    </td>
    </tr>
    </tbody>
</table>
  </body>
</html>

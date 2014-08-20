<? //echo "<pre>"; print_r($_GET); echo "</pre>";

  $arquivo="edificacao.php";
  require_once 'lib/loader.php';

  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) die($conn->get_msg());

  $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row();

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

  if ($_GET['hdn_nr_edificacao'] and $_GET['hdn_id_logradouro']) {

	$NR_EDIFICACAO = $_GET['hdn_nr_edificacao'];
	$ID_LOGRADOURO = $_GET['hdn_id_logradouro'];
	$ID_CIDADE = $_GET['hdn_id_cidade'];

	$sql = "SELECT ".
		TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".
		TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO,".
		TBL_LOGRADOURO.".ID_BAIRROS ID_BAIRROS,NM_BAIRROS,ID_CEP,".
		TBL_LOGRADOURO.".ID_CIDADE ID_CIDADE,NM_CIDADE, ".
		TBL_CEP.".CH_AGUARDO AS CH_AGUARDO_CEP, ".
		TBL_LOGRADOURO.".CH_AGUARDO AS CH_AGUARDO_LOG, ".
		TBL_BAIRROS.".CH_AGUARDO AS CH_AGUARDO_BAIRRO,".
		TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO ".
	"FROM ".TBL_LOGRADOURO." ".
		"LEFT JOIN ".TBL_CIDADE." ON (".
			TBL_LOGRADOURO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) ".
		"LEFT JOIN ".TBL_CEP." ON (".
			TBL_LOGRADOURO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".
			TBL_LOGRADOURO.".ID_CIDADE=".TBL_CEP.".ID_CIDADE) ".
		"LEFT JOIN ".TBL_UF." ON (".
			TBL_CIDADE.".ID_UF=".TBL_UF.".ID_UF) ".
		"LEFT JOIN ".TBL_BAIRROS." ON (".
			TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".
			TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) ".
		"LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".
			TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) ".
		"WHERE ".
			TBL_LOGRADOURO.".ID_LOGRADOURO = '$ID_LOGRADOURO' AND ".
			TBL_LOGRADOURO.".ID_CIDADE = '$ID_CIDADE' ";
	$conn->query($sql);
	$edificacao = $conn->fetch_row();
	
	$sql = "SELECT ".TBL_EDIFICACAO.".ID_EDIFICACAO FROM ".TBL_EDIFICACAO." WHERE ".
		TBL_EDIFICACAO.".NR_EDIFICACAO = '$NR_EDIFICACAO' AND ".
		TBL_EDIFICACAO.".ID_LOGRADOURO = '$ID_LOGRADOURO' AND ".
		TBL_EDIFICACAO.".ID_CIDADE = '$ID_CIDADE'";
	//echo "sql: $sql";
	$conn->query($sql);
	$r = $conn->fetch_row();
	$id_edificacao = $r['ID_EDIFICACAO'];
	$encontrou = $nao_confirmou = false;
	if ($id_edificacao) $encontrou = true;

  } elseif (isset($_GET["txt_nm_logradouro"])) {

    if (isset($_GET["hdn_limit"])) {
      $limit=$_GET["hdn_limit"];
    } else {
      $limit=0;
    }
    $restringir=10;

    $NM_LOGRADOURO=$_GET["txt_nm_logradouro"];
    $ID_CIDADE=$_GET["hdn_id_cidade"];
	$NR_EDIFICACAO=$_GET["txt_nr_edificacao"];

    if ($NM_LOGRADOURO!="") {
      $NM_FONETICA=nr_txt_fonetica($NM_LOGRADOURO);
    } else {
      $NM_FONETICA="";
    }
    if ($NM_FONETICA!="") {
      if ((!isset($_GET["hdn_fim"]))||(@$_GET["hdn_fim"]=="")) {
        $query="SELECT ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO,NM_BAIRROS,ID_CEP,".TBL_LOGRADOURO.".ID_CIDADE ID_CIDADE,NM_CIDADE, ".TBL_CEP.".CH_AGUARDO AS CH_AGUARDO_CEP, ".TBL_LOGRADOURO.".CH_AGUARDO AS CH_AGUARDO_LOG, ".TBL_BAIRROS.".CH_AGUARDO AS CH_AGUARDO_BAIRRO,".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO FROM ".TBL_LOGRADOURO." LEFT JOIN ".TBL_CIDADE." ON (".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_LOGRADOURO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CEP.".ID_CIDADE) LEFT JOIN ".TBL_UF." ON (".TBL_CIDADE.".ID_UF=".TBL_UF.".ID_UF) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_LOGRADOURO.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_LOGRADOURO.".ID_CIDADE =$ID_CIDADE";
        $conn->query($query);
        if ($conn->get_status()==false) {
          die($conn->get_msg());
        }
        $rows=$conn->num_rows();
        $fim=(ceil($rows/$restringir)-1);
      } else {
        $fim=$_GET["hdn_fim"];
      }
      
      if (@$fim<1) {
        $fim="";
      }
      if ($limit=="") {
        $limit=0;
      }
      $query="SELECT ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO,".TBL_LOGRADOURO.".ID_BAIRROS ID_BAIRROS,NM_BAIRROS,ID_CEP,".TBL_LOGRADOURO.".ID_CIDADE ID_CIDADE,NM_CIDADE, ".TBL_CEP.".CH_AGUARDO AS CH_AGUARDO_CEP, ".TBL_LOGRADOURO.".CH_AGUARDO AS CH_AGUARDO_LOG, ".TBL_BAIRROS.".CH_AGUARDO AS CH_AGUARDO_BAIRRO,".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO FROM ".TBL_LOGRADOURO." LEFT JOIN ".TBL_CIDADE." ON (".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_LOGRADOURO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CEP.".ID_CIDADE) LEFT JOIN ".TBL_UF." ON (".TBL_CIDADE.".ID_UF=".TBL_UF.".ID_UF) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_LOGRADOURO.".NM_FONETICA LIKE '%".$NM_FONETICA."%' AND ".TBL_LOGRADOURO.".ID_CIDADE =$ID_CIDADE ORDER BY ".TBL_LOGRADOURO.".NM_LOGRADOURO LIMIT ".$limit." , 10";
    } else {
      $fim="";
      $limit=0;
      $query="SELECT ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO ID_TP_LOGRADOURO,".TBL_LOGRADOURO.".ID_LOGRADOURO ID_LOGRADOURO,NM_LOGRADOURO,".TBL_LOGRADOURO.".ID_BAIRROS ID_BAIRROS,NM_BAIRROS,ID_CEP,".TBL_LOGRADOURO.".ID_CIDADE ID_CIDADE,NM_CIDADE, ".TBL_CEP.".CH_AGUARDO AS CH_AGUARDO_CEP, ".TBL_LOGRADOURO.".CH_AGUARDO AS CH_AGUARDO_LOG, ".TBL_BAIRROS.".CH_AGUARDO AS CH_AGUARDO_BAIRRO,".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO FROM ".TBL_LOGRADOURO." LEFT JOIN ".TBL_CIDADE." ON (".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_LOGRADOURO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CEP.".ID_CIDADE) LEFT JOIN ".TBL_UF." ON (".TBL_CIDADE.".ID_UF=".TBL_UF.".ID_UF) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_LOGRADOURO.".ID_LOGRADOURO=0 AND ".TBL_LOGRADOURO.".ID_CIDADE = $ID_CIDADE ORDER BY ".TBL_LOGRADOURO.".NM_LOGRADOURO LIMIT ".$limit." , 10";
    }

    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
//     echo "aqui:$rows\n";
?>
<body>
<script language="javascript" type="text/javascript">//<!--
function sbmit () {
  if (document.form1.hdn_nome.value!=document.form1.txt_nm_logradouro.value) {
    document.form1.hdn_limit.value=0;
    document.form1.hdn_fim.value="";
  }
  window.document.form1.submit();
}
function consulta_ret(id_prefixo,id_logradouro,nm_logradouro,nm_bairros,id_cep,nm_prefixo) {
  var frm=window.opener.document.frm_edificacao;
  frm.hdn_id_tp_logradouro.value=id_prefixo;
  frm.txt_nm_tp_logradouro.value=nm_prefixo
  frm.hdn_id_logradouro.value=id_logradouro;
  frm.txt_nm_logradouro.value=nm_logradouro;
  frm.txt_nm_bairro.value=nm_bairros;
  frm.txt_nr_cep.value=id_cep;
  frm.hdn_id_cep.value=id_cep;
  CEP(frm.txt_nr_cep);
  frm.txt_nm_complemento.focus();
}
function novo_reg() {
  window.opener.cad_log();
  window.close();
}
function carregar_reg() {
document.form1.hdn_carrega.value="1";
document.form1.submit();

}
function testar_numero(f,NR_EDIFICACAO,ID_LOGRADOURO) {
  f.hdn_nr_edificacao.value = NR_EDIFICACAO;
  f.hdn_id_logradouro.value = ID_LOGRADOURO;
  f.submit();
}
//-->
</script>

<form method="GET" target="_self" name="form1" onsubmit="sbmit()">
  <fieldset>
  <legend>Consulta Logradouro</legend>
    <table width="100%" border="0" cellpadding="2" cellspacing="2" align="center">
    <head>
      <link rel="stylesheet" type="text/css" href="./../../css/menu.css">
      <link type="text/css" rel="stylesheet" href="./../../css/calendario.css" />
      <link rel="stylesheet" type="text/css" href="./../../css/ebombeiro.css">
    </head>
  <tr>

    <table width="100%" cellspacing="5" border="0" cellpadding="2" align="center">
      <tr valign="center">
	<td align="left">Logradouro
	    <input type="text" size="70" maxlength="100" class="campo_obr" value="<?=$NM_LOGRADOURO?>" name="txt_nm_logradouro">
	    <input type="hidden" name="hdn_limit" value="">
	    <input type="hidden" name="hdn_fim" value="<?=$fim?>">
	    <input type="hidden" name="hdn_nome" value="<?=$NM_LOGRADOURO?>">
	    <input type="hidden" name="hdn_id_cidade" value="<?=$ID_CIDADE?>">
	    <input type="hidden" name="txt_nr_edificacao" value="<?=$_GET['txt_nr_edificacao']?>">
	    <input type="hidden" name="hdn_nr_edificacao" value="">
	    <input type="hidden" name="hdn_id_logradouro" value="">
	    <input type="button" name="btn_consulta" value="Consulta" title="Nova Consulta" class="botao" onclick="sbmit()"></td>
      </tr>
      <tr valign="center">
	<td colspan="1">
    <?
	if ($rows>0) {
    ?>
	<table width="100%" border="0" cellpadding="2" cellspacing="2" align="center">
	  <tr>
	    <th>LOGRADOURO</th>
	    <th>BAIRRO</th>
	    <th>CEP</th>
	    <th>AGUARDA VALIDAÇÃO</th>
	  </tr>
	<?
	  while ($tupula = $conn->fetch_row()) {
	    if (($tupula["CH_AGUARDO_CEP"]=="S")||($tupula["CH_AGUARDO_LOG"]=="S")||($tupula["CH_AGUARDO_BAIRRO"]=="S")) {
	      $CH_AGUARDO="SIM";
	    } else {
	      $CH_AGUARDO="NÃO";
	    }
	    if ($cor == '#f5f5f5') $cor = '#ffffff'; else $cor = '#f5f5f5';
	?>
	  <tr style="cursor:pointer" bgcolor="<?=$cor;?>" onclick="testar_numero(form1,'<?=$NR_EDIFICACAO?>','<?=$tupula["ID_LOGRADOURO"]?>')">

	    <td><?=$tupula["NM_LOGRADOURO"];?></td>
	    <td align="center"><?=$tupula["NM_BAIRROS"];?></td>
	    <td align="center"><?=formatCEP($tupula["ID_CEP"]);?></td>
	    <td align="center"><?=$CH_AGUARDO?></td>
	  </tr>
	<?
		}
		$limit_ant=$limit-$restringir;
		$limit+=$restringir;
	?>
	<script language="javascript" type="text/javascript">
	function envia(tipo) { alert(tipo);
	  switch (tipo) {
	    case 1:
	      document.form1.hdn_limit.value='0';
	      break;
	    case 2:
	      document.form1.hdn_limit.value='<?=$limit_ant?>';
	      break;
	    case 3:
	      document.form1.hdn_limit.value='<?=$limit?>';
	      break;
	    case 4:
	      document.form1.hdn_limit.value='<?=$fim*10?>';
	      break;
	  }
	  document.form1.submit();
	}
	</script>

	    <table width="100%" cellspacing="5" border="0" cellpadding="0" align="center"> 
	      <tr>
	    <?
		  if ($limit_ant>=0) {
	    ?>
		    <td><input type="button" value="Primeiro" name="btn_primeiro" title="Primeiros 10 Registros" onclick="envia(1)" class="botao" ></td>
		    <td><input type="button" value="Anterior" name="btn_anterior" title="10 Registros Anteriores" onclick="envia(2)" class="botao" ></td>
	    <?
		  } else {
	    ?>
		    <td><input type="button" value="Primeiro" name="btn_primeiro" title="Primeiros 10 Registros" onclick="envia(1)" class="botao" disabled="true"></td>
		    <td><input type="button" value="Anterior" name="btn_anterior" title="10 Registros Anteriores" onclick="envia(2)" class="botao" disabled="true"></td>
	    <?
		  }if (($fim*10)>=$limit) {
	    ?>
		    <td><input type="button" value="Próximo" name="btn_proximo" title="Próximos 10 Registros" onclick="envia(3)" class="botao"></td>
		    <td><input type="button" value="Último" name="btn_ultimo" title="Últimos 10 Registros" onclick="envia(4)" class="botao" ></td>
	    <?
		  } else {
	    ?>
		    <td><input type="button" value="Próximo" name="btn_proximo" title="Próximos 10 Registros" onclick="envia(3)" class="botao" disabled="true"></td>
		    <td><input type="button" value="Último" name="btn_ultimo" title="Últimos 10 Registros" onclick="envia(4)" class="botao" disabled="true"></td>
	    <?
		  }
	    ?>
	      </tr>
	    </table>
	</table>
	</td>
      </tr>
    </table>

  </fieldset>
  <?
	  } else {
  ?>
  <script language="javascript" type="text/javascript">
  //<!--
    alert("Registros não encontrados!!!");
    <?="//".$NM_FONETICA?>
  </script>
  <?
      }
  ?>

  <?
    $global_alteracao="N";
    $cons_log="S";
  ?>

</form>
<? } ?>

<?
if($_GET['hdn_nr_edificacao'] and $_GET['hdn_id_logradouro']) {

	$r = $edificacao;

	if ($encontrou) {

		?><script language="javascript" type="text/javascript">

			var frm = window.opener.document.frm_edificacao;

			if (confirm ("Já existe uma edificação para este endereço, deseja cadastrar uma nova RE?")) {
				frm.hdn_id_tp_logradouro.value="<?=$r["ID_TP_LOGRADOURO"]?>";
				frm.txt_nm_tp_logradouro.value="<?=$r["NM_TP_LOGRADOURO"]?>";
				frm.hdn_id_logradouro.value="<?=$r["ID_LOGRADOURO"]?>";
				frm.txt_nm_logradouro.value="<?=$r["NM_LOGRADOURO"]?>";
				frm.txt_nm_bairro.value="<?=$r["NM_BAIRROS"]?>";
				frm.txt_nr_cep.value="<?=$r["ID_CEP"]?>";
				frm.hdn_id_cep.value="<?=$r["ID_CEP"]?>";
				CEP(frm.txt_nr_cep);
				frm.txt_nm_complemento.focus();

			} else {
				frm.hdn_id_tp_logradouro.value="";
				frm.txt_nm_tp_logradouro.value="";
				frm.hdn_id_logradouro.value="";
				frm.txt_nm_logradouro.value="";
				frm.txt_nm_bairro.value="";
				frm.txt_nr_cep.value="";
				frm.hdn_id_cep.value="";
				frm.txt_nm_complemento.focus();
			}
			window.close();

		</script><?
	} else {
		?>
		<script language="javascript" type="text/javascript">
			var frm = window.opener.document.frm_edificacao;
			frm.hdn_id_tp_logradouro.value="<?=$r["ID_TP_LOGRADOURO"]?>";
			frm.txt_nm_tp_logradouro.value="<?=$r["NM_TP_LOGRADOURO"]?>";
			frm.hdn_id_logradouro.value="<?=$r["ID_LOGRADOURO"]?>";
			frm.txt_nm_logradouro.value="<?=$r["NM_LOGRADOURO"]?>";
			frm.txt_nm_bairro.value='<?=$r["NM_BAIRROS"]?>';
			frm.txt_nr_cep.value="<?=$r["ID_CEP"]?>";
			frm.hdn_id_cep.value="<?=$r["ID_CEP"]?>";
			CEP(frm.txt_nr_cep);
			frm.txt_nm_complemento.focus();
			window.close();
		</script>
		<?
	}
}
?>
<table width="100%" cellspacing="5" border="0" cellpadding="2" align="center">
  <?
    include('/var/www/bombeiro/templates/btn_cons.htm');
  ?>
</table>
</body>
</html>
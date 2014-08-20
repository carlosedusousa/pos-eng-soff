<?	//echo "<pre>POST: "; print_r($_POST); echo "</pre><pre>GET: "; print_r($_GET); echo "</pre>";//exit;
	//include ('../../templates/head.htm');

  $erro= "";
  require_once 'lib/loader.php';

  $arquivo="source_acomp.php";
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";

  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  }
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();
	
  @$NR_CPF_CNPJ		= formataCampo($_POST["txt_nome"],'VN');
  @$NR_CPF_CNPJ_AUX	= formatCPFCNPJ(str_replace("-","",str_replace(".","",$_POST["txt_nome"])));
  $ID_CIDADE		= $_POST["cmb_id_cidade"];
  $NOME				= $_POST["txt_nome"];
  $TP_DOC			= $_POST["pesquisa"];



  switch (@$_POST['select_deferimento']) {
	case 'deferido': 
	$select_deferimento = "'D'";
	break;
	case 'indeferido': 
	$select_deferimento = "'I'";
	break;
	case 'pendente': 
	$select_deferimento = "'P'"; 	
	break;
  }
 
 
 if (isset($_GET["limit"])) $limit = $_GET["limit"]; else $limit = 0;
  $restringir = 10;

?>
<Script Language="JavaScript">
    function link(re,cidade,tipo) {
	  //alert(re + ' ' +cidade + ' ' +tipo); exit;
      var frm = document.frm_acomp_solic;
      frm.hdn_id_edificacao.value=re;
      frm.hdn_id_cidade.value=cidade;
      frm.hdn_id_tipo.value=tipo;
      //alert(frm.hdn_id_tipo.value);
      frm.submit();
    }
</script>
<body  onload="ajustaspan()">
<table style="height : 167px; margin-left : 0px; width : 764px;" valign="middle" border="0" cellpadding="0" cellspacing="0" id="tbcorpo">
  <tbody>
    <tr >
      <!--<td align="center" valign="middle" style="background-image : url('../../imagens/barrasigat.jpg');background-repeat: no-repeat;color : #FFFFFF;font-weight : bold;font-size : 16px;">SIGAT -
        <?/*@$rotina['ID_ROTINA']?> - <?=@$rotina['NM_ROTINA']*/?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->

      </td>
    </tr>
    <?
      if ($erro!="") {
        eval($erro);
      }
    ?>
    <tr valign="top" id="lncorpo" style="height:300px;">
      <td> 
<span style="overflow: auto; height: 295px; width: 760px;" id="corpo">



                                           
     <form target="_self" action="index.php" enctype="multipart/form-data" method="post" name="frm_acomp_solic">

       <input type="hidden" name="op_menu" value="rel_geral">
	   <input type="hidden" name="select_protocolo" value="<?=$_POST['select_protocolo']?>">
	   <input type="hidden" name="select_deferimento" value="<?=$_POST['select_deferimento']?>">
	   <input type="hidden" name="hdn_limit" value="">
	   <input type="hidden" name="pesquisa" value="">
	   <input type="hidden" name="cmb_id_cidade" value="<?=$ID_CIDADE?>">
	   <input type="hidden" name="hdn_fim" value="<?=$fim?>">	
       <input type="hidden" name="consulta" value="0">
       <input type="hidden" name="CPF_CNPJ" value="<?=$NR_CPF_CNPJ_AUX ?>" >
       <input type="hidden" name="hdn_id_edificacao" >
       <input type="hidden" name="hdn_id_cidade" >
       <input type="hidden" name="hdn_id_tipo" >
  <table style="width: 98%; text-align: left;" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
        <!--  <legend>Pesquisa</legend> -->
          <table border="0" cellpadding="1" width="100%">
            <?
			     switch ($TP_DOC) {

					case 1: // Pesquisa por RE
	              		 //$_POST["cmb_tp_doc"];
							if( $_POST["cmb_tp_doc"] == 1){
							 $tp="RE";
							}
						$query_sol_p = "SELECT ".
							TBL_EDIFICACAO.".ID_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CIDADE, ".
							TBL_EDIFICACAO.".NM_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO, ".
							TBL_EDIFICACAO.".ID_LOGRADOURO, ".
							TBL_EDIFICACAO.".NM_FANTASIA_1, ".
							TBL_EDIFICACAO.".NM_COMPLEMENTO, ".
							TBL_EDIFICACAO.".NR_EDIFICACAO, ".
							TBL_LOGRADOURO.".NM_LOGRADOURO, ".
							TBL_PESSOA.".NM_PESSOA, ".
							TBL_PESSOA.".ID_CNPJ_CPF, ".
							TBL_CIDADE.".NM_CIDADE
						FROM ".TBL_EDIFICACAO."
							LEFT JOIN ".TBL_CIDADE." ON ( ".TBL_CIDADE.".ID_CIDADE=$ID_CIDADE)
							LEFT JOIN ".TBL_PESSOA." ON ( ".TBL_PESSOA.".ID_CNPJ_CPF = ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO AND ".TBL_PESSOA.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE )
							LEFT JOIN ".TBL_LOGRADOURO." ON ( ".TBL_LOGRADOURO.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE AND ".TBL_LOGRADOURO.".ID_LOGRADOURO = ".TBL_EDIFICACAO.".ID_LOGRADOURO )
						WHERE ".
							TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE AND ".
							TBL_EDIFICACAO.".ID_EDIFICACAO = $NOME " .
						"GROUP BY ".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_PESSOA.".NM_PESSOA " .
						"ORDER BY ".TBL_PESSOA.".NM_PESSOA";
							//echo "meu sql: ".$query_sol_p;
					break;
				  	case 3: // Pesquisa por Nome do Solicitante ou Proprietário
						 
							if( $_POST["cmb_tp_doc"]=3){
							 $tp="Proprietário";
							}
						$query_sol_p= "SELECT ".
							TBL_EDIFICACAO.".ID_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CIDADE, ".
							TBL_EDIFICACAO.".NM_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO, ".
							TBL_EDIFICACAO.".ID_LOGRADOURO,".
							TBL_EDIFICACAO.".NM_FANTASIA_1, ".
							TBL_EDIFICACAO.".NM_COMPLEMENTO, ".
							TBL_EDIFICACAO.".NR_EDIFICACAO, ".
							TBL_LOGRADOURO.".NM_LOGRADOURO, ".
							TBL_PESSOA.".NM_PESSOA,".
							TBL_PESSOA.".ID_CNPJ_CPF, ".
							TBL_CIDADE.".NM_CIDADE
						FROM ".TBL_EDIFICACAO."
							LEFT JOIN ".TBL_CIDADE." ON ( ".TBL_CIDADE.".ID_CIDADE=$ID_CIDADE)
							LEFT JOIN ".TBL_PESSOA." ON ( ".TBL_PESSOA.".ID_CNPJ_CPF = ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO AND ".TBL_PESSOA.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE )
							LEFT JOIN ".TBL_LOGRADOURO." ON ( ".TBL_LOGRADOURO.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE AND ".TBL_LOGRADOURO.".ID_LOGRADOURO = ".TBL_EDIFICACAO.".ID_LOGRADOURO )
						WHERE ".
							TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE AND (".
							TBL_PESSOA.".NM_PESSOA LIKE '%$NOME%' OR ".TBL_EDIFICACAO.".NM_FANTASIA_1 LIKE '%$NOME%')
						GROUP BY ".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_PESSOA.".NM_PESSOA
						ORDER BY ".TBL_PESSOA.".NM_PESSOA";
							
					break;
					case 4://caso a pesquisa for por Nome da Edificacao
              			
							if( $_POST["cmb_tp_doc"]=4){
							 $tp="Edificação";
							}
							$query_sol_p= "SELECT ".TBL_EDIFICACAO.".ID_EDIFICACAO, ".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_EDIFICACAO.".NM_EDIFICACAO,
												".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO, ".TBL_EDIFICACAO.".ID_LOGRADOURO,

".TBL_EDIFICACAO.".NR_EDIFICACAO,
												".TBL_EDIFICACAO.".NM_FANTASIA_1, ".TBL_EDIFICACAO.".NM_COMPLEMENTO, ".TBL_PESSOA.".NM_PESSOA,
												".TBL_LOGRADOURO.".NM_LOGRADOURO, ".TBL_CIDADE.".NM_CIDADE
										 FROM ".TBL_EDIFICACAO."
								  LEFT JOIN ".TBL_CIDADE." ON ( ".TBL_CIDADE.".ID_CIDADE=$ID_CIDADE)
								  LEFT JOIN ".TBL_PESSOA." ON ( ".TBL_PESSOA.".ID_CNPJ_CPF = ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO
										  AND ".TBL_PESSOA.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE )
								  LEFT JOIN ".TBL_LOGRADOURO." ON ( ".TBL_LOGRADOURO.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE
										  AND ".TBL_LOGRADOURO.".ID_LOGRADOURO = ".TBL_EDIFICACAO.".ID_LOGRADOURO )
								      WHERE ".TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE
								        AND (".TBL_EDIFICACAO.".NM_EDIFICACAO  LIKE '%$NOME%'
								         OR ".TBL_EDIFICACAO.".NM_FANTASIA_1 LIKE '%$NOME%')";
										//echo ("$query_sol_p");exit;
					break;

					case 5://caso a pesquisa for por cnpj/cpf
							 if( $_POST["cmb_tp_doc"]=5){
							 $tp="CPF/CNPJ";
							}
							$query_sol_p= "SELECT ".TBL_EDIFICACAO.".ID_EDIFICACAO, ".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_EDIFICACAO.".NM_EDIFICACAO,
												".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO, ".TBL_EDIFICACAO.".ID_LOGRADOURO,

".TBL_EDIFICACAO.".NR_EDIFICACAO,
												".TBL_EDIFICACAO.".NM_FANTASIA_1, ".TBL_EDIFICACAO.".NM_COMPLEMENTO, ".TBL_PESSOA.".NM_PESSOA,
												".TBL_LOGRADOURO.".NM_LOGRADOURO, ".TBL_CIDADE.".NM_CIDADE
										 FROM ".TBL_EDIFICACAO."
                          LEFT JOIN ".TBL_CIDADE." ON ( ".TBL_CIDADE.".ID_CIDADE=$ID_CIDADE)
								  LEFT JOIN ".TBL_PESSOA." ON ( ".TBL_PESSOA.".ID_CNPJ_CPF = ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO
										  AND ".TBL_PESSOA.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE )
								  LEFT JOIN ".TBL_LOGRADOURO." ON ( ".TBL_LOGRADOURO.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE
										  AND ".TBL_LOGRADOURO.".ID_LOGRADOURO = ".TBL_EDIFICACAO.".ID_LOGRADOURO )
								      WHERE ".TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE
								        AND ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO = $NR_CPF_CNPJ
								   GROUP BY ".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_EDIFICACAO.".ID_EDIFICACAO
								   ORDER BY ".TBL_EDIFICACAO.".ID_EDIFICACAO";
					break;

					case 6://caso a pesquisa pelo Logradouro

		
							if( $_POST["cmb_tp_doc"]=6){
							 $tp="Logradouro";
							}
						$query_sol_p = "SELECT ".
							TBL_EDIFICACAO.".ID_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CIDADE, ".TBL_EDIFICACAO.".NM_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO, ".
							TBL_EDIFICACAO.".ID_LOGRADOURO, ".
							TBL_EDIFICACAO.".NM_FANTASIA_1, ".
							TBL_EDIFICACAO.".NM_COMPLEMENTO, ".
							TBL_EDIFICACAO.".NR_EDIFICACAO, ".
							TBL_PESSOA.".NM_PESSOA, ".
							TBL_LOGRADOURO.".NM_LOGRADOURO, ".
							TBL_CIDADE.".NM_CIDADE
						FROM ".TBL_EDIFICACAO."
							LEFT JOIN ".TBL_CIDADE." ON ( ".TBL_CIDADE.".ID_CIDADE=$ID_CIDADE)
							LEFT JOIN ".TBL_PESSOA." ON ( ".
								TBL_PESSOA.".ID_CNPJ_CPF = ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO AND ".
								TBL_PESSOA.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE )
							LEFT JOIN ".TBL_LOGRADOURO." ON ( ".TBL_LOGRADOURO.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE AND ".TBL_LOGRADOURO.".ID_LOGRADOURO = ".TBL_EDIFICACAO.".ID_LOGRADOURO )
						WHERE ".
							TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE AND ".
							TBL_LOGRADOURO.".NM_LOGRADOURO LIKE '%$NOME%' ORDER BY NM_LOGRADOURO, NR_EDIFICACAO";
						
					break;

					case 7://caso a pesquisa for por Protocolo
							 $_POST["cmb_tp_doc"];
							if( $_POST["cmb_tp_doc"]=7){
							 $tp="Protocolo";
							}
						$l_protocolo = $_POST["txt_nome"];

						switch(@$_POST['select_protocolo']) {
							case 'projeto': 
								$l_tabela	= TBL_ANALISE;
								$l_campo 	= 'ID_PROTOCOLO'; 		
							break;
							case 'habitese': 
								$l_tabela 	= TBL_VISTORIA_HABITESE; 	
								$l_campo 	= 'ID_PROT_HABITESE'; 		
							break;
							case 'funcionamento':
								$l_tabela 	= TBL_VISTORIA_FUNC;
								$l_campo 	= 'ID_PROT_FUNC';	
							break;
							case 'manutencao':
								$l_tabela 	= TBL_VISTORIA_MANUT;
								$l_campo 	= 'ID_PROT_MANUTENCAO'; 		
							break;
						}

						$query_sol_p = "SELECT ".
							TBL_EDIFICACAO.".ID_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CIDADE, ".
							TBL_EDIFICACAO.".NM_EDIFICACAO,".
							TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO, ".
							TBL_EDIFICACAO.".ID_LOGRADOURO,".
							TBL_EDIFICACAO.".NM_FANTASIA_1, ".
							TBL_EDIFICACAO.".NM_COMPLEMENTO, ".
							TBL_EDIFICACAO.".NR_EDIFICACAO, ".
							TBL_CIDADE.".NM_CIDADE, " .
							TBL_PESSOA.".NM_PESSOA," .
							TBL_LOGRADOURO.".NM_LOGRADOURO ".
						"FROM $l_tabela ";
	
						if($l_campo == 'ID_PROT_FUNC') {
							$query_sol_p .=
								"LEFT JOIN ".TBL_VIST_ESTAB." ON ( $l_tabela.ID_VISTORIA_FUNC = ".TBL_VIST_ESTAB.".ID_VISTORIA_FUNC AND " .TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA = $ID_CIDADE) " .
								"LEFT JOIN ".TBL_EDIFICACAO." ON ( ".TBL_VIST_ESTAB.".ID_EDIFICACAO = ".TBL_EDIFICACAO.".ID_EDIFICACAO AND ".TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE) ";
						} else {
							$query_sol_p .=
								"LEFT JOIN ".TBL_EDIFICACAO." ON ( $l_tabela.ID_EDIFICACAO = ".TBL_EDIFICACAO.".ID_EDIFICACAO AND ".TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE) ";
						}

						$query_sol_p .=
							"LEFT JOIN ".TBL_CIDADE." ON ( ".TBL_CIDADE.".ID_CIDADE=$ID_CIDADE) " .
							"LEFT JOIN ".TBL_PESSOA." ON ( ".TBL_PESSOA.".ID_CNPJ_CPF = ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO AND ".TBL_PESSOA.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE ) " .
							"LEFT JOIN ".TBL_LOGRADOURO." ON ( ".TBL_LOGRADOURO.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE AND ".TBL_LOGRADOURO.".ID_LOGRADOURO = ".TBL_EDIFICACAO.".ID_LOGRADOURO ) " .
						"WHERE ".
							"$l_tabela.ID_CIDADE = $ID_CIDADE AND ".
							"$l_tabela.$l_campo = $l_protocolo ";

					break;



					
					case 8: // Pesquisa por nome fantasia ou razao social
							
							if( $_POST["cmb_tp_doc"]=8){
							 $tp="Nome Fantasia";
							 $nome="Nome Fantasia";
															
							}
							$query_sol_p= "SELECT ".
							TBL_EDIFICACAO.".ID_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CIDADE, ".
							TBL_EDIFICACAO.".NM_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO, ".
							TBL_EDIFICACAO.".ID_LOGRADOURO,".
							TBL_EDIFICACAO.".NM_FANTASIA_1, ".
							TBL_EDIFICACAO.".NM_COMPLEMENTO, ".
							TBL_EDIFICACAO.".NR_EDIFICACAO, ".
							TBL_LOGRADOURO.".NM_LOGRADOURO, ".
							TBL_PESSOA.".NM_PESSOA,".
							TBL_PESSOA.".ID_CNPJ_CPF, ".
							TBL_CIDADE.".NM_CIDADE
						FROM ".TBL_EDIFICACAO."
							LEFT JOIN ".TBL_CIDADE." ON ( ".
								TBL_CIDADE.".ID_CIDADE=$ID_CIDADE)
							LEFT JOIN ".TBL_PESSOA." ON ( ".
								TBL_PESSOA.".ID_CNPJ_CPF = ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO AND ".
								TBL_PESSOA.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE )
							LEFT JOIN ".TBL_LOGRADOURO." ON ( ".
								TBL_LOGRADOURO.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE AND ".
								TBL_LOGRADOURO.".ID_LOGRADOURO = ".TBL_EDIFICACAO.".ID_LOGRADOURO )
						WHERE ".
							TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE AND (".
							TBL_PESSOA.".NM_PESSOA LIKE '%$NOME%' OR ".
							TBL_EDIFICACAO.".NM_FANTASIA_1 LIKE '%$NOME%' OR ".
							TBL_EDIFICACAO.".NM_FANTASIA_2 LIKE '%$NOME%')
						GROUP BY ".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_PESSOA.".NM_PESSOA
						ORDER BY ".TBL_EDIFICACAO.".NM_FANTASIA_2";
							break;
//////////////////////////// aqui termina o case adicionado


					case 9: // Pesquisa por parecer
						 
						if( $_POST["cmb_tp_doc"]=9){
							 $tp="Parecer";
						}
						switch (@$_POST['select_protocolo']) {
							case 'projeto': 
								$l_tabela	= TBL_ANALISE;
								$l_campo 	= 'ID_PROTOCOLO'; 		
								$l_campo2 	= 'CH_PARCER'; 		
								$l_campo4 	= 'ID_CNPJ_CPF_SOLICITANTE';
							break;
							case 'habitese': 
								$l_tabela 	= TBL_VISTORIA_HABITESE; 	
								$l_campo 	= 'ID_PROT_HABITESE'; 		
								$l_campo2 	= 'CH_PARECER'; 		
								
								$l_campo4 	= 'ID_CNPJ_CPF_SOLICITANTE';
							break;
							case 'funcionamento':
								$l_tabela 	= TBL_VISTORIA_FUNC;
								$l_campo 	= 'ID_PROT_FUNC';	
								$l_campo2 	= 'CH_PARECER'; 		
								$l_campo4 	= 'ID_CNPJ_EMPRESA';
							break;
							case 'manutencao':
								$l_tabela 	= TBL_VISTORIA_MANUT;
								$l_campo 	= 'ID_PROT_MANUTENCAO'; 		
								$l_campo2 	= 'CH_PARECER'; 		
								$l_campo4 	= 'ID_CNPJCPF_SOLICITANTE';
							
							break;
						}

						$query_sol_p = "SELECT ".
							TBL_PESSOA.".NM_PESSOA, ";
							if (@$_POST['select_protocolo'] == 'funcionamento') {
								$query_sol_p .= TBL_VIST_ESTAB.".ID_EDIFICACAO, ";
							} else {
								$query_sol_p .= "$l_tabela.ID_EDIFICACAO, ";
							}
							$query_sol_p .= "$l_tabela.$l_campo2, ".
							"$l_tabela.$l_campo4, ".
							"$l_tabela.$l_campo ".
						"FROM $l_tabela ";
							if (@$_POST['select_protocolo'] == 'funcionamento') { 
								$query_sol_p .= 
								"LEFT JOIN ".TBL_VIST_ESTAB." ON (
									$l_tabela.ID_VISTORIA_FUNC = ".TBL_VIST_ESTAB.".ID_VISTORIA_FUNC and 
									$l_tabela.ID_CIDADE = ".TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA) ";
							}
							$query_sol_p .= 
							"LEFT JOIN ".TBL_PESSOA." ON ($l_tabela.$l_campo4 = ".TBL_PESSOA.".ID_CNPJ_CPF
							 AND $l_tabela.ID_CIDADE = ".TBL_PESSOA.".ID_CIDADE ) ".
						


						"WHERE " .
							"$l_tabela.ID_CIDADE = $ID_CIDADE AND " .
							"$l_tabela.$l_campo2 = $select_deferimento ".
						"ORDER BY NM_PESSOA, $l_campo2 ";

//echo "query_sol_p: $query_sol_p<br><br>";

						// Calcular o numero de registros

						$conn->query($query_sol_p);
						if ($conn->get_status()==false) die($conn->get_msg());
						$rows = $conn->num_rows();
						$fim = (ceil($rows/$restringir)-1);

						// Consulta com os limitadores para o paginador
						$query_sol_p .= "limit $limit,$restringir";
//echo "query_sol_p: $query_sol_p"; exit;
					break;

case 10: // Pesquisa por razao social
							
					/*$query_sol_p= "SELECT ".
							TBL_EDIFICACAO.".ID_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CIDADE, ".
							TBL_EDIFICACAO.".NM_EDIFICACAO, ".
							TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO, ".
							TBL_EDIFICACAO.".ID_LOGRADOURO,".
							TBL_EDIFICACAO.".NM_FANTASIA_1, ".
							TBL_EDIFICACAO.".NM_COMPLEMENTO, ".
							TBL_EDIFICACAO.".NR_EDIFICACAO, ".
							TBL_LOGRADOURO.".NM_LOGRADOURO, ".
							TBL_PESSOA.".NM_PESSOA,".
							TBL_PESSOA.".ID_CNPJ_CPF, ".
							TBL_CIDADE.".NM_CIDADE
						FROM ".TBL_EDIFICACAO."
							LEFT JOIN ".TBL_CIDADE." ON ( ".
								TBL_CIDADE.".ID_CIDADE=$ID_CIDADE)
							LEFT JOIN ".TBL_PESSOA." ON ( ".
								TBL_PESSOA.".ID_CNPJ_CPF = ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO AND ".
								TBL_PESSOA.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE )
							LEFT JOIN ".TBL_LOGRADOURO." ON ( ".
								TBL_LOGRADOURO.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE AND ".
								TBL_LOGRADOURO.".ID_LOGRADOURO = ".TBL_EDIFICACAO.".ID_LOGRADOURO )
						WHERE ".
							TBL_EDIFICACAO.".ID_CIDADE = $ID_CIDADE AND (".
							TBL_PESSOA.".NM_PESSOA LIKE '%$NOME%' OR ".
							TBL_EDIFICACAO.".NM_FANTASIA_1 LIKE '%$NOME%' OR ".
							TBL_EDIFICACAO.".NM_FANTASIA_2 LIKE '%$NOME%')
						GROUP BY ".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_PESSOA.".NM_PESSOA
						ORDER BY ".TBL_EDIFICACAO.".NM_FANTASIA_2";
							break;	*/


						if ($_POST["cmb_tp_doc"] == 10) {
							 $tp="Razão Social";
							 $nome="Razão Social";	
							}
							$query_sol_p= "SELECT ".
							TBL_VISTORIA_FUNC.".ID_CNPJ_EMPRESA, ".
							TBL_VISTORIA_FUNC.".ID_CIDADE, ".
							TBL_VIST_ESTAB.".ID_EDIFICACAO, ".
							TBL_PESSOA.".NM_PESSOA , ".
							TBL_PESSOA.".ID_CNPJ_CPF , ".
							TBL_EDIFICACAO.".NM_EDIFICACAO , ".
							TBL_EDIFICACAO.".NR_EDIFICACAO, ".
							TBL_LOGRADOURO.".NM_LOGRADOURO
							FROM ".TBL_VISTORIA_FUNC."
								LEFT JOIN ".TBL_PESSOA." ON ( ".
									TBL_PESSOA.".ID_CNPJ_CPF = ".TBL_VISTORIA_FUNC.".ID_CNPJ_EMPRESA AND ".
									TBL_PESSOA.".ID_CIDADE = ".TBL_VISTORIA_FUNC.".ID_CIDADE ) 
								LEFT JOIN ".TBL_VIST_ESTAB." ON ( ".
									TBL_VIST_ESTAB.".ID_VISTORIA_FUNC = ".TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC AND ".
									TBL_VIST_ESTAB.".ID_CIDADE_ESTAB = ".TBL_VISTORIA_FUNC.".ID_CIDADE  )
								LEFT JOIN ".TBL_EDIFICACAO." ON ( ".
									TBL_EDIFICACAO.".ID_EDIFICACAO = ".TBL_VIST_ESTAB.".ID_EDIFICACAO AND ".
									TBL_EDIFICACAO.".ID_CIDADE = ".TBL_VIST_ESTAB.".ID_CIDADE_ESTAB ) 
								LEFT JOIN ".TBL_LOGRADOURO." ON ( ".
									TBL_LOGRADOURO.".ID_LOGRADOURO = ".TBL_EDIFICACAO.".ID_LOGRADOURO AND ".
									TBL_LOGRADOURO.".ID_CIDADE = ".TBL_EDIFICACAO.".ID_CIDADE ) 
					        WHERE ".
							TBL_VISTORIA_FUNC.".ID_CIDADE = $ID_CIDADE AND (".
							TBL_PESSOA.".NM_PESSOA LIKE '%$NOME%')
						GROUP BY ".TBL_VISTORIA_FUNC.".ID_CIDADE, ".TBL_PESSOA.".NM_PESSOA
						ORDER BY ".TBL_PESSOA.".NM_PESSOA";		
//echo "query_sol_p: $query_sol_p"; exit;						
							break;
//////////////////////////// aqui termina o case adicionado

default: die('Fun&ccedil;&atilde;o solicitada n&atilde;o implementada!');
			        
			     } // switch

			//echo "query_sol_p: $query_sol_p"; exit;
            $res = $conn->query($query_sol_p);

			//echo "<pre>"; print_r($conn); echo "</pre>"; exit;

            if ($conn->get_status()==false) die($conn->get_msg());

            $rows_solic_p = $conn->num_rows();
 		   
			// so entra neste if se tiver registros no banco e mostra a tabelinha
     	     if ($rows_solic_p > 0 and $TP_DOC != 9 ) {

				if ($TP_DOC != 10) $nome = 'Nome fantasia'; ?>
					<tr><th colspan="2">Consulta por <?=$tp;?></th></tr>
					<tr align="center" style="background-color : #BFEFFF">
					<th>RE</th>
					<th>Nome da Edificação</th>
					<th>Endereço</th>
					<!--<th><?=$nome;?></th>-->
					<th>Proprietario</th>
					<th>CNPJ/CPF</th>
					</tr>
<?
	        $count=0;
//echo "sql: ".$query_sol_p;

                while ($projeto = $conn->fetch_row()) {
				
					$l_logradouro = explode("-",$projeto["NM_LOGRADOURO"]);
					$projeto["NM_LOGRADOURO"] = $l_logradouro[0];
					if(!@$projeto["NR_EDIFICACAO"]) @$projeto["NR_EDIFICACAO"] = 's/n';
				
						if ($projeto["NM_EDIFICACAO"]==""){
						  $NM_EDIFICACAO=$projeto["NM_FANTASIA_1"];
						}else{
						  $NM_EDIFICACAO=$projeto["NM_EDIFICACAO"];
						}
		            $ENDERECO = $projeto["NM_LOGRADOURO"].", ".$projeto["NR_EDIFICACAO"]." <BR> ".$projeto["NM_CIDADE"];
		            $nome_pessoa = $projeto["NM_PESSOA"];
		            if (isset($projeto["ID_CNPJ_CPF"])){
		              $cnpjcpf = $projeto["ID_CNPJ_CPF"];
		            }
		            else{
		              $cnpjcpf = $projeto["ID_CNPJ_CPF_PROPRIETARIO"];
		            }
                  if ($count==0) {
                    $cor_bak = "#9AC0CD";
                    $count=1;
                  } else {
                    $cor_bak = "#D1EEEE";
                    $count=0;
                  }
            ?>
            <tr style="background-color : <?=$cor_bak?>; cursor : pointer;">
              <td onclick="link('<?=$projeto["ID_EDIFICACAO"]?>','<?=$projeto["ID_CIDADE"]?>','<?=$_POST["pesquisa"]?>','<?=$cnpjcpf?>')">
                <?=$projeto["ID_EDIFICACAO"]?>
              </td>
              <td onclick="link('<?=$projeto["ID_EDIFICACAO"]?>','<?=$projeto["ID_CIDADE"]?>','<?=$_POST["pesquisa"]?>','<?=$cnpjcpf?>')">
                <?=$NM_EDIFICACAO?>
              </td>
              <td onclick="link('<?=$projeto["ID_EDIFICACAO"]?>','<?=$projeto["ID_CIDADE"]?>','<?=$_POST["pesquisa"]?>','<?=$cnpjcpf?>')">
                <?=$ENDERECO?>
              </td>
              <td onclick="link('<?=$projeto["ID_EDIFICACAO"]?>','<?=$projeto["ID_CIDADE"]?>','<?=$_POST["pesquisa"]?>','<?=$cnpjcpf?>')">
                <?=$nome_pessoa?>
              </td>
              <td onclick="link('<?=$projeto["ID_EDIFICACAO"]?>','<?=$projeto["ID_CIDADE"]?>','<?=$_POST["pesquisa"]?>','<?=$cnpjcpf?>')">
                <?=$cnpjcpf?>
              </td>
             </tr>
           <?
                }

  					} elseif ($rows_solic_p>0 and $TP_DOC == 9) {
     	    		//echo "ok";	
			  
			  			
						?>
						<tr><th colspan="5">Consulta de <?=$_POST['select_protocolo'];?> <?=$_POST['select_deferimento'];?> [<?=number_format($rows,'0','','.')?> registros encontrados]<br> </th></tr>
						<tr align="center" style="background-color : #BFEFFF">
						<th>CPF/CNPJ</th>
						<th>Empresa</th>
						<th>Parecer</th>
						<th>RE</th>
						<th>Protocolo</th>
						</tr>
						<?
			
							while ($tupla = $conn->fetch_row()) {
			
								if ($cor_bak == COR_LINHA01) $cor_bak = COR_LINHA02; else $cor_bak = COR_LINHA01;
			
								?>
								<tr style="background-color : <?=$cor_bak?>;cursor:pointer;" onclick="link('<?=$tupla['ID_EDIFICACAO']?>','<?=$ID_CIDADE?>','<?=$_POST["pesquisa"]?>')"> 

									<td align="center"><?=$tupla[$l_campo4]?></td>
									<td><?=$tupla["NM_PESSOA"]?>
									</td>
									<td align="center"><? 
									if ($tupla["$l_campo2"] == 'D') echo "deferido"; 
									elseif ($tupla["$l_campo2"] == 'I') echo "indeferido";
									elseif ($tupla["$l_campo2"] == 'P') echo "pendente";
									else echo "parecer n&atilde;o definido";
									?></td>
									<td align="center"><?=$tupla['ID_EDIFICACAO']?></td>
									<td align="center"><?=$tupla[$l_campo]?></td>
								</tr>	
			
						<?	}
							//echo "<pre>"; print_r($tuplas); echo "</pre>";exit;
								$limit_ant = $limit-$restringir;
								$limit += $restringir; 
						?>

						<tr>
							<td colspan="4">


<? // echo "limit: $limit<br>fim: $fim<br>"; ?>
<!--o valor 10 foi substituido por $restringir na funcao envia-->
<Script Language="JavaScript">
function envia(tipo) {
    switch (tipo) {
        case 1:
		document.frm_acomp_solic.pesquisa.value='9';
		document.frm_acomp_solic.action = 'acomp_source_geral.php';
        break;
        case 2:
		document.frm_acomp_solic.pesquisa.value='9';
		document.frm_acomp_solic.action = 'acomp_source_geral.php?limit=<?=$limit-$restringir-$restringir;?>';
        break;
        case 3:
        document.frm_acomp_solic.pesquisa.value='9';
		document.frm_acomp_solic.action = 'acomp_source_geral.php?limit=<?=$limit+$restringir-$restringir;?>';
        break;
        case 4:
        document.frm_acomp_solic.pesquisa.value='9';
		document.frm_acomp_solic.action = 'acomp_source_geral.php?limit=<?=$fim*$restringir;?>';
        break;
    }
    document.frm_acomp_solic.submit();
}
</script>


<table width="90%" align="center" border="0">
<tr>
	<? if ($limit_ant>=0) { ?>
		<td><input type="button" value="Primeiro" name="btn_primeiro" title="Primeiros 10 Registros" onclick="envia(1)" class="botao" ></td>
		<td><input type="button" value="Anterior" name="btn_anterior" title="10 Registros Anteriores" onclick="envia(2)" class="botao" ></td>
	<? } else { ?>
		<td>
		<input type="button" value="Primeiro" name="btn_primeiro" title="Primeiros 10 Registros" onclick="envia(1)" class="botao"  disabled="true">
		</td>
		<td><input type="button" value="Anterior" name="btn_anterior" title="10 Registros Anteriores" onclick="envia(2)" class="botao"  disabled="true"></td>
	<? } ?>
	<? if (($fim*$restringir)>=$limit) { ?>
		<td>
		<input type="button" value="Próximo" name="btn_proximo" title="Próximos 10 Registros" onclick="envia(3)" class="botao" >
		</td>
		<td><input type="button" value="Último" name="btn_ultimo" title="Últimos 10 Registros" onclick="envia(4)" class="botao" ></td>
	<? } else { ?>
		<td>
		<input type="button" value="Próximo" name="btn_proximo" title="Próximos 10 Registros" onclick="envia(3)" class="botao"  disabled="true">
		</td>
		<td><input type="button" value="Último" name="btn_ultimo" title="Últimos 10 Registros" onclick="envia(4)" class="botao"  disabled="true"></td>
	<? } ?>
</tr>
</table>






							</td>
						</tr>

						<?

				} else {

           ?>
            <tr style="background-color : #9bd5ff;">
              <td colspan="5">NÃO EXITEM PROCESSOS PARA ESTE SOLICITANTE NESTA CIDADE</td>
            </tr>
           <?
              }
		
            ?>
          </table>
        </fieldset>
      </td>
    </tr>

    <tr valign="top" align="center">
      <td>
        <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
          <tr align="center" valign="center">
            <td colspan="2">                                                          
              <input type="button" onClick="voltar('frm_acomp_solic', 'source_geral')"  name="btn_enviar" value="Voltar" align="middle" title="Volta para a Tela de Procura" class="botao" >
            </td>
          </tr>
        </table>
    </tr>


  </table>
  </form>
<? // include ('../../templates/footer1.htm');                                      frm_acomp_solic ?>


<script>

function voltar(frm_acomp_solic, source_geral){
//     alert("entrei");
//    getElement("op_menu").value="source_geral";
// 
//    document.frm_acomp_solic.submit();
// /*
   
      document.frm_acomp_solic.op_menu.value = source_geral;  

      document.frm_acomp_solic.submit();


}
</script>






















  

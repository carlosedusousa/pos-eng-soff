<?

  //include ('../../templates/head.htm');

  require_once 'lib/loader.php';
  require_once 'funcoes_mail.php';

  // Conectando ao BD BD ($host, $user, $pass, $db)
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }

  $arquivo = "protocolo.php";
  $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res = $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  }

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();
  $sql="SELECT ID_BATALHAO,ID_COMPANIA,ID_PELOTAO,ID_GRUPAMENTO FROM ".TBL_USUARIO." WHERE ID_USUARIO='".$usuario."'";
  $conn->query($sql);
  $lotacao = $conn->fetch_row();

  // Verifica campos obrigatórios
  unset($erro);
  $erro="";

  if ((@$_POST["cmb_id_tp_prefixo"]!="")&&(@$_POST["txt_nm_logradouro"]!="")&&(@$_POST["txt_nm_bairro"]!="")&&(@$_POST["txt_id_cep"]!="")&&(@$_POST["cmb_id_cidade"]!="")&&(@$_POST["txt_vl_area_construida"]!="")&&(@$_POST["txt_nm_solicitante"]!="")&&(@$_POST["txt_nr_cnpjcpf_solicitante"]!="")&&(@$_POST["txt_nr_fone_solicitante"]!="")&&(@$_POST["txt_nm_email_solicitante"]!="")&&(@$_POST["txt_nm_edificacao"]!="")&&(@$_POST["hdn_id_tipo_solicitacao"]!="") &&(@$_POST["cmb_id_servico"]!="") &&(@$_POST["cmb_id_tp_servico"]!="")) {

    $ID_TIPO_SOLICITACAO		= formataCampo(strtoupper($_POST["hdn_id_tipo_solicitacao"]));
    $NM_SOLICITANTE				= formataCampo(strtoupper($_POST["txt_nm_solicitante"]));
    $NR_CNPJCPF_SOLICITANTE		= formataCampo(str_replace("-","",str_replace("/","",str_replace(".","",$_POST["txt_nr_cnpjcpf_solicitante"]))));
    $NM_EMAIL_SOLICITANTE		= formataCampo($_POST["txt_nm_email_solicitante"],"t","l");
    $NM_EDIFICACAO				= formataCampo(strtoupper($_POST["txt_nm_edificacao"]));
    $ID_TP_LOGRADOURO			= formataCampo($_POST["cmb_id_tp_prefixo"],"n","O");
    $ID_LOGRADOURO				= formataCampo($_POST["hdn_id_logradouro"],"n","O");
    $NM_LOGRADOURO				= formataCampo(strtoupper($_POST["txt_nm_logradouro"]));
    $NR_EDIFICACAO				= formataCampo($_POST["txt_nr_edificacao"],"n");
    $NM_BAIRRO					= formataCampo(strtoupper($_POST["txt_nm_bairro"]));
    $NM_COMPLEMENTO				= formataCampo(strtoupper($_POST["txt_nm_complemento"]));
    $ID_CEP						= formataCampo(str_replace("-","",str_replace(".","",$_POST["txt_id_cep"])),"n");
    $ID_CIDADE					= formataCampo($_POST["cmb_id_cidade"],"n");
    $ID_SERVICO					= formataCampo($_POST["cmb_id_servico"],'N','O');
    $ID_TP_SERVICO				= formataCampo($_POST["cmb_id_tp_servico"],'N','O');
    $NR_FONE_SOLICITANTE		= str_replace(".","",str_replace("-","",$_POST["txt_nr_fone_solicitante"]));
    $VL_AREA_CONTRUIDA			= str_replace(",",".",str_replace(".","",$_POST["txt_vl_area_construida"]));
    $ID_CIDADE_ANT				= $_POST["hdn_id_cidade_ant"];

	// Ajuste do endereço
    if (($ID_LOGRADOURO!="NULL")&&($ID_CEP!="")) {
      $CH_GUARDA_LOGRAD			= "'N'";
      $DT_AGUARDO_LOGRADOURO	= "NULL";
      $ID_USUARIO_AGUARDO		= "NULL";
      $ID_CEP_LOG				= $ID_CEP;
      $ID_CIDADE_CEP			= $ID_CIDADE;
    } else {
      $CH_GUARDA_LOGRAD			= "'S'";
      $DT_AGUARDO_LOGRADOURO	= "CURDATE()";
      $ID_CEP_LOG				= "NULL";
      $ID_LOGRADOURO			= "NULL";
      $ID_USUARIO_AGUARDO		= "'".$usuario."'";
      $ID_CIDADE_CEP			= "NULL";
    }
    
	// Verificar solicitação existente

    $l_dias		= 10;
    $l_cpfcnpj	= str_replace('.','',(str_replace('-','',(str_replace('/','',$_POST['txt_nr_cnpjcpf_solicitante'])))));
    $l_cidade	= $_POST['cmb_id_cidade'];

	// Verificar se existe solicitação para o mesmo solicitante em menos de 10 dias 
	$sql = "SELECT " .
		"ID_SOLICITACAO," .
		"CNPJ_CPF_SOLICITANTE,".
		TBL_SOLICITACAO.".ID_CIDADE," .
		"CH_PROTOCOLADO," .
		"NM_FANTASIA," .
		"NM_LOGRADOURO," .
		"NR_EDIFICACOES_LX," .
		"NR_CEP,NM_BAIRRO, " .
		"ID_TIPO_SOLICITACAO, " .
		"NM_EDIFICACOES_LX, " .
		"DATE_FORMAT(DT_SOLICITACAO,'%d/%m/%Y') " .
		"DT_SOLICITACAOS, (TO_DAYS('".date("Y-m-d")."') - TO_DAYS(DT_SOLICITACAO)) AS DIAS, " .
		"NM_CIDADE " .
	"FROM ".TBL_SOLICITACAO." " .
		"LEFT JOIN ".TBL_CIDADE." USING(ID_CIDADE) " .
	"WHERE ".
		TBL_SOLICITACAO.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."') AND ".TBL_SOLICITACAO.".CNPJ_CPF_SOLICITANTE = ".$l_cpfcnpj." AND ".
		TBL_SOLICITACAO.".CH_PROTOCOLADO = 'P' AND " .
		TBL_SOLICITACAO.".ID_CIDADE = $l_cidade " .
	"ORDER BY DT_SOLICITACAOS DESC";

	$conn->query($sql);
	$rows_pendente=$conn->num_rows();
	$encontrouSolicitacao = false;
	while ($pendente = $conn->fetch_row()) {
		if($encontrouSolicitacao == false) $encontrouSolicitacao = true;
		$solicitacoes[] = $pendente;
	} 

	//if($solicitacoes) echo "<pre>"; print_r($solicitacoes); echo "</pre>"; exit; 

	if(!$encontrouSolicitacao || @$_POST[btn_enviar_solicitacao]) {

	    $ERRO_TRANS="";
	    $query_trans='BEGIN';
	    $conn->query($query_trans);
	    $query_trans="COMMIT";
	
		// Monta a consulta para a tabela SOLICITACAO.SOLICITACAO
	
	    if (@$_POST["hdn_id_solicitacao"]!="") {
	      $ID_SOLICITACAO = @$_POST["hdn_id_solicitacao"];
	      $query = 
			"UPDATE ".TBL_SOLICITACAO." set " .
	      		"NM_LOGRADOURO =".$NM_LOGRADOURO."," .
	      		"NR_EDIFICACOES_LX=".$NR_EDIFICACAO.", " .
				"NR_CEP=".$ID_CEP."," .
				"NM_BAIRRO=".$NM_BAIRRO."," .
				"NM_COMPLEMENTO=".$NM_COMPLEMENTO."," .
				"VL_AREA_CONTRUIDA=".$VL_AREA_CONTRUIDA."," .
				"ID_TP_LOGRADOURO=".$ID_TP_LOGRADOURO."," .
				"CH_PROTOCOLADO='P'," .
				"CNPJ_CPF_SOLICITANTE=".$NR_CNPJCPF_SOLICITANTE."," .
				"NM_SOLICITANTE=".$NM_SOLICITANTE."," .
				"NR_FONE_SOLICITANTE=".$NR_FONE_SOLICITANTE."," .
				"DE_EMAIL_SOLICITANTE=".$NM_EMAIL_SOLICITANTE."," .
				"NM_EDIFICACOES_LX=".$NM_EDIFICACAO."," .
				"CH_AGUARDO_LOGRADOURO=".$CH_GUARDA_LOGRAD."," .
				"DT_AGUARDO_LOGRADOURO=".$DT_AGUARDO_LOGRADOURO."," .
				"ID_USUARIO=".$ID_USUARIO_AGUARDO.", " .
				"ID_CEP=$ID_CEP_LOG, " .
				"ID_LOGRADOURO=$ID_LOGRADOURO   " .
			"WHERE ".
				TBL_SOLICITACAO.".ID_CIDADE=".$ID_CIDADE_ANT." AND ".
				TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO=".$ID_TIPO_SOLICITACAO." AND ".
				TBL_SOLICITACAO.".ID_SOLICITACAO=".$ID_SOLICITACAO;
				//echo "<br>update: ".$query;
	    } else {
	      $query = 
			"INSERT INTO ".TBL_SOLICITACAO." (" .
				"ID_TIPO_SOLICITACAO,ID_SOLICITACAO,NM_LOGRADOURO,NR_EDIFICACOES_LX,NR_CEP,NM_BAIRRO," .
				"NM_COMPLEMENTO,VL_AREA_CONTRUIDA,ID_CIDADE,ID_TP_LOGRADOURO,CNPJ_CPF_SOLICITANTE," .
				"NM_SOLICITANTE,NR_FONE_SOLICITANTE,DE_EMAIL_SOLICITANTE,NM_EDIFICACOES_LX,CH_PROTOCOLADO," .
				"DT_SOLICITACAO,CH_AGUARDO_LOGRADOURO,DT_AGUARDO_LOGRADOURO,ID_USUARIO, ID_CEP,ID_LOGRADOURO" .
			") VALUES (".
				$ID_TIPO_SOLICITACAO.",'',".$NM_LOGRADOURO.",".$NR_EDIFICACAO.",".$ID_CEP.",".$NM_BAIRRO.",".
				$NM_COMPLEMENTO.",".$VL_AREA_CONTRUIDA.",".$ID_CIDADE.",".$ID_TP_LOGRADOURO.",".$NR_CNPJCPF_SOLICITANTE.",".
				$NM_SOLICITANTE.",".$NR_FONE_SOLICITANTE.",".$NM_EMAIL_SOLICITANTE.",".$NM_EDIFICACAO.",'P',CURDATE(),".
				$CH_GUARDA_LOGRAD.",".$DT_AGUARDO_LOGRADOURO.",".$ID_USUARIO_AGUARDO.",$ID_CEP_LOG, $ID_LOGRADOURO" .
			")";
			//echo "insert: ".$query;
	      $ID_SOLICITACAO="";
	    }
	
	
	    if ($ID_LOGRADOURO=="NULL") $ID_CEP="NULL";
	
	    if (($CH_GUARDA_LOGRAD=='N')&&($ID_LOGRADOURO=="NULL")) {
	
	      $erro="echo '<tr><td align=\"center\" style=\"background-color : #f7ff05; color : #ff0000; font-weight : bold;\">LOGRADOURO NÃO VALIDADO</td></tr>';";
	
	    } else {
	
	      $res = $conn->query($query);
	      if ($conn->get_status()==false) {
	        $ERRO_TRANS.=$conn->get_msg()."\n";
	        $query_trans="ROLLBACK";
	      }
	
	      if ($ID_SOLICITACAO=="") {
	        $ID_SOLICITACAO=$conn->insert_id();
	      } else {
	        if ($ID_CIDADE_ANT!=$ID_CIDADE) {//echo"inserindo denovo";
	          $ID_SOLICITACAO_ANT=$ID_SOLICITACAO;
	          $query="INSERT INTO ".TBL_SOLICITACAO." (ID_CIDADE,ID_SOLICITACAO, ID_TIPO_SOLICITACAO, CH_PAGO, CNPJ_CPF_SOLICITANTE, NM_SOLICITANTE, NR_FONE_SOLICITANTE, DE_EMAIL_SOLICITANTE, CNPJ_CPF_PROPRIETARIO, NM_PROPRIETARIO, NR_FONE_PROPRIETARIO, DE_EMAIL_PROPRIETARIO, NM_EDIFICACOES_LX, NM_FANTASIA, NM_LOGRADOURO , NR_EDIFICACOES_LX, NR_CEP, NM_BAIRRO, NM_COMPLEMENTO, VL_AREA_CONTRUIDA, VL_ALTURA, VL_AREA_TIPO, NR_PAVIMENTOS, NR_BLOCOS, CH_SIS_PREVENTIVO_EXTINTOR, NR_ESCADA_COMUM, NR_ESCADA_PROTEGIDA, NR_ESCADA_ENC, NR_ESCADA_PROVA_FUMACA, NR_ESCADA_PRESSU, NR_RAMPA, NR_ELEV_EMERGENCIA, NR_RESG_AEREO, NR_PASSARELA, ID_RISCO, ID_SITUACAO, ID_TP_CONSTRUCAO, ID_OCUPACAO, ID_TP_ALARME_INCENDIO, ID_ILU_EMERG, ID_TP_PARA_RAIO, NR_CREA_1, NM_ENGENHEIRO_1, NR_CREA_2, NM_ENGENHEIRO_2, NR_CREA_3, NM_ENGENHEIRO_3, CH_COMB_GN, CH_COMB_GLP, ID_TP_RECIPIENTE, ID_TP_INSTALACAO, CH_ABANDONO, CH_FIXO_CO2, CH_SPRINKLER, CH_ANCORA_CABO, CH_MULSYFIRE, NM_OUTROS, CH_PROTOCOLADO, ID_ADUCAO, DT_SOLICITACAO, ID_TP_LOGRADOURO, CH_AGUARDO_LOGRADOURO, DT_AGUARDO_LOGRADOURO, ID_CEP, ID_LOGRADOURO, ID_CIDADE_CEP, ID_USUARIO) SELECT $ID_CIDADE,0, ID_TIPO_SOLICITACAO, CH_PAGO, CNPJ_CPF_SOLICITANTE, NM_SOLICITANTE, NR_FONE_SOLICITANTE, DE_EMAIL_SOLICITANTE, CNPJ_CPF_PROPRIETARIO, NM_PROPRIETARIO, NR_FONE_PROPRIETARIO, DE_EMAIL_PROPRIETARIO, NM_EDIFICACOES_LX, NM_FANTASIA, NM_LOGRADOURO , NR_EDIFICACOES_LX, NR_CEP, NM_BAIRRO, NM_COMPLEMENTO, VL_AREA_CONTRUIDA, VL_ALTURA, VL_AREA_TIPO, NR_PAVIMENTOS, NR_BLOCOS, CH_SIS_PREVENTIVO_EXTINTOR, NR_ESCADA_COMUM, NR_ESCADA_PROTEGIDA, NR_ESCADA_ENC, NR_ESCADA_PROVA_FUMACA, NR_ESCADA_PRESSU, NR_RAMPA, NR_ELEV_EMERGENCIA, NR_RESG_AEREO, NR_PASSARELA, ID_RISCO, ID_SITUACAO, ID_TP_CONSTRUCAO, ID_OCUPACAO, ID_TP_ALARME_INCENDIO, ID_ILU_EMERG, ID_TP_PARA_RAIO, NR_CREA_1, NM_ENGENHEIRO_1, NR_CREA_2, NM_ENGENHEIRO_2, NR_CREA_3, NM_ENGENHEIRO_3, CH_COMB_GN, CH_COMB_GLP, ID_TP_RECIPIENTE, ID_TP_INSTALACAO, CH_ABANDONO, CH_FIXO_CO2, CH_SPRINKLER, CH_ANCORA_CABO, CH_MULSYFIRE, NM_OUTROS, CH_PROTOCOLADO, ID_ADUCAO, DT_SOLICITACAO, ID_TP_LOGRADOURO, CH_AGUARDO_LOGRADOURO, DT_AGUARDO_LOGRADOURO, ID_CEP, ID_LOGRADOURO, ID_CIDADE_CEP, ID_USUARIO FROM ".TBL_SOLICITACAO." WHERE ID_CIDADE=$ID_CIDADE_ANT AND ID_SOLICITACAO=$ID_SOLICITACAO AND ID_TIPO_SOLICITACAO=$ID_TIPO_SOLICITACAO";
	          $res= $conn->query($query);
	          if ($conn->get_status()==false) {
	            $ERRO_TRANS.=$conn->get_msg()."\n";
	            $query_trans="ROLLBACK";
	          }
	          $ID_SOLICITACAO=$conn->insert_id();
	          $query="DELETE FROM ".TBL_SOLICITACAO." WHERE ID_SOLICITACAO=$ID_SOLICITACAO_ANT AND ID_CIDADE=$ID_CIDADE_ANT AND ID_TIPO_SOLICITACAO=$ID_TIPO_SOLICITACAO";
	          $res= $conn->query($query);
	          if ($conn->get_status()==false) {
	            $ERRO_TRANS.=$conn->get_msg()."\n";
	            $query_trans="ROLLBACK";
	          }
	        }
	      }
	
	
	// força para inserir se não tiver protocolo
	if(!$_POST['txt_id_protocolo']) $_POST["hdn_controle"] = 1;
	
		  /*** CONTROLE 1 ***/
	
	
	      if ($_POST["hdn_controle"]==1) {
	
	        if ($global_inclusao=="S") {
	
			  $duplica='1';
	
			  if(@$incluir!='1'){
	            $duplica=$duplica++;
	            $sql ="INSERT INTO ".TBL_PROTOCOLOS." (ID_CIDADE,ID_PROTOCOLO,ID_TIPO_SOLICITACAO,ID_SOLICITACAO,CH_ANALISE,DT_PROTOCOLO,ID_USUARIO, ID_SERVICO, ID_TP_SERVICO, ID_CIDADE_TP_SERVICO) VALUES ($ID_CIDADE,'',$ID_TIPO_SOLICITACAO,$ID_SOLICITACAO,'N',CURDATE(),'$usuario',$ID_SERVICO, $ID_TP_SERVICO, $ID_CIDADE)";
	            $res= $conn->query($sql);
	            if ($conn->get_status()==false) {
	              $ERRO_TRANS.=$conn->get_msg()."\n";
	              $query_trans="ROLLBACK";
	            }
	            $ID_PROTOCOLO_RES=$conn->insert_id();
	            $incluir='1';
			  }
	
			  // Fórmula
	          $query_formula="SELECT NR_MAX_PARCELA, NR_PRAZO_VENCTO, DE_FORMULA, VL_MIN_PARCELA, VL_MAX_PARCELA FROM ".TBL_FORMULA." WHERE ".TBL_FORMULA.".ID_CIDADE=$ID_CIDADE AND ID_TP_SERVICO=$ID_TP_SERVICO AND ID_SERVICO=$ID_SERVICO AND VL_MIN_AREA<=$VL_AREA_CONTRUIDA AND VL_MAX_AREA>=$VL_AREA_CONTRUIDA";
	          echo "<!--aqui ppp:$query_formula-->\n";
	          $conn->query($query_formula);
	          if ($conn->get_status()==false) {
	            $ERRO_TRANS.=$conn->get_msg()."\n";
	            $query_trans="ROLLBACK";
	          }
	
	          $fetch_formula=$conn->fetch_row();
	          $VL_DESC_ABATIMENTO=0;
	          $VL_OUTRAS_DEDUCOES=0;
	          $VL_MULTA_MORA=0;
	          $VL_OUTROS_ACRESCIMOS=0;
	          $DT_VENCIMENTO=date("Y-m-d", mktime(0,0,0,date("m",time()), (date("d",time())+$fetch_formula["NR_PRAZO_VENCTO"]), date("Y", time())));
			  // $dia=date("d", mktime(0,0,0,date("m",time()),(date("d",time())+$fetch_formula["NR_PRAZO_VENCTO"]), date("Y",time())));
	          $RESULTADO=0;
	          $VL_AREA=$VL_AREA_CONTRUIDA;
	          eval($fetch_formula["DE_FORMULA"].";");
	          echo "<!--aquixx:".$fetch_formula["NR_MAX_PARCELA"]."-->\n";
	          $vl_parcela=$RESULTADO/$fetch_formula["NR_MAX_PARCELA"];
	
	          $VL_COBRANCA=$vl_parcela-$VL_DESC_ABATIMENTO-$VL_OUTRAS_DEDUCOES+$VL_MULTA_MORA+$VL_OUTROS_ACRESCIMOS;
	          if ($vl_parcela>=$fetch_formula["VL_MIN_PARCELA"]) {
	            $NR_PARCELA=$fetch_formula["NR_MAX_PARCELA"];
	          } else {
	            $NR_PARCELA=1;  $res= $conn->query($sql);
	            if ($conn->get_status()==false) {
	              $ERRO_TRANS.=$conn->get_msg()."\n";
	              $query_trans="ROLLBACK";
	            }
				// $ID_PROTOCOLO_RES=$conn->insert_id();
	          }
	
	            $query_formula="SELECT NR_MAX_PARCELA, NR_PRAZO_VENCTO, DE_FORMULA, VL_MIN_PARCELA, VL_MAX_PARCELA FROM ".TBL_FORMULA." WHERE ".TBL_FORMULA.".ID_CIDADE=$ID_CIDADE AND ID_TP_SERVICO=$ID_TP_SERVICO AND ID_SERVICO=$ID_SERVICO AND VL_MIN_AREA<=$VL_AREA_CONTRUIDA AND VL_MAX_AREA>=$VL_AREA_CONTRUIDA";
	            $conn->query($query_formula);
	            if ($conn->get_status()==false) {
	              $ERRO_TRANS.=$conn->get_msg()."\n";
	              $query_trans="ROLLBACK";
	            }
	            $fetch_formula=$conn->fetch_row();
	            $VL_DESC_ABATIMENTO=0;
	            $VL_OUTRAS_DEDUCOES=0;
	            $VL_MULTA_MORA=0;
	            $VL_OUTROS_ACRESCIMOS=0;
	            $DT_VENCIMENTO=date("Y-m-d", mktime(0,0,0,date("m",time()), (date("d",time())+$fetch_formula["NR_PRAZO_VENCTO"]), date("Y", time())));
				// $dia=date("d", mktime(0,0,0,date("m",time()),(date("d",time())+$fetch_formula["NR_PRAZO_VENCTO"]), date("Y",time())));
	            $RESULTADO=0;
	            $VL_AREA=$VL_AREA_CONTRUIDA;
	            eval($fetch_formula["DE_FORMULA"].";");
	            if ($RESULTADO>0) {
	              $vl_parcela=$RESULTADO/$fetch_formula["NR_MAX_PARCELA"];
	              $VL_COBRANCA=$vl_parcela-$VL_DESC_ABATIMENTO-$VL_OUTRAS_DEDUCOES+$VL_MULTA_MORA+$VL_OUTROS_ACRESCIMOS;
	              if ($vl_parcela>=$fetch_formula["VL_MIN_PARCELA"]) {
	                $NR_PARCELA=$fetch_formula["NR_MAX_PARCELA"];
	              } else {
	                $NR_PARCELA=1;
	              }
	              echo "<!--aqui 0:$NR_PARCELA<=".$fetch_formula["NR_MAX_PARCELA"]."-->\n";
	              for ($NR_PARCELA=1;$NR_PARCELA<=$fetch_formula["NR_MAX_PARCELA"];$NR_PARCELA++) {
	                if ($NR_PARCELA>1) {
	                  $data_venc=explode("-",$DT_VENCIMENTO);
	                  $DT_VENCIMENTO=date("Y-m-d", mktime(0,0,0,($data_venc[1]+1), $data_venc[2], $data_venc[0]));
	                }
	                $ID_COBRANCA_BOLETO=0;
	                echo "<!--aqui 3-->\n";
	                $query_boleto="REPLACE INTO ".TBL_COB_BOLETO." (ID_CIDADE, ID_COBRANCA_BOLETO, ID_PROTOCOLO, ID_CIDADE_PROTOCOLO, CH_TIPO_COBRANCA, NR_PARCELA, DT_GERACAO, DT_VENCIMENTO, VL_TOTAL_COBRADO, VL_COBRANCA_DOC, VL_DESC_ABATIMENTO, VL_OUTRAS_DEDUCOES, VL_MULTA_MORA, VL_OUTROS_ACRESCIMOS, VL_COBRANCA) VALUES ($ID_CIDADE, $ID_COBRANCA_BOLETO, $ID_PROTOCOLO_RES, $ID_CIDADE, 'P', $NR_PARCELA, CURDATE(), '$DT_VENCIMENTO',$RESULTADO,$vl_parcela,$VL_DESC_ABATIMENTO,$VL_OUTRAS_DEDUCOES,$VL_MULTA_MORA,$VL_OUTROS_ACRESCIMOS,$VL_COBRANCA)";
	                //echo "aqui:$query_boleto\n<br>";
	                $conn->query($query_boleto);
	                if ($conn->get_status()==false) {
	                  $ERRO_TRANS.=$conn->get_msg()."\n";
	                  $query_trans="ROLLBACK";
	                }
	              }
	            }
	
	            $conn->query($query_trans);
	            if (($conn->get_status()==false)||($ERRO_TRANS!="")) {
	              die($ERRO_TRANS.$conn->get_msg()."\n");
	            } else {
	              //include ('../../templates/retorno.htm');
	              $ID_PROTOCOLO=$ID_PROTOCOLO_RES;
	
		            if ($_POST["hdn_contr_pendente"]!="") {
						?>
						<script language="javascript" type="text/javascript">//<!--
						  <?
						    if ($ID_PROTOCOLO_RES!="") {
						      if (($_POST["hdn_controle"]==1)&&($global_inclusao=="S")) {
						        echo "alert(\"Registro Inserido: Protocolo ".$ID_PROTOCOLO_RES."\");\n";
						      }
						    }
						    if (($_POST["hdn_controle"]==2)&&($global_alteracao=="S")) {
						      echo "alert(\"Registro Alterado com o Protocolo:".$ID_CODIGO_RETORNO."\");\n";
						    }
						  ?>
						if (window.confirm("Deseja Imprimir Protocolo?")) {
						  window.open("./modulos/processos/protocolo/rprotocolo.php?txt_id_protocolo=<?=$ID_PROTOCOLO?>&txt_id_cidade=<?=$ID_CIDADE?>","relprot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
						}
						if (window.confirm("Deseja Imprimir Boleto?")) {
						  window.open("./modulos/financeiro/boleto_projeto.php?txt_id_protocolo=<?=$ID_PROTOCOLO?>&cmb_id_cidade=<?=$ID_CIDADE?>","boletoprot","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=550,innerwidth=780,innerheight=550");
						}
//  						  window.location.href="pendente.php";
                                               <input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">
						//--></script>
						<?
		            }
				}
	      } else {
	        $sql="";
	        $erro=MSG_ERR_INC;
	      }
	    }
	
		  /*** CONTROLE 2 ***/
	
	      if ($_POST["hdn_controle"]==2) {
	
	        if ($global_alteracao=="S") {
	            $ID_CODIGO_RETORNO=$_POST['txt_id_protocolo'];
	            $ID_PROTOCOLO = $_POST['txt_id_protocolo'];
	            $ID_SOLICITACAO = $_POST['hdn_id_solicitacao'];
	
	/*
				// Tabela SOLICITACAO
	            $sql="UPDATE ".TBL_SOLICITACAO." set CH_EXCLUIDO='N', DE_EXCLUIDO='' where ID_CIDADE=$ID_CIDADE and ID_SOLICITACAO=".$ID_SOLICITACAO;
	             $res= $conn->query($sql);
	            if ($conn->get_status()==false) {
	              $ERRO_TRANS.=$conn->get_msg()."\n";
	              $query_trans="ROLLBACK";
	            }
	*/
				// Tabela PROTOCOLOS
	            $sql="UPDATE ".TBL_PROTOCOLOS." set CH_EXCLUIDO='N', DE_EXCLUIDO='', ID_SOLICITACAO=".$ID_SOLICITACAO.",ID_CIDADE=".$ID_CIDADE.",CH_ANALISE='N',DT_PROTOCOLO=CURDATE(),ID_USUARIO='".$usuario."', ID_SERVICO=$ID_SERVICO, ID_TP_SERVICO=$ID_TP_SERVICO, ID_CIDADE_TP_SERVICO=$ID_CIDADE WHERE ".TBL_PROTOCOLOS.".ID_CIDADE=".$ID_CIDADE_ANT." AND ".TBL_PROTOCOLOS.".ID_PROTOCOLO=".$ID_PROTOCOLO;
	            $res= $conn->query($sql);
	            if ($conn->get_status()==false) {
	              $ERRO_TRANS.=$conn->get_msg()."\n";
	              $query_trans="ROLLBACK";
	            }
	
				// Formula
	            $query_formula="SELECT NR_MAX_PARCELA, NR_PRAZO_VENCTO, DE_FORMULA, VL_MIN_PARCELA, VL_MAX_PARCELA FROM ".TBL_FORMULA." WHERE ".TBL_FORMULA.".ID_CIDADE=$ID_CIDADE AND ID_TP_SERVICO=$ID_TP_SERVICO AND ID_SERVICO=$ID_SERVICO AND VL_MIN_AREA<=$VL_AREA_CONTRUIDA AND VL_MAX_AREA>=$VL_AREA_CONTRUIDA";
	            $conn->query($query_formula);
	            if ($conn->get_status()==false) {
	              $ERRO_TRANS.=$conn->get_msg()."\n";
	              $query_trans="ROLLBACK";
	            }
	
	            $fetch_formula=$conn->fetch_row();
	            $VL_DESC_ABATIMENTO=0;
	            $VL_OUTRAS_DEDUCOES=0;
	            $VL_MULTA_MORA=0;
	            $VL_OUTROS_ACRESCIMOS=0;
	            $DT_VENCIMENTO=date("Y-m-d", mktime(0,0,0,date("m",time()), (date("d",time())+$fetch_formula["NR_PRAZO_VENCTO"]), date("Y", time())));
				// $dia=date("d", mktime(0,0,0,date("m",time()),(date("d",time())+$fetch_formula["NR_PRAZO_VENCTO"]), date("Y",time())));
	            $RESULTADO=0;
	            $VL_AREA=$VL_AREA_CONTRUIDA;
	            @eval($fetch_formula["DE_FORMULA"].";");
	            if ($RESULTADO>0){
	              $vl_parcela=str_replace(",",".",$RESULTADO/$fetch_formula["NR_MAX_PARCELA"]);
	              $RESULTADO=str_replace(",",".",$RESULTADO);
	
	              $VL_COBRANCA=str_replace(",",".",($vl_parcela-$VL_DESC_ABATIMENTO-$VL_OUTRAS_DEDUCOES+$VL_MULTA_MORA+$VL_OUTROS_ACRESCIMOS));
	              if ($vl_parcela>=$fetch_formula["VL_MIN_PARCELA"]) {
	                $NR_PARCELA=$fetch_formula["NR_MAX_PARCELA"];
	              } else {
	                $NR_PARCELA=1;
	              }
	              for ($NR_PARCELA=1;$NR_PARCELA<=$fetch_formula["NR_MAX_PARCELA"];$NR_PARCELA++) {
	                if ($NR_PARCELA>1) {
	                  $data_venc=explode("-",$DT_VENCIMENTO);
	                  $DT_VENCIMENTO=date("Y-m-d", mktime(0,0,0,($data_venc[1]+1), $data_venc[2], $data_venc[0]));
	                }
	                //echo "<!--aqui vencto:$DT_VENCIMENTO==>".date("Y-m-d", mktime(0,0,0,(date("m",time())+($NR_PARCELA-1)), $dia, date("Y", time())))."===>".(date("m",time())+($NR_PARCELA-1)).",". $dia.",".date("Y", time())."\n-->\n";
	                $query_pagto="SELECT ID_COBRANCA_BOLETO FROM ".TBL_COB_BOLETO." WHERE ID_CIDADE=$ID_CIDADE AND ID_PROTOCOLO=$ID_PROTOCOLO AND  NR_PARCELA=$NR_PARCELA AND ".TBL_COB_BOLETO.".DT_PAGAMENTO IS NULL";
	                $conn->query($query_pagto);
	                if ($conn->get_status()==false) {
	                  $ERRO_TRANS.=$conn->get_msg()."\n";
	                  $query_trans="ROLLBACK";
	                }
	
	                if ($conn->num_rows()>0) {
	                  $fetch_pagto=$conn->fetch_row();
	                  $ID_COBRANCA_BOLETO=$fetch_pagto["ID_COBRANCA_BOLETO"];
	                  $query_boleto="REPLACE INTO ".TBL_COB_BOLETO." (ID_CIDADE, ID_COBRANCA_BOLETO, ID_PROTOCOLO,ID_CIDADE_PROTOCOLO, CH_TIPO_COBRANCA, NR_PARCELA, DT_GERACAO, DT_VENCIMENTO, VL_TOTAL_COBRADO, VL_COBRANCA_DOC, VL_DESC_ABATIMENTO, VL_OUTRAS_DEDUCOES, VL_MULTA_MORA, VL_OUTROS_ACRESCIMOS, VL_COBRANCA) VALUES ($ID_CIDADE, $ID_COBRANCA_BOLETO,  $ID_PROTOCOLO,$ID_CIDADE, 'P', $NR_PARCELA, CURDATE(), '$DT_VENCIMENTO',$RESULTADO,$vl_parcela,$VL_DESC_ABATIMENTO,$VL_OUTRAS_DEDUCOES,$VL_MULTA_MORA,$VL_OUTROS_ACRESCIMOS,$VL_COBRANCA)";
	                  //echo "<!-- aqui boleto==>$query_boleto\n-->\n";
	                  $conn->query($query_boleto);
	                  if ($conn->get_status()==false) {
	                    $ERRO_TRANS.=$conn->get_msg()."\n";
	                    $query_trans="ROLLBACK";
	                  }
	                }
	              }
	            }
	            $conn->query($query_trans);
	            if (($conn->get_status()==false)||($ERRO_TRANS!="")) {
	              die($ERRO_TRANS.$conn->get_msg()."\n");
	            }
	        //  include ('../../templates/retorno.htm');
	        } else {
	          $sql="";
	          $erro=MSG_ERR_ALT;
	        }
	
	      } // Fim do controle 2
	      
	    }
	
	    // ENVIO POR EMAIL
	
	    if (@$RESULTADO>0){
	      $query_cidade="SELECT ID_CIDADE FROM ".TBL_CIDADE." WHERE CH_MAIL='S' AND ID_CIDADE=$ID_CIDADE";
	      @$conn->query($query_cidade);
	      if ($conn->num_rows()>0) {
	        $hostname=exec("hostname -s");
	        enviamail($usuario,$DE_EMAIL_SOLICITANTE, $NM_SOLICITANTE, $ID_CIDADE, $ID_PROTOCOLO, $hostname, 'rprotocolo.php');
	      }
	    }



	} // (!$encontrouSolicitacao || @$_POST[btn_enviar_solicitacao]) {


  } else { // Campos obrigatórios não satisfeitos

    if ((isset($_POST["cmb_id_tp_prefixo"]))&&(isset($_POST["txt_nm_logradouro"]))&&(isset($_POST["txt_nm_bairro"]))&&(isset($_POST["txt_id_cep"]))&&(isset($_POST["cmb_id_cidade"]))&&(isset($_POST["txt_vl_area_construida"]))&&(isset($_POST["txt_nm_solicitante"]))&&(isset($_POST["txt_nr_cnpjcpf_solicitante"]))&&(isset($_POST["txt_nr_fone_solicitante"]))&&(isset($_POST["txt_nm_email_solicitante"]))&&(isset($_POST["txt_nm_edificacao"])) &&(isset($_POST["cmb_id_servico"])) && (isset($_POST["cmb_id_tp_servico"]))) {
      $erro= MSG_ERR_OBR;
    }

  }

  if (@$ID_PROTOCOLO!="") {
	?>
	<script language="javascript" type="text/javascript">//<!--
	if (window.confirm("Deseja Imprimir Protocolo?")) {
	  window.open("./modulos/processos/protocolo/rprotocolo.php?txt_id_protocolo=<?=$ID_PROTOCOLO?>&txt_id_cidade=<?=$ID_CIDADE?>","relprot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
	}
	if (window.confirm("Deseja Imprimir Boleto?")) {
	  window.open("./modulos/financeiro/boleto_projeto.php?txt_id_protocolo=<?=$ID_PROTOCOLO?>&cmb_id_cidade=<?=$ID_CIDADE?>","boletoprot","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=550,innerwidth=780,innerheight=550");
	}
	//--></script>
	<?
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo,arq) {
      if (campo.value!="") {
        window.open(arq+"?campo="+campo.value,"consulprot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
	<? if ($global_inclusao=="S") { ?>
      frm.btn_incluir.value="Incluir";
      <? if($_POST["hdn_controle"]!="2"){?>frm.hdn_controle.value="1";<?}?>
      frm.btn_incluir;
	<? } else { ?>
      frm.btn_incluir;
	<? } ?>
      frm.txt_id_protocolo.readOnly=false;
    }
    
    function cons_logra(valor,cidade) {
      if (cidade!="") {
        window.open("./modulos/edificacoes/cons_logradouro.php?txt_nm_logradouro="+valor+"&hdn_id_cidade="+cidade,"cons_logradouro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=400,innerwidth=780,innerheight=400")
      }else {
        alert("O campo Cidade deve ser selecionado!");
      }
    }

    function consultaSelc(formulario,cmb_campo,tabela,atrib,cond,obrigatorio,campo_atual,campos_limpos,novo) {
      if ((campo_atual.value != "" )&&(campo_atual.value != 0)) {
        //alert("formulario="+cmb_campo.form.name+"&cmb_campo="+cmb_campo.name+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio);
        window.open("./php/consultaSelc.php?formulario="+formulario+"&cmb_campo="+cmb_campo+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio+"&novo="+novo,"consulsec","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      } else {
        var cmp = campos_limpos.split(",");
        for (var i=0;i<cmp.length;i++) {
          window.document.frm_protocolo[cmp[i]].options.length=0;
          sec_cmb=window.document.frm_protocolo[cmp[i]].options.length++;
          window.document.frm_protocolo[cmp[i]].options[sec_cmb].text='---------------';
          window.document.frm_protocolo[cmp[i]].options[sec_cmb].value='0';
        }
      }
    }

    function servico(cidade) {
      consultaSelc("frm_protocolo","cmb_id_servico","<?=TBL_SERVICO?>","ID_SERVICO,NM_SERVICO","CH_OPERACAO IN ("+document.frm_protocolo.hdn_opracao.value+") AND ID_CIDADE="+cidade,"",document.frm_protocolo.cmb_id_cidade,"cmb_id_servico,cmb_id_tp_servico","")
    }

    function validacao() {
      document.frm_protocolo.hdn_id_logradouro.value="";
      document.frm_protocolo.txt_aguardo.value="Aguardando Validação";
    }

//--></script>

<body onload="ajustaspan()">

	<? //include ('../../templates/cab.htm'); ?>


<? if(@$encontrouSolicitacao) { ?>

  <form target="_self" enctype="multipart/form-data" method="post" name="frm_protocolo" onreset="retorna(this)" onsubmit="return validaForm(this,'txt_nm_solicitante,Nome Solicitante,t','txt_nr_fone_solicitante,Fone do Solicitante,n','txt_nr_cnpjcpf_solicitante,CNPJ/CPF do Solicitante,t','txt_nm_email_solicitante,E-mail Solicitante,e','txt_nm_edificacao,Nome da Edificação,t','cmb_id_tp_prefixo,Prefixo do Logradouro,n','txt_nm_logradouro,Nome do Logradouro,t','txt_nm_bairro,Nome do Bairro,t','txt_id_cep,Número do CEP,t','cmb_id_cidade,Cidade da Edificação,n','txt_vl_area_construida,Valor da Àrea Construida,t','cmb_id_servico,Serviço Prestado,n','cmb_id_tp_servico,Tipo do Serviço,n')">
 

<input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">



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
              <td><input type="text" name="txt_nr_cnpjcpf_solicitante" value="<?=$_POST['txt_nr_cnpjcpf_solicitante']?>" size="20" maxlength="18" class="campo_obr" title="CPF ou CNPJ do Solicitante de Análise da Edificação" onblur="cpfcnpj(this);valida_prop();" value=""></td>
            </tr>
          </table>
          <table>
            <tr>
              <td width="30">Fone</td>
              <td><input type="text" name="txt_nr_fone_solicitante" value="<?=$_POST['txt_nr_fone_solicitante']?>" size="13" maxlength="12" class="campo_obr" title="Fone do Solicitante de Análise da Edificação"></td>
              <td>E-mail</td>
              <td><input type="text" name="txt_nm_email_solicitante" value="<?=$_POST['txt_nm_email_solicitante']?>" size="61" maxlength="100" class="campo_obr" title="E-mail do Solicitante de Análise da Edificação" style="text-transform : none;"></td>
            </tr>
          </table>
        </fieldset>
      </td>
    </tr>
    <!-- SOLICITAÇÕES -->
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Solicitações Protocoladas</legend>
          <table width="100%">
            <tr>
              <td colspan="2"><b><br>
              <? if(count($solicitacoes)==1) { ?>
              	Existe a seguinte solicitação protocolada para este endereço:
              <? } else { ?>
              	Existem <?=count($solicitacoes)?> solicitações protocoladas para este endereço:
              <? } ?>
              </b><br><br></td>
			</tr>              
            <tr>
              <td colspan="2">
              	<table border="0" width="100%" align="center">
				<? foreach($solicitacoes as $solicitacao) { ?>
					<tr>
						<td align="right" width="100">Data:&nbsp;</td> 
						<td><b><?=$solicitacao['DT_SOLICITACAOS']?></b></td>
					</tr> 
					<tr>
						<td align="right">Edificação:&nbsp;</td> 
						<td><?=$solicitacao['NM_EDIFICACOES_LX']?></td>
					</tr> 
					<tr>
						<td align="right">Nome Fantasia:&nbsp;</td> 
						<td><? if($solicitacao['NM_FANTASIA']) echo "$solicitacao[NM_FANTASIA]"; else echo "<i>não informado</i>";?></td>
					</tr> 
					<tr>
						<td align="right">Logradouro:&nbsp;</td> 
						<td><?=$solicitacao['NM_LOGRADOURO']?>, <?=$solicitacao['NR_EDIFICACOES_LX']?></td>
					</tr> 
					<tr>
						<td align="right">CEP:&nbsp;</td> 
						<td><?=$solicitacao['NR_CEP']?>  <?=$solicitacao['NM_BAIRRO']?>/<?=$solicitacao['NM_CIDADE']?></td>
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
              <input type="submit" name="btn_enviar_solicitacao" value="Enviar" align="middle" title="Enviar Solicitação" class="botao" >
            </td>
            <td>
              <input type="button" name="btn_voltar" value="Voltar" onclick="javascript:history.back();" align="middle" title="Voltar ao formulário" class="botao" >
            </td>
          </tr>
        </table>
    </tr>
  </table>
  </form>

<? } else { ?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_protocolo" onreset="retorna(this)" onsubmit="return validaForm(this,'txt_nm_solicitante,Nome Solicitante,t','txt_nr_fone_solicitante,Fone do Solicitante,n','txt_nr_cnpjcpf_solicitante,CNPJ/CPF do Solicitante,t','txt_nm_email_solicitante,E-mail Solicitante,e','txt_nm_edificacao,Nome da Edificação,t','cmb_id_tp_prefixo,Prefixo do Logradouro,n','txt_nm_logradouro,Nome do Logradouro,t','txt_nm_bairro,Nome do Bairro,t','txt_id_cep,Número do CEP,t','cmb_id_cidade,Cidade da Edificação,n','txt_vl_area_construida,Valor da Àrea Construida,t','cmb_id_servico,Serviço Prestado,n','cmb_id_tp_servico,Tipo do Serviço,n')">
          

<input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">


           <table width="95%" cellspacing="0" border="0" cellpadding="5" align="center">
              <tr>
                <td>
                <fieldset>
                  <legend>Protocolo</legend>
                  <table width="95%" cellspacing="0" border="0" cellpadding="0" align="center">
                    <tr>
                      <td align="center">N° Protocolo&nbsp;
                        <input type="hidden" name="hdn_contr_pendente" value="">
                        <input type="hidden" name="hdn_id_cidade_ant" value="">
                      <input type="text" name="txt_id_protocolo" value="" class="campo" align="right" title="Número do Protocolo" size="12" maxlength="11">
                      </td>
                      <td align="center">Data Protocolo&nbsp;
                      <input type="text" name="txt_dt_protocolo" value="<?=Date('d/m/Y', Time())?>" class="campo" readOnly="true" title="Data de Protocolamento" size="11" maxlength="10">
                      </td>
                    </tr>
                  </table>
                </fieldset>
                </td>
              </tr>
              <tr>
                <td>
                  <fieldset>
                    <legend>Solicitante</legend>
                    <input type="hidden" name="hdn_id_solicitacao" value="<?=@$_POST["hdn_id_solicitacao"]?>">
					<? if (@$_POST["hdn_id_tipo_solicitacao"]!="") { ?>
                    	<input type="hidden" name="hdn_id_tipo_solicitacao" value="<?=$_POST["hdn_id_tipo_solicitacao"]?>">
					<? } else { ?>
                    	<input type="hidden" name="hdn_id_tipo_solicitacao" value="P">
					<? } ?>
                    <table width="95%" cellspacing="0" border="0" cellpadding="5" align="center">
                      <tr>
                        <td>Nome</td>
                        <td colspan="3"><input type="text" name="txt_nm_solicitante" class="campo_obr" title="Nome do Solicitante do Projeto" size="80" value=""></td>
                      </tr>
                      <tr>
                        <td>Fone</td>
                        <td><input type="text" name="txt_nr_fone_solicitante" class="campo_obr" title="Fone do Solicitante" size="20" value=""></td>
                        <td>CNPJ/CPF</td>
                        <td><input type="text" name="txt_nr_cnpjcpf_solicitante" class="campo_obr" title="CNPJ/CPF do Solicitante" size="20" value="" onblur="cpfcnpj(this)"></td>
                      </tr>
                      <tr>
                        <td>E-mail</td>
                        <td colspan="3"><input type="text" name="txt_nm_email_solicitante" class="campo_obr" title="E-mail do Solicitante do Projeto" size="80" value="" style="text-transform : none;"></td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td>
                  <fieldset>
                    <legend>Edificação</legend>
                    <table width="95%" cellspacing="0" border="0" cellpadding="5" align="center">
                      <tr>
                        <td>Nome</td>
                        <td colspan="4"><input type="text" name="txt_nm_edificacao" size="80" class="campo_obr" title="Nome da Edificação" value=""></td>
                      </tr>
                       <tr>
                        <td>Tipo</td>
                        <td colspan="4">
                          <select name="cmb_id_tp_prefixo" class="campo_obr">
                          <option value="">---------------</option>
<?
                            $sql_tp_logradouro="SELECT ID_TP_LOGRADOURO, NM_TP_LOGRADOURO FROM ".TBL_TP_LOGRADOURO;
                            $conn->query($sql_tp_logradouro);
                            while ($cidade=$conn->fetch_row()) {
?>
                            <option value="<?=$cidade["ID_TP_LOGRADOURO"]?>"><?=$cidade["NM_TP_LOGRADOURO"]?></option>
<?
                           }
?>
                          </select>
                        </td>
                      </tr><tr>
                        <td>Logradouro</td>
                        <td colspan="4">
                          <input type="hidden" name="hdn_id_logradouro" value="">
                          <input type="text" size="80" class="campo_obr" value="" name="txt_nm_logradouro" title="Nome do Logradouro" maxlength="100" onChange="validacao()">
                        </td>
                      </tr>
                      <tr>
                        <td>Nº</td>
                        <td height="10"><input type="text" size="6" maxlength="5" name="txt_nr_edificacao" align="right" class="campo" title="Número da Edificação no Logradouro" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)"></td>
                        <td colspan="3">
                          <input type="button" name="btn_valida_logradouro" value="Validar" class="botao"  title="Validar o Logradouro Existente" onClick="cons_logra(document.frm_protocolo.txt_nm_logradouro.value, document.frm_protocolo.cmb_id_cidade.value)">
                          <input type="hidden" name="hdn_ctrl_valida" value="">
                        </td>
                      </tr>
                      <tr>
                        <td>Bairro</td>
                        <td>
                          <input type="hidden" name="hdn_id_bairro" value="">
                          <input type="text" size="40" maxlength="50" value="" name="txt_nm_bairro" class="campo_obr" title="Nome do Bairro" onChange="validacao()"></td>
                        <td>CEP</td>
                        <td colspan="2"><input type="text" size="15" maxlength="10" name="txt_id_cep" value="" class="campo_obr" title="Número do CEP" onkeypress="return validaTecla(this, event, 'n')" onblur="CEP(this)" onChange="validacao()"></td>
                      </tr>
                      <tr>
                        <td>Cidade</td>
                        <td>
                          <input type="hidden" name="hdn_opracao" value="'P','T'">
                          <select name="cmb_id_cidade" class="campo_obr" onChange="consultaSelc(this.form.name,'cmb_id_servico','<?=TBL_SERVICO?>','ID_SERVICO,NM_SERVICO','CH_OPERACAO IN ('+document.frm_protocolo.hdn_opracao.value+') AND ID_CIDADE='+this.value,'',this,'cmb_id_servico,cmb_id_tp_servico','')">
                            <option value="">-------------</option>
<?

                            $sql_cidade="SELECT ".TBL_CIDADE.".ID_CIDADE ID_CIDADE,NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_USUARIO ='".$usuario."' AND ".TBL_CIDADE.".ID_UF IN ('SC') ORDER BY NM_CIDADE";
                            $conn->query($sql_cidade);
                            while ($cidade=$conn->fetch_row()) {
?>
                            <option value="<?=$cidade["ID_CIDADE"]?>"><?=$cidade["NM_CIDADE"]?></option>
<?
                            }
?>
                          </select>
                        </td>
                        <td>Área Construida</td>
                        <td colspan="2"><input type="text" align="right" name="txt_vl_area_construida" class="campo_obr" title="Valor da Área Total Construida da Edificação" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)" size="20"></td>
                      </tr>
                      <tr valign="middle">
                        <td>Complemento</td>
                        <td><input type="text" name="txt_nm_complemento" class="campo" size="50" maxlength="100" value="" title="Complemento do Endereço da Edificação"></td>
                        <td>Aguardando<br>Logradouro</td>
                        <td colspan="2">
                          <input type="text" name="txt_aguardo" value="Aguardando Validação" readOnly="true" size="23" class="campo_obr" style="color : #ff0000;">
                        </td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td>
                  <fieldset>
                    <legend>Financeiro</legend>
                    <table width="95%" cellspacing="0" border="0" cellpadding="5" align="center">
                      <tr>
                        <td>Serviço</td>
                        <td>
                          <select name="cmb_id_servico" class="campo_obr" title="Serviço a Ser Prestado" onChange="consultaSelc(this.form.name,'cmb_id_tp_servico','<?=TBL_TP_SERVICO?>','ID_TP_SERVICO,NM_TP_SERVICO','ID_SERVICO='+this.value+' AND ID_CIDADE='+document.frm_protocolo.cmb_id_cidade.value,'s',this,'cmb_id_tp_servico','');">
                            <option value="">-----------------</option>
                          </select>
                        </td>
                        <td>Tipo Serviço</td>
                        <td>
                          <select name="cmb_id_tp_servico" class="campo_obr" title="Tipo de Serviço a Ser Prestado">
                            <option value="">-----------------</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
<?

  include('./templates/btn_inc.htm');

?>            <input type="hidden" name="hdn_controle" value="2"></table>
<?
//hdn_id_cidade" value="">
            //<input type="hidden" name="hdn_id_tipo_solicitacao
  if ((@$_POST["hdn_id_solicitacao"]!="") && (@$_POST["hdn_id_cidade"]!="") && (@$_POST["hdn_id_tipo_solicitacao"]!="")){
    $sql=
	"SELECT " .
		TBL_PROTOCOLOS.".ID_PROTOCOLO,".
		TBL_SOLICITACAO.".CNPJ_CPF_SOLICITANTE, " .
		TBL_SOLICITACAO.".CNPJ_CPF_SOLICITANTE, " .
		TBL_SOLICITACAO.".NM_SOLICITANTE, " .
		TBL_SOLICITACAO.".NR_FONE_SOLICITANTE, " .
		TBL_SOLICITACAO.".DE_EMAIL_SOLICITANTE, " .
		TBL_SOLICITACAO.".NM_EDIFICACOES_LX, " .
		TBL_SOLICITACAO.".NM_LOGRADOURO, " .
		TBL_SOLICITACAO.".NR_EDIFICACOES_LX, " .
		TBL_SOLICITACAO.".NR_CEP, NM_BAIRRO, " .
		TBL_SOLICITACAO.".NM_COMPLEMENTO, " .
		TBL_SOLICITACAO.".VL_AREA_CONTRUIDA, " .
		TBL_SOLICITACAO.".ID_TP_LOGRADOURO," .
		TBL_SOLICITACAO.".ID_CIDADE " .
	" FROM ".TBL_SOLICITACAO.
	" LEFT JOIN ".TBL_PROTOCOLOS." ON (".TBL_SOLICITACAO.".ID_SOLICITACAO=".TBL_PROTOCOLOS.".ID_SOLICITACAO AND ".TBL_SOLICITACAO.".ID_CIDADE=".TBL_PROTOCOLOS.".ID_CIDADE)" .
	" WHERE ".
		TBL_SOLICITACAO.".ID_SOLICITACAO = ".$_POST["hdn_id_solicitacao"]." AND " .
		TBL_SOLICITACAO.".ID_CIDADE=".$_POST["hdn_id_cidade"]." AND " .
		TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO='".$_POST["hdn_id_tipo_solicitacao"]."' AND " .
		TBL_SOLICITACAO.".CH_PROTOCOLADO='S'";
	//echo $sql; exit;
    $conn->query($sql);
    $row_solicita=$conn->num_rows();
    if ($row_solicita>0) {
      $solicitacao=$conn->fetch_row();
      $ID_PROTOCOLO           = $solicitacao["ID_PROTOCOLO"];
      $NM_SOLICITANTE         = $solicitacao["NM_SOLICITANTE"];
      $NR_FONE_SOLICITANTE    = $solicitacao["NR_FONE_SOLICITANTE"];
      $NR_CNPJCPF_SOLICITANTE = $solicitacao["CNPJ_CPF_SOLICITANTE"];
      $NM_EMAIL_SOLICITANTE   = $solicitacao["DE_EMAIL_SOLICITANTE"];
      $NM_EDIFICACAO          = $solicitacao["NM_EDIFICACOES_LX"];
      $NM_LOGRADOURO          = $solicitacao["NM_LOGRADOURO"];
      $NR_EDIFICACAO          = $solicitacao["NR_EDIFICACOES_LX"];
      $NM_BAIRRO              = $solicitacao["NM_BAIRRO"];
      $NR_CEP                 = $solicitacao["NR_CEP"];
      $ID_CIDADE              = $solicitacao["ID_CIDADE"];
      $ID_TP_PREFIXO          = $solicitacao["ID_TP_LOGRADOURO"];
      $NM_COMPLEMENTO         = $solicitacao["NM_COMPLEMENTO"];
      $VL_AREA_CONSTRUIDA     = $solicitacao["VL_AREA_CONTRUIDA"];
?>
<script language="javascript" type="text/javascript">//<!--
var frm_at=document.frm_protocolo;
frm_at.txt_id_protocolo.value="<?=$ID_PROTOCOLO?>";
frm_at.hdn_id_tipo_solicitacao.value="<?=$_POST["hdn_id_tipo_solicitacao"]?>";
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
frm_at.txt_nm_complemento.value="<?=str_replace('"',' ',$NM_COMPLEMENTO)?>";
frm_at.cmb_id_cidade.value="<?=$ID_CIDADE?>";
frm_at.hdn_id_cidade_ant.value="<?=$ID_CIDADE?>";
frm_at.cmb_id_tp_prefixo.value="<?=$ID_TP_PREFIXO?>";
frm_at.hdn_contr_pendente.value='1';
<?
  $query_servico="SELECT ID_SERVICO,NM_SERVICO FROM ".TBL_SERVICO." WHERE ID_CIDADE=$ID_CIDADE AND CH_OPERACAO IN ('T','P')";
  $conn->query($query_servico);
?>
var sec_cmb_id_servico_pen=0;
frm_at.cmb_id_servico.options.length=0;
sec_cmb_id_servico_pen=frm_at.cmb_id_servico.options.length++;
frm_at.cmb_id_servico.options[sec_cmb_id_servico_pen].text="-----------------";
frm_at.cmb_id_servico.options[sec_cmb_id_servico_pen].value="";
<?
  if ($conn->num_rows()>0) {
    while ($fetch_servico=$conn->fetch_row()) {
?>
sec_cmb_id_servico_pen=frm_at.cmb_id_servico.options.length++;
frm_at.cmb_id_servico.options[sec_cmb_id_servico_pen].text="<?=$fetch_servico["NM_SERVICO"]?>";
frm_at.cmb_id_servico.options[sec_cmb_id_servico_pen].value="<?=$fetch_servico["ID_SERVICO"]?>";
<?
    }
  }
?>

//-->
</script>
<?
    }
  }
?>


          </form>

<? } // if($encontrouSolicitacao) { ?>


<?
//  include ('../../templates/footer.htm');
?>

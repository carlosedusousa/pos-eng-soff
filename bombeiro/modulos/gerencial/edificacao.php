<?
// echo "<pre>"; print_r($_GET); echo "</pre>";
// echo "<pre>"; print_r($_POST); echo "</pre>";

 // if (@$_GET["form_padrao"]=="") include ('../../templates/head.htm'); else include ('../../templates/head_cons.htm');

  $erro = "";
  require_once 'lib/loader.php';

  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) die($conn->get_msg());

  $arquivo = "edificacao.php";
  $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res = $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row();

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

$campos_preenchidos = true;
$campos_existe = true;
$campos_obr = array('txt_nr_cnpjcpf_proprietario'=>"'txt_nr_cnpjcpf_proprietario,CNPJ/CPF do Propriet&aacute;rio,t'",
'txt_nm_proprietario'=>"'txt_nm_proprietario,Nome do Propriet&aacute;rio,t'",
'txt_nr_fone_proprietario'=>"'txt_nr_fone_proprietario,N&utilde;mero do Fone Propriet&aacute;rio,n'",
'txt_de_email_proprietario'=>"'txt_de_email_proprietario,E-mail do Propriet&aacute;rio,e'",
'txt_nm_edificacao'=>"'txt_nm_edificacao,Nome da Edifica&ccedil;&atilde;o,t'",
'hdn_id_tp_logradouro'=>"'hdn_id_tp_logradouro,Prefixo do Logradouro,t'",
'hdn_id_logradouro'=>"'hdn_id_logradouro,Logradouro n&atildeo Cadastrado,t'",
'hdn_id_cidade'=>"'hdn_id_cidade,Cidade da Edifica&ccedil;&atilde;o,t'",
'txt_nm_bairro'=>"'txt_nm_bairro,Nome do Bairro,t'",
'hdn_id_cep'=>"'hdn_id_cep,CEP n&atildeo Cadastrado,t'",
'txt_vl_area_construida'=>"'txt_vl_area_construida,Valor da &acute;rea total Constru&icute;da,t'",
'txt_vl_altura'=>"'txt_vl_altura,Valor da Altura de Discarga,t'",
'txt_vl_area_pavimento'=>"'txt_vl_area_pavimento,Valor da &acute;rea do Pavimento Tipo,t'",
'cmb_id_ocupacao'=>"'cmb_id_ocupacao,Tipo de Ocupa&ccedil;&atilde;o,n'",
'cmb_id_risco'=>"'cmb_id_risco,Tipo Risco da Edifica&ccedil;&atilde;o,n'",
'cmb_id_situacao'=>"'cmb_id_situacao,Situa&ccedil;&atilde;o da Edifica&ccedil;&atilde;o,n'",
'cmb_id_tp_construcao'=>"'cmb_id_tp_construcao,Tipo de Constru&ccedil;&atlde;o'",
'cmb_nr_pavimentos'=>"'cmb_nr_pavimentos,N&utilde;mero de Pavimentos,n'",
'cmb_nr_blocos'=>"'cmb_nr_blocos,N&utilde;mero de Blocos,n'"
);

foreach($campos_obr as $campos_key=>$campos_value) {
  if ($campos_preenchidos==true) {
    if (!isset($_POST[$campos_key])) {
      $campos_existe=false;
      $campos_preenchidos=false;
    } else {
      if ($_POST[$campos_key]=="") $campos_preenchidos=false;
    }
  }
}

$campos_js=implode(",",$campos_obr);
if (isset($_GET["form_padrao"])) {
  $form_padrao=$_GET["form_padrao"];
} elseif (isset($_POST["form_padrao"])) {
  $form_padrao=$_POST["form_padrao"];
} else {
  $form_padrao="";
}

if ($campos_preenchidos) {



  $ID_CARC_EDIFICACAO		= formataCampo($_POST["hdn_id_carc_edificacao"],'N');
  $ID_CIDADE				= formataCampo($_POST["hdn_id_cidade"],'N');
  $ID_EDIFICACAO			= formataCampo($_POST["txt_id_edificacao"],'N','D');
  $NR_CNPJ_CPF_PROPRIETARIO	= formataCampo($_POST["txt_nr_cnpjcpf_proprietario"],'VN');
  $NM_PROPRIETARIO			= formataCampo($_POST["txt_nm_proprietario"]);
  $NM_PROPRIETARIO_FONETICA	= formataCampo(nr_txt_fonetica($NM_PROPRIETARIO));
  $NR_FONE_PROPRIETARIO		= formataCampo($_POST["txt_nr_fone_proprietario"],'VN');
  $DE_EMAIL_PROPRIETARIO	= formataCampo($_POST["txt_de_email_proprietario"],'T','L');
  $NM_EDIFICACAO			= formataCampo($_POST["txt_nm_edificacao"]);
  $NM_EDIFICACAO_FONETICA	= formataCampo(nr_txt_fonetica($NM_EDIFICACAO));
  $NM_FANTASIA_1			= formataCampo($_POST["txt_nm_fantasia_1"]);
  $NM_FANTASIA_FONETICA_1	= formataCampo(nr_txt_fonetica($NM_FANTASIA_1));
  $NM_FANTASIA_2			= formataCampo($_POST["txt_nm_fantasia_2"]);
  $NM_FANTASIA_FONETICA_2	= formataCampo(nr_txt_fonetica($NM_FANTASIA_2));
  $ID_LOGRADOURO			= formataCampo($_POST["hdn_id_logradouro"],'N','O');
  $NM_LOGRADOURO			= formataCampo($_POST["txt_nm_logradouro"]);
  $ID_TP_LOGRADOURO			= formataCampo($_POST["hdn_id_tp_logradouro"],'N');
  $NM_TP_LOGRADOURO			= formataCampo($_POST["txt_nm_tp_logradouro"]);
  $NR_CEP					= formataCampo($_POST["txt_nr_cep"],'N');
  $ID_CEP					= formataCampo($_POST["hdn_id_cep"],'N','O');
  $NM_BAIRROS				= formataCampo($_POST["txt_nm_bairro"]);
  $NR_EDIFICACAO			= formataCampo(($_POST["txt_nr_edificacao"]),'N','O');
  $NM_COMPLEMENTO			= formataCampo($_POST["txt_nm_complemento"]);
  $VL_AREA_CONSTRUIDA		= formataCampo($_POST["txt_vl_area_construida"],'D','D');
  $VL_ALTURA				= formataCampo($_POST["txt_vl_altura"],'D','D');
  $VL_AREA_TIPO				= formataCampo($_POST["txt_vl_area_pavimento"],'D','D');
  $ID_RISCO					= formataCampo($_POST["cmb_id_risco"],'N');
  $ID_OCUPACAO				= formataCampo($_POST["cmb_id_ocupacao"],'N');
  $ID_SITUACAO				= formataCampo($_POST["cmb_id_situacao"],'N');
  $ID_TP_CONSTRUCAO			= formataCampo($_POST["cmb_id_tp_construcao"],'N');
  $NR_BLOCOS				= formataCampo($_POST["cmb_nr_blocos"],'N');
  $NR_PAVIMENTOS			= formataCampo($_POST["cmb_nr_pavimentos"],'N');

  //variaveis referentes a sistemas preventivos 

$ID_ADUCAO			      	= formataCampo($_POST["cmb_id_aducao"],'N');
$ID_TP_INSTALACAO         	= formataCampo($_POST["cmb_id_tp_instalacao"],'N');
$ID_TP_RECIPIENTE		  	= formataCampo($_POST["cmb_id_recipiente"],'N');
$ID_ILU_EMERG  			  	= formataCampo($_POST["cmb_id_iluminacao_emergencia"],'N');
$ID_TP_PARA_RAIO          	= formataCampo($_POST["cmb_id_pararaio"],'N');
$ID_TP_CAPTORES			  	= formataCampo($_POST["cmb_id_captores"],'N');
$ID_TP_ATERRAMENTO        	= formataCampo($_POST["cmb_id_aterramento"],'N');
$ID_TP_ABANDONO           	= formataCampo($_POST["cmb_id_abandono"],'N');
$CH_SIS_PREVENTIVO_EXTINTOR = formataCampo($_POST["rdo_ch_extintor"]);
$NR_ESCADA_COMUM		  	= formataCampo($_POST["cmb_nr_escada_comum"],'VN');
$NR_ESCADA_PROTEGIDA      	= formataCampo($_POST["cmb_nr_protegida"],'VN');
$NR_RAMPA                 	= formataCampo($_POST["cmb_nr_rampa"],'VN');
$NR_ELEV_EMERGENCIA       	= formataCampo($_POST["cmb_nr_elev_emerg"],'VN');
$NR_ESCADA_ENC            	= formataCampo($_POST["cmb_nr_enclausurada"],'VN');
$NR_RESG_AEREO            	= formataCampo($_POST["cmb_nr_reg_aereo"],'VN');
$NR_ESCADA_PROVA_FUMACA   	= formataCampo($_POST["cmb_nr_esc_fumaca"],'VN');
$NR_PASSARELA             	= formataCampo($_POST["cmb_nr_passarela"],'VN');
$NR_ESCADA_PRESSU         	= formataCampo($_POST["cmb_nr_pressurizada"],'VN');

// variaveis referentes ao SAI e SE(extintores)

$NR_DETEC_FUMACA         	= formataCampo($_POST["cmb_nr_fumaca"],'VN');
$NR_DETEC_VEL         		= formataCampo($_POST["cmb_nr_velocimetrico"],'VN');
$NR_DETEC_QMC         		= formataCampo($_POST["cmb_dec_quimico"],'VN');
$NR_PONTOS         			= formataCampo($_POST["cmb_nr_acioanamento"],'VN');
$NR_PQS         		    = formataCampo($_POST["cmb_nr_pqs"],'VN');
$NR_AGUA         			= formataCampo($_POST["cmb_agua"],'VN');
$NR_ESPUMA         			= formataCampo($_POST["cmb_espuma"],'VN');
$NR_CO2         			= formataCampo($_POST["cmb_co2"],'VN');
$PONTOS_INSTALADOS          = formataCampo($_POST["txa_local_instalados"]);
$QTD_GLP                    = formataCampo($_POST["cmb_qt_glp"]);
$QTD_GN                     = formataCampo($_POST["cmb_qt_gn"]);



if ($ID_TP_RECIPIENTE > 0) $CH_COMB_GLP = "'S'"; else $CH_COMB_GLP = "'N'";
if ($ID_TP_INSTALACAO > 0) $CH_COMB_GN = "'S'"; else $CH_COMB_GN = "'N'";
if ($_POST["chk_ch_sprinkler"] == 'S')  $CH_SPRINKLER = "'S'"; else $CH_SPRINKLER = "'N'";
if ($_POST["chk_ch_mulsyfire"] == 'S')  $CH_MULSYFIRE = "'S'"; else $CH_MULSYFIRE = "'N'";
if ($_POST["chk_ch_co2"] == 'S')        $CH_FIXO_CO2 = "'S'"; else $CH_FIXO_CO2 = "'N'";
if ($_POST["chk_ch_ancora_cabo"] == 'S')$CH_ANCORA_CABO = "'S'"; else $CH_ANCORA_CABO = "'N'";
$DE_OUTROS                 = formataCampo($_POST["txt_nm_outros"]);

 if (strlen($NR_CNPJ_CPF_PROPRIETARIO)>14) $CH_JURIDICA="'S'"; else $CH_JURIDICA="'N'";

  $ERRO_TRANS="";
  $query_trans="BEGIN";
  $conn->query($query_trans);
  $query_trans="COMMIT";

  $query_pessoa="SELECT ID_TP_PESSOA FROM ".TBL_PESSOA." WHERE ".TBL_PESSOA.".ID_CNPJ_CPF=$NR_CNPJ_CPF_PROPRIETARIO AND ".TBL_PESSOA.".ID_CIDADE=$ID_CIDADE";
  $res= $conn->query($query_pessoa);
  if ($conn->get_status()==false) {
    $ERRO_TRANS.="SELECIONE PROPRIETÁRIO:".$conn->get_msg()."\n";
    $query_trans="ROLLBACK";
  }
  $rows_pessoa=$conn->num_rows();
  if ($rows_pessoa>0) {
    $pessoa = $conn->fetch_row();
    if ($pessoa["ID_TP_PESSOA"]=='S') {
      $ID_TP_PESSOA="'A'";
    } else {
      $ID_TP_PESSOA="'P'";
    }
    $query_pessoa="UPDATE ".TBL_PESSOA." SET ID_TP_PESSOA=$ID_TP_PESSOA, NM_PESSOA=$NM_PROPRIETARIO, NM_PESSOA_FONETICA=$NM_PROPRIETARIO_FONETICA, NR_FONE=$NR_FONE_PROPRIETARIO, DE_EMAIL_PESSOA=$DE_EMAIL_PROPRIETARIO WHERE ".TBL_PESSOA.".ID_CNPJ_CPF=$NR_CNPJ_CPF_PROPRIETARIO AND ".TBL_PESSOA.".ID_CIDADE=$ID_CIDADE";
  } else {
    $ID_TP_PESSOA="'P'";
    $query_pessoa="INSERT INTO ".TBL_PESSOA." (ID_CNPJ_CPF, ID_CIDADE, ID_TP_PESSOA, NM_PESSOA, NM_PESSOA_FONETICA, NR_FONE, DE_EMAIL_PESSOA, CH_JURIDICA) VALUES ($NR_CNPJ_CPF_PROPRIETARIO,
$ID_CIDADE, $ID_TP_PESSOA, $NM_PROPRIETARIO, $NM_PROPRIETARIO_FONETICA, $NR_FONE_PROPRIETARIO, $DE_EMAIL_PROPRIETARIO, $CH_JURIDICA)";
  }
  $res= $conn->query($query_pessoa);
  if ($conn->get_status()==false) {
    $ERRO_TRANS.="ATUALIZAÇÃO PROPRIETÁRIO:".$conn->get_msg()."\n";
    $query_trans="ROLLBACK";
  }

// $consulta_edif = "SELECT ".TBL_EDIFICACAO.".ID_EDIFICACAO FROM ".TBL_EDIFICACAO ." JOIN ".TBL_LOGRADOURO." ON (".TBL_EDIFICACAO.".ID_LOGRADOURO = ".TBL_LOGRADOURO.".ID_LOGRADOURO) WHERE ".TBL_EDIFICACAO.".NR_EDIFICACAO = $NR_EDIFICACAO AND ".TBL_EDIFICACAO.".ID_CIDADE=$ID_CIDADE AND ".TBL_LOGRADOURO.".NM_LOGRADOURO= $NM_LOGRADOURO";
// 		$res= $conn->query($consulta_edif);
// //  		echo "$consulta_edif";
// 		if ($conn->get_status()==false) {
// 			$ERRO_TRANS.="ERRO DE CONSULTA DE EDIFICACAO:".$conn->get_msg()."\n";
// 			$query_trans="ROLLBACK";
// 		}
// 
// 		$rows_edificacao=$conn->num_rows();
// 		if ($rows_edificacao>0) {
// 			$r = $conn->fetch_row();
// 			$id_edificacao = $r['ID_EDIFICACAO'];
//         }else{
//   		  $id_edificacao == null;
// 		}

  //echo "<pre>"; print_r($id_edificacao); echo "</pre>";exit;

  if ($_POST["hdn_controle"]==1 ) {
	    	if ($id_edificacao != null) {

				?>
				<script language="javascript" type="text/javascript">
					edif = confirm ("Já existe uma edificação para este endereço, deseja cadastrar uma nova RE?");
					if ( edif == false) { // testa se o usuario clicou em cancelar	
						<?/* */
							$query_ed="";
							$query_ed_2="";
							$query_ed_3="";
							//$erro = MSG_ERR_INC;
							$query_trans="ROLLBACK";
							/* */
						?>
					} else {
							<? $query_trans="COMMIT"; ?>

					}
             	</script>
				<? 
}

//echo "query_trans: $query_trans"; exit;


  if ($global_inclusao=="S") {

      $query_ed = "INSERT INTO ".TBL_EDIFICACAO." (ID_CIDADE, ID_EDIFICACAO, ID_CNPJ_CPF_PROPRIETARIO, ID_CIDADE_PESSOA, NM_EDIFICACAO, NM_EDIFICACAO_FONETICA, NM_FANTASIA_1, NM_FANTASIA_FONETICA_1, NM_FANTASIA_2, NM_FANTASIA_FONETICA_2, NR_EDIFICACAO, NM_COMPLEMENTO, VL_AREA_CONSTRUIDA, VL_ALTURA, VL_AREA_TIPO, NR_PAVIMENTOS, NR_BLOCOS, ID_RISCO, ID_SITUACAO, ID_TP_CONSTRUCAO, ID_OCUPACAO, ID_CEP, ID_LOGRADOURO, ID_CIDADE_CEP) VALUES ($ID_CIDADE, $ID_EDIFICACAO, $NR_CNPJ_CPF_PROPRIETARIO, $ID_CIDADE, $NM_EDIFICACAO, $NM_EDIFICACAO_FONETICA, $NM_FANTASIA_1, $NM_FANTASIA_FONETICA_1, $NM_FANTASIA_2, $NM_FANTASIA_FONETICA_2, $NR_EDIFICACAO, $NM_COMPLEMENTO, $VL_AREA_CONSTRUIDA, $VL_ALTURA, $VL_AREA_TIPO, $NR_PAVIMENTOS, $NR_BLOCOS, $ID_RISCO, $ID_SITUACAO, $ID_TP_CONSTRUCAO, $ID_OCUPACAO, $ID_CEP, $ID_LOGRADOURO, $ID_CIDADE)";


		//fazer insert com os dados dos sistemas preventivos quando é soh inserção

		$query_ed_3 = "insert into ".TBL_CARAC_ED." (".
				"ID_EDIFICACAO, ".
				"ID_CIDADE, ".
				"CH_SIS_PREVENTIVO_EXTINTOR, ".
				"CH_COMB_GLP, ".
				"ID_TP_RECIPIENTE, ".
				"CH_COMB_GN, ".
				"ID_TP_INSTALACAO, ".
				"ID_ILU_EMERG, ".
				"NR_ESCADA_PRESSU, ".
				"NR_ESCADA_COMUM, ".
				"NR_ESCADA_PROTEGIDA, ".
				"NR_RAMPA, ".
				"NR_ESCADA_ENC, ".
				"NR_RESG_AEREO, ".
				"NR_ELEV_EMERGENCIA, ".
				"NR_ESCADA_PROVA_FUMACA, ".
				"NR_PASSARELA , ".
				"ID_TP_PARA_RAIO, ".   
				"ID_TP_CAPTORES , ".      
				"ID_TP_ATERRAMENTO, ".    
				"ID_TP_ABANDONO , ".      
				"CH_SPRINKLER , ".
				"CH_MULSYFIRE, ".
				"CH_FIXO_CO2, ".
				"CH_ANCORA_CABO, ".
				"DE_OUTROS, ".
				"ID_ADUCAO, ".
				"NR_DETEC_FUMACA, ".    
				"NR_DETEC_VEL, ". 
				"NR_DETEC_QMC, ". 
				"NR_PONTOS, ".         	
				"NR_PQS, ".
				"NR_AGUA, ".
				"NR_ESPUMA, ".
				"NR_CO2, ".
				"QTD_GLP, ".
				"QTD_GN, ". 
				"PONTOS_INSTALADOS ".
				") values (".
				"asdf, ".
				"$ID_CIDADE, ".
				"$CH_SIS_PREVENTIVO_EXTINTOR, ".
				"$CH_COMB_GLP, ".
				"$ID_TP_RECIPIENTE, ".
				"$CH_COMB_GN, ".
				"$ID_TP_INSTALACAO, ".
				"$ID_ILU_EMERG, ".
				"$NR_ESCADA_PRESSU, ".
				"$NR_ESCADA_COMUM, ".
				"$NR_ESCADA_PROTEGIDA, ".
				"$NR_RAMPA, ".
				"$NR_ESCADA_ENC, ".
				"$NR_RESG_AEREO, ".
				"$NR_ELEV_EMERGENCIA, ".
				"$NR_ESCADA_PROVA_FUMACA, ".
				"$NR_PASSARELA, ".
				"$ID_TP_PARA_RAIO, ".   
				"$ID_TP_CAPTORES, ".      
				"$ID_TP_ATERRAMENTO, ".    
				"$ID_TP_ABANDONO, ".      
				"$CH_SPRINKLER, ".
				"$CH_MULSYFIRE, ".
				"$CH_FIXO_CO2, ".
				"$CH_ANCORA_CABO, ".
				"$DE_OUTROS, ".
				"$ID_ADUCAO, ".
				"$NR_DETEC_FUMACA, ".    
				"$NR_DETEC_VEL, ". 
				"$NR_DETEC_QMC, ". 
				"$NR_PONTOS, ".         	
				"$NR_PQS, ".
				"$NR_AGUA, ".
				"$NR_ESPUMA, ".
				"$NR_CO2, ".
				"$QTD_GLP, ".
				"$QTD_GN, ". 
				"$PONTOS_INSTALADOS ".
		")" ;
/*?>
<script language="javascript" type="text/javascript">
alert "Registro inserido com sucesso";
</script>
<?*/
} else {

		$query_ed="";
		$query_ed_2="";
		$query_ed_3="";
//		$erro = MSG_ERR_INC;
		$query_trans="ROLLBACK";
  
  }
 }


  if ($_POST["hdn_controle"]==2) {

    if ($global_alteracao=="S") {

      $query_ed="UPDATE ".TBL_EDIFICACAO." SET ID_CNPJ_CPF_PROPRIETARIO=$NR_CNPJ_CPF_PROPRIETARIO, ID_CIDADE_PESSOA=$ID_CIDADE, NM_EDIFICACAO=$NM_EDIFICACAO, NM_EDIFICACAO_FONETICA=$NM_EDIFICACAO_FONETICA, NM_FANTASIA_1=$NM_FANTASIA_1, NM_FANTASIA_FONETICA_1=$NM_FANTASIA_FONETICA_1, NM_FANTASIA_2=$NM_FANTASIA_2, NM_FANTASIA_FONETICA_2=$NM_FANTASIA_FONETICA_2, NR_EDIFICACAO=$NR_EDIFICACAO, NM_COMPLEMENTO=$NM_COMPLEMENTO, VL_AREA_CONSTRUIDA=$VL_AREA_CONSTRUIDA, VL_ALTURA=$VL_ALTURA, VL_AREA_TIPO=$VL_AREA_TIPO, NR_PAVIMENTOS=$NR_PAVIMENTOS, NR_BLOCOS=$NR_BLOCOS, ID_RISCO=$ID_RISCO, ID_SITUACAO=$ID_SITUACAO, ID_TP_CONSTRUCAO=$ID_TP_CONSTRUCAO, ID_OCUPACAO=$ID_OCUPACAO, ID_CEP=$ID_CEP, ID_LOGRADOURO=$ID_LOGRADOURO, ID_CIDADE_CEP=$ID_CIDADE WHERE ".TBL_EDIFICACAO.".ID_EDIFICACAO=$ID_EDIFICACAO AND ".TBL_EDIFICACAO.".ID_CIDADE=$ID_CIDADE";


	$sql = "select ID_CIDADE FROM ".TBL_CARAC_ED. " ".
	"WHERE ".
		TBL_CARAC_ED.".ID_EDIFICACAO = $ID_EDIFICACAO AND ". 
		TBL_CARAC_ED.".ID_CIDADE=$ID_CIDADE ".
	";";// echo "sql: $sql"; exit;
	$conn->query($sql);
	if( $conn->num_rows() > 0 ) {
			//echo "query_ed_2";exit;
		//update
		$query_ed_2 = "UPDATE ".TBL_CARAC_ED." SET ".
				"CH_SIS_PREVENTIVO_EXTINTOR = $CH_SIS_PREVENTIVO_EXTINTOR, ".
				"CH_COMB_GLP = $CH_COMB_GLP, ".
				"ID_TP_RECIPIENTE= $ID_TP_RECIPIENTE, ".
				"CH_COMB_GN = $CH_COMB_GN, ".
				"ID_TP_INSTALACAO= $ID_TP_INSTALACAO, ".
				"ID_ILU_EMERG=$ID_ILU_EMERG, ".
				"NR_ESCADA_PRESSU = $NR_ESCADA_PRESSU, ".
				"NR_ESCADA_COMUM= $NR_ESCADA_COMUM, ".
				"NR_ESCADA_PROTEGIDA= $NR_ESCADA_PROTEGIDA, ".
				"NR_RAMPA = $NR_RAMPA, ".
				"NR_ESCADA_ENC = $NR_ESCADA_ENC, ".
				"NR_RESG_AEREO= $NR_RESG_AEREO, ".
				"NR_ELEV_EMERGENCIA=$NR_ELEV_EMERGENCIA, ".
				"NR_ESCADA_PROVA_FUMACA = $NR_ESCADA_PROVA_FUMACA, ".
				"NR_PASSARELA = $NR_PASSARELA, ".
				"ID_TP_PARA_RAIO = $ID_TP_PARA_RAIO, ".   
				"ID_TP_CAPTORES = $ID_TP_CAPTORES, ".      
				"ID_TP_ATERRAMENTO = $ID_TP_ATERRAMENTO, ".    
				"ID_TP_ABANDONO = $ID_TP_ABANDONO, ".      
				"CH_SPRINKLER = $CH_SPRINKLER, ".
				"CH_MULSYFIRE = $CH_MULSYFIRE, ".
				"CH_FIXO_CO2  = $CH_FIXO_CO2, ".
				"CH_ANCORA_CABO =$CH_ANCORA_CABO, ".
				"DE_OUTROS =     $DE_OUTROS, ".
				"ID_ADUCAO = $ID_ADUCAO, ".
				"NR_DETEC_FUMACA = $NR_DETEC_FUMACA, ".    
				"NR_DETEC_VEL = $NR_DETEC_VEL, ". 
				"NR_DETEC_QMC = $NR_DETEC_QMC, ". 
				"NR_PONTOS = $NR_PONTOS, ".         	
				"NR_PQS = $NR_PQS, ".
				"NR_AGUA = $NR_AGUA, ".
				"NR_ESPUMA = $NR_ESPUMA, ".
				"NR_CO2 = $NR_CO2, ".
				"QTD_GLP= $QTD_GLP, ".
				"QTD_GN= $QTD_GN, ".
				"PONTOS_INSTALADOS = $PONTOS_INSTALADOS ".

			"WHERE ".
				TBL_CARAC_ED.".ID_EDIFICACAO = $ID_EDIFICACAO AND ". 
				TBL_CARAC_ED.".ID_CIDADE=$ID_CIDADE ".
			";";
// echo "query_ed_2: $query_ed_2"; exit;

	} else {
 
		
$query_pessoa= "INSERT INTO ".TBL_PESSOA." (ID_CNPJ_CPF, ID_CIDADE, ID_TP_PESSOA, NM_PESSOA, NM_PESSOA_FONETICA, NR_FONE, DE_EMAIL_PESSOA, CH_JURIDICA) VALUES ($NR_CNPJ_CPF_PROPRIETARIO,
$ID_CIDADE, $ID_TP_PESSOA, $NM_PROPRIETARIO, $NM_PROPRIETARIO_FONETICA, $NR_FONE_PROPRIETARIO, $DE_EMAIL_PROPRIETARIO, $CH_JURIDICA)";



//insert
		$query_ed_2 = "insert into ".TBL_CARAC_ED." (".
				"ID_EDIFICACAO, ".
				"ID_CIDADE, ".
				"CH_SIS_PREVENTIVO_EXTINTOR, ".
				"CH_COMB_GLP, ".
				"ID_TP_RECIPIENTE, ".
				"CH_COMB_GN, ".
				"ID_TP_INSTALACAO, ".
				"ID_ILU_EMERG, ".
				"NR_ESCADA_PRESSU, ".
				"NR_ESCADA_COMUM, ".
				"NR_ESCADA_PROTEGIDA, ".
				"NR_RAMPA, ".
				"NR_ESCADA_ENC, ".
				"NR_RESG_AEREO, ".
				"NR_ELEV_EMERGENCIA, ".
				"NR_ESCADA_PROVA_FUMACA, ".
				"NR_PASSARELA , ".
				"ID_TP_PARA_RAIO, ".   
				"ID_TP_CAPTORES , ".      
				"ID_TP_ATERRAMENTO, ".    
				"ID_TP_ABANDONO , ".      
				"CH_SPRINKLER , ".
				"CH_MULSYFIRE, ".
				"CH_FIXO_CO2, ".
				"CH_ANCORA_CABO, ".
				"DE_OUTROS, ".
				"ID_ADUCAO ".
			") values (".

				"$ID_EDIFICACAO, ".
				"$ID_CIDADE, ".
				"$CH_SIS_PREVENTIVO_EXTINTOR, ".
				"$CH_COMB_GLP, ".
				"$ID_TP_RECIPIENTE, ".
				"$CH_COMB_GN, ".
				"$ID_TP_INSTALACAO, ".
				"$ID_ILU_EMERG, ".
				"$NR_ESCADA_PRESSU, ".
				"$NR_ESCADA_COMUM, ".
				"$NR_ESCADA_PROTEGIDA, ".
				"$NR_RAMPA, ".
				"$NR_ESCADA_ENC, ".
				"$NR_RESG_AEREO, ".
				"$NR_ELEV_EMERGENCIA, ".
				"$NR_ESCADA_PROVA_FUMACA, ".
				"$NR_PASSARELA, ".
				"$ID_TP_PARA_RAIO, ".   
				"$ID_TP_CAPTORES, ".      
				"$ID_TP_ATERRAMENTO, ".    
				"$ID_TP_ABANDONO, ".      
				"$CH_SPRINKLER, ".
				"$CH_MULSYFIRE, ".
				"$CH_FIXO_CO2, ".
				"$CH_ANCORA_CABO, ".
				"$DE_OUTROS, ".
				"$ID_ADUCAO ".
			")" ;// echo "query_ed_2: $query_ed_2"; exit;

	}

    } else {

      $query_ed="";
	  $query_ed_2="";
	  $erro = MSG_ERR_ALT;
      $query_trans = "ROLLBACK";

    }
  }

  // query_ed

  if ($query_ed!="") {
    $res = $conn->query($query_ed);
    if ($conn->get_status()==false) {
      $ERRO_TRANS.="ATUALIZAÇÃO EDIFICAÇÃO:".$conn->get_msg()."\n";
      $query_trans="ROLLBACK";
    }

    if ($ID_EDIFICACAO==0) {
      $ID_EDIFICACAO=$conn->insert_id();
    }
    $ID_CODIGO_RETORNO=$ID_EDIFICACAO;
  }

  // teste query_2
  if ($query_ed_2) {
    $conn->query($query_ed_2);
    if ($conn->get_status() == false) {
      $ERRO_TRANS .= "ATUALIZAÇÃO CARACTERÍSTICA DA EDIFICAÇÃO:".$conn->get_msg()."\n";
      $query_trans = "ROLLBACK";
    }
  }

  if ($query_ed_3) {
	$query_ed_3 = str_replace("asdf",$ID_EDIFICACAO,$query_ed_3);
		$conn->query($query_ed_3);
		if ($conn->get_status() == false) {
			$ERRO_TRANS .= "INSERÇÃO CARACTERÍSTICA DA EDIFICAÇÃO:".$conn->get_msg()."\n";
			$query_trans = "ROLLBACK";
		}
		// echo "$query_ed_3 ";  
  }

  $res = $conn->query($query_trans);
  if ($conn->get_status()==false) {
    $ERRO_TRANS.="COMMIT:".$conn->get_msg()."\n";
    $query_trans="ROLLBACK";
    mysql_query($query_trans);
    die($ERRO_TRANS);
  }

 //  include ('../../templates/retorno.htm');
   if (($form_padrao!="") && ($query_ed!="")) {
	?>
	<script language="javascript" type="text/javascript">//<!--
	  var frm_ret=window.opener.document.<?=$_POST["hdn_form_padrao"]?>;
	  frm_ret.txt_id_edificacao.value="<?=str_replace("'","",$ID_EDIFICACAO)?>";
	  frm_ret.txt_nm_edificacao.value="<?=str_replace("'","",$NM_EDIFICACAO)?>";
	  frm_ret.txt_nm_tp_logradouro.value="<?=str_replace("'","",$NM_TP_LOGRADOURO)?>";
	  frm_ret.txt_nm_logradouro.value="<?=str_replace("'","",$NM_LOGRADOURO)?>";
	  frm_ret.txt_nr_edificacao.value="<?=str_replace(".",",",$NR_EDIFICACAO)?>";
	  frm_ret.txt_nm_bairro.value="<?=str_replace("'","",$NM_BAIRROS)?>";
	  frm_ret.txt_id_cep.value="<?=str_replace("'","",$ID_CEP)?>";
	  //frm_ret.txt_nm_cidade.value="<?=$ID_CIDADE?>";
	  frm_ret.txt_nm_complemento.value="<?=str_replace("'","",$NM_COMPLEMENTO)?>";
	  frm_ret.txt_vl_area_construida.value="<?=str_replace(".",",",$VL_AREA_CONSTRUIDA)?>";
	  CEP(frm_ret.txt_id_cep);
	  FormatNumero(frm_ret.txt_vl_area_construida);
	  decimal(frm_ret.txt_vl_area_construida,2);
	  FormatNumero(frm_ret.txt_nr_edificacao);
	  decimal(frm_ret.txt_nr_edificacao,0);
	  frm_ret.txt_id_edificacao.readOnly=true;
	 window.close();
	
	//--></script>
	<?
   } else {
	?>
	<script language="javascript" type="text/javascript">
	  //window.location.href="<?=$arquivo?>";
	</script>
	<?
   }
} else {
  if ($campos_existe) {
    $erro= MSG_ERR_OBR;
  }
}
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo1,campo2,arq) {
      var frm=document.frm_edificacao;
    //alert "ok"; 
	 frm.txt_id_edificacao_old.value = frm.txt_id_edificacao.value;
      frm.cmb_id_cidade_old.selectedIndex = frm.cmb_id_cidade.selectedIndex;
	  if ((campo1.value!="") && (campo2.value!="")) {
    		window.open(arq+"?campo1="+campo1.value+"&campo2="+campo2.value,"consulrot","top=5000,left=5000,screenY= 5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      window.location.href="<?=$arquivo?>";
 //     frm.txt_id_rotina.readOnly=false;
    }
    function eng(funcao,campo_id,campo_nm,ctr) {
      var frm=document.frm_edificacao;
      if (funcao==1) {
        alert("consulta");
        return true;
      }
      if (funcao==2) {
        if (ctr==1) {
          if ((frm.hdn_id_engenheiro_2.value!="")||(frm.hdn_id_engenheiro_3.value!="")) {
            alert("Primeiro Engenheiro Obrigat&oacute;rio, Limpe os Posteriores!");
            return true;
          }
        }
        alert("limpa");
        campo_id.value = "";
        campo_nm.value ="";
        return true;
      }
    }
    function cons_logra(valor,cidade,nr) {
	      window.open("cons_logra_func_ed.php?txt_nm_logradouro="+valor+"&hdn_id_cidade="+cidade+"&txt_nr_edificacao="+nr,"cons_logradouro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=670,innerwidth=780,innerheight=670")
    }
    function cad_log() {
      var cep =document.frm_edificacao.txt_nr_cep.value;
      var cidade=document.frm_edificacao.hdn_id_cidade.value;
      if ((cep!="")&&(cidade!="")) {
        cep=limpa_num(cep,false);
        <?
          if ($form_padrao=="") {
        ?>
        var indice = document.frm_edificacao.cmb_id_cidade.selectedIndex;
        var nomecidade = document.frm_edificacao.cmb_id_cidade.options[indice].text;
        //alert(cidade);
        <?
          } else {
        ?>
        var nomecidade = document.frm_edificacao.txt_nm_cidade;
        <?
          }
        ?>
        window.open("../cadastro/cad_lograd_ed.php?txt_id_cep="+cep+"&hdn_id_cidade="+cidade+"&txt_nm_cidade="+nomecidade,"cad_cons_logradouro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=470,innerwidth=780,innerheight=470");
      } else {
        var msg_erro="Os Seguintes Problemas Foram Encontrados:\n";
        if (cep=="") {
          msg_erro+="=>CEP em Branco!!\n";
        }
        if (cidade=="") {
          msg_erro+="=>Cidade n&atildeo Definida!!\n";
        }
        msg_erro+="VERIFIQUE!!";
        alert(msg_erro);
      }
    }
    function envia_cons_ed() {
      var frm_ed = document.frm_edificacao;
      window.open("edificacoes/consulta_edif.php?hdn_id_cidade="+frm_ed.hdn_id_cidade.value+"&form_padrao=frm_edificacao","cons_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=500,innerwidth=780,innerheight=500")
    }
    function envia_cons_pro() {
//alert('adf'); exit;
      var frm_ed = document.frm_edificacao;
      window.open("../cadastro/consulta_propr.php?form_padrao=frm_edificacao&txt_nm_pessoa="+document.frm_edificacao.txt_nm_proprietario.value,"cons_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=500,innerwidth=780,innerheight=500")
    }
</script>
<body onload="ajustaspan()">

	<? //include ('../../templates/cab.htm'); ?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_edificacao" onreset="retorna(this)" onsubmit="return validaForm(this,<?=$campos_js?>)">

            <input type="hidden" name="hdn_id_carc_edificacao" value="">

            <input type="hidden" name="hdn_form_padrao" value="<?=$form_padrao?>">
            <table width="95%" cellspacing="0" border="0" cellpadding="2" align="center">
              <tr>
              	<td>
					Cidade
					<? if ($form_padrao=="") { ?>
						<script language="javascript" type="text/javascript">document.frm_edificacao.txt_id_edificacao.readOnly=false;</script>
						<select name="cmb_id_cidade" class="campo_obr" title="Nome da Cidade onde está localizada a Edifica&ccedil;&atilde;o" onChange="javascript:document.frm_edificacao.hdn_id_cidade.value=this.value;consultaReg(document.frm_edificacao.txt_id_edificacao,this,'edificacao_cons.php');">
							<option value="">-------</option>
							<?
							$sql = "SELECT ".TBL_CIDADE.".ID_CIDADE ID_CIDADE,NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' AND ".TBL_CIDADE.".ID_UF='SC' ORDER BY NM_CIDADE";
							$res = $conn->query($sql);
							if ($conn->get_status()==false) die($conn->get_msg());
							while ($tupula = $conn->fetch_row()) {?><option value="<?=$tupula['ID_CIDADE']?>"><?=$tupula['NM_CIDADE']?></option><? } ?>
						</select>
					<? } else { echo $_GET['hdn_id_cidade']; } ?>
              	</td>
              	<td>
					RE <input type="text" name="txt_id_edificacao" class="campo" value="" readOnly="false" onkeypress="return validaTecla(this, event, 'n')" title="Registro da Edifica&ccedil;&atilde;o" align="right" size="20" maxlength="15" onchange="consultaReg(this,document.frm_edificacao.cmb_id_cidade,'edificacao_cons.php')">
              	</td>
              </tr>
              <tr>
                <td  colspan="2" >
                  <fieldset>
                    <legend>Propriet&aacute;rio</legend>
                      <table>
                        <tr>
                          <td>CNPJ/CPF</td>
                          <td><input type="text" name="txt_nr_cnpjcpf_proprietario" size="20" maxlength="18" class="campo_obr" title="CNPJ ou CPF do Propriet&aacute;rio da Edifica&ccedil;&atilde;o" onblur="cpfcnpj(this);consultaReg(this,'','proprietario_cons.php');"></td>
                          <td>Nome</td>
                          <td><input type="text" name="txt_nm_proprietario" size="40" maxlength="100" class="campo_obr" title="Nome do Propriet&aacute;rio da Edifica&ccedil;&atilde;o"></td>
                          <td>
                            <input type="button" name="btn_cons_proprietario" value="Propriet&aacute;rio" align="middle" title="Consulta Propriet&aacute;rio" class="botao" style="background-image : url('../../imagens/botao.gif');" onClick="envia_cons_pro()">
                          </td>
                        </tr>
                        <tr>
                          <td>Fone</td>
                          <td><input type="text" name="txt_nr_fone_proprietario" size="20" maxlength="12" class="campo_obr" title="Fone do Propriet&aacute;rio da Edifica&ccedil;&atilde;o"></td>
                          <td>E-mail</td>
                          <td><input type="text" name="txt_de_email_proprietario" size="40" maxlength="100" class="campo_obr" title="E-mail do Prorietário da Edifica&ccedil;&atilde;o" style="text-transform : none;"></td>
                        </tr>
                      </table>
                    </fieldset>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="vertical-align: top;">
                    <fieldset>
                      <legend>Edifica&ccedil;&atilde;o</legend>
                      <table width="100%" cellspacing="0" border="0" cellpadding="0">
                        <tr>
                          <td>
                            <table width="100%" cellspacing="2" border="0" cellpadding="2">
                              <tr>
                                <td>RE</td>
                                <td>
                                  <input type="text" name="txt_id_edificacao_old" class="campo2" value="" readOnly="true" onkeypress="return validaTecla(this, event, 'n')" title="Registro da Edifica&ccedil;&atilde;o" align="right" size="20" maxlength="15">
                                <td>Nome</td>
                                <td><input type="text" name="txt_nm_edificacao" size="50" maxlength="100" class="campo_obr" title="Nome da Edifica&ccedil;&atilde;o"></td>
                              </tr>
                            </table>
                            <table width="100%" cellspacing="0" border="0" cellpadding="0">
                              <tr>
                                <td>Nome Fantasia 1</td>
                                <td><input type="text" name="txt_nm_fantasia_1" size="25" maxlength="100" title="Primeiro Nome Fantasia da Edificação" class="campo"></td>
                                <td>Nome Fantasia 2</td>
                                <td><input type="text" name="txt_nm_fantasia_2" size="25" maxlength="100" title="Primeiro Nome Fantasia da Edificação" class="campo"></td>
                              </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <fieldset>
                            <legend>Endere&ccedil;o</legend>
                            <table cellspacing="0" border="0" cellpadding="2" width="100%">
                              <tr>
                                <td>Logradouro</td>
                                <td>
                                  <input type="hidden" name="hdn_id_tp_logradouro" value="">
                                  <input type="text" name="txt_nm_tp_logradouro" value="" class="campo" size="20" maxlength="50" readOnly="true">
                                </td>
                                <td colspan="1">
                                  <input type="hidden" name="hdn_id_logradouro" value="">
                                  <input type="text" name="txt_nm_logradouro" size="40" maxlength="100" title="Nome do Logradouro" class="campo_obr">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3">

                                  <table width="100%" border="0" cellspacing="0" cellpadding="2" align="left">
                                    <td>Nº</td>
                                    <td>
                                      <input type="text" name="txt_nr_edificacao" size="5" maxlength="6" class="campo" title="N&utilde;mero do Endere&ccedil;o da Edifica&ccedil;&atilde;o" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)" align="right">
                                    </td>
                                    <td>Cidade</td>

                                    <td>
                                      <input type="hidden" name="hdn_id_cidade" value="">
								<? if ($form_padrao=="") { ?>
									<script language="javascript" type="text/javascript">
									  document.frm_edificacao.txt_id_edificacao.readOnly=false;
									</script>
                                      <select name="cmb_id_cidade_old" class="campo_obr" title="Nome da Cidade onde est&aatilde; localizada a Edifica&ccedil;&atilde;o" onChange="javascript:document.frm_edificacao.hdn_id_cidade.value=this.value;consultaReg(document.frm_edificacao.txt_id_edificacao,this,'edificacao_cons.php');">
                                        <option value="">-------</option>
                                            <?
                                              // string da query
                                              $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE ID_CIDADE,NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' AND ".TBL_CIDADE.".ID_UF='SC' ORDER BY NM_CIDADE";
                                              $res= $conn->query($sql);
                                               if ($conn->get_status()==false) die($conn->get_msg());
                                              while ($tupula = $conn->fetch_row()) {
											?>
                                        <option value="<?=$tupula['ID_CIDADE']?>"><?=$tupula['NM_CIDADE']?></option>
								<? } ?>
                                      </select>
                                    </td>

                                    <td>
                                      <input type="button" name="btn_cons_edificacao" value="Consulta RE" align="middle	" title="Inclui o Registro" class="botao" style="background-image : url('../../imagens/botao.gif');" onClick="envia_cons_ed()">
                                    </td>
								<? } else { ?>
                                      <input type="text" name="txt_nm_cidade" size="50" maxlength="100" class="campo" readOnly="true" value="">
								<? } ?>
                                    </td>
                                  </tr>
                                  </table>

                                </td>
                              <tr>
                                <td>Bairro</td>
                                <td>
                                  <input type="text" name="txt_nm_bairro" size="26" maxlength="50" class="campo_obr" title="Bairro da Edifica&ccedil;&atilde;o">
                                </td>
                                <td width="10">CEP
                                  <input type="hidden" name="hdn_id_cep" value="">
                                  <input type="text" name="txt_nr_cep" size="15" maxlength="10" class="campo_obr" title="N&utilde;mero do CEP da Edifica&ccedil;&atilde;o" onkeypress="return validaTecla(this, event, 'n')" onblur="CEP(this)">
                                </td>
                              </tr>
                              <tr>
                                <td align="right">Complemento</td>
                                <td>
                                  <input type="text" name="txt_nm_complemento" size="30" maxlength="100" class="campo" title="Complemento do Endere&ccedil;o da Edifica&ccedil;&atilde;o">
                                </td>
                                <td colspan="2">
                                  <center>
                                    <input type="button" name="btn_valida_logradouro" value="Validar" class="botao" style="background-image : url('../../imagens/botao.gif');" title="Validar o Logradouro Existente" onClick="cons_logra(document.frm_edificacao.txt_nm_logradouro.value,document.frm_edificacao.hdn_id_cidade.value,document.frm_edificacao.txt_nr_edificacao.value)">
                                  </center>
                                </td>
                              </tr>
                            </table>
                          </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <fieldset>
                            <legend>Caracter&iacute;sticas</legend>
                            <table width="100%" cellspacing="0" border="0" cellpadding="2">
                              <tr>
                                <td>&Aacute;rea Total<br>Constru&iacute;da</td>
                                <td>
                                  <input type="text" name="txt_vl_area_construida" align="right" class="campo_obr" size="10" maxlength="25" value="" title="Valor total da &aacute;rea constru&iacute;da" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)"><em>(m2)</em>
                                </td>
                                <td>Altura</td>
                                <td>
                                  <input type="text" align="right" name="txt_vl_altura" class="campo_obr" size="10" maxlength="25" value="" title="Altura Total da Edifica&ccedil;&atilde;o" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)"><em>(m)</em>
                                </td>
                                <td>&Aacute;rea do<br>Pavimento Tipo</td>
                                <td>
                                  <input type="text" align="right"  name="txt_vl_area_pavimento" class="campo_obr" size="10" maxlength="25" value="" title="&Aacute;rea do maior Pavimento da Edifica&ccedil;&atilde;o" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)"><em>(m2)</em>
                                </td>
                              <tr>
                                <td>Risco</td>
                                <td>
                                  <select name="cmb_id_risco" class="campo_obr" title="Classe de risco de inc?ndio da Edifica&ccedil;&atilde;o">
                                    <option value="">-------</option>
								<?
		                        // string da query
		                        $sql= "SELECT ID_RISCO, NM_RISCO FROM ".TBL_TP_RISCO;
		                        // executando a consulta
		                        $res= $conn->query($sql);
		                        // testando se houve algum erro
		                        if ($conn->get_status()==false) die($conn->get_msg());
		                        while ($tupula = $conn->fetch_row()) {
								?>
                                    <option value="<?=$tupula['ID_RISCO']?>"><?=$tupula['NM_RISCO']?></option>
								<? } ?>
                                  </select>
                                </td>
                                <td>Ocupa&ccedil;&atilde;o</td>
                                <td colspan="3">
                                  <select name="cmb_id_ocupacao" class="campo_obr" title="Classifica&ccedil;&atilde;o da Edifica&ccedil;&atilde;o quanto a sua Ocupa&ccedil;&atilde;o">
                                    <option value="">--------</option>
						<?
                        // string da query
                        $sql= "SELECT ID_OCUPACAO, NM_OCUPACAO FROM ".TBL_TP_OCUPACAO;
                        // executando a consulta
                        $res= $conn->query($sql);
                        // testando se houve algum erro
                        if ($conn->get_status()==false) die($conn->get_msg());
                        while ($tupula = $conn->fetch_row()) {
						?>
						<option value="<?=$tupula['ID_OCUPACAO']?>"><?=$tupula['NM_OCUPACAO']?></option>
						<? } ?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>Situa&ccedil;&atilde;o</td>
                                <td>
                                  <select name="cmb_id_situacao" title="Situa&ccedil;&atilde;o da edifica&ccedil;&atilde;o quanto a sua constru&ccedil;&atilde;o" class="campo_obr">
                                    <option value="">--------</option>
						<?
                        // string da query
                        $sql= "SELECT ID_SITUACAO, NM_SITUACAO FROM ".TBL_TP_SITUACAO;
                        // executando a consulta
                        $res= $conn->query($sql);
                        // testando se houve algum erro
                        if ($conn->get_status()==false) die($conn->get_msg());
                        while ($tupula = $conn->fetch_row()) {
						?>
							<option value="<?=$tupula['ID_SITUACAO']?>"><?=$tupula['NM_SITUACAO']?></option>
						<? } ?>
                                  </select>
                                </td>
                                <td>Tipo</td>
                                <td colspan="3">
                                  <select name="cmb_id_tp_construcao" class="campo_obr" title="Tipo de constru&ccedil;&atilde;o da Edifica&ccedil;&atilde;o">
                                    <option value="">--------</option>
						<?
                        // string da query
                        $sql= "SELECT ID_TP_CONSTRUCAO, NM_TP_CONSTRUCAO FROM ".TBL_TP_CONSTRUCAO;
                        // executando a consulta
                        $res= $conn->query($sql);
                        // testando se houve algum erro
                        if ($conn->get_status()==false) die($conn->get_msg());
                        while ($tupula = $conn->fetch_row()) {
							?><option value="<?=$tupula['ID_TP_CONSTRUCAO']?>"><?=$tupula['NM_TP_CONSTRUCAO']?></option><?
						}
						?>
                                  </select>
                                </td>
                              <tr>
                              </tr>
                                <td>Nº Pavimento</td>
                                <td>
                                  <select name="cmb_nr_pavimentos" class="campo_obr" title="N&utilde;mero de pavimentos da edifica&ccedil;&atilde;o">
						<? for ($i=1;$i<=35;$i++) { ?>
                        	<option value="<?=$i?>"><?=$i?></option>
						<? } ?>
                    		</select>
                                </td>
                                <td>Nº Blocos</td>
                                <td colspan="3">
                                  <select name="cmb_nr_blocos" class="campo_obr" title="N&utilde;mero de Blocos da Edifica&ccedil;&atilde;o">
						<? for ($i=1;$i<=50;$i++) { ?>
                              <option value="<?=$i?>"><?=$i?></option>
						<? } ?>
                                  </select>
                                </td>
                              </tr>
                            </table>
                          </fieldset>
                        </td>
                      </tr>
	                  </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
<!-- começa aqui sistemas preventivos -->

            <table width="80%" cellspacing="0" border="0" cellpadding="0" align="center">
              <tr>
                <td  colspan="2" >
                  <fieldset>
  					<fieldset>
                  <legend>Sistema de Segurança Contra Incêndios</legend>
                  <table width="95%" cellspacing="2" border="0" cellpadding="0" align="center">
                   
  <tr>
                    <tr><td colspan="5"><hr class="hr2" /></td></tr>
                      <td colspan="3">Possui Sistema Preventivo por Extintor(SE)?</td>
                    </tr>
                    <tr>
                      <td colspan="3">
                        <table cellspacing="0" cellpadding="2" align="center" border="0" width="100%">
                          <tr>
                            <td>
  								<input type="hidden" name="hdn_ctr_extintor" value="">
                              <label><input type="radio" name="rdo_ch_extintor" class="campo" value="S" onChange="controle_multiplos(this.form,1,'chk_pqs','cmb_nr_pqs','chk_agua','cmb_agua','chk_espuma','cmb_espuma','chk_co2','cmb_co2')" class="campo" value="S">Sim</label>
                                <label><input type="radio" name="rdo_ch_extintor" class="campo" value="N" onChange="controle_multiplos(this.form,2,'chk_pqs','cmb_nr_pqs','chk_agua','cmb_agua','chk_espuma','cmb_espuma','chk_co2','cmb_co2')" class="campo" value="N">Não</label>
                            </td>
</tr>
<tr>                          
 							 <td style="font-weight : bold;">Dispositivo</td>
                            <td style="font-weight : bold;">Quantidade</td>
                          
                            <td style="font-weight : bold;">Dispositivo</td>
                            <td style="font-weight : bold;">Quantidade</td>                           
                          <tr>
                            <td>
                              <label>
                                <input type="checkbox" name="chk_pqs" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_pqs')" class="campo" disabled="true">PQS
                              </label>
                            </td>
                            <td>
                              <select name="cmb_nr_pqs" class="campo"  disabled="true">
                                <?
                                  for ($i=0;$i<=20;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                            </td>
                              <td>
                              <label>
                                <input type="checkbox" name="chk_agua" class="campo" onchange="controle_multiplo(this.form,this,'cmb_agua')" disabled="true">H2O
                              </label>
                            </td>
                            <td>
                              <select name="cmb_agua" class="campo" disabled="true">
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
                                <input type="checkbox" name="chk_espuma" onchange="controle_multiplo(this.form,this,'cmb_espuma')" class="campo" disabled="true">Espuma
                              </label>
                            </td>
                            <td>
                              <select name="cmb_espuma" class="campo" disabled="true">
                                <?
                                  for ($i=0;$i<=20;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                            </td>
							<td>
                              <label>
                                <input type="checkbox" name="chk_co2" onchange="controle_multiplo(this.form,this,'cmb_co2')" class="campo" disabled="true">CO2
                              </label>
                            </td>
                            <td>
                              <select name="cmb_co2" class="campo" disabled="true">
                                <?
                                  for ($i=0;$i<=20;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                            </td>
					 </tr>
                        </table>
                      </td>
                    </tr>
 					 <tr><td colspan="3"><hr class="hr2" /></td></tr>
                     <tr><td colspan="3">Possui Sistema e alarme de Incêndio(SAI)?</td>
 					 <tr>
                      <td colspan="3">
                        <table cellspacing="0" cellpadding="2" align="center" border="0" width="100%">
                          <tr>
                            <td>
                              <label>
                                <input 
                                    type="radio" 
                                    name="rdo_alarme" 
                                    onChange="controle_multiplos(
                                        this.form,
                                        1,
                                        'chk_dec_fumaca',
                                        'cmb_nr_fumaca',
                                        'chk_dec_termo',
                                        'cmb_nr_velocimetrico',
                                        'chk_dec_quimico',
                                        'cmb_dec_quimico',
                                        'chk_acioanamento',
                                        'cmb_nr_acioanamento',
										'txa_local_instalados'
                                    )" 
                                    class="campo" 
                                    value="S">Sim
                                </label>
                                <label>
                                    <input 
                                    type="radio" 
                                    name="rdo_alarme"
                                    onChange="controle_multiplos(
                                        this.form,
                                        2,
                                        'chk_dec_fumaca',
                                        'cmb_nr_fumaca',
                                        'chk_dec_termo',
                                        'cmb_nr_velocimetrico',
                                        'chk_dec_quimico',
                                        'cmb_dec_quimico',
                                        'chk_acioanamento',
                                        'cmb_nr_acioanamento',
										'txa_local_instalados'
                                    )" 
                                    class="campo" 
                                    value="N">Não
                                 </label>
                            </td>
                            <td>&nbsp;</td>
</tr>
<tr>
                            <td style="font-weight : bold;">Dispositivo</td>
                            <td style="font-weight : bold;">Quantidade</td>
                            <td style="font-weight : bold;">Dispositivo</td>
                            <td style="font-weight : bold;">Quantidade</td>
						   </tr>
                            <tr>
                            <td>
                              <label>
                                <input type="checkbox" name="chk_dec_termo" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_velocimetrico')" disabled="true">Detector Termo-velocimetrico
                              </label>
                            </td>
                            <td>
                              <select name="cmb_nr_velocimetrico" disabled="true" class="campo" title="Número de Detectores Termo-velocimetricos">
                                <?
                                  for ($i=0;$i<=10;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                    
                            <td valign="top">
                              <label>
                                <input type="checkbox" name="chk_dec_quimico" class="campo" onchange="controle_multiplo(this.form,this,'cmb_dec_quimico')" disabled="true"> Detectores Químicos
                              </label>
                            </td>
                            <td valign="top">
                              <select name="cmb_dec_quimico" disabled="true" class="campo" title="Número de Detectores Químicos">
                                <?
                                  for ($i=0;$i<=20;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                            </td>
                          </tr>
							<td>
                              <label>
                                <input type="checkbox" name="chk_acioanamento" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_acioanamento')" disabled="true">Pontos Acionamento
                              </label>
                            </td>
                            <td>
                              <select name="cmb_nr_acioanamento" class="campo" title="Quantidade Pontos Acionamento" disabled="true">
                                <?
                                  for ($i=0;$i<=20;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                            </td>
							<td>
                              <label>
                                <input type="checkbox" name="chk_dec_fumaca" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_fumaca')" disabled="true">Detectores de Fumaça
                              </label>
                            </td>
                            <td>
                              <select name="cmb_nr_fumaca" class="campo" title="Número de Detectores de Fumaça" disabled="true">
                                <?
                                  for ($i=0;$i<=20;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                            </td>
                         	</tr>   
							 <tr>								
                                    <td colspan="5">
                                    <textarea name="txa_local_instalados" cols="87" rows="4" class="campo"   style="text-transform : none;">Local onde estão instalados:</textarea>
                                    </td>	                          
                                </tr>
                                </tr>   
                        </table>
                      </td>
                    </tr>
			        <tr>
                      <td colspan="3"></td>
                    </tr>

					<tr><td colspan="3"><hr class="hr2" /></td></tr>

                    <tr>
                      <td width="33%">Possui Sistema Hidraulico Preventivo(SHP)?</td>
                      <td colspan="2">Tipo da Adução</td>
                    </tr>
                    <tr>
                      <td>
                        <input type="hidden" name="hdn_ctr_aducao" value="">
                    <label><input type="radio" name="rdo_hidraulico_preventivo"
					onChange="javascript:controle_multiplos(this.form,1,'cmb_id_aducao');document.frm_seguranca.hdn_ctr_aducao.value='';" class="campo" value="S">Sim</label>
					<label><input type="radio" name="rdo_hidraulico_preventivo"
					onChange="javascript:controle_multiplos(this.form,2,'cmb_id_aducao');document.frm_seguranca.hdn_ctr_aducao.value='N';" class="campo" value="N">Não</label>
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
                      <td colspan="3"></td>
                    </tr>
					<tr><td colspan="3"><hr class="hr2" /></td></tr>
                    <tr>
                      <td>Possui Gás Canalizado(SGCC)?</td>
                    </tr>
                    <tr>
                      <td>
                       
<input type="hidden" name="hdn_ctr_gas" value="">
                        <label><input type="radio" name="rdo_gas_can" onChange="controle_multiplos(this.form,1,'chk_ch_glp','cmb_id_recipiente','chk_ch_gn','cmb_id_tp_instalacao','cmb_qt_glp','cmb_qt_gn');" class="campo" value="S">Sim</label>
                        <label><input type="radio" name="rdo_gas_can" onChange="controle_multiplos(this.form,2,'chk_ch_glp','cmb_id_recipiente','chk_ch_gn','cmb_id_tp_instalacao','cmb_qt_glp','cmb_qt_gn');" class="campo" value="N">Não</label>

</td>
</tr>

   					<td>Combustível</td>
                    <td>Recipiente</td>
					<td>Quantidade(Kg)</td>
<tr>
					  <td>
                        <label><input type="checkbox" name="chk_ch_glp" onChange="controle_multiplo	(this.form,this,'cmb_id_recipiente');check(this);" class="campo" disabled="true">GLP</label>
                      </td>
                      <td>
                        <select name="cmb_id_recipiente" class="campo" title="Modelo de cilindro quanto a sua carga" disabled="true">
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

					  <td>
                        <select name="cmb_qt_glp" class="campo">
                          <option value="">---------</option>
						  <option value="13">13</option>
						  <option value="26">26</option>
						  <option value="45">45</option>
						  <option value="90">90</option>
						  <option value="180">180</option>
						  <option value="360">360</option>
						  <option value="500">500</option>
						  <option value="720">720</option>
						  <option value="1000">1000</option>
						  <option value="1500">1500</option>
						  <option value="2000">2000</option>
						  <option value="2500">2500</option>
						  <option value="3000">3000</option>
                        </select>
                      </td>
                   </tr>
                     <td>Combustível</td>
                     <td>Tipo</td>
					 <td>Quantidade(Kg)</td>
                   
<tr>
                      <td>
                        <label><input type="checkbox" name="chk_ch_gn" class="campo" title="Caso possua gás natural" disabled="true" onchange="controle_multiplo(this.form,this,'cmb_id_tp_instalacao');check(this)">GN(Gás Natural)</label>
                      </td>
                      <td>
                      <select name="cmb_id_tp_instalacao" class="campo" title="Objeto de uso da instalação" disabled="true">
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
?>						 </select>
                      </td>
						<td>
                        <select name="cmb_qt_gn" class="campo">
						  <option value="">---------</option>
						  <option value="13">13</option>
						  <option value="26">26</option>
						  <option value="45">45</option>
						  <option value="90">90</option>
						  <option value="180">180</option>
						  <option value="360">360</option>
						  <option value="500">500</option>
						  <option value="720">720</option>
						  <option value="1000">1000</option>
						  <option value="1500">1500</option>
						  <option value="2000">2000</option>
						  <option value="2500">2500</option>
						  <option value="3000">3000</option>
						 </select>
                      </td>
                    </tr>
                    <tr><td colspan="3"><hr class="hr2" /></td></tr>
					<tr>
                      <td>Possui Iluminação de Emergência(IE)?</td>
                      <td colspan="2">Tipo</td>
                    </tr>
                    <tr>
                      <td>
                        <input type="hidden" name="hdn_ctr_iluminacao" value="">

<label><input type="radio" name="rdo_ilu_emergencia"
onChange="javascript:controle_multiplos(this.form,1,'cmb_id_iluminacao_emergencia');document.frm_seguranca.hdn_ctr_iluminacao.value='';" class="campo" value="S">Sim</label>

<label><input type="radio" name="rdo_ilu_emergencia"
onChange="javascript:controle_multiplos(this.form,2,'cmb_id_iluminacao_emergencia');document.frm_seguranca.hdn_ctr_iluminacao.value='N';" class="campo" value="N">Não</label>

                      </td>
                      <td colspan="2">
                        <select name="cmb_id_iluminacao_emergencia" class="campo" title="Tipo de iluminação de emergência quanto a sua alimentação de energia" disabled="true">
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
					</tr>
                    <tr>
                      <td colspan="3"></td>
                    </tr>
                    <tr>
					<tr><td colspan="3"><hr class="hr2" /></td></tr>
                      <td colspan="3">Possui Saída de Emergência(SE)?</td>
                    </tr>
                    <tr>
                      <td colspan="3">
                        <table cellspacing="0" cellpadding="2" align="center" border="0" width="100%">
                          <tr>
                            <td>
                              <label><input type="radio" name="rdo_saida_emergencia" onChange="controle_multiplos(this.form,1,'chk_esc_comum','chk_esc_pres','chk_esc_protegida','chk_rampa','chk_esc_enclausurada','chk_elev_emergencia','chk_esc_fumaca','chk_resg_aereo','chk_passarela','cmb_nr_escada_comum','cmb_nr_pressurizada','cmb_nr_protegida','cmb_nr_rampa','cmb_nr_enclausurada','cmb_nr_elev_emerg','cmb_nr_esc_fumaca','cmb_nr_reg_aereo','cmb_nr_passarela')" class="campo" value="S">Sim</label>
                              <label><input type="radio" name="rdo_saida_emergencia" onChange="controle_multiplos(this.form,2,'chk_esc_comum','chk_esc_pres','chk_esc_protegida','chk_rampa','chk_esc_enclausurada','chk_elev_emergencia','chk_esc_fumaca','chk_resg_aereo','chk_passarela','cmb_nr_escada_comum','cmb_nr_pressurizada','cmb_nr_protegida','cmb_nr_rampa','cmb_nr_enclausurada','cmb_nr_elev_emerg','cmb_nr_esc_fumaca','cmb_nr_reg_aereo','cmb_nr_passarela')" class="campo" value="N">Não</label>
                            </td>
                     </tr>
					 <tr>
                            <td style="font-weight : bold;">Dispositivo</td>
                            <td style="font-weight : bold;">Quantidade</td>
                        	    <td style="font-weight : bold;">Dispositivo</td>
                            <td style="font-weight : bold;">Quantidade</td>
                           
                          </tr>
                          <tr>
                            <td>
                              <label>
                                <input type="checkbox" name="chk_esc_comum" onchange="controle_multiplo(this.form,this,'cmb_nr_escada_comum')" class="campo" disabled="true">Escada Comum(EC)
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
                                <input type="checkbox" name="chk_rampa" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_rampa')">Rampa(R)
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
                                <input type="checkbox" name="chk_esc_protegida" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_protegida')" disabled="true">Escada Protegida(EP)
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
                                <input type="checkbox" name="chk_elev_emergencia" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_elev_emerg')" disabled="true">Elevador de Emergência(ELE)
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
                            <td valign="top">
                              <label>
                                <input type="checkbox" name="chk_esc_enclausurada" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_enclausurada')" disabled="true">Escada Enclausurada(EE)
                              </label>
                            </td>
                            <td valign="top">
                              <select name="cmb_nr_enclausurada" disabled="true" class="campo" title="Número de Escadas Enclausuradas da Edificação">
                                <?
                                  for ($i=0;$i<=20;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                            </td>
                            <td valign="top">
                              <label>
                                <input type="checkbox" name="chk_resg_aereo" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_reg_aereo')" disabled="true">Local para Resgate Aéreo(LRA)
                              </label>
                            </td>
                            <td>
                              <select name="cmb_nr_reg_aereo" disabled="true" class="campo" title="Número de Locais para Resgate Aéreo da Edificação">
                                <?
                                  for ($i=0;$i<=10;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td valign="top">
                              <label>
                                <input type="checkbox" name="chk_esc_fumaca" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_esc_fumaca')" disabled="true">Escada Enclausurada a<br> Prova de Fumaça(EEPF)
                              </label>
                            </td>
                            <td valign="top">
                              <select name="cmb_nr_esc_fumaca" class="campo" title="Número de Escadas Enclausuradas a Prova de Fumaça da Edificação" disabled="true">
                                <?
                                  for ($i=0;$i<=20;$i++) {
                                    echo "<option value=\"".$i."\">".$i."</option>\n";
                                  }
                                ?>
                              </select>
                            </td>
                            <td valign="top">
                              <label>
                                <input type="checkbox" name="chk_passarela" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_passarela')" disabled="true">Passarela(PA)
                              </label>
                            </td>
                            <td valign="top">
                              <select name="cmb_nr_passarela" disabled="true" class="campo" title="Número de Passarelas da Edificação">
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
                                <input type="checkbox" name="chk_esc_pres" class="campo" onchange="controle_multiplo(this.form,this,'cmb_nr_pressurizada')" disabled="true">Escada Pressurizada(EP)
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
</table>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3"><td>
                    </tr>
                   </tr>
				   <tr>
                   <tr><td colspan="3"><hr class="hr2" /></td></tr>
						<td colspan="3">Possui Proteção Contra Descarga Atmosférica(SPCDA)?</td>
                    </tr>
                    <tr>
                      <td>
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
                    </tr>
					<tr>
                      <td>Método de Proteção</td>
                      <td>Tipo de Captores</td>
                      <td>Tipo de Aterramento</td>
                    </tr>
                    <tr>
                      <td>

			<?
				$conn->query("SELECT ID_TP_PARA_RAIO, NM_TP_PARA_RAIO FROM ".TBL_TP_PARA_RAIO);
				while ($r = $conn->fetch_row()) {
					switch ($r['NM_TP_PARA_RAIO']) {
						case 'ELETROGEOMÉTRICO': $r['NM_TP_PARA_RAIO'] = 'ELETROGEOMÉTRICO(EGEO) '; break;
						case 'FRANKLIN' :$r['NM_TP_PARA_RAIO'] = 'FRANKLIN(FRAN)'; break;
						case 'FARADAY': $r['NM_TP_PARA_RAIO'] = 'FARADAY(FARD) '; break;
					}
					$pararaios[] = $r;
				}
			
			?>

					<select name="cmb_id_pararaio" title="Tipo de Pararaio" class="campo" disabled="true" onChange="javascript:document.frm_seguranca..value=this.value;">
						<option value="">-------------------</option>
						<? foreach ($pararaios as $r) { ?>
							<option value="<?=$r['ID_TP_PARA_RAIO']?>"><?=$r['NM_TP_PARA_RAIO']?></option>
						<? } ?>
					</select>

                     </td>
                   <!---   -->  
					<td>
			<?

				$conn->query("SELECT ID_TP_CAPTORES, NM_TP_CAPTORES FROM ".TBL_TP_CAPTORES);
				while ($cap = $conn->fetch_row()) {
					switch ($cap['NM_TP_CAPTORES']) {
						case 'HASTES': $cap['NM_TP_CAPTORES'] = 'HASTES '; break;
						case 'CABOS ESTICADOS' :$cap['NM_TP_CAPTORES'] = 'CABOS ESTICADOS'; break;
						case 'CONDUTORES EM MALHA': $cap['NM_TP_CAPTORES'] = 'CONDUTORES EM MALHA '; break;
					}
					$captores[] = $cap;
				}                       
			?>

					<select name="cmb_id_captores" title="Tipo de Captores" class="campo" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_raio.value=this.value;">
                          <option value="">-------------------</option>
                          <?foreach ($captores as $cap){?>
								<option value= "<?=$cap['ID_TP_CAPTORES']?>"><?=$cap['NM_TP_CAPTORES']?></option>		
                           <? } ?>  
						</select>
				    </td>	 
			<td>
		<?
				$conn->query("SELECT ID_TP_ATERRAMENTO, NM_TP_ATERRAMENTO FROM ".TBL_TP_ATERRAMENTO);
				while ($a = $conn->fetch_row()) {
					switch ($a['NM_TP_ATERRAMENTO']) {
						case 'CONDUTORES EM ANEL': $a['NM_TP_ATERRAMENTO'] = 'CONDUTORES EM ANEL'; break;
						case 'ATERRAMENTO NATURAL PELAS FUNDAÇÕES' :$a['NM_TP_ATERRAMENTO'] = 'ATERRAMENTO NATURAL PELAS FUNDAÇÕES  '; break;
						case 'HASTES VERTICAIS': $a['NM_TP_ATERRAMENTO'] = 'HASTES VERTICAIS '; break;
					}
					$aterramento[] = $a;
				}
			
		 ?>
                        <select name="cmb_id_aterramento" title="Tipo de Aterramento"  class="campo" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_raio.value=this.value;">
                          <option value="">-------------------</option>
							<? foreach ($aterramento as $a) { ?>
						    	<option value="<?=$a['ID_TP_ATERRAMENTO']?>"><?=$a['NM_TP_ATERRAMENTO']?></option>
							<? } ?>
						</select>
                      </td>
					 </tr>
                    <tr>
                      <td colspan="3"></td>
                    </tr>
                    <tr><td colspan="3"><hr class="hr2" /></td></tr>
					<tr>
                      <td colspan="2">Possui Sinalização de Abandono de Local</td>
                      <td>Tipo</td>
                    </tr>
                    <tr>
                      <td>
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
			<?


				$conn->query("SELECT ID_TP_ABANDONO, NM_TP_ABANDONO FROM ".TBL_TP_ABANDONO);
				while ($ab = $conn->fetch_row()) {
					switch ($ab['NM_TP_ABANDONO']) {
						case 'BLOCO AUTÔNOMO': $ab['NM_TP_ABANDONO'] = 'BLOCO AUTÔNOMO(AUT) '; break;
						case 'CENTRAL DE BATERIAS' :$ab['NM_TP_ABANDONO'] = 'CENTRAL DE BATERIAS(BAT)'; break;
						case 'PLACA (NÃO LUMINOSA)': $ab['NM_TP_ABANDONO'] = 'PLACA NÃO LUMINOSA(PLACA) '; break;
					}
					$abandono[] = $ab;
				}                       
			?>

					<select name="cmb_id_abandono" title="Tipo de Sinalização de Abandono"  class="campo" disabled="true" onChange="javascript:document.frm_seguranca.hdn_ctr_abandono.value=this.value;">
                          <option value="">--------------------</option>
                          <?foreach ($abandono as $ab){?>
								<option value= "<?=$ab['ID_TP_ABANDONO']?>"><?=$ab['NM_TP_ABANDONO']?></option>		
                           <? } ?>  
					</select>
		</td>
                    </tr>
                    <tr>
                      <td colspan="3"></td>
                    </tr>
					</tr>
                    <tr>
					<tr><td colspan="3"><hr class="hr2" /></td></tr>
                      <td colspan="3">Outros Sistemas Marque as Caixas de Seleção para os Existentes</td>
                    </tr>
                    <tr>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_ch_sprinkler" class="campo" value="S">Sprinkler(SPK)
                        </label>
                      </td>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_ch_mulsyfire" class="campo" value="S">Mulsyfire(MULSY)
                        </label>
                      </td>
                    </tr> 
					 <tr>
					 <td>
                        <label>
                          <input type="checkbox" name="chk_ch_co2" class="campo" value="S">Sistema Fixo de CO<sub>2</sub>(SCO<sub>2</sub>)
                        </label>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_ch_ancora_cabo" class="campo" value="S">Ancoragem de Cabo(DAC)
                        </label>
                      </td>
                      <td>
                        <label>
                          <input type="checkbox" name="chk_outros" class="campo" onChange="controle_multiplo(this.form,this,'txt_nm_outros')">Outros
                        </label>
                        <input type="text" name="txt_nm_outros" value="" class="campo" title="Outros Dispositivos">
                      </td>
                    </tr>
                  </table>
                  </fieldset>
				</fieldset>
                <?include('/var/www/sistemacbm/templates/btn_inc.htm'); ?>
				</td>
              </tr>
			</tr>

 	 <? // termina aqui sistemas preventivos ?>

          </form>
          <script language="javascript" type="text/javascript">
<?
if ((@$_GET["hdn_id_cidade"]!="") && (@$_GET["hdn_id_edificacao"]!="") && (@$_GET["form_padrao"]!="")) {
  $query_carga="SELECT ".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_EDIFICACAO.".ID_EDIFICACAO, ".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO AS NR_CNPJ_CPF_PROPRIETARIO, ".TBL_EDIFICACAO.".ID_CIDADE_PESSOA, ".TBL_EDIFICACAO.".NM_EDIFICACAO AS NM_EDIFICACOES, ".TBL_EDIFICACAO.".NM_EDIFICACAO_FONETICA, ".TBL_EDIFICACAO.".NM_FANTASIA_1 AS NM_FANTASIA, ".TBL_EDIFICACAO.".NM_FANTASIA_FONETICA_1, ".TBL_EDIFICACAO.".NM_FANTASIA_2, ".TBL_EDIFICACAO.".NM_FANTASIA_FONETICA_2, ".TBL_EDIFICACAO.".NR_EDIFICACAO AS NR_EDIFICACOES, ".TBL_EDIFICACAO.".NM_COMPLEMENTO, ".TBL_EDIFICACAO.".VL_AREA_CONSTRUIDA, ".TBL_EDIFICACAO.".VL_ALTURA, ".TBL_EDIFICACAO.".VL_AREA_TIPO, ".TBL_EDIFICACAO.".NR_PAVIMENTOS, ".TBL_EDIFICACAO.".NR_BLOCOS, ".TBL_EDIFICACAO.".ID_RISCO, ".TBL_EDIFICACAO.".ID_SITUACAO, ".TBL_EDIFICACAO.".ID_TP_CONSTRUCAO, ".TBL_EDIFICACAO.".ID_OCUPACAO, ".TBL_EDIFICACAO.".ID_CEP, UPPER(".TBL_EDIFICACAO.".ID_CEP) AS NR_CEP, ".TBL_EDIFICACAO.".ID_LOGRADOURO, ".TBL_EDIFICACAO.".ID_CIDADE_CEP, ".TBL_CIDADE.".NM_CIDADE, ".TBL_PESSOA.".NM_PESSOA AS NM_PROPRIETARIO, ".TBL_PESSOA.".NR_FONE AS NR_FONE_PROPRIETARIO, ".TBL_PESSOA.".DE_EMAIL_PESSOA AS DE_EMAIL_PROPRIETARIO, ".TBL_BAIRROS.".NM_BAIRROS AS NM_BAIRRO, ".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO, ".TBL_LOGRADOURO.".NM_LOGRADOURO FROM ".TBL_EDIFICACAO." LEFT JOIN ".TBL_CIDADE." ON(".TBL_EDIFICACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON(".TBL_EDIFICACAO.".ID_CEP=".TBL_CEP.".ID_CEP AND ".TBL_EDIFICACAO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_EDIFICACAO.".ID_CIDADE_CEP=".TBL_CEP.".ID_CIDADE) LEFT JOIN ".TBL_LOGRADOURO." ON(".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE) LEFT JOIN ".TBL_BAIRROS." ON(".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON(".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) LEFT JOIN ".TBL_PESSOA." ON (".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO=".TBL_PESSOA.".ID_CNPJ_CPF AND ".TBL_EDIFICACAO.".ID_CIDADE_PESSOA=".TBL_PESSOA.".ID_CIDADE) WHERE ".TBL_EDIFICACAO.".ID_EDIFICACAO=".$_GET["hdn_id_edificacao"]." AND ".TBL_EDIFICACAO.".ID_CIDADE=".$_GET["hdn_id_cidade"];
} else {
  if ((@$_GET["hdn_id_solicitacao"]!="") && (@$_GET["hdn_id_tipo_solicitacao"]!="") && (@$_GET["hdn_id_cidade"]!="") && (@$_GET["form_padrao"]!="")) {
    if (@$_GET["form_padrao"]=="frm_vist_manutencao") {
      $query_carga="SELECT ".TBL_SOL_MANUT.".ID_CIDADE, ".TBL_SOL_MANUT.".ID_SOLIC_MANUTENCAO AS ID_SOLIC, ".TBL_SOL_MANUT.".ID_TP_MANUTENCAO AS ID_TP_SOLIC, ".TBL_SOL_MANUT.".CH_PAGO,  ".TBL_SOL_MANUT.".NR_CNPJ_CPF_PROPRIETARIO, ".TBL_SOL_MANUT.".NM_PROPRIETARIO, ".TBL_SOL_MANUT.".NR_FONE_PROPRIETARIO, ".TBL_SOL_MANUT.".DE_EMAIL_PROPRIETARIO, ".TBL_SOL_MANUT.".NM_EDIFICACOES, ".TBL_SOL_MANUT.".NM_FANTASIA, '' AS NM_FANTASIA_2, ".TBL_SOL_MANUT.".ID_TP_LOGRADOURO, ".TBL_SOL_MANUT.".NM_LOGRADOURO, ".TBL_SOL_MANUT.".NR_EDIFICACOES, ".TBL_SOL_MANUT.".ID_CEP, ".TBL_SOL_MANUT.".ID_LOGRADOURO, ".TBL_SOL_MANUT.".ID_CIDADE_CEP, ".TBL_SOL_MANUT.".NR_CEP, ".TBL_SOL_MANUT.".NM_BAIRRO, ".TBL_SOL_MANUT.".NM_COMPLEMENTO, ".TBL_SOL_MANUT.".VL_AREA_CONSTRUIDA, ".TBL_SOL_MANUT.".CH_PROTOCOLADO, ".TBL_SOL_MANUT.".DT_SOLICITACAO, ".TBL_SOL_MANUT.".CH_AGUARDO_LOGRADOURO, ".TBL_SOL_MANUT.".DT_AGUARDO_LOGRADOURO, ".TBL_SOL_MANUT.".ID_USUARIO, ".TBL_SOL_MANUT.".ID_RISCO, ".TBL_SOL_MANUT.".ID_TP_CONSTRUCAO, ".TBL_SOL_MANUT.".ID_OCUPACAO, ".TBL_SOL_MANUT.".ID_SITUACAO, ".TBL_SOL_MANUT.".NR_PAVIMENTOS, ".TBL_SOL_MANUT.".NR_BLOCOS, ".TBL_CIDADE.".NM_CIDADE, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO, '0.00' AS VL_ALTURA, '0.00' AS VL_AREA_TIPO, '' AS ID_EDIFICACAO FROM ".TBL_SOL_MANUT." LEFT JOIN ".TBL_CIDADE." ON(".TBL_SOL_MANUT.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_SOL_MANUT.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_SOL_MANUT.".ID_CIDADE=".$_GET["hdn_id_cidade"]." AND ".TBL_SOL_MANUT.".ID_SOLIC_MANUTENCAO=".$_GET["hdn_id_solicitacao"]." AND ".TBL_SOL_MANUT.".ID_TP_MANUTENCAO='".$_GET["hdn_id_tipo_solicitacao"]."'";
    } elseif (@$_GET["form_padrao"]=="frm_vist_an_func") {
      $query_carga="SELECT ".TBL_SOLICITACAO.".ID_CIDADE, ".TBL_SOLICITACAO.".ID_SOLICITACAO AS ID_SOLIC, ".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO AS ID_TP_SOLIC, ".TBL_SOLICITACAO.".CH_PAGO,  ".TBL_SOLICITACAO.".CNPJ_CPF_PROPRIETARIO AS NR_CNPJ_CPF_PROPRIETARIO, ".TBL_SOLICITACAO.".NM_PROPRIETARIO AS NM_PROPRIETARIO, ".TBL_SOLICITACAO.".NR_FONE_PROPRIETARIO AS NR_FONE_PROPRIETARIO, ".TBL_SOLICITACAO.".DE_EMAIL_PROPRIETARIO AS DE_EMAIL_PROPRIETARIO, ".TBL_SOLICITACAO.".NM_EDIFICACOES_LX AS NM_EDIFICACOES, ".TBL_SOLICITACAO.".NM_FANTASIA, '' AS NM_FANTASIA_2, ".TBL_SOLICITACAO.".ID_TP_LOGRADOURO, ".TBL_SOLICITACAO.".NM_LOGRADOURO, ".TBL_SOLICITACAO.".NR_EDIFICACOES_LX AS NR_EDIFICACOES, ".TBL_SOLICITACAO.".ID_CEP, ".TBL_SOLICITACAO.".ID_LOGRADOURO, ".TBL_SOLICITACAO.".ID_CIDADE_CEP, ".TBL_SOLICITACAO.".NR_CEP, ".TBL_SOLICITACAO.".NM_BAIRRO, ".TBL_SOLICITACAO.".NM_COMPLEMENTO, ".TBL_SOLICITACAO.".VL_AREA_CONTRUIDA AS VL_AREA_CONSTRUIDA, ".TBL_SOLICITACAO.".CH_PROTOCOLADO, ".TBL_SOLICITACAO.".DT_SOLICITACAO, ".TBL_SOLICITACAO.".CH_AGUARDO_LOGRADOURO, ".TBL_SOLICITACAO.".DT_AGUARDO_LOGRADOURO, ".TBL_SOLICITACAO.".ID_USUARIO, ".TBL_SOLICITACAO.".ID_RISCO, ".TBL_SOLICITACAO.".ID_TP_CONSTRUCAO, ".TBL_SOLICITACAO.".ID_OCUPACAO, ".TBL_SOLICITACAO.".ID_SITUACAO, ".TBL_SOLICITACAO.".NR_PAVIMENTOS, ".TBL_SOLICITACAO.".NR_BLOCOS, ".TBL_CIDADE.".NM_CIDADE, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO, ".TBL_SOLICITACAO.".VL_ALTURA AS VL_ALTURA, ".TBL_SOLICITACAO.".VL_AREA_TIPO AS VL_AREA_TIPO, '' AS ID_EDIFICACAO FROM ".TBL_SOLICITACAO." LEFT JOIN ".TBL_CIDADE." ON(".TBL_SOLICITACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_SOLICITACAO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_SOLICITACAO.".ID_CIDADE=".$_GET["hdn_id_cidade"]." AND ".TBL_SOLICITACAO.".ID_SOLICITACAO=".$_GET["hdn_id_solicitacao"]." AND ".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO='".$_GET["hdn_id_tipo_solicitacao"]."'";
    } else {
      $query_carga="SELECT ".TBL_SOL_FUNC.".ID_CIDADE, ".TBL_SOL_FUNC.".ID_SOLIC_FUNC  AS ID_SOLIC, ".TBL_SOL_FUNC.".ID_TP_FUNC AS ID_TP_SOLIC, ".TBL_SOL_FUNC.".CH_PAGO,  ".TBL_SOL_FUNC.".NR_CNPJ_CPF_PROPRIETARIO, ".TBL_SOL_FUNC.".NM_PROPRIETARIO, ".TBL_SOL_FUNC.".NR_FONE_PROPRIETARIO, ".TBL_SOL_FUNC.".DE_EMAIL_PROPRIETARIO, ".TBL_SOL_FUNC.".NM_EDIFICACOES, ".TBL_SOL_FUNC.".NM_FANTASIA, '' AS NM_FANTASIA_2, ".TBL_SOL_FUNC.".ID_TP_LOGRADOURO, ".TBL_SOL_FUNC.".NM_LOGRADOURO, ".TBL_SOL_FUNC.".NR_EDIFICACOES, ".TBL_SOL_FUNC.".ID_CEP, ".TBL_SOL_FUNC.".ID_LOGRADOURO, ".TBL_SOL_FUNC.".ID_CIDADE_CEP, ".TBL_SOL_FUNC.".NR_CEP, ".TBL_SOL_FUNC.".NM_BAIRRO, ".TBL_SOL_FUNC.".NM_COMPLEMENTO, ".TBL_SOL_FUNC.".VL_AREA_CONSTRUIDA, ".TBL_SOL_FUNC.".CH_PROTOCOLADO, ".TBL_SOL_FUNC.".DT_SOLICITACAO, ".TBL_SOL_FUNC.".CH_AGUARDO_LOGRADOURO, ".TBL_SOL_FUNC.".DT_AGUARDO_LOGRADOURO, ".TBL_SOL_FUNC.".ID_USUARIO, ".TBL_SOL_FUNC.".ID_RISCO, ".TBL_SOL_FUNC.".ID_TP_CONSTRUCAO, ".TBL_SOL_FUNC.".ID_OCUPACAO, ".TBL_SOL_FUNC.".ID_SITUACAO, ".TBL_SOL_FUNC.".NR_PAVIMENTOS, ".TBL_SOL_FUNC.".NR_BLOCOS, ".TBL_CIDADE.".NM_CIDADE, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO, '0.00' AS VL_ALTURA, '0.00' AS VL_AREA_TIPO, '' AS ID_EDIFICACAO FROM ".TBL_SOL_FUNC." LEFT JOIN ".TBL_CIDADE." ON(".TBL_SOL_FUNC.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_SOL_FUNC.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_SOL_FUNC.".ID_CIDADE=".$_GET["hdn_id_cidade"]." AND ".TBL_SOL_FUNC.".ID_SOLIC_FUNC=".$_GET["hdn_id_solicitacao"]." AND ".TBL_SOL_FUNC.".ID_TP_FUNC='".$_GET["hdn_id_tipo_solicitacao"]."'";
    }
  }
}
//echo "/*<!--\n$query_carga\n-->*/\n";
if (isset($query_carga)) {
  $res= $conn->query($query_carga);
  if ($conn->get_status()==false) {
    die("Consulta ".@$_GET["form_padrao"].":".$conn->get_msg());
  }
  $rows_carga=$conn->num_rows();
  if ($rows_carga>0) {
    $carga = $conn->fetch_row();
  }
  $ID_CIDADE=$carga["ID_CIDADE"];
  $NM_CIDADE=$carga["NM_CIDADE"];
  $ID_EDIFICACAO=$carga["ID_EDIFICACAO"];

  if ($ID_EDIFICACAO!="") $controle=2; else $controle=1;

  $NR_CNPJ_CPF_PROPRIETARIO=$carga["NR_CNPJ_CPF_PROPRIETARIO"];
  $NM_PROPRIETARIO=$carga["NM_PROPRIETARIO"];
  $NR_FONE_PROPRIETARIO=$carga["NR_FONE_PROPRIETARIO"];
  $DE_EMAIL_PROPRIETARIO=$carga["DE_EMAIL_PROPRIETARIO"];
  $NM_EDIFICACOES=$carga["NM_EDIFICACOES"];
  $NM_FANTASIA_1=$carga["NM_FANTASIA"];
  $NM_FANTASIA_2=@$carga["NM_FANTASIA_2"];
  $ID_TP_LOGRADOURO=$carga["ID_TP_LOGRADOURO"];
  $NM_TP_LOGRADOURO=$carga["NM_TP_LOGRADOURO"];
  $ID_LOGRADOURO=$carga["ID_LOGRADOURO"];
  $NM_LOGRADOURO=$carga["NM_LOGRADOURO"];
  $ID_CEP=$carga["ID_CEP"];
  $NR_CEP=$carga["NR_CEP"];
  $NR_EDIFICACAO=$carga["NR_EDIFICACOES"];
  $ID_BAIRROS=@$carga["ID_BAIRROS"];
  $NM_BAIRRO=$carga["NM_BAIRRO"];
  $NM_COMPLEMENTO=$carga["NM_COMPLEMENTO"];
  $VL_AREA_CONSTRUIDA=str_replace(".",",",$carga["VL_AREA_CONSTRUIDA"]);
  $VL_ALTURA=str_replace(".",",",$carga["VL_ALTURA"]);
  $VL_AREA_TIPO=str_replace(".",",",$carga["VL_AREA_TIPO"]);
  $ID_RISCO=$carga["ID_RISCO"];
  $ID_OCUPACAO=$carga["ID_OCUPACAO"];
  $ID_SITUACAO=$carga["ID_SITUACAO"];
  $ID_TP_CONSTRUCAO=$carga["ID_TP_CONSTRUCAO"];
  $NR_BLOCOS=$carga["NR_BLOCOS"];
  $NR_PAVIMENTOS=$carga["NR_PAVIMENTOS"];
?>
            var frm_at=document.frm_edificacao;
            frm_at.hdn_id_cidade.value="<?=$ID_CIDADE?>";
            frm_at.txt_id_edificacao.value="<?=$ID_EDIFICACAO?>";
            frm_at.txt_nm_cidade.value="<?=$NM_CIDADE?>";
            frm_at.txt_nr_cnpjcpf_proprietario.value="<?=$NR_CNPJ_CPF_PROPRIETARIO?>";
            frm_at.txt_nm_proprietario.value="<?=$NM_PROPRIETARIO?>";
            frm_at.txt_nr_fone_proprietario.value="<?=$NR_FONE_PROPRIETARIO?>";
            frm_at.txt_de_email_proprietario.value="<?=$DE_EMAIL_PROPRIETARIO?>";
            frm_at.txt_nm_edificacao.value="<?=$NM_EDIFICACOES?>";
            frm_at.txt_nm_fantasia_1.value="<?=$NM_FANTASIA_1?>";
            frm_at.txt_nm_fantasia_2.value="<?=$NM_FANTASIA_2?>";
            frm_at.hdn_id_tp_logradouro.value="<?=$ID_TP_LOGRADOURO?>";
            frm_at.txt_nm_tp_logradouro.value="<?=$NM_TP_LOGRADOURO?>";
            frm_at.hdn_id_logradouro.value="<?=$ID_LOGRADOURO?>";
            frm_at.txt_nm_logradouro.value="<?=$NM_LOGRADOURO?>";
            frm_at.txt_nr_cep.value="<?=$NR_CEP?>";
            frm_at.hdn_id_cep.value="<?=$ID_CEP?>";
            frm_at.txt_nr_edificacao.value="<?=$NR_EDIFICACAO?>";
            frm_at.txt_nm_bairro.value="<?=$NM_BAIRRO?>";
            frm_at.txt_nm_complemento.value="<?=$NM_COMPLEMENTO?>";
            frm_at.txt_vl_area_construida.value="<?=$VL_AREA_CONSTRUIDA?>";
            frm_at.txt_vl_altura.value="<?=$VL_ALTURA?>";
            frm_at.txt_vl_area_pavimento.value="<?=$VL_AREA_TIPO?>";
            frm_at.cmb_id_risco.value="<?=$ID_RISCO?>";
            frm_at.cmb_id_ocupacao.value="<?=$ID_OCUPACAO?>";
            frm_at.cmb_id_situacao.value="<?=$ID_SITUACAO?>";
            frm_at.cmb_id_tp_construcao.value="<?=$ID_TP_CONSTRUCAO?>";
            frm_at.cmb_nr_blocos.value="<?=$NR_BLOCOS?>";
            frm_at.cmb_nr_pavimentos.value="<?=$NR_PAVIMENTOS?>";
            CEP(frm_at.txt_nr_cep);
            FormatNumero(frm_at.txt_vl_area_construida);
            decimal(frm_at.txt_vl_area_construida,2);
            FormatNumero(frm_at.txt_vl_altura);
            decimal(frm_at.txt_vl_altura,2);
            FormatNumero(frm_at.txt_vl_area_pavimento);
            decimal(frm_at.txt_vl_area_pavimento,2);
            FormatNumero(frm_at.txt_nr_edificacao);
            decimal(frm_at.txt_nr_edificacao,0)
            cpfcnpj(frm_at.txt_nr_cnpjcpf_proprietario);
            frm_at.txt_id_edificacao.readOnly=true;

<? if ($controle==2) { ?>

            frm_at.btn_incluir.disabled=false;
            frm_at.btn_incluir.value="Alterar";
            frm_at.hdn_controle.value="2";
            frm_at.btn_incluir.style.backgroundImage="url('/var/www/sistemacbm/imagens/botao.gif')";
<?
  }
  if (($global_inclusao!="S") && ($controle==1)) {
?>
            frm_at.btn_incluir.disabled=false;
            frm_at.btn_incluir.value="Alterar";
            frm_at.hdn_controle.value="2";
            frm_at.btn_incluir.style.backgroundImage="url('/var/www/sistemacbm/imagens/botao.gif')";
            frm_at.btn_incluir.disabled=true;
            alert("SEM PERMISSÃO PARA INCLUSÃO!!");
<?
  }
  if (($global_alteracao!="S") && ($controle==2)) {
?>
            frm_at.hdn_controle.value="2";
            frm_at.btn_incluir.style.backgroundImage="url('/var/www/sistemacbm/imagens/botao2.gif')";
            frm_at.btn_incluir.disabled=true;
            alert("SEM PERMISSÃO PARA ALTERAÇÃO");
<?
  }
}
?>
          </script>

<?// include ('../../templates/footer.htm'); ?>

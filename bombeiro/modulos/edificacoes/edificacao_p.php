<?
// include ('../../templates/head_cons.htm');
?>
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd"; ID_BAIRRO

// Conectando ao BD BD ($host, $user, $pass, $db)
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
  $sql="SELECT ID_BATALHAO,ID_COMPANIA,ID_PELOTAO,ID_GRUPAMENTO FROM ".TBL_USUARIO." WHERE ID_USUARIO='".$usuario."'";
  $conn->query($sql);
  $lotacao = $conn->fetch_row();
  if ((@$_POST["txt_nr_cnpjcpf_proprietario"]!="") && (@$_POST["txt_nm_proprietario"]!="") && (@$_POST["txt_nr_fone_proprietario"]!="") && (@$_POST["txt_de_email_proprietario"]!="") && (@$_POST["txt_nm_edificacao"]!="")  && (@$_POST["cmb_id_tp_prefixo"]!="") && (@$_POST["txt_nm_logradouro"]!="") &&  (@$_POST["hdn_id_cidade"]!="") && (@$_POST["txt_nm_bairro"]!="") && (@$_POST["txt_id_cep"]!="") && (@$_POST["txt_vl_area_contruida"]!="") && (@$_POST["txt_vl_altura"]!="") && (@$_POST["txt_vl_area_pavimento"]!="") && (@$_POST["cmb_id_risco"]!="") && (@$_POST["cmb_id_ocupacao"]!="") && (@$_POST["cmb_id_situacao"]!="") && (@$_POST["cmb_id_tp_construcao"]!="") && (@$_POST["cmb_nr_pavimentos"]!="") && (@$_POST["cmb_nr_blocos"]!="") && (@$_POST["hdn_sis_incendio"]!="") && (@$_POST["hdn_id_crea_1"]!="") && (@$_POST["txt_nm_engenheiro_1"]!="") ) {
  
    $USUARIO_CAD=formataCampo($usuario);
    
    // PESSOA
    $ID_CNPJ_CPF= formataCampo($_POST["txt_nr_cnpjcpf_proprietario"],"vn");
    $ID_TP_PESSOA="'P'";
    $NM_PESSOA= formataCampo($_POST["txt_nm_proprietario"]);
    $NM_PESSOA_FONETICA=formataCampo(nr_txt_fonetica($_POST["txt_nm_proprietario"]));
    $NR_FONE=formataCampo($_POST["txt_nr_fone_proprietario"],"n");
    $DE_EMAIL_PESSOA=formataCampo($_POST["txt_de_email_proprietario"],"t","l");
    // FIM
    $ID_SOLICITACAO=$_POST["hdn_id_solicitacao"];
    $ID_TIPO_SOLICITACAO=formataCampo($_POST["hdn_id_tipo_solicitacao"]);
  
    // LOGRADOURO
    $ID_TP_LOGRADOURO=formataCampo($_POST["cmb_id_tp_prefixo"],'n');
    $NM_LOGRADOURO=formataCampo($_POST["txt_nm_logradouro"]);
    $NM_LOGRADOURO_FONETICA=formataCampo(nr_txt_fonetica($_POST["txt_nm_logradouro"]));
    $NR_EDIFICACAO=formataCampo($_POST["txt_nr_numero"],'n');
    $ID_CEP=formataCampo($_POST["txt_id_cep"],'n');
    $NM_COMPLEMENTO=formataCampo($_POST["txt_nm_complemento"]);
    $ID_BAIRROS=formataCampo($_POST["hdn_id_bairro"],'N');
    $ID_LOGRADOURO=formataCampo($_POST["hdn_id_logradouro"],'N');
    $NM_BAIRRO=formataCampo($_POST["txt_nm_bairro"]);
    $NM_BAIRRO_FONETICA=formataCampo(nr_txt_fonetica($_POST["txt_nm_bairro"]));
    // FIM
  
    $ID_CIDADE=formataCampo($_POST["hdn_id_cidade"],'n');
    if ($_POST["hdn_id_edificacao"]=="") { $ID_EDIFICACAO=0; }
    else { $ID_EDIFICACAO=$_POST["hdn_id_edificacao"]; }
    
    $NM_EDIFICACAO=formataCampo($_POST["txt_nm_edificacao"]);
    $NM_EDIFICACAO_FONETICA=formataCampo(nr_txt_fonetica($_POST["txt_nm_edificacao"]));
    $NM_FANTASIA_1=formataCampo($_POST["txt_nm_fantasia_1"]);
    $NM_FANTASIA_FONETICA_1=formataCampo(nr_txt_fonetica($_POST["txt_nm_fantasia_1"]));
    $NM_FANTASIA_2=formataCampo($_POST["txt_nm_fantasia_2"]);
    $NM_FANTASIA_FONETICA_2=formataCampo(nr_txt_fonetica($_POST["txt_nm_fantasia_2"]));
    $VL_AREA_CONSTRUIDA=formataCampo($_POST["txt_vl_area_contruida"],'D','D');
    $VL_ALTURA=formataCampo($_POST["txt_vl_altura"],'D');
    $VL_AREA_TIPO=formataCampo($_POST["txt_vl_area_pavimento"],'D');
    $ID_RISCO=formataCampo($_POST["cmb_id_risco"],'N');
    $ID_OCUPACAO=formataCampo($_POST["cmb_id_ocupacao"],'N');
    $ID_SITUACAO=formataCampo($_POST["cmb_id_situacao"],'N');
    $ID_TP_CONSTRUCAO=formataCampo($_POST["cmb_id_tp_construcao"],'N');
    $NR_PAVIMENTOS=formataCampo($_POST["cmb_nr_pavimentos"],'N');
    $NR_BLOCOS=formataCampo($_POST["cmb_nr_blocos"],'N');
    $DE_PLANO_ACAO=$_POST["txa_de_plano"];

    $ID_CREA=formataCampo($_POST["hdn_id_crea_1"],"NT","7");
    $NM_ENGENHEIRO_1=formataCampo($_POST["txt_nm_engenheiro_1"]);
    $NM_ENGENHEIRO_FON_1=formataCampo(nr_txt_fonetica($_POST["txt_nm_engenheiro_1"]));
    $ID_CREA_2=formataCampo(str_replace("-","",$_POST["hdn_id_crea_2"]),"NT","7");
    $NM_ENGENHEIRO_2=formataCampo($_POST["txt_nm_engenheiro_2"]);
    $NM_ENGENHEIRO_FON_2=formataCampo(nr_txt_fonetica($_POST["txt_nm_engenheiro_2"]));
    $ID_CREA_3=formataCampo(str_replace("-","",$_POST["hdn_id_crea_3"]),"NT","7");
    $NM_ENGENHEIRO_3=formataCampo($_POST["txt_nm_engenheiro_3"]);
    $NM_ENGENHEIRO_FON_3=formataCampo(nr_txt_fonetica($_POST["txt_nm_engenheiro_3"]));
    
    $ERRO_TRANS="";
    $query_trans="BEGIN";
    $conn->query($query_trans);
    $query_trans="COMMIT";
    //$query_trans="ROLLBACK";
    $query_pessoa="SELECT ID_TP_PESSOA FROM ".TBL_PESSOA." WHERE ID_CIDADE=$ID_CIDADE AND ID_CNPJ_CPF=$ID_CNPJ_CPF";
    $conn->query($query_pessoa);
    $rows_pessoa=$conn->num_rows();
    if ($rows_pessoa>0) {
      $pessoa_fetch=$conn->fetch_row();
      if ($pessoa_fetch["ID_TP_PESSOA"]!="P") {
        $ID_TP_PESSOA="'A'";
      }
      $query_pessoa="UPDATE ".TBL_PESSOA." SET ID_TP_PESSOA=$ID_TP_PESSOA, NM_PESSOA=$NM_PESSOA, NM_PESSOA_FONETICA=$NM_PESSOA_FONETICA, NR_FONE=$NR_FONE, DE_EMAIL_PESSOA=$DE_EMAIL_PESSOA WHERE ID_CIDADE=$ID_CIDADE AND ID_CNPJ_CPF=$ID_CNPJ_CPF";
    } else {
      $query_pessoa="INSERT INTO ".TBL_PESSOA." (ID_CNPJ_CPF,ID_CIDADE,ID_TP_PESSOA,NM_PESSOA,NM_PESSOA_FONETICA,NR_FONE,DE_EMAIL_PESSOA) VALUES ($ID_CNPJ_CPF,$ID_CIDADE, $ID_TP_PESSOA, $NM_PESSOA,$NM_PESSOA_FONETICA,$NR_FONE,$DE_EMAIL_PESSOA)";
    }
    $conn->query($query_pessoa);
    if ($conn->get_status()==false) {
      $ERRO_TRANS.=$conn->get_msg()."\n";
      $query_trans="ROLLBACK";
    }
    if (($ID_BAIRROS=="") || ($ID_BAIRROS=="NULL")){
      $query_bairro="SELECT ID_CIDADE, ID_BAIRROS FROM ".TBL_BAIRROS." WHERE ID_CIDADE=$ID_CIDADE AND NM_BAIRROS=$NM_BAIRRO";
      $conn->query($query_bairro);
      if ($conn->num_rows()>0) {
        $fetch_bairros = $conn->fetch_row();
        $ID_BAIRROS=$fetch_bairros["ID_BAIRROS"];
      } else {
        $query_bairro="INSERT INTO ".TBL_BAIRROS." (ID_CIDADE,ID_BAIRROS,NM_BAIRROS,NM_FONETICA,DT_AGUARDO,CH_AGUARDO,ID_USUARIO) VALUES ($ID_CIDADE,0,$NM_BAIRRO,$NM_BAIRRO_FONETICA,CURDATE(),'S',$USUARIO_CAD)";
        $conn->query($query_bairro);
        if ($conn->get_status()==false) {
          $ERRO_TRANS.=$conn->get_msg()."\n";
          $query_trans="ROLLBACK";
        }
        $ID_BAIRROS=mysql_insert_id();
      }
    }
    if (($ID_LOGRADOURO=="")||($ID_LOGRADOURO=="NULL")) {
      $query_logradouro="SELECT ID_CIDADE, ID_LOGRADOURO, ID_BAIRROS FROM ".TBL_LOGRADOURO." WHERE ID_CIDADE=$ID_CIDADE AND NM_LOGRADOURO=$NM_LOGRADOURO AND ID_BAIRROS=$ID_BAIRROS";
      $conn->query($query_logradouro);
      if ($conn->num_rows()>0) {
        $fetch_logradouro = $conn->fetch_row();
        $ID_LOGRADOURO=$fetch_logradouro["ID_LOGRADOURO"];
      } else {
        $query_logradouro="INSERT INTO ".TBL_LOGRADOURO."  (ID_CIDADE, ID_LOGRADOURO, NM_LOGRADOURO,NM_FONETICA,ID_BAIRROS, ID_CIDADE_BAIRROS, ID_TP_LOGRADOURO, DT_AGUARDO, CH_AGUARDO, ID_USUARIO) VALUES ($ID_CIDADE,0, $NM_LOGRADOURO,$NM_LOGRADOURO_FONETICA, $ID_BAIRROS, $ID_CIDADE, $ID_TP_LOGRADOURO,CURDATE(),'S',$USUARIO_CAD)";
        $conn->query($query_logradouro);
        if ($conn->get_status()==false) {
          $ERRO_TRANS.=$conn->get_msg()."\n";
          $query_trans="ROLLBACK";
        }
        $ID_LOGRADOURO=mysql_insert_id();
      }
      
      $query_cep="SELECT ID_CEP FROM ".TBL_CEP." WHERE ID_CIDADE=$ID_CIDADE AND ID_CEP=$ID_CEP AND ID_LOGRADOURO=$ID_LOGRADOURO";
       $conn->query($query_cep);
      if ($conn->num_rows()<1) {
        $query_cep="INSERT INTO ".TBL_CEP." (ID_CEP,ID_LOGRADOURO,ID_CIDADE,DT_AGUARDO,CH_AGUARDO,ID_USUARIO) VALUES ($ID_CEP,$ID_LOGRADOURO,$ID_CIDADE,CURDATE(),'S',$USUARIO_CAD)";
        $conn->query($query_cep);
        if ($conn->get_status()==false) {
          $ERRO_TRANS.=$conn->get_msg()."\n";
          $query_trans="ROLLBACK";
        }
      }
    }
    
    if ($_POST["hdn_controle"]==1) {
      $ID_EDIFICACAO=0;
      $query_edificacao="SELECT ID_EDIFICACAO FROM ".TBL_EDIFICACAO." WHERE  ID_CIDADE=$ID_CIDADE AND NM_EDIFICACAO=$NM_EDIFICACAO AND NR_EDIFICACAO=$NR_EDIFICACAO AND ID_CEP=$ID_CEP AND ID_LOGRADOURO=$ID_LOGRADOURO";
      $conn->query($query_edificacao);
      if ($conn->get_status()==false) {
          $ERRO_TRANS.=$conn->get_msg()."\n";
          $query_trans="ROLLBACK";
      } else {
        if ($conn->num_rows()>0) {
          $fetch_edificacao=$conn->fetch_row();
          $ID_EDIFICACAO=$fetch_edificacao["ID_EDIFICACAO"];
        }
      }
    }
    if ($ID_EDIFICACAO==0) {
      $query_edificacao="INSERT INTO ".TBL_EDIFICACAO." (ID_CIDADE, ID_EDIFICACAO, ID_CNPJ_CPF_PROPRIETARIO, ID_CIDADE_PESSOA, NM_EDIFICACAO, NM_EDIFICACAO_FONETICA, NM_FANTASIA_1, NM_FANTASIA_FONETICA_1, NM_FANTASIA_2, NM_FANTASIA_FONETICA_2, NR_EDIFICACAO, NM_COMPLEMENTO, VL_AREA_CONSTRUIDA, VL_ALTURA, VL_AREA_TIPO, NR_PAVIMENTOS, NR_BLOCOS, ID_RISCO, ID_SITUACAO, ID_TP_CONSTRUCAO, ID_OCUPACAO, ID_CEP, ID_LOGRADOURO, ID_CIDADE_CEP) VALUES ($ID_CIDADE,0, $ID_CNPJ_CPF, $ID_CIDADE, $NM_EDIFICACAO, $NM_EDIFICACAO_FONETICA, $NM_FANTASIA_1, $NM_FANTASIA_FONETICA_1, $NM_FANTASIA_2, $NM_FANTASIA_FONETICA_2, $NR_EDIFICACAO, $NM_COMPLEMENTO, $VL_AREA_CONSTRUIDA, $VL_ALTURA, $VL_AREA_TIPO, $NR_PAVIMENTOS, $NR_BLOCOS, $ID_RISCO, $ID_SITUACAO, $ID_TP_CONSTRUCAO, $ID_OCUPACAO, $ID_CEP, $ID_LOGRADOURO, $ID_CIDADE)";
    } else {
      $query_edificacao="UPDATE ".TBL_EDIFICACAO." SET ID_CNPJ_CPF_PROPRIETARIO=$ID_CNPJ_CPF, ID_CIDADE_PESSOA=$ID_CIDADE, NM_EDIFICACAO=$NM_EDIFICACAO, NM_EDIFICACAO_FONETICA=$NM_EDIFICACAO_FONETICA, NM_FANTASIA_1=$NM_FANTASIA_1, NM_FANTASIA_FONETICA_1=$NM_FANTASIA_FONETICA_1, NM_FANTASIA_2=$NM_FANTASIA_2, NM_FANTASIA_FONETICA_2=$NM_FANTASIA_FONETICA_2, NR_EDIFICACAO=$NR_EDIFICACAO, NM_COMPLEMENTO=$NM_COMPLEMENTO, VL_AREA_CONSTRUIDA=$VL_AREA_CONSTRUIDA, VL_ALTURA=$VL_ALTURA, VL_AREA_TIPO=$VL_AREA_TIPO, NR_PAVIMENTOS=$NR_PAVIMENTOS, NR_BLOCOS=$NR_BLOCOS, ID_RISCO=$ID_RISCO, ID_SITUACAO=$ID_SITUACAO, ID_TP_CONSTRUCAO=$ID_TP_CONSTRUCAO, ID_OCUPACAO=$ID_OCUPACAO, ID_CEP=$ID_CEP, ID_LOGRADOURO=$ID_LOGRADOURO, ID_CIDADE_CEP=$ID_CIDADE WHERE ID_CIDADE=$ID_CIDADE AND ID_EDIFICACAO=$ID_EDIFICACAO";
    }
    $conn->query($query_edificacao);
    if ($conn->get_status()==false) {
      $ERRO_TRANS.=$conn->get_msg()."\n";
      $query_trans="ROLLBACK";
    }
    if ($ID_EDIFICACAO==0) { $ID_EDIFICACAO=mysql_insert_id(); }
    
    $query_eng="SELECT ID_EDIFICACAO FROM ".TBL_ENG_EDIFICACAO." WHERE ID_EDIFICACAO=$ID_EDIFICACAO AND ID_CIDADE=$ID_CIDADE AND  ID_TP_ENG='P'";
    $conn->query($query_eng);
    if ($conn->num_rows()>0) {
      $query_eng="DELETE FROM ".TBL_ENG_EDIFICACAO." WHERE ID_EDIFICACAO=$ID_EDIFICACAO AND ID_CIDADE=$ID_CIDADE AND  ID_TP_ENG='P'";
      $conn->query($query_eng);
    }
    $query_eng="SELECT ID_CREA FROM ".TBL_ENGENHEIRO." WHERE ID_CREA=$ID_CREA";
    echo "<!--aqui 0:$query_eng-->";
    $conn->query($query_eng);
    if ($conn->num_rows()<1) {
      $query_eng="INSERT INTO ".TBL_ENGENHEIRO." (ID_CREA, NM_ENGENHEIRO, NM_ENGENHEIRO_FONETICA) VALUES ($ID_CREA, $NM_ENGENHEIRO_1,$NM_ENGENHEIRO_FON_1)";
      echo "<!--aqui 1:$query_eng-->";
      $conn->query($query_eng);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
    }
    $query_eng="INSERT INTO ".TBL_ENG_EDIFICACAO." (ID_CREA, ID_EDIFICACAO, ID_CIDADE, ID_TP_ENG) VALUES ($ID_CREA, $ID_EDIFICACAO,$ID_CIDADE,'P')";
    $conn->query($query_eng);
    if ($conn->get_status()==false) {
      $ERRO_TRANS.=$conn->get_msg()."\n";
      $query_trans="ROLLBACK";
    }
    if (($ID_CREA_2!="NULL") && ($NM_ENGENHEIRO_2!="NULL")) {
      $query_eng="SELECT ID_CREA FROM ".TBL_ENGENHEIRO." WHERE ID_CREA=$ID_CREA_2";
      $conn->query($query_eng);
      if ($conn->num_rows()<1) {
        $query_eng="INSERT INTO ".TBL_ENGENHEIRO." (ID_CREA, NM_ENGENHEIRO, NM_ENGENHEIRO_FONETICA) VALUES ($ID_CREA_2, $NM_ENGENHEIRO_2,$NM_ENGENHEIRO_FON_2)";
        $conn->query($query_eng);
        if ($conn->get_status()==false) {
          $ERRO_TRANS.=$conn->get_msg()."\n";
          $query_trans="ROLLBACK";
        }
      }
      $query_eng="INSERT INTO ".TBL_ENG_EDIFICACAO." (ID_CREA, ID_EDIFICACAO, ID_CIDADE, ID_TP_ENG) VALUES ($ID_CREA_2, $ID_EDIFICACAO,$ID_CIDADE,'P')";
      $conn->query($query_eng);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
    }
    if (($ID_CREA_3!="NULL") && ($NM_ENGENHEIRO_3!="NULL")) {
      $query_eng="SELECT ID_CREA FROM ".TBL_ENGENHEIRO." WHERE ID_CREA=$ID_CREA_3";
      $conn->query($query_eng);
      if ($conn->num_rows()<1) {
        $query_eng="INSERT INTO ".TBL_ENGENHEIRO." (ID_CREA, NM_ENGENHEIRO, NM_ENGENHEIRO_FONETICA) VALUES ($ID_CREA_3, $NM_ENGENHEIRO_3,$NM_ENGENHEIRO_FON_3)";
        $conn->query($query_eng);
        if ($conn->get_status()==false) {
          $ERRO_TRANS.=$conn->get_msg()."\n";
          $query_trans="ROLLBACK";
        }
      }
      $query_eng="INSERT INTO ".TBL_ENG_EDIFICACAO." (ID_CREA, ID_EDIFICACAO, ID_CIDADE, ID_TP_ENG) VALUES ($ID_CREA_2, $ID_EDIFICACAO,$ID_CIDADE,'P')";
      $conn->query($query_eng);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
    }
    //$query_trans="COMMIT";
    //$query_trans="ROLLBACK";
    $conn->query($query_trans);
    if (($conn->get_status()==false)|| ($ERRO_TRANS!="")) {
      $ERRO_TRANS.=$conn->get_msg()."\n";
      die($ERRO_TRANS);
    } else {
      $sql_tp_logradouro="SELECT NM_TP_LOGRADOURO FROM ".TBL_TP_LOGRADOURO." WHERE ".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO=$ID_TP_LOGRADOURO";
      $conn->query($sql_tp_logradouro);
      $fet_tp_logradouro=$conn->fetch_row();
      $NM_TP_LOGRADOURO=$fet_tp_logradouro["NM_TP_LOGRADOURO"];
      $sql_cidade="SELECT NM_CIDADE FROM ".TBL_CIDADE." WHERE ".TBL_CIDADE.".ID_CIDADE=$ID_CIDADE";
      $conn->query($sql_cidade);
      $fet_cidade=$conn->fetch_row();
      $NM_CIDADE=$fet_cidade["NM_CIDADE"];
      if ($_POST["hdn_sis_incendio"]=="S") {
  ?>
  
<script language="javascript" type="text/javascript">//<!--
var novos=0;
<?
        $query_carac="SELECT ID_CARC_EDIFICACAO FROM ".TBL_CARAC_ED." WHERE ID_EDIFICACAO=$ID_EDIFICACAO AND ID_CIDADE=$ID_CIDADE AND CH_ATIVO='S' ORDER BY CH_ATIVO DESC, DT_CARC_EDIFICACAO DESC, ID_CARC_EDIFICACAO DESC LIMIT 1";
        $conn->query($query_carac);
        if ($conn->get_status()==false) {
          die($conn->get_msg());
        }
        if ($conn->num_rows()>0) {
          $carac=$conn->fetch_row();
        
?>
  if (window.confirm("Deseja Carregar Novos Dados?")) {
    novos=0;
  } else {
    novos=<?=$carac["ID_CARC_EDIFICACAO"]?>;
  }
<?
        } else {
          echo "  novos=0;";
        }
?>

  window.opener.document.frm_analise.txt_id_edificacao.value="<?=$ID_EDIFICACAO?>";
  window.opener.document.frm_analise.hdn_de_plano_acao.value="<?=$DE_PLANO_ACAO?>";
  window.opener.document.frm_analise.txt_nm_edificacao.value="<?=str_replace("'","",$NM_EDIFICACAO)?>";
  window.opener.document.frm_analise.hdn_id_tp_prefixo.value="<?=$ID_TP_LOGRADOURO?>";
  window.opener.document.frm_analise.txt_nm_tp_prefixo.value="<?=$NM_TP_LOGRADOURO?>";
  window.opener.document.frm_analise.txt_nm_logradouro.value="<?=str_replace("'","",$NM_LOGRADOURO)?>";
  window.opener.document.frm_analise.txt_nr_edificacao.value="<?=$NR_EDIFICACAO?>";
  window.opener.document.frm_analise.txt_nm_bairro.value="<?=str_replace("'","",$NM_BAIRRO)?>";
  window.opener.document.frm_analise.txt_id_cep.value="<?=$ID_CEP?>";
  CEP(window.opener.document.frm_analise.txt_id_cep);
  window.opener.document.frm_analise.hdn_id_cidade.value="<?=$ID_CIDADE?>";
  <?
  if (@$_POST["hdn_alt"]!=1) {
  ?>
  window.opener.document.frm_analise.txt_nm_cidade.value="<?=$NM_CIDADE?>";
  <?
  } else {
    echo "//".@$_POST["hdn_alt"]."\n";
  }
  ?>
  window.opener.document.frm_analise.txt_nm_complemento.value="<?=str_replace("'","",$NM_COMPLEMENTO)?>";
  window.opener.document.frm_analise.txt_vl_area_construida.value="<?=str_replace(".",",",$VL_AREA_CONSTRUIDA)?>";
  FormatNumero(window.opener.document.frm_analise.txt_vl_area_construida);
  decimal(window.opener.document.frm_analise.txt_vl_area_construida,2);
  
  window.location.href="seguranca.php?hdn_id_cidade=<?=$ID_CIDADE?>&hdn_id_edificacao=<?=$ID_EDIFICACAO?>&hdn_id_solicitacao=<?=$_POST["hdn_id_solicitacao"]?>&hdn_id_tipo_solicitacao=<?=$_POST["hdn_id_tipo_solicitacao"]?>&hdn_novos="+novos;
//-->
</script>
  <?
      } else {
  ?>
<script language="javascript" type="text/javascript">//<!--
  window.opener.document.frm_analise.txt_id_edificacao.value="<?=$ID_EDIFICACAO?>";
  window.opener.document.frm_analise.txt_nm_edificacao.value="<?=$NM_EDIFICACAO?>";
  window.opener.document.frm_analise.txt_nm_edificacao.value="<?=str_replace("'","",$NM_EDIFICACAO)?>";
  window.opener.document.frm_analise.hdn_id_tp_prefixo.value="<?=$ID_TP_LOGRADOURO?>";
  window.opener.document.frm_analise.txt_nm_tp_prefixo.value="<?=$NM_TP_LOGRADOURO?>";
  window.opener.document.frm_analise.txt_nm_logradouro.value="<?=str_replace("'","",$NM_LOGRADOURO)?>";
  window.opener.document.frm_analise.txt_nr_edificacao.value="<?=$NR_EDIFICACAO?>";
  window.opener.document.frm_analise.txt_nm_bairro.value="<?=str_replace("'","",$NM_BAIRRO)?>";
  window.opener.document.frm_analise.txt_id_cep.value="<?=$ID_CEP?>";
  CEP(window.opener.document.frm_analise.txt_id_cep);
  window.opener.document.frm_analise.hdn_id_cidade.value="<?=$ID_CIDADE?>";
  <?
  if (@$_POST["hdn_alt"]!=1) {
  ?>
  window.opener.document.frm_analise.txt_nm_cidade.value="<?=$NM_CIDADE?>";
  <?
  } else {
    echo "//".@$_POST["hdn_alt"]."\n";
  }
  ?>
  window.opener.document.frm_analise.txt_nm_complemento.value="<?=str_replace("'","",$NM_COMPLEMENTO)?>";
  window.opener.document.frm_analise.txt_vl_area_construida.value="<?=$VL_AREA_CONSTRUIDA?>";
  FormatNumero(window.opener.document.frm_analise.txt_vl_area_construida);
  decimal(window.opener.document.frm_analise.txt_vl_area_construida,2);
  window.close();
//-->
</script>
<?
      }
    }
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo,arq) {
      if (campo.value!="") {
       window.open(arq+"?campo="+campo.value,"consulrot","top=5000,left=5000,screenY= 5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
 //     frm.txt_id_rotina.readOnly=false;
    }
    function eng(funcao,campo_nm,ctr) {
      var frm=document.frm_edificacao;
      if (funcao==1) {
        window.open("../edificacoes/consulta_engenheiro.php?hdn_campo="+ctr+"&txt_pesq_engenheiro="+campo_nm,"cons_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=400,innerwidth=780,innerheight=400")
        return true;
      }
      if (funcao==2) {
        if (ctr==1) {
          if ((frm.hdn_id_crea_2.value!="")||(frm.hdn_id_crea_3.value!="")) {
            alert("Primeiro Engenheiro Obrigatório, Limpe os Posteriores!");
            return true;
          }
        }
        var campo_eng_id="hdn_id_crea_"+ctr;
        var campo_eng_nm="txt_nm_engenheiro_"+ctr;
        document.frm_edificacao[campo_eng_id].value="";
        document.frm_edificacao[campo_eng_nm].value="";
        return true;
      }
    }
    function cons_logra(valor,cidade) {
      window.open("cons_lograd_ed.php?txt_nm_logradouro="+valor+"&hdn_id_cidade="+cidade,"cons_logradouro","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=400,innerwidth=780,innerheight=400")
    }
//--></script>
<body onload="ajustaspan()">
<?
 //include ('../../templates/cab_cons.htm');
?>
          <form target="_self" enctype="multipart/form-data" method="post" name="frm_edificacao" onreset="retorna(this)" onsubmit="return validaForm(this,'txt_nr_cnpjcpf_proprietario,CPF/CNPJ do Proprietário,t','txt_nm_proprietario,Nome Proprietário,t','txt_nr_fone_proprietario,Fone Proprietário,n','txt_de_email_proprietario,E-mail do Proprietário,e','txt_nm_edificacao,Nome da Edificação,t','cmb_id_tp_prefixo,Tipo Logradouro,n','txt_nm_logradouro,Nome do Logradouro','hdn_id_cidade,Cidade,n','txt_nm_bairro,Nome do Bairro,t','txt_id_cep,CEP,t','txt_vl_area_contruida,Área Construída,t','txt_vl_altura,Altura da Edificação,t','txt_vl_area_pavimento,Área Pavimento Tipo,t','cmb_id_risco,Risco,n','cmb_id_ocupacao,Ocupação,n','cmb_id_situacao,Situação,n','cmb_id_tp_construcao,Tipo da Construção,n','cmb_nr_pavimentos,N° de Pavimentos,n','cmb_nr_blocos,n','hdn_sis_incendio,Sistema de Segurança contra Incendio,t','hdn_id_crea_1,Engenheiro Valido,t')">
          

<table width="100%" cellspacing="0" border="0" cellpadding="0" align="center">

           <link rel="stylesheet" type="text/css" href="./../../css/menu.css">
	<link type="text/css" rel="stylesheet" href="./../../css/calendario.css" />
	<link rel="stylesheet" type="text/css" href="./../../css/ebombeiro.css">
	<link rel="stylesheet" type="text/css" href="./../../js/sigat_div.js">
	<link rel="stylesheet" type="text/css" href="./../../js/menu.js">
	<link rel="stylesheet" type="text/css" href="./../../js/editcombo.js">





              <td>




            <table width="95%" cellspacing="0" border="0" cellpadding="0" align="center">
              <tr>
                <td  colspan="2" >
                  <fieldset>
                    <legend>Proprietário</legend>
                      <table>
                        <tr>
                          <td>CNPJ/CPF</td>
                          <td>
                            <input type="hidden" name="hdn_alt" value="<?=@$_GET["alt"]?>">
                            <input type="hidden" name="hdn_id_edificacao" value="">
                            <input type="hidden" name="hdn_id_solicitacao" value="">
                            <input type="hidden" name="hdn_id_tipo_solicitacao" value="">
                            <input type="text" name="txt_nr_cnpjcpf_proprietario" size="20" maxlength="18" class="campo_obr" title="CNPJ ou CPF do Proprietário da Edificação" onblur="cpfcnpj(this)"></td>
                          <td>Nome</td>
                          <td><input type="text" name="txt_nm_proprietario" size="59" maxlength="100" class="campo_obr" title="Nome do Proprietário da Edificação"></td>
                        </tr>
                        <tr>
                          <td>Fone</td>
                          <td><input type="text" name="txt_nr_fone_proprietario" size="20" maxlength="12" class="campo_obr" title="Fone do Proprietário da Edificação"></td>
                          <td>E-mail</td>
                          <td><input type="text" name="txt_de_email_proprietario" size="59" maxlength="100" class="campo_obr" title="E-mail do Proprietário da Edificação" style="text-transform : none;"></td>
                        </tr>
                      </table>
                    </fieldset>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="vertical-align: top;">
                  
                    <fieldset>
                      <legend>Edificação</legend>
                      <table width="100%" cellspacing="0" border="0" cellpadding="0">
                        <tr>
                          <td>
                            <table width="100%" cellspacing="0" border="0" cellpadding="2">
                              <tr>
                                <td>Nome</td>
                                <td colspan="3"><input type="text" name="txt_nm_edificacao" size="82" maxlength="100" class="campo_obr" title="Nome da Edificação"></td>
                              </tr>
                              <tr>
                                <td>Nome Fantasia 1</td>
                                <td><input type="text" name="txt_nm_fantasia_1" size="35" maxlength="100" title="Primeiro Nome Fantasia da Edificação" class="campo"></td>
                                <td>Nome Fantasia 2</td>
                                <td><input type="text" name="txt_nm_fantasia_2" size="35" maxlength="100" title="Primeiro Nome Fantasia da Edificação" class="campo"></td>
                              </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <fieldset>
                            <legend>Endereço</legend>
                            <table cellspacing="0" border="0" cellpadding="2" width="100%">
                              <tr>
                                <td>Logradouro</td>
                                <td>
                                  <select name="cmb_id_tp_prefixo" class="campo_obr">
                                    <option value="">--</option>
<?
                                  $sql_tp_logradouro="SELECT ID_TP_LOGRADOURO,NM_TP_LOGRADOURO FROM ".TBL_TP_LOGRADOURO;
                                  $conn->query($sql_tp_logradouro);
                                  while ($cidade=$conn->fetch_row()) {
?>
                                    <option value="<?=$cidade["ID_TP_LOGRADOURO"]?>"><?=$cidade["NM_TP_LOGRADOURO"]?></option>
<?
                                 }
?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <input name="hdn_id_logradouro" type="hidden" value="">
                                  <input type="text" name="txt_nm_logradouro" size="41" maxlength="100" title="Nome do Logradouro" class="campo_obr">
                                </td>
                              </tr>
                              <tr>
                                <td>N°</td>
                                <td>
                                  <input type="text" name="txt_nr_numero" size="5" maxlength="6" class="campo" title="Número do Endereço da Edificação" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)">
                                </td>
                                <td>Cidade</td>
                                <td colspan="2">
                                  <input type="hidden" name="hdn_id_cidade" value="">
                                  <input type="text" name="txt_nm_cidade" size="35" maxlength="100" value="" class="campo_obr" readOnly="true">
                                </td>
                              </tr>
                              <tr>
                                <td>Bairro</td>
                                <td>
                                  <input type="hidden" name="hdn_id_bairro" value="">
                                  <input type="text" name="txt_nm_bairro" size="38" maxlength="50" class="campo_obr" title="Bairro da Edificação">
                                </td>
                                <td>CEP</td>
                                <td><input type="text" name="txt_id_cep" size="11" maxlength="10" class="campo" title="Número do CEP da Edificação" onkeypress="return validaTecla(this, event, 'n')" onblur="CEP(this)"></td>
                                <td colspan="2">
                                  <center>
                                    <input type="button" name="btn_valida_logradouro" value="Validar" class="botao"  title="Validar o Logradouro Existente" onClick="cons_logra(document.frm_edificacao.txt_nm_logradouro.value,document.frm_edificacao.hdn_id_cidade.value)">
                                  </center>
                                </td>
                              </tr>
                              <tr>
                                <td align="rigth">Complemento</td>
                                <td colspan="5"><input type="text" name="txt_nm_complemento" size="95" maxlength="100" class="campo" title="Complemento do Endereço da Edificação"></td>
                              </tr>
                            </table>
                          </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <fieldset>
                            <legend>Características</legend>
                            <table width="100%" cellspacing="0" border="0" cellpadding="2">
                              <tr>
                                <td>Área Total<br>Construída</td>
                                <td>
                                  <input name="txt_vl_area_contruida" class="campo_obr" size="10" maxlength="25" value="" title="Valor total da área construída" align="right" onChange="FormatNumero(this)" onblur="decimal(this,2)"><em>(m²)</em>
                                </td>
                                <td>Altura</td>
                                <td>
                                  <input name="txt_vl_altura" class="campo_obr" size="10" maxlength="25" value="" title="Altura do Piso de Descarga (Saída) até a altura do último piso útil da Edificação (Ex.: 1 andar altura=0)" align="right" onChange="FormatNumero(this)" onblur="decimal(this,2)"><em>(m)</em>
                                </td>
                                <td>Área do<br>Pavimento Tipo</td>
                                <td>
                                  <input name="txt_vl_area_pavimento" class="campo_obr" size="10" maxlength="25" value="" title="Área do maior Pavimento da Edificação" align="right" onChange="FormatNumero(this)" onblur="decimal(this,2)"><em>(m²)</em>
                                </td>
                                <td>Risco</td>
                                <td>
                                  <select name="cmb_id_risco" class="campo_obr" title="Classe de risco de incêndio da Edificação">
                                    <option value="">-------</option>
<?
                        // string da query
                        $sql= "SELECT ID_RISCO, NM_RISCO FROM ".TBL_TP_RISCO;
                        // executando a consulta
                        $res= $conn->query($sql);
                        // testando se houve algum erro
                        if ($conn->get_status()==false) {
                          die($conn->get_msg());
                        }

                        while ($tupula = $conn->fetch_row()) {
?>
                                    <option value="<?=$tupula['ID_RISCO']?>"><?=$tupula['NM_RISCO']?></option>
<?
                        }
?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>Ocupação</td>
                                <td colspan="4">
                                  <select name="cmb_id_ocupacao" class="campo_obr" title="Classificação da Edificação quanto a sua Ocupação">
                                    <option value="">--------</option>
<?
                        // string da query
                        $sql= "SELECT ID_OCUPACAO, NM_OCUPACAO FROM ".TBL_TP_OCUPACAO;
                        // executando a consulta
                        $res= $conn->query($sql);
                        // testando se houve algum erro
                        if ($conn->get_status()==false) {
                          die($conn->get_msg());
                        }

                        while ($tupula = $conn->fetch_row()) {
?>
                                    <option value="<?=$tupula['ID_OCUPACAO']?>"><?=$tupula['NM_OCUPACAO']?></option>
<?
                        }
?>
                                  </select>
                                </td>

                                <td>Situação</td>
                                <td colspan="2">
                                  <select name="cmb_id_situacao" title="Situação da edificação quanto a sua construção" class="campo_obr">
                                    <option value="">--------</option>
<?
                        // string da query
                        $sql= "SELECT ID_SITUACAO, NM_SITUACAO FROM ".TBL_TP_SITUACAO;
                        // executando a consulta
                        $res= $conn->query($sql);
                        // testando se houve algum erro
                        if ($conn->get_status()==false) {
                          die($conn->get_msg());
                        }

                        while ($tupula = $conn->fetch_row()) {
?>
                                    <option value="<?=$tupula['ID_SITUACAO']?>"><?=$tupula['NM_SITUACAO']?></option>
<?
                        }
?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>Tipo</td>
                                <td colspan="3 ">
                                  <select name="cmb_id_tp_construcao" class="campo_obr" title="Tipo de contrução da Edificação">
                                    <option value="">--------</option>
<?
                        // string da query
                        $sql= "SELECT ID_TP_CONSTRUCAO, NM_TP_CONSTRUCAO FROM ".TBL_TP_CONSTRUCAO;
                        // executando a consulta
                        $res= $conn->query($sql);
                        // testando se houve algum erro
                        if ($conn->get_status()==false) {
                          die($conn->get_msg());
                        }
                        while ($tupula = $conn->fetch_row()) {
?>
                                    <option value="<?=$tupula['ID_TP_CONSTRUCAO']?>"><?=$tupula['NM_TP_CONSTRUCAO']?></option>
<?
                        }
?>
                                  </select>
                                </td>
                                <td>N°<br>Pavimento</td>
                                <td>
                                  <select name="cmb_nr_pavimentos" class="campo_obr" title="Número de pavimentos da edificação">
<?
                      for ($i=1;$i<=35;$i++) {
?>
                                    <option value="<?=$i?>"><?=$i?></option>
<?
                        }
                      ?>
                    </select>
                                </td>
                                <td>N°<br>Blocos</td>
                                <td>
                                  <select name="cmb_nr_blocos" class="campo_obr" title="Número de Blocos da Edificação">
<?
                        for ($i=1;$i<=50;$i++) {
?>
                                    <option value="<?=$i?>"><?=$i?></option>
<?
                        }
?>
                                  </select>
                                </td>
                              </tr>
                            </table>
                          </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table width="100%" cellspacing="0" border="0" cellpadding="2">
                              <tr>
                                <td>
                                  <fieldset>
                                    <legend>Sist. Seg.<br>Incendio</legend>
                                    <table width="100%" cellspacing="0" border="0" cellpadding="3">
                                      <tr>
                                        <td>
                                          &nbsp;
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <input name="hdn_sis_incendio" type="hidden" value="">
                                          <label><input type="radio" name="rdo_sis_incendio" onChange="javascript:document.frm_edificacao.hdn_sis_incendio.value='S';">Sim</label>
                                          <label><input type="radio" name="rdo_sis_incendio" onChange="javascript:document.frm_edificacao.hdn_sis_incendio.value='N';">Não</label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          &nbsp;
                                        </td>
                                      </tr>
                                    </table>
                                  </fieldset>
                                </td>
                                <td>
                                  <fieldset>
                                    <legend>Plano de Ação</legend><center>
                                    <textarea name="txa_de_plano" cols="20" rows="4" class="campo_obr"></textarea>
                                    </center>
                                  </fieldset>
                                </td>
                                <td>
                                  <fieldset>
                                    <legend>Responsável Técnico Projeto (Máximo 3)</legend>
                                    <table width="1" cellspacing="0" border="0" cellpadding="0">
                                      <tr style="background-color : #ffffff;">
                                        <td width="1">
                                          <input type="hidden" name="hdn_id_crea_1" value="">
                                          <input type="text" name="txt_nm_engenheiro_1" value="" class="campo_obr" title="Engenheiro Responsável" size="30">
                                        </td>
                                        <td width="1">
                                          <img src="./imagens/botao-atualizar-a.gif" width="25" height="25" border="0" style="cursor : pointer;" onClick="eng(1,document.frm_edificacao.txt_nm_engenheiro_1.value,1)">
                                        </td>
                                        <td>
                                          <img src="./imagens/botao-limpar-a.gif" width="25" height="25" border="0" style="cursor : pointer;" onClick="eng(2,document.frm_edificacao.txt_nm_engenheiro_1.value,1)">
                                        </td>
                                      </tr>
                                      <tr style="background-color : #ffffff;">
                                        <td width="1">
                                          <input type="hidden" name="hdn_id_crea_2" value="">
                                          <input type="text" name="txt_nm_engenheiro_2" value="" class="campo" title="Engenheiro Responsável" size="35">
                                        </td>
                                        <td width="1">
                                          <img src="./imagens/botao-atualizar-a.gif" width="25" height="25" border="0" style="cursor : pointer;" onClick="eng(1,document.frm_edificacao.txt_nm_engenheiro_2.value,2)">
                                        </td>
                                        <td>
                                          <img src="./imagens/botao-limpar-a.gif" width="25" height="25" border="0" style="cursor : pointer;" onClick="eng(2,document.frm_edificacao.txt_nm_engenheiro_2.value,2)">
                                        </td>
                                      </tr>
                                      <tr style="background-color : #ffffff;">
                                        <td width="1">
                                          <input type="hidden" name="hdn_id_crea_3" value="">
                                          <input type="text" name="txt_nm_engenheiro_3" value="" class="campo" title="Engenheiro Responsável" size="35">
                                        </td>
                                        <td width="1">
                                          <img src="./imagens/botao-atualizar-a.gif" width="25" height="25" border="0" style="cursor : pointer;" onClick="eng(1,document.frm_edificacao.txt_nm_engenheiro_3.value,3)">
                                        </td>
                                        <td>
                                          <img src="./imagens/botao-limpar-a.gif" width="25" height="25" border="0" style="cursor : pointer;" onClick="eng(2,document.frm_edificacao.txt_nm_engenheiro_3.value,3)">
                                        </td>
                                      </tr>
                                    </table>
                                  </fieldset>
                                </td>
                              </tr>
                          </table>
                        </td>
                        </tr>
                      </table>
                    </fieldset>
                  </td>
                </tr>

<?

 include('./../../templates/btn_salva.htm');

?>
              </tr>
            </table>
               <!-- </td>
               </table>-->
          </form>
        </span>
      </td>
    </tr>
  </tbody>
</table>
<?
  if ((@$_GET["hdn_id_solicitacao"]!="")&&(@$_GET["hdn_id_cidade"]!="")&&(@$_GET["hdn_id_tipo_solicitacao"]!="")&&(@$_POST["hdn_id_cidade"]=="")) {
    if ((@$_GET["hdn_id_edificacao"]=="") || (@$_GET["hdn_id_edificacao"]=="0")) {
    $sql_ed=" SELECT  ".TBL_SOLICITACAO.".ID_CIDADE, ".TBL_SOLICITACAO.".ID_SOLICITACAO, ".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO, ".TBL_SOLICITACAO.".CNPJ_CPF_PROPRIETARIO, ".TBL_SOLICITACAO.".NM_PROPRIETARIO, ".TBL_SOLICITACAO.".NR_FONE_PROPRIETARIO, ".TBL_SOLICITACAO.".DE_EMAIL_PROPRIETARIO, ".TBL_SOLICITACAO.".NM_EDIFICACOES_LX, ".TBL_SOLICITACAO.".NM_FANTASIA, ".TBL_SOLICITACAO.".NM_LOGRADOURO, ".TBL_SOLICITACAO.".NR_EDIFICACOES_LX, ".TBL_SOLICITACAO.".NR_CEP, ".TBL_SOLICITACAO.".NM_BAIRRO, ".TBL_SOLICITACAO.".NM_COMPLEMENTO, ".TBL_SOLICITACAO.".VL_AREA_CONTRUIDA, ".TBL_SOLICITACAO.".VL_ALTURA, ".TBL_SOLICITACAO.".VL_AREA_TIPO, ".TBL_SOLICITACAO.".NR_PAVIMENTOS, ".TBL_SOLICITACAO.".NR_BLOCOS, ".TBL_SOLICITACAO.".ID_RISCO, ".TBL_SOLICITACAO.".ID_SITUACAO, ".TBL_SOLICITACAO.".ID_TP_CONSTRUCAO, ".TBL_SOLICITACAO.".ID_OCUPACAO, ".TBL_SOLICITACAO.".NR_CREA_1, ".TBL_SOLICITACAO.".NM_ENGENHEIRO_1, ".TBL_SOLICITACAO.".NR_CREA_2, ".TBL_SOLICITACAO.".NM_ENGENHEIRO_2, ".TBL_SOLICITACAO.".NR_CREA_3, ".TBL_SOLICITACAO.".NM_ENGENHEIRO_3, ".TBL_SOLICITACAO.".ID_TP_LOGRADOURO, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_SOLICITACAO." LEFT JOIN ".TBL_CIDADE." USING(ID_CIDADE) WHERE   ".TBL_SOLICITACAO.".ID_SOLICITACAO=".$_GET["hdn_id_solicitacao"]." AND ".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO='".$_GET["hdn_id_tipo_solicitacao"]."' AND ".TBL_SOLICITACAO.".ID_CIDADE=".$_GET["hdn_id_cidade"];
    $conn->query($sql_ed);
    $row_ed=$conn->num_rows();
    if ($row_ed>0) {
      $solicitacao=$conn->fetch_row();
      $ID_CIDADE=$solicitacao["ID_CIDADE"];
      $NM_CIDADE=$solicitacao["NM_CIDADE"];
      $ID_EDIFICACAO="";
      $ID_SOLICITACAO=$solicitacao["ID_SOLICITACAO"];
      $ID_TIPO_SOLICITACAO=$solicitacao["ID_TIPO_SOLICITACAO"];
      if ($solicitacao["CNPJ_CPF_PROPRIETARIO"]=="NULL") { $NR_CNPJCPF_PROPRIETARIO=""; }
      else { $NR_CNPJCPF_PROPRIETARIO=$solicitacao["CNPJ_CPF_PROPRIETARIO"]; }
      $NM_PROPRIETARIO=$solicitacao["NM_PROPRIETARIO"];
      $NR_FONE_PROPRIETARIO=$solicitacao["NR_FONE_PROPRIETARIO"];
      $DE_EMAIL_PROPRIETARIO=$solicitacao["DE_EMAIL_PROPRIETARIO"];
      $NM_EDIFICACOES_LX=$solicitacao["NM_EDIFICACOES_LX"];
      $NM_FANTASIA=$solicitacao["NM_FANTASIA"];
      $NM_FANTASIA_2="";
      $NM_LOGRADOURO=$solicitacao["NM_LOGRADOURO"];
      $NR_EDIFICACOES_LX=$solicitacao["NR_EDIFICACOES_LX"];
      $NR_CEP=$solicitacao["NR_CEP"];
      $NM_BAIRRO=$solicitacao["NM_BAIRRO"];
      $NM_COMPLEMENTO=$solicitacao["NM_COMPLEMENTO"];
      $VL_AREA_CONSTRUIDA=str_replace(".",",",$solicitacao["VL_AREA_CONTRUIDA"]);
      $VL_ALTURA=str_replace(".",",",$solicitacao["VL_ALTURA"]);
      $VL_AREA_TIPO=str_replace(".",",",$solicitacao["VL_AREA_TIPO"]);
      $NR_PAVIMENTOS=$solicitacao["NR_PAVIMENTOS"];
      $NR_BLOCOS=$solicitacao["NR_BLOCOS"];
      $ID_RISCO=$solicitacao["ID_RISCO"];
      $ID_SITUACAO=$solicitacao["ID_SITUACAO"];
      $ID_TP_CONSTRUCAO=$solicitacao["ID_TP_CONSTRUCAO"];
      $ID_OCUPACAO=$solicitacao["ID_OCUPACAO"];
      $NR_CREA_1=$solicitacao["NR_CREA_1"];
      $NM_ENGENHEIRO_1=$solicitacao["NM_ENGENHEIRO_1"];
      $NR_CREA_2=$solicitacao["NR_CREA_2"];
      $NM_ENGENHEIRO_2=$solicitacao["NM_ENGENHEIRO_2"];
      $NR_CREA_3=$solicitacao["NR_CREA_3"];
      $NM_ENGENHEIRO_3=$solicitacao["NM_ENGENHEIRO_3"];
      $ID_TP_LOGRADOURO=$solicitacao["ID_TP_LOGRADOURO"];
      $ID_BAIRROS="";
      $ID_LOGRADOURO="";
      $CONTROLE=1;
    }
  } else {
      $sql_ed=" SELECT  ".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_EDIFICACAO.".ID_EDIFICACAO, ".TBL_PESSOA.".ID_CNPJ_CPF, ".TBL_PESSOA.".NM_PESSOA, ".TBL_PESSOA.".NR_FONE, ".TBL_PESSOA.".DE_EMAIL_PESSOA, ".TBL_EDIFICACAO.".NM_EDIFICACAO, ".TBL_EDIFICACAO.".NM_FANTASIA_1, ".TBL_EDIFICACAO.".NM_FANTASIA_2, ".TBL_LOGRADOURO.".ID_LOGRADOURO, ".TBL_LOGRADOURO.".NM_LOGRADOURO, ".TBL_EDIFICACAO.".NR_EDIFICACAO, ".TBL_EDIFICACAO.".ID_CEP, ".TBL_BAIRROS.".ID_BAIRROS, ".TBL_BAIRROS.".NM_BAIRROS, ".TBL_EDIFICACAO.".NM_COMPLEMENTO, ".TBL_EDIFICACAO.".VL_AREA_CONSTRUIDA, ".TBL_EDIFICACAO.".VL_ALTURA, ".TBL_EDIFICACAO.".VL_AREA_TIPO, ".TBL_EDIFICACAO.".NR_PAVIMENTOS, ".TBL_EDIFICACAO.".NR_BLOCOS, ".TBL_EDIFICACAO.".ID_RISCO, ".TBL_EDIFICACAO.".ID_SITUACAO, ".TBL_EDIFICACAO.".ID_TP_CONSTRUCAO, ".TBL_EDIFICACAO.".ID_OCUPACAO, ".TBL_ENGENHEIRO.".ID_CREA, ".TBL_ENGENHEIRO.".NM_ENGENHEIRO, ".TBL_LOGRADOURO.".ID_TP_LOGRADOURO, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_EDIFICACAO." LEFT JOIN ".TBL_CIDADE." ON (".TBL_EDIFICACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_PESSOA." ON (".TBL_EDIFICACAO.".ID_CNPJ_CPF_PROPRIETARIO=".TBL_PESSOA.".ID_CNPJ_CPF AND ".TBL_EDIFICACAO.".ID_CIDADE_PESSOA=".TBL_PESSOA.".ID_CIDADE) LEFT JOIN ".TBL_ENG_EDIFICACAO." ON (".TBL_EDIFICACAO.".ID_EDIFICACAO=".TBL_ENG_EDIFICACAO.".ID_EDIFICACAO AND ".TBL_EDIFICACAO.".ID_CIDADE=".TBL_ENG_EDIFICACAO.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_EDIFICACAO.".ID_CEP=".TBL_CEP.".ID_CEP AND ".TBL_EDIFICACAO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_EDIFICACAO.".ID_CIDADE_CEP=".TBL_CEP.".ID_CIDADE) LEFT JOIN ".TBL_ENGENHEIRO." ON (".TBL_ENG_EDIFICACAO.".ID_CREA=".TBL_ENGENHEIRO.".ID_CREA) LEFT JOIN ".TBL_LOGRADOURO." ON (".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE)   WHERE (".TBL_ENG_EDIFICACAO.".ID_TP_ENG='P' OR ".TBL_ENG_EDIFICACAO.".ID_TP_ENG IS NULL) AND  ".TBL_EDIFICACAO.".ID_EDIFICACAO=".$_GET["hdn_id_edificacao"]." AND ".TBL_EDIFICACAO.".ID_CIDADE=".$_GET["hdn_id_cidade"];
      echo "<!-- aqui: $sql_ed-->\n";
      $conn->query($sql_ed);
      $row_ed=$conn->num_rows();
      if ($row_ed>0) {
        $count=1;
        while ($solicitacao=$conn->fetch_row()) {
          if ($count==1) {
            $ID_CIDADE=$solicitacao["ID_CIDADE"];
            $NM_CIDADE=$solicitacao["NM_CIDADE"];
            $ID_EDIFICACAO=$solicitacao["ID_EDIFICACAO"];
            $ID_SOLICITACAO=$_GET["hdn_id_solicitacao"];
            $ID_TIPO_SOLICITACAO=$_GET["hdn_id_tipo_solicitacao"];
            if ($solicitacao["ID_CNPJ_CPF"]=="NULL") { $NR_CNPJCPF_PROPRIETARIO=""; }
            else { $NR_CNPJCPF_PROPRIETARIO=$solicitacao["ID_CNPJ_CPF"]; }
            $NM_PROPRIETARIO=$solicitacao["NM_PESSOA"];
            $NR_FONE_PROPRIETARIO=$solicitacao["NR_FONE"];
            $DE_EMAIL_PROPRIETARIO=$solicitacao["DE_EMAIL_PESSOA"];
            $NM_EDIFICACOES_LX=$solicitacao["NM_EDIFICACAO"];
            $NM_FANTASIA=$solicitacao["NM_FANTASIA_1"];
            $NM_FANTASIA_2=$solicitacao["NM_FANTASIA_2"];
            $NM_LOGRADOURO=$solicitacao["NM_LOGRADOURO"];
            $NR_EDIFICACOES_LX=$solicitacao["NR_EDIFICACAO"];
            $NR_CEP=$solicitacao["ID_CEP"];
            $NM_BAIRRO=$solicitacao["NM_BAIRROS"];
            $NM_COMPLEMENTO=$solicitacao["NM_COMPLEMENTO"];
            $VL_AREA_CONSTRUIDA=str_replace(".",",",$solicitacao["VL_AREA_CONSTRUIDA"]);
            $VL_ALTURA=str_replace(".",",",$solicitacao["VL_ALTURA"]);
            $VL_AREA_TIPO=str_replace(".",",",$solicitacao["VL_AREA_TIPO"]);
            $NR_PAVIMENTOS=$solicitacao["NR_PAVIMENTOS"];
            $NR_BLOCOS=$solicitacao["NR_BLOCOS"];
            $ID_RISCO=$solicitacao["ID_RISCO"];
            $ID_SITUACAO=$solicitacao["ID_SITUACAO"];
            $ID_TP_CONSTRUCAO=$solicitacao["ID_TP_CONSTRUCAO"];
            $ID_OCUPACAO=$solicitacao["ID_OCUPACAO"];
            $ID_TP_LOGRADOURO=$solicitacao["ID_TP_LOGRADOURO"];
            $NR_CREA_1=$solicitacao["ID_CREA"];
            $NM_ENGENHEIRO_1=$solicitacao["NM_ENGENHEIRO"];
            $ID_BAIRROS=$solicitacao["ID_BAIRROS"];
            $ID_LOGRADOURO=$solicitacao["ID_LOGRADOURO"];
          }
          $eng_crea='$NR_CREA_'.$count.'=$solicitacao["ID_CREA"];';
          $eng_nm='$NM_ENGENHEIRO_'.$count.'=$solicitacao["NM_ENGENHEIRO"];';
          eval($eng_crea);
          eval($eng_nm);
          $count++;
        }
        if (!isset($NR_CREA_1)) {
          $NR_CREA_1="";
          $NM_ENGENHEIRO_1="";
        }
        if (!isset($NR_CREA_2)) {
          $NR_CREA_2="";
          $NM_ENGENHEIRO_2="";
        }
        if (!isset($NR_CREA_3)) {
          $NR_CREA_3="";
          $NM_ENGENHEIRO_3="";
        }
        $CONTROLE=2;
      }
    }
?>
<script language="javascript" type="text/javascript">//<!--
var frm_at=document.frm_edificacao;
frm_at.hdn_controle.value="<?=$CONTROLE?>";
frm_at.hdn_id_edificacao.value="<?=$ID_EDIFICACAO?>";
frm_at.hdn_id_solicitacao.value="<?=$ID_SOLICITACAO?>";
frm_at.hdn_id_tipo_solicitacao.value="<?=$ID_TIPO_SOLICITACAO?>";
frm_at.txt_nm_proprietario.value="<?=$NM_PROPRIETARIO?>";
frm_at.txt_nr_fone_proprietario.value="<?=$NR_FONE_PROPRIETARIO?>";
frm_at.txt_nr_cnpjcpf_proprietario.value="<?=$NR_CNPJCPF_PROPRIETARIO?>";
// cpfcnpj(frm_at.txt_nr_cnpjcpf_proprietario);
frm_at.txt_de_email_proprietario.value="<?=$DE_EMAIL_PROPRIETARIO?>";
frm_at.txt_nm_edificacao.value="<?=$NM_EDIFICACOES_LX?>";
frm_at.txt_nm_fantasia_1.value="<?=$NM_FANTASIA?>";
frm_at.txt_nm_fantasia_2.value="<?=$NM_FANTASIA_2?>";
frm_at.cmb_id_tp_prefixo.value="<?=$ID_TP_LOGRADOURO?>";
frm_at.hdn_id_logradouro.value="<?=$ID_LOGRADOURO?>";
frm_at.txt_nm_logradouro.value="<?=$NM_LOGRADOURO?>";
frm_at.txt_nr_numero.value="<?=$NR_EDIFICACOES_LX?>";
frm_at.hdn_id_cidade.value="<?=$ID_CIDADE?>";
frm_at.txt_nm_cidade.value="<?=$NM_CIDADE?>";
frm_at.hdn_id_bairro.value="<?=$ID_BAIRROS?>";
frm_at.txt_nm_bairro.value="<?=$NM_BAIRRO?>";
frm_at.txt_id_cep.value="<?=$NR_CEP?>";
// CEP(frm_at.txt_id_cep);
frm_at.txt_nm_complemento.value="<?=$NM_COMPLEMENTO?>";
frm_at.txt_vl_area_contruida.value="<?=$VL_AREA_CONSTRUIDA?>";
// FormatNumero(frm_at.txt_vl_area_contruida);
// decimal(frm_at.txt_vl_area_contruida,2);
frm_at.txt_vl_altura.value="<?=$VL_ALTURA?>";
// FormatNumero(frm_at.txt_vl_altura);
// decimal(frm_at.txt_vl_altura,2);


frm_at.txt_vl_area_pavimento.value="<?=$VL_AREA_TIPO?>";
// FormatNumero(frm_at.txt_vl_area_pavimento);
// decimal(frm_at.txt_vl_area_pavimento,2);


frm_at.cmb_id_risco.value="<?=$ID_RISCO?>";
frm_at.cmb_id_ocupacao.value="<?=$ID_OCUPACAO?>";
frm_at.cmb_id_situacao.value="<?=$ID_SITUACAO?>";
frm_at.cmb_id_tp_construcao.value="<?=$ID_TP_CONSTRUCAO?>";
frm_at.cmb_nr_pavimentos.value="<?=$NR_PAVIMENTOS?>";
frm_at.cmb_nr_blocos.value="<?=$NR_BLOCOS?>";
frm_at.hdn_id_crea_1.value="<?=$NR_CREA_1?>";
frm_at.txt_nm_engenheiro_1.value="<?=$NM_ENGENHEIRO_1?>";
frm_at.hdn_id_crea_2.value="<?=$NR_CREA_2?>";
frm_at.txt_nm_engenheiro_2.value="<?=$NM_ENGENHEIRO_2?>";
frm_at.hdn_id_crea_3.value="<?=$NR_CREA_3?>";
frm_at.txt_nm_engenheiro_3.value="<?=$NM_ENGENHEIRO_3?>";
/*
frm_at.txt_nm_logradouro.value="<?=@$NM_LOGRADOURO?>";
frm_at.txt_nr_edificacao.value="<?=@$NR_EDIFICACAO?>";
FormatNumero(frm_at.txt_nr_edificacao);
frm_at.txt_nm_bairro.value="<?=@$NM_BAIRRO?>";
frm_at.txt_id_cep.value="<?=@$NR_CEP?>";
CEP(frm_at.txt_id_cep);
frm_at.txt_vl_area_construida.value="<?=str_replace(".",",",@$VL_AREA_CONSTRUIDA)?>";
FormatNumero(frm_at.txt_vl_area_construida);
decimal(frm_at.txt_vl_area_construida,2);
frm_at.txt_nm_complemento.value="<?=@$NM_COMPLEMENTO?>";
frm_at.hdn_id_cidade.value="<?=@$ID_CIDADE?>";
frm_at.hdn_id_cidade_ant.value="<?=@$ID_CIDADE?>";
frm_at.cmb_id_tp_prefixo.value="<?=@$ID_TP_PREFIXO?>";
frm_at.hdn_contr_pendente.value='1';
*/
//-->
</script>

<?
    //}
  } else {
?>
<?
  }
?>
</body>
</html>

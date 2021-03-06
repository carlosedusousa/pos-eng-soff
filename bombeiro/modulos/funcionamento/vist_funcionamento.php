<?
  $erro="";
  require_once 'lib/loader.php';

  $arquivo="vist_funcionamento.php";
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  } else {
    $rotina["ID_ROTINA"]=-1;
  }

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

  $campos_preenchidos=true;
  $campos_existe=true;

  $campos_obr= array('txt_nr_fone_empresa'=>"',txt_nr_cnpj_empresa,CNPJ da Empresa Solicitante,t'",
   'txt_nm_razao_social'=>"'txt_nm_razao_social,Raz�o Social,t'",
   'txt_nr_fone_empresa'=>"'txt_nr_fone_empresa,N�mero do Fone Solicitante,n'",
   'txt_de_email_empresa'=>"'txt_de_email_empresa,E-mail da Empresa Solicitante,e'",
   'txt_id_edificacao'=>"'txt_id_edificacao,RE da Edifica��o,n'",
   'txt_nm_edificacao'=>"'txt_nm_edificacao,Nome da Edifica��o,t'",
   'txt_nm_logradouro'=>"'txt_nm_logradouro,Nome do Logradouro,t'",
   'hdn_id_cidade'=>"'hdn_id_cidade,Cidade da Edifica��o,t'",
   'txt_nm_bairro'=>"'txt_nm_bairro,Nome do Bairro,t'",
   'txt_id_cep'=>"'txt_id_cep,N�mero do CEP,t'",
   'txt_vl_area_construida'=>"'txt_vl_area_construida,Valor da �rea total Constru�da,t'",
   'txt_vl_area_vistoriada'=>"'txt_vl_area_vistoriada,Valor da �rea a ser Vistoriada,t'",
   'cmb_ch_parecer'=>"'cmb_ch_parecer,Parecer da Vistoria,t'",
   'hdn_mtv_indeferimento'=>"'hdn_mtv_indeferimento,Motivo do Indeferimento,t'"
  );

foreach($campos_obr as $campos_key=>$campos_value) {
  if ($campos_preenchidos==true) {
    if (!isset($_POST[$campos_key])) {
      $campos_existe=false;
      $campos_preenchidos=false;
    } else {
      if ($_POST[$campos_key]=="") {
        $campos_preenchidos=false;
      }
    }
  }
}
$campos_js=implode(",",$campos_obr);

  if ($campos_preenchidos) {

    if (@$_POST["hdn_id_vist_func"]!="") {
      $ID_VISTORIA_FUNC=formataCampo($_POST["hdn_id_vist_func"],"N");
    } else {
      $ID_VISTORIA_FUNC=0;
    }
    $ID_CIDADE                   =formataCampo($_POST["hdn_id_cidade"],"N");
    $ID_TP_PESSOA                ="'S'";
    $ID_SOLIC_FUNC               =$_POST["hdn_id_sol_funcionamento"];
    $ID_TP_FUNC                  =formataCampo($_POST["hdn_id_tp_sol_funcionamento"]);
    $ID_EDIFICACAO               =$_POST["txt_id_edificacao"];
    $ID_PROT_FUNC                =formataCampo($_POST["txt_id_prot_funcionamento"],"N");
    $ID_CNPJ_EMPRESA             =formataCampo(formataCampo($_POST["txt_nr_cnpj_empresa"],"N"));
    $NM_RAZAO_SOCIAL             =formataCampo($_POST["txt_nm_razao_social"]);
    $NM_RAZAO_SOCIAL_FONETICA    =formataCampo(nr_txt_fonetica($_POST["txt_nm_razao_social"]));
    $NM_CONTATO                  =formataCampo($_POST["txt_nm_contato"]);
    $NM_CONTATO_FONETICO         =formataCampo(nr_txt_fonetica($_POST["txt_nm_contato"]));
    $NM_FANTASIA_EMPRESA         =formataCampo($_POST["txt_nm_fantasia_empresa"]);
    $NM_FANTASIA_FONETICO_EMPRESA=formataCampo(nr_txt_fonetica($_POST["txt_nm_fantasia_empresa"]));
    $NR_FONE_EMPRESA             =formataCampo($_POST["txt_nr_fone_empresa"],"N");
    $DE_EMAIL_EMPRESA            =formataCampo($_POST["txt_de_email_empresa"],"T","L");
    if (strlen(str_replace("'","",$ID_CNPJ_EMPRESA))>13) $CH_JURIDICA="'S'"; else $CH_JURIDICA="'N'";

    $DT_VISTORIA   	= "CURDATE()";
    $ID_USUARIO_CAD	= formataCampo($usuario,"T","L");
	$ID_VISTORIADOR = formataCampo($_POST["cmb_vistoriador"],"T","L");
    $CH_PARCER     	= formataCampo($_POST["cmb_ch_parecer"]);
    $DE_OBSERVACOES	= formataCampo(@$_POST["txa_mtv_indeferimento"],"T","L");
    $id_estab      	= explode("^",$_POST["hdn_id_estab"]);
    $nm_estab      	= explode("^",$_POST["hdn_nm_desc_funcionamento"]);
    $nm_bloco      	= explode("^",$_POST["hdn_nm_bloco_desc_funcionamento"]);
    $vl_vist_estab 	= explode("^",$_POST["hdn_vl_desc_funcionamento"]);

    $ERRO_TRANS ="";
    $query_trans="BEGIN";
    $conn->query($query_trans);
    $query_trans="COMMIT";

    $query_pessoa="SELECT ID_TP_PESSOA FROM ".TBL_PESSOA." WHERE ID_CNPJ_CPF=$ID_CNPJ_EMPRESA AND ID_CIDADE=$ID_CIDADE";
    $conn->query($query_pessoa);
    if ($conn->num_rows()>0) {
      $pessoa_fetch=$conn->fetch_row();
      if ($pessoa_fetch["ID_TP_PESSOA"]!="S") {
        $ID_TP_PESSOA="'A'";
      }
      $query_pessoa="UPDATE ".TBL_PESSOA." SET ID_TP_PESSOA=$ID_TP_PESSOA, NM_PESSOA=$NM_RAZAO_SOCIAL, NM_PESSOA_FONETICA=$NM_RAZAO_SOCIAL_FONETICA, NR_FONE=$NR_FONE_EMPRESA, DE_EMAIL_PESSOA=$DE_EMAIL_EMPRESA, NM_CONTATO=$NM_CONTATO, NM_CONTATO_FONETICO=$NM_CONTATO_FONETICO, NM_FANTASIA=$NM_FANTASIA_EMPRESA, NM_FANTASIA_FONETICO=$NM_FANTASIA_FONETICO_EMPRESA, CH_JURIDICA=$CH_JURIDICA WHERE ".TBL_PESSOA.".ID_CNPJ_CPF=$ID_CNPJ_EMPRESA AND ".TBL_PESSOA.".ID_CIDADE=$ID_CIDADE";
    } else {
      $query_pessoa="INSERT INTO ".TBL_PESSOA." (ID_CNPJ_CPF, ID_CIDADE, ID_TP_PESSOA, NM_PESSOA, NM_PESSOA_FONETICA, NR_FONE, DE_EMAIL_PESSOA, NM_CONTATO, NM_CONTATO_FONETICO, NM_FANTASIA, NM_FANTASIA_FONETICO, CH_JURIDICA) VALUES ($ID_CNPJ_EMPRESA, $ID_CIDADE, $ID_TP_PESSOA, $NM_RAZAO_SOCIAL, $NM_RAZAO_SOCIAL_FONETICA, $NR_FONE_EMPRESA, $DE_EMAIL_EMPRESA, $NM_CONTATO, $NM_CONTATO_FONETICO, $NM_FANTASIA_EMPRESA, $NM_FANTASIA_FONETICO_EMPRESA, $CH_JURIDICA)";
    }
    $conn->query($query_pessoa);
     if ($conn->get_status()==false) {
      $ERRO_TRANS.= "pessoa:\n".$conn->get_msg()."\n";
    }

    $query_solictacao= "UPDATE ".TBL_SOL_FUNC." SET CH_PROTOCOLADO='V' " .
    "WHERE ".
    	TBL_SOL_FUNC.".ID_SOLIC_FUNC= $ID_SOLIC_FUNC AND ".
    	TBL_SOL_FUNC.".ID_CIDADE=$ID_CIDADE AND ".
    	TBL_SOL_FUNC.".ID_TP_FUNC=$ID_TP_FUNC";

    $conn->query($query_solictacao);
    if ($conn->get_status()==false) {
      $ERRO_TRANS.= "solicitacao:\n".$conn->get_msg()."\n";
    }

    $query_prot_habitese="UPDATE ".TBL_PROT_FUNC." SET CH_VISTORIADO='S', CH_STATUS_RETIRADA='V' WHERE ID_CIDADE=$ID_CIDADE AND ID_PROT_FUNC=$ID_PROT_FUNC";
    $conn->query($query_prot_habitese);
    if ($conn->get_status()==false) {
      $ERRO_TRANS.= "protocolo:\n".$conn->get_msg()."\n";
    }

     if ($ID_VISTORIA_FUNC==0) {
      $query_vist_funcionamento="INSERT INTO ".TBL_VISTORIA_FUNC." (ID_VISTORIA_FUNC, ID_CIDADE, ID_PROT_FUNC, ID_CNPJ_EMPRESA, ID_CIDADE_EMPRESA, CH_PARECER, DE_OBSERVACOES, DT_VIST_FUNC, ID_USUARIO, ID_VISTORIADOR) VALUES ($ID_VISTORIA_FUNC, $ID_CIDADE,  $ID_PROT_FUNC, $ID_CNPJ_EMPRESA, $ID_CIDADE, $CH_PARCER, $DE_OBSERVACOES, $DT_VISTORIA,'$usuario', $ID_VISTORIADOR)";
     } else {
      $query_vist_funcionamento="UPDATE ".TBL_VISTORIA_FUNC." SET ID_CNPJ_EMPRESA=$ID_CNPJ_EMPRESA, ID_CIDADE_EMPRESA=$ID_CIDADE, CH_PARECER=$CH_PARCER, DE_OBSERVACOES=$DE_OBSERVACOES, DT_VIST_FUNC=$DT_VISTORIA, ID_PROT_FUNC=$ID_PROT_FUNC, ID_USUARIO='$usuario', ID_VISTORIADOR = $ID_VISTORIADOR WHERE ID_VISTORIA_FUNC= $ID_VISTORIA_FUNC AND ID_CIDADE=$ID_CIDADE";
     }
     if ($query_vist_funcionamento!="") {
      $res= $conn->query($query_vist_funcionamento);
      if ($ID_VISTORIA_FUNC==0) {
        $ID_VISTORIA_FUNC=$conn->insert_id();
      }
      if ($conn->get_status()==false) {
        $ERRO_TRANS.= "Vistoria:\n".$conn->get_msg()."\n";
      }
    }

    if ($_POST["cmb_ch_tp_funcionamento"]=="T") {
      $ID_ESTABELECIMENTO=0;
      $query_edific="SELECT ID_EDIFICACAO, NM_EDIFICACAO, VL_AREA_CONSTRUIDA, NR_PAVIMENTOS FROM ".TBL_EDIFICACAO." WHERE ".TBL_EDIFICACAO.".ID_CIDADE=$ID_CIDADE AND ".TBL_EDIFICACAO.".ID_EDIFICACAO=$ID_EDIFICACAO";
      $conn->query($query_edific);
      $tupula=$conn->fetch_row();
      $NM_ESTABELECIMENTO=formataCampo($tupula["NM_EDIFICACAO"]);
      $NM_ESTABELECIMENTO_FONETICO=formataCampo(nr_txt_fonetica($tupula["NM_EDIFICACAO"]));
      $VL_AREA=formataCampo(str_replace(".",",",$tupula["VL_AREA_CONSTRUIDA"]),"D","D");
      $NR_PAVIMENTO=$tupula["NR_PAVIMENTOS"];
      $NM_BLOCO=formataCampo("TODOS");
      $query_estab="SELECT ID_ESTABELECIMENTO FROM ".TBL_ESTABELECIMENTO." WHERE NM_ESTABELECIMENTO=$NM_ESTABELECIMENTO AND ID_CIDADE=$ID_CIDADE AND ID_EDIFICACAO=$ID_EDIFICACAO";
      $conn->query($query_estab);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.= "cons_estabelecimento :\n".$conn->get_msg()."\n";
      }
      if ($conn->num_rows()>0) {
        $tupula=$conn->fetch_row();
        $ID_ESTABELECIMENTO=$tupula["ID_ESTABELECIMENTO"];
      }
      if ($ID_ESTABELECIMENTO!=0) {
        $query_estab="UPDATE ".TBL_ESTABELECIMENTO." SET NM_ESTABELECIMENTO=$NM_ESTABELECIMENTO, NM_ESTABELECIMENTO_FONETICO=$NM_ESTABELECIMENTO_FONETICO, VL_AREA=$VL_AREA, NR_PAVIMENTO=$NR_PAVIMENTO, NM_BLOCO=$NM_BLOCO, DT_CADASTRO=CURDATE() WHERE ".TBL_ESTABELECIMENTO.".ID_ESTABELECIMENTO=$ID_ESTABELECIMENTO AND ".TBL_ESTABELECIMENTO.".ID_CIDADE=$ID_CIDADE AND ".TBL_ESTABELECIMENTO.".ID_EDIFICACAO=$ID_EDIFICACAO";
      } else {
        $query_estab="INSERT INTO ".TBL_ESTABELECIMENTO." (ID_ESTABELECIMENTO, ID_EDIFICACAO, ID_CIDADE, NM_ESTABELECIMENTO, NM_ESTABELECIMENTO_FONETICO, VL_AREA, NR_PAVIMENTO, NM_BLOCO, DT_CADASTRO) VALUES ($ID_ESTABELECIMENTO, $ID_EDIFICACAO, $ID_CIDADE, $NM_ESTABELECIMENTO, $NM_ESTABELECIMENTO_FONETICO, $VL_AREA, $NR_PAVIMENTO, $NM_BLOCO, CURDATE())";
      $res= $conn->query($query_estab);
      }
      if ($conn->get_status()==false) {
        $ERRO_TRANS.= "estabelecimento :\n".$conn->get_msg()."\n";
      }
      if ($ID_ESTABELECIMENTO==0) {
        $ID_ESTABELECIMENTO=$conn->insert_id();
      }
      $query_vist_estab="SELECT ID_ESTABELECIMENTO FROM ".TBL_VIST_ESTAB." WHERE ".TBL_VIST_ESTAB.".ID_VISTORIA_FUNC=$ID_VISTORIA_FUNC AND ".TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA=$ID_CIDADE AND ".TBL_VIST_ESTAB.".ID_ESTABELECIMENTO=$ID_ESTABELECIMENTO AND ".TBL_VIST_ESTAB.".ID_EDIFICACAO=$ID_EDIFICACAO AND ".TBL_VIST_ESTAB.".ID_CIDADE_ESTAB=$ID_CIDADE";
      $res= $conn->query($query_vist_estab);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.= "estab_vist :\n".$conn->get_msg()."\n";
      }
      if ($conn->num_rows()!=1) {
        $query_vist_estab="INSERT INTO ".TBL_VIST_ESTAB." (ID_VISTORIA_FUNC, ID_CIDADE_VISTORIA, ID_ESTABELECIMENTO, ID_EDIFICACAO, ID_CIDADE_ESTAB) VALUES ($ID_VISTORIA_FUNC, $ID_CIDADE, $ID_ESTABELECIMENTO, $ID_EDIFICACAO, $ID_CIDADE)";
        $res= $conn->query($query_vist_estab);
        if ($conn->get_status()==false) {
          $ERRO_TRANS.= "estab_vist :\n".$conn->get_msg()."\n";
        }
      }
    } else {
      $query_vist_estab="DELETE FROM ".TBL_VIST_ESTAB." WHERE ID_VISTORIA_FUNC=$ID_VISTORIA_FUNC AND ID_CIDADE_VISTORIA=$ID_CIDADE";
      $res= $conn->query($query_vist_estab);
      if ($conn->get_status()==false) {
        $ERRO_TRANS.= "estab_vist DELETE:\n".$conn->get_msg()."\n";
      }
      for ($i=0;$i<count($nm_estab);$i++) {
        if (($nm_estab[$i]=="") || ($vl_vist_estab[$i]=="")) {
          break;
        }
        if (@$id_estab[$i]=="") {
          $id_estab[$i]=0;
        }
        $ID_ESTABELECIMENTO=$id_estab[$i];
        $NM_ESTABELECIMENTO=formataCampo($nm_estab[$i]);
        $NM_ESTABELECIMENTO_FONETICO=formataCampo(nr_txt_fonetica($nm_estab[$i]));
        $VL_AREA=formataCampo($vl_vist_estab[$i],"D","D");
        $NR_PAVIMENTO=0;
        $NM_BLOCO=formataCampo($nm_bloco[$i]);
        $query_estab="SELECT ID_ESTABELECIMENTO FROM ".TBL_ESTABELECIMENTO." WHERE ID_EDIFICACAO=$ID_EDIFICACAO AND ID_CIDADE=$ID_CIDADE AND NM_ESTABELECIMENTO=$NM_ESTABELECIMENTO LIMIT 1";
        $conn->query($query_estab);
        if ($conn->get_status()==false) {
          $ERRO_TRANS.= "select estabelecimento $i:\n".$conn->get_msg()."\n";
        }
        if ($conn->num_rows()>0) {
          $tupula=$conn->fetch_row();
          $ID_ESTABELECIMENTO=$tupula["ID_ESTABELECIMENTO"];
          $query_estab="UPDATE ".TBL_ESTABELECIMENTO." SET NM_ESTABELECIMENTO=$NM_ESTABELECIMENTO, NM_ESTABELECIMENTO_FONETICO=$NM_ESTABELECIMENTO_FONETICO, VL_AREA=$VL_AREA, NR_PAVIMENTO=$NR_PAVIMENTO, NM_BLOCO=$NM_BLOCO, DT_CADASTRO=CURDATE() WHERE ID_ESTABELECIMENTO=$ID_ESTABELECIMENTO AND ID_EDIFICACAO=$ID_EDIFICACAO AND ID_CIDADE=$ID_CIDADE";
        } else {
          $ID_ESTABELECIMENTO=0;
          $query_estab="INSERT INTO ".TBL_ESTABELECIMENTO." (ID_ESTABELECIMENTO, ID_EDIFICACAO, ID_CIDADE, NM_ESTABELECIMENTO, NM_ESTABELECIMENTO_FONETICO, VL_AREA, NR_PAVIMENTO, NM_BLOCO, DT_CADASTRO) VALUES ($ID_ESTABELECIMENTO, $ID_EDIFICACAO, $ID_CIDADE, $NM_ESTABELECIMENTO, $NM_ESTABELECIMENTO_FONETICO, $VL_AREA, $NR_PAVIMENTO, $NM_BLOCO, CURDATE())";
        }
        $res= $conn->query($query_estab);
        if ($conn->get_status()==false) {
          $ERRO_TRANS.= "estabelecimento $i:\n".$conn->get_msg()."\n";
        }
        if ($ID_ESTABELECIMENTO==0) {
          $ID_ESTABELECIMENTO=$conn->insert_id();
        }
        $query_vist_estab="REPLACE INTO ".TBL_VIST_ESTAB." (ID_VISTORIA_FUNC, ID_CIDADE_VISTORIA, ID_ESTABELECIMENTO, ID_EDIFICACAO, ID_CIDADE_ESTAB) VALUES ($ID_VISTORIA_FUNC, $ID_CIDADE, $ID_ESTABELECIMENTO, $ID_EDIFICACAO, $ID_CIDADE)";
        $res= $conn->query($query_vist_estab);
        if ($conn->get_status()==false) {
          $ERRO_TRANS.= "estab_vist $i:\n".$conn->get_msg()."\n";
        }
      }
    }

    if ($ERRO_TRANS!="") {
      die("CONTATE O ADMINISTRADOR!!\n".$ERRO_TRANS);
      $query_trans="ROLLBACK";
      $conn->query($query_trans);
      mysql_query($query_trans);
    } else {
      $conn->query($query_trans);
      $ID_CODIGO_RETORNO=$ID_VISTORIA_FUNC;
      $query_pgto="SELECT ".TBL_COB_BOLETO.".DT_PAGAMENTO FROM ".TBL_COB_BOLETO." WHERE ID_PROT_FUNC=$ID_PROT_FUNC AND ID_CIDADE=$ID_CIDADE AND DT_PAGAMENTO IS NULL";
      $conn->query($query_pgto);
      if ($conn->get_status()==false) {
        die("Atual cob:".$conn->get_msg());
      }
      $flg_pgto=1;
      if ($conn->num_rows()>0) {
        $flg_pgto=0;
      }
      $query_pgto="SELECT ".TBL_COB_BOLETO.".ID_PROT_FUNC FROM ".TBL_COB_BOLETO." WHERE ID_PROT_FUNC=$ID_PROT_FUNC AND ID_CIDADE=$ID_CIDADE AND ID_CNPJ_CPF IS NULL";
      $conn->query($query_pgto);
      if ($conn->num_rows()>0) {
        $query_pgto="UPDATE ".TBL_COB_BOLETO." SET ID_CNPJ_CPF=$ID_CNPJ_EMPRESA, ID_CIDADE_PESSOA=$ID_CIDADE WHERE ID_CIDADE=$ID_CIDADE AND ID_PROT_FUNC=$ID_PROT_FUNC";
        $conn->query($query_pgto);
        if ($conn->get_status()==false) {
          die("Atual pessoa:".$conn->get_msg());
        }
      }

?>

<form name="form_index" method="post">
  <input type="hidden" name="op_menu" value="">
</form>


<script language="javascript" type="text/javascript">//<!--

window.confirm("O Funcionamento para o Protocolo <?=$ID_PROT_FUNC?> foi deferido com Sucesso!");
 
f = document.form_index;
f.op_menu.value='index';
f.submit();

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

    function consultaReg(campo1,campo2) {
      if ((campo1.value!="") && (campo2.value!="")) {
        window.open("./modulos/funcionamento/cons_vist_funcionamento.php?campo1="+campo1.value+"&campo2="+campo2.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.txt_id_prot_funcionamento.readOnly=false;
      frm.cmb_ch_tp_funcionamento.value="T";
      muda_desc_tp(frm.cmb_ch_tp_funcionamento);
    }
    function verpend(campo) {
      if (campo.value!="") {
        document.frm_vist_funcionamento.txa_mtv_indeferimento.disabled=false;
        document.frm_vist_funcionamento.txa_mtv_indeferimento.value="";
        if (campo.value=="I") {
          document.frm_vist_funcionamento.hdn_mtv_indeferimento.value=document.frm_vist_funcionamento.txa_mtv_indeferimento.value;
          document.frm_vist_funcionamento.txt_obs.value="Motivo do Indeferimento";
        } else {
          document.frm_vist_funcionamento.hdn_mtv_indeferimento.value="1";
          document.frm_vist_funcionamento.txt_obs.value="Observa��o";
        }
        document.frm_vist_funcionamento.txa_mtv_indeferimento.focus();
      } else {
        document.frm_vist_funcionamento.txa_mtv_indeferimento.disabled=true;
      }
    }
    function verfica_textarea(campo) {
      if (document.frm_vist_funcionamento.cmb_ch_parecer.value=="I") {
        document.frm_vist_funcionamento.hdn_mtv_indeferimento.value=campo.value;
      }
    }
    function envia_cons_ed() {
      var frm_ed = document.frm_vist_funcionamento;
      window.open("./modulos/edificacoes/consulta_edif.php?hdn_id_cidade="+frm_ed.hdn_id_cidade.value+"&form_padrao=frm_vist_funcionamento","cons_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=500,innerwidth=780,innerheight=500")
    }

    function carrega_desc(camp_desc) {
      var dfrm=document.frm_vist_funcionamento;
      if (camp_desc.value!="") {
        dfrm.hdn_id_desc_funcionamento_tmp.value=camp_desc.value;
        var indice_car=camp_desc.value-1;
        var nomes=dfrm.hdn_nm_desc_funcionamento.value.split("^");
        var valores=dfrm.hdn_vl_desc_funcionamento.value.split("^");
        var blocos=dfrm.hdn_nm_bloco_desc_funcionamento.value.split("^");
        dfrm.txt_nm_desc_funcionamento_tmp.value=nomes[indice_car];
        dfrm.txt_vl_desc_funcionamento_tmp.value=valores[indice_car];
        dfrm.txt_nm_bloco_desc_funcionamento_tmp.value=blocos[indice_car];
        dfrm.btn_incluir_desc.disabled=false;
        dfrm.btn_incluir_desc;
        dfrm.btn_incluir_desc.disabled=true;
        dfrm.btn_excluir_desc.disabled=false;
        dfrm.btn_excluir_desc;
      } else {
        dfrm.txt_nm_desc_funcionamento_tmp.value="";
        dfrm.txt_vl_desc_funcionamento_tmp.value="";
        dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";
        dfrm.hdn_id_desc_funcionamento_tmp.value="";
        dfrm.btn_incluir_desc.disabled=false;
        dfrm.btn_incluir_desc;
        dfrm.btn_incluir_desc.disabled=true;
        dfrm.btn_excluir_desc.disabled=false;
        dfrm.btn_excluir_desc;
        dfrm.btn_excluir_desc.disabled=true;
      }
    }
    function insere_desc() {
      var dfrm=document.frm_vist_funcionamento;
      var nomes=dfrm.hdn_nm_desc_funcionamento.value.split("^");
      for (var i=0; i<nomes.length; i++) {
        if (nomes[i]==dfrm.txt_nm_desc_funcionamento_tmp.value) {
          alert("Nome da Refer�ncia j� Existe!!");
          return;
        }
      }
      sec_cmb_desc_funcionamento=dfrm.cmb_desc_funcionamento.options.length++;
      dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text=dfrm.txt_nm_desc_funcionamento_tmp.value;
      dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value=sec_cmb_desc_funcionamento;
      dfrm.hdn_nm_desc_funcionamento.value+=dfrm.txt_nm_desc_funcionamento_tmp.value+"^";
      dfrm.hdn_vl_desc_funcionamento.value+=dfrm.txt_vl_desc_funcionamento_tmp.value+"^";
      dfrm.hdn_nm_bloco_desc_funcionamento.value+=dfrm.txt_nm_bloco_desc_funcionamento_tmp.value+"^";
      dfrm.txt_nm_desc_funcionamento_tmp.value="";
      dfrm.txt_vl_desc_funcionamento_tmp.value="";
      dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";
      dfrm.txt_nm_desc_funcionamento_tmp.focus();
      dfrm.btn_incluir_desc.disabled=false;
      dfrm.btn_incluir_desc;
      dfrm.btn_incluir_desc.disabled=true;
    }
    function exclui_desc() {
      var dfrm=document.frm_vist_funcionamento;
      var indice_excluido=dfrm.hdn_id_desc_funcionamento_tmp.value;
      var sec_cmb_desc_funcionamento="";
      if (dfrm.cmb_desc_funcionamento.value!="") {
        dfrm.cmb_desc_funcionamento.options.length=0;
        sec_cmb_desc_funcionamento=dfrm.cmb_desc_funcionamento.options.length++;
        dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text="__________________";
        dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value="";
        var nomes=dfrm.hdn_nm_desc_funcionamento.value.split("^");
        var valores=dfrm.hdn_vl_desc_funcionamento.value.split("^");
        var blocos=dfrm.hdn_nm_bloco_desc_funcionamento.value.split("^");
        dfrm.hdn_nm_desc_funcionamento.value="";
        dfrm.hdn_vl_desc_funcionamento.value="";
        dfrm.hdn_nm_bloco_desc_funcionamento.value="";
        dfrm.txt_nm_desc_funcionamento_tmp.value="";
        dfrm.txt_vl_desc_funcionamento_tmp.value="";
        dfrm.txt_nm_bloco_desc_funcionamento_tmp.value="";
        for (var i=0; i<nomes.length;i++) {
          if ((i!=(dfrm.hdn_id_desc_funcionamento_tmp.value-1)) && (nomes[i]!="")) {
            sec_cmb_desc_funcionamento=dfrm.cmb_desc_funcionamento.options.length++;
            dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text=nomes[i];
            dfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value=sec_cmb_desc_funcionamento;
            dfrm.hdn_nm_desc_funcionamento.value+=nomes[i]+"^";
            dfrm.hdn_vl_desc_funcionamento.value+=valores[i]+"^";
            dfrm.hdn_nm_bloco_desc_funcionamento.value+=blocos[i]+"^";
          }
        }
        valida_sum_desc();
        dfrm.btn_incluir_desc.disabled=false;
        dfrm.btn_incluir_desc;
        dfrm.btn_excluir_desc.disabled=false;
        dfrm.btn_excluir_desc;
        dfrm.btn_excluir_desc.disabled=true;
      }
    }
    function muda_desc() {
      var vfrm=document.frm_vist_funcionamento;
      var sec_cmb_desc_funcionamento="";
      if ((vfrm.txt_nm_desc_funcionamento_tmp.value!="") && (vfrm.txt_vl_desc_funcionamento_tmp.value!="")) {
        vfrm.btn_incluir_desc.disabled=false;
        vfrm.btn_incluir_desc;
      } else {
          vfrm.btn_incluir_desc.disabled=false;
          vfrm.btn_incluir_desc;
          vfrm.btn_incluir_desc.disabled=true;
          vfrm.btn_excluir_desc.disabled=false;
          vfrm.btn_excluir_desc;
          vfrm.btn_excluir_desc.disabled=true;
      }
    }
    function muda_desc_tp(tp_vist) {
      var vfrm=document.frm_vist_funcionamento;
      var sec_cmb_desc_funcionamento="";
      if (tp_vist.value=="P") {
        vfrm.cmb_desc_funcionamento.disabled=false;
        vfrm.txt_nm_desc_funcionamento_tmp.disabled=false;
        vfrm.txt_nm_bloco_desc_funcionamento_tmp.disabled=false;
        vfrm.txt_vl_desc_funcionamento_tmp.disabled=false;
      } else {
        vfrm.txt_vl_area_vistoriada.value=vfrm.txt_vl_area_construida.value;
        var sec_cmb_desc_funcionamento="";
        vfrm.cmb_desc_funcionamento.options.length=0;
        sec_cmb_desc_funcionamento=vfrm.cmb_desc_funcionamento.options.length++;
        vfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].text="__________________";
        vfrm.cmb_desc_funcionamento.options[sec_cmb_desc_funcionamento].value="";
        vfrm.cmb_desc_funcionamento.disabled=true;
        vfrm.txt_nm_desc_funcionamento_tmp.disabled=true;
        vfrm.txt_nm_bloco_desc_funcionamento_tmp.disabled=true;
        vfrm.txt_vl_desc_funcionamento_tmp.disabled=true;
        vfrm.hdn_nm_desc_funcionamento.value="";
        vfrm.hdn_vl_desc_funcionamento.value="";
        vfrm.hdn_nm_bloco_desc_funcionamento.value="";
        vfrm.btn_incluir_desc.disabled=false;
        vfrm.btn_incluir_desc;
        vfrm.btn_incluir_desc.disabled=true;
        vfrm.btn_excluir_desc.disabled=false;
        vfrm.btn_excluir_desc;
        vfrm.btn_excluir_desc.disabled=true;
      }
    }

    function valida_desc_func() {
      var vfrm=document.frm_vist_funcionamento;
      var desc_erro="";
      var valores_desc_calc=document.frm_vist_funcionamento.hdn_vl_desc_funcionamento.value;
      var vl_vist=0;
      var valor_tmp=document.frm_vist_funcionamento.txt_vl_desc_funcionamento_tmp.value;
      var vl_tot=document.frm_vist_funcionamento.txt_vl_area_construida.value;
      while (vl_tot.indexOf(".")>-1) {
        vl_tot=vl_tot.replace(".","");
      }
      while (vl_tot.indexOf(",")>-1) {
        vl_tot=vl_tot.replace(",",".");
      }
      while (valor_tmp.indexOf(".")>-1) {
        valor_tmp=valor_tmp.replace(".","");
      }
      while (valor_tmp.indexOf(",")>-1) {
        valor_tmp=valor_tmp.replace(",",".");
      }
      while (valores_desc_calc.indexOf(".")>-1) {
        valores_desc_calc=valores_desc_calc.replace(".","");
      }
      while (valores_desc_calc.indexOf(",")>-1) {
        valores_desc_calc=valores_desc_calc.replace(",",".");
      }
      var valores_desc=valores_desc_calc.split("^");
      for (var i=0; i<valores_desc.length; i++) {
        if (!isNaN(parseFloat(valores_desc[i]))) {
          vl_vist=parseFloat(vl_vist)+parseFloat(valores_desc[i]);
        }
      }
      if (isNaN(parseFloat(vl_tot))) {
        vl_tot=-9999999.99;
      }
      if (isNaN(vl_vist)) {
        vl_vist=parseFloat(valor_tmp);
      } else {
        vl_vist=parseFloat(vl_vist)+parseFloat(valor_tmp);
      }
      if (vfrm.txt_nm_desc_funcionamento_tmp.value=="") {
        desc_erro="=> N� ou Refer�ncia da Sala\n";
      }
      if (vfrm.txt_vl_desc_funcionamento_tmp.value=="") {
        desc_erro+="=> Valor da �rea\n";
      }
      if (parseFloat(vl_tot)<parseFloat(vl_vist)) {
        desc_erro+="=> �rea de Vistoria MENOR que �rea Constru�da\n";
        vl_vist=vl_vist+"";
      }
      if (desc_erro!="") {
        alert("Os campos s�o Obrigat�rios!\n"+desc_erro+"Verifique!!!");
      } else {
        insere_desc();
        valida_sum_desc();
      }
    }
    function valida_sum_desc() {
      var vfrm=document.frm_vist_funcionamento;
      var desc_erro="";
      var valores_desc_calc=document.frm_vist_funcionamento.hdn_vl_desc_funcionamento.value;
      var vl_vist=0;
      var valor_tmp=document.frm_vist_funcionamento.txt_vl_desc_funcionamento_tmp.value;
      var vl_tot=document.frm_vist_funcionamento.txt_vl_area_construida.value;
      while (vl_tot.indexOf(".")>-1) {
        vl_tot=vl_tot.replace(".","");
      }
      while (vl_tot.indexOf(",")>-1) {
        vl_tot=vl_tot.replace(",",".");
      }
      while (valor_tmp.indexOf(".")>-1) {
        valor_tmp=valor_tmp.replace(".","");
      }
      while (valor_tmp.indexOf(",")>-1) {
        valor_tmp=valor_tmp.replace(",",".");
      }
      while (valores_desc_calc.indexOf(".")>-1) {
        valores_desc_calc=valores_desc_calc.replace(".","");
      }
      while (valores_desc_calc.indexOf(",")>-1) {
        valores_desc_calc=valores_desc_calc.replace(",",".");
      }
      var valores_desc=valores_desc_calc.split("^");
      for (var i=0; i<valores_desc.length; i++) {
        if (!isNaN(parseFloat(valores_desc[i]))) {
          vl_vist=parseFloat(vl_vist)+parseFloat(valores_desc[i]);
        }
      }
      if (isNaN(parseFloat(vl_tot))) {
        vl_tot=-9999999.99;
      }
      if (isNaN(vl_vist)) {
        alert(vl_vist);
        vl_vist=parseFloat(valor_tmp);
      }
      if ((parseFloat(vl_tot)-parseFloat(vl_vist))<0) {
        vfrm.btn_incluir;
        vfrm.btn_incluir.disabled=true;
        vl_vist=vl_vist+"";
        vfrm.txt_vl_area_vistoriada.value=vl_vist.replace(".",",");
        FormatNumero(vfrm.txt_vl_area_vistoriada);
        decimal(vfrm.txt_vl_area_vistoriada,2);
        if ((parseFloat(vl_tot)!=(-9999999.99)) && (parseFloat(vl_vist)!=0)) {
          alert("Valor de Vistoria � MAIOR que a �rea Constru�da");
        }
      } else {
        vfrm.btn_incluir.disabled=false;
        vfrm.btn_incluir;
        vl_vist=vl_vist+"";
        vfrm.txt_vl_area_vistoriada.value=vl_vist.replace(".",",");
        FormatNumero(vfrm.txt_vl_area_vistoriada);
        decimal(vfrm.txt_vl_area_vistoriada,2);
      }
    }
    function envia(edificacao) {
      var frm_ed = document.frm_vist_funcionamento;
      if (edificacao==0) {
        window.open("./edificacao.php?hdn_id_solicitacao="+frm_ed.hdn_id_sol_funcionamento.value+"&hdn_id_cidade="+frm_ed.hdn_id_cidade.value+"&hdn_id_tipo_solicitacao="+frm_ed.hdn_id_tp_sol_funcionamento.value+"&form_padrao=frm_vist_funcionamento","cad_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=550,innerwidth=780,innerheight=550");
      } else {
        window.open("./edificacao.php?hdn_id_cidade="+frm_ed.hdn_id_cidade.value+"&hdn_id_edificacao="+edificacao+"&form_padrao=frm_vist_funcionamento","cad_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=550,innerwidth=780,innerheight=550")

      }
    }

//--></script>
<body onload="ajustaspan();valida_sum_desc();">
       <form target="_self" enctype="multipart/form-data" method="post" name="frm_vist_funcionamento" onreset="retorna(this)" onsubmit="return validaForm(this,<?=$campos_js?>)">
        <?
         if ((@$_POST["hdn_id_protocolo"]=="") && (@$_POST["hdn_id_cidade"]=="") ){
          $alter=true;
         } else {
          $alter=false;
         }
        ?>

<input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">
          <table width="100%" cellspacing="2" border="0" cellpadding="2">
              <tr>
                <td>
                  <fieldset>
                    <legend>Cadastro de Vistoria de Funcionamento</legend>
                    <table width="100%" cellspacing="2" border="0" cellpadding="2">
                      <tr>
                        <td colspan="2">
                          <table width="100%" cellspacing="2" border="0" cellpadding="2">
                            <tr>
                              <td align="left">Protocolo
                                  <?
                                    if (!$alter) {
                                  ?>
                                    <input type="hidden" name="hdn_id_cidade" value="">
                                  <?
                                    }
                                  ?>
                                  <input type="hidden" name="hdn_id_sol_funcionamento" value="">
                                  <input type="hidden" name="hdn_id_tp_sol_funcionamento" value="">
                                  <input type="hidden" name="hdn_id_vist_func" value="">
                                  <input type="text" name="txt_id_prot_funcionamento" class="campo_obr" size="15" maxlength="11" value="" title="N�mero do Protocolo">

				<? if ($alter) { ?>

				      <select name="hdn_id_cidade" value="" class="campo_obr"  onblur="consultaReg(document.frm_vist_funcionamento.hdn_id_cidade,document.frm_vist_funcionamento.txt_id_prot_funcionamento)">
					<option value="">SELECIONE A CIDADE</option>
					<?
							      $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_USUARIO ='".$usuario."' ORDER BY NM_CIDADE";
					  $res = $conn->query($sql);
					  if ($conn->get_status()==false) die($conn->get_msg());
					  while ($tupla = $conn->fetch_row()) {
						      ?> <option value="<?=$tupla["ID_CIDADE"]?>"><?=$tupla["NM_CIDADE"]?></option> <?
					  }
					?>
				      </select>
				  </td>
				<? } ?>


                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                        <fieldset>
                          <legend>Solicitante</legend>
                          <table width="100%" cellspacing="2" border="0" cellpadding="2">
                            <tr>
                              <td align="right">CNPJ</td>
                              <td><input type="text" name="txt_nr_cnpj_empresa" class="campo_obr" title="CNPJ/CPF do Solicitante" size="30" value="" onblur="cpfcnpj(this)"></td>
                              <td align="right">Raz�o Social</td>
                              <td><input type="text" name="txt_nm_razao_social" class="campo_obr" title="Nome do Solicitante do Projeto" size="61" value="" maxlength="100"></td>
                            </tr>
                            <tr>
                              <td align="right" nowrap="true">Nome Fantasia</td>
                              <td>
                                <input type="text" name="txt_nm_fantasia_empresa" class="campo" size="25" maxlength="100" title="Nome Fantasia da Empresa Solicitante">
                              </td>
                              <td align="right">Contato</td>
                              <td>
                                <input type="text" name="txt_nm_contato" class="campo" size="52" maxlength="100" title="Nome da Pessoa de Contato da Empresa Solcitante">
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Fone</td>
                              <td><input type="text" name="txt_nr_fone_empresa" class="campo_obr" title="Fone do Solicitante" size="30" value=""></td>
                              <td align="right">E-mail</td>
                              <td><input type="text" name="txt_de_email_empresa" class="campo_obr" title="E-mail do Solicitante do Projeto" size="61" value="" style="text-transform : none;" maxlength="100"></td>
                            </tr>
                          </table>
                        </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                        <fieldset>
                          <legend>Edifica��o</legend>
                          <table width="100%" cellspacing="2" border="0" cellpadding="2">
                            <tr>
                              <td align="right">RE</td>
                              <td><input type="text" name="txt_id_edificacao" size="20" class="campo_obr" title="RE da Edifica��o" value="" maxlength="15" align="right" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)"></td>
                              <td align="right">Nome</td>
                              <td><input type="text" name="txt_nm_edificacao" size="61" class="campo_obr" title="Nome da Edifica��o" value="" readOnly="true"></td>
                            </tr>
                            <tr>
                              <td align="right">Tipo</td>
                              <td>
                                <input type="hidden" name="hdn_id_tp_logradouro" value="">
                                <input type="text" name="txt_nm_tp_logradouro" size="20" class="campo_obr" title="Tipo do Logradouro" value="" readOnly="true">
                              </td>
                              <td align="right">Logradouro</td>
                              <td>
                                <input type="text" size="61" class="campo_obr" value="" name="txt_nm_logradouro" title="Nome do Logradouro" maxlength="100" readOnly="true">
                              </td>
                            </tr>
                            <tr>
                              <td align="right">N�</td>
                              <td><input type="text" size="20" maxlength="5" name="txt_nr_edificacao" align="right" class="campo_obr" title="N�mero da Edifica��o no Logradouro" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)" readOnly="true"></td>
                              <td align="right">Bairro</td>
                              <td><input type="text" size="61" maxlength="50" value="" name="txt_nm_bairro" class="campo_obr" title="Nome do Bairro" readOnly="true"></td>
                            </tr>
                            <tr>
                              <td align="right">CEP</td>
                              <td><input type="text" size="20" maxlength="10" name="txt_id_cep" value="" class="campo_obr" title="N�mero do CEP" onkeypress="return validaTecla(this, event, 'n')" onblur="CEP(this)" readOnly="true"></td>
                              <td align="right">Cidade</td>
                              <td>
                                <input type="text" name="txt_nm_cidade" size="61" class="campo_obr" title="Cidade" value="" readOnly="true">
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Complemento</td>
                              <td><input type="text" name="txt_nm_complemento" class="campo" size="30" maxlength="100" value="" title="Complemento do Endere�o da Edifica��o" readOnly="true"></td>
                              <td colspan="2">
                                <center>
                                  <input name="btn_edificacao" type="button" value="Edifica��o" class="botao"  onClick="envia_cons_ed()">
                                </center>
                              </td>
                             </tr>
                             <tr>
                              <td>�rea Construida</td>
                              <td>
                              <input type="text" align="right" name="txt_vl_area_construida" class="campo_obr" title="Valor da �rea Total Construida da Edifica��o" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)" readOnly="true" value="" size="20"><em>(m�)</em>
                              </td>
                              <td align="right" nowrap="true">�rea Vistoriada</td>
                              <td colspan="3">
                              <input type="text" align="right" name="txt_vl_area_vistoriada" class="campo_obr" title="Valor da �rea Vistoriada da Edifica��o" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)" readOnly="true" size="20"><em>(m�)</em>
                              </td>
                            </tr>
                          </table>
                        </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <fieldset>
                            <legend>�rea de Vistoria</legend>
                            <table width="100%" cellspacing="2" border="0" cellpadding="2">
                              <tr>
                                <td align="right" nowrap="true">Tipo de Vistoria</td>
                                <td>
                                  <select name="cmb_ch_tp_funcionamento" class="campo_obr" onChange="muda_desc_tp(this)">
                                    <option value="T" selected>TODA A EDIFICA��O</option>
                                    <option value="P">PARCIAL</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td align="right" nowrap="true">Salas Cadastradas</td>
                                <td>
                                  <select name="cmb_desc_funcionamento" class="campo" onChange="carrega_desc(this)" disabled="true">
                                    <option value="">__________________</option>
                                  </select>
                                  <input type="hidden" name="hdn_id_estab" value="">
                                  <input type="hidden" name="hdn_nm_desc_funcionamento" value="">
                                  <input type="hidden" name="hdn_vl_desc_funcionamento" value="">
                                  <input type="hidden" name="hdn_nm_bloco_desc_funcionamento" value="">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                  <table width="100%" cellspacing="2" border="0" cellpadding="2">
                                    <tr>
                                      <td align="right" nowrap="true">Local a Ser Vistoriado</td>
                                      <td colspan="2">
                                        <input type="hidden" name="hdn_id_desc_funcionamento_tmp" value="">
                                        <input type="text" name="txt_nm_desc_funcionamento_tmp" class="campo_obr" size="30" maxlength="50" value="" onkeyup="muda_desc()" disabled="true">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="right">Complemento</td>
                                      <td colspan="2">
                                        <input type="text" name="txt_nm_bloco_desc_funcionamento_tmp" class="campo" size="25" maxlength="50" value="" disabled="true">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="right">�rea</td>
                                      <td>
                                        <input type="text" name="txt_vl_desc_funcionamento_tmp" class="campo_obr" size="30" maxlength="50" align="right" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this);muda_desc();" onblur="decimal(this,2)" value="" disabled="true">
                                        <em>(m�)</em>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" align="center">
                                        <input type="button" name="btn_incluir_desc" value="Incluir" class="botao"  disabled="true" onClick="valida_desc_func()">&nbsp;
                                        <input type="button" name="btn_excluir_desc" value="Excluir" class="botao"  disabled="true" onClick="exclui_desc()">
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <fieldset>
                          <legend>Vistoria</legend>
                            <table width="100%" cellspacing="2" border="0" cellpadding="2">
                              <tr>
                                <td align="right">Vistoriador</td>
                                <td>
                        <?
                          $query_usuario="SELECT NM_USUARIO FROM ".TBL_USUARIO." WHERE ID_USUARIO='$usuario'";
                          $conn->query($query_usuario);
                          $fetch_usuario=$conn->fetch_row();
 			
                        ?>
                                  <input type="text" name="txt_nm_usuario" size="65" class="campo_obr" title="Nome do Analista" value="<?=$fetch_usuario["NM_USUARIO"]?>" readOnly="true">
                                </td>
                              </tr>
                              	<tr>
				<td align="right">Vistoriador</td>

                                    <td>
                                      <select name="cmb_vistoriador" class="campo_obr">
                                        <option value="">_______________________________________________________________</option>
                                            <?

                                              $sql= "SELECT ".TBL_CIDADES_USR.".ID_USUARIO, ".TBL_USUARIO.".NM_USUARIO FROM ".TBL_CIDADES_USR." JOIN ".TBL_USUARIO." USING (ID_USUARIO) WHERE ".TBL_CIDADES_USR.".ID_CIDADE = '$_POST[hdn_id_cidade]' order by ".TBL_USUARIO.".NM_USUARIO";

                                              $res= $conn->query($sql);

                                               if ($conn->get_status()==false) die($conn->get_msg());
                                              while ($tupula = $conn->fetch_row()) {
						if ($usuario == $tupula['ID_USUARIO']) $sel = 'selected="selected"'; else $sel = null;
											?>
                                        <option value="<?=$tupula['ID_USUARIO']?>" <?=$sel?> ><?=$tupula['NM_USUARIO']?></option>
								<? } ?>
                                      </select>

                                    </td>
				</tr>
			  <tr>
                                <td align="right">Parecer</td>
                                <td>
                                  <select name="cmb_ch_parecer" class="campo_obr" onchange="verpend(this)">
                                    <option value="">__________________</option>
                                    <option value="D">Deferido</option>
                                    <option value="I">Indeferido</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2"><input type="text" size="30" name="txt_obs" style="border-bottom-color : #ffffff; border-bottom-style : solid; border-left-color : #ffffff; border-left-style : solid; border-right-color : #ffffff; border-right-style : solid; border-top-color : #ffffff; border-top-style : solid; font-family : Verdana, Geneva, Arial, Helvetica, sans-serif; font-size : 12px;" value="Observa��o" readOnly="true"><br>
                                  <input type="hidden" name="hdn_mtv_indeferimento" value="">
                                  <textarea name="txa_mtv_indeferimento" cols="125" rows="5" class="campo" disabled="true" style="text-transform : none;" onblur="verfica_textarea(this)"></textarea>
                                </td>
                              </tr>
                            </table>
                          </fieldset>
                        </td>
                      </tr>

 <?
  include('./templates/btn_inc.htm');
?>
                    </table>
<?
 if ((@$_POST["hdn_id_protocolo"]!="") && (@$_POST["hdn_id_cidade"]!="") ){
   if(!isset($_POST["hdn_pendencia"])) {
    $sql= "SELECT ".TBL_PROT_FUNC.".ID_PROT_FUNC, ".TBL_PROT_FUNC.".ID_CIDADE, ".TBL_PROT_FUNC.".VL_VISTORIA,
            ".TBL_SOL_FUNC.".ID_SOLIC_FUNC, ".TBL_SOL_FUNC.".ID_TP_FUNC, ".TBL_SOL_FUNC.".CH_PAGO,
            ".TBL_SOL_FUNC.".CH_TP_FUNC, ".TBL_SOL_FUNC.".NR_CNPJ_EMPRESA, ".TBL_SOL_FUNC.".NM_RAZAO_SOCIAL,
            ".TBL_SOL_FUNC.".NM_FANTASIA_EMPRESA, ".TBL_SOL_FUNC.".NM_CONTATO, ".TBL_SOL_FUNC.".NR_FONE_EMPRESA,
            ".TBL_SOL_FUNC.".DE_EMAIL_EMPRESA, ".TBL_SOL_FUNC.".NM_EDIFICACOES, ".TBL_SOL_FUNC.".NM_FANTASIA,
            ".TBL_SOL_FUNC.".NM_LOGRADOURO, ".TBL_SOL_FUNC.".NR_EDIFICACOES, ".TBL_SOL_FUNC.".NR_CEP,
            ".TBL_SOL_FUNC.".NM_BAIRRO, ".TBL_SOL_FUNC.".NM_COMPLEMENTO, ".TBL_SOL_FUNC.".VL_AREA_CONSTRUIDA,
            ".TBL_SOL_FUNC.".CH_PROTOCOLADO, ".TBL_SOL_FUNC.".DT_SOLICITACAO,".TBL_SOL_FUNC.".NR_PAVIMENTOS,
            ".TBL_SOL_FUNC.".NR_BLOCOS, ".TBL_DESC_FUNC.".ID_DESC_FUNC, ".TBL_DESC_FUNC.".NM_DESC_FUNC,
            ".TBL_DESC_FUNC.".NR_PAVIMENTO, ".TBL_DESC_FUNC.".NM_BLOCO, ".TBL_DESC_FUNC.".VL_AREA_DESC_FUNC,
            ".TBL_CIDADE.".NM_CIDADE, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO
       FROM ".TBL_PROT_FUNC."
  LEFT JOIN ".TBL_SOL_FUNC." ON(".TBL_PROT_FUNC.".ID_SOLIC_FUNC=".TBL_SOL_FUNC.".ID_SOLIC_FUNC
        AND ".TBL_PROT_FUNC.".ID_TP_FUNC=".TBL_SOL_FUNC.".ID_TP_FUNC
        AND ".TBL_PROT_FUNC.".ID_CIDADE=".TBL_SOL_FUNC.".ID_CIDADE)
  LEFT JOIN ".TBL_CIDADE." ON(".TBL_SOL_FUNC.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE)
  LEFT JOIN ".TBL_DESC_FUNC." ON (".TBL_SOL_FUNC.".ID_SOLIC_FUNC=".TBL_DESC_FUNC.".ID_SOLIC_FUNC
        AND ".TBL_SOL_FUNC.".ID_TP_FUNC=".TBL_DESC_FUNC.".ID_TP_FUNC
        AND ".TBL_SOL_FUNC.".ID_CIDADE=".TBL_DESC_FUNC.".ID_CIDADE)
  LEFT JOIN ".TBL_TP_LOGRADOURO." ON(".TBL_SOL_FUNC.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO)
      WHERE ".TBL_PROT_FUNC.".ID_CIDADE=".$_POST["hdn_id_cidade"]."
        AND ".TBL_PROT_FUNC.".ID_PROT_FUNC=".$_POST["hdn_id_protocolo"];
    
//       echo "$sql"; exit;
	} else {
      $sql=  $sql="SELECT ".TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC
             , ".TBL_VISTORIA_FUNC.".DE_OBSERVACOES
             , ".TBL_VISTORIA_FUNC.".CH_PARECER
             , ".TBL_PROT_FUNC.".ID_PROT_FUNC
             , ".TBL_PROT_FUNC.".ID_CIDADE
             , ".TBL_SOL_FUNC.".ID_SOLIC_FUNC
             , ".TBL_SOL_FUNC.".ID_TP_FUNC
             , ".TBL_VISTORIA_FUNC.".ID_CNPJ_EMPRESA AS NR_CNPJ_EMPRESA
             , ".TBL_SOL_FUNC.".CH_TP_FUNC
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
             , ".TBL_SOL_FUNC.".CH_PROTOCOLADO
             , ".TBL_SOL_FUNC.".DT_SOLICITACAO
             , ".TBL_EDIFICACAO.".NR_PAVIMENTOS
             , ".TBL_EDIFICACAO.".NR_BLOCOS
             , ".TBL_PROT_FUNC.".VL_VISTORIA
             , ".TBL_ESTABELECIMENTO.".ID_ESTABELECIMENTO
             , ".TBL_ESTABELECIMENTO.".NM_ESTABELECIMENTO AS NM_DESC_FUNC
             , ".TBL_ESTABELECIMENTO.".NR_PAVIMENTO
             , ".TBL_ESTABELECIMENTO.".NM_BLOCO
             , ".TBL_ESTABELECIMENTO.".VL_AREA AS VL_AREA_DESC_FUNC
             , ".TBL_CIDADE.".NM_CIDADE
             , ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO
          FROM ".TBL_VISTORIA_FUNC." LEFT JOIN ".TBL_PROT_FUNC." ON (".TBL_VISTORIA_FUNC.".ID_PROT_FUNC=".TBL_PROT_FUNC.".ID_PROT_FUNC AND ".TBL_VISTORIA_FUNC.".ID_CIDADE=".TBL_PROT_FUNC.".ID_CIDADE)
     LEFT JOIN ".TBL_PESSOA." ON (".TBL_VISTORIA_FUNC.".ID_CNPJ_EMPRESA=".TBL_PESSOA.".ID_CNPJ_CPF AND ".TBL_VISTORIA_FUNC.".ID_CIDADE_EMPRESA=".TBL_PESSOA.".ID_CIDADE)
     LEFT JOIN ".TBL_VIST_ESTAB." ON (".TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC=".TBL_VIST_ESTAB.".ID_VISTORIA_FUNC AND ".TBL_VISTORIA_FUNC.".ID_CIDADE=".TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA)
     LEFT JOIN ".TBL_ESTABELECIMENTO." ON (".TBL_VIST_ESTAB.".ID_ESTABELECIMENTO=".TBL_ESTABELECIMENTO.".ID_ESTABELECIMENTO AND ".TBL_VIST_ESTAB.".ID_EDIFICACAO=".TBL_ESTABELECIMENTO.".ID_EDIFICACAO AND ".TBL_VIST_ESTAB.".ID_CIDADE_ESTAB=".TBL_ESTABELECIMENTO.".ID_CIDADE)
     LEFT JOIN ".TBL_EDIFICACAO." ON (".TBL_ESTABELECIMENTO.".ID_EDIFICACAO=".TBL_EDIFICACAO.".ID_EDIFICACAO AND ".TBL_ESTABELECIMENTO.".ID_CIDADE=".TBL_EDIFICACAO.".ID_CIDADE)
     LEFT JOIN ".TBL_SOL_FUNC." ON(".TBL_PROT_FUNC.".ID_SOLIC_FUNC=".TBL_SOL_FUNC.".ID_SOLIC_FUNC AND ".TBL_PROT_FUNC.".ID_TP_FUNC=".TBL_SOL_FUNC.".ID_TP_FUNC AND ".TBL_PROT_FUNC.".ID_CIDADE=".TBL_SOL_FUNC.".ID_CIDADE)
     LEFT JOIN ".TBL_CIDADE." ON(".TBL_SOL_FUNC.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE)
     LEFT JOIN ".TBL_CEP." ON (".TBL_EDIFICACAO.".ID_CEP=".TBL_CEP.".ID_CEP AND ".TBL_EDIFICACAO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO AND ".TBL_EDIFICACAO.".ID_CIDADE_CEP=".TBL_CEP.".ID_CIDADE)
     LEFT JOIN ".TBL_LOGRADOURO." ON (".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE)
     LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE)
     LEFT JOIN ".TBL_TP_LOGRADOURO." ON(".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO)
     WHERE ".TBL_VISTORIA_FUNC.".ID_CIDADE=".$_POST["hdn_id_cidade"]." AND ".TBL_VISTORIA_FUNC.".ID_PROT_FUNC=".$_POST["hdn_id_protocolo"]." ORDER BY ".TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC DESC LIMIT 1";
    }
//         echo "$sql"; exit;
    $count=1;
    $conn->query($sql);
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }

    $row_solicita=$conn->num_rows();
    if ($row_solicita>0) {
      while ($solicitacao=$conn->fetch_row()) {

		foreach($solicitacao as $indice=>$registro) $aux[$indice] =  str_replace('"',' ',$registro);
		$solicitacao = $aux;

        if ($count==1) {
          $ID_EDIFICACAO       =@$solicitacao["ID_EDIFICACAO"];
          $ID_CIDADE           =$solicitacao["ID_CIDADE"];
          $NM_RAZAO_SOCIAL     =$solicitacao["NM_RAZAO_SOCIAL"];
          $NR_FONE_EMPRESA     =$solicitacao["NR_FONE_EMPRESA"];
          $NM_CONTATO          =$solicitacao["NM_CONTATO"];
          $NM_FANTASIA_EMPRESA =$solicitacao["NM_FANTASIA_EMPRESA"];
          $NR_CNPJ_EMPRESA     =$solicitacao["NR_CNPJ_EMPRESA"];
          $DE_EMAIL_EMPRESA    =$solicitacao["DE_EMAIL_EMPRESA"];
          $NM_EDIFICACOES      =$solicitacao["NM_EDIFICACOES"];
          $NM_LOGRADOURO       =$solicitacao["NM_LOGRADOURO"];
          $NR_EDIFICACAO       =$solicitacao["NR_EDIFICACOES"];
          $NM_BAIRRO           =$solicitacao["NM_BAIRRO"];
          $NR_CEP              =$solicitacao["NR_CEP"];
          $NM_CIDADE           =$solicitacao["NM_CIDADE"];
          $NM_COMPLEMENTO      =$solicitacao["NM_COMPLEMENTO"];
          $VL_AREA_CONSTRUIDA  =$solicitacao["VL_AREA_CONSTRUIDA"];
          $VL_VISTORIA         =$solicitacao["VL_VISTORIA"];
          $NM_CIDADE           =$solicitacao["NM_CIDADE"];
          $NM_TP_LOGRADOURO    =$solicitacao["NM_TP_LOGRADOURO"];
          $ID_TP_FUNC          =$solicitacao["ID_TP_FUNC"];
          $ID_SOLIC_FUNC       =$solicitacao["ID_SOLIC_FUNC"];
          $ID_PROT_FUNC        =$solicitacao["ID_PROT_FUNC"];
          $CH_TP_FUNC          =$solicitacao["CH_TP_FUNC"];


?>
<script language="javascript" type="text/javascript">//<!--
  var frm_at=document.frm_vist_funcionamento;
  frm_at.txt_id_prot_funcionamento.readOnly=true;
  frm_at.txt_id_prot_funcionamento.value="<?=$ID_PROT_FUNC?>";
  frm_at.hdn_id_tp_sol_funcionamento.value="<?=$ID_TP_FUNC?>";
  frm_at.hdn_id_sol_funcionamento.value="<?=$ID_SOLIC_FUNC?>";
  frm_at.txt_nm_razao_social.value="<?=$NM_RAZAO_SOCIAL?>";
  frm_at.txt_nm_razao_social.readOnly=true;
  frm_at.txt_nr_fone_empresa.value="<?=$NR_FONE_EMPRESA?>";
  frm_at.txt_nr_fone_empresa.readOnly=true;
  frm_at.txt_nr_cnpj_empresa.value="<?=$NR_CNPJ_EMPRESA?>";
  cpfcnpj(frm_at.txt_nr_cnpj_empresa);
  frm_at.txt_nr_cnpj_empresa.readOnly=true;
  frm_at.txt_de_email_empresa.value="<?=$DE_EMAIL_EMPRESA?>";
  frm_at.txt_de_email_empresa.readOnly=true;
  frm_at.txt_nm_contato.value="<?=$NM_CONTATO?>";
  frm_at.txt_nm_fantasia_empresa.value="<?=$NM_FANTASIA_EMPRESA?>";
  frm_at.txt_nm_edificacao.value="<?=$NM_EDIFICACOES?>";
  frm_at.txt_nm_edificacao.readOnly=true;
  frm_at.txt_nm_logradouro.value="<?=$NM_LOGRADOURO?>";
  frm_at.txt_nr_edificacao.value="<?=$NR_EDIFICACAO?>";
  frm_at.txt_id_edificacao.value="<?=$ID_EDIFICACAO?>";
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
  frm_at.txt_nm_tp_logradouro.value="<?=$NM_TP_LOGRADOURO?>";
  //frm_at.hdn_mtv_indeferimento.value=1;
  frm_at.txt_vl_area_vistoriada.value="<?=str_replace(".",",",$VL_VISTORIA)?>";
  FormatNumero(frm_at.txt_vl_area_vistoriada);
  decimal(frm_at.txt_vl_area_vistoriada,2);
  frm_at.cmb_ch_tp_funcionamento.value="<?=$CH_TP_FUNC?>";

<?
        $count=2;
      }
      $NM_DESC_FUNC     =$solicitacao["NM_DESC_FUNC"];
      $NM_BLOCO         =$solicitacao["NM_BLOCO"];
      $NR_PAVIMENTO     =$solicitacao["NR_PAVIMENTO"];
      $VL_AREA_DESC_FUNC=$solicitacao["VL_AREA_DESC_FUNC"];
      if ($CH_TP_FUNC=='P') {
?>
muda_desc_tp(frm_at.cmb_ch_tp_funcionamento);
frm_at.txt_nm_desc_funcionamento_tmp.value="<?=$NM_DESC_FUNC?>";
frm_at.txt_nm_bloco_desc_funcionamento_tmp.value="<?=$NM_BLOCO?>";
frm_at.txt_vl_desc_funcionamento_tmp.value="<?=str_replace(".",",",$VL_AREA_DESC_FUNC)?>";
FormatNumero(frm_at.txt_vl_desc_funcionamento_tmp);
decimal(frm_at.txt_vl_desc_funcionamento_tmp,2);
insere_desc()
<?
      }
    }
?>
  frm_at.txt_nr_cnpj_empresa.focus();
</script>
<?
  }

}
?>
                  </fieldset>
                </td>
              </tr>
            </table>


          </form>

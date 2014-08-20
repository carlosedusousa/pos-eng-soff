<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?
  if (@$_GET["campo"]!="") {
    require_once 'lib/loader.php';

    $arquivo="protocolo.php";
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
    $sql="SELECT ID_BATALHAO,ID_COMPANIA,ID_PELOTAO,ID_GRUPAMENTO FROM ".TBL_USUARIO." WHERE ID_USUARIO='".$usuario."'";
    $conn->query($sql);
    $lotacao = $conn->fetch_row();
    $ID_PROTOCOLO=strtoupper($_GET["campo"]);
    $query="SELECT ".TBL_PROTOCOLOS.".ID_TIPO_SOLICITACAO,CNPJ_CPF_SOLICITANTE, NM_SOLICITANTE, NR_FONE_SOLICITANTE, DE_EMAIL_SOLICITANTE, NM_EDIFICACOES_LX, NM_LOGRADOURO, NR_EDIFICACOES_LX, NR_CEP, NM_BAIRRO, NM_COMPLEMENTO, VL_AREA_CONTRUIDA, ID_TP_LOGRADOURO,".TBL_PROTOCOLOS.".ID_CIDADE ID_CIDADE,ID_PROTOCOLO,".TBL_PROTOCOLOS.".ID_SOLICITACAO ID_SOLICITACAO,CH_PROTOCOLADO,
    DT_PROTOCOLO, ".TBL_PROTOCOLOS.".ID_TP_SERVICO, ".TBL_PROTOCOLOS.".ID_SERVICO FROM ".TBL_PROTOCOLOS." LEFT JOIN ".TBL_SOLICITACAO." USING (ID_CIDADE,ID_TIPO_SOLICITACAO,ID_SOLICITACAO) WHERE ID_PROTOCOLO=".$ID_PROTOCOLO." AND ".TBL_SOLICITACAO.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."')";

    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
    if ($rows>0) {
      $tupula = $conn->fetch_row();
?>
<script language="javascript" type="text/javascript"><!--
    var frm_cons=window.opener.document.frm_protocolo;
<?
      if ($tupula["CH_PROTOCOLADO"]=="A") {
?>
  window.opener.alert("Protocolo já se encontra em Análise!");
  frm_cons.txt_id_protocolo.value="";
  frm_cons.txt_id_protocolo.focus();
<?
      } else {
?>
  if (window.opener.confirm("Exite Registro para esta Rotina. Deseja Carregar?")) {
    frm_cons.txt_id_protocolo.value           ="<?=$tupula["ID_PROTOCOLO"]?>";
    frm_cons.txt_dt_protocolo.value           ='<?=$tupula["DT_PROTOCOLO"]?>';
    frm_cons.hdn_id_solicitacao.value         ='<?=$tupula["ID_SOLICITACAO"]?>';
    frm_cons.txt_nm_solicitante.value         ='<?=$tupula["NM_SOLICITANTE"]?>';
    frm_cons.txt_nr_fone_solicitante.value    ='<?=$tupula["NR_FONE_SOLICITANTE"]?>';
    frm_cons.txt_nr_cnpjcpf_solicitante.value ='<?=$tupula["CNPJ_CPF_SOLICITANTE"]?>';
    window.opener.cpfcnpj(frm_cons.txt_nr_cnpjcpf_solicitante);
    frm_cons.txt_nm_email_solicitante.value   ='<?=$tupula["DE_EMAIL_SOLICITANTE"]?>';
    frm_cons.txt_nm_edificacao.value          ='<?=$tupula["NM_EDIFICACOES_LX"]?>';
    frm_cons.cmb_id_tp_prefixo.value          ='<?=$tupula["ID_TP_LOGRADOURO"]?>';
    frm_cons.txt_nm_logradouro.value          ='<?=$tupula["NM_LOGRADOURO"]?>';
    frm_cons.txt_nr_edificacao.value          ='<?=$tupula["NR_EDIFICACOES_LX"]?>';
    frm_cons.txt_nm_bairro.value              ='<?=$tupula["NM_BAIRRO"]?>';
    frm_cons.txt_id_cep.value                 ='<?=$tupula["NR_CEP"]?>';
    frm_cons.cmb_id_cidade.value              ='<?=$tupula["ID_CIDADE"]?>';
    frm_cons.txt_vl_area_construida.value     ='<?=str_replace(".",",",$tupula["VL_AREA_CONTRUIDA"])?>';
    frm_cons.txt_nm_complemento.value         ='<?=$tupula["NM_COMPLEMENTO"]?>';
    frm_cons.rdo_guarda_logradouro.value      ='N';
    frm_cons.hdn_id_cidade_ant.value='<?=$tupula["ID_CIDADE"]?>';
    frm_cons.hdn_id_tipo_solicitacao.value='<?=$tupula["ID_TIPO_SOLICITACAO"]?>';
   
<?
    $query_servico="SELECT ID_SERVICO, NM_SERVICO FROM ".TBL_SERVICO." WHERE ID_CIDADE=".$tupula["ID_CIDADE"];
    $conn->query($query_servico);
?>
  frm_cons.cmb_id_servico.options.length=0;
  sec_servico=frm_cons.cmb_id_servico.options.length++;
  frm_cons.cmb_id_servico.options[sec_servico].text="--------------------------";
  frm_cons.cmb_id_servico.options[sec_servico].value="";
<?
    while ($fetch_servico=$conn->fetch_row()) {
?>
  sec_servico=frm_cons.cmb_id_servico.options.length++;
  frm_cons.cmb_id_servico.options[sec_servico].text="<?=$fetch_servico["NM_SERVICO"]?>";
  frm_cons.cmb_id_servico.options[sec_servico].value="<?=$fetch_servico["ID_SERVICO"]?>";
<?
    }
?>
    frm_cons.cmb_id_servico.value='<?=$tupula["ID_SERVICO"]?>';
<?
    $query_tp_servico="SELECT ID_SERVICO, NM_SERVICO FROM ".TBL_SERVICO." WHERE ID_CIDADE=".$tupula["ID_CIDADE"];
    $conn->query($query_tp_servico);
?>
  frm_cons.cmb_id_tp_servico.options.length=0;
<?
    while ($fetch_tp_servico=$conn->fetch_row()) {
?>
  sec_tp_servico=frm_cons.cmb_id_tp_servico.options.length++;
  frm_cons.cmb_id_tp_servico.options[sec_tp_servico].text="<?=$fetch_tp_servico["NM_SERVICO"]?>";
  frm_cons.cmb_id_tp_servico.options[sec_tp_servico].value="<?=$fetch_tp_servico["ID_SERVICO"]?>";
<?
    }
    if ($tupula["ID_SERVICO"]!="") {
?>
  frm_cons.cmb_id_tp_servico.value='<?=$tupula["ID_TP_SERVICO"]?>';
<?
    }
?>
    window.opener.FormatNumero(frm_cons.txt_nr_edificacao);
    window.opener.CEP(frm_cons.txt_id_cep);
    window.opener.FormatNumero(frm_cons.txt_vl_area_construida);
    window.opener.decimal(frm_cons.txt_vl_area_construida,2);
<?
        if ($global_alteracao=="S") {
?>
    frm_cons.btn_incluir.disabled=false;
    frm_cons.btn_incluir.value="Alterar";
    frm_cons.btn_incluir.style.backgroundImage="url('../../imagens/botao.gif')";
<?
        } else {
?>
    frm_cons.btn_incluir.disabled=false;
    frm_cons.btn_incluir.value="Alterar";
    frm_cons.btn_incluir.style.backgroundImage="url('../../imagens/botao2.gif')";
    frm_cons.btn_incluir.disabled=true;
<?
        }
?>
    frm_cons.hdn_controle.value="2";
    frm_cons.txt_id_protocolo.readOnly=true;
  } else {
    frm_cons.txt_id_protocolo.value="";
    frm_cons.txt_id_protocolo.focus();
  }

<?
      }
    } else {
?>
<?
    } 
    mysql_close();
  }
?>

</script>
<script language="javascript" type="text/javascript">//<!--
window.close();
// --></script>
</body>
</html>

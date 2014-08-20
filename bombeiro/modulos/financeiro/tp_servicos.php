<?
// include ('../../templates/head.htm');
?>
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="tp_servicos.php";
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
  if ((@$_POST["cmb_id_cidade"]!="") && (@$_POST["cmb_id_servico"]!="") && (@$_POST["txt_nm_tp_servico"]!="") && (@$_POST["hdn_controle"]!="")) {
    $ID_CIDADE=formataCampo($_POST["cmb_id_cidade"],'N');
    $ID_SERVICO=formataCampo($_POST["cmb_id_servico"],'N');
    $NM_TP_SERVICO=formataCampo($_POST["txt_nm_tp_servico"]);
    $ID_TP_SERVICO=formataCampo($_POST["txt_id_tp_servico"],'N');
    if ($_POST["txt_id_tp_servico"]=="") {
      $ID_TP_SERVICO=0;
    }

    if ($_POST["hdn_controle"]==1) {
      if ($global_inclusao=="S") {
        $sql= "INSERT INTO ".TBL_TP_SERVICO."  (ID_TP_SERVICO, ID_SERVICO, ID_CIDADE, NM_TP_SERVICO) VALUES ($ID_TP_SERVICO,$ID_SERVICO,$ID_CIDADE,$NM_TP_SERVICO)";
?>
<script>
alert("Salvo com susseso!");
</script>
<?

       } else {
        $sql="";
        $erro=MSG_ERR_INC;
      }
    }
    if ($_POST["hdn_controle"]==2) {
      if ($global_alteracao=="S") {
        $ID_CODIGO_RETORNO=$ID_TP_SERVICO;
        $sql= "UPDATE ".TBL_TP_SERVICO."  set NM_TP_SERVICO=$NM_TP_SERVICO WHERE ID_TP_SERVICO=$ID_TP_SERVICO AND ID_SERVICO=$ID_SERVICO AND ID_CIDADE=$ID_CIDADE";

?>
<script>
alert("Alteração feita com susseso!");
</script>
<?


      } else {
        $sql="";
        $erro=MSG_ERR_ALT;
      }
    }
    if ($sql!="") {
      $res= $conn->query($sql);
    }
    if ($conn->get_status()==false) {
      die ($conn->get_msg());
    } else {
     // include ('../../templates/retorno.htm');
    }
  } else {
    if ((isset($_POST["cmb_id_cidade"]))&& (isset($_POST["cmb_id_servico"]))&& (isset($_POST["txt_nm_tp_servico"]))) {
      $erro= MSG_ERR_OBR;
    }
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo1,campo2,campo3,arq) {
      if ((campo1.value!="") && (campo2.value!="")&& (campo3.value!="")) {
        window.open(arq+"?campo="+campo1.value+"&campo2="+campo2.value+"&campo3="+campo3.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.txt_id_tp_servico.readOnly=false;
    }
    function consultaSelc(formulario,cmb_campo,tabela,atrib,cond,obrigatorio,campo_atual,campos_limpos) {
      if ((campo_atual.value != "" )&&(campo_atual.value != 0)) {
        //alert("formulario="+cmb_campo.form.name+"&cmb_campo="+cmb_campo.name+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio);
        window.open("./php/consultaSelc.php?formulario="+formulario+"&cmb_campo="+cmb_campo+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio,"consulsec","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      } else {
        var cmp = campos_limpos.split(",");
        for (var i=0;i<cmp.length;i++) {
          window.document.frm_tp_servico[cmp[i]].options.length=0;
          sec_cmb=window.document.frm_tp_servico[cmp[i]].options.length++;
          window.document.frm_tp_servico[cmp[i]].options[sec_cmb].text='---------------';
          window.document.frm_tp_servico[cmp[i]].options[sec_cmb].value='0';
        }
      }
    }
    function limpa_chave(frm) {
      frm.txt_id_tp_servico.value="";
      frm.txt_id_tp_servico.readOnly=false;
    }
//--></script>
<body onload="ajustaspan()">
<?
// include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_tp_servico" onreset="retorna(this)" onsubmit="return validaForm(this,'cmb_id_cidade,Cidade,n','cmb_id_servico,Serviço,n','txt_nm_tp_servico,Nome do Tipo de Serviço,t')">
         

 <input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">


           <table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
              <tr>
                <td>Cidade</td>
                <td>
                  <select name="cmb_id_cidade" class="campo_obr" title="Nome da Cidade onde é Prestado o Serviço" onChange="limpa_chave(this.form); consultaSelc(this.form.name,'cmb_id_servico','<?=TBL_SERVICO?>','ID_SERVICO,NM_SERVICO','ID_CIDADE='+this.value,'s',this,'cmb_id_servico');">
                    <option value="">-------</option>
                    <?
                      $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_USUARIO ='".$usuario."' ORDER BY NM_CIDADE";
                      $res= $conn->query($sql);
                      if ($conn->get_status()==false) {
                        die($conn->get_msg());
                      }
                      while ($tupula = $conn->fetch_row()) {
                    ?>
                    <option value="<?=$tupula['ID_CIDADE']?>"><?=$tupula['NM_CIDADE']?></option>
                    <?
                      }
                    ?>
                  </select>
                </td>
                <td>Serviço</td>
                <td>
                  <select name="cmb_id_servico" class="campo_obr" title="Serviço Prestado" onChange="limpa_chave(this.form)">
                    <option value="">-------</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Código Tipo Serviço</td>
                <td><input type="text" name="txt_id_tp_servico" size="6" maxlength="5" class="campo" title="Código do Tipo de Serviço" align="right" onBlur="consultaReg(document.frm_tp_servico.cmb_id_cidade,document.frm_tp_servico.cmb_id_servico,this,'./modulos/financeiro/cons_tp_servicos.php')"></td>
                <td>Nome do Tipo</td>
                <td>
                  <input type="text" name="txt_nm_tp_servico" size="30" maxlength="50" class="campo_obr" title="Nome do Tipo de Serviço">
                </td>
              </tr>

<?
  include('./templates/btn_inc.htm');
?>
            </table>
          </form>
<?
 // include ('../../templates/footer.htm');
?>

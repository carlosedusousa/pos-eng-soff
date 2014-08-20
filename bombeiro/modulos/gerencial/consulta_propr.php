<?
 //include ('../../templates/head_erro.htm');
?>
<?
  $arquivo="edificacao.php";
  require_once 'lib/loader.php';
  // incluindo a classe
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
// campo de seleção
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  // executando a consulta
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  }
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

//  if (isset($_GET["txt_nm_pessoa"])) {
    if (isset($_GET["hdn_limit"])) {
      $limit=$_GET["hdn_limit"];
    } else {
      $limit=0;
    }
    $restringir=10;
    /*
    $sql="SELECT ID_BATALHAO,ID_COMPANIA,ID_PELOTAO,ID_GRUPAMENTO FROM ".TBL_USUARIO." WHERE ID_USUARIO='".$usuario."'";
    $conn->query($sql);
    $lotacao = $conn->fetch_row();
    */
    $NM_PESSOA=$_GET["txt_nm_pessoa"];
    $form_padrao=$_GET["form_padrao"];
    if ($NM_PESSOA!="") {
      $NM_FONETICA=nr_txt_fonetica($NM_PESSOA);
    } else {
      $NM_FONETICA="";
    }
/*    if ($NM_FONETICA!="") {*/
      if ((!isset($_GET["hdn_fim"]))||(@$_GET["hdn_fim"]=="")) {
        $query="SELECT ".TBL_PESSOA.".ID_CNPJ_CPF, ".TBL_PESSOA.".NM_PESSOA, ".TBL_PESSOA.".ID_CIDADE, ".TBL_PESSOA.".NR_FONE, ".TBL_PESSOA.".DE_EMAIL_PESSOA FROM ".TBL_PESSOA." WHERE ".TBL_PESSOA.".NM_PESSOA_FONETICA LIKE '%".$NM_FONETICA."%' GROUP BY ".TBL_PESSOA.".ID_CNPJ_CPF";
//         echo "<!--aqui:$query-->\n";
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
      $query="SELECT ".TBL_PESSOA.".ID_CNPJ_CPF, ".TBL_PESSOA.".NM_PESSOA, ".TBL_PESSOA.".ID_CIDADE, ".TBL_PESSOA.".NR_FONE, ".TBL_PESSOA.".DE_EMAIL_PESSOA FROM ".TBL_PESSOA." WHERE ".TBL_PESSOA.".NM_PESSOA_FONETICA LIKE '%".$NM_FONETICA."%' GROUP BY ".TBL_PESSOA.".ID_CNPJ_CPF ORDER BY ".TBL_PESSOA.".NM_PESSOA LIMIT ".$limit." , 10";
//         echo "<!--aqui2:$query-->\n";
//     } else {
//       $fim="";
//       $limit=0;
//       $query="SELECT ".TBL_PESSOA.".ID_CNPJ_CPF, ".TBL_PESSOA.".NM_PESSOA, ".TBL_PESSOA.".ID_CIDADE, ".TBL_PESSOA.".NR_FONE, ".TBL_PESSOA.".DE_EMAIL_PESSOA FROM ".TBL_PESSOA." WHERE ".TBL_PESSOA.".NM_PESSOA_FONETICA LIKE '%".$NM_FONETICA."%' ORDER BY ".TBL_PESSOA.".NM_PESSOA LIMIT ".$limit." , 10";
//     }

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
  if (document.form1.hdn_nome.value!=document.form1.txt_nm_pessoa.value) {
    document.form1.hdn_limit.value=0;
    document.form1.hdn_fim.value="";
  }
  window.document.form1.submit();
}
function consulta_ret(id_cnpj_cpf,nm_pessoa,nr_fone,de_email) {
  var frm=window.opener.document.<?=$form_padrao?>;
  frm.txt_nr_cnpjcpf_proprietario.value=id_cnpj_cpf;
  frm.txt_nm_proprietario.value=nm_pessoa;
  frm.txt_nr_fone_proprietario.value=nr_fone;
  frm.txt_de_email_proprietario.value=de_email;
//  radio_ed(window.opener.document.frm_prot_funcionamento.rdo_guarda_logradouro,ch_aguardo);
  frm.txt_de_email_proprietario.focus();
  //window.open("?campo="+reg,"consulusr","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
  window.close();
}

//-->
</script>
<?
// include ('../../templates/cab.htm');
?>
<form method="GET" target="_self" name="form1" onsubmit="sbmit()">
<fieldset>
<legend>Consulta Proprietário</legend>
<table width="90%" cellspacing="0" border="0" cellpadding="5" align="center">
  <tr valign="center">
    <td>NOME</td>
    <td><input type="text" size="50" maxlength="100" class="campo_obr" value="<?=$NM_PESSOA?>" name="txt_nm_pessoa">
        <input type="hidden" name="hdn_limit" value="">
        <input type="hidden" name="hdn_fim" value="<?=$fim?>">
        <input type="hidden" name="hdn_nome" value="<?=$NM_PESSOA?>">
        <input type="hidden" name="form_padrao" value="<?=$form_padrao?>">
    </td>
    <td><input type="button" name="btn_consulta" value="Consulta" title="Nova Consulta" class="botao"  onclick="sbmit()"></td>
  </tr>
  <tr valign="center">
    <td colspan="3">
<?
    if ($rows>0) {
?>
<table width="100%" cellspacing="0" border="1" cellpadding="0" align="center">
  <tr>
    <th>CNPJ/CPF</th>
    <th>NOME</th>
    <th>FONE</th>
    <th>E-MAIL</th>
  </tr>
<?
        while ($tupula = $conn->fetch_row()) {
?>
  <tr>
    <td><a href="javascript:consulta_ret('<?=formatCPFCNPJ($tupula["ID_CNPJ_CPF"])?>','<?=$tupula["NM_PESSOA"]?>','<?=$tupula["NR_FONE"]?>','<?=$tupula["DE_EMAIL_PESSOA"]?>')"><?=formatCPFCNPJ($tupula["ID_CNPJ_CPF"]);?></a></td>
    <td><a href="javascript:consulta_ret('<?=formatCPFCNPJ($tupula["ID_CNPJ_CPF"])?>','<?=$tupula["NM_PESSOA"]?>','<?=$tupula["NR_FONE"]?>','<?=$tupula["DE_EMAIL_PESSOA"]?>')"><?=$tupula["NM_PESSOA"];?></a></td>
    <td><a href="javascript:consulta_ret('<?=formatCPFCNPJ($tupula["ID_CNPJ_CPF"])?>','<?=$tupula["NM_PESSOA"]?>','<?=$tupula["NR_FONE"]?>','<?=$tupula["DE_EMAIL_PESSOA"]?>')"><?=$tupula["NR_FONE"];?></a></td>
    <td><a href="javascript:consulta_ret('<?=formatCPFCNPJ($tupula["ID_CNPJ_CPF"])?>','<?=$tupula["NM_PESSOA"]?>','<?=$tupula["NR_FONE"]?>','<?=$tupula["DE_EMAIL_PESSOA"]?>')"><?=$tupula["DE_EMAIL_PESSOA"];?></a></td>
  </tr>
<?
        }
        $limit_ant=$limit-$restringir;
        $limit+=$restringir;
?>
<script language="javascript" type="text/javascript">
function envia(tipo) {
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
<!--  <input type="hidden" name="hdn_limit" value="">
  <input type="hidden" name="hdn_fim" value="<?=$fim?>">-->
<table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
  <tr>
<?
      if ($limit_ant>=0) {
?>
    <td><input type="button" value="Primeiro" name="btn_primeiro" title="Primeiros 10 Registros" onclick="envia(1)" class="botao" ></td>
    <td><input type="button" value="Anterior" name="btn_anterior" title="10 Registros Anteriores" onclick="envia(2)" class="botao" ></td>
<?
      } else {
?>
    <td><input type="button" value="Primeiro" name="btn_primeiro" title="Primeiros 10 Registros" onclick="envia(1)" class="botao"  disabled="true"></td>
    <td><input type="button" value="Anterior" name="btn_anterior" title="10 Registros Anteriores" onclick="envia(2)" class="botao"  disabled="true"></td>
<?
      }
      if (($fim*10)>=$limit) {
?>
    <td>
    <input type="button" value="Próximo" name="btn_proximo" title="Próximos 10 Registros" onclick="envia(3)" class="botao" >
    </td>
    <td><input type="button" value="Último" name="btn_ultimo" title="Últimos 10 Registros" onclick="envia(4)" class="botao" ></td>
<?
      } else {
?>
    <td>
    <input type="button" value="Próximo" name="btn_proximo" title="Próximos 10 Registros" onclick="envia(3)" class="botao"  disabled="true">
    </td>
    <td><input type="button" value="Último" name="btn_ultimo" title="Últimos 10 Registros" onclick="envia(4)" class="botao"  disabled="true"></td>

<!--    <td width="50">&nbsp;</td>
    <td width="50">&nbsp;</td>-->
<?
      }
?>
  </tr>
</table>
</table>
</td>
  </tr>
</table>
<?
    } else {
?>
<script language="javascript" type="text/javascript">
//<!--
  alert("Registros não encontrados!!!");
  <?="//".$NM_FONETICA?>
  ///window.close();
// -->
</script>
<?
    }
?>
</fieldset>
</form>
<?
//  } 
?>
</body>
</html>

<?
  include ('../../templates/headA.htm');
  $erro="";
  require_once 'lib/loader.php';

  $arquivo="usuario.php";
// Conectando ao BD BD ($host, $user, $pass, $db)
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
// Verifica Campos Obrigatórios
  if ((@$_POST["txt_id_usuario"]!="") && (@$_POST["txt_nm_usuario"]!="")&&(@$_POST["cmb_id_batalhao"]!="")&&(@$_POST["cmb_id_compania"]!="")&&(@$_POST["cmb_id_pelotao"]!="")&&(@$_POST["cmb_id_grupamento"]!="")&&(@$_POST["cmb_id_cidade"])) {
    // string da query
    $ID_USUARIO   =formataCampo($_POST["txt_id_usuario"],"t","l");
    $PS_SENHA     =formataCampo(md5(@$_POST["psw_ps_senha"]),"t","l");
    $NM_USUARIO   =formataCampo(strtoupper($_POST["txt_nm_usuario"]));
    $ID_BATALHAO  =formataCampo($_POST["cmb_id_batalhao"],"N","D");
    $ID_COMPANIA  =formataCampo($_POST["cmb_id_compania"],"n","D");
    $ID_PELOTAO   =formataCampo($_POST["cmb_id_pelotao"],"n","D");
    $ID_PERFIL    =formataCampo($_POST["cmb_perfil"],"n","O");
    $ID_POSTO     =formataCampo($_POST["cmb_id_posto"],"n","O");
    $ID_GRUPAMENTO=formataCampo($_POST["cmb_id_grupamento"],"n");
    $ID_CIDADE    =formataCampo($_POST["cmb_id_cidade"],"n");
    if ($_POST["hdn_controle"]==1) {
      if ($global_inclusao=="S") {
        $sql= "insert into ".TBL_USUARIO." (ID_USUARIO, PS_SENHA, NM_USUARIO, ID_BATALHAO, ID_COMPANIA, ID_PELOTAO, ID_PERFIL, ID_POSTO, ID_GRUPAMENTO, ID_CIDADE) values($ID_USUARIO,$PS_SENHA,$NM_USUARIO,$ID_BATALHAO,$ID_COMPANIA,$ID_PELOTAO,$ID_PERFIL,$ID_POSTO,$ID_GRUPAMENTO, $ID_CIDADE)";
      } else {
        $sql="";
        $erro=MSG_ERR_INC;
      }
    }
    if ($_POST["hdn_controle"]==2) {
      if ($global_alteracao=="S") {
        $sql= "UPDATE ".TBL_USUARIO."  set NM_USUARIO=".$NM_USUARIO.",ID_BATALHAO=".$ID_BATALHAO.",ID_COMPANIA=".$ID_COMPANIA.",ID_PELOTAO=".$ID_PELOTAO.",ID_PERFIL=".$ID_PERFIL.",ID_POSTO=".$ID_POSTO.",ID_GRUPAMENTO=".$ID_GRUPAMENTO.", ID_CIDADE=$ID_CIDADE WHERE ID_USUARIO=".$ID_USUARIO;
     } else {
        $sql="";
        $erro=MSG_ERR_ALT;
      }

    }
    // executando o insert
    $res= $conn->query($sql);
    // testando se houve algum erro
    if ($conn->get_status()==false) {
      //erro_alert($conn->getMessage());
      die ($conn->get_msg());
    } else {
?>
<script language="JavaScript" type="text/javascript">//<!--
  <?
    if ($ID_USUARIO!="") {
      if (($_POST["hdn_controle"]==1)&&($global_inclusao=="S")) {
        echo "alert(\"Registro Inserido com o Usuário:".$ID_USUARIO."\");\n";
      } else {
        if ($global_alteracao=="S") {
          echo "alert(\"Registro Alterado com o Usuário:".$ID_USUARIO."\");\n";
        }
      }
    }
  ?>
//--></script>
<?
    }
  } else {
    if ((isset($_POST["txt_id_usuario"])) && (isset($_POST["txt_nm_usuario"]))&&(isset($_POST["cmb_id_posto"]))&&(isset($_POST["cmb_id_batalhao"]))&&(isset($_POST["cmb_id_compania"]))&&(isset($_POST["cmb_id_pelotao"]))&&(isset($_POST["cmb_id_grupamento"]))&&(isset($_POST["psw_ps_senha"]))&&(isset($_POST["psw_ps_senha_confirma"]))&&(isset($_POST["cmb_id_cidade"]))) {
      $erro= "echo '<tr><td align=\"center\" style=\"background-color : #f7ff05; color : #ff0000; font-weight : bold;\">OS CAMPOS ASSINALADOS SÃO OBRIGATÓRIOS</td></tr>'\n";
    }
  }
?>
<script language="JavaScript" type="text/javascript">
    function consultaSelc(formulario,cmb_campo,tabela,atrib,cond,obrigatorio,campo_atual,campos_limpos) {
      if ((campo_atual.value != "" )&&(campo_atual.value != 0)) {
        //alert("formulario="+cmb_campo.form.name+"&cmb_campo="+cmb_campo.name+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio);
        window.open("../../php/consultaSelc.php?formulario="+formulario+"&cmb_campo="+cmb_campo+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio,"consulsec","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      } else {
        var cmp = campos_limpos.split(",");
        for (var i=0;i<cmp.length;i++) {
          window.document.frm_usuario[cmp[i]].options.length=0;
          sec_cmb=window.document.frm_usuario[cmp[i]].options.length++;
          window.document.frm_usuario[cmp[i]].options[sec_cmb].text='---------------';
          window.document.frm_usuario[cmp[i]].options[sec_cmb].value='0';
        }
      }
    }
    function confirmaSenha(campo_senha1,campo_senha2) {
      if (campo_senha1.value!=campo_senha2.value) {
        window.alert("Campo Senha diferente da Confirmação Verifique!!");
        campo_senha1.value="";
        campo_senha2.value="";
        campo_senha1.focus();
      }
    }
    function consultaReg(campo) {
      if (campo.value!="") {
        window.open("cons_usuario.php?campo="+campo.value,"consulusr","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
<?
if ($global_inclusao=="S") {
?>
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.btn_incluir.style.backgroundImage="url('../../imagens/botao.gif')";
<?
} else {

?>
      frm.btn_incluir.style.backgroundImage="url('../../imagens/botao2.gif')";
<?
}
?>
      frm.txt_id_usuario.readOnly=false;
    }
    function consulta(frm,frm_name,pre_campo,def) {
    var cons=window.prompt('Digite o Nome a ser pesquisado',def.toUpperCase());
    if (cons!="") {
      window.open('../../php/cons_limit.php?form='+frm_name+'&pre_campo='+pre_campo+'&clausula='+cons.toUpperCase(),'consulta','top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=600,height=400,innerwidth=600,innerheight=400');
    }
    }
</script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
 echo "\n";
?>
          <form target="_self" enctype="multipart/form-data" method="post" name="frm_usuario" onsubmit="return validaForm(this,'txt_id_usuario,Login do Usuário,t','txt_nm_usuario,Nome do Usuário,t','cmb_id_batalhao,Batalhão,n','cmb_id_cidade,Cidade Lotação,n')" onreset="retorna(this)">
            <table width="95$" cellspacing="5" border="0" cellpadding="0" align="center">
              <tr>
                <td>Usuário</td>
                <td><input type="text" name="txt_id_usuario" size="21" maxlength="20" class="campo_obr" title="Login do Usuário" value="" onblur="consultaReg(this)" style="text-transform : none;"></td>
                <td>Nome</td>
                <td><input type="text" name="txt_nm_usuario" size="50" maxlength="100" class="campo_obr" title="Nome do Usuário" value="">
                <input type="button" name="btn_cons_usu" value="Consulta Nome" onclick="consulta(this.form,this.form.name,'hdn_usu',document.frm_usuario.txt_nm_usuario.value)" class="botao" style="background-image : url('../../imagens/botao.gif');">
                <!--
                from=USUARIO
                campo=ID_USUARIO,NM_USUARIO
                desc_campos=Cod,Nome
                arquivo=usuario.php
                bd=ACESSOS
                where=NM_USUARIO%20like%20'%ED%'
                cp_asso
                -->
                <input type="hidden" name="hdn_usu_from" value="ACESSOS.USUARIO">
                <input type="hidden" name="hdn_usu_where" value="NM_USUARIO LIKE '%pesquisa%' ORDER BY NM_USUARIO ASC">
                <input type="hidden" name="hdn_usu_campo" value="ID_USUARIO,NM_USUARIO">
                <input type="hidden" name="hdn_usu_desc_campos" value="Código do Usuário, Nome do Usuário">
                <input type="hidden" name="hdn_usu_bd" value="<?=BD_NOME_ACESSOS?>">
                <input type="hidden" name="hdn_usu_arquivo" value="<?=$arquivo?>">
                <input type="hidden" name="hdn_usu_cp_asso" value="ID_USUARIO,NM_USUARIO">
                <input type="hidden" name="hdn_arq_envio" value="window.opener.document.frm_usuario.txt_id_usuario">
                <input type="hidden" name="hdn_chave" value="ID_USUARIO">
                </td>
              </tr>
              <tr>
                <td>Cidade Lotação</td>
                <td colspan="3">
                                  <select name="cmb_id_cidade" value="" class="campo_obr">
                  <option value="">--------</option>
                  <?
                    $sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' ORDER BY NM_CIDADE";
                    $res= $conn->query($sql);
                    if ($conn->get_status()==false) {
                      die($conn->get_msg());
                    }
                    while ($tupula = $conn->fetch_row()) {
                  ?>
                  <option value="<?=$tupula["ID_CIDADE"]?>"><?=$tupula["NM_CIDADE"]?></option>
                  <?
                    }
                  ?>
                </select>
                </td>
              </tr>
              <tr>
                <td>Perfil de Acesso</td>
                <td>
                  <select name="cmb_perfil" class="campo" title="Perfil do Grupo de Acesso">
                    <option value="">------------</option>
                     <?
                      // string da query
                      $sql= "SELECT ID_PERFIL, NM_PERFIL FROM PERFIS ORDER BY NM_PERFIL ASC";
                      // executando a consulta
                      $res= $conn->query($sql);
  
                      // testando se houve algum erro
                      if ($conn->get_status()==false) {
                        die($conn->get_msg());
                      }
                      $rows=$conn->num_rows();
                      if ($rows>0) {
                        while ($tupula = $conn->fetch_row()) {
                          echo "\t\t\t\t\t\t\t\t\t\t<option value=\"".$tupula['ID_PERFIL']."\">";
                          echo $tupula['NM_PERFIL'];
                          echo "</option>\n";
                        }
                      }
                    ?>
                  </select>
                </td>
                <td>Posto</td>
                <td>
                <select name="cmb_id_posto" class="campo" title="Posto/Graduação do Usuário">
                  <option value="">------------</option>
                  <?
                    // string da query
                    $sql= "SELECT ID_POSTO, NM_POSTO FROM POSTO_GRADUACAO ORDER BY NR_NIVEL ASC";
                    // executando a consulta
                    $res= $conn->query($sql);

                    // testando se houve algum erro
                    if ($conn->get_status()==false) {
                      die($conn->get_msg());
                    }
                    while ($tupula = $conn->fetch_row()) {
                      echo "\t\t\t\t\t\t\t\t\t\t<option value=\"".$tupula['ID_POSTO']."\">";
                      echo $tupula['NM_POSTO'];
                      echo "</option>\n";
                    }
                  ?>
                </select>
                </td>
              </tr>
              <tr>
                <td>Batalhão</td>
                <td>
                <select name="cmb_id_batalhao" class="campo_obr" title="Batalhão do Usuário" onchange="consultaSelc(this.form.name,'cmb_id_compania','CADASTROS.COMPANIA','ID_COMPANIA,NM_COMPANIA','ID_BATALHAO='+this.value,'s',this,'cmb_id_compania,cmb_id_pelotao,cmb_id_grupamento')">
                  <option value="">-------</option>
                                    <?
                    // string da query
                    $sql= "SELECT ID_BATALHAO, NM_BATALHAO FROM CADASTROS.BATALHAO ORDER BY ID_BATALHAO";
                    // executando a consulta
                    $res= $conn->query($sql);

                    // testando se houve algum erro
                    if ($conn->get_status()==false) {
                      die($conn->get_msg());
                    }//<!--

                    while ($tupula = $conn->fetch_row()) {
                      echo "\t\t\t\t\t\t\t\t\t\t<option value=\"".$tupula['ID_BATALHAO']."\">";
                      echo $tupula['NM_BATALHAO'];
                      echo "</option>\n";
                    }
                  ?>
                </select>
                </td>
                <td>Compania</td>
                <td>
                <select name="cmb_id_compania" class="campo_obr" title="Compania do Usuário" onchange="consultaSelc(this.form.name,'cmb_id_pelotao','CADASTROS.PELOTAO','ID_PELOTAO,NM_PELOTAO','ID_BATALHAO='+document.frm_usuario.cmb_id_batalhao.value+' AND ID_COMPANIA='+document.frm_usuario.cmb_id_compania.value,'s',this,'cmb_id_pelotao,cmb_id_grupamento')">
                  <option v$global_alteracaoalue="0">---------</option>
                </select>
                </td>
              </tr>
              <tr>
                <td>Pelotão</td>
                <td>
                  <select name="cmb_id_pelotao" class="campo_obr" title="Pelotão do Usuário" onchange="consultaSelc(this.form.name,'cmb_id_grupamento','CADASTROS.GRUPAMENTO','ID_GRUPAMENTO,NM_GRUPAMENTO','ID_BATALHAO='+document.frm_usuario.cmb_id_batalhao.value+' AND ID_COMPANIA='+document.frm_usuario.cmb_id_compania.value+' AND ID_PELOTAO='+document.frm_usuario.cmb_id_pelotao.value,'s',this,'cmb_id_grupamento')">
                    <option value="0">-------</option>
                  </select>
                </td>
                <td>Grupamento</td>
                <td>
                  <select name="cmb_id_grupamento" class="campo_obr" title="Grupamento do Usuário">
                    <option value="0">----------</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Senha</td>
                <td><input type="password" name="psw_ps_senha" class="campo" title="Senha do Usuário" value="" style="text-transform : none;"></td>
                <td>Confirme</td>
                <td><input type="password" name="psw_ps_senha_confirma" class="campo" title="Confirme a Senha" value="" onblur="confirmaSenha(document.frm_usuario.psw_ps_senha,this)" style="text-transform : none;"></td>
              </tr>
<?
  include('../../templates/btn_inc.htm');
?>
            </table>
          </form>
<?
  mysql_close();
  include ('../../templates/footer.htm');
?>


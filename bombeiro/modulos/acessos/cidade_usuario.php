<?
 include ('../../templates/headA.htm');
?>
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="cidade_usuario.php";
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
  
  if ((@$_POST["txt_id_usuario"]!="") && (@$_POST["hdn_id_cidade_gbm"]!="")) {
    $ID_CIDADE_GBM_ARRAY=explode("^",$_POST["hdn_id_cidade_gbm"]);
    echo "<!--\n";
    var_dump($ID_CIDADE_GBM_ARRAY);
    echo "\n-->\n";
    $ID_USUARIO_GBM=$_POST["txt_id_usuario"];
    $ERRO_TRANS="";
    if ($global_inclusao=="S") {
      $query_trans="BEGIN";
      $conn->query($query_trans);
      $query_trans="COMMIT";
      $query_delete="DELETE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='$ID_USUARIO_GBM'";
      $conn->query($query_delete);
      if ($conn->get_status()==false) {
        $ERRO_TRANS=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
  
      for ($i=0;$i<count($ID_CIDADE_GBM_ARRAY);$i++){
        $ID_CIDADE=$ID_CIDADE_GBM_ARRAY[$i];
        if (trim($ID_CIDADE)!="") {
          $query_insert="INSERT INTO ".TBL_CIDADES_USR." (ID_CIDADE,ID_USUARIO) VALUES ($ID_CIDADE,'$ID_USUARIO_GBM')";
          $conn->query($query_insert);
          if ($conn->get_status()==false) {
            $ERRO_TRANS.=$conn->get_msg()."\n";
            $query_trans="ROLLBACK";
          }
        }
      }
        /*
      */
      $conn->query($query_trans);
      if ($conn->get_status()==false) {
        die($ERRO_TRANS."\n".$conn->get_msg());
      }
?>
<script language="javascript" type="text/javascript">//<!--
alert("Registro Cadastrado com Sucesso");
window.location.href="cidade_usuario.php";
//--></script>
<?
    } else {
      $erro=MSG_ERR_INC;
    }
  }

?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo,arq) {
      if (campo.value!="") {
        window.open(arq+"?campo="+campo.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.txt_id_usuario.readOnly=false;
    }
    function move_item(from, to) {
      var f;
      var SI; /* selected Index */
      if(from.options.length>0) {
        for(i=0;i<from.length;i++) {
          if(from.options[i].selected) {
            SI=from.selectedIndex;
            f=from.options[SI].index;
            to.options[to.length]=new Option(from.options[SI].text,from.options[SI].value);
            from.options[f]=null;
            i--;
          }
        }
      }
    }
    function consultaSelc(formulario,cmb_campo,tabela,atrib,cond,obrigatorio,campo_atual,campos_limpos) {
      if ((campo_atual.value != "" )&&(campo_atual.value != 0)) {
        //alert("formulario="+cmb_campo.form.name+"&cmb_campo="+cmb_campo.name+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio);
        window.open("../../php/consultaSelc.php?formulario="+formulario+"&cmb_campo="+cmb_campo+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio,"consulsec","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      } else {
        var cmp = campos_limpos.split(",");
        for (var i=0;i<cmp.length;i++) {
          window.document.frm_cidade_gbm[cmp[i]].options.length=0;
          sec_cmb=window.document.frm_cidade_gbm[cmp[i]].options.length++;
          window.document.frm_cidade_gbm[cmp[i]].options[sec_cmb].text='---------------';
          window.document.frm_cidade_gbm[cmp[i]].options[sec_cmb].value='0';
        }
      }
    }
    function cons_lotacao() {
      var frm=document.frm_cidade_gbm;
      var erro="";
      if (frm.txt_id_usuario.value=="") {
        alert("Um Usuário deve ser Setado");
        return false;
      } else {
        window.location.href="cidade_usuario.php?txt_id_usuario="+frm.txt_id_usuario.value+"&txt_nm_usuario="+frm.txt_nm_usuario.value;
        return true;
      }
    }
    function sbmit() {
      var valores="";
      var frm=document.frm_cidade_gbm;
      for (var i=0; i<frm.cmb_id_cidade_gbm.length;i++) {
        valores+=frm.cmb_id_cidade_gbm[i].value+"^";
      }
      if (valores!="") {
        frm.hdn_id_cidade_gbm.value=valores;
        return true;
      } else {
        alert("Os seguinte ERROS encontrados:\nCidade GBM\nVERIFIQUE!!!");
        return false;
      }
    }
    function consulta(frm,frm_name,pre_campo,def) {
      var cons=window.prompt('Digite o Nome a ser pesquisado',def.toUpperCase());
      if (cons!="") {
        window.open('../../php/cons_limit.php?form='+frm_name+'&pre_campo='+pre_campo+'&clausula='+cons.toUpperCase(),'consulta','top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=600,height=400,innerwidth=600,innerheight=400');
      }
    }
//--></script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>
          <form target="_self" enctype="multipart/form-data" method="post" name="frm_cidade_gbm" onreset="retorna(this)" onsubmit="return sbmit()">
            <table align="center" cellpadding="2" cellspacing="0" border="0" width="95%">
              <tr>
                <td>Usuário</td>
                <td><input type="text" name="txt_id_usuario" size="15" maxlength="20" class="campo_obr" title="Login do Usuário" value="" onblur="consultaReg(this,'cons_cid_usr.php')" style="text-transform : none;"></td>
                <td>Nome</td>
                <td><input type="text" name="txt_nm_usuario" size="50" maxlength="100" class="campo_obr" title="Nome do Usuário" value="">
                <input type="button" name="btn_cons_usu" value="Consulta Nome" onclick="consulta(this.form,this.form.name,'hdn_usu',document.frm_cidade_gbm.txt_nm_usuario.value)" class="botao" style="background-image : url('../../imagens/botao.gif');">
                  <input type="hidden" name="hdn_usu_from" value="<?=TBL_USUARIO?>">
                  <input type="hidden" name="hdn_usu_where" value="NM_USUARIO LIKE '%pesquisa%' ORDER BY NM_USUARIO ASC">
                  <input type="hidden" name="hdn_usu_campo" value="ID_USUARIO,NM_USUARIO">
                  <input type="hidden" name="hdn_usu_desc_campos" value="Código do Usuário, Nome do Usuário">
                  <input type="hidden" name="hdn_usu_bd" value="<?=BD_NOME_ACESSOS?>">
                  <input type="hidden" name="hdn_usu_arquivo" value="<?=$arquivo?>">
                  <input type="hidden" name="hdn_usu_cp_asso" value="ID_USUARIO,NM_USUARIO">
                  <input type="hidden" name="hdn_arq_envio" value="window.opener.document.frm_cidade_gbm.txt_id_usuario">
                  <input type="hidden" name="hdn_chave" value="ID_USUARIO">
                </td>
              </tr>
              <tr>
                <td colspan="4" align="center">
                  <input type="button" name="btn_cons_gbm" value="Consulta Cidades" onClick="cons_lotacao()" class="botao" style="background-image : url('../../imagens/botao.gif');">
                </td>
              </tr>
              <tr>
                <td colspan="4">
                  <table border=0 align=center cellpadding=3 cellspacing=0>
                    <tr>
                      <td>
                        <select name="cmb_id_cidade" multiple size=15>
                        <?
                          if (@$_GET["txt_id_usuario"]!="") {
                            $query_cidade="SELECT ".TBL_CIDADE.".ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." WHERE ".TBL_CIDADE.".ID_CIDADE NOT IN (SELECT ".TBL_CIDADES_USR.".ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ".TBL_CIDADES_USR.".ID_USUARIO='".$_GET["txt_id_usuario"]."') ORDER BY ".TBL_CIDADE.".NM_CIDADE";
                          echo "<!-- aqui0:\n$query_cidade\n-->\n";
                            $res= $conn->query($query_cidade);
                            $rows_cidade=$conn->num_rows();
                            if ($rows_cidade>0) {
                              while ($cidade = $conn->fetch_row()) {
                        ?>
                          <option value="<?=$cidade["ID_CIDADE"]?>"><?=$cidade["NM_CIDADE"]?></option>
                        <?
                              }
                            } else {
                        ?>
                          <option value=""></option>
                        <?
                            }
                           } else {
                        ?>
                          <option value=""></option>
                        <?
                          }
                        ?>
                        </select>
                      </td>
                      <td>
                        <input type="button" value = "    Adiciona >  " onClick="move_item(cmb_id_cidade, cmb_id_cidade_gbm)" class="botao" style="background-image : url('../../imagens/botao.gif');"><br>
                        <input type="button" value = "< Remove    " onClick="move_item(cmb_id_cidade_gbm,cmb_id_cidade)" class="botao" style="background-image : url('../../imagens/botao.gif');">
                      </td>
                      <td>
                        <input type="hidden" name="hdn_id_cidade_gbm" value="">
                        <Select name="cmb_id_cidade_gbm" multiple size=15>
                        <?
                          if (@$_GET["txt_id_usuario"]!="") {
                            $query_cidade_gbm="SELECT ".TBL_CIDADES_USR.". ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADES_USR." JOIN ".TBL_CIDADE." USING (ID_CIDADE) WHERE  ".TBL_CIDADES_USR.".ID_USUARIO='".$_GET["txt_id_usuario"]."' ORDER BY ".TBL_CIDADE.".NM_CIDADE";
                            $res= $conn->query($query_cidade_gbm);
                            $rows_cidade_gbm=$conn->num_rows();
                            if ($rows_cidade_gbm>0) {
                              while ($cidade_gbm = $conn->fetch_row()) {
                        ?>
                          <option value="<?=$cidade_gbm["ID_CIDADE"]?>"><?=$cidade_gbm["NM_CIDADE"]?></option>
                        <?
                              }
                            } else {
                        ?>
                          <option value=""></option>
                        <?
                            }
                          } else {
                        ?>
                          <option value=""></option>
                        <?
                          }
                        ?>
                        </Select>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

<?
  include('../../templates/btn_salva.htm');
?>
            </table>
          </form>
<?
if ((@$_GET["txt_id_usuario"]!="")&&(count($_POST)<2)) {
?>
<script language="javascript" type="text/javascript">//<!--
var frm_at=document.frm_cidade_gbm;
frm_at.txt_id_usuario.value="<?=$_GET["txt_id_usuario"]?>";
frm_at.txt_nm_usuario.value="<?=$_GET["txt_nm_usuario"]?>";
//--></script>
<?
}
?>
<?
  include ('../../templates/footer.htm');
?>

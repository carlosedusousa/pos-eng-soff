<?
 include ('../../templates/headA.htm');
?>
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="cidade_lotacao.php";
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
  
  if ((@$_POST["hdn_id_batalhao"]!="") && (@$_POST["hdn_id_compania"]!="") && (@$_POST["hdn_id_pelotao"]!="") && (@$_POST["hdn_id_grupamento"]!="") && (@$_POST["hdn_id_cidade_gbm"]!="")) {
    $ID_CIDADE_GBM_ARRAY=explode("^",$_POST["hdn_id_cidade_gbm"]);
    echo "<!--\n";
    var_dump($ID_CIDADE_GBM_ARRAY);
    echo "\n-->\n";
    $ID_BATALHAO=$_POST["hdn_id_batalhao"];
    $ID_COMPANIA=$_POST["hdn_id_compania"];
    $ID_PELOTAO=$_POST["hdn_id_pelotao"];
    $ID_GRUPAMENTO=$_POST["hdn_id_grupamento"];
    $ERRO_TRANS="";
    if ($global_inclusao=="S") {
      $query_trans="BEGIN";
      $conn->query($query_trans);
      $query_trans="COMMIT";
      $query_delete="DELETE FROM ".TBL_CIDADES_GBM." WHERE ID_BATALHAO=$ID_BATALHAO AND ID_COMPANIA=$ID_COMPANIA AND ID_PELOTAO=$ID_PELOTAO AND ID_GRUPAMENTO=$ID_GRUPAMENTO";
      $conn->query($query_delete);
      if ($conn->get_status()==false) {
        $ERRO_TRANS=$conn->get_msg()."\n";
        $query_trans="ROLLBACK";
      }
  
      for ($i=0;$i<count($ID_CIDADE_GBM_ARRAY);$i++){
        $ID_CIDADE=$ID_CIDADE_GBM_ARRAY[$i];
        if (trim($ID_CIDADE)!="") {
          $query_insert="INSERT INTO ".TBL_CIDADES_GBM." (ID_CIDADE,ID_BATALHAO,ID_COMPANIA,ID_PELOTAO,ID_GRUPAMENTO) VALUES ($ID_CIDADE,$ID_BATALHAO,$ID_COMPANIA,$ID_PELOTAO,$ID_GRUPAMENTO)";
          $conn->query($query_insert);
          if ($conn->get_status()==false) {
            $ERRO_TRANS.=$conn->get_msg()."\n";
            $query_trans="ROLLBACK";
          }
        }
      }
  
      $query_select_usuario="SELECT ID_USUARIO FROM ".TBL_USUARIO." WHERE ID_BATALHAO=$ID_BATALHAO AND ID_COMPANIA=$ID_COMPANIA AND ID_PELOTAO=$ID_PELOTAO AND ID_GRUPAMENTO=$ID_GRUPAMENTO";
      $res=mysql_query($query_select_usuario);
      if (mysql_errno()!=0) {
        $ERRO_TRANS.=mysql_error()." (requisição original: ".$query_select_usuario.")\n";
        $query_trans="ROLLBACK";
      }
      while ($usuario_gbm_cidade=mysql_fetch_assoc($res)) {
        for ($i=0;$i<count($ID_CIDADE_GBM_ARRAY);$i++){
          $ID_CIDADE=$ID_CIDADE_GBM_ARRAY[$i];
          if (trim($ID_CIDADE)!="") {
            $query_insert="REPLACE INTO ".TBL_CIDADES_USR." (ID_CIDADE,ID_USUARIO) VALUES ($ID_CIDADE,'".$usuario_gbm_cidade["ID_USUARIO"]."')";
            $conn->query($query_insert);
            if ($conn->get_status()==false) {
              $ERRO_TRANS.=$conn->get_msg()."\n";
              $query_trans="ROLLBACK";
            }
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
window.location.href="<?=END_PADRAO?>modulos/acessos/cidade_lotacao.php";
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
      //frm.txt_id_rotina.readOnly=false;
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
      if (frm.cmb_id_batalhao.value=="") {
        erro+="Batalhão deve ser Setado\n";
      }
      if (frm.cmb_id_compania.value=="") {
        erro+="Compania deve ser Setado\n";
      }
      if (frm.cmb_id_pelotao.value=="") {
        erro+="Pelotão deve ser Setado\n";
      }
      if (frm.cmb_id_grupamento.value=="") {
        erro+="Grupamento deve ser Setado\n";
      }
      if (erro!="") {
        alert(erro);
        return false;
      } else {
        window.location.href="<?=END_PADRAO?>modulos/acessos/cidade_lotacao.php?cmb_id_batalhao="+frm.cmb_id_batalhao.value+"&cmb_id_compania="+frm.cmb_id_compania.value+"&cmb_id_pelotao="+frm.cmb_id_pelotao.value+"&cmb_id_grupamento="+frm.cmb_id_grupamento.value
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
//--></script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_cidade_gbm" onreset="retorna(this)" onsubmit="return sbmit()">
            <table align="center" cellpadding="2" cellspacing="0" border="0" width="95%">
              <tr>
                <td>Batalhão</td>
                <td>
                <input type="hidden" name="hdn_id_batalhao" value="">
                <select name="cmb_id_batalhao" class="campo_obr" title="Batalhão do Usuário" onchange="consultaSelc(this.form.name,'cmb_id_compania','CADASTROS.COMPANIA','ID_COMPANIA,NM_COMPANIA','ID_BATALHAO='+this.value,'s',this,'cmb_id_compania,cmb_id_pelotao,cmb_id_grupamento')">
                  <option value="">-------</option>
                                    <?
                    // string da query
                    $sql= "SELECT ID_BATALHAO,NM_BATALHAO FROM CADASTROS.BATALHAO ORDER BY ID_BATALHAO";
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
                <input type="hidden" name="hdn_id_compania" value="">
                <select name="cmb_id_compania" class="campo_obr" title="Compania do Usuário" onchange="consultaSelc(this.form.name,'cmb_id_pelotao','CADASTROS.PELOTAO','ID_PELOTAO,NM_PELOTAO','ID_BATALHAO='+document.frm_cidade_gbm.cmb_id_batalhao.value+' AND ID_COMPANIA='+document.frm_cidade_gbm.cmb_id_compania.value,'s',this,'cmb_id_pelotao,cmb_id_grupamento')">
                  <option value="0">---------</option>
                </select>
                </td>
              </tr>
              <tr>
                <td>Pelotão</td>
                <td>
                  <input type="hidden" name="hdn_id_pelotao" value="">
                  <select name="cmb_id_pelotao" class="campo_obr" title="Pelotão do Usuário" onchange="consultaSelc(this.form.name,'cmb_id_grupamento','CADASTROS.GRUPAMENTO','ID_GRUPAMENTO,NM_GRUPAMENTO','ID_BATALHAO='+document.frm_cidade_gbm.cmb_id_batalhao.value+' AND ID_COMPANIA='+document.frm_cidade_gbm.cmb_id_compania.value+' AND ID_PELOTAO='+document.frm_cidade_gbm.cmb_id_pelotao.value,'s',this,'cmb_id_grupamento')">
                    <option value="0">-------</option>
                  </select>
                </td>
                <td>Grupamento</td>
                <td>
                  <input type="hidden" name="hdn_id_grupamento" value="">
                  <select name="cmb_id_grupamento" class="campo_obr" title="Grupamento do Usuário">
                    <option value="0">----------</option>
                  </select>
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
                          if ((@$_GET["cmb_id_batalhao"]!="") && (@$_GET["cmb_id_compania"]!="") && (@$_GET["cmb_id_pelotao"]!="") && (@$_GET["cmb_id_grupamento"]!="")) {
                            $query_cidade="SELECT ".TBL_CIDADE.".ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." WHERE ".TBL_CIDADE.".ID_CIDADE NOT IN (SELECT ".TBL_CIDADES_GBM.".ID_CIDADE FROM ".TBL_CIDADES_GBM." WHERE ".TBL_CIDADES_GBM.".ID_BATALHAO=".$_GET["cmb_id_batalhao"]." AND ".TBL_CIDADES_GBM.".ID_COMPANIA=".$_GET["cmb_id_compania"]." AND ".TBL_CIDADES_GBM.".ID_PELOTAO = ".$_GET["cmb_id_pelotao"]." AND ".TBL_CIDADES_GBM.".ID_GRUPAMENTO=".$_GET["cmb_id_grupamento"].") ORDER BY ".TBL_CIDADE.".NM_CIDADE";
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
                          if ((@$_GET["cmb_id_batalhao"]!="") && (@$_GET["cmb_id_compania"]!="") && (@$_GET["cmb_id_pelotao"]!="") && (@$_GET["cmb_id_grupamento"]!="")) {
                            $query_cidade_gbm="SELECT ".TBL_CIDADES_GBM.". ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADES_GBM." JOIN ".TBL_CIDADE." USING (ID_CIDADE) WHERE  ".TBL_CIDADES_GBM.".ID_BATALHAO=".$_GET["cmb_id_batalhao"]." AND ".TBL_CIDADES_GBM.".ID_COMPANIA=".$_GET["cmb_id_compania"]." AND ".TBL_CIDADES_GBM.".ID_PELOTAO = ".$_GET["cmb_id_pelotao"]." AND ".TBL_CIDADES_GBM.".ID_GRUPAMENTO=".$_GET["cmb_id_grupamento"]." ORDER BY ".TBL_CIDADE.".NM_CIDADE";
                            echo "<!-- aqui1:\n$query_cidade_gbm\n-->\n";
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
if ((@$_GET["cmb_id_batalhao"]!="") && (@$_GET["cmb_id_compania"]!="") && (@$_GET["cmb_id_pelotao"]!="") && (@$_GET["cmb_id_grupamento"]!="")&&(count($_POST)<2)) {
?>
<script language="javascript" type="text/javascript">//<!--
var frm_at=document.frm_cidade_gbm;
frm_at.cmb_id_batalhao.value="<?=$_GET["cmb_id_batalhao"]?>";
frm_at.hdn_id_batalhao.value="<?=$_GET["cmb_id_batalhao"]?>";
frm_at.cmb_id_compania.value="<?=$_GET["cmb_id_compania"]?>";
frm_at.hdn_id_compania.value="<?=$_GET["cmb_id_compania"]?>";
frm_at.cmb_id_pelotao.value="<?=$_GET["cmb_id_pelotao"]?>";
frm_at.hdn_id_pelotao.value="<?=$_GET["cmb_id_pelotao"]?>";
frm_at.cmb_id_grupamento.value="<?=$_GET["cmb_id_grupamento"]?>";
frm_at.hdn_id_grupamento.value="<?=$_GET["cmb_id_grupamento"]?>";
//--></script>
<?
}
?>
<?
  include ('../../templates/footer.htm');
?>

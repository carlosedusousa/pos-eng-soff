<?
 include ('../../templates/headA.htm');
?>
<?
  $erro="";
/*
  require_once 'conf/conf_bd.php';
  // incluindo a classe
  require_once 'class/class_mysql.php';
  require_once 'class/class_sessao_sigat.php';
*/
  require_once 'lib/loader.php';

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="perfilamento.php";
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



  // INSERE PERFILAMENTO
  if ((@$_POST["cmb_id_perfil"]!="")&&($global_alteracao=="S")&&($global_inclusao=="S")) {
    // string da query
/*

ID_ROTINA
ID_PERFIL
CH_CONSULTA
CH_INCLUSAO
CH_ALTERACAO
CH_EXCLUSAO
*/
    $ID_PERFIL    =formataCampo(strtoupper($_POST["cmb_id_perfil"]),'n');
    $query="SELECT ID_ROTINA FROM ".TBL_ROTINAS;
    $conn->query($query);
    $rows=$conn->num_rows();
    if ($rows>0) {
      while ($tupula = $conn->fetch_row()) {
        $ID_ROTINA=$tupula["ID_ROTINA"];
        $CAMPO="hdn_".$ID_ROTINA."_perm";
        if (@$_POST[$CAMPO]!="") {
          $permissao= explode("^",$_POST[$CAMPO]);
          if (count($permissao)!=4) {
            continue;
          }
        } else {
          $permissao= explode("^","N^N^N^N");
        }
        $CH_CONSULTA  =formataCampo(@$permissao[0],"sn");
        $CH_INCLUSAO  =formataCampo(@$permissao[1],"sn");
        $CH_ALTERACAO =formataCampo(@$permissao[2],"sn");
        $CH_EXCLUSAO  =formataCampo(@$permissao[3],"sn");
        $sql= "REPLACE INTO ".TBL_PERFILAMENTO_ACESSO."  (ID_ROTINA,ID_PERFIL,CH_CONSULTA,CH_INCLUSAO,CH_ALTERACAO,CH_EXCLUSAO) values($ID_ROTINA,$ID_PERFIL,$CH_CONSULTA,$CH_INCLUSAO,$CH_ALTERACAO,$CH_EXCLUSAO)";
        echo "<!--aqui :$sql-->\n";
        $conn->queryx($sql);
        if ($conn->get_status()==false) {
          die ($res->get_msg());
        }
      }
    }
    if ($conn->get_status()==false) {
      //erro_alert($conn->getMessage());
      die ($res->get_msg());
    } else {
      $_POST["cmb_id_perfil"]="";
?>
<script language="JavaScript" type="text/javascript">//<!--
  <?
    echo "alert(\"Perfilamento Savo com Sucesso Inserido\");\n";
  ?>
//--></script>
<?
    }
  } else {
    if (($global_alteracao=="S")&&($global_inclusao=="S")) {
      if ((isset($_POST["cmb_id_perfil"]))) {
        $erro= MSG_ERR_OBR;
      }
    } else {
      $erro=MSG_ERR_ALT;
    }
  }
?>
<script language="JavaScript" type="text/javascript">//<!--
  function check_completo(chk_comp,ids) {
    var cons=document.frm_perfilamento["chk_"+ids+"_C"];
    var incs=document.frm_perfilamento["chk_"+ids+"_I"];
    var alts=document.frm_perfilamento["chk_"+ids+"_A"];
    var excs=document.frm_perfilamento["chk_"+ids+"_E"];
    var pems=document.frm_perfilamento["hdn_"+ids+"_perm"];
    if (chk_comp.checked==true) {
      cons.checked=true;
      incs.checked=true;
      alts.checked=true;
      excs.checked=true;
      pems.value="S^S^S^S";
    } else {
      cons.checked=false;
      incs.checked=false;
      alts.checked=false;
      excs.checked=false;
      pems.value="N^N^N^N";
    }
  }
  function check_indiv(ids) {
    var cons=document.frm_perfilamento["chk_"+ids+"_C"];
    var incs=document.frm_perfilamento["chk_"+ids+"_I"];
    var alts=document.frm_perfilamento["chk_"+ids+"_A"];
    var excs=document.frm_perfilamento["chk_"+ids+"_E"];
    var pems=document.frm_perfilamento["hdn_"+ids+"_perm"];
    if (pems.value=="") {
      pems.value="N^N^N^N";
    }
    var permissoes = pems.value.split("^");
    if (cons.checked==true) {
      permissoes[0]="S";
    } else {
      permissoes[0]="N";
    }
    if (incs.checked==true) {
      permissoes[1]="S";
    } else {
      permissoes[1]="N";
    }
    if (alts.checked==true) {
      permissoes[2]="S";
    } else {
      permissoes[2]="N";
    }
    if (excs.checked==true) {
      permissoes[3]="S";
    } else {
      permissoes[3]="N";
    }
    pems.value=permissoes.join("^");
    if (pems.value=="S^S^S^S") {
      document.frm_perfilamento["chk_"+ids+"_comp"].checked=true;
    } else {
      document.frm_perfilamento["chk_"+ids+"_comp"].checked=false;
    }
  }
  function consultaReg(campo) {
    if (campo.value!="") {
      window.open("cons_perfilamento.php?campo="+campo.value,"consulusr","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
    }
  }
//--></script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_perfilamento" onsubmit="return validaForm(this,'cmb_id_perfil,Perfil,t')">
            <table width="90%" cellspacing="0" border="0" cellpadding="0" align="center">
              <tr>
                <td colspan="7" align="center">
                <table cellspacing="0" border="0" cellpadding="5" align="center">
                  <tr>
                    <td><b>Perfil</b></td>
                    <td>
                    <select name="cmb_id_perfil" class="campo_obr" title="Perfil de Acesso" onchange="consultaReg(this)">
                      <option value="">----------------</option>
                    <?
                      // string da query
                      $sql= "SELECT ID_PERFIL, NM_PERFIL FROM ".TBL_PERFIS." ORDER BY NM_PERFIL ASC";
                      // executando a consulta
                      $res= $conn->query($sql);
  
                      // testando se houve algum erro
                      //echo "aqui :".$conn->get_status()."\n";
                      if ($conn->get_status()==false) {
                        die($conn->get_msg());
                      }
                      $rows=$conn->num_rows();
                      if ($rows>0) {
                        while ($tupula = $conn->fetch_row()) {
                        ?>
                      <option value="<?=$tupula['ID_PERFIL'];?>"><?=$tupula['NM_PERFIL'];?></option>
                        <?
                        }
                      }
                    ?>
                    </select>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
              <tr>
                <th align="left">Nome do Modulo</th>
                <th align="left">Nome da Rotina</th>
                <th>Completo&nbsp;</td>
                <th>Consulta&nbsp;</th>
                <th>Inclusão&nbsp;</th>
                <th>Alteração&nbsp;</th>
                <th>Exclusão&nbsp;</th>
              </tr>
              <?
              $query="SELECT ID_ROTINA,NM_ROTINA,NM_MODULO FROM ".TBL_ROTINAS." JOIN ".TBL_MODULOS." USING(ID_MODULO) ORDER BY NM_MODULO, NM_ROTINA ASC";
              $conn->query($query);
              if ($conn->get_status()==false) {
                die($conn->get_msg());
              }
              $rows=$conn->num_rows();
              if ($rows>0) {
                $cont=1;
                $NM_MODULO="";
                $controlador=0;
                while ($tupula = $conn->fetch_row()) {
                  if ($NM_MODULO!=$tupula["NM_MODULO"]) {
                    $NM_MODULO=$tupula["NM_MODULO"];
                    $controlador=1;
                  } else {
                    $controlador=0;
                  }
                  $resto=$cont%2;
                  if ($resto!=0) {
                  ?>
              <tr style="background-color : #9bd5ff;">
                  <?
                  } else {
                  ?>
              <tr style="background-color : #ffffff;">
                  <?
                  }
                  ?>
                  <td>
                  <strong>
                  <? 
                    if ($controlador==1) {
                      echo $NM_MODULO."\n";
                    } else {
                      echo "&nbsp;\n";
                    }
                  ?>
                  </strong>
                  </td>
                  <td>
                  <?
                    echo $tupula["ID_ROTINA"]." - ".$tupula["NM_ROTINA"];
                  ?>
                  <input name="hdn_<?=$tupula["ID_ROTINA"];?>_perm" type="hidden" value="">
                  </td>
                  <td align="center">
                    <input type="checkbox" class="campo" name="chk_<?=$tupula["ID_ROTINA"];?>_comp" onchange="check_completo(this,'<?=$tupula["ID_ROTINA"];?>')">
                  </td>
                  <td align="center">
                    <input type="checkbox" class="campo" name="chk_<?=$tupula["ID_ROTINA"];?>_C" onchange="check_indiv('<?=$tupula["ID_ROTINA"];?>')">
                  </td>
                  <td align="center">
                    <input type="checkbox" class="campo" name="chk_<?=$tupula["ID_ROTINA"];?>_I" onchange="check_indiv('<?=$tupula["ID_ROTINA"];?>')">
                  </td>
                  <td align="center">
                    <input type="checkbox" class="campo" name="chk_<?=$tupula["ID_ROTINA"];?>_A" onchange="check_indiv('<?=$tupula["ID_ROTINA"];?>')">
                  </td>
                  <td align="center">
                    <input type="checkbox" class="campo" name="chk_<?=$tupula["ID_ROTINA"];?>_E" onchange="check_indiv('<?=$tupula["ID_ROTINA"];?>')">
                  </td>
                  <?
                  ?>
              </tr>
                  <?
                  $cont++;
                }
              }
              ?>
<?
  include('../../templates/btn_salva.htm');
?>
            </table>
          </form>
<?
  include ('../../templates/footer.htm');
?>

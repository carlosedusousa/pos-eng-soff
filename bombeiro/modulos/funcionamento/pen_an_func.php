<?

 // include ('../../templates/head.htm');

  $erro="";
  require_once 'lib/loader.php';

  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }

  $arquivo="pen_an_func.php";
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row(); else die("ROTINA NÃO CADASTRADA");
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

  $arq = explode('/',__FILE__); 
  $arq = end($arq);
  $seta = '<img src="./imagens/seta1.gif" alt="" border="0">&nbsp;';

  switch(@$_GET['ord']) {
  	case 'dt' 	: $ord = 'ORDER BY DT_PROTOCOLO ASC, NM_CIDADE ASC '; 			break;
  	case 'edf'	: $ord = 'ORDER BY NM_EDIFICACOES_LX ASC, DT_PROTOCOLO ASC '; 	break;
  	case 'cid'	: $ord = 'ORDER BY NM_CIDADE ASC, DT_PROTOCOLO ASC '; 			break;
  	case 'pag'	: $ord = 'ORDER BY DT_PAGAMENTO ASC, DT_PROTOCOLO ASC '; 		break;
  	default		: $ord = 'ORDER BY DT_PROTOCOLO ASC, NM_CIDADE ASC '; 			break; 
  }

  $sql="SELECT ".TBL_PROT_AN_FUNC.".ID_PROT_ANALISE_FUNC, ".TBL_PROT_AN_FUNC.".ID_CIDADE,  ".TBL_SOLICITACAO.".NM_EDIFICACOES_LX, ".TBL_CIDADE.".NM_CIDADE, DATE_FORMAT(".TBL_PROT_AN_FUNC.".DT_PROTOCOLO,'%d/%m/%Y') DT_PROTOCOLOS, (TO_DAYS('".date("Y-m-d")."') - TO_DAYS(".TBL_PROT_AN_FUNC.".DT_PROTOCOLO)) AS DIAS, IF(".TBL_COB_BOLETO.".DT_PAGAMENTO IS NULL,'NÃO PAGO',DATE_FORMAT(".TBL_COB_BOLETO.".DT_PAGAMENTO,'%d/%m/%Y')) AS DT_PAGAMENTO FROM ".TBL_PROT_AN_FUNC." LEFT JOIN ".TBL_SOLICITACAO." ON (".TBL_PROT_AN_FUNC.".ID_CIDADE=".TBL_SOLICITACAO.".ID_CIDADE AND ".TBL_PROT_AN_FUNC.".ID_SOLICITACAO=".TBL_SOLICITACAO.".ID_SOLICITACAO AND ".TBL_PROT_AN_FUNC.".ID_TIPO_SOLICITACAO=".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO) LEFT JOIN ".TBL_COB_BOLETO." ON (".TBL_PROT_AN_FUNC.".ID_CIDADE=".TBL_COB_BOLETO.".ID_CIDADE_AN_FUNC AND ".TBL_PROT_AN_FUNC.".ID_PROT_ANALISE_FUNC=".TBL_COB_BOLETO.".ID_PROT_ANALISE_FUNC) LEFT JOIN ".TBL_CIDADE." ON (".TBL_SOLICITACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) WHERE ".TBL_SOLICITACAO.".CH_PROTOCOLADO='P' AND ".TBL_PROT_AN_FUNC.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."') $ord";

  $diasd=false;
  $conn->query($sql);
  $rows_pendente=$conn->num_rows();
?>
<script language="javascript" type="text/javascript">//<!--

    function consultaReg(campo,arq) {
      if (campo.value!="") {
        window.open(arq+"?campo="+campo.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function envia_pendencia(solicitacao,cidade) {
      var frm = document.frm_funcionamento_pendencia;
      frm.hdn_id_protocolo.value=solicitacao;
      frm.hdn_id_cidade.value=cidade;
      //alert(frm.hdn_id_solicitacao.value);
      frm.submit();
    }
//--></script>
<body onload="ajustaspan()">

<?// include ('../../templates/cab.htm'); ?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_funcionamento_pendencia" action="vist_an_func.php">
            <input type="hidden" name="hdn_id_protocolo" value="">
            <input type="hidden" name="hdn_id_cidade" value="">
            <table width="98%" cellspacing="0" border="0" cellpadding="0" align="center">
              <tr>
                <td>
                <fieldset>
                  <legend>Análise Pendente</legend>
                  <table width="100%" cellspacing="2" border="0" cellpadding="3" align="center">
                    <tr style="background-color:#C6E2FF">
  					  <th nowrap><? if(@$_GET['ord']=='dt' OR !@$_GET['ord']) echo $seta; ?><a href="<?=$arq?>?ord=dt">Data</a></th>
                      <th nowrap><? if(@$_GET['ord']=='edf') echo $seta; ?><a href="<?=$arq?>?ord=edf">Edificação</a></th>
                      <th nowrap><? if(@$_GET['ord']=='cid') echo $seta; ?><a href="<?=$arq?>?ord=cid">Cidade</a></th>
                      <th nowrap><? if(@$_GET['ord']=='pag') echo $seta; ?><a href="<?=$arq?>?ord=pag">Pagamento</a></th>
                    </tr>
<?
                    if ($rows_pendente>0) {
                      $cont=1;
                      while ($pendente=$conn->fetch_row()) {
                        $resto=$cont%2;
                        if ($pendente["DIAS"]<30) {
                          $dias="";
                        } else {
                          $dias="color : #ff0101;font-weight : bold;";
                          $diasd=true;
                        }
                        if ($resto!=0) {
?>
                        <tr style="background-color : #4ab; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_PROT_ANALISE_FUNC"]?>','<?=$pendente["ID_CIDADE"]?>')">
<?
                        } else {
?>
                        <tr style="background-color : #87CEEB; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_PROT_ANALISE_FUNC"]?>','<?=$pendente["ID_CIDADE"]?>')">
<?
                        }
?>
                          <td width="20" align="center"><?=$pendente["DT_PROTOCOLOS"]?></td>
                          <td><?=$pendente["NM_EDIFICACOES_LX"]?></td>
                          <td align="center"><?=$pendente["NM_CIDADE"]?></td>
                          <td align="center"><?=$pendente["DT_PAGAMENTO"]?></td>
                        </tr>
<?
                        $cont++;
                      }
                    } else {
?>
                        <tr>
                          <td width="20" align="center">00/00/0000</td>
                          <td colspan="3">Nenhuma Solicitação Encontrada</td>
                        </tr>
<?
                    }
if ($diasd) {
?>
                        <tr>
                          <td colspan="4" align="center" style="background-color : #87CEEB;"><b>Os Campos em Vermelho Estão Pendentes a mais de 20 dias</b></td>
                        </tr>
<? } ?>
                  </table>
                </fieldset>
                </td>
              </tr>
            </table>
          </form>

<? //include ('../../templates/footer1.htm'); ?>

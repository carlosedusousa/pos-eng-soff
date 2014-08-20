<?
  $erro="";
  require_once 'lib/loader.php';

  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }

  $arquivo="pen_funcionamento.php";
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row(); else die("ROTINA NÃO CADASTRADA");
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

  $arq = explode('/',__FILE__); 
  $arq = end($arq);
  $sql = "SELECT ".TBL_PROT_FUNC.".ID_PROT_FUNC, ".TBL_PROT_FUNC.".ID_CIDADE,  ".TBL_SOL_FUNC.".NM_RAZAO_SOCIAL, ".TBL_SOL_FUNC.".NM_EDIFICACOES, ".TBL_CIDADE.".NM_CIDADE, DATE_FORMAT(".TBL_PROT_FUNC.".DT_PROTOCOLADO,'%d/%m/%Y') DT_PROTOCOLADOS, (TO_DAYS('".date("Y-m-d")."') - TO_DAYS(".TBL_PROT_FUNC.".DT_PROTOCOLADO)) AS DIAS, IF(".TBL_COB_BOLETO.".DT_PAGAMENTO IS NULL,'NÃO PAGO',DATE_FORMAT(".TBL_COB_BOLETO.".DT_PAGAMENTO,'%d/%m/%Y')) AS DT_PAGAMENTO FROM ".TBL_PROT_FUNC." LEFT JOIN ".TBL_SOL_FUNC." ON (".TBL_PROT_FUNC.".ID_CIDADE=".TBL_SOL_FUNC.".ID_CIDADE AND ".TBL_PROT_FUNC.".ID_SOLIC_FUNC=".TBL_SOL_FUNC.".ID_SOLIC_FUNC AND ".TBL_PROT_FUNC.".ID_TP_FUNC=".TBL_SOL_FUNC.".ID_TP_FUNC) LEFT JOIN ".TBL_COB_BOLETO." ON (".TBL_PROT_FUNC.".ID_CIDADE=".TBL_COB_BOLETO.".ID_CIDADE_PROT_FUNC AND ".TBL_PROT_FUNC.".ID_PROT_FUNC=".TBL_COB_BOLETO.".ID_PROT_FUNC) LEFT JOIN ".TBL_CIDADE." ON (".TBL_SOL_FUNC.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) WHERE ".	TBL_SOL_FUNC.".CH_PROTOCOLADO='P' AND ".TBL_PROT_FUNC.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."') ORDER BY ID_PROT_FUNC ASC ";

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
 
      var op = "vistoriaPendenteFuncionamento";
      frm.op_menu.value = op;
      frm.submit();
    }
    function envia_ordenador(tipo){
    	alert(tipo);
    }
//--></script>
<body onload="ajustaspan()">

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_funcionamento_pendencia" action="index.php">
            <input type="hidden" name="hdn_id_protocolo" value="">
            <input type="hidden" name="hdn_id_cidade" value="">
            <input type="hidden" name="op_menu" value="">
            <table width="100%" cellspacing="2" border="0" cellpadding="2">
              <tr>
                <td>
                <fieldset>
                  <legend>Vistoria Pendente</legend>
                  <table width="100%" cellspacing="1" border="0" cellpadding="5" align="center">
                    <tr style="background-color:#B0C4DE">
		      <th nowrap>Data</a></th>
                      <th nowrap>Protocolo</a></th>
                      <th nowrap>Empresa</a></th>
                      <th nowrap>Cidade</a></th>
                      <th nowrap>Pagamento</a></th>
                    </tr>
<?
                    if ($rows_pendente>0) {
                      $cont=1;
                      while ($pendente=$conn->fetch_row()) {
                        $resto=$cont%2;
                        if ($pendente["DIAS"]<30) {
                          $dias="";
                        } else {
                          $dias="color : red;font-weight : bold;";
                          $diasd=true;
                        }
                        if ($resto!=0) {
?>
                        <tr style="background-color : #f5f5f5; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_PROT_FUNC"]?>','<?=$pendente["ID_CIDADE"]?>')">
<?
                        } else {
?>
                        <tr style="background-color : #ffffff; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_PROT_FUNC"]?>','<?=$pendente["ID_CIDADE"]?>')">
<?
                        }
?>
                          <td width="20" align="center"><?=$pendente["DT_PROTOCOLADOS"]?></td>
                          <td align="center"><?=$pendente["ID_PROT_FUNC"]?></td>
                          <td><?=$pendente["NM_RAZAO_SOCIAL"]?></td>
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
                        <tr style="background-color : #ccddee">
                          <td colspan="5" align="center"><b>Os Campos em Vermelho Estão Pendentes a mais de 30 dias</b></td>
                        </tr>
<?
}
?>
                  </table>
                </fieldset>
                </td>
              </tr>
            </table>

          </form>
<?
 // include ('../../templates/footer1.htm');
?>

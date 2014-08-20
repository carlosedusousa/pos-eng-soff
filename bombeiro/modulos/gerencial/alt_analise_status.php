<?
  include ('../../templates/head.htm');
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="analise_pen.php";
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
  /*
  $sql="SELECT ID_BATALHAO,ID_COMPANIA,ID_PELOTAO,ID_GRUPAMENTO FROM ".TBL_USUARIO." WHERE ID_USUARIO='".$usuario."'";
  $conn->query($sql);
  $lotacao = $conn->fetch_row();
/*
ID_PROTOCOLO
ID_SOLICITACAO
CH_ANALISE
ID_CEP
ID_LOGRADOURO
DT_PROTOCOLO
*/
  $sql="SELECT ".TBL_PROTOCOLOS.".ID_PROTOCOLO, ".TBL_SOLICITACAO.".NM_EDIFICACOES_LX, DATE_FORMAT(".TBL_PROTOCOLOS.".DT_PROTOCOLO,'%d/%m/%Y') DT_PROTOCOLOS, ".TBL_PROTOCOLOS.".ID_CIDADE, (TO_DAYS('".date("Y-m-d")."') - TO_DAYS(".TBL_PROTOCOLOS.".DT_PROTOCOLO)) AS DIAS, IF(".TBL_COB_BOLETO.".DT_PAGAMENTO IS NULL,'NÃO PAGO',DATE_FORMAT(".TBL_COB_BOLETO.".DT_PAGAMENTO,'%d/%m/%Y')) AS DT_PAGAMENTO, ".TBL_CIDADE.".NM_CIDADE  FROM ".TBL_PROTOCOLOS." LEFT JOIN ".TBL_SOLICITACAO." ON (".TBL_PROTOCOLOS.".ID_CIDADE=".TBL_SOLICITACAO.".ID_CIDADE AND ".TBL_PROTOCOLOS.".ID_SOLICITACAO=".TBL_SOLICITACAO.".ID_SOLICITACAO AND ".TBL_PROTOCOLOS.".ID_TIPO_SOLICITACAO=".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO) LEFT JOIN ".TBL_CIDADE." ON (".TBL_SOLICITACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_COB_BOLETO." ON (".TBL_PROTOCOLOS.".ID_CIDADE=".TBL_COB_BOLETO.".ID_CIDADE_PROTOCOLO AND ".TBL_PROTOCOLOS.".ID_PROTOCOLO=".TBL_COB_BOLETO.".ID_PROTOCOLO) WHERE ".TBL_PROTOCOLOS.".CH_ANALISE='N' AND ".TBL_SOLICITACAO.".CH_PROTOCOLADO='P' AND ".TBL_SOLICITACAO.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."') ORDER BY DT_PROTOCOLO ASC, NM_CIDADE ASC, ".TBL_PROTOCOLOS.".ID_PROTOCOLO ASC";
  echo "<!--aqui :$sql-->\n";
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
      var frm = document.frm_analise_pendencia;
      frm.hdn_id_protocolo.value=solicitacao;
      frm.hdn_id_cidade.value=cidade;
      //alert(frm.hdn_id_solicitacao.value);
      frm.submit();
    }
//--></script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_analise_pendencia" action="analise.php">
            <input type="hidden" name="hdn_id_protocolo" value="">
            <input type="hidden" name="hdn_id_cidade" value="">
            <table width="90%" cellspacing="0" border="0" cellpadding="5" align="center">
              <tr>
                <td>
                <fieldset>
                  <legend>Alteração Análise</legend>
                  <table width="100%" cellspacing="0" border="1" cellpadding="5" align="center">
                    <tr>
                      <th>Data</th>
                      <th>Edificação</th>
                      <th>Cidade</th>
                      <th>Status</th>
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
                        <tr style="background-color : #9bd5ff; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_PROTOCOLO"]?>','<?=$pendente["ID_CIDADE"]?>')">
<?
                        } else {
?>
                        <tr style="background-color : #ffffff; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_PROTOCOLO"]?>','<?=$pendente["ID_CIDADE"]?>')">
<?
                        }
?>
                          <td width="20" align="center"><?=$pendente["DT_PROTOCOLOS"]?></td>
                          <td><?=$pendente["NM_EDIFICACOES_LX"]?></td>
                          <td><?=$pendente["NM_CIDADE"]?></td>
                          <td><?=$pendente["DT_PAGAMENTO"]?></td>
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
                          <td colspan="4" align="center">Os Campos em Vermelhos Estão Pendentes a mais de 20 dias</td>
                        </tr>
<?
}
?>
                  </table>
<?/*
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;Edificação<br>
                  <select name="cmb_pendente" size="10">
<?
                    if ($rows_pendente>0) {
                      while ($pendente=$conn->fetch_row()) {
?>
                    <option value="<?=$pendente["ID_SOLICITACAO"]?>"><?=$pendente["DT_SOLICITACAO"]?>&nbsp;-&nbsp;<?=$pendente["NM_EDIFICACOES_LX"]?></option>
<?
                      }
                    } else {
?>
                    <option value="">00/00/0000&nbsp;-&nbsp;Nenhuma Solicitação Encontrada</option>
<?
                    }
?>
                  </select>
*/
?>
                </fieldset>
                </td>
              </tr>
            </table>

<?
/*
  include('../../templates/btn_inc.htm');
*/
?>
          </form>
<?
  include ('../../templates/footer.htm');
?>

<?
  $erro="";
  require_once 'lib/loader.php';

  $arquivo="pen_vist_func.php";
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";

  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  } else {
    die("ROTINA NÃO CADASTRADA");
  }
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

  $sql="SELECT ".TBL_PROT_HABITESE.".ID_PROT_HABITESE, ".TBL_PROT_HABITESE.".ID_CIDADE,  ".TBL_SOL_HABITESE.".NM_EDIFICACOES, ".TBL_CIDADE.".NM_CIDADE, DATE_FORMAT(".TBL_PROT_HABITESE.".DT_PROT_HABITESE,'%d/%m/%Y') DT_PROT_HABITESES, (TO_DAYS('".date("Y-m-d")."') - TO_DAYS(".TBL_PROT_HABITESE.".DT_PROT_HABITESE)) AS DIAS, IF(".TBL_COB_BOLETO.".DT_PAGAMENTO IS NULL,'NÃO PAGO',DATE_FORMAT(".TBL_COB_BOLETO.".DT_PAGAMENTO,'%d/%m/%Y')) AS DT_PAGAMENTO FROM ".TBL_PROT_HABITESE." LEFT JOIN ".TBL_SOL_HABITESE." ON (".TBL_PROT_HABITESE.".ID_CIDADE=".TBL_SOL_HABITESE.".ID_CIDADE AND ".TBL_PROT_HABITESE.".ID_SOLIC_HABITESE=".TBL_SOL_HABITESE.".ID_SOLIC_HABITESE AND ".TBL_PROT_HABITESE.".ID_TP_HABITESE=".TBL_SOL_HABITESE.".ID_TP_HABITESE) LEFT JOIN ".TBL_COB_BOLETO." ON (".TBL_PROT_HABITESE.".ID_CIDADE=".TBL_COB_BOLETO.".ID_CIDADE AND ".TBL_PROT_HABITESE.".ID_PROT_HABITESE=".TBL_COB_BOLETO.".ID_PROT_HABITESE) LEFT JOIN ".TBL_CIDADE." USING(ID_CIDADE) WHERE ".TBL_SOL_HABITESE.".CH_PROTOCOLADO='P' AND ".TBL_PROT_HABITESE.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."') ORDER BY DT_PROT_HABITESE ASC, NM_CIDADE ASC";

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
      var frm = document.frm_habitese_pendencia;
      frm.hdn_id_protocolo.value=solicitacao;
      frm.hdn_id_cidade.value=cidade;
      frm.submit();
    }
//--></script>
<body onload="ajustaspan()">

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_habitese_pendencia" action="vist_habitese.php">
            <input type="hidden" name="hdn_id_protocolo" value="">
            <input type="hidden" name="hdn_id_cidade" value="">
            <table width="90%" cellspacing="0" border="0" cellpadding="5" align="center">
              <tr>
                <td>
                <fieldset>
                  <legend>Análise Pendente</legend>
                  <table width="100%" cellspacing="0" border="1" cellpadding="5" align="center">
                    <tr>
                      <th>Data</th>
                      <th>Edificação</th>
                      <th>Cidade</th>
                      <th>Data Pagamento</th>
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
                        <tr style="background-color : #9bd5ff; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_PROT_HABITESE"]?>','<?=$pendente["ID_CIDADE"]?>')">
<?
                        } else {
?>
                        <tr style="background-color : #ffffff; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_PROT_HABITESE"]?>','<?=$pendente["ID_CIDADE"]?>')">
<?
                        }
?>
                          <td width="20" align="center"><?=$pendente["DT_PROT_HABITESES"]?></td>
                          <td><?=$pendente["NM_EDIFICACOES"]?></td>
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
                          <td colspan="3" align="center">Os Campos em Vermelhos Estão Pendentes a mais de 20 dias</td>
                        </tr>
<?
}
?>
                  </table>
                </fieldset>
                </td>
              </tr>
            </table>

<?

  include('./templates/btn_inc.htm');

?>
          </form>


<?
 include ('../../templates/head.htm');
?>
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="pen_logradouro.php";
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
  
  $lotacao = $conn->fetch_row();
  $sql="SELECT ".TBL_CEP.".ID_CEP, ".TBL_CIDADE.".ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE, ".TBL_LOGRADOURO.".ID_LOGRADOURO, ".TBL_LOGRADOURO.".NM_LOGRADOURO, ".TBL_BAIRROS.".ID_BAIRROS, ".TBL_BAIRROS.".NM_BAIRROS, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO, DATE_FORMAT(".TBL_LOGRADOURO.".DT_AGUARDO,'%d/%m/%Y') AS DT_AGUARDO, (TO_DAYS('".date("Y-m-d")."') - TO_DAYS(".TBL_LOGRADOURO.".DT_AGUARDO)) AS DIAS, ".TBL_USUARIO.".NM_USUARIO FROM  ".TBL_CEP." LEFT JOIN ".TBL_LOGRADOURO." ON (".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE) LEFT JOIN ".TBL_CIDADE."  ON (".TBL_LOGRADOURO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) LEFT JOIN ".TBL_USUARIO." ON (".TBL_LOGRADOURO.".ID_USUARIO=".TBL_USUARIO.".ID_USUARIO) WHERE ".TBL_CIDADE.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."') AND ".TBL_LOGRADOURO.".CH_AGUARDO='S' ORDER BY ".TBL_LOGRADOURO.".DT_AGUARDO ASC";
  echo "<!--//aqui :".$sql."-->\n";
  $conn->query($sql);
  $rows_pendente=$conn->num_rows();
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
      frm.txt_id_rotina.readOnly=false;
    }
    function envia_pendencia(cep,cidade,logradouro,bairros) {
      var frm = document.frm_pendencia_logra;
      frm.hdn_id_cep.value=cep;
      frm.hdn_id_cidade.value=cidade;
      frm.hdn_id_logradouro.value=logradouro;
      frm.hdn_id_bairros.value=bairros;
     //alert("=>"+frm.hdn_id_cep.value+"\n=>"+frm.hdn_id_cidade.value+"\n=>"+frm.hdn_id_logradouro.value+"\n=>"+frm.hdn_id_bairros.value);
      frm.submit();
    }
//--></script>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>

          <form target="_self" enctype="multipart/form-data" method="post" name="frm_pendencia_logra" action="cad_logradouro.php">
            <input type="hidden" name="hdn_id_cep" value="">
            <input type="hidden" name="hdn_id_cidade" value="">
            <input type="hidden" name="hdn_id_logradouro" value="">
            <input type="hidden" name="hdn_id_bairros" value="">
            <table width="95%" cellspacing="0" border="0" cellpadding="5" align="center">
              <tr>
                <td>
                <fieldset>
                  <legend>Protocolo Pendente</legend>
                  <table width="100%" cellspacing="0" border="1" cellpadding="3" align="center">
                    <tr>
                      <th>CEP</th>
                      <th>Logradouro</th>
                      <th>Bairro</th>
                      <th>Cidade</th>
                      <th>Data Requerimento</th>
                      <th>Usuário</th>
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
                        }
                        if ($resto!=0) {
?>
                        <tr style="background-color : #9bd5ff; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_CEP"]?>','<?=$pendente["ID_CIDADE"]?>','<?=$pendente["ID_LOGRADOURO"]?>','<?=$pendente["ID_BAIRROS"]?>')">
<?
                        } else {
?>
                        <tr style="background-color : #ffffff; cursor : pointer;<?=$dias?>" onclick="envia_pendencia('<?=$pendente["ID_CEP"]?>','<?=$pendente["ID_CIDADE"]?>','<?=$pendente["ID_LOGRADOURO"]?>','<?=$pendente["ID_BAIRROS"]?>')">
<?
                        }
?>
                          <td width="20" align="center"><?=formatCEP($pendente["ID_CEP"])?></td>
                          <td><?=$pendente["NM_TP_LOGRADOURO"]?>: <?=$pendente["NM_LOGRADOURO"]?></td>
                          <td><?=$pendente["NM_BAIRROS"]?></td>
                          <td><?=$pendente["NM_CIDADE"]?></td>
                          <td  align="center"><?=$pendente["DT_AGUARDO"]?></td>
                          <td><?=$pendente["NM_USUARIO"]?></td>
                        </tr>
<?
                        $cont++;
                      }
                    } else {
?>
                        <tr>
                          <td width="20" align="center">00.000-000</td>
                          <td colspan="3">Nenhuma Logradouro Pendente</td>
                          <td>00/00/0000</td>
                          <td>&nsbp;</td>
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
/*
  include('../../templates/btn_inc.htm');
*/
?>
          </form>
<?
  include ('../../templates/footer.htm');
?>

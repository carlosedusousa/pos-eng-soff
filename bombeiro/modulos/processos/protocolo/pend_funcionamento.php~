<?


  $erro="";
  require_once 'lib/loader.php';

  $arquivo="pend_funcionamento.php";
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";

  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row(); else die("ROTINA NÃO CADASTRADA!!");

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

  if ($_POST) foreach ($_POST as $i => $v) {
    $aux = explode('_', $i);
    if ($aux[0] == 'cbx') {
	$query_exclui = "DELETE FROM ".TBL_SOL_FUNC." WHERE ".TBL_SOL_FUNC.".ID_CIDADE=".$aux[2]." AND ".TBL_SOL_FUNC.".ID_SOLIC_FUNC=".$aux[1]." AND ".TBL_SOL_FUNC.".ID_TP_FUNC='".$aux[3]."'";
	$conn->query($query_exclui);
	$excluido = true;
    }
  }

  if ($global_exclusao=="S") {
    if ($excluido == true){
	  ?>
	    <script language="javascript" type="text/javascript">//<!--
	    alert("Exclusão realizada com Sucesso!");
	    //--></script>
	  <?
    }
  }
  $lotacao = $conn->fetch_row();

  $arq = explode('/',__FILE__); 
  $arq = end($arq);

  $sql="SELECT ".TBL_SOL_FUNC.".ID_USUARIO, ".TBL_SOL_FUNC.".ID_CIDADE, ".TBL_SOL_FUNC.".ID_SOLIC_FUNC, ".TBL_SOL_FUNC.".ID_TP_FUNC, ".TBL_SOL_FUNC.".NM_RAZAO_SOCIAL, ".TBL_SOL_FUNC.".NM_EDIFICACOES, ".TBL_CIDADE.".NM_CIDADE, DATE_FORMAT(".TBL_SOL_FUNC.".DT_SOLICITACAO,'%d/%m/%Y') DT_SOLICITACAOS, (TO_DAYS('".date("Y-m-d")."') - TO_DAYS(".TBL_SOL_FUNC.".DT_SOLICITACAO)) AS DIAS FROM ".TBL_SOL_FUNC." JOIN ".TBL_CIDADE." USING(ID_CIDADE) WHERE ".TBL_SOL_FUNC.".CH_PROTOCOLADO IN ('S','J') AND ".TBL_SOL_FUNC.".ID_CIDADE IN (SELECT ID_CIDADE FROM ".TBL_CIDADES_USR." WHERE ID_USUARIO='".$usuario."') ORDER BY NM_RAZAO_SOCIAL ASC, NM_CIDADE ASC ";

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
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.txt_id_rotina.readOnly=false;
    }
    function envia_pendencia(solicitacao,cidade,tipo) {
      var frm = document.frm_pendencia;
      frm.hdn_id_solic_funcionamento.value=solicitacao;
      frm.hdn_id_cidade.value=cidade;
      frm.hdn_id_tp_funcionamento.value=tipo;
     
      var op = "pendenteFuncionamentoChama";
      frm.op_menu.value = op;

      
      frm.submit();
    }

    function excluirRegistro(f) {

      f.submit();

    }

//--></script>
<body onload="ajustaspan()">
<form target="_self" enctype="multipart/form-data" method="post" name="frm_pendencia" >
<input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">
<input type="hidden" name="hdn_id_solic_funcionamento" value="">
<input type="hidden" name="hdn_id_cidade" value="">
<input type="hidden" name="hdn_id_tp_funcionamento" value="">
        
       
          <table width="100%" cellspacing="2" border="0" cellpadding="2" align="center">
              <tr>
                <td>
                <fieldset>
                  <legend>Protocolo Pendente</legend>
                  <table width="100%" cellspacing="1" border="0" cellpadding="5" align="center">
                     <tr style="background-color : #B0C4DE;">
                      <? if ($global_exclusao!="N") { ?>
                      <th width="20">Exclusão</th>
                      <? } ?>
                      <th nowrap>Data</a></th>
                      <th nowrap>Empresa</a></th>
                      <th nowrap>Cidade</a></th>

                    </tr>
<?
                    $diasd=false;
                    if ($rows_pendente>0) {
                      $cont=1;
                      while ($pendente=$conn->fetch_row()) {
                        $resto=$cont%2;
                          $dias="color : #2F4F4F;font-weight : bold;";
                          $diasd=true;

                        if ($resto!=0) {
?>
                      <tr style="background-color : #f5f5f5; cursor : pointer;<?=$dias?>"> 
<?
                        } else {
?>
                        <tr style="background-color : #ffffff; cursor : pointer;<?=$dias?>">
<?
    }

?>
                          <? if ($global_exclusao!="N") { ?>


			  <td align="center">
			  <input type="checkbox" name="cbx_<?=$pendente["ID_SOLIC_FUNC"]?>_<?=$pendente["ID_CIDADE"]?>_<?=$pendente["ID_TP_FUNC"]?>" >
			  </td>

                          <? } ?>
                          <td width="20" align="center" onclick="envia_pendencia('<?=$pendente["ID_SOLIC_FUNC"]?>','<?=$pendente["ID_CIDADE"]?>','<?=$pendente["ID_TP_FUNC"]?>')"><?=$pendente["DT_SOLICITACAOS"]?></td>
                          <td onclick="envia_pendencia('<?=$pendente["ID_SOLIC_FUNC"]?>','<?=$pendente["ID_CIDADE"]?>','<?=$pendente["ID_TP_FUNC"]?>')"><?=$pendente["NM_RAZAO_SOCIAL"]?></td>
                          <td align="center" onclick="envia_pendencia('<?=$pendente["ID_SOLIC_FUNC"]?>','<?=$pendente["ID_CIDADE"]?>','<?=$pendente["ID_TP_FUNC"]?>')"><?=$pendente["NM_CIDADE"]?></td>

                        </tr>
<?
                        $cont++;
                      }
                    } else {
?>
                        <tr>
			  <td></td>
                          <td width="20" align="center"></td>
                          <td colspan="3">Nenhuma Solicitação de Funcionamento Encontrada</td>
                        </tr>
<?
                    }

?>
		      <tr valign="top" align="center">
	                <td align="center" colspan="4"><br>
			  <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
	                    <tr align="center" valign="center">
	                      <td>
	                        <input type="button" name="btn_excluir" value="Excluir" align="middle" title="Excluir" class="botao"  onClick="excluirRegistro(this.form);" >
	                      </td>
	                      <td>
	                        <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa as Informações" class="botao" >
	                      </td>
	                    </tr>
	                  </table>
	                </td>
	              </tr>
                    </table>
                </fieldset>
                </td>
              </tr>
            </table>
          </form>

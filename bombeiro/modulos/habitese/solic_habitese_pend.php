<? 
// echo "<pre>"; print_r($_POST); echo "</pre>";


  $erro = "";
  require_once 'lib/loader.php';

  $arquivo = "solic_funcionamento.php";
  $conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) die($conn->get_msg());

  $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res = $conn->query($sql);
  $rows_rotina = $conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row();

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

    if($_POST["btn_excluir"] == 'Excluir') {

        foreach ($_POST as $indice => $valor) {

            $aux = explode('_',$indice);
            if ($aux[0].$aux[1] == 'cbxsolic') {
                $ID_SOLIC_HABITESE = $aux[2];
                $sql = "delete from SOLICITACAO.SOLIC_HABITESE where SOLICITACAO.ID_SOLIC_HABITESE = '$ID_SOLIC_HABITESE';";
//                  echo "$sql<br>";
              mysql_query($sql);
                $mesg_alert = 'Registro excluído com sucesso';
            }

        }

    }

   $sql = "SELECT CADASTROS.CIDADE.NM_CIDADE, SOLICITACAO.SOLIC_HABITESE.ID_CIDADE, SOLICITACAO.SOLIC_HABITESE.ID_SOLIC_HABITESE, SOLICITACAO.SOLIC_HABITESE.DATA, SOLICITACAO.SOLIC_HABITESE.NM_FANTASIA, SOLICITACAO.SOLIC_HABITESE.NM_SOLICITANTE FROM SOLICITACAO.SOLIC_HABITESE JOIN CADASTROS.CIDADE USING (ID_CIDADE) WHERE STATUS LIKE 'P'";
// echo $sql;exit;
   $res = mysql_query($sql);
   while ($r = mysql_fetch_assoc($res)) {
        $pendente[] = $r;
    }
  
//echo "<div align='left'><pre>";print_r($pendente); echo "</pre></div>"; //exit;



?>
<script language="javascript" type="text/javascript">
    function envia_pendencia(solicitacao,cidade) {
      var frm = document.frm_solic_pendente;
      frm.hdn_id_solic_habitese.value=solicitacao;
      frm.hdn_id_cidade.value=cidade;
     frm.op_menu.value='vist_habitese2';
//    alert(frm.hdn_id_solic_projeto.value+" "+frm.hdn_id_cidade.value) ;
      frm.submit();
    }
</script>

 
  
<form target="_self" enctype="multipart/form-data" method="post" name="frm_solic_pendente" action="index.php">
            <table width="98%" cellspacing="0" border="0" cellpadding="5" align="center">
		<input type="hidden" name="hdn_id_solic_habitese" value="">
		<input type="hidden" name="op_menu" value="vist_habitese">
               <input type="hidden" name="hdn_id_cidade" value="">
              <tr>
                <td>
                <fieldset>
                  <legend>Vistoria Pendente</legend>
                  <table width="100%" cellspacing="5" border="0" cellpadding="2" align="center">

                   <tr style="background-color:#ccddee">
  		   <? if ($_COOKIE['perfil'] == 'Analista') { ?><th nowrap width="20">&nbsp;</th><? } ?>
		      <th nowrap>Data</th>
                      <th nowrap>Solicitante</th>
		      <th nowrap>Empresa</th>
                      <th nowrap>Cidade</th>
                  </tr>


		  <? foreach ($pendente as $r) { 
			$d = explode('-',$r["DATA"]);
 			$data = $d[2].'/'.$d[1].'/'.$d[0];
			if ($cor == '#f5f5f5') $cor = '#ffffff'; else $cor = '#f5f5f5';
// 			if ($_COOKIE['perfil'] == 'Vistoriador') { PODE-SE RALIZAR UM TRATAMENTO PARA OUTROS PERFIS
			if(true){
			    $on_click = 'style="cursor:pointer;" onclick="envia_pendencia(\''.$r["ID_SOLIC_HABITESE"].'\',\''.$r["ID_CIDADE"].'\')"';
			}
		  ?>
	               <tr style="background-color:<?=$cor?>">
				 <? if ($_COOKIE['perfil'] == 'Analista') { ?><td align="center"><input type="checkbox" name="cbx_solic_<?=$r["ID_SOLIC_HABITESE"]?>"></td><? } ?>
				<td <?=$on_click?> align="center" style="background-color:<?=$cor?>"><?=$data?></td>
				<td <?=$on_click?> align="center" style="background-color:<?=$cor?>"><?=$r["NM_SOLICITANTE"]?></td>
				<td <?=$on_click?> align="center" style="background-color:<?=$cor?>"><?=$r["NM_FANTASIA"]?></td>
				<td <?=$on_click?> align="center" style="background-color:<?=$cor?>"><?=$r["NM_CIDADE"]?></td>
			</tr>

		  <? } ?>
		</table>
               </fieldset>
                </td>
              </tr>
	<? if ($_COOKIE['perfil'] == 'Analista') { ?>
              <tr valign="top" align="center">
                <td>
                    <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
                    <tr align="center" valign="center">
                        <td>
                        <input type="submit" name="btn_excluir" value="Excluir" class="botao" onclick="return confirm('Deseja realmente excluir?')">
                        </td>
                    </tr>
                    </table>
              </tr>
	<? } ?> 
    </table>
</form> 


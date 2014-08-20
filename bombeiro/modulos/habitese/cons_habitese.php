<?
// echo " <pre> "; print_r($_POST); echo "</pre>"; 
 
require './../../requires/loader.php';

    $ID_CIDADE = $_GET["cidade"];
    $NM_EDIFICACAO = $_GET["edificacao"];

    if ($NM_EDIFICACAO && $ID_CIDADE) {
	$sql = "SELECT ID_CIDADE, ID_EDIFICACAO, CPF_CNPJ, NM_EDIFICACAO, NM_FANTASIA, NR_CEP, AREA_TOTAL, NM_LOGRADOURO, NM_PROPRIETARIO, NM_BAIRRO FROM EDIFICACOES WHERE ID_CIDADE = $ID_CIDADE AND NM_EDIFICACAO LIKE '$NM_EDIFICACAO'";
//   	echo "sql: $sql"; exit;
        $res = mysql_query($sql);
	while ($r = mysql_fetch_assoc($res)) {
	    $edificacoes[] = $r;
	}
    } 

if (!$edificacoes){ 
?>
	<script language="javascript" type="text/javascript">
	window.opener.alert ("Nenhum registro encontrado para <?=$NM_EDIFICACAO?>,favor cadastrar no cadastro de edificações.");
	window.close();
	</script>
<? }
//echo "<pre>"; print_r($edificacoes); echo "</pre>";

 ?>
<form target="_self" enctype="multipart/form-data" method="post" name="frm_cons_habitese" action="index.php">
            <table width="98%" cellspacing="0" border="0" cellpadding="5" align="center">
		<!--<input type="hidden" name="hdn_id_solic_projeto" value="">-->
		<input type="hidden" name="op_menu" value="cons_habitese">
               <input type="hidden" name="hdn_id_cidade" value="">
              <tr>
                <td>
                <fieldset>
                  <legend>Edificações</legend>
                  <table width="100%" cellspacing="5" border="0" cellpadding="2" align="center">

                   <tr style="background-color:#ccddee">
  		      <th nowrap>Nome Fantasia</th>
                      <th nowrap>Logradouro</th>
		      <th nowrap>Proprietário</th>
                      <th nowrap>CPF</th>
		      <th nowrap>Bairro</th>
                  </tr>

<script language="javascript" type="text/javascript">
function carregar_dados(nm_edificacao, id_edificacao, nm_logradouro, cep, nm_bairro, area) {
	var f = window.opener.document.frm_habitese;
	// alert('1 '+nm_edificacao+'2 '+id_edificacao+'3 '+nm_logradouro+'4 '+cep+'5 '+nm_bairro+'6 '+area);
	f.txt_nm_edificacao.value = nm_edificacao;
	f.txt_re.value = id_edificacao;
	f.txt_nm_logradouro.value = nm_logradouro;
	f.txt_cep.value = cep;
	f.txt_bairro.value = nm_bairro;
	f.txt_area.value = area;
 	window.close();
}
</script>

		  <?  foreach ($edificacoes as $r) { 
			if ($cor == '#f5f5f5') $cor = '#ffffff'; else $cor = '#f5f5f5';
		  ?>
			<tr onclick="carregar_dados('<?=$r["NM_EDIFICACAO"]?>','<?=$r["ID_EDIFICACAO"]?>','<?=$r["NM_LOGRADOURO"]?>','<?=$r["NR_CEP"]?>','<?=$r["NM_BAIRRO"]?>','<?=$r["AREA_TOTAL"]?>')" style="cursor:pointer">
				<td align="center" style="background-color:<?=$cor?>"><?=$r["NM_FANTASIA"]?></td>
				<td align="center" style="background-color:<?=$cor?>"><?=$r["NM_LOGRADOURO"]?></td>
				<td align="center" style="background-color:<?=$cor?>"><?=$r["NM_PROPRIETARIO"]?></td>
				<td align="center" style="background-color:<?=$cor?>"><?=$r["CPF_CNPJ"]?></td>
				<td align="center" style="background-color:<?=$cor?>"><?=$r["NM_BAIRRO"]?></td>
			</tr>

		  <? } ?>
		</table>
               </fieldset>
                </td>
              </tr>
            </table>
</form> 
